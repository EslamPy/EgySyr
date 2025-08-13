<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobApplicationsExport;

class JobApplicationController extends Controller
{
    /**
     * List job applications with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = JobApplication::with(['job:id,title,slug', 'reviewer:id,name']);

        // Filter by job
        if ($jobId = $request->get('job_id')) {
            $query->where('job_id', $jobId);
        }

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('job', function($jobQuery) use ($search) {
                      $jobQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        $applications = $query->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($applications);
    }

    /**
     * Show application details
     */
    public function show(int $id): JsonResponse
    {
        $application = JobApplication::with(['job', 'reviewer:id,name'])
            ->findOrFail($id);

        return response()->json($application);
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $application = JobApplication::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $application->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application status updated successfully',
            'application' => $application->load(['job:id,title', 'reviewer:id,name']),
        ]);
    }

    /**
     * Delete application
     */
    public function destroy(int $id): JsonResponse
    {
        $application = JobApplication::findOrFail($id);

        // Delete CV file if exists
        if ($application->cv_path && Storage::disk('public')->exists($application->cv_path)) {
            Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully',
        ]);
    }

    /**
     * Download CV file
     */
    public function downloadCv(int $id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $application = JobApplication::findOrFail($id);

        if (!$application->cv_path || !Storage::disk('public')->exists($application->cv_path)) {
            abort(404, 'CV file not found');
        }

        $filePath = Storage::disk('public')->path($application->cv_path);
        $fileName = $application->full_name . '_CV.' . pathinfo($application->cv_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }

    /**
     * Export applications to Excel
     */
    public function export(Request $request)
    {
        $jobId = $request->get('job_id');
        $status = $request->get('status');

        return Excel::download(
            new JobApplicationsExport($jobId, $status),
            'job_applications_' . date('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Get application statistics
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total' => JobApplication::count(),
            'pending' => JobApplication::where('status', 'pending')->count(),
            'reviewed' => JobApplication::where('status', 'reviewed')->count(),
            'shortlisted' => JobApplication::where('status', 'shortlisted')->count(),
            'rejected' => JobApplication::where('status', 'rejected')->count(),
            'today' => JobApplication::whereDate('created_at', today())->count(),
            'this_week' => JobApplication::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])->count(),
        ];

        // Applications by job
        $applicationsByJob = Job::withCount('applications')
            ->having('applications_count', '>', 0)
            ->orderByDesc('applications_count')
            ->limit(10)
            ->get(['id', 'title', 'applications_count']);

        return response()->json([
            'stats' => $stats,
            'by_job' => $applicationsByJob,
        ]);
    }
}
