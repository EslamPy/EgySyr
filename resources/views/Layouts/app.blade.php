<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'EgySyr - Professional Technology Solutions')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Professional technology company offering website development, e-commerce solutions, and comprehensive management systems. We provide innovative tech solutions tailored to your business needs.')">
    <meta name="keywords" content="@yield('keywords', 'website development, e-commerce solutions, management systems, technology company, tech solutions, web development, software development, business solutions')">
    <meta name="author" content="EgySyr Technology">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('title', 'EgySyr - Professional Technology Solutions')">
    <meta property="og:description" content="@yield('description', 'Professional technology company offering innovative solutions for your business growth.')">
    <meta property="og:image" content="{{ asset('images/logo.webp') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="EgySyr">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <link rel="apple-touch-icon" href="{{ asset('images/icon.webp') }}">
    
    <!-- Performance Hints -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <!-- Additional CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    @stack('styles')
    
    <!-- Critical CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            --vh: 1vh;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }
        
        .gradient-primary {
            background: var(--primary-gradient);
        }
        
        .gradient-secondary {
            background: var(--secondary-gradient);
        }
        
        .gradient-accent {
            background: var(--accent-gradient);
        }
        
        .gradient-dark {
            background: var(--dark-gradient);
        }
        
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            padding: 12px 32px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: #667eea;
            padding: 12px 32px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Loading screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: var(--dark-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loading-screen.hidden {
            opacity: 0;
            pointer-events: none;
        }
        
        .loader {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(102, 126, 234, 0.3);
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Performance optimizations */
        img {
            content-visibility: auto;
        }
        
        .hero-section {
            content-visibility: auto;
            contain-intrinsic-size: 100vh;
        }
    </style>
</head>
<body class="bg-gray-950 text-white antialiased">
    <!-- Loading Screen -->
    <div class="loading-screen" id="loading-screen">
        <div class="loader"></div>
    </div>
    
    <!-- Navigation -->
    @include('Layouts.Navbar')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('Layouts.Footer')
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <!-- Performance Monitoring -->
    <script>
        // Performance monitoring
        window.addEventListener('load', function() {
            // Hide loading screen
            const loadingScreen = document.getElementById('loading-screen');
            loadingScreen.classList.add('hidden');
            
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
            
            // Fix viewport height on mobile
            const setVH = () => {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            };
            setVH();
            window.addEventListener('resize', setVH);
            
            // Register Service Worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('Service Worker registered successfully');
                    })
                    .catch(error => {
                        console.log('Service Worker registration failed:', error);
                    });
            }
            
            // Performance metrics
            if ('performance' in window) {
                const perfData = performance.getEntriesByType('navigation')[0];
                if (perfData) {
                    const loadTime = perfData.loadEventEnd - perfData.fetchStart;
                    const domContentLoaded = perfData.domContentLoadedEventEnd - perfData.fetchStart;
                    
                    console.log(`Page load time: ${loadTime}ms`);
                    console.log(`DOM ready: ${domContentLoaded}ms`);
                    
                    // Send to analytics if needed
                    // gtag('event', 'timing_complete', {
                    //     name: 'load',
                    //     value: loadTime
                    // });
                }
            }
        });
        
        // Smooth scrolling for anchor links
        document.addEventListener('click', function(e) {
            const anchor = e.target.closest('a[href^="#"]');
            if (!anchor) return;
            
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
        
        // Preload next page on hover
        let preloadedPages = new Set();
        document.addEventListener('mouseover', function(e) {
            const link = e.target.closest('a[href]');
            if (link && link.hostname === window.location.hostname && 
                !preloadedPages.has(link.href)) {
                
                const prefetch = document.createElement('link');
                prefetch.rel = 'prefetch';
                prefetch.href = link.href;
                document.head.appendChild(prefetch);
                preloadedPages.add(link.href);
            }
        });
        
        // Error handling
        window.addEventListener('error', function(e) {
            console.error('JavaScript error:', e.error);
        });
        
        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
        });
    </script>
    
    @stack('scripts')
</body>
</html>