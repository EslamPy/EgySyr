import './bootstrap';

// DOM Elements
const navbar = document.getElementById('navbar');
const scrollIndicator = document.getElementById('scrollIndicator');
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const mobileMenu = document.querySelector('.mobile-menu');
const navLinks = document.querySelectorAll('.nav-link');

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAnimations();
    initializeScrollEffects();
    initializeNavigation();
    initializeInteractiveElements();
    createParticleBackground();
    initializeIntersectionObserver();
    
    // Add loading state management
    handlePageLoad();
});

// Page Load Animation
function handlePageLoad() {
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
        setTimeout(() => {
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.remove();
            }, 500);
        }, 1000);
    }
}

// Initialize GSAP Animations
function initializeAnimations() {
    // Register GSAP plugins
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        
        // Hero section entrance animation
        const heroTimeline = gsap.timeline();
        heroTimeline
            .from('.hero-title', { 
                duration: 1.2, 
                y: 100, 
                opacity: 0, 
                ease: 'power3.out',
                stagger: 0.2
            })
            .from('.hero-subtitle', { 
                duration: 1, 
                y: 50, 
                opacity: 0, 
                ease: 'power3.out' 
            }, '-=0.5')
            .from('.hero-buttons', { 
                duration: 1, 
                y: 30, 
                opacity: 0, 
                ease: 'power3.out' 
            }, '-=0.3');

        // Floating elements animation
        gsap.utils.toArray('.floating-animation').forEach((element, index) => {
            gsap.to(element, {
                y: -30,
                duration: 2 + (index * 0.5),
                ease: 'power1.inOut',
                repeat: -1,
                yoyo: true,
                delay: index * 0.5
            });
        });

        // Section reveal animations
        gsap.utils.toArray('section').forEach((section, index) => {
            const elements = section.querySelectorAll('.glass-effect, .hover-lift, h2, h3, p');
            
            gsap.fromTo(elements, 
                { 
                    opacity: 0, 
                    y: 60,
                    scale: 0.9
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1,
                    ease: 'power3.out',
                    stagger: 0.1,
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 80%',
                        end: 'bottom 20%',
                        toggleActions: 'play none none reverse'
                    }
                }
            );
        });

        // Parallax scrolling effects
        gsap.utils.toArray('.parallax-element').forEach(element => {
            gsap.to(element, {
                yPercent: -50,
                ease: "none",
                scrollTrigger: {
                    trigger: element,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });

        // Text reveal animation
        gsap.utils.toArray('.text-reveal').forEach(element => {
            gsap.fromTo(element,
                { opacity: 0, y: 20 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 90%',
                        toggleActions: 'play none none reverse'
                    }
                }
            );
        });
    }
}

// Scroll Effects
function initializeScrollEffects() {
    let lastScrollTop = 0;
    let scrollTimeout;

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Update scroll progress indicator
        updateScrollProgress();
        
        // Navbar effects
        updateNavbarState(scrollTop);
        
        // Parallax effects for floating elements
        updateParallaxElements(scrollTop);
        
        // Update active navigation section
        updateActiveNavSection();
        
        // Debounced scroll end detection
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            onScrollEnd();
        }, 150);
        
        lastScrollTop = scrollTop;
    });
}

// Update scroll progress indicator
function updateScrollProgress() {
    if (scrollIndicator) {
        const scrollTop = document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollPercentage = (scrollTop / scrollHeight) * 100;
        scrollIndicator.style.width = scrollPercentage + '%';
    }
}

// Update navbar state based on scroll
function updateNavbarState(scrollTop) {
    if (navbar) {
        if (scrollTop > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
}

// Parallax effects for floating elements
function updateParallaxElements(scrollTop) {
    const floatingElements = document.querySelectorAll('.floating-animation');
    floatingElements.forEach((element, index) => {
        const speed = 0.5 + (index * 0.1);
        const yPos = -(scrollTop * speed);
        element.style.transform = `translateY(${yPos}px)`;
    });
}

// Update active navigation section
function updateActiveNavSection() {
    const sections = ['home', 'about', 'services', 'blog', 'contact'];
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
        link.classList.remove('text-purple-600', 'active');
        link.classList.add('text-gray-700');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.remove('text-gray-700');
            link.classList.add('text-purple-600', 'active');
        }
    });
}

// Scroll end callback
function onScrollEnd() {
    // Add any actions that should happen when scrolling stops
    document.body.classList.remove('scrolling');
}

