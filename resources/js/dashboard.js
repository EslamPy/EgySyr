// Modern Dashboard JavaScript for EgySyr

class Dashboard {
    constructor() {
        this.init();
        this.setupEventListeners();
        this.loadInitialData();
    }

    init() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.statsContainer = document.getElementById('stats-container');
        this.recentActivityContainer = document.getElementById('recent-activity-container');
        this.notificationsContainer = document.getElementById('notifications-container');
        this.searchInput = document.getElementById('search-input');
        this.searchResults = document.getElementById('search-results');
    }

    setupEventListeners() {
        // Search functionality
        if (this.searchInput) {
            this.searchInput.addEventListener('input', this.debounce(this.handleSearch.bind(this), 300));
        }

        // Notification clicks
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('notification-item')) {
                this.markAsRead(e.target.dataset.type, e.target.dataset.id);
            }
        });

        // Real-time updates (every 30 seconds)
        setInterval(() => {
            this.loadStats();
            this.loadNotifications();
        }, 30000);
    }

    async loadInitialData() {
        await Promise.all([
            this.loadStats(),
            this.loadRecentActivity(),
            this.loadNotifications()
        ]);
    }

    async loadStats() {
        try {
            const response = await fetch('/api/dashboard/stats', {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (data.success) {
                this.updateStatsDisplay(data.data);
            }
        } catch (error) {
            console.error('Error loading stats:', error);
        }
    }

    async loadRecentActivity() {
        try {
            const response = await fetch('/api/dashboard/recent-activity', {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (data.success) {
                this.updateRecentActivityDisplay(data.data);
            }
        } catch (error) {
            console.error('Error loading recent activity:', error);
        }
    }

    async loadNotifications() {
        try {
            const response = await fetch('/api/dashboard/notifications', {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (data.success) {
                this.updateNotificationsDisplay(data.data);
            }
        } catch (error) {
            console.error('Error loading notifications:', error);
        }
    }

    updateStatsDisplay(stats) {
        if (!this.statsContainer) return;

        const statsHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card rounded-xl p-6 card-hover">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-sm font-medium">Total Messages</p>
                            <p class="text-3xl font-bold text-white">${stats.total_messages}</p>
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
                            <p class="text-3xl font-bold text-white">${stats.total_reviews}</p>
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
                            <p class="text-3xl font-bold text-white">${stats.total_blogs}</p>
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
                            <p class="text-3xl font-bold text-white">${stats.total_categories}</p>
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
        `;

        this.statsContainer.innerHTML = statsHTML;
    }

    updateRecentActivityDisplay(data) {
        if (!this.recentActivityContainer) return;

        const messagesHTML = data.messages.map(message => `
            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium">${this.escapeHtml(message.name)}</p>
                    <p class="text-xs text-gray-400">${this.escapeHtml(message.message.substring(0, 50))}...</p>
                </div>
                <span class="text-xs text-gray-500">${this.formatDate(message.created_at)}</span>
            </div>
        `).join('');

        const reviewsHTML = data.reviews.map(review => `
            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                <div class="flex-1">
                    <p class="text-sm font-medium">${this.escapeHtml(review.name)}</p>
                    <p class="text-xs text-gray-400">${this.escapeHtml(review.comment.substring(0, 50))}...</p>
                </div>
                <div class="flex items-center space-x-1">
                    ${this.generateStarRating(review.rating)}
                </div>
            </div>
        `).join('');

        this.recentActivityContainer.innerHTML = `
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="chart-container rounded-xl p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Messages</h3>
                    <div class="space-y-4">
                        ${messagesHTML}
                    </div>
                </div>
                
                <div class="chart-container rounded-xl p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Reviews</h3>
                    <div class="space-y-4">
                        ${reviewsHTML}
                    </div>
                </div>
            </div>
        `;
    }

    updateNotificationsDisplay(notifications) {
        if (!this.notificationsContainer) return;

        if (notifications.length === 0) {
            this.notificationsContainer.innerHTML = '<p class="text-gray-400 text-center">No new notifications</p>';
            return;
        }

        const notificationsHTML = notifications.map(notification => `
            <div class="notification-item p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                 data-type="${notification.type}" 
                 data-id="${notification.id}">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-red-400 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">${this.escapeHtml(notification.message)}</p>
                        <p class="text-xs text-gray-400">Click to mark as read</p>
                    </div>
                </div>
            </div>
        `).join('');

        this.notificationsContainer.innerHTML = notificationsHTML;
    }

    async handleSearch(event) {
        const query = event.target.value.trim();
        
        if (query.length < 2) {
            this.hideSearchResults();
            return;
        }

        try {
            const response = await fetch(`/api/dashboard/search?q=${encodeURIComponent(query)}`, {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (data.success) {
                this.showSearchResults(data.data);
            }
        } catch (error) {
            console.error('Error searching:', error);
        }
    }

    showSearchResults(results) {
        if (!this.searchResults) return;

        if (results.length === 0) {
            this.searchResults.innerHTML = '<p class="text-gray-400 text-center p-4">No results found</p>';
            this.searchResults.classList.remove('hidden');
            return;
        }

        const resultsHTML = results.map(result => `
            <a href="${result.url}" class="block p-3 hover:bg-white/5 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gray-500/20 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">${this.escapeHtml(result.title)}</p>
                        <p class="text-xs text-gray-400">${result.date}</p>
                    </div>
                </div>
            </a>
        `).join('');

        this.searchResults.innerHTML = resultsHTML;
        this.searchResults.classList.remove('hidden');
    }

    hideSearchResults() {
        if (this.searchResults) {
            this.searchResults.classList.add('hidden');
        }
    }

    async markAsRead(type, id) {
        try {
            const response = await fetch('/api/dashboard/mark-as-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ type, id })
            });
            const data = await response.json();

            if (data.success) {
                // Reload notifications
                this.loadNotifications();
                
                // Show success message
                this.showNotification('Marked as read successfully', 'success');
            }
        } catch (error) {
            console.error('Error marking as read:', error);
            this.showNotification('Error marking as read', 'error');
        }
    }

    generateStarRating(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            const color = i <= rating ? 'text-yellow-400' : 'text-gray-600';
            stars += `<svg class="w-3 h-3 ${color}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>`;
        }
        return stars;
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffTime = Math.abs(now - date);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays === 1) return 'Today';
        if (diffDays === 2) return 'Yesterday';
        if (diffDays <= 7) return `${diffDays - 1} days ago`;
        
        return date.toLocaleDateString('en-US', { 
            month: 'short', 
            day: 'numeric' 
        });
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        } text-white`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new Dashboard();
});

// Export for use in other modules
window.Dashboard = Dashboard;