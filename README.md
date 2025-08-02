# Website Project

A modern web application built with Laravel and Vite, featuring a blog system, service pages, admin panel, and user authentication.

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js 16+ and npm
- MySQL/PostgreSQL database

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd <project-name>
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   - Update `.env` file with your database credentials
   - Run migrations: `php artisan migrate`
   - Seed the database: `php artisan db:seed`

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── resources/
│   ├── views/               # Blade templates
│   │   ├── Admin/          # Admin panel views
│   │   ├── Layouts/        # Reusable layouts
│   │   └── Services/       # Service-specific views
│   ├── js/                 # JavaScript files
│   └── css/                # Stylesheets
├── routes/
│   └── web.php             # Web routes
├── public/                 # Public assets
└── storage/                # File storage
```

## 🏗️ Architecture Overview

### Controllers
- **PageController**: Handles public pages (home, about, blog, contact, services)
- **AdminController**: Manages admin panel functionality
- **AuthController**: Handles user authentication

### Models
- **User**: User management and authentication
- **Article**: Blog posts and content management
- **Category**: Blog categories
- **Review**: User reviews and testimonials
- **Contact**: Contact form submissions

### Key Features
- **Blog System**: Articles with categories and search functionality
- **Service Pages**: Multiple service offerings with individual pages
- **Admin Panel**: Content management for articles, reviews, and messages
- **User Authentication**: Registration, login, and profile management
- **Contact System**: Contact form with admin response capability

## 🛠️ Development Guidelines

### Code Organization
- Keep controllers focused on single responsibilities
- Use descriptive route names
- Follow Laravel naming conventions
- Organize views by feature/functionality

### Frontend Development
- CSS files are in `resources/css/`
- JavaScript files are in `resources/js/`
- Use Vite for asset compilation
- Follow responsive design principles

### Database
- Use migrations for schema changes
- Create seeders for test data
- Follow Laravel Eloquent conventions

## 🔧 Available Commands

```bash
# Development
php artisan serve          # Start development server
npm run dev               # Watch and compile assets
npm run build             # Build for production

# Database
php artisan migrate       # Run migrations
php artisan migrate:fresh # Reset database
php artisan db:seed       # Seed database

# Cache
php artisan cache:clear   # Clear application cache
php artisan config:clear  # Clear config cache
```

## 📝 Contributing

1. Follow the existing code style
2. Write meaningful commit messages
3. Test your changes thoroughly
4. Update documentation as needed

## 🚀 Deployment

1. Set up production environment variables
2. Run `npm run build` to compile assets
3. Configure web server (Apache/Nginx)
4. Set up database and run migrations
5. Configure file permissions for storage

## 📚 Documentation

This project includes comprehensive documentation to help developers understand and contribute to the codebase:

### Quick Start
- **[Setup Guide](docs/SETUP.md)** - Complete installation instructions
- **[Quick Reference](docs/QUICK_REFERENCE.md)** - Common commands and troubleshooting
- **[Navigation Guide](docs/NAVIGATE.md)** - Find documentation based on your needs

### Detailed Documentation
- **[Architecture Documentation](docs/ARCHITECTURE.md)** - Technical overview and design decisions
- **[Project Structure](docs/STRUCTURE.md)** - File organization and conventions
- **[Development Guide](docs/DEVELOPMENT.md)** - Coding standards and best practices
- **[API Documentation](docs/API.md)** - Routes, endpoints, and data models

### Documentation Index
- **[Documentation Index](docs/README.md)** - Complete overview of all documentation

## 📞 Support

For questions or issues, please refer to the project documentation or contact the development team.
