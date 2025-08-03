import React, { useState } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import { MessageCircle, X, Send, User, Bot } from 'lucide-react'

interface Message {
  id: string
  text: string
  isBot: boolean
  timestamp: Date
}

const predefinedResponses: Record<string, string> = {
  hello: "Hello! 👋 Welcome to EgySyr. I'm here to help you learn more about our services and how we can transform your digital presence.",
  services: "We offer comprehensive digital solutions including:\n• Custom Web Applications\n• Mobile App Development\n• Cloud Infrastructure\n• UI/UX Design\n• AI & Automation\n• Backend Systems\n\nWhich service interests you most?",
  pricing: "Our pricing is tailored to your specific needs and project scope. We offer competitive rates and flexible payment options. Would you like to schedule a consultation to discuss your project?",
  contact: "You can reach us through:\n📧 hello@egysyr.com\n📱 +1 (555) 123-4567\n🌐 www.egysyr.com\n\nOr fill out our contact form and we'll get back to you within 24 hours!",
  portfolio: "Check out our featured projects section above! We've worked on AI-powered e-commerce platforms, secure banking apps, cloud dashboards, and more. Each project showcases our commitment to innovation and quality.",
  team: "Our team consists of experienced developers, designers, and tech strategists who are passionate about creating exceptional digital experiences. We stay current with the latest technologies and best practices.",
  process: "Our development process includes:\n1. Discovery & Planning\n2. Design & Prototyping\n3. Development & Testing\n4. Deployment & Launch\n5. Ongoing Support & Maintenance\n\nWe keep you involved every step of the way!",
  default: "I'd be happy to help! You can ask me about our services, pricing, portfolio, team, or anything else about EgySyr. What would you like to know?"
}