// Navigation functionality
function initializeNavigation() {
    // Mobile menu toggle
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            // Animate hamburger menu
            const icon = mobileMenuBtn.querySelector('svg');
            if (icon) {
                icon.style.transform = mobileMenu.classList.contains('hidden') ? 
                    'rotate(0deg)' : 'rotate(180deg)';
            }
        });
    }

    // Smooth scroll for navigation links
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80;
                
                // Smooth scroll with custom easing
                smoothScrollTo(offsetTop, 1000);
                
                // Close mobile menu if open
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
                
                // Add active state animation
                link.classList.add('clicked');
                setTimeout(() => {
                    link.classList.remove('clicked');
                }, 300);
            }
        });
    });
}

// Custom smooth scroll function
function smoothScrollTo(targetPosition, duration) {
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    // Easing function for smooth animation
    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

// Interactive Elements
function initializeInteractiveElements() {
    // Enhanced hover effects for cards
    const hoverElements = document.querySelectorAll('.hover-lift');
    hoverElements.forEach(element => {
        element.addEventListener('mouseenter', (e) => {
            createRippleEffect(e);
            addGlowEffect(element);
        });
        
        element.addEventListener('mouseleave', () => {
            removeGlowEffect(element);
        });
        
        // 3D tilt effect
        element.addEventListener('mousemove', (e) => {
            add3DTiltEffect(element, e);
        });
        
        element.addEventListener('mouseleave', () => {
            remove3DTiltEffect(element);
        });
    });

    // Button click animations
    const buttons = document.querySelectorAll('button, .btn-gradient');
    buttons.forEach(button => {
        button.addEventListener('click', (e) => {
            createClickAnimation(e);
        });
    });

    // Form enhancements
    const formInputs = document.querySelectorAll('input, textarea');
    formInputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('focused');
        });
    });
}

// Create ripple effect on hover
function createRippleEffect(e) {
    const button = e.currentTarget;
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    button.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// Add glow effect
function addGlowEffect(element) {
    element.style.boxShadow = '0 0 30px rgba(102, 126, 234, 0.3)';
}

// Remove glow effect
function removeGlowEffect(element) {
    element.style.boxShadow = '';
}

// 3D Tilt Effect
function add3DTiltEffect(element, e) {
    const rect = element.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    const rotateX = (y - centerY) / 10;
    const rotateY = (centerX - x) / 10;
    
    element.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(10px)`;
}

// Remove 3D tilt effect
function remove3DTiltEffect(element) {
    element.style.transform = '';
}

// Click animation
function createClickAnimation(e) {
    const button = e.currentTarget;
    button.style.transform = 'scale(0.95)';
    setTimeout(() => {
        button.style.transform = '';
    }, 150);
}

// Particle Background
function createParticleBackground() {
    const particleContainers = document.querySelectorAll('.particle-bg');
    
    particleContainers.forEach(container => {
        for (let i = 0; i < 20; i++) {
            createParticle(container);
        }
    });
}

function createParticle(container) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    
    const size = Math.random() * 4 + 2;
    particle.style.width = size + 'px';
    particle.style.height = size + 'px';
    particle.style.left = Math.random() * 100 + '%';
    particle.style.animationDelay = Math.random() * 6 + 's';
    particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
    
    container.appendChild(particle);
    
    // Remove particle when animation ends and create a new one
    particle.addEventListener('animationend', () => {
        particle.remove();
        createParticle(container);
    });
}

// Intersection Observer for enhanced animations
function initializeIntersectionObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.glass-effect, .hover-lift, .gradient-text');
    animatedElements.forEach(element => {
        observer.observe(element);
    });
}

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Performance monitoring
function monitorPerformance() {
    if ('performance' in window) {
        window.addEventListener('load', () => {
            const perfData = performance.getEntriesByType('navigation')[0];
            console.log('Page load time:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
        });
    }
}

// Initialize performance monitoring
monitorPerformance();

// Error handling
window.addEventListener('error', (e) => {
    console.error('JavaScript error:', e.error);
});

// Accessibility enhancements
function enhanceAccessibility() {
    // Add keyboard navigation support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });

    document.addEventListener('mousedown', () => {
        document.body.classList.remove('keyboard-navigation');
    });

    // Respect prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.body.classList.add('reduce-motion');
    }
}

// Initialize accessibility features
enhanceAccessibility();

// Export functions for external use
export {
    smoothScrollTo,
    createRippleEffect,
    debounce,
    throttle
};
