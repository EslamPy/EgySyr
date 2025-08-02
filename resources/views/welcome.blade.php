<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr - Technology Solutions</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="شركة تكنولوجيا تقدم خدمات برمجة مواقع، تطوير متاجر إلكترونية، وأنظمة إدارية متكاملة. نوفر حلول تقنية مبتكرة تناسب احتياجاتك وتدعم نمو أعمالك.">
    <meta name="keywords" content="برمجة مواقع, تطوير متاجر إلكترونية, أنظمة إدارية, شركة تكنولوجيا, حلول تقنية, تصميم مواقع, برمجة ويب, تطوير برمجيات, إدارة أعمال, برمجة أنظمة, تطوير مواقع, website development, e-commerce solutions, management systems, technology company, tech solutions, website design, web development, software development, business management, system programming, website creation">
    <meta name="author" content="EgySyr">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="EgySyr - Technology Solutions">
    <meta property="og:description" content="شركة تكنولوجيا تقدم خدمات برمجة مواقع، تطوير متاجر إلكترونية، وأنظمة إدارية متكاملة.">
    <meta property="og:image" content="https://www.egysyr.net/img/logo.webp">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    
    <!-- Preload Critical Resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Critical CSS -->
    <style>
        /* Critical CSS for above-the-fold content */
        body {
            margin: 0;
            padding: 0;
            background-color: #1B0015;
            color: white;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ff00ff, #00ffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .btn-primary {
            display: inline-block;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #ff00ff, #00ffff);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 0, 255, 0.3);
        }
        
        .loading {
            display: none;
        }
        
        .loaded {
            display: block;
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/20 backdrop-blur-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/icon.webp') }}" alt="EgySyr" class="h-8 w-8">
                    <span class="ml-2 text-xl font-bold">EgySyr</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-purple-400 transition-colors">Home</a>
                    <a href="#about" class="text-white hover:text-purple-400 transition-colors">About</a>
                    <a href="#services" class="text-white hover:text-purple-400 transition-colors">Services</a>
                    <a href="#blog" class="text-white hover:text-purple-400 transition-colors">Blog</a>
                    <a href="#contact" class="text-white hover:text-purple-400 transition-colors">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Login</a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <button class="md:hidden text-white" id="mobile-menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">EgySyr Technology Solutions</h1>
            <p class="hero-subtitle">
                شركة تكنولوجيا تقدم خدمات برمجة مواقع، تطوير متاجر إلكترونية، وأنظمة إدارية متكاملة. 
                نوفر حلول تقنية مبتكرة تناسب احتياجاتك وتدعم نمو أعمالك.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#services" class="btn-primary">Our Services</a>
                <a href="#contact" class="btn-primary bg-transparent border-2 border-purple-500 hover:bg-purple-500">Contact Us</a>
            </div>
        </div>
        
        <!-- Animated background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 to-pink-900/20"></div>
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-purple-500/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute top-3/4 right-1/4 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">About EgySyr</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    We are a leading technology company specializing in web development, e-commerce solutions, 
                    and comprehensive management systems. Our team of experts delivers innovative solutions 
                    that drive business growth and digital transformation.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white/5 rounded-xl backdrop-blur-lg">
                    <div class="w-16 h-16 bg-purple-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Web Development</h3>
                    <p class="text-gray-400">Custom websites and web applications built with modern technologies</p>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-xl backdrop-blur-lg">
                    <div class="w-16 h-16 bg-pink-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">E-commerce Solutions</h3>
                    <p class="text-gray-400">Complete online store solutions with payment integration</p>
                </div>
                
                <div class="text-center p-6 bg-white/5 rounded-xl backdrop-blur-lg">
                    <div class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Management Systems</h3>
                    <p class="text-gray-400">Comprehensive business management and ERP solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Our Services</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    We offer a comprehensive range of technology services to help your business grow
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Website Development', 'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z', 'color' => 'purple'],
                    ['title' => 'E-commerce Development', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'color' => 'pink'],
                    ['title' => 'Mobile Applications', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', 'color' => 'blue'],
                    ['title' => 'UI/UX Design', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z', 'color' => 'green'],
                    ['title' => 'Digital Marketing', 'icon' => 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z', 'color' => 'yellow'],
                    ['title' => 'Technical Support', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'red']
                ] as $service)
                <div class="group p-6 bg-white/5 rounded-xl backdrop-blur-lg hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-{{ $service['color'] }}-500/20 rounded-full flex items-center justify-center mb-4 group-hover:bg-{{ $service['color'] }}-500/30 transition-colors">
                        <svg class="w-8 h-8 text-{{ $service['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $service['icon'] }}"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $service['title'] }}</h3>
                    <p class="text-gray-400">Professional {{ strtolower($service['title']) }} services tailored to your business needs.</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-black/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Contact Us</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Ready to start your project? Get in touch with us today!
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold mb-6">Get In Touch</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Email</p>
                                <p class="text-gray-400">info@egysyr.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-pink-500/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Phone</p>
                                <p class="text-gray-400">+20 123 456 789</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">Name</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 text-white">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 text-white">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 text-white resize-none"></textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/40 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('images/icon.webp') }}" alt="EgySyr" class="h-8 w-8">
                        <span class="text-xl font-bold">EgySyr</span>
                    </div>
                    <p class="text-gray-400">
                        Leading technology solutions provider helping businesses grow through innovative digital solutions.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Web Development</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">E-commerce</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Mobile Apps</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">UI/UX Design</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-white/10 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} EgySyr. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" onclick="closeMobileMenu()"></div>
        <div class="fixed right-0 top-0 h-full w-64 bg-gray-900 p-6">
            <div class="flex justify-between items-center mb-8">
                <span class="text-xl font-bold">Menu</span>
                <button onclick="closeMobileMenu()" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="#home" class="block text-white hover:text-purple-400 transition-colors" onclick="closeMobileMenu()">Home</a>
                <a href="#about" class="block text-white hover:text-purple-400 transition-colors" onclick="closeMobileMenu()">About</a>
                <a href="#services" class="block text-white hover:text-purple-400 transition-colors" onclick="closeMobileMenu()">Services</a>
                <a href="#contact" class="block text-white hover:text-purple-400 transition-colors" onclick="closeMobileMenu()">Contact</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary block text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary block text-center">Login</a>
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
        document.querySelectorAll('.group, .stat-card, .chart-container').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>