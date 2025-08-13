import { useState, useEffect } from 'react'

interface SiteVisitStats {
  today: number
  unique_today: number
  this_week: number
  this_month: number
  avg_session: number
  top_countries: Array<{
    country: string
    country_code: string
    visits: number
  }>
}

interface DashboardStats {
  site_visits: SiteVisitStats
  messages: {
    new_today: number
    total: number
  }
  feedback: {
    pending: number
    approved: number
  }
  jobs: {
    active: number
    new_applications: number
    total_applications: number
  }
}

interface VisitChartData {
  date: string
  visits: number
  unique_visits: number
}

interface WorldMapData {
  country_code: string
  country: string
  visits: number
  unique_visits: number
}

export const useDashboardData = () => {
  const [stats, setStats] = useState<DashboardStats | null>(null)
  const [chartData, setChartData] = useState<VisitChartData[]>([])
  const [worldMapData, setWorldMapData] = useState<WorldMapData[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  const fetchStats = async () => {
    try {
      const response = await fetch('/api/admin/dashboard/stats', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
          'Content-Type': 'application/json',
        },
      })
      
      if (!response.ok) {
        throw new Error('Failed to fetch dashboard stats')
      }
      
      const data = await response.json()
      setStats(data)
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Unknown error')
    }
  }

  const fetchChartData = async (period: string = '7days') => {
    try {
      const response = await fetch(`/api/admin/dashboard/visits-chart?period=${period}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
          'Content-Type': 'application/json',
        },
      })
      
      if (!response.ok) {
        throw new Error('Failed to fetch chart data')
      }
      
      const data = await response.json()
      setChartData(data)
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Unknown error')
    }
  }

  const fetchWorldMapData = async () => {
    try {
      const response = await fetch('/api/admin/dashboard/world-map', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
          'Content-Type': 'application/json',
        },
      })
      
      if (!response.ok) {
        throw new Error('Failed to fetch world map data')
      }
      
      const data = await response.json()
      setWorldMapData(data)
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Unknown error')
    }
  }

  useEffect(() => {
    const loadData = async () => {
      setLoading(true)
      await Promise.all([
        fetchStats(),
        fetchChartData(),
        fetchWorldMapData(),
      ])
      setLoading(false)
    }

    loadData()
  }, [])

  const refreshData = () => {
    fetchStats()
    fetchChartData()
    fetchWorldMapData()
  }

  return {
    stats,
    chartData,
    worldMapData,
    loading,
    error,
    refreshData,
    fetchChartData,
  }
}
