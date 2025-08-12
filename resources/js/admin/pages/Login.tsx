import React, { useState } from 'react'
import { motion } from 'framer-motion'
import { Mail, Lock, Eye, EyeOff, LogIn, Shield, Image as ImageIcon } from 'lucide-react'
import { Link, useLocation } from 'wouter'
import { setCurrentUser } from '../utils/auth'

const AdminLogin: React.FC = () => {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [errors, setErrors] = useState<{ email?: string; password?: string; avatar?: string }>({})
  const [remember, setRemember] = useState(true)
  const [avatarPreview, setAvatarPreview] = useState<string | undefined>()
  const [_, navigate] = useLocation()

  const validate = () => {
    const next: typeof errors = {}
    if (!email) next.email = 'Email is required'
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) next.email = 'Enter a valid email'
    if (!password) next.password = 'Password is required'
    setErrors(next)
    return Object.keys(next).length === 0
  }

  const onSelectAvatar = (file?: File | null) => {
    if (!file) { setAvatarPreview(undefined); return }
    if (!file.type.startsWith('image/')) { setErrors(e => ({ ...e, avatar: 'Please choose an image file' })); return }
    const reader = new FileReader()
    reader.onload = () => setAvatarPreview(reader.result as string)
    reader.readAsDataURL(file)
  }

  const onSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    if (!validate()) return
    // Fake auth; persist user locally
    setCurrentUser({ email, avatarDataUrl: avatarPreview })
    navigate('/admin/dashboard')
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

        <motion.form onSubmit={onSubmit} initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: 0.1 }} className="space-y-5 bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl">
          <div>
            <label className="block text-sm text-gray-300 mb-2">Email</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.email ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50`}>
              <Mail className="w-4 h-4 text-gray-400" />
              <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="you@example.com" className="w-full bg-transparent outline-none placeholder-gray-500" />
            </div>
            {errors.email && <p className="mt-1 text-sm text-red-400">{errors.email}</p>}
          </div>

          <div>
            <label className="block text-sm text-gray-300 mb-2">Password</label>
            <div className={`flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border ${errors.password ? 'border-red-500/60' : 'border-white/10'} focus-within:border-neon-purple/50`}>
              <Lock className="w-4 h-4 text-gray-400" />
              <input type={showPassword ? 'text' : 'password'} value={password} onChange={(e) => setPassword(e.target.value)} placeholder="••••••••" className="w-full bg-transparent outline-none placeholder-gray-500" />
              <button type="button" onClick={() => setShowPassword(v => !v)} className="text-gray-400 hover:text-gray-200">
                {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>
            {errors.password && <p className="mt-1 text-sm text-red-400">{errors.password}</p>}
          </div>

          <div>
            <label className="block text-sm text-gray-300 mb-2">Profile Image (optional)</label>
            <label className="flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border border-white/10 hover:border-neon-purple/40 cursor-pointer">
              <ImageIcon className="w-4 h-4 text-gray-400" />
              <span className="text-gray-400">{avatarPreview ? 'Change image' : 'Choose image'}</span>
              <input type="file" accept="image/*" className="hidden" onChange={(e) => onSelectAvatar(e.target.files?.[0])} />
            </label>
            {avatarPreview && (
              <div className="mt-3 flex items-center gap-3">
                <img src={avatarPreview} alt="Avatar preview" className="w-16 h-16 rounded-full object-cover border border-white/10" />
                <span className="text-sm text-gray-400">Preview</span>
              </div>
            )}
            {errors.avatar && <p className="mt-1 text-sm text-red-400">{errors.avatar}</p>}
          </div>

          <div className="flex items-center justify-between text-sm">
            <label className="inline-flex items-center gap-2 text-gray-400">
              <input type="checkbox" checked={remember} onChange={(e) => setRemember(e.target.checked)} className="accent-neon-purple" />
              Remember me
            </label>
            <a href="#" className="text-neon-cyan hover:underline">Forgot password?</a>
          </div>

          <motion.button whileHover={{ scale: 1.02 }} className="w-full py-3 rounded-xl bg-neon-gradient text-white font-semibold shadow-lg hover:shadow-neon-purple/25 transition-all flex items-center justify-center gap-2" type="submit">
            <LogIn className="w-4 h-4" /> Log In
          </motion.button>

          <p className="text-center text-sm text-gray-400">No account?
            {' '}<Link href="/admin/register" className="text-neon-cyan hover:underline">Create one</Link>
          </p>
        </motion.form>
      </div>
    </div>
  )
}

export default AdminLogin 