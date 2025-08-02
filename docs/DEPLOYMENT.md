# Deployment Guide

## Table of Contents
- [Environment Setup](#environment-setup)
- [Server Requirements](#server-requirements)
- [Production Deployment](#production-deployment)
- [Staging Environment](#staging-environment)
- [Environment Variables](#environment-variables)
- [Database Setup](#database-setup)
- [Web Server Configuration](#web-server-configuration)
- [SSL Configuration](#ssl-configuration)
- [Performance Optimization](#performance-optimization)
- [Monitoring and Maintenance](#monitoring-and-maintenance)
- [Troubleshooting](#troubleshooting)

## Environment Setup

### Development Environment

```bash
# Prerequisites
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-mbstring

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js (via NodeSource)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Clone and setup project
git clone <repository-url> laravel-blog-cms
cd laravel-blog-cms

# Install dependencies
composer install
npm install

# Environment configuration
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Asset compilation
npm run dev
```

### Local Development with Docker (Laravel Sail)

```bash
# Install Laravel Sail
composer require laravel/sail --dev

# Publish Sail configuration
php artisan sail:install

# Start development environment
./vendor/bin/sail up -d

# Run commands through Sail
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

## Server Requirements

### Minimum System Requirements

- **OS**: Ubuntu 20.04 LTS or CentOS 8+
- **PHP**: 8.2 or higher
- **Memory**: 2GB RAM minimum, 4GB+ recommended
- **Storage**: 20GB+ available space
- **CPU**: 2 cores minimum

### Required PHP Extensions

```bash
# Ubuntu/Debian
sudo apt install php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml php8.2-curl \
php8.2-zip php8.2-gd php8.2-mbstring php8.2-intl php8.2-bcmath php8.2-soap

# CentOS/RHEL
sudo yum install php82-php-cli php82-php-fpm php82-php-mysqlnd php82-php-xml \
php82-php-curl php82-php-zip php82-php-gd php82-php-mbstring php82-php-intl
```

### Database Requirements

**MySQL 8.0+ (Recommended)**
```bash
sudo apt install mysql-server-8.0
sudo mysql_secure_installation
```

**PostgreSQL 13+ (Alternative)**
```bash
sudo apt install postgresql-13 postgresql-contrib
```

### Web Server Options

**Nginx (Recommended)**
```bash
sudo apt install nginx
```

**Apache (Alternative)**
```bash
sudo apt install apache2
sudo a2enmod rewrite
```

## Production Deployment

### Automated Deployment Script

```bash
#!/bin/bash
# deploy.sh

set -e

echo "🚀 Starting deployment..."

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --optimize-autoloader --no-dev
npm ci --production

# Clear and cache optimization
php artisan down
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Database migrations
php artisan migrate --force

# Build assets
npm run build

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Restart services
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx

# Bring application back up
php artisan up

echo "✅ Deployment completed successfully!"
```

### Manual Deployment Steps

```bash
# 1. Prepare the server
sudo adduser deploy
sudo usermod -aG sudo deploy
su - deploy

# 2. Clone repository
git clone <repository-url> /var/www/laravel-blog-cms
cd /var/www/laravel-blog-cms

# 3. Install dependencies
composer install --optimize-autoloader --no-dev
npm ci --production

# 4. Environment setup
cp .env.example .env
nano .env  # Configure production settings
php artisan key:generate

# 5. Database setup
php artisan migrate --force
php artisan db:seed --class=ProductionSeeder

# 6. Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Build assets
npm run build

# 8. Set permissions
sudo chown -R www-data:www-data /var/www/laravel-blog-cms
sudo chmod -R 775 /var/www/laravel-blog-cms/storage
sudo chmod -R 775 /var/www/laravel-blog-cms/bootstrap/cache
```

## Staging Environment

### Staging Server Setup

```bash
# Create staging subdomain configuration
server {
    listen 80;
    server_name staging.yourdomain.com;
    root /var/www/laravel-blog-cms-staging/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Staging Environment Variables

```bash
# .env.staging
APP_NAME="Laravel Blog CMS (Staging)"
APP_ENV=staging
APP_DEBUG=true
APP_URL=https://staging.yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_blog_staging
DB_USERNAME=staging_user
DB_PASSWORD=secure_staging_password

MAIL_MAILER=log
```

## Environment Variables

### Production .env Template

```bash
# Application
APP_NAME="Laravel Blog CMS"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_blog_production
DB_USERNAME=production_user
DB_PASSWORD=strong_production_password

# Cache
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# File Storage
FILESYSTEM_DISK=public

# Logging
LOG_CHANNEL=daily
LOG_LEVEL=warning

# Security
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

### Environment Security

```bash
# Secure .env file permissions
chmod 600 .env
chown www-data:www-data .env

# Never commit .env to version control
echo ".env" >> .gitignore
```

## Database Setup

### MySQL Production Setup

```sql
-- Create database and user
CREATE DATABASE laravel_blog_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'production_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON laravel_blog_production.* TO 'production_user'@'localhost';
FLUSH PRIVILEGES;

-- Optimize MySQL for Laravel
-- Add to /etc/mysql/mysql.conf.d/mysqld.cnf
[mysqld]
innodb_buffer_pool_size = 1G
innodb_log_file_size = 256M
max_connections = 200
query_cache_size = 64M
query_cache_type = 1
```

### Database Backup Strategy

```bash
#!/bin/bash
# backup-database.sh

BACKUP_DIR="/var/backups/mysql"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="laravel_blog_production"

# Create backup directory
mkdir -p $BACKUP_DIR

# Create backup
mysqldump -u production_user -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/backup_$DATE.sql

# Compress backup
gzip $BACKUP_DIR/backup_$DATE.sql

# Remove backups older than 30 days
find $BACKUP_DIR -name "backup_*.sql.gz" -mtime +30 -delete

echo "Database backup completed: backup_$DATE.sql.gz"
```

### Automated Backup with Cron

```bash
# Add to crontab (crontab -e)
0 2 * * * /var/www/laravel-blog-cms/scripts/backup-database.sh
```

## Web Server Configuration

### Nginx Configuration

```nginx
# /etc/nginx/sites-available/laravel-blog-cms
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/laravel-blog-cms/public;
    index index.php;

    # SSL Configuration
    ssl_certificate /etc/ssl/certs/yourdomain.crt;
    ssl_certificate_key /etc/ssl/private/yourdomain.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384;
    ssl_prefer_server_ciphers off;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

    # Laravel Configuration
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    # Static Assets
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }

    # Security
    location ~ /\.ht {
        deny all;
    }

    location ~ /\.git {
        deny all;
    }

    # File Upload Limits
    client_max_body_size 10M;
}
```

### Apache Configuration

```apache
# /etc/apache2/sites-available/laravel-blog-cms.conf
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    Redirect permanent / https://yourdomain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName yourdomain.com
    ServerAlias www.yourdomain.com
    DocumentRoot /var/www/laravel-blog-cms/public

    # SSL Configuration
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/yourdomain.crt
    SSLCertificateKeyFile /etc/ssl/private/yourdomain.key

    # Laravel Configuration
    <Directory /var/www/laravel-blog-cms/public>
        AllowOverride All
        Require all granted
    </Directory>

    # Security Headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set X-Content-Type-Options "nosniff"

    # Error and Access Logs
    ErrorLog ${APACHE_LOG_DIR}/laravel-blog-cms_error.log
    CustomLog ${APACHE_LOG_DIR}/laravel-blog-cms_access.log combined
</VirtualHost>
```

## SSL Configuration

### Let's Encrypt (Certbot)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal setup (usually automatic)
sudo crontab -e
# Add: 0 12 * * * /usr/bin/certbot renew --quiet
```

### Manual SSL Certificate

```bash
# Generate private key
openssl genrsa -out yourdomain.key 2048

# Generate certificate signing request
openssl req -new -key yourdomain.key -out yourdomain.csr

# Place certificate files
sudo cp yourdomain.crt /etc/ssl/certs/
sudo cp yourdomain.key /etc/ssl/private/
sudo chmod 600 /etc/ssl/private/yourdomain.key
```

## Performance Optimization

### PHP-FPM Tuning

```ini
; /etc/php/8.2/fpm/pool.d/www.conf
[www]
user = www-data
group = www-data
listen = /var/run/php/php8.2-fpm.sock
listen.owner = www-data
listen.group = www-data

; Process Management
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 1000

; Performance
request_terminate_timeout = 300
rlimit_files = 1024
rlimit_core = 0
```

### Redis Configuration

```bash
# Install Redis
sudo apt install redis-server

# Configure Redis (/etc/redis/redis.conf)
maxmemory 256mb
maxmemory-policy allkeys-lru
save 900 1
save 300 10
save 60 10000
```

### Laravel Optimization

```bash
# Production optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Composer optimization
composer install --optimize-autoloader --no-dev

# Enable OPcache in php.ini
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

## Monitoring and Maintenance

### Log Monitoring

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Nginx logs
tail -f /var/log/nginx/access.log
tail -f /var/log/nginx/error.log

# System logs
journalctl -f -u nginx
journalctl -f -u php8.2-fpm
```

### Health Check Script

```bash
#!/bin/bash
# health-check.sh

# Check application status
HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://yourdomain.com)

if [ $HTTP_STATUS -eq 200 ]; then
    echo "✅ Application is healthy"
else
    echo "❌ Application health check failed (HTTP: $HTTP_STATUS)"
    # Send alert notification
fi

# Check database connectivity
php artisan tinker --execute="DB::connection()->getPdo();"

# Check disk space
DISK_USAGE=$(df / | awk 'NR==2 {print $5}' | sed 's/%//')
if [ $DISK_USAGE -gt 80 ]; then
    echo "⚠️ Warning: Disk usage is at ${DISK_USAGE}%"
fi
```

### Automated Maintenance

```bash
# Add to crontab
# Clear logs older than 30 days
0 3 * * * find /var/www/laravel-blog-cms/storage/logs -name "*.log" -mtime +30 -delete

# Clear cache weekly
0 4 * * 0 cd /var/www/laravel-blog-cms && php artisan cache:clear

# Health check every 5 minutes
*/5 * * * * /var/www/laravel-blog-cms/scripts/health-check.sh
```

## Troubleshooting

### Common Issues

#### Permission Issues
```bash
# Fix ownership
sudo chown -R www-data:www-data /var/www/laravel-blog-cms

# Fix permissions
sudo chmod -R 755 /var/www/laravel-blog-cms
sudo chmod -R 775 /var/www/laravel-blog-cms/storage
sudo chmod -R 775 /var/www/laravel-blog-cms/bootstrap/cache
```

#### Database Connection Issues
```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Check database credentials
grep -E "DB_|CACHE_|SESSION_" .env
```

#### SSL Certificate Issues
```bash
# Check certificate validity
openssl x509 -in /etc/ssl/certs/yourdomain.crt -text -noout

# Test SSL configuration
curl -I https://yourdomain.com
```

#### Performance Issues
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check PHP processes
ps aux | grep php-fpm

# Monitor system resources
htop
iotop
```

### Debugging Commands

```bash
# Enable debug mode temporarily
php artisan down
sed -i 's/APP_DEBUG=false/APP_DEBUG=true/' .env
php artisan config:clear
php artisan up

# Check Laravel logs
tail -f storage/logs/laravel.log

# Check queue workers
php artisan queue:work --verbose

# Test routes
php artisan route:list
```

This deployment guide provides comprehensive instructions for setting up and maintaining a production Laravel application.