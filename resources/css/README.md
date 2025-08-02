# CSS Assets Documentation

## Overview

This directory contains custom CSS stylesheets for the Laravel Blog CMS application. The project primarily uses TailwindCSS for utility-first styling, with custom CSS for specific components and overrides.

## File Structure

```
resources/css/
├── README.md           # This documentation file
├── app.css            # Main application stylesheet
├── components/        # Component-specific styles
├── utilities/         # Custom utility classes
└── overrides/         # Framework overrides
```

## Styling Approach

### TailwindCSS (Primary)
The application uses TailwindCSS as the primary CSS framework, providing:
- Utility-first CSS approach
- Responsive design utilities
- Consistent spacing and sizing
- Built-in dark mode support
- Component extraction capabilities

### Custom CSS (Secondary)
Custom CSS is used for:
- Complex animations
- Framework overrides
- Specific component styling
- Browser compatibility fixes

## CSS Architecture

### 1. Utility-First Approach
```html
<!-- TailwindCSS utilities for quick styling -->
<div class="bg-white rounded-lg shadow-md p-6 mb-4">
    <h2 class="text-2xl font-bold text-gray-900 mb-2">Article Title</h2>
    <p class="text-gray-600 leading-relaxed">Article content...</p>
</div>
```

### 2. Component Classes
```css
/* Custom component classes when utilities become repetitive */
.article-card {
    @apply bg-white rounded-lg shadow-md p-6 mb-4 hover:shadow-lg transition-shadow duration-300;
}

.btn-primary {
    @apply bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200;
}
```

### 3. Responsive Design
```css
/* Mobile-first responsive design */
.hero-section {
    @apply py-8 px-4;
}

@screen md {
    .hero-section {
        @apply py-16 px-8;
    }
}

@screen lg {
    .hero-section {
        @apply py-24 px-12;
    }
}
```

## Color Palette

### Primary Colors
```css
:root {
    --color-primary: #3B82F6;      /* Blue 600 */
    --color-primary-dark: #2563EB; /* Blue 700 */
    --color-primary-light: #60A5FA; /* Blue 400 */
}
```

### Semantic Colors
```css
:root {
    --color-success: #10B981;      /* Green 600 */
    --color-warning: #F59E0B;      /* Yellow 600 */
    --color-error: #EF4444;        /* Red 600 */
    --color-info: #3B82F6;         /* Blue 600 */
}
```

### Neutral Colors
```css
:root {
    --color-gray-50: #F9FAFB;
    --color-gray-100: #F3F4F6;
    --color-gray-500: #6B7280;
    --color-gray-900: #111827;
}
```

## Typography

### Font Stack
```css
.font-sans {
    font-family: 'Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', sans-serif;
}

.font-serif {
    font-family: 'Georgia', 'Times New Roman', serif;
}

.font-mono {
    font-family: 'JetBrains Mono', 'Monaco', 'Consolas', monospace;
}
```

### Typography Scale
```css
/* Heading sizes */
.text-xs { font-size: 0.75rem; }    /* 12px */
.text-sm { font-size: 0.875rem; }   /* 14px */
.text-base { font-size: 1rem; }     /* 16px */
.text-lg { font-size: 1.125rem; }   /* 18px */
.text-xl { font-size: 1.25rem; }    /* 20px */
.text-2xl { font-size: 1.5rem; }    /* 24px */
.text-3xl { font-size: 1.875rem; }  /* 30px */
.text-4xl { font-size: 2.25rem; }   /* 36px */
```

## Component Styling Guidelines

### Article Cards
```css
.article-card {
    @apply bg-white rounded-lg shadow-md overflow-hidden;
    @apply hover:shadow-lg transition-shadow duration-300;
}

.article-card img {
    @apply w-full h-48 object-cover;
}

.article-card .content {
    @apply p-6;
}

.article-card .title {
    @apply text-xl font-semibold text-gray-900 mb-2;
}

.article-card .excerpt {
    @apply text-gray-600 mb-4 leading-relaxed;
}
```

### Buttons
```css
/* Base button styles */
.btn {
    @apply inline-flex items-center px-4 py-2 rounded font-medium;
    @apply transition-colors duration-200 focus:outline-none focus:ring-2;
}

/* Button variants */
.btn-primary {
    @apply bg-blue-600 text-white hover:bg-blue-700;
    @apply focus:ring-blue-500 focus:ring-offset-2;
}

.btn-secondary {
    @apply bg-gray-200 text-gray-900 hover:bg-gray-300;
    @apply focus:ring-gray-500 focus:ring-offset-2;
}

.btn-success {
    @apply bg-green-600 text-white hover:bg-green-700;
    @apply focus:ring-green-500 focus:ring-offset-2;
}
```

