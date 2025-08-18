import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Users, Eye, Globe, Clock, Mail, Briefcase, User, TrendingUp, RefreshCw,
  Star, MessageSquare, FileText, UserCheck, Calendar, ArrowUp, ArrowDown,
  Activity, BarChart3, PieChart, MapPin, AlertCircle, ChevronRight, Info
} from 'lucide-react'
import { getCurrentUser } from '../utils/auth'
import { motion } from 'framer-motion'
import toast from 'react-hot-toast'
import { BubbleWorldMap } from '../components/BubbleWorldMap'
import AnimatedCounter from '../../components/AnimatedCounter'
import Flag from 'react-world-flags'

interface DashboardStats {
  site_visits: {
    total: number
    today: number
    this_week: number
    this_month: number
    unique_today?: number
    avg_session_seconds_today?: number
  }
  contact_messages: {
    total: number
    unread: number
    today: number
    this_week: number
    recent: ContactMessage[]
  }
  feedback: {
    total: number
    pending: number
    approved: number
    today: number
  }
  job_applications: {
    total: number
    pending: number
    reviewed: number
    today: number
    recent: JobApplication[]
  }
  users: {
    total: number
    pending_approval: number
    approved: number
    admins: number
  }
  top_pages?: Array<{
    page: string
    visits: number
  }>
  browser_stats?: Array<{
    browser: string
    visits: number
  }>
}

interface ContactMessage {
  id: number
  name: string
  email: string
  subject: string
  message: string
  created_at: string
}

interface JobApplication {
  id: number
  job_id: number
  job: {
    title: string
  }
  first_name: string
  last_name: string
  email: string
  status: string
  created_at: string
}

interface RecentActivity {
  type: string
  title: string
  description: string
  created_at: string
  url: string
}

interface WorldMapData {
  country: string
  country_code: string
  visits: number
  unique_visitors: number
}

