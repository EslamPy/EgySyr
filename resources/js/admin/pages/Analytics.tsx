import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { BubbleWorldMap } from '../components/BubbleWorldMap'
import AnalyticsChart from '../components/AnalyticsChart'
import ActiveUsersChart from '../components/ActiveUsersChart'
import {
  BarChart3, PieChart, TrendingUp, Users, Eye, Globe,
  Calendar, RefreshCw, Download, Filter, ArrowUp, ArrowDown,
  Monitor, Smartphone, Tablet, MapPin, Mail, Briefcase,
  MessageSquare, Activity, MoreVertical
} from 'lucide-react'
import { motion } from 'framer-motion'
import toast from 'react-hot-toast'

interface WorldMapData {
  country: string
  country_code: string
  visits: number
  unique_visitors: number
}

interface AnalyticsData {
  visits_over_time: Array<{
    date: string
    visits: number
    unique_visitors: number
  }>
  top_pages: Array<{
    page: string
    visits: number
  }>
  browser_stats: Array<{
    browser: string
    visits: number
  }>
  device_stats: Array<{
    device: string
    visits: number
  }>
  top_countries: Array<{
    country: string
    visits: number
  }>
  active_users_history: Array<{
    time: string
    count: number
  }>
}

type DropdownKey = 'topPages' | 'activeUsers' | 'devices' | 'countries';

