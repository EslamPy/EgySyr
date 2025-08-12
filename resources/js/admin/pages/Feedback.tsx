import React, { useMemo, useState } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import { Stars } from '../components/Stars'
import { createInvite, listInvites, listFeedback, approveFeedback, rejectFeedback, deleteFeedback, deleteInvite } from '../../utils/feedback'
import { Copy, Check, Trash2, CheckCircle2, XCircle, Link2 } from 'lucide-react'

type TabKey = 'invites' | 'pending' | 'approved'

const TabButton: React.FC<{ active: boolean; onClick: () => void; children: React.ReactNode }> = ({ active, onClick, children }) => (
  <button
    onClick={onClick}
    className={`px-4 py-2 rounded-xl text-sm border transition-colors ${
      active
        ? 'bg-white/10 border-white/20 text-white'
        : 'bg-white/5 border-white/10 text-gray-300 hover:bg-white/10'
    }`}
  >
    {children}
  </button>
)

function avatarInitial(text: string): string {
  const t = text.trim()
  if (!t) return 'C'
  const parts = t.split(/\s+/)
  return (parts[0][0] + (parts[1]?.[0] ?? '')).toUpperCase()
}

const FeedbackPage: React.FC = () => {
  const [invites, setInvites] = useState(listInvites())
  const [items, setItems] = useState(listFeedback())
  const [copied, setCopied] = useState<string | null>(null)
  const [tab, setTab] = useState<TabKey>('pending')

  const baseUrl = typeof window !== 'undefined' ? window.location.origin : ''

  const onNewInvite = () => {
    const inv = createInvite('admin')
    setInvites(listInvites())
    const link = `${baseUrl}/feedback/${inv.token}`
    navigator.clipboard?.writeText(link).then(() => {
      setCopied(inv.id)
      setTimeout(() => setCopied(null), 1500)
    }).catch(() => {})
    setTab('invites')
  }

  const onApprove = (id: string) => { approveFeedback(id); setItems(listFeedback()); setTab('approved') }
  const onReject = (id: string) => { rejectFeedback(id); setItems(listFeedback()) }
  const onDelete = (id: string) => { deleteFeedback(id); setItems(listFeedback()) }

  const pending = items.filter(i => i.status === 'pending')
  const approved = items.filter(i => i.status === 'approved')

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <div className="text-sm text-gray-400">Reputation</div>
            <h1 className="text-2xl font-bold">Client Feedback</h1>
          </div>
          <button onClick={onNewInvite} className="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-white/10 text-gray-200 hover:bg-white/10">
            <Link2 className="w-4 h-4" /> Generate Invite Link
          </button>
        </div>

        {/* Tabs */}
        <div className="flex items-center gap-2">
          <TabButton active={tab === 'invites'} onClick={() => setTab('invites')}>Invites</TabButton>
          <TabButton active={tab === 'pending'} onClick={() => setTab('pending')}>Pending</TabButton>
          <TabButton active={tab === 'approved'} onClick={() => setTab('approved')}>Approved</TabButton>
        </div>

        {/* Invites */}
        {tab === 'invites' && (
          <div className="bg-white/5 border border-white/10 rounded-2xl p-5">
            <div className="text-sm text-gray-400 mb-3">Share one of these links with a client to collect feedback.</div>
            {invites.length === 0 && (
              <div className="text-gray-500 text-sm">No invites yet. Click "Generate Invite Link" to create one.</div>
            )}
            <div className="space-y-2">
              {invites.map(inv => {
                const link = `${baseUrl}/feedback/${inv.token}`
                const isCopied = copied === inv.id
                return (
                  <div key={inv.id} className="flex items-center justify-between gap-3 px-3 py-2 rounded-lg bg-black/30 border border-white/10">
                    <div className="truncate text-sm text-gray-300">{link}</div>
                    <div className="flex items-center gap-2">
                      <button
                        onClick={() => navigator.clipboard?.writeText(link).then(() => { setCopied(inv.id); setTimeout(() => setCopied(null), 1200) })}
                        className={`inline-flex items-center gap-2 text-xs ${isCopied ? 'text-neon-cyan' : 'text-gray-300 hover:text-white'}`}
                      >
                        {isCopied ? <><Check className="w-3 h-3" /> Copied</> : <><Copy className="w-3 h-3" /> Copy</>}
                      </button>
                      <button
                        onClick={() => { deleteInvite(inv.id); setInvites(listInvites()) }}
                        className="inline-flex items-center gap-2 text-xs text-red-400 hover:text-red-300"
                      >
                        <Trash2 className="w-3 h-3" /> Delete
                      </button>
                    </div>
                  </div>
                )
              })}
            </div>
          </div>
        )}

        {/* Pending */}
        {tab === 'pending' && (
          <div className="bg-white/5 border border-white/10 rounded-2xl p-5">
            <div className="text-sm text-gray-400 mb-3">Submissions awaiting review</div>
            {pending.length === 0 && <div className="text-gray-500 text-sm">No pending items.</div>}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {pending.map(f => (
                <div key={f.id} className="relative p-4 rounded-2xl border border-white/10 bg-gradient-to-br from-black/40 to-black/20">
                  <div className="flex items-start gap-3">
                    <div className="w-10 h-10 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-sm text-gray-200">
                      {avatarInitial(f.name)}
                    </div>
                    <div className="min-w-0 flex-1">
                      <div className="flex items-center justify-between gap-3">
                        <div className="truncate font-medium">{f.name}{f.company ? ` • ${f.company}` : ''}</div>
                        <Stars value={f.rating} />
                      </div>
                      <div className="text-xs text-gray-500 mt-1">{new Date(f.createdAt).toLocaleString()}</div>
                      <div className="text-sm text-gray-300 mt-3 leading-relaxed">{f.comment}</div>
                      <div className="mt-4 flex items-center gap-2">
                        <button onClick={() => onApprove(f.id)} className="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-neon-cyan/50 text-neon-cyan text-xs hover:bg-neon-cyan/10"><CheckCircle2 className="w-3 h-3" /> Approve</button>
                        <button onClick={() => onReject(f.id)} className="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-neon-pink/50 text-neon-pink text-xs hover:bg-neon-pink/10"><XCircle className="w-3 h-3" /> Reject</button>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* Approved */}
        {tab === 'approved' && (
          <div className="bg-white/5 border border-white/10 rounded-2xl p-5">
            <div className="text-sm text-gray-400 mb-3">Approved feedback</div>
            {approved.length === 0 && <div className="text-gray-500 text-sm">No approved items.</div>}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {approved.map(f => (
                <div key={f.id} className="relative p-4 rounded-2xl border border-white/10 bg-gradient-to-br from-black/40 to-black/20">
                  <div className="flex items-start gap-3">
                    <div className="w-10 h-10 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-sm text-gray-200">
                      {avatarInitial(f.name)}
                    </div>
                    <div className="min-w-0 flex-1">
                      <div className="flex items-center justify-between gap-3">
                        <div className="truncate font-medium">{f.name}{f.company ? ` • ${f.company}` : ''}</div>
                        <Stars value={f.rating} />
                      </div>
                      <div className="text-xs text-gray-500 mt-1">{new Date(f.createdAt).toLocaleDateString()}</div>
                      <div className="text-sm text-gray-300 mt-3 leading-relaxed">{f.comment}</div>
                      <div className="mt-4 flex items-center justify-end">
                        <button onClick={() => onDelete(f.id)} className="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-white/10 text-gray-300 text-xs hover:bg-white/10"><Trash2 className="w-3 h-3" /> Remove</button>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}
      </div>
    </AdminLayout>
  )
}

export default FeedbackPage 