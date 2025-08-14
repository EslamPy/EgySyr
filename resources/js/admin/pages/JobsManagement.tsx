import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Plus, Search, Edit, Trash2, Eye, ToggleLeft, ToggleRight,
  Briefcase, MapPin, Clock, DollarSign, Calendar, Users,
  RefreshCw, Filter, X, Building
} from 'lucide-react'
import toast from 'react-hot-toast'

interface Job {
  id: number
  title: string
  slug: string
  description: string
  requirements: string
  location: string
  type: 'full-time' | 'part-time' | 'contract' | 'internship'
  department?: string
  salary_min?: number
  salary_max?: number
  salary_currency: string
  is_active: boolean
  application_deadline?: string
  created_at: string
  creator: { name: string }
  applications_count?: number
}

interface PaginatedResponse {
  data: Job[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

const JobsManagement: React.FC = () => {
  const [jobs, setJobs] = useState<Job[]>([])
  const [pagination, setPagination] = useState<Omit<PaginatedResponse, 'data'> | null>(null)
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')
  const [activeFilter, setActiveFilter] = useState<'all' | 'active' | 'inactive'>('all')
  const [showCreateModal, setShowCreateModal] = useState(false)
  const [editingJob, setEditingJob] = useState<Job | null>(null)
  const [selectedJob, setSelectedJob] = useState<Job | null>(null)
  const [currentPage, setCurrentPage] = useState(1)

  const fetchJobs = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('search', searchTerm)
      if (activeFilter !== 'all') {
        params.append('active', activeFilter === 'active' ? 'true' : 'false')
      }

      const response = await fetch(`/api/admin/jobs?${params}`, { credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      if (!response.ok) throw new Error('Failed to fetch jobs')

      const data: PaginatedResponse = await response.json()
      setJobs(data.data)
      setPagination({
        current_page: data.current_page,
        last_page: data.last_page,
        per_page: data.per_page,
        total: data.total,
      })
    } catch (error) {
      toast.error('Failed to load jobs')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchJobs(currentPage)
  }, [currentPage, searchTerm, activeFilter])

  const toggleJobStatus = async (id: number) => {
    try {
      const response = await fetch(`/api/admin/jobs/${id}/toggle-status`, {
        method: 'POST',
      })

      if (!response.ok) throw new Error('Failed to toggle status')

      const data = await response.json()
      toast.success(data.message)
      fetchJobs(currentPage)
    } catch (error) {
      toast.error('Failed to toggle job status')
    }
  }

  const deleteJob = async (id: number) => {
    if (!confirm('Are you sure you want to delete this job? This will also delete all applications.')) return

    try {
      const response = await fetch(`/api/admin/jobs/${id}`, {
        method: 'DELETE',
      })

      if (!response.ok) throw new Error('Failed to delete job')

      toast.success('Job deleted successfully!')
      fetchJobs(currentPage)
    } catch (error) {
      toast.error('Failed to delete job')
    }
  }

  const formatSalary = (job: Job) => {
    if (!job.salary_min && !job.salary_max) return 'Not specified'
    
    const currency = job.salary_currency || 'USD'
    if (job.salary_min && job.salary_max) {
      return `${currency} ${job.salary_min.toLocaleString()} - ${job.salary_max.toLocaleString()}`
    }
    if (job.salary_min) {
      return `${currency} ${job.salary_min.toLocaleString()}+`
    }
    return `${currency} ${job.salary_max?.toLocaleString()}`
  }

  const getTypeColor = (type: string) => {
    switch (type) {
      case 'full-time': return 'bg-green-500/20 text-green-400'
      case 'part-time': return 'bg-blue-500/20 text-blue-400'
      case 'contract': return 'bg-orange-500/20 text-orange-400'
      case 'internship': return 'bg-purple-500/20 text-purple-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">Jobs Management</h1>
            <p className="text-gray-400 mt-1">
              {pagination ? `${pagination.total} total jobs` : 'Loading...'}
            </p>
          </div>
          <button
            onClick={() => setShowCreateModal(true)}
            className="inline-flex items-center gap-2 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
          >
            <Plus className="w-4 h-4" />
            Create Job
          </button>
        </div>

        {/* Filters and Search */}
        <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div className="flex items-center gap-2">
            {(['all', 'active', 'inactive'] as const).map((filter) => (
              <button
                key={filter}
                onClick={() => {
                  setActiveFilter(filter)
                  setCurrentPage(1)
                }}
                className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
                  activeFilter === filter
                    ? 'bg-neon-purple text-white'
                    : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'
                }`}
              >
                {filter.charAt(0).toUpperCase() + filter.slice(1)}
              </button>
            ))}
          </div>

          <div className="flex items-center gap-3">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
              <input
                type="text"
                placeholder="Search jobs..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
              />
            </div>
            <button
              onClick={() => fetchJobs(currentPage)}
              className="p-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
            >
              <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
            </button>
          </div>
        </div>

        {/* Jobs List */}
        <div className="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
          {loading ? (
            <div className="p-8 text-center">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading jobs...</p>
            </div>
          ) : jobs.length === 0 ? (
            <div className="p-8 text-center">
              <Briefcase className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">
                {searchTerm ? 'No jobs found matching your search' : 'No jobs created yet'}
              </p>
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {jobs.map((job) => (
                <div key={job.id} className="p-6 hover:bg-white/5 transition-colors">
                  <div className="flex items-start justify-between gap-4">
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-3 mb-2">
                        <h3 className="font-semibold text-white text-lg">{job.title}</h3>
                        <span className={`px-2 py-1 rounded-full text-xs font-medium ${getTypeColor(job.type)}`}>
                          {job.type.replace('-', ' ').toUpperCase()}
                        </span>
                        {!job.is_active && (
                          <span className="px-2 py-1 rounded-full text-xs font-medium bg-gray-500/20 text-gray-400">
                            INACTIVE
                          </span>
                        )}
                      </div>

                      <div className="flex items-center gap-4 text-sm text-gray-400 mb-3">
                        {job.department && (
                          <div className="flex items-center gap-1">
                            <Building className="w-4 h-4" />
                            <span>{job.department}</span>
                          </div>
                        )}
                        <div className="flex items-center gap-1">
                          <MapPin className="w-4 h-4" />
                          <span>{job.location}</span>
                        </div>
                        <div className="flex items-center gap-1">
                          <DollarSign className="w-4 h-4" />
                          <span>{formatSalary(job)}</span>
                        </div>
                        {job.application_deadline && (
                          <div className="flex items-center gap-1">
                            <Calendar className="w-4 h-4" />
                            <span>Deadline: {new Date(job.application_deadline).toLocaleDateString()}</span>
                          </div>
                        )}
                      </div>

                      <p className="text-gray-300 line-clamp-2 mb-3">{job.description}</p>

                      <div className="flex items-center gap-4 text-sm text-gray-400">
                        <span>Created by {job.creator.name}</span>
                        <span>{new Date(job.created_at).toLocaleDateString()}</span>
                        {job.applications_count !== undefined && (
                          <div className="flex items-center gap-1">
                            <Users className="w-4 h-4" />
                            <span>{job.applications_count} applications</span>
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="flex items-center gap-2">
                      <button
                        onClick={() => toggleJobStatus(job.id)}
                        className={`p-2 transition-colors ${
                          job.is_active 
                            ? 'text-green-400 hover:text-green-300' 
                            : 'text-gray-400 hover:text-gray-300'
                        }`}
                        title={job.is_active ? 'Deactivate job' : 'Activate job'}
                      >
                        {job.is_active ? <ToggleRight className="w-5 h-5" /> : <ToggleLeft className="w-5 h-5" />}
                      </button>

                      <button
                        onClick={() => setSelectedJob(job)}
                        className="p-2 text-gray-400 hover:text-white transition-colors"
                        title="View details"
                      >
                        <Eye className="w-4 h-4" />
                      </button>

                      <button
                        onClick={() => setEditingJob(job)}
                        className="p-2 text-blue-400 hover:text-blue-300 transition-colors"
                        title="Edit job"
                      >
                        <Edit className="w-4 h-4" />
                      </button>

                      <button
                        onClick={() => deleteJob(job.id)}
                        className="p-2 text-red-400 hover:text-red-300 transition-colors"
                        title="Delete job"
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
              {pagination.total} jobs
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

      {/* Create Job Modal */}
      {showCreateModal && (
        <JobFormModal
          onClose={() => setShowCreateModal(false)}
          onSubmit={async (jobData) => {
            try {
              await fetch('/sanctum/csrf-cookie', { credentials: 'include' })
              const response = await fetch('/api/admin/jobs', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'include',
                body: JSON.stringify(jobData),
              })

              if (!response.ok) throw new Error('Failed to create job')

              toast.success('Job created successfully!')
              setShowCreateModal(false)
              fetchJobs(currentPage)
            } catch (error) {
              toast.error('Failed to create job')
            }
          }}
        />
      )}

      {/* Edit Job Modal */}
      {editingJob && (
        <JobFormModal
          job={editingJob}
          onClose={() => setEditingJob(null)}
          onSubmit={async (jobData) => {
            try {
              await fetch('/sanctum/csrf-cookie', { credentials: 'include' })
              const response = await fetch(`/api/admin/jobs/${editingJob.id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'include',
                body: JSON.stringify(jobData),
              })

              if (!response.ok) throw new Error('Failed to update job')

              toast.success('Job updated successfully!')
              setEditingJob(null)
              fetchJobs(currentPage)
            } catch (error) {
              toast.error('Failed to update job')
            }
          }}
        />
      )}

