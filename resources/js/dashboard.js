import './bootstrap';

// Dashboard-specific modules
class Dashboard {
    constructor() {
        this.charts = {};
        this.realTimeData = null;
        this.websocket = null;
        this.init();
    }

    async init() {
        await this.loadDependencies();
        this.initializeCharts();
        this.setupRealTimeUpdates();
        this.initializeInteractiveElements();
        this.setupPerformanceMonitoring();
    }

    async loadDependencies() {
        // Dynamically import Chart.js only when dashboard is loaded
        const { Chart, registerables } = await import('chart.js');
        Chart.register(...registerables);
        window.Chart = Chart;
    }

    initializeCharts() {
        this.createTrafficChart();
        this.createPerformanceChart();
        this.createUserEngagementChart();
        this.createRevenueChart();
    }

    createTrafficChart() {
        const ctx = document.getElementById('trafficChart');
        if (!ctx) return;

        this.charts.traffic = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Website Traffic',
                    data: [12000, 19000, 15000, 25000, 22000, 30000],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4,
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
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    createPerformanceChart() {
        const ctx = document.getElementById('performanceChart');
        if (!ctx) return;

        this.charts.performance = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Page Load', 'Database', 'API Calls', 'Rendering'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#ffce56',
                        '#4bc0c0'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    createUserEngagementChart() {
        const ctx = document.getElementById('engagementChart');
        if (!ctx) return;

        this.charts.engagement = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Active Users',
                    data: [150, 220, 180, 270, 320, 200, 180],
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 4
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
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    createRevenueChart() {
        const ctx = document.getElementById('revenueChart');
        if (!ctx) return;

        this.charts.revenue = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Revenue',
                    data: [5000, 8000, 6500, 12000],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
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
                            color: 'rgba(0,0,0,0.1)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    setupRealTimeUpdates() {
        // Simulate real-time data updates
        setInterval(() => {
            this.updateRealTimeStats();
        }, 5000);

        // Setup WebSocket connection for real-time updates
        this.initWebSocket();
    }

    initWebSocket() {
        try {
            // Only connect if WebSocket is available
            if (window.Echo) {
                window.Echo.channel('dashboard-updates')
                    .listen('StatsUpdated', (e) => {
                        this.handleRealTimeUpdate(e);
                    });
            }
        } catch (error) {
            console.log('WebSocket not available, using polling instead');
        }
    }

    updateRealTimeStats() {
        // Update counters with animation
        const counters = document.querySelectorAll('.stat-counter');
        counters.forEach(counter => {
            const currentValue = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            const increase = Math.floor(Math.random() * 10) + 1;
            this.animateCounter(counter, currentValue, currentValue + increase);
        });

        // Update chart data
        this.updateChartsData();
    }

    animateCounter(element, start, end) {
        const duration = 1000;
        const increment = (end - start) / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= end) {
                current = end;
                clearInterval(timer);
            }
            
            const prefix = element.dataset.prefix || '';
            const suffix = element.dataset.suffix || '';
            element.textContent = prefix + Math.floor(current).toLocaleString() + suffix;
        }, 16);
    }

    updateChartsData() {
        // Update traffic chart with new data point
        if (this.charts.traffic) {
            const data = this.charts.traffic.data;
            const newValue = Math.floor(Math.random() * 5000) + 25000;
            
            data.labels.push(this.getCurrentTimeLabel());
            data.datasets[0].data.push(newValue);
            
            // Keep only last 10 data points
            if (data.labels.length > 10) {
                data.labels.shift();
                data.datasets[0].data.shift();
            }
            
            this.charts.traffic.update('none');
        }
    }

    getCurrentTimeLabel() {
        const now = new Date();
        return now.getHours() + ':' + now.getMinutes().toString().padStart(2, '0');
    }

    initializeInteractiveElements() {
        // Theme switcher
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                this.toggleTheme();
            });
        }

        // Notification system
        this.initNotifications();

        // Search functionality
        this.initSearch();

        // Sidebar toggle
        this.initSidebarToggle();
    }

    toggleTheme() {
        const body = document.body;
        const isDark = body.classList.contains('dark-theme');
        
        if (isDark) {
            body.classList.remove('dark-theme');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        }

        // Update charts for new theme
        this.updateChartsTheme();
    }

    updateChartsTheme() {
        const isDark = document.body.classList.contains('dark-theme');
        const textColor = isDark ? '#fff' : '#374151';
        const gridColor = isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)';

        Object.values(this.charts).forEach(chart => {
            if (chart.options.scales) {
                if (chart.options.scales.x) {
                    chart.options.scales.x.ticks = { color: textColor };
                    chart.options.scales.x.grid = { color: gridColor };
                }
                if (chart.options.scales.y) {
                    chart.options.scales.y.ticks = { color: textColor };
                    chart.options.scales.y.grid = { color: gridColor };
                }
            }
            chart.update();
        });
    }

    initNotifications() {
        // Show welcome notification
        setTimeout(() => {
            this.showNotification('Welcome to your dashboard!', 'success');
        }, 1000);
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;

        const container = document.getElementById('notifications') || document.body;
        container.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);

        // Manual close
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.remove();
        });
    }

    initSearch() {
        const searchInput = document.getElementById('dashboardSearch');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                this.performSearch(e.target.value);
            });
        }
    }

    performSearch(query) {
        // Implement search functionality
        const searchableElements = document.querySelectorAll('[data-searchable]');
        searchableElements.forEach(element => {
            const text = element.textContent.toLowerCase();
            const isVisible = text.includes(query.toLowerCase());
            element.style.display = isVisible ? '' : 'none';
        });
    }

    initSidebarToggle() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');
            });
        }
    }

    setupPerformanceMonitoring() {
        // Monitor page performance
        if ('performance' in window) {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    const loadTime = perfData.loadEventEnd - perfData.loadEventStart;
                    
                    // Update performance metrics in dashboard
                    const loadTimeElement = document.getElementById('pageLoadTime');
                    if (loadTimeElement) {
                        loadTimeElement.textContent = Math.round(loadTime) + 'ms';
                    }
                }, 100);
            });
        }
    }

    handleRealTimeUpdate(data) {
        // Handle real-time updates from server
        if (data.type === 'stats') {
            this.updateStatsCards(data.stats);
        } else if (data.type === 'notification') {
            this.showNotification(data.message, data.level);
        }
    }

    updateStatsCards(stats) {
        Object.keys(stats).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                this.animateCounter(element, 
                    parseInt(element.textContent.replace(/[^\d]/g, '')), 
                    stats[key]
                );
            }
        });
    }
}

// Initialize dashboard when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.body.classList.contains('dashboard-page')) {
        new Dashboard();
    }
});

// Apply saved theme on load
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
    }
});

export default Dashboard;