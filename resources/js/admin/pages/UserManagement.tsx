import React, { useState, useEffect } from 'react'
import { AdminLayout } from '../components/AdminLayout'
import {
  Search, UserCheck, UserX, Trash2, Eye, Settings,
  Shield, User, Mail, Calendar, Crown, RefreshCw,
  CheckCircle, XCircle, Clock, AlertTriangle, X
} from 'lucide-react'
import toast from 'react-hot-toast'

// Utility function to get CSRF token
const getCSRFToken = (): string | null => {
  const metaTag = document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement
  return metaTag ? metaTag.content : null
}

interface User {
  id: number
  name: string
  email: string
  role: 'owner' | 'admin'
  status: 'pending' | 'approved' | 'denied'
  profile_image_path?: string
  denial_reason?: string
  created_at: string
  permissions?: UserPermission[]
}

interface UserPermission {
  id: number
  permission: string
  can_view: boolean
  can_create: boolean
  can_edit: boolean
  can_delete: boolean
}

interface PaginatedResponse {
  data: User[]
  current_page: number
  last_page: number
  per_page: number
  total: number
}

const AVAILABLE_PERMISSIONS = {
  dashboard: 'Dashboard',
  users: 'User Management',
  jobs: 'Job Management',
  feedback: 'Feedback Management',
  messages: 'Contact Messages',
  site_visits: 'Site Analytics',
}

