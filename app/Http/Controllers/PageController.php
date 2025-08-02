<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Category;
use App\Models\Article;

class PageController extends Controller
{
    // Home page
    public function welcome()
    {
        $reviews = Review::where('status', 'publication')->get();
        return view('welcome', compact('reviews'));
    }

    // About page
    public function about()
    {
        return view('About');
    }

    // Blog listing page
    public function blog(Request $request)
    {
        $query = Article::query();
        
        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('summary', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        $articles = $query->paginate(6);
        $categories = Category::all();

        return view('Blog', compact('articles', 'categories'));
    }

    // Blog details page
    public function blogDetails($id)
    {
        $article = Article::findOrFail($id);
        return view('Blog_details', compact('article'));
    }

    // Contact page
    public function contact()
    {
        return view('Contact');
    }

    // Custom page
    public function custom()
    {
        return view('Custom');
    }

    // Data Security page
    public function dataSecurity()
    {
        return view('Data-Security');
    }

    // Maintenance Policy page
    public function maintenancePolicy()
    {
        return view('Maintenance-Policy');
    }

    // Policy page
    public function policy()
    {
        return view('Policy');
    }

    // Services main page
    public function services()
    {
        return view('Services.Services');
    }

    // Application Service page
    public function serviceApplication()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_Application')
                        ->get();
        return view('Services.service-Application', compact('reviews'));
    }

    // Graphic Design Service page
    public function serviceGraphic()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_Graphic')
                        ->get();
        return view('Services.service-graphic', compact('reviews'));
    }

    // Hosting Service page
    public function serviceHosting()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_Hosting')
                        ->get();
        return view('Services.service-Hosting', compact('reviews'));
    }

    // Marketing Service page
    public function serviceMarketing()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_Marketing')
                        ->get();
        return view('Services.service-Marketing', compact('reviews'));
    }

    // Protection Systems Service page
    public function serviceProtectionSystems()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_protection_systems')
                        ->get();
        return view('Services.service-protection-systems', compact('reviews'));
    }

    // System Service page
    public function serviceSystem()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_system')
                        ->get();
        return view('Services.service-system', compact('reviews'));
    }

    // Web Service page
    public function serviceWeb()
    {
        $reviews = Review::where('status', 'publication')
                        ->where('service_type', 'service_web')
                        ->get();
        return view('Services.service-web', compact('reviews'));
    }

    // Search Results page
    public function searchResults()
    {
        return view('Services.search-results');
    }

    // Add Comment page
    public function addComment(Request $request)
    {
        $service_type = $request->query('service_type', 'general');
        return view('Add-Comment', compact('service_type'));
    }
} 