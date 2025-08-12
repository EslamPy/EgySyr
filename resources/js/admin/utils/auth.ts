export type AdminUser = {
  email: string
  avatarDataUrl?: string
}

const STORAGE_KEY = 'adminUser'

export function setCurrentUser(user: AdminUser): void {
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(user))
  } catch {}
}

export function getCurrentUser(): AdminUser | null {
  try {
    const raw = localStorage.getItem(STORAGE_KEY)
    if (!raw) return null
    return JSON.parse(raw) as AdminUser
  } catch {
    return null
  }
}

export function clearCurrentUser(): void {
  try {
    localStorage.removeItem(STORAGE_KEY)
  } catch {}
} 