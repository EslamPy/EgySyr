import React, { useEffect, useRef } from 'react'
import { motion, useScroll, useTransform } from 'framer-motion'
import { ChevronRight, ArrowRight, Play, Star, CheckCircle, Users, Zap, Shield, Globe, Sparkles, Code, Smartphone, Server, Eye, TrendingUp, Rocket, Brain, Palette, Sliders } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import AnimatedCounter from '../components/AnimatedCounter.tsx'
import Footer from '../components/Footer.tsx'
import RotatingText from '../components/RotatingText.tsx'
import { Canvas } from '@react-three/fiber'
import { Environment, Float, OrbitControls, Box, Torus, Sphere, MeshDistortMaterial } from '@react-three/drei'
import { animationUtils } from '../utils/animations.ts'
import { useApprovedFeedback } from '../hooks/useApprovedFeedback.tsx'
import { Link } from 'wouter'

// Premium 3D Scene Component
const PremiumScene: React.FC = () => {
  return (
    <>
      <Environment preset="city" />
      <ambientLight intensity={0.3} />
      <directionalLight position={[10, 10, 5]} intensity={1.2} color="#8B5CF6" />
      <directionalLight position={[-10, -10, -10]} intensity={0.8} color="#06B6D4" />
      <pointLight position={[0, 0, 5]} color="#EC4899" intensity={0.6} />
      <pointLight position={[5, 5, -5]} color="#3B82F6" intensity={0.4} />

      {/* Enhanced Floating geometric shapes */}
      <Float speed={1.2} rotationIntensity={0.8} floatIntensity={1.2}>
        <Box args={[1.2, 1.2, 1.2]} position={[-4, 3, -1]} rotation={[0.8, 0.8, 0]}>
          <meshStandardMaterial color="#8B5CF6" metalness={0.9} roughness={0.1} />
        </Box>
      </Float>

      <Float speed={1.8} rotationIntensity={0.5} floatIntensity={1.8}>
        <Torus args={[1.2, 0.4, 20, 100]} position={[4, -2, -3]} rotation={[1.2, 0, 0]}>
          <meshStandardMaterial color="#06B6D4" metalness={0.95} roughness={0.05} />
        </Torus>
      </Float>

      <Float speed={1.0} rotationIntensity={0.9} floatIntensity={1.0}>
        <Sphere args={[1.0, 80, 80]} position={[0, -3, -2]}>
          <MeshDistortMaterial
            color="#EC4899"
            metalness={0.9}
            roughness={0.1}
            distort={0.4}
            speed={3}
          />
        </Sphere>
      </Float>

      {/* Additional geometric shapes for more visual interest */}
      <Float speed={0.6} rotationIntensity={1.2} floatIntensity={0.8}>
        <Box args={[0.8, 0.8, 0.8]} position={[2, 4, 0]} rotation={[0, 0.6, 0.4]}>
          <meshStandardMaterial color="#3B82F6" metalness={0.8} roughness={0.2} />
        </Box>
      </Float>

      <Float speed={1.4} rotationIntensity={0.6} floatIntensity={1.4}>
        <Torus args={[0.8, 0.2, 16, 80]} position={[-3, -1, 1]} rotation={[0, 1, 0.5]}>
          <meshStandardMaterial color="#1E40AF" metalness={0.9} roughness={0.1} />
        </Torus>
      </Float>

      <Float speed={0.9} rotationIntensity={1.1} floatIntensity={0.9}>
        <Sphere args={[0.6, 64, 64]} position={[3, 2, 2]}>
          <MeshDistortMaterial
            color="#0F766E"
            metalness={0.85}
            roughness={0.15}
            distort={0.3}
            speed={2.5}
          />
        </Sphere>
      </Float>

      {/* Floating particles for ambient effect */}
      {Array.from({ length: 15 }).map((_, i) => (
        <Float key={i} speed={0.5 + Math.random()} rotationIntensity={0.3} floatIntensity={0.5 + Math.random()}>
          <Sphere args={[0.1, 16, 16]} position={[
            (Math.random() - 0.5) * 10,
            (Math.random() - 0.5) * 10,
            (Math.random() - 0.5) * 10
          ]}>
            <meshStandardMaterial
              color={['#8B5CF6', '#06B6D4', '#EC4899', '#3B82F6', '#1E40AF'][Math.floor(Math.random() * 5)]}
              metalness={0.8}
              roughness={0.2}
              emissive={['#8B5CF6', '#06B6D4', '#EC4899', '#3B82F6', '#1E40AF'][Math.floor(Math.random() * 5)]}
              emissiveIntensity={0.2}
            />
          </Sphere>
        </Float>
      ))}
    </>
  )
}

