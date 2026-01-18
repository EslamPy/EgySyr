<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'username',
        'email',
        'password',
        'role',
        'profile_image_path',
        'status',
        'denial_reason',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_image_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function permissions()
    {
        return $this->hasMany(UserPermission::class);
    }

    public function createdJobs()
    {
        return $this->hasMany(Job::class, 'created_by');
    }

    public function reviewedFeedback()
    {
        return $this->hasMany(Feedback::class, 'reviewed_by');
    }

    public function reviewedApplications()
    {
        return $this->hasMany(JobApplication::class, 'reviewed_by');
    }

    // Mutators
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
        $this->updateNameAttribute();
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = $value;
        $this->updateNameAttribute();
    }

    private function updateNameAttribute()
    {
        $firstName = $this->attributes['first_name'] ?? '';
        $lastName = $this->attributes['last_name'] ?? '';
        $this->attributes['name'] = trim($firstName . ' ' . $lastName);
    }

    // Accessors
    public function getAvatarDataUrlAttribute(): ?string
    {
        return $this->getProfileImageUrlAttribute();
    }

    // Status methods
    public function isApproved(): bool { return $this->status === 'approved'; }
    public function isPending(): bool { return $this->status === 'pending'; }
    public function isDenied(): bool { return $this->status === 'denied'; }

    // Role methods
    public function isOwner(): bool { return $this->role === 'owner'; }
    public function isAdmin(): bool { return $this->role === 'admin'; }

    // Permission methods
    public function hasPermission(string $permission, string $action = 'view'): bool
    {
        if ($this->isOwner()) {
            return true; // Owner has all permissions
        }

        $userPermission = $this->permissions()
            ->where('permission', $permission)
            ->first();

        if (!$userPermission) {
            return false;
        }

        return match($action) {
            'view' => $userPermission->can_view,
            'create' => $userPermission->can_create,
            'edit' => $userPermission->can_edit,
            'delete' => $userPermission->can_delete,
            default => false,
        };
    }

    public function getProfileImageUrlAttribute(): ?string
    {
        if (!$this->profile_image_path) {
            return null;
        }

        return asset('storage/' . $this->profile_image_path);
    }
}
