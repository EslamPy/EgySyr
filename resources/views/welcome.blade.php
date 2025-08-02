<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr - Technology Solutions</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Leading technology company specializing in web development, e-commerce solutions, and comprehensive management systems. Our team of experts delivers innovative solutions that drive business growth and digital transformation.">
    <meta name="keywords" content="web development, e-commerce solutions, management systems, technology company, tech solutions, website design, web development, software development, business management, system programming, website creation">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="EgySyr - Technology Solutions">
    <meta property="og:description" content="Leading technology company specializing in web development, e-commerce solutions, and comprehensive management systems.">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'space': ['Space Grotesk', 'sans-serif']
                    },
                    colors: {
                        'primary': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e'
                        },
                        'accent': {
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'bounce-slow': 'bounce 3s infinite'
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(139, 92, 246, 0.3); }
            to { box-shadow: 0 0 40px rgba(139, 92, 246, 0.6); }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .hover-scale {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-scale:hover {
            transform: scale(1.05) translateY(-5px);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #1e1b4b 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            z-index: 1;
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .card-hover:hover {
            transform: translateY(-10px) rotate(2deg);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .space-font {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-accent-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <span class="text-xl font-bold space-font text-white">EgySyr</span>
                    </a>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#home" class="text-white hover:text-primary-300 transition-colors duration-200">Home</a>
                        <a href="#about" class="text-white hover:text-primary-300 transition-colors duration-200">About</a>
                        <a href="#services" class="text-white hover:text-primary-300 transition-colors duration-200">Services</a>
                        <a href="#contact" class="text-white hover:text-primary-300 transition-colors duration-200">Contact</a>
                    </div>
                </div>
                
                <div class="hidden md:block">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-primary-500 to-accent-500 text-white px-4 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-primary-500 to-accent-500 text-white px-4 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-200">Login</a>
                    @endauth
                </div>
                
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center justify-center relative">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/20 to-accent-900/20 z-2"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-r from-primary-400 to-accent-400 rounded-full opacity-20 animate-float"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-gradient-to-r from-accent-400 to-primary-400 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 left-20 w-12 h-12 bg-gradient-to-r from-primary-300 to-accent-300 rounded-full opacity-20 animate-float" style="animation-delay: 4s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-black space-font mb-6 animate-fade-in">
                    <span class="text-white">Transform Your</span>
                    <br>
                    <span class="text-gradient">Digital Vision</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto animate-slide-up">
                    We are a leading technology company specializing in web development, e-commerce solutions, and comprehensive management systems. Our team of experts delivers innovative solutions that drive business growth and digital transformation.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up" style="animation-delay: 0.2s;">
                    <a href="#contact" class="bg-gradient-to-r from-primary-500 to-accent-500 text-white px-8 py-4 rounded-full font-semibold text-lg hover:shadow-xl hover:scale-105 transition-all duration-300 animate-glow">
                        Start Your Project
                    </a>
                    <a href="#services" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-gray-900 transition-all duration-300">
                        Explore Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold space-font mb-4 text-gradient">About EgySyr</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We offer a comprehensive range of technology services to help your business grow
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="text-center p-8 glass-effect rounded-2xl card-hover bg-gradient-to-br from-primary-50 to-accent-50">
                    <div class="w-16 h-16 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 space-font">Web Development</h3>
                    <p class="text-gray-600">Custom websites and web applications built with modern technologies</p>
                </div>
                
                <div class="text-center p-8 glass-effect rounded-2xl card-hover bg-gradient-to-br from-accent-50 to-primary-50">
                    <div class="w-16 h-16 bg-gradient-to-r from-accent-500 to-primary-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 space-font">E-commerce Solutions</h3>
                    <p class="text-gray-600">Complete online store solutions with payment integration</p>
                </div>
                
                <div class="text-center p-8 glass-effect rounded-2xl card-hover bg-gradient-to-br from-primary-50 to-accent-50">
                    <div class="w-16 h-16 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 space-font">Management Systems</h3>
                    <p class="text-gray-600">Comprehensive business management and ERP solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold space-font mb-4 text-gradient">Our Services</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We offer a comprehensive range of technology services to help your business grow
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Website Development', 'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z', 'color' => 'from-purple-500 to-pink-500', 'description' => 'Professional website development services tailored to your business needs'],
                    ['title' => 'E-commerce Development', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'color' => 'from-blue-500 to-cyan-500', 'description' => 'Complete e-commerce development services with secure payment integration'],
                    ['title' => 'Mobile Applications', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', 'color' => 'from-green-500 to-emerald-500', 'description' => 'Professional mobile applications services tailored to your business needs'],
                    ['title' => 'UI/UX Design', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z', 'color' => 'from-orange-500 to-red-500', 'description' => 'Professional UI/UX design services tailored to your business needs'],
                    ['title' => 'Digital Marketing', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z', 'color' => 'from-yellow-500 to-orange-500', 'description' => 'Professional digital marketing services tailored to your business needs'],
                    ['title' => 'Technical Support', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'from-indigo-500 to-purple-500', 'description' => 'Professional technical support services tailored to your business needs']
                ] as $service)
                <div class="group p-8 bg-white rounded-2xl shadow-lg hover-scale card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-r {{ $service['color'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:animate-bounce-slow transition-all duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 space-font">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $service['description'] }}</p>
                    <div class="mt-6">
                        <a href="#contact" class="text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-200 inline-flex items-center">
                            Learn More 
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-primary-900 to-accent-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold space-font mb-4">Contact Us</h2>
                <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                    Ready to start your project? Get in touch with us today!
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold mb-8 space-font">Get In Touch</h3>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-accent-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-lg">Email</p>
                                <p class="text-primary-200">info@egysyr.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-accent-500 to-primary-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-lg">Phone</p>
                                <p class="text-primary-200">+20 123 456 789</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="full_name" class="block text-sm font-medium mb-2">Full Name</label>
                                <input type="text" id="full_name" name="full_name" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-500 text-white placeholder-white/60 backdrop-blur-sm" placeholder="Your full name">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-500 text-white placeholder-white/60 backdrop-blur-sm" placeholder="your@email.com">
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium mb-2">Phone</label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-500 text-white placeholder-white/60 backdrop-blur-sm" placeholder="+20 123 456 789">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-500 text-white placeholder-white/60 resize-none backdrop-blur-sm" placeholder="Tell us about your project..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-accent-500 to-primary-500 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-accent-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <span class="text-xl font-bold space-font">EgySyr</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Leading technology solutions provider helping businesses grow through innovative digital solutions and expert technical support.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gradient-to-r from-primary-500 to-accent-500 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4 space-font">Services</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary-300 transition-colors">Web Development</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">E-commerce</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">Mobile Apps</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">UI/UX Design</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4 space-font">Company</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-primary-300 transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-primary-300 transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} EgySyr. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="closeMobileMenu()"></div>
        <div class="fixed right-0 top-0 h-full w-80 bg-white shadow-2xl">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-primary-500 to-accent-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <span class="text-xl font-bold space-font text-gray-900">EgySyr</span>
                    </div>
                    <button onclick="closeMobileMenu()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="space-y-4">
                    <a href="#home" class="block text-gray-900 hover:text-primary-600 transition-colors py-2 text-lg" onclick="closeMobileMenu()">Home</a>
                    <a href="#about" class="block text-gray-900 hover:text-primary-600 transition-colors py-2 text-lg" onclick="closeMobileMenu()">About</a>
                    <a href="#services" class="block text-gray-900 hover:text-primary-600 transition-colors py-2 text-lg" onclick="closeMobileMenu()">Services</a>
                    <a href="#contact" class="block text-gray-900 hover:text-primary-600 transition-colors py-2 text-lg" onclick="closeMobileMenu()">Contact</a>
                    <div class="pt-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block bg-gradient-to-r from-primary-500 to-accent-500 text-white px-6 py-3 rounded-full font-medium text-center">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block bg-gradient-to-r from-primary-500 to-accent-500 text-white px-6 py-3 rounded-full font-medium text-center">Login</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        function openMobileMenu() {
            document.getElementById('mobile-menu').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            document.getElementById('mobile-menu').classList.add('hidden');
            document.body.style.overflow = 'auto';
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
        
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.querySelectorAll('.card-hover, .hover-scale').forEach(el => {
            observer.observe(el);
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 100) {
                navbar.classList.add('bg-white/95', 'shadow-lg');
                navbar.querySelector('.space-font').classList.remove('text-white');
                navbar.querySelector('.space-font').classList.add('text-gray-900');
                navbar.querySelectorAll('a[href^="#"]').forEach(link => {
                    link.classList.remove('text-white', 'hover:text-primary-300');
                    link.classList.add('text-gray-900', 'hover:text-primary-600');
                });
            } else {
                navbar.classList.remove('bg-white/95', 'shadow-lg');
                navbar.querySelector('.space-font').classList.add('text-white');
                navbar.querySelector('.space-font').classList.remove('text-gray-900');
                navbar.querySelectorAll('a[href^="#"]').forEach(link => {
                    link.classList.add('text-white', 'hover:text-primary-300');
                    link.classList.remove('text-gray-900', 'hover:text-primary-600');
                });
            }
        });
    </script>
</body>
</html>