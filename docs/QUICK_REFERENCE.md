# Quick Reference Guide

This guide provides quick access to common commands, file locations, and troubleshooting tips for developers working on the website project.

## 🚀 Quick Start Commands

### Initial Setup
```bash
# Clone and setup
git clone <repository-url>
cd <project-name>
composer install
npm install
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Build assets
npm run build

# Start development server
php artisan serve
```

### Development Workflow
```bash
# Start development
php artisan serve
npm run dev

# Database operations
php artisan migrate
php artisan migrate:fresh --seed
php artisan make:migration create_table_name

# Cache management
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Testing
php artisan test
```

## 📁 Common File Locations

### Controllers
- **Public Pages**: `app/Http/Controllers/PageController.php`
- **Admin Panel**: `app/Http/Controllers/AdminController.php`
- **Authentication**: `app/Http/Controllers/AuthController.php`

### Models
- **User**: `app/Models/User.php`
- **Article**: `app/Models/Article.php`
- **Category**: `app/Models/Category.php`
- **Review**: `app/Models/Review.php`
- **Contact**: `app/Models/Contact.php`

### Views
- **Main Pages**: `resources/views/` (root level)
- **Admin Views**: `resources/views/Admin/`
- **Service Pages**: `resources/views/Services/`
- **Layouts**: `resources/views/Layouts/`
- **Auth Views**: `resources/views/auth/`

### Assets
- **CSS**: `resources/css/`
- **JavaScript**: `resources/js/`
- **Fonts**: `resources/fonts/`
- **Compiled Assets**: `public/css/`, `public/js/`

### Routes
- **Web Routes**: `routes/web.php`
- **Console Routes**: `routes/console.php`

### Database
- **Migrations**: `database/migrations/`
- **Seeders**: `database/seeders/`
- **Factories**: `database/factories/`

## 🔧 Common Artisan Commands

### Development
```bash
# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName

# Create new migration
php artisan make:migration create_table_name

# Create new seeder
php artisan make:seeder SeederName

# Create new middleware
php artisan make:middleware MiddlewareName
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset database and run migrations
php artisan migrate:fresh

# Reset database, run migrations, and seed
php artisan migrate:fresh --seed

# Show migration status
php artisan migrate:status
```

### Cache & Optimization
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize for production
php artisan optimize
```

### Information
```bash
# List all routes
php artisan route:list

# Show environment
php artisan env

# Show application info
php artisan about

# Clear compiled class files
php artisan clear-compiled
```

## 🎨 Frontend Commands

### Asset Management
```bash
# Development mode (watch for changes)
npm run dev

# Build for production
npm run build

# Install dependencies
npm install

# Update dependencies
npm update
```

### Vite Configuration
- **Config File**: `vite.config.js`
- **Entry Points**: `resources/css/app.css`, `resources/js/app.js`
- **Output**: `public/build/`

## 🗄️ Database Reference

### Table Names
- **users**: User accounts
- **articles**: Blog posts
- **categories**: Blog categories
- **reviews**: Customer reviews
- **contacts**: Contact form submissions

### Common Queries
```php
// Get published articles
Article::where('status', 'published')->get();

// Get articles with category
Article::with('category')->get();

// Get unread messages
Contact::where('status', 'unread')->get();

// Get published reviews
Review::where('status', 'publication')->get();
```

## 🔍 Troubleshooting

### Common Issues

#### 1. "Class not found" errors
```bash
# Clear autoloader
composer dump-autoload
```

#### 2. Assets not loading
```bash
# Rebuild assets
npm run build
# Check if Vite is running
npm run dev
```

#### 3. Database connection issues
```bash
# Check .env configuration
php artisan env
# Clear config cache
php artisan config:clear
```

#### 4. Permission denied errors
```bash
# Set proper permissions
chmod -R 775 storage bootstrap/cache
```

#### 5. Route not found
```bash
# Clear route cache
php artisan route:clear
# List all routes
php artisan route:list
```

### Debug Commands
```bash
# Enable debug mode
APP_DEBUG=true

# View logs
tail -f storage/logs/laravel.log

# Show application info
php artisan about
```

## 📝 Code Snippets

### Controller Methods
```php
// Basic controller method
public function index()
{
    $data = Model::all();
    return view('view-name', compact('data'));
}

// With validation
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email'
    ]);
    
    Model::create($validated);
    return redirect()->back()->with('success', 'Created successfully');
}
```

### Blade Templates
```php
// Extend layout
@extends('layouts.app')

// Include sections
@section('content')
    <h1>Page Content</h1>
@endsection

// Display data
{{ $variable }}
{!! $html !!}

// CSRF token
@csrf
```

### Database Queries
```php
// Eloquent queries
Model::where('column', 'value')->get();
Model::find($id);
Model::create($data);
Model::update($data);

// Relationships
$model->relationship()->get();
Model::with('relationship')->get();
```

## 🛠️ Development Tools

### Recommended Extensions (VS Code)
- **PHP Intelephense**: PHP language support
- **Laravel Blade Snippets**: Blade template support
- **Tailwind CSS IntelliSense**: Tailwind CSS support
- **GitLens**: Git integration
- **PHP Debug**: PHP debugging

### Useful Packages
```bash
# Development packages
composer require --dev barryvdh/laravel-debugbar
composer require --dev laravel/telescope

# Production packages
composer require laravel/sanctum
```

## 📊 Performance Tips

### Database Optimization
```php
// Use eager loading
Model::with('relationship')->get();

// Use pagination
Model::paginate(10);

// Use caching
Cache::remember('key', 3600, function () {
    return Model::all();
});
```

### Asset Optimization
```bash
# Build for production
npm run build

# Use CDN for external libraries
# Optimize images
# Enable gzip compression
```

## 🔐 Security Checklist

### Authentication
- [ ] All admin routes protected
- [ ] CSRF tokens on forms
- [ ] Input validation
- [ ] Password hashing

### Data Protection
- [ ] SQL injection prevention
- [ ] XSS protection
- [ ] File upload validation
- [ ] HTTPS in production

## 📞 Getting Help

### Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Forge](https://forge.laravel.com/)
- [Laravel Nova](https://nova.laravel.com/)
- [Laravel Vapor](https://vapor.laravel.com/)

### Community
- [Laravel Discord](https://discord.gg/laravel)
- [Laravel Reddit](https://reddit.com/r/laravel)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)

### Debugging
- Check `storage/logs/laravel.log`
- Use Laravel Debugbar in development
- Enable `APP_DEBUG=true` for detailed errors
- Use `dd()` or `dump()` for debugging

## 🚀 Deployment Checklist

### Pre-deployment
- [ ] All tests pass
- [ ] Environment variables set
- [ ] Database migrations run
- [ ] Assets compiled
- [ ] Cache cleared
- [ ] Permissions set

### Production optimization
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

This quick reference guide should help developers quickly find the information they need to work efficiently on the project.