<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'permission',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    protected $casts = [
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_edit' => 'boolean',
        'can_delete' => 'boolean',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Available permissions
    public const PERMISSIONS = [
        'dashboard' => 'Dashboard',
        'users' => 'User Management',
        'jobs' => 'Job Management',
        'feedback' => 'Feedback Management',
        'messages' => 'Contact Messages',
        'site_visits' => 'Site Analytics',
    ];

    // Methods
    public static function createDefaultPermissions(User $user, array $permissions = []): void
    {
        foreach (array_keys(self::PERMISSIONS) as $permission) {
            $permissionData = $permissions[$permission] ?? [
                'can_view' => true,
                'can_create' => false,
                'can_edit' => false,
                'can_delete' => false,
            ];

            self::updateOrCreate(
                ['user_id' => $user->id, 'permission' => $permission],
                $permissionData
            );
        }
    }

    public static function createOwnerPermissions(User $user): void
    {
        $ownerPermissions = [];
        foreach (array_keys(self::PERMISSIONS) as $permission) {
            $ownerPermissions[$permission] = [
                'can_view' => true,
                'can_create' => true,
                'can_edit' => true,
                'can_delete' => true,
            ];
        }

        self::createDefaultPermissions($user, $ownerPermissions);
    }
}
