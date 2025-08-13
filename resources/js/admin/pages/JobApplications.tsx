import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Search, Download, Trash2, Eye, User, Mail, Calendar,
  Briefcase, FileText, ExternalLink, RefreshCw, Filter,
  CheckCircle, XCircle, Clock, Star, Phone, Globe, X
} from 'lucide-react'
import toast from 'react-hot-toast'

interface JobApplication {
  id: number
  first_name: string
  last_name: string
  email: string
  phone: string
  cover_letter?: string
  cv_path: string
  linkedin_url?: string
  portfolio_url?: string
  years_experience?: number
  additional_info?: string
  status: 'pending' | 'reviewed' | 'shortlisted' | 'rejected'
  admin_notes?: string
  created_at: string
  reviewed_at?: string
  job: {
    id: number
    title: string
    slug: string
  }
  reviewer?: {
    name: string
  }
}

interface ApplicationStats {
  total: number
  pending: number
  reviewed: number
  shortlisted: number
  rejected: number
  today: number
  this_week: number
}

interface PaginatedResponse {
  data: JobApplication[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

const JobApplications: React.FC = () => {
  const [applications, setApplications] = useState<JobApplication[]>([])
  const [pagination, setPagination] = useState<Omit<PaginatedResponse, 'data'> | null>(null)
  const [stats, setStats] = useState<ApplicationStats | null>(null)
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')
  const [statusFilter, setStatusFilter] = useState<'all' | 'pending' | 'reviewed' | 'shortlisted' | 'rejected'>('all')
  const [selectedApplication, setSelectedApplication] = useState<JobApplication | null>(null)
  const [currentPage, setCurrentPage] = useState(1)

  const fetchApplications = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('search', searchTerm)
      if (statusFilter !== 'all') params.append('status', statusFilter)

      const response = await fetch(`/api/admin/job-applications?${params}`)
      if (!response.ok) throw new Error('Failed to fetch applications')

      const data: PaginatedResponse = await response.json()
      setApplications(data.data)
      setPagination({
        current_page: data.current_page,
        last_page: data.last_page,
        per_page: data.per_page,
        total: data.total,
      })
    } catch (error) {
      toast.error('Failed to load applications')
    } finally {
      setLoading(false)
    }
  }

  const fetchStats = async () => {
    try {
      const response = await fetch('/api/admin/job-applications/stats')
      if (!response.ok) throw new Error('Failed to fetch stats')
      
      const data = await response.json()
      setStats(data.stats)
    } catch (error) {
      console.error('Failed to load stats')
    }
  }

  useEffect(() => {
    fetchApplications(currentPage)
  }, [currentPage, searchTerm, statusFilter])

  useEffect(() => {
    fetchStats()
  }, [])

