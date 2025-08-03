<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    /**
     * Store a new contact form submission
     */
    public function store(Request $request): JsonResponse
    {
        // Rate limiting
        $key = 'contact-form:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            
            return response()->json([
                'error' => 'Too many attempts',
                'message' => "Please wait {$seconds} seconds before submitting again.",
                'retry_after' => $seconds
            ], 429);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'project_type' => 'required|in:web,mobile,ecommerce,custom',
            'budget' => 'required|in:5k-15k,15k-30k,30k-50k,50k+',
            'timeline' => 'required|in:rush,4-8weeks,8-12weeks,flexible',
            'message' => 'required|string|max:2000|min:10',
            'features' => 'nullable|array',
            'features.*' => 'string|max:100',
            'estimated_quote' => 'nullable|numeric|min:0|max:999999.99'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'message' => 'Please check your input and try again.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create contact record
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'project_type' => $request->project_type,
                'budget' => $request->budget,
                'timeline' => $request->timeline,
                'message' => $request->message,
                'features' => $request->features ?? [],
                'estimated_quote' => $request->estimated_quote,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => Contact::STATUS_NEW,
                'priority' => $this->determinePriority($request),
                'is_read' => false
            ]);

            // Hit rate limiter
            RateLimiter::hit($key, 60 * 15); // 15 minutes

            // Send notification emails (in background)
            $this->sendNotificationEmails($contact);

            // Log the submission
            Log::info('New contact form submission', [
                'contact_id' => $contact->id,
                'email' => $contact->email,
                'project_type' => $contact->project_type,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We\'ll get back to you within 24 hours.',
                'contact_id' => $contact->id,
                'estimated_quote' => $contact->estimated_quote
            ], 201);

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'email' => $request->email,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'error' => 'Submission failed',
                'message' => 'We encountered an error processing your request. Please try again later.'
            ], 500);
        }
    }

    /**
     * Show success page data
     */
    public function success(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Your message has been sent successfully!',
            'next_steps' => [
                'We\'ll review your requirements within 24 hours',
                'Our team will reach out to schedule a consultation',
                'We\'ll provide a detailed proposal based on your needs'
            ],
            'contact_info' => [
                'email' => config('mail.from.address'),
                'response_time' => '24 hours',
                'availability' => 'Monday - Friday, 9 AM - 6 PM'
            ]
        ]);
    }

    /**
     * Admin: Get all contacts with pagination and filters
     */
    public function admin_index(Request $request): JsonResponse
    {
        $query = Contact::query();

        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('unread_only') && $request->unread_only) {
            $query->where('is_read', false);
        }

        if ($request->has('project_type')) {
            $query->where('project_type', $request->project_type);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Get paginated results
        $contacts = $query->paginate($request->get('per_page', 20));

        return response()->json($contacts);
    }

    /**
     * Admin: Show specific contact
     */
    public function admin_show(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read when viewed
        if (!$contact->is_read) {
            $contact->markAsRead();
        }

        return response()->json($contact);
    }

    /**
     * Admin: Mark contact as read
     */
    public function markAsRead(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Contact marked as read'
        ]);
    }

    /**
     * Admin: Delete contact
     */
    public function destroy(int $id): JsonResponse
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully'
        ]);
    }

    /**
     * Determine priority based on request data
     */
    private function determinePriority(Request $request): string
    {
        // High priority for rush timeline
        if ($request->timeline === 'rush') {
            return Contact::PRIORITY_HIGH;
        }

        // High priority for large budgets
        if (in_array($request->budget, ['30k-50k', '50k+'])) {
            return Contact::PRIORITY_HIGH;
        }

        // Normal priority for medium budgets
        if ($request->budget === '15k-30k') {
            return Contact::PRIORITY_NORMAL;
        }

        // Default to normal priority
        return Contact::PRIORITY_NORMAL;
    }

    /**
     * Send notification emails
     */
    private function sendNotificationEmails(Contact $contact): void
    {
        try {
            // Send admin notification
            Mail::send('emails.contact-notification', compact('contact'), function ($message) {
                $message->to(config('mail.admin_email', 'admin@egysyr.com'))
                        ->subject('New Contact Form Submission - EgySyr');
            });

            // Send auto-reply to customer
            Mail::send('emails.contact-auto-reply', compact('contact'), function ($message) use ($contact) {
                $message->to($contact->email, $contact->name)
                        ->subject('Thank you for contacting EgySyr');
            });

        } catch (\Exception $e) {
            Log::error('Failed to send contact notification emails', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}