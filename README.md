# EgySyr - Modern Business Website

A comprehensive, modern business website built with Laravel, React, TypeScript, and cutting-edge web technologies. This project features a stunning frontend with 3D animations, an advanced admin dashboard, job management system, and comprehensive analytics.

## 🌟 Features

### Frontend Features
- **Modern React SPA** with TypeScript and Vite
- **3D Interactive Scenes** using Three.js and React Three Fiber
- **Smooth Animations** with Framer Motion and GSAP
- **Responsive Design** with Tailwind CSS
- **Custom Cursor** and smooth scrolling effects
- **Interactive World Map** with visitor analytics
- **Real-time Statistics** with animated counters
- **Contact Form** with validation
- **Job Board** with application system
- **Feedback System** with approval workflow
- **Blog Section** for content management
- **Services & About Pages** with rich content

### Admin Dashboard Features
- **Comprehensive Analytics** with real-time data
- **User Management** with role-based permissions
- **Job Management** with CRUD operations
- **Application Tracking** with status management
- **Contact Message Management** with export functionality
- **Feedback Management** with approval system
- **Site Analytics** with world map visualization
- **File Upload** with drag & drop support
- **Export Functionality** for data analysis
- **Profile Management** with preferences

### Backend Features
- **Laravel 12** with modern PHP 8.2+
- **Inertia.js** for seamless SPA experience
- **Role-based Authentication** system
- **API-first Architecture** with RESTful endpoints
- **Database Migrations** with proper relationships
- **File Upload** with image processing
- **Email Notifications** system
- **Queue System** for background jobs
- **Caching** for performance optimization
- **Testing** with Pest PHP

## 🛠️ Technology Stack

### Frontend
- **React 18** with TypeScript
- **Vite** for fast development and building
- **Tailwind CSS** for styling
- **Framer Motion** for animations
- **GSAP** for advanced animations
- **Three.js** with React Three Fiber for 3D graphics
- **React Query** for data fetching
- **Wouter** for routing
- **Lucide React** for icons
- **React Hot Toast** for notifications
- **React Dropzone** for file uploads
- **Recharts** for data visualization
- **React World Flags** for internationalization

### Backend
- **Laravel 12** (PHP 8.2+)
- **Inertia.js** for SPA integration
- **MySQL/PostgreSQL** database
- **Laravel Sanctum** for API authentication
- **Intervention Image** for image processing
- **Maatwebsite Excel** for data export
- **Laravel Queue** for background jobs
- **Laravel Mail** for email notifications

### Development Tools
- **TypeScript** for type safety
- **ESLint** for code linting
- **Pest PHP** for testing
- **Laravel Pint** for code formatting
- **Laravel Sail** for Docker development

## 📁 Project Structure

```
EgySyr/
├── app/
│   ├── Exports/                 # Data export classes
│   ├── Http/
│   │   ├── Controllers/         # API and web controllers
│   │   │   ├── Api/            # API controllers
│   │   │   │   ├── Admin/      # Admin API controllers
│   │   │   │   └── ...         # Public API controllers
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form request validation
│   ├── Models/                 # Eloquent models
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/               # Database seeders
│   └── factories/             # Model factories
├── resources/
│   ├── js/
│   │   ├── admin/             # Admin dashboard components
│   │   │   ├── components/    # Admin-specific components
│   │   │   ├── pages/         # Admin pages
│   │   │   └── utils/         # Admin utilities
│   │   ├── components/        # Shared components
│   │   ├── hooks/             # Custom React hooks
│   │   ├── pages/             # Frontend pages
│   │   └── utils/             # Utility functions
│   ├── css/                   # Stylesheets
│   └── views/                 # Blade templates
├── routes/
│   ├── api.php               # API routes
│   ├── web.php               # Web routes
│   └── auth.php              # Authentication routes
└── public/                   # Public assets
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL/PostgreSQL database
- Git

### Step 1: Clone the Repository
```bash
git clone <repository-url>
cd EgySyr
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node.js Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Configure your `.env` file with database credentials and other settings:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=egysyr
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 5: Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Build Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### Step 7: Start the Development Server
```bash
# Using Laravel's built-in server
php artisan serve

# Or using the combined dev script
composer run dev
```

