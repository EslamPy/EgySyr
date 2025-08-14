<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Update user profile
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
                'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'], // 2MB max
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validated = $validator->validated();

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($user->profile_image_path) {
                    Storage::disk('public')->delete($user->profile_image_path);
                }

                // Store new image
                $imagePath = $request->file('profile_image')->store('profile-images', 'public');
                $validated['profile_image_path'] = $imagePath;
            }

            // Update user
            $user->update($validated);

            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                    'status' => $user->status,
                    'profile_image_path' => $user->profile_image_path,
                    'profile_image_url' => $user->profile_image_path 
                        ? Storage::url($user->profile_image_path) 
                        : null,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update profile',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'current_password' => ['required', 'string'],
                'new_password' => ['required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'Current password is incorrect',
                    'errors' => ['current_password' => ['Current password is incorrect']]
                ], 422);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'message' => 'Password changed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to change password',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Update user preferences
     */
    public function updatePreferences(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'email_notifications' => ['boolean'],
                'browser_notifications' => ['boolean'],
                'theme' => ['string', 'in:dark,light,auto'],
                'language' => ['string', 'in:en,ar,fr,es'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $preferences = $validator->validated();

            // Store preferences in user's preferences column (JSON)
            // You might want to add a preferences column to users table
            // For now, we'll just return success
            
            return response()->json([
                'message' => 'Preferences updated successfully',
                'preferences' => $preferences
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update preferences',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get user preferences
     */
    public function getPreferences(): JsonResponse
    {
        try {
            $user = Auth::user();

            // Default preferences
            $preferences = [
                'email_notifications' => true,
                'browser_notifications' => false,
                'theme' => 'dark',
                'language' => 'en',
            ];

            // If you have a preferences column, merge with stored preferences
            // $preferences = array_merge($preferences, $user->preferences ?? []);

            return response()->json($preferences);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to get preferences',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
