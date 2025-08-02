// Service Worker for EgySyr Website
// Version 1.0.0

const CACHE_NAME = 'egysyr-v1';
const STATIC_CACHE_NAME = 'egysyr-static-v1';
const DYNAMIC_CACHE_NAME = 'egysyr-dynamic-v1';

// Assets to cache immediately
const STATIC_ASSETS = [
    '/',
    '/css/app.css',
    '/js/app.js',
    '/images/logo.webp',
    '/images/icon.webp',
    // Add other critical assets
];

// Assets to cache dynamically
const DYNAMIC_ASSETS_PATTERNS = [
    /\.(css|js)$/,
    /\.(png|jpg|jpeg|webp|svg|gif)$/,
    /\.(woff|woff2|ttf|eot)$/,
];

// Network-first strategies for these patterns
const NETWORK_FIRST_PATTERNS = [
    /\/api\//,
    /\/admin\//,
    /\/contact$/,
];

// Cache-first strategies for these patterns
const CACHE_FIRST_PATTERNS = [
    /\.(css|js)$/,
    /\.(png|jpg|jpeg|webp|svg|gif|ico)$/,
    /\.(woff|woff2|ttf|eot)$/,
];

// Install event - cache static assets
self.addEventListener('install', event => {
    console.log('Service Worker installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE_NAME)
            .then(cache => {
                console.log('Caching static assets...');
                return cache.addAll(STATIC_ASSETS);
            })
            .then(() => {
                console.log('Static assets cached successfully');
                return self.skipWaiting();
            })
            .catch(error => {
                console.error('Error caching static assets:', error);
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
    console.log('Service Worker activating...');
    
    event.waitUntil(
        caches.keys()
            .then(cacheNames => {
                return Promise.all(
                    cacheNames.map(cacheName => {
                        // Delete old caches
                        if (cacheName !== STATIC_CACHE_NAME && 
                            cacheName !== DYNAMIC_CACHE_NAME &&
                            cacheName.startsWith('egysyr-')) {
                            console.log('Deleting old cache:', cacheName);
                            return caches.delete(cacheName);
                        }
                    })
                );
            })
            .then(() => {
                console.log('Service Worker activated');
                return self.clients.claim();
            })
    );
});

// Fetch event - handle requests with different strategies
self.addEventListener('fetch', event => {
    const request = event.request;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }
    
    // Skip chrome-extension and other protocols
    if (!url.protocol.startsWith('http')) {
        return;
    }
    
    event.respondWith(handleRequest(request));
});

// Main request handler
async function handleRequest(request) {
    const url = new URL(request.url);
    
    try {
        // Network-first strategy for API calls and dynamic content
        if (NETWORK_FIRST_PATTERNS.some(pattern => pattern.test(url.pathname))) {
            return await networkFirst(request);
        }
        
        // Cache-first strategy for static assets
        if (CACHE_FIRST_PATTERNS.some(pattern => pattern.test(url.pathname))) {
            return await cacheFirst(request);
        }
        
        // Stale-while-revalidate for HTML pages
        if (request.headers.get('accept')?.includes('text/html')) {
            return await staleWhileRevalidate(request);
        }
        
        // Default to network first
        return await networkFirst(request);
        
    } catch (error) {
        console.error('Error handling request:', error);
        return await handleOffline(request);
    }
}

// Network-first strategy
async function networkFirst(request) {
    try {
        const networkResponse = await fetch(request);
        
        // Cache successful responses
        if (networkResponse.ok) {
            const cache = await caches.open(DYNAMIC_CACHE_NAME);
            cache.put(request, networkResponse.clone());
        }
        
        return networkResponse;
    } catch (error) {
        // Fall back to cache
        const cachedResponse = await caches.match(request);
        if (cachedResponse) {
            return cachedResponse;
        }
        throw error;
    }
}

// Cache-first strategy
async function cacheFirst(request) {
    const cachedResponse = await caches.match(request);
    
    if (cachedResponse) {
        return cachedResponse;
    }
    
    try {
        const networkResponse = await fetch(request);
        
        if (networkResponse.ok) {
            const cache = await caches.open(DYNAMIC_CACHE_NAME);
            cache.put(request, networkResponse.clone());
        }
        
        return networkResponse;
    } catch (error) {
        throw error;
    }
}

// Stale-while-revalidate strategy
async function staleWhileRevalidate(request) {
    const cachedResponse = await caches.match(request);
    
    // Fetch from network in background
    const networkPromise = fetch(request)
        .then(response => {
            if (response.ok) {
                const cache = caches.open(DYNAMIC_CACHE_NAME);
                cache.then(c => c.put(request, response.clone()));
            }
            return response;
        })
        .catch(() => {
            // Network failed, but we might have cache
        });
    
    // Return cached version immediately if available
    if (cachedResponse) {
        return cachedResponse;
    }
    
    // Otherwise wait for network
    return networkPromise;
}

// Handle offline scenarios
async function handleOffline(request) {
    const url = new URL(request.url);
    
    // Try to serve from cache first
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
        return cachedResponse;
    }
    
    // For HTML requests, show offline page
    if (request.headers.get('accept')?.includes('text/html')) {
        const offlineResponse = await caches.match('/');
        if (offlineResponse) {
            return offlineResponse;
        }
    }
    
    // For images, return a placeholder
    if (request.headers.get('accept')?.includes('image')) {
        return new Response(
            '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200"><rect width="200" height="200" fill="#f3f4f6"/><text x="100" y="100" text-anchor="middle" dy=".3em" fill="#9ca3af">Image Unavailable</text></svg>',
            {
                headers: {
                    'Content-Type': 'image/svg+xml',
                    'Cache-Control': 'no-cache'
                }
            }
        );
    }
    
    // Default offline response
    return new Response('Offline', {
        status: 503,
        statusText: 'Service Unavailable',
        headers: {
            'Content-Type': 'text/plain'
        }
    });
}

// Background sync for form submissions
self.addEventListener('sync', event => {
    if (event.tag === 'contact-form') {
        event.waitUntil(syncContactForm());
    }
});

// Sync contact form submissions when back online
async function syncContactForm() {
    try {
        // Implement background sync logic for contact forms
        console.log('Syncing contact form submissions...');
        
        // Get pending submissions from IndexedDB
        // Send them to server
        // Clear from IndexedDB on success
        
    } catch (error) {
        console.error('Error syncing contact form:', error);
    }
}

// Push notification handling
self.addEventListener('push', event => {
    if (!event.data) return;
    
    const data = event.data.json();
    const options = {
        body: data.body,
        icon: '/images/icon.webp',
        badge: '/images/icon.webp',
        vibrate: [200, 100, 200],
        data: data.data || {},
        actions: data.actions || []
    };
    
    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

// Notification click handling
self.addEventListener('notificationclick', event => {
    event.notification.close();
    
    const urlToOpen = event.notification.data.url || '/';
    
    event.waitUntil(
        clients.matchAll({ type: 'window' })
            .then(clientList => {
                // Check if window is already open
                for (const client of clientList) {
                    if (client.url === urlToOpen && 'focus' in client) {
                        return client.focus();
                    }
                }
                
                // Open new window
                if (clients.openWindow) {
                    return clients.openWindow(urlToOpen);
                }
            })
    );
});

// Cache management - clean up old entries
async function cleanupCache() {
    const cache = await caches.open(DYNAMIC_CACHE_NAME);
    const requests = await cache.keys();
    
    // Remove old entries (keep only last 50)
    if (requests.length > 50) {
        const oldRequests = requests.slice(0, requests.length - 50);
        await Promise.all(
            oldRequests.map(request => cache.delete(request))
        );
    }
}

// Run cleanup periodically
setInterval(cleanupCache, 5 * 60 * 1000); // Every 5 minutes