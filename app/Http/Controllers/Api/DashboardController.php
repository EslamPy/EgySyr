<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function stats()
    {
        try {
            $stats = [
                'total_blogs' => Blog::count(),
                'total_categories' => Category::count(),
                'total_messages' => Contact::count(),
                'total_reviews' => Review::count(),
                'unread_messages' => Contact::where('status', 'unread')->count(),
                'unread_reviews' => Review::where('status', 'unread')->count(),
                'published_blogs' => Blog::where('status', 'published')->count(),
                'draft_blogs' => Blog::where('status', 'draft')->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching stats: ' . $e->getMessage()
            ], 500);
        }
    }

    public function recentActivity()
    {
        try {
            $recentBlogs = Blog::latest()->take(5)->get(['id', 'title', 'created_at', 'status']);
            $recentMessages = Contact::latest()->take(5)->get(['id', 'name', 'email', 'message', 'created_at', 'status']);
            $recentReviews = Review::latest()->take(5)->get(['id', 'name', 'comment', 'rating', 'created_at', 'status']);

            return response()->json([
                'success' => true,
                'data' => [
                    'blogs' => $recentBlogs,
                    'messages' => $recentMessages,
                    'reviews' => $recentReviews
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching recent activity: ' . $e->getMessage()
            ], 500);
        }
    }

    public function chartData()
    {
        try {
            // Monthly blog posts
            $blogStats = Blog::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Monthly messages
            $messageStats = Contact::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Category distribution
            $categoryStats = Category::withCount('blogs')->get(['id', 'name', 'blogs_count']);

            return response()->json([
                'success' => true,
                'data' => [
                    'blog_stats' => $blogStats,
                    'message_stats' => $messageStats,
                    'category_stats' => $categoryStats
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching chart data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function notifications()
    {
        try {
            $notifications = [];

            // Unread messages
            $unreadMessages = Contact::where('status', 'unread')->count();
            if ($unreadMessages > 0) {
                $notifications[] = [
                    'type' => 'message',
                    'count' => $unreadMessages,
                    'message' => "You have {$unreadMessages} unread message(s)"
                ];
            }

            // Unread reviews
            $unreadReviews = Review::where('status', 'unread')->count();
            if ($unreadReviews > 0) {
                $notifications[] = [
                    'type' => 'review',
                    'count' => $unreadReviews,
                    'message' => "You have {$unreadReviews} unread review(s)"
                ];
            }

            // Draft blogs
            $draftBlogs = Blog::where('status', 'draft')->count();
            if ($draftBlogs > 0) {
                $notifications[] = [
                    'type' => 'blog',
                    'count' => $draftBlogs,
                    'message' => "You have {$draftBlogs} draft blog(s)"
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $notifications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching notifications: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:message,review',
                'id' => 'required|integer'
            ]);

            if ($request->type === 'message') {
                $item = Contact::findOrFail($request->id);
            } else {
                $item = Review::findOrFail($request->id);
            }

            $item->update(['status' => 'read']);

            return response()->json([
                'success' => true,
                'message' => 'Marked as read successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error marking as read: ' . $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->get('q');
            
            if (empty($query)) {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }

            $results = [];

            // Search blogs
            $blogs = Blog::where('title', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%")
                ->take(5)
                ->get(['id', 'title', 'created_at']);

            foreach ($blogs as $blog) {
                $results[] = [
                    'type' => 'blog',
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'date' => $blog->created_at->format('M d, Y'),
                    'url' => route('admin.blogs.show', $blog->id)
                ];
            }

            // Search messages
            $messages = Contact::where('name', 'LIKE', "%{$query}%")
                ->orWhere('message', 'LIKE', "%{$query}%")
                ->take(5)
                ->get(['id', 'name', 'message', 'created_at']);

            foreach ($messages as $message) {
                $results[] = [
                    'type' => 'message',
                    'id' => $message->id,
                    'title' => $message->name,
                    'content' => Str::limit($message->message, 50),
                    'date' => $message->created_at->format('M d, Y'),
                    'url' => route('admin.messages.show', $message->id)
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching: ' . $e->getMessage()
            ], 500);
        }
    }
}