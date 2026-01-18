import React from 'react'
import { Link, useLocation } from 'wouter'
import {
  LayoutDashboard, Users, MessageSquare, Briefcase, Star,
  FileText, Settings, Eye
} from 'lucide-react'

export const AdminSidebar: React.FC = () => {
  const [location] = useLocation()
  const linkClass = (href: string) => `flex items-center gap-3 px-4 py-3 rounded-xl transition-colors ${location === href ? 'bg-white/10 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'}`

  return (
    <aside className="w-64 bg-black/40 border-r border-white/10 min-h-screen p-4 hidden md:block">
      <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">Overview</div>
      <nav className="space-y-2">
        <Link href="/admin/dashboard" className={linkClass('/admin/dashboard')}>
          <LayoutDashboard className="w-4 h-4" /> Dashboard
        </Link>
        <Link href="/admin/analytics" className={linkClass('/admin/analytics')}>
          <Eye className="w-4 h-4" /> Site Analytics
        </Link>

        <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">Content</div>
        <Link href="/admin/messages" className={linkClass('/admin/messages')}>
          <MessageSquare className="w-4 h-4" /> Contact Messages
        </Link>
        <Link href="/admin/feedback" className={linkClass('/admin/feedback')}>
          <Star className="w-4 h-4" /> Feedback Management
        </Link>

        <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">Jobs</div>
        <Link href="/admin/jobs" className={linkClass('/admin/jobs')}>
          <Briefcase className="w-4 h-4" /> Job Management
        </Link>
        <Link href="/admin/job-applications" className={linkClass('/admin/job-applications')}>
          <FileText className="w-4 h-4" /> Applications
        </Link>

        <div className="px-2 py-3 text-sm uppercase tracking-wider text-gray-500">System</div>
        <Link href="/admin/users" className={linkClass('/admin/users')}>
          <Users className="w-4 h-4" /> User Management
        </Link>
        <Link href="/admin/settings" className={linkClass('/admin/settings')}>
          <Settings className="w-4 h-4" /> Settings
        </Link>
      </nav>
    </aside>
  )
}