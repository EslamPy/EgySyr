<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * List all feedback with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Feedback::with('reviewer:id,name');

        // Filter by status - but handle unsubmitted links differently
        if ($status = $request->get('status')) {
            if ($status === 'pending') {
                // For pending, show both unsubmitted links and submitted pending feedback
                $query->where(function ($q) {
                    $q->whereNull('submitted_at')
                      ->orWhere(function ($subQ) {
                          $subQ->whereNotNull('submitted_at')
                               ->where('status', 'pending');
                      });
                });
            } else {
                // For approved/denied, only show submitted feedback
                $query->where('status', $status)
                      ->whereNotNull('submitted_at');
            }
        }

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('feedback_text', 'like', "%{$search}%");
            });
        }

        $feedback = $query->orderByRaw('COALESCE(submitted_at, created_at) DESC')
            ->paginate(20);

        return response()->json($feedback);
    }

    /**
     * Generate new feedback link
     */
    public function generateLink(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
        ]);

        $feedback = Feedback::create([
            'token' => Feedback::generateToken(),
            'client_name' => $validated['client_name'],
            'client_email' => '',
            'company_name' => $validated['company_name'] ?? null,
            'feedback_text' => '',
            'status' => 'pending',
        ]);

        $feedbackUrl = url("/feedback/{$feedback->token}");

        return response()->json([
            'success' => true,
            'feedback_id' => $feedback->id,
            'token' => $feedback->token,
            'url' => $feedbackUrl,
            'client_name' => $feedback->client_name,
        ], 201);
    }

    /**
     * Approve feedback
     */
    public function approve(int $id): JsonResponse
    {
        $feedback = Feedback::findOrFail($id);

        if (!$feedback->submitted_at) {
            return response()->json(['error' => 'Cannot approve unsubmitted feedback'], 400);
        }

        $feedback->approve(Auth::user());

        return response()->json([
            'success' => true,
            'message' => 'Feedback approved successfully',
        ]);
    }

    /**
     * Deny feedback
     */
    public function deny(Request $request, int $id): JsonResponse
    {
        $feedback = Feedback::findOrFail($id);

        if (!$feedback->submitted_at) {
            return response()->json(['error' => 'Cannot deny unsubmitted feedback'], 400);
        }

        $validated = $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $feedback->deny(Auth::user(), $validated['admin_notes'] ?? null);

        return response()->json([
            'success' => true,
            'message' => 'Feedback denied successfully',
        ]);
    }

    /**
     * Delete feedback
     */
    public function destroy(int $id): JsonResponse
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback deleted successfully',
        ]);
    }

    /**
     * Get feedback statistics
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total' => Feedback::whereNotNull('submitted_at')->count(),
            'pending' => Feedback::where(function ($q) {
                $q->whereNull('submitted_at')
                  ->orWhere(function ($subQ) {
                      $subQ->whereNotNull('submitted_at')
                           ->where('status', 'pending');
                  });
            })->count(),
            'approved' => Feedback::approved()->count(),
            'denied' => Feedback::where('status', 'denied')->count(),
            'links_generated' => Feedback::count(),
            'links_unused' => Feedback::whereNull('submitted_at')->count(),
        ];

        return response()->json($stats);
    }
}
