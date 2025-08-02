<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr Dashboard - Analytics & Management</title>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/dashboard.js'])
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --success: #10b981;
            --dark: #111827;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: var(--gray-700);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem 0;
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-brand {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .sidebar-brand h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 12px;
        }

        .sidebar-nav {
            padding: 0 1rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 1rem 0.75rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            border-radius: 12px;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            gap: 0.75rem;
        }

        .nav-link:hover {
            background: var(--gray-100);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        /* Header */
        .dashboard-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header-top {
            display: flex;
            justify-content: between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .header-left h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            color: var(--gray-500);
            font-weight: 500;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            position: relative;
        }

        .search-input {
            background: var(--gray-100);
            border: none;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: 12px;
            width: 300px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
        }

        .btn-ghost {
            background: transparent;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        .btn-ghost:hover {
            background: var(--gray-100);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .stat-icon.primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); }
        .stat-icon.success { background: linear-gradient(135deg, var(--success) 0%, #059669 100%); }
        .stat-icon.warning { background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%); }
        .stat-icon.info { background: linear-gradient(135deg, var(--info) 0%, #2563eb 100%); }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Analytics Grid */
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        /* Notifications */
        #notifications {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 10000;
            max-width: 400px;
        }

        .notification {
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideIn 0.3s ease;
        }

        .notification-success {
            border-left-color: var(--success);
        }

        .notification-warning {
            border-left-color: var(--warning);
        }

        .notification-error {
            border-left-color: var(--danger);
        }

        .notification-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: var(--gray-400);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Dark Theme */
        body.dark-theme {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: var(--gray-200);
        }

        body.dark-theme .sidebar,
        body.dark-theme .dashboard-header,
        body.dark-theme .stat-card,
        body.dark-theme .chart-card {
            background: rgba(31, 41, 55, 0.95);
            border-color: rgba(75, 85, 99, 0.2);
        }

        body.dark-theme .search-input {
            background: var(--gray-700);
            color: var(--gray-200);
        }

        body.dark-theme .nav-link:hover {
            background: var(--gray-700);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .header-top {
                flex-direction: column;
                align-items: stretch;
            }

            .search-input {
                width: 100%;
            }
        }
    </style>
</head>
<body class="dashboard-page">
    <div id="notifications"></div>
    
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h2>
                    <img src="{{ asset('images/icon.webp') }}" alt="EgySyr">
                    <span>EgySyr</span>
                </h2>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main</div>
                    <div class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <i class="fas fa-chart-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.analytics') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Analytics</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Content</div>
                    <div class="nav-item">
                        <a href="{{ route('admin.blogs.index') }}" class="nav-link">
                            <i class="fas fa-blog"></i>
                            <span>Blogs</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link">
                            <i class="fas fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Communication</div>
                    <div class="nav-item">
                        <a href="{{ route('admin.messages.index') }}" class="nav-link">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                            @if($unreadCount > 0)
                            <span class="badge">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.reviews.index') }}" class="nav-link">
                            <i class="fas fa-star"></i>
                            <span>Reviews</span>
                            @if($ReviewUnreadCount > 0)
                            <span class="badge">{{ $ReviewUnreadCount }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">System</div>
                    <div class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="dashboard-header">
                <div class="header-top">
                    <div class="header-left">
                        <h1>Dashboard Overview</h1>
                        <p class="header-subtitle">Welcome back! Here's what's happening with your business today.</p>
                    </div>
                    <div class="header-right">
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" id="dashboardSearch" placeholder="Search anything...">
                        </div>
                        <div class="header-actions">
                            <button class="btn btn-ghost" id="themeToggle">
                                <i class="fas fa-moon"></i>
                            </button>
                            <button class="btn btn-ghost" id="sidebarToggle">
                                <i class="fas fa-bars"></i>
                            </button>
                            <a href="{{ route('welcome') }}" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i>
                                View Site
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Stats Cards -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Visitors</div>
                            <div class="stat-value stat-counter" data-suffix="" id="totalVisitors">24,583</div>
                        </div>
                        <div class="stat-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+12.5% from last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Active Messages</div>
                            <div class="stat-value stat-counter" data-suffix="" id="activeMessages">{{ $unreadCount }}</div>
                        </div>
                        <div class="stat-icon success">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+8.2% from yesterday</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Pending Reviews</div>
                            <div class="stat-value stat-counter" data-suffix="" id="pendingReviews">{{ $ReviewUnreadCount }}</div>
                        </div>
                        <div class="stat-icon warning">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        <span>-3.1% from last week</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Page Load Time</div>
                            <div class="stat-value" id="pageLoadTime">Loading...</div>
                        </div>
                        <div class="stat-icon info">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>Performance optimized</span>
                    </div>
                </div>
            </section>

            <!-- Charts Section -->
            <section class="charts-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Website Traffic</h3>
                        <div>
                            <button class="btn btn-ghost">
                                <i class="fas fa-download"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Performance Breakdown</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </section>

            <!-- Analytics Grid -->
            <section class="analytics-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">User Engagement</h3>
                        <select class="btn btn-ghost">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 3 months</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="engagementChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Revenue Trend</h3>
                        <div>
                            <button class="btn btn-ghost">
                                <i class="fas fa-refresh"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <style>
        .badge {
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-weight: 600;
            margin-left: auto;
        }
    </style>
</body>
</html> 