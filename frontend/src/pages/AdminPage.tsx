import React from 'react'
import { motion } from 'framer-motion'
import { Lock, ArrowLeft } from 'lucide-react'
import { useNavigate } from 'react-router-dom'

const AdminPage: React.FC = () => {
  const navigate = useNavigate()

  return (
    <div className="min-h-screen bg-egyshyr-black flex items-center justify-center px-6">
      <motion.div
        initial={{ opacity: 0, scale: 0.9 }}
        animate={{ opacity: 1, scale: 1 }}
        transition={{ duration: 0.5 }}
        className="max-w-md w-full bg-egyshyr-darker-gray border border-egyshyr-blue/30 rounded-xl p-8 text-center"
      >
        <motion.div
          className="text-egyshyr-blue mb-6"
          animate={{ rotate: [0, 10, -10, 0] }}
          transition={{ duration: 2, repeat: Infinity }}
        >
          <Lock size={64} className="mx-auto" />
        </motion.div>

        <h1 className="text-3xl font-orbitron font-bold text-egyshyr-white mb-4">
          Admin Access
        </h1>

        <p className="text-egyshyr-gray font-inter mb-8 leading-relaxed">
          This admin panel is currently under development. Full testimonials management 
          and content administration features will be available soon.
        </p>

        <div className="space-y-4">
          <motion.button
            onClick={() => navigate('/')}
            className="w-full px-6 py-3 bg-gradient-to-r from-egyshyr-blue to-egyshyr-purple rounded-lg text-white font-semibold hover:shadow-glow transition-all duration-300"
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
          >
            <ArrowLeft size={16} className="inline-block mr-2" />
            Back to Homepage
          </motion.button>

          <motion.div
            className="p-4 bg-egyshyr-blue/10 border border-egyshyr-blue/30 rounded-lg"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ delay: 0.5 }}
          >
            <p className="text-egyshyr-blue text-sm font-inter">
              🚀 Coming Soon: Testimonials management, content editing, analytics dashboard, and more!
            </p>
          </motion.div>
        </div>
      </motion.div>
    </div>
  )
}

export default AdminPage