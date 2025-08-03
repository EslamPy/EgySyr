import React, { useState } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import { useForm } from 'react-hook-form'
import { 
  Mail, 
  Phone, 
  MapPin, 
  Clock, 
  Send, 
  ArrowLeft, 
  ArrowRight,
  Calculator,
  CheckCircle,
  User,
  MessageSquare,
  Building,
  Code
} from 'lucide-react'
import toast from 'react-hot-toast'

interface FormData {
  name: string
  email: string
  company: string
  projectType: string
  budget: string
  timeline: string
  message: string
  features: string[]
}

interface QuoteCalculatorState {
  projectType: string
  features: string[]
  complexity: string
  timeline: string
}

const projectTypes = [
  { id: 'web', name: 'Web Application', basePrice: 5000, icon: Code },
  { id: 'mobile', name: 'Mobile App', basePrice: 8000, icon: Phone },
  { id: 'ecommerce', name: 'E-commerce', basePrice: 12000, icon: Building },
  { id: 'custom', name: 'Custom Solution', basePrice: 15000, icon: Calculator },
]

const features = [
  { id: 'auth', name: 'User Authentication', price: 1500 },
  { id: 'payment', name: 'Payment Gateway', price: 2000 },
  { id: 'admin', name: 'Admin Dashboard', price: 3000 },
  { id: 'api', name: 'API Integration', price: 1000 },
  { id: 'realtime', name: 'Real-time Features', price: 2500 },
  { id: 'analytics', name: 'Analytics & Reporting', price: 2000 },
  { id: 'responsive', name: 'Responsive Design', price: 1000 },
  { id: 'seo', name: 'SEO Optimization', price: 800 },
]

