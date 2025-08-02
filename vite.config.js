import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/style.css',
                'resources/css/splide.min.css',
                'resources/js/app.js',
                'resources/js/dashboard.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'],
                    ui: ['resources/js/splide.min.js'],
                },
            },
        },
        sourcemap: false,
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
            },
        },
        cssMinify: true,
        chunkSizeWarningLimit: 1000,
    },
    optimizeDeps: {
        include: ['axios'],
    },
    resolve: {
        alias: {
            '@': resolve(__dirname, 'resources/js'),
            '@css': resolve(__dirname, 'resources/css'),
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
