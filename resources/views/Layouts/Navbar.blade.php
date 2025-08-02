<!-- Modern Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
    <div class="glass-effect border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0" data-aos="fade-right">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Logo" class="h-12 w-auto">
                        <span class="text-2xl font-bold text-gradient">EgySyr</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8" data-aos="fade-down">
                    <a href="{{ route('welcome') }}" 
                       class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <div class="relative group">
                        <a href="{{ route('services') }}" 
                           class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                            <i class="fas fa-cogs mr-2"></i>Services
                            <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                        </a>
                        <!-- Services Dropdown -->
                        <div class="absolute top-full left-0 mt-2 w-64 glass-effect rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="p-4 space-y-2">
                                <a href="{{ route('services.web') }}" class="dropdown-link">
                                    <i class="fas fa-globe mr-3"></i>Web Development
                                </a>
                                <a href="{{ route('services.application') }}" class="dropdown-link">
                                    <i class="fas fa-mobile-alt mr-3"></i>App Development
                                </a>
                                <a href="{{ route('services.system') }}" class="dropdown-link">
                                    <i class="fas fa-server mr-3"></i>System Solutions
                                </a>
                                <a href="{{ route('services.hosting') }}" class="dropdown-link">
                                    <i class="fas fa-cloud mr-3"></i>Hosting Services
                                </a>
                                <a href="{{ route('services.graphic') }}" class="dropdown-link">
                                    <i class="fas fa-paint-brush mr-3"></i>Graphic Design
                                </a>
                                <a href="{{ route('services.marketing') }}" class="dropdown-link">
                                    <i class="fas fa-bullhorn mr-3"></i>Digital Marketing
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('blog') }}" 
                       class="nav-link {{ request()->is('blog*') ? 'active' : '' }}">
                        <i class="fas fa-blog mr-2"></i>Blog
                    </a>
                    <a href="{{ route('about') }}" 
                       class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-users mr-2"></i>About
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        <i class="fas fa-envelope mr-2"></i>Contact
                    </a>
                </div>

                <!-- CTA Button -->
                <div class="hidden lg:flex items-center space-x-4" data-aos="fade-left">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        <i class="fas fa-rocket mr-2"></i>Get Started
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button type="button" 
                            class="mobile-menu-btn p-2 rounded-lg text-white hover:bg-white/10 transition-colors"
                            id="mobile-menu-btn">
                        <span class="sr-only">Open main menu</span>
                        <div class="w-6 h-6 relative">
                            <span class="hamburger-line top-0"></span>
                            <span class="hamburger-line top-2"></span>
                            <span class="hamburger-line top-4"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="lg:hidden fixed inset-0 z-50 hidden" id="mobile-menu">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" id="mobile-menu-overlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-sm glass-effect transform translate-x-full transition-transform duration-300" id="mobile-menu-panel">
            <div class="p-6">
                <!-- Close Button -->
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Logo" class="h-10 w-auto">
                        <span class="text-xl font-bold text-gradient">EgySyr</span>
                    </div>
                    <button type="button" class="p-2 rounded-lg text-white hover:bg-white/10 transition-colors" id="mobile-close-btn">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Navigation Links -->
                <div class="space-y-4">
                    <a href="{{ route('welcome') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home mr-3"></i>Home
                    </a>
                    
                    <!-- Mobile Services -->
                    <div class="space-y-2">
                        <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->is('services*') ? 'active' : '' }}">
                            <i class="fas fa-cogs mr-3"></i>Services
                        </a>
                        <div class="pl-6 space-y-2">
                            <a href="{{ route('services.web') }}" class="mobile-sub-link">Web Development</a>
                            <a href="{{ route('services.application') }}" class="mobile-sub-link">App Development</a>
                            <a href="{{ route('services.system') }}" class="mobile-sub-link">System Solutions</a>
                            <a href="{{ route('services.hosting') }}" class="mobile-sub-link">Hosting Services</a>
                            <a href="{{ route('services.graphic') }}" class="mobile-sub-link">Graphic Design</a>
                            <a href="{{ route('services.marketing') }}" class="mobile-sub-link">Digital Marketing</a>
                        </div>
                    </div>
                    
                    <a href="{{ route('blog') }}" class="mobile-nav-link {{ request()->is('blog*') ? 'active' : '' }}">
                        <i class="fas fa-blog mr-3"></i>Blog
                    </a>
                    <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->is('about') ? 'active' : '' }}">
                        <i class="fas fa-users mr-3"></i>About
                    </a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        <i class="fas fa-envelope mr-3"></i>Contact
                    </a>
                </div>

                <!-- Mobile CTA -->
                <div class="mt-8 pt-8 border-t border-white/10">
                    <a href="{{ route('contact') }}" class="btn-primary w-full text-center">
                        <i class="fas fa-rocket mr-2"></i>Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply text-white/80 hover:text-white transition-all duration-300 font-medium flex items-center relative;
    }
    
    .nav-link:hover {
        transform: translateY(-1px);
    }
    
    .nav-link.active {
        @apply text-white;
    }
    
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }
    
    .dropdown-link {
        @apply block px-4 py-3 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 text-sm;
    }
    
    .mobile-nav-link {
        @apply block px-4 py-3 text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 font-medium;
    }
    
    .mobile-nav-link.active {
        @apply text-white bg-white/10;
    }
    
    .mobile-sub-link {
        @apply block px-4 py-2 text-white/60 hover:text-white/80 hover:bg-white/5 rounded-lg transition-all duration-200 text-sm;
    }
    
    .hamburger-line {
        @apply absolute left-0 w-6 h-0.5 bg-white transition-all duration-300;
    }
    
    .mobile-menu-btn.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translate(3px, 3px);
    }
    
    .mobile-menu-btn.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-menu-btn.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translate(3px, -3px);
    }
    
    /* Navbar scroll effect */
    .navbar-scrolled {
        @apply bg-gray-900/95;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuPanel = document.getElementById('mobile-menu-panel');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
    
    // Mobile menu toggle
    function toggleMobileMenu() {
        mobileMenu.classList.toggle('hidden');
        mobileMenuBtn.classList.toggle('active');
        
        // Animate panel
        setTimeout(() => {
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenuPanel.style.transform = 'translateX(0)';
            }
        }, 10);
        
        // Prevent body scroll
        document.body.classList.toggle('overflow-hidden');
    }
    
    function closeMobileMenu() {
        mobileMenuPanel.style.transform = 'translateX(100%)';
        mobileMenuBtn.classList.remove('active');
        document.body.classList.remove('overflow-hidden');
        
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300);
    }
    
    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    mobileCloseBtn.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    
    // Close mobile menu on link click
    document.querySelectorAll('.mobile-nav-link, .mobile-sub-link').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
});
</script>