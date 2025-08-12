import React from 'react'
import { AdminSidebar } from './AdminSidebar'

interface AdminLayoutProps {
  children: React.ReactNode
}

export const AdminLayout: React.FC<AdminLayoutProps> = ({ children }) => {
  return (
    <div className="min-h-screen bg-jet-black text-white flex">
      <AdminSidebar />
      <main className="flex-1 min-w-0">
        <div className="px-6 py-6">
          {children}
        </div>
      </main>
    </div>
  )
} 