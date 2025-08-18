import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { 
  Plus, Search, Edit, Trash2, Eye, ToggleLeft, ToggleRight,
  Briefcase, MapPin, Clock, DollarSign, Calendar, Users,
  RefreshCw, Filter, X, Building, ChevronDown, CheckCircle,
  AlertCircle, FileText, ChevronRight, Link, Clipboard, ExternalLink,
  Loader2
} from 'lucide-react'
import { motion, AnimatePresence } from 'framer-motion'
import toast from 'react-hot-toast'

// Utility function to get CSRF token
const getCSRFToken = (): string | null => {
  const metaTag = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
  return metaTag ? metaTag.content : null
}

// Define interfaces
interface Job {
  id: number
  title: string
  slug: string
  description: string
  requirements: string
  location: string
  type: string
  department: string
  salary_min: number | null
  salary_max: number | null
  salary_currency: string
  is_active: boolean
  application_deadline: string | null
  created_at: string
  created_by: number
  creator?: {
    id: number
    name: string
  }
  applications?: {
    count: number
  }[]
}

interface PaginatedResponse {
  data: Job[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

// Helper function for job type colors
const getTypeColor = (type: string) => {
  switch (type) {
    case 'full-time':
      return 'bg-green-500/20 text-green-400 border border-green-500/30'
    case 'part-time':
      return 'bg-blue-500/20 text-blue-400 border border-blue-500/30'
    case 'contract':
      return 'bg-purple-500/20 text-purple-400 border border-purple-500/30'
    case 'internship':
      return 'bg-orange-500/20 text-orange-400 border border-orange-500/30'
    default:
      return 'bg-gray-500/20 text-gray-400 border border-gray-500/30'
  }
}

const JobsManagement: React.FC = () => {
  // State variables
  const [jobs, setJobs] = useState<Job[]>([])
  const [pagination, setPagination] = useState<Omit<PaginatedResponse, 'data'> | null>(null)
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')
  const [activeFilter, setActiveFilter] = useState<'all' | 'active' | 'inactive'>('all')
  const [currentPage, setCurrentPage] = useState(1)
  const [showCreateModal, setShowCreateModal] = useState(false)
  const [selectedJob, setSelectedJob] = useState<Job | null>(null)
  const [editingJob, setEditingJob] = useState<Job | null>(null)
  
  // Filter states
  const [filterOpen, setFilterOpen] = useState(false)
  const [typeFilter, setTypeFilter] = useState<string>('all')
  const [departmentFilter, setDepartmentFilter] = useState<string>('all')
  const [departments, setDepartments] = useState<string[]>([])

  // Fetch jobs with filters
  const fetchJobs = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('search', searchTerm)
      if (activeFilter !== 'all') {
        params.append('active', activeFilter === 'active' ? 'true' : 'false')
      }
      if (typeFilter !== 'all') {
        params.append('type', typeFilter)
      }
      if (departmentFilter !== 'all') {
        params.append('department', departmentFilter)
      }

      const response = await fetch(`/api/admin/jobs?${params}`, { 
        credentials: 'include', 
        headers: { 
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        } 
      })
      
      if (!response.ok) {
        const errorData = await response.json().catch(() => null)
        throw new Error(errorData?.message || 'Failed to fetch jobs')
      }

      const data: PaginatedResponse = await response.json()
      setJobs(data.data)
      setPagination({
        current_page: data.current_page,
        last_page: data.last_page,
        per_page: data.per_page,
        total: data.total,
      })
      
      // Extract unique departments for filter options
      const uniqueDepartments = Array.from(
        new Set(
          data.data
            .map(job => job.department)
            .filter(Boolean) // Remove null/undefined values
        )
      )
      setDepartments(uniqueDepartments as string[])
    } catch (error) {
      console.error('Error fetching jobs:', error)
      toast.error(error instanceof Error ? error.message : 'Failed to load jobs')
    } finally {
      setLoading(false)
    }
  }

  // Load jobs on component mount and when filters change
  useEffect(() => {
    fetchJobs(currentPage)
  }, [currentPage, activeFilter])

  // Debounce search term changes
  useEffect(() => {
    const timer = setTimeout(() => {
      if (currentPage === 1) {
        fetchJobs(1)
      } else {
        setCurrentPage(1)
      }
    }, 500)

    return () => clearTimeout(timer)
  }, [searchTerm, typeFilter, departmentFilter])

