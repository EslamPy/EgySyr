<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EgySyr Admin</title>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        :root {
            --primary-color: #0047ab;
            --primary-color-light: #2563eb;
            --primary-hover: #0039a6;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --dark-color: #111827;
            --dark-gray: #374151;
            --medium-gray: #6b7280;
            --light-gray: #e5e7eb;
            --lighter-gray: #f3f4f6;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--lighter-gray);
            color: var(--dark-color);
            min-height: 100vh;
            display: flex;
            position: relative;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 260px;
            background: var(--primary-color);
            color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 1.5rem 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand img {
            width: 35px;
            height: auto;
            margin-right: 0.75rem;
        }

        .sidebar-brand span {
            font-size: 1.25rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: white;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-header {
            padding: 0.75rem 1.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.5rem;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }

        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-left: 4px solid var(--secondary-color);
        }

        .sidebar-menu li a i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .sidebar-menu .badge {
            margin-left: auto;
            background: var(--danger-color);
        }

        /* Collapsed sidebar */
        body.sidebar-collapsed .sidebar {
            width: 70px;
        }

        body.sidebar-collapsed .sidebar-brand span,
        body.sidebar-collapsed .sidebar-header,
        body.sidebar-collapsed .sidebar-menu li a span {
            display: none;
        }

        body.sidebar-collapsed .sidebar-menu li a {
            padding: 0.75rem;
            justify-content: center;
        }

        body.sidebar-collapsed .sidebar-menu li a i {
            margin-right: 0;
        }

        body.sidebar-collapsed .content-wrapper {
            margin-left: 70px;
        }

        /* Main Content */
        .content-wrapper {
            flex: 1;
            margin-left: 260px;
            width: calc(100% - 260px);
            transition: all 0.3s;
            position: relative;
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .nav-toggle {
            background: none;
            border: none;
            color: var(--dark-color);
            cursor: pointer;
            font-size: 1.25rem;
        }

        .nav-toggle:focus {
            outline: none;
        }

        .top-navbar-right {
            display: flex;
            align-items: center;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            padding: 0.5rem;
            color: var(--dark-gray);
            font-size: 1.25rem;
            position: relative;
        }

        .nav-item .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.6rem;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-left: 1rem;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0.75rem;
        }

        .user-profile .user-info {
            line-height: 1.2;
        }

        .user-profile .user-name {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-profile .user-role {
            font-size: 0.7rem;
            color: var(--medium-gray);
        }

        /* Page Content */
        .content {
            padding: 1.5rem;
            min-height: calc(100vh - 70px);
        }

        .page-title {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.8rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: var(--white);
            border-bottom: 1px solid var(--light-gray);
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Stats Cards */
        .stats-card {
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-card .card-body {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .stats-info p {
            font-size: 0.9rem;
            color: var(--medium-gray);
            margin: 0;
        }

        .stats-icon {
            background: rgba(37, 99, 235, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stats-card.primary .stats-icon {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
        }

        .stats-card.success .stats-icon {
            background: rgba(16, 185, 129, 0.1);
            color: var(--secondary-color);
        }

        .stats-card.warning .stats-icon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .stats-card.danger .stats-icon {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        /* Tables */
        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th {
            font-weight: 600;
            border-top: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }

        .table .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .table .thumbnail {
            width: 50px;
            height: 30px;
            border-radius: 4px;
            object-fit: cover;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 500;
        }

        .badge-primary {
            background: var(--primary-color);
            color: white;
        }

        .badge-success {
            background: var(--secondary-color);
            color: white;
        }

        .badge-warning {
            background: var(--warning-color);
            color: white;
        }

        .badge-danger {
            background: var(--danger-color);
            color: white;
        }

        .badge-info {
            background: var(--info-color);
            color: white;
        }

        .badge-dark {
            background: var(--dark-color);
            color: white;
        }

        /* Forms */
        .form-control:focus {
            border-color: var(--primary-color-light);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-text {
            color: var(--medium-gray);
            font-size: 0.8rem;
        }

        /* Buttons */
        .btn {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-info {
            background-color: var(--info-color);
            border-color: var(--info-color);
        }

        /* Footer */
        .footer {
            background: white;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--light-gray);
            font-size: 0.8rem;
            color: var(--medium-gray);
        }

        /* Utilities */
        .text-muted {
            color: var(--medium-gray) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-success {
            color: var(--secondary-color) !important;
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        .text-warning {
            color: var(--warning-color) !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .bg-success {
            background-color: var(--secondary-color) !important;
        }

        .bg-danger {
            background-color: var(--danger-color) !important;
        }

        .bg-warning {
            background-color: var(--warning-color) !important;
        }

        .bg-light-primary {
            background-color: rgba(37, 99, 235, 0.1) !important;
        }

        .bg-light-success {
            background-color: rgba(16, 185, 129, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(239, 68, 68, 0.1) !important;
        }

        .bg-light-warning {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                transform: translateX(0);
            }

            .sidebar.expanded {
                width: 260px;
            }

            .sidebar:not(.expanded) .sidebar-brand span,
            .sidebar:not(.expanded) .sidebar-header,
            .sidebar:not(.expanded) .sidebar-menu li a span {
                display: none;
            }

            .sidebar:not(.expanded) .sidebar-menu li a {
                padding: 0.75rem;
                justify-content: center;
            }

            .sidebar:not(.expanded) .sidebar-menu li a i {
                margin-right: 0;
            }

            .content-wrapper {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .content-wrapper.expanded {
                margin-left: 260px;
                width: calc(100% - 260px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-70px);
            }

            .sidebar.expanded {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .content-wrapper.expanded {
                margin-left: 0;
                width: 100%;
            }

            .user-profile .user-info {
                display: none;
            }
        }

        /* Animations */
        .fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--lighter-gray);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--medium-gray);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-gray);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/icon.webp') }}" alt="EgySyr Logo">
            <span>EgySyr Admin</span>
        </div>
        <div class="sidebar-menu">
            <div class="sidebar-header">Main Navigation</div>
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Blog Posts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder"></i>
                        <span>Categories</span>
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-header">Communications</div>
            <ul>
                <li>
                    <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="badge rounded-pill">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                        <i class="fas fa-comments"></i>
                        <span>Reviews</span>
                        @if(isset($ReviewUnreadCount) && $ReviewUnreadCount > 0)
                            <span class="badge rounded-pill">{{ $ReviewUnreadCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
            
            <div class="sidebar-header">Settings</div>
            <ul>
                <li>
                    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Website</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <button class="nav-toggle" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="top-navbar-right">
                <!-- Search -->
                <div class="nav-item me-3 d-none d-md-block">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-primary btn-sm" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Notifications -->
                <div class="nav-item dropdown me-3">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge rounded-pill bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-header">Notifications</div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-envelope fa-fw text-primary"></i>
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold">New Message</div>
                                        <div class="small text-muted">You have a new message from John Doe</div>
                                        <div class="smallest text-muted">5 minutes ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-comment fa-fw text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold">New Review</div>
                                        <div class="small text-muted">Jane Smith left a new review</div>
                                        <div class="smallest text-muted">1 hour ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-center small" href="#">Show all notifications</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Messages -->
                <div class="nav-item dropdown me-3">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-envelope"></i>
                        <span class="badge rounded-pill bg-danger">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-header">Messages</div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <img class="rounded-circle me-2" src="https://via.placeholder.com/40" alt="User Image">
                                    <div>
                                        <div class="fw-bold">John Doe</div>
                                        <div class="small text-muted">Hi, I'm interested in your services...</div>
                                        <div class="smallest text-muted">10 minutes ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <img class="rounded-circle me-2" src="https://via.placeholder.com/40" alt="User Image">
                                    <div>
                                        <div class="fw-bold">Jane Smith</div>
                                        <div class="small text-muted">Thank you for your quick response...</div>
                                        <div class="smallest text-muted">2 hours ago</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-center small" href="#">Read all messages</a>
                        </li>
                    </ul>
                </div>
                
                <!-- User Profile -->
                <div class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-profile">
                            <img src="https://via.placeholder.com/40" alt="User Profile">
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                <div class="user-role">Administrator</div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-fw me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                <i class="fas fa-cog fa-fw me-2"></i> Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="content fadeIn">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div>&copy; {{ date('Y') }} EgySyr. All rights reserved.</div>
            <div>Version 1.0.0</div>
        </footer>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const contentWrapper = document.querySelector('.content-wrapper');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('expanded');
                contentWrapper.classList.toggle('expanded');
            });
            
            // Dismiss alerts automatically
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    @yield('scripts')
</body>
</html> 