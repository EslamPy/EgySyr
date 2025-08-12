import React from 'react'
import { Link, useLocation } from 'wouter'
import { LayoutDashboard, Users, LogIn, UserPlus, MessageSquare, Briefcase, Star } from 'lucide-react'

export const AdminSidebar: React.FC = () => {
  const [location] = useLocation()
  const linkClass = (href: string) => `flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${location === href ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'}`

  return (
    <aside className="w-64 bg-black/40 border-r border-white/10 min-h-screen p-4 hidden md:block">
      <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">Admin</div>
      <nav className="space-y-2">
        <Link href="/admin/dashboard" className={linkClass('/admin/dashboard')}>
          <LayoutDashboard className="w-4 h-4" /> Dashboard
        </Link>
        <Link href="/admin/feedback" className={linkClass('/admin/feedback')}>
          <Star className="w-4 h-4" /> Feedback
        </Link>
        <Link href="/admin/careers" className={linkClass('/admin/careers')}>
          <Briefcase className="w-4 h-4" /> Careers
        </Link>
        <Link href="/admin/messages" className={linkClass('/admin/messages')}>
          <MessageSquare className="w-4 h-4" /> Messages
        </Link>
        <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">Data</div>
        <button className={linkClass('#') + ' w-full text-left'}>
          <Users className="w-4 h-4" /> Users
        </button>
      </nav>
    </aside>
  )
} 