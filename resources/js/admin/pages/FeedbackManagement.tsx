import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import {
  Plus, Search, Filter, Download, Eye, Check, X, Trash2,
  Star, Calendar, User, Mail, Building, MessageSquare,
  Copy, CheckCircle, ExternalLink, RefreshCw
} from 'lucide-react'
import toast from 'react-hot-toast'

// Utility function to get CSRF token
const getCSRFToken = (): string | null => {
  const metaTag = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
  return metaTag ? metaTag.content : null
}

interface FeedbackItem {
  id: number
  token: string
  client_name: string
  client_email: string
  company_name?: string
  feedback_text?: string
  rating?: number
  status: 'pending' | 'approved' | 'denied'
  submitted_at?: string
  reviewed_at?: string
  reviewer?: { name: string }
  created_at: string
}

interface FeedbackStats {
  total: number
  pending: number
  approved: number
  denied: number
  links_generated: number
  links_unused: number
}

const FeedbackManagement: React.FC = () => {
  const [feedback, setFeedback] = useState<FeedbackItem[]>([])
  const [stats, setStats] = useState<FeedbackStats | null>(null)
  const [loading, setLoading] = useState(true)
  const [activeTab, setActiveTab] = useState<'all' | 'pending' | 'approved' | 'denied'>('all')
  const [searchTerm, setSearchTerm] = useState('')
  const [showGenerateModal, setShowGenerateModal] = useState(false)
  const [selectedFeedback, setSelectedFeedback] = useState<FeedbackItem | null>(null)

  const fetchFeedback = async () => {
    try {
      const params = new URLSearchParams()
      if (activeTab !== 'all') params.append('status', activeTab)
      if (searchTerm) params.append('search', searchTerm)

      const response = await fetch(`/api/admin/feedback?${params}`, { credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      const data = await response.json()
      setFeedback(data.data || [])
    } catch (error) {
      toast.error('Failed to load feedback')
    }
  }

  const fetchStats = async () => {
    try {
      const response = await fetch('/api/admin/feedback/stats', { credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      const data = await response.json()
      setStats(data)
    } catch (error) {
      console.error('Failed to load stats')
    }
  }

  useEffect(() => {
    const loadData = async () => {
      setLoading(true)
      await Promise.all([fetchFeedback(), fetchStats()])
      setLoading(false)
    }
    loadData()
  }, [activeTab, searchTerm])

  const generateFeedbackLink = async (formData: {
    client_name: string
    company_name?: string
  }) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch('/api/admin/feedback/generate-link', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
        body: JSON.stringify(formData),
      })

      const data = await response.json()

      if (!response.ok) {
        throw new Error(data.message || data.error || 'Failed to generate link')
      }

      toast.success('Feedback link generated successfully!')

      // Copy to clipboard
      const feedbackUrl = `${window.location.origin}/feedback/${data.token}`
      await navigator.clipboard.writeText(feedbackUrl)
      toast.success('Link copied to clipboard!')

      setShowGenerateModal(false)
      fetchFeedback()
      fetchStats()
    } catch (error) {
      console.error('Generate link error:', error)
      toast.error(error instanceof Error ? error.message : 'Failed to generate feedback link')
    }
  }

  const approveFeedback = async (id: number) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/feedback/${id}/approve`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
      })

      if (!response.ok) throw new Error('Failed to approve')

      toast.success('Feedback approved successfully!')
      fetchFeedback()
      fetchStats()
    } catch (error) {
      toast.error('Failed to approve feedback')
    }
  }

  const denyFeedback = async (id: number, notes?: string) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/feedback/${id}/deny`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
        body: JSON.stringify({ admin_notes: notes }),
      })

      if (!response.ok) throw new Error('Failed to deny')

      toast.success('Feedback denied successfully!')
      fetchFeedback()
      fetchStats()
    } catch (error) {
      toast.error('Failed to deny feedback')
    }
  }

  const deleteFeedback = async (id: number) => {
    if (!confirm('Are you sure you want to delete this feedback?')) return

    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/feedback/${id}`, {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
      })

      if (!response.ok) throw new Error('Failed to delete')

      toast.success('Feedback deleted successfully!')
      fetchFeedback()
      fetchStats()
    } catch (error) {
      toast.error('Failed to delete feedback')
    }
  }

  const renderStars = (rating: number) => {
    return (
      <div className="flex items-center gap-1">
        {[1, 2, 3, 4, 5].map((star) => (
          <Star
            key={star}
            className={`w-4 h-4 ${
              star <= rating
                ? 'text-yellow-400 fill-yellow-400'
                : 'text-gray-400'
            }`}
          />
        ))}
      </div>
    )
  }

  const filteredFeedback = feedback.filter(item => {
    if (activeTab === 'all') return true
    return item.status === activeTab
  })

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">Feedback Management</h1>
            <p className="text-gray-400 mt-1">Manage client feedback and testimonials</p>
          </div>
          <button
            onClick={() => setShowGenerateModal(true)}
            className="inline-flex items-center gap-2 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
          >
            <Plus className="w-4 h-4" />
            Generate Feedback Link
          </button>
        </div>

        {/* Stats Cards */}
        {stats && (
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-neon-cyan">{stats.total}</div>
              <div className="text-sm text-gray-400">Total Submitted</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-yellow-400">{stats.pending}</div>
              <div className="text-sm text-gray-400">Pending Review</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-green-400">{stats.approved}</div>
              <div className="text-sm text-gray-400">Approved</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-red-400">{stats.denied}</div>
              <div className="text-sm text-gray-400">Denied</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-blue-400">{stats.links_generated}</div>
              <div className="text-sm text-gray-400">Links Generated</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-orange-400">{stats.links_unused}</div>
              <div className="text-sm text-gray-400">Unused Links</div>
            </div>
          </div>
        )}

        {/* Filters and Search */}
        <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div className="flex items-center gap-2">
            {(['all', 'pending', 'approved', 'denied'] as const).map((tab) => (
              <button
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
                  activeTab === tab
                    ? 'bg-neon-purple text-white'
                    : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'
                }`}
              >
                {tab.charAt(0).toUpperCase() + tab.slice(1)}
              </button>
            ))}
          </div>

          <div className="flex items-center gap-3">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
              <input
                type="text"
                placeholder="Search feedback..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
              />
            </div>
            <button
              onClick={() => { fetchFeedback(); fetchStats(); }}
              className="p-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
            >
              <RefreshCw className={`${loading ? 'animate-spin' : ''} w-4 h-4`} />
            </button>
          </div>
        </div>

        {/* Feedback List */}
        <div className="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
          {loading ? (
            <div className="p-8 text-center">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading feedback...</p>
            </div>
          ) : filteredFeedback.length === 0 ? (
            <div className="p-8 text-center">
              <MessageSquare className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">No feedback found</p>
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {filteredFeedback.map((item) => (
                <div key={item.id} className="p-6 hover:bg-white/5 transition-colors">
                  <div className="flex items-start justify-between gap-4">
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-3 mb-2">
                        <div className="flex items-center gap-2">
                          <User className="w-4 h-4 text-gray-400" />
                          <span className="font-medium">{item.client_name}</span>
                        </div>
                        {item.company_name && (
                          <div className="flex items-center gap-2">
                            <Building className="w-4 h-4 text-gray-400" />
                            <span className="text-sm text-gray-400">{item.company_name}</span>
                          </div>
                        )}
                      </div>

                      {item.feedback_text && (
                        <div className="mb-3">
                          <p className="text-gray-300 line-clamp-2">{item.feedback_text}</p>
                        </div>
                      )}

                      <div className="flex items-center gap-4 text-sm text-gray-400">
                        {item.rating && (
                          <div className="flex items-center gap-2">
                            {renderStars(item.rating)}
                            <span>{item.rating}/5</span>
                          </div>
                        )}
                        <div className="flex items-center gap-1">
                          <Calendar className="w-4 h-4" />
                          {item.submitted_at 
                            ? new Date(item.submitted_at).toLocaleDateString()
                            : 'Not submitted'
                          }
                        </div>
                        {item.reviewer && (
                          <span>Reviewed by {item.reviewer.name}</span>
                        )}
                      </div>
                    </div>

                    <div className="flex items-center gap-2">
                      <span className={`px-2 py-1 rounded-full text-xs font-medium ${
                        item.status === 'approved' 
                          ? 'bg-green-500/20 text-green-400'
                          : item.status === 'denied'
                          ? 'bg-red-500/20 text-red-400'
                          : 'bg-yellow-500/20 text-yellow-400'
                      }`}>
                        {item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                      </span>

                      <div className="flex items-center gap-1">
                        {!item.submitted_at && (
                          <button
                            onClick={() => {
                              const url = `${window.location.origin}/feedback/${item.token}`
                              navigator.clipboard.writeText(url)
                              toast.success('Feedback link copied!')
                            }}
                            className="p-1 text-gray-400 hover:text-white transition-colors"
                            title="Copy feedback link"
                          >
                            <Copy className="w-4 h-4" />
                          </button>
                        )}

                        {item.submitted_at && item.status === 'pending' && (
                          <>
                            <button
                              onClick={() => approveFeedback(item.id)}
                              className="p-1 text-green-400 hover:text-green-300 transition-colors"
                              title="Approve feedback"
                            >
                              <Check className="w-4 h-4" />
                            </button>
                            <button
                              onClick={() => denyFeedback(item.id)}
                              className="p-1 text-red-400 hover:text-red-300 transition-colors"
                              title="Deny feedback"
                            >
                              <X className="w-4 h-4" />
                            </button>
                          </>
                        )}

                        <button
                          onClick={() => setSelectedFeedback(item)}
                          className="p-1 text-gray-400 hover:text-white transition-colors"
                          title="View details"
                        >
                          <Eye className="w-4 h-4" />
                        </button>

                        <button
                          onClick={() => deleteFeedback(item.id)}
                          className="p-1 text-red-400 hover:text-red-300 transition-colors"
                          title="Delete feedback"
                        >
                          <Trash2 className="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>

      {/* Generate Link Modal */}
      {showGenerateModal && (
        <GenerateLinkModal
          onClose={() => setShowGenerateModal(false)}
          onSubmit={generateFeedbackLink}
        />
      )}

      {/* Feedback Details Modal */}
      {selectedFeedback && (
        <FeedbackDetailsModal
          feedback={selectedFeedback}
          onClose={() => setSelectedFeedback(null)}
          onApprove={() => {
            approveFeedback(selectedFeedback.id)
            setSelectedFeedback(null)
          }}
          onDeny={(notes) => {
            denyFeedback(selectedFeedback.id, notes)
            setSelectedFeedback(null)
          }}
        />
      )}
    </AdminLayout>
  )
}

// Generate Link Modal Component
const GenerateLinkModal: React.FC<{
  onClose: () => void
  onSubmit: (data: { client_name: string; company_name?: string }) => void
}> = ({ onClose, onSubmit }) => {
  const [formData, setFormData] = useState({
    client_name: '',
    company_name: '',
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    onSubmit({
      client_name: formData.client_name,
      company_name: formData.company_name || undefined,
    })
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-md">
        <h3 className="text-xl font-semibold mb-4">Generate Feedback Link</h3>
        
        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Client Name *
            </label>
            <input
              type="text"
              required
              value={formData.client_name}
              onChange={(e) => setFormData({ ...formData, client_name: e.target.value })}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
              placeholder="Enter client name"
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Company Name (Optional)
            </label>
            <input
              type="text"
              value={formData.company_name}
              onChange={(e) => setFormData({ ...formData, company_name: e.target.value })}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
              placeholder="Enter company name"
            />
          </div>

          <div className="flex gap-3 pt-4">
            <button
              type="button"
              onClick={onClose}
              className="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
            >
              Cancel
            </button>
            <button
              type="submit"
              className="flex-1 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Generate Link
            </button>
          </div>
        </form>
      </div>
    </div>
  )
}

// Feedback Details Modal Component
const FeedbackDetailsModal: React.FC<{
  feedback: FeedbackItem
  onClose: () => void
  onApprove: () => void
  onDeny: (notes?: string) => void
}> = ({ feedback, onClose, onApprove, onDeny }) => {
  const [denyNotes, setDenyNotes] = useState('')
  const [showDenyForm, setShowDenyForm] = useState(false)

  const renderStars = (rating: number) => {
    return (
      <div className="flex items-center gap-1">
        {[1, 2, 3, 4, 5].map((star) => (
          <Star
            key={star}
            className={`w-5 h-5 ${
              star <= rating
                ? 'text-yellow-400 fill-yellow-400'
                : 'text-gray-400'
            }`}
          />
        ))}
      </div>
    )
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">Feedback Details</h3>
          <button
            onClick={onClose}
            className="p-1 text-gray-400 hover:text-white transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Client Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Client Name</label>
              <p className="text-white">{feedback.client_name}</p>
            </div>
            {feedback.company_name && (
              <div className="md:col-span-2">
                <label className="block text-sm font-medium text-gray-400 mb-1">Company</label>
                <p className="text-white">{feedback.company_name}</p>
              </div>
            )}
          </div>

          {/* Feedback Content */}
          {feedback.feedback_text && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Feedback</label>
              <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                <p className="text-white whitespace-pre-wrap">{feedback.feedback_text}</p>
              </div>
            </div>
          )}

          {/* Rating */}
          {feedback.rating && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Rating</label>
              <div className="flex items-center gap-3">
                {renderStars(feedback.rating)}
                <span className="text-white font-medium">{feedback.rating}/5</span>
              </div>
            </div>
          )}

          {/* Status and Dates */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Status</label>
              <span className={`inline-block px-3 py-1 rounded-full text-sm font-medium ${
                feedback.status === 'approved' 
                  ? 'bg-green-500/20 text-green-400'
                  : feedback.status === 'denied'
                  ? 'bg-red-500/20 text-red-400'
                  : 'bg-yellow-500/20 text-yellow-400'
              }`}>
                {feedback.status.charAt(0).toUpperCase() + feedback.status.slice(1)}
              </span>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Submitted</label>
              <p className="text-white">
                {feedback.submitted_at 
                  ? new Date(feedback.submitted_at).toLocaleString()
                  : 'Not submitted yet'
                }
              </p>
            </div>
          </div>

          {/* Feedback Link */}
          {!feedback.submitted_at && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Feedback Link</label>
              <div className="flex items-center gap-2">
                <input
                  type="text"
                  readOnly
                  value={`${window.location.origin}/feedback/${feedback.token}`}
                  className="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm"
                />
                <button
                  onClick={() => {
                    const url = `${window.location.origin}/feedback/${feedback.token}`
                    navigator.clipboard.writeText(url)
                    toast.success('Link copied!')
                  }}
                  className="px-3 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
                >
                  <Copy className="w-4 h-4" />
                </button>
              </div>
            </div>
          )}

          {/* Actions */}
          {feedback.submitted_at && feedback.status === 'pending' && (
            <div className="flex gap-3 pt-4 border-t border-white/10">
              {!showDenyForm ? (
                <>
                  <button
                    onClick={onApprove}
                    className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                  >
                    <Check className="w-4 h-4" />
                    Approve Feedback
                  </button>
                  <button
                    onClick={() => setShowDenyForm(true)}
                    className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                  >
                    <X className="w-4 h-4" />
                    Deny Feedback
                  </button>
                </>
              ) : (
                <div className="w-full space-y-3">
                  <textarea
                    placeholder="Reason for denial (optional)"
                    value={denyNotes}
                    onChange={(e) => setDenyNotes(e.target.value)}
                    className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
                    rows={3}
                  />
                  <div className="flex gap-2">
                    <button
                      onClick={() => setShowDenyForm(false)}
                      className="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
                    >
                      Cancel
                    </button>
                    <button
                      onClick={() => onDeny(denyNotes)}
                      className="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                    >
                      Confirm Denial
                    </button>
                  </div>
                </div>
              )}
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

export default FeedbackManagement
