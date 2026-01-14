/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      screens: {
        's': {'max': '650px'}, // شاشة صغيرة جدًا
        'xs': {'max': '527px'}, // شاشة صغيرة جدًا
        'short': {'raw': '(max-height: 720px)'},
      },
      colors: {
        'neon-purple': '#8B5CF6',
        'neon-cyan': '#FF66B2',
        'neon-pink': '#EC4899',
        'electric-blue': '#FF2D95',
        'deep-charcoal': '#1A1A1A',
        'jet-black': '#0A0A0A',
        // Logo-inspired professional colors
        'logo-blue': '#FF2D95',
        'logo-navy': '#FF2D95',
        'logo-teal': '#D946EF',
        'logo-emerald': '#610596ff',
        'logo-indigo': '#D946EF',
        'logo-slate': '#475569',
        'logo-gray': '#C0C0C0',
      },
      fontFamily: {
        'space': ['Space Grotesk', 'sans-serif'],
        'inter': ['Inter', 'sans-serif'],
        'sora': ['Sora', 'sans-serif'],
      },
      animation: {
        'float': 'float 6s ease-in-out infinite',
        'glow': 'glow 2s ease-in-out infinite alternate',
        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        'spin-slow': 'spin 8s linear infinite',
        'bounce-slow': 'bounce 3s infinite',
        'gradient-x': 'gradient-x 3s ease infinite',
        'float-slow': 'float-slow 20s ease-in-out infinite',
        'gradient-shift': 'gradient-shift 3s ease infinite',
        'neon-pulse': 'neon-pulse 2s ease-in-out infinite',
        'orbit': 'orbit 20s linear infinite',
        'glitch': 'glitch 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) both infinite',
        'rotate-y': 'rotate-y 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-20px)' },
        },
        glow: {
          '0%': { boxShadow: '0 0 5px #8B5CF6, 0 0 10px #8B5CF6, 0 0 15px #8B5CF6' },
          '100%': { boxShadow: '0 0 10px #8B5CF6, 0 0 20px #8B5CF6, 0 0 30px #8B5CF6' },
        },
        'gradient-x': {
          '0%, 100%': {
            'background-size': '200% 200%',
            'background-position': 'left center'
          },
          '50%': {
            'background-size': '200% 200%',
            'background-position': 'right center'
          }
        },
        'float-slow': {
          '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
          '50%': { transform: 'translateY(-30px) rotate(180deg)' },
        },
        'gradient-shift': {
          '0%, 100%': { 'background-position': '0% 50%' },
          '50%': { 'background-position': '100% 50%' },
        },
        'neon-pulse': {
          '0%, 100%': { 
            boxShadow: '0 0 5px currentColor, 0 0 10px currentColor, 0 0 15px currentColor'
          },
          '50%': { 
            boxShadow: '0 0 10px currentColor, 0 0 20px currentColor, 0 0 30px currentColor'
          },
        },
        orbit: {
          'from': { transform: 'rotate(0deg) translateX(20px) rotate(0deg)' },
          'to': { transform: 'rotate(360deg) translateX(20px) rotate(-360deg)' },
        },
        glitch: {
          '0%': { transform: 'translate(0)' },
          '20%': { transform: 'translate(-2px, 2px)' },
          '40%': { transform: 'translate(-2px, -2px)' },
          '60%': { transform: 'translate(2px, 2px)' },
          '80%': { transform: 'translate(2px, -2px)' },
          '100%': { transform: 'translate(0)' },
        },
        'rotate-y': {
          'from': { transform: 'rotateY(0deg)' },
          'to': { transform: 'rotateY(12deg)' },
        },
      },
      backdropBlur: {
        'xs': '2px',
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
        'neon-gradient': 'linear-gradient(45deg, #000000ff, #d406c3ff, #EC4899, #f03bf6ff)',
        'logo-gradient': 'linear-gradient(45deg, #df0000ff, #4338CA, #0F766E, #059669)',
        'logo-gradient-subtle': 'linear-gradient(135deg, rgba(30, 64, 175, 0.1), rgba(67, 56, 202, 0.1), rgba(15, 118, 110, 0.1))',
        'creative-pattern': 'radial-gradient(circle at 1px 1px, rgba(139, 92, 246, 0.3) 1px, transparent 0)',
        'hexagonal-pattern': 'url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%238B5CF6\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")',
      },
      backgroundSize: {
        '50': '50px',
        '60': '60px',
      },
      transformStyle: {
        'preserve-3d': 'preserve-3d',
      },
      perspective: {
        '1000': '1000px',
      },
      rotate: {
        'y-12': 'rotateY(12deg)',
      },
      transitionTimingFunction: {
        'creative': 'cubic-bezier(0.23, 1, 0.32, 1)',
        'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
        'bounce': 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
      },
      boxShadow: {
        'neon-purple': '0 0 20px rgba(139, 92, 246, 0.5)',
        'neon-cyan': '0 0 20px rgba(6, 182, 212, 0.5)',
        'neon-pink': '0 0 20px rgba(236, 72, 153, 0.5)',
        'creative': '0 25px 50px rgba(139, 92, 246, 0.15)',
      },
    },
  },
  plugins: [],
}
