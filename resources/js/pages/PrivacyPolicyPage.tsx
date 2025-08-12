import React from 'react'
import { motion } from 'framer-motion'
import { Shield, Eye, Lock, Users, Globe, FileText, Calendar, Mail } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'

const PrivacyPolicyPage: React.FC = () => {
  const sections = [
    {
      title: 'Information We Collect',
      icon: Eye,
      content: [
        {
          subtitle: 'Personal Information',
          text: 'We collect information you provide directly to us, such as when you create an account, contact us, or use our services. This may include your name, email address, phone number, and company information.'
        },
        {
          subtitle: 'Usage Information',
          text: 'We automatically collect information about how you use our website and services, including your IP address, browser type, operating system, and pages visited.'
        },
        {
          subtitle: 'Cookies and Tracking',
          text: 'We use cookies and similar technologies to enhance your experience, analyze usage patterns, and provide personalized content.'
        }
      ]
    },
    {
      title: 'How We Use Your Information',
      icon: Users,
      content: [
        {
          subtitle: 'Service Provision',
          text: 'We use your information to provide, maintain, and improve our services, process transactions, and communicate with you about your account.'
        },
        {
          subtitle: 'Communication',
          text: 'We may use your contact information to send you updates, newsletters, marketing materials, and other information that may be of interest to you.'
        },
        {
          subtitle: 'Analytics and Improvement',
          text: 'We analyze usage patterns to understand how our services are used and to improve functionality and user experience.'
        }
      ]
    },
    {
      title: 'Information Sharing',
      icon: Globe,
      content: [
        {
          subtitle: 'Service Providers',
          text: 'We may share your information with third-party service providers who assist us in operating our website and providing our services.'
        },
        {
          subtitle: 'Legal Requirements',
          text: 'We may disclose your information if required by law, regulation, or legal process, or to protect our rights and the safety of our users.'
        },
        {
          subtitle: 'Business Transfers',
          text: 'In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of the transaction.'
        }
      ]
    },
    {
      title: 'Data Security',
      icon: Lock,
      content: [
        {
          subtitle: 'Security Measures',
          text: 'We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.'
        },
        {
          subtitle: 'Data Retention',
          text: 'We retain your personal information only for as long as necessary to fulfill the purposes outlined in this policy or as required by law.'
        },
        {
          subtitle: 'International Transfers',
          text: 'Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place for such transfers.'
        }
      ]
    }
  ]

  const lastUpdated = 'December 15, 2024'

  return (
    <PageTransition>
      <div className="relative bg-jet-black text-white overflow-hidden">
        {/* Hero Section */}
        <section className="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-jet-black via-deep-charcoal/50 to-jet-black">
          {/* Background Effects */}
          <div className="absolute inset-0">
            <div className="absolute top-20 left-20 w-96 h-96 bg-neon-purple/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-cyan/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-neon-pink/5 rounded-full blur-3xl" />
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
                <Shield className="w-4 h-4 mr-3" />
                Your Privacy Matters
              </motion.div>

              <motion.h1
                className="text-6xl md:text-7xl font-black leading-tight mb-8"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.2 }}
              >
                Privacy{' '}
                <span className="bg-gradient-to-r from-neon-pink via-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Policy
                </span>
              </motion.h1>

              <motion.p
                className="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-8"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.4 }}
              >
                We are committed to protecting your privacy and ensuring the security of your personal information. This policy explains how we collect, use, and safeguard your data.
              </motion.p>

              <motion.div
                className="flex items-center justify-center gap-2 text-gray-400"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.6 }}
              >
                <Calendar className="w-4 h-4" />
                <span>Last updated: {lastUpdated}</span>
              </motion.div>
            </motion.div>
          </div>
        </section>

        {/* Content Sections */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-b from-jet-black via-deep-charcoal/20 to-jet-black" />
          
          <div className="relative max-w-5xl mx-auto px-6">
            <div className="space-y-20">
              {sections.map((section, index) => (
                <motion.div
                  key={index}
                  className="group relative"
                  initial={{ opacity: 0, y: 50 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.8, delay: index * 0.1 }}
                  viewport={{ once: true }}
                >
                  <div className="relative p-10 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-500 overflow-hidden">
                    {/* Animated Background */}
                    <motion.div
                      className="absolute inset-0 bg-gradient-to-br from-neon-purple/5 via-neon-pink/5 to-neon-cyan/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    />

                    {/* Section Header */}
                    <div className="relative flex items-center gap-6 mb-8">
                      <motion.div 
                        className="w-16 h-16 bg-gradient-to-br from-neon-purple to-neon-cyan rounded-2xl flex items-center justify-center relative overflow-hidden"
                        whileHover={{ rotate: 360 }}
                        transition={{ duration: 0.8 }}
                      >
                        <section.icon className="w-8 h-8 text-white relative z-10" />
                        <motion.div
                          className="absolute inset-0 bg-white/20 rounded-2xl"
                          animate={{ rotate: [0, 360] }}
                          transition={{ duration: 10, repeat: Infinity, ease: "linear" }}
                        />
                      </motion.div>

                      <h2 className="text-4xl font-black text-white group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-pink group-hover:to-neon-cyan group-hover:bg-clip-text transition-all duration-300">
                        {section.title}
                      </h2>
                    </div>

                    {/* Section Content */}
                    <div className="relative space-y-8">
                      {section.content.map((item, itemIndex) => (
                        <motion.div
                          key={itemIndex}
                          className="relative"
                          initial={{ opacity: 0, x: -20 }}
                          whileInView={{ opacity: 1, x: 0 }}
                          transition={{ duration: 0.6, delay: itemIndex * 0.1 }}
                          viewport={{ once: true }}
                        >
                          <h3 className="text-xl font-bold text-white mb-3 group-hover:text-gray-100 transition-colors duration-300">
                            {item.subtitle}
                          </h3>
                          <p className="text-gray-400 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                            {item.text}
                          </p>
                        </motion.div>
                      ))}
                    </div>

                    {/* Floating Particles */}
                    <div className="absolute inset-0 overflow-hidden pointer-events-none">
                      {Array.from({ length: 5 }).map((_, i) => (
                        <motion.div
                          key={i}
                          className="absolute w-1 h-1 bg-gradient-to-r from-neon-purple to-neon-cyan rounded-full opacity-0 group-hover:opacity-60"
                          style={{
                            left: `${Math.random() * 100}%`,
                            top: `${Math.random() * 100}%`,
                          }}
                          animate={{
                            y: [0, -40, 0],
                            x: [0, Math.random() * 20 - 10, 0],
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
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        {/* Your Rights Section */}
        <section className="py-32 relative overflow-hidden bg-gradient-to-b from-deep-charcoal/30 to-jet-black">
          <div className="absolute inset-0">
            <div className="absolute top-20 right-20 w-72 h-72 bg-neon-pink/10 rounded-full blur-3xl" />
            <div className="absolute bottom-20 left-20 w-80 h-80 bg-electric-blue/10 rounded-full blur-3xl" />
          </div>

          <div className="relative max-w-5xl mx-auto px-6">
            <motion.div
              className="text-center mb-16"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-6 leading-tight text-white">
                Your{' '}
                <span className="bg-gradient-to-r from-neon-cyan to-electric-blue bg-clip-text text-transparent">
                  Rights
                </span>
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                You have certain rights regarding your personal information. Here's what you can do:
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {[
                {
                  title: 'Access Your Data',
                  description: 'Request a copy of the personal information we hold about you.',
                  icon: FileText
                },
                {
                  title: 'Correct Information',
                  description: 'Update or correct any inaccurate personal information.',
                  icon: Users
                },
                {
                  title: 'Delete Your Data',
                  description: 'Request deletion of your personal information, subject to legal requirements.',
                  icon: Lock
                },
                {
                  title: 'Data Portability',
                  description: 'Receive your personal information in a structured, machine-readable format.',
                  icon: Globe
                }
              ].map((right, index) => (
                <motion.div
                  key={index}
                  className="group relative"
                  initial={{ opacity: 0, scale: 0.9 }}
                  whileInView={{ opacity: 1, scale: 1 }}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  viewport={{ once: true }}
                  whileHover={{ y: -8, scale: 1.02 }}
                >
                  <div className="relative p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl group-hover:bg-white/10 group-hover:border-white/20 transition-all duration-500 overflow-hidden">
                    <motion.div
                      className="absolute inset-0 bg-gradient-to-br from-neon-purple/10 via-neon-pink/10 to-neon-cyan/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    />

                    <motion.div
                      className="w-12 h-12 bg-gradient-to-br from-neon-purple to-neon-cyan rounded-xl mb-6 flex items-center justify-center relative overflow-hidden"
                      whileHover={{ rotate: 360 }}
                      transition={{ duration: 0.8 }}
                    >
                      <right.icon className="w-6 h-6 text-white relative z-10" />
                    </motion.div>

                    <h3 className="text-xl font-bold text-white mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-pink group-hover:to-neon-cyan group-hover:bg-clip-text transition-all duration-300">
                      {right.title}
                    </h3>

                    <p className="text-gray-400 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                      {right.description}
                    </p>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        {/* Contact Section */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 via-neon-pink/20 to-neon-cyan/20" />

          <div className="relative max-w-4xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-8 leading-tight text-white">
                Questions About{' '}
                <span className="bg-gradient-to-r from-neon-pink via-neon-purple to-neon-cyan bg-clip-text text-transparent">
                  Privacy?
                </span>
              </h2>

              <p className="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed mb-12">
                If you have any questions about this Privacy Policy or how we handle your personal information, please don't hesitate to contact us.
              </p>

              <motion.a
                href="mailto:ahmed@egysyr.com"
                className="group relative inline-flex items-center gap-3 px-12 py-4 bg-gradient-to-r from-logo-blue via-logo-indigo to-logo-navy text-white font-bold text-lg rounded-full overflow-hidden shadow-2xl"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
              >
                <span className="relative z-10 flex items-center gap-3">
                  <Mail className="w-5 h-5" />
                  Contact Us
                </span>
                <motion.div
                  className="absolute inset-0 bg-gradient-to-r from-logo-teal via-logo-emerald to-logo-blue opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                />
              </motion.a>
            </motion.div>
          </div>
        </section>

        <Footer />
      </div>
    </PageTransition>
  )
}

export default PrivacyPolicyPage