const QuoteCalculator: React.FC<{ onQuoteGenerated: (quote: number) => void }> = ({ onQuoteGenerated }) => {
  const [calculator, setCalculator] = useState<QuoteCalculatorState>({
    projectType: '',
    features: [],
    complexity: '',
    timeline: '',
  })

  const calculateQuote = () => {
    const projectTypeData = projectTypes.find(p => p.id === calculator.projectType)
    if (!projectTypeData) return 0

    let basePrice = projectTypeData.basePrice

    // Add feature costs
    const featureCost = calculator.features.reduce((total, featureId) => {
      const feature = features.find(f => f.id === featureId)
      return total + (feature?.price || 0)
    }, 0)

    // Apply complexity multiplier
    const complexityMultiplier = calculator.complexity === 'simple' ? 0.8 : 
                                calculator.complexity === 'complex' ? 1.5 : 1

    // Apply timeline multiplier
    const timelineMultiplier = calculator.timeline === 'rush' ? 1.5 : 
                              calculator.timeline === 'flexible' ? 0.9 : 1

    const totalQuote = (basePrice + featureCost) * complexityMultiplier * timelineMultiplier

    return Math.round(totalQuote)
  }

  const handleGenerateQuote = () => {
    const quote = calculateQuote()
    onQuoteGenerated(quote)
    toast.success(`Quote generated: $${quote.toLocaleString()}`)
  }

  return (
    <div className="space-y-6">
      <h3 className="text-2xl font-orbitron font-bold text-egyshyr-white mb-6 text-center">
        Project Quote Calculator
      </h3>

      {/* Project Type */}
      <div>
        <label className="block text-egyshyr-white font-rajdhani font-medium mb-3">
          Project Type
        </label>
        <div className="grid grid-cols-2 gap-3">
          {projectTypes.map((type) => {
            const IconComponent = type.icon
            return (
              <motion.button
                key={type.id}
                type="button"
                onClick={() => setCalculator(prev => ({ ...prev, projectType: type.id }))}
                className={`p-4 rounded-lg border-2 transition-all duration-300 ${
                  calculator.projectType === type.id
                    ? 'border-egyshyr-blue bg-egyshyr-blue/10'
                    : 'border-egyshyr-blue/20 hover:border-egyshyr-blue/50'
                }`}
                whileHover={{ scale: 1.02 }}
                whileTap={{ scale: 0.98 }}
              >
                <IconComponent size={24} className="mx-auto mb-2 text-egyshyr-blue" />
                <p className="text-sm font-inter text-egyshyr-white">{type.name}</p>
                <p className="text-xs text-egyshyr-gray">from ${type.basePrice.toLocaleString()}</p>
              </motion.button>
            )
          })}
        </div>
      </div>

      {/* Features */}
      <div>
        <label className="block text-egyshyr-white font-rajdhani font-medium mb-3">
          Features (Select all that apply)
        </label>
        <div className="grid grid-cols-2 gap-2">
          {features.map((feature) => (
            <motion.button
              key={feature.id}
              type="button"
              onClick={() => {
                setCalculator(prev => ({
                  ...prev,
                  features: prev.features.includes(feature.id)
                    ? prev.features.filter(f => f !== feature.id)
                    : [...prev.features, feature.id]
                }))
              }}
              className={`p-3 rounded-lg border text-left transition-all duration-300 ${
                calculator.features.includes(feature.id)
                  ? 'border-egyshyr-green bg-egyshyr-green/10'
                  : 'border-egyshyr-blue/20 hover:border-egyshyr-blue/50'
              }`}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              <p className="text-sm font-inter text-egyshyr-white">{feature.name}</p>
              <p className="text-xs text-egyshyr-gray">+${feature.price}</p>
            </motion.button>
          ))}
        </div>
      </div>

      {/* Complexity */}
      <div>
        <label className="block text-egyshyr-white font-rajdhani font-medium mb-3">
          Complexity Level
        </label>
        <div className="grid grid-cols-3 gap-3">
          {[
            { id: 'simple', name: 'Simple', multiplier: '0.8x' },
            { id: 'standard', name: 'Standard', multiplier: '1x' },
            { id: 'complex', name: 'Complex', multiplier: '1.5x' },
          ].map((complexity) => (
            <motion.button
              key={complexity.id}
              type="button"
              onClick={() => setCalculator(prev => ({ ...prev, complexity: complexity.id }))}
              className={`p-3 rounded-lg border-2 transition-all duration-300 ${
                calculator.complexity === complexity.id
                  ? 'border-egyshyr-purple bg-egyshyr-purple/10'
                  : 'border-egyshyr-blue/20 hover:border-egyshyr-blue/50'
              }`}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              <p className="text-sm font-inter text-egyshyr-white">{complexity.name}</p>
              <p className="text-xs text-egyshyr-gray">{complexity.multiplier}</p>
            </motion.button>
          ))}
        </div>
      </div>

      {/* Timeline */}
      <div>
        <label className="block text-egyshyr-white font-rajdhani font-medium mb-3">
          Timeline
        </label>
        <div className="grid grid-cols-3 gap-3">
          {[
            { id: 'rush', name: 'Rush (< 4 weeks)', multiplier: '1.5x' },
            { id: 'standard', name: 'Standard (4-12 weeks)', multiplier: '1x' },
            { id: 'flexible', name: 'Flexible (> 12 weeks)', multiplier: '0.9x' },
          ].map((timeline) => (
            <motion.button
              key={timeline.id}
              type="button"
              onClick={() => setCalculator(prev => ({ ...prev, timeline: timeline.id }))}
              className={`p-3 rounded-lg border-2 transition-all duration-300 ${
                calculator.timeline === timeline.id
                  ? 'border-egyshyr-green bg-egyshyr-green/10'
                  : 'border-egyshyr-blue/20 hover:border-egyshyr-blue/50'
              }`}
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              <p className="text-sm font-inter text-egyshyr-white">{timeline.name}</p>
              <p className="text-xs text-egyshyr-gray">{timeline.multiplier}</p>
            </motion.button>
          ))}
        </div>
      </div>

      {/* Calculate Button */}
      <motion.button
        type="button"
        onClick={handleGenerateQuote}
        disabled={!calculator.projectType || !calculator.complexity || !calculator.timeline}
        className="w-full px-6 py-3 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-glow transition-all duration-300"
        whileHover={{ scale: 1.02 }}
        whileTap={{ scale: 0.98 }}
      >
        <Calculator size={20} className="inline-block mr-2" />
        Calculate Quote
      </motion.button>

      {calculator.projectType && calculator.complexity && calculator.timeline && (
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="p-4 bg-egyshyr-darker-gray/50 rounded-lg border border-egyshyr-blue/30"
        >
          <p className="text-egyshyr-white text-center">
            Estimated Quote: <span className="text-2xl font-orbitron font-bold text-egyshyr-blue">
              ${calculateQuote().toLocaleString()}
            </span>
          </p>
          <p className="text-egyshyr-gray text-xs text-center mt-2">
            *This is an estimate. Final pricing may vary based on specific requirements.
          </p>
        </motion.div>
      )}
    </div>
  )
}

