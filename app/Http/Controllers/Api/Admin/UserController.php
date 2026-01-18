<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * List all users with filtering
     */
    public function index(Request $request): JsonResponse
    {
        // Only owners can manage users
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $query = User::with('permissions');

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Filter by role
        if ($role = $request->get('role')) {
            $query->where('role', $role);
        }

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($users);
    }

    /**
     * Show user details
     */
    public function show(int $id): JsonResponse
    {
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::with('permissions')->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Approve user
     */
    public function approve(int $id): JsonResponse
    {
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::findOrFail($id);

        if ($user->status !== 'pending') {
            return response()->json(['error' => 'User is not pending approval'], 400);
        }

        $user->update([
            'status' => 'approved',
            'denial_reason' => null,
        ]);

        // Create default permissions for approved user
        UserPermission::createDefaultPermissions($user);

        return response()->json([
            'success' => true,
            'message' => 'User approved successfully',
        ]);
    }

    /**
     * Deny user
     */
    public function deny(Request $request, int $id): JsonResponse
    {
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::findOrFail($id);

        if ($user->status !== 'pending') {
            return response()->json(['error' => 'User is not pending approval'], 400);
        }

        $validated = $request->validate([
            'denial_reason' => 'required|string|max:500',
        ]);

        $user->update([
            'status' => 'denied',
            'denial_reason' => $validated['denial_reason'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User denied successfully',
        ]);
    }

    /**
     * Update user permissions
     */
    public function updatePermissions(Request $request, int $id): JsonResponse
    {
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::findOrFail($id);

        if ($user->isOwner()) {
            return response()->json(['error' => 'Cannot modify owner permissions'], 400);
        }

        $validated = $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'array',
            'permissions.*.can_view' => 'boolean',
            'permissions.*.can_create' => 'boolean',
            'permissions.*.can_edit' => 'boolean',
            'permissions.*.can_delete' => 'boolean',
        ]);

        foreach ($validated['permissions'] as $permission => $actions) {
            UserPermission::updateOrCreate(
                ['user_id' => $user->id, 'permission' => $permission],
                $actions
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Permissions updated successfully',
        ]);
    }

    /**
     * Delete user
     */
    public function destroy(int $id): JsonResponse
    {
        if (!Auth::user()->isOwner()) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $user = User::findOrFail($id);

        if ($user->isOwner()) {
            return response()->json(['error' => 'Cannot delete owner account'], 400);
        }

        if ($user->id === Auth::id()) {
            return response()->json(['error' => 'Cannot delete your own account'], 400);
        }

        // Delete profile image if exists
        if ($user->profile_image_path && Storage::disk('public')->exists($user->profile_image_path)) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}
