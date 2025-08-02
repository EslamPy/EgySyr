<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EgySyr - Modern Technology Solutions</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,1,0" rel="stylesheet">
    
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
                        },
                        'neon': {
                            pink: '#ff007f',
                            blue: '#00ffff',
                            purple: '#8b5cf6',
                            green: '#00ff88'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out forwards',
                        'slide-up': 'slideUp 1s ease-out forwards',
                        'slide-left': 'slideLeft 1s ease-out forwards',
                        'slide-right': 'slideRight 1s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'bounce-slow': 'bounce 3s infinite',
                        'spin-slow': 'spin 8s linear infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'gradient': 'gradient 15s ease infinite',
                        'blob': 'blob 7s infinite',
                        'tilt': 'tilt 10s infinite linear'
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>
    
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(139, 92, 246, 0.4); }
            to { box-shadow: 0 0 60px rgba(139, 92, 246, 0.8); }
        }
        
        @keyframes wiggle {
            0%, 7% { transform: rotateZ(0); }
            15% { transform: rotateZ(-15deg); }
            20% { transform: rotateZ(10deg); }
            25% { transform: rotateZ(-10deg); }
            30% { transform: rotateZ(6deg); }
            35% { transform: rotateZ(-4deg); }
            40%, 100% { transform: rotateZ(0); }
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        @keyframes tilt {
            0%, 50%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(1deg); }
            75% { transform: rotate(-1deg); }
        }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.1); }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(45deg, #8b5cf6, #06b6d4);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #7c3aed, #0891b2);
        }
        
        /* Custom Classes */
        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .neon-border {
            border: 2px solid;
            border-image: linear-gradient(45deg, #ff007f, #00ffff, #8b5cf6) 1;
            animation: gradient 3s ease infinite;
        }
        
        .hover-scale {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .hover-scale:hover {
            transform: scale(1.05) translateY(-5px);
        }
        
        .bg-gradient-animated {
            background: linear-gradient(-45deg, #667eea, #764ba2, #667eea, #764ba2);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        .text-shadow {
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom cursor */
        .cursor-pointer {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        /* Particle background */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: linear-gradient(45deg, #8b5cf6, #06b6d4);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }
        
        /* Section transitions */
        .section-transition {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Loading animation */
        .loading-dots {
            display: inline-block;
        }
        
        .loading-dots::after {
            content: '...';
            animation: dots 2s infinite;
        }
        
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60%, 100% { content: '...'; }
        }
    </style>
</head>

<body class="font-inter bg-gray-900 text-white overflow-x-hidden">
    <!-- Particle Background -->
    <div class="particles" id="particles"></div>
    
    <!-- Fixed Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">E</span>
                    </div>
                    <span class="text-2xl font-space font-bold gradient-text">EgySyr</span>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">Home</a>
                    <a href="#about" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">About</a>
                    <a href="#services" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">Services</a>
                    <a href="#portfolio" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">Portfolio</a>
                    <a href="#blog" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">Blog</a>
                    <a href="#contact" class="nav-link text-white hover:text-purple-400 transition-colors duration-300">Contact</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-purple-500 to-blue-500 px-4 py-2 rounded-lg hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-purple-500 to-blue-500 px-4 py-2 rounded-lg hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300">Login</a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white p-2" id="mobile-menu-btn">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
            
            <!-- Mobile Navigation -->
            <div class="md:hidden mt-4 space-y-2 hidden" id="mobile-menu">
                <a href="#home" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">Home</a>
                <a href="#about" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">About</a>
                <a href="#services" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">Services</a>
                <a href="#portfolio" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">Portfolio</a>
                <a href="#blog" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">Blog</a>
                <a href="#contact" class="block text-white hover:text-purple-400 py-2 transition-colors duration-300">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-animated">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="container mx-auto px-6 text-center relative z-10">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-6xl md:text-8xl font-space font-bold mb-6 leading-tight">
                    <span class="gradient-text">Modern</span><br>
                    <span class="text-white text-shadow">Technology</span><br>
                    <span class="gradient-text">Solutions</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    We craft innovative digital experiences that transform businesses and captivate audiences with cutting-edge technology and creative excellence.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="400">
                    <a href="#services" class="bg-gradient-to-r from-purple-500 to-blue-500 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-purple-500/25 transition-all duration-300 hover-scale">
                        Explore Services
                    </a>
                    <a href="#contact" class="glass-effect px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transition-all duration-300 hover-scale">
                        Start Project
                    </a>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce" data-aos="fade-up" data-aos-delay="600">
                <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
                    <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-5xl font-space font-bold gradient-text mb-4">About EgySyr</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Pioneering the future of technology with innovative solutions</p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="slide-right">
                    <div class="glass-effect p-8 rounded-2xl hover-scale">
                        <h3 class="text-3xl font-bold mb-6 gradient-text">Our Mission</h3>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            We are dedicated to transforming businesses through innovative technology solutions. Our team of experts combines creativity with technical excellence to deliver exceptional digital experiences.
                        </p>
                        <p class="text-gray-300 text-lg leading-relaxed mb-6">
                            From web development to e-commerce solutions and comprehensive management systems, we provide end-to-end services that drive growth and success.
                        </p>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 mt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold gradient-text" data-counter="150">0</div>
                                <div class="text-sm text-gray-400">Projects</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold gradient-text" data-counter="50">0</div>
                                <div class="text-sm text-gray-400">Clients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold gradient-text" data-counter="5">0</div>
                                <div class="text-sm text-gray-400">Years</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div data-aos="slide-left">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-white">code</span>
                            </div>
                            <h4 class="text-lg font-semibold mb-2">Web Development</h4>
                            <p class="text-gray-400 text-sm">Modern, responsive websites built with latest technologies</p>
                        </div>
                        
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-white">shopping_cart</span>
                            </div>
                            <h4 class="text-lg font-semibold mb-2">E-Commerce</h4>
                            <p class="text-gray-400 text-sm">Powerful online stores that drive sales and growth</p>
                        </div>
                        
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-white">settings</span>
                            </div>
                            <h4 class="text-lg font-semibold mb-2">Management Systems</h4>
                            <p class="text-gray-400 text-sm">Comprehensive solutions for business management</p>
                        </div>
                        
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-white">support_agent</span>
                            </div>
                            <h4 class="text-lg font-semibold mb-2">24/7 Support</h4>
                            <p class="text-gray-400 text-sm">Round-the-clock support for all our clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-5xl font-space font-bold gradient-text mb-4">Our Services</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Comprehensive technology solutions tailored to your needs</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Web Development -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">web</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Web Development</h3>
                    <p class="text-gray-300 mb-6">Custom websites and web applications built with modern frameworks and technologies for optimal performance and user experience.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Responsive Design</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>SEO Optimization</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>Performance Optimization</li>
                    </ul>
                </div>
                
                <!-- E-Commerce -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">storefront</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">E-Commerce Solutions</h3>
                    <p class="text-gray-300 mb-6">Complete online store solutions with payment integration, inventory management, and customer analytics to boost your sales.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Payment Gateway</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Inventory Management</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>Analytics Dashboard</li>
                    </ul>
                </div>
                
                <!-- Management Systems -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">dashboard</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Management Systems</h3>
                    <p class="text-gray-300 mb-6">Comprehensive business management solutions including CRM, ERP, and custom administrative systems.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>CRM Integration</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>Data Analytics</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-pink-500 rounded-full mr-3"></span>Workflow Automation</li>
                    </ul>
                </div>
                
                <!-- Digital Marketing -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">campaign</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Digital Marketing</h3>
                    <p class="text-gray-300 mb-6">Strategic digital marketing services to enhance your online presence and reach your target audience effectively.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>SEO/SEM</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>Social Media</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></span>Content Strategy</li>
                    </ul>
                </div>
                
                <!-- Graphic Design -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">palette</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Graphic Design</h3>
                    <p class="text-gray-300 mb-6">Creative visual solutions including branding, UI/UX design, and marketing materials that make your brand stand out.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-red-500 rounded-full mr-3"></span>Brand Identity</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-red-500 rounded-full mr-3"></span>UI/UX Design</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-red-500 rounded-full mr-3"></span>Print Design</li>
                    </ul>
                </div>
                
                <!-- Hosting & Support -->
                <div class="glass-effect p-8 rounded-2xl hover-scale group" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mb-6 group-hover:animate-wiggle">
                        <span class="material-symbols-outlined text-white text-3xl">cloud</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Hosting & Support</h3>
                    <p class="text-gray-300 mb-6">Reliable hosting solutions with 24/7 support, ensuring your website is always online and performing optimally.</p>
                    <ul class="text-gray-400 space-y-2">
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>99.9% Uptime</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>SSL Security</li>
                        <li class="flex items-center"><span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>24/7 Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-5xl font-space font-bold gradient-text mb-4">Our Portfolio</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Showcasing our latest projects and success stories</p>
            </div>
            
            <!-- Portfolio Filter -->
            <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="200">
                <button class="portfolio-filter active bg-gradient-to-r from-purple-500 to-blue-500 px-6 py-3 rounded-full transition-all duration-300" data-filter="all">All Projects</button>
                <button class="portfolio-filter glass-effect px-6 py-3 rounded-full hover:bg-purple-500/20 transition-all duration-300" data-filter="web">Web Development</button>
                <button class="portfolio-filter glass-effect px-6 py-3 rounded-full hover:bg-purple-500/20 transition-all duration-300" data-filter="ecommerce">E-Commerce</button>
                <button class="portfolio-filter glass-effect px-6 py-3 rounded-full hover:bg-purple-500/20 transition-all duration-300" data-filter="design">Design</button>
            </div>
            
            <!-- Portfolio Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="portfolio-item group" data-category="web" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-effect rounded-2xl overflow-hidden hover-scale">
                        <div class="h-48 bg-gradient-to-br from-purple-500 to-blue-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl">web</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 gradient-text">Corporate Website</h3>
                            <p class="text-gray-400 mb-4">Modern responsive website with advanced animations and interactive features.</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">React</span>
                                <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Tailwind</span>
                                <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-sm">Laravel</span>
                            </div>
                            <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                                View Project <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="portfolio-item group" data-category="ecommerce" data-aos="fade-up" data-aos-delay="400">
                    <div class="glass-effect rounded-2xl overflow-hidden hover-scale">
                        <div class="h-48 bg-gradient-to-br from-green-500 to-blue-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl">shopping_cart</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 gradient-text">E-Commerce Platform</h3>
                            <p class="text-gray-400 mb-4">Full-featured online store with payment integration and inventory management.</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Vue.js</span>
                                <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Node.js</span>
                                <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-sm">MongoDB</span>
                            </div>
                            <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                                View Project <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="portfolio-item group" data-category="design" data-aos="fade-up" data-aos-delay="500">
                    <div class="glass-effect rounded-2xl overflow-hidden hover-scale">
                        <div class="h-48 bg-gradient-to-br from-pink-500 to-purple-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl">palette</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 gradient-text">Brand Identity</h3>
                            <p class="text-gray-400 mb-4">Complete brand identity design including logo, colors, and marketing materials.</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Illustrator</span>
                                <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Photoshop</span>
                                <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-sm">Figma</span>
                            </div>
                            <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                                View Project <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-5xl font-space font-bold gradient-text mb-4">Latest Blog Posts</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Insights, tutorials, and industry trends</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <article class="glass-effect rounded-2xl overflow-hidden hover-scale group" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-blue-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Technology</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">January 15, 2024</div>
                        <h3 class="text-xl font-bold mb-3 gradient-text group-hover:text-purple-400 transition-colors duration-300">
                            The Future of Web Development: Trends to Watch in 2024
                        </h3>
                        <p class="text-gray-300 mb-4 line-clamp-3">
                            Explore the latest trends and technologies shaping the future of web development, from AI integration to progressive web apps.
                        </p>
                        <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                            Read More <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                        </a>
                    </div>
                </article>
                
                <!-- Blog Post 2 -->
                <article class="glass-effect rounded-2xl overflow-hidden hover-scale group" data-aos="fade-up" data-aos-delay="400">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-blue-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">E-Commerce</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">January 10, 2024</div>
                        <h3 class="text-xl font-bold mb-3 gradient-text group-hover:text-purple-400 transition-colors duration-300">
                            Building Successful E-Commerce Platforms: Best Practices
                        </h3>
                        <p class="text-gray-300 mb-4 line-clamp-3">
                            Learn the essential strategies and technologies needed to create high-converting e-commerce platforms that drive sales.
                        </p>
                        <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                            Read More <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                        </a>
                    </div>
                </article>
                
                <!-- Blog Post 3 -->
                <article class="glass-effect rounded-2xl overflow-hidden hover-scale group" data-aos="fade-up" data-aos-delay="500">
                    <div class="h-48 bg-gradient-to-br from-pink-500 to-purple-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Design</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-2">January 5, 2024</div>
                        <h3 class="text-xl font-bold mb-3 gradient-text group-hover:text-purple-400 transition-colors duration-300">
                            Modern UI/UX Design Principles for Better User Experience
                        </h3>
                        <p class="text-gray-300 mb-4 line-clamp-3">
                            Discover the key principles of modern UI/UX design that create engaging and intuitive user experiences.
                        </p>
                        <a href="#" class="text-purple-400 hover:text-purple-300 transition-colors duration-300 inline-flex items-center">
                            Read More <span class="material-symbols-outlined ml-1 text-lg">arrow_outward</span>
                        </a>
                    </div>
                </article>
            </div>
            
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="600">
                <a href="#" class="bg-gradient-to-r from-purple-500 to-blue-500 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-2xl hover:shadow-purple-500/25 transition-all duration-300 hover-scale">
                    View All Posts
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-5xl font-space font-bold gradient-text mb-4">Get In Touch</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Ready to start your project? Let's discuss how we can help you achieve your goals</p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div data-aos="slide-right">
                    <div class="glass-effect p-8 rounded-2xl">
                        <h3 class="text-2xl font-bold mb-6 gradient-text">Send us a Message</h3>
                        <form id="contact-form" class="space-y-6">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-300 mb-2">Name *</label>
                                    <input type="text" name="name" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:border-purple-500 focus:outline-none transition-colors duration-300 text-white placeholder-gray-400" placeholder="Your Name">
                                </div>
                                <div>
                                    <label class="block text-gray-300 mb-2">Email *</label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:border-purple-500 focus:outline-none transition-colors duration-300 text-white placeholder-gray-400" placeholder="your@email.com">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-300 mb-2">Subject *</label>
                                <input type="text" name="subject" required class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:border-purple-500 focus:outline-none transition-colors duration-300 text-white placeholder-gray-400" placeholder="Project Subject">
                            </div>
                            
                            <div>
                                <label class="block text-gray-300 mb-2">Message *</label>
                                <textarea name="message" required rows="5" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg focus:border-purple-500 focus:outline-none transition-colors duration-300 text-white placeholder-gray-400 resize-none" placeholder="Tell us about your project..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-blue-500 px-8 py-4 rounded-lg text-lg font-semibold hover:shadow-2xl hover:shadow-purple-500/25 transition-all duration-300 hover-scale">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div data-aos="slide-left">
                    <div class="space-y-8">
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">email</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold mb-1">Email Us</h4>
                                    <p class="text-gray-400">contact@egysyr.net</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">call</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold mb-1">Call Us</h4>
                                    <p class="text-gray-400">+20 123 456 7890</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="glass-effect p-6 rounded-xl hover-scale">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">location_on</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold mb-1">Visit Us</h4>
                                    <p class="text-gray-400">Cairo, Egypt</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="glass-effect p-6 rounded-xl">
                            <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-300 hover-scale">
                                    <span class="material-symbols-outlined text-white text-sm">facebook</span>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 rounded-lg flex items-center justify-center hover:shadow-lg hover:shadow-blue-400/25 transition-all duration-300 hover-scale">
                                    <span class="material-symbols-outlined text-white text-sm">twitter</span>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg flex items-center justify-center hover:shadow-lg hover:shadow-purple-500/25 transition-all duration-300 hover-scale">
                                    <span class="material-symbols-outlined text-white text-sm">instagram</span>
                                </a>
                                <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-700 to-blue-800 rounded-lg flex items-center justify-center hover:shadow-lg hover:shadow-blue-700/25 transition-all duration-300 hover-scale">
                                    <span class="material-symbols-outlined text-white text-sm">linkedin</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/10 bg-black/30">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">E</span>
                        </div>
                        <span class="text-xl font-space font-bold gradient-text">EgySyr</span>
                    </div>
                    <p class="text-gray-400 mb-4">Pioneering the future of technology with innovative solutions that transform businesses and create exceptional digital experiences.</p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 gradient-text">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Home</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">About</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Services</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 gradient-text">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Web Development</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">E-Commerce</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Management Systems</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Digital Marketing</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4 gradient-text">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">contact@egysyr.net</li>
                        <li class="text-gray-400">+20 123 456 7890</li>
                        <li class="text-gray-400">Cairo, Egypt</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 EgySyr. All rights reserved. Designed with ❤️ for the future.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Particle Animation
        function createParticles() {
            const particles = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particles.appendChild(particle);
            }
        }

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('[data-counter]');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-counter'));
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current) + (target > 100 ? '+' : '');
                }, 20);
            });
        }

        // Smooth Navigation
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

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Navbar Background on Scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('bg-black/80');
            } else {
                navbar.classList.remove('bg-black/80');
            }
        });

        // Portfolio Filter
        const filterButtons = document.querySelectorAll('.portfolio-filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-gradient-to-r', 'from-purple-500', 'to-blue-500');
                    btn.classList.add('glass-effect');
                });
                
                // Add active class to clicked button
                button.classList.add('active', 'bg-gradient-to-r', 'from-purple-500', 'to-blue-500');
                button.classList.remove('glass-effect');
                
                const filter = button.getAttribute('data-filter');
                
                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Contact Form
        document.getElementById('contact-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    body: formData
                });
                
                if (response.ok) {
                    submitBtn.textContent = 'Message Sent!';
                    submitBtn.classList.remove('from-purple-500', 'to-blue-500');
                    submitBtn.classList.add('from-green-500', 'to-green-600');
                    e.target.reset();
                    
                    setTimeout(() => {
                        submitBtn.textContent = originalText;
                        submitBtn.classList.remove('from-green-500', 'to-green-600');
                        submitBtn.classList.add('from-purple-500', 'to-blue-500');
                        submitBtn.disabled = false;
                    }, 3000);
                } else {
                    throw new Error('Failed to send message');
                }
            } catch (error) {
                submitBtn.textContent = 'Error! Try Again';
                submitBtn.classList.remove('from-purple-500', 'to-blue-500');
                submitBtn.classList.add('from-red-500', 'to-red-600');
                
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.classList.remove('from-red-500', 'to-red-600');
                    submitBtn.classList.add('from-purple-500', 'to-blue-500');
                    submitBtn.disabled = false;
                }, 3000);
            }
        });

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            
            // Trigger counter animation when section is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            const aboutSection = document.getElementById('about');
            if (aboutSection) observer.observe(aboutSection);
        });

        // GSAP Animations
        gsap.registerPlugin(ScrollTrigger);

        // Hero text animation
        gsap.fromTo('.gradient-text', {
            opacity: 0,
            y: 100
        }, {
            opacity: 1,
            y: 0,
            duration: 1.2,
            ease: 'power4.out',
            stagger: 0.3
        });

        // Section reveal animations
        gsap.utils.toArray('section').forEach(section => {
            gsap.fromTo(section, {
                opacity: 0.3,
                y: 50
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        });

        // Parallax effect for background elements
        gsap.utils.toArray('.animate-blob').forEach(blob => {
            gsap.to(blob, {
                y: '-50%',
                ease: 'none',
                scrollTrigger: {
                    trigger: blob,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });
    </script>
</body>
</html>