  // Toggle job active status
  const toggleJobStatus = async (id: number) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/jobs/${id}/toggle-status`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include'
      })

      if (!response.ok) {
        const errorData = await response.json().catch(() => null)
        throw new Error(errorData?.message || 'Failed to toggle status')
      }

      const data = await response.json()
      toast.success(data.message)
      fetchJobs(currentPage)
    } catch (error) {
      console.error('Error toggling job status:', error)
      toast.error(error instanceof Error ? error.message : 'Failed to toggle job status')
    }
  }

  // Delete job
  const deleteJob = async (id: number) => {
    if (!confirm('Are you sure you want to delete this job? This will also delete all applications.')) return

    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/jobs/${id}`, {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include'
      })

      if (!response.ok) {
        const errorData = await response.json().catch(() => null)
        throw new Error(errorData?.message || 'Failed to delete job')
      }

      toast.success('Job deleted successfully!')
      fetchJobs(currentPage)
    } catch (error) {
      console.error('Error deleting job:', error)
      toast.error(error instanceof Error ? error.message : 'Failed to delete job')
    }
  }

  // Format salary display
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

  // Get color for job type badge
  const getTypeColor = (type: string) => {
    switch (type) {
      case 'full-time': return 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30'
      case 'part-time': return 'bg-blue-500/20 text-blue-400 border border-blue-500/30'
      case 'contract': return 'bg-amber-500/20 text-amber-400 border border-amber-500/30'
      case 'internship': return 'bg-purple-500/20 text-purple-400 border border-purple-500/30'
      default: return 'bg-gray-500/20 text-gray-400 border border-gray-500/30'
    }
  }

  return (
    <AdminLayout>
      <div className="space-y-8">
        {/* Header */}
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h1 className="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-blue-100 to-blue-300">
              Jobs Management
            </h1>
            <p className="text-gray-400 mt-1 flex items-center gap-2">
              {pagination ? (
                <>
                  <Briefcase className="w-4 h-4 text-blue-400" />
                  <span className="text-blue-300">{pagination.total}</span> total jobs
                </>
              ) : 'Loading...'}
            </p>
          </div>
          <button
            onClick={() => setShowCreateModal(true)}
            className="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl transition-all shadow-lg shadow-blue-600/20 transform hover:scale-105 font-medium"
          >
            <Plus className="w-5 h-5" />
            Create Job
          </button>
        </div>

        {/* Filters and Search */}
        <div className="bg-gradient-to-b from-white/5 to-white/[0.02] border border-white/10 rounded-xl p-6 shadow-lg">
          <div className="flex flex-col sm:flex-row gap-5 items-start sm:items-center justify-between">
            <div className="flex items-center gap-3">
              {(['all', 'active', 'inactive'] as const).map((filter) => (
                <button
                  key={filter}
                  onClick={() => {
                    setActiveFilter(filter)
                    setCurrentPage(1)
                  }}
                  className={`px-4 py-2.5 rounded-lg text-sm font-medium transition-all flex items-center gap-1.5 ${activeFilter === filter
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-600/20'
                    : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5'}`}
                >
                  {filter === 'active' && <CheckCircle className="w-4 h-4" />}
                  {filter === 'inactive' && <AlertCircle className="w-4 h-4" />}
                  {filter === 'all' && <Briefcase className="w-4 h-4" />}
                  {filter.charAt(0).toUpperCase() + filter.slice(1)}
                </button>
              ))}
            </div>

            <div className="flex items-center gap-3 w-full sm:w-auto">
              <div className="relative flex-1 sm:flex-none sm:w-64 md:w-80">
                <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-400 w-4 h-4" />
                <input
                  type="text"
                  placeholder="Search jobs..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="w-full pl-10 pr-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                />
              </div>
              
              <button
                onClick={() => setFilterOpen(!filterOpen)}
                className="px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors flex items-center gap-2"
              >
                <Filter className="w-4 h-4" />
                Filters
                <ChevronDown className={`w-4 h-4 transition-transform ${filterOpen ? 'rotate-180' : ''}`} />
              </button>
            </div>
          </div>

          <AnimatePresence>
            {filterOpen && (
              <motion.div 
                initial={{ height: 0, opacity: 0 }}
                animate={{ height: 'auto', opacity: 1 }}
                exit={{ height: 0, opacity: 0 }}
                transition={{ duration: 0.3 }}
                className="overflow-hidden"
              >
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6 pt-6 border-t border-white/10">
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">Job Type</label>
                    <select
                      value={typeFilter}
                      onChange={(e) => {
                        setTypeFilter(e.target.value)
                        setCurrentPage(1)
                      }}
                      className="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    >
                      <option value="all">All Types</option>
                      <option value="full-time">Full Time</option>
                      <option value="part-time">Part Time</option>
                      <option value="contract">Contract</option>
                      <option value="internship">Internship</option>
                    </select>
                  </div>
                  
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">Department</label>
                    <select
                      value={departmentFilter}
                      onChange={(e) => {
                        setDepartmentFilter(e.target.value)
                        setCurrentPage(1)
                      }}
                      className="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    >
                      <option value="all">All Departments</option>
                      {departments.map((dept, index) => (
                        <option key={index} value={dept}>{dept}</option>
                      ))}
                    </select>
                  </div>
                </div>
                
                <div className="flex justify-end mt-4">
                  <button
                    onClick={() => {
                      setTypeFilter('all')
                      setDepartmentFilter('all')
                      setFilterOpen(false)
                      if (typeFilter !== 'all' || departmentFilter !== 'all') {
                        fetchJobs(1)
                        setCurrentPage(1)
                      }
                    }}
                    className="px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors flex items-center gap-2"
                  >
                    <X className="w-4 h-4" />
                    Reset Filters
                  </button>
                </div>
              </motion.div>
            )}
          </AnimatePresence>
        </div>

        {/* Jobs List */}
        <div className="bg-gradient-to-b from-gray-900/80 to-gray-900/60 rounded-xl shadow-xl overflow-hidden border border-white/10">
          {loading ? (
            <div className="p-12 text-center">
              <div className="inline-flex items-center justify-center">
                <Loader2 className="w-8 h-8 text-blue-500 animate-spin" />
              </div>
              <p className="text-gray-400 mt-3">Loading jobs...</p>
            </div>
          ) : jobs.length === 0 ? (
            <div className="p-12 text-center">
              <div className="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/5 mb-4">
                <Briefcase className="w-8 h-8 text-gray-400" />
              </div>
              <p className="text-gray-300 text-lg font-medium">
                {searchTerm || typeFilter !== 'all' || departmentFilter !== 'all' ? 'No jobs found matching your search' : 'No jobs created yet'}
              </p>
              <p className="text-gray-500 mt-2">Try adjusting your filters or create a new job</p>
              {(searchTerm || typeFilter !== 'all' || departmentFilter !== 'all') && (
                <button
                  onClick={() => {
                    setSearchTerm('')
                    setTypeFilter('all')
                    setDepartmentFilter('all')
                    setActiveFilter('all')
                    fetchJobs(1)
                  }}
                  className="mt-4 px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-blue-400 hover:text-blue-300 transition-colors inline-flex items-center gap-2"
                >
                  <RefreshCw className="w-4 h-4" />
                  Clear all filters
                </button>
              )}
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {jobs.map((job) => (
                <motion.div 
                  key={job.id} 
                  className="p-6 hover:bg-white/5 transition-colors" 
                  initial={{ opacity: 0, y: 10 }} 
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.3 }}
                >
                  <div className="flex flex-col md:flex-row items-start justify-between gap-4">
                    <div className="flex-1 min-w-0">
                      <div className="flex items-center gap-3 mb-2">
                        <div className="flex-shrink-0 h-10 w-10 rounded-lg bg-gradient-to-br from-blue-600/20 to-indigo-600/20 border border-blue-500/20 flex items-center justify-center">
                          <Briefcase className="w-5 h-5 text-blue-400" />
                        </div>
                        <div>
                          <h3 className="font-semibold text-white text-xl">{job.title}</h3>
                          <div className="flex flex-wrap items-center gap-2 mt-2">
                            <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${getTypeColor(job.type)}`}>
                              {job.type.replace('-', ' ').toUpperCase()}
                            </span>
                            {!job.is_active && (
                              <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-red-900/30 text-red-400 border border-red-500/30 flex items-center gap-1">
                                <AlertCircle className="inline-block h-3 w-3" />
                                INACTIVE
                              </span>
                            )}
                          </div>
                        </div>
                      </div>

                      <div className="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 mt-4 text-sm text-gray-400">
                        {job.department && (
                          <div className="flex items-center">
                            <Building className="w-4 h-4 text-gray-500 mr-2" />
                            <span>{job.department}</span>
                          </div>
                        )}
                        <div className="flex items-center">
                          <MapPin className="w-4 h-4 text-gray-500 mr-2" />
                          <span>{job.location}</span>
                        </div>
                        <div className="flex items-center">
                          <DollarSign className="w-4 h-4 text-gray-500 mr-2" />
                          <span>{formatSalary(job)}</span>
                        </div>
                        {job.application_deadline && (
                          <div className="flex items-center">
                            <Calendar className="w-4 h-4 text-gray-500 mr-2" />
                            <span>Deadline: {new Date(job.application_deadline).toLocaleDateString()}</span>
                          </div>
                        )}
                        {job.applications && (
                          <div className="flex items-center">
                            <Users className="w-4 h-4 text-gray-500 mr-2" />
                            <span>{job.applications[0]?.count || 0} applications</span>
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="flex flex-col gap-3 sm:items-end w-full sm:w-auto">
                      <div className="flex flex-wrap gap-2 justify-start sm:justify-end">
                        <button
                          onClick={() => toggleJobStatus(job.id)}
                          className={`p-2 rounded-lg transition-colors ${job.is_active 
                            ? 'bg-green-900/20 text-green-400 hover:bg-green-900/30 border border-green-500/30' 
                            : 'bg-gray-800 text-gray-400 hover:bg-gray-700 border border-gray-700'}`}
                          title={job.is_active ? 'Deactivate job' : 'Activate job'}
                        >
                          {job.is_active ? <ToggleRight className="w-5 h-5" /> : <ToggleLeft className="w-5 h-5" />}
                        </button>

                        <button
                          onClick={() => setSelectedJob(job)}
                          className="p-2 bg-indigo-900/20 text-indigo-400 rounded-lg hover:bg-indigo-900/30 transition-colors border border-indigo-500/30"
                          title="View details"
                        >
                          <Eye className="w-5 h-5" />
                        </button>

                        <button
                          onClick={() => setEditingJob(job)}
                          className="p-2 bg-blue-900/20 text-blue-400 rounded-lg hover:bg-blue-900/30 transition-colors border border-blue-500/30"
                          title="Edit job"
                        >
                          <Edit className="w-5 h-5" />
                        </button>

                        <button
                          onClick={() => deleteJob(job.id)}
                          className="p-2 bg-red-900/20 text-red-400 rounded-lg hover:bg-red-900/30 transition-colors border border-red-500/30"
                          title="Delete job"
                        >
                          <Trash2 className="w-5 h-5" />
                        </button>
                      </div>
                      
                      <div className="mt-2 pt-2 border-t border-white/5 w-full sm:text-right">
                        <button 
                          onClick={() => setSelectedJob(job)}
                          className="text-sm text-blue-400 hover:text-blue-300 flex items-center transition-colors sm:inline-flex sm:ml-auto"
                        >
                          <FileText className="h-4 w-4 mr-1" />
                          View full details
                          <ChevronRight className="h-4 w-4 ml-1" />
                        </button>
                      </div>
                    </div>
                  </div>
                </motion.div>
              ))}
            </div>
          )}
        </div>

        {/* Pagination */}
        {pagination && pagination.last_page > 1 && (
          <div className="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
            <div className="text-sm text-gray-400">
              Showing <span className="text-white font-medium">{((pagination.current_page - 1) * pagination.per_page) + 1}-{Math.min(pagination.current_page * pagination.per_page, pagination.total)}</span> of <span className="text-white font-medium">{pagination.total}</span> jobs
            </div>
            
            <div className="flex space-x-1">
              <button
                onClick={() => setCurrentPage(pagination.current_page - 1)}
                disabled={pagination.current_page === 1}
                className="px-3 py-2 rounded-lg flex items-center bg-white/5 border border-white/10 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                </svg>
                Previous
              </button>
              
              <div className="hidden md:flex space-x-1">
                {Array.from({ length: pagination.last_page }, (_, i) => i + 1).map((page) => {
                  // Show first page, last page, current page, and pages around current page
                  if (
                    page === 1 ||
                    page === pagination.last_page ||
                    (page >= pagination.current_page - 1 && page <= pagination.current_page + 1)
                  ) {
                    return (
                      <button
                        key={page}
                        onClick={() => setCurrentPage(page)}
                        className={`w-10 h-10 flex items-center justify-center rounded-lg ${pagination.current_page === page ? 'bg-blue-600 text-white' : 'bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition-colors'}`}
                      >
                        {page}
                      </button>
                    )
                  } else if (
                    (page === pagination.current_page - 2 && pagination.current_page > 3) ||
                    (page === pagination.current_page + 2 && pagination.current_page < pagination.last_page - 2)
                  ) {
                    // Show ellipsis
                    return <span key={page} className="w-10 h-10 flex items-center justify-center text-gray-500">...</span>
                  }
                  return null
                })}
              </div>
              
              <div className="md:hidden flex items-center px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-300">
                <span className="text-white font-medium">{pagination.current_page}</span>
                <span className="mx-1">of</span>
                <span className="text-white font-medium">{pagination.last_page}</span>
              </div>
              
              <button
                onClick={() => setCurrentPage(pagination.current_page + 1)}
                disabled={pagination.current_page === pagination.last_page}
                className="px-3 py-2 rounded-lg flex items-center bg-white/5 border border-white/10 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                Next
                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                </svg>
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
              const csrfToken = getCSRFToken()
              if (!csrfToken) {
                throw new Error('CSRF token not found')
              }

              const response = await fetch('/api/admin/jobs', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'include',
                body: JSON.stringify(jobData),
              })

              if (!response.ok) {
                const errorData = await response.json().catch(() => null)
                throw new Error(errorData?.message || 'Failed to create job')
              }

              toast.success('Job created successfully!')
              setShowCreateModal(false)
              fetchJobs(currentPage)
              return Promise.resolve()
            } catch (error) {
              console.error('Job creation error:', error)
              toast.error(error instanceof Error ? error.message : 'Failed to create job')
              return Promise.reject(error) // This will trigger the isSubmitting reset in the form
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
              const csrfToken = getCSRFToken()
              if (!csrfToken) {
                throw new Error('CSRF token not found')
              }

              const response = await fetch(`/api/admin/jobs/${editingJob.id}`, {
                method: 'PUT',
                headers: {
                  'Content-Type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'include',
                body: JSON.stringify(jobData),
              })

              if (!response.ok) {
                const errorData = await response.json().catch(() => null)
                throw new Error(errorData?.message || 'Failed to update job')
              }

              toast.success('Job updated successfully!')
              setEditingJob(null)
              fetchJobs(currentPage)
              return Promise.resolve()
            } catch (error) {
              console.error('Job update error:', error)
              toast.error(error instanceof Error ? error.message : 'Failed to update job')
              return Promise.reject(error) // This will trigger the isSubmitting reset in the form
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
  onSubmit: (data: any) => Promise<void>
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
  
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [errors, setErrors] = useState<Record<string, string>>({}) 

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setIsSubmitting(true)
    setErrors({})

    const submitData = {
      ...formData,
      salary_min: formData.salary_min ? parseFloat(formData.salary_min.toString()) : null,
      salary_max: formData.salary_max ? parseFloat(formData.salary_max.toString()) : null,
      application_deadline: formData.application_deadline || null,
    }

    try {
      await onSubmit(submitData)
    } catch (error) {
      // Error handling is done in the parent component
      console.error('Form submission error:', error)
    } finally {
      setIsSubmitting(false)
    }
  }

  return (
    <div className="fixed inset-0 bg-black/80 backdrop-blur-md flex items-center justify-center z-50 p-4">
      <div className="bg-gradient-to-b from-gray-900 to-gray-900/90 border border-white/10 rounded-2xl p-8 w-full max-w-6xl max-h-[95vh] overflow-y-auto shadow-2xl">
        <div className="flex items-center justify-between mb-8">
          <div className="flex items-center gap-3">
            <div className="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-600/20">
              <Briefcase className="w-5 h-5 text-white" />
            </div>
            <h3 className="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-300">
              {job ? 'Edit Job' : 'Create New Job'}
            </h3>
          </div>
          <button 
            onClick={onClose} 
            disabled={isSubmitting}
            className="p-2 text-gray-400 hover:text-white transition-colors rounded-full hover:bg-white/10 disabled:opacity-50 disabled:cursor-not-allowed"
            aria-label="Close"
          >
            <X className="w-6 h-6" />
          </button>
        </div>

        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Basic Information */}
          <div className="bg-white/5 rounded-xl p-5 border border-white/10 shadow-inner">
            <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
              <FileText className="w-5 h-5 text-blue-400" />
              Basic Information
            </h4>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div className="md:col-span-2">
                <label className="block text-sm font-medium text-gray-300 mb-2">Job Title *</label>
                <div className="relative">
                  <input
                    type="text"
                    required
                    value={formData.title}
                    onChange={(e) => setFormData({ ...formData, title: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    placeholder="e.g. Senior Frontend Developer"
                    disabled={isSubmitting}
                  />
                  <Briefcase className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.title && <p className="text-red-400 text-sm mt-1">{errors.title}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Location *</label>
                <div className="relative">
                  <input
                    type="text"
                    required
                    value={formData.location}
                    onChange={(e) => setFormData({ ...formData, location: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    placeholder="e.g. Remote, New York, etc."
                    disabled={isSubmitting}
                  />
                  <MapPin className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.location && <p className="text-red-400 text-sm mt-1">{errors.location}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Department</label>
                <div className="relative">
                  <input
                    type="text"
                    value={formData.department}
                    onChange={(e) => setFormData({ ...formData, department: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    placeholder="e.g. Engineering, Marketing, etc."
                    disabled={isSubmitting}
                  />
                  <Building className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.department && <p className="text-red-400 text-sm mt-1">{errors.department}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Job Type *</label>
                <div className="relative">
                  <select
                    required
                    value={formData.type}
                    onChange={(e) => setFormData({ ...formData, type: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white appearance-none focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    disabled={isSubmitting}
                  >
                    <option value="full-time">Full Time</option>
                    <option value="part-time">Part Time</option>
                    <option value="contract">Contract</option>
                    <option value="internship">Internship</option>
                  </select>
                  <Briefcase className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                  <ChevronDown className="absolute right-3 top-3.5 w-4 h-4 text-gray-500 pointer-events-none" />
                </div>
                {errors.type && <p className="text-red-400 text-sm mt-1">{errors.type}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Application Deadline</label>
                <div className="relative">
                  <input
                    type="date"
                    value={formData.application_deadline}
                    onChange={(e) => setFormData({ ...formData, application_deadline: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    min={new Date().toISOString().split('T')[0]}
                    disabled={isSubmitting}
                  />
                  <Calendar className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.application_deadline && <p className="text-red-400 text-sm mt-1">{errors.application_deadline}</p>}
              </div>

              <div className="flex items-center gap-4">
                <label className="block text-sm font-medium text-gray-300">Salary Currency</label>
                <div className="relative flex-1">
                  <select
                    value={formData.salary_currency}
                    onChange={(e) => setFormData({ ...formData, salary_currency: e.target.value })}
                    className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white appearance-none focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    disabled={isSubmitting}
                  >
                    <option value="USD">USD ($)</option>
                    <option value="EUR">EUR (€)</option>
                    <option value="GBP">GBP (£)</option>
                    <option value="CAD">CAD (C$)</option>
                    <option value="AUD">AUD (A$)</option>
                    <option value="JPY">JPY (¥)</option>
                    <option value="CNY">CNY (¥)</option>
                    <option value="INR">INR (₹)</option>
                  </select>
                  <ChevronDown className="absolute right-3 top-3.5 w-4 h-4 text-gray-500 pointer-events-none" />
                </div>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Minimum Salary</label>
                <div className="relative">
                  <input
                    type="number"
                    min="0"
                    step="0.01"
                    value={formData.salary_min}
                    onChange={(e) => setFormData({ ...formData, salary_min: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    placeholder="e.g. 50000"
                    disabled={isSubmitting}
                  />
                  <DollarSign className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.salary_min && <p className="text-red-400 text-sm mt-1">{errors.salary_min}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Maximum Salary</label>
                <div className="relative">
                  <input
                    type="number"
                    min="0"
                    step="0.01"
                    value={formData.salary_max}
                    onChange={(e) => setFormData({ ...formData, salary_max: e.target.value })}
                    className="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all"
                    placeholder="e.g. 80000"
                    disabled={isSubmitting}
                  />
                  <DollarSign className="absolute left-3 top-3.5 w-4 h-4 text-gray-500" />
                </div>
                {errors.salary_max && <p className="text-red-400 text-sm mt-1">{errors.salary_max}</p>}
              </div>
            </div>
          </div>

          {/* Job Description */}
          <div className="bg-white/5 rounded-xl p-5 border border-white/10 shadow-inner">
            <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
              <FileText className="w-5 h-5 text-blue-400" />
              Job Description
            </h4>
            
            <div className="space-y-5">
              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                <textarea
                  required
                  value={formData.description}
                  onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                  className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all min-h-[150px]"
                  placeholder="Enter detailed job description..."
                  disabled={isSubmitting}
                />
                {errors.description && <p className="text-red-400 text-sm mt-1">{errors.description}</p>}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-300 mb-2">Requirements *</label>
                <textarea
                  required
                  value={formData.requirements}
                  onChange={(e) => setFormData({ ...formData, requirements: e.target.value })}
                  className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all min-h-[150px]"
                  placeholder="Enter job requirements..."
                  disabled={isSubmitting}
                />
                {errors.requirements && <p className="text-red-400 text-sm mt-1">{errors.requirements}</p>}
              </div>
            </div>
          </div>

          {/* Job Status */}
          <div className="bg-white/5 rounded-xl p-5 border border-white/10 shadow-inner">
            <div className="flex items-center gap-3">
              <div className="relative inline-block w-12 h-6 mr-2">
                <input
                  type="checkbox"
                  id="is_active"
                  checked={formData.is_active}
                  onChange={(e) => setFormData({ ...formData, is_active: e.target.checked })}
                  className="opacity-0 w-0 h-0"
                  disabled={isSubmitting}
                />
                <label
                  htmlFor="is_active"
                  className={`absolute cursor-pointer top-0 left-0 right-0 bottom-0 rounded-full transition-all duration-300 ${formData.is_active ? 'bg-gradient-to-r from-blue-600 to-indigo-600' : 'bg-gray-700'}`}
                >
                  <span 
                    className={`absolute left-1 bottom-1 bg-white w-4 h-4 rounded-full transition-all duration-300 ${formData.is_active ? 'transform translate-x-6' : ''}`}
                  />
                </label>
              </div>
              <label htmlFor="is_active" className="text-sm text-gray-300 cursor-pointer">
                Job is active and accepting applications
              </label>
            </div>
          </div>

          {/* Form Actions */}
          <div className="flex gap-4 pt-4 border-t border-white/10">
            <button
              type="button"
              onClick={onClose}
              disabled={isSubmitting}
              className="flex-1 px-5 py-3 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Cancel
            </button>
            <button
              type="submit"
              disabled={isSubmitting}
              className="flex-1 px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg transition-all shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed"
            >
              {isSubmitting ? (
                <>
                  <Loader2 className="w-4 h-4 animate-spin" />
                  {job ? 'Updating...' : 'Creating...'}
                </>
              ) : (
                <>
                  {job ? 'Update Job' : 'Create Job'}
                </>
              )}
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

  const formatDate = (dateString: string) => {
    const date = new Date(dateString)
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
  }

  return (
    <div className="fixed inset-0 bg-black/80 backdrop-blur-md flex items-center justify-center z-50 p-4">
      <div className="bg-gradient-to-b from-gray-900 to-gray-900/90 border border-white/10 rounded-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto shadow-2xl">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold text-white">Job Details</h3>
          <button onClick={onClose} className="p-2 text-gray-400 hover:text-white transition-colors rounded-lg hover:bg-white/5">
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Header Info */}
          <div className="bg-gradient-to-r from-blue-600/20 to-indigo-600/10 p-6 rounded-xl border border-blue-500/20">
            <div className="flex items-center gap-3 mb-4">
              <div className="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-600/30 to-indigo-600/30 border border-blue-500/30 flex items-center justify-center">
                <Briefcase className="h-6 w-6 text-blue-400" />
              </div>
              <div>
                <h2 className="text-2xl font-bold text-white">{job.title}</h2>
                <div className="flex flex-wrap items-center gap-2 mt-2">
                  <span className={`px-3 py-1 rounded-full text-sm font-medium ${getTypeColor(job.type)}`}>
                    {job.type.replace('-', ' ').toUpperCase()}
                  </span>
                  {!job.is_active ? (
                    <span className="px-3 py-1 rounded-full text-sm font-medium bg-red-900/30 text-red-400 border border-red-500/30 flex items-center gap-1">
                      <AlertCircle className="h-3 w-3" />
                      INACTIVE
                    </span>
                  ) : (
                    <span className="px-3 py-1 rounded-full text-sm font-medium bg-green-900/30 text-green-400 border border-green-500/30 flex items-center gap-1">
                      <CheckCircle className="h-3 w-3" />
                      ACTIVE
                    </span>
                  )}
                </div>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-gray-300">
              {job.department && (
                <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                  <Building className="w-5 h-5 text-blue-400" />
                  <div>
                    <p className="text-xs text-gray-400">Department</p>
                    <p className="font-medium">{job.department}</p>
                  </div>
                </div>
              )}
              <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                <MapPin className="w-5 h-5 text-blue-400" />
                <div>
                  <p className="text-xs text-gray-400">Location</p>
                  <p className="font-medium">{job.location}</p>
                </div>
              </div>
              <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                <DollarSign className="w-5 h-5 text-blue-400" />
                <div>
                  <p className="text-xs text-gray-400">Salary Range</p>
                  <p className="font-medium">{formatSalary(job)}</p>
                </div>
              </div>
              {job.application_deadline && (
                <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                  <Calendar className="w-5 h-5 text-blue-400" />
                  <div>
                    <p className="text-xs text-gray-400">Application Deadline</p>
                    <p className="font-medium">{formatDate(job.application_deadline)}</p>
                  </div>
                </div>
              )}
              <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                <Clock className="w-5 h-5 text-blue-400" />
                <div>
                  <p className="text-xs text-gray-400">Posted On</p>
                  <p className="font-medium">{formatDate(job.created_at)}</p>
                </div>
              </div>
              {job.applications && (
                <div className="flex items-center gap-2 bg-white/5 p-3 rounded-lg">
                  <Users className="w-5 h-5 text-blue-400" />
                  <div>
                    <p className="text-xs text-gray-400">Applications</p>
                    <p className="font-medium">{job.applications[0]?.count || 0}</p>
                  </div>
                </div>
              )}
            </div>
          </div>

          {/* Description */}
          <div className="bg-white/5 rounded-xl p-6 border border-white/10">
            <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
              <FileText className="w-5 h-5 text-blue-400" />
              Job Description
            </h4>
            <div className="prose prose-invert max-w-none prose-p:text-gray-300 prose-headings:text-white prose-strong:text-white prose-a:text-blue-400 prose-a:no-underline hover:prose-a:underline">
              <div dangerouslySetInnerHTML={{ __html: job.description.replace(/\n/g, '<br>') }} />
            </div>
          </div>

          {/* Requirements */}
          <div className="bg-white/5 rounded-xl p-6 border border-white/10">
            <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
              <CheckCircle className="w-5 h-5 text-blue-400" />
              Requirements
            </h4>
            <div className="prose prose-invert max-w-none prose-p:text-gray-300 prose-headings:text-white prose-strong:text-white prose-a:text-blue-400 prose-a:no-underline hover:prose-a:underline">
              <div dangerouslySetInnerHTML={{ __html: job.requirements.replace(/\n/g, '<br>') }} />
            </div>
          </div>

          {/* Public Link */}
          <div className="bg-white/5 rounded-xl p-6 border border-white/10">
            <h4 className="text-lg font-semibold text-white mb-3">Public Job Link</h4>
            <div className="flex items-center gap-3">
              <input
                type="text"
                value={`${window.location.origin}/careers/${job.slug}`}
                readOnly
                className="flex-1 px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-300 text-sm"
              />
              <button
                onClick={() => {
                  navigator.clipboard.writeText(`${window.location.origin}/careers/${job.slug}`)
                  toast.success('Link copied to clipboard!')
                }}
                className="px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors text-sm"
              >
                Copy Link
              </button>
            </div>
          </div>

          {/* Action Buttons */}
          <div className="flex gap-3 pt-6 border-t border-white/10">
            <button
              onClick={onEdit}
              className="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2"
            >
              <Edit className="w-4 h-4" />
              Edit Job
            </button>
            <button
              onClick={onDelete}
              className="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors flex items-center justify-center gap-2"
            >
              <Trash2 className="w-4 h-4" />
              Delete Job
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}

export default JobsManagement
