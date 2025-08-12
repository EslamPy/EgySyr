import React, { useEffect, useMemo, useState } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { Mail, Search, Calendar, Download, Trash2 } from 'lucide-react'

interface ContactMessage {
  id: number
  name: string
  email: string
  subject: string
  message: string
  created_at: string
}

interface Paginated<T> {
  data: T[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

const MessagesPage: React.FC = () => {
  const [items, setItems] = useState<ContactMessage[]>([])
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState<string | null>(null)
  const [q, setQ] = useState('')
  const [from, setFrom] = useState('')
  const [to, setTo] = useState('')
  const [page, setPage] = useState(1)
  const [meta, setMeta] = useState<{ current_page: number; last_page: number; total: number }>({ current_page: 1, last_page: 1, total: 0 })

  const params = useMemo(() => {
    const p = new URLSearchParams()
    if (q) p.set('q', q)
    if (from) p.set('from', from)
    if (to) p.set('to', to)
    p.set('page', String(page))
    return p.toString()
  }, [q, from, to, page])

  const load = async () => {
    setLoading(true)
    setError(null)
    try {
      const res = await fetch(`/api/admin/messages?${params}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      if (!res.ok) throw new Error('Failed to load messages')
      const data: Paginated<ContactMessage> = await res.json()
      setItems(data.data)
      setMeta({ current_page: data.current_page, last_page: data.last_page, total: data.total })
    } catch (e: any) {
      setError(e.message || 'Error loading messages')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => { load() }, [params])

  const exportCsv = () => {
    window.open('/api/admin/messages/export', '_blank')
  }

  const destroy = async (id: number) => {
    try {
      const res = await fetch(`/api/admin/messages/${id}`, { method: 'DELETE', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      if (!res.ok) throw new Error('Failed to delete')
      await load()
    } catch (e) {
      alert('Failed to delete message')
    }
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-bold">Contact Messages</h1>
          <button onClick={exportCsv} className="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 text-sm">
            <Download className="w-4 h-4" /> Export CSV
          </button>
        </div>

        {/* Filters */}
        <div className="flex flex-wrap items-center gap-3 bg-white/5 border border-white/10 rounded-xl p-3">
          <div className="flex items-center gap-2 px-3 py-2 rounded-lg bg-black/30 border border-white/10">
            <Search className="w-4 h-4 text-gray-400" />
            <input value={q} onChange={(e) => { setPage(1); setQ(e.target.value) }} placeholder="Search name, email, subject" className="bg-transparent outline-none text-sm" />
          </div>
          <div className="flex items-center gap-2 px-3 py-2 rounded-lg bg-black/30 border border-white/10">
            <Calendar className="w-4 h-4 text-gray-400" />
            <input type="date" value={from} onChange={(e) => { setPage(1); setFrom(e.target.value) }} className="bg-transparent outline-none text-sm" />
          </div>
          <div className="flex items-center gap-2 px-3 py-2 rounded-lg bg-black/30 border border-white/10">
            <Calendar className="w-4 h-4 text-gray-400" />
            <input type="date" value={to} onChange={(e) => { setPage(1); setTo(e.target.value) }} className="bg-transparent outline-none text-sm" />
          </div>
          <button onClick={() => { setQ(''); setFrom(''); setTo(''); setPage(1) }} className="text-xs text-gray-300 hover:text-white">Clear</button>
        </div>

        <div className="bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
          {loading && <div className="p-6 text-gray-400">Loading...</div>}
          {error && <div className="p-6 text-red-400">{error}</div>}
          {!loading && !error && (
            <div className="overflow-x-auto">
              <table className="min-w-full text-sm">
                <thead>
                  <tr className="text-left text-gray-400">
                    <th className="py-3 px-4">ID</th>
                    <th className="py-3 px-4">Name</th>
                    <th className="py-3 px-4">Email</th>
                    <th className="py-3 px-4">Subject</th>
                    <th className="py-3 px-4">Message</th>
                    <th className="py-3 px-4">Date</th>
                    <th className="py-3 px-4 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-white/10">
                  {items.map(m => (
                    <tr key={m.id}>
                      <td className="py-3 px-4 text-gray-400">{m.id}</td>
                      <td className="py-3 px-4">{m.name}</td>
                      <td className="py-3 px-4 text-gray-300 flex items-center gap-2"><Mail className="w-3 h-3" />{m.email}</td>
                      <td className="py-3 px-4">{m.subject}</td>
                      <td className="py-3 px-4 max-w-[360px] truncate" title={m.message}>{m.message}</td>
                      <td className="py-3 px-4 text-gray-500">{new Date(m.created_at).toLocaleString()}</td>
                      <td className="py-3 px-4 text-right">
                        <button onClick={() => destroy(m.id)} className="inline-flex items-center gap-2 px-2 py-1 rounded border border-white/10 text-gray-300 hover:bg-white/10"><Trash2 className="w-3 h-3" /> Delete</button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>

        {/* Pagination */}
        <div className="flex items-center justify-between text-sm text-gray-400">
          <div>Page {meta.current_page} of {meta.last_page} • {meta.total} total</div>
          <div className="flex items-center gap-2">
            <button disabled={page <= 1} onClick={() => setPage(p => Math.max(1, p - 1))} className={`px-3 py-1 rounded border ${page <= 1 ? 'border-white/10 text-gray-500' : 'border-white/20 hover:bg-white/10'}`}>Prev</button>
            <button disabled={page >= meta.last_page} onClick={() => setPage(p => Math.min(meta.last_page, p + 1))} className={`px-3 py-1 rounded border ${page >= meta.last_page ? 'border-white/10 text-gray-500' : 'border-white/20 hover:bg-white/10'}`}>Next</button>
          </div>
        </div>
      </div>
    </AdminLayout>
  )
}

export default MessagesPage 