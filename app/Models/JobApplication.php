<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'cover_letter',
        'cv_path',
        'linkedin_url',
        'portfolio_url',
        'years_experience',
        'additional_info',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'years_experience' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    // Relationships
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', 'shortlisted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Methods
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function markAsReviewed(User $user, ?string $notes = null): void
    {
        $this->update([
            'status' => 'reviewed',
            'reviewed_at' => now(),
            'reviewed_by' => $user->id,
            'admin_notes' => $notes,
        ]);
    }

    public function shortlist(User $user, ?string $notes = null): void
    {
        $this->update([
            'status' => 'shortlisted',
            'reviewed_at' => now(),
            'reviewed_by' => $user->id,
            'admin_notes' => $notes,
        ]);
    }

    public function reject(User $user, ?string $notes = null): void
    {
        $this->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => $user->id,
            'admin_notes' => $notes,
        ]);
    }
}