const ContactSection: React.FC = () => {
  const [currentStep, setCurrentStep] = useState(0)
  const [showCalculator, setShowCalculator] = useState(false)
  const [estimatedQuote, setEstimatedQuote] = useState<number | null>(null)
  const { register, handleSubmit, formState: { errors }, reset } = useForm<FormData>()

  const steps = [
    {
      title: 'Personal Information',
      icon: User,
      fields: ['name', 'email', 'company']
    },
    {
      title: 'Project Details',
      icon: Code,
      fields: ['projectType', 'budget', 'timeline']
    },
    {
      title: 'Additional Information',
      icon: MessageSquare,
      fields: ['message']
    }
  ]

  const onSubmit = async (data: FormData) => {
    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1500))
      
      toast.success('Message sent successfully! We\'ll get back to you within 24 hours.')
      reset()
      setCurrentStep(0)
      setEstimatedQuote(null)
    } catch (error) {
      toast.error('Failed to send message. Please try again.')
    }
  }

  const nextStep = () => {
    if (currentStep < steps.length - 1) {
      setCurrentStep(currentStep + 1)
    }
  }

  const prevStep = () => {
    if (currentStep > 0) {
      setCurrentStep(currentStep - 1)
    }
  }

  const contactInfo = [
    {
      icon: Mail,
      label: 'Email',
      value: 'hello@egysyr.com',
      color: 'text-egyshyr-blue'
    },
    {
      icon: Phone,
      label: 'Phone',
      value: '+1 (555) 123-4567',
      color: 'text-egyshyr-purple'
    },
    {
      icon: MapPin,
      label: 'Location',
      value: 'Global Remote Team',
      color: 'text-egyshyr-green'
    },
    {
      icon: Clock,
      label: 'Response Time',
      value: 'Within 24 hours',
      color: 'text-egyshyr-blue'
    }
  ]

  return (
    <section id="contact" className="py-20 px-6 relative overflow-hidden">
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
            Get In Touch
          </motion.span>
          
          <h2 className="text-4xl md:text-6xl font-orbitron font-bold text-egyshyr-white mb-6">
            Start Your
            <span className="block bg-gradient-to-r from-egyshyr-blue via-egyshyr-purple to-egyshyr-green bg-clip-text text-transparent">
              Digital Journey
            </span>
          </h2>
          
          <p className="text-xl text-egyshyr-gray font-inter max-w-2xl mx-auto leading-relaxed">
            Ready to transform your ideas into reality? Let's discuss your project 
            and create something extraordinary together.
          </p>
        </motion.div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
          {/* Contact Information */}
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
          >
            <h3 className="text-2xl font-orbitron font-bold text-egyshyr-white mb-8">
              Let's Connect
            </h3>

            <div className="space-y-6 mb-8">
              {contactInfo.map((info, index) => {
                const IconComponent = info.icon
                return (
                  <motion.div
                    key={index}
                    className="flex items-center space-x-4 p-4 bg-egyshyr-darker-gray/30 rounded-lg border border-egyshyr-blue/20 hover:border-egyshyr-blue/50 transition-all duration-300"
                    initial={{ opacity: 0, y: 20 }}
                    whileInView={{ opacity: 1, y: 0 }}
                    viewport={{ once: true }}
                    transition={{ delay: index * 0.1, duration: 0.5 }}
                    whileHover={{ x: 5 }}
                  >
                    <div className={`${info.color} p-2`}>
                      <IconComponent size={24} />
                    </div>
                    <div>
                      <p className="text-egyshyr-gray text-sm font-rajdhani">{info.label}</p>
                      <p className="text-egyshyr-white font-inter">{info.value}</p>
                    </div>
                  </motion.div>
                )
              })}
            </div>

            {/* Quote Calculator Toggle */}
            <motion.button
              onClick={() => setShowCalculator(!showCalculator)}
              className="w-full px-6 py-4 bg-gradient-to-r from-egyshyr-green to-egyshyr-blue rounded-lg text-white font-semibold hover:shadow-glow transition-all duration-300 mb-8"
              whileHover={{ scale: 1.02 }}
              whileTap={{ scale: 0.98 }}
            >
              <Calculator size={20} className="inline-block mr-2" />
              {showCalculator ? 'Hide' : 'Show'} Quote Calculator
            </motion.button>

            {/* Quote Calculator */}
            <AnimatePresence>
              {showCalculator && (
                <motion.div
                  initial={{ opacity: 0, height: 0 }}
                  animate={{ opacity: 1, height: 'auto' }}
                  exit={{ opacity: 0, height: 0 }}
                  className="bg-egyshyr-darker-gray/30 rounded-lg border border-egyshyr-blue/20 p-6"
                >
                  <QuoteCalculator onQuoteGenerated={setEstimatedQuote} />
                </motion.div>
              )}
            </AnimatePresence>
          </motion.div>

          {/* Contact Form */}
          <motion.div
            initial={{ opacity: 0, x: 30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
            className="bg-egyshyr-darker-gray/30 backdrop-blur-sm border border-egyshyr-blue/20 rounded-xl p-8"
          >
            {/* Step Indicator */}
            <div className="flex items-center justify-between mb-8">
              {steps.map((step, index) => {
                const IconComponent = step.icon
                return (
                  <div key={index} className="flex items-center">
                    <motion.div
                      className={`w-10 h-10 rounded-full flex items-center justify-center border-2 ${
                        index <= currentStep
                          ? 'border-egyshyr-blue bg-egyshyr-blue/20'
                          : 'border-egyshyr-blue/30'
                      }`}
                      animate={{
                        borderColor: index <= currentStep ? '#00FFFF' : 'rgba(0, 255, 255, 0.3)',
                        backgroundColor: index <= currentStep ? 'rgba(0, 255, 255, 0.2)' : 'transparent',
                      }}
                    >
                      <IconComponent size={18} className={index <= currentStep ? 'text-egyshyr-blue' : 'text-egyshyr-gray'} />
                    </motion.div>
                    {index < steps.length - 1 && (
                      <div className={`w-16 h-0.5 mx-2 ${
                        index < currentStep ? 'bg-egyshyr-blue' : 'bg-egyshyr-blue/30'
                      }`} />
                    )}
                  </div>
                )
              })}
            </div>

            <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
              <AnimatePresence mode="wait">
                <motion.div
                  key={currentStep}
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  exit={{ opacity: 0, x: -20 }}
                  transition={{ duration: 0.3 }}
                >
                  <h3 className="text-xl font-orbitron font-semibold text-egyshyr-white mb-6">
                    {steps[currentStep].title}
                  </h3>

                  {currentStep === 0 && (
                    <div className="space-y-4">
                      <div>
                        <input
                          {...register('name', { required: 'Name is required' })}
                          placeholder="Full Name"
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white placeholder-egyshyr-gray focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        />
                        {errors.name && <p className="text-red-400 text-sm mt-1">{errors.name.message}</p>}
                      </div>
                      <div>
                        <input
                          {...register('email', { 
                            required: 'Email is required',
                            pattern: {
                              value: /^\S+@\S+$/i,
                              message: 'Invalid email format'
                            }
                          })}
                          placeholder="Email Address"
                          type="email"
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white placeholder-egyshyr-gray focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        />
                        {errors.email && <p className="text-red-400 text-sm mt-1">{errors.email.message}</p>}
                      </div>
                      <div>
                        <input
                          {...register('company')}
                          placeholder="Company Name (Optional)"
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white placeholder-egyshyr-gray focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        />
                      </div>
                    </div>
                  )}

                  {currentStep === 1 && (
                    <div className="space-y-4">
                      <div>
                        <select
                          {...register('projectType', { required: 'Project type is required' })}
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        >
                          <option value="">Select Project Type</option>
                          <option value="web">Web Application</option>
                          <option value="mobile">Mobile App</option>
                          <option value="ecommerce">E-commerce</option>
                          <option value="custom">Custom Solution</option>
                        </select>
                        {errors.projectType && <p className="text-red-400 text-sm mt-1">{errors.projectType.message}</p>}
                      </div>
                      <div>
                        <select
                          {...register('budget', { required: 'Budget range is required' })}
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        >
                          <option value="">Select Budget Range</option>
                          <option value="5k-15k">$5,000 - $15,000</option>
                          <option value="15k-30k">$15,000 - $30,000</option>
                          <option value="30k-50k">$30,000 - $50,000</option>
                          <option value="50k+">$50,000+</option>
                        </select>
                        {errors.budget && <p className="text-red-400 text-sm mt-1">{errors.budget.message}</p>}
                      </div>
                      <div>
                        <select
                          {...register('timeline', { required: 'Timeline is required' })}
                          className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300"
                        >
                          <option value="">Select Timeline</option>
                          <option value="rush">ASAP (Rush)</option>
                          <option value="4-8weeks">4-8 weeks</option>
                          <option value="8-12weeks">8-12 weeks</option>
                          <option value="flexible">Flexible</option>
                        </select>
                        {errors.timeline && <p className="text-red-400 text-sm mt-1">{errors.timeline.message}</p>}
                      </div>
                      {estimatedQuote && (
                        <motion.div
                          initial={{ opacity: 0, y: 10 }}
                          animate={{ opacity: 1, y: 0 }}
                          className="p-4 bg-egyshyr-blue/10 border border-egyshyr-blue/30 rounded-lg"
                        >
                          <p className="text-egyshyr-white text-center">
                            Estimated Quote: <span className="font-orbitron font-bold text-egyshyr-blue">
                              ${estimatedQuote.toLocaleString()}
                            </span>
                          </p>
                        </motion.div>
                      )}
                    </div>
                  )}

                  {currentStep === 2 && (
                    <div>
                      <textarea
                        {...register('message', { required: 'Project description is required' })}
                        placeholder="Tell us about your project, goals, and any specific requirements..."
                        rows={6}
                        className="w-full px-4 py-3 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white placeholder-egyshyr-gray focus:outline-none focus:border-egyshyr-blue/50 transition-all duration-300 resize-none"
                      />
                      {errors.message && <p className="text-red-400 text-sm mt-1">{errors.message.message}</p>}
                    </div>
                  )}
                </motion.div>
              </AnimatePresence>

              {/* Navigation Buttons */}
              <div className="flex justify-between pt-6">
                <motion.button
                  type="button"
                  onClick={prevStep}
                  disabled={currentStep === 0}
                  className="px-6 py-3 border border-egyshyr-blue/50 rounded-lg text-egyshyr-blue font-semibold disabled:opacity-50 disabled:cursor-not-allowed hover:bg-egyshyr-blue/10 transition-all duration-300"
                  whileHover={{ scale: currentStep > 0 ? 1.05 : 1 }}
                  whileTap={{ scale: currentStep > 0 ? 0.95 : 1 }}
                >
                  <ArrowLeft size={16} className="inline-block mr-2" />
                  Previous
                </motion.button>

                {currentStep < steps.length - 1 ? (
                  <motion.button
                    type="button"
                    onClick={nextStep}
                    className="px-6 py-3 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold hover:shadow-glow transition-all duration-300"
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                  >
                    Next
                    <ArrowRight size={16} className="inline-block ml-2" />
                  </motion.button>
                ) : (
                  <motion.button
                    type="submit"
                    className="px-6 py-3 bg-gradient-to-r from-egyshyr-green to-egyshyr-blue rounded-lg text-white font-semibold hover:shadow-glow transition-all duration-300"
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                  >
                    Send Message
                    <Send size={16} className="inline-block ml-2" />
                  </motion.button>
                )}
              </div>
            </form>
          </motion.div>
        </div>
      </div>
    </section>
  )
}

export default ContactSection