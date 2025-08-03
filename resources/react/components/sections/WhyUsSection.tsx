import React, { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { 
  Users, 
  Globe, 
  Award, 
  Clock, 
  TrendingUp, 
  Shield,
  Zap,
  Target
} from 'lucide-react'
import { AnimatePresence } from 'framer-motion'

interface Stat {
  id: string
  icon: React.ElementType
  value: number
  suffix: string
  label: string
  color: string
  description: string
}

const stats: Stat[] = [
  {
    id: 'projects',
    icon: Target,
    value: 120,
    suffix: '+',
    label: 'Projects Completed',
    color: 'text-egyshyr-blue',
    description: 'Successfully delivered projects across various industries and technologies',
  },
  {
    id: 'clients',
    icon: Users,
    value: 50,
    suffix: '+',
    label: 'Happy Clients',
    color: 'text-egyshyr-purple',
    description: 'Satisfied clients who continue to trust us with their digital transformation',
  },
  {
    id: 'continents',
    icon: Globe,
    value: 4,
    suffix: '',
    label: 'Continents',
    color: 'text-egyshyr-green',
    description: 'Global reach with clients across North America, Europe, Asia, and Africa',
  },
  {
    id: 'experience',
    icon: Clock,
    value: 5,
    suffix: '+',
    label: 'Years Experience',
    color: 'text-egyshyr-blue',
    description: 'Years of expertise in cutting-edge technologies and best practices',
  },
]

interface Value {
  id: string
  icon: React.ElementType
  title: string
  description: string
  color: string
}

const values: Value[] = [
  {
    id: 'innovation',
    icon: Zap,
    title: 'Innovation First',
    description: 'We stay ahead of technology trends and implement cutting-edge solutions that give you a competitive advantage.',
    color: 'text-egyshyr-blue',
  },
  {
    id: 'quality',
    icon: Award,
    title: 'Quality Assured',
    description: 'Rigorous testing, code reviews, and best practices ensure every deliverable meets the highest standards.',
    color: 'text-egyshyr-purple',
  },
  {
    id: 'security',
    icon: Shield,
    title: 'Security Focused',
    description: 'Security is built into every layer of our solutions, protecting your data and users from day one.',
    color: 'text-egyshyr-green',
  },
  {
    id: 'growth',
    icon: TrendingUp,
    title: 'Scalable Growth',
    description: 'Our solutions are designed to grow with your business, supporting expansion and evolving requirements.',
    color: 'text-egyshyr-blue',
  },
]

const AnimatedCounter: React.FC<{ 
  targetValue: number; 
  suffix: string; 
  isInView: boolean 
}> = ({ targetValue, suffix, isInView }) => {
  const [count, setCount] = useState(0)

  useEffect(() => {
    if (!isInView) return

    const duration = 2000 // 2 seconds
    const steps = 60
    const increment = targetValue / steps
    const stepDuration = duration / steps

    let currentCount = 0
    const timer = setInterval(() => {
      currentCount += increment
      if (currentCount >= targetValue) {
        setCount(targetValue)
        clearInterval(timer)
      } else {
        setCount(Math.floor(currentCount))
      }
    }, stepDuration)

    return () => clearInterval(timer)
  }, [targetValue, isInView])

  return (
    <span className="font-orbitron font-bold">
      {count}{suffix}
    </span>
  )
}

const StatCard: React.FC<{ stat: Stat; index: number; isActive: boolean; onClick: () => void }> = ({ 
  stat, 
  index, 
  isActive, 
  onClick 
}) => {
  const { icon: Icon, value, suffix, label, color, description } = stat

  return (
    <motion.div
      className={`relative p-6 rounded-xl border-2 cursor-pointer transition-all duration-300 ${
        isActive 
          ? 'bg-egyshyr-darker-gray border-egyshyr-blue shadow-glow' 
          : 'bg-egyshyr-darker-gray/30 border-egyshyr-blue/20 hover:border-egyshyr-blue/50'
      }`}
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.6 }}
      whileHover={{ scale: 1.02 }}
      onClick={onClick}
    >
      <div className="text-center">
        <motion.div
          className={`${color} mb-4 flex justify-center`}
          animate={{ 
            scale: isActive ? 1.1 : 1,
            rotate: isActive ? 5 : 0 
          }}
          transition={{ duration: 0.3 }}
        >
          <Icon size={40} />
        </motion.div>
        
        <div className={`text-3xl md:text-4xl ${color} mb-2`}>
          <AnimatedCounter 
            targetValue={value} 
            suffix={suffix} 
            isInView={isActive} 
          />
        </div>
        
        <h3 className="text-lg font-rajdhani font-semibold text-egyshyr-white mb-2">
          {label}
        </h3>

        <AnimatePresence>
          {isActive && (
            <motion.p
              className="text-sm text-egyshyr-gray font-inter leading-relaxed"
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              transition={{ duration: 0.3 }}
            >
              {description}
            </motion.p>
          )}
        </AnimatePresence>
      </div>
    </motion.div>
  )
}

