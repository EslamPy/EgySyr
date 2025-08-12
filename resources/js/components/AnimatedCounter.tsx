import React, { useEffect, useRef } from 'react'
import { motion, useInView } from 'framer-motion'
import { animationUtils } from '../utils/animations.ts'

interface AnimatedCounterProps {
  target: number
  suffix?: string
  duration?: number
  className?: string
}

const AnimatedCounter: React.FC<AnimatedCounterProps> = ({ 
  target, 
  suffix = '', 
  duration = 2,
  className = ''
}) => {
  const ref = useRef<HTMLSpanElement>(null)
  const isInView = useInView(ref, { once: true, margin: "-100px" })

  useEffect(() => {
    if (isInView && ref.current) {
      animationUtils.animateCounter(ref.current, target, duration)
    }
  }, [isInView, target, duration])

  return (
    <motion.span
      ref={ref}
      className={className}
      initial={{ opacity: 0, scale: 0.5 }}
      animate={isInView ? { opacity: 1, scale: 1 } : { opacity: 0, scale: 0.5 }}
      transition={{ duration: 0.5, ease: "backOut" }}
    >
      0{suffix}
    </motion.span>
  )
}

export default AnimatedCounter
