<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteVisit;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Models\Job;
use App\Models\JobApplication;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function stats()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        // Site visits stats
        $visitsToday = SiteVisit::whereDate('created_at', $today)->count();
        $uniqueVisitorsToday = SiteVisit::whereDate('created_at', $today)
            ->where('is_unique_visitor', true)->count();

        $visitsThisWeek = SiteVisit::where('created_at', '>=', $thisWeek)->count();
        $visitsThisMonth = SiteVisit::where('created_at', '>=', $thisMonth)->count();

        // Average session duration (in minutes)
        $avgSession = SiteVisit::whereDate('created_at', $today)
            ->avg('session_duration') / 60; // Convert to minutes

        // Top countries today
        $topCountries = SiteVisit::whereDate('created_at', $today)
            ->selectRaw('country, country_code, COUNT(*) as visits')
            ->whereNotNull('country')
            ->groupBy('country', 'country_code')
            ->orderByDesc('visits')
            ->limit(5)
            ->get();

        // Contact messages stats
        $newMessages = ContactMessage::whereDate('created_at', $today)->count();
        $totalMessages = ContactMessage::count();

        // Feedback stats
        $pendingFeedback = Feedback::where('status', 'pending')->count();
        $approvedFeedback = Feedback::where('status', 'approved')->count();

        // Jobs stats
        $activeJobs = Job::where('is_active', true)->count();
        $newApplications = JobApplication::whereDate('created_at', $today)->count();
        $totalApplications = JobApplication::count();

        return response()->json([
            'site_visits' => [
                'today' => $visitsToday,
                'unique_today' => $uniqueVisitorsToday,
                'this_week' => $visitsThisWeek,
                'this_month' => $visitsThisMonth,
                'avg_session' => round($avgSession, 1),
                'top_countries' => $topCountries,
            ],
            'messages' => [
                'new_today' => $newMessages,
                'total' => $totalMessages,
            ],
            'feedback' => [
                'pending' => $pendingFeedback,
                'approved' => $approvedFeedback,
            ],
            'jobs' => [
                'active' => $activeJobs,
                'new_applications' => $newApplications,
                'total_applications' => $totalApplications,
            ],
        ]);
    }

    public function visitsChart(Request $request)
    {
        $period = $request->get('period', '7days'); // 7days, 30days, 90days

        $days = match($period) {
            '7days' => 7,
            '30days' => 30,
            '90days' => 90,
            default => 7,
        };

        $startDate = Carbon::now()->subDays($days);

        $visits = SiteVisit::where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as visits, COUNT(CASE WHEN is_unique_visitor = 1 THEN 1 END) as unique_visits')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($visits);
    }

    public function worldMapData()
    {
        $countryData = SiteVisit::selectRaw('country_code, country, COUNT(*) as visits, COUNT(CASE WHEN is_unique_visitor = 1 THEN 1 END) as unique_visits')
            ->whereNotNull('country_code')
            ->groupBy('country_code', 'country')
            ->orderByDesc('visits')
            ->get();

        return response()->json($countryData);
    }
}