  const updateApplicationStatus = async (id: number, status: string, notes?: string) => {
    try {
      const response = await fetch(`/api/admin/job-applications/${id}/status`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ status, admin_notes: notes }),
      })

      if (!response.ok) throw new Error('Failed to update status')

      toast.success('Application status updated successfully!')
      fetchApplications(currentPage)
      fetchStats()
    } catch (error) {
      toast.error('Failed to update application status')
    }
  }

  const deleteApplication = async (id: number) => {
    if (!confirm('Are you sure you want to delete this application?')) return

    try {
      const response = await fetch(`/api/admin/job-applications/${id}`, {
        method: 'DELETE',
      })

      if (!response.ok) throw new Error('Failed to delete application')

      toast.success('Application deleted successfully!')
      fetchApplications(currentPage)
      fetchStats()
    } catch (error) {
      toast.error('Failed to delete application')
    }
  }

  const downloadCV = async (id: number, applicantName: string) => {
    try {
      const response = await fetch(`/api/admin/job-applications/${id}/download-cv`)
      if (!response.ok) throw new Error('Failed to download CV')

      const blob = await response.blob()
      const url = window.URL.createObjectURL(blob)
      const a = document.createElement('a')
      a.href = url
      a.download = `${applicantName}_CV.pdf`
      document.body.appendChild(a)
      a.click()
      window.URL.revokeObjectURL(url)
      document.body.removeChild(a)
    } catch (error) {
      toast.error('Failed to download CV')
    }
  }

  const exportApplications = async () => {
    try {
      const params = new URLSearchParams()
      if (statusFilter !== 'all') params.append('status', statusFilter)

      const response = await fetch(`/api/admin/job-applications/export?${params}`)
      if (!response.ok) throw new Error('Failed to export applications')

      const blob = await response.blob()
      const url = window.URL.createObjectURL(blob)
      const a = document.createElement('a')
      a.href = url
      a.download = `job_applications_${new Date().toISOString().split('T')[0]}.xlsx`
      document.body.appendChild(a)
      a.click()
      window.URL.revokeObjectURL(url)
      document.body.removeChild(a)

      toast.success('Applications exported successfully!')
    } catch (error) {
      toast.error('Failed to export applications')
    }
  }

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'pending': return 'bg-yellow-500/20 text-yellow-400'
      case 'reviewed': return 'bg-blue-500/20 text-blue-400'
      case 'shortlisted': return 'bg-green-500/20 text-green-400'
      case 'rejected': return 'bg-red-500/20 text-red-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  const getStatusIcon = (status: string) => {
    switch (status) {
      case 'pending': return <Clock className="w-4 h-4" />
      case 'reviewed': return <Eye className="w-4 h-4" />
      case 'shortlisted': return <CheckCircle className="w-4 h-4" />
      case 'rejected': return <XCircle className="w-4 h-4" />
      default: return <Clock className="w-4 h-4" />
    }
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">Job Applications</h1>
            <p className="text-gray-400 mt-1">
              {pagination ? `${pagination.total} total applications` : 'Loading...'}
            </p>
          </div>
          <div className="flex items-center gap-3">
            <button
              onClick={exportApplications}
              className="inline-flex items-center gap-2 px-4 py-2 bg-neon-cyan hover:bg-neon-cyan/80 text-white rounded-lg transition-colors"
            >
              <Download className="w-4 h-4" />
              Export Excel
            </button>
            <button
              onClick={() => { fetchApplications(currentPage); fetchStats(); }}
              className="p-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
            >
              <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
            </button>
          </div>
        </div>

        {/* Stats Cards */}
        {stats && (
          <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-neon-cyan">{stats.total}</div>
              <div className="text-sm text-gray-400">Total</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-yellow-400">{stats.pending}</div>
              <div className="text-sm text-gray-400">Pending</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-blue-400">{stats.reviewed}</div>
              <div className="text-sm text-gray-400">Reviewed</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-green-400">{stats.shortlisted}</div>
              <div className="text-sm text-gray-400">Shortlisted</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-red-400">{stats.rejected}</div>
              <div className="text-sm text-gray-400">Rejected</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-purple-400">{stats.today}</div>
              <div className="text-sm text-gray-400">Today</div>
            </div>
            <div className="bg-white/5 border border-white/10 rounded-xl p-4">
              <div className="text-2xl font-bold text-orange-400">{stats.this_week}</div>
              <div className="text-sm text-gray-400">This Week</div>
            </div>
          </div>
        )}

        {/* Filters and Search */}
        <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div className="flex items-center gap-2">
            {(['all', 'pending', 'reviewed', 'shortlisted', 'rejected'] as const).map((status) => (
              <button
                key={status}
                onClick={() => {
                  setStatusFilter(status)
                  setCurrentPage(1)
                }}
                className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
                  statusFilter === status
                    ? 'bg-neon-purple text-white'
                    : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'
                }`}
              >
                {status.charAt(0).toUpperCase() + status.slice(1)}
              </button>
            ))}
          </div>

          <div className="relative">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
            <input
              type="text"
              placeholder="Search applications..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
            />
          </div>
        </div>

        {/* Applications List */}
        <div className="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
          {loading ? (
            <div className="p-8 text-center">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading applications...</p>
            </div>
          ) : applications.length === 0 ? (
            <div className="p-8 text-center">
              <Briefcase className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">
                {searchTerm ? 'No applications found matching your search' : 'No applications yet'}
              </p>
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {applications.map((application) => (
                <div key={application.id} className="p-6 hover:bg-white/5 transition-colors">
                  <div className="flex items-start justify-between gap-4">
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-4 mb-2">
                        <div className="flex items-center gap-2">
                          <User className="w-4 h-4 text-gray-400" />
                          <span className="font-medium text-white">
                            {application.first_name} {application.last_name}
                          </span>
                        </div>
                        <div className="flex items-center gap-2">
                          <Mail className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-400">{application.email}</span>
                        </div>
                        <div className="flex items-center gap-2">
                          <Phone className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-400">{application.phone}</span>
                        </div>
                      </div>

                      <div className="flex items-center gap-4 mb-3">
                        <div className="flex items-center gap-2">
                          <Briefcase className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-300">{application.job.title}</span>
                        </div>
                        {application.years_experience && (
                          <div className="flex items-center gap-2">
                            <Star className="w-4 h-4 text-gray-400" />
                            <span className="text-sm text-gray-400">{application.years_experience} years exp.</span>
                          </div>
                        )}
                        <div className="flex items-center gap-2">
                          <Calendar className="w-4 h-4 text-gray-400" />
                          <span className="text-sm text-gray-400">
                            {new Date(application.created_at).toLocaleDateString()}
                          </span>
                        </div>
                      </div>

                      {application.cover_letter && (
                        <p className="text-gray-300 line-clamp-2 mb-2">{application.cover_letter}</p>
                      )}

                      <div className="flex items-center gap-4 text-sm">
                        <span className={`inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(application.status)}`}>
                          {getStatusIcon(application.status)}
                          {application.status.charAt(0).toUpperCase() + application.status.slice(1)}
                        </span>
                        {application.reviewer && (
                          <span className="text-gray-400">Reviewed by {application.reviewer.name}</span>
                        )}
                      </div>
                    </div>

                    <div className="flex items-center gap-2">
                      {application.linkedin_url && (
                        <a
                          href={application.linkedin_url}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="p-2 text-blue-400 hover:text-blue-300 transition-colors"
                          title="LinkedIn Profile"
                        >
                          <ExternalLink className="w-4 h-4" />
                        </a>
                      )}

                      {application.portfolio_url && (
                        <a
                          href={application.portfolio_url}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="p-2 text-purple-400 hover:text-purple-300 transition-colors"
                          title="Portfolio"
                        >
                          <Globe className="w-4 h-4" />
                        </a>
                      )}

                      <button
                        onClick={() => downloadCV(application.id, `${application.first_name}_${application.last_name}`)}
                        className="p-2 text-green-400 hover:text-green-300 transition-colors"
                        title="Download CV"
                      >
                        <FileText className="w-4 h-4" />
                      </button>

                      <button
                        onClick={() => setSelectedApplication(application)}
                        className="p-2 text-gray-400 hover:text-white transition-colors"
                        title="View details"
                      >
                        <Eye className="w-4 h-4" />
                      </button>

                      <button
                        onClick={() => deleteApplication(application.id)}
                        className="p-2 text-red-400 hover:text-red-300 transition-colors"
                        title="Delete application"
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
              {pagination.total} applications
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

      {/* Application Details Modal */}
      {selectedApplication && (
        <ApplicationDetailsModal
          application={selectedApplication}
          onClose={() => setSelectedApplication(null)}
          onUpdateStatus={(status, notes) => {
            updateApplicationStatus(selectedApplication.id, status, notes)
            setSelectedApplication(null)
          }}
          onDelete={() => {
            deleteApplication(selectedApplication.id)
            setSelectedApplication(null)
          }}
        />
      )}
    </AdminLayout>
  )
}

// Application Details Modal Component
const ApplicationDetailsModal: React.FC<{
  application: JobApplication
  onClose: () => void
  onUpdateStatus: (status: string, notes?: string) => void
  onDelete: () => void
}> = ({ application, onClose, onUpdateStatus, onDelete }) => {
  const [newStatus, setNewStatus] = useState(application.status)
  const [adminNotes, setAdminNotes] = useState(application.admin_notes || '')
  const [showStatusUpdate, setShowStatusUpdate] = useState(false)

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'pending': return 'bg-yellow-500/20 text-yellow-400'
      case 'reviewed': return 'bg-blue-500/20 text-blue-400'
      case 'shortlisted': return 'bg-green-500/20 text-green-400'
      case 'rejected': return 'bg-red-500/20 text-red-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  const handleStatusUpdate = () => {
    onUpdateStatus(newStatus, adminNotes)
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">Application Details</h3>
          <button
            onClick={onClose}
            className="p-1 text-gray-400 hover:text-white transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Applicant Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Full Name</label>
                <p className="text-white text-lg font-medium">
                  {application.first_name} {application.last_name}
                </p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Email</label>
                <p className="text-white">{application.email}</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Phone</label>
                <p className="text-white">{application.phone}</p>
              </div>
              {application.years_experience && (
                <div>
                  <label className="block text-sm font-medium text-gray-400 mb-1">Years of Experience</label>
                  <p className="text-white">{application.years_experience} years</p>
                </div>
              )}
            </div>

            <div className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Applied For</label>
                <p className="text-white font-medium">{application.job.title}</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Application Date</label>
                <p className="text-white">{new Date(application.created_at).toLocaleString()}</p>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Current Status</label>
                <span className={`inline-block px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(application.status)}`}>
                  {application.status.charAt(0).toUpperCase() + application.status.slice(1)}
                </span>
              </div>
              {application.reviewed_at && application.reviewer && (
                <div>
                  <label className="block text-sm font-medium text-gray-400 mb-1">Reviewed By</label>
                  <p className="text-white">{application.reviewer.name}</p>
                  <p className="text-sm text-gray-400">{new Date(application.reviewed_at).toLocaleString()}</p>
                </div>
              )}
            </div>
          </div>

          {/* Links */}
          {(application.linkedin_url || application.portfolio_url) && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Links</label>
              <div className="flex gap-3">
                {application.linkedin_url && (
                  <a
                    href={application.linkedin_url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                  >
                    <ExternalLink className="w-4 h-4" />
                    LinkedIn Profile
                  </a>
                )}
                {application.portfolio_url && (
                  <a
                    href={application.portfolio_url}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                  >
                    <Globe className="w-4 h-4" />
                    Portfolio
                  </a>
                )}
              </div>
            </div>
          )}

          {/* Cover Letter */}
          {application.cover_letter && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Cover Letter</label>
              <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                <p className="text-white whitespace-pre-wrap">{application.cover_letter}</p>
              </div>
            </div>
          )}

          {/* Additional Info */}
          {application.additional_info && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Additional Information</label>
              <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                <p className="text-white whitespace-pre-wrap">{application.additional_info}</p>
              </div>
            </div>
          )}

          {/* Admin Notes */}
          {application.admin_notes && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Admin Notes</label>
              <div className="bg-white/5 border border-white/10 rounded-lg p-4">
                <p className="text-white whitespace-pre-wrap">{application.admin_notes}</p>
              </div>
            </div>
          )}

          {/* Status Update Section */}
          <div className="border-t border-white/10 pt-6">
            {!showStatusUpdate ? (
              <div className="flex gap-3">
                <button
                  onClick={() => setShowStatusUpdate(true)}
                  className="flex-1 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
                >
                  Update Status
                </button>
                <button
                  onClick={() => {
                    const applicantName = `${application.first_name}_${application.last_name}`
                    // Download CV logic would go here
                    toast.success('CV download started')
                  }}
                  className="flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                >
                  <FileText className="w-4 h-4" />
                  Download CV
                </button>
                <button
                  onClick={onDelete}
                  className="flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                >
                  <Trash2 className="w-4 h-4" />
                  Delete
                </button>
              </div>
            ) : (
              <div className="space-y-4">
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">Update Status</label>
                  <select
                    value={newStatus}
                    onChange={(e) => setNewStatus(e.target.value)}
                    className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
                  >
                    <option value="pending">Pending</option>
                    <option value="reviewed">Reviewed</option>
                    <option value="shortlisted">Shortlisted</option>
                    <option value="rejected">Rejected</option>
                  </select>
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">Admin Notes</label>
                  <textarea
                    value={adminNotes}
                    onChange={(e) => setAdminNotes(e.target.value)}
                    placeholder="Add notes about this application..."
                    className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
                    rows={4}
                  />
                </div>

                <div className="flex gap-3">
                  <button
                    onClick={() => setShowStatusUpdate(false)}
                    className="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
                  >
                    Cancel
                  </button>
                  <button
                    onClick={handleStatusUpdate}
                    className="flex-1 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
                  >
                    Update Status
                  </button>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  )
}

export default JobApplications
