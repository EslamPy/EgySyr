import React, { useRef, useMemo } from 'react'
import { Canvas, useFrame } from '@react-three/fiber'
import { Points, PointMaterial } from '@react-three/drei'
import { motion } from 'framer-motion'
import * as THREE from 'three'
import { ArrowDown, Code, Smartphone, Cloud } from 'lucide-react'

// 3D Particle System Component
const ParticleField: React.FC = () => {
  const ref = useRef<THREE.Points>(null!)
  
  const particlesPosition = useMemo(() => {
    const positions = new Float32Array(5000 * 3)
    for (let i = 0; i < 5000; i++) {
      positions[i * 3] = (Math.random() - 0.5) * 10
      positions[i * 3 + 1] = (Math.random() - 0.5) * 10
      positions[i * 3 + 2] = (Math.random() - 0.5) * 10
    }
    return positions
  }, [])

  useFrame((state) => {
    if (ref.current) {
      ref.current.rotation.x = state.clock.elapsedTime * 0.05
      ref.current.rotation.y = state.clock.elapsedTime * 0.02
    }
  })

  return (
    <Points ref={ref} positions={particlesPosition} stride={3} frustumCulled={false}>
      <PointMaterial
        transparent
        color="#00FFFF"
        size={0.02}
        sizeAttenuation={true}
        depthWrite={false}
        vertexColors={false}
        opacity={0.8}
      />
    </Points>
  )
}

// Floating Code Matrix
const CodeMatrix: React.FC = () => {
  const codeSnippets = [
    'const future = () => {}',
    'function buildApp() {}',
    'class Innovation {}',
    'async develop() {}',
    'export { Experience }',
    'import { Innovation }',
  ]

  return (
    <div className="absolute inset-0 overflow-hidden pointer-events-none">
      {codeSnippets.map((code, index) => (
        <motion.div
          key={index}
          className="absolute text-egyshyr-blue/30 font-mono text-sm"
          style={{
            left: `${Math.random() * 100}%`,
            top: `${Math.random() * 100}%`,
          }}
          animate={{
            y: [0, -50, 0],
            opacity: [0.3, 0.7, 0.3],
          }}
          transition={{
            duration: 4 + Math.random() * 3,
            repeat: Infinity,
            delay: Math.random() * 2,
          }}
        >
          {code}
        </motion.div>
      ))}
    </div>
  )
}

