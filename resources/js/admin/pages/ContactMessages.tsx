import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Search, Download, Trash2, Mail, Calendar, User, 
  MessageSquare, RefreshCw, Eye, Filter, X, ChevronDown,
  Clock, CheckCircle, AlertCircle
} from 'lucide-react'
import toast from 'react-hot-toast'
import { motion, AnimatePresence } from 'framer-motion'

interface ContactMessage {
  id: number
  name: string
  email: string
  subject: string
  message: string
  created_at: string
  read?: boolean
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
  const [filterOpen, setFilterOpen] = useState(false)
  const [dateFilter, setDateFilter] = useState<string>('all')
  const [readFilter, setReadFilter] = useState<string>('all')

  const fetchMessages = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('q', searchTerm)
      if (dateFilter !== 'all') params.append('date', dateFilter)
      if (readFilter !== 'all') params.append('read', readFilter)

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
  }, [currentPage, searchTerm, dateFilter, readFilter])

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

        {/* Search and Filter */}
        <div className="flex flex-col md:flex-row gap-3">
          <form onSubmit={handleSearch} className="flex gap-3 flex-1">
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
          
          <div className="flex gap-3">
            <div className="relative">
              <button 
                onClick={() => setFilterOpen(!filterOpen)}
                className="flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-colors"
              >
                <Filter className="w-4 h-4" />
                Filters
                <ChevronDown className={`w-4 h-4 transition-transform ${filterOpen ? 'rotate-180' : ''}`} />
              </button>
              
              <AnimatePresence>
                {filterOpen && (
                  <motion.div 
                    initial={{ opacity: 0, y: 10 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: 10 }}
                    transition={{ duration: 0.2 }}
                    className="absolute right-0 mt-2 w-64 bg-deep-charcoal border border-white/10 rounded-lg shadow-xl z-10"
                  >
                    <div className="p-4 space-y-4">
                      <div>
                        <label className="block text-sm font-medium text-gray-300 mb-2">Date</label>
                        <select
                          value={dateFilter}
                          onChange={(e) => {
                            setDateFilter(e.target.value)
                            setCurrentPage(1)
                          }}
                          className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
                        >
                          <option value="all">All time</option>
                          <option value="today">Today</option>
                          <option value="week">This week</option>
                          <option value="month">This month</option>
                        </select>
                      </div>
                      
                      <div>
                        <label className="block text-sm font-medium text-gray-300 mb-2">Status</label>
                        <select
                          value={readFilter}
                          onChange={(e) => {
                            setReadFilter(e.target.value)
                            setCurrentPage(1)
                          }}
                          className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
                        >
                          <option value="all">All messages</option>
                          <option value="read">Read</option>
                          <option value="unread">Unread</option>
                        </select>
                      </div>
                      
                      <div className="pt-2 border-t border-white/10">
                        <button
                          onClick={() => {
                            setDateFilter('all')
                            setReadFilter('all')
                            setCurrentPage(1)
                            setFilterOpen(false)
                          }}
                          className="w-full px-3 py-2 bg-white/5 hover:bg-white/10 text-gray-300 rounded-lg transition-colors text-sm"
                        >
                          Reset Filters
                        </button>
                      </div>
                    </div>
                  </motion.div>
                )}
              </AnimatePresence>
            </div>
          </div>
        </div>

        {/* Messages List */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {loading ? (
            <div className="col-span-full p-8 text-center bg-white/5 border border-white/10 rounded-xl">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading messages...</p>
            </div>
          ) : messages.length === 0 ? (
            <div className="col-span-full p-8 text-center bg-white/5 border border-white/10 rounded-xl">
              <MessageSquare className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">
                {searchTerm || dateFilter !== 'all' || readFilter !== 'all' 
                  ? 'No messages found matching your filters' 
                  : 'No messages yet'}
              </p>
            </div>
          ) : (
            <>
              {messages.map((message) => (
                <motion.div 
                  key={message.id} 
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.3 }}
                  className={`bg-white/5 border border-white/10 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-neon-purple/5 transition-all cursor-pointer group ${message.read ? '' : 'border-l-4 border-l-neon-cyan'}`}
                  onClick={() => setSelectedMessage(message)}
                >
                  <div className="p-5">
                    <div className="flex items-center justify-between mb-3">
                      <div className="flex items-center gap-2">
                        <div className="w-8 h-8 rounded-full bg-neon-purple/20 flex items-center justify-center">
                          <User className="w-4 h-4 text-neon-purple" />
                        </div>
                        <h3 className="font-medium text-white truncate">{message.name}</h3>
                      </div>
                      <div className="flex items-center gap-1">
                        {message.read ? (
                          <CheckCircle className="w-4 h-4 text-green-400" />
                        ) : (
                          <AlertCircle className="w-4 h-4 text-neon-cyan" />
                        )}
                      </div>
                    </div>
                    
                    <h4 className="font-medium text-white mb-2 truncate">{message.subject}</h4>
                    <p className="text-gray-300 text-sm line-clamp-2 mb-4">{message.message}</p>
                    
                    <div className="flex items-center justify-between text-xs text-gray-400 pt-3 border-t border-white/10">
                      <div className="flex items-center gap-1">
                        <Mail className="w-3 h-3" />
                        <span className="truncate max-w-[120px]">{message.email}</span>
                      </div>
                      <div className="flex items-center gap-1">
                        <Clock className="w-3 h-3" />
                        <span>{new Date(message.created_at).toLocaleDateString()}</span>
                      </div>
                    </div>
                  </div>
                  
                  <div className="flex bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button
                      onClick={(e) => {
                        e.stopPropagation();
                        setSelectedMessage(message);
                      }}
                      className="flex-1 py-2 text-center text-gray-300 hover:text-white hover:bg-white/10 transition-colors text-sm"
                    >
                      <Eye className="w-4 h-4 inline-block mr-1" />
                      View
                    </button>
                    <button
                      onClick={(e) => {
                        e.stopPropagation();
                        deleteMessage(message.id);
                      }}
                      className="flex-1 py-2 text-center text-red-400 hover:text-red-300 hover:bg-red-900/20 transition-colors text-sm"
                    >
                      <Trash2 className="w-4 h-4 inline-block mr-1" />
                      Delete
                    </button>
                  </div>
                </motion.div>
              ))}
            </>
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
  // Mark message as read when viewed
  const markAsRead = async () => {
    try {
      await fetch('/sanctum/csrf-cookie', { credentials: 'include' })
      await fetch(`/api/admin/messages/${message.id}/read`, {
        method: 'POST',
        credentials: 'include',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      })
    } catch (error) {
      // Silent fail - not critical
    }
  }

  useEffect(() => {
    markAsRead()
  }, [message.id])

  return (
    <div className="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4 backdrop-blur-sm">
      <motion.div 
        initial={{ opacity: 0, scale: 0.95 }}
        animate={{ opacity: 1, scale: 1 }}
        exit={{ opacity: 0, scale: 0.95 }}
        transition={{ duration: 0.2 }}
        className="bg-deep-charcoal border border-white/10 rounded-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col shadow-xl shadow-neon-purple/10"
      >
        <div className="flex items-center justify-between p-5 border-b border-white/10">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-full bg-neon-purple/20 flex items-center justify-center">
              <User className="w-5 h-5 text-neon-purple" />
            </div>
            <div>
              <h3 className="text-xl font-semibold">Message from {message.name}</h3>
              <p className="text-sm text-gray-400">{new Date(message.created_at).toLocaleString()}</p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-full transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="flex-1 overflow-y-auto p-5 space-y-6">
          {/* Email */}
          <div className="flex items-center gap-2 bg-white/5 px-4 py-3 rounded-lg">
            <Mail className="w-5 h-5 text-neon-cyan" />
            <a href={`mailto:${message.email}`} className="text-neon-cyan hover:underline">
              {message.email}
            </a>
          </div>

          {/* Subject */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Subject</label>
            <div className="bg-white/5 border border-white/10 rounded-lg px-4 py-3">
              <p className="text-white font-medium">{message.subject}</p>
            </div>
          </div>

          {/* Message */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Message</label>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4 min-h-[200px]">
              <p className="text-white whitespace-pre-wrap">{message.message}</p>
            </div>
          </div>
        </div>

        {/* Actions */}
        <div className="p-5 border-t border-white/10 bg-white/5">
          <div className="flex gap-3">
            <button
              onClick={() => {
                const subject = `Re: ${message.subject}`
                const body = `Hi ${message.name},\n\nThank you for your message. \n\n---\nOriginal message:\n${message.message}`
                window.location.href = `mailto:${message.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`
              }}
              className="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-neon-cyan hover:bg-neon-cyan/80 text-white rounded-lg transition-colors"
            >
              <Mail className="w-4 h-4" />
              Reply via Email
            </button>
            <button
              onClick={onDelete}
              className="flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
            >
              <Trash2 className="w-4 h-4" />
              Delete
            </button>
          </div>
        </div>
      </motion.div>
    </div>
  )
}

export default ContactMessages
