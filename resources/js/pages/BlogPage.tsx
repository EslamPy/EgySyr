import React, { useState } from 'react'
import { motion, AnimatePresence } from 'framer-motion'
import PageTransition from '../components/PageTransition.tsx'
import Footer from '../components/Footer.tsx'

const BlogPage: React.FC = () => {
  const [activeCategory, setActiveCategory] = useState('All')
  const [selectedPost, setSelectedPost] = useState<any>(null)

  const categories = ['All', 'Technology', 'Design', 'Development', 'AI', 'Business']

  const blogPosts = [
    {
      id: 1,
      title: 'The Future of Web Development: Trends to Watch in 2024',
      excerpt: 'Explore the latest trends shaping the future of web development, from AI integration to advanced frameworks.',
      content: `
        <h2>Introduction</h2>
        <p>The web development landscape is evolving at an unprecedented pace. As we move through 2024, several key trends are reshaping how we build and interact with web applications.</p>

        <h2>AI Integration</h2>
        <p>Artificial Intelligence is no longer a futuristic concept—it's becoming an integral part of modern web development. From automated code generation to intelligent user interfaces, AI is transforming how we approach development.</p>

        <h2>Advanced Frameworks</h2>
        <p>New frameworks and libraries are emerging that prioritize performance, developer experience, and maintainability. These tools are making it easier than ever to build complex, scalable applications.</p>

        <h2>Conclusion</h2>
        <p>The future of web development is bright, with exciting innovations on the horizon. Staying updated with these trends will be crucial for developers looking to remain competitive in the field.</p>`,
      category: 'Technology',
      date: '2024-01-15',
      readTime: '5 min read',
      image: (
        <svg className="w-full h-full text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
      ),
      author: 'Sarah Chen',
      authorRole: 'Senior Developer'
    },
    {
      id: 2,
      title: 'Building Scalable Applications with Modern Architecture',
      excerpt: 'Learn how to design and build applications that can scale with your business growth.',
      content: `
        <h2>Understanding Scalability</h2>
        <p>Scalability is the ability of a system to handle increased load without compromising performance. In modern web development, this means designing applications that can grow with your user base.</p>

        <h2>Microservices Architecture</h2>
        <p>Breaking down monolithic applications into smaller, manageable services allows for better scalability, maintainability, and team collaboration.</p>

        <h2>Database Optimization</h2>
        <p>Proper database design and optimization strategies are crucial for maintaining performance as your application scales.</p>
      `,
      category: 'Development',
      date: '2024-01-10',
      readTime: '8 min read',
      image: (
        <svg className="w-full h-full text-neon-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
      ),
      author: 'Michael Rodriguez',
      authorRole: 'Solutions Architect'
    },
    {
      id: 3,
      title: 'AI-Powered User Experiences: The Next Frontier',
      excerpt: 'Discover how artificial intelligence is revolutionizing user experience design.',
      content: `
        <h2>The AI Revolution in UX</h2>
        <p>Artificial Intelligence is transforming how users interact with digital products, creating more personalized and intuitive experiences.</p>

        <h2>Personalization at Scale</h2>
        <p>AI enables unprecedented levels of personalization, adapting interfaces and content to individual user preferences and behaviors.</p>

        <h2>Predictive Interfaces</h2>
        <p>Machine learning algorithms can predict user needs and proactively provide relevant information and functionality.</p>
      `,
      category: 'AI',
      date: '2024-01-05',
      readTime: '6 min read',
      image: (
        <svg className="w-full h-full text-neon-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
        </svg>
      ),
      author: 'Dr. Emily Watson',
      authorRole: 'AI Research Lead'
    },
    {
      id: 4,
      title: 'Design Systems That Scale: Best Practices',
      excerpt: 'Creating consistent, maintainable design systems for growing organizations.',
      content: `
        <h2>The Foundation of Great Design</h2>
        <p>Design systems provide the foundation for consistent, scalable user interfaces across products and teams.</p>

        <h2>Component Libraries</h2>
        <p>Building reusable component libraries ensures consistency while reducing development time and maintenance overhead.</p>

        <h2>Documentation and Governance</h2>
        <p>Proper documentation and governance processes are essential for maintaining design system quality and adoption.</p>
      `,
      category: 'Design',
      date: '2023-12-28',
      readTime: '7 min read',
      image: (
        <svg className="w-full h-full text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
        </svg>
      ),
      author: 'Alex Thompson',
      authorRole: 'Design Director'
    },
    {
      id: 5,
      title: 'Digital Transformation: A Strategic Approach',
      excerpt: 'How businesses can successfully navigate their digital transformation journey.',
      content: `
        <h2>Understanding Digital Transformation</h2>
        <p>Digital transformation is more than just adopting new technologies—it's about fundamentally changing how businesses operate and deliver value.</p>

        <h2>Strategic Planning</h2>
        <p>Successful digital transformation requires careful planning, stakeholder buy-in, and a clear vision for the future.</p>

        <h2>Implementation Challenges</h2>
        <p>Organizations must navigate technical, cultural, and operational challenges to achieve successful transformation.</p>`,
      category: 'Business',
      date: '2023-12-20',
      readTime: '10 min read',
      image: (
        <svg className="w-full h-full text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
      ),
      author: 'David Kim',
      authorRole: 'Business Strategy Lead'
    },
    {
      id: 6,
      title: 'Performance Optimization: Making Web Apps Lightning Fast',
      excerpt: 'Techniques and strategies to optimize your web applications for maximum performance.',
      content: `
        <h2>The Need for Speed</h2>
        <p>In today's fast-paced digital world, performance is crucial for user satisfaction and business success.</p>

        <h2>Optimization Techniques</h2>
        <p>From code splitting to image optimization, there are numerous techniques to improve application performance.</p>

        <h2>Monitoring and Measurement</h2>
        <p>Continuous monitoring and measurement are essential for maintaining optimal performance over time.</p>`,
      category: 'Development',
      date: '2023-12-15',
      readTime: '9 min read',
      image: (
        <svg className="w-full h-full text-neon-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
      ),
      author: 'Lisa Park',
      authorRole: 'Performance Engineer'
    }
  ]

  const filteredPosts = activeCategory === 'All'
    ? blogPosts
    : blogPosts.filter(post => post.category === activeCategory)

  // Blog Post Detail View
  if (selectedPost) {
    return (
      <PageTransition>
        <div className="min-h-screen pt-24 pb-16">
          {/* Back Button */}
          <div className="max-w-4xl mx-auto px-6 mb-8">
            <motion.button
              onClick={() => setSelectedPost(null)}
              className="flex items-center gap-2 text-neon-purple hover:text-neon-pink transition-colors duration-300"
              whileHover={{ x: -5 }}
              transition={{ type: "spring", stiffness: 300, damping: 20 }}
            >
              <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
              </svg>
              Back to Blog
            </motion.button>
          </div>

          {/* Article Header */}
          <article className="max-w-4xl mx-auto px-6">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              className="mb-12"
            >
              {/* Category Badge */}
              <div className="inline-block px-4 py-2 bg-gradient-to-r from-neon-purple/20 to-neon-pink/20 backdrop-blur-sm border border-neon-purple/30 rounded-full text-neon-purple text-sm font-medium mb-6">
                {selectedPost.category}
              </div>

              {/* Title */}
              <h1 className="text-4xl md:text-5xl lg:text-6xl font-black mb-8 leading-tight text-white">
                {selectedPost.title}
              </h1>

              {/* Meta Info */}
              <div className="flex flex-wrap items-center gap-6 text-gray-400 mb-8">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 bg-gradient-to-r from-neon-purple to-neon-pink rounded-full flex items-center justify-center">
                    <span className="text-white font-bold text-sm">
                      {selectedPost.author.split(' ').map((n: string) => n[0]).join('')}
                    </span>
                  </div>
                  <div>
                    <div className="text-white font-medium">{selectedPost.author}</div>
                    <div className="text-sm">{selectedPost.authorRole}</div>
                  </div>
                </div>
                <span>•</span>
                <span>{new Date(selectedPost.date).toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric'
                })}</span>
                <span>•</span>
                <span>{selectedPost.readTime}</span>
              </div>

              {/* Featured Image */}
              <div className="w-full h-64 bg-gradient-to-br from-neon-purple/20 via-neon-pink/20 to-neon-cyan/20 rounded-2xl flex items-center justify-center mb-12 border border-white/10">
                <div className="w-24 h-24">
                  {selectedPost.image}
                </div>
              </div>
            </motion.div>

            {/* Article Content */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
              className="prose prose-lg prose-invert max-w-none"
              dangerouslySetInnerHTML={{ __html: selectedPost.content }}
            />

            {/* Share Section */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.4 }}
              className="mt-16 pt-8 border-t border-white/10"
            >
              <h3 className="text-xl font-bold text-white mb-4">Share this article</h3>
              <div className="flex gap-4">
                {['Twitter', 'LinkedIn', 'Facebook'].map((platform) => (
                  <motion.button
                    key={platform}
                    className="px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 hover:text-white hover:border-neon-purple/50 transition-all duration-300"
                    whileHover={{ scale: 1.05 }}
                  >
                    {platform}
                  </motion.button>
                ))}
              </div>
            </motion.div>
          </article>
        </div>
        <Footer />
      </PageTransition>
    )
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
              <span className="inline-block px-4 py-2 bg-neon-pink/20 backdrop-blur-sm border border-neon-pink/30 rounded-full text-neon-pink text-sm font-medium mb-6">
                Our Blog
              </span>
            </motion.div>

            <motion.h1
              className="text-5xl md:text-7xl font-bold mb-8 leading-tight"
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.2 }}
            >
              Insights &{' '}
              <span className="bg-neon-gradient bg-clip-text text-transparent">
                Innovation
              </span>
            </motion.h1>

            <motion.p
              className="text-xl text-gray-300 max-w-3xl mx-auto"
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.4 }}
            >
              Stay updated with the latest trends, insights, and innovations in technology and design.
            </motion.p>
          </div>
        </section>

        {/* Category Filter */}
        <section className="py-12">
          <div className="max-w-7xl mx-auto px-6">
            <motion.div
              className="flex flex-wrap justify-center gap-4 mb-12"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8, delay: 0.6 }}
            >
              {categories.map((category, index) => (
                <motion.button
                  key={category}
                  className={`px-6 py-3 rounded-full font-medium transition-all duration-300 ${
                    activeCategory === category
                      ? 'bg-neon-gradient text-white shadow-lg shadow-neon-purple/25'
                      : 'bg-deep-charcoal/50 text-gray-300 hover:bg-neon-purple/20 hover:text-white border border-neon-purple/20'
                  }`}
                  onClick={() => setActiveCategory(category)}
                  whileHover={{ scale: 1.05, y: -2 }}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.5, delay: index * 0.1 }}
                >
                  {category}
                  
                  {/* Glow effect for active category */}
                  {activeCategory === category && (
                    <motion.div
                      className="absolute inset-0 bg-neon-gradient opacity-50 blur-lg rounded-full -z-10"
                      layoutId="categoryGlow"
                      initial={{ opacity: 0 }}
                      animate={{ opacity: 0.5 }}
                      transition={{ duration: 0.3 }}
                    />
                  )}
                </motion.button>
              ))}
            </motion.div>
          </div>
        </section>

        {/* Blog Posts Grid */}
        <section className="py-12">
          <div className="max-w-7xl mx-auto px-6">
            <AnimatePresence mode="wait">
              <motion.div
                key={activeCategory}
                className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                transition={{ duration: 0.5 }}
              >
                {filteredPosts.map((post, index) => (
                  <motion.article
                    key={post.id}
                    className="group relative cursor-pointer"
                    initial={{ opacity: 0, y: 50 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: index * 0.1 }}
                    whileHover={{ y: -10 }}
                    onClick={() => setSelectedPost(post)}
                  >
                    {/* Modern Blog Card */}
                    <div className="relative h-full bg-gradient-to-br from-white/10 via-white/5 to-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl overflow-hidden group-hover:border-white/40 transition-all duration-500 shadow-2xl group-hover:shadow-[0_25px_50px_-12px_rgba(139,92,246,0.3)]">

                      {/* Featured Image Area */}
                      <div className="relative h-48 bg-gradient-to-br from-neon-purple/20 via-neon-pink/20 to-neon-cyan/20 flex items-center justify-center border-b border-white/10">
                        <div className="w-16 h-16 opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                          {post.image}
                        </div>

                        {/* Category Badge */}
                        <div className="absolute top-4 left-4 px-3 py-1 bg-black/50 backdrop-blur-sm border border-white/20 rounded-full text-white text-xs font-medium">
                          {post.category}
                        </div>

                        {/* Gradient Overlay */}
                        <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" />
                      </div>

                      {/* Content Area */}
                      <div className="p-8">
                        {/* Title */}
                        <h3 className="text-2xl font-bold mb-4 text-white group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-neon-purple group-hover:to-neon-pink group-hover:bg-clip-text transition-all duration-300 leading-tight">
                          {post.title}
                        </h3>

                        {/* Excerpt */}
                        <p className="text-gray-300 mb-6 leading-relaxed line-clamp-3 group-hover:text-gray-200 transition-colors duration-300">
                          {post.excerpt}
                        </p>

                        {/* Author & Meta Info */}
                        <div className="flex items-center justify-between">
                          <div className="flex items-center gap-3">
                            <div className="w-8 h-8 bg-gradient-to-r from-neon-purple to-neon-pink rounded-full flex items-center justify-center">
                              <span className="text-white font-bold text-xs">
                                {post.author.split(' ').map((n: string) => n[0]).join('')}
                              </span>
                            </div>
                            <div>
                              <div className="text-white text-sm font-medium">{post.author}</div>
                              <div className="text-gray-400 text-xs">{post.authorRole}</div>
                            </div>
                          </div>

                          <div className="text-right">
                            <div className="text-gray-400 text-sm">{post.readTime}</div>
                            <div className="text-gray-500 text-xs">{new Date(post.date).toLocaleDateString()}</div>
                          </div>
                        </div>

                        {/* Read More Button */}
                        <motion.div
                          className="mt-6 flex items-center gap-2 text-neon-purple font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                          whileHover={{ x: 5 }}
                          transition={{ type: "spring", stiffness: 300, damping: 20 }}
                        >
                          <span>Read Article</span>
                          <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                          </svg>
                        </motion.div>
                      </div>

                      {/* Hover Glow Effect */}
                      <div className="absolute inset-0 bg-gradient-to-br from-neon-purple/5 via-neon-pink/5 to-neon-cyan/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl" />
                    </div>
                  </motion.article>
                ))}
              </motion.div>
            </AnimatePresence>
          </div>
        </section>

        {/* Newsletter CTA */}
        <section className="py-20">
          <div className="max-w-4xl mx-auto px-6 text-center">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.8 }}
              viewport={{ once: true }}
              className="p-12 bg-gradient-to-br from-neon-cyan/10 to-neon-pink/10 backdrop-blur-sm border border-neon-cyan/20 rounded-3xl"
            >
              <h2 className="text-4xl md:text-5xl font-bold mb-6">
                Stay{' '}
                <span className="bg-neon-gradient bg-clip-text text-transparent">
                  Updated
                </span>
              </h2>
              
              <p className="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter and never miss the latest insights and updates.
              </p>

              <div className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input
                  type="email"
                  placeholder="Enter your email"
                  className="flex-1 px-6 py-3 bg-deep-charcoal/50 border border-neon-cyan/30 rounded-full text-white placeholder-gray-400 focus:outline-none focus:border-neon-cyan focus:ring-2 focus:ring-neon-cyan/20"
                />
                <motion.button
                  className="px-8 py-3 bg-neon-gradient text-white font-semibold rounded-full hover:shadow-lg hover:shadow-neon-cyan/25 transition-all duration-300"
                  whileHover={{ scale: 1.05 }}
                >
                  Subscribe
                </motion.button>
              </div>
            </motion.div>
          </div>
        </section>
      </div>
      <Footer />
    </PageTransition>
  )
}

export default BlogPage
