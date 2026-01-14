import React from 'react'
import { motion } from 'framer-motion'
import { Users, Award, Heart, CheckCircle, Star, Play, Globe, Zap, Shield, Linkedin, Twitter, Github } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'
import { Canvas } from '@react-three/fiber'
import { Environment, Float, Box, Torus, Sphere, MeshDistortMaterial } from '@react-three/drei'
import { Link } from 'wouter'

const AboutPage: React.FC = () => {
  const stats = [
    { number: '150+', label: 'Projects Completed', icon: CheckCircle },
    { number: '50+', label: 'Happy Clients', icon: Heart },
    { number: '5+', label: 'Years Experience', icon: Award },
    { number: '24/7', label: 'Support Available', icon: Shield }
  ]

  const values = [
    {
      title: 'Innovation First',
      description: 'We stay ahead of technology trends to deliver cutting-edge solutions that give our clients a competitive advantage.',
      icon: Zap,
      color: 'from-blue-600 to-cyan-600'
    },
    {
      title: 'Quality Excellence',
      description: 'Every project is crafted with meticulous attention to detail, ensuring the highest standards of quality and performance.',
      icon: Star,
      color: 'from-yellow-500 to-orange-500'
    },
    {
      title: 'Client Partnership',
      description: 'We believe in building long-term relationships with our clients, working as an extension of their team.',
      icon: Heart,
      color: 'from-pink-500 to-rose-500'
    },
    {
      title: 'Global Impact',
      description: 'Our solutions reach businesses worldwide, helping them scale and succeed in the digital economy.',
      icon: Globe,
      color: 'from-green-500 to-emerald-500'
    }
  ]

  const team = [
    {
      name: 'Ahmed Ezz',
      role: 'COB & Founder',
      image: 'images/Ahmed.png', 
      bio: 'Founder & COB, EgySyr Ahmed Ezz is an expert in programming and website design. As Chairman of EgySyr, he combines technical skills and strategy to deliver innovative solutions that drive growth and client satisfaction.',
      social: { linkedin: 'https://www.linkedin.com/in/ahmed-ezz-65071a348/' }
    },
    {
      name: 'Naiem',
      role: 'CEO',
      image: 'images/Naiem.png',
      bio: 'Entrepreneur and business growth expert with strategic vision and experience in leading projects and creating tech solutions. As Founder and CEO of EgySyr, Naiem drives innovation through smart strategies that help startups and SMEs succeed.',
      social: { linkedin: 'https://www.linkedin.com/in/naiem-shamyeh/' }
    },
  ]

  const timeline = [
    {
      year: '2019',
      title: 'Company Founded',
      description: 'Started with a vision to transform businesses through technology.'
    },
    {
      year: '2020',
      title: 'First Major Project',
      description: 'Delivered our first enterprise solution for a leading retail company.'
    },
    {
      year: '2021',
      title: 'Team Expansion',
      description: 'Grew our team to 15+ professionals and opened our Cairo office.'
    },
    {
      year: '2022',
      title: 'International Reach',
      description: 'Started serving clients across the Middle East and Europe.'
    },
    {
      year: '2023',
      title: 'Innovation Hub',
      description: 'Launched our innovation lab for cutting-edge technology research.'
    },
    {
      year: '2024',
      title: 'Future Forward',
      description: 'Continuing to push boundaries and deliver exceptional value.'
    }
  ]

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

  const featuredMembers = team.filter(m => /(cob|ceo)/i.test(m.role))
  const otherMembers = team.filter(m => !featuredMembers.includes(m))

  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white">
        {/* Hero Section */}
        <section className="relative pt-32 pb-20 overflow-hidden">
          {/* 3D Background */}
          <div className="absolute inset-0 z-[1] pointer-events-none opacity-60">
            <Canvas camera={{ position: [0, 0, 8], fov: 60 }}>
              <Environment preset="city" />
              <ambientLight intensity={0.3} />
              <directionalLight position={[10, 10, 5]} intensity={0.8} color="#8B5CF6" />
              <directionalLight position={[-10, -10, -10]} intensity={0.5} color="#06B6D4" />

              <Float speed={1.2} rotationIntensity={0.8} floatIntensity={1.2}>
                <Box args={[1, 1, 1]} position={[-3, 2, -1]} rotation={[0.6, 0.8, 0.2]}>
                  <meshStandardMaterial color="#8B5CF6" metalness={0.9} roughness={0.1} />
                </Box>
              </Float>

              <Float speed={1.6} rotationIntensity={0.6} floatIntensity={1.0}>
                <Torus args={[1, 0.3, 16, 80]} position={[3, -1.5, -2]} rotation={[1.1, 0.2, 0]}>
                  <meshStandardMaterial color="#06B6D4" metalness={0.9} roughness={0.1} />
                </Torus>
              </Float>

              <Float speed={1.0} rotationIntensity={0.9} floatIntensity={1.0}>
                <Sphere args={[0.9, 64, 64]} position={[0, -2.5, -2]}>
                  <MeshDistortMaterial color="#EC4899" metalness={0.9} roughness={0.1} distort={0.35} speed={2.2} />
                </Sphere>
              </Float>
            </Canvas>
          </div>

          {/* Background Elements */}
          <div className="absolute inset-0 z-0 bg-gradient-to-b from-jet-black via-deep-charcoal/30 to-jet-black" />
          <div className="absolute inset-0 z-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,92,246,0.12),transparent_50%)]" />
          <div className="absolute inset-0 z-0 bg-[radial-gradient(circle_at_70%_80%,rgba(6,182,212,0.12),transparent_50%)]" />
          
          {/* Floating Elements */}
          <div className="absolute top-20 left-10 w-32 h-32 bg-neon-purple/10 rounded-full blur-3xl animate-pulse" />
          <div className="absolute bottom-20 right-10 w-40 h-40 bg-neon-cyan/10 rounded-full blur-3xl animate-pulse animation-delay-2000" />

          <div className="relative z-10 max-w-7xl mx-auto px-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
              <motion.div
                initial={{ opacity: 0, x: -30 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.8 }}
              >
                <div className="inline-flex items-center px-6 py-3 bg-white/10 text-white border border-white/20 rounded-full text-sm font-medium mb-8 backdrop-blur-sm">
                  <Users className="w-4 h-4 mr-2" />
                  About Us
                </div>
                
                <h1 className="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                  We Build
                  <span className="bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent"> Digital Dreams</span>
                </h1>
                
                <p className="text-xl text-gray-300 mb-8 leading-relaxed">
                  EgySyr is a forward-thinking technology company dedicated to transforming businesses through innovative digital solutions. 
                  We combine creativity, technical expertise, and business acumen to deliver exceptional results.
                </p>

              </motion.div>
            </div>
          </div>
        </section>

        {/* Stats Section */}
        <section className="py-20">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              variants={staggerContainer}
              initial="initial"
              animate="animate"
              className="grid grid-cols-2 md:grid-cols-4 gap-8"
            >
              {stats.map((stat) => (
                <motion.div
                  key={stat.label}
                  variants={fadeInUp}
                  className="text-center group"
                >
                  <div className="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-cyan rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <stat.icon className="w-8 h-8 text-white" />
                  </div>
                  <div className="text-3xl md:text-4xl font-bold text-white mb-2">
                    {stat.number}
                  </div>
                  <p className="text-gray-300 font-medium">{stat.label}</p>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Values Section */}
        <section className="py-20 bg-white/5 border-t border-white/10">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-16"
            >
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
                Our Core Values
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                The principles that guide everything we do and shape our company culture.
              </p>
            </motion.div>

            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-1 md:grid-cols-2 gap-8"
            >
              {values.map((value) => (
                <motion.div
                  key={value.title}
                  variants={fadeInUp}
                  className="group bg-white/5 rounded-3xl p-8 hover:bg-white/10 hover:shadow-xl transition-all duration-300 border border-white/10 backdrop-blur-sm"
                >
                  <div className={`w-16 h-16 bg-gradient-to-r ${value.color} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300`}>
                    <value.icon className="w-8 h-8 text-white" />
                  </div>
                  
                  <h3 className="text-2xl font-bold text-white mb-4">{value.title}</h3>
                  <p className="text-gray-300 leading-relaxed">{value.description}</p>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Team Section */}
        <section className="py-24 relative overflow-hidden">
          {/* Background Accents */}
          <div className="pointer-events-none absolute inset-0">
            <div className="absolute -top-24 -left-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl" />
            <div className="absolute -bottom-24 -right-24 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl" />
          </div>

          <div className="max-w-7xl mx-auto px-6 relative">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-16"
            >
              <span className="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-white/10 text-white border border-white/20 mb-5 backdrop-blur-sm">Our Team</span>
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-4">Leadership & Creators</h2>
              <p className="text-lg text-gray-300 max-w-3xl mx-auto">A small team of world‑class creators, engineers, and strategists building delightful digital experiences.</p>
            </motion.div>

            {/* Featured: Leadership (CEO, CTO) */}
            {featuredMembers.length > 0 && (
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {featuredMembers.map((fm) => (
                  <motion.div
                    key={fm.name}
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.7 }}
                    viewport={{ once: true }}
                    className="relative overflow-hidden rounded-3xl p-8 md:p-10 bg-gradient-to-br from-logo-navy to-logo-indigo text-white border border-white/10 shadow-2xl"
                  >
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                      <div className="flex justify-center">
                        <div className="relative">
                          <img
                            src={fm.image}
                            alt={fm.name}
                            loading="lazy"
                            className="w-40 h-40 rounded-2xl object-cover ring-4 ring-white/20 shadow-2xl"
                            onError={(e) => { (e.currentTarget as HTMLImageElement).src = '/images/icon.webp' }}
                          />
                          <div className="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-white/10 via-transparent to-white/10 blur-lg -z-10" />
                        </div>
                      </div>

                      <div className="md:col-span-2">
                        <div className="flex flex-wrap items-center gap-3 mb-3">
                          <h3 className="text-2xl md:text-3xl font-bold tracking-tight">{fm.name}</h3>
                          <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-sm font-semibold">
                            <Shield className="w-4 h-4" /> {fm.role}
                          </span>
                        </div>
                        <p className="text-blue-100 leading-relaxed mb-6 max-w-2xl">{fm.bio}</p>
                        <div className="flex items-center gap-3">
                          {Object.entries(fm.social).map(([platform, url]) => (
                            <a
                              key={platform}
                              href={url}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 transition-colors"
                            >
                              {platform === 'linkedin' ? (
                                <Linkedin className="w-5 h-5" />
                              ) : platform === 'twitter' ? (
                                <Twitter className="w-5 h-5" />
                              ) : (
                                <Github className="w-5 h-5" />
                              )}
                            </a>
                          ))}
                        </div>
                      </div>
                    </div>

                    {/* Decorative */}
                    <div className="pointer-events-none absolute -top-24 -right-24 w-72 h-72 rounded-full bg-white/10 blur-3xl" />
                  </motion.div>
                ))}
              </div>
            )}

            {/* Team Grid */}
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
            >
              {otherMembers.map((member) => (
                <motion.div
                  key={member.name}
                  variants={fadeInUp}
                  className="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm hover:shadow-xl transition-all duration-300"
                >
                  <div className="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-blue-50 to-purple-50" />
                  <div className="relative p-6">
                    <div className="flex items-center gap-4 mb-5">
                      <img
                        src={member.image}
                        alt={member.name}
                        loading="lazy"
                        className="w-16 h-16 rounded-xl object-cover ring-2 ring-blue-100"
                        onError={(e) => { (e.currentTarget as HTMLImageElement).src = '/images/icon.webp' }}
                      />
                      <div>
                        <h4 className="text-lg font-semibold text-gray-900">{member.name}</h4>
                        <p className="text-sm font-medium bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{member.role}</p>
                      </div>
                  </div>
                  
                    <p className="text-gray-600 text-sm leading-relaxed mb-5">{member.bio}</p>
                  
                    <div className="flex items-center gap-3">
                    {Object.entries(member.social).map(([platform, url]) => (
                      <a
                        key={platform}
                        href={url}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-200 text-gray-600 hover:border-blue-500 hover:text-blue-600 hover:shadow-sm transition-colors"
                      >
                          {platform === 'linkedin' ? (
                            <Linkedin className="w-4.5 h-4.5" />
                          ) : platform === 'twitter' ? (
                            <Twitter className="w-4.5 h-4.5" />
                          ) : (
                            <Github className="w-4.5 h-4.5" />
                          )}
                      </a>
                    ))}
                    </div>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Timeline Section */}
        <section className="py-20 bg-white/5 border-t border-white/10">
          <div className="max-w-6xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center mb-16"
            >
              <h2 className="text-4xl md:text-5xl font-bold text-white mb-6">
                Our Journey
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                From humble beginnings to becoming a trusted technology partner.
              </p>
            </motion.div>

            <div className="relative">
              {/* Timeline line */}
              <div className="absolute left-1/2 transform -translate-x-px w-0.5 h-full bg-gradient-to-b from-blue-600 to-purple-600" />
              
              <motion.div
                variants={staggerContainer}
                initial="initial"
                whileInView="animate"
                viewport={{ once: true }}
                className="space-y-12"
              >
                {timeline.map((item) => (
                  <motion.div
                    key={item.year}
                    variants={fadeInUp}
                    className={`relative flex items-center ${
                      timeline.indexOf(item) % 2 === 0 ? 'flex-row' : 'flex-row-reverse'
                    }`}
                  >
                    {/* Timeline dot */}
                    <div className="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full border-4 border-white shadow-lg" />
                    
                    {/* Content */}
                    <div className={`w-5/12 ${timeline.indexOf(item) % 2 === 0 ? 'pr-8 text-right' : 'pl-8 text-left'}`}>
                      <div className="bg-white/5 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-white/10">
                        <div className="text-2xl font-bold text-neon-purple mb-2">{item.year}</div>
                        <h3 className="text-xl font-bold text-white mb-2">{item.title}</h3>
                        <p className="text-gray-300">{item.description}</p>
                      </div>
                    </div>
                  </motion.div>
                ))}
              </motion.div>
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="py-20 bg-gradient-to-r from-neon-purple to-electric-blue relative overflow-hidden">
          {/* Background Elements */}
          <div className="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(255,255,255,0.1),transparent_50%)]" />
          <div className="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(255,255,255,0.1),transparent_50%)]" />
          
          <div className="relative max-w-4xl mx-auto px-6 text-center text-white">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-4xl md:text-5xl font-bold mb-6">
                Ready to Work Together?
              </h2>
              
              <p className="text-xl text-white/90 mb-8 leading-relaxed">
                Let's discuss your project and explore how we can help bring your vision to life.
              </p>
              
              <div className="flex flex-col sm:flex-row gap-4 justify-center">
                <Link href="/contact">
                  <motion.button
                    whileHover={{ scale: 1.05 }}
                    className="px-8 py-4 bg-white text-neon-purple font-semibold rounded-full hover:shadow-xl transition-all duration-300"
                  >
                    Start Your Project
                  </motion.button>
                </Link>
                
                <Link href="/contact">
                  <motion.button
                    whileHover={{ scale: 1.05 }}
                    className="px-4 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-neon-purple transition-all duration-300"
                  >
                    Get in Touch
                  </motion.button>
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

export default AboutPage
