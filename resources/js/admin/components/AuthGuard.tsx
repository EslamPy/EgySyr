import React, { useEffect, useState } from 'react'
import { useLocation } from 'wouter'
import { isAuthenticated } from '../utils/auth'
import { RefreshCw, AlertCircle } from 'lucide-react'

interface AuthGuardProps {
  children: React.ReactNode
  requireAuth?: boolean
  requireApproval?: boolean
}

const AuthGuard: React.FC<AuthGuardProps> = ({
  children,
  requireAuth = true,
  requireApproval = true
}) => {
  const [, setLocation] = useLocation()
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    const checkAuth = async () => {
      try {
        setLoading(true)
        setError(null)

        // If auth is not required, just render children
        if (!requireAuth) {
          setLoading(false)
          return
        }

        // Check if user is authenticated
        if (!isAuthenticated()) {
          setLocation('/admin/login')
          return
        }

        // Verify authentication with backend
        const response = await fetch('/api/auth/me', {
          credentials: 'include',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
        })

        if (!response.ok) {
          if (response.status === 401) {
            // Clear local auth data and redirect to login
            localStorage.clear()
            setLocation('/admin/login')
            return
          }
          throw new Error('Failed to verify authentication')
        }

        const data = await response.json()
        const user = data.user

        // Check if user has admin role
        if (!['admin', 'owner'].includes(user.role)) {
          setError('Unauthorized: Admin access required')
          return
        }

        // Check approval status if required
        if (requireApproval && user.status !== 'approved') {
          const message = user.status === 'pending'
            ? 'Your account is pending approval'
            : 'Your account has been denied access'
          setError(message)
          return
        }

        setLoading(false)

      } catch (err) {
        console.error('Auth check failed:', err)
        setError('Authentication verification failed')
      }
    }

    checkAuth()
  }, [requireAuth, requireApproval, setLocation])

  if (loading) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-violet-900 flex items-center justify-center">
        <div className="text-center">
          <RefreshCw className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-purple" />
          <p className="text-gray-400">Verifying authentication...</p>
        </div>
      </div>
    )
  }

  if (error) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-violet-900 flex items-center justify-center">
        <div className="text-center max-w-md mx-auto p-8">
          <div className="bg-white/5 border border-white/10 rounded-xl p-8">
            <AlertCircle className="w-16 h-16 mx-auto mb-4 text-red-400" />
            <h1 className="text-2xl font-bold text-white mb-4">Access Denied</h1>
            <p className="text-gray-400 mb-6">{error}</p>
            <div className="space-y-3">
              <button
                onClick={() => setLocation('/admin/login')}
                className="w-full px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
              >
                Go to Login
              </button>
              <button
                onClick={() => window.location.reload()}
                className="w-full px-4 py-2 bg-white/5 border border-white/10 text-gray-400 hover:text-white rounded-lg transition-colors"
              >
                Try Again
              </button>
            </div>
          </div>
        </div>
      </div>
    )
  }

  return <>{children}</>
}

export default AuthGuard
