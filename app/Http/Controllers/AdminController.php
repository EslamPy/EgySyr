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
} 