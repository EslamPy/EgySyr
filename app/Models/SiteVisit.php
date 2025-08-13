<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'country',
        'country_code',
        'city',
        'page_url',
        'referrer',
        'session_duration',
        'is_unique_visitor',
        'visitor_id',
    ];

    protected $casts = [
        'is_unique_visitor' => 'boolean',
        'session_duration' => 'integer',
    ];

    // Scopes for analytics
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    public function scopeUniqueVisitors($query)
    {
        return $query->where('is_unique_visitor', true);
    }

    public function scopeByCountry($query, $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }
}
