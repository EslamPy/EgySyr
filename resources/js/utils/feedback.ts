export type FeedbackInvite = {
  id: string
  token: string
  createdAt: string
  createdBy?: string
}

export type FeedbackItem = {
  id: string
  token?: string
  name: string
  email?: string
  company?: string
  rating: number
  comment: string
  createdAt: string
  status: 'pending' | 'approved' | 'rejected'
}

const INVITES_KEY = 'feedback.invites'
const FEEDBACK_KEY = 'feedback.items'

function read<T>(key: string, fallback: T): T {
  try {
    const raw = localStorage.getItem(key)
    if (!raw) return fallback
    return JSON.parse(raw) as T
  } catch {
    return fallback
  }
}

function write<T>(key: string, value: T) {
  try { localStorage.setItem(key, JSON.stringify(value)) } catch {}
}

export function listInvites(): FeedbackInvite[] {
  return read<FeedbackInvite[]>(INVITES_KEY, [])
}

export function createInvite(createdBy?: string): FeedbackInvite {
  const invite: FeedbackInvite = {
    id: cryptoRandomId(),
    token: cryptoRandomId(),
    createdAt: new Date().toISOString(),
    createdBy,
  }
  const current = listInvites()
  current.unshift(invite)
  write(INVITES_KEY, current)
  return invite
}

export function deleteInvite(id: string): void {
  const remaining = listInvites().filter(i => i.id !== id)
  write(INVITES_KEY, remaining)
}

export function listFeedback(): FeedbackItem[] {
  return read<FeedbackItem[]>(FEEDBACK_KEY, [])
}

export function submitFeedback(input: Omit<FeedbackItem, 'id' | 'createdAt' | 'status'>): FeedbackItem {
  const item: FeedbackItem = {
    id: cryptoRandomId(),
    createdAt: new Date().toISOString(),
    status: 'pending',
    ...input,
  }
  const current = listFeedback()
  current.unshift(item)
  write(FEEDBACK_KEY, current)
  return item
}

export function approveFeedback(id: string) {
  const items = listFeedback()
  const idx = items.findIndex(i => i.id === id)
  if (idx >= 0) {
    items[idx].status = 'approved'
    write(FEEDBACK_KEY, items)
  }
}

export function rejectFeedback(id: string) {
  const items = listFeedback()
  const idx = items.findIndex(i => i.id === id)
  if (idx >= 0) {
    items[idx].status = 'rejected'
    write(FEEDBACK_KEY, items)
  }
}

export function deleteFeedback(id: string) {
  const items = listFeedback().filter(i => i.id !== id)
  write(FEEDBACK_KEY, items)
}

export function isValidInvite(token: string): boolean {
  return listInvites().some(i => i.token === token)
}

function cryptoRandomId(): string {
  try {
    const arr = new Uint8Array(8)
    crypto.getRandomValues(arr)
    return Array.from(arr).map(b => b.toString(16).padStart(2, '0')).join('')
  } catch {
    return Math.random().toString(36).slice(2)
  }
} 