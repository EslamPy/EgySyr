<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'requirements',
        'location',
        'type',
        'department',
        'salary_min',
        'salary_max',
        'salary_currency',
        'is_active',
        'application_deadline',
        'created_by',
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'is_active' => 'boolean',
        'application_deadline' => 'date',
    ];

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Methods
    public static function generateSlug(string $title): string
    {
        return Str::slug($title);
    }

    public function getFormattedSalaryAttribute(): ?string
    {
        if (!$this->salary_min && !$this->salary_max) {
            return null;
        }

        $currency = $this->salary_currency;

        if ($this->salary_min && $this->salary_max) {
            return "{$currency} {$this->salary_min} - {$this->salary_max}";
        }

        if ($this->salary_min) {
            return "{$currency} {$this->salary_min}+";
        }

        return "{$currency} {$this->salary_max}";
    }

    public function getApplicationsCountAttribute(): int
    {
        return $this->applications()->count();
    }
}
