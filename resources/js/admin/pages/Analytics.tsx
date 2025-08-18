import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { BubbleWorldMap } from '../components/BubbleWorldMap'
import {
  BarChart3, PieChart, TrendingUp, Users, Eye, Globe,
  Calendar, RefreshCw, Download, Filter, ArrowUp, ArrowDown,
  Monitor, Smartphone, Tablet, MapPin
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
}

const Analytics: React.FC = () => {
  const [data, setData] = useState<AnalyticsData | null>(null)
  const [worldMapData, setWorldMapData] = useState<WorldMapData[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [period, setPeriod] = useState('30') // days

  const fetchAnalytics = async () => {
    try {
      setLoading(true)
      setError(null)

      // Get CSRF token first
      await fetch('/sanctum/csrf-cookie', {
        credentials: 'include',
      })

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

      // Fetch world map data
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

  const getBrowserIcon = (browser: string) => {
    // Using Globe icon for all browsers since specific browser icons don't exist in lucide-react
    return <Globe className="w-4 h-4" />
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
            {/* Period Filter */}
            <select
              value={period}
              onChange={(e) => setPeriod(e.target.value)}
              className="px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
            >
              <option value="7">Last 7 days</option>
              <option value="30">Last 30 days</option>
              <option value="90">Last 90 days</option>
              <option value="365">Last year</option>
            </select>
            
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

        {/* Visits Over Time Chart */}
        <div className="bg-white/5 border border-white/10 rounded-xl p-6">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-xl font-semibold">Visits Over Time</h2>
            <TrendingUp className="w-5 h-5 text-gray-400" />
          </div>
          <VisitsChart data={data?.visits_over_time || []} />
        </div>

        {/* World Map Analytics */}
        <div className="bg-white/5 border border-white/10 rounded-xl p-6">
          <div className="flex items-center justify-between mb-6">
            <div>
              <h2 className="text-xl font-semibold">Global Visitor Analytics</h2>
              <p className="text-gray-400 text-sm mt-1">
                Hover over countries to see visitor counts and statistics
              </p>
            </div>
            <div className="flex items-center gap-2">
              <MapPin className="w-5 h-5 text-gray-400" />
              <span className="text-sm text-gray-400">
                {worldMapData.length} countries reached
              </span>
            </div>
          </div>

          {worldMapData.length > 0 ? (
            <div className="space-y-6">
              <BubbleWorldMap
                data={worldMapData.map(d => ({
                  code: d.country_code,
                  name: d.country,
                  visits: d.visits
                }))}
              />

              {/* World Map Stats */}
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
          ) : (
            <div className="h-64 flex items-center justify-center">
              <div className="text-center">
                <Globe className="w-12 h-12 mx-auto mb-2 text-gray-400" />
                <p className="text-gray-400">No geographic data available</p>
              </div>
            </div>
          )}
        </div>

        {/* Stats Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {/* Top Pages */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <h3 className="text-lg font-semibold mb-4">Top Pages</h3>
            <div className="space-y-3">
              {data?.top_pages.slice(0, 5).map((page, index) => (
                <div key={index} className="flex items-center justify-between">
                  <span className="text-sm text-gray-300 truncate flex-1 mr-2">
                    {page.page}
                  </span>
                  <span className="text-sm font-medium text-white">
                    {page.visits}
                  </span>
                </div>
              ))}
            </div>
          </div>

          {/* Browser Stats */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <h3 className="text-lg font-semibold mb-4">Browsers</h3>
            <div className="space-y-3">
              {data?.browser_stats.map((browser, index) => (
                <div key={index} className="flex items-center justify-between">
                  <div className="flex items-center gap-2">
                    {getBrowserIcon(browser.browser)}
                    <span className="text-sm text-gray-300">
                      {browser.browser}
                    </span>
                  </div>
                  <span className="text-sm font-medium text-white">
                    {browser.visits}
                  </span>
                </div>
              ))}
            </div>
          </div>

          {/* Device Stats */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <h3 className="text-lg font-semibold mb-4">Devices</h3>
            <div className="space-y-3">
              {data?.device_stats.map((device, index) => (
                <div key={index} className="flex items-center justify-between">
                  <div className="flex items-center gap-2">
                    {getDeviceIcon(device.device)}
                    <span className="text-sm text-gray-300">
                      {device.device}
                    </span>
                  </div>
                  <span className="text-sm font-medium text-white">
                    {device.visits}
                  </span>
                </div>
              ))}
            </div>
          </div>

          {/* Top Countries */}
          <div className="bg-white/5 border border-white/10 rounded-xl p-6">
            <h3 className="text-lg font-semibold mb-4">Top Countries</h3>
            <div className="space-y-3">
              {data?.top_countries.slice(0, 5).map((country, index) => (
                <div key={index} className="flex items-center justify-between">
                  <span className="text-sm text-gray-300">
                    {country.country}
                  </span>
                  <span className="text-sm font-medium text-white">
                    {country.visits}
                  </span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  )
}

// Visits Chart Component
const VisitsChart: React.FC<{
  data: Array<{ date: string; visits: number; unique_visitors: number }>
}> = ({ data }) => {
  if (!data || data.length === 0) {
    return (
      <div className="h-64 flex items-center justify-center">
        <div className="text-center">
          <BarChart3 className="w-12 h-12 mx-auto mb-2 text-gray-400" />
          <p className="text-gray-400">No data available</p>
        </div>
      </div>
    )
  }

  const maxVisits = Math.max(...data.map(d => d.visits), 1)
  const maxUniqueVisitors = Math.max(...data.map(d => d.unique_visitors), 1)

  return (
    <div className="h-64">
      <div className="flex items-center justify-between mb-4">
        <div className="flex items-center gap-4">
          <div className="flex items-center gap-2">
            <div className="w-3 h-3 bg-neon-purple rounded-full"></div>
            <span className="text-sm text-gray-400">Total Visits</span>
          </div>
          <div className="flex items-center gap-2">
            <div className="w-3 h-3 bg-neon-cyan rounded-full"></div>
            <span className="text-sm text-gray-400">Unique Visitors</span>
          </div>
        </div>
      </div>

      <div className="relative h-48">
        <svg viewBox="0 0 100 100" className="w-full h-full">
          {/* Grid lines */}
          {[0, 25, 50, 75, 100].map(y => (
            <line
              key={y}
              x1="0"
              y1={y}
              x2="100"
              y2={y}
              stroke="rgba(255,255,255,0.1)"
              strokeWidth="0.5"
            />
          ))}

          {/* Visits line */}
          <polyline
            points={data.map((d, i) =>
              `${(i / (data.length - 1)) * 100},${100 - (d.visits / maxVisits) * 100}`
            ).join(' ')}
            fill="none"
            stroke="#8B5CF6"
            strokeWidth="2"
          />

          {/* Unique visitors line */}
          <polyline
            points={data.map((d, i) =>
              `${(i / (data.length - 1)) * 100},${100 - (d.unique_visitors / maxUniqueVisitors) * 100}`
            ).join(' ')}
            fill="none"
            stroke="#06B6D4"
            strokeWidth="2"
          />

          {/* Data points */}
          {data.map((d, i) => (
            <g key={i}>
              <circle
                cx={(i / (data.length - 1)) * 100}
                cy={100 - (d.visits / maxVisits) * 100}
                r="2"
                fill="#8B5CF6"
              />
              <circle
                cx={(i / (data.length - 1)) * 100}
                cy={100 - (d.unique_visitors / maxUniqueVisitors) * 100}
                r="2"
                fill="#06B6D4"
              />
            </g>
          ))}
        </svg>

        {/* X-axis labels */}
        <div className="flex justify-between mt-2 text-xs text-gray-500">
          {data.filter((_, i) => i % Math.ceil(data.length / 5) === 0).map((d, i) => (
            <span key={i}>
              {new Date(d.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}
            </span>
          ))}
        </div>
      </div>
    </div>
  )
}

export default Analytics
