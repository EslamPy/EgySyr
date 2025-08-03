import React, { useState } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import { ExternalLink, Github, X, Play } from 'lucide-react'

interface Project {
  id: string
  title: string
  description: string
  category: string
  image: string
  technologies: string[]
  liveUrl?: string
  githubUrl?: string
  featured: boolean
}

const projects: Project[] = [
  {
    id: 'ecommerce-platform',
    title: 'AI-Powered E-commerce Platform',
    description: 'A next-generation e-commerce platform with AI recommendations, real-time inventory management, and seamless checkout experience.',
    category: 'Web Application',
    image: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop',
    technologies: ['React', 'Node.js', 'AI/ML', 'PostgreSQL', 'AWS'],
    liveUrl: 'https://demo.example.com',
    githubUrl: 'https://github.com/example',
    featured: true,
  },
  {
    id: 'mobile-banking-app',
    title: 'Secure Mobile Banking App',
    description: 'Revolutionary mobile banking application with biometric authentication, real-time transactions, and advanced security features.',
    category: 'Mobile App',
    image: 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800&h=600&fit=crop',
    technologies: ['React Native', 'Node.js', 'MongoDB', 'Blockchain'],
    liveUrl: 'https://app.example.com',
    featured: true,
  },
  {
    id: 'cloud-dashboard',
    title: 'Cloud Infrastructure Dashboard',
    description: 'Comprehensive cloud management dashboard with real-time monitoring, automated scaling, and cost optimization.',
    category: 'Cloud Solution',
    image: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop',
    technologies: ['Vue.js', 'Python', 'Docker', 'Kubernetes', 'AWS'],
    liveUrl: 'https://cloud.example.com',
    featured: true,
  },
  {
    id: 'ai-assistant',
    title: 'Intelligent Customer Support AI',
    description: 'Advanced AI-powered customer support system with natural language processing and automated ticket resolution.',
    category: 'AI Solution',
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=600&fit=crop',
    technologies: ['Python', 'TensorFlow', 'NLP', 'FastAPI', 'Redis'],
    liveUrl: 'https://ai.example.com',
    featured: false,
  },
  {
    id: 'iot-platform',
    title: 'IoT Device Management Platform',
    description: 'Scalable IoT platform for device management, data analytics, and real-time monitoring across multiple industries.',
    category: 'IoT Solution',
    image: 'https://images.unsplash.com/photo-1518432031352-d6fc5c10da5a?w=800&h=600&fit=crop',
    technologies: ['Angular', 'Express.js', 'InfluxDB', 'MQTT', 'Docker'],
    featured: false,
  },
  {
    id: 'blockchain-wallet',
    title: 'Secure Cryptocurrency Wallet',
    description: 'Multi-currency cryptocurrency wallet with advanced security features and decentralized exchange integration.',
    category: 'Blockchain',
    image: 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&h=600&fit=crop',
    technologies: ['React', 'Solidity', 'Web3', 'Ethereum', 'MetaMask'],
    liveUrl: 'https://wallet.example.com',
    featured: false,
  },
]

