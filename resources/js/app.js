import './bootstrap';

// Performance-optimized main application JavaScript
class EgySyrApp {
    constructor() {
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.setupLazyLoading();
        this.setupIntersectionObserver();
        this.setupSmoothScrolling();
        this.setupFormOptimizations();
        this.setupPerformanceOptimizations();
        this.setupImageOptimizations();
    }

    // Lazy loading for images and content
    setupLazyLoading() {
        // Native lazy loading support check
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                }, { once: true });
            });
        } else {
            // Fallback for browsers without native lazy loading
            this.polyfillLazyLoading();
        }
    }

    polyfillLazyLoading() {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Intersection Observer for animations
    setupIntersectionObserver() {
        if (!window.IntersectionObserver) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe elements with fade-in class
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    }

    // Optimized smooth scrolling
    setupSmoothScrolling() {
        // Use passive listeners for better performance
        document.addEventListener('click', (e) => {
            const anchor = e.target.closest('a[href^="#"]');
            if (!anchor) return;

            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            
            if (target) {
                this.smoothScrollTo(target);
            }
        }, { passive: false });
    }

    smoothScrollTo(element) {
        const start = window.pageYOffset;
        const targetPosition = element.offsetTop - 80; // Account for fixed navbar
        const distance = targetPosition - start;
        const duration = Math.min(Math.abs(distance) / 2, 1000); // Max 1 second
        let startTime = null;

        const animation = (currentTime) => {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            
            // Easing function
            const ease = progress * (2 - progress);
            
            window.scrollTo(0, start + (distance * ease));
            
            if (timeElapsed < duration) {
                requestAnimationFrame(animation);
            }
        };

        requestAnimationFrame(animation);
    }

    // Form optimizations
    setupFormOptimizations() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            // Debounced validation
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                let timeout;
                input.addEventListener('input', () => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        this.validateField(input);
                    }, 300);
                });
            });

            // Prevent double submission
            form.addEventListener('submit', (e) => {
                if (form.dataset.submitting === 'true') {
                    e.preventDefault();
                    return;
                }
                form.dataset.submitting = 'true';
                
                // Re-enable after 3 seconds as fallback
                setTimeout(() => {
                    form.dataset.submitting = 'false';
                }, 3000);
            });
        });
    }

    validateField(field) {
        // Basic validation - extend as needed
        const value = field.value.trim();
        const type = field.type;
        
        let isValid = true;
        let message = '';

        if (field.required && !value) {
            isValid = false;
            message = 'This field is required';
        } else if (type === 'email' && value && !this.isValidEmail(value)) {
            isValid = false;
            message = 'Please enter a valid email address';
        }

        this.updateFieldValidation(field, isValid, message);
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    updateFieldValidation(field, isValid, message) {
        const errorElement = field.parentNode.querySelector('.error-message');
        
        if (isValid) {
            field.classList.remove('error');
            if (errorElement) errorElement.remove();
        } else {
            field.classList.add('error');
            if (!errorElement) {
                const error = document.createElement('div');
                error.className = 'error-message text-red-500 text-sm mt-1';
                error.textContent = message;
                field.parentNode.appendChild(error);
            } else {
                errorElement.textContent = message;
            }
        }
    }

    // Performance optimizations
    setupPerformanceOptimizations() {
        // Preload critical resources
        this.preloadCriticalResources();
        
        // Setup resource hints
        this.setupResourceHints();
        
        // Optimize event listeners
        this.setupEfficientEventListeners();
        
        // Memory management
        this.setupMemoryManagement();
    }

    preloadCriticalResources() {
        const criticalImages = document.querySelectorAll('img[data-critical]');
        criticalImages.forEach(img => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = img.src || img.dataset.src;
            document.head.appendChild(link);
        });
    }

    setupResourceHints() {
        // Add dns-prefetch for external domains
        const externalDomains = [
            'fonts.googleapis.com',
            'fonts.gstatic.com',
            'cdnjs.cloudflare.com'
        ];

        externalDomains.forEach(domain => {
            const link = document.createElement('link');
            link.rel = 'dns-prefetch';
            link.href = `//${domain}`;
            document.head.appendChild(link);
        });
    }

    setupEfficientEventListeners() {
        // Use delegation for hover effects
        document.addEventListener('mouseover', this.handleHover.bind(this), { passive: true });
        document.addEventListener('mouseout', this.handleHoverOut.bind(this), { passive: true });
        
        // Throttled scroll listener
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            if (!scrollTimeout) {
                scrollTimeout = setTimeout(() => {
                    this.handleScroll();
                    scrollTimeout = null;
                }, 16); // ~60fps
            }
        }, { passive: true });

        // Throttled resize listener
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                this.handleResize();
            }, 250);
        }, { passive: true });
    }

    handleHover(e) {
        const hoverElement = e.target.closest('.hover-scale, .hover-lift');
        if (hoverElement) {
            hoverElement.style.willChange = 'transform';
        }
    }

    handleHoverOut(e) {
        const hoverElement = e.target.closest('.hover-scale, .hover-lift');
        if (hoverElement) {
            // Delay removing will-change to allow animation to complete
            setTimeout(() => {
                hoverElement.style.willChange = 'auto';
            }, 300);
        }
    }

    handleScroll() {
        // Navbar background change on scroll
        const navbar = document.getElementById('navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        }
    }

    handleResize() {
        // Handle responsive changes
        this.updateViewportHeight();
    }

    updateViewportHeight() {
        // Fix mobile viewport height issues
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }

    setupImageOptimizations() {
        // WebP support detection
        this.detectWebPSupport();
        
        // Responsive image loading
        this.setupResponsiveImages();
    }

    detectWebPSupport() {
        const webP = new Image();
        webP.onload = webP.onerror = () => {
            document.documentElement.classList.add(
                webP.height === 2 ? 'webp' : 'no-webp'
            );
        };
        webP.src = 'data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';
    }

    setupResponsiveImages() {
        const images = document.querySelectorAll('img[data-sizes]');
        images.forEach(img => {
            if (window.matchMedia && img.dataset.sizes) {
                const sizes = JSON.parse(img.dataset.sizes);
                Object.keys(sizes).forEach(breakpoint => {
                    if (window.matchMedia(breakpoint).matches) {
                        img.src = sizes[breakpoint];
                    }
                });
            }
        });
    }

    setupMemoryManagement() {
        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            // Cancel any pending timeouts/intervals
            // Remove event listeners if needed
            // Clear any large objects from memory
        });
    }
}

// Initialize the application
const app = new EgySyrApp();

// Export for potential external use
window.EgySyrApp = app;
