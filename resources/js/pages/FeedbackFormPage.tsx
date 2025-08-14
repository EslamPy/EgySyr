import React, { useState, useEffect } from 'react'
import { useRoute, useLocation } from 'wouter'
import PageTransition from '../components/PageTransition'
import { Stars } from '../components/Stars'
import { Star, CheckCircle, AlertCircle, Loader } from 'lucide-react'
import toast from 'react-hot-toast'

interface FeedbackData {
  token: string
  client_name: string
  client_email: string
  company_name?: string
}

const StarRating: React.FC<{ value: number; onChange: (v: number) => void }> = ({ value, onChange }) => {
  return (
    <div className="flex items-center gap-1">
      {[1, 2, 3, 4, 5].map(star => (
        <button
          key={star}
          type="button"
          onClick={() => onChange(star)}
          className={`p-1 transition-colors ${
            star <= value ? 'text-yellow-400' : 'text-gray-400 hover:text-yellow-300'
          }`}
        >
          <Star className={`w-8 h-8 ${star <= value ? 'fill-current' : ''}`} />
        </button>
      ))}
    </div>
  )
}

const FeedbackFormPage: React.FC = () => {
  const [, params] = useRoute('/feedback/:token')
  const [_, navigate] = useLocation()
  const token = params?.token || ''

  const [feedbackData, setFeedbackData] = useState<FeedbackData | null>(null)
  const [loading, setLoading] = useState(true)
  const [submitting, setSubmitting] = useState(false)
  const [submitted, setSubmitted] = useState(false)
  const [error, setError] = useState<string | null>(null)

  // Form state
  const [rating, setRating] = useState(5)
  const [feedbackText, setFeedbackText] = useState('')
  const [formErrors, setFormErrors] = useState<{ rating?: string; feedback_text?: string }>({})

  // Fetch feedback data on mount
  useEffect(() => {
    const fetchFeedbackData = async () => {
      try {
        const response = await fetch(`/api/feedback/${token}`)

        if (!response.ok) {
          if (response.status === 404) {
            setError('Invalid feedback link')
          } else if (response.status === 400) {
            setError('Feedback already submitted')
          } else {
            setError('Failed to load feedback form')
          }
          return
        }

        const data = await response.json()
        setFeedbackData(data)
      } catch (err) {
        setError('Failed to load feedback form')
      } finally {
        setLoading(false)
      }
    }

    if (token) {
      fetchFeedbackData()
    } else {
      setError('Invalid feedback link')
      setLoading(false)
    }
  }, [token])

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()

    // Validate form
    const errors: typeof formErrors = {}
    if (rating < 1 || rating > 5) errors.rating = 'Please select a rating'
    if (!feedbackText.trim()) errors.feedback_text = 'Please provide your feedback'

    setFormErrors(errors)
    if (Object.keys(errors).length > 0) return

    setSubmitting(true)

    try {
      const response = await fetch(`/api/feedback/${token}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          rating,
          feedback_text: feedbackText.trim(),
        }),
      })

      if (!response.ok) {
        const errorData = await response.json()
        throw new Error(errorData.error || 'Failed to submit feedback')
      }

      const result = await response.json()
      setSubmitted(true)
      toast.success(result.message || 'Thank you for your feedback!')
    } catch (err) {
      const errorMessage = err instanceof Error ? err.message : 'Failed to submit feedback'
      setError(errorMessage)
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
            <div className="text-xl font-semibold mb-2">Loading feedback form...</div>
          </div>
        </div>
      </PageTransition>
    )
  }

  // Error state
  if (error) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
          <div className="text-center">
            <AlertCircle className="w-16 h-16 mx-auto mb-4 text-red-400" />
            <div className="text-2xl font-semibold mb-2">Oops!</div>
            <div className="text-gray-400 mb-6">{error}</div>
            <button
              onClick={() => navigate('/')}
              className="px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Go Home
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
              Thank You!
            </div>
            <div className="text-gray-400 mb-8">
              Your feedback has been submitted successfully. We appreciate you taking the time to share your thoughts with us.
            </div>
            <button
              onClick={() => navigate('/')}
              className="px-6 py-3 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Visit Our Website
            </button>
          </div>
        </div>
      </PageTransition>
    )
  }

  // Main feedback form
  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white">
        <Stars />
        <div className="relative z-10 flex items-center justify-center min-h-screen px-4 py-12">
          <div className="w-full max-w-2xl">
            <div className="text-center mb-8">
              <div className="text-4xl font-bold mb-4 bg-neon-gradient bg-clip-text text-transparent">
                Share Your Feedback
              </div>
              <div className="text-gray-400 text-lg mb-6">
                We'd love to hear about your experience working with us
              </div>

              {/* Client Info Display */}
              <div className="bg-white/5 border border-white/10 rounded-xl p-6 mb-8">
                <div className="text-left">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                      <span className="text-gray-400">Name:</span>
                      <span className="ml-2 text-white font-medium">{feedbackData?.client_name}</span>
                    </div>
                    <div>
                      <span className="text-gray-400">Email:</span>
                      <span className="ml-2 text-white font-medium">{feedbackData?.client_email}</span>
                    </div>
                    {feedbackData?.company_name && (
                      <div className="md:col-span-2">
                        <span className="text-gray-400">Company:</span>
                        <span className="ml-2 text-white font-medium">{feedbackData.company_name}</span>
                      </div>
                    )}
                  </div>
                </div>
              </div>
            </div>

            <form onSubmit={handleSubmit} className="space-y-8">
              {/* Rating Section */}
              <div className="bg-white/5 border border-white/10 rounded-xl p-6">
                <label className="block text-lg font-semibold text-white mb-4">
                  How would you rate your overall experience? *
                </label>
                <div className="flex flex-col items-center gap-4">
                  <StarRating value={rating} onChange={setRating} />
                  <div className="text-center">
                    <div className="text-2xl font-bold text-neon-purple">{rating}/5</div>
                    <div className="text-sm text-gray-400">
                      {rating === 1 && 'Poor'}
                      {rating === 2 && 'Fair'}
                      {rating === 3 && 'Good'}
                      {rating === 4 && 'Very Good'}
                      {rating === 5 && 'Excellent'}
                    </div>
                  </div>
                </div>
                {formErrors.rating && (
                  <div className="text-red-400 text-sm mt-2">{formErrors.rating}</div>
                )}
              </div>

              {/* Feedback Text Section */}
              <div className="bg-white/5 border border-white/10 rounded-xl p-6">
                <label className="block text-lg font-semibold text-white mb-4">
                  Tell us about your experience *
                </label>
                <textarea
                  value={feedbackText}
                  onChange={(e) => setFeedbackText(e.target.value)}
                  rows={6}
                  className="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
                  placeholder="Please share your thoughts about our service, team, or any specific aspects of your experience..."
                />
                <div className="flex justify-between items-center mt-2">
                  <div className="text-sm text-gray-400">
                    {feedbackText.length}/2000 characters
                  </div>
                  {formErrors.feedback_text && (
                    <div className="text-red-400 text-sm">{formErrors.feedback_text}</div>
                  )}
                </div>
              </div>

              {/* Submit Button */}
              <div className="text-center">
                <button
                  type="submit"
                  disabled={submitting}
                  className="px-8 py-4 bg-neon-purple hover:bg-neon-purple/80 disabled:bg-gray-600 disabled:cursor-not-allowed text-white font-semibold rounded-xl transition-colors text-lg min-w-[200px]"
                >
                  {submitting ? (
                    <div className="flex items-center justify-center gap-2">
                      <Loader className="w-5 h-5 animate-spin" />
                      Submitting...
                    </div>
                  ) : (
                    'Submit Feedback'
                  )}
                </button>

                <div className="text-sm text-gray-400 mt-4">
                  Your feedback will be reviewed by our team before being published.
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </PageTransition>
  )
}

export default FeedbackFormPage 