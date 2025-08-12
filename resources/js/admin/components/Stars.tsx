import React from 'react'
import { Star } from 'lucide-react'

interface StarsProps {
  value: number // 0..5
  size?: number
}

export const Stars: React.FC<StarsProps> = ({ value, size = 16 }) => {
  const full = Math.round(value)
  return (
    <div className="flex items-center gap-0.5">
      {Array.from({ length: 5 }).map((_, i) => (
        <Star
          key={i}
          className="" 
          style={{ width: size, height: size }}
          color={i < full ? '#FBBF24' : '#4B5563'}
          fill={i < full ? '#FBBF24' : 'transparent'}
        />
      ))}
    </div>
  )
} 