      {/* Job Details Modal */}
      {selectedJob && (
        <JobDetailsModal
          job={selectedJob}
          onClose={() => setSelectedJob(null)}
          onEdit={() => {
            setEditingJob(selectedJob)
            setSelectedJob(null)
          }}
          onDelete={() => {
            deleteJob(selectedJob.id)
            setSelectedJob(null)
          }}
        />
      )}
    </AdminLayout>
  )
}

// Job Form Modal Component
const JobFormModal: React.FC<{
  job?: Job
  onClose: () => void
  onSubmit: (data: any) => void
}> = ({ job, onClose, onSubmit }) => {
  const [formData, setFormData] = useState({
    title: job?.title || '',
    description: job?.description || '',
    requirements: job?.requirements || '',
    location: job?.location || '',
    type: job?.type || 'full-time',
    department: job?.department || '',
    salary_min: job?.salary_min || '',
    salary_max: job?.salary_max || '',
    salary_currency: job?.salary_currency || 'USD',
    application_deadline: job?.application_deadline ? job.application_deadline.split('T')[0] : '',
    is_active: job?.is_active ?? true,
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()

    const submitData = {
      ...formData,
      salary_min: formData.salary_min ? parseFloat(formData.salary_min.toString()) : null,
      salary_max: formData.salary_max ? parseFloat(formData.salary_max.toString()) : null,
      application_deadline: formData.application_deadline || null,
    }

    onSubmit(submitData)
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">{job ? 'Edit Job' : 'Create New Job'}</h3>
          <button onClick={onClose} className="p-1 text-gray-400 hover:text-white transition-colors">
            <X className="w-5 h-5" />
          </button>
        </div>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="md:col-span-2">
              <label className="block text-sm font-medium text-gray-300 mb-2">Job Title *</label>
              <input
                type="text"
                required
                value={formData.title}
                onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
                placeholder="e.g. Senior Frontend Developer"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">Location *</label>
              <input
                type="text"
                required
                value={formData.location}
                onChange={(e) => setFormData({ ...formData, location: e.target.value })}
                className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
                placeholder="e.g. New York, NY / Remote"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">Job Type *</label>
              <select
                required
                value={formData.type}
                onChange={(e) => setFormData({ ...formData, type: e.target.value as any })}
                className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
              >
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
              </select>
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">Department</label>
              <input
                type="text"
                value={formData.department}
                onChange={(e) => setFormData({ ...formData, department: e.target.value })}
                className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
                placeholder="e.g. Engineering, Marketing"
              />
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">Application Deadline</label>
              <input
                type="date"
                value={formData.application_deadline}
                onChange={(e) => setFormData({ ...formData, application_deadline: e.target.value })}
                className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
              />
            </div>

            <div className="grid grid-cols-3 gap-2">
              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Min Salary</label>
                <input
                  type="number"
                  value={formData.salary_min}
                  onChange={(e) => setFormData({ ...formData, salary_min: e.target.value })}
                  className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
                  placeholder="50000"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Max Salary</label>
                <input
                  type="number"
                  value={formData.salary_max}
                  onChange={(e) => setFormData({ ...formData, salary_max: e.target.value })}
                  className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
                  placeholder="80000"
                />
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Currency</label>
                <select
                  value={formData.salary_currency}
                  onChange={(e) => setFormData({ ...formData, salary_currency: e.target.value })}
                  className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-neon-purple"
                >
                  <option value="USD">USD</option>
                  <option value="EUR">EUR</option>
                  <option value="GBP">GBP</option>
                  <option value="EGP">EGP</option>
                </select>
              </div>
            </div>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Job Description *</label>
            <textarea
              required
              rows={6}
              value={formData.description}
              onChange={(e) => setFormData({ ...formData, description: e.target.value })}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
              placeholder="Describe the role, responsibilities, and what the candidate will be doing..."
            />
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">Requirements *</label>
            <textarea
              required
              rows={6}
              value={formData.requirements}
              onChange={(e) => setFormData({ ...formData, requirements: e.target.value })}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
              placeholder="List the required skills, experience, education, etc..."
            />
          </div>

          <div className="flex items-center gap-3">
            <input
              type="checkbox"
              id="is_active"
              checked={formData.is_active}
              onChange={(e) => setFormData({ ...formData, is_active: e.target.checked })}
              className="w-4 h-4 text-neon-purple bg-white/5 border-white/10 rounded focus:ring-neon-purple focus:ring-2"
            />
            <label htmlFor="is_active" className="text-sm text-gray-300">
              Job is active and accepting applications
            </label>
          </div>

          <div className="flex gap-3 pt-4 border-t border-white/10">
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
              {job ? 'Update Job' : 'Create Job'}
            </button>
          </div>
        </form>
      </div>
    </div>
  )
}

// Job Details Modal Component
const JobDetailsModal: React.FC<{
  job: Job
  onClose: () => void
  onEdit: () => void
  onDelete: () => void
}> = ({ job, onClose, onEdit, onDelete }) => {
  const formatSalary = (job: Job) => {
    if (!job.salary_min && !job.salary_max) return 'Not specified'

    const currency = job.salary_currency || 'USD'
    if (job.salary_min && job.salary_max) {
      return `${currency} ${job.salary_min.toLocaleString()} - ${job.salary_max.toLocaleString()}`
    }
    if (job.salary_min) {
      return `${currency} ${job.salary_min.toLocaleString()}+`
    }
    return `${currency} ${job.salary_max?.toLocaleString()}`
  }

  const getTypeColor = (type: string) => {
    switch (type) {
      case 'full-time': return 'bg-green-500/20 text-green-400'
      case 'part-time': return 'bg-blue-500/20 text-blue-400'
      case 'contract': return 'bg-orange-500/20 text-orange-400'
      case 'internship': return 'bg-purple-500/20 text-purple-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">Job Details</h3>
          <button onClick={onClose} className="p-1 text-gray-400 hover:text-white transition-colors">
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Header Info */}
          <div>
            <div className="flex items-center gap-3 mb-2">
              <h2 className="text-2xl font-bold text-white">{job.title}</h2>
              <span className={`px-3 py-1 rounded-full text-sm font-medium ${getTypeColor(job.type)}`}>
                {job.type.replace('-', ' ').toUpperCase()}
              </span>
              {!job.is_active && (
                <span className="px-3 py-1 rounded-full text-sm font-medium bg-red-500/20 text-red-400">
                  INACTIVE
                </span>
              )}
            </div>

            <div className="flex items-center gap-4 text-gray-400">
              {job.department && (
                <div className="flex items-center gap-1">
                  <Building className="w-4 h-4" />
                  <span>{job.department}</span>
                </div>
              )}
              <div className="flex items-center gap-1">
                <MapPin className="w-4 h-4" />
                <span>{job.location}</span>
              </div>
              <div className="flex items-center gap-1">
                <DollarSign className="w-4 h-4" />
                <span>{formatSalary(job)}</span>
              </div>
            </div>
          </div>

          {/* Meta Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-white/5 rounded-lg">
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Created By</label>
              <p className="text-white">{job.creator.name}</p>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Created Date</label>
              <p className="text-white">{new Date(job.created_at).toLocaleDateString()}</p>
            </div>
            {job.application_deadline && (
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Application Deadline</label>
                <p className="text-white">{new Date(job.application_deadline).toLocaleDateString()}</p>
              </div>
            )}
            {job.applications_count !== undefined && (
              <div>
                <label className="block text-sm font-medium text-gray-400 mb-1">Applications</label>
                <p className="text-white">{job.applications_count} received</p>
              </div>
            )}
          </div>

          {/* Description */}
          <div>
            <h4 className="text-lg font-semibold text-white mb-3">Job Description</h4>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <p className="text-gray-300 whitespace-pre-wrap">{job.description}</p>
            </div>
          </div>

          {/* Requirements */}
          <div>
            <h4 className="text-lg font-semibold text-white mb-3">Requirements</h4>
            <div className="bg-white/5 border border-white/10 rounded-lg p-4">
              <p className="text-gray-300 whitespace-pre-wrap">{job.requirements}</p>
            </div>
          </div>

          {/* Public Link */}
          <div>
            <h4 className="text-lg font-semibold text-white mb-3">Public Job Link</h4>
            <div className="flex items-center gap-2">
              <input
                type="text"
                readOnly
                value={`${window.location.origin}/careers/${job.slug}`}
                className="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm"
              />
              <button
                onClick={() => {
                  navigator.clipboard.writeText(`${window.location.origin}/careers/${job.slug}`)
                  toast.success('Link copied!')
                }}
                className="px-3 py-2 bg-neon-cyan hover:bg-neon-cyan/80 text-white rounded-lg transition-colors"
              >
                Copy
              </button>
              <a
                href={`/careers/${job.slug}`}
                target="_blank"
                rel="noopener noreferrer"
                className="px-3 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
              >
                View
              </a>
            </div>
          </div>

          {/* Actions */}
          <div className="flex gap-3 pt-4 border-t border-white/10">
            <button
              onClick={onEdit}
              className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
            >
              <Edit className="w-4 h-4" />
              Edit Job
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

export default JobsManagement
