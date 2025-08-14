<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
	use HasFactory;

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
		'is_active' => 'boolean',
		'application_deadline' => 'date',
		'salary_min' => 'decimal:2',
		'salary_max' => 'decimal:2',
	];

	public function scopeActive($query)
	{
		return $query->where('is_active', true);
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function applications(): HasMany
	{
		return $this->hasMany(JobApplication::class);
	}
}
