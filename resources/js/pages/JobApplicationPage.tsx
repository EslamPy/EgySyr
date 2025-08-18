import React, { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { useRoute, useLocation } from 'wouter'
import { ArrowLeft, User, Mail, Phone, FileText, Link, Github, Linkedin, Upload, CheckCircle, Loader, MapPin, Clock, DollarSign } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'
import toast from 'react-hot-toast'

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
  application_deadline: string | null
  created_at: string
  creator: {
    id: number
    name: string
  }
}

const JobApplicationPage: React.FC = () => {
  const [, params] = useRoute('/careers/:slug/apply')
  const [_, navigate] = useLocation()
  const slug = params?.slug || ''

  const [job, setJob] = useState<Job | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
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
    github_url: '',
    years_experience: '',
    additional_info: '',
  })

  const [cvFile, setCvFile] = useState<File | null>(null)
  const [formErrors, setFormErrors] = useState<Record<string, string>>({})

  // Fetch job details
  useEffect(() => {
    const fetchJob = async () => {
      try {
        const response = await fetch(`/api/jobs/${slug}`)
        if (!response.ok) {
          throw new Error('Job not found')
        }
        const jobData = await response.json()
        setJob(jobData)
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to load job')
      } finally {
        setLoading(false)
      }
    }

    if (slug) {
      fetchJob()
    }
  }, [slug])

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
      if (file.size > 5 * 1024 * 1024) { // 5MB
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
    else if (!/\S+@\S+\.\S+/.test(formData.email)) errors.email = 'Email is invalid'
    if (!formData.phone.trim()) errors.phone = 'Phone number is required'
    if (!cvFile) errors.cv = 'CV/Resume is required'

    // Validate URLs if provided
    if (formData.linkedin_url && !/^https?:\/\/.+/.test(formData.linkedin_url)) {
      errors.linkedin_url = 'Please enter a valid URL'
    }
    if (formData.portfolio_url && !/^https?:\/\/.+/.test(formData.portfolio_url)) {
      errors.portfolio_url = 'Please enter a valid URL'
    }
    if (formData.github_url && !/^https?:\/\/.+/.test(formData.github_url)) {
      errors.github_url = 'Please enter a valid URL'
    }

    setFormErrors(errors)
    return Object.keys(errors).length === 0
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    
    if (!validateForm()) {
      toast.error('Please fix the errors below')
      return
    }

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

  if (loading) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-gradient-to-br from-jet-black via-deep-charcoal to-jet-black text-white flex items-center justify-center">
          <div className="text-center">
            <Loader className="w-8 h-8 animate-spin mx-auto mb-4 text-neon-cyan" />
            <div className="text-gray-400">Loading job details...</div>
          </div>
        </div>
      </PageTransition>
    )
  }

  if (error || !job) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-gradient-to-br from-jet-black via-deep-charcoal to-jet-black text-white flex items-center justify-center">
          <div className="text-center max-w-md mx-auto px-6">
            <div className="text-red-400 text-xl font-bold mb-4">Job Not Found</div>
            <div className="text-gray-400 mb-8">{error || 'The job you are looking for does not exist or has been removed.'}</div>
            <button
              onClick={() => navigate('/careers')}
              className="px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Back to Careers
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
        <div className="min-h-screen bg-gradient-to-br from-jet-black via-deep-charcoal to-jet-black text-white flex items-center justify-center">
          <div className="text-center max-w-md mx-auto px-6">
            <CheckCircle className="w-16 h-16 mx-auto mb-6 text-green-400" />
            <div className="text-3xl font-bold mb-4 bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
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
        <div className="container mx-auto px-6 pt-32 pb-20">
          {/* Back Button */}
          <motion.button
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
            onClick={() => navigate(`/careers/${slug}`)}
            className="inline-flex items-center gap-2 text-gray-400 hover:text-neon-cyan transition-all duration-300 mb-8 group cursor-pointer"
          >
            <ArrowLeft className="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
            <span className="font-medium">Back to Job Details</span>
          </motion.button>

          <div className="max-w-4xl mx-auto">
            {/* Header */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              className="text-center mb-12"
            >
              <h1 className="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
                Apply for {job.title}
              </h1>
              <p className="text-gray-400 text-lg">
                Join our team and make an impact at EgySyr
              </p>
            </motion.div>

            {/* Job Summary Card */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.1 }}
              className="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8 backdrop-blur-sm"
            >
              <h3 className="text-xl font-bold text-white mb-4">Position Summary</h3>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="flex items-center gap-3">
                  <MapPin className="w-5 h-5 text-neon-cyan" />
                  <div>
                    <div className="text-sm text-gray-400">Location</div>
                    <div className="text-white font-medium">{job.location}</div>
                  </div>
                </div>
                <div className="flex items-center gap-3">
                  <Clock className="w-5 h-5 text-neon-purple" />
                  <div>
                    <div className="text-sm text-gray-400">Type</div>
                    <div className="text-white font-medium capitalize">{job.type.replace('-', ' ')}</div>
                  </div>
                </div>
                {(job.salary_min || job.salary_max) && (
                  <div className="flex items-center gap-3">
                    <DollarSign className="w-5 h-5 text-neon-pink" />
                    <div>
                      <div className="text-sm text-gray-400">Salary</div>
                      <div className="text-white font-medium">
                        {job.salary_min && job.salary_max 
                          ? `${job.salary_currency} ${job.salary_min.toLocaleString()} - ${job.salary_max.toLocaleString()}`
                          : job.salary_min 
                            ? `From ${job.salary_currency} ${job.salary_min.toLocaleString()}`
                            : `Up to ${job.salary_currency} ${job.salary_max?.toLocaleString()}`
                        }
                      </div>
                    </div>
                  </div>
                )}
              </div>
            </motion.div>

            {/* Application Form */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.2 }}
              className="bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm"
            >
              <h3 className="text-2xl font-bold text-white mb-6">Application Form</h3>

              <form onSubmit={handleSubmit} className="space-y-6">
                {/* Personal Information */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <User className="w-4 h-4 inline mr-2" />
                      First Name *
                    </label>
                    <input
                      type="text"
                      name="first_name"
                      value={formData.first_name}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="Enter your first name"
                    />
                    {formErrors.first_name && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.first_name}</p>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <User className="w-4 h-4 inline mr-2" />
                      Last Name *
                    </label>
                    <input
                      type="text"
                      name="last_name"
                      value={formData.last_name}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="Enter your last name"
                    />
                    {formErrors.last_name && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.last_name}</p>
                    )}
                  </div>
                </div>

                {/* Contact Information */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <Mail className="w-4 h-4 inline mr-2" />
                      Email Address *
                    </label>
                    <input
                      type="email"
                      name="email"
                      value={formData.email}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="your.email@example.com"
                    />
                    {formErrors.email && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.email}</p>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <Phone className="w-4 h-4 inline mr-2" />
                      Phone Number *
                    </label>
                    <input
                      type="tel"
                      name="phone"
                      value={formData.phone}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="+1 (555) 123-4567"
                    />
                    {formErrors.phone && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.phone}</p>
                    )}
                  </div>
                </div>

                {/* Professional Information */}
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">
                    Years of Experience
                  </label>
                  <input
                    type="number"
                    name="years_experience"
                    value={formData.years_experience}
                    onChange={handleInputChange}
                    min="0"
                    max="50"
                    className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                    placeholder="e.g., 3"
                  />
                </div>

                {/* CV Upload */}
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">
                    <Upload className="w-4 h-4 inline mr-2" />
                    CV/Resume *
                  </label>
                  <div className="relative">
                    <input
                      type="file"
                      onChange={handleFileChange}
                      accept=".pdf,.doc,.docx"
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-neon-purple file:text-white file:cursor-pointer hover:file:bg-neon-purple/80 transition-colors"
                    />
                    {cvFile && (
                      <p className="text-green-400 text-sm mt-1">✓ {cvFile.name}</p>
                    )}
                  </div>
                  {formErrors.cv && (
                    <p className="text-red-400 text-sm mt-1">{formErrors.cv}</p>
                  )}
                  <p className="text-gray-400 text-sm mt-1">
                    Accepted formats: PDF, DOC, DOCX (Max 5MB)
                  </p>
                </div>

                {/* Social Links */}
                <div className="space-y-4">
                  <h4 className="text-lg font-semibold text-white">Professional Links</h4>

                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <Linkedin className="w-4 h-4 inline mr-2" />
                      LinkedIn Profile
                    </label>
                    <input
                      type="url"
                      name="linkedin_url"
                      value={formData.linkedin_url}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="https://linkedin.com/in/yourprofile"
                    />
                    {formErrors.linkedin_url && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.linkedin_url}</p>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <Github className="w-4 h-4 inline mr-2" />
                      GitHub Profile
                    </label>
                    <input
                      type="url"
                      name="github_url"
                      value={formData.github_url}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="https://github.com/yourusername"
                    />
                    {formErrors.github_url && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.github_url}</p>
                    )}
                  </div>

                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">
                      <Link className="w-4 h-4 inline mr-2" />
                      Portfolio/Website
                    </label>
                    <input
                      type="url"
                      name="portfolio_url"
                      value={formData.portfolio_url}
                      onChange={handleInputChange}
                      className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors"
                      placeholder="https://yourportfolio.com"
                    />
                    {formErrors.portfolio_url && (
                      <p className="text-red-400 text-sm mt-1">{formErrors.portfolio_url}</p>
                    )}
                  </div>
                </div>

                {/* Cover Letter */}
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">
                    <FileText className="w-4 h-4 inline mr-2" />
                    Cover Letter
                  </label>
                  <textarea
                    name="cover_letter"
                    value={formData.cover_letter}
                    onChange={handleInputChange}
                    rows={6}
                    className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors resize-none"
                    placeholder="Tell us why you're interested in this position and what makes you a great fit..."
                  />
                  <p className="text-gray-400 text-sm mt-1">
                    Optional: Share your motivation and relevant experience
                  </p>
                </div>

                {/* Additional Information */}
                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">
                    Additional Information
                  </label>
                  <textarea
                    name="additional_info"
                    value={formData.additional_info}
                    onChange={handleInputChange}
                    rows={4}
                    className="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:border-neon-cyan focus:outline-none transition-colors resize-none"
                    placeholder="Any additional information you'd like to share..."
                  />
                </div>

                {/* Submit Button */}
                <div className="flex gap-4 pt-6 border-t border-white/20">
                  <button
                    type="button"
                    onClick={() => navigate(`/careers/${slug}`)}
                    className="flex-1 px-6 py-4 bg-white/5 border border-white/20 text-gray-300 rounded-xl hover:bg-white/10 transition-all duration-200 font-medium"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    disabled={submitting}
                    className="flex-1 px-6 py-4 bg-gradient-to-r from-neon-purple to-neon-pink hover:from-neon-purple/80 hover:to-neon-pink/80 disabled:from-gray-600 disabled:to-gray-600 disabled:cursor-not-allowed text-white rounded-xl transition-all duration-200 font-bold shadow-lg"
                  >
                    {submitting ? (
                      <div className="flex items-center justify-center gap-2">
                        <Loader className="w-5 h-5 animate-spin" />
                        Submitting Application...
                      </div>
                    ) : (
                      'Submit Application'
                    )}
                  </button>
                </div>
              </form>
            </motion.div>
          </div>
        </div>

        <Footer />
      </div>
    </PageTransition>
  )
}

export default JobApplicationPage
