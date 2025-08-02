# Setup Guide

This guide will help you set up the website project on your local development environment.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

### Required Software
- **PHP 8.1 or higher**
- **Composer** (PHP package manager)
- **Node.js 16+ and npm**
- **MySQL 8.0+ or PostgreSQL 12+**
- **Git**

### Optional but Recommended
- **Laravel Valet** (macOS) or **Laravel Homestead**
- **VS Code** with PHP extensions
- **TablePlus** or **phpMyAdmin** for database management

## Step-by-Step Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd <project-name>
```

### 2. Install PHP Dependencies

```bash
composer install
```

If you encounter memory issues, you can increase PHP memory limit:
```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the environment file:
```bash
cp .env.example .env
```

Generate application key:
```bash
php artisan key:generate
```

### 5. Database Setup

#### Option A: MySQL
1. Create a new database:
   ```sql
   CREATE DATABASE website_db;
   ```

2. Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=website_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

#### Option B: PostgreSQL
1. Create a new database:
   ```sql
   CREATE DATABASE website_db;
   ```

2. Update `.env` file:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=website_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed the Database (Optional)

```bash
php artisan db:seed
```

This will create sample data for testing.

### 8. Build Frontend Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 9. Set Up File Permissions

```bash
chmod -R 775 storage bootstrap/cache
```

### 10. Start the Development Server

```bash
php artisan serve
```

Your application should now be running at `http://localhost:8000`

## Configuration Files

### Environment Variables (.env)

Key variables to configure:

```env
# Application
APP_NAME="Your Website Name"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=website_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Mail (for contact forms)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourwebsite.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Vite Configuration (vite.config.js)

The project uses Vite for asset compilation. Key configuration:

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

## Development Workflow

### 1. Making Changes

1. **Backend Changes**: Edit PHP files in `app/` directory
2. **Frontend Changes**: Edit files in `resources/` directory
3. **Database Changes**: Create migrations for schema changes

### 2. Asset Compilation

During development, run:
```bash
npm run dev
```

This will watch for changes and automatically recompile assets.

### 3. Testing Changes

1. Start the development server: `php artisan serve`
2. Open your browser to `http://localhost:8000`
3. Test the functionality you're working on

### 4. Database Changes

When you need to modify the database schema:

1. Create a migration:
   ```bash
   php artisan make:migration create_new_table_name
   ```

2. Edit the migration file in `database/migrations/`

3. Run the migration:
   ```bash
   php artisan migrate
   ```

## Troubleshooting

### Common Issues

#### 1. Composer Memory Limit
**Error**: `Fatal error: Allowed memory size exhausted`

**Solution**:
```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

#### 2. Permission Denied
**Error**: `Permission denied` when accessing storage or cache

**Solution**:
```bash
chmod -R 775 storage bootstrap/cache
```

#### 3. Database Connection Failed
**Error**: `SQLSTATE[HY000] [2002] Connection refused`

**Solutions**:
- Check if your database server is running
- Verify database credentials in `.env`
- Ensure database exists

#### 4. Assets Not Loading
**Error**: CSS/JS files not found

**Solutions**:
- Run `npm run build` or `npm run dev`
- Check if Vite is running
- Clear browser cache

#### 5. Route Not Found
**Error**: `404 Not Found`

**Solutions**:
- Clear route cache: `php artisan route:clear`
- Check if routes are properly defined
- Verify URL structure

### Debugging Tools

#### Laravel Debugbar
Install Laravel Debugbar for development:
```bash
composer require barryvdh/laravel-debugbar --dev
```

#### Telescope (Optional)
For advanced debugging:
```bash
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

## Production Setup

### 1. Environment Configuration
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### 2. Optimize for Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### 3. Set Proper Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 4. Configure Web Server
Set up Apache or Nginx to serve the application from the `public/` directory.

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Vite Documentation](https://vitejs.dev/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

## Getting Help

If you encounter issues not covered in this guide:

1. Check the Laravel logs in `storage/logs/`
2. Review the application logs
3. Check the browser console for JavaScript errors
4. Consult the Laravel documentation
5. Contact the development team