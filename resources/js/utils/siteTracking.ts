interface TrackingData {
  page_url: string
  referrer?: string
  session_duration?: number
}

class SiteTracker {
  private sessionStart: number
  private lastPageUrl: string
  private isTracking: boolean

  constructor() {
    this.sessionStart = Date.now()
    this.lastPageUrl = window.location.href
    this.isTracking = false
    this.init()
  }

  private init() {
    // Track initial page load asynchronously to not block app startup
    setTimeout(() => {
      this.trackPageView()
    }, 1000) // Delay initial tracking by 1 second

    // Track page changes (for SPA navigation)
    window.addEventListener('popstate', () => {
      this.trackPageView()
    })

    // Track when user leaves the page
    window.addEventListener('beforeunload', () => {
      this.trackSessionEnd()
    })

    // Track visibility changes (tab switching)
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        this.trackSessionEnd()
      } else {
        this.sessionStart = Date.now()
      }
    })
  }

  private async trackPageView() {
    if (this.isTracking) return

    this.isTracking = true

    try {
      const trackingData: TrackingData = {
        page_url: window.location.href,
        referrer: document.referrer || undefined,
      }

      // Use a timeout to prevent blocking the app
      const controller = new AbortController()
      const timeoutId = setTimeout(() => controller.abort(), 5000) // 5 second timeout

      // Get CSRF token
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

      await fetch('/api/track-visit', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          ...(csrfToken && { 'X-CSRF-TOKEN': csrfToken }),
        },
        body: JSON.stringify(trackingData),
        signal: controller.signal,
      })

      clearTimeout(timeoutId)
      this.lastPageUrl = window.location.href
      this.sessionStart = Date.now()
    } catch (error) {
      // Silently fail - don't block the app
      console.warn('Failed to track page view:', error)
    } finally {
      this.isTracking = false
    }
  }

  private async trackSessionEnd() {
    if (this.isTracking) return

    const sessionDuration = Math.floor((Date.now() - this.sessionStart) / 1000)

    if (sessionDuration < 5) return // Ignore very short sessions

    try {
      const trackingData: TrackingData = {
        page_url: this.lastPageUrl,
        session_duration: sessionDuration,
      }

      // Use sendBeacon for reliable tracking on page unload
      if (navigator.sendBeacon) {
        const blob = new Blob([JSON.stringify(trackingData)], {
          type: 'application/json',
        })
        navigator.sendBeacon('/api/track-visit', blob)
      } else {
        // Fallback for browsers without sendBeacon
        await fetch('/api/track-visit', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify(trackingData),
          keepalive: true,
        })
      }
    } catch (error) {
      console.warn('Failed to track session end:', error)
    }
  }

  public trackCustomEvent(_eventData: Partial<TrackingData>) {
    this.trackPageView()
  }

  public updatePageUrl(url: string) {
    if (url !== this.lastPageUrl) {
      this.trackSessionEnd()
      this.lastPageUrl = url
      this.trackPageView()
    }
  }
}

// Create a singleton instance
let tracker: SiteTracker | null = null

export const initSiteTracking = () => {
  if (!tracker && typeof window !== 'undefined') {
    tracker = new SiteTracker()
  }
  return tracker
}

export const trackPageChange = (url: string) => {
  if (tracker) {
    tracker.updatePageUrl(url)
  }
}

export const trackCustomEvent = (eventData: Partial<TrackingData>) => {
  if (tracker) {
    tracker.trackCustomEvent(eventData)
  }
}

// Auto-initialize when module is imported in browser
if (typeof window !== 'undefined') {
  initSiteTracking()
}
