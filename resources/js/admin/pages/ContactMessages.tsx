import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Search, Download, Trash2, Mail, Calendar, User, 
  MessageSquare, RefreshCw, Eye, Filter, X
} from 'lucide-react'
import toast from 'react-hot-toast'

interface ContactMessage {
  id: number
  name: string
  email: string
  subject: string
  message: string
  created_at: string
}

interface PaginatedResponse {
  data: ContactMessage[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

const ContactMessages: React.FC = () => {
  const [messages, setMessages] = useState<ContactMessage[]>([])
  const [pagination, setPagination] = useState<Omit<PaginatedResponse, 'data'> | null>(null)
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedMessage, setSelectedMessage] = useState<ContactMessage | null>(null)
  const [currentPage, setCurrentPage] = useState(1)

  const fetchMessages = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('q', searchTerm)

      const response = await fetch(`/api/admin/messages?${params}`)
      if (!response.ok) throw new Error('Failed to fetch messages')

      const data: PaginatedResponse = await response.json()
      setMessages(data.data)
      setPagination({
        current_page: data.current_page,
        last_page: data.last_page,
        per_page: data.per_page,
        total: data.total,
      })
    } catch (error) {
      toast.error('Failed to load messages')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchMessages(currentPage)
  }, [currentPage, searchTerm])

  const deleteMessage = async (id: number) => {
    if (!confirm('Are you sure you want to delete this message?')) return

    try {
      await fetch('/sanctum/csrf-cookie', { credentials: 'include' })
      const response = await fetch(`/api/admin/messages/${id}`, {
        method: 'DELETE',
        credentials: 'include',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      })

      if (!response.ok) throw new Error('Failed to delete message')

      toast.success('Message deleted successfully!')
      fetchMessages(currentPage)
    } catch (error) {
      toast.error('Failed to delete message')
    }
  }

  const exportMessages = async () => {
    try {
      await fetch('/sanctum/csrf-cookie', { credentials: 'include' })
      const response = await fetch('/api/admin/messages/export', { credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      if (!response.ok) throw new Error('Failed to export messages')

      const blob = await response.blob()
      const url = window.URL.createObjectURL(blob)
      const a = document.createElement('a')
      a.href = url
      a.download = `contact_messages_${new Date().toISOString().split('T')[0]}.xlsx`
      document.body.appendChild(a)
      a.click()
      window.URL.revokeObjectURL(url)
      document.body.removeChild(a)

      toast.success('Messages exported successfully!')
    } catch (error) {
      toast.error('Failed to export messages')
    }
  }

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault()
    setCurrentPage(1)
    fetchMessages(1)
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">Contact Messages</h1>
            <p className="text-gray-400 mt-1">
              {pagination ? `${pagination.total} total messages` : 'Loading...'}
            </p>
          </div>
          <div className="flex items-center gap-3">
            <button
              onClick={exportMessages}
              className="inline-flex items-center gap-2 px-4 py-2 bg-neon-cyan hover:bg-neon-cyan/80 text-white rounded-lg transition-colors"
            >
              <Download className="w-4 h-4" />
              Export Excel
            </button>
            <button
              onClick={() => fetchMessages(currentPage)}
              className="p-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
            >
              <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
            </button>
          </div>
        </div>

        {/* Search */}
        <form onSubmit={handleSearch} className="flex gap-3">
          <div className="relative flex-1">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
            <input
              type="text"
              placeholder="Search messages by name, email, subject, or content..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
            />
          </div>
          <button
            type="submit"
            className="px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
          >
            Search
          </button>
          {searchTerm && (
            <button
              type="button"
              onClick={() => {
                setSearchTerm('')
                setCurrentPage(1)
              }}
              className="px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
            >
              Clear
            </button>
          )}
        </form>

        {/* Messages List */}
        <div className="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
          {loading ? (
            <div className="p-8 text-center">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading messages...</p>
            </div>
          ) : messages.length === 0 ? (
            <div className="p-8 text-center">
              <MessageSquare className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">
                {searchTerm ? 'No messages found matching your search' : 'No messages yet'}
              </p>
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {messages.map((message) => (
                <div key={message.id} className="p-6 hover:bg-white/5 transition-colors">
                  <div className="flex items-start justify-between gap-4">
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-4 mb-2">
                        <div className="flex items-center gap-2">
                          <User className="w-4 h-4 text-gray-400" />
                          <span className="font-medium">{message.name}</span>
                        </div>
                        <div className="flex items-center gap-2">
                          <Mail className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-400">{message.email}</span>
                        </div>
                        <div className="flex items-center gap-2">
                          <Calendar className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-400">
                            {new Date(message.created_at).toLocaleDateString()}
                          </span>
                        </div>
                      </div>

                      <h3 className="font-medium text-white mb-2">{message.subject}</h3>
                      
                      <p className="text-gray-300 line-clamp-2">{message.message}</p>
                    </div>

                    <div className="flex items-center gap-2">
                      <button
                        onClick={() => setSelectedMessage(message)}
                        className="p-2 text-gray-400 hover:text-white transition-colors"
                        title="View full message"
                      >
                        <Eye className="w-4 h-4" />
                      </button>
                      <button
                        onClick={() => deleteMessage(message.id)}
                        className="p-2 text-red-400 hover:text-red-300 transition-colors"
                        title="Delete message"
                      >
                        <Trash2 className="w-4 h-4" />
                      </button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>

        {/* Pagination */}
        {pagination && pagination.last_page > 1 && (
          <div className="flex items-center justify-between">
            <p className="text-sm text-gray-400">
              Showing {((pagination.current_page - 1) * pagination.per_page) + 1} to{' '}
              {Math.min(pagination.current_page * pagination.per_page, pagination.total)} of{' '}
              {pagination.total} messages
            </p>
            
            <div className="flex items-center gap-2">
              <button
                onClick={() => setCurrentPage(pagination.current_page - 1)}
                disabled={pagination.current_page === 1}
                className="px-3 py-1 bg-white/5 border border-white/10 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                Previous
              </button>
              
              {Array.from({ length: Math.min(5, pagination.last_page) }, (_, i) => {
                const page = i + Math.max(1, pagination.current_page - 2)
                if (page > pagination.last_page) return null
                
                return (
                  <button
                    key={page}
                    onClick={() => setCurrentPage(page)}
                    className={`px-3 py-1 rounded text-sm transition-colors ${
                      page === pagination.current_page
                        ? 'bg-neon-purple text-white'
                        : 'bg-white/5 border border-white/10 hover:bg-white/10'
                    }`}
                  >
                    {page}
                  </button>
                )
              })}
              
              <button
                onClick={() => setCurrentPage(pagination.current_page + 1)}
                disabled={pagination.current_page === pagination.last_page}
                className="px-3 py-1 bg-white/5 border border-white/10 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                Next
              </button>
            </div>
          </div>
        )}
      </div>

      {/* Message Details Modal */}
      {selectedMessage && (
        <MessageDetailsModal
          message={selectedMessage}
          onClose={() => setSelectedMessage(null)}
          onDelete={() => {
            deleteMessage(selectedMessage.id)
            setSelectedMessage(null)
          }}
        />
      )}
    </AdminLayout>
  )
}

// Message Details Modal Component
const MessageDetailsModal: React.FC<{
  message: ContactMessage
  onClose: () => void
  onDelete: () => void
}> = ({ message, onClose, onDelete }) => {
  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">Message Details</h3>
          <button
            onClick={onClose}
            className="p-1 text-gray-400 hover:text-white transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Sender Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Name</label>
              <p className="text-white">{message.name}</p>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Email</label>
              <p className="text-white">{message.email}</p>
            </div>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-400 mb-1">Date</label>
            <p className="text-white">{new Date(message.created_at).toLocaleString()}</p>
          </div>

          {/* Subject */}
          <div>
            <label className="block text-sm font-medium text-gray-400 mb-2">Subject</label>
            <p className="text-white font-medium">{message.subject}</p>
          </div>

          {/* Message */}
          <div>
            <label className="block text-sm font-medium text-gray-400 mb-2">Message</label>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <p className="text-white whitespace-pre-wrap">{message.message}</p>
            </div>
          </div>

          {/* Actions */}
          <div className="flex gap-3 pt-4 border-t border-white/10">
            <button
              onClick={() => {
                const subject = `Re: ${message.subject}`
                const body = `Hi ${message.name},\n\nThank you for your message. \n\n---\nOriginal message:\n${message.message}`
                window.location.href = `mailto:${message.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
              }}
              className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-neon-cyan hover:bg-neon-cyan/80 text-white rounded-lg transition-colors"
            >
              <Mail className="w-4 h-4" />
              Reply via Email
            </button>
            <button
              onClick={onDelete}
              className="flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
            >
              <Trash2 className="w-4 h-4" />
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}

export default ContactMessages
