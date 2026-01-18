import React, { useState, useEffect } from 'react'
import { useRoute, useLocation } from 'wouter'
import { motion } from 'framer-motion'
import {
  MapPin, Clock, Building, DollarSign, Calendar, ArrowLeft,
  User, Upload, FileText, ExternalLink,
  CheckCircle, AlertCircle, Loader, X, Briefcase
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
      <div className="min-h-screen bg-gradient-to-br from-jet-black via-deep-charcoal to-jet-black text-white">
        <Stars />

        <div className="relative z-10">
          {/* Hero Section */}
          <div className="relative overflow-hidden">
            {/* Background Pattern */}
            <div className="absolute inset-0 opacity-5">
              <div className="absolute inset-0 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20" />
              <div className="absolute inset-0" style={{
                backgroundImage: `radial-gradient(circle at 25% 25%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                                 radial-gradient(circle at 75% 75%, rgba(6, 182, 212, 0.1) 0%, transparent 50%)`
              }} />
            </div>

            <div className="container mx-auto px-6 pt-32 pb-20">
              <motion.button
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                onClick={() => {
                  console.log('Back button clicked')
                  navigate('/careers')
                }}
                className="inline-flex items-center gap-2 text-gray-400 hover:text-neon-cyan transition-all duration-300 mb-12 group cursor-pointer"
              >
                <ArrowLeft className="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
                <span className="font-medium">Back to Careers</span>
              </motion.button>

              <div className="max-w-5xl">
                <motion.div
                  initial={{ opacity: 0, y: 30 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.8 }}
                  className="mb-8"
                >
                  <div className="flex flex-col lg:flex-row lg:items-center gap-6 mb-6">
                    <h1 className="text-5xl lg:text-6xl font-bold bg-gradient-to-r from-white via-neon-cyan to-neon-purple bg-clip-text text-transparent leading-tight">
                      {job.title}
                    </h1>
                    <span className={`px-4 py-2 border text-sm font-bold rounded-full backdrop-blur-sm ${getTypeColor(job.type)} lg:self-start lg:mt-2`}>
                      {job.type.replace('-', ' ').toUpperCase()}
                    </span>
                  </div>

                  {/* Job Meta Info */}
                  <div className="flex flex-wrap items-center gap-8 text-gray-300 mb-10">
                    {job.department && (
                      <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.2 }}
                        className="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-full border border-white/10"
                      >
                        <Building className="w-5 h-5 text-neon-purple" />
                        <span className="font-medium">{job.department}</span>
                      </motion.div>
                    )}
                    <motion.div
                      initial={{ opacity: 0, y: 20 }}
                      animate={{ opacity: 1, y: 0 }}
                      transition={{ delay: 0.3 }}
                      className="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-full border border-white/10"
                    >
                      <MapPin className="w-5 h-5 text-neon-cyan" />
                      <span className="font-medium">{job.location}</span>
                    </motion.div>
                    {formatSalary(job) && (
                      <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.4 }}
                        className="flex items-center gap-3 bg-gradient-to-r from-green-500/10 to-emerald-500/10 px-4 py-2 rounded-full border border-green-500/20"
                      >
                        <DollarSign className="w-5 h-5 text-green-400" />
                        <span className="font-bold text-green-300">{formatSalary(job)}</span>
                      </motion.div>
                    )}
                    {job.application_deadline && (
                      <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.5 }}
                        className="flex items-center gap-3 bg-orange-500/10 px-4 py-2 rounded-full border border-orange-500/20"
                      >
                        <Calendar className="w-5 h-5 text-orange-400" />
                        <span className="font-medium text-orange-300">Apply by {new Date(job.application_deadline).toLocaleDateString()}</span>
                      </motion.div>
                    )}
                  </div>

                  {/* CTA Buttons */}
                  <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: 0.6 }}
                    className="flex flex-col sm:flex-row gap-4"
                  >
                    <button
                      onClick={() => navigate(`/careers/${slug}/apply`)}
                      className="group relative px-10 py-4 bg-gradient-to-r from-neon-purple via-purple-600 to-neon-pink text-white font-bold rounded-xl shadow-2xl shadow-neon-purple/30 hover:shadow-neon-purple/50 transition-all duration-300 hover:scale-[1.02] overflow-hidden"
                    >
                      <div className="absolute inset-0 bg-gradient-to-r from-neon-pink via-purple-600 to-neon-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                      <span className="relative flex items-center gap-3">
                        <User className="w-5 h-5" />
                        Apply Now
                      </span>
                    </button>
                    <button
                      onClick={() => window.scrollTo({ top: window.innerHeight * 0.8, behavior: 'smooth' })}
                      className="px-10 py-4 bg-white/5 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-neon-cyan/50 transition-all duration-300 backdrop-blur-sm"
                    >
                      Learn More
                    </button>
                  </motion.div>
                </motion.div>
              </div>
            </div>
          </div>

          {/* Main Content */}
          <div className="container mx-auto px-6 pb-24">
            <div className="max-w-7xl mx-auto">
              <div className="grid grid-cols-1 xl:grid-cols-4 gap-12">
                {/* Main Content */}
                <div className="xl:col-span-3 space-y-10">
                  {/* Job Description */}
                  <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.2 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-r from-neon-purple/10 to-neon-cyan/10 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-300" />
                    <div className="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl p-8 backdrop-blur-sm">
                      <div className="flex items-center gap-3 mb-6">
                        <div className="w-10 h-10 bg-gradient-to-r from-neon-purple to-neon-cyan rounded-lg flex items-center justify-center">
                          <FileText className="w-5 h-5 text-white" />
                        </div>
                        <h2 className="text-3xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                          Job Description
                        </h2>
                      </div>
                      <div className="prose prose-invert prose-lg max-w-none">
                        <div className="text-gray-200 leading-relaxed text-lg whitespace-pre-wrap font-light">
                          {job.description}
                        </div>
                      </div>
                    </div>
                  </motion.div>

                  {/* Requirements */}
                  <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.4 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-r from-neon-cyan/10 to-neon-purple/10 rounded-2xl blur-xl group-hover:blur-2xl transition-all duration-300" />
                    <div className="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl p-8 backdrop-blur-sm">
                      <div className="flex items-center gap-3 mb-6">
                        <div className="w-10 h-10 bg-gradient-to-r from-neon-cyan to-neon-purple rounded-lg flex items-center justify-center">
                          <CheckCircle className="w-5 h-5 text-white" />
                        </div>
                        <h2 className="text-3xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                          Requirements & Qualifications
                        </h2>
                      </div>
                      <div className="prose prose-invert prose-lg max-w-none">
                        <div className="text-gray-200 leading-relaxed text-lg whitespace-pre-wrap font-light">
                          {job.requirements}
                        </div>
                      </div>
                    </div>
                  </motion.div>

                  {/* Apply Section */}
                  <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.6 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-r from-neon-purple/20 to-neon-pink/20 rounded-2xl blur-xl" />
                    <div className="relative bg-gradient-to-br from-white/10 to-white/5 border border-white/20 rounded-2xl p-8 backdrop-blur-sm text-center">
                      <h3 className="text-2xl font-bold mb-4 bg-gradient-to-r from-neon-purple to-neon-pink bg-clip-text text-transparent">
                        Ready to Join Our Team?
                      </h3>
                      <p className="text-gray-300 mb-6 text-lg">
                        Take the next step in your career and become part of our innovative team.
                      </p>
                      <button
                        onClick={() => setShowApplicationForm(true)}
                        className="group relative px-12 py-4 bg-gradient-to-r from-neon-purple via-purple-600 to-neon-pink text-white font-bold rounded-xl shadow-2xl shadow-neon-purple/30 hover:shadow-neon-purple/50 transition-all duration-300 hover:scale-[1.02] overflow-hidden"
                      >
                        <div className="absolute inset-0 bg-gradient-to-r from-neon-pink via-purple-600 to-neon-purple opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                        <span className="relative flex items-center gap-3">
                          <User className="w-5 h-5" />
                          Apply for This Position
                        </span>
                      </button>
                    </div>
                  </motion.div>
                </div>

                {/* Enhanced Sidebar */}
                <div className="space-y-8">
                  {/* Job Details Card */}
                  <motion.div
                    initial={{ opacity: 0, x: 30 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.8, delay: 0.3 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 to-neon-cyan/20 rounded-2xl blur-lg group-hover:blur-xl transition-all duration-300" />
                    <div className="relative bg-gradient-to-br from-white/15 to-white/5 border border-white/30 rounded-2xl p-6 backdrop-blur-md">
                      <div className="flex items-center gap-3 mb-6">
                        <div className="w-8 h-8 bg-gradient-to-r from-neon-purple to-neon-cyan rounded-lg flex items-center justify-center">
                          <Briefcase className="w-4 h-4 text-white" />
                        </div>
                        <h3 className="text-xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                          Job Details
                        </h3>
                      </div>

                      <div className="space-y-5">
                        <div className="group/item">
                          <div className="text-sm font-medium text-gray-400 mb-2 flex items-center gap-2">
                            <Clock className="w-4 h-4" />
                            Position Type
                          </div>
                          <div className="text-white font-semibold capitalize bg-white/5 px-3 py-2 rounded-lg border border-white/10">
                            {job.type.replace('-', ' ')}
                          </div>
                        </div>

                        <div className="group/item">
                          <div className="text-sm font-medium text-gray-400 mb-2 flex items-center gap-2">
                            <MapPin className="w-4 h-4" />
                            Location
                          </div>
                          <div className="text-white font-semibold bg-white/5 px-3 py-2 rounded-lg border border-white/10">
                            {job.location}
                          </div>
                        </div>

                        {job.department && (
                          <div className="group/item">
                            <div className="text-sm font-medium text-gray-400 mb-2 flex items-center gap-2">
                              <Building className="w-4 h-4" />
                              Department
                            </div>
                            <div className="text-white font-semibold bg-white/5 px-3 py-2 rounded-lg border border-white/10">
                              {job.department}
                            </div>
                          </div>
                        )}

                        {formatSalary(job) && (
                          <div className="group/item">
                            <div className="text-sm font-medium text-gray-400 mb-2 flex items-center gap-2">
                              <DollarSign className="w-4 h-4" />
                              Salary Range
                            </div>
                            <div className="text-green-300 font-bold text-lg bg-gradient-to-r from-green-500/10 to-emerald-500/10 px-3 py-2 rounded-lg border border-green-500/20">
                              {formatSalary(job)}
                            </div>
                          </div>
                        )}

                        <div className="group/item">
                          <div className="text-sm font-medium text-gray-400 mb-2 flex items-center gap-2">
                            <Calendar className="w-4 h-4" />
                            Posted Date
                          </div>
                          <div className="text-white font-semibold bg-white/5 px-3 py-2 rounded-lg border border-white/10">
                            {new Date(job.created_at).toLocaleDateString('en-US', {
                              year: 'numeric',
                              month: 'long',
                              day: 'numeric'
                            })}
                          </div>
                        </div>
                      </div>
                    </div>
                  </motion.div>

                  {/* Apply Button Card */}
                  <motion.div
                    initial={{ opacity: 0, x: 30 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.8, delay: 0.5 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/30 to-neon-pink/30 rounded-2xl blur-lg" />
                    <div className="relative bg-gradient-to-br from-white/15 to-white/5 border border-white/30 rounded-2xl p-6 backdrop-blur-md">
                      <div className="text-center mb-4">
                        <h4 className="text-lg font-bold text-white mb-2">Ready to Apply?</h4>
                        <p className="text-gray-300 text-sm">Join our team and make an impact</p>
                      </div>
                      <button
                        onClick={() => navigate(`/careers/${slug}/apply`)}
                        className="group/btn relative w-full px-6 py-4 bg-gradient-to-r from-neon-purple via-purple-600 to-neon-pink text-white font-bold rounded-xl shadow-2xl shadow-neon-purple/30 hover:shadow-neon-purple/50 transition-all duration-300 hover:scale-[1.02] overflow-hidden"
                      >
                        <div className="absolute inset-0 bg-gradient-to-r from-neon-pink via-purple-600 to-neon-purple opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300" />
                        <span className="relative flex items-center justify-center gap-3">
                          <User className="w-5 h-5" />
                          Apply Now
                        </span>
                      </button>
                    </div>
                  </motion.div>

                  {/* Share Card */}
                  <motion.div
                    initial={{ opacity: 0, x: 30 }}
                    animate={{ opacity: 1, x: 0 }}
                    transition={{ duration: 0.8, delay: 0.7 }}
                    className="relative group"
                  >
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-cyan/20 to-neon-purple/20 rounded-2xl blur-lg group-hover:blur-xl transition-all duration-300" />
                    <div className="relative bg-gradient-to-br from-white/15 to-white/5 border border-white/30 rounded-2xl p-6 backdrop-blur-md">
                      <h4 className="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <ExternalLink className="w-5 h-5 text-neon-cyan" />
                        Share This Job
                      </h4>
                      <div className="flex gap-2">
                        <button
                          onClick={() => navigator.clipboard.writeText(window.location.href)}
                          className="flex-1 px-3 py-2 bg-white/10 border border-white/20 text-white text-sm rounded-lg hover:bg-white/20 transition-colors"
                        >
                          Copy Link
                        </button>
                        <button
                          onClick={() => window.open(`https://twitter.com/intent/tweet?text=Check out this job: ${job.title}&url=${window.location.href}`, '_blank')}
                          className="flex-1 px-3 py-2 bg-blue-500/20 border border-blue-500/30 text-blue-300 text-sm rounded-lg hover:bg-blue-500/30 transition-colors">
                          Tweet
                        </button>
                      </div>
                    </div>
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
    <div className="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4">
      <motion.div
        initial={{ opacity: 0, scale: 0.9, y: 20 }}
        animate={{ opacity: 1, scale: 1, y: 0 }}
        exit={{ opacity: 0, scale: 0.9, y: 20 }}
        className="relative w-full max-w-3xl max-h-[90vh] overflow-hidden"
      >
        {/* Background Effects */}
        <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 to-neon-cyan/20 rounded-2xl blur-xl" />

        <div className="relative bg-gradient-to-br from-deep-charcoal/95 to-jet-black/95 border border-white/20 rounded-2xl backdrop-blur-md overflow-hidden">
          {/* Header */}
          <div className="sticky top-0 bg-gradient-to-r from-deep-charcoal/95 to-jet-black/95 border-b border-white/20 p-6 backdrop-blur-md">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-2xl font-bold bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Apply for {job.title}
                </h3>
                <p className="text-gray-400 mt-1">Join our team and make an impact</p>
              </div>
              <button
                onClick={onClose}
                className="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200"
              >
                <X className="w-6 h-6" />
              </button>
            </div>
          </div>

          {/* Form Container */}
          <div className="max-h-[calc(90vh-120px)] overflow-y-auto custom-scrollbar">
            <form onSubmit={onSubmit} className="p-8 space-y-8">
              {/* Personal Information */}
              <div className="space-y-6">
                <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                  <User className="w-5 h-5 text-neon-purple" />
                  Personal Information
                </h4>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-semibold text-gray-300 mb-3">
                      First Name *
                    </label>
                    <input
                      type="text"
                      name="first_name"
                      value={formData.first_name}
                      onChange={onInputChange}
                      className={`w-full px-4 py-3 bg-white/10 border-2 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple transition-all duration-200 backdrop-blur-sm ${formErrors.first_name ? 'border-red-500' : 'border-white/20 hover:border-white/30'
                        }`}
                      placeholder="Enter your first name"
                    />
                    {formErrors.first_name && (
                      <div className="text-red-400 text-sm mt-2 flex items-center gap-1">
                        <AlertCircle className="w-4 h-4" />
                        {formErrors.first_name}
                      </div>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-semibold text-gray-300 mb-3">
                      Last Name *
                    </label>
                    <input
                      type="text"
                      name="last_name"
                      value={formData.last_name}
                      onChange={onInputChange}
                      className={`w-full px-4 py-3 bg-white/10 border-2 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple transition-all duration-200 backdrop-blur-sm ${formErrors.last_name ? 'border-red-500' : 'border-white/20 hover:border-white/30'
                        }`}
                      placeholder="Enter your last name"
                    />
                    {formErrors.last_name && (
                      <div className="text-red-400 text-sm mt-2 flex items-center gap-1">
                        <AlertCircle className="w-4 h-4" />
                        {formErrors.last_name}
                      </div>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-semibold text-gray-300 mb-3">
                      Email Address *
                    </label>
                    <input
                      type="email"
                      name="email"
                      value={formData.email}
                      onChange={onInputChange}
                      className={`w-full px-4 py-3 bg-white/10 border-2 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple transition-all duration-200 backdrop-blur-sm ${formErrors.email ? 'border-red-500' : 'border-white/20 hover:border-white/30'
                        }`}
                      placeholder="your@email.com"
                    />
                    {formErrors.email && (
                      <div className="text-red-400 text-sm mt-2 flex items-center gap-1">
                        <AlertCircle className="w-4 h-4" />
                        {formErrors.email}
                      </div>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-semibold text-gray-300 mb-3">
                      Phone Number *
                    </label>
                    <input
                      type="tel"
                      name="phone"
                      value={formData.phone}
                      onChange={onInputChange}
                      className={`w-full px-4 py-3 bg-white/10 border-2 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple transition-all duration-200 backdrop-blur-sm ${formErrors.phone ? 'border-red-500' : 'border-white/20 hover:border-white/30'
                        }`}
                      placeholder="+1 (555) 123-4567"
                    />
                    {formErrors.phone && (
                      <div className="text-red-400 text-sm mt-2 flex items-center gap-1">
                        <AlertCircle className="w-4 h-4" />
                        {formErrors.phone}
                      </div>
                    )}
                  </div>
                </div>
              </div>

              {/* CV Upload */}
              <div>
                <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                  <Upload className="w-5 h-5 text-neon-cyan" />
                  CV/Resume
                </h4>
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
                    className={`flex items-center justify-center gap-4 w-full px-6 py-10 border-2 border-dashed rounded-2xl cursor-pointer transition-all duration-300 backdrop-blur-sm ${formErrors.cv
                        ? 'border-red-500 bg-red-500/10'
                        : 'border-white/30 hover:border-neon-cyan/50 hover:bg-white/10'
                      }`}
                  >
                    <Upload className="w-8 h-8 text-gray-400" />
                    <div className="text-center">
                      <div className="text-white font-semibold text-lg">
                        {cvFile ? cvFile.name : 'Upload your CV/Resume'}
                      </div>
                      <div className="text-sm text-gray-400 mt-2">
                        PDF, DOC, or DOCX (max 5MB)
                      </div>
                    </div>
                  </label>
                </div>
                {formErrors.cv && (
                  <div className="text-red-400 text-sm mt-2 flex items-center gap-1">
                    <AlertCircle className="w-4 h-4" />
                    {formErrors.cv}
                  </div>
                )}
              </div>

              {/* Cover Letter */}
              <div>
                <h4 className="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                  <FileText className="w-5 h-5 text-neon-purple" />
                  Cover Letter
                </h4>
                <textarea
                  name="cover_letter"
                  value={formData.cover_letter}
                  onChange={onInputChange}
                  rows={6}
                  className="w-full px-4 py-3 bg-white/10 border-2 border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none transition-all duration-200 backdrop-blur-sm"
                  placeholder="Tell us why you're interested in this position and what makes you a great fit..."
                />
              </div>

              {/* Submit Button */}
              <div className="flex gap-4 pt-6 border-t border-white/20">
                <button
                  type="button"
                  onClick={onClose}
                  className="flex-1 px-6 py-3 bg-white/5 border border-white/20 text-gray-300 rounded-xl hover:bg-white/10 transition-all duration-200 font-medium"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  disabled={submitting}
                  className="flex-1 px-6 py-3 bg-gradient-to-r from-neon-purple to-neon-pink hover:from-neon-purple/80 hover:to-neon-pink/80 disabled:from-gray-600 disabled:to-gray-600 disabled:cursor-not-allowed text-white rounded-xl transition-all duration-200 font-bold shadow-lg"
                >
                  {submitting ? (
                    <div className="flex items-center justify-center gap-2">
                      <Loader className="w-5 h-5 animate-spin" />
                      Submitting...
                    </div>
                  ) : (
                    <div className="flex items-center justify-center gap-2">
                      <User className="w-5 h-5" />
                      Submit Application
                    </div>
                  )}
                </button>
              </div>
            </form>
          </div>
        </div>
      </motion.div>
    </div>
  )
}

export default JobDetailPage