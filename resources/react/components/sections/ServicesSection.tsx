import React, { useState } from 'react'
import { motion } from 'framer-motion'
import { 
  Code, 
  Smartphone, 
  Cloud, 
  Palette, 
  Brain, 
  Database,
  ArrowRight,
  CheckCircle
} from 'lucide-react'

interface Service {
  id: string
  icon: React.ElementType
  title: string
  description: string
  features: string[]
  color: string
  gradient: string
}

const services: Service[] = [
  {
    id: 'web',
    icon: Code,
    title: 'Custom Web Applications',
    description: 'Modern, scalable web applications built with cutting-edge technologies and best practices.',
    features: ['React/Vue/Angular', 'Progressive Web Apps', 'API Integration', 'Real-time Features'],
    color: 'text-egyshyr-blue',
    gradient: 'from-egyshyr-blue to-egyshyr-purple',
  },
  {
    id: 'mobile',
    icon: Smartphone,
    title: 'Android/iOS Apps',
    description: 'Native and cross-platform mobile applications that deliver exceptional user experiences.',
    features: ['Native Development', 'Cross-platform (Flutter)', 'App Store Optimization', 'Push Notifications'],
    color: 'text-egyshyr-purple',
    gradient: 'from-egyshyr-purple to-egyshyr-green',
  },
  {
    id: 'cloud',
    icon: Cloud,
    title: 'Cloud & System Admin',
    description: 'Robust cloud infrastructure and system administration for scalable, secure operations.',
    features: ['AWS/Azure/GCP', 'DevOps & CI/CD', 'Monitoring & Analytics', 'Security & Backup'],
    color: 'text-egyshyr-green',
    gradient: 'from-egyshyr-green to-egyshyr-blue',
  },
  {
    id: 'design',
    icon: Palette,
    title: 'UI/UX & Product Design',
    description: 'Beautiful, intuitive designs that prioritize user experience and business objectives.',
    features: ['User Research', 'Wireframing & Prototyping', 'Design Systems', 'Usability Testing'],
    color: 'text-egyshyr-blue',
    gradient: 'from-egyshyr-blue to-egyshyr-purple',
  },
  {
    id: 'ai',
    icon: Brain,
    title: 'AI & Automation',
    description: 'Intelligent automation solutions and AI integration to streamline your business processes.',
    features: ['Machine Learning', 'Process Automation', 'Chatbots & NLP', 'Data Analytics'],
    color: 'text-egyshyr-purple',
    gradient: 'from-egyshyr-purple to-egyshyr-green',
  },
  {
    id: 'backend',
    icon: Database,
    title: 'APIs & Backend Systems',
    description: 'Powerful, scalable backend architectures and APIs that form the foundation of great apps.',
    features: ['RESTful APIs', 'Database Design', 'Microservices', 'Performance Optimization'],
    color: 'text-egyshyr-green',
    gradient: 'from-egyshyr-green to-egyshyr-blue',
  },
]

const ServiceCard: React.FC<{ service: Service; index: number }> = ({ service, index }) => {
  const [isFlipped, setIsFlipped] = useState(false)
  const { icon: Icon, title, description, features, color, gradient } = service

  return (
    <motion.div
      className="relative h-80 w-full perspective-1000"
      initial={{ opacity: 0, y: 50 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.6 }}
      onHoverStart={() => setIsFlipped(true)}
      onHoverEnd={() => setIsFlipped(false)}
    >
      <motion.div
        className="relative w-full h-full preserve-3d duration-700"
        animate={{ rotateY: isFlipped ? 180 : 0 }}
        transition={{ duration: 0.7, ease: "easeInOut" }}
      >
        {/* Front of Card */}
        <div className="absolute inset-0 backface-hidden bg-egyshyr-darker-gray/50 backdrop-blur-sm border border-egyshyr-blue/20 rounded-xl p-6 hover:border-egyshyr-blue/50 transition-all duration-300">
          <div className="flex flex-col h-full">
            <motion.div
              className={`${color} mb-4`}
              whileHover={{ scale: 1.1, rotate: 5 }}
              transition={{ duration: 0.3 }}
            >
              <Icon size={48} />
            </motion.div>
            
            <h3 className="text-xl font-orbitron font-semibold text-egyshyr-white mb-3">
              {title}
            </h3>
            
            <p className="text-egyshyr-gray font-inter text-sm leading-relaxed flex-grow">
              {description}
            </p>
            
            <div className="mt-4 flex items-center text-egyshyr-blue">
              <span className="text-sm font-inter">Learn More</span>
              <ArrowRight size={16} className="ml-2" />
            </div>
          </div>
        </div>

        {/* Back of Card */}
        <div className={`absolute inset-0 backface-hidden rotate-y-180 bg-gradient-to-br ${gradient} p-6 rounded-xl`}>
          <div className="flex flex-col h-full text-white">
            <div className="flex items-center mb-4">
              <Icon size={32} className="mr-3" />
              <h3 className="text-lg font-orbitron font-semibold">
                Key Features
              </h3>
            </div>
            
            <div className="space-y-3 flex-grow">
              {features.map((feature, idx) => (
                <motion.div
                  key={idx}
                  className="flex items-center"
                  initial={{ opacity: 0, x: -20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ delay: idx * 0.1 }}
                >
                  <CheckCircle size={16} className="mr-3 text-white/80" />
                  <span className="text-sm font-inter">{feature}</span>
                </motion.div>
              ))}
            </div>
            
            <motion.button
              className="mt-4 px-6 py-2 bg-white/20 backdrop-blur-sm rounded-lg font-semibold text-sm hover:bg-white/30 transition-all duration-300"
              whileHover={{ scale: 1.05 }}
              whileTap={{ scale: 0.95 }}
            >
              Get Quote
            </motion.button>
          </div>
        </div>
      </motion.div>
    </motion.div>
  )
}

const ServicesSection: React.FC = () => {
  return (
    <section id="services" className="py-20 px-6 relative overflow-hidden">
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
            className="inline-block px-4 py-2 bg-egyshyr-blue/10 border border-egyshyr-blue/30 rounded-full text-egyshyr-blue text-sm font-rajdhani font-medium mb-4"
            whileHover={{ scale: 1.05 }}
          >
            Our Services
          </motion.span>
          
          <h2 className="text-4xl md:text-6xl font-orbitron font-bold text-egyshyr-white mb-6">
            Complete Digital
            <span className="block bg-gradient-to-r from-egyshyr-blue via-egyshyr-purple to-egyshyr-green bg-clip-text text-transparent">
              Solutions
            </span>
          </h2>
          
          <p className="text-xl text-egyshyr-gray font-inter max-w-2xl mx-auto leading-relaxed">
            From concept to deployment, we provide end-to-end digital solutions 
            that scale with your business and exceed expectations.
          </p>
        </motion.div>

        {/* Services Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {services.map((service, index) => (
            <ServiceCard key={service.id} service={service} index={index} />
          ))}
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
            className="px-8 py-4 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold text-lg hover:shadow-glow interactive glow-on-hover"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            Start Your Project Today
          </motion.button>
        </motion.div>
      </div>
    </section>
  )
}

export default ServicesSection