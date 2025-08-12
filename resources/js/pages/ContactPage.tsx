import React, { useState } from 'react'
import { motion } from 'framer-motion'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'

const ContactPage: React.FC = () => {
  const [form, setForm] = useState({ name: '', email: '', subject: '', message: '' })
  const [status, setStatus] = useState<'idle' | 'submitting' | 'success' | 'error'>('idle')
  const [errors, setErrors] = useState<{ [k: string]: string }>({})

  const submit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('submitting')
    setErrors({})
    try {
      const res = await fetch('/api/contact', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify(form),
      })
      if (!res.ok) {
        const data = await res.json().catch(() => ({}))
        if (data.errors) setErrors(Object.fromEntries(Object.entries(data.errors).map(([k, v]) => [k, (v as any)[0]])))
        throw new Error('Failed')
      }
      setStatus('success')
      setForm({ name: '', email: '', subject: '', message: '' })
    } catch {
      setStatus('error')
    }
  }

  return (
    <PageTransition>
      <div className="min-h-screen pt-24 pb-16">
        {/* Hero Section */}
        <section className="relative py-20 overflow-hidden">
          <div className="max-w-7xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              className="mb-8"
            >
              <span className="inline-block px-4 py-2 bg-neon-purple/20 backdrop-blur-sm border border-neon-purple/30 rounded-full text-neon-purple text-sm font-medium mb-6">
                Contact Us
              </span>
            </motion.div>

            <motion.h1
              className="text-5xl md:text-7xl font-bold mb-8 leading-tight"
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
            >
              Let's Build Something{' '}
              <span className="bg-neon-gradient bg-clip-text text-transparent">
                Extraordinary
              </span>
            </motion.h1>

            <motion.p
              className="text-xl text-gray-300 max-w-3xl mx-auto"
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.4 }}>
              Ready to get started? Fill out the form below and we'll be in touch shortly.
            </motion.p>
          </div>
        </section>

        {/* Contact Form */}
        <section className="py-12">
          <div className="max-w-4xl mx-auto px-6">
            <motion.div
              className="p-8 md:p-12 bg-gradient-to-br from-deep-charcoal/50 to-jet-black/50 backdrop-blur-sm border border-neon-purple/20 rounded-3xl"
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <form className="space-y-6" onSubmit={submit}>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">Name</label>
                    <input type="text" className={`w-full px-6 py-4 bg-deep-charcoal/50 border ${errors.name ? 'border-red-500/60' : 'border-neon-purple/30'} rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20`} placeholder="Your name" value={form.name} onChange={e => setForm({ ...form, name: e.target.value })} />
                    {errors.name && <p className="text-sm text-red-400 mt-1">{errors.name}</p>}
                  </div>
                  <div>
                    <label className="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" className={`w-full px-6 py-4 bg-deep-charcoal/50 border ${errors.email ? 'border-red-500/60' : 'border-neon-purple/30'} rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20`} placeholder="you@example.com" value={form.email} onChange={e => setForm({ ...form, email: e.target.value })} />
                    {errors.email && <p className="text-sm text-red-400 mt-1">{errors.email}</p>}
                  </div>
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">Subject</label>
                  <input type="text" className={`w-full px-6 py-4 bg-deep-charcoal/50 border ${errors.subject ? 'border-red-500/60' : 'border-neon-purple/30'} rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20`} placeholder="How can we help?" value={form.subject} onChange={e => setForm({ ...form, subject: e.target.value })} />
                  {errors.subject && <p className="text-sm text-red-400 mt-1">{errors.subject}</p>}
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-300 mb-2">Message</label>
                  <textarea rows={6} className={`w-full px-6 py-4 bg-deep-charcoal/50 border ${errors.message ? 'border-red-500/60' : 'border-neon-purple/30'} rounded-xl text-white placeholder-gray-400 focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20`} placeholder="Tell us about your project" value={form.message} onChange={e => setForm({ ...form, message: e.target.value })} />
                  {errors.message && <p className="text-sm text-red-400 mt-1">{errors.message}</p>}
                </div>

                <div className="flex items-center justify-between">
                  <div className="text-sm text-gray-400">We'll get back to you within 24 hours.</div>

                  <motion.button type="submit" className="group relative px-8 py-4 bg-neon-gradient text-white font-semibold rounded-full text-lg overflow-hidden" data-cursor="magnetic" whileHover={{ scale: 1.05, y: -2 }} disabled={status === 'submitting'}>
                    <span className="relative z-10">{status === 'submitting' ? 'Sending...' : status === 'success' ? 'Sent!' : 'Send Message'}</span>
                    <motion.div className="absolute inset-0 bg-gradient-to-r from-neon-pink to-electric-blue" initial={{ x: '-100%' }} whileHover={{ x: 0 }} transition={{ duration: 0.3 }} />
                    <div className="absolute inset-0 bg-neon-gradient opacity-50 blur-xl group-hover:opacity-75 transition-opacity duration-300" />
                  </motion.button>
                </div>
              </form>

              {/* Floating background */}
              <div className="absolute inset-0 pointer-events-none -z-10">
                <div className="absolute -top-20 -left-20 w-80 h-80 bg-neon-purple/20 rounded-full blur-3xl" />
                <div className="absolute -bottom-20 -right-20 w-80 h-80 bg-neon-cyan/20 rounded-full blur-3xl" />
              </div>
            </motion.div>
          </div>
        </section>
      </div>
      <Footer />
    </PageTransition>
  )
}

export default ContactPage
