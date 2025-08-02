<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EgySyr</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .dashboard-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #1B0015 0%, #2D1B3D 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .chart-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar-gradient w-64 flex-shrink-0 hidden md:block">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <img src="{{ asset('images/icon.webp') }}" alt="Logo" class="w-8 h-8">
                    <h1 class="text-xl font-bold text-white">EgySyr Admin</h1>
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-white/10 text-white hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.blogs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span>Blogs</span>
                    </a>
                    
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>Messages</span>
                        @if($unreadCount > 0)
                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.reviews.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <span>Reviews</span>
                        @if($ReviewUnreadCount > 0)
                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $ReviewUnreadCount }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/5 backdrop-blur-lg border-b border-white/10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="md:hidden text-white" id="mobile-menu-button">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold">Dashboard</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-white hover:text-gray-300 transition-colors">
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'Admin' }}&background=6366f1&color=fff" alt="Avatar" class="w-8 h-8 rounded-full">
                                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Messages</p>
                                <p class="text-3xl font-bold text-white">{{ $unreadCount }}</p>
                                <p class="text-green-400 text-sm">+12% from last month</p>
                            </div>
                            <div class="p-3 bg-blue-500/20 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Reviews</p>
                                <p class="text-3xl font-bold text-white">{{ $ReviewUnreadCount }}</p>
                                <p class="text-green-400 text-sm">+8% from last month</p>
                            </div>
                            <div class="p-3 bg-green-500/20 rounded-lg">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Blogs</p>
                                <p class="text-3xl font-bold text-white">{{ \App\Models\Blog::count() }}</p>
                                <p class="text-green-400 text-sm">+5% from last month</p>
                            </div>
                            <div class="p-3 bg-purple-500/20 rounded-lg">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="stat-card rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Categories</p>
                                <p class="text-3xl font-bold text-white">{{ \App\Models\Category::count() }}</p>
                                <p class="text-green-400 text-sm">+3% from last month</p>
                            </div>
                            <div class="p-3 bg-orange-500/20 rounded-lg">
                                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts and Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Messages -->
                    <div class="chart-container rounded-xl p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Messages</h3>
                        <div class="space-y-4">
                            @foreach(\App\Models\Contact::latest()->take(5)->get() as $message)
                            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">{{ Str::limit($message->name, 20) }}</p>
                                    <p class="text-xs text-gray-400">{{ Str::limit($message->message, 50) }}</p>
                                </div>
                                <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Recent Reviews -->
                    <div class="chart-container rounded-xl p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Reviews</h3>
                        <div class="space-y-4">
                            @foreach(\App\Models\Review::latest()->take(5)->get() as $review)
                            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">{{ Str::limit($review->name, 20) }}</p>
                                    <p class="text-xs text-gray-400">{{ Str::limit($review->comment, 50) }}</p>
                                </div>
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50"></div>
        <div class="fixed left-0 top-0 h-full w-64 bg-gray-900 p-6">
            <!-- Mobile menu content -->
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking outside
        document.getElementById('mobile-menu').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</body>
</html> 