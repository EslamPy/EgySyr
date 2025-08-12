import { useEffect, useRef, useCallback } from 'react'
import Lenis from '@studio-freight/lenis'

export const useSmoothScroll = () => {
  const lenisRef = useRef<Lenis | null>(null)
  const rafRef = useRef<number | null>(null)

  const initSmoothScroll = useCallback(() => {
    if (typeof window === 'undefined' || lenisRef.current) return

    try {
      // Create Lenis instance with ultra-smooth 144Hz+ optimized settings
      lenisRef.current = new Lenis({
        duration: 0.8, // Faster, more responsive for high refresh rates
        easing: (t: number) => 1 - Math.pow(1 - t, 4), // Ultra-smooth easing curve for high refresh rates
        lerp: 0.06, // Faster interpolation for 144Hz+ displays - ultra-smooth
        wheelMultiplier: 0.5, // Ultra-smooth wheel scrolling
        touchMultiplier: 1.2, // Optimized touch sensitivity
      })

      // Ultra-smooth animation loop optimized for 144Hz+ displays
      const raf = (time: number) => {
        lenisRef.current?.raf(time)
        // Use requestAnimationFrame for maximum smoothness
        rafRef.current = requestAnimationFrame(raf)
      }

      // Start the ultra-smooth animation loop
      rafRef.current = requestAnimationFrame(raf)

      // Additional performance optimizations
      if (typeof window !== 'undefined') {
        // Enable hardware acceleration on the body
        document.body.style.willChange = 'transform'
        document.body.style.transform = 'translateZ(0)'

        // Optimize for high refresh rate displays
        const mediaQuery = window.matchMedia('(min-resolution: 120dpi)')
        if (mediaQuery.matches) {
          // Additional optimizations for high-DPI displays
          document.documentElement.style.transform = 'translate3d(0, 0, 0)'
        }
      }

      // Reset body styles properly
      document.body.style.overflow = ''
      document.documentElement.style.overflow = ''

      // Prevent scroll restoration
      if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual'
      }

      console.log('Lenis smooth scroll initialized successfully')
    } catch (error) {
      console.warn('Lenis initialization failed, falling back to native scroll:', error)
      // Fallback to native smooth scroll
      document.documentElement.style.scrollBehavior = 'smooth'
    }
  }, [])

  const scrollTo = useCallback((target: string | number, options?: any) => {
    lenisRef.current?.scrollTo(target, {
      duration: 1.2,
      easing: (t: number) => 1 - Math.pow(1 - t, 3),
      ...options
    })
  }, [])

  const destroy = useCallback(() => {
    if (rafRef.current) {
      cancelAnimationFrame(rafRef.current)
      rafRef.current = null
    }
    lenisRef.current?.destroy()
    lenisRef.current = null

    // Reset body styles
    document.body.style.overflow = ''
    document.documentElement.style.overflow = ''
  }, [])

  useEffect(() => {
    return () => {
      destroy()
    }
  }, [destroy])

  return {
    initSmoothScroll,
    scrollTo,
    destroy,
    lenis: lenisRef.current,
  }
}