## 🔧 Configuration

### Admin User Setup
After running migrations and seeders, you can create an admin user:

```bash
php artisan tinker
```

```php
User::create([
    'name' => 'Admin User',
    'email' => 'admin@egysyr.com',
    'password' => Hash::make('password'),
    'role' => 'owner',
    'status' => 'approved'
]);
```

### File Permissions
Ensure proper file permissions for storage and cache:
```bash
chmod -R 775 storage bootstrap/cache
```

### Queue Configuration
For background job processing, configure your queue driver in `.env`:
```env
QUEUE_CONNECTION=database
```

Then run the queue worker:
```bash
php artisan queue:work
```

## 📊 Database Schema

### Core Tables
- **users** - User accounts with role-based permissions
- **jobs** - Job postings with detailed information
- **job_applications** - Job applications with file uploads
- **contact_messages** - Contact form submissions
- **feedback** - User feedback with approval system
- **site_visits** - Analytics tracking
- **user_permissions** - Granular permission system

### Key Relationships
- Users can have multiple job applications
- Jobs can have multiple applications
- Admin users can manage all content
- Role-based access control for different admin levels

## 🎨 Frontend Components

### 3D Scene Components
- **PremiumScene** - Interactive 3D environment with floating geometric shapes
- **Stars** - Animated star field background
- **BubbleWorldMap** - Interactive world map with visitor data

### Animation Components
- **AnimatedCounter** - Smooth number counting animations
- **PageTransition** - Page transition effects
- **CustomCursor** - Custom mouse cursor with effects

### Admin Components
- **AdminLayout** - Main admin dashboard layout
- **AdminSidebar** - Navigation sidebar
- **AuthGuard** - Authentication protection
- **DataTables** - Sortable and filterable data tables

## 🔐 Authentication & Authorization

### User Roles
- **owner** - Full system access
- **admin** - Content management access
- **user** - Basic access (pending approval)

### Permission System
- Granular permissions for different admin functions
- Role-based middleware protection
- Session-based authentication with CSRF protection

## 📈 Analytics & Tracking

### Site Analytics
- Real-time visitor tracking
- Geographic visitor distribution
- Session duration tracking
- Page view analytics
- Export functionality for data analysis

### Admin Dashboard Metrics
- Total site visits and unique visitors
- Contact message statistics
- Job application tracking
- Feedback approval rates
- User registration analytics

## 🚀 Deployment

### Production Build
```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build frontend assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Server Requirements
- PHP 8.2+
- MySQL 8.0+ or PostgreSQL 13+
- Node.js 18+ (for asset building)
- Web server (Apache/Nginx)
- SSL certificate (recommended)

### Environment Variables
Ensure all production environment variables are properly configured:
- Database credentials
- Mail configuration
- Queue settings
- File storage settings
- Security settings

## 🧪 Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter=AuthTest

# Run with coverage
php artisan test --coverage
```

### Test Structure
- **Feature Tests** - Full application testing
- **Unit Tests** - Individual component testing
- **Authentication Tests** - Auth flow testing
- **Admin Tests** - Admin functionality testing

## 📝 API Documentation

### Public Endpoints
- `POST /api/contact` - Submit contact form
- `POST /api/track-visit` - Track site visits
- `GET /api/jobs` - List job postings
- `POST /api/jobs/{slug}/apply` - Apply for jobs
- `GET /api/feedback/{token}` - View feedback form
- `POST /api/feedback/{token}` - Submit feedback

### Admin Endpoints
- `GET /api/admin/dashboard/*` - Dashboard analytics
- `GET /api/admin/messages` - Contact message management
- `GET /api/admin/feedback` - Feedback management
- `GET /api/admin/jobs` - Job management
- `GET /api/admin/job-applications` - Application tracking
- `GET /api/admin/users` - User management (owner only)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔄 Version History

- **v1.0.0** - Initial release with core features
- **v1.1.0** - Added 3D animations and enhanced UI
- **v1.2.0** - Implemented advanced admin dashboard
- **v1.3.0** - Added job management and application system
- **v1.4.0** - Enhanced analytics and export functionality

---

**Built with ❤️ using Laravel, React, and modern web technologies** 