const HeroSection: React.FC = () => {
  const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: {
        staggerChildren: 0.3,
        delayChildren: 0.2,
      },
    },
  }

  const itemVariants = {
    hidden: { opacity: 0, y: 30 },
    visible: {
      opacity: 1,
      y: 0,
      transition: {
        duration: 0.8,
        ease: "easeOut",
      },
    },
  }

  const floatingIcons = [
    { Icon: Code, delay: 0, color: 'text-egyshyr-blue' },
    { Icon: Smartphone, delay: 0.5, color: 'text-egyshyr-purple' },
    { Icon: Cloud, delay: 1, color: 'text-egyshyr-green' },
  ]

  return (
    <section id="hero" className="relative min-h-screen flex items-center justify-center overflow-hidden">
      {/* 3D Background */}
      <div className="absolute inset-0">
        <Canvas camera={{ position: [0, 0, 1] }}>
          <ParticleField />
        </Canvas>
      </div>

      {/* Code Matrix Overlay */}
      <CodeMatrix />

      {/* Gradient Overlay */}
      <div className="absolute inset-0 bg-gradient-radial from-transparent via-egyshyr-black/50 to-egyshyr-black" />

      {/* Main Content */}
      <motion.div
        className="relative z-10 text-center px-6 max-w-6xl mx-auto"
        variants={containerVariants}
        initial="hidden"
        animate="visible"
      >
        {/* Floating Icons */}
        <div className="absolute inset-0 pointer-events-none">
          {floatingIcons.map(({ Icon, delay, color }, index) => (
            <motion.div
              key={index}
              className={`absolute ${color}`}
              style={{
                left: `${20 + index * 30}%`,
                top: `${20 + index * 15}%`,
              }}
              animate={{
                y: [0, -20, 0],
                rotate: [0, 10, 0],
              }}
              transition={{
                duration: 3,
                repeat: Infinity,
                delay,
              }}
            >
              <Icon size={48} className="opacity-20" />
            </motion.div>
          ))}
        </div>

        {/* Main Heading */}
        <motion.div variants={itemVariants} className="mb-8">
          <motion.h1
            className="text-6xl md:text-8xl font-orbitron font-bold mb-6"
            initial={{ scale: 0.8, opacity: 0 }}
            animate={{ scale: 1, opacity: 1 }}
            transition={{ duration: 1, delay: 0.5 }}
          >
            <span className="block text-egyshyr-white mb-2">WE ENGINEER</span>
            <span className="block bg-gradient-to-r from-egyshyr-blue via-egyshyr-purple to-egyshyr-green bg-clip-text text-transparent animate-glow-pulse">
              THE DIGITAL
            </span>
            <span className="block text-egyshyr-white">WORLD</span>
          </motion.h1>
        </motion.div>

        {/* Subtitle */}
        <motion.p
          variants={itemVariants}
          className="text-xl md:text-2xl text-egyshyr-gray font-rajdhani mb-8 leading-relaxed"
        >
          We build the future. Not just apps — experiences.<br />
          <span className="text-egyshyr-blue">Custom solutions</span> that push boundaries and 
          <span className="text-egyshyr-purple"> transform ideas</span> into reality.
        </motion.p>

        {/* Service Highlights */}
        <motion.div
          variants={itemVariants}
          className="flex flex-wrap justify-center gap-4 mb-12"
        >
          {[
            'Web Applications',
            'Mobile Apps',
            'Cloud Solutions',
            'AI Integration',
            'UI/UX Design',
            'Backend Systems'
          ].map((service, index) => (
            <motion.span
              key={service}
              className="px-4 py-2 bg-egyshyr-darker-gray/50 backdrop-blur-sm border border-egyshyr-blue/20 rounded-lg text-egyshyr-white font-inter text-sm"
              whileHover={{
                scale: 1.05,
                borderColor: '#00FFFF',
                boxShadow: '0 0 20px rgba(0, 255, 255, 0.3)',
              }}
              transition={{ delay: index * 0.1 }}
            >
              {service}
            </motion.span>
          ))}
        </motion.div>

        {/* CTA Buttons */}
        <motion.div
          variants={itemVariants}
          className="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16"
        >
          <motion.button
            className="px-8 py-4 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold text-lg hover:shadow-glow interactive glow-on-hover group"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            <span className="mr-2">Start Your Project</span>
            <motion.span
              className="inline-block"
              animate={{ x: [0, 5, 0] }}
              transition={{ duration: 1.5, repeat: Infinity }}
            >
              →
            </motion.span>
          </motion.button>

          <motion.button
            className="px-8 py-4 border-2 border-egyshyr-blue/50 rounded-lg text-egyshyr-blue font-semibold text-lg hover:bg-egyshyr-blue/10 interactive group"
            whileHover={{ scale: 1.05, borderColor: '#00FFFF' }}
            whileTap={{ scale: 0.95 }}
          >
            View Our Work
          </motion.button>
        </motion.div>

        {/* Scroll Indicator */}
        <motion.div
          variants={itemVariants}
          className="flex flex-col items-center"
        >
          <p className="text-egyshyr-gray text-sm mb-4 font-inter">Discover More</p>
          <motion.div
            animate={{ y: [0, 10, 0] }}
            transition={{ duration: 2, repeat: Infinity }}
            className="text-egyshyr-blue cursor-pointer interactive"
            onClick={() => {
              document.querySelector('#services')?.scrollIntoView({ behavior: 'smooth' })
            }}
          >
            <ArrowDown size={24} />
          </motion.div>
        </motion.div>
      </motion.div>

      {/* Animated Lines/Grid */}
      <div className="absolute inset-0 pointer-events-none">
        <div className="absolute top-1/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-egyshyr-blue/30 to-transparent" />
        <div className="absolute top-3/4 left-0 w-full h-px bg-gradient-to-r from-transparent via-egyshyr-purple/30 to-transparent" />
        <div className="absolute left-1/4 top-0 w-px h-full bg-gradient-to-b from-transparent via-egyshyr-green/30 to-transparent" />
        <div className="absolute right-1/4 top-0 w-px h-full bg-gradient-to-b from-transparent via-egyshyr-blue/30 to-transparent" />
      </div>
    </section>
  )
}

export default HeroSection