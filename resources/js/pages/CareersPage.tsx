import React, { useState, useEffect, useRef } from 'react'
import { motion } from 'framer-motion'
import { MapPin, Clock, Users, ArrowRight, Star, Award, Coffee, Heart, Globe, Briefcase, GraduationCap, DollarSign, Calendar, Building } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'
import { Link } from 'wouter'

interface Job {
  id: number
  title: string
  slug: string
  description: string
  requirements: string
  location: string
  type: 'full-time' | 'part-time' | 'contract' | 'internship'
  department?: string
  salary_min?: number
  salary_max?: number
  salary_currency: string
  application_deadline?: string
  created_at: string
}

const formatSalary = (job: Job) => {
  if (!job.salary_min && !job.salary_max) return null

  const currency = job.salary_currency || 'USD'
  if (job.salary_min && job.salary_max) {
    return `${currency} ${job.salary_min.toLocaleString()} - ${job.salary_max.toLocaleString()}`
  }
  if (job.salary_min) {
    return `${currency} ${job.salary_min.toLocaleString()}+`
  }
  return `${currency} ${job.salary_max?.toLocaleString()}`
}

const getTypeColor = (type: string) => {
  switch (type) {
    case 'full-time': return 'bg-green-500/20 text-green-400 border-green-500/30'
    case 'part-time': return 'bg-blue-500/20 text-blue-400 border-blue-500/30'
    case 'contract': return 'bg-orange-500/20 text-orange-400 border-orange-500/30'
    case 'internship': return 'bg-purple-500/20 text-purple-400 border-purple-500/30'
    default: return 'bg-gray-500/20 text-gray-400 border-gray-500/30'
  }
}

