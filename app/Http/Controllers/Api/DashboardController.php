<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Get dashboard overview statistics
     */
    public function overview(): JsonResponse
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            'site_visits' => [
                'total' => SiteVisit::count(),
                'today' => SiteVisit::whereDate('created_at', $today)->count(),
                'this_week' => SiteVisit::where('created_at', '>=', $thisWeek)->count(),
                'this_month' => SiteVisit::where('created_at', '>=', $thisMonth)->count(),
                'unique_today' => SiteVisit::whereDate('created_at', $today)->where('is_unique_visitor', true)->count(),
                'avg_session_seconds_today' => (int) round((float) SiteVisit::whereDate('created_at', $today)->avg('session_duration')),
            ],
            'contact_messages' => [
                'total' => ContactMessage::count(),
                'unread' => 0,
                'today' => ContactMessage::whereDate('created_at', $today)->count(),
                'this_week' => ContactMessage::where('created_at', '>=', $thisWeek)->count(),
            ],
            'feedback' => [
                'total' => Feedback::count(),
                'pending' => Feedback::where('status', 'pending')->count(),
                'approved' => Feedback::where('status', 'approved')->count(),
                'today' => Feedback::whereDate('created_at', $today)->count(),
            ],
            'job_applications' => [
                'total' => JobApplication::count(),
                'pending' => JobApplication::where('status', 'pending')->count(),
                'reviewed' => JobApplication::where('status', 'reviewed')->count(),
                'today' => JobApplication::whereDate('created_at', $today)->count(),
            ],
            'users' => [
                'total' => User::count(),
                'pending_approval' => User::where('status', 'pending')->count(),
                'approved' => User::where('status', 'approved')->count(),
                'admins' => User::where('role', 'admin')->where('status', 'approved')->count(),
            ],
        ];

        return response()->json($stats);
    }

    /**
     * Get recent activity for dashboard
     */
    public function recentActivity(): JsonResponse
    {
        $activities = collect();

        // Recent contact messages
        $recentMessages = ContactMessage::select('id', 'name', 'subject', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($message) {
                return [
                    'type' => 'contact_message',
                    'title' => "New message from {$message->name}",
                    'description' => $message->subject,
                    'created_at' => $message->created_at,
                    'url' => '/admin/messages',
                ];
            });

        // Recent feedback
        $recentFeedback = Feedback::select('id', 'client_name', 'rating', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($feedback) {
                return [
                    'type' => 'feedback',
                    'title' => "New feedback from {$feedback->client_name}",
                    'description' => "Rating: {$feedback->rating}/5 - Status: {$feedback->status}",
                    'created_at' => $feedback->created_at,
                    'url' => '/admin/feedback',
                ];
            });

        // Recent job applications
        $recentApplications = JobApplication::with('job:id,title')
            ->select('id', 'job_id', 'first_name', 'last_name', 'status', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($application) {
                return [
                    'type' => 'job_application',
                    'title' => "New application from {$application->first_name} {$application->last_name}",
                    'description' => "Applied for: " . ($application->job->title ?? 'Unknown Position'),
                    'created_at' => $application->created_at,
                    'url' => '/admin/job-applications',
                ];
            });

        // Recent user registrations
        $recentUsers = User::select('id', 'name', 'email', 'status', 'created_at')
            ->where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($user) {
                return [
                    'type' => 'user_registration',
                    'title' => "New admin registration: {$user->name}",
                    'description' => "Email: {$user->email} - Status: {$user->status}",
                    'created_at' => $user->created_at,
                    'url' => '/admin/users',
                ];
            });

        // Combine and sort all activities
        $activities = $activities
            ->concat($recentMessages)
            ->concat($recentFeedback)
            ->concat($recentApplications)
            ->concat($recentUsers)
            ->sortByDesc('created_at')
            ->take(15)
            ->values();

        return response()->json($activities);
    }

    /**
     * Get world map data
     */
    public function worldMap(): JsonResponse
    {
        $countries = SiteVisit::select(
            'country',
            'country_code',
            DB::raw('count(*) as visits'),
            DB::raw('count(distinct ip_address) as unique_visitors')
        )
            ->whereNotNull('country')
            ->whereNotNull('country_code')
            ->groupBy('country', 'country_code')
            ->orderBy('visits', 'desc')
            ->get();

        return response()->json($countries);
    }

    /**
     * Get analytics data for charts
     */
    public function analytics(Request $request): JsonResponse
    {
        $period = $request->get('period', '30');
        $startDate = Carbon::now()->subDays($period);

        $data = [
            'visits_over_time' => SiteVisit::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as visits'),
                DB::raw('count(distinct ip_address) as unique_visitors')
            )
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date')
                ->get(),

            'top_pages' => SiteVisit::select('page_url as page', DB::raw('count(*) as visits'))
                ->where('created_at', '>=', $startDate)
                ->whereNotNull('page_url')
                ->groupBy('page_url')
                ->orderBy('visits', 'desc')
                ->limit(10)
                ->get(),

            'browser_stats' => SiteVisit::select(
                DB::raw('CASE
                    WHEN user_agent LIKE "%Chrome%" THEN "Chrome"
                    WHEN user_agent LIKE "%Firefox%" THEN "Firefox"
                    WHEN user_agent LIKE "%Safari%" AND user_agent NOT LIKE "%Chrome%" THEN "Safari"
                    WHEN user_agent LIKE "%Edge%" THEN "Edge"
                    ELSE "Other"
                END as browser'),
                DB::raw('count(*) as visits')
            )
                ->where('created_at', '>=', $startDate)
                ->whereNotNull('user_agent')
                ->groupBy('browser')
                ->orderBy('visits', 'desc')
                ->get(),

            'device_stats' => SiteVisit::select(
                DB::raw('CASE
                    WHEN user_agent LIKE "%Mobile%" THEN "Mobile"
                    WHEN user_agent LIKE "%Tablet%" THEN "Tablet"
                    ELSE "Desktop"
                END as device'),
                DB::raw('count(*) as visits')
            )
                ->where('created_at', '>=', $startDate)
                ->whereNotNull('user_agent')
                ->groupBy('device')
                ->orderBy('visits', 'desc')
                ->get(),

            'top_countries' => SiteVisit::select(
                'country',
                DB::raw('count(*) as visits')
            )
                ->whereNotNull('country')
                ->where('created_at', '>=', $startDate)
                ->groupBy('country')
                ->orderBy('visits', 'desc')
                ->limit(10)
                ->get(),
        ];

        return response()->json($data);
    }

    /**
     * Export analytics data to CSV
     */
    public function exportAnalytics(Request $request)
    {
        $period = $request->get('period', '30');
        $data = $this->analytics($request)->getData(true);

        $filename = 'analytics-' . $period . 'days-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            // Write headers
            fputcsv($file, ['Date', 'Visits', 'Unique Visitors']);

            // Write data
            foreach ($data['visits_over_time'] as $row) {
                fputcsv($file, [
                    $row['date'],
                    $row['visits'],
                    $row['unique_visitors'] ?? 0
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