const ValueCard: React.FC<{ value: Value; index: number }> = ({ value, index }) => {
  const { icon: Icon, title, description, color } = value

  return (
    <motion.div
      className="group p-6 bg-egyshyr-darker-gray/30 backdrop-blur-sm border border-egyshyr-blue/20 rounded-xl hover:border-egyshyr-blue/50 transition-all duration-300"
      initial={{ opacity: 0, y: 30 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.6 }}
      whileHover={{ y: -5 }}
    >
      <div className="flex items-start space-x-4">
        <motion.div
          className={`${color} mt-1 group-hover:scale-110 transition-transform duration-300`}
        >
          <Icon size={32} />
        </motion.div>
        
        <div className="flex-1">
          <h3 className="text-xl font-orbitron font-semibold text-egyshyr-white mb-3 group-hover:text-egyshyr-blue transition-colors">
            {title}
          </h3>
          
          <p className="text-egyshyr-gray font-inter leading-relaxed">
            {description}
          </p>
        </div>
      </div>
    </motion.div>
  )
}

const WhyUsSection: React.FC = () => {
  const [activeStat, setActiveStat] = useState(0)

  useEffect(() => {
    const interval = setInterval(() => {
      setActiveStat((prev) => (prev + 1) % stats.length)
    }, 3000)

    return () => clearInterval(interval)
  }, [])

  return (
    <section id="why-us" className="py-20 px-6 relative overflow-hidden">
      {/* Background Elements */}
      <div className="absolute inset-0 bg-tech-pattern opacity-5" />
      
      <div className="max-w-7xl mx-auto">
        {/* Section Header */}
        <motion.div
          className="text-center mb-16"
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
        >
          <motion.span
            className="inline-block px-4 py-2 bg-egyshyr-green/10 border border-egyshyr-green/30 rounded-full text-egyshyr-green text-sm font-rajdhani font-medium mb-4"
            whileHover={{ scale: 1.05 }}
          >
            Why Choose Us
          </motion.span>
          
          <h2 className="text-4xl md:text-6xl font-orbitron font-bold text-egyshyr-white mb-6">
            Proven
            <span className="block bg-gradient-to-r from-egyshyr-green via-egyshyr-blue to-egyshyr-purple bg-clip-text text-transparent">
              Excellence
            </span>
          </h2>
          
          <p className="text-xl text-egyshyr-gray font-inter max-w-2xl mx-auto leading-relaxed">
            Numbers speak louder than words. Our track record of success and 
            commitment to excellence sets us apart in the digital landscape.
          </p>
        </motion.div>

        {/* Stats Section */}
        <div className="mb-20">
          <motion.h3
            className="text-2xl md:text-3xl font-orbitron font-bold text-center text-egyshyr-white mb-12"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
          >
            Our Impact in Numbers
          </motion.h3>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {stats.map((stat, index) => (
              <StatCard
                key={stat.id}
                stat={stat}
                index={index}
                isActive={activeStat === index}
                onClick={() => setActiveStat(index)}
              />
            ))}
          </div>
        </div>

        {/* Values Section */}
        <div>
          <motion.h3
            className="text-2xl md:text-3xl font-orbitron font-bold text-center text-egyshyr-white mb-12"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.6 }}
          >
            Our Core Values
          </motion.h3>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {values.map((value, index) => (
              <ValueCard key={value.id} value={value} index={index} />
            ))}
          </div>
        </div>

        {/* Call to Action */}
        <motion.div
          className="text-center mt-16"
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.3 }}
        >
          <motion.button
            className="px-8 py-4 bg-gradient-to-r from-egyshyr-green to-egyshyr-blue rounded-lg text-white font-semibold text-lg hover:shadow-glow interactive glow-on-hover"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            Partner With Us Today
          </motion.button>
        </motion.div>
      </div>
    </section>
  )
}

export default WhyUsSection