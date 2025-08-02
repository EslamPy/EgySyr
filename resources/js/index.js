// Performance optimized JavaScript for EgySyr website

// Lazy loading for images
document.addEventListener('DOMContentLoaded', function() {
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
});

// Debounce function for performance
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

// Optimized counter animation
let nums = document.querySelectorAll(".num");
let contersSection = document.querySelector(".conters");
let started = false;

function startCount(el) {
    let goal = parseInt(el.dataset.goal);
    let symbol = el.dataset.symbol || "";
    let count = 0;
    let speed = 1500 / goal;

    let counter = setInterval(() => {
        count++;
        el.textContent = count;

        if (count >= goal) {
            clearInterval(counter);
            el.textContent = goal + symbol;
        }
    }, speed);
}

// Debounced scroll handler
const debouncedScrollHandler = debounce(function() {
    if (window.scrollY >= contersSection.offsetTop - window.innerHeight + 200) {
        if (!started) {
            nums.forEach(num => startCount(num));
            started = true;
        }
    }
}, 100);

window.addEventListener("scroll", debouncedScrollHandler);

// Mobile menu functionality
let menu = document.querySelector(".menu");
let min_menu = document.querySelector(".min_menu");

if (menu && min_menu) {
    $(".i_menu").click(function(){
        $(".menu").removeClass("hid");
        $(".menu").addClass("s");   
    });

    $(".menu").click(function(){
        $(".menu").removeClass("s");
        $(".menu").addClass("hid");   
    });
}

// Video background optimization (only for desktop)
if (!/Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
    const video = document.getElementById("myVideo");
    if (video) {
        let reverse = false;
        let interval;

        function playReverse() {
            clearInterval(interval);
            interval = setInterval(() => {
                if (video.currentTime <= 0) {
                    clearInterval(interval);
                    reverse = false;
                    video.play();
                } else {
                    video.currentTime -= 0.1;
                }
            }, 100);
        }

        video.addEventListener("ended", function () {
            if (!reverse) {
                reverse = true;
                playReverse();
            } else {
                video.currentTime = 0;
                video.play();
                reverse = false;
            }
        });
    }

    // Custom cursor (only for desktop)
    const cursor = document.querySelector('.cursor');
    if (cursor) {
        let mouseX = 0, mouseY = 0;
        let currentX = 0, currentY = 0;
        let isHovering = false;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function animate() {
            currentX += (mouseX - currentX) * 0.1;
            currentY += (mouseY - currentY) * 0.1;
            
            cursor.style.left = currentX + 'px';
            cursor.style.top = currentY + 'px';
            
            requestAnimationFrame(animate);
        }
        animate();

        // Hover effects
        document.querySelectorAll('a, button, .card, .btn-primary').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.classList.add('active');
                isHovering = true;
            });
            
            el.addEventListener('mouseleave', () => {
                cursor.classList.remove('active');
                isHovering = false;
            });
        });
    }
}

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
document.querySelectorAll('.group, .stat-card, .chart-container, [data-aos]').forEach(el => {
    observer.observe(el);
});

// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });
    
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}

// Export for use in other modules
window.debounce = debounce;