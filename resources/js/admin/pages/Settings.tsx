import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import {
  User, Mail, Lock, Camera, Save, Eye, EyeOff,
  Shield, Bell, Globe, Palette, RefreshCw, Check,
  AlertCircle, Upload, X, LogOut
} from 'lucide-react'
import { getCurrentUser, setCurrentUser, logout } from '../utils/auth'
import { motion } from 'framer-motion'
import toast from 'react-hot-toast'

// Utility function to get CSRF token
const getCSRFToken = (): string | null => {
  const metaTag = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
  return metaTag ? metaTag.content : null
}

interface UserProfile {
  id: number
  name: string
  username: string
  email: string
  profile_image_path?: string
  profile_image_url?: string
  role: string
  status: string
  created_at: string
}

const Settings: React.FC = () => {
  const currentUser = getCurrentUser()
  const [activeTab, setActiveTab] = useState<'profile' | 'security' | 'preferences' | 'account'>('profile')
  const [loading, setLoading] = useState(false)
  const [profile, setProfile] = useState<UserProfile | null>(null)

  // Profile form state
  const [profileForm, setProfileForm] = useState({
    name: '',
    username: '',
    email: '',
  })
  const [profileImage, setProfileImage] = useState<File | null>(null)
  const [profileImagePreview, setProfileImagePreview] = useState<string | null>(null)

  // Security form state
  const [securityForm, setSecurityForm] = useState({
    current_password: '',
    new_password: '',
    confirm_password: '',
  })
  const [showPasswords, setShowPasswords] = useState({
    current: false,
    new: false,
    confirm: false,
  })

  // Preferences state
  const [preferences, setPreferences] = useState({
    email_notifications: true,
    browser_notifications: false,
    theme: 'dark',
    language: 'en',
  })

  const [errors, setErrors] = useState<Record<string, string>>({})

  const handleLogout = async () => {
    if (window.confirm('Are you sure you want to logout? You will be redirected to the main website.')) {
      try {
        await logout()
        toast.success('Logged out successfully!')
        // Redirect to main website
        window.location.href = '/'
      } catch (error) {
        console.error('Logout error:', error)
        toast.error('Failed to logout. Please try again.')
      }
    }
  }

  useEffect(() => {
    fetchProfile()
  }, [])

  const fetchProfile = async () => {
    try {
      setLoading(true)

      const response = await fetch('/api/auth/me', {
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
      })

      if (response.ok) {
        const data = await response.json()
        setProfile(data.user)
        setProfileForm({
          name: data.user.name || '',
          username: data.user.username || '',
          email: data.user.email || '',
        })
        if (data.user.profile_image_url) {
          setProfileImagePreview(data.user.profile_image_url)
        }
      }
    } catch (error) {
      console.error('Failed to fetch profile:', error)
      toast.error('Failed to load profile data')
    } finally {
      setLoading(false)
    }
  }

  const handleProfileImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0]
    if (file) {
      // Validate file type and size
      const allowedTypes = ['image/jpeg', 'image/png', 'image/webp']
      if (!allowedTypes.includes(file.type)) {
        toast.error('Please upload a JPEG, PNG, or WebP image')
        return
      }
      if (file.size > 2 * 1024 * 1024) { // 2MB limit
        toast.error('Image size must be less than 2MB')
        return
      }

      setProfileImage(file)
      
      // Create preview
      const reader = new FileReader()
      reader.onload = (e) => {
        setProfileImagePreview(e.target?.result as string)
      }
      reader.readAsDataURL(file)
    }
  }

  const updateProfile = async (e: React.FormEvent) => {
    e.preventDefault()
    setLoading(true)
    setErrors({})

    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const formData = new FormData()
      formData.append('name', profileForm.name)
      formData.append('username', profileForm.username)
      formData.append('email', profileForm.email)

      if (profileImage) {
        formData.append('profile_image', profileImage)
      }

      const response = await fetch('/api/admin/profile/update', {
        method: 'POST',
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: formData,
      })

      const data = await response.json()

      if (response.ok) {
        toast.success('Profile updated successfully!')

        // Update localStorage with new user data
        if (data.user) {
          setCurrentUser(data.user)
          // Dispatch custom event to notify other components of user update
          window.dispatchEvent(new CustomEvent('userProfileUpdated', { detail: data.user }))
        }

        fetchProfile() // Refresh profile data
        setProfileImage(null)
      } else {
        if (data.errors) {
          setErrors(data.errors)
        } else {
          toast.error(data.message || 'Failed to update profile')
        }
      }
    } catch (error) {
      console.error('Profile update error:', error)
      toast.error('Failed to update profile')
    } finally {
      setLoading(false)
    }
  }

  const updatePassword = async (e: React.FormEvent) => {
    e.preventDefault()
    setLoading(true)
    setErrors({})

    // Validate passwords match
    if (securityForm.new_password !== securityForm.confirm_password) {
      setErrors({ confirm_password: 'Passwords do not match' })
      setLoading(false)
      return
    }

    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch('/api/admin/profile/change-password', {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
          current_password: securityForm.current_password,
          new_password: securityForm.new_password,
          new_password_confirmation: securityForm.confirm_password,
        }),
      })

      const data = await response.json()

      if (response.ok) {
        toast.success('Password changed successfully!')
        setSecurityForm({
          current_password: '',
          new_password: '',
          confirm_password: '',
        })
      } else {
        if (data.errors) {
          setErrors(data.errors)
        } else {
          toast.error(data.message || 'Failed to change password')
        }
      }
    } catch (error) {
      console.error('Password change error:', error)
      toast.error('Failed to change password')
    } finally {
      setLoading(false)
    }
  }

  const tabs = [
    { id: 'profile', label: 'Profile', icon: <User className="w-4 h-4" /> },
    { id: 'security', label: 'Security', icon: <Shield className="w-4 h-4" /> },
    { id: 'preferences', label: 'Preferences', icon: <Bell className="w-4 h-4" /> },
    { id: 'account', label: 'Account', icon: <LogOut className="w-4 h-4" /> },
  ]

  if (loading && !profile) {
    return (
      <AdminLayout>
        <div className="flex items-center justify-center min-h-[400px]">
          <div className="text-center">
            <RefreshCw className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-purple" />
            <p className="text-gray-400">Loading settings...</p>
          </div>
        </div>
      </AdminLayout>
    )
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div>
          <h1 className="text-3xl font-bold">Settings</h1>
          <p className="text-gray-400 mt-1">
            Manage your account settings and preferences
          </p>
        </div>

        {/* Tabs */}
        <div className="border-b border-white/10">
          <nav className="flex space-x-8">
            {tabs.map((tab) => (
              <button
                key={tab.id}
                onClick={() => setActiveTab(tab.id as any)}
                className={`flex items-center gap-2 py-4 px-1 border-b-2 font-medium text-sm transition-colors ${
                  activeTab === tab.id
                    ? 'border-neon-purple text-neon-purple'
                    : 'border-transparent text-gray-400 hover:text-gray-300'
                }`}
              >
                {tab.icon}
                {tab.label}
              </button>
            ))}
          </nav>
        </div>

        {/* Tab Content */}
        <div className="max-w-2xl">
          {activeTab === 'profile' && (
            <ProfileTab
              profile={profile}
              profileForm={profileForm}
              setProfileForm={setProfileForm}
              profileImagePreview={profileImagePreview}
              onImageChange={handleProfileImageChange}
              onSubmit={updateProfile}
              loading={loading}
              errors={errors}
            />
          )}

          {activeTab === 'security' && (
            <SecurityTab
              securityForm={securityForm}
              setSecurityForm={setSecurityForm}
              showPasswords={showPasswords}
              setShowPasswords={setShowPasswords}
              onSubmit={updatePassword}
              loading={loading}
              errors={errors}
            />
          )}

          {activeTab === 'preferences' && (
            <PreferencesTab
              preferences={preferences}
              setPreferences={setPreferences}
              loading={loading}
            />
          )}

          {activeTab === 'account' && (
            <AccountTab
              onLogout={handleLogout}
              loading={loading}
            />
          )}
        </div>
      </div>
    </AdminLayout>
  )
}

