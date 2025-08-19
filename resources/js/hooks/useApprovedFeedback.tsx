import { useState, useEffect } from 'react'

export interface ApprovedFeedback {
  client_name: string
  company_name?: string
  feedback_text: string
  rating: number
  submitted_at: string
  avatar?: string // Optional avatar field
}

export const useApprovedFeedback = () => {
  const [feedback, setFeedback] = useState<ApprovedFeedback[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    const fetchFeedback = async () => {
      try {
        setLoading(true)
        const response = await fetch('/api/feedback-approved')
        
        if (!response.ok) {
          throw new Error('Failed to fetch feedback')
        }

        const data = await response.json()
        // Add default avatar to each feedback item
        const feedbackWithAvatars = data.map((item: any) => ({
          ...item,
          avatar: item.avatar || '/images/icon.png' // Use default icon.png if no avatar
        }))
        
        setFeedback(feedbackWithAvatars)
        setError(null)
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to fetch feedback')
        console.error('Error fetching approved feedback:', err)
      } finally {
        setLoading(false)
      }
    }

    fetchFeedback()
  }, [])

  return { feedback, loading, error }
} 