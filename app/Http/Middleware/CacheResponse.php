<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $duration = 3600): Response
    {
        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Don't cache authenticated requests
        if ($request->user()) {
            return $next($request);
        }

        // Generate cache key based on URL and query parameters
        $cacheKey = $this->generateCacheKey($request);

        // Check if response is cached
        $cachedResponse = Cache::get($cacheKey);
        
        if ($cachedResponse) {
            return response($cachedResponse['content'])
                ->header('Content-Type', $cachedResponse['content_type'])
                ->header('X-Cache', 'HIT')
                ->header('Cache-Control', 'public, max-age=' . $duration);
        }

        // Get response from next middleware
        $response = $next($request);

        // Only cache successful responses
        if ($response->getStatusCode() === 200) {
            $cacheData = [
                'content' => $response->getContent(),
                'content_type' => $response->headers->get('Content-Type', 'text/html'),
            ];

            Cache::put($cacheKey, $cacheData, now()->addSeconds($duration));
            
            $response->header('X-Cache', 'MISS');
            $response->header('Cache-Control', 'public, max-age=' . $duration);
        }

        return $response;
    }

    /**
     * Generate cache key for the request
     */
    private function generateCacheKey(Request $request): string
    {
        $url = $request->url();
        $queryParams = $request->query();
        
        // Sort query parameters for consistent cache keys
        ksort($queryParams);
        
        $queryString = http_build_query($queryParams);
        
        return 'page_cache:' . md5($url . $queryString);
    }
}