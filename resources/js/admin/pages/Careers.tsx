import React from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { Briefcase, PlusCircle } from 'lucide-react'
import { listApplications } from '../../utils/jobs'
import { Link } from 'wouter'

const CareersPage: React.FC = () => {
  const apps = listApplications()
  return (
    <AdminLayout>
      <div className="space-y-6">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-bold">Careers Applications</h1>
          <Link href="/admin/jobs/new">
            <a className="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white/5 border border-white/10 hover:bg-white/10 text-sm">
              <PlusCircle className="w-4 h-4" /> Post Job
            </a>
          </Link>
        </div>

        <div className="divide-y divide-white/10 rounded-2xl overflow-hidden border border-white/10 bg-white/5">
          {apps.length === 0 && (
            <div className="p-6 text-gray-400">No applications yet.</div>
          )}
          {apps.map(a => (
            <div key={a.id} className="flex items-center justify-between p-4">
              <div className="flex items-center gap-3 min-w-0">
                <Briefcase className="w-4 h-4 text-neon-purple" />
                <div className="truncate">
                  <div className="font-medium truncate">{a.name} • {a.email}</div>
                  <div className="text-xs text-gray-400 truncate">{a.jobTitle}</div>
                </div>
              </div>
              <div className="text-right">
                <div className="text-xs text-gray-500">{new Date(a.createdAt).toLocaleString()}</div>
                {a.resumeDataUrl && (
                  <a href={a.resumeDataUrl} download className="text-xs text-neon-cyan hover:underline">Download CV</a>
                )}
              </div>
            </div>
          ))}
        </div>
      </div>
    </AdminLayout>
  )
}

export default CareersPage 