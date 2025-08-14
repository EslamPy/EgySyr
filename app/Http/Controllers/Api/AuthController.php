<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register a new admin user
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
            ],
            'confirm_password' => 'required|same:password',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'username.regex' => 'Username can only contain letters, numbers, and underscores.',
            'username.unique' => 'This username is already taken.',
            'email.unique' => 'This email is already registered.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $profileImagePath = null;

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $profileImagePath = $image->storeAs('profile-images', $filename, 'public');
            }

            // Create user with pending status
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin',
                'status' => 'pending',
                'profile_image_path' => $profileImagePath,
            ]);

            return response()->json([
                'message' => 'Registration submitted successfully. Your account is under review.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status,
                ]
            ], 201);

        } catch (\Exception $e) {
            // Clean up uploaded file if user creation fails
            if ($profileImagePath && Storage::disk('public')->exists($profileImagePath)) {
                Storage::disk('public')->delete($profileImagePath);
            }

            return response()->json([
                'message' => 'Registration failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Login user
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Find user by email
            $user = User::where('email', $request->email)->first();

            // Check if user exists and password is correct
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            // Check if user is approved
            if ($user->status === 'pending') {
                return response()->json([
                    'message' => 'Your account is still under review. Please wait for admin approval.'
                ], 403);
            }

            if ($user->status === 'denied') {
                return response()->json([
                    'message' => 'Your account request was denied. Please contact the administrator.'
                ], 403);
            }

            if ($user->status !== 'approved') {
                return response()->json([
                    'message' => 'Your account is not active. Please contact the administrator.'
                ], 403);
            }

            // Login user
            Auth::login($user, $request->remember);

            // Update last login
            $user->update(['last_login_at' => now()]);

            return response()->json([
                'message' => 'Login successful',
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
                ],
                'token' => 'session-based', // For compatibility with frontend
                'expires_at' => now()->addHours(8)->toISOString(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Logged out successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Get current user
     */
    public function me(): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Not authenticated'
                ], 401);
            }

            return response()->json([
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
                'message' => 'Failed to get user data',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Refresh session
     */
    public function refresh(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'message' => 'Not authenticated'
                ], 401);
            }

            // Regenerate session
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Session refreshed successfully',
                'token' => 'session-based',
                'expires_at' => now()->addHours(8)->toISOString(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Session refresh failed',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