const ProjectCard: React.FC<{ project: Project; index: number; onOpen: () => void }> = ({ 
  project, 
  index, 
  onOpen 
}) => {
  return (
    <motion.div
      className="flex-shrink-0 w-80 group cursor-pointer"
      initial={{ opacity: 0, x: 50 }}
      whileInView={{ opacity: 1, x: 0 }}
      viewport={{ once: true }}
      transition={{ delay: index * 0.1, duration: 0.6 }}
      onClick={onOpen}
    >
      <div className="relative bg-egyshyr-darker-gray/50 backdrop-blur-sm border border-egyshyr-blue/20 rounded-xl overflow-hidden hover:border-egyshyr-blue/50 transition-all duration-300 glow-on-hover">
        {/* Image */}
        <div className="relative h-48 overflow-hidden">
          <img
            src={project.image}
            alt={project.title}
            className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
          />
          <div className="absolute inset-0 bg-gradient-to-t from-egyshyr-black via-transparent to-transparent opacity-60" />
          
          {/* Play Button Overlay */}
          <motion.div
            className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            whileHover={{ scale: 1.1 }}
          >
            <div className="bg-egyshyr-blue/80 backdrop-blur-sm rounded-full p-4">
              <Play size={24} className="text-white ml-1" />
            </div>
          </motion.div>

          {/* Category Badge */}
          <div className="absolute top-4 left-4">
            <span className="px-3 py-1 bg-egyshyr-blue/20 backdrop-blur-sm border border-egyshyr-blue/30 rounded-full text-egyshyr-blue text-xs font-rajdhani font-medium">
              {project.category}
            </span>
          </div>

          {project.featured && (
            <div className="absolute top-4 right-4">
              <span className="px-3 py-1 bg-egyshyr-purple/20 backdrop-blur-sm border border-egyshyr-purple/30 rounded-full text-egyshyr-purple text-xs font-rajdhani font-medium">
                Featured
              </span>
            </div>
          )}
        </div>

        {/* Content */}
        <div className="p-6">
          <h3 className="text-xl font-orbitron font-semibold text-egyshyr-white mb-3 group-hover:text-egyshyr-blue transition-colors">
            {project.title}
          </h3>
          
          <p className="text-egyshyr-gray font-inter text-sm leading-relaxed mb-4 line-clamp-3">
            {project.description}
          </p>

          {/* Technologies */}
          <div className="flex flex-wrap gap-2 mb-4">
            {project.technologies.slice(0, 3).map((tech) => (
              <span
                key={tech}
                className="px-2 py-1 bg-egyshyr-blue/10 border border-egyshyr-blue/20 rounded text-egyshyr-blue text-xs font-inter"
              >
                {tech}
              </span>
            ))}
            {project.technologies.length > 3 && (
              <span className="px-2 py-1 text-egyshyr-gray text-xs font-inter">
                +{project.technologies.length - 3} more
              </span>
            )}
          </div>

          {/* Links */}
          <div className="flex items-center gap-4">
            {project.liveUrl && (
              <motion.button
                className="flex items-center text-egyshyr-blue hover:text-egyshyr-purple transition-colors text-sm font-inter interactive"
                whileHover={{ scale: 1.05 }}
                onClick={(e) => {
                  e.stopPropagation()
                  window.open(project.liveUrl, '_blank')
                }}
              >
                <ExternalLink size={16} className="mr-2" />
                Live Demo
              </motion.button>
            )}
            {project.githubUrl && (
              <motion.button
                className="flex items-center text-egyshyr-gray hover:text-egyshyr-white transition-colors text-sm font-inter interactive"
                whileHover={{ scale: 1.05 }}
                onClick={(e) => {
                  e.stopPropagation()
                  window.open(project.githubUrl, '_blank')
                }}
              >
                <Github size={16} className="mr-2" />
                Code
              </motion.button>
            )}
          </div>
        </div>
      </div>
    </motion.div>
  )
}

