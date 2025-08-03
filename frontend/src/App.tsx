import React, { useState, useEffect } from 'react'
import { Routes, Route } from 'react-router-dom'
import { AnimatePresence } from 'framer-motion'
import HomePage from '@pages/HomePage'
import AdminPage from '@pages/AdminPage'
import LoadingScreen from '@components/LoadingScreen'
import CustomCursor from '@components/CustomCursor'
import { motion } from 'framer-motion'

function App() {
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    // Simulate loading time
    const timer = setTimeout(() => {
      setLoading(false)
    }, 3000)

    return () => clearTimeout(timer)
  }, [])

  return (
    <div className="App custom-cursor min-h-screen bg-egyshyr-black text-egyshyr-white overflow-x-hidden">
      <CustomCursor />
      
      <AnimatePresence mode="wait">
        {loading ? (
          <LoadingScreen key="loading" />
        ) : (
          <motion.div
            key="app"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 0.5 }}
          >
            <Routes>
              <Route path="/" element={<HomePage />} />
              <Route path="/admin" element={<AdminPage />} />
            </Routes>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  )
}

export default App