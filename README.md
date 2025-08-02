# Laravel Blog CMS

A comprehensive content management system built with Laravel 12, featuring a blog platform with admin panel, user authentication, and contact management.

## 🚀 Project Overview

This is a full-featured Laravel CMS application that includes:

- **Public Blog Platform**: Browse articles, categories, and leave reviews
- **Admin Dashboard**: Complete content management system
- **User Authentication**: Login, registration, and password recovery
- **Contact Management**: Handle user inquiries and feedback
- **Review System**: User reviews with moderation capabilities
- **Category Management**: Organize content with hierarchical categories

## 📁 Project Structure

```
project-root/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminController.php      # Admin panel functionality
│   │       ├── AuthController.php       # User authentication
│   │       ├── PageController.php       # Public pages
│   │       └── Controller.php           # Base controller
│   ├── Models/
│   │   ├── Article.php                  # Blog articles/posts
│   │   ├── Category.php                 # Content categories
│   │   ├── Contact.php                  # Contact form submissions
│   │   ├── Review.php                   # User reviews
│   │   └── User.php                     # User accounts
│   └── Providers/                       # Laravel service providers
├── resources/
│   ├── views/
│   │   ├── Admin/                       # Admin panel views
│   │   │   ├── dashboard/               # Dashboard components
│   │   │   ├── blogs/                   # Blog management
│   │   │   ├── categories/              # Category management
│   │   │   └── messages/                # Contact management
│   │   ├── Layouts/                     # Shared layout components
│   │   │   ├── Navbar.blade.php         # Navigation component
│   │   │   └── Footer.blade.php         # Footer component
│   │   ├── Services/                    # Service-related views
│   │   └── auth/                        # Authentication views
│   ├── js/                              # Frontend JavaScript
│   ├── css/                             # Stylesheets
│   └── fonts/                           # Custom fonts
├── routes/
│   ├── web.php                          # Web routes
│   └── console.php                      # Artisan commands
├── database/                            # Database migrations & seeders
├── public/                              # Public assets
└── config/                              # Laravel configuration
```

## 🛠️ Technology Stack

### Backend
- **Laravel 12**: PHP framework
- **PHP 8.2+**: Server-side language
- **MySQL/SQLite**: Database
- **Laravel Sanctum**: API authentication

### Frontend
- **Blade Templates**: Laravel templating engine
- **TailwindCSS 4.0**: Utility-first CSS framework
- **JavaScript (ES6+)**: Frontend interactions
- **Vite**: Asset bundling and dev server

### Development Tools
- **Laravel Pint**: Code style fixer
- **PHPUnit**: Testing framework
- **Laravel Sail**: Docker development environment
- **Vite**: Frontend build tool

## 📋 Prerequisites

Before running this project, ensure you have:

- PHP 8.2 or higher
- Composer (PHP dependency manager)
- Node.js 18+ and npm/yarn
- MySQL or SQLite database
- Git

## ⚡ Quick Start

### 1. Clone the Repository
```bash
git clone <repository-url>
cd laravel-blog-cms
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# Set DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### 4. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed
```

### 5. Build Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### 6. Start Development Server
```bash
# Start Laravel server
php artisan serve

# In another terminal, start Vite dev server
npm run dev
```

Visit `http://localhost:8000` to see the application.

## 📖 Application Features

### Public Features
- **Homepage**: Latest articles and reviews
- **Blog**: Article listing with category filtering and search
- **Article Details**: Full article view with comment system
- **About Page**: Company/site information
- **Contact**: Contact form with inquiry submission
- **Policy Pages**: Privacy, data security, and maintenance policies

### Admin Features
- **Dashboard**: Overview with statistics and quick actions
- **Article Management**: Create, edit, delete, and publish articles
- **Category Management**: Organize content with hierarchical categories
- **User Management**: Handle user accounts and permissions
- **Contact Management**: View and respond to user inquiries
- **Review Moderation**: Approve or reject user reviews

### Authentication
- **User Registration**: Account creation with email verification
- **Login/Logout**: Secure authentication system
- **Password Reset**: Email-based password recovery
- **Profile Management**: User profile updates

## 🗃️ Database Schema

### Key Models & Relationships

- **User**: Authentication and user management
- **Article**: Blog posts with category relationships
- **Category**: Hierarchical content organization
- **Review**: User feedback system with moderation
- **Contact**: Contact form submissions tracking

## 🚦 API Routes

### Public Routes
- `GET /` - Homepage
- `GET /blog` - Blog listing
- `GET /blog/{slug}` - Article details
- `GET /about` - About page
- `GET /contact` - Contact page
- `POST /contact` - Submit contact form

### Authentication Routes
- `GET|POST /login` - User login
- `GET|POST /register` - User registration
- `GET|POST /forgot-password` - Password reset
- `POST /logout` - Logout

### Admin Routes (Authenticated)
- `GET /admin/dashboard` - Admin dashboard
- `GET|POST /admin/blogs` - Blog management
- `GET|POST /admin/categories` - Category management
- `GET /admin/messages` - Contact management
- `GET /admin/reviews` - Review moderation

## 🔧 Development Guidelines

### Code Standards
- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting: `./vendor/bin/pint`
- Write descriptive commit messages
- Use meaningful variable and function names

### Testing
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/BlogTest.php
```

### Database Migrations
```bash
# Create new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback
```

### Artisan Commands
```bash
# Create controller
php artisan make:controller ControllerName

# Create model with migration
php artisan make:model ModelName -m

# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Configure production database
4. Set up proper web server (Apache/Nginx)
5. Configure SSL certificate
6. Set up cron job for Laravel scheduler

### Optimization Commands
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/new-feature`
3. Make your changes and commit: `git commit -m 'Add new feature'`
4. Push to the branch: `git push origin feature/new-feature`
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 📞 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the Laravel documentation: https://laravel.com/docs

---

**Happy Coding! 🎉**
