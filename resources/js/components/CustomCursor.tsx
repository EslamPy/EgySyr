import React, { useEffect, useState } from 'react'
import { motion, useMotionValue, useSpring } from 'framer-motion'

interface CursorState {
  isVisible: boolean
  isHovering: boolean
  isClicking: boolean
  cursorType: 'default' | 'magnetic'
}

const CustomCursor: React.FC = () => {
  const [cursorState, setCursorState] = useState<CursorState>({
    isVisible: false,
    isHovering: false,
    isClicking: false,
    cursorType: 'default'
  })

  const mouseX = useMotionValue(0)
  const mouseY = useMotionValue(0)

  const springConfig = { damping: 30, stiffness: 800, mass: 0.5 }
  const cursorX = useSpring(mouseX, springConfig)
  const cursorY = useSpring(mouseY, springConfig)

  useEffect(() => {
    let isScrolling = false
    let scrollTimeout: number

    const handleScroll = () => {
      isScrolling = true
      clearTimeout(scrollTimeout)
      scrollTimeout = window.setTimeout(() => {
        isScrolling = false
      }, 150)
    }

    const handleMouseMove = (e: MouseEvent) => {
      mouseX.set(e.clientX)
      mouseY.set(e.clientY)

      // Don't change cursor type while scrolling
      if (isScrolling) return

      // Check what element we're hovering over
      const target = e.target as HTMLElement
      const isInteractive = target.closest('button, a, input, textarea, [data-cursor="magnetic"]')

      if (isInteractive) {
        setCursorState(prev => ({ ...prev, cursorType: 'magnetic', isHovering: true }))
      } else {
        // Always use default cursor when not over interactive elements
        // This prevents the "SELECT" text from appearing during scroll or over non-interactive content
        setCursorState(prev => ({ ...prev, cursorType: 'default', isHovering: false }))
      }
    }

    const handleMouseDown = () => {
      setCursorState(prev => ({ ...prev, isClicking: true }))
    }

    const handleMouseUp = () => {
      setCursorState(prev => ({ ...prev, isClicking: false }))
    }

    const handleMouseEnter = () => {
      setCursorState(prev => ({ ...prev, isVisible: true }))
    }

    const handleMouseLeave = () => {
      setCursorState(prev => ({ ...prev, isVisible: false }))
    }

    // Add event listeners
    document.addEventListener('mousemove', handleMouseMove)
    document.addEventListener('mousedown', handleMouseDown)
    document.addEventListener('mouseup', handleMouseUp)
    document.addEventListener('mouseenter', handleMouseEnter)
    document.addEventListener('mouseleave', handleMouseLeave)
    window.addEventListener('scroll', handleScroll, { passive: true })

    // Hide default cursor
    document.body.style.cursor = 'none'

    return () => {
      document.removeEventListener('mousemove', handleMouseMove)
      document.removeEventListener('mousedown', handleMouseDown)
      document.removeEventListener('mouseup', handleMouseUp)
      document.removeEventListener('mouseenter', handleMouseEnter)
      document.removeEventListener('mouseleave', handleMouseLeave)
      window.removeEventListener('scroll', handleScroll)
      clearTimeout(scrollTimeout)
      document.body.style.cursor = 'auto'
    }
  }, [mouseX, mouseY])

  const getCursorSize = () => {
    switch (cursorState.cursorType) {
      case 'magnetic':
        return cursorState.isHovering ? 60 : 40
      default:
        return 40
    }
  }

  const getCursorColor = () => {
    switch (cursorState.cursorType) {
      case 'magnetic':
        return 'bg-neon-purple/30 border-neon-purple/50'
      default:
        return 'bg-white/20 border-white/30'
    }
  }

  if (!cursorState.isVisible) return null

  return (
    <motion.div
      className="fixed top-0 left-0 pointer-events-none z-[99999] mix-blend-difference"
      style={{
        x: cursorX,
        y: cursorY,
      }}
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      exit={{ opacity: 0 }}
    >
      <motion.div
        className={`rounded-full backdrop-blur-sm border-2 ${getCursorColor()}`}
        animate={{
          width: getCursorSize(),
          height: getCursorSize(),
          scale: cursorState.isClicking ? 0.8 : 1,
        }}
        transition={{ type: 'spring', stiffness: 500, damping: 28 }}
        style={{
          transform: 'translate(-50%, -50%)',
        }}
      >
        {/* Inner dot */}
        <motion.div
          className="absolute top-1/2 left-1/2 w-2 h-2 bg-white rounded-full"
          style={{
            transform: 'translate(-50%, -50%)',
          }}
          animate={{
            scale: cursorState.isHovering ? 0 : 1,
          }}
          transition={{ type: 'spring', stiffness: 500, damping: 28 }}
        />

        {/* Hover effect rings */}
        {cursorState.isHovering && (
          <>
            <motion.div
              className="absolute top-1/2 left-1/2 border border-neon-purple/50 rounded-full"
              style={{
                transform: 'translate(-50%, -50%)',
              }}
              animate={{
                width: [0, getCursorSize() + 20],
                height: [0, getCursorSize() + 20],
                opacity: [1, 0],
              }}
              transition={{
                duration: 1,
                repeat: Infinity,
                ease: 'easeOut',
              }}
            />
            <motion.div
              className="absolute top-1/2 left-1/2 border border-neon-cyan/30 rounded-full"
              style={{
                transform: 'translate(-50%, -50%)',
              }}
              animate={{
                width: [0, getCursorSize() + 40],
                height: [0, getCursorSize() + 40],
                opacity: [1, 0],
              }}
              transition={{
                duration: 1.5,
                repeat: Infinity,
                ease: 'easeOut',
                delay: 0.2,
              }}
            />
          </>
        )}
      </motion.div>


    </motion.div>
  )
}

export default CustomCursor