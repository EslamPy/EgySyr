import React from 'react'
import { motion } from 'framer-motion'
import HeroSection from '@components/sections/HeroSection'
import ServicesSection from '@components/sections/ServicesSection'
import ProjectsSection from '@components/sections/ProjectsSection'
import WhyUsSection from '@components/sections/WhyUsSection'
import ContactSection from '@components/sections/ContactSection'
import Navigation from '@components/Navigation'
import Chatbot from '@components/Chatbot'
import ScrollProgress from '@components/ScrollProgress'

const HomePage: React.FC = () => {
  return (
    <motion.div
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      transition={{ duration: 0.8 }}
      className="relative"
    >
      <ScrollProgress />
      <Navigation />
      
      <main>
        <HeroSection />
        <ServicesSection />
        <ProjectsSection />
        <WhyUsSection />
        <ContactSection />
      </main>

      <Chatbot />
    </motion.div>
  )
}

export default HomePage