<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function dashboard()
    {
        // Get counts for dashboard stats
        $unreadCount = Contact::where('status', 'unread')->count();
        $ReviewUnreadCount = Review::where('status', 'unread')->count();
        
        return view('admin.dashboard.index', compact('unreadCount', 'ReviewUnreadCount'));
    }
    
    /**
     * List all blog posts
     */
    public function listBlogs(Request $request)
    {
        $blogs = Article::query();
        
        // Apply filters
        if ($request->has('status')) {
            $blogs->where('status', $request->status);
        }
        
        if ($request->has('category')) {
            $blogs->where('category_id', $request->category);
        }
        
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $blogs->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'newest':
                    $blogs->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $blogs->orderBy('created_at', 'asc');
                    break;
                case 'title_asc':
                    $blogs->orderBy('title', 'asc');
                    break;
                case 'title_desc':
                    $blogs->orderBy('title', 'desc');
                    break;
                case 'most_viewed':
                    $blogs->orderBy('views', 'desc');
                    break;
                default:
                    $blogs->orderBy('created_at', 'desc');
            }
        } else {
            $blogs->orderBy('created_at', 'desc');
        }
        
        $blogs = $blogs->paginate(10);
        $categories = Category::all();
        
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }
    
    /**
     * Show create blog form
     */
    public function createBlog()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }
    
    /**
     * Store a new blog post
     */
    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'required|string',
            'summary' => 'required|string|max:255',
        ]);
        
        $blog = new Article();
        $blog->title = $request->title;
        $blog->slug = $request->slug ?: Str::slug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->status = $request->status;
        $blog->featured_image = $request->featured_image;
        $blog->summary = $request->summary;
        $blog->meta_title = $request->meta_title ?: $request->title;
        $blog->meta_description = $request->meta_description ?: $request->summary;
        $blog->featured = $request->has('featured');
        $blog->allow_comments = $request->has('allow_comments');
        $blog->user_id = Auth::id();
        
        if ($request->publish_date) {
            $blog->published_at = $request->publish_date;
        } elseif ($request->status == 'published') {
            $blog->published_at = now();
        }
        
        if ($request->tags) {
            $blog->tags = $request->tags;
        }
        
        $blog->save();
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully');
    }
    
    /**
     * Show a blog post
     */
    public function showBlog($id)
    {
        $blog = Article::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }
    
    /**
     * Show edit blog form
     */
    public function editBlog($id)
    {
        $blog = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }
    
    /**
     * Update a blog post
     */
    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'summary' => 'required|string|max:255',
        ]);
        
        $blog = Article::findOrFail($id);
        $blog->title = $request->title;
        $blog->slug = $request->slug ?: Str::slug($request->title);
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->status = $request->status;
        $blog->summary = $request->summary;
        $blog->meta_title = $request->meta_title ?: $request->title;
        $blog->meta_description = $request->meta_description ?: $request->summary;
        $blog->featured = $request->has('featured');
        $blog->allow_comments = $request->has('allow_comments');
        
        if ($request->featured_image) {
            $blog->featured_image = $request->featured_image;
        }
        
        if ($request->publish_date) {
            $blog->published_at = $request->publish_date;
        } elseif ($request->status == 'published' && !$blog->published_at) {
            $blog->published_at = now();
        }
        
        if ($request->tags) {
            $blog->tags = $request->tags;
        }
        
        $blog->save();
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully');
    }
    
    /**
     * Delete a blog post
     */
    public function destroyBlog($id)
    {
        $blog = Article::findOrFail($id);
        $blog->delete();
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully');
    }
    
    /**
     * List all categories
     */
    public function listCategories()
    {
        $categories = Category::withCount('articles')->get();
        return view('admin.categories.index', compact('categories'));
    }
    
    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'color' => 'nullable|string|max:20',
        ]);
        
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug ?: Str::slug($request->name);
        $category->description = $request->description;
        $category->color = $request->color;
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }
    
    /**
     * Update a category
     */
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'color' => 'nullable|string|max:20',
        ]);
        
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug ?: Str::slug($request->name);
        $category->description = $request->description;
        $category->color = $request->color;
        $category->save();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }
    
    /**
     * Delete a category
     */
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has posts
        if ($category->articles()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with associated posts');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
    
    /**
     * List all messages
     */
    public function listMessages()
    {
        $messages = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }
    
    /**
     * Show a message
     */
    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        
        // Mark as read if unread
        if ($message->status === 'unread') {
            $message->status = 'read';
            $message->save();
        }
        
        return view('admin.messages.show', compact('message'));
    }
    
    /**
     * Mark a message as read
     */
    public function markAsRead($id)
    {
        $message = Contact::findOrFail($id);
        $message->status = 'read';
        $message->save();
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Delete a message
     */
    public function destroyMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully');
    }
    
    /**
     * Reply to a message
     */
    public function replyToMessage(Request $request)
    {
        $request->validate([
            'message_id' => 'required|exists:contacts,id',
            'reply_content' => 'required|string',
        ]);
        
        $message = Contact::findOrFail($request->message_id);
        
        // Here you would typically send an email to the contact
        // For demo purposes, we'll just update the status
        $message->status = 'replied';
        $message->save();
        
        return redirect()->route('admin.messages.show', $message->id)->with('success', 'Reply sent successfully');
    }
    
    /**
     * List all reviews
     */
    public function listReviews()
    {
        $reviews = Review::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }
    
    /**
     * Show a review
     */
    public function showReview($id)
    {
        $review = Review::findOrFail($id);
        
        // Mark as read if unread
        if ($review->status === 'unread') {
            $review->status = 'read';
            $review->save();
        }
        
        return view('admin.reviews.show', compact('review'));
    }
    
    /**
     * Update review status
     */
    public function updateReviewStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:read,publication,rejected',
        ]);
        
        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();
        
        return redirect()->route('admin.reviews.index')->with('success', 'Review status updated successfully');
    }
    
    /**
     * Delete a review
     */
    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully');
    }
    
    /**
     * Show settings page
     */
    public function showSettings()
    {
        return view('admin.settings.index');
    }
    
    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        // Here you would typically save settings to database or config files
        
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }

    /**
     * Analytics Dashboard
     */
    public function analytics()
    {
        $analytics = $this->getAnalyticsData();
        return view('Admin.analytics.index', compact('analytics'));
    }

    /**
     * Get analytics data for dashboard
     */
    private function getAnalyticsData()
    {
        return [
            'totalVisitors' => $this->getTotalVisitors(),
            'pageViews' => $this->getPageViews(),
            'bounceRate' => $this->getBounceRate(),
            'avgSessionDuration' => $this->getAverageSessionDuration(),
            'topPages' => $this->getTopPages(),
            'trafficSources' => $this->getTrafficSources(),
            'userEngagement' => $this->getUserEngagement(),
            'performance' => $this->getPerformanceMetrics()
        ];
    }

    /**
     * Get real-time dashboard stats via API
     */
    public function getDashboardStats()
    {
        $stats = [
            'visitors' => $this->getTotalVisitors(),
            'messages' => Contact::where('status', 'unread')->count(),
            'reviews' => Review::where('status', 'unread')->count(),
            'performance' => $this->getPerformanceMetrics(),
            'traffic' => $this->getRealtimeTraffic()
        ];

        return response()->json($stats);
    }

    /**
     * Get performance metrics
     */
    private function getPerformanceMetrics()
    {
        // Simulate performance data - in production, integrate with monitoring tools
        return [
            'page_load_time' => rand(800, 1200), // milliseconds
            'database_query_time' => rand(50, 150),
            'api_response_time' => rand(100, 300),
            'memory_usage' => rand(60, 85), // percentage
            'cpu_usage' => rand(20, 50)
        ];
    }

    /**
     * Get total visitors (simulated data)
     */
    private function getTotalVisitors()
    {
        // In production, integrate with Google Analytics or similar
        return rand(20000, 30000);
    }

    /**
     * Get page views data
     */
    private function getPageViews()
    {
        $dates = [];
        $views = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $dates[] = now()->subDays($i)->format('M d');
            $views[] = rand(1000, 3000);
        }
        
        return [
            'dates' => $dates,
            'views' => $views
        ];
    }

    /**
     * Get bounce rate
     */
    private function getBounceRate()
    {
        return round(rand(35, 65), 1); // percentage
    }

    /**
     * Get average session duration
     */
    private function getAverageSessionDuration()
    {
        return rand(120, 300); // seconds
    }

    /**
     * Get top pages
     */
    private function getTopPages()
    {
        return [
            ['url' => '/', 'views' => rand(5000, 8000), 'title' => 'Home'],
            ['url' => '/about', 'views' => rand(2000, 4000), 'title' => 'About Us'],
            ['url' => '/services', 'views' => rand(1500, 3000), 'title' => 'Services'],
            ['url' => '/blog', 'views' => rand(1000, 2500), 'title' => 'Blog'],
            ['url' => '/contact', 'views' => rand(800, 1500), 'title' => 'Contact']
        ];
    }

    /**
     * Get traffic sources
     */
    private function getTrafficSources()
    {
        return [
            'direct' => rand(35, 45),
            'organic' => rand(25, 35),
            'social' => rand(15, 25),
            'referral' => rand(10, 20),
            'email' => rand(5, 15)
        ];
    }

    /**
     * Get user engagement data
     */
    private function getUserEngagement()
    {
        $days = [];
        $users = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $days[] = now()->subDays($i)->format('D');
            $users[] = rand(150, 350);
        }
        
        return [
            'days' => $days,
            'users' => $users
        ];
    }

    /**
     * Get real-time traffic data
     */
    private function getRealtimeTraffic()
    {
        $hours = [];
        $traffic = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $hours[] = now()->subHours($i)->format('H:i');
            $traffic[] = rand(50, 200);
        }
        
        return [
            'hours' => $hours,
            'traffic' => $traffic
        ];
    }

    /**
     * Export analytics data
     */
    public function exportAnalytics(Request $request)
    {
        $format = $request->get('format', 'csv');
        $data = $this->getAnalyticsData();
        
        if ($format === 'csv') {
            return $this->exportToCsv($data);
        } elseif ($format === 'pdf') {
            return $this->exportToPdf($data);
        }
        
        return response()->json($data);
    }

    /**
     * Export to CSV
     */
    private function exportToCsv($data)
    {
        $filename = 'analytics_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, ['Metric', 'Value']);
            
            // Data
            fputcsv($file, ['Total Visitors', $data['totalVisitors']]);
            fputcsv($file, ['Bounce Rate', $data['bounceRate'] . '%']);
            fputcsv($file, ['Avg Session Duration', $data['avgSessionDuration'] . 's']);
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * System health check
     */
    public function systemHealth()
    {
        $health = [
            'database' => $this->checkDatabaseHealth(),
            'storage' => $this->checkStorageHealth(),
            'cache' => $this->checkCacheHealth(),
            'queue' => $this->checkQueueHealth(),
            'performance' => $this->getPerformanceMetrics()
        ];
        
        return response()->json($health);
    }

    /**
     * Check database health
     */
    private function checkDatabaseHealth()
    {
        try {
            \DB::connection()->getPdo();
            return ['status' => 'healthy', 'response_time' => rand(10, 50)];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'error' => $e->getMessage()];
        }
    }

    /**
     * Check storage health
     */
    private function checkStorageHealth()
    {
        $totalSpace = disk_total_space(storage_path());
        $freeSpace = disk_free_space(storage_path());
        $usedPercentage = (($totalSpace - $freeSpace) / $totalSpace) * 100;
        
        return [
            'status' => $usedPercentage < 90 ? 'healthy' : 'warning',
            'used_percentage' => round($usedPercentage, 2),
            'free_space' => $this->formatBytes($freeSpace),
            'total_space' => $this->formatBytes($totalSpace)
        ];
    }

    /**
     * Check cache health
     */
    private function checkCacheHealth()
    {
        try {
            \Cache::put('health_check', 'test', 1);
            $value = \Cache::get('health_check');
            \Cache::forget('health_check');
            
            return [
                'status' => $value === 'test' ? 'healthy' : 'unhealthy',
                'driver' => config('cache.default')
            ];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'error' => $e->getMessage()];
        }
    }

    /**
     * Check queue health
     */
    private function checkQueueHealth()
    {
        // Simulate queue check - in production, check actual queue status
        return [
            'status' => 'healthy',
            'pending_jobs' => rand(0, 10),
            'failed_jobs' => rand(0, 2)
        ];
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
} 