const Dashboard: React.FC = () => {
  const [user, setUser] = useState(getCurrentUser())
  const [stats, setStats] = useState<DashboardStats | null>(null)
  const [recentActivity, setRecentActivity] = useState<RecentActivity[]>([])
  const [worldMapData, setWorldMapData] = useState<WorldMapData[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  const fetchDashboardData = async () => {
    try {
      setLoading(true)
      setError(null)

      // Get CSRF token first
      await fetch('/sanctum/csrf-cookie', {
        credentials: 'include',
      })

      // Fetch dashboard overview stats
      const [statsResponse, activityResponse, mapResponse] = await Promise.all([
        fetch('/api/admin/dashboard/overview', {
          credentials: 'include',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
        }),
        fetch('/api/admin/dashboard/recent-activity', {
          credentials: 'include',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
        }),
        fetch('/api/admin/dashboard/world-map', {
          credentials: 'include',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
        }),
      ])

      if (statsResponse.ok) {
        const statsData = await statsResponse.json()
        setStats(statsData)
      }

      if (activityResponse.ok) {
        const activityData = await activityResponse.json()
        setRecentActivity(activityData)
      }

      if (mapResponse.ok) {
        const mapData = await mapResponse.json()
        setWorldMapData(mapData)
      }

    } catch (err) {
      console.error('Failed to fetch dashboard data:', err)
      setError('Failed to load dashboard data')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchDashboardData()
  }, [])

  // Listen for profile updates
  useEffect(() => {
    const handleProfileUpdate = (event: CustomEvent) => {
      setUser(event.detail)
    }

    window.addEventListener('userProfileUpdated', handleProfileUpdate as EventListener)

    return () => {
      window.removeEventListener('userProfileUpdated', handleProfileUpdate as EventListener)
    }
  }, [])

  const refreshData = () => {
    fetchDashboardData()
    toast.success('Dashboard data refreshed!')
  }

  if (loading) {
    return (
      <AdminLayout>
        <div className="flex items-center justify-center min-h-[400px]">
          <div className="text-center">
            <RefreshCw className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-purple" />
            <p className="text-gray-400">Loading dashboard...</p>
          </div>
        </div>
      </AdminLayout>
    )
  }

  if (error) {
    return (
      <AdminLayout>
        <div className="flex items-center justify-center min-h-[400px]">
          <div className="text-center">
            <AlertCircle className="w-12 h-12 mx-auto mb-4 text-red-400" />
            <p className="text-red-400 mb-4">{error}</p>
            <button
              onClick={refreshData}
              className="px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Try Again
            </button>
          </div>
        </div>
      </AdminLayout>
    )
  }

  const username = user?.username || user?.name || 'Admin'

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-full overflow-hidden bg-white/10 border border-white/10 flex items-center justify-center">
              {user?.profile_image_url || user?.profile_image_path ? (
                <img
                  src={user.profile_image_url || `/storage/${user.profile_image_path}`}
                  alt={username}
                  className="w-full h-full object-cover"
                />
              ) : (
                <User className="w-6 h-6 text-gray-400" />
              )}
            </div>
            <div>
              <h1 className="text-3xl font-bold">Welcome back, {username}</h1>
              <p className="text-gray-400 mt-1">Here's what's happening with your platform today.</p>
            </div>
          </div>
          <button
            onClick={refreshData}
            className="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
          >
            <RefreshCw className="w-4 h-4" />
            Refresh
          </button>
        </div>

        {/* Compact Stats Row */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <DashboardStatsCard
            title="Site Visits"
            value={stats?.site_visits.total || 0}
            change={stats?.site_visits.today || 0}
            changeLabel="today"
            icon={<Eye className="w-6 h-6" />}
            color="blue"
          />
          <DashboardStatsCard
            title="Contact Messages"
            value={stats?.contact_messages.total || 0}
            change={stats?.contact_messages.unread || 0}
            changeLabel="unread"
            icon={<Mail className="w-6 h-6" />}
            color="green"
          />
          <DashboardStatsCard
            title="Job Applications"
            value={stats?.job_applications.total || 0}
            change={stats?.job_applications.pending || 0}
            changeLabel="pending"
            icon={<Briefcase className="w-6 h-6" />}
            color="purple"
          />
          <DashboardStatsCard
            title="Feedback"
            value={stats?.feedback.total || 0}
            change={stats?.feedback.pending || 0}
            changeLabel="pending"
            icon={<Star className="w-6 h-6" />}
            color="yellow"
          />
        </div>

        {/* World Map - Full Width */}
        <div className="bg-white/5 border border-white/10 rounded-xl p-6">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-xl font-semibold">Global Visitors</h2>
            <Globe className="w-5 h-5 text-gray-400" />
          </div>
          <DashboardWorldMap data={worldMapData} />
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Top Countries</div>
              <div className="text-lg font-semibold">{worldMapData.length}</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Visits Today</div>
              <div className="text-lg font-semibold">{stats?.site_visits.today.toLocaleString()}</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Unique Visitors</div>
              <div className="text-lg font-semibold">{stats?.site_visits.unique_today?.toLocaleString() || 0}</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Avg. Session</div>
              <div className="text-lg font-semibold">{Math.round((stats?.site_visits.avg_session_seconds_today || 0) / 60)} min</div>
            </div>
          </div>
        </div>

        {/* Site Analytics Section */}
        <div className="bg-white/5 border border-white/10 rounded-xl p-6">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-xl font-semibold">Site Analytics</h2>
            <div className="flex items-center gap-2">
              <BarChart3 className="w-5 h-5 text-gray-400" />
              <a
                href="/admin/analytics"
                className="text-sm text-neon-purple hover:text-neon-purple/80 flex items-center gap-1"
              >
                View Full Analytics <ChevronRight className="w-4 h-4" />
              </a>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <Eye className="w-4 h-4 text-blue-400" />
                <span className="text-xs text-gray-400">Page Views</span>
              </div>
              <div className="text-2xl font-bold text-white">{stats?.site_visits.total?.toLocaleString() || 0}</div>
              <div className="text-xs text-green-400">+{stats?.site_visits.today || 0} today</div>
            </div>

            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <Users className="w-4 h-4 text-green-400" />
                <span className="text-xs text-gray-400">Unique Visitors</span>
              </div>
              <div className="text-2xl font-bold text-white">{stats?.site_visits.unique_today?.toLocaleString() || 0}</div>
              <div className="text-xs text-blue-400">Today</div>
            </div>

            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <Clock className="w-4 h-4 text-purple-400" />
                <span className="text-xs text-gray-400">Avg. Session</span>
              </div>
              <div className="text-2xl font-bold text-white">{Math.round((stats?.site_visits.avg_session_seconds_today || 0) / 60)}m</div>
              <div className="text-xs text-gray-400">Duration</div>
            </div>

            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <Globe className="w-4 h-4 text-cyan-400" />
                <span className="text-xs text-gray-400">Countries</span>
              </div>
              <div className="text-2xl font-bold text-white">{worldMapData.length}</div>
              <div className="text-xs text-gray-400">Reached</div>
            </div>
          </div>

          {/* Top Pages */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 className="text-lg font-medium mb-4 flex items-center gap-2">
                <FileText className="w-4 h-4 text-blue-400" />
                Top Pages
              </h3>
              <div className="space-y-2">
                {stats?.top_pages?.slice(0, 5).map((page, index) => (
                  <div key={index} className="flex items-center justify-between py-2 px-3 bg-white/5 rounded-lg">
                    <span className="text-sm text-gray-300 truncate">{page.page || '/'}</span>
                    <span className="text-sm font-medium text-white">{page.visits}</span>
                  </div>
                )) || (
                  <div className="text-center py-4 text-gray-400">No page data available</div>
                )}
              </div>
            </div>

            <div>
              <h3 className="text-lg font-medium mb-4 flex items-center gap-2">
                <Activity className="w-4 h-4 text-green-400" />
                Browser Stats
              </h3>
              <div className="space-y-2">
                {stats?.browser_stats?.slice(0, 5).map((browser, index) => (
                  <div key={index} className="flex items-center justify-between py-2 px-3 bg-white/5 rounded-lg">
                    <span className="text-sm text-gray-300">{browser.browser}</span>
                    <span className="text-sm font-medium text-white">{browser.visits}</span>
                  </div>
                )) || (
                  <div className="text-center py-4 text-gray-400">No browser data available</div>
                )}
              </div>
            </div>
          </div>
        </div>

        {/* Recent Data Section */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Recent Messages */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-xl font-semibold">Recent Messages</h2>
              <Mail className="w-5 h-5 text-gray-400" />
            </div>
            <div className="space-y-4">
              {stats?.contact_messages.recent && stats.contact_messages.recent.length > 0 ? (
                stats.contact_messages.recent.map((message) => (
                  <div key={message.id} className="bg-white/5 border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors">
                    <div className="flex justify-between items-start mb-2">
                      <h3 className="font-medium text-white truncate">{message.name}</h3>
                      <span className="text-xs text-gray-400">
                        {new Date(message.created_at).toLocaleDateString()}
                      </span>
                    </div>
                    <p className="text-sm text-gray-300 mb-2 truncate">{message.subject}</p>
                    <p className="text-xs text-gray-400 truncate">{message.email}</p>
                  </div>
                ))
              ) : (
                <div className="text-center py-6">
                  <Mail className="w-8 h-8 text-gray-500 mx-auto mb-2" />
                  <p className="text-gray-400">No recent messages</p>
                </div>
              )}
              <a href="/admin/messages" className="inline-flex items-center gap-1 text-sm text-neon-purple hover:text-neon-purple/80">
                View all messages <ChevronRight className="w-4 h-4" />
              </a>
            </div>
          </div>

          {/* Recent Applications */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-xl font-semibold">Recent Applications</h2>
              <Briefcase className="w-5 h-5 text-gray-400" />
            </div>
            <div className="space-y-4">
              {stats?.job_applications.recent && stats.job_applications.recent.length > 0 ? (
                stats.job_applications.recent.map((application) => (
                  <div key={application.id} className="bg-white/5 border border-white/10 rounded-lg p-4 hover:bg-white/10 transition-colors">
                    <div className="flex justify-between items-start mb-2">
                      <h3 className="font-medium text-white truncate">{application.first_name} {application.last_name}</h3>
                      <span className="text-xs text-gray-400">
                        {new Date(application.created_at).toLocaleDateString()}
                      </span>
                    </div>
                    <p className="text-sm text-gray-300 mb-2 truncate">Position: {application.job.title}</p>
                    <div className="flex justify-between items-center">
                      <p className="text-xs text-gray-400 truncate">{application.email}</p>
                      <span className="px-2 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-300">{application.status}</span>
                    </div>
                  </div>
                ))
              ) : (
                <div className="text-center py-6">
                  <Briefcase className="w-8 h-8 text-gray-500 mx-auto mb-2" />
                  <p className="text-gray-400">No recent applications</p>
                </div>
              )}
              <a href="/admin/job-applications" className="inline-flex items-center gap-1 text-sm text-neon-purple hover:text-neon-purple/80">
                View all applications <ChevronRight className="w-4 h-4" />
              </a>
            </div>
          </div>
        </div>
        
        {/* Site Visits Stats */}
        <div className="bg-white/5 border border-white/10 rounded-xl p-6">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-xl font-semibold">Site Visits</h2>
            <Eye className="w-5 h-5 text-gray-400" />
          </div>
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Total Visits</div>
              <div className="text-2xl font-bold"><AnimatedCounter target={stats?.site_visits.total || 0} /></div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">Today</div>
              <div className="text-2xl font-bold">{stats?.site_visits.today.toLocaleString()}</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">This Week</div>
              <div className="text-2xl font-bold">{stats?.site_visits.this_week.toLocaleString()}</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <div className="text-xs text-gray-400">This Month</div>
              <div className="text-2xl font-bold">{stats?.site_visits.this_month.toLocaleString()}</div>
            </div>
          </div>
          <a href="/admin/analytics" className="inline-flex items-center gap-1 text-sm text-neon-purple hover:text-neon-purple/80">
            View detailed analytics <ChevronRight className="w-4 h-4" />
          </a>
        </div>

        {/* Quick Actions */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <DashboardQuickActionCard
            title="Pending Users"
            count={stats?.users.pending_approval || 0}
            href="/admin/users"
            icon={<UserCheck className="w-5 h-5" />}
            color="orange"
          />
          <DashboardQuickActionCard
            title="Unread Messages"
            count={stats?.contact_messages.unread || 0}
            href="/admin/messages"
            icon={<MessageSquare className="w-5 h-5" />}
            color="blue"
          />
          <DashboardQuickActionCard
            title="Pending Feedback"
            count={stats?.feedback.pending || 0}
            href="/admin/feedback"
            icon={<Star className="w-5 h-5" />}
            color="yellow"
          />
          <DashboardQuickActionCard
            title="New Applications"
            count={stats?.job_applications.pending || 0}
            href="/admin/job-applications"
            icon={<FileText className="w-5 h-5" />}
            color="green"
          />
        </div>
      </div>
    </AdminLayout>
  )
}

// Stats Card Component
const DashboardStatsCard: React.FC<{
  title: string
  value: number
  change: number
  changeLabel: string
  icon: React.ReactNode
  color: 'blue' | 'green' | 'purple' | 'yellow'
}> = ({ title, value, change, changeLabel, icon, color }) => {
  const colorClasses = {
    blue: 'text-blue-400 bg-blue-500/10 border-blue-500/20',
    green: 'text-green-400 bg-green-500/10 border-green-500/20',
    purple: 'text-purple-400 bg-purple-500/10 border-purple-500/20',
    yellow: 'text-yellow-400 bg-yellow-500/10 border-yellow-500/20',
  }

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      transition={{ duration: 0.4 }}
      className="bg-white/5 border border-white/10 rounded-xl p-6 hover:bg-white/10 transition-colors"
    >
      <div className="flex items-center justify-between mb-4">
        <div className={`p-3 rounded-lg ${colorClasses[color]}`}>
          {icon}
        </div>
        <TrendingUp className="w-4 h-4 text-gray-400" />
      </div>
      <div>
        <h3 className="text-3xl font-bold text-white mb-1">
          <AnimatedCounter target={value} />
        </h3>
        <p className="text-gray-400 text-sm">
          {title}
        </p>
        <p className="text-xs text-gray-500 mt-2">
          +{change} {changeLabel}
        </p>
      </div>
    </motion.div>
  )
}

// Quick Action Card Component
const DashboardQuickActionCard: React.FC<{
  title: string
  count: number
  href: string
  icon: React.ReactNode
  color: 'blue' | 'green' | 'purple' | 'yellow' | 'orange'
}> = ({ title, count, href, icon, color }) => {
  const colorClasses = {
    blue: 'text-blue-400 bg-blue-500/10 border-blue-500/20',
    green: 'text-green-400 bg-green-500/10 border-green-500/20',
    purple: 'text-purple-400 bg-purple-500/10 border-purple-500/20',
    yellow: 'text-yellow-400 bg-yellow-500/10 border-yellow-500/20',
    orange: 'text-orange-400 bg-orange-500/10 border-orange-500/20',
  }

  return (
    <motion.a
      href={href}
      initial={{ opacity: 0, scale: 0.95 }}
      animate={{ opacity: 1, scale: 1 }}
      whileHover={{ scale: 1.02 }}
      className="block bg-white/5 border border-white/10 rounded-xl p-4 hover:bg-white/10 transition-all"
    >
      <div className="flex items-center justify-between">
        <div>
          <p className="text-sm text-gray-400">{title}</p>
          <p className="text-2xl font-bold text-white">{count}</p>
        </div>
        <div className={`p-2 rounded-lg ${colorClasses[color]}`}>
          {icon}
        </div>
      </div>
    </motion.a>
  )
}

// Modern World Map Component
const DashboardWorldMap: React.FC<{ data: WorldMapData[] }> = ({ data }) => {
  const maxVisits = Math.max(...data.map(d => d.visits), 1)
  const [tooltipCountry, setTooltipCountry] = useState<WorldMapData | null>(null)

  return (
    <div className="space-y-4">
      <div className="relative">
        <BubbleWorldMap
          data={data.map(d => ({ code: d.country_code, name: d.country, visits: d.visits }))}
        />
        
        {/* Country Tooltip */}
        {tooltipCountry && (
          <div className="absolute top-0 right-0 bg-black/80 border border-white/20 rounded-lg p-3 shadow-lg z-10">
            <div className="flex items-center gap-2 mb-2">
              <div className="w-6 h-6 rounded overflow-hidden bg-white/10 flex items-center justify-center">
                <Flag code={tooltipCountry.country_code} width={22} />
              </div>
              <span className="font-medium">{tooltipCountry.country}</span>
            </div>
            <div className="text-sm text-gray-300">
              <div className="flex justify-between gap-4">
                <span>Total Visits:</span>
                <span className="font-medium">{tooltipCountry.visits.toLocaleString()}</span>
              </div>
              <div className="flex justify-between gap-4">
                <span>Unique Visitors:</span>
                <span className="font-medium">{tooltipCountry.unique_visitors.toLocaleString()}</span>
              </div>
            </div>
          </div>
        )}
      </div>

      {/* Top Countries List */}
      <div className="space-y-2">
        <h4 className="text-sm font-medium text-gray-400 mb-3">Top Countries</h4>
        {data.slice(0, 8).map((country) => (
          <div 
            key={country.country_code} 
            className="flex items-center justify-between py-2 px-2 rounded-lg hover:bg-white/5 transition-colors cursor-pointer"
            onMouseEnter={() => setTooltipCountry(country)}
            onMouseLeave={() => setTooltipCountry(null)}
          >
            <div className="flex items-center gap-3 min-w-0">
              <div className="w-6 h-6 rounded overflow-hidden bg-white/10 flex items-center justify-center">
                <Flag code={country.country_code} width={22} />
              </div>
              <span className="text-sm text-white truncate">{country.country}</span>
            </div>
            <div className="flex items-center gap-3">
              <div className="w-28 h-2 bg-white/10 rounded-full overflow-hidden">
                <div
                  className="h-full bg-neon-purple rounded-full"
                  style={{ width: `${(country.visits / maxVisits) * 100}%` }}
                />
              </div>
              <span className="text-sm text-gray-300 w-14 text-right">
                {country.visits}
              </span>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Dashboard

