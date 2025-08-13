<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'token',
        'client_name',
        'client_email',
        'company_name',
        'feedback_text',
        'rating',
        'status',
        'admin_notes',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'rating' => 'integer',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    // Relationships
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeDenied($query)
    {
        return $query->where('status', 'denied');
    }

    // Methods
    public static function generateToken(): string
    {
        return Str::random(32);
    }

    public function approve(User $user): void
    {
        $this->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => $user->id,
        ]);
    }

    public function deny(User $user, ?string $notes = null): void
    {
        $this->update([
            'status' => 'denied',
            'reviewed_at' => now(),
            'reviewed_by' => $user->id,
            'admin_notes' => $notes,
        ]);
    }
}
