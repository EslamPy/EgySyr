<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * List all jobs with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Job::with([
            'creator' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            },
            'applications' => function($q) {
                $q->selectRaw('job_id, COUNT(*) as count')->groupBy('job_id');
            }
        ]);

        // Filter by status
        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $jobs = $query->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($jobs);
    }

    /**
     * Store new job
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'department' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_currency' => 'nullable|string|size:3',
            'application_deadline' => 'nullable|date|after:today',
            'is_active' => 'boolean',
        ]);

        // Generate unique slug
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;

        while (Job::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $job = Job::create([
            ...$validated,
            'slug' => $slug,
            'created_by' => Auth::id(),
            'salary_currency' => $validated['salary_currency'] ?? 'USD',
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job created successfully',
            'job' => $job->load(['creator' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }]),
        ], 201);
    }

    /**
     * Show job details
     */
    public function show(int $id): JsonResponse
    {
        $job = Job::with([
            'creator' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            },
            'applications'
        ])->findOrFail($id);

        return response()->json($job);
    }

    /**
     * Update job
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'department' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_currency' => 'nullable|string|size:3',
            'application_deadline' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        // Update slug if title changed
        if ($validated['title'] !== $job->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Job::where('slug', $slug)->where('id', '!=', $job->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $validated['slug'] = $slug;
        }

        $job->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully',
            'job' => $job->load(['creator' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            }]),
        ]);
    }

    /**
     * Delete job
     */
    public function destroy(int $id): JsonResponse
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully',
        ]);
    }

    /**
     * Toggle job active status
     */
    public function toggleStatus(int $id): JsonResponse
    {
        $job = Job::findOrFail($id);
        $job->update(['is_active' => !$job->is_active]);

        return response()->json([
            'success' => true,
            'message' => $job->is_active ? 'Job activated' : 'Job deactivated',
            'is_active' => $job->is_active,
        ]);
    }
}
