<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * List active jobs for public careers page
     */
    public function index(): JsonResponse
    {
        $jobs = Job::active()
            ->with('creator:id,name')
            ->select([
                'id', 'title', 'slug', 'description', 'requirements',
                'location', 'type', 'department', 'salary_min', 'salary_max',
                'salary_currency', 'application_deadline', 'created_at', 'created_by'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($jobs);
    }

    /**
     * Show single job by slug
     */
    public function show(string $slug): JsonResponse
    {
        $job = Job::active()
            ->with('creator:id,name')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($job);
    }

    /**
     * Submit job application
     */
    public function apply(Request $request, string $slug): JsonResponse
    {
        $job = Job::active()->where('slug', $slug)->firstOrFail();

        // Check if application deadline has passed
        if ($job->application_deadline && $job->application_deadline->isPast()) {
            return response()->json([
                'error' => 'Application deadline has passed'
            ], 400);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string|max:2000',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'years_experience' => 'nullable|integer|min:0|max:50',
            'additional_info' => 'nullable|string|max:1000',
        ]);

        // Check for duplicate application
        $existingApplication = JobApplication::where('job_id', $job->id)
            ->where('email', $validated['email'])
            ->first();

        if ($existingApplication) {
            return response()->json([
                'error' => 'You have already applied for this position'
            ], 400);
        }

        // Store CV file
        $cvPath = $request->file('cv')->store('job-applications', 'public');

        $application = JobApplication::create([
            'job_id' => $job->id,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cover_letter' => $validated['cover_letter'],
            'cv_path' => $cvPath,
            'linkedin_url' => $validated['linkedin_url'],
            'portfolio_url' => $validated['portfolio_url'],
            'years_experience' => $validated['years_experience'],
            'additional_info' => $validated['additional_info'],
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully! We will review your application and get back to you soon.',
            'application_id' => $application->id,
        ], 201);
    }
}