const Chatbot: React.FC = () => {
  const [isOpen, setIsOpen] = useState(false)
  const [messages, setMessages] = useState<Message[]>([
    {
      id: '1',
      text: "Hi! I'm EgySyr's AI assistant. How can I help you today?",
      isBot: true,
      timestamp: new Date(),
    }
  ])
  const [inputText, setInputText] = useState('')
  const [isTyping, setIsTyping] = useState(false)

  const findResponse = (text: string): string => {
    const lowercaseText = text.toLowerCase()
    
    if (lowercaseText.includes('hello') || lowercaseText.includes('hi') || lowercaseText.includes('hey')) {
      return predefinedResponses.hello
    } else if (lowercaseText.includes('service') || lowercaseText.includes('what do you do')) {
      return predefinedResponses.services
    } else if (lowercaseText.includes('price') || lowercaseText.includes('cost') || lowercaseText.includes('rate')) {
      return predefinedResponses.pricing
    } else if (lowercaseText.includes('contact') || lowercaseText.includes('reach') || lowercaseText.includes('email')) {
      return predefinedResponses.contact
    } else if (lowercaseText.includes('portfolio') || lowercaseText.includes('work') || lowercaseText.includes('project')) {
      return predefinedResponses.portfolio
    } else if (lowercaseText.includes('team') || lowercaseText.includes('who are you')) {
      return predefinedResponses.team
    } else if (lowercaseText.includes('process') || lowercaseText.includes('how do you work')) {
      return predefinedResponses.process
    } else {
      return predefinedResponses.default
    }
  }

  const handleSendMessage = () => {
    if (!inputText.trim()) return

    const newMessage: Message = {
      id: Date.now().toString(),
      text: inputText,
      isBot: false,
      timestamp: new Date(),
    }

    setMessages(prev => [...prev, newMessage])
    setInputText('')
    setIsTyping(true)

    // Simulate bot response delay
    setTimeout(() => {
      const botResponse: Message = {
        id: (Date.now() + 1).toString(),
        text: findResponse(inputText),
        isBot: true,
        timestamp: new Date(),
      }

      setMessages(prev => [...prev, botResponse])
      setIsTyping(false)
    }, 1000 + Math.random() * 1000)
  }

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault()
      handleSendMessage()
    }
  }

  return (
    <>
      {/* Chat Button */}
      <motion.button
        className="fixed bottom-6 right-6 z-40 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple p-4 rounded-full shadow-glow hover:shadow-glow-purple transition-all duration-300 interactive"
        whileHover={{ scale: 1.1 }}
        whileTap={{ scale: 0.9 }}
        onClick={() => setIsOpen(!isOpen)}
        animate={{
          rotate: isOpen ? 180 : 0,
        }}
      >
        {isOpen ? <X size={24} className="text-white" /> : <MessageCircle size={24} className="text-white" />}
      </motion.button>

      {/* Notification Dot */}
      {!isOpen && (
        <motion.div
          className="fixed bottom-[4.5rem] right-[4.5rem] z-41 w-3 h-3 bg-egyshyr-green rounded-full"
          animate={{
            scale: [1, 1.2, 1],
            opacity: [1, 0.7, 1],
          }}
          transition={{
            duration: 2,
            repeat: Infinity,
          }}
        />
      )}

      {/* Chat Window */}
      <AnimatePresence>
        {isOpen && (
          <motion.div
            className="fixed bottom-24 right-6 z-39 w-80 h-96 bg-egyshyr-darker-gray border border-egyshyr-blue/30 rounded-xl shadow-xl overflow-hidden"
            initial={{ opacity: 0, scale: 0.8, y: 20 }}
            animate={{ opacity: 1, scale: 1, y: 0 }}
            exit={{ opacity: 0, scale: 0.8, y: 20 }}
            transition={{ type: "spring", duration: 0.5 }}
          >
            {/* Header */}
            <div className="bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple p-4">
              <div className="flex items-center space-x-3">
                <div className="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                  <Bot size={18} className="text-white" />
                </div>
                <div>
                  <h3 className="text-white font-rajdhani font-semibold">EgySyr Assistant</h3>
                  <p className="text-white/80 text-xs">Online • Ready to help</p>
                </div>
              </div>
            </div>

            {/* Messages */}
            <div className="flex-1 p-4 space-y-4 overflow-y-auto h-64">
              {messages.map((message) => (
                <motion.div
                  key={message.id}
                  className={`flex ${message.isBot ? 'justify-start' : 'justify-end'}`}
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.3 }}
                >
                  <div className={`flex items-start space-x-2 max-w-xs ${message.isBot ? '' : 'flex-row-reverse space-x-reverse'}`}>
                    <div className={`w-6 h-6 rounded-full flex items-center justify-center ${
                      message.isBot ? 'bg-egyshyr-blue/20' : 'bg-egyshyr-purple/20'
                    }`}>
                      {message.isBot ? (
                        <Bot size={12} className="text-egyshyr-blue" />
                      ) : (
                        <User size={12} className="text-egyshyr-purple" />
                      )}
                    </div>
                    <div className={`px-3 py-2 rounded-lg ${
                      message.isBot 
                        ? 'bg-egyshyr-blue/10 border border-egyshyr-blue/20 text-egyshyr-white' 
                        : 'bg-egyshyr-purple/10 border border-egyshyr-purple/20 text-egyshyr-white'
                    }`}>
                      <p className="text-sm font-inter whitespace-pre-wrap">{message.text}</p>
                    </div>
                  </div>
                </motion.div>
              ))}

              {/* Typing Indicator */}
              {isTyping && (
                <motion.div
                  className="flex justify-start"
                  initial={{ opacity: 0, y: 10 }}
                  animate={{ opacity: 1, y: 0 }}
                >
                  <div className="flex items-start space-x-2 max-w-xs">
                    <div className="w-6 h-6 bg-egyshyr-blue/20 rounded-full flex items-center justify-center">
                      <Bot size={12} className="text-egyshyr-blue" />
                    </div>
                    <div className="px-3 py-2 bg-egyshyr-blue/10 border border-egyshyr-blue/20 rounded-lg">
                      <div className="flex space-x-1">
                        {[0, 1, 2].map((i) => (
                          <motion.div
                            key={i}
                            className="w-2 h-2 bg-egyshyr-blue rounded-full"
                            animate={{
                              scale: [1, 1.5, 1],
                              opacity: [0.5, 1, 0.5],
                            }}
                            transition={{
                              duration: 1,
                              repeat: Infinity,
                              delay: i * 0.2,
                            }}
                          />
                        ))}
                      </div>
                    </div>
                  </div>
                </motion.div>
              )}
            </div>

            {/* Input */}
            <div className="p-4 border-t border-egyshyr-blue/20">
              <div className="flex space-x-2">
                <input
                  type="text"
                  value={inputText}
                  onChange={(e) => setInputText(e.target.value)}
                  onKeyPress={handleKeyPress}
                  placeholder="Ask me anything..."
                  className="flex-1 px-3 py-2 bg-egyshyr-black/50 border border-egyshyr-blue/20 rounded-lg text-egyshyr-white placeholder-egyshyr-gray text-sm focus:outline-none focus:border-egyshyr-blue/50"
                />
                <motion.button
                  onClick={handleSendMessage}
                  className="px-3 py-2 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white hover:shadow-glow interactive"
                  whileHover={{ scale: 1.05 }}
                  whileTap={{ scale: 0.95 }}
                  disabled={!inputText.trim()}
                >
                  <Send size={16} />
                </motion.button>
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  )
}

export default Chatbot