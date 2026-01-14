import React from 'react'
import { motion } from 'framer-motion'
import { ArrowRight, CheckCircle, Sliders, Smartphone, Monitor, Server, Camera, Palette, TrendingUp, Sparkles, Brain, Rocket } from 'lucide-react'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'
import { Link } from 'wouter'


const ServicesPage: React.FC = () => {
  const services = [
    {
      title: 'Web Development',
      description: 'Cutting-edge websites and web applications that push the boundaries of what\'s possible',
      category: 'Development',
      gradient: 'from-neon-purple to-neon-cyan',
      icon: Monitor,
      features: ['Modern Frameworks', 'Performance First', 'SEO Optimized', 'Responsive Design'],
      technologies: ['React', 'Next.js', 'Vue.js', 'Node.js'],
      price: 'Starting from EGP 2,500'
    },
    {
      title: 'Mobile Applications',
      description: 'Native and cross-platform mobile apps that deliver exceptional user experiences',
      category: 'Development',
      gradient: 'from-neon-cyan to-neon-pink',
      icon: Smartphone,
      features: ['iOS & Android', 'Cross-Platform', 'Native Performance', 'App Store Ready'],
      technologies: ['React Native', 'Flutter', 'Swift', 'Kotlin'],
      price: 'Starting from EGP 5,000'
    },
    {
      title: 'Administrative systems',
      description: 'We provide smart, tailor-made administrative systems that enhance productivity, automate processes, and save time and effort',
      category: 'Development',
      gradient: 'from-neon-purple to-neon-cyan',
      icon: Sliders,
      features: ['ERP', 'POS', 'HR', 'Custom system'],
      technologies: ['React Native', 'Flutter', 'Swift', 'Kotlin'],
      price: 'Starting from EGP 5,000'
    },
    // {
    //   title: 'AI & Machine Learning',
    //   description: 'Intelligent solutions that learn, adapt, and evolve with your business needs',
    //   category: 'Enterprise',
    //   gradient: 'from-neon-pink to-electric-blue',
    //   icon: Brain,
    //   features: ['Predictive Analytics', 'Natural Language', 'Computer Vision', 'Automation'],
    //   technologies: ['Python', 'TensorFlow', 'PyTorch', 'OpenAI'],
    //   price: 'Starting from EGP 8,000'
    // },
    // {
    //   title: 'Cloud Infrastructure',
    //   description: 'Scalable cloud solutions that grow with your business and ensure reliability',
    //   category: 'Infrastructure',
    //   gradient: 'from-electric-blue to-neon-purple',
    //   icon: Server,
    //   features: ['AWS & Azure', 'Auto-scaling', '99.9% Uptime', 'Security First'],
    //   technologies: ['AWS', 'Azure', 'Docker', 'Kubernetes'],
    //   price: 'Starting from EGP 15/month'
    // },
    // {
    //   title: 'UI/UX Design',
    //   description: 'Beautiful, intuitive interfaces that users love and businesses trust',
    //   category: 'Creative',
    //   gradient: 'from-neon-cyan to-neon-pink',
    //   icon: Palette,
    //   features: ['User Research', 'Wireframing', 'Prototyping', 'User Testing'],
    //   technologies: ['Figma', 'Adobe XD', 'Sketch', 'InVision'],
    //   price: 'Starting from EGP 500'
    // },
    // {
    //   title: 'Digital Marketing',
    //   description: 'Data-driven marketing strategies that convert visitors into loyal customers',
    //   category: 'Marketing',
    //   gradient: 'from-neon-pink to-electric-blue',
    //   icon: TrendingUp,
    //   features: ['SEO & SEM', 'Social Media', 'Content Strategy', 'Analytics'],
    //   technologies: ['Google Ads', 'Facebook Ads', 'Google Analytics', 'HubSpot'],
    //   price: 'Starting from EGP 1,000/month'
    // }
  ]

  const filteredServices = services

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

  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white">
        {/* Hero Section */}
        <section className="relative pt-32 pb-12 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/10 via-neon-cyan/10 to-neon-pink/10" />
          
          {/* Animated Background Elements */}
          <motion.div
            animate={{ rotate: 360 }}
            transition={{ duration: 60, repeat: Infinity, ease: "linear" }}
            className="absolute inset-0 opacity-5"
          >
            <div className="absolute top-20 left-20 w-96 h-96 bg-neon-purple rounded-full blur-3xl" />
            <div className="absolute bottom-20 right-20 w-96 h-96 bg-neon-cyan rounded-full blur-3xl" />
          </motion.div>
          
          <div className="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
            >
              <div className="inline-flex items-center px-6 py-3 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-sm font-medium mb-8 backdrop-blur-sm">
                <Sparkles className="w-4 h-4 mr-2" />
                Our Services
              </div>
              
              <h1 className="text-5xl lg:text-7xl font-bold mb-8">
                <span className="text-white">Services That</span>{' '}
                <span className="bg-gradient-to-r from-neon-purple via-neon-cyan to-neon-pink bg-clip-text text-transparent">
                  Transform
                </span>
              </h1>
              
              <p className="text-xl lg:text-2xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                From concept to reality, we craft digital experiences that leave lasting impressions and drive real business results.
              </p>

              {/* Hero Content Additions */}
              <motion.div
                initial={{ opacity: 0, y: 25 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.2, duration: 0.8 }}
                className="mt-8 flex flex-col items-center gap-6"
              >
                {/* Feature chips */}
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-4xl">
                  <div className="flex items-center justify-center gap-3 px-4 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <CheckCircle className="w-5 h-5 text-neon-cyan" />
                    <span className="text-sm text-gray-200">Fast Delivery</span>
                  </div>
                  <div className="flex items-center justify-center gap-3 px-4 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <CheckCircle className="w-5 h-5 text-neon-pink" />
                    <span className="text-sm text-gray-200">Transparent Pricing</span>
                  </div>
                  <div className="flex items-center justify-center gap-3 px-4 py-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                    <CheckCircle className="w-5 h-5 text-neon-purple" />
                    <span className="text-sm text-gray-200">Dedicated Support</span>
                  </div>
                </div>


                {/* Trusted by avatars */}
                <div className="flex items-center gap-4">
                  {/* <div className="flex -space-x-3">
                    <img src="/images/icon.webp" alt="Client" className="w-10 h-10 rounded-full ring-2 ring-white/10 object-cover" />
                    <img src="/images/naiem.webp" alt="Client" className="w-10 h-10 rounded-full ring-2 ring-white/10 object-cover" />
                    <img src="/images/ezz (2).webp" alt="Client" className="w-10 h-10 rounded-full ring-2 ring-white/10 object-cover" />
                    <div className="w-10 h-10 rounded-full bg-gradient-to-br from-neon-purple to-neon-cyan text-white text-xs font-semibold flex items-center justify-center ring-2 ring-white/10">+120</div>
                  </div> */}
                  {/* <span className="text-sm text-gray-300">Trusted by 120+ businesses</span> */}
                </div>
              </motion.div>
            </motion.div>
          </div>
        </section>

        {/* Pricing Overview */}
        <section className="py-8 relative">
          <div className="max-w-5xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="text-center"
            >
              <div className="inline-flex items-center px-5 py-2 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-sm font-semibold mb-4 backdrop-blur-sm">
                Pricing
              </div>
              <h2 className="text-4xl lg:text-5xl font-bold mb-3">
                <span className="text-white">Simple,</span>{' '}
                <span className="bg-gradient-to-r from-neon-purple via-neon-cyan to-neon-pink bg-clip-text text-transparent">Transparent Pricing</span>
              </h2>
              <div className="mx-auto w-24 h-1 rounded-full bg-gradient-to-r from-neon-purple via-neon-cyan to-neon-pink mb-5" />
              <p className="text-lg text-gray-300 max-w-3xl mx-auto">
                Choose the package that fits your project. No hidden fees. Fully customizable to your needs.
              </p>
              <div className="mt-6 flex flex-wrap justify-center gap-3">
                <div className="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                  <CheckCircle className="w-4 h-4 text-neon-cyan" />
                  <span className="text-sm text-gray-200">No hidden fees</span>
                </div>
                <div className="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                  <CheckCircle className="w-4 h-4 text-neon-pink" />
                  <span className="text-sm text-gray-200">Fully customizable</span>
                </div>
                <div className="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                  <CheckCircle className="w-4 h-4 text-neon-purple" />
                  <span className="text-sm text-gray-200">Flexible scope</span>
                </div>
              </div>
            </motion.div>
          </div>
        </section>

    {/* See if Ahmed Likes it or not */}
        {/* Pricing Plans
        <section className="pt-4 pb-12 relative">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-1 md:grid-cols-3 gap-8"
            >
              {[
                {
                  name: 'Starter',
                  price: '$499',
                  cadence: 'one-time',
                  highlight: 'Best for landing pages',
                  features: ['1 page design', 'Responsive layout', 'Basic SEO', '1 revision'],
                  gradient: 'from-neon-purple to-neon-cyan'
                },
                {
                  name: 'Professional',
                  price: '$1,999',
                  cadence: 'one-time',
                  highlight: 'Most popular for SMBs',
                  features: ['Up to 8 pages', 'CMS integration', 'Performance optimization', '3 revisions'],
                  gradient: 'from-neon-cyan to-neon-pink'
                },
                {
                  name: 'Enterprise',
                  price: 'Custom',
                  cadence: 'per project',
                  highlight: 'For complex solutions',
                  features: ['Unlimited pages', 'Custom features', 'Cloud & DevOps', 'Dedicated PM'],
                  gradient: 'from-electric-blue to-neon-purple'
                }
              ].map((plan, index) => (
                <motion.div
                  key={plan.name}
                  variants={fadeInUp}
                  transition={{ delay: index * 0.1 }}
                  className="group relative"
                >
                  <div className="relative p-8 rounded-3xl bg-gradient-to-br from-deep-charcoal to-jet-black border border-white/10 backdrop-blur-sm hover:border-neon-purple/50 transition-all duration-500 overflow-hidden">
                    <div className={`absolute inset-0 bg-gradient-to-br ${plan.gradient} opacity-0 group-hover:opacity-10 transition-opacity duration-500`} />
                    <div className="relative">
                      <h3 className="text-2xl font-bold text-white mb-2">{plan.name}</h3>
                      <p className="text-sm text-gray-400 mb-6">{plan.highlight}</p>
                      <div className="flex items-end gap-2 mb-6">
                        <span className="text-4xl font-extrabold text-white">{plan.price}</span>
                        <span className="text-sm text-gray-400">{plan.cadence}</span>
                      </div>
                      <ul className="space-y-3 mb-8">
                        {plan.features.map((f) => (
                          <li key={f} className="flex items-center text-gray-300">
                            <CheckCircle className="w-4 h-4 text-neon-cyan mr-3" />
                            {f}
                          </li>
                        ))}
                      </ul>
                      <button className="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-neon-purple/10 to-neon-cyan/10 text-neon-purple border border-neon-purple/30 hover:from-neon-purple/20 hover:to-neon-cyan/20 hover:border-neon-purple/50 transition-all">
                        Choose {plan.name}
                      </button>
                    </div>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section> */} 

        {/* Services Grid */}
        <section className="py-32 relative">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              variants={staggerContainer}
              initial="initial"
              whileInView="animate"
              viewport={{ once: true }}
              className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            >
              {filteredServices.map((service, index) => (
                <motion.div
                  key={index}
                  variants={fadeInUp}
                  transition={{ delay: index * 0.1 }}
                  className="group relative perspective-1000"
                >
                  <div className="relative bg-gradient-to-br from-deep-charcoal to-jet-black rounded-3xl p-8 border border-white/10 backdrop-blur-sm hover:border-neon-purple/50 transition-all duration-700 transform hover:-translate-y-4 hover:rotate-y-12 preserve-3d">
                    {/* 3D Hover Effect */}
                    <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/5 to-neon-cyan/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700" />
                    
                    {/* Category Badge */}
                    <div className="inline-flex items-center px-3 py-1 bg-gradient-to-r from-neon-purple/20 to-neon-cyan/20 border border-neon-purple/30 rounded-full text-neon-purple text-xs font-medium mb-6 backdrop-blur-sm">
                      {service.category}
                    </div>
                    
                    {/* Service Icon */}
                    <div className={`w-20 h-20 bg-gradient-to-r ${service.gradient} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 shadow-lg`}>
                      <service.icon className="w-10 h-10 text-white" />
                    </div>
                    
                    {/* Service Content */}
                    <h3 className="text-2xl font-bold text-white mb-4 group-hover:text-neon-purple transition-colors duration-500">{service.title}</h3>
                    <p className="text-gray-400 mb-6 leading-relaxed">{service.description}</p>
                    
                    {/* Features List */}
                    <ul className="space-y-3 mb-6">
                      {service.features.map((feature, idx) => (
                        <li key={idx} className="flex items-center text-gray-300 group-hover:text-gray-200 transition-colors duration-300">
                          <CheckCircle className="w-4 h-4 text-neon-cyan mr-3 flex-shrink-0" />
                          {feature}
                        </li>
                      ))}
                    </ul>
                    
                    {/* Technologies */}
                    <div className="mb-6">
                      <p className="text-sm text-gray-500 mb-3 font-medium">Technologies:</p>
                      <div className="flex flex-wrap gap-2">
                        {service.technologies.map((tech, idx) => (
                          <span key={idx} className="px-3 py-1 bg-white/5 text-gray-300 text-xs rounded-full border border-white/10">
                            {tech}
                          </span>
                        ))}
                      </div>
                    </div>
                    
                    {/* Price */}
                    <div className="mb-8">
                      <p className="text-2xl font-bold text-neon-purple">{service.price}</p>
                    </div>
                    
                    {/* CTA Button */}
                    <Link href="/contact">
                      <button className="group/btn w-full py-4 px-6 bg-gradient-to-r from-neon-purple/10 to-neon-cyan/10 text-neon-purple rounded-xl font-semibold hover:from-neon-purple/20 hover:to-neon-cyan/20 transition-all duration-500 border border-neon-purple/30 hover:border-neon-purple/50 flex items-center justify-center backdrop-blur-sm">
                        Get Started
                        <ArrowRight className="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform duration-300" />
                      </button>
                    </Link>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="py-32 relative overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/20 via-neon-cyan/20 to-neon-pink/20" />
          
          <div className="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
            >
              <h2 className="text-5xl lg:text-6xl font-bold text-white mb-8">
                Ready to Start Your
                <span className="block bg-gradient-to-r from-neon-purple via-neon-cyan to-neon-pink bg-clip-text text-transparent">
                  Digital Journey?
                </span>
              </h2>
              
              <p className="text-xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                Let's discuss your project requirements and create a custom solution that perfectly fits your business needs.
              </p>
              
              <div className="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <Link href="/contact">
                  <button className="group relative px-10 py-5 bg-gradient-to-r from-neon-purple to-neon-cyan text-white font-bold rounded-2xl shadow-2xl hover:shadow-neon-purple/25 transform hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                    <span className="relative z-10 flex items-center text-lg">
                      Start Your Project
                      <Rocket className="ml-3 w-6 h-6 group-hover:translate-x-2 transition-transform duration-300" />
                    </span>
                    <div className="absolute inset-0 bg-gradient-to-r from-neon-cyan to-neon-pink opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                  </button>
                </Link>
                
                <Link href="/contact">
                  <button className="group px-10 py-5 border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 hover:border-white/50 transition-all duration-500 backdrop-blur-sm text-lg">
                    <span className="flex items-center">
                      <ArrowRight className="w-5 h-5 mr-3 group-hover:translate-x-1 transition-transform duration-300" />
                      Contact Us
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

export default ServicesPage
