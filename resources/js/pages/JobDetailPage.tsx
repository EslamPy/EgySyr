import React, { useState, useEffect } from 'react'
import { useRoute, useLocation } from 'wouter'
import { motion } from 'framer-motion'
import {
  MapPin, Clock, Building, DollarSign, Calendar, ArrowLeft,
  User, Mail, Phone, Upload, FileText, ExternalLink,
  CheckCircle, AlertCircle, Loader, X
} from 'lucide-react'
import PageTransition from '../components/PageTransition'
import Footer from '../components/Footer'
import { Stars } from '../components/Stars'
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
  application_deadline?: string
  created_at: string
}

const JobDetailPage: React.FC = () => {
  const [, params] = useRoute('/careers/:slug')
  const [_, navigate] = useLocation()
  const slug = params?.slug || ''

  const [job, setJob] = useState<Job | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const [showApplicationForm, setShowApplicationForm] = useState(false)
  const [submitting, setSubmitting] = useState(false)
  const [submitted, setSubmitted] = useState(false)

  // Form state
  const [formData, setFormData] = useState({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    cover_letter: '',
    linkedin_url: '',
    portfolio_url: '',
    years_experience: '',
    additional_info: '',
  })
  const [cvFile, setCvFile] = useState<File | null>(null)
  const [formErrors, setFormErrors] = useState<Record<string, string>>({})

  useEffect(() => {
    const fetchJob = async () => {
      try {
        const response = await fetch(`/api/jobs/${slug}`)
        if (!response.ok) {
          if (response.status === 404) {
            setError('Job not found')
          } else {
            setError('Failed to load job details')
          }
          return
        }

        const data = await response.json()
        setJob(data)
      } catch (err) {
        setError('Failed to load job details')
      } finally {
        setLoading(false)
      }
    }

    if (slug) {
      fetchJob()
    } else {
      setError('Invalid job URL')
      setLoading(false)
    }
  }, [slug])

  const formatSalary = (job: Job) => {
    if (!job.salary_min && !job.salary_max) return null

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
      case 'full-time': return 'bg-green-500/20 text-green-400 border-green-500/30'
      case 'part-time': return 'bg-blue-500/20 text-blue-400 border-blue-500/30'
      case 'contract': return 'bg-orange-500/20 text-orange-400 border-orange-500/30'
      case 'internship': return 'bg-purple-500/20 text-purple-400 border-purple-500/30'
      default: return 'bg-gray-500/20 text-gray-400 border-gray-500/30'
    }
  }

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target
    setFormData(prev => ({ ...prev, [name]: value }))
    // Clear error when user starts typing
    if (formErrors[name]) {
      setFormErrors(prev => ({ ...prev, [name]: '' }))
    }
  }

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0]
    if (file) {
      // Validate file type and size
      const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
      if (!allowedTypes.includes(file.type)) {
        toast.error('Please upload a PDF or Word document')
        return
      }
      if (file.size > 5 * 1024 * 1024) { // 5MB limit
        toast.error('File size must be less than 5MB')
        return
      }
      setCvFile(file)
      if (formErrors.cv) {
        setFormErrors(prev => ({ ...prev, cv: '' }))
      }
    }
  }

  const validateForm = () => {
    const errors: Record<string, string> = {}

    if (!formData.first_name.trim()) errors.first_name = 'First name is required'
    if (!formData.last_name.trim()) errors.last_name = 'Last name is required'
    if (!formData.email.trim()) errors.email = 'Email is required'
    else if (!/\S+@\S+\.\S+/.test(formData.email)) errors.email = 'Please enter a valid email'
    if (!formData.phone.trim()) errors.phone = 'Phone number is required'
    if (!cvFile) errors.cv = 'CV/Resume is required'

    if (formData.linkedin_url && !formData.linkedin_url.startsWith('http')) {
      errors.linkedin_url = 'Please enter a valid URL'
    }
    if (formData.portfolio_url && !formData.portfolio_url.startsWith('http')) {
      errors.portfolio_url = 'Please enter a valid URL'
    }
    if (formData.years_experience && (isNaN(Number(formData.years_experience)) || Number(formData.years_experience) < 0)) {
      errors.years_experience = 'Please enter a valid number'
    }

    setFormErrors(errors)
    return Object.keys(errors).length === 0
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()

    if (!validateForm()) return

    setSubmitting(true)

    try {
      const submitData = new FormData()
      Object.entries(formData).forEach(([key, value]) => {
        if (value) submitData.append(key, value)
      })
      if (cvFile) submitData.append('cv', cvFile)

      const response = await fetch(`/api/jobs/${slug}/apply`, {
        method: 'POST',
        body: submitData,
      })

      if (!response.ok) {
        const errorData = await response.json()
        throw new Error(errorData.error || 'Failed to submit application')
      }

      const result = await response.json()
      setSubmitted(true)
      toast.success(result.message || 'Application submitted successfully!')
    } catch (err) {
      const errorMessage = err instanceof Error ? err.message : 'Failed to submit application'
      toast.error(errorMessage)
    } finally {
      setSubmitting(false)
    }
  }

  // Loading state
  if (loading) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
          <div className="text-center">
            <Loader className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-purple" />
            <div className="text-xl font-semibold mb-2">Loading job details...</div>
          </div>
        </div>
      </PageTransition>
    )
  }

  // Error state
  if (error || !job) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
          <div className="text-center">
            <AlertCircle className="w-16 h-16 mx-auto mb-4 text-red-400" />
            <div className="text-2xl font-semibold mb-2">Job Not Found</div>
            <div className="text-gray-400 mb-6">{error || 'The job you are looking for does not exist.'}</div>
            <button
              onClick={() => navigate('/careers')}
              className="px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              View All Jobs
            </button>
          </div>
        </div>
      </PageTransition>
    )
  }

  // Success state
  if (submitted) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
          <div className="text-center max-w-md mx-auto px-6">
            <CheckCircle className="w-16 h-16 mx-auto mb-6 text-green-400" />
            <div className="text-3xl font-bold mb-4 bg-neon-gradient bg-clip-text text-transparent">
              Application Submitted!
            </div>
            <div className="text-gray-400 mb-8">
              Thank you for applying to <strong>{job.title}</strong>. We have received your application and will review it shortly. You'll hear from us soon!
            </div>
            <div className="flex gap-3">
              <button
                onClick={() => navigate('/careers')}
                className="flex-1 px-6 py-3 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
              >
                View More Jobs
              </button>
              <button
                onClick={() => navigate('/')}
                className="flex-1 px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
              >
                Go Home
              </button>
            </div>
          </div>
        </div>
      </PageTransition>
    )
  }

  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white">
        <Stars />

        <div className="relative z-10">
          {/* Header */}
          <div className="container mx-auto px-6 pt-24 pb-12">
            <button
              onClick={() => navigate('/careers')}
              className="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors mb-8"
            >
              <ArrowLeft className="w-4 h-4" />
              Back to Careers
            </button>

            <div className="max-w-4xl">
              <div className="flex items-center gap-3 mb-4">
                <h1 className="text-4xl font-bold bg-neon-gradient bg-clip-text text-transparent">
                  {job.title}
                </h1>
                <span className={`px-3 py-1 border text-sm font-medium rounded-full ${getTypeColor(job.type)}`}>
                  {job.type.replace('-', ' ').toUpperCase()}
                </span>
              </div>

              <div className="flex flex-wrap items-center gap-6 text-gray-400 mb-8">
                {job.department && (
                  <div className="flex items-center gap-2">
                    <Building className="w-5 h-5" />
                    <span>{job.department}</span>
                  </div>
                )}
                <div className="flex items-center gap-2">
                  <MapPin className="w-5 h-5" />
                  <span>{job.location}</span>
                </div>
                {formatSalary(job) && (
                  <div className="flex items-center gap-2">
                    <DollarSign className="w-5 h-5" />
                    <span>{formatSalary(job)}</span>
                  </div>
                )}
                {job.application_deadline && (
                  <div className="flex items-center gap-2">
                    <Calendar className="w-5 h-5" />
                    <span>Apply by {new Date(job.application_deadline).toLocaleDateString()}</span>
                  </div>
                )}
              </div>

              <div className="flex gap-4">
                <button
                  onClick={() => setShowApplicationForm(true)}
                  className="px-8 py-3 bg-gradient-to-r from-neon-purple to-neon-pink text-white font-semibold rounded-lg shadow-lg hover:shadow-neon-purple/25 transition-all duration-200 hover:scale-[1.02]"
                >
                  Apply Now
                </button>
                <button
                  onClick={() => window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })}
                  className="px-8 py-3 bg-white/5 border border-white/10 text-white rounded-lg hover:bg-white/10 transition-colors"
                >
                  Learn More
                </button>
              </div>
            </div>
          </div>

          {/* Job Details */}
          <div className="container mx-auto px-6 pb-24">
            <div className="max-w-4xl">
              <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div className="lg:col-span-2 space-y-8">
                  {/* Description */}
                  <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.6 }}
                    className="bg-white/5 border border-white/10 rounded-xl p-8"
                  >
                    <h2 className="text-2xl font-bold mb-6">Job Description</h2>
                    <div className="prose prose-invert max-w-none">
                      <p className="text-gray-300 leading-relaxed whitespace-pre-wrap">
                        {job.description}
                      </p>
                    </div>
                  </motion.div>

                  {/* Requirements */}
                  <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.6, delay: 0.1 }}
                    className="bg-white/5 border border-white/10 rounded-xl p-8"
                  >
                    <h2 className="text-2xl font-bold mb-6">Requirements</h2>
                    <div className="prose prose-invert max-w-none">
                      <p className="text-gray-300 leading-relaxed whitespace-pre-wrap">
                        {job.requirements}
                      </p>
                    </div>
                  </motion.div>
                </div>

                {/* Sidebar */}
                <div className="space-y-6">
                  <motion.div
                    initial={{ opacity: 0, x: 20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.6, delay: 0.2 }}
                    className="bg-white/5 border border-white/10 rounded-xl p-6"
                  >
                    <h3 className="text-lg font-semibold mb-4">Job Details</h3>
                    <div className="space-y-4">
                      <div>
                        <div className="text-sm text-gray-400 mb-1">Position Type</div>
                        <div className="text-white capitalize">{job.type.replace('-', ' ')}</div>
                      </div>
                      <div>
                        <div className="text-sm text-gray-400 mb-1">Location</div>
                        <div className="text-white">{job.location}</div>
                      </div>
                      {job.department && (
                        <div>
                          <div className="text-sm text-gray-400 mb-1">Department</div>
                          <div className="text-white">{job.department}</div>
                        </div>
                      )}
                      {formatSalary(job) && (
                        <div>
                          <div className="text-sm text-gray-400 mb-1">Salary Range</div>
                          <div className="text-neon-cyan font-semibold">{formatSalary(job)}</div>
                        </div>
                      )}
                      <div>
                        <div className="text-sm text-gray-400 mb-1">Posted</div>
                        <div className="text-white">{new Date(job.created_at).toLocaleDateString()}</div>
                      </div>
                    </div>
                  </motion.div>

                  <motion.div
                    initial={{ opacity: 0, x: 20 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.6, delay: 0.3 }}
                    className="bg-white/5 border border-white/10 rounded-xl p-6"
                  >
                    <button
                      onClick={() => setShowApplicationForm(true)}
                      className="w-full px-6 py-3 bg-gradient-to-r from-neon-purple to-neon-pink text-white font-semibold rounded-lg shadow-lg hover:shadow-neon-purple/25 transition-all duration-200 hover:scale-[1.02]"
                    >
                      Apply for this Position
                    </button>
                  </motion.div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <Footer />

        {/* Application Form Modal */}
        {showApplicationForm && (
          <ApplicationFormModal
            job={job}
            formData={formData}
            cvFile={cvFile}
            formErrors={formErrors}
            submitting={submitting}
            onClose={() => setShowApplicationForm(false)}
            onInputChange={handleInputChange}
            onFileChange={handleFileChange}
            onSubmit={handleSubmit}
          />
        )}
      </div>
    </PageTransition>
  )
}