const Analytics: React.FC = () => {
  const [data, setData] = useState<AnalyticsData | null>(null)
  const [worldMapData, setWorldMapData] = useState<WorldMapData[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [period, setPeriod] = useState('30') // days
  const [selectedPeriod, setSelectedPeriod] = useState('optionTwo')
  const [dropdownStates, setDropdownStates] = useState<Record<DropdownKey, boolean>>({
    topPages: false,
    activeUsers: false,
    devices: false,
    countries: false,
  })

  const toggleDropdown = (key: DropdownKey) => {
    setDropdownStates(prev => ({
      ...prev,
      [key]: !prev[key]
    }))
  }

  const closeDropdown = (key: DropdownKey) => {
    setDropdownStates(prev => ({
      ...prev,
      [key]: false
    }))
  }

  const fetchAnalytics = async () => {
    try {
      setLoading(true)
      setError(null)

      const response = await fetch(`/api/admin/analytics?period=${period}`, {
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
      })

      if (response.ok) {
        const analyticsData = await response.json()
        setData(analyticsData)
      } else {
        setError('Failed to load analytics data')
      }

      const worldMapResponse = await fetch('/api/admin/dashboard/world-map', {
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
      })

      if (worldMapResponse.ok) {
        const worldMapData = await worldMapResponse.json()
        setWorldMapData(worldMapData)
      }

    } catch (err) {
      console.error('Failed to fetch analytics:', err)
      setError('Failed to load analytics data')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchAnalytics()
  }, [period])

  const refreshData = () => {
    fetchAnalytics()
    toast.success('Analytics data refreshed!')
  }

  const exportData = async () => {
    try {
      const response = await fetch(`/api/admin/analytics/export?period=${period}`, {
        credentials: 'include',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        },
      })

      if (response.ok) {
        const blob = await response.blob()
        const url = window.URL.createObjectURL(blob)
        const a = document.createElement('a')
        a.href = url
        a.download = `analytics-${period}days.csv`
        document.body.appendChild(a)
        a.click()
        window.URL.revokeObjectURL(url)
        document.body.removeChild(a)
        toast.success('Analytics exported successfully!')
      } else {
        toast.error('Failed to export analytics')
      }
    } catch (err) {
      toast.error('Failed to export analytics')
    }
  }

  const getDeviceIcon = (device: string) => {
    switch (device.toLowerCase()) {
      case 'mobile': return <Smartphone className="w-4 h-4" />
      case 'tablet': return <Tablet className="w-4 h-4" />
      default: return <Monitor className="w-4 h-4" />
    }
  }

  if (loading) {
    return (
      <AdminLayout>
        <div className="flex items-center justify-center min-h-[400px]">
          <div className="text-center">
            <RefreshCw className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-purple" />
            <p className="text-gray-400">Loading analytics...</p>
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
            <BarChart3 className="w-12 h-12 mx-auto mb-4 text-red-400" />
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

  if (!data) return null

  const totalVisits = data.visits_over_time.reduce((sum, d) => sum + d.visits, 0) || 0
  const totalUniqueVisitors = data.visits_over_time.reduce((sum, d) => sum + d.unique_visitors, 0) || 0
  const avgDailyVisits = data.visits_over_time.length ? Math.round(totalVisits / data.visits_over_time.length) : 0

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold">Site Analytics</h1>
            <p className="text-gray-400 mt-1">
              Comprehensive insights into your website performance
            </p>
          </div>
          <div className="flex items-center gap-3">
            <button
              onClick={exportData}
              className="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
            >
              <Download className="w-4 h-4" />
              Export
            </button>

            <button
              onClick={refreshData}
              className="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
            >
              <RefreshCw className="w-4 h-4" />
              Refresh
            </button>
          </div>
        </div>

        {/* Metric Cards */}
        <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:gap-6 xl:grid-cols-4">
          {/* Total Visitors */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.1 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5"
          >
            <p className="text-sm text-gray-400">Total Visitors</p>
            <div className="mt-3 flex items-end justify-between">
              <div>
                <h4 className="text-2xl font-bold text-white">{totalVisits}</h4>
              </div>
              <div className="flex items-center gap-1">
                <span className="flex items-center gap-1 rounded-full bg-green-500/20 px-2 py-0.5 text-xs font-medium text-green-400">
                  <ArrowUp className="w-3 h-3" />
                  20%
                </span>
              </div>
            </div>
          </motion.div>

          {/* Unique Visitors */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5"
          >
            <p className="text-sm text-gray-400">Unique Visitors</p>
            <div className="mt-3 flex items-end justify-between">
              <div>
                <h4 className="text-2xl font-bold text-white">{totalUniqueVisitors}</h4>
              </div>
              <div className="flex items-center gap-1">
                <span className="flex items-center gap-1 rounded-full bg-green-500/20 px-2 py-0.5 text-xs font-medium text-green-400">
                  <ArrowUp className="w-3 h-3" />
                  15%
                </span>
              </div>
            </div>
          </motion.div>

          {/* Average Daily */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.3 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5"
          >
            <p className="text-sm text-gray-400">Avg. Daily Visits</p>
            <div className="mt-3 flex items-end justify-between">
              <div>
                <h4 className="text-2xl font-bold text-white">{avgDailyVisits}</h4>
              </div>
              <div className="flex items-center gap-1">
                <span className="flex items-center gap-1 rounded-full bg-red-500/20 px-2 py-0.5 text-xs font-medium text-red-400">
                  <ArrowDown className="w-3 h-3" />
                  2%
                </span>
              </div>
            </div>
          </motion.div>

          {/* Job Applications */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.4 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5"
          >
            <p className="text-sm text-gray-400">Job Applications</p>
            <div className="mt-3 flex items-end justify-between">
              <div>
                <h4 className="text-2xl font-bold text-white">{worldMapData.length}</h4>
              </div>
              <div className="flex items-center gap-1">
                <span className="flex items-center gap-1 rounded-full bg-green-500/20 px-2 py-0.5 text-xs font-medium text-green-400">
                  <ArrowUp className="w-3 h-3" />
                  7%
                </span>
              </div>
            </div>
          </motion.div>
        </div>

        {/* Analytics Chart */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ delay: 0.5 }}
          className="bg-white/5 border border-white/10 rounded-xl px-5 pt-5 sm:px-6 sm:pt-6"
        >
          <div className="flex flex-wrap items-start justify-between gap-5">
            <div>
              <h3 className="mb-1 text-lg font-semibold text-white">Site Analytics Overview</h3>
              <span className="block text-sm text-gray-400">Visitor analytics over time</span>
            </div>

            <div className="flex items-center gap-0.5 rounded-lg bg-white/5 p-0.5">
              <button
                onClick={() => { setSelectedPeriod('optionOne'); setPeriod('365') }}
                className={`rounded-md px-3 py-2 text-sm font-medium transition-colors ${selectedPeriod === 'optionOne'
                  ? 'bg-white/10 text-white shadow-sm'
                  : 'text-gray-400 hover:text-white'
                  }`}
              >
                12 months
              </button>
              <button
                onClick={() => { setSelectedPeriod('optionTwo'); setPeriod('30') }}
                className={`rounded-md px-3 py-2 text-sm font-medium transition-colors ${selectedPeriod === 'optionTwo'
                  ? 'bg-white/10 text-white shadow-sm'
                  : 'text-gray-400 hover:text-white'
                  }`}
              >
                30 days
              </button>
              <button
                onClick={() => { setSelectedPeriod('optionThree'); setPeriod('7') }}
                className={`rounded-md px-3 py-2 text-sm font-medium transition-colors ${selectedPeriod === 'optionThree'
                  ? 'bg-white/10 text-white shadow-sm'
                  : 'text-gray-400 hover:text-white'
                  }`}
              >
                7 days
              </button>
              <button
                onClick={() => { setSelectedPeriod('optionFour'); setPeriod('1') }}
                className={`rounded-md px-3 py-2 text-sm font-medium transition-colors ${selectedPeriod === 'optionFour'
                  ? 'bg-white/10 text-white shadow-sm'
                  : 'text-gray-400 hover:text-white'
                  }`}
              >
                24 hours
              </button>
            </div>
          </div>
          <AnalyticsChart
            selectedPeriod={selectedPeriod}
            data={data.visits_over_time}
          />
        </motion.div>

        {/* Top Pages & Device Stats */}
        <div className="grid grid-cols-1 gap-6 xl:grid-cols-7">
          {/* Top Pages Card */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.6 }}
            className="xl:col-span-4 bg-white/5 border border-white/10 rounded-xl p-5 md:p-6"
          >
            <div className="flex items-start justify-between">
              <h3 className="text-lg font-semibold text-white">Top Pages</h3>
              <div className="relative">
                <button
                  onClick={() => toggleDropdown('topPages')}
                  className={dropdownStates.topPages ? 'text-white' : 'text-gray-400 hover:text-white'}
                >
                  <MoreVertical className="w-5 h-5" />
                </button>
                {dropdownStates.topPages && (
                  <div
                    onClick={() => closeDropdown('topPages')}
                    className="absolute right-0 top-full z-40 w-40 space-y-1 rounded-xl border border-white/10 bg-deep-charcoal p-2 shadow-lg"
                  >
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">View All Pages</button>
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">Export Data</button>
                  </div>
                )}
              </div>
            </div>

            <div className="my-6">
              <div className="flex items-center justify-between border-b border-white/10 pb-4">
                <span className="text-xs text-gray-400">Page</span>
                <span className="text-right text-xs text-gray-400">Visits</span>
              </div>
              {data?.top_pages.slice(0, 6).map((page, idx) => (
                <div key={idx} className="flex items-center justify-between border-b border-white/10 py-3">
                  <span className="text-sm text-gray-300 truncate max-w-[200px]">{page.page}</span>
                  <span className="text-right text-sm text-white font-medium">{page.visits}</span>
                </div>
              ))}
            </div>

            <a href="#" className="flex justify-center gap-2 rounded-lg border border-white/10 bg-white/5 p-2.5 text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white">
              View All Pages
              <ArrowUp className="w-4 h-4 rotate-45" />
            </a>
          </motion.div>

          {/* Active Users */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.7 }}
            className="xl:col-span-3 bg-white/5 border border-white/10 rounded-xl p-5 md:p-6"
          >
            <div className="flex items-start justify-between">
              <h3 className="text-lg font-semibold text-white">Activity Overview</h3>
              <Activity className="w-5 h-5 text-gray-400" />
            </div>

            <div className="mt-6 flex items-end gap-1.5">
              <div className="flex items-center gap-2.5">
                <span className="relative inline-block w-5 h-5">
                  <span className="absolute w-2 h-2 transform -translate-x-1/2 -translate-y-1/2 rounded-full bg-green-500 top-1/2 left-1/2">
                    <span className="absolute inline-flex w-4 h-4 rounded-full opacity-75 bg-green-400 -top-1 -left-1 animate-ping"></span>
                  </span>
                </span>
                <span className="font-semibold text-white text-title-sm">{avgDailyVisits}</span>
              </div>
              <span className="block mb-1 text-gray-400 text-sm">Average daily visits</span>
            </div>

            <div className="my-5 min-h-[120px] rounded-xl bg-white/5 flex items-center justify-center">
              <ActiveUsersChart data={data.active_users_history} />
            </div>

            <div className="flex items-center justify-center gap-6">
              <div>
                <p className="text-lg font-semibold text-center text-white">{totalVisits}</p>
                <p className="text-xs mt-0.5 text-center text-gray-400">Total</p>
              </div>

              <div className="w-px bg-white/10 h-11"></div>

              <div>
                <p className="text-lg font-semibold text-center text-white">{totalUniqueVisitors}</p>
                <p className="text-xs mt-0.5 text-center text-gray-400">Unique</p>
              </div>

              <div className="w-px bg-white/10 h-11"></div>

              <div>
                <p className="text-lg font-semibold text-center text-white">{avgDailyVisits}</p>
                <p className="text-xs mt-0.5 text-center text-gray-400">Avg. Daily</p>
              </div>
            </div>
          </motion.div>
        </div>

        {/* Devices & Countries */}
        <div className="grid grid-cols-1 gap-6 xl:grid-cols-2">
          {/* Device Stats */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.8 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5 sm:p-6"
          >
            <div className="flex justify-between">
              <div>
                <h3 className="text-lg font-semibold text-white">Devices & Browsers</h3>
                <p className="mt-1 text-sm text-gray-400">Traffic breakdown by device type</p>
              </div>
              <div className="relative h-fit">
                <button
                  onClick={() => toggleDropdown('devices')}
                  className={dropdownStates.devices ? 'text-white' : 'text-gray-400 hover:text-white'}
                >
                  <MoreVertical className="w-5 h-5" />
                </button>
                {dropdownStates.devices && (
                  <div
                    onClick={() => closeDropdown('devices')}
                    className="absolute right-0 top-full z-40 w-40 space-y-1 rounded-xl border border-white/10 bg-deep-charcoal p-2 shadow-lg"
                  >
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">View Details</button>
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">Export</button>
                  </div>
                )}
              </div>
            </div>

            <div className="mt-6 space-y-4">
              {data.device_stats.map((device, index) => {
                const total = data.device_stats.reduce((sum, d) => sum + d.visits, 0)
                const percentage = total > 0 ? Math.round((device.visits / total) * 100) : 0
                return (
                  <div key={index}>
                    <div className="flex items-center justify-between mb-2">
                      <div className="flex items-center gap-3">
                        <div className="p-2 bg-white/5 rounded-lg">
                          {getDeviceIcon(device.device)}
                        </div>
                        <div>
                          <p className="font-semibold text-white text-sm">{device.device}</p>
                          <span className="block text-gray-400 text-xs">{device.visits} Visitors</span>
                        </div>
                      </div>
                      <p className="font-medium text-white text-sm">{percentage}%</p>
                    </div>
                    <div className="relative block h-2 w-full rounded-sm bg-white/5">
                      <div
                        className="absolute left-0 top-0 h-full rounded-sm bg-neon-purple"
                        style={{ width: `${percentage}%` }}
                      ></div>
                    </div>
                  </div>
                )
              })}
            </div>
          </motion.div>

          {/* Top Countries */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.9 }}
            className="bg-white/5 border border-white/10 rounded-xl p-5 sm:p-6"
          >
            <div className="flex justify-between">
              <div>
                <h3 className="text-lg font-semibold text-white">Top Countries</h3>
                <p className="mt-1 text-sm text-gray-400">Visitors by location</p>
              </div>
              <div className="relative h-fit">
                <button
                  onClick={() => toggleDropdown('countries')}
                  className={dropdownStates.countries ? 'text-white' : 'text-gray-400 hover:text-white'}
                >
                  <MoreVertical className="w-5 h-5" />
                </button>
                {dropdownStates.countries && (
                  <div
                    onClick={() => closeDropdown('countries')}
                    className="absolute right-0 top-full z-40 w-40 space-y-1 rounded-xl border border-white/10 bg-deep-charcoal p-2 shadow-lg"
                  >
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">View Map</button>
                    <button className="flex w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-gray-400 hover:bg-white/5 hover:text-gray-300">Export</button>
                  </div>
                )}
              </div>
            </div>

            <div className="mt-6 space-y-5">
              {data.top_countries.slice(0, 5).map((country, index) => {
                const total = data.top_countries.reduce((sum, c) => sum + c.visits, 0)
                const percentage = total > 0 ? Math.round((country.visits / total) * 100) : 0
                return (
                  <div key={index} className="flex items-center justify-between">
                    <div className="flex items-center gap-3">
                      <div className="flex items-center justify-center w-10 h-10 rounded-full bg-white/5">
                        <Globe className="w-5 h-5 text-gray-400" />
                      </div>
                      <div>
                        <p className="font-semibold text-white text-sm">{country.country}</p>
                        <span className="block text-gray-400 text-xs">{country.visits} Visitors</span>
                      </div>
                    </div>

                    <div className="flex w-full max-w-[140px] items-center gap-3">
                      <div className="relative block h-2 w-full max-w-[100px] rounded-sm bg-white/5">
                        <div
                          className="absolute left-0 top-0 h-full rounded-sm bg-neon-cyan"
                          style={{ width: `${percentage}%` }}
                        ></div>
                      </div>
                      <p className="font-medium text-white text-sm">{percentage}%</p>
                    </div>
                  </div>
                )
              })}
            </div>
          </motion.div>
        </div>

        {/* World Map Analytics */}
        {worldMapData.length > 0 && (
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.0 }}
            className="bg-white/5 border border-white/10 rounded-xl p-6"
          >
            <div className="flex items-center justify-between mb-6">
              <div>
                <h2 className="text-xl font-semibold">Global Visitor Analytics</h2>
                <p className="text-gray-400 text-sm mt-1">
                  Interactive map showing visitor distribution worldwide
                </p>
              </div>
              <div className="flex items-center gap-2">
                <MapPin className="w-5 h-5 text-gray-400" />
                <span className="text-sm text-gray-400">
                  {worldMapData.length} countries reached
                </span>
              </div>
            </div>

            <div className="space-y-6">
              <BubbleWorldMap
                data={worldMapData.map(d => ({
                  code: d.country_code,
                  name: d.country,
                  visits: d.visits
                }))}
              />

              <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                  <div className="text-xs text-gray-400 mb-1">Total Countries</div>
                  <div className="text-2xl font-bold text-white">{worldMapData.length}</div>
                </div>
                <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                  <div className="text-xs text-gray-400 mb-1">Total Visits</div>
                  <div className="text-2xl font-bold text-white">
                    {worldMapData.reduce((sum, country) => sum + country.visits, 0).toLocaleString()}
                  </div>
                </div>
                <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                  <div className="text-xs text-gray-400 mb-1">Unique Visitors</div>
                  <div className="text-2xl font-bold text-white">
                    {worldMapData.reduce((sum, country) => sum + country.unique_visitors, 0).toLocaleString()}
                  </div>
                </div>
                <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                  <div className="text-xs text-gray-400 mb-1">Top Country</div>
                  <div className="text-lg font-bold text-white">
                    {worldMapData.length > 0 ? worldMapData[0].country : 'N/A'}
                  </div>
                </div>
              </div>
            </div>
          </motion.div>
        )}
      </div>
    </AdminLayout>
  )
}






export default Analytics
