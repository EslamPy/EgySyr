import React from 'react'
import { motion } from 'framer-motion'

interface PageTransitionProps {
  children: React.ReactNode
}

const PageTransition: React.FC<PageTransitionProps> = ({ children }) => {
  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      animate={{ opacity: 1, y: 0 }}
      exit={{ opacity: 0, y: -20 }}
      transition={{
        duration: 0.6,
        ease: [0.22, 1, 0.36, 1]
      }}
      className="min-h-screen"
    >
      {/* Page transition overlay */}
      <motion.div
        className="fixed inset-0 z-50 bg-jet-black pointer-events-none"
        initial={{ scaleY: 1 }}
        animate={{ scaleY: 0 }}
        exit={{ scaleY: 1 }}
        transition={{
          duration: 0.8,
          ease: [0.22, 1, 0.36, 1]
        }}
        style={{ transformOrigin: 'top' }}
      />
      
      {/* Animated bars for cinematic effect */}
      {Array.from({ length: 5 }).map((_, i) => (
        <motion.div
          key={i}
          className="fixed top-0 bg-neon-gradient pointer-events-none z-40"
          style={{
            left: `${i * 20}%`,
            width: '20%',
            height: '100vh',
          }}
          initial={{ y: '-100%' }}
          animate={{ y: '-100%' }}
          exit={{ y: 0 }}
          transition={{
            duration: 0.6,
            delay: i * 0.1,
            ease: [0.22, 1, 0.36, 1]
          }}
        />
      ))}
      
      {children}
    </motion.div>
  )
}

export default PageTransition