const CareersPage: React.FC = () => {
  const [jobs, setJobs] = useState<Job[]>([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)
  const openPositionsRef = useRef<HTMLElement>(null)

  const scrollToOpenPositions = () => {
    openPositionsRef.current?.scrollIntoView({ behavior: 'smooth' })
  }

  useEffect(() => {
    const fetchJobs = async () => {
      try {
        const response = await fetch('/api/jobs')
        if (!response.ok) throw new Error('Failed to fetch jobs')

        const data = await response.json()
        setJobs(data)
      } catch (err) {
        setError(err instanceof Error ? err.message : 'Failed to load jobs')
      } finally {
        setLoading(false)
      }
    }

    fetchJobs()
  }, [])

  const values = [
    {
      title: 'Innovation First',
      description: 'We embrace cutting-edge technologies and creative solutions to solve complex problems.',
      gradient: 'from-neon-purple to-neon-pink'
    },
    {
      title: 'Quality Excellence',
      description: 'We deliver exceptional work that exceeds expectations and drives real business value.',
      gradient: 'from-neon-pink to-neon-cyan'
    },
    {
      title: 'Collaborative Spirit',
      description: 'We believe the best results come from diverse teams working together towards common goals.',
      gradient: 'from-neon-cyan to-electric-blue'
    },
    {
      title: 'Continuous Learning',
      description: 'We invest in our growth, staying ahead of industry trends and expanding our capabilities.',
      gradient: 'from-electric-blue to-neon-purple'
    }
  ]

  const benefits = [
    {
      icon: Globe,
      title: 'Remote First',
      description: 'Work from anywhere in the world with flexible hours and async collaboration.'
    },
    {
      icon: Heart,
      title: 'Health & Wellness',
      description: 'Comprehensive health insurance, mental health support, and wellness stipends.'
    },
    {
      icon: GraduationCap,
      title: 'Learning & Growth',
      description: 'Annual learning budget, conference tickets, and mentorship programs.'
    },
    {
      icon: Coffee,
      title: 'Work-Life Balance',
      description: 'Unlimited PTO, flexible schedules, and company-wide mental health days.'
    },
    {
      icon: Award,
      title: 'Competitive Compensation',
      description: 'Top-tier salaries, equity packages, and performance-based bonuses.'
    },
    {
      icon: Users,
      title: 'Amazing Team',
      description: 'Work with talented, passionate people who care about making an impact.'
    }
  ]

  return (
    <PageTransition>
      <div className="relative bg-jet-black text-white overflow-hidden">
        {/* Hero Section */}
        <section className="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-jet-black via-deep-charcoal/50 to-jet-black">
          {/* Background Effects */}
          <div className="absolute inset-0">
            <div className="absolute top-20 left-20 w-96 h-96 bg-neon-purple/15 rounded-full blur-3xl animate-pulse" />
            <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/15 rounded-full blur-3xl animate-pulse" />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-neon-pink/5 rounded-full blur-3xl" />
          </div>

          <div className="relative max-w-6xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 1 }}
            >
              <motion.div
                className="inline-flex items-center px-6 py-3 bg-white/5 backdrop-blur-xl border border-white/10 rounded-full text-white/80 text-sm font-medium mb-8"
                whileHover={{ scale: 1.05 }}
                transition={{ type: "spring", stiffness: 300, damping: 20 }}
              >
                <Briefcase className="w-4 h-4 mr-3" />
                Join Our Team
              </motion.div>

              <motion.h1
                className="text-6xl md:text-8xl font-black leading-tight mb-8"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.2 }}
              >
                Build the{' '}
                <span className="bg-gradient-to-r from-neon-pink via-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Future
                </span>
                {' '}With Us
              </motion.h1>

              <motion.p
                className="text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-12"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.4 }}
              >
                Join a team of passionate innovators creating cutting-edge digital solutions that transform businesses worldwide.
              </motion.p>

              <motion.div
                className="flex flex-col sm:flex-row gap-6 justify-center"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.6 }}
              >
                <motion.button
                  className="group relative px-12 py-4 bg-gradient-to-r from-logo-blue via-logo-indigo to-logo-navy text-white font-bold text-lg rounded-full overflow-hidden shadow-2xl"
                  whileHover={{ scale: 1.05 }}
                  whileTap={{ scale: 0.95 }}
                  onClick={scrollToOpenPositions}
                >
                  <span className="relative z-10 flex items-center gap-3">
                    View Open Positions
                    <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                  </span>
                  <motion.div
                    className="absolute inset-0 bg-gradient-to-r from-logo-teal via-logo-emerald to-logo-blue opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                  />
                </motion.button>
              </motion.div>
            </motion.div>
          </div>
        </section>

        {/* Company Values Section */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-b from-jet-black via-deep-charcoal/20 to-jet-black" />
          
          <div className="relative max-w-7xl mx-auto px-6">
            <motion.div
              className="text-center mb-20"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-6 leading-tight text-white">
                Our{' '}
                <span className="bg-gradient-to-r from-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Values
                </span>
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                The principles that guide everything we do and shape our culture.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {values.map((value, index) => (
                <motion.div
                  key={index}
                  className="group relative"
                  initial={{ opacity: 0, y: 50 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.8, delay: index * 0.2 }}
                  viewport={{ once: true }}
                  whileHover={{ y: -8 }}
                >
                  <div className="relative p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-500 overflow-hidden">
                    <motion.div
                      className={`absolute inset-0 bg-gradient-to-br ${value.gradient} opacity-0 group-hover:opacity-10 transition-opacity duration-500`}
                    />
                    
                    <h3 className="text-2xl font-bold text-white mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-white group-hover:to-gray-300 group-hover:bg-clip-text transition-all duration-300">
                      {value.title}
                    </h3>
                    
                    <p className="text-gray-400 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                      {value.description}
                    </p>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        {/* Benefits Section */}
        <section className="py-32 relative overflow-hidden bg-gradient-to-b from-deep-charcoal/30 to-jet-black">
          <div className="absolute inset-0">
            <div className="absolute top-20 right-20 w-72 h-72 bg-neon-pink/10 rounded-full blur-3xl" />
            <div className="absolute bottom-20 left-20 w-80 h-80 bg-electric-blue/10 rounded-full blur-3xl" />
          </div>

          <div className="relative max-w-7xl mx-auto px-6">
            <motion.div
              className="text-center mb-20"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-6 leading-tight text-white">
                Why{' '}
                <span className="bg-gradient-to-r from-neon-cyan to-electric-blue bg-clip-text text-transparent">
                  Work Here?
                </span>
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                We offer more than just a job - we provide a platform for growth, innovation, and making a real impact.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {benefits.map((benefit, index) => (
                <motion.div
                  key={index}
                  className="group relative"
                  initial={{ opacity: 0, scale: 0.9 }}
                  whileInView={{ opacity: 1, scale: 1 }}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  viewport={{ once: true }}
                  whileHover={{ y: -8, scale: 1.02 }}
                >
                  <div className="relative p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-500 text-center overflow-hidden">
                    {/* Animated Background */}
                    <motion.div
                      className="absolute inset-0 bg-gradient-to-br from-neon-purple/10 via-neon-pink/10 to-neon-cyan/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    />

                    {/* Icon Container */}
                    <motion.div
                      className="w-16 h-16 bg-gradient-to-br from-neon-purple to-neon-cyan rounded-xl mx-auto mb-6 flex items-center justify-center relative overflow-hidden"
                      whileHover={{ rotate: 360 }}
                      transition={{ duration: 0.8 }}
                    >
                      <benefit.icon className="w-8 h-8 text-white relative z-10" />
                      <motion.div
                        className="absolute inset-0 bg-white/20 rounded-xl"
                        animate={{ rotate: [0, 360] }}
                        transition={{ duration: 8, repeat: Infinity, ease: "linear" }}
                      />
                    </motion.div>

                    <h3 className="text-xl font-bold text-white mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-pink group-hover:to-neon-cyan group-hover:bg-clip-text transition-all duration-300">
                      {benefit.title}
                    </h3>

                    <p className="text-gray-400 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                      {benefit.description}
                    </p>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        {/* Job Openings Section */}
        <section ref={openPositionsRef} className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-b from-jet-black via-deep-charcoal/20 to-jet-black" />

          <div className="relative max-w-7xl mx-auto px-6">
            <motion.div
              className="text-center mb-20"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-6 leading-tight text-white">
                Open{' '}
                <span className="bg-gradient-to-r from-neon-pink to-electric-blue bg-clip-text text-transparent">
                  Positions
                </span>
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                Find your next opportunity and join our mission to create exceptional digital experiences.
              </p>
            </motion.div>

            <div className="space-y-6">
              {loading ? (
                <div className="text-center py-12">
                  <div className="animate-spin w-8 h-8 border-2 border-neon-purple border-t-transparent rounded-full mx-auto mb-4"></div>
                  <p className="text-gray-400">Loading job opportunities...</p>
                </div>
              ) : error ? (
                <div className="text-center py-12">
                  <p className="text-red-400 mb-4">{error}</p>
                  <button
                    onClick={() => window.location.reload()}
                    className="px-6 py-2 bg-neon-purple hover:bg-neon-purple/80 text-white rounded-lg transition-colors"
                  >
                    Try Again
                  </button>
                </div>
              ) : jobs.length === 0 ? (
                <div className="text-center py-12">
                  <Briefcase className="w-16 h-16 mx-auto mb-4 text-gray-400" />
                  <h3 className="text-xl font-semibold text-white mb-2">No Open Positions</h3>
                  <p className="text-gray-400">We don't have any open positions at the moment, but we're always looking for talented individuals. Feel free to reach out!</p>
                </div>
              ) : (
                jobs.map((job, index) => (
                <motion.div key={job.slug ?? index} className="group relative" initial={{ opacity: 0, y: 30 }} whileInView={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: index * 0.1 }} viewport={{ once: true }} whileHover={{ y: -4 }}>
                  <div className="relative p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-500 overflow-hidden">
                    <motion.div className="absolute inset-0 bg-gradient-to-r from-neon-purple/5 via-neon-pink/5 to-neon-cyan/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500" />

                    <div className="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                      <div className="flex-1">
                        <div className="flex flex-wrap items-center gap-4 mb-4">
                          <h3 className="text-2xl font-bold text-white group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-pink group-hover:to-neon-cyan group-hover:bg-clip-text transition-all duration-300">
                            {job.title}
                          </h3>
                          <span className="px-3 py-1 bg-neon-purple/20 text-neon-purple text-sm font-medium rounded-full border border-neon-purple/30">
                            {job.department}
                          </span>
                        </div>

                        <p className="text-gray-400 mb-4 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                          {job.description}
                        </p>

                        <div className="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                          <div className="flex items-center gap-2"><MapPin className="w-4 h-4" />{job.location}</div>
                          <div className="flex items-center gap-2"><Clock className="w-4 h-4" />{job.type.replace('-', ' ')}</div>
                          {job.department && (
                            <div className="flex items-center gap-2"><Building className="w-4 h-4" />{job.department}</div>
                          )}
                          {job.application_deadline && (
                            <div className="flex items-center gap-2"><Calendar className="w-4 h-4" />Apply by {new Date(job.application_deadline).toLocaleDateString()}</div>
                          )}
                        </div>

                        {formatSalary(job) && (
                          <div className="text-neon-cyan font-semibold mb-4">{formatSalary(job)}</div>
                        )}
                      </div>

                      <Link href={`/careers/${job.slug}`}>
                        <a className="inline-flex items-center justify-center h-12 px-8 rounded-full bg-gradient-to-r from-neon-purple to-neon-pink text-white font-semibold no-underline shadow-lg hover:shadow-neon-purple/25 transition-transform duration-200 hover:scale-[1.02] focus:outline-none">
                          <span className="flex items-center gap-2">Apply Now<ArrowRight className="w-4 h-4 transition-transform" /></span>
                        </a>
                      </Link>
                    </div>
                  </div>
                </motion.div>
                ))
              )}
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 via-neon-pink/20 to-neon-cyan/20" />

          <div className="relative max-w-6xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-8 leading-tight text-white">
                Ready to{' '}
                <span className="bg-gradient-to-r from-neon-pink via-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Join Us?
                </span>
              </h2>

              <p className="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed mb-12">
                Don't see the perfect role? We're always looking for exceptional talent. Send us your resume and let's start a conversation.
              </p>

              <Link href="/contact">
                <motion.button
                  className="group relative px-12 py-4 bg-gradient-to-r from-logo-blue via-logo-indigo to-logo-navy text-white font-bold text-lg rounded-full overflow-hidden shadow-2xl"
                  whileHover={{ scale: 1.05 }}
                  whileTap={{ scale: 0.95 }}
                >
                  <span className="relative z-10 flex items-center gap-3">
                    Get In Touch
                    <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                  </span>
                  <motion.div
                    className="absolute inset-0 bg-gradient-to-r from-logo-teal via-logo-emerald to-logo-blue opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                  />
                </motion.button>
              </Link>
            </motion.div>
          </div>
        </section>

        <Footer />
      </div>
    </PageTransition>
  )
}

export default CareersPage
