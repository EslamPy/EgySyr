<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteVisit;
use Illuminate\Support\Str;

class SiteVisitController extends Controller
{
    public function track(Request $request)
    {
        $request->validate([
            'page_url' => 'required|string',
            'referrer' => 'nullable|string',
            'session_duration' => 'nullable|integer',
        ]);

        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        $visitorId = $request->cookie('visitor_id') ?: Str::uuid();

        // Check if this is a unique visitor (first visit today)
        $isUniqueVisitor = !SiteVisit::where('visitor_id', $visitorId)
            ->whereDate('created_at', today())
            ->exists();

        // Get location data (you can integrate with a GeoIP service)
        $locationData = $this->getLocationData($ipAddress);

        $visit = SiteVisit::create([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'country' => $locationData['country'] ?? null,
            'country_code' => $locationData['country_code'] ?? null,
            'city' => $locationData['city'] ?? null,
            'page_url' => $request->page_url,
            'referrer' => $request->referrer,
            'session_duration' => $request->session_duration ?? 0,
            'is_unique_visitor' => $isUniqueVisitor,
            'visitor_id' => $visitorId,
        ]);

        return response()->json([
            'success' => true,
            'visitor_id' => $visitorId,
        ])->cookie('visitor_id', $visitorId, 60 * 24 * 365); // 1 year
    }

    private function getLocationData(string $ipAddress): array
    {
        // For demo purposes, return sample data
        // In production, integrate with a service like MaxMind GeoIP2, ipapi.co, etc.

        if ($ipAddress === '127.0.0.1' || $ipAddress === '::1') {
            return [
                'country' => 'Local',
                'country_code' => 'LC',
                'city' => 'Localhost',
            ];
        }

        // Sample implementation - replace with actual GeoIP service
        $sampleCountries = [
            ['country' => 'United States', 'country_code' => 'US', 'city' => 'New York'],
            ['country' => 'United Kingdom', 'country_code' => 'GB', 'city' => 'London'],
            ['country' => 'Germany', 'country_code' => 'DE', 'city' => 'Berlin'],
            ['country' => 'France', 'country_code' => 'FR', 'city' => 'Paris'],
            ['country' => 'Egypt', 'country_code' => 'EG', 'city' => 'Cairo'],
            ['country' => 'Syria', 'country_code' => 'SY', 'city' => 'Damascus'],
        ];

        return $sampleCountries[array_rand($sampleCountries)];
    }
}
