<!-- Modern Footer -->
<footer class="gradient-dark relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>
    
    <div class="relative">
        <!-- Main Footer Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-2" data-aos="fade-up">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Logo" class="h-12 w-auto" loading="lazy">
                        <span class="text-2xl font-bold text-gradient">EgySyr</span>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                        Leading technology company delivering innovative solutions including advanced software development, 
                        AI implementation, and customized technology consulting services to help businesses thrive in the digital age.
                    </p>
                    
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=61551238234574" 
                           class="social-link group" 
                           aria-label="Facebook"
                           target="_blank" 
                           rel="noopener noreferrer">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/egysyr_tech" 
                           class="social-link group" 
                           aria-label="Instagram"
                           target="_blank" 
                           rel="noopener noreferrer">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" 
                           class="social-link group" 
                           aria-label="LinkedIn"
                           target="_blank" 
                           rel="noopener noreferrer">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" 
                           class="social-link group" 
                           aria-label="WhatsApp"
                           target="_blank" 
                           rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:info@egysyr.com" 
                           class="social-link group" 
                           aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-white font-semibold text-lg mb-6 relative">
                        Quick Links
                        <span class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></span>
                    </h3>
                    <nav class="space-y-3">
                        <a href="{{ route('welcome') }}" class="footer-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                        <a href="{{ route('services') }}" class="footer-link {{ request()->is('services*') ? 'active' : '' }}">
                            <i class="fas fa-cogs mr-2"></i>Services
                        </a>
                        <a href="{{ route('blog') }}" class="footer-link {{ request()->is('blog*') ? 'active' : '' }}">
                            <i class="fas fa-blog mr-2"></i>Blog
                        </a>
                        <a href="{{ route('about') }}" class="footer-link {{ request()->is('about') ? 'active' : '' }}">
                            <i class="fas fa-users mr-2"></i>About Us
                        </a>
                        <a href="{{ route('contact') }}" class="footer-link {{ request()->is('contact') ? 'active' : '' }}">
                            <i class="fas fa-envelope mr-2"></i>Contact Us
                        </a>
                    </nav>
                </div>

                <!-- Services Links -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-white font-semibold text-lg mb-6 relative">
                        Our Services
                        <span class="absolute bottom-0 left-0 w-12 h-0.5 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></span>
                    </h3>
                    <nav class="space-y-3">
                        <a href="{{ route('services.web') }}" class="footer-link">
                            <i class="fas fa-globe mr-2"></i>Web Development
                        </a>
                        <a href="{{ route('services.application') }}" class="footer-link">
                            <i class="fas fa-mobile-alt mr-2"></i>App Development
                        </a>
                        <a href="{{ route('services.system') }}" class="footer-link">
                            <i class="fas fa-server mr-2"></i>System Solutions
                        </a>
                        <a href="{{ route('services.hosting') }}" class="footer-link">
                            <i class="fas fa-cloud mr-2"></i>Hosting Services
                        </a>
                        <a href="{{ route('services.graphic') }}" class="footer-link">
                            <i class="fas fa-paint-brush mr-2"></i>Graphic Design
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Legal Links -->
            <div class="border-t border-gray-700 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex flex-wrap gap-6 text-sm">
                        <a href="{{ route('policy') }}" class="footer-legal-link">Privacy Policy</a>
                        <a href="{{ route('maintenance.policy') }}" class="footer-legal-link">Maintenance Policy</a>
                        <a href="{{ route('data.security') }}" class="footer-legal-link">Data Security</a>
                    </div>
                    <div class="text-sm text-gray-400">
                        © {{ date('Y') }} EgySyr Technology. All rights reserved.
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center" data-aos="fade-up">
                    <h3 class="text-white font-semibold text-lg mb-4">Stay Updated</h3>
                    <p class="text-gray-300 mb-6 max-w-md mx-auto">
                        Subscribe to our newsletter for the latest updates on technology trends and our services.
                    </p>
                    <div class="max-w-md mx-auto flex">
                        <input type="email" 
                               placeholder="Enter your email" 
                               class="flex-1 px-4 py-3 bg-gray-800 border border-gray-600 rounded-l-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        <button type="submit" 
                                class="px-6 py-3 gradient-primary text-white font-medium rounded-r-lg hover:opacity-90 transition-opacity">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .social-link {
        @apply w-10 h-10 bg-gray-800 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 rounded-lg flex items-center justify-center text-white transition-all duration-300 transform hover:scale-110;
    }
    
    .footer-link {
        @apply block text-gray-300 hover:text-white transition-colors duration-200 flex items-center;
    }
    
    .footer-link.active {
        @apply text-white;
    }
    
    .footer-legal-link {
        @apply text-gray-400 hover:text-white transition-colors duration-200;
    }
</style>