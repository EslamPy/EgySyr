import React, { useMemo, useState } from 'react'
import { useRoute, useLocation } from 'wouter'
import { addApplication, getAllJobs, Application } from '../utils/jobs'
import { defaultJobOpenings } from './CareersPage'
import PageTransition from '../components/PageTransition'
import { ArrowLeft, UploadCloud } from 'lucide-react'

const JobDetailPage: React.FC = () => {
  const [, params] = useRoute('/careers/:slug')
  const [_, navigate] = useLocation()
  const jobs = useMemo(() => getAllJobs(defaultJobOpenings), [])
  const job = jobs.find(j => j.slug === params?.slug)

  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [cover, setCover] = useState('')
  const [resume, setResume] = useState<string | undefined>()
  const [errors, setErrors] = useState<{ name?: string; email?: string; resume?: string }>({})

  if (!job) {
    return (
      <PageTransition>
        <div className="min-h-screen flex items-center justify-center text-gray-400">Job not found</div>
      </PageTransition>
    )
  }

  const onSelectResume = (file?: File | null) => {
    if (!file) { setResume(undefined); return }
    if (!file.type.startsWith('application/') && !file.type.startsWith('image/')) {
      setErrors(e => ({ ...e, resume: 'Please choose a PDF/Doc or image file' })); return
    }
    const reader = new FileReader()
    reader.onload = () => setResume(reader.result as string)
    reader.readAsDataURL(file)
  }

  const submit = (e: React.FormEvent) => {
    e.preventDefault()
    const next: typeof errors = {}
    if (!name) next.name = 'Name is required'
    if (!email) next.email = 'Email is required'
    if (!resume) next.resume = 'Please upload your CV'
    setErrors(next)
    if (Object.keys(next).length) return

    const app: Omit<Application, 'id' | 'createdAt'> = {
      jobSlug: job.slug,
      jobTitle: job.title,
      name,
      email,
      coverLetter: cover,
      resumeDataUrl: resume,
    }
    addApplication(app)
    navigate('/admin/careers')
  }

  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white">
        <div className="max-w-5xl mx-auto px-6 py-10">
          <button onClick={() => navigate('/careers')} className="text-gray-400 hover:text-white inline-flex items-center gap-2 mb-6">
            <ArrowLeft className="w-4 h-4" /> Back to Careers
          </button>

          <div className="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8">
            <div className="flex items-start justify-between flex-wrap gap-4">
              <div>
                <h1 className="text-3xl font-bold">{job.title}</h1>
                <div className="text-sm text-gray-400 mt-1">{job.department} • {job.location} • {job.type}</div>
              </div>
              <div className="text-neon-cyan font-semibold">{job.salary}</div>
            </div>
            <p className="text-gray-300 mt-4">{job.description}</p>
            <div className="mt-4 flex flex-wrap gap-2">
              {job.skills.map(s => (
                <span key={s} className="px-3 py-1 rounded-full bg-white/5 border border-white/10 text-gray-300 text-sm">{s}</span>
              ))}
            </div>
          </div>

          <form onSubmit={submit} className="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <h2 className="text-xl font-semibold">Apply to this job</h2>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Full Name</label>
              <input className={`w-full px-4 py-3 rounded-xl bg-black/30 border ${errors.name ? 'border-red-500/60' : 'border-white/10'}`} value={name} onChange={e => setName(e.target.value)} />
              {errors.name && <p className="text-sm text-red-400 mt-1">{errors.name}</p>}
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Email</label>
              <input type="email" className={`w-full px-4 py-3 rounded-xl bg-black/30 border ${errors.email ? 'border-red-500/60' : 'border-white/10'}`} value={email} onChange={e => setEmail(e.target.value)} />
              {errors.email && <p className="text-sm text-red-400 mt-1">{errors.email}</p>}
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Cover Letter (optional)</label>
              <textarea className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10 min-h-32" value={cover} onChange={e => setCover(e.target.value)} />
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Upload CV</label>
              <label className="flex items-center gap-3 px-4 py-3 rounded-xl bg-black/30 border border-white/10 hover:border-neon-purple/40 cursor-pointer">
                <UploadCloud className="w-4 h-4 text-gray-400" />
                <span className="text-gray-400">{resume ? 'Change file' : 'Choose file (PDF, DOC, or Image)'}</span>
                <input type="file" accept=".pdf,.doc,.docx,image/*" className="hidden" onChange={(e) => onSelectResume(e.target.files?.[0])} />
              </label>
              {errors.resume && <p className="text-sm text-red-400 mt-1">{errors.resume}</p>}
            </div>
            <button className="px-6 py-3 rounded-xl bg-neon-gradient text-white font-semibold" type="submit">Submit Application</button>
          </form>
        </div>
      </div>
    </PageTransition>
  )
}

export default JobDetailPage 