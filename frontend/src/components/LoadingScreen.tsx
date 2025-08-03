import React, { useEffect, useState } from 'react'
import { motion } from 'framer-motion'

const LoadingScreen: React.FC = () => {
  const [progress, setProgress] = useState(0)

  useEffect(() => {
    const timer = setInterval(() => {
      setProgress((prev) => {
        if (prev >= 100) {
          clearInterval(timer)
          return 100
        }
        return prev + 2
      })
    }, 50)

    return () => clearInterval(timer)
  }, [])

  const matrixChars = '01'
  const matrixColumns = Array.from({ length: 50 }, (_, i) => i)

  return (
    <motion.div
      className="matrix-bg"
      exit={{ opacity: 0, scale: 0.8 }}
      transition={{ duration: 0.5 }}
    >
      {/* Matrix Background */}
      <div className="absolute inset-0 overflow-hidden">
        {matrixColumns.map((col) => (
          <div
            key={col}
            className="absolute top-0 text-egyshyr-blue opacity-20 font-mono text-sm"
            style={{
              left: `${(col / 50) * 100}%`,
              animationDelay: `${Math.random() * 5}s`,
            }}
          >
            {Array.from({ length: 50 }, (_, i) => (
              <div
                key={i}
                className="animate-matrix-fall"
                style={{
                  animationDelay: `${Math.random() * 20}s`,
                  animationDuration: `${15 + Math.random() * 10}s`,
                }}
              >
                {matrixChars[Math.floor(Math.random() * matrixChars.length)]}
              </div>
            ))}
          </div>
        ))}
      </div>

      {/* Loading Content */}
      <div className="relative z-10 text-center">
        <motion.div
          initial={{ scale: 0.5, opacity: 0 }}
          animate={{ scale: 1, opacity: 1 }}
          transition={{ duration: 1, delay: 0.5 }}
          className="mb-8"
        >
          <h1 className="loading-logo glitch" data-text="EGYSYR">
            EGYSYR
          </h1>
          <motion.p
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 1.5 }}
            className="text-egyshyr-gray font-rajdhani text-xl mt-4"
          >
            We Engineer the Digital World
          </motion.p>
        </motion.div>

        {/* Progress Bar */}
        <motion.div
          initial={{ width: 0, opacity: 0 }}
          animate={{ width: '300px', opacity: 1 }}
          transition={{ delay: 2 }}
          className="mx-auto bg-egyshyr-darker-gray rounded-full h-1 overflow-hidden"
        >
          <motion.div
            className="h-full bg-gradient-to-r from-egyshyr-blue via-egyshyr-purple to-egyshyr-green"
            style={{ width: `${progress}%` }}
            transition={{ duration: 0.1 }}
          />
        </motion.div>

        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 2.2 }}
          className="text-egyshyr-gray text-sm mt-4 font-inter"
        >
          {progress}% Complete
        </motion.p>

        {/* Loading Animation */}
        <motion.div
          className="mt-8 flex justify-center space-x-2"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ delay: 1.8 }}
        >
          {[0, 1, 2].map((i) => (
            <motion.div
              key={i}
              className="w-3 h-3 bg-egyshyr-blue rounded-full"
              animate={{
                scale: [1, 1.5, 1],
                opacity: [0.5, 1, 0.5],
              }}
              transition={{
                duration: 1.5,
                repeat: Infinity,
                delay: i * 0.2,
              }}
            />
          ))}
        </motion.div>
      </div>
    </motion.div>
  )
}

export default LoadingScreen