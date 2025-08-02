<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class ClearOptimizedCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-optimized {--type=all : Type of cache to clear (all, page, data, view)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear optimized application caches selectively';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->option('type');

        $this->info('Clearing optimized caches...');

        switch ($type) {
            case 'page':
                $this->clearPageCache();
                break;
            case 'data':
                $this->clearDataCache();
                break;
            case 'view':
                $this->clearViewCache();
                break;
            case 'all':
            default:
                $this->clearAllCaches();
                break;
        }

        $this->info('✅ Cache clearing completed successfully!');
    }

    /**
     * Clear page-level caches
     */
    private function clearPageCache()
    {
        $this->line('🧹 Clearing page caches...');
        
        // Clear page response caches
        $keys = Cache::getRedis()->keys('*page_cache:*');
        if (!empty($keys)) {
            Cache::getRedis()->del($keys);
            $this->line('  ✓ Page response cache cleared');
        }

        // Clear specific page data caches
        $pageDataKeys = [
            'welcome_page_data',
            'about_page_data',
            'services_page_data',
        ];

        foreach ($pageDataKeys as $key) {
            Cache::forget($key);
        }
        
        $this->line('  ✓ Page data cache cleared');
    }

    /**
     * Clear data-level caches
     */
    private function clearDataCache()
    {
        $this->line('🗃️ Clearing data caches...');
        
        // Clear blog-related caches
        $keys = Cache::getRedis()->keys('*blog_list_*');
        if (!empty($keys)) {
            Cache::getRedis()->del($keys);
        }

        $keys = Cache::getRedis()->keys('*blog_details_*');
        if (!empty($keys)) {
            Cache::getRedis()->del($keys);
        }

        $keys = Cache::getRedis()->keys('*search_articles_*');
        if (!empty($keys)) {
            Cache::getRedis()->del($keys);
        }

        // Clear analytics caches
        Cache::forget('analytics_data');
        Cache::forget('dashboard_stats');
        Cache::forget('unread_messages_count');

        $this->line('  ✓ Data cache cleared');
    }

    /**
     * Clear view-level caches
     */
    private function clearViewCache()
    {
        $this->line('👁️ Clearing view caches...');
        
        Artisan::call('view:clear');
        $this->line('  ✓ Compiled views cleared');
    }

    /**
     * Clear all caches
     */
    private function clearAllCaches()
    {
        $this->clearPageCache();
        $this->clearDataCache();
        $this->clearViewCache();
        
        // Additional Laravel caches
        $this->line('⚡ Clearing Laravel caches...');
        
        Artisan::call('config:clear');
        $this->line('  ✓ Configuration cache cleared');
        
        Artisan::call('route:clear');
        $this->line('  ✓ Route cache cleared');
        
        Cache::flush();
        $this->line('  ✓ Application cache cleared');
    }
}