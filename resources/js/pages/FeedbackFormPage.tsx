import React, { useState } from 'react'
import { useRoute, useLocation } from 'wouter'
import PageTransition from '../components/PageTransition'
import { isValidInvite, submitFeedback } from '../utils/feedback'
import { Stars } from '../components/Stars'

const StarInput: React.FC<{ value: number; onChange: (v: number) => void }> = ({ value, onChange }) => {
  return (
    <div className="flex items-center gap-1">
      {[1,2,3,4,5].map(v => (
        <button key={v} type="button" onClick={() => onChange(v)} className={`p-1 ${v <= value ? 'text-yellow-400' : 'text-gray-500'}`}>★</button>
      ))}
    </div>
  )
}

const FeedbackFormPage: React.FC = () => {
  const [, params] = useRoute('/feedback/:token')
  const [_, navigate] = useLocation()
  const token = params?.token || ''
  const valid = isValidInvite(token)

  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [company, setCompany] = useState('')
  const [rating, setRating] = useState(5)
  const [comment, setComment] = useState('')
  const [errors, setErrors] = useState<{ name?: string; comment?: string }>({})

  if (!valid) {
    return (
      <PageTransition>
        <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
          <div className="text-center">
            <div className="text-2xl font-semibold mb-2">Invalid or expired link</div>
            <div className="text-gray-400">Please contact the team for a new feedback link.</div>
          </div>
        </div>
      </PageTransition>
    )
  }

  const submit = (e: React.FormEvent) => {
    e.preventDefault()
    const next: typeof errors = {}
    if (!name) next.name = 'Name is required'
    if (!comment) next.comment = 'Please leave your feedback'
    setErrors(next)
    if (Object.keys(next).length) return
    submitFeedback({ token, name, email, company, rating, comment })
    navigate('/thank-you')
  }

  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white py-16">
        <div className="max-w-xl mx-auto px-6">
          <h1 className="text-3xl font-bold mb-6">Share Your Feedback</h1>
          <p className="text-gray-400 mb-6">We value your thoughts. This feedback will be reviewed before being published.</p>

          <form onSubmit={submit} className="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <div>
              <label className="block text-sm text-gray-300 mb-2">Name</label>
              <input className={`w-full px-4 py-3 rounded-xl bg-black/30 border ${errors.name ? 'border-red-500/60' : 'border-white/10'}`} value={name} onChange={e => setName(e.target.value)} />
              {errors.name && <p className="text-sm text-red-400 mt-1">{errors.name}</p>}
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Email (optional)</label>
              <input type="email" className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={email} onChange={e => setEmail(e.target.value)} />
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Company (optional)</label>
              <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={company} onChange={e => setCompany(e.target.value)} />
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Rating</label>
              <StarInput value={rating} onChange={setRating} />
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Feedback</label>
              <textarea className={`w-full px-4 py-3 rounded-xl bg-black/30 border ${errors.comment ? 'border-red-500/60' : 'border-white/10'} min-h-32`} value={comment} onChange={e => setComment(e.target.value)} />
              {errors.comment && <p className="text-sm text-red-400 mt-1">{errors.comment}</p>}
            </div>
            <button className="px-6 py-3 rounded-xl bg-neon-gradient text-white font-semibold" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </PageTransition>
  )
}

export default FeedbackFormPage 