const UserManagement: React.FC = () => {
  const [users, setUsers] = useState<User[]>([])
  const [pagination, setPagination] = useState<Omit<PaginatedResponse, 'data'> | null>(null)
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')
  const [statusFilter, setStatusFilter] = useState<'all' | 'pending' | 'approved' | 'denied'>('all')
  const [selectedUser, setSelectedUser] = useState<User | null>(null)
  const [showPermissionsModal, setShowPermissionsModal] = useState(false)
  const [currentPage, setCurrentPage] = useState(1)

  const fetchUsers = async (page = 1) => {
    try {
      setLoading(true)
      const params = new URLSearchParams()
      params.append('page', page.toString())
      if (searchTerm) params.append('search', searchTerm)
      if (statusFilter !== 'all') params.append('status', statusFilter)

      const response = await fetch(`/api/admin/users?${params}`, { credentials: 'include', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      if (!response.ok) throw new Error('Failed to fetch users')

      const data: PaginatedResponse = await response.json()
      setUsers(data.data)
      setPagination({
        current_page: data.current_page,
        last_page: data.last_page,
        per_page: data.per_page,
        total: data.total,
      })
    } catch (error) {
      toast.error('Failed to load users')
    } finally {
      setLoading(false)
    }
  }

  useEffect(() => {
    fetchUsers(currentPage)
  }, [currentPage, searchTerm, statusFilter])

  const approveUser = async (id: number) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/users/${id}/approve`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
      })

      if (!response.ok) throw new Error('Failed to approve user')

      toast.success('User approved successfully!')
      fetchUsers(currentPage)
    } catch (error) {
      toast.error('Failed to approve user')
    }
  }

  const denyUser = async (id: number, reason: string) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/users/${id}/deny`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
        body: JSON.stringify({ denial_reason: reason }),
      })

      if (!response.ok) throw new Error('Failed to deny user')

      toast.success('User denied successfully!')
      fetchUsers(currentPage)
    } catch (error) {
      toast.error('Failed to deny user')
    }
  }

  const deleteUser = async (id: number) => {
    if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) return

    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/users/${id}`, {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
      })

      if (!response.ok) throw new Error('Failed to delete user')

      toast.success('User deleted successfully!')
      fetchUsers(currentPage)
    } catch (error) {
      toast.error('Failed to delete user')
    }
  }

  const updatePermissions = async (userId: number, permissions: Record<string, any>) => {
    try {
      const csrfToken = getCSRFToken()
      if (!csrfToken) {
        throw new Error('CSRF token not found')
      }

      const response = await fetch(`/api/admin/users/${userId}/permissions`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
        body: JSON.stringify({ permissions }),
      })

      if (!response.ok) throw new Error('Failed to update permissions')

      toast.success('Permissions updated successfully!')
      fetchUsers(currentPage)
      setShowPermissionsModal(false)
    } catch (error) {
      toast.error('Failed to update permissions')
    }
  }

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'approved': return 'bg-green-500/20 text-green-400'
      case 'pending': return 'bg-yellow-500/20 text-yellow-400'
      case 'denied': return 'bg-red-500/20 text-red-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  const getStatusIcon = (status: string) => {
    switch (status) {
      case 'approved': return <CheckCircle className="w-4 h-4" />
      case 'pending': return <Clock className="w-4 h-4" />
      case 'denied': return <XCircle className="w-4 h-4" />
      default: return <AlertTriangle className="w-4 h-4" />
    }
  }

  return (
    <AdminLayout>
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold">User Management</h1>
            <p className="text-gray-400 mt-1">
              {pagination ? `${pagination.total} total users` : 'Loading...'}
            </p>
          </div>
          <button
            onClick={() => fetchUsers(currentPage)}
            className="p-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white transition-colors"
          >
            <RefreshCw className={`w-4 h-4 ${loading ? 'animate-spin' : ''}`} />
          </button>
        </div>

        {/* Filters and Search */}
        <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div className="flex items-center gap-2">
            {(['all', 'pending', 'approved', 'denied'] as const).map((status) => (
              <button
                key={status}
                onClick={() => {
                  setStatusFilter(status)
                  setCurrentPage(1)
                }}
                className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
                  statusFilter === status
                    ? 'bg-neon-purple text-white'
                    : 'bg-white/5 text-gray-400 hover:text-white hover:bg-white/10'
                }`}
              >
                {status.charAt(0).toUpperCase() + status.slice(1)}
              </button>
            ))}
          </div>

          <div className="relative">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
            <input
              type="text"
              placeholder="Search users..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple"
            />
          </div>
        </div>

        {/* Users List */}
        <div className="bg-white/5 border border-white/10 rounded-xl overflow-hidden">
          {loading ? (
            <div className="p-8 text-center">
              <RefreshCw className="w-8 h-8 animate-spin mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">Loading users...</p>
            </div>
          ) : users.length === 0 ? (
            <div className="p-8 text-center">
              <User className="w-12 h-12 mx-auto text-gray-400 mb-4" />
              <p className="text-gray-400">
                {searchTerm ? 'No users found matching your search' : 'No users yet'}
              </p>
            </div>
          ) : (
            <div className="divide-y divide-white/10">
              {users.map((user) => (
                <div key={user.id} className="p-6 hover:bg-white/5 transition-colors">
                  <div className="flex items-start justify-between gap-4">
                    <div className="flex items-start gap-4">
                      {/* Profile Image */}
                      <div className="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center overflow-hidden">
                        {user.profile_image_path ? (
                          <img 
                            src={`/storage/${user.profile_image_path}`} 
                            alt={user.name}
                            className="w-full h-full object-cover"
                          />
                        ) : (
                          <User className="w-6 h-6 text-gray-400" />
                        )}
                      </div>

                      <div className="flex-1 min-w-0">
                        <div className="flex items-center gap-3 mb-2">
                          <h3 className="font-semibold text-white">{user.name}</h3>
                          {user.role === 'owner' && (
                            <Crown className="w-4 h-4 text-yellow-400" />
                          )}
                          <span className={`inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(user.status)}`}>
                            {getStatusIcon(user.status)}
                            {user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                          </span>
                        </div>

                        <div className="flex items-center gap-4 text-sm text-gray-400 mb-2">
                          <div className="flex items-center gap-1">
                            <Mail className="w-4 h-4" />
                            <span>{user.email}</span>
                          </div>
                          <div className="flex items-center gap-1">
                            <Shield className="w-4 h-4" />
                            <span>{user.role.charAt(0).toUpperCase() + user.role.slice(1)}</span>
                          </div>
                          <div className="flex items-center gap-1">
                            <Calendar className="w-4 h-4" />
                            <span>{new Date(user.created_at).toLocaleDateString()}</span>
                          </div>
                        </div>

                        {user.denial_reason && (
                          <div className="bg-red-500/10 border border-red-500/20 rounded-lg p-3 mt-2">
                            <p className="text-red-400 text-sm">
                              <strong>Denial Reason:</strong> {user.denial_reason}
                            </p>
                          </div>
                        )}
                      </div>
                    </div>

                    <div className="flex items-center gap-2">
                      {user.status === 'pending' && (
                        <>
                          <button
                            onClick={() => approveUser(user.id)}
                            className="p-2 text-green-400 hover:text-green-300 transition-colors"
                            title="Approve user"
                          >
                            <UserCheck className="w-4 h-4" />
                          </button>
                          <button
                            onClick={() => {
                              const reason = prompt('Enter denial reason:')
                              if (reason) denyUser(user.id, reason)
                            }}
                            className="p-2 text-red-400 hover:text-red-300 transition-colors"
                            title="Deny user"
                          >
                            <UserX className="w-4 h-4" />
                          </button>
                        </>
                      )}

                      {user.status === 'approved' && user.role !== 'owner' && (
                        <button
                          onClick={() => {
                            setSelectedUser(user)
                            setShowPermissionsModal(true)
                          }}
                          className="p-2 text-blue-400 hover:text-blue-300 transition-colors"
                          title="Manage permissions"
                        >
                          <Settings className="w-4 h-4" />
                        </button>
                      )}

                      <button
                        onClick={() => setSelectedUser(user)}
                        className="p-2 text-gray-400 hover:text-white transition-colors"
                        title="View details"
                      >
                        <Eye className="w-4 h-4" />
                      </button>

                      {user.role !== 'owner' && (
                        <button
                          onClick={() => deleteUser(user.id)}
                          className="p-2 text-red-400 hover:text-red-300 transition-colors"
                          title="Delete user"
                        >
                          <Trash2 className="w-4 h-4" />
                        </button>
                      )}
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>

        {/* Pagination */}
        {pagination && pagination.last_page > 1 && (
          <div className="flex items-center justify-between">
            <p className="text-sm text-gray-400">
              Showing {((pagination.current_page - 1) * pagination.per_page) + 1} to{' '}
              {Math.min(pagination.current_page * pagination.per_page, pagination.total)} of{' '}
              {pagination.total} users
            </p>
            
            <div className="flex items-center gap-2">
              <button
                onClick={() => setCurrentPage(pagination.current_page - 1)}
                disabled={pagination.current_page === 1}
                className="px-3 py-1 bg-white/5 border border-white/10 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                Previous
              </button>
              
              {Array.from({ length: Math.min(5, pagination.last_page) }, (_, i) => {
                const page = i + Math.max(1, pagination.current_page - 2)
                if (page > pagination.last_page) return null
                
                return (
                  <button
                    key={page}
                    onClick={() => setCurrentPage(page)}
                    className={`px-3 py-1 rounded text-sm transition-colors ${
                      page === pagination.current_page
                        ? 'bg-neon-purple text-white'
                        : 'bg-white/5 border border-white/10 hover:bg-white/10'
                    }`}
                  >
                    {page}
                  </button>
                )
              })}
              
              <button
                onClick={() => setCurrentPage(pagination.current_page + 1)}
                disabled={pagination.current_page === pagination.last_page}
                className="px-3 py-1 bg-white/5 border border-white/10 rounded text-sm disabled:opacity-50 disabled:cursor-not-allowed hover:bg-white/10 transition-colors"
              >
                Next
              </button>
            </div>
          </div>
        )}
      </div>

      {/* User Details Modal */}
      {selectedUser && !showPermissionsModal && (
        <UserDetailsModal
          user={selectedUser}
          onClose={() => setSelectedUser(null)}
          onApprove={() => {
            approveUser(selectedUser.id)
            setSelectedUser(null)
          }}
          onDeny={(reason) => {
            denyUser(selectedUser.id, reason)
            setSelectedUser(null)
          }}
          onDelete={() => {
            deleteUser(selectedUser.id)
            setSelectedUser(null)
          }}
        />
      )}

      {/* Permissions Modal */}
      {showPermissionsModal && selectedUser && (
        <PermissionsModal
          user={selectedUser}
          onClose={() => {
            setShowPermissionsModal(false)
            setSelectedUser(null)
          }}
          onSave={(permissions) => {
            updatePermissions(selectedUser.id, permissions)
          }}
        />
      )}
    </AdminLayout>
  )
}

// User Details Modal Component
const UserDetailsModal: React.FC<{
  user: User
  onClose: () => void
  onApprove: () => void
  onDeny: (reason: string) => void
  onDelete: () => void
}> = ({ user, onClose, onApprove, onDeny, onDelete }) => {
  const [denyReason, setDenyReason] = useState('')
  const [showDenyForm, setShowDenyForm] = useState(false)

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'approved': return 'bg-green-500/20 text-green-400'
      case 'pending': return 'bg-yellow-500/20 text-yellow-400'
      case 'denied': return 'bg-red-500/20 text-red-400'
      default: return 'bg-gray-500/20 text-gray-400'
    }
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">User Details</h3>
          <button
            onClick={onClose}
            className="p-1 text-gray-400 hover:text-white transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          {/* Profile Section */}
          <div className="flex items-center gap-4">
            <div className="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center overflow-hidden">
              {user.profile_image_path ? (
                <img
                  src={`/storage/${user.profile_image_path}`}
                  alt={user.name}
                  className="w-full h-full object-cover"
                />
              ) : (
                <User className="w-8 h-8 text-gray-400" />
              )}
            </div>
            <div>
              <div className="flex items-center gap-3 mb-1">
                <h2 className="text-xl font-bold text-white">{user.name}</h2>
                {user.role === 'owner' && (
                  <Crown className="w-5 h-5 text-yellow-400" />
                )}
              </div>
              <p className="text-gray-400">{user.email}</p>
            </div>
          </div>

          {/* User Info */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Role</label>
              <p className="text-white capitalize">{user.role}</p>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Status</label>
              <span className={`inline-block px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(user.status)}`}>
                {user.status.charAt(0).toUpperCase() + user.status.slice(1)}
              </span>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-1">Joined</label>
              <p className="text-white">{new Date(user.created_at).toLocaleString()}</p>
            </div>
          </div>

          {/* Denial Reason */}
          {user.denial_reason && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Denial Reason</label>
              <div className="bg-red-500/10 border border-red-500/20 rounded-lg p-4">
                <p className="text-red-400">{user.denial_reason}</p>
              </div>
            </div>
          )}

          {/* Permissions Summary */}
          {user.permissions && user.permissions.length > 0 && (
            <div>
              <label className="block text-sm font-medium text-gray-400 mb-2">Permissions</label>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
                {user.permissions.map((perm) => (
                  <div key={perm.id} className="bg-white/5 border border-white/10 rounded-lg p-3">
                    <div className="font-medium text-white mb-1">
                      {AVAILABLE_PERMISSIONS[perm.permission as keyof typeof AVAILABLE_PERMISSIONS] || perm.permission}
                    </div>
                    <div className="text-xs text-gray-400 space-x-2">
                      {perm.can_view && <span className="text-green-400">View</span>}
                      {perm.can_create && <span className="text-blue-400">Create</span>}
                      {perm.can_edit && <span className="text-yellow-400">Edit</span>}
                      {perm.can_delete && <span className="text-red-400">Delete</span>}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {/* Actions */}
          {user.role !== 'owner' && (
            <div className="flex gap-3 pt-4 border-t border-white/10">
              {user.status === 'pending' && (
                <>
                  {!showDenyForm ? (
                    <>
                      <button
                        onClick={onApprove}
                        className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                      >
                        <UserCheck className="w-4 h-4" />
                        Approve User
                      </button>
                      <button
                        onClick={() => setShowDenyForm(true)}
                        className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                      >
                        <UserX className="w-4 h-4" />
                        Deny User
                      </button>
                    </>
                  ) : (
                    <div className="w-full space-y-3">
                      <textarea
                        placeholder="Enter reason for denial..."
                        value={denyReason}
                        onChange={(e) => setDenyReason(e.target.value)}
                        className="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple resize-none"
                        rows={3}
                      />
                      <div className="flex gap-2">
                        <button
                          onClick={() => setShowDenyForm(false)}
                          className="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
                        >
                          Cancel
                        </button>
                        <button
                          onClick={() => onDeny(denyReason)}
                          disabled={!denyReason.trim()}
                          className="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                          Confirm Denial
                        </button>
                      </div>
                    </div>
                  )}
                </>
              )}

              {user.status !== 'pending' && (
                <button
                  onClick={onDelete}
                  className="flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                >
                  <Trash2 className="w-4 h-4" />
                  Delete User
                </button>
              )}
            </div>
          )}
        </div>
      </div>
    </div>
  )
}

// Permissions Modal Component
const PermissionsModal: React.FC<{
  user: User
  onClose: () => void
  onSave: (permissions: Record<string, any>) => void
}> = ({ user, onClose, onSave }) => {
  const [permissions, setPermissions] = useState<Record<string, any>>(() => {
    const initial: Record<string, any> = {}
    Object.keys(AVAILABLE_PERMISSIONS).forEach(permission => {
      const userPerm = user.permissions?.find(p => p.permission === permission)
      initial[permission] = {
        can_view: userPerm?.can_view || false,
        can_create: userPerm?.can_create || false,
        can_edit: userPerm?.can_edit || false,
        can_delete: userPerm?.can_delete || false,
      }
    })
    return initial
  })

  const handlePermissionChange = (permission: string, action: string, value: boolean) => {
    setPermissions(prev => ({
      ...prev,
      [permission]: {
        ...prev[permission],
        [action]: value
      }
    }))
  }

  const handleSave = () => {
    onSave(permissions)
  }

  return (
    <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
      <div className="bg-deep-charcoal border border-white/10 rounded-xl p-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-xl font-semibold">Manage Permissions - {user.name}</h3>
          <button
            onClick={onClose}
            className="p-1 text-gray-400 hover:text-white transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        <div className="space-y-6">
          <p className="text-gray-400">
            Configure what this user can access and do in the admin panel.
          </p>

          <div className="space-y-4">
            {Object.entries(AVAILABLE_PERMISSIONS).map(([permission, label]) => (
              <div key={permission} className="bg-white/5 border border-white/10 rounded-lg p-4">
                <h4 className="font-medium text-white mb-3">{label}</h4>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                  {['can_view', 'can_create', 'can_edit', 'can_delete'].map((action) => (
                    <label key={action} className="flex items-center gap-2 cursor-pointer">
                      <input
                        type="checkbox"
                        checked={permissions[permission]?.[action] || false}
                        onChange={(e) => handlePermissionChange(permission, action, e.target.checked)}
                        className="w-4 h-4 text-neon-purple bg-white/5 border-white/10 rounded focus:ring-neon-purple focus:ring-2"
                      />
                      <span className="text-sm text-gray-300 capitalize">
                        {action.replace('can_', '')}
                      </span>
                    </label>
                  ))}
                </div>
              </div>
            ))}
          </div>

          <div className="flex gap-3 pt-4 border-t border-white/10">
            <button
              onClick={onClose}
              className="flex-1 px-4 py-2 bg-white/5 border border-white/10 text-gray-300 rounded-lg hover:bg-white/10 transition-colors"
            >
              Cancel
            </button>
            <button
              onClick={handleSave}
              className="flex-1 px-4 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
            >
              Save Permissions
            </button>
          </div>
        </div>
      </div>
    </div>
  )
}

export default UserManagement