// Application Form Modal Component
const ApplicationFormModal: React.FC<{
  job: Job
  formData: any
  cvFile: File | null
  formErrors: Record<string, string>
  submitting: boolean
  onClose: () => void
  onInputChange: (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => void
  onFileChange: (e: React.ChangeEvent<HTMLInputElement>) => void
  onSubmit: (e: React.FormEvent) => void
}> = ({ job, formData, cvFile, formErrors, submitting, onClose, onInputChange, onFileChange, onSubmit }) => {
  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div className="sticky top-0 bg-deep-charcoal border-b border-white/10 p-6">
          <div className="flex items-center justify-between">
            <h3 className="text-xl font-semibold">Apply for {job.title}</h3>
            <button
              onClick={onClose}
              className="p-1 text-gray-400 hover:text-white transition-colors"
            >
              <X className="w-5 h-5" />
            </button>
          </div>
        </div>

        <form onSubmit={onSubmit} className="p-6 space-y-6">
          {/* Personal Information */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                First Name *
              </label>
              <input
                type="text"
                name="first_name"
                value={formData.first_name}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.first_name ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your first name"
              />
              {formErrors.first_name && (
                <div className="text-red-400 text-sm mt-1">{formErrors.first_name}</div>
              )}
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Last Name *
              </label>
              <input
                type="text"
                name="last_name"
                value={formData.last_name}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.last_name ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="Enter your last name"
              />
              {formErrors.last_name && (
                <div className="text-red-400 text-sm mt-1">{formErrors.last_name}</div>
              )}
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Email Address *
              </label>
              <input
                type="email"
                name="email"
                value={formData.email}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.email ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="your@email.com"
              />
              {formErrors.email && (
                <div className="text-red-400 text-sm mt-1">{formErrors.email}</div>
              )}
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Phone Number *
              </label>
              <input
                type="tel"
                name="phone"
                value={formData.phone}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.phone ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="+1 (555) 123-4567"
              />
              {formErrors.phone && (
                <div className="text-red-400 text-sm mt-1">{formErrors.phone}</div>
              )}
            </div>
          </div>

          {/* CV Upload */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              CV/Resume *
            </label>
            <div className="relative">
              <input
                type="file"
                onChange={onFileChange}
                accept=".pdf,.doc,.docx"
                className="hidden"
                id="cv-upload"
              />
              <label
                htmlFor="cv-upload"
                className={`flex items-center justify-center gap-3 w-full px-4 py-8 border-2 border-dashed rounded-lg cursor-pointer transition-colors ${
                  formErrors.cv
                    ? 'border-red-500 bg-red-500/5'
                    : 'border-white/20 hover:border-neon-purple/50 hover:bg-white/5'
                }`}
              >
                <Upload className="w-6 h-6 text-gray-400" />
                <div className="text-center">
                  <div className="text-white font-medium">
                    {cvFile ? cvFile.name : 'Upload your CV/Resume'}
                  </div>
                  <div className="text-sm text-gray-400 mt-1">
                    PDF, DOC, or DOCX (max 5MB)
                  </div>
                </div>
              </label>
            </div>
            {formErrors.cv && (
              <div className="text-red-400 text-sm mt-1">{formErrors.cv}</div>
            )}
          </div>

          {/* Optional Fields */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                LinkedIn Profile
              </label>
              <input
                type="url"
                name="linkedin_url"
                value={formData.linkedin_url}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.linkedin_url ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="https://linkedin.com/in/yourprofile"
              />
              {formErrors.linkedin_url && (
                <div className="text-red-400 text-sm mt-1">{formErrors.linkedin_url}</div>
              )}
            </div>

            <div>
              <label className="block text-sm font-medium text-gray-300 mb-2">
                Portfolio/Website
              </label>
              <input
                type="url"
                name="portfolio_url"
                value={formData.portfolio_url}
                onChange={onInputChange}
                className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                  formErrors.portfolio_url ? 'border-red-500' : 'border-white/10'
                }`}
                placeholder="https://yourportfolio.com"
              />
              {formErrors.portfolio_url && (
                <div className="text-red-400 text-sm mt-1">{formErrors.portfolio_url}</div>
              )}
            </div>
          </div>

          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Years of Experience
            </label>
            <input
              type="number"
              name="years_experience"
              value={formData.years_experience}
              onChange={onInputChange}
              min="0"
              max="50"
              className={`w-full px-3 py-2 bg-white/5 border rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple ${
                formErrors.years_experience ? 'border-red-500' : 'border-white/10'
              }`}
              placeholder="e.g. 5"
            />
            {formErrors.years_experience && (
              <div className="text-red-400 text-sm mt-1">{formErrors.years_experience}</div>
            )}
          </div>

          {/* Cover Letter */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Cover Letter
            </label>
            <textarea
              name="cover_letter"
              value={formData.cover_letter}
              onChange={onInputChange}
              rows={4}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
              placeholder="Tell us why you're interested in this position and what makes you a great fit..."
            />
          </div>

          {/* Additional Info */}
          <div>
            <label className="block text-sm font-medium text-gray-300 mb-2">
              Additional Information
            </label>
            <textarea
              name="additional_info"
              value={formData.additional_info}
              onChange={onInputChange}
              rows={3}
              className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
              placeholder="Any additional information you'd like to share..."
            />
          </div>

          {/* Submit Button */}
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
              disabled={submitting}
              className="flex-1 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 disabled:bg-gray-600 disabled:cursor-not-allowed text-white rounded-lg transition-colors"
            >
              {submitting ? (
                <div className="flex items-center justify-center gap-2">
                  <Loader className="w-4 h-4 animate-spin" />
                  Submitting...
                </div>
              ) : (
                'Submit Application'
              )}
            </button>
          </div>
        </form>
      </div>
    </div>
  )
}

export default JobDetailPage