# EgySyr Deployment Guide

🚀 **Complete deployment instructions for the EgySyr futuristic website**

## 📋 Prerequisites

- **Node.js** v18+ 
- **PHP** v8.1+
- **Composer** (for Laravel)
- **MySQL** v8.0+
- **Web Server** (Apache/Nginx)
- **SSL Certificate** (for HTTPS)

## 🎯 Production Deployment

### 1. Frontend Deployment (React)

#### Option A: Vercel Deployment (Recommended)
```bash
# Navigate to frontend directory
cd frontend

# Install Vercel CLI
npm install -g vercel

# Deploy to Vercel
vercel --prod

# Configure environment variables in Vercel dashboard:
# VITE_API_URL=https://your-api-domain.com/api
```

#### Option B: Manual Deployment
```bash
# Build for production
cd frontend
npm install
npm run build

# Upload dist/ folder to your web server
# Configure web server to serve index.html for all routes
```

### 2. Backend Deployment (Laravel)

#### Server Setup
```bash
# Clone repository
git clone <your-repo-url>
cd backend

# Install dependencies
composer install --optimize-autoloader --no-dev

# Environment configuration
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=egysyr_production
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
```

#### Web Server Configuration

**Nginx Configuration:**
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name api.egysyr.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name api.egysyr.com;
    
    ssl_certificate /path/to/ssl/cert.pem;
    ssl_certificate_key /path/to/ssl/private.key;
    
    root /var/www/egysyr/backend/public;
    index index.php;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🛠️ Local Development Setup

### Frontend Setup
```bash
cd frontend

# Install dependencies
npm install

# Start development server
npm run dev

# Available at http://localhost:3000
```

### Backend Setup
```bash
cd backend

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database
# Edit .env file with your database credentials

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Start development server
php artisan serve

# Available at http://localhost:8000
```

## 🔧 Environment Variables

### Frontend (.env)
```bash
VITE_API_URL=http://localhost:8000/api
VITE_APP_NAME=EgySyr
VITE_CONTACT_EMAIL=hello@egysyr.com
```

### Backend (.env)
```bash
APP_NAME="EgySyr Backend"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.egysyr.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=egysyr_production
DB_USERNAME=your-db-user
DB_PASSWORD=your-secure-password

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@egysyr.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@egysyr.com"
MAIL_FROM_NAME="EgySyr"

# CORS
FRONTEND_URL=https://egysyr.com
CORS_ALLOWED_ORIGINS=https://egysyr.com

# Additional Config
CONTACT_EMAIL=hello@egysyr.com
ADMIN_EMAIL=admin@egysyr.com
```

## 📈 Performance Optimization

### Frontend Optimizations
- ✅ Code splitting by routes
- ✅ Lazy loading for images and components
- ✅ Three.js asset optimization
- ✅ Bundle size optimization
- ✅ CDN for static assets

### Backend Optimizations
- ✅ Database indexing
- ✅ API rate limiting
- ✅ Laravel caching (config, routes, views)
- ✅ Optimized autoloader
- ✅ Database connection pooling

## 🔒 Security Considerations

### Frontend Security
- ✅ Environment variables for sensitive data
- ✅ HTTPS enforcement
- ✅ CSP headers configuration
- ✅ Input validation and sanitization

### Backend Security
- ✅ Rate limiting on API endpoints
- ✅ CORS configuration
- ✅ Input validation and sanitization
- ✅ SQL injection prevention
- ✅ XSS protection
- ✅ CSRF protection

## 📊 Monitoring & Analytics

### Recommended Tools
- **Frontend**: Vercel Analytics, Google Analytics
- **Backend**: Laravel Telescope, New Relic
- **Uptime**: Pingdom, UptimeRobot
- **Error Tracking**: Sentry, Bugsnag

## 🔄 CI/CD Pipeline

### GitHub Actions Example
```yaml
name: Deploy EgySyr

on:
  push:
    branches: [main]

jobs:
  deploy-frontend:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: actions/setup-node@v3
        with:
          node-version: '18'
      - name: Install and Build
        working-directory: ./frontend
        run: |
          npm ci
          npm run build
      - name: Deploy to Vercel
        uses: amondnet/vercel-action@v25
        with:
          vercel-token: ${{ secrets.VERCEL_TOKEN }}
          vercel-org-id: ${{ secrets.ORG_ID }}
          vercel-project-id: ${{ secrets.PROJECT_ID }}
          working-directory: ./frontend

  deploy-backend:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Deploy to Server
        uses: appleboy/ssh-action@v0.1.5
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          key: ${{ secrets.KEY }}
          script: |
            cd /var/www/egysyr/backend
            git pull origin main
            composer install --optimize-autoloader --no-dev
            php artisan migrate --force
            php artisan config:cache
            php artisan route:cache
            php artisan view:cache
```

## 🆘 Troubleshooting

### Common Issues

**Frontend Build Errors:**
```bash
# Clear cache and reinstall
rm -rf node_modules package-lock.json
npm install
npm run build
```

**Backend Permission Issues:**
```bash
# Fix Laravel permissions
sudo chown -R www-data:www-data /var/www/egysyr/backend
sudo chmod -R 755 /var/www/egysyr/backend
sudo chmod -R 775 /var/www/egysyr/backend/storage
sudo chmod -R 775 /var/www/egysyr/backend/bootstrap/cache
```

**Database Connection Issues:**
```bash
# Test database connection
php artisan tinker
DB::connection()->getPdo();
```

## 📞 Support

For deployment assistance or technical support:
- 📧 Email: devops@egysyr.com
- 📚 Documentation: /docs
- 🐛 Issues: GitHub Issues

---

🎉 **Congratulations!** Your EgySyr website is now live and ready to engineer the digital world!