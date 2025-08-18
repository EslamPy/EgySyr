import React, { useEffect } from 'react'
import { Router, Route, Switch, useLocation } from 'wouter'
import { motion, AnimatePresence } from 'framer-motion'
import { useSmoothScroll } from './hooks/useSmoothScroll.tsx'
import { useCursor } from './hooks/useCursor.tsx'
import { initSiteTracking, trackPageChange } from './utils/siteTracking'

// Components
import Navigation from './components/Navigation.tsx'
import PageTransition from './components/PageTransition.tsx'

// Pages
import HomePage from './pages/HomePage.tsx'
import ServicesPage from './pages/ServicesPage.tsx'
import BlogPage from './pages/BlogPage.tsx'
import AboutPage from './pages/AboutPage.tsx'
import ContactPage from './pages/ContactPage.tsx'
import { AdminLogin, AdminRegister, AdminDashboard, AdminFeedback, AdminMessages, AdminJobs, AdminJobApplications, AdminUsers, AdminAnalytics, AdminSettings } from './admin'
import AuthGuard from './admin/components/AuthGuard'
import CareersPage from './pages/CareersPage.tsx'
import JobDetailPage from './pages/JobDetailPage'
import JobApplicationPage from './pages/JobApplicationPage'
import FeedbackFormPage from './pages/FeedbackFormPage'
import ThankYouPage from './pages/ThankYouPage'
import PrivacyPolicyPage from './pages/PrivacyPolicyPage.tsx'
import TermsOfServicePage from './pages/TermsOfServicePage.tsx'


// Global animations and effects
import { initializeGSAP, initScrollAnimations } from './utils/animations.ts'

const App: React.FC = () => {
  console.log('App component rendering...')

  const { initSmoothScroll, scrollTo, lenis } = useSmoothScroll()
  const { initCursor } = useCursor()
  const [location] = useLocation()
  const showGlobalNav = !location.startsWith('/admin')

  console.log('Current location:', location)

  useEffect(() => {
    // Simplified initialization for debugging
    document.documentElement.classList.add('dark')
    document.body.style.backgroundColor = '#0A0A0A'

    // Initialize complex features after a delay to prevent blocking
    setTimeout(() => {
      try {
        initializeGSAP()
        const cursorCleanup = initCursor()
        initSmoothScroll()
        setTimeout(() => { initScrollAnimations() }, 300)
      } catch (error) {
        console.error('Error initializing features:', error)
      }
    }, 100)
    const fonts = [
      'Space Grotesk:wght@300;400;500;600;700',
      'Inter:wght@300;400;500;600;700',
      'Sora:wght@300;400;500;600;700'
    ]
    fonts.forEach(font => {
      const link = document.createElement('link')
      link.href = `https://fonts.googleapis.com/css2?family=${font}&display=swap`
      link.rel = 'stylesheet'
      document.head.appendChild(link)
    })
    // No cleanup needed for now - variables are scoped locally
  }, [initSmoothScroll, initCursor])

  console.log('App component about to render JSX...')

  return (
    <div className="min-h-screen bg-jet-black text-white font-space overflow-hidden">
      <div className="fixed inset-0 pointer-events-none z-0">
        <div className="absolute inset-0 bg-gradient-radial from-neon-purple/5 via-transparent to-transparent animate-pulse-slow" />
        <div className="absolute inset-0">
          {Array.from({ length: 20 }).map((_, i) => (
            <motion.div key={i} className="absolute w-1 h-1 bg-neon-cyan/30 rounded-full" style={{ left: `${Math.random() * 100}%`, top: `${Math.random() * 100}%` }} animate={{ y: [0, -100, 0], opacity: [0, 1, 0], scale: [0, 1, 0] }} transition={{ duration: Math.random() * 10 + 5, repeat: Infinity, delay: Math.random() * 5 }} />
          ))}
        </div>
      </div>

      <Router>
        {showGlobalNav && (
          <div className="relative z-[10000]"><Navigation /></div>
        )}

        <main className="relative z-10">
          <AnimatePresence mode="wait">
            <Switch>
              <Route path="/" component={HomePage} />
              <Route path="/services" component={ServicesPage} />
              <Route path="/blog" component={BlogPage} />
              <Route path="/about" component={AboutPage} />
              <Route path="/contact" component={ContactPage} />
              <Route path="/careers" component={CareersPage} />
              <Route path="/careers/:slug/apply" component={JobApplicationPage} />
              <Route path="/careers/:slug" component={JobDetailPage} />
              <Route path="/feedback/:token" component={FeedbackFormPage} />
              <Route path="/thank-you" component={ThankYouPage} />
              <Route path="/admin/login" component={AdminLogin} />
              <Route path="/admin/register" component={AdminRegister} />
              <Route path="/admin/dashboard">
                <AuthGuard><AdminDashboard /></AuthGuard>
              </Route>
              <Route path="/admin/messages">
                <AuthGuard><AdminMessages /></AuthGuard>
              </Route>
              <Route path="/admin/feedback">
                <AuthGuard><AdminFeedback /></AuthGuard>
              </Route>
              <Route path="/admin/jobs">
                <AuthGuard><AdminJobs /></AuthGuard>
              </Route>
              <Route path="/admin/job-applications">
                <AuthGuard><AdminJobApplications /></AuthGuard>
              </Route>
              <Route path="/admin/users">
                <AuthGuard><AdminUsers /></AuthGuard>
              </Route>
              <Route path="/admin/analytics">
                <AuthGuard><AdminAnalytics /></AuthGuard>
              </Route>
              <Route path="/admin/settings">
                <AuthGuard><AdminSettings /></AuthGuard>
              </Route>
              <Route path="/privacy" component={PrivacyPolicyPage} />
              <Route path="/terms" component={TermsOfServicePage} />
              <Route>
                <PageTransition>
                  <div className="min-h-screen flex items-center justify-center">
                    <motion.div initial={{ opacity: 0, scale: 0.8 }} animate={{ opacity: 1, scale: 1 }} className="text-center">
                      <h1 className="text-8xl font-bold bg-neon-gradient bg-clip-text text-transparent mb-4">404</h1>
                      <p className="text-xl text-gray-400">This page doesn't exist in our dimension</p>
                    </motion.div>
                  </div>
                </PageTransition>
              </Route>
            </Switch>
          </AnimatePresence>
        </main>

        <div className="fixed bottom-8 right-8 z-50">
          <motion.button className="w-12 h-12 bg-neon-purple/20 backdrop-blur-md border border-neon-purple/30 rounded-full flex items-center justify-center hover:bg-neon-purple/30 transition-all duration-300" whileHover={{ scale: 1.1, rotate: 180 }} onClick={() => { if (lenis) { scrollTo(0) } else { window.scrollTo({ top: 0, behavior: 'smooth' }) } }} data-cursor="magnetic">
            <svg className="w-6 h-6 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
          </motion.button>
        </div>
      </Router>
    </div>
  )
}

export default App
