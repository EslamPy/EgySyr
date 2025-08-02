<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    /**
     * Welcome page with optimized queries
     */
    public function welcome()
    {
        $data = Cache::remember('welcome_page_data', 3600, function () {
            return [
                'featured_blogs' => Blog::where('featured', true)
                    ->with(['category', 'user'])
                    ->latest()
                    ->take(3)
                    ->get(),
                'stats' => [
                    'total_projects' => 150,
                    'happy_clients' => 200,
                    'years_experience' => 5,
                    'team_members' => 12
                ],
                'latest_reviews' => Review::where('status', 'approved')
                    ->latest()
                    ->take(5)
                    ->get()
            ];
        });

        return view('welcome', $data);
    }

    /**
     * About page
     */
    public function about()
    {
        $data = Cache::remember('about_page_data', 7200, function () {
            return [
                'team_stats' => [
                    'projects_completed' => 150,
                    'clients_served' => 200,
                    'years_experience' => 5,
                    'technologies_used' => 25
                ]
            ];
        });

        return view('About', $data);
    }

    /**
     * Blog page with pagination and caching
     */
    public function blog(Request $request)
    {
        $page = $request->get('page', 1);
        $category = $request->get('category');
        $search = $request->get('search');
        
        $cacheKey = "blog_list_page_{$page}_cat_{$category}_search_" . md5($search ?? '');
        
        $data = Cache::remember($cacheKey, 1800, function () use ($category, $search) {
            $query = Blog::with(['category', 'user'])
                ->where('status', 'published');

            if ($category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            }

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
                });
            }

            return [
                'blogs' => $query->latest()->paginate(12),
                'categories' => Category::withCount('blogs')->get(),
                'featured_posts' => Blog::where('featured', true)
                    ->with(['category'])
                    ->take(3)
                    ->get()
            ];
        });

        return view('Blog', $data);
    }

    /**
     * Blog details with caching
     */
    public function blogDetails($id)
    {
        $data = Cache::remember("blog_details_{$id}", 3600, function () use ($id) {
            $blog = Blog::with(['category', 'user', 'comments.user'])
                ->findOrFail($id);

            // Increment view count (don't cache this)
            $blog->increment('views');

            return [
                'blog' => $blog,
                'related_posts' => Blog::where('category_id', $blog->category_id)
                    ->where('id', '!=', $id)
                    ->with(['category'])
                    ->take(4)
                    ->get(),
                'recent_posts' => Blog::with(['category'])
                    ->latest()
                    ->take(5)
                    ->get()
            ];
        });

        // Don't cache the view count increment
        $data['blog']->increment('views');

        return view('Blog_details', $data);
    }

    /**
     * Contact page
     */
    public function contact()
    {
        return view('Contact');
    }

    /**
     * Store contact form with validation
     */
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $contact = Contact::create(array_merge($validated, [
            'status' => 'unread',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]));

        // Clear cache for unread messages count
        Cache::forget('unread_messages_count');

        // Send notification email (implement as needed)
        // Mail::to(config('mail.admin_email'))->send(new ContactFormSubmitted($contact));

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    /**
     * Custom page
     */
    public function custom()
    {
        return view('Custom');
    }

    /**
     * Services page
     */
    public function services()
    {
        $data = Cache::remember('services_page_data', 7200, function () {
            return [
                'services' => [
                    [
                        'title' => 'Web Development',
                        'description' => 'Custom web applications built with modern technologies',
                        'icon' => 'fas fa-code',
                        'features' => ['Responsive Design', 'SEO Optimized', 'Fast Loading']
                    ],
                    [
                        'title' => 'Mobile Apps',
                        'description' => 'Native and cross-platform mobile applications',
                        'icon' => 'fas fa-mobile-alt',
                        'features' => ['iOS & Android', 'User-Friendly', 'High Performance']
                    ],
                    [
                        'title' => 'E-commerce',
                        'description' => 'Complete online store solutions',
                        'icon' => 'fas fa-shopping-cart',
                        'features' => ['Payment Integration', 'Inventory Management', 'Analytics']
                    ]
                ]
            ];
        });

        return view('Services.index', $data);
    }

    /**
     * Service application page
     */
    public function serviceApplication()
    {
        return view('Services.application');
    }

    /**
     * Service graphic page
     */
    public function serviceGraphic()
    {
        return view('Services.graphic');
    }

    /**
     * Service hosting page
     */
    public function serviceHosting()
    {
        return view('Services.hosting');
    }

    /**
     * Service marketing page
     */
    public function serviceMarketing()
    {
        return view('Services.marketing');
    }

    /**
     * Service protection systems page
     */
    public function serviceProtectionSystems()
    {
        return view('Services.protection-systems');
    }

    /**
     * Service system page
     */
    public function serviceSystem()
    {
        return view('Services.system');
    }

    /**
     * Service web page
     */
    public function serviceWeb()
    {
        return view('Services.web');
    }

    /**
     * Search articles
     */
    public function searchArticles(Request $request)
    {
        $query = $request->get('q');
        $cacheKey = 'search_articles_' . md5($query);

        $results = Cache::remember($cacheKey, 1800, function () use ($query) {
            return Blog::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%");
                })
                ->with(['category', 'user'])
                ->latest()
                ->take(20)
                ->get();
        });

        return response()->json([
            'results' => $results->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'excerpt' => $blog->excerpt,
                    'url' => route('blog.details', $blog->id),
                    'category' => $blog->category->name ?? 'Uncategorized',
                    'date' => $blog->created_at->format('M d, Y')
                ];
            })
        ]);
    }

    /**
     * Search results page
     */
    public function searchResults(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('blog');
        }

        $data = [
            'query' => $query,
            'blogs' => Blog::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%");
                })
                ->with(['category', 'user'])
                ->latest()
                ->paginate(12)
        ];

        return view('search-results', $data);
    }

    /**
     * Data security policy page
     */
    public function dataSecurity()
    {
        return view('Data-Security');
    }

    /**
     * Maintenance policy page
     */
    public function maintenancePolicy()
    {
        return view('Maintenance-Policy');
    }

    /**
     * Privacy policy page
     */
    public function policy()
    {
        return view('Policy');
    }

    /**
     * Add comment page
     */
    public function addComment()
    {
        return view('Add-Comment');
    }
} 