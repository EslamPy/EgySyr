import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/react/main.tsx'
            ],
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/react'),
            '@components': resolve(__dirname, 'resources/react/components'),
            '@pages': resolve(__dirname, 'resources/react/pages'),
            '@animations': resolve(__dirname, 'resources/react/animations'),
            '@assets': resolve(__dirname, 'resources/react/assets'),
            '@utils': resolve(__dirname, 'resources/react/utils'),
        },
    },
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true
            }
        },
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['react', 'react-dom'],
                    three: ['three', '@react-three/fiber', '@react-three/drei'],
                    animations: ['framer-motion', 'gsap', 'lottie-react'],
                },
            },
        },
    },
    optimizeDeps: {
        include: ['three', '@react-three/fiber', '@react-three/drei'],
    },
});