const HomePage: React.FC = () => {
  console.log('HomePage component rendering...')

  const heroRef = useRef<HTMLDivElement>(null)
  const titleRef = useRef<HTMLHeadingElement>(null)
  const containerRef = useRef<HTMLDivElement>(null)
  const { scrollYProgress } = useScroll()
  const { feedback, loading: feedbackLoading, error: feedbackError } = useApprovedFeedback()

  const y = useTransform(scrollYProgress, [0, 1], ['0%', '50%'])
  const opacity = useTransform(scrollYProgress, [0, 0.5], [1, 0])

  useEffect(() => {
    if (titleRef.current) {
      // Animate the hero title with split text effect
      setTimeout(() => {
        animationUtils.splitText(titleRef.current!, 0.5)
      }, 1000)
    }
  }, [])

  const fadeInUp = {
    initial: { opacity: 0, y: 60 },
    animate: { opacity: 1, y: 0 }
  }

  const staggerContainer = {
    animate: {
      transition: {
        staggerChildren: 0.1
      }
    }
  }

  const floatingIcons = [
    { icon: Sparkles, x: '10%', y: '20%', delay: 0, color: 'text-neon-purple' },
    { icon: Code, x: '85%', y: '15%', delay: 1, color: 'text-neon-cyan' },
    { icon: Brain, x: '15%', y: '80%', delay: 2, color: 'text-neon-pink' },
    { icon: Rocket, x: '80%', y: '75%', delay: 3, color: 'text-electric-blue' },
  ]

  return (
    <PageTransition>
      <div className="relative bg-jet-black text-white overflow-hidden" ref={containerRef}>
        {/* Floating Background Elements */}
        <div className="fixed inset-0 pointer-events-none z-0">
          {floatingIcons.map((item, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, scale: 0 }}
              animate={{ opacity: 0.1, scale: 1 }}
              transition={{ delay: item.delay, duration: 2 }}
              className={`absolute ${item.x} ${item.y}`}
            >
              <item.icon className={`w-32 h-32 ${item.color} opacity-20 blur-sm`} />
            </motion.div>
          ))}

          {/* Animated Grid Pattern */}
          <div className="absolute inset-0 opacity-5">
            <div className="absolute inset-0" style={{
              backgroundImage: `radial-gradient(circle at 1px 1px, rgba(139, 92, 246, 0.3) 1px, transparent 0)`,
              backgroundSize: '50px 50px'
            }} />
          </div>
        </div>

        {/* Hero Section */}
        <section
          ref={heroRef}
          className="relative min-h-screen flex items-center justify-center overflow-hidden"
        >
          {/* Video Background */}
          <div className="absolute inset-0 z-0">
            <video
              autoPlay
              muted
              loop
              playsInline
              preload="auto"
              controls={false}
              disablePictureInPicture
              className="w-full h-full object-cover"
              style={{
                filter: 'brightness(0.7) contrast(1.3) saturate(0.3)',
                transform: 'scale(1.02)',
                imageRendering: 'auto',
              }}
            >
              <source src="/images/3d.mp4" type="video/mp4" />
            </video>
            {/* Lighter overlay for better video visibility */}
            <div className="absolute inset-0 bg-black/25" />
            {/* Gradient overlay for text readability */}
            <div className="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/40" />
          </div>

          {/* Animated geometric elements */}
          <div className="absolute inset-0 z-10 pointer-events-none">
            <motion.div
              className="absolute top-20 left-20 w-32 h-32 border border-white/10 rotate-45"
              animate={{ rotate: [45, 405] }}
              transition={{ duration: 20, repeat: Infinity, ease: "linear" }}
            />
            <motion.div
              className="absolute bottom-32 right-32 w-24 h-24 border border-white/10 rounded-full"
              animate={{ scale: [1, 1.2, 1] }}
              transition={{ duration: 4, repeat: Infinity, ease: "easeInOut" }}
            />
            <motion.div
              className="absolute top-1/3 right-20 w-16 h-16 bg-white/5 backdrop-blur-sm"
              animate={{ y: [-20, 20, -20] }}
              transition={{ duration: 6, repeat: Infinity, ease: "easeInOut" }}
            />
          </div>

          {/* Main Content */}
          <div className="relative z-20 text-center max-w-6xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 1, delay: 0.2 }}
              className="space-y-8"
            >
              {/* Badge */}
              <motion.div
                initial={{ opacity: 0, scale: 0.8 }}
                animate={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.8, delay: 0.5 }}
                className="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-sm font-medium"
              >
                <motion.div
                  animate={{ rotate: [0, 360] }}
                  transition={{ duration: 3, repeat: Infinity, ease: "linear" }}
                  className="w-2 h-2 bg-white rounded-full mr-3"
                />
                Innovation • Technology • Excellence
              </motion.div>

              {/* Main Heading */}
              <h1 className="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-heading">
                <span className="text-white">Elevate your</span>
                <br />
                <span className="inline-flex items-center justify-center flex-wrap gap-2 mt-4 sm:mt-6 md:mt-8">
                  <span className="text-white">Business</span>
                  <RotatingText
                    texts={["Growth", "Innovation", "Efficiency", "Success", "Performance"]}
                    mainClassName="px-2 sm:px-2 md:px-3 bg-white text-black overflow-hidden py-1 sm:py-1 md:py-2 justify-center rounded-lg shadow-lg"
                    staggerFrom={"last"}
                    initial={{ y: "100%" }}
                    animate={{ y: 0 }}
                    exit={{ y: "-120%" }}
                    staggerDuration={0.025}
                    splitLevelClassName="overflow-hidden pb-1 sm:pb-1 md:pb-1"
                    transition={{ type: "spring", damping: 30, stiffness: 400 }}
                    rotationInterval={2000}
                  />
                </span>
              </h1>

              {/* Subtitle */}
              <motion.p
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 1.2 }}
                className="text-xl md:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed"
              >
                Transforming visions into extraordinary digital experiences through cutting-edge technology,
                innovative design, and unparalleled expertise.
              </motion.p>

              {/* CTA Buttons */}
              <motion.div
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 1.6 }}
                className="flex flex-col sm:flex-row gap-6 justify-center items-center pt-8"
              >
                <Link href="/services">
                  <motion.button
                    whileHover={{ scale: 1.05, y: -2 }}
                    whileTap={{ scale: 0.95 }}
                    className="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full overflow-hidden transition-all duration-300"
                  >
                    <motion.div
                      className="absolute inset-0 bg-gradient-to-r from-purple-600 to-cyan-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                    />
                    <span className="relative z-10 flex items-center">
                      Start Your Project
                      <motion.svg
                        className="w-5 h-5 ml-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        animate={{ x: [0, 5, 0] }}
                        transition={{ duration: 2, repeat: Infinity, ease: "easeInOut" }}
                      >
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                      </motion.svg>
                    </span>
                  </motion.button>
                </Link>

                <Link href="/about">
                  <motion.button
                    whileHover={{ scale: 1.05, y: -2 }}
                    whileTap={{ scale: 0.95 }}
                    className="group px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-full hover:bg-white/10 transition-all duration-300"
                  >
                    <span className="flex items-center">
                      View Our Work
                      <motion.svg
                        className="w-5 h-5 ml-2"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        animate={{ scale: [1, 1.2, 1] }}
                        transition={{ duration: 2, repeat: Infinity, ease: "easeInOut" }}
                      >
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </motion.svg>
                    </span>
                  </motion.button>
                </Link>
              </motion.div>

              {/* Stats */}
              <motion.div
                initial={{ opacity: 0, y: 30 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 2 }}
                className="flex flex-wrap justify-center gap-8 pt-16"
              >
                {[
                  { number: '500+', label: 'Projects Completed' },
                  { number: '98%', label: 'Client Satisfaction' },
                  { number: '50+', label: 'Expert Team' },
                  { number: '24/7', label: 'Support' }
                ].map((stat, index) => (
                  <motion.div
                    key={index}
                    initial={{ opacity: 0, scale: 0.8 }}
                    animate={{ opacity: 1, scale: 1 }}
                    transition={{ duration: 0.8, delay: 2.2 + index * 0.1 }}
                    className="text-center"
                  >
                    <div className="text-3xl md:text-4xl font-bold text-white mb-2">
                      {stat.number}
                    </div>
                    <div className="text-sm text-gray-400 uppercase tracking-wider">
                      {stat.label}
                    </div>
                  </motion.div>
                ))}
              </motion.div>
            </motion.div>
          </div>

          {/* Scroll Indicator */}
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 1, delay: 3 }}
            className="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20"
          >
            <motion.div
              animate={{ y: [0, 10, 0] }}
              transition={{ duration: 2, repeat: Infinity, ease: "easeInOut" }}
              className="flex flex-col items-center text-white/60"
            >
              <span className="text-sm mb-2 uppercase tracking-wider">Scroll</span>
              <motion.div
                animate={{ scaleY: [1, 1.5, 1] }}
                transition={{ duration: 2, repeat: Infinity, ease: "easeInOut" }}
                className="w-0.5 h-8 bg-white/60 rounded-full"
              />
            </motion.div>
          </motion.div>
        </section>


        {/* Unique Stats Section - Hexagonal Grid */}
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-20"
            >
              <h2 className="text-5xl lg:text-6xl font-bold mb-6">
                <span className="text-white">Numbers That</span>{' '}
                <span className="bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Speak
                </span>
              </h2>
              <p className="text-xl text-gray-400 max-w-3xl mx-auto">
                Our achievements in numbers - each digit represents a story of innovation and success.
              </p>
            </motion.div>

            {/* Hexagonal Stats Grid */}
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8"
            >
              {[
                { number: '500+', label: 'Projects Delivered', icon: CheckCircle, color: 'from-neon-purple to-neon-cyan' },
                { number: '98%', label: 'Client Satisfaction', icon: Star, color: 'from-neon-cyan to-neon-pink' },
                { number: '50+', label: 'Expert Team', icon: Users, color: 'from-neon-pink to-electric-blue' },
                { number: '24/7', label: 'Support Available', icon: Shield, color: 'from-electric-blue to-neon-purple' }
              ].map((stat, index) => (
                <motion.div
                  key={index}
                  variants={fadeInUp}
                  className="group relative"
                >
                  <div className="relative bg-gradient-to-br from-deep-charcoal to-jet-black rounded-3xl p-8 border border-white/10 backdrop-blur-sm hover:border-neon-purple/50 transition-all duration-500 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-neon-purple/25">
                    {/* Hexagonal Background Pattern */}
                    <div className="absolute inset-0 opacity-5">
                      <div className="w-full h-full" style={{
                        backgroundImage: `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238B5CF6' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
                        backgroundSize: '60px 60px'
                      }} />
                    </div>

                    <div className={`w-20 h-20 bg-gradient-to-r ${stat.color} rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500 shadow-lg`}>
                      <stat.icon className="w-10 h-10 text-white" />
                    </div>

                    <div className="text-4xl lg:text-5xl font-bold text-white mb-3 text-center">
                      <AnimatedCounter target={parseInt(stat.number)} suffix={stat.number.includes('+') ? '+' : ''} />
                    </div>

                    <p className="text-gray-300 font-medium text-center text-lg">{stat.label}</p>

                    {/* Hover Effect Line */}
                    <div className="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-1 bg-gradient-to-r from-neon-purple to-neon-cyan group-hover:w-1/2 transition-all duration-500 rounded-full" />
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Creative Services Section - 3D Card Layout */}
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-20"
            >
              <div className="inline-flex items-center px-6 py-3 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-sm font-medium mb-8 backdrop-blur-sm">
                <Sparkles className="w-4 h-4 mr-2" />
                Our Expertise
              </div>
              <h2 className="text-5xl lg:text-6xl font-bold mb-6">
                <span className="text-white">Services That</span>{' '}
                <span className="bg-gradient-to-r from-neon-purple via-neon-cyan to-neon-pink bg-clip-text text-transparent">
                  Transform
                </span>
              </h2>
              <p className="text-xl text-gray-400 max-w-3xl mx-auto">
                From concept to reality, we craft digital experiences that leave lasting impressions.
              </p>
            </motion.div>

            {/* 3D Services Grid */}
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            >
              {[
                {
                  title: 'Web Development',
                  description: 'Cutting-edge websites and web applications that push the boundaries of what\'s possible.',
                  icon: Globe,
                  gradient: 'from-neon-purple to-neon-cyan',
                  features: ['Modern Frameworks', 'Performance First', 'SEO Optimized', 'Responsive Design'],
                  delay: 0
                },
                {
                  title: 'Mobile Applications',
                  description: 'Native and cross-platform mobile apps that deliver exceptional user experiences.',
                  icon: Smartphone,
                  gradient: 'from-neon-cyan to-neon-pink',
                  features: ['iOS & Android', 'Cross-Platform', 'Native Performance', 'App Store Ready'],
                  delay: 0.1
                },
                {
                  title: 'Administrative systems',
                  description: 'Intelligent solutions that learn, adapt, and evolve with your business needs.',
                  icon: Sliders,
                  gradient: 'from-neon-pink to-electric-blue',
                  features: ['Predictive Analytics', 'Natural Language', 'Computer Vision', 'Automation'],
                  delay: 0.2
                },
                // {
                //   title: 'Cloud Infrastructure',
                //   description: 'Scalable cloud solutions that grow with your business and ensure reliability.',
                //   icon: Server,
                //   gradient: 'from-electric-blue to-neon-purple',
                //   features: ['AWS & Azure', 'Auto-scaling', '99.9% Uptime', 'Security First'],
                //   delay: 0.3
                // },
                // {
                //   title: 'Digital Marketing',
                //   description: 'Data-driven marketing strategies that convert visitors into loyal customers.',
                //   icon: TrendingUp,
                //   gradient: 'from-neon-purple to-neon-cyan',
                //   features: ['SEO & SEM', 'Social Media', 'Content Strategy', 'Analytics'],
                //   delay: 0.4
                // },
                // {
                //   title: 'UI/UX Design',
                //   description: 'Beautiful, intuitive interfaces that users love and businesses trust.',
                //   icon: Palette,
                //   gradient: 'from-neon-cyan to-neon-pink',
                //   features: ['User Research', 'Wireframing', 'Prototyping', 'User Testing'],
                //   delay: 0.5
                // }
              ].map((service, index) => (
                <motion.div
                  key={index}
                  variants={fadeInUp}
                  transition={{ delay: service.delay }}
                  className="group relative perspective-1000"
                >
                  <div className="relative bg-gradient-to-br from-deep-charcoal to-jet-black rounded-3xl p-8 border border-white/10 backdrop-blur-sm hover:border-neon-purple/50 transition-all duration-700 transform hover:-translate-y-4 hover:rotate-y-12 preserve-3d">
                    {/* 3D Hover Effect */}
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/5 to-neon-cyan/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700" />

                    <div className={`w-20 h-20 bg-gradient-to-r ${service.gradient} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 shadow-lg`}>
                      <service.icon className="w-10 h-10 text-white" />
                    </div>

                    <h3 className="text-2xl font-bold text-white mb-4 group-hover:text-neon-purple transition-colors duration-500">{service.title}</h3>
                    <p className="text-gray-400 mb-6 leading-relaxed">{service.description}</p>

                    <ul className="space-y-3 mb-8">
                      {service.features.map((feature, idx) => (
                        <li key={idx} className="flex items-center text-gray-300 group-hover:text-gray-200 transition-colors duration-300">
                          <CheckCircle className="w-4 h-4 text-neon-cyan mr-3 flex-shrink-0" />
                          {feature}
                        </li>
                      ))}
                    </ul>

                    <Link href="/services">
                      <button className="group/btn w-full py-4 px-6 bg-gradient-to-r from-logo-blue/10 to-logo-indigo/10 text-logo-blue rounded-xl font-semibold hover:from-logo-blue/20 hover:to-logo-indigo/20 transition-all duration-500 border border-logo-blue/30 hover:border-logo-blue/50 flex items-center justify-center backdrop-blur-sm">
                        Explore
                        <ChevronRight className="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform duration-300" />
                      </button>
                    </Link>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Interactive Technology Showcase */}
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-20"
            >
              <h2 className="text-5xl lg:text-6xl font-bold mb-6">
                <span className="text-white">Powered by</span>{' '}
                <span className="bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Technology
                </span>
              </h2>
              <p className="text-xl text-gray-400 max-w-3xl mx-auto">
                We leverage the latest technologies to create solutions that are not just current, but future-ready.
              </p>
            </motion.div>

            {/* Interactive Tech Grid */}
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8"
            >
              {[
                { name: 'React', logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg', color: 'text-cyan-500' },
                { name: 'Node.js', logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg', color: 'text-green-500' },
                { name: 'Python', logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', color: 'text-blue-500' },
                { name: 'AWS', logo: 'https://registry.npmmirror.com/@lobehub/icons-static-png/latest/files/light/aws.png', color: 'text-orange-500' },
                { name: 'Docker', logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg', color: 'text-blue-600' },
                { name: 'MongoDB', logo: 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mongodb/mongodb-original.svg', color: 'text-green-600' }
              ].map((tech, index) => (
                <motion.div
                  key={index}
                  variants={fadeInUp}
                  className="group text-center"
                >
                  <div className="relative w-24 h-24 bg-gradient-to-br from-deep-charcoal to-jet-black rounded-3xl shadow-lg flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:shadow-2xl group-hover:shadow-neon-purple/25 transition-all duration-500 border border-white/10 group-hover:border-neon-purple/50 backdrop-blur-sm">
                    <img src={tech.logo} alt={tech.name} className="w-14 h-14 filter brightness-0 invert group-hover:filter-none transition-all duration-500" />

                    {/* Hover Glow Effect */}
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 to-neon-cyan/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                  </div>
                  <p className={`font-semibold ${tech.color} group-hover:text-white transition-colors duration-500`}>{tech.name}</p>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Revolutionary Client Testimonials Section */}
        <section className="py-32 relative overflow-hidden bg-gradient-to-b from-jet-black via-deep-charcoal/30 to-jet-black">
          {/* Background Effects */}
          <div className="absolute inset-0">
            <div className="absolute top-20 left-20 w-96 h-96 bg-neon-purple/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-neon-pink/5 rounded-full blur-3xl" />
          </div>

          <div className="relative max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 1 }}
              viewport={{ once: true }}
              className="text-center mb-20"
            >
              <motion.div
                className="inline-flex items-center px-6 py-3 bg-white/5 backdrop-blur-xl border border-white/10 rounded-full text-white/80 text-sm font-medium mb-8"
                whileHover={{ scale: 1.05 }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
              >
                <motion.div
                  animate={{ rotate: [0, 360] }}
                  transition={{ duration: 3, repeat: Infinity, ease: "linear" }}
                >
                  <Star className="w-4 h-4 mr-3 text-neon-pink" />
                </motion.div>
                Client Success Stories
              </motion.div>

              <motion.h2
                className="text-5xl md:text-7xl font-black mb-8 leading-tight"
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.2 }}
                viewport={{ once: true }}
              >
                What Our{' '}
                <span className="bg-gradient-to-r from-neon-pink via-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Clients
                </span>
                {' '}Say
              </motion.h2>

              <motion.p
                className="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed"
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.4 }}
                viewport={{ once: true }}
              >
                Real stories from businesses we've transformed with cutting-edge digital solutions that drive growth and innovation.
              </motion.p>
            </motion.div>

            {/* Revolutionary Testimonials Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {feedbackLoading ? (
                // Loading state
                Array.from({ length: 3 }).map((_, index) => (
                  <motion.div
                    key={`loading-${index}`}
                    className="group relative"
                    initial={{ opacity: 0, y: 50, scale: 0.9 }}
                    whileInView={{ opacity: 1, y: 0, scale: 1 }}
                    transition={{
                      duration: 0.8,
                      delay: index * 0.2,
                      type: "spring",
                      stiffness: 100
                    }}
                    viewport={{ once: true }}
                  >
                    <div className="relative p-8 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl overflow-hidden">
                      <div className="animate-pulse">
                        <div className="flex items-center mb-6 space-x-1">
                          {[...Array(5)].map((_, i) => (
                            <div key={i} className="w-5 h-5 bg-gray-600 rounded"></div>
                          ))}
                        </div>
                        <div className="space-y-3">
                          <div className="h-4 bg-gray-600 rounded"></div>
                          <div className="h-4 bg-gray-600 rounded w-5/6"></div>
                          <div className="h-4 bg-gray-600 rounded w-4/6"></div>
                        </div>
                        <div className="flex items-center space-x-4 mt-8">
                          <div className="w-16 h-16 bg-gray-600 rounded-2xl"></div>
                          <div className="space-y-2">
                            <div className="h-4 bg-gray-600 rounded w-24"></div>
                            <div className="h-3 bg-gray-600 rounded w-32"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </motion.div>
                ))
              ) : feedbackError ? (
                // Error state
                <div className="col-span-full text-center py-12">
                  <div className="text-gray-400 text-lg">
                    Unable to load client testimonials at the moment.
                  </div>
                </div>
              ) : feedback.length === 0 ? (
                // No feedback state
                <div className="col-span-full text-center py-12">
                  <div className="text-gray-400 text-lg">
                    No client testimonials available yet.
                  </div>
                </div>
              ) : (
                // Dynamic feedback display
                feedback.map((item, index) => {
                  // Generate gradient based on index
                  const gradients = [
                    'from-neon-purple to-neon-pink',
                    'from-neon-pink to-neon-cyan',
                    'from-neon-cyan to-electric-blue',
                    'from-electric-blue to-neon-purple',
                    'from-neon-purple to-neon-cyan',
                    'from-neon-pink to-electric-blue'
                  ]
                  const gradient = gradients[index % gradients.length]

                  // Use the avatar from feedback data or fallback to default
                  const avatar = item.avatar || '/images/icon.png'

                  return (
                    <motion.div
                      key={index}
                      className="group relative"
                      initial={{ opacity: 0, y: 50, scale: 0.9 }}
                      whileInView={{ opacity: 1, y: 0, scale: 1 }}
                      transition={{
                        duration: 0.8,
                        delay: index * 0.2,
                        type: "spring",
                        stiffness: 100
                      }}
                      viewport={{ once: true }}
                      whileHover={{ y: -12, scale: 1.02 }}
                    >
                      <div className="relative p-8 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-3xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-700 overflow-hidden">
                        {/* Animated Background Gradient */}
                        <motion.div
                          className={`absolute inset-0 bg-gradient-to-br ${gradient} opacity-0 group-hover:opacity-10 transition-opacity duration-700`}
                          animate={{
                            background: [
                              `linear-gradient(135deg, ${gradient.split(' ')[1]}, ${gradient.split(' ')[3]})`,
                              `linear-gradient(225deg, ${gradient.split(' ')[3]}, ${gradient.split(' ')[1]})`,
                              `linear-gradient(135deg, ${gradient.split(' ')[1]}, ${gradient.split(' ')[3]})`
                            ]
                          }}
                          transition={{ duration: 8, repeat: Infinity }}
                        />

                        {/* Quote Icon */}
                        <motion.div
                          className="absolute top-6 right-6 w-12 h-12 opacity-10 group-hover:opacity-20 transition-opacity duration-500"
                          whileHover={{ rotate: 360, scale: 1.2 }}
                          transition={{ duration: 0.8 }}
                        >
                          <svg viewBox="0 0 24 24" fill="currentColor" className="w-full h-full text-white">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                          </svg>
                        </motion.div>

                        {/* Animated Rating Stars */}
                        <div className="flex items-center mb-6 space-x-1">
                          {[...Array(item.rating)].map((_, i) => (
                            <motion.div
                              key={i}
                              initial={{ opacity: 0, scale: 0 }}
                              whileInView={{ opacity: 1, scale: 1 }}
                              transition={{
                                duration: 0.5,
                                delay: index * 0.2 + i * 0.1,
                                type: "spring",
                                stiffness: 200
                              }}
                              viewport={{ once: true }}
                              whileHover={{ scale: 1.3, rotate: 360 }}
                            >
                              <Star className="w-5 h-5 text-yellow-400 fill-current" />
                            </motion.div>
                          ))}
                        </div>

                        {/* Testimonial Content */}
                        <motion.blockquote
                          className="text-gray-300 mb-8 leading-relaxed text-lg group-hover:text-gray-200 transition-colors duration-500 relative z-10"
                          initial={{ opacity: 0 }}
                          whileInView={{ opacity: 1 }}
                          transition={{ duration: 1, delay: index * 0.2 + 0.3 }}
                          viewport={{ once: true }}
                        >
                          "{item.feedback_text}"
                        </motion.blockquote>

                        {/* Enhanced Client Info */}
                        <motion.div
                          className="flex items-center space-x-4 relative z-10"
                          initial={{ opacity: 0, x: -20 }}
                          whileInView={{ opacity: 1, x: 0 }}
                          transition={{ duration: 0.8, delay: index * 0.2 + 0.5 }}
                          viewport={{ once: true }}
                        >
                          <motion.div
                            className="relative"
                            whileHover={{ scale: 1.1 }}
                            transition={{ type: "spring", stiffness: 300 }}
                          >
                            <div className={`w-16 h-16 rounded-2xl overflow-hidden border-2 border-gradient-to-r ${gradient} p-0.5`}>
                              <div className="w-full h-full rounded-2xl rounded-2xl overflow-hidden">
                                <img
                                  src={avatar}
                                  alt={item.client_name}
                                  className="w-full h-full object-cover"
                                />
                              </div>
                            </div>

                            {/* Animated Ring */}
                            <motion.div
                              className={`absolute inset-0 rounded-2xl border-2 border-gradient-to-r ${gradient} opacity-0 group-hover:opacity-100`}
                              animate={{ rotate: [0, 360] }}
                              transition={{ duration: 3, repeat: Infinity, ease: "linear" }}
                            />
                          </motion.div>

                          <div>
                            <motion.h4
                              className="font-bold text-white text-lg group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-pink group-hover:to-neon-cyan group-hover:bg-clip-text transition-all duration-300"
                              whileHover={{ scale: 1.05 }}
                            >
                              {item.client_name}
                            </motion.h4>
                            <p className="text-gray-400 text-sm font-medium group-hover:text-gray-300 transition-colors duration-300">
                              {item.company_name || 'Client'}
                            </p>
                            <p className={`text-xs font-semibold bg-gradient-to-r ${gradient} bg-clip-text text-transparent`}>
                              {item.company_name || 'Client'}
                            </p>
                          </div>
                        </motion.div>

                        {/* Floating Particles */}
                        <div className="absolute inset-0 overflow-hidden pointer-events-none">
                          {Array.from({ length: 6 }).map((_, i) => (
                            <motion.div
                              key={i}
                              className={`absolute w-1 h-1 bg-gradient-to-r ${gradient} rounded-full opacity-0 group-hover:opacity-60`}
                              style={{
                                left: `${Math.random() * 100}%`,
                                top: `${Math.random() * 100}%`,
                              }}
                              animate={{
                                y: [0, -50, 0],
                                x: [0, Math.random() * 30 - 15, 0],
                                opacity: [0, 0.6, 0],
                                scale: [0, 1, 0],
                              }}
                              transition={{
                                duration: 4,
                                repeat: Infinity,
                                delay: i * 0.5,
                                ease: "easeInOut"
                              }}
                            />
                          ))}
                        </div>

                        {/* Bottom Glow Line */}
                        <motion.div
                          className={`absolute bottom-0 left-0 h-1 bg-gradient-to-r ${gradient} rounded-full transition-all duration-700 group-hover:w-full`}
                          initial={{ width: 0 }}
                          whileInView={{ width: '30%' }}
                          transition={{ duration: 1, delay: index * 0.2 + 0.8 }}
                          viewport={{ once: true }}
                        />
                      </div>
                    </motion.div>
                  )
                })
              )}
            </div>
          </div>
        </section>

        {/* Our Process Section - Creative Timeline */}
        <section className="py-32 relative">
          {/* Background Pattern */}
          <div className="absolute inset-0 bg-gradient-to-br from-logo-blue/5 via-logo-indigo/5 to-logo-teal/5" />
          <div className="absolute inset-0 opacity-30">
            <div className="w-full h-full" style={{
              backgroundImage: `url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231E40AF' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")`,
              backgroundSize: '60px 60px'
            }} />
          </div>

          <div className="relative z-10 max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-20"
            >
              <div className="inline-flex items-center px-6 py-3 bg-gradient-to-r from-logo-teal/20 to-logo-emerald/20 border border-logo-teal/30 rounded-full text-logo-teal text-sm font-medium mb-8 backdrop-blur-sm">
                <Zap className="w-4 h-4 mr-2" />
                How We Work
              </div>
              <h2 className="text-5xl lg:text-6xl font-bold mb-6">
                <span className="text-white">Our Proven</span>{' '}
                <span className="bg-gradient-to-r from-logo-teal via-logo-emerald to-logo-blue bg-clip-text text-transparent">
                  Process
                </span>
              </h2>
              <p className="text-xl text-gray-400 max-w-3xl mx-auto">
                A systematic approach that ensures every project exceeds expectations and delivers measurable results.
              </p>
            </motion.div>

            {/* Creative Process Timeline */}
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="relative"
            >
              {/* Timeline Line */}
              <div className="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-logo-blue via-logo-indigo to-logo-teal opacity-50 shadow-lg shadow-logo-blue/25" />

              {[
                {
                  step: '01',
                  title: 'Discovery & Strategy',
                  description: 'We dive deep into understanding your business, goals, and target audience to create a comprehensive digital strategy.',
                  icon: Eye,
                  color: 'from-logo-blue to-logo-indigo',
                  delay: 0
                },
                {
                  step: '02',
                  title: 'Design & Prototyping',
                  description: 'Our creative team crafts stunning designs and interactive prototypes that bring your vision to life.',
                  icon: Palette,
                  color: 'from-logo-indigo to-logo-teal',
                  delay: 0.2
                },
                {
                  step: '03',
                  title: 'Development & Testing',
                  description: 'Expert developers build your solution using cutting-edge technologies, followed by rigorous testing.',
                  icon: Code,
                  color: 'from-logo-teal to-logo-emerald',
                  delay: 0.4
                },
                {
                  step: '04',
                  title: 'Launch & Support',
                  description: 'We ensure smooth deployment and provide ongoing support to keep your digital presence optimized.',
                  icon: Rocket,
                  color: 'from-logo-emerald to-logo-blue',
                  delay: 0.6
                }
              ].map((process, index) => (
                <motion.div
                  key={index}
                  variants={fadeInUp}
                  transition={{ delay: process.delay }}
                  className={`relative flex items-center mb-16 ${index % 2 === 0 ? 'flex-row' : 'flex-row-reverse'
                    }`}
                >
                  {/* Process Card */}
                  <div className={`w-1/2 ${index % 2 === 0 ? 'pr-12' : 'pl-12'}`}>
                    <div className="relative bg-gradient-to-br from-deep-charcoal to-jet-black rounded-3xl p-8 border-2 border-white/20 backdrop-blur-sm hover:border-logo-blue/50 transition-all duration-500 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-logo-blue/25 shadow-lg">
                      {/* Step Number */}
                      <div className={`absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-r ${process.color} rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg`}>
                        {process.step}
                      </div>

                      {/* Process Icon */}
                      <div className={`w-16 h-16 bg-gradient-to-r ${process.color} rounded-2xl flex items-center justify-center mb-6 ml-8 group-hover:scale-110 transition-transform duration-500 shadow-lg`}>
                        <process.icon className="w-8 h-8 text-white" />
                      </div>

                      <h3 className="text-2xl font-bold text-white mb-4">{process.title}</h3>
                      <p className="text-gray-400 leading-relaxed">{process.description}</p>
                    </div>
                  </div>

                  {/* Timeline Dot */}
                  <div className="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gradient-to-r from-logo-blue to-logo-indigo rounded-full border-4 border-jet-black shadow-lg" />
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Creative CTA Section - Parallax Effect */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-logo-blue/20 via-logo-indigo/20 to-logo-teal/20" />

          {/* Animated Background Elements */}
          <motion.div
            animate={{ rotate: 360 }}
            transition={{ duration: 60, repeat: Infinity, ease: "linear" }}
            className="absolute inset-0 opacity-10"
          >
            <div className="absolute top-20 left-20 w-96 h-96 bg-logo-blue rounded-full blur-3xl" />
            <div className="absolute bottom-20 right-20 w-96 h-96 bg-logo-indigo rounded-full blur-3xl" />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-logo-teal rounded-full blur-3xl" />
          </motion.div>

          <div className="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl lg:text-6xl font-bold text-white mb-8">
                Ready to Create
                <span className="block bg-gradient-to-r from-logo-blue via-logo-indigo to-logo-teal bg-clip-text text-transparent">
                  Something Amazing?
                </span>
              </h2>
              <p className="text-xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                Let's turn your vision into reality. Our team of innovators is ready to craft digital experiences that will set your business apart from the competition.
              </p>

              <div className="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <Link href="/services">
                  <button className="group relative px-10 py-5 bg-gradient-to-r from-logo-blue to-logo-indigo text-white font-bold rounded-2xl shadow-2xl hover:shadow-logo-blue/25 transform hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                    <span className="relative z-10 flex items-center text-lg">
                      Start Your Project
                      <Rocket className="ml-3 w-6 h-6 group-hover:translate-x-2 transition-transform duration-300" />
                    </span>
                    <div className="absolute inset-0 bg-gradient-to-r from-logo-teal to-logo-emerald opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                  </button>
                </Link>

                <Link href="/about">
                  <button className="group px-10 py-5 border-2 border-logo-blue/30 text-logo-blue font-bold rounded-2xl hover:bg-logo-blue/10 hover:border-logo-blue/50 transition-all duration-500 backdrop-blur-sm text-lg">
                    <span className="flex items-center">
                      <Eye className="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" />
                      View Our Work
                    </span>
                  </button>
                </Link>
              </div>
            </motion.div>
          </div>
        </section>

        <Footer />
      </div>
    </PageTransition>
  )
}

export default HomePage
