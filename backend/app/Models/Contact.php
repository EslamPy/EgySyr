<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'company',
        'project_type',
        'budget',
        'timeline',
        'message',
        'features',
        'estimated_quote',
        'ip_address',
        'user_agent',
        'is_read',
        'status',
        'priority',
        'assigned_to',
        'responded_at',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'features' => 'array',
        'estimated_quote' => 'decimal:2',
        'is_read' => 'boolean',
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'ip_address',
        'user_agent'
    ];

    /**
     * Status constants
     */
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESPONDED = 'responded';
    const STATUS_CLOSED = 'closed';
    const STATUS_SPAM = 'spam';

    /**
     * Priority constants
     */
    const PRIORITY_LOW = 'low';
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    /**
     * Get all possible statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_RESPONDED => 'Responded',
            self::STATUS_CLOSED => 'Closed',
            self::STATUS_SPAM => 'Spam'
        ];
    }

    /**
     * Get all possible priorities
     */
    public static function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_NORMAL => 'Normal',
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_URGENT => 'Urgent'
        ];
    }

    /**
     * Scope for unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for specific status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for recent contacts
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Mark contact as read
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }

    /**
     * Update status
     */
    public function updateStatus(string $status): bool
    {
        $validStatuses = array_keys(self::getStatuses());
        
        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $data = ['status' => $status];
        
        if ($status === self::STATUS_RESPONDED) {
            $data['responded_at'] = now();
        }

        return $this->update($data);
    }

    /**
     * Get formatted budget range
     */
    public function getFormattedBudgetAttribute(): string
    {
        return match($this->budget) {
            '5k-15k' => '$5,000 - $15,000',
            '15k-30k' => '$15,000 - $30,000',
            '30k-50k' => '$30,000 - $50,000',
            '50k+' => '$50,000+',
            default => 'Not specified'
        };
    }

    /**
     * Get formatted project type
     */
    public function getFormattedProjectTypeAttribute(): string
    {
        return match($this->project_type) {
            'web' => 'Web Application',
            'mobile' => 'Mobile App',
            'ecommerce' => 'E-commerce',
            'custom' => 'Custom Solution',
            default => 'Not specified'
        };
    }

    /**
     * Get formatted timeline
     */
    public function getFormattedTimelineAttribute(): string
    {
        return match($this->timeline) {
            'rush' => 'ASAP (Rush)',
            '4-8weeks' => '4-8 weeks',
            '8-12weeks' => '8-12 weeks',
            'flexible' => 'Flexible',
            default => 'Not specified'
        };
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_NEW => 'blue',
            self::STATUS_IN_PROGRESS => 'yellow',
            self::STATUS_RESPONDED => 'green',
            self::STATUS_CLOSED => 'gray',
            self::STATUS_SPAM => 'red',
            default => 'gray'
        };
    }

    /**
     * Get priority badge color
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'gray',
            self::PRIORITY_NORMAL => 'blue',
            self::PRIORITY_HIGH => 'orange',
            self::PRIORITY_URGENT => 'red',
            default => 'gray'
        };
    }
}