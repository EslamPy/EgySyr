<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;


class FeedbackController extends Controller
{
    /**
     * Display feedback form by token
     */
    public function show(string $token): JsonResponse
    {
        $feedback = Feedback::where('token', $token)->first();

        if (!$feedback) {
            return response()->json(['error' => 'Invalid feedback link'], 404);
        }

        if ($feedback->submitted_at) {
            return response()->json(['error' => 'Feedback already submitted'], 400);
        }

        return response()->json([
            'token' => $feedback->token,
            'client_name' => $feedback->client_name,
            'client_email' => $feedback->client_email,
            'company_name' => $feedback->company_name,
        ]);
    }

    /**
     * Submit feedback
     */
    public function submit(Request $request, string $token): JsonResponse
    {
        $feedback = Feedback::where('token', $token)->first();

        if (!$feedback) {
            return response()->json(['error' => 'Invalid feedback link'], 404);
        }

        if ($feedback->submitted_at) {
            return response()->json(['error' => 'Feedback already submitted'], 400);
        }

        $validated = $request->validate([
            'feedback_text' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feedback->update([
            'feedback_text' => $validated['feedback_text'],
            'rating' => $validated['rating'],
            'submitted_at' => now(),
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback! It will be reviewed by our team.',
        ]);
    }

    /**
     * Get approved feedback for public display
     */
    public function approved(): JsonResponse
    {
        $feedback = Feedback::approved()
            ->whereNotNull('submitted_at')
            ->select(['client_name', 'company_name', 'feedback_text', 'rating', 'submitted_at'])
            ->orderBy('submitted_at', 'desc')
            ->limit(20)
            ->get();

        return response()->json($feedback);
    }
}
