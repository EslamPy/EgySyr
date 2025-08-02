<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr - Enterprise Technology Solutions</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Premium enterprise technology solutions specializing in custom software development, digital transformation, and innovative business solutions for industry leaders.">
    <meta name="keywords" content="enterprise software, digital transformation, custom development, technology consulting, business solutions, software architecture, enterprise systems">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="EgySyr - Enterprise Technology Solutions">
    <meta property="og:description" content="Premium enterprise technology solutions for industry leaders seeking digital transformation and innovative business solutions.">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    
    <!-- Preload Critical Resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Critical CSS -->
    <style>
        :root {
            --primary-50: #f8f9ff;
            --primary-100: #eef2ff;
            --primary-200: #e0e7ff;
            --primary-300: #c7d2fe;
            --primary-400: #a5b4fc;
            --primary-500: #818cf8;
            --primary-600: #6366f1;
            --primary-700: #4f46e5;
            --primary-800: #4338ca;
            --primary-900: #3730a3;
            --primary-950: #1e1b4b;
            
            --neutral-50: #fafafa;
            --neutral-100: #f5f5f5;
            --neutral-200: #e5e5e5;
            --neutral-300: #d4d4d4;
            --neutral-400: #a3a3a3;
            --neutral-500: #737373;
            --neutral-600: #525252;
            --neutral-700: #404040;
            --neutral-800: #262626;
            --neutral-900: #171717;
            --neutral-950: #0a0a0a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--neutral-950) 0%, #0f0f23 50%, var(--neutral-950) 100%);
            color: var(--neutral-50);
            overflow-x: hidden;
            line-height: 1.6;
        }
        
        .grain-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.03;
            z-index: 1;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 400 400'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.4'/%3E%3C/svg%3E");
        }
        
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, rgba(79, 70, 229, 0.1) 25%, transparent 50%);
        }
        
        .card-glass {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -12px rgba(99, 102, 241, 0.3);
        }
        
        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .section-heading {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1.1;
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-300) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 800;
            line-height: 1.1;
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--primary-200) 50%, var(--neutral-300) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 24px;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        
        .service-card {
            padding: 32px;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .service-card:hover::before {
            opacity: 1;
        }
        
        .service-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.3);
        }
        
        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-400) 0%, var(--primary-600) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .nav-link {
            color: var(--neutral-300);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--primary-400);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-400);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Grain Overlay -->
    <div class="grain-overlay"></div>
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/10 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold">EgySyr</span>
                        <div class="text-xs text-neutral-400 font-medium">Enterprise Solutions</div>
                    </div>
                </div>
                
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#portfolio" class="nav-link">Portfolio</a>
                    <a href="#contact" class="nav-link">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Client Portal</a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <button class="lg:hidden text-white p-2" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="hero-gradient absolute inset-0"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-20 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-primary-600/10 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="mb-8">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-primary-500/10 text-primary-300 border border-primary-500/20 mb-6">
                    <span class="w-2 h-2 bg-primary-400 rounded-full mr-2 animate-pulse"></span>
                    Trusted by Enterprise Leaders
                </span>
            </div>
            
            <h1 class="hero-title max-w-5xl mx-auto">
                Engineering the Future of
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-400 to-primary-600">
                    Enterprise Technology
                </span>
            </h1>
            
            <p class="text-xl text-neutral-300 max-w-3xl mx-auto mb-12 leading-relaxed">
                We architect sophisticated technology solutions that transform how industry leaders operate, 
                scale, and innovate. From custom enterprise software to digital transformation initiatives, 
                we deliver excellence that drives measurable business outcomes.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                <a href="#services" class="btn-primary">
                    Explore Our Solutions
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="#contact" class="btn-secondary">
                    Schedule Consultation
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="stat-number">500+</div>
                    <div class="text-neutral-400 font-medium">Projects Delivered</div>
                </div>
                <div class="text-center">
                    <div class="stat-number">99.9%</div>
                    <div class="text-neutral-400 font-medium">Uptime SLA</div>
                </div>
                <div class="text-center">
                    <div class="stat-number">150+</div>
                    <div class="text-neutral-400 font-medium">Enterprise Clients</div>
                </div>
                <div class="text-center">
                    <div class="stat-number">24/7</div>
                    <div class="text-neutral-400 font-medium">Premium Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="section-heading mb-6">Excellence in Every Line of Code</h2>
                <p class="text-xl text-neutral-300 max-w-4xl mx-auto leading-relaxed">
                    For over a decade, we've been the technology partner of choice for organizations 
                    that demand nothing less than exceptional. Our expertise spans the full spectrum 
                    of enterprise technology, from mission-critical systems to cutting-edge innovations.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="card-glass rounded-2xl p-8 service-card group">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Custom Development</h3>
                    <p class="text-neutral-300 leading-relaxed">
                        Bespoke software solutions engineered to your exact specifications, 
                        built with enterprise-grade architecture and modern technologies.
                    </p>
                </div>
                
                <div class="card-glass rounded-2xl p-8 service-card group">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Digital Transformation</h3>
                    <p class="text-neutral-300 leading-relaxed">
                        Strategic technology initiatives that modernize operations, 
                        enhance efficiency, and position your organization for future growth.
                    </p>
                </div>
                
                <div class="card-glass rounded-2xl p-8 service-card group">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Enterprise Security</h3>
                    <p class="text-neutral-300 leading-relaxed">
                        Comprehensive security frameworks and protocols that protect 
                        your critical assets with military-grade encryption and monitoring.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="section-heading mb-6">Premium Technology Services</h2>
                <p class="text-xl text-neutral-300 max-w-4xl mx-auto leading-relaxed">
                    We offer a comprehensive suite of technology services designed to help 
                    enterprise organizations achieve their digital ambitions and operational excellence.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                <div class="card-glass rounded-2xl p-10 service-card group">
                    <div class="flex items-start space-x-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Enterprise Applications</h3>
                            <p class="text-neutral-300 leading-relaxed mb-6">
                                Mission-critical applications built for scale, reliability, and performance. 
                                We architect solutions that handle millions of transactions while maintaining 
                                sub-second response times.
                            </p>
                            <ul class="space-y-2 text-neutral-400">
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Microservices Architecture</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Real-time Data Processing</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Advanced Analytics</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-glass rounded-2xl p-10 service-card group">
                    <div class="flex items-start space-x-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">E-commerce Platforms</h3>
                            <p class="text-neutral-300 leading-relaxed mb-6">
                                High-converting e-commerce solutions that drive revenue growth. 
                                From B2B marketplaces to consumer storefronts, we build platforms 
                                that deliver exceptional user experiences.
                            </p>
                            <ul class="space-y-2 text-neutral-400">
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Multi-vendor Marketplaces</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Advanced Payment Systems</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>AI-powered Recommendations</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-glass rounded-2xl p-10 service-card group">
                    <div class="flex items-start space-x-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">Mobile Solutions</h3>
                            <p class="text-neutral-300 leading-relaxed mb-6">
                                Native and cross-platform mobile applications that engage users 
                                and drive business value. Built for performance, security, and scalability 
                                across all devices and platforms.
                            </p>
                            <ul class="space-y-2 text-neutral-400">
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Native iOS & Android</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Progressive Web Apps</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Enterprise MDM Integration</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-glass rounded-2xl p-10 service-card group">
                    <div class="flex items-start space-x-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">UI/UX Design</h3>
                            <p class="text-neutral-300 leading-relaxed mb-6">
                                User-centered design that combines aesthetic excellence with functional 
                                brilliance. We create interfaces that users love and that drive 
                                measurable business outcomes.
                            </p>
                            <ul class="space-y-2 text-neutral-400">
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Design Systems</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>User Research & Testing</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-primary-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Accessibility Compliance</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="section-heading mb-6">Start Your Digital Transformation</h2>
                <p class="text-xl text-neutral-300 max-w-4xl mx-auto leading-relaxed">
                    Ready to elevate your technology infrastructure? Let's discuss how we can help 
                    you achieve your digital ambitions with solutions that deliver real business value.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="space-y-8">
                    <div class="card-glass rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-6">Get in Touch</h3>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-lg font-semibold">Email</div>
                                    <div class="text-neutral-400">info@egysyr.com</div>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-lg font-semibold">Phone</div>
                                    <div class="text-neutral-400">+20 123 456 789</div>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-lg font-semibold">Response Time</div>
                                    <div class="text-neutral-400">Within 2 hours</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-glass rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-6">Enterprise Support</h3>
                        <p class="text-neutral-300 mb-6">
                            Our dedicated enterprise support team provides white-glove service 
                            with guaranteed SLAs and priority access to our senior architects.
                        </p>
                        <a href="#" class="btn-primary">
                            Learn More
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                                 <div class="card-glass rounded-2xl p-8">
                     <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                         @csrf
                         <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                             <div>
                                 <label class="block text-sm font-medium text-neutral-300 mb-2">Full Name</label>
                                 <input type="text" name="full_name" required class="w-full px-4 py-3 bg-neutral-800/50 border border-neutral-700 rounded-xl text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="John Doe">
                             </div>
                             <div>
                                 <label class="block text-sm font-medium text-neutral-300 mb-2">Phone</label>
                                 <input type="tel" name="phone" required class="w-full px-4 py-3 bg-neutral-800/50 border border-neutral-700 rounded-xl text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="+1 (555) 123-4567">
                             </div>
                         </div>
                         
                         <div>
                             <label class="block text-sm font-medium text-neutral-300 mb-2">Email</label>
                             <input type="email" name="email" required class="w-full px-4 py-3 bg-neutral-800/50 border border-neutral-700 rounded-xl text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="john@company.com">
                         </div>
                         
                         <div>
                             <label class="block text-sm font-medium text-neutral-300 mb-2">Service Type</label>
                             <select name="service_type" class="w-full px-4 py-3 bg-neutral-800/50 border border-neutral-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                 <option value="custom_development">Custom Development</option>
                                 <option value="digital_transformation">Digital Transformation</option>
                                 <option value="ecommerce">E-commerce Platform</option>
                                 <option value="mobile_app">Mobile Application</option>
                                 <option value="consulting">Technology Consulting</option>
                                 <option value="contacts">General Inquiry</option>
                             </select>
                         </div>
                         
                         <div>
                             <label class="block text-sm font-medium text-neutral-300 mb-2">Message</label>
                             <textarea name="message" rows="4" required class="w-full px-4 py-3 bg-neutral-800/50 border border-neutral-700 rounded-xl text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent" placeholder="Tell us about your project requirements..."></textarea>
                         </div>
                         
                         <button type="submit" class="w-full btn-primary justify-center">
                             Send Message
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                             </svg>
                         </button>
                     </form>
                 </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-neutral-950/80 backdrop-blur-xl border-t border-neutral-800/50 py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <div>
                            <span class="text-xl font-bold">EgySyr</span>
                            <div class="text-xs text-neutral-400 font-medium">Enterprise Solutions</div>
                        </div>
                    </div>
                    <p class="text-neutral-300 leading-relaxed max-w-md">
                        Leading enterprise technology solutions provider, trusted by organizations 
                        worldwide to deliver digital transformation initiatives that drive real business value.
                    </p>
                    <div class="flex space-x-4 mt-8">
                        <a href="#" class="w-12 h-12 bg-neutral-800/50 rounded-xl flex items-center justify-center hover:bg-neutral-700/50 transition-colors">
                            <svg class="w-5 h-5 text-neutral-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-neutral-800/50 rounded-xl flex items-center justify-center hover:bg-neutral-700/50 transition-colors">
                            <svg class="w-5 h-5 text-neutral-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-neutral-800/50 rounded-xl flex items-center justify-center hover:bg-neutral-700/50 transition-colors">
                            <svg class="w-5 h-5 text-neutral-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Services</h4>
                    <ul class="space-y-3 text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">Custom Development</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Digital Transformation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">E-commerce Platforms</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Mobile Applications</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">UI/UX Design</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Technology Consulting</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Company</h4>
                    <ul class="space-y-3 text-neutral-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Case Studies</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-neutral-800/50 mt-12 pt-8 flex flex-col lg:flex-row justify-between items-center">
                <p class="text-neutral-400">&copy; {{ date('Y') }} EgySyr. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 lg:mt-0 text-neutral-400">
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" onclick="closeMobileMenu()"></div>
        <div class="fixed right-0 top-0 h-full w-80 bg-neutral-900/95 backdrop-blur-xl border-l border-neutral-800 p-6">
            <div class="flex justify-between items-center mb-12">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">E</span>
                    </div>
                    <span class="text-lg font-bold">EgySyr</span>
                </div>
                <button onclick="closeMobileMenu()" class="text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-6">
                <a href="#home" class="block text-lg text-white hover:text-primary-400 transition-colors" onclick="closeMobileMenu()">Home</a>
                <a href="#about" class="block text-lg text-white hover:text-primary-400 transition-colors" onclick="closeMobileMenu()">About</a>
                <a href="#services" class="block text-lg text-white hover:text-primary-400 transition-colors" onclick="closeMobileMenu()">Services</a>
                <a href="#contact" class="block text-lg text-white hover:text-primary-400 transition-colors" onclick="closeMobileMenu()">Contact</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary block text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary block text-center">Client Portal</a>
                @endauth
            </nav>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        function openMobileMenu() {
            document.getElementById('mobile-menu').classList.remove('hidden');
        }
        
        function closeMobileMenu() {
            document.getElementById('mobile-menu').classList.add('hidden');
        }
        
        document.getElementById('mobile-menu-btn').addEventListener('click', openMobileMenu);
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroElements = document.querySelectorAll('.hero-gradient');
            heroElements.forEach(element => {
                element.style.transform = `translateY(${scrolled * 0.5}px)`;
            });
        });
        
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.service-card, .card-glass').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
        
        // Add smooth hover effects
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>