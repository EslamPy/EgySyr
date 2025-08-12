import React from 'react'
import { motion } from 'framer-motion'
import { FileText, Scale, Shield, AlertTriangle, Users, Calendar, Mail } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'

const TermsOfServicePage: React.FC = () => {
  const sections = [
    {
      title: 'Acceptance of Terms',
      icon: FileText,
      content: [
        {
          subtitle: 'Agreement to Terms',
          text: 'By accessing and using our website and services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.'
        },
        {
          subtitle: 'Modifications',
          text: 'We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting. Your continued use of the service constitutes acceptance of the modified terms.'
        },
        {
          subtitle: 'Eligibility',
          text: 'You must be at least 18 years old to use our services. By using our services, you represent and warrant that you meet this age requirement.'
        }
      ]
    },
    {
      title: 'Use of Services',
      icon: Users,
      content: [
        {
          subtitle: 'Permitted Use',
          text: 'You may use our services for lawful purposes only. You agree not to use the service in any way that violates any applicable federal, state, local, or international law or regulation.'
        },
        {
          subtitle: 'Account Responsibility',
          text: 'You are responsible for safeguarding the password and for maintaining the confidentiality of your account. You agree to accept responsibility for all activities that occur under your account.'
        },
        {
          subtitle: 'Prohibited Activities',
          text: 'You may not use our services to transmit, distribute, or store material that is unlawful, harmful, threatening, abusive, harassing, defamatory, vulgar, obscene, or otherwise objectionable.'
        }
      ]
    },
    {
      title: 'Intellectual Property',
      icon: Shield,
      content: [
        {
          subtitle: 'Our Content',
          text: 'The service and its original content, features, and functionality are and will remain the exclusive property of EgySyr and its licensors. The service is protected by copyright, trademark, and other laws.'
        },
        {
          subtitle: 'User Content',
          text: 'You retain ownership of any intellectual property rights that you hold in content that you submit to us. However, by submitting content, you grant us a worldwide, non-exclusive, royalty-free license to use, reproduce, and distribute such content.'
        },
        {
          subtitle: 'Trademark Policy',
          text: 'All trademarks, service marks, and logos used on our website are trademarks or registered trademarks of their respective owners. You may not use these marks without prior written permission.'
        }
      ]
    },
    {
      title: 'Limitation of Liability',
      icon: AlertTriangle,
      content: [
        {
          subtitle: 'Service Availability',
          text: 'We strive to provide uninterrupted service, but we do not guarantee that our services will be available at all times. We may experience hardware, software, or other problems that could lead to interruptions, delays, or errors.'
        },
        {
          subtitle: 'Disclaimer of Warranties',
          text: 'Our services are provided "as is" and "as available" without any warranties of any kind, either express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, or non-infringement.'
        },
        {
          subtitle: 'Limitation of Damages',
          text: 'In no event shall EgySyr be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.'
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
            <div className="absolute top-20 left-20 w-96 h-96 bg-electric-blue/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute bottom-20 right-20 w-80 h-80 bg-neon-pink/10 rounded-full blur-3xl animate-pulse" />
            <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-neon-purple/5 rounded-full blur-3xl" />
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
                <Scale className="w-4 h-4 mr-3" />
                Legal Agreement
              </motion.div>

              <motion.h1
                className="text-6xl md:text-7xl font-black leading-tight mb-8"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.2 }}
              >
                Terms of{' '}
                <span className="bg-gradient-to-r from-electric-blue via-neon-cyan to-neon-purple bg-clip-text text-transparent">
                  Service
                </span>
              </motion.h1>

              <motion.p
                className="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed mb-8"
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 1, delay: 0.4 }}
              >
                These terms and conditions outline the rules and regulations for the use of EgySyr's website and services. Please read them carefully before using our platform.
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
                      className="absolute inset-0 bg-gradient-to-br from-electric-blue/5 via-neon-cyan/5 to-neon-purple/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    />

                    {/* Section Header */}
                    <div className="relative flex items-center gap-6 mb-8">
                      <motion.div 
                        className="w-16 h-16 bg-gradient-to-br from-electric-blue to-neon-purple rounded-2xl flex items-center justify-center relative overflow-hidden"
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

                      <h2 className="text-4xl font-black text-white group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-neon-purple group-hover:bg-clip-text transition-all duration-300">
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
                          className="absolute w-1 h-1 bg-gradient-to-r from-electric-blue to-neon-purple rounded-full opacity-0 group-hover:opacity-60"
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

        {/* Additional Terms Section */}
        <section className="py-32 relative overflow-hidden bg-gradient-to-b from-deep-charcoal/30 to-jet-black">
          <div className="absolute inset-0">
            <div className="absolute top-20 right-20 w-72 h-72 bg-neon-cyan/10 rounded-full blur-3xl" />
            <div className="absolute bottom-20 left-20 w-80 h-80 bg-neon-purple/10 rounded-full blur-3xl" />
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
                Additional{' '}
                <span className="bg-gradient-to-r from-neon-cyan to-neon-purple bg-clip-text text-transparent">
                  Terms
                </span>
              </h2>
              <p className="text-xl text-gray-300 max-w-3xl mx-auto">
                Important additional terms and conditions that govern your use of our services.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              {[
                {
                  title: 'Termination',
                  description: 'We may terminate or suspend your account and access to our services immediately, without prior notice, for any reason whatsoever, including breach of these terms.',
                  icon: AlertTriangle
                },
                {
                  title: 'Governing Law',
                  description: 'These terms shall be interpreted and governed by the laws of Egypt, without regard to its conflict of law provisions.',
                  icon: Scale
                },
                {
                  title: 'Privacy Policy',
                  description: 'Your privacy is important to us. Please review our Privacy Policy, which also governs your use of our services.',
                  icon: Shield
                },
                {
                  title: 'Contact Information',
                  description: 'If you have any questions about these Terms of Service, please contact us at ahmed@egysyr.com.',
                  icon: Mail
                }
              ].map((term, index) => (
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
                      className="absolute inset-0 bg-gradient-to-br from-electric-blue/10 via-neon-cyan/10 to-neon-purple/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    />

                    <motion.div
                      className="w-12 h-12 bg-gradient-to-br from-electric-blue to-neon-purple rounded-xl mb-6 flex items-center justify-center relative overflow-hidden"
                      whileHover={{ rotate: 360 }}
                      transition={{ duration: 0.8 }}
                    >
                      <term.icon className="w-6 h-6 text-white relative z-10" />
                    </motion.div>

                    <h3 className="text-xl font-bold text-white mb-4 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-electric-blue group-hover:to-neon-purple group-hover:bg-clip-text transition-all duration-300">
                      {term.title}
                    </h3>

                    <p className="text-gray-400 leading-relaxed group-hover:text-gray-300 transition-colors duration-300">
                      {term.description}
                    </p>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        {/* Important Notice Section */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 via-electric-blue/20 to-neon-cyan/20" />

          <div className="relative max-w-4xl mx-auto px-6">
            <motion.div
              className="text-center mb-12"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl md:text-6xl font-black mb-8 leading-tight text-white">
                Important{' '}
                <span className="bg-gradient-to-r from-electric-blue via-neon-cyan to-neon-purple bg-clip-text text-transparent">
                  Notice
                </span>
              </h2>

              <div className="relative p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden">
                <motion.div
                  className="absolute inset-0 bg-gradient-to-br from-electric-blue/5 via-neon-cyan/5 to-neon-purple/5"
                />

                <div className="relative">
                  <div className="flex items-center justify-center mb-6">
                    <motion.div
                      className="w-16 h-16 bg-gradient-to-br from-electric-blue to-neon-purple rounded-2xl flex items-center justify-center"
                      whileHover={{ rotate: 360 }}
                      transition={{ duration: 0.8 }}
                    >
                      <AlertTriangle className="w-8 h-8 text-white" />
                    </motion.div>
                  </div>

                  <p className="text-xl text-gray-300 leading-relaxed mb-8">
                    By using our services, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service. If you do not agree with any part of these terms, you must not use our services.
                  </p>

                  <p className="text-lg text-gray-400 leading-relaxed">
                    These terms constitute the entire agreement between you and EgySyr regarding the use of our services and supersede all prior agreements and understandings.
                  </p>
                </div>
              </div>
            </motion.div>

            <motion.div
              className="text-center"
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              viewport={{ once: true }}
            >
              <motion.a
                href="mailto:ahmed@egysyr.com"
                className="group relative inline-flex items-center gap-3 px-12 py-4 bg-gradient-to-r from-logo-blue via-logo-indigo to-logo-navy text-white font-bold text-lg rounded-full overflow-hidden shadow-2xl"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
              >
                <span className="relative z-10 flex items-center gap-3">
                  <Mail className="w-5 h-5" />
                  Questions? Contact Us
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

export default TermsOfServicePage
