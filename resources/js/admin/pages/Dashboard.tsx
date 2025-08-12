import React from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { Users, Eye, Globe, Clock, Mail, Briefcase, User, TrendingUp } from 'lucide-react'
import { Stars } from '../components/Stars'
import { getCurrentUser } from '../utils/auth'
import { BubbleWorldMap } from '../components/BubbleWorldMap'

const mock = {
  stats: {
    visitsToday: 324,
    visits7d: [120, 180, 150, 220, 300, 260, 324],
    uniqueVisitors: 278,
    avgSession: '3m 24s',
    countries: 23,
    // Added: top countries breakdown (example data)
    countriesBreakdown: [
      { code: 'EG', name: 'Egypt', visits: 540 },
      { code: 'SA', name: 'Saudi Arabia', visits: 320 },
      { code: 'AE', name: 'United Arab Emirates', visits: 210 },
      { code: 'US', name: 'United States', visits: 150 },
      { code: 'DE', name: 'Germany', visits: 90 },
    ],
  },
  ratings: [
    { id: 1, name: 'Sarah Johnson', rating: 5, comment: 'Amazing work and support!', date: '2025-08-12' },
    { id: 2, name: 'Michael Chen', rating: 4, comment: 'Great results, quick delivery.', date: '2025-08-11' },
    { id: 3, name: 'Emily Rodriguez', rating: 5, comment: 'Exceeded expectations.', date: '2025-08-10' },
  ],
  careers: [
    { id: 'C-1024', name: 'Omar Ali', role: 'Full Stack Developer', status: 'New', date: '2025-08-12' },
    { id: 'C-1023', name: 'Fatima Ahmed', role: 'UI/UX Designer', status: 'Reviewed', date: '2025-08-11' },
    { id: 'C-1022', name: 'Youssef Samir', role: 'DevOps Engineer', status: 'Interview', date: '2025-08-09' },
  ],
  messages: [
    { id: 'M-209', name: 'Ahmed Hassan', email: 'ahmed@example.com', subject: 'Project Inquiry', date: '2025-08-12' },
    { id: 'M-208', name: 'Layla Noor', email: 'layla@example.com', subject: 'Partnership', date: '2025-08-11' },
    { id: 'M-207', name: 'Khaled Zaki', email: 'khaled@example.com', subject: 'Support', date: '2025-08-10' },
  ],
}

const AreaChart: React.FC<{ data: number[] }> = ({ data }) => {
  const max = Math.max(...data)
  const points = data.map((v, i) => `${(i / (data.length - 1)) * 100},${100 - (v / max) * 100}`).join(' ')
  const gradientId = 'gradVisits'
  return (
    <svg viewBox="0 0 100 100" className="w-full h-36">
      <defs>
        <linearGradient id={gradientId} x1="0" x2="0" y1="0" y2="1">
          <stop offset="0%" stopColor="#8B5CF6" stopOpacity="0.6" />
          <stop offset="100%" stopColor="#06B6D4" stopOpacity="0.1" />
        </linearGradient>
      </defs>
      <polyline fill={`url(#${gradientId})`} stroke="#8B5CF6" strokeWidth="0.6" points={`0,100 ${points} 100,100`} />
    </svg>
  )
}

// Donut chart showing Unique vs Total visits
const DonutChart: React.FC<{ total: number; unique: number }> = ({ total, unique }) => {
  const size = 160
  const stroke = 16
  const radius = (size - stroke) / 2
  const circumference = 2 * Math.PI * radius
  const uniquePct = total > 0 ? Math.min(100, Math.max(0, Math.round((unique / total) * 100))) : 0
  const uniqueLen = (uniquePct / 100) * circumference
  return (
    <div className="relative w-[160px] h-[160px]">
      <svg width={size} height={size} viewBox={`0 0 ${size} ${size}`}>
        <defs>
          <linearGradient id="donutGrad" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stopColor="#8B5CF6" />
            <stop offset="100%" stopColor="#06B6D4" />
          </linearGradient>
        </defs>
        <circle cx={size / 2} cy={size / 2} r={radius} stroke="#1f2937" strokeWidth={stroke} fill="none" />
        <circle
          cx={size / 2}
          cy={size / 2}
          r={radius}
          stroke="url(#donutGrad)"
          strokeWidth={stroke}
          fill="none"
          strokeDasharray={`${uniqueLen} ${circumference - uniqueLen}`}
          strokeLinecap="round"
          transform={`rotate(-90 ${size / 2} ${size / 2})`}
        />
      </svg>
      <div className="absolute inset-0 flex items-center justify-center">
        <div className="text-center">
          <div className="text-3xl font-extrabold">{uniquePct}%</div>
          <div className="text-xs text-gray-400">Unique</div>
        </div>
      </div>
    </div>
  )
}

function codeToFlagEmoji(code: string): string {
  if (!code || code.length !== 2) return ''
  const base = 127397
  const chars = code.toUpperCase().split('').map(c => String.fromCodePoint(base + c.charCodeAt(0)))
  return chars.join('')
}

