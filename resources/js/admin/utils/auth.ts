export interface AdminUser {
  id: number
  name: string
  username: string
  email: string
  role: 'owner' | 'admin'
  status: 'pending' | 'approved' | 'denied'
  profile_image_path?: string
  profile_image_url?: string
  avatarDataUrl?: string | null
}

export interface AuthData {
  user: AdminUser
  token: string
  expires_at: string
}

const USER_STORAGE_KEY = 'adminUser'
const TOKEN_STORAGE_KEY = 'adminToken'
const TOKEN_EXPIRES_KEY = 'adminTokenExpires'

// User management
export function setCurrentUser(user: AdminUser): void {
  try {
    localStorage.setItem(USER_STORAGE_KEY, JSON.stringify(user))
  } catch (error) {
    console.error('Failed to save user data:', error)
  }
}

export function getCurrentUser(): AdminUser | null {
  try {
    const raw = localStorage.getItem(USER_STORAGE_KEY)
    if (!raw) return null
    return JSON.parse(raw) as AdminUser
  } catch (error) {
    console.error('Failed to get user data:', error)
    return null
  }
}

export function clearCurrentUser(): void {
  try {
    localStorage.removeItem(USER_STORAGE_KEY)
  } catch (error) {
    console.error('Failed to clear user data:', error)
  }
}

// Token management
export function setAuthToken(token: string, expiresAt: string): void {
  try {
    localStorage.setItem(TOKEN_STORAGE_KEY, token)
    localStorage.setItem(TOKEN_EXPIRES_KEY, expiresAt)
  } catch (error) {
    console.error('Failed to save auth token:', error)
  }
}

export function getAuthToken(): string | null {
  try {
    const token = localStorage.getItem(TOKEN_STORAGE_KEY)
    const expiresAt = localStorage.getItem(TOKEN_EXPIRES_KEY)

    if (!token || !expiresAt) return null

    // Check if token is expired
    if (new Date(expiresAt) <= new Date()) {
      clearAuthData()
      return null
    }

    return token
  } catch (error) {
    console.error('Failed to get auth token:', error)
    return null
  }
}

export function clearAuthToken(): void {
  try {
    localStorage.removeItem(TOKEN_STORAGE_KEY)
    localStorage.removeItem(TOKEN_EXPIRES_KEY)
  } catch (error) {
    console.error('Failed to clear auth token:', error)
  }
}

// Combined auth data management
export function setAuthData(authData: AuthData): void {
  setCurrentUser(authData.user)
  // For session-based auth, we don't need to store tokens
  // The session cookie handles authentication
}

export function clearAuthData(): void {
  clearCurrentUser()
  clearAuthToken()
}

export function isAuthenticated(): boolean {
  // For session-based auth, we only need to check if user exists in localStorage
  return getCurrentUser() !== null
}

export function isOwner(): boolean {
  const user = getCurrentUser()
  return user?.role === 'owner'
}

export function isAdmin(): boolean {
  const user = getCurrentUser()
  return user?.role === 'admin' || user?.role === 'owner'
}

export function isApproved(): boolean {
  const user = getCurrentUser()
  return user?.status === 'approved'
}

// API helper to add auth headers (for session-based auth, we rely on cookies)
export function getAuthHeaders(): Record<string, string> {
  return {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-Requested-With': 'XMLHttpRequest', // Important for Laravel to recognize AJAX requests
  }
}

// Utility function to get CSRF token
function getCSRFToken(): string | null {
  const metaTag = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
  return metaTag ? metaTag.content : null
}

// Logout function
export async function logout(): Promise<void> {
  try {
    const csrfToken = getCSRFToken()
    if (!csrfToken) {
      throw new Error('CSRF token not found')
    }

    await fetch('/api/auth/logout', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken
      },
      credentials: 'include',
    })
  } catch (error) {
    console.error('Logout API call failed:', error)
  }

  clearAuthData()
}