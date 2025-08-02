@extends('admin.layout')

@section('title', 'Dashboard')

@section('styles')
<style>
    .chart-container {
        position: relative;
        height: 300px;
    }
    .activity-timeline {
        position: relative;
        padding-left: 3rem;
    }
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 0;
        height: 100%;
        width: 2px;
        background-color: var(--light-gray);
    }
    .activity-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    .activity-item:last-child {
        padding-bottom: 0;
    }
    .activity-icon {
        position: absolute;
        left: -2.25rem;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    .activity-content {
        background-color: var(--white);
        border-radius: 0.5rem;
        padding: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    .activity-time {
        font-size: 0.75rem;
        color: var(--medium-gray);
    }
    .todo-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .todo-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-gray);
    }
    .todo-item:last-child {
        border-bottom: none;
    }
    .todo-checkbox {
        margin-right: 0.75rem;
    }
    .todo-text {
        flex: 1;
    }
    .todo-completed {
        text-decoration: line-through;
        color: var(--medium-gray);
    }
    .recent-item {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-gray);
    }
    .recent-item:last-child {
        border-bottom: none;
    }
    .recent-image {
        width: 60px;
        height: 40px;
        border-radius: 0.25rem;
        object-fit: cover;
        margin-right: 1rem;
    }
    .recent-content {
        flex: 1;
        min-width: 0;
    }
    .recent-title {
        margin: 0;
        font-size: 0.9rem;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .recent-meta {
        display: flex;
        font-size: 0.75rem;
        color: var(--medium-gray);
    }
    .recent-meta > div {
        margin-right: 1rem;
    }
    .recent-meta i {
        margin-right: 0.25rem;
    }
</style>
@endsection

@section('content')
<!-- Page Title -->
<div class="page-title">
    <h1>Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card primary h-100">
            <div class="card-body">
                <div class="stats-info">
                    <p>Total Visitors</p>
                    <h3>{{ number_format(rand(10000, 50000)) }}</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +5.27%
                    </small>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card success h-100">
            <div class="card-body">
                <div class="stats-info">
                    <p>Blog Posts</p>
                    <h3>{{ rand(50, 150) }}</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +2.8%
                    </small>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card warning h-100">
            <div class="card-body">
                <div class="stats-info">
                    <p>New Messages</p>
                    <h3>{{ isset($unreadCount) ? $unreadCount : rand(5, 20) }}</h3>
                    <small class="text-danger">
                        <i class="fas fa-arrow-up"></i> +12.5%
                    </small>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card danger h-100">
            <div class="card-body">
                <div class="stats-info">
                    <p>Revenue</p>
                    <h3>${{ number_format(rand(10000, 100000)) }}</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +8.3%
                    </small>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Traffic Chart -->
    <div class="col-xl-8 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Traffic Overview</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Last 7 Days
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Traffic Sources -->
    <div class="col-xl-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Traffic Sources</h5>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="sourceChart"></canvas>
                </div>
                <div class="text-center mt-3">
                    <div class="d-inline-block me-3">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </div>
                    <div class="d-inline-block me-3">
                        <i class="fas fa-circle text-success"></i> Social
                    </div>
                    <div class="d-inline-block me-3">
                        <i class="fas fa-circle text-warning"></i> Referral
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-circle text-danger"></i> Search
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Blog Posts -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Recent Blog Posts</h5>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @for ($i = 0; $i < 5; $i++)
                    <div class="recent-item">
                        <img src="https://via.placeholder.com/60x40" class="recent-image" alt="Blog Image">
                        <div class="recent-content">
                            <h6 class="recent-title">How to optimize your website for better SEO</h6>
                            <div class="recent-meta">
                                <div>
                                    <i class="far fa-calendar"></i> {{ date('M d, Y', strtotime("-$i days")) }}
                                </div>
                                <div>
                                    <i class="far fa-eye"></i> {{ rand(50, 500) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    
    <!-- Todo List -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Todo List</h5>
                <button class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="card-body">
                <ul class="todo-list">
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo1">
                        <label class="form-check-label todo-text" for="todo1">Review new blog posts</label>
                    </li>
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo2">
                        <label class="form-check-label todo-text" for="todo2">Update homepage banner</label>
                    </li>
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo3" checked>
                        <label class="form-check-label todo-text todo-completed" for="todo3">Respond to client emails</label>
                    </li>
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo4">
                        <label class="form-check-label todo-text" for="todo4">Prepare monthly report</label>
                    </li>
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo5">
                        <label class="form-check-label todo-text" for="todo5">Plan content calendar for next month</label>
                    </li>
                    <li class="todo-item">
                        <input type="checkbox" class="form-check-input todo-checkbox" id="todo6" checked>
                        <label class="form-check-label todo-text todo-completed" for="todo6">Update website plugins</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="col-xl-4 col-md-12 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5>Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="activity-timeline">
                    <div class="activity-item">
                        <div class="activity-icon bg-primary">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">New blog post published</p>
                            <div class="activity-time">5 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-success">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">New user registered</p>
                            <div class="activity-time">1 hour ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-warning">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">New message from client</p>
                            <div class="activity-time">3 hours ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-info">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">System settings updated</p>
                            <div class="activity-time">Yesterday</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-danger">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">Unused files cleaned up</p>
                            <div class="activity-time">2 days ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Traffic Overview Chart
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(trafficCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Visits',
                data: [1250, 1400, 1800, 1700, 2100, 1900, 2200],
                borderColor: '#0047ab',
                backgroundColor: 'rgba(0, 71, 171, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });
    
    // Traffic Sources Chart
    const sourceCtx = document.getElementById('sourceChart').getContext('2d');
    const sourceChart = new Chart(sourceCtx, {
        type: 'doughnut',
        data: {
            labels: ['Direct', 'Social', 'Referral', 'Search'],
            datasets: [{
                data: [35, 25, 20, 20],
                backgroundColor: ['#0047ab', '#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            cutout: '70%'
        }
    });
    
    // Todo list functionality
    document.querySelectorAll('.todo-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.classList.add('todo-completed');
            } else {
                label.classList.remove('todo-completed');
            }
        });
    });
</script>
@endsection 