// Profile Tab Component
const ProfileTab: React.FC<{
  profile: UserProfile | null
  profileForm: any
  setProfileForm: any
  profileImagePreview: string | null
  onImageChange: (e: React.ChangeEvent<HTMLInputElement>) => void
  onSubmit: (e: React.FormEvent) => void
  loading: boolean
  errors: Record<string, string>
}> = ({ profile, profileForm, setProfileForm, profileImagePreview, onImageChange, onSubmit, loading, errors }) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      className="space-y-6"
    >
      <div className="bg-white/5 border border-white/10 rounded-xl p-6">
        <h2 className="text-xl font-semibold mb-6">Profile Information</h2>

        <form onSubmit={onSubmit} className="space-y-6">
          {/* Profile Image */}
          <div className="flex items-center gap-6">
            <div className="relative">
              <div className="w-20 h-20 rounded-full overflow-hidden bg-white/10 border border-white/10">
                {profileImagePreview ? (
                  <img
                    src={profileImagePreview}
                    alt="Profile"
                    className="w-full h-full object-cover"
                  />
                ) : (
                  <div className="w-full h-full flex items-center justify-center">
                    <User className="w-8 h-8 text-gray-400" />
                  </div>
                )}
              </div>
              <input
                type="file"
                onChange={onImageChange}
                accept="image/jpeg,image/png,image/webp"
                className="hidden"
                id="profile-image-upload"
              />
              <label
                htmlFor="profile-image-upload"
                className="absolute -bottom-2 -right-2 p-2 bg-neon-purple hover:bg-neon-purple/80 rounded-full cursor-pointer transition-colors"
              >
                <Camera className="w-4 h-4 text-white" />
              </label>
            </div>
            <div>
              <h3 className="font-medium text-white">{profile?.name}</h3>
              <p className="text-sm text-gray-400">{profile?.email}</p>
              <p className="text-xs text-gray-500 mt-1">
                Role: {profile?.role} • Status: {profile?.status}
              </p>
            </div>
          </div>

          {/* Form Fields */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Full Name
              </label>
              <input
                type="text"
                value={profileForm.name}
                onChange={(e) => setProfileForm({ ...profileForm, name: e.target.value })}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  errors.name ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your full name"
              />
              {errors.name && (
                <p className="text-red-400 text-sm mt-1">{errors.name}</p>
              )}
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Username
              </label>
              <input
                type="text"
                value={profileForm.username}
                onChange={(e) => setProfileForm({ ...profileForm, username: e.target.value })}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  errors.username ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your username"
              />
              {errors.username && (
                <p className="text-red-400 text-sm mt-1">{errors.username}</p>
              )}
            </div>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Email Address
            </label>
            <input
              type="email"
              value={profileForm.email}
              onChange={(e) => setProfileForm({ ...profileForm, email: e.target.value })}
              className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                errors.email ? 'border-red-500' : 'border-white/10'
              }`}
              placeholder="Enter your email address"
            />
            {errors.email && (
              <p className="text-red-400 text-sm mt-1">{errors.email}</p>
            )}
          </div>

          <div className="flex justify-end">
            <button
              type="submit"
              disabled={loading}
              className="flex items-center gap-2 px-6 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {loading ? (
                <RefreshCw className="w-4 h-4 animate-spin" />
              ) : (
                <Save className="w-4 h-4" />
              )}
              {loading ? 'Saving...' : 'Save Changes'}
            </button>
          </div>
        </form>
      </div>
    </motion.div>
  )
}

// Security Tab Component
const SecurityTab: React.FC<{
  securityForm: any
  setSecurityForm: any
  showPasswords: any
  setShowPasswords: any
  onSubmit: (e: React.FormEvent) => void
  loading: boolean
  errors: Record<string, string>
}> = ({ securityForm, setSecurityForm, showPasswords, setShowPasswords, onSubmit, loading, errors }) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      className="space-y-6"
    >
      <div className="bg-white/5 border border-white/10 rounded-xl p-6">
        <h2 className="text-xl font-semibold mb-6">Change Password</h2>

        <form onSubmit={onSubmit} className="space-y-6">
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Current Password
            </label>
            <div className="relative">
              <input
                type={showPasswords.current ? 'text' : 'password'}
                value={securityForm.current_password}
                onChange={(e) => setSecurityForm({ ...securityForm, current_password: e.target.value })}
                className={`w-full px-3 py-2 pr-10 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  errors.current_password ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your current password"
              />
              <button
                type="button"
                onClick={() => setShowPasswords({ ...showPasswords, current: !showPasswords.current })}
                className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
              >
                {showPasswords.current ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>
            {errors.current_password && (
              <p className="text-red-400 text-sm mt-1">{errors.current_password}</p>
            )}
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              New Password
            </label>
            <div className="relative">
              <input
                type={showPasswords.new ? 'text' : 'password'}
                value={securityForm.new_password}
                onChange={(e) => setSecurityForm({ ...securityForm, new_password: e.target.value })}
                className={`w-full px-3 py-2 pr-10 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  errors.new_password ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your new password"
              />
              <button
                type="button"
                onClick={() => setShowPasswords({ ...showPasswords, new: !showPasswords.new })}
                className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
              >
                {showPasswords.new ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>
            {errors.new_password && (
              <p className="text-red-400 text-sm mt-1">{errors.new_password}</p>
            )}
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Confirm New Password
            </label>
            <div className="relative">
              <input
                type={showPasswords.confirm ? 'text' : 'password'}
                value={securityForm.confirm_password}
                onChange={(e) => setSecurityForm({ ...securityForm, confirm_password: e.target.value })}
                className={`w-full px-3 py-2 pr-10 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  errors.confirm_password ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Confirm your new password"
              />
              <button
                type="button"
                onClick={() => setShowPasswords({ ...showPasswords, confirm: !showPasswords.confirm })}
                className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
              >
                {showPasswords.confirm ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>
            {errors.confirm_password && (
              <p className="text-red-400 text-sm mt-1">{errors.confirm_password}</p>
            )}
          </div>

          <div className="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
            <div className="flex items-start gap-3">
              <AlertCircle className="w-5 h-5 text-blue-400 mt-0.5 flex-shrink-0" />
              <div className="text-sm text-blue-300">
                <p className="font-medium mb-1">Password Requirements:</p>
                <ul className="space-y-1 text-blue-400">
                  <li>• At least 8 characters long</li>
                  <li>• Contains uppercase and lowercase letters</li>
                  <li>• Contains at least one number</li>
                  <li>• Contains at least one special character</li>
                </ul>
              </div>
            </div>
          </div>

          <div className="flex justify-end">
            <button
              type="submit"
              disabled={loading}
              className="flex items-center gap-2 px-6 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {loading ? (
                <RefreshCw className="w-4 h-4 animate-spin" />
              ) : (
                <Lock className="w-4 h-4" />
              )}
              {loading ? 'Changing...' : 'Change Password'}
            </button>
          </div>
        </form>
      </div>
    </motion.div>
  )
}

