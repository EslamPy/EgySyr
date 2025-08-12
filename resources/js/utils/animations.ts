import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { TextPlugin } from 'gsap/TextPlugin';

gsap.registerPlugin(ScrollTrigger, TextPlugin);

export const initializeGSAP = () => {
  // Set default ease
  gsap.defaults({ ease: "power2.out", duration: 1 });

  // Configure ScrollTrigger for better performance
  ScrollTrigger.config({
    autoRefreshEvents: "visibilitychange,DOMContentLoaded,load"
  });

  // Refresh ScrollTrigger on window resize with debouncing
  let resizeTimeout: number;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = window.setTimeout(() => {
      ScrollTrigger.refresh();
    }, 250);
  });
};

export const animationUtils = {
  // Text splitting animation
  splitText: (element: HTMLElement, delay = 0) => {
    const text = element.textContent || '';
    const chars = text.split('');
    
    element.innerHTML = chars
      .map((char) => `<span class="char" style="display: inline-block;">${char === ' ' ? '&nbsp;' : char}</span>`)
      .join('');
    
    const charElements = element.querySelectorAll('.char');
    
    gsap.fromTo(charElements, 
      { 
        y: 100, 
        opacity: 0,
        rotationX: -90,
      },
      {
        y: 0,
        opacity: 1,
        rotationX: 0,
        duration: 0.8,
        stagger: 0.02,
        delay,
        ease: "back.out(1.7)",
      }
    );
  },

  // Reveal animation with scroll trigger
  revealOnScroll: (element: HTMLElement, direction = 'up') => {
    const directions = {
      up: { y: 100 },
      down: { y: -100 },
      left: { x: 100 },
      right: { x: -100 },
    };

    gsap.fromTo(element,
      {
        ...directions[direction as keyof typeof directions],
        opacity: 0,
      },
      {
        x: 0,
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
          trigger: element,
          start: "top 80%",
          end: "bottom 20%",
          toggleActions: "play none none reverse",
        },
      }
    );
  },

  // Floating animation
  float: (element: HTMLElement, intensity = 20, duration = 4) => {
    gsap.to(element, {
      y: -intensity,
      duration: duration / 2,
      ease: "power2.inOut",
      yoyo: true,
      repeat: -1,
    });
  },

  // Magnetic hover effect
  magneticHover: (element: HTMLElement, strength = 0.3) => {
    const handleMouseMove = (e: MouseEvent) => {
      const rect = element.getBoundingClientRect();
      const centerX = rect.left + rect.width / 2;
      const centerY = rect.top + rect.height / 2;
      
      const deltaX = (e.clientX - centerX) * strength;
      const deltaY = (e.clientY - centerY) * strength;

      gsap.to(element, {
        x: deltaX,
        y: deltaY,
        duration: 0.3,
        ease: "power2.out",
      });
    };

    const handleMouseLeave = () => {
      gsap.to(element, {
        x: 0,
        y: 0,
        duration: 0.5,
        ease: "elastic.out(1, 0.3)",
      });
    };

    element.addEventListener('mousemove', handleMouseMove);
    element.addEventListener('mouseleave', handleMouseLeave);

    return () => {
      element.removeEventListener('mousemove', handleMouseMove);
      element.removeEventListener('mouseleave', handleMouseLeave);
    };
  },

  // Parallax effect
  parallax: (element: HTMLElement, speed = 0.5) => {
    gsap.to(element, {
      yPercent: -50 * speed,
      ease: "none",
      scrollTrigger: {
        trigger: element,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    });
  },

  // Stagger animation for multiple elements
  staggerIn: (elements: NodeListOf<Element> | Element[], delay = 0.1) => {
    gsap.fromTo(elements,
      {
        y: 60,
        opacity: 0,
        scale: 0.8,
      },
      {
        y: 0,
        opacity: 1,
        scale: 1,
        duration: 0.8,
        stagger: delay,
        ease: "back.out(1.7)",
      }
    );
  },

  // Morphing shape animation
  morphShape: (element: HTMLElement) => {
    const tl = gsap.timeline({ repeat: -1, yoyo: true });
    
    tl.to(element, {
      borderRadius: "60% 40% 30% 70% / 60% 30% 70% 40%",
      duration: 2,
      ease: "power2.inOut",
    })
    .to(element, {
      borderRadius: "30% 60% 70% 40% / 50% 60% 30% 60%",
      duration: 2,
      ease: "power2.inOut",
    });
  },

  // Counter animation
  animateCounter: (element: HTMLElement, target: number, duration = 2) => {
    const obj = { value: 0 };
    
    gsap.to(obj, {
      value: target,
      duration,
      ease: "power2.out",
      onUpdate: () => {
        element.textContent = Math.round(obj.value).toString();
      },
    });
  },
};

// Initialize scroll-triggered animations
export const initScrollAnimations = () => {
  // Text reveal animation
  gsap.utils.toArray('.text-reveal').forEach((element: any) => {
    gsap.fromTo(element,
      { y: 100, opacity: 0 },
      {
        y: 0,
        opacity: 1,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
          trigger: element,
          start: "top 80%",
          end: "bottom 20%",
          toggleActions: "play none none reverse"
        }
      }
    );
  });

  // Fade in animation
  gsap.utils.toArray('.fade-in').forEach((element: any) => {
    gsap.fromTo(element,
      { opacity: 0, y: 50 },
      {
        opacity: 1,
        y: 0,
        duration: 1.2,
        ease: "power2.out",
        scrollTrigger: {
          trigger: element,
          start: "top 85%",
          toggleActions: "play none none reverse"
        }
      }
    );
  });

  // Scale animation
  gsap.utils.toArray('.scale-in').forEach((element: any) => {
    gsap.fromTo(element,
      { scale: 0.8, opacity: 0 },
      {
        scale: 1,
        opacity: 1,
        duration: 1,
        ease: "back.out(1.7)",
        scrollTrigger: {
          trigger: element,
          start: "top 80%",
          toggleActions: "play none none reverse"
        }
      }
    );
  });

  // Parallax effect
  gsap.utils.toArray('.parallax').forEach((element: any) => {
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
};
