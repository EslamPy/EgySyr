import React from 'react'
import PageTransition from '../components/PageTransition'

const ThankYouPage: React.FC = () => {
  return (
    <PageTransition>
      <div className="min-h-screen bg-jet-black text-white flex items-center justify-center">
        <div className="text-center px-6">
          <h1 className="text-4xl font-bold mb-2">Thank you!</h1>
          <p className="text-gray-400">Your feedback has been submitted and is pending review.</p>
        </div>
      </div>
    </PageTransition>
  )
}

export default ThankYouPage 