// Preferences Tab Component
const PreferencesTab: React.FC<{
  preferences: any
  setPreferences: any
  loading: boolean
}> = ({ preferences, setPreferences, loading }) => {
  const savePreferences = async () => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch('/api/admin/profile/preferences', {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(preferences),
      })

      if (response.ok) {
        toast.success('Preferences saved successfully!')
      } else {
        toast.error('Failed to save preferences')
      }
    } catch (error) {
      console.error('Preferences save error:', error)
      toast.error('Failed to save preferences')
    }
  }

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      className="space-y-6"
    >
      <div className="bg-white/5 border border-white/10 rounded-xl p-6">
        <h2 className="text-xl font-semibold mb-6">Notifications</h2>

        <div className="space-y-4">
          <div className="flex items-center justify-between">
            <div>
              <h3 className="font-medium text-white">Email Notifications</h3>
              <p className="text-sm text-gray-400">Receive notifications via email</p>
            </div>
            <label className="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                checked={preferences.email_notifications}
                onChange={(e) => setPreferences({ ...preferences, email_notifications: e.target.checked })}
                className="sr-only peer"
              />
              <div className="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-neon-purple"></div>
            </label>
          </div>

          <div className="flex items-center justify-between">
            <div>
              <h3 className="font-medium text-white">Browser Notifications</h3>
              <p className="text-sm text-gray-400">Show desktop notifications</p>
            </div>
            <label className="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                checked={preferences.browser_notifications}
                onChange={(e) => setPreferences({ ...preferences, browser_notifications: e.target.checked })}
                className="sr-only peer"
              />
              <div className="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-neon-purple"></div>
            </label>
          </div>
        </div>
      </div>

      <div className="flex justify-end">
        <button
          onClick={savePreferences}
          disabled={loading}
          className="flex items-center gap-2 px-6 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
        >
          {loading ? (
            <RefreshCw className="w-4 h-4 animate-spin" />
          ) : (
            <Check className="w-4 h-4" />
          )}
          {loading ? 'Saving...' : 'Save Preferences'}
        </button>
      </div>
    </motion.div>
  )
}