### Forms
```css
/* Form input styles */
.form-input {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-md;
    @apply focus:outline-none focus:ring-blue-500 focus:border-blue-500;
    @apply placeholder-gray-400;
}

.form-textarea {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-md;
    @apply focus:outline-none focus:ring-blue-500 focus:border-blue-500;
    @apply placeholder-gray-400 resize-vertical;
}

.form-select {
    @apply block w-full px-3 py-2 border border-gray-300 rounded-md;
    @apply focus:outline-none focus:ring-blue-500 focus:border-blue-500;
    @apply bg-white;
}

/* Form validation states */
.form-input.error {
    @apply border-red-500 focus:border-red-500 focus:ring-red-500;
}

.form-input.success {
    @apply border-green-500 focus:border-green-500 focus:ring-green-500;
}
```

## Layout Components

### Container
```css
.container {
    @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
}

.container-narrow {
    @apply max-w-4xl mx-auto px-4 sm:px-6 lg:px-8;
}
```

### Grid System
```css
.grid-auto {
    @apply grid gap-6;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

.grid-blog {
    @apply grid gap-6 md:grid-cols-2 lg:grid-cols-3;
}
```

### Navigation
```css
.navbar {
    @apply bg-white shadow-sm border-b border-gray-200;
}

.navbar-brand {
    @apply text-xl font-bold text-gray-900;
}

.navbar-nav {
    @apply flex space-x-4;
}

.navbar-link {
    @apply text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md;
    @apply transition-colors duration-200;
}

.navbar-link.active {
    @apply text-blue-600 bg-blue-50;
}
```

## Animation and Transitions

### Hover Effects
```css
.hover-lift {
    @apply transition-transform duration-200;
}

.hover-lift:hover {
    @apply transform -translate-y-1;
}

.hover-shadow {
    @apply transition-shadow duration-300;
}

.hover-shadow:hover {
    @apply shadow-lg;
}
```

### Loading States
```css
.loading {
    @apply opacity-50 pointer-events-none;
}

.spinner {
    @apply animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600;
}

.pulse {
    @apply animate-pulse bg-gray-200 rounded;
}
```

### Page Transitions
```css
.page-enter {
    @apply opacity-0 transform translate-y-4;
}

.page-enter-active {
    @apply opacity-100 transform translate-y-0;
    @apply transition-all duration-300 ease-out;
}
```

## Responsive Design

### Breakpoints
```css
/* Tailwind CSS breakpoints */
/* sm: 640px */
/* md: 768px */
/* lg: 1024px */
/* xl: 1280px */
/* 2xl: 1536px */
```

### Mobile-First Approach
```css
/* Base styles (mobile) */
.hero {
    @apply text-center py-8;
}

/* Tablet styles */
@screen md {
    .hero {
        @apply py-16;
    }
}

/* Desktop styles */
@screen lg {
    .hero {
        @apply text-left py-24;
    }
}
```

## Dark Mode Support

### Dark Mode Classes
```css
/* Enable dark mode with class strategy */
.dark .bg-white {
    @apply bg-gray-900;
}

.dark .text-gray-900 {
    @apply text-gray-100;
}

.dark .text-gray-600 {
    @apply text-gray-400;
}
```

### Dark Mode Components
```css
.article-card {
    @apply bg-white dark:bg-gray-800;
    @apply text-gray-900 dark:text-gray-100;
    @apply border border-gray-200 dark:border-gray-700;
}
```

## Performance Optimization

### CSS Purging
```javascript
// tailwind.config.js
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    // This ensures unused CSS is removed in production
}
```

### Critical CSS
```css
/* Inline critical CSS for above-the-fold content */
.critical {
    /* Navigation styles */
    /* Hero section styles */
    /* Essential layout styles */
}
```

## Browser Compatibility

### Supported Features
- CSS Grid (IE 11+)
- Flexbox (IE 11+)
- CSS Custom Properties (IE 11 with polyfill)
- CSS Transforms (IE 9+)

### Fallbacks
```css
/* Flexbox fallback for older browsers */
.flex {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

/* Grid fallback */
.grid {
    display: -ms-grid;
    display: grid;
}
```

## Build Process

### Development
```bash
# Watch for changes and rebuild CSS
npm run dev

# Build CSS for development
npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --watch
```

### Production
```bash
# Build optimized CSS for production
npm run build

# Build with purging and minification
npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --minify
```

## Best Practices

### Naming Conventions
1. Use semantic class names for components
2. Follow BEM methodology for complex components
3. Use Tailwind utilities for simple styling
4. Create custom components for repeated patterns

### Performance
1. Use CSS custom properties for dynamic values
2. Minimize the use of custom CSS
3. Leverage Tailwind's purging feature
4. Optimize critical rendering path

### Maintainability
1. Document custom CSS thoroughly
2. Use consistent spacing and sizing
3. Follow mobile-first responsive design
4. Extract common patterns into components

## Debugging CSS

### Development Tools
```css
/* Debugging utility classes */
.debug-grid {
    background-image: 
        linear-gradient(rgba(255,0,0,0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,0,0,0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

.debug-outline * {
    outline: 1px solid red !important;
}
```

### Common Issues
1. **Specificity conflicts**: Use utility classes or increase specificity
2. **Responsive issues**: Check breakpoint order and mobile-first approach
3. **Performance**: Monitor CSS bundle size and purging effectiveness

This CSS documentation provides guidance for maintaining consistent, performant, and accessible styles throughout the Laravel Blog CMS application.