const KPI: React.FC<{ icon: React.ReactNode; label: string; value: string | number }> = ({ icon, label, value }) => (
  <div className="bg-gradient-to-br from-deep-charcoal to-jet-black border border-white/10 rounded-2xl p-5 shadow-[0_10px_30px_rgba(0,0,0,0.25)]">
    <div className="flex items-center gap-3 text-gray-300 mb-2">{icon}<span className="text-sm">{label}</span></div>
    <div className="text-2xl font-bold">{value}</div>
  </div>
)

const SectionCard: React.FC<{ title: string; description?: string; action?: React.ReactNode; children: React.ReactNode }> = ({ title, description, action, children }) => (
  <div className="bg-white/5 border border-white/10 rounded-2xl p-5">
    <div className="flex items-center justify-between mb-4">
      <div>
        <div className="text-sm text-gray-400">{description}</div>
        <div className="text-xl font-semibold">{title}</div>
      </div>
      {action}
    </div>
    {children}
  </div>
)

const Dashboard: React.FC = () => {
  const user = getCurrentUser()
  const totalVisits = mock.stats.visits7d.reduce((sum, v) => sum + v, 0)
  const countries = mock.stats.countriesBreakdown
  const maxCountryVisits = Math.max(...countries.map(c => c.visits))
  const totalByCountries = countries.reduce((s, c) => s + c.visits, 0)
  const countriesSorted = [...countries].sort((a, b) => b.visits - a.visits)

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* User Profile Card */}
        <div className="relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-r from-neon-purple/10 to-neon-cyan/10 p-5">
          <div className="flex items-center gap-4">
            <div className="relative">
              <div className="w-16 h-16 rounded-2xl bg-white/10 border border-white/10 overflow-hidden">
                {user?.avatarDataUrl ? (
                  <img src={user.avatarDataUrl} alt="Avatar" className="w-full h-full object-cover" />
                ) : (
                  <div className="w-full h-full flex items-center justify-center">
                    <User className="w-6 h-6 text-gray-300" />
                  </div>
                )}
              </div>
            </div>
            <div className="min-w-0">
              <div className="text-sm text-gray-400">Welcome back</div>
              <div className="text-xl font-semibold truncate">{user?.email ?? 'Guest'}</div>
              <div className="text-xs text-gray-500">Here is your analytics overview</div>
            </div>
          </div>
          <div className="absolute -top-10 -right-10 w-40 h-40 rounded-full bg-neon-purple/20 blur-3xl" />
        </div>

        {/* KPIs */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <KPI icon={<Eye className="w-4 h-4 text-neon-purple" />} label="Visits Today" value={mock.stats.visitsToday} />
          <KPI icon={<Users className="w-4 h-4 text-neon-cyan" />} label="Unique Visitors" value={mock.stats.uniqueVisitors} />
          <KPI icon={<Clock className="w-4 h-4 text-neon-pink" />} label="Avg. Session" value={mock.stats.avgSession} />
          <KPI icon={<Globe className="w-4 h-4 text-electric-blue" />} label="Countries" value={mock.stats.countries} />
        </div>

        {/* Global Map */}
        <BubbleWorldMap data={countries} />

        {/* Audience Overview: Countries + Unique Visitors */}
        <SectionCard
          title="Audience Overview"
          description="Top countries and unique visitors"
          action={
            <div className="hidden md:flex items-center gap-2 text-xs">
              <span className="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-gray-300">7d</span>
              <span className="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-white cursor-pointer">30d</span>
              <span className="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-gray-400 hover:text-white cursor-pointer">90d</span>
            </div>
          }
        >
          <div className="grid grid-cols-1 lg:grid-cols-5 gap-6">
            {/* Countries list (left 3 cols) */}
            <div className="lg:col-span-3">
              <div className="flex items-center justify-between mb-2">
                <div className="text-sm text-gray-400">Top Countries</div>
                <div className="text-xs text-gray-500 flex items-center gap-1"><TrendingUp className="w-3 h-3" /> Last 7 days</div>
              </div>
              <div className="space-y-3">
                {countriesSorted.map((c, idx) => {
                  const pct = Math.round((c.visits / maxCountryVisits) * 100)
                  const share = Math.round((c.visits / (totalByCountries || 1)) * 100)
                  return (
                    <div key={c.code} className="p-3 rounded-xl bg-black/30 border border-white/10 hover:border-neon-purple/30 transition-colors">
                      <div className="flex items-center justify-between gap-4 mb-2">
                        <div className="flex items-center gap-3 min-w-0">
                          <span className="text-xs px-2 py-0.5 rounded-full bg-white/10 text-gray-300">#{idx + 1}</span>
                          <span className="text-lg">{codeToFlagEmoji(c.code)}</span>
                          <span className="font-medium truncate">{c.name}</span>
                        </div>
                        <div className="text-right">
                          <div className="text-sm font-semibold">{c.visits.toLocaleString()}</div>
                          <div className="text-xs text-gray-400">{share}% share</div>
                        </div>
                      </div>
                      <div className="h-2 rounded-full bg-white/10 overflow-hidden">
                        <div className="h-full bg-neon-gradient" style={{ width: `${pct}%` }} />
                      </div>
                    </div>
                  )
                })}
              </div>
            </div>

            {/* Unique visitors panel (right 2 cols) */}
            <div className="lg:col-span-2">
              <div className="p-4 rounded-xl bg-black/30 border border-white/10 h-full flex flex-col items-center justify-center gap-4">
                <DonutChart total={totalVisits} unique={mock.stats.uniqueVisitors} />
                <div className="grid grid-cols-3 gap-3 w-full">
                  <div className="rounded-lg bg-white/5 border border-white/10 p-3 text-center">
                    <div className="text-xs text-gray-400 mb-1">Unique</div>
                    <div className="text-lg font-bold">{mock.stats.uniqueVisitors.toLocaleString()}</div>
                  </div>
                  <div className="rounded-lg bg-white/5 border border-white/10 p-3 text-center">
                    <div className="text-xs text-gray-400 mb-1">Total (7d)</div>
                    <div className="text-lg font-bold">{totalVisits.toLocaleString()}</div>
                  </div>
                  <div className="rounded-lg bg-white/5 border border-white/10 p-3 text-center">
                    <div className="text-xs text-gray-400 mb-1">Countries</div>
                    <div className="text-lg font-bold">{mock.stats.countries}</div>
                  </div>
                </div>
                <div className="text-xs text-gray-500">Traffic quality improving • +4% WoW</div>
              </div>
            </div>
          </div>
        </SectionCard>

        {/* Two-column: Ratings and Careers */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <SectionCard title="Recent Client Ratings" description="Latest feedback" action={<a href="/admin/feedback" className="text-sm text-neon-cyan">View all</a>}>
            <div className="space-y-3">
              {mock.ratings.map(r => (
                <div key={r.id} className="flex items-start justify-between gap-3 p-3 rounded-xl bg-black/30 border border-white/10">
                  <div className="flex items-start gap-3">
                    <div className="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-sm">
                      <User className="w-4 h-4 text-gray-300" />
                    </div>
                    <div>
                      <div className="font-medium">{r.name}</div>
                      <div className="text-sm text-gray-400">{r.comment}</div>
                    </div>
                  </div>
                  <div className="flex flex-col items-end gap-1">
                    <Stars value={r.rating} />
                    <div className="text-xs text-gray-500">{r.date}</div>
                  </div>
                </div>
              ))}
            </div>
          </SectionCard>

          <SectionCard title="Careers Applications" description="Latest applicants" action={<a href="/admin/careers" className="text-sm text-neon-cyan">View all</a>}>
            <div className="divide-y divide-white/10">
              {mock.careers.map(c => (
                <div key={c.id} className="flex items-center justify-between py-3">
                  <div className="flex items-center gap-3">
                    <Briefcase className="w-4 h-4 text-neon-purple" />
                    <div>
                      <div className="font-medium">{c.name}</div>
                      <div className="text-xs text-gray-400">{c.role}</div>
                    </div>
                  </div>
                  <div className="text-right">
                    <span className={`text-xs px-2 py-1 rounded-full border ${c.status === 'New' ? 'border-neon-cyan text-neon-cyan' : c.status === 'Interview' ? 'border-neon-pink text-neon-pink' : 'border-white/20 text-gray-300'}`}>{c.status}</span>
                    <div className="text-xs text-gray-500 mt-1">{c.date}</div>
                  </div>
                </div>
              ))}
            </div>
          </SectionCard>
        </div>

        {/* Contact Messages */}
        <SectionCard title="Contact Messages" description="Latest form submissions" action={<a href="/admin/messages" className="text-sm text-neon-cyan">View all</a>}>
          <div className="overflow-x-auto">
            <table className="min-w-full text-sm">
              <thead>
                <tr className="text-left text-gray-400">
                  <th className="py-2 pr-4">ID</th>
                  <th className="py-2 pr-4">Name</th>
                  <th className="py-2 pr-4">Email</th>
                  <th className="py-2 pr-4">Subject</th>
                  <th className="py-2 pr-4">Date</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-white/10">
                {mock.messages.map(m => (
                  <tr key={m.id}>
                    <td className="py-2 pr-4 text-gray-400">{m.id}</td>
                    <td className="py-2 pr-4">{m.name}</td>
                    <td className="py-2 pr-4 text-gray-300 flex items-center gap-2"><Mail className="w-3 h-3" />{m.email}</td>
                    <td className="py-2 pr-4">{m.subject}</td>
                    <td className="py-2 pr-4 text-gray-500">{m.date}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </SectionCard>
      </div>
    </AdminLayout>
  )
}

export default Dashboard 