// Account Tab Component
const AccountTab: React.FC<{
  onLogout: () => void
  loading: boolean
}> = ({ onLogout, loading }) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      className="space-y-6"
    >
      <div className="bg-white/5 border border-white/10 rounded-xl p-6">
        <h2 className="text-xl font-semibold mb-6">Account Management</h2>

        <div className="space-y-6">
          {/* Logout Section */}
          <div className="border border-red-500/20 rounded-lg p-6 bg-red-500/5">
            <div className="flex items-start gap-4">
              <div className="flex-shrink-0">
                <LogOut className="w-6 h-6 text-red-400" />
              </div>
              <div className="flex-1">
                <h3 className="text-lg font-medium text-white mb-2">Logout</h3>
                <p className="text-gray-400 text-sm mb-4">
                  Sign out of your admin account and return to the main website. You'll need to log in again to access the admin panel.
                </p>
                <button
                  onClick={onLogout}
                  disabled={loading}
                  className="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 disabled:bg-red-600/50 disabled:cursor-not-allowed text-white rounded-lg transition-colors font-medium"
                >
                  <LogOut className="w-4 h-4" />
                  {loading ? 'Logging out...' : 'Logout'}
                </button>
              </div>
            </div>
          </div>

          {/* Additional Account Actions */}
          <div className="border border-white/10 rounded-lg p-6">
            <h3 className="text-lg font-medium text-white mb-4">Account Information</h3>
            <div className="space-y-3 text-sm">
              <div className="flex justify-between">
                <span className="text-gray-400">Account Type:</span>
                <span className="text-white">Administrator</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Session Status:</span>
                <span className="text-green-400">Active</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-400">Last Login:</span>
                <span className="text-white">Today</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </motion.div>
  )
}

export default Settings
