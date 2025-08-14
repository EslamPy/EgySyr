import React, { useState } from 'react'
import { motion } from 'framer-motion'
import {
  Mail, Lock, Eye, EyeOff, UserPlus, Shield, User,
  Image as ImageIcon, AlertCircle, Loader, CheckCircle,
  Check, X
} from 'lucide-react'
import { Link, useLocation } from 'wouter'
import toast from 'react-hot-toast'

interface FormData {
  first_name: string
  last_name: string
  username: string
  email: string
  password: string
  confirm_password: string
}

interface FormErrors {
  first_name?: string
  last_name?: string
  username?: string
  email?: string
  password?: string
  confirm_password?: string
  profile_image?: string
  general?: string
}

const AdminRegister: React.FC = () => {
  const [formData, setFormData] = useState<FormData>({
    first_name: '',
    last_name: '',
    username: '',
    email: '',
    password: '',
    confirm_password: '',
  })
  const [showPassword, setShowPassword] = useState(false)
  const [showConfirmPassword, setShowConfirmPassword] = useState(false)
  const [errors, setErrors] = useState<FormErrors>({})
  const [loading, setLoading] = useState(false)
  const [submitted, setSubmitted] = useState(false)
  const [profileImage, setProfileImage] = useState<File | null>(null)
  const [profileImagePreview, setProfileImagePreview] = useState<string | null>(null)
  const [_, navigate] = useLocation()

  const passwordRequirements = [
    { text: 'At least 8 characters', test: (pwd: string) => pwd.length >= 8 },
    { text: 'Contains uppercase letter', test: (pwd: string) => /[A-Z]/.test(pwd) },
    { text: 'Contains lowercase letter', test: (pwd: string) => /[a-z]/.test(pwd) },
    { text: 'Contains number', test: (pwd: string) => /\d/.test(pwd) },
    { text: 'Contains special character', test: (pwd: string) => /[!@#$%^&*(),.?":{}|<>]/.test(pwd) },
  ]

  const handleInputChange = (field: keyof FormData, value: string) => {
    setFormData(prev => ({ ...prev, [field]: value }))
    // Clear error when user starts typing
    if (errors[field]) {
      setErrors(prev => ({ ...prev, [field]: '' }))
    }
  }

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0]
    if (!file) return

    // Validate file type
    if (!file.type.startsWith('image/')) {
      setErrors(prev => ({ ...prev, profile_image: 'Please select a valid image file' }))
      return
    }

    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      setErrors(prev => ({ ...prev, profile_image: 'Image size must be less than 5MB' }))
      return
    }

    setProfileImage(file)
    setErrors(prev => ({ ...prev, profile_image: '' }))

    // Create preview
    const reader = new FileReader()
    reader.onload = () => setProfileImagePreview(reader.result as string)
    reader.readAsDataURL(file)
  }

  const validate = (): boolean => {
    const newErrors: FormErrors = {}

    // Required fields
    if (!formData.first_name.trim()) newErrors.first_name = 'First name is required'
    if (!formData.last_name.trim()) newErrors.last_name = 'Last name is required'
    if (!formData.username.trim()) newErrors.username = 'Username is required'
    else if (formData.username.length < 3) newErrors.username = 'Username must be at least 3 characters'
    else if (!/^[a-zA-Z0-9_]+$/.test(formData.username)) newErrors.username = 'Username can only contain letters, numbers, and underscores'

    if (!formData.email.trim()) newErrors.email = 'Email is required'
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) newErrors.email = 'Enter a valid email address'

    // Password validation
    if (!formData.password) newErrors.password = 'Password is required'
    else {
      const failedRequirements = passwordRequirements.filter(req => !req.test(formData.password))
      if (failedRequirements.length > 0) {
        newErrors.password = 'Password does not meet requirements'
      }
    }

    if (!formData.confirm_password) newErrors.confirm_password = 'Please confirm your password'
    else if (formData.password !== formData.confirm_password) newErrors.confirm_password = 'Passwords do not match'

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
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

      const submitData = new FormData()
      Object.entries(formData).forEach(([key, value]) => {
        submitData.append(key, value)
      })
      if (profileImage) {
        submitData.append('profile_image', profileImage)
      }

      const response = await fetch('/api/auth/register', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'include',
        body: submitData,
      })

      const data = await response.json()

      if (!response.ok) {
        if (response.status === 422) {
          setErrors(data.errors || {})
        } else {
          setErrors({ general: data.message || 'Registration failed. Please try again.' })
        }
        return
      }

      // Success
      setSubmitted(true)
      toast.success('Registration submitted successfully!')

    } catch (error) {
      console.error('Registration error:', error)
      setErrors({ general: 'Network error. Please check your connection and try again.' })
    } finally {
      setLoading(false)
    }
  }

  // Success state
  if (submitted) {
    return (
      <div className="min-h-screen bg-jet-black text-white relative overflow-hidden flex items-center justify-center">
        <div className="absolute inset-0 opacity-20 pointer-events-none">
          <div className="absolute top-20 left-20 w-72 h-72 bg-neon-purple/20 rounded-full blur-3xl" />
          <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/20 rounded-full blur-3xl" />
        </div>

        <motion.div
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.6 }}
          className="relative text-center max-w-md mx-auto px-6"
        >
          <div className="bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-xl">
            <CheckCircle className="w-16 h-16 text-green-400 mx-auto mb-6" />
            <h1 className="text-3xl font-bold mb-4 bg-neon-gradient bg-clip-text text-transparent">
              Registration Submitted!
            </h1>
            <p className="text-gray-400 mb-6 leading-relaxed">
              Your account is under review by the admin. You'll receive an email notification once your account is approved.
            </p>
            <div className="flex gap-3">
              <button
                onClick={() => navigate('/admin/login')}
                className="flex-1 px-6 py-3 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
              >
                Back to Login
              </button>
              <button
                onClick={() => navigate('/')}
                className="flex-1 px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
              >
                Go Home
              </button>
            </div>
          </div>
        </motion.div>
      </div>
    )
  }

  return (
    <div className="min-h-screen bg-jet-black text-white relative overflow-hidden">
      <div className="absolute inset-0 opacity-20 pointer-events-none">
        <div className="absolute top-20 left-20 w-72 h-72 bg-neon-purple/20 rounded-full blur-3xl" />
        <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/20 rounded-full blur-3xl" />
      </div>

      <div className="relative max-w-2xl mx-auto px-6 pt-16 pb-16">
        <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }} className="text-center mb-8">
          <div className="inline-flex items-center px-5 py-2 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-sm font-semibold backdrop-blur-sm mb-4">
            <Shield className="w-4 h-4 mr-2" /> Admin Access Request
          </div>
          <h1 className="text-4xl font-extrabold">Request Admin Account</h1>
          <p className="text-gray-400 mt-2">Submit your information for admin dashboard access</p>
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

          {/* Name Fields */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">First Name</label>
              <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.first_name ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
                <User className="w-5 h-5 text-gray-400" />
                <input
                  type="text"
                  value={formData.first_name}
                  onChange={(e) => handleInputChange('first_name', e.target.value)}
                  placeholder="John"
                  className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                  disabled={loading}
                />
              </div>
              {errors.first_name && <p className="mt-2 text-sm text-red-400">{errors.first_name}</p>}
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
              <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.last_name ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
                <User className="w-5 h-5 text-gray-400" />
                <input
                  type="text"
                  value={formData.last_name}
                  onChange={(e) => handleInputChange('last_name', e.target.value)}
                  placeholder="Doe"
                  className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                  disabled={loading}
                />
              </div>
              {errors.last_name && <p className="mt-2 text-sm text-red-400">{errors.last_name}</p>}
            </div>
          </div>

          {/* Username */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Username</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.username ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <User className="w-5 h-5 text-gray-400" />
              <input
                type="text"
                value={formData.username}
                onChange={(e) => handleInputChange('username', e.target.value)}
                placeholder="johndoe"
                className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                disabled={loading}
              />
            </div>
            {errors.username && <p className="mt-2 text-sm text-red-400">{errors.username}</p>}
            <p className="mt-1 text-xs text-gray-500">Letters, numbers, and underscores only</p>
          </div>

          {/* Email */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.email ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <Mail className="w-5 h-5 text-gray-400" />
              <input
                type="email"
                value={formData.email}
                onChange={(e) => handleInputChange('email', e.target.value)}
                placeholder="john@example.com"
                className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                disabled={loading}
              />
            </div>
            {errors.email && <p className="mt-2 text-sm text-red-400">{errors.email}</p>}
          </div>
          {/* Password */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Password</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.password ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <Lock className="w-5 h-5 text-gray-400" />
              <input
                type={showPassword ? 'text' : 'password'}
                value={formData.password}
                onChange={(e) => handleInputChange('password', e.target.value)}
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

            {/* Password Requirements */}
            <div className="mt-3 space-y-2">
              <p className="text-xs text-gray-400 font-medium">Password Requirements:</p>
              <div className="grid grid-cols-1 gap-1">
                {passwordRequirements.map((req, index) => {
                  const isValid = req.test(formData.password)
                  return (
                    <div key={index} className={`flex items-center gap-2 text-xs ${isValid ? 'text-green-400' : 'text-gray-500'}`}>
                      {isValid ? <Check className="w-3 h-3" /> : <X className="w-3 h-3" />}
                      <span>{req.text}</span>
                    </div>
                  )
                })}
              </div>
            </div>
          </div>

          {/* Confirm Password */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.confirm_password ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50 transition-colors`}>
              <Lock className="w-5 h-5 text-gray-400" />
              <input
                type={showConfirmPassword ? 'text' : 'password'}
                value={formData.confirm_password}
                onChange={(e) => handleInputChange('confirm_password', e.target.value)}
                placeholder="••••••••"
                className="w-full bg-transparent outline-none placeholder-gray-500 text-white"
                disabled={loading}
              />
              <button
                type="button"
                onClick={() => setShowConfirmPassword(v => !v)}
                className="text-gray-400 hover:text-gray-200 transition-colors"
                disabled={loading}
              >
                {showConfirmPassword ? <EyeOff className="w-5 h-5" /> : <Eye className="w-5 h-5" />}
              </button>
            </div>
            {errors.confirm_password && <p className="mt-2 text-sm text-red-400">{errors.confirm_password}</p>}
          </div>

          {/* Profile Image */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Profile Image (Optional)</label>
            <div className="flex items-center gap-4">
              <label className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.profile_image ? 'border-red-500/60' : 'border-white/10'} hover:border-neon-purple/40 cursor-pointer transition-colors flex-1`}>
                <ImageIcon className="w-5 h-5 text-gray-400" />
                <span className="text-gray-400">{profileImage ? profileImage.name : 'Choose image'}</span>
                <input
                  type="file"
                  accept="image/*"
                  className="hidden"
                  onChange={handleImageChange}
                  disabled={loading}
                />
              </label>
              {profileImagePreview && (
                <img
                  src={profileImagePreview}
                  alt="Profile preview"
                  className="w-16 h-16 rounded-full object-cover border border-white/10"
                />
              )}
            </div>
            {errors.profile_image && <p className="mt-2 text-sm text-red-400">{errors.profile_image}</p>}
            <p className="mt-1 text-xs text-gray-500">JPG, PNG, or GIF. Max size 5MB.</p>
          </div>

          {/* Submit Button */}
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
                Submitting Request...
              </>
            ) : (
              <>
                <UserPlus className="w-5 h-5" />
                Request Admin Access
              </>
            )}
          </motion.button>

          <div className="text-center">
            <p className="text-sm text-gray-400">
              Already have an account?{' '}
              <Link href="/admin/login" className="text-neon-cyan hover:text-neon-cyan/80 transition-colors font-medium">
                Sign In
              </Link>
            </p>
          </div>
        </motion.form>
      </div>
    </div>
  )
}

export default AdminRegister