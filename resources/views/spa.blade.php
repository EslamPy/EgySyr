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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Animation Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .section-transition {
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .nav-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .nav-glass.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            z-index: 1000;
            transition: width 0.1s ease;
        }
        
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 font-inter overflow-x-hidden">
    <!-- Scroll Progress Indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>
    
    <!-- Modern Navigation -->
    <nav class="nav-glass fixed w-full top-0 z-50" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img class="h-8 w-auto" src="{{ asset('images/icon.webp') }}" alt="EgySyr">
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#home" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300">Home</a>
                        <a href="#about" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300">About</a>
                        <a href="#services" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300">Services</a>
                        <a href="#blog" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300">Blog</a>
                        <a href="#contact" class="nav-link text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300">Contact</a>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-btn text-gray-700 hover:text-purple-600 focus:outline-none focus:text-purple-600">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg">
                <a href="#home" class="nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600">Home</a>
                <a href="#about" class="nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600">About</a>
                <a href="#services" class="nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600">Services</a>
                <a href="#blog" class="nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600">Blog</a>
                <a href="#contact" class="nav-link block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900"></div>
        <div class="absolute inset-0 bg-black opacity-20"></div>
        
        <!-- Animated background elements -->
        <div class="absolute inset-0">
            <div class="floating-animation absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-20 blur-xl"></div>
            <div class="floating-animation absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-full opacity-20 blur-xl" style="animation-delay: -2s;"></div>
            <div class="floating-animation absolute bottom-32 left-1/4 w-20 h-20 bg-gradient-to-r from-green-400 to-blue-400 rounded-full opacity-20 blur-xl" style="animation-delay: -4s;"></div>
        </div>
        
        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
                <span class="block">Innovative</span>
                <span class="gradient-text bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">Technology Solutions</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                We transform ideas into powerful digital experiences with cutting-edge web development, e-commerce solutions, and innovative management systems.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
                <button class="glass-effect hover-lift px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                    Get Started
                </button>
                <button class="border-2 border-white border-opacity-30 hover-lift px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:bg-white hover:bg-opacity-10">
                    Learn More
                </button>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 section-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">About EgySyr</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We are passionate about creating digital solutions that drive innovation and success for businesses worldwide.</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="glass-effect rounded-3xl p-8 hover-lift">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            To empower businesses with innovative technology solutions that streamline operations, enhance user experiences, and drive sustainable growth in the digital era.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mr-3"></div>
                                <span class="text-gray-700">Expert Development Team</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-full mr-3"></div>
                                <span class="text-gray-700">Cutting-edge Technology</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-gradient-to-r from-green-400 to-blue-400 rounded-full mr-3"></div>
                                <span class="text-gray-700">24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6" data-aos="fade-left">
                    <div class="glass-effect rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold gradient-text mb-2">100+</div>
                        <div class="text-gray-600">Projects Completed</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold gradient-text mb-2">50+</div>
                        <div class="text-gray-600">Happy Clients</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold gradient-text mb-2">5+</div>
                        <div class="text-gray-600">Years Experience</div>
                    </div>
                    <div class="glass-effect rounded-2xl p-6 text-center hover-lift">
                        <div class="text-3xl font-bold gradient-text mb-2">24/7</div>
                        <div class="text-gray-600">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gradient-to-br from-gray-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">Our Services</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">We offer comprehensive technology solutions designed to elevate your business to new heights.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Web Development</h3>
                    <p class="text-gray-600 mb-6">Custom websites and web applications built with modern technologies and responsive design.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
                
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">E-commerce Solutions</h3>
                    <p class="text-gray-600 mb-6">Complete online store development with payment integration and inventory management.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
                
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-blue-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Management Systems</h3>
                    <p class="text-gray-600 mb-6">Comprehensive business management systems to streamline your operations.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
                
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Mobile Applications</h3>
                    <p class="text-gray-600 mb-6">Native and cross-platform mobile apps for iOS and Android devices.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
                
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-16 h-16 bg-gradient-to-r from-red-400 to-pink-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">UI/UX Design</h3>
                    <p class="text-gray-600 mb-6">Beautiful and intuitive user interfaces that enhance user experience.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
                
                <div class="glass-effect rounded-3xl p-8 hover-lift" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Performance Optimization</h3>
                    <p class="text-gray-600 mb-6">Speed up your applications and improve user experience with our optimization services.</p>
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Learn More →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold gradient-text mb-6">Latest Blog Posts</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Stay updated with the latest trends and insights from the world of technology.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article class="glass-effect rounded-3xl overflow-hidden hover-lift" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-400"></div>
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full mb-3">Technology</span>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">The Future of Web Development</h3>
                        <p class="text-gray-600 mb-4">Exploring the latest trends and technologies shaping the future of web development...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 15, 2024</span>
                            <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Read More →</a>
                        </div>
                    </div>
                </article>
                
                <article class="glass-effect rounded-3xl overflow-hidden hover-lift" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-cyan-400"></div>
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-100 rounded-full mb-3">E-commerce</span>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Building Scalable E-commerce Solutions</h3>
                        <p class="text-gray-600 mb-4">Learn how to create e-commerce platforms that can handle high traffic and sales...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 12, 2024</span>
                            <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Read More →</a>
                        </div>
                    </div>
                </article>
                
                <article class="glass-effect rounded-3xl overflow-hidden hover-lift" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-blue-400"></div>
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-green-600 bg-green-100 rounded-full mb-3">Design</span>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Modern UI/UX Design Principles</h3>
                        <p class="text-gray-600 mb-4">Discover the key principles behind creating engaging and user-friendly interfaces...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Jan 10, 2024</span>
                            <a href="#" class="text-purple-600 font-semibold hover:text-purple-700 transition-colors">Read More →</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0">
            <div class="floating-animation absolute top-20 right-10 w-32 h-32 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full opacity-10 blur-xl"></div>
            <div class="floating-animation absolute bottom-32 left-20 w-24 h-24 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-full opacity-10 blur-xl" style="animation-delay: -2s;"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Get In Touch</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">Ready to start your next project? Let's discuss how we can help you achieve your goals.</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div data-aos="fade-right">
                    <div class="glass-dark rounded-3xl p-8">
                        <h3 class="text-2xl font-bold text-white mb-6">Contact Information</h3>
                        <div class="space-y-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Email</div>
                                    <div class="text-gray-300">contact@egysyr.net</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Phone</div>
                                    <div class="text-gray-300">+20 123 456 7890</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-white font-semibold">Location</div>
                                    <div class="text-gray-300">Cairo, Egypt</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div data-aos="fade-left">
                    <form class="glass-dark rounded-3xl p-8 space-y-6" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">Name</label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-xl bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-xl bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-white mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required class="w-full px-4 py-3 rounded-xl bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-white mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 rounded-xl bg-white bg-opacity-10 border border-white border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full glass-effect hover-lift px-8 py-4 rounded-xl text-white font-semibold text-lg transition-all duration-300 hover:bg-white hover:bg-opacity-20">
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
                <div>
                    <img class="h-8 w-auto mb-4" src="{{ asset('images/icon.webp') }}" alt="EgySyr">
                    <p class="text-gray-400 mb-4">Innovative technology solutions that drive business growth and digital transformation.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Web Development</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">E-commerce Solutions</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Management Systems</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Mobile Applications</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#blog" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="{{ route('policy') }}" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates.</p>
                    <div class="flex">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded-l-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <button class="px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-r-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 EgySyr. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Scroll progress indicator
        window.addEventListener('scroll', () => {
            const scrollProgress = document.getElementById('scrollIndicator');
            const scrollTop = document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrollPercentage = (scrollTop / scrollHeight) * 100;
            scrollProgress.style.width = scrollPercentage + '%';
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', () => {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    const offsetTop = targetSection.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
                
                // Close mobile menu if open
                document.querySelector('.mobile-menu').classList.add('hidden');
            });
        });

        // Active navigation highlighting
        window.addEventListener('scroll', () => {
            const sections = ['home', 'about', 'services', 'blog', 'contact'];
            const navLinks = document.querySelectorAll('.nav-link');
            
            let current = '';
            sections.forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section) {
                    const sectionTop = section.offsetTop - 100;
                    const sectionHeight = section.offsetHeight;
                    if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                        current = sectionId;
                    }
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('text-purple-600');
                link.classList.add('text-gray-700');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.remove('text-gray-700');
                    link.classList.add('text-purple-600');
                }
            });
        });

        // GSAP animations
        gsap.registerPlugin(ScrollTrigger);

        // Hero section animations
        gsap.timeline()
            .from('.gradient-text', { duration: 1, y: 50, opacity: 0, ease: 'power3.out' })
            .from('.text-gray-300', { duration: 1, y: 30, opacity: 0, ease: 'power3.out' }, '-=0.5')
            .from('.glass-effect', { duration: 1, y: 30, opacity: 0, ease: 'power3.out' }, '-=0.3');

        // Section reveal animations
        gsap.utils.toArray('section').forEach(section => {
            gsap.fromTo(section, 
                { opacity: 0, y: 50 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 80%',
                        end: 'bottom 20%',
                        toggleActions: 'play none none reverse'
                    }
                }
            );
        });

        // Parallax effect for floating elements
        gsap.utils.toArray('.floating-animation').forEach(element => {
            gsap.to(element, {
                y: -50,
                duration: 2,
                ease: 'power1.inOut',
                repeat: -1,
                yoyo: true
            });
        });
    </script>
</body>
</html>