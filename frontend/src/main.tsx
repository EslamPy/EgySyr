import React from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter } from 'react-router-dom'
import { Toaster } from 'react-hot-toast'
import App from './App.tsx'
import './index.css'

ReactDOM.createRoot(document.getElementById('root')!).render(
  <React.StrictMode>
    <BrowserRouter>
      <App />
      <Toaster
        position="top-right"
        toastOptions={{
          duration: 4000,
          style: {
            background: '#1A1A1A',
            color: '#FFFFFF',
            border: '1px solid #00FFFF',
            borderRadius: '8px',
          },
          success: {
            iconTheme: {
              primary: '#00FF88',
              secondary: '#1A1A1A',
            },
          },
          error: {
            iconTheme: {
              primary: '#FF6B6B',
              secondary: '#1A1A1A',
            },
          },
        }}
      />
    </BrowserRouter>
  </React.StrictMode>,
)