const ProjectModal: React.FC<{ 
  project: Project | null; 
  isOpen: boolean; 
  onClose: () => void 
}> = ({ project, isOpen, onClose }) => {
  if (!project) return null

  return (
    <AnimatePresence>
      {isOpen && (
        <motion.div
          className="fixed inset-0 z-50 flex items-center justify-center p-6"
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
        >
          {/* Backdrop */}
          <motion.div
            className="absolute inset-0 bg-egyshyr-black/80 backdrop-blur-sm"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={onClose}
          />

          {/* Modal Content */}
          <motion.div
            className="relative bg-egyshyr-darker-gray border border-egyshyr-blue/30 rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
            initial={{ scale: 0.8, opacity: 0 }}
            animate={{ scale: 1, opacity: 1 }}
            exit={{ scale: 0.8, opacity: 0 }}
            transition={{ type: "spring", duration: 0.5 }}
          >
            {/* Close Button */}
            <button
              onClick={onClose}
              className="absolute top-4 right-4 z-10 bg-egyshyr-black/50 backdrop-blur-sm rounded-full p-2 text-egyshyr-white hover:text-egyshyr-blue transition-colors interactive"
            >
              <X size={24} />
            </button>

            {/* Image */}
            <div className="relative h-80 overflow-hidden rounded-t-xl">
              <img
                src={project.image}
                alt={project.title}
                className="w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-egyshyr-darker-gray via-transparent to-transparent" />
            </div>

            {/* Content */}
            <div className="p-8">
              <div className="flex items-start justify-between mb-6">
                <div>
                  <h2 className="text-3xl font-orbitron font-bold text-egyshyr-white mb-2">
                    {project.title}
                  </h2>
                  <span className="inline-block px-3 py-1 bg-egyshyr-blue/20 border border-egyshyr-blue/30 rounded-full text-egyshyr-blue text-sm font-rajdhani font-medium">
                    {project.category}
                  </span>
                </div>
              </div>

              <p className="text-egyshyr-gray font-inter leading-relaxed mb-8">
                {project.description}
              </p>

              {/* Technologies */}
              <div className="mb-8">
                <h3 className="text-xl font-orbitron font-semibold text-egyshyr-white mb-4">
                  Technologies Used
                </h3>
                <div className="flex flex-wrap gap-3">
                  {project.technologies.map((tech) => (
                    <span
                      key={tech}
                      className="px-4 py-2 bg-gradient-to-r from-egyshyr-blue/20 to-egyshyr-purple/20 border border-egyshyr-blue/30 rounded-lg text-egyshyr-white font-inter"
                    >
                      {tech}
                    </span>
                  ))}
                </div>
              </div>

              {/* Action Buttons */}
              <div className="flex flex-col sm:flex-row gap-4">
                {project.liveUrl && (
                  <motion.button
                    className="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold hover:shadow-glow interactive"
                    whileHover={{ scale: 1.05 }}
                    whileTap={{ scale: 0.95 }}
                    onClick={() => window.open(project.liveUrl, '_blank')}
                  >
                    <ExternalLink size={20} className="mr-2" />
                    View Live Project
                  </motion.button>
                )}
                {project.githubUrl && (
                  <motion.button
                    className="flex items-center justify-center px-6 py-3 border-2 border-egyshyr-blue/50 rounded-lg text-egyshyr-blue font-semibold hover:bg-egyshyr-blue/10 interactive"
                    whileHover={{ scale: 1.05, borderColor: '#00FFFF' }}
                    whileTap={{ scale: 0.95 }}
                    onClick={() => window.open(project.githubUrl, '_blank')}
                  >
                    <Github size={20} className="mr-2" />
                    View Source Code
                  </motion.button>
                )}
              </div>
            </div>
          </motion.div>
        </motion.div>
      )}
    </AnimatePresence>
  )
}

const ProjectsSection: React.FC = () => {
  const [selectedProject, setSelectedProject] = useState<Project | null>(null)
  const [isModalOpen, setIsModalOpen] = useState(false)

  const openModal = (project: Project) => {
    setSelectedProject(project)
    setIsModalOpen(true)
  }

  const closeModal = () => {
    setIsModalOpen(false)
    setTimeout(() => setSelectedProject(null), 300)
  }

  return (
    <section id="projects" className="py-20 px-6 relative overflow-hidden">
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
            className="inline-block px-4 py-2 bg-egyshyr-purple/10 border border-egyshyr-purple/30 rounded-full text-egyshyr-purple text-sm font-rajdhani font-medium mb-4"
            whileHover={{ scale: 1.05 }}
          >
            Our Work
          </motion.span>
          
          <h2 className="text-4xl md:text-6xl font-orbitron font-bold text-egyshyr-white mb-6">
            Featured
            <span className="block bg-gradient-to-r from-egyshyr-purple via-egyshyr-blue to-egyshyr-green bg-clip-text text-transparent">
              Projects
            </span>
          </h2>
          
          <p className="text-xl text-egyshyr-gray font-inter max-w-2xl mx-auto leading-relaxed">
            Explore our portfolio of innovative solutions that have transformed 
            businesses and delivered exceptional user experiences.
          </p>
        </motion.div>

        {/* Projects Gallery */}
        <div className="relative">
          <div className="flex gap-8 overflow-x-auto pb-8 scrollbar-hide">
            {projects.map((project, index) => (
              <ProjectCard
                key={project.id}
                project={project}
                index={index}
                onOpen={() => openModal(project)}
              />
            ))}
          </div>

          {/* Scroll Indicators */}
          <div className="flex justify-center mt-8">
            <div className="flex gap-2">
              {projects.map((_, index) => (
                <div
                  key={index}
                  className="w-2 h-2 bg-egyshyr-blue/30 rounded-full"
                />
              ))}
            </div>
          </div>
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
            className="px-8 py-4 bg-gradient-to-r from-egyshyr-purple to-egyshyr-blue rounded-lg text-white font-semibold text-lg hover:shadow-glow interactive glow-on-hover"
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.95 }}
          >
            View All Projects
          </motion.button>
        </motion.div>
      </div>

      {/* Project Modal */}
      <ProjectModal
        project={selectedProject}
        isOpen={isModalOpen}
        onClose={closeModal}
      />
    </section>
  )
}

export default ProjectsSection