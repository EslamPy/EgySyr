import React, { useState } from 'react'
import { motion } from 'framer-motion'
import { Mail, Lock, Eye, EyeOff, LogIn, Shield, AlertCircle, Loader } from 'lucide-react'
import { Link, useLocation } from 'wouter'
import { setAuthData } from '../utils/auth'
import toast from 'react-hot-toast'

const AdminLogin: React.FC = () => {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [errors, setErrors] = useState<{ email?: string; password?: string; general?: string }>({})
  const [remember, setRemember] = useState(true)
  const [loading, setLoading] = useState(false)
  const [_, navigate] = useLocation()

  const validate = () => {
    const next: typeof errors = {}
    if (!email.trim()) next.email = 'Email is required'
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) next.email = 'Enter a valid email'
    if (!password.trim()) next.password = 'Password is required'
    setErrors(next)
    return Object.keys(next).length === 0
  }

  const onSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    if (!validate()) return

    setLoading(true)
    setErrors({})

    try {
      // Get CSRF token first
      await fetch('/sanctum/csrf-cookie', {
        credentials: 'include',
      })

      const response = await fetch('/api/auth/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'include',
        body: JSON.stringify({
          email: email.trim(),
          password: password.trim(),
          remember,
        }),
      })

      const data = await response.json()

      if (!response.ok) {
        if (response.status === 422) {
          // Validation errors
          setErrors(data.errors || {})
        } else if (response.status === 401) {
          // Authentication failed
          setErrors({ general: data.message || 'Invalid credentials' })
        } else if (response.status === 403) {
          // Account not approved
          setErrors({ general: data.message || 'Your account is still under review' })
        } else {
          setErrors({ general: 'Login failed. Please try again.' })
        }
        return
      }

      // Success - store auth data and redirect
      setAuthData({
        user: data.user,
        token: data.token,
        expires_at: data.expires_at,
      })
      toast.success(`Welcome back, ${data.user.name}!`)
      navigate('/admin/dashboard')

    } catch (error) {
      console.error('Login error:', error)
      setErrors({ general: 'Network error. Please check your connection and try again.' })
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="min-h-screen bg-jet-black text-white relative overflow-hidden">
      <div className="absolute inset-0 opacity-20 pointer-events-none">
        <div className="absolute top-20 left-20 w-72 h-72 bg-neon-purple/20 rounded-full blur-3xl" />
        <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/20 rounded-full blur-3xl" />
      </div>

      <div className="relative max-w-md mx-auto px-6 pt-28 pb-16">
        <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }} className="text-center mb-8">
          <div className="inline-flex items-center px-5 py-2 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-sm font-semibold backdrop-blur-sm mb-4">
            <Shield className="w-4 h-4 mr-2" /> Admin Access
          </div>
          <h1 className="text-4xl font-extrabold">Welcome back</h1>
          <p className="text-gray-400 mt-2">Log in to manage your dashboard</p>
        </motion.div>

        <motion.form onSubmit={onSubmit} initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: 0.1 }} className="space-y-6 bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-xl">

          {/* General Error Message */}
          {errors.general && (
            <motion.div
              initial={{ opacity: 0, y: -10 }}
              animate={{ opacity: 1, y: 0 }}
              className="flex items-center gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400"
            >
              <AlertCircle className="w-5 h-5 flex-shrink-0" />
              <span className="text-sm">{errors.general}</span>
            </motion.div>
          )}

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.email ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <Mail className="w-5 h-5 text-gray-400" />
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                placeholder="admin@example.com"
                className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                disabled={loading}
              />
            </div>
            {errors.email && <p className="mt-2 text-sm text-red-400">{errors.email}</p>}
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.password ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <Lock className="w-5 h-5 text-gray-400" />
              <input
                type={showPassword ? 'text' : 'password'}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="••••••••"
                className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                disabled={loading}
              />
              <button
                type="button"
                onClick={() => setShowPassword(v => !v)}
                className="text-gray-400 hover:text-gray-200 transition-colors"
                disabled={loading}
              >
                {showPassword ? <EyeOff className="w-5 h-5" /> : <Eye className="w-5 h-5" />}
              </button>
            </div>
            {errors.password && <p className="mt-2 text-sm text-red-400">{errors.password}</p>}
          </div>

          <div className="flex items-center justify-between text-sm">
            <label className="inline-flex items-center gap-2 text-gray-400 cursor-pointer">
              <input
                type="checkbox"
                checked={remember}
                onChange={(e) => setRemember(e.target.checked)}
                className="w-4 h-4 text-neon-purple bg-transparent border-gray-600 rounded focus:ring-neon-purple focus:ring-2"
                disabled={loading}
              />
              Remember me for 30 days
            </label>
          </div>

          <motion.button
            whileHover={!loading ? { scale: 1.02 } : {}}
            whileTap={!loading ? { scale: 0.98 } : {}}
            className="w-full py-4 rounded-xl bg-gradient-to-r from-neon-purple to-neon-pink text-white font-semibold shadow-lg hover:shadow-neon-purple/25 transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
            type="submit"
            disabled={loading}
          >
            {loading ? (
              <>
                <Loader className="w-5 h-5 animate-spin" />
                Signing in...
              </>
            ) : (
              <>
                <LogIn className="w-5 h-5" />
                Sign In
              </>
            )}
          </motion.button>

          <div className="text-center">
            <p className="text-sm text-gray-400">
              Need admin access?{' '}
              <Link href="/admin/register" className="text-neon-cyan hover:text-neon-cyan/80 transition-colors font-medium">
                Request Account
              </Link>
            </p>
          </div>
        </motion.form>
      </div>
    </div>
  )
}

export default AdminLogin 