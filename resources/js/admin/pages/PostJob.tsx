import React, { useMemo, useState } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { addJob, listAdminJobs, deleteJob, updateJob, Job } from '../../utils/jobs'
import { useLocation } from 'wouter'
import { Pencil, Trash2, Save } from 'lucide-react'

const empty = { title: '', department: '', location: 'Remote', type: 'Full-time', experience: '', salary: '', description: '', skills: '' }

const PostJobPage: React.FC = () => {
  const [form, setForm] = useState(empty)
  const [editingSlug, setEditingSlug] = useState<string | null>(null)
  const [jobs, setJobs] = useState<Job[]>(listAdminJobs())
  const [_, navigate] = useLocation()

  const submit = (e: React.FormEvent) => {
    e.preventDefault()
    if (editingSlug) {
      updateJob(editingSlug, {
        title: form.title,
        department: form.department,
        location: form.location,
        type: form.type,
        experience: form.experience,
        description: form.description,
        salary: form.salary,
        skills: form.skills.split(',').map(s => s.trim()).filter(Boolean),
      })
      setEditingSlug(null)
    } else {
      addJob({
        title: form.title,
        department: form.department,
        location: form.location,
        type: form.type,
        experience: form.experience,
        description: form.description,
        salary: form.salary,
        skills: form.skills.split(',').map(s => s.trim()).filter(Boolean),
      })
    }
    setJobs(listAdminJobs())
    setForm(empty)
  }

  const startEdit = (job: Job) => {
    setEditingSlug(job.slug)
    setForm({
      title: job.title,
      department: job.department,
      location: job.location,
      type: job.type,
      experience: job.experience,
      salary: job.salary,
      description: job.description,
      skills: job.skills.join(', '),
    })
  }

  const destroy = (slug: string) => {
    deleteJob(slug)
    setJobs(listAdminJobs())
  }

  return (
    <AdminLayout>
      <div className="space-y-8">
        <div className="max-w-3xl space-y-6">
          <h1 className="text-2xl font-bold">{editingSlug ? 'Edit Job' : 'Post a Job'}</h1>
          <form onSubmit={submit} className="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-5">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm text-gray-300 mb-2">Title</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.title} onChange={e => setForm({ ...form, title: e.target.value })} />
              </div>
              <div>
                <label className="block text-sm text-gray-300 mb-2">Department</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.department} onChange={e => setForm({ ...form, department: e.target.value })} />
              </div>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm text-gray-300 mb-2">Location</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.location} onChange={e => setForm({ ...form, location: e.target.value })} />
              </div>
              <div>
                <label className="block text-sm text-gray-300 mb-2">Type</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.type} onChange={e => setForm({ ...form, type: e.target.value })} />
              </div>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm text-gray-300 mb-2">Experience</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.experience} onChange={e => setForm({ ...form, experience: e.target.value })} />
              </div>
              <div>
                <label className="block text-sm text-gray-300 mb-2">Salary</label>
                <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.salary} onChange={e => setForm({ ...form, salary: e.target.value })} />
              </div>
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Description</label>
              <textarea className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10 min-h-32" value={form.description} onChange={e => setForm({ ...form, description: e.target.value })} />
            </div>
            <div>
              <label className="block text-sm text-gray-300 mb-2">Skills (comma separated)</label>
              <input className="w-full px-4 py-3 rounded-xl bg-black/30 border border-white/10" value={form.skills} onChange={e => setForm({ ...form, skills: e.target.value })} />
            </div>
            <button className="px-6 py-3 rounded-xl bg-neon-gradient text-white font-semibold" type="submit">{editingSlug ? <span className="inline-flex items-center gap-2"><Save className="w-4 h-4" /> Save Changes</span> : 'Post Job'}</button>
          </form>
        </div>

        {/* Admin Jobs List */}
        <div className="bg-white/5 border border-white/10 rounded-2xl p-6">
          <div className="flex items-center justify-between mb-4">
            <h2 className="text-lg font-semibold">Your Job Posts</h2>
          </div>
          {jobs.length === 0 && (
            <div className="text-gray-400 text-sm">You haven't posted any jobs yet.</div>
          )}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {jobs.map(job => (
              <div key={job.slug} className="p-4 rounded-xl bg-black/30 border border-white/10">
                <div className="flex items-start justify-between gap-3">
                  <div className="min-w-0">
                    <div className="font-medium truncate">{job.title}</div>
                    <div className="text-xs text-gray-500">{job.department} • {job.location} • {job.type}</div>
                    <div className="text-sm text-gray-300 mt-2 line-clamp-3">{job.description}</div>
                  </div>
                  <div className="flex items-center gap-2">
                    <button onClick={() => startEdit(job)} className="inline-flex items-center gap-1 px-2 py-1 rounded border border-white/10 text-gray-300 hover:bg-white/10"><Pencil className="w-3 h-3" /> Edit</button>
                    <button onClick={() => destroy(job.slug)} className="inline-flex items-center gap-1 px-2 py-1 rounded border border-white/10 text-gray-300 hover:bg-white/10"><Trash2 className="w-3 h-3" /> Delete</button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </AdminLayout>
  )
}

export default PostJobPage 