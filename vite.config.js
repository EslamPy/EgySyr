import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    
    // Performance optimizations
    build: {
        // Code splitting for better caching
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'],
                    // Split large libraries into separate chunks
                },
                // Optimize chunk file naming
                chunkFileNames: 'assets/js/[name]-[hash].js',
                entryFileNames: 'assets/js/[name]-[hash].js',
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    if (/\.(png|jpe?g|svg|gif|tiff|bmp|ico)$/i.test(assetInfo.name)) {
                        return `assets/images/[name]-[hash].${ext}`;
                    }
                    if (/\.(woff2?|eot|ttf|otf)$/i.test(assetInfo.name)) {
                        return `assets/fonts/[name]-[hash].${ext}`;
                    }
                    return `assets/${ext}/[name]-[hash].${ext}`;
                }
            }
        },
        
        // Minification and optimization
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true, // Remove console.logs in production
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
            },
            mangle: {
                safari10: true,
            },
        },
        
        // Asset optimization
        assetsInlineLimit: 4096, // Inline assets smaller than 4kb
        cssCodeSplit: true, // Enable CSS code splitting
        sourcemap: false, // Disable sourcemaps in production for smaller files
        
        // Chunk size warnings
        chunkSizeWarningLimit: 1000, // Warn about chunks larger than 1MB
    },
    
    // CSS optimization
    css: {
        devSourcemap: true,
        postcss: {
            plugins: [
                // Add PostCSS plugins if needed
            ],
        },
    },
    
    // Server optimization for development
    server: {
        hmr: {
            overlay: false, // Disable error overlay for better performance
        },
        // Enable compression
        compress: true,
    },
    
    // Preview server optimization
    preview: {
        // Enable compression for preview
        compress: true,
    },
    
    // Define global constants for performance
    define: {
        __DEV__: JSON.stringify(process.env.NODE_ENV === 'development'),
        __PROD__: JSON.stringify(process.env.NODE_ENV === 'production'),
    },
    
    // Optimize dependencies
    optimizeDeps: {
        include: [
            'axios',
        ],
        exclude: [
            // Exclude large dependencies that don't need optimization
        ],
    },
    
    // Asset processing
    assetsInclude: [
        '**/*.webp',
        '**/*.avif',
    ],
});
