import './bootstrap';

// Lazy load heavy libraries only when needed
const loadSplide = () => import('./splide.min.js');
const loadJQuery = () => import('./jquery-3.6.1.min.js');

// Performance-optimized initialization
document.addEventListener('DOMContentLoaded', function() {
    // Initialize critical functionality immediately
    initializeNavigation();
    initializeLazyLoading();
    
    // Load heavy libraries only when needed
    const splideElements = document.querySelectorAll('.splide');
    if (splideElements.length > 0) {
        loadSplide().then(() => {
            // Initialize Splide components
            splideElements.forEach(element => {
                new Splide(element).mount();
            });
        });
    }
    
    // Load jQuery-dependent features on user interaction
    const jqueryTriggers = document.querySelectorAll('.i_menu, .menu');
    if (jqueryTriggers.length > 0) {
        let jqueryLoaded = false;
        jqueryTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                if (!jqueryLoaded) {
                    loadJQuery().then(() => {
                        import('./index.js');
                        jqueryLoaded = true;
                    });
                }
            });
        });
    }
});

// Critical functions that need to run immediately
function initializeNavigation() {
    // Mobile menu toggle without jQuery
    const menuToggle = document.querySelector('.i_menu');
    const menu = document.querySelector('.menu');
    
    if (menuToggle && menu) {
        menuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            menu.classList.remove('hid');
            menu.classList.add('s');
        });
        
        menu.addEventListener('click', (e) => {
            e.preventDefault();
            menu.classList.remove('s');
            menu.classList.add('hid');
        });
    }
}

function initializeLazyLoading() {
    // Intersection Observer for lazy loading images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
    
    // Lazy load counter animations
    const counters = document.querySelectorAll('.num');
    const counterSection = document.querySelector('.conters');
    
    if (counters.length > 0 && counterSection) {
        let counterStarted = false;
        
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !counterStarted) {
                    counters.forEach(counter => startCount(counter));
                    counterStarted = true;
                }
            });
        }, { threshold: 0.5 });
        
        counterObserver.observe(counterSection);
    }
}

function startCount(el) {
    const goal = parseInt(el.dataset.goal);
    const symbol = el.dataset.symbol || "";
    let count = 0;
    const speed = Math.max(1, 1500 / goal);
    
    const counter = setInterval(() => {
        count++;
        el.textContent = count;
        
        if (count >= goal) {
            clearInterval(counter);
            el.textContent = goal + symbol;
        }
    }, speed);
}
