# Project Structure

This document provides a detailed overview of the website project's file and directory structure, explaining the purpose and organization of each component.

## Root Directory Structure

```
website-project/
├── app/                    # Application core
├── bootstrap/              # Framework bootstrap files
├── config/                 # Configuration files
├── database/               # Database migrations and seeders
├── docs/                   # Project documentation
├── lang/                   # Language files
├── public/                 # Public assets and entry point
├── resources/              # Frontend resources
├── routes/                 # Route definitions
├── storage/                # File storage and logs
├── tests/                  # Test files
├── vendor/                 # Composer dependencies
├── node_modules/           # NPM dependencies
├── .env                    # Environment configuration
├── .env.example           # Environment template
├── .gitignore             # Git ignore rules
├── artisan                # Laravel command-line tool
├── composer.json          # PHP dependencies
├── composer.lock          # PHP dependency lock
├── package.json           # Node.js dependencies
├── package-lock.json      # Node.js dependency lock
├── phpunit.xml           # PHPUnit configuration
├── README.md             # Project documentation
└── vite.config.js        # Vite configuration
```

## Application Core (`app/`)

### Controllers (`app/Http/Controllers/`)

```
app/Http/Controllers/
├── Controller.php          # Base controller class
├── PageController.php      # Public page controllers
├── AdminController.php     # Admin panel controllers
└── AuthController.php      # Authentication controllers
```

**Purpose**: Handle HTTP requests and return responses. Controllers contain the business logic for handling user interactions.

**Key Files**:
- **PageController.php**: Manages all public-facing pages (home, about, blog, contact, services)
- **AdminController.php**: Handles admin panel functionality (content management, user management)
- **AuthController.php**: Manages user authentication (login, register, profile)

### Models (`app/Models/`)

```
app/Models/
├── User.php               # User authentication model
├── Article.php            # Blog article model
├── Category.php           # Blog category model
├── Review.php             # Customer review model
└── Contact.php            # Contact form model
```

**Purpose**: Represent database tables and handle data relationships. Models contain the business logic for data manipulation.

**Key Models**:
- **User.php**: User accounts and authentication
- **Article.php**: Blog posts with categories and status management
- **Category.php**: Blog post categorization
- **Review.php**: Customer testimonials with service type association
- **Contact.php**: Contact form submissions with status tracking

### Providers (`app/Providers/`)

```
app/Providers/
├── AppServiceProvider.php  # Application service provider
├── AuthServiceProvider.php # Authentication service provider
├── EventServiceProvider.php # Event service provider
└── RouteServiceProvider.php # Route service provider
```

**Purpose**: Configure application services, register bindings, and bootstrap application components.

## Frontend Resources (`resources/`)

### Views (`resources/views/`)

```
resources/views/
├── Admin/                  # Admin panel views
│   ├── dashboard/         # Dashboard views
│   ├── blogs/            # Blog management views
│   ├── categories/       # Category management views
│   ├── messages/         # Message management views
│   ├── reviews/          # Review management views
│   └── settings/         # Settings views
├── Layouts/               # Reusable layout templates
│   ├── app.blade.php     # Main application layout
│   └── admin.blade.php   # Admin panel layout
├── Services/              # Service-specific views
│   ├── Services.blade.php # Main services page
│   ├── service-Application.blade.php
│   ├── service-Graphic.blade.php
│   ├── service-Hosting.blade.php
│   ├── service-Marketing.blade.php
│   ├── service-ProtectionSystems.blade.php
│   ├── service-System.blade.php
│   └── service-Web.blade.php
├── auth/                  # Authentication views
│   ├── login.blade.php   # Login form
│   ├── register.blade.php # Registration form
│   └── forgot-password.blade.php # Password reset
├── welcome.blade.php      # Home page
├── About.blade.php        # About page
├── Blog.blade.php         # Blog listing page
├── Blog_details.blade.php # Blog article details
├── Contact.blade.php      # Contact page
├── Custom.blade.php       # Custom page
├── Data-Security.blade.php # Data security policy
├── Maintenance-Policy.blade.php # Maintenance policy
├── Policy.blade.php       # General policy
└── profile.blade.php      # User profile page
```

**Purpose**: Blade templates that define the HTML structure and presentation logic for the application.

**Key View Categories**:
- **Admin Views**: Admin panel interface for content management
- **Layout Views**: Reusable templates for consistent page structure
- **Service Views**: Individual service page templates
- **Public Views**: Main website pages

### CSS (`resources/css/`)

```
resources/css/
├── app.css               # Main stylesheet (Tailwind CSS)
├── style.css             # Custom styles
└── splide.min.css        # Third-party carousel styles
```

**Purpose**: Define the visual styling and layout of the application.

**Key Files**:
- **app.css**: Main stylesheet with Tailwind CSS imports
- **style.css**: Custom component styles and overrides
- **splide.min.css**: Carousel/slider component styles

### JavaScript (`resources/js/`)

```
resources/js/
├── app.js                # Main JavaScript file
├── bootstrap.js          # Bootstrap configuration
├── index.js              # Custom JavaScript functionality
├── jquery-3.6.1.min.js  # jQuery library
├── all.min.js            # Font Awesome icons
└── splide.min.js         # Carousel/slider functionality
```

**Purpose**: Handle client-side interactivity and dynamic functionality.

**Key Files**:
- **app.js**: Main JavaScript entry point
- **index.js**: Custom application JavaScript
- **jquery-3.6.1.min.js**: jQuery for DOM manipulation
- **splide.min.js**: Carousel/slider component

### Fonts (`resources/fonts/`)

```
resources/fonts/
└── [font files]          # Custom font files
```

**Purpose**: Store custom font files used in the application.

## Routes (`routes/`)

```
routes/
├── web.php               # Web routes (main application)
└── console.php           # Console routes (artisan commands)
```

**Purpose**: Define URL patterns and map them to controller actions.

**Key Files**:
- **web.php**: All web application routes including public pages, admin panel, and authentication

## Database (`database/`)

```
database/
├── factories/            # Model factories for testing
├── migrations/           # Database schema migrations
└── seeders/             # Database seeders
```

**Purpose**: Define database structure and populate with initial data.

**Key Components**:
- **Migrations**: Define database table structure and relationships
- **Seeders**: Populate database with initial data for development/testing
- **Factories**: Generate fake data for testing

## Configuration (`config/`)

```
config/
├── app.php               # Application configuration
├── auth.php              # Authentication configuration
├── database.php          # Database configuration
├── filesystems.php       # File system configuration
├── mail.php              # Mail configuration
├── queue.php             # Queue configuration
├── session.php           # Session configuration
└── [other config files]  # Additional configuration files
```

**Purpose**: Configure application settings, services, and external integrations.

## Public Assets (`public/`)

```
public/
├── index.php             # Application entry point
├── favicon.ico           # Website favicon
├── images/               # Static images
├── css/                  # Compiled CSS files
├── js/                   # Compiled JavaScript files
└── [other assets]        # Other public assets
```

**Purpose**: Serve as the web server's document root and contain publicly accessible files.

## Storage (`storage/`)

```
storage/
├── app/                  # Application storage
│   ├── public/          # Publicly accessible files
│   └── [private files]  # Private application files
├── framework/            # Framework files
│   ├── cache/           # Application cache
│   ├── sessions/        # Session files
│   └── views/           # Compiled Blade views
└── logs/                # Application logs
```

**Purpose**: Store application files, cache, sessions, and logs.

## Tests (`tests/`)

```
tests/
├── Feature/              # Feature tests
├── Unit/                 # Unit tests
└── TestCase.php          # Base test class
```

**Purpose**: Define automated tests to ensure application functionality.

## Documentation (`docs/`)

```
docs/
├── ARCHITECTURE.md       # Application architecture documentation
├── SETUP.md              # Setup and installation guide
├── DEVELOPMENT.md        # Development guidelines and standards
├── API.md               # API and route documentation
└── STRUCTURE.md         # This file - project structure overview
```

**Purpose**: Provide comprehensive documentation for developers working on the project.

## Configuration Files

### Environment Configuration

- **.env**: Environment-specific configuration (not in version control)
- **.env.example**: Template for environment configuration

### Package Management

- **composer.json**: PHP dependencies and project metadata
- **composer.lock**: Locked PHP dependency versions
- **package.json**: Node.js dependencies and scripts
- **package-lock.json**: Locked Node.js dependency versions

### Build Tools

- **vite.config.js**: Vite build tool configuration
- **phpunit.xml**: PHPUnit testing configuration

### Version Control

- **.gitignore**: Files to exclude from version control
- **.gitattributes**: Git attributes for file handling

## File Naming Conventions

### PHP Files
- **Controllers**: PascalCase with "Controller" suffix (e.g., `PageController.php`)
- **Models**: PascalCase singular form (e.g., `User.php`, `Article.php`)
- **Migrations**: Snake_case with timestamp prefix (e.g., `2024_01_01_000000_create_users_table.php`)

### Blade Templates
- **Views**: PascalCase with `.blade.php` extension (e.g., `Welcome.blade.php`)
- **Layouts**: Lowercase with descriptive names (e.g., `app.blade.php`)

### CSS/JavaScript
- **CSS**: Lowercase with descriptive names (e.g., `style.css`)
- **JavaScript**: Lowercase with descriptive names (e.g., `index.js`)

## Directory Organization Principles

### 1. Separation of Concerns
- **Backend Logic**: Contained in `app/` directory
- **Frontend Assets**: Organized in `resources/` directory
- **Public Files**: Served from `public/` directory

### 2. Feature-Based Organization
- **Admin Features**: Grouped in `app/Http/Controllers/Admin/` and `resources/views/Admin/`
- **Service Pages**: Organized in `resources/views/Services/`
- **Authentication**: Centralized in `AuthController.php` and `resources/views/auth/`

### 3. Scalability Considerations
- **Modular Structure**: Easy to add new features without affecting existing code
- **Clear Separation**: Backend and frontend code are clearly separated
- **Reusable Components**: Layouts and components can be reused across pages

## Development Workflow Integration

### 1. Adding New Features
1. Create controller in `app/Http/Controllers/`
2. Add routes in `routes/web.php`
3. Create views in `resources/views/`
4. Add styles in `resources/css/`
5. Add JavaScript in `resources/js/`

### 2. Database Changes
1. Create migration in `database/migrations/`
2. Update models in `app/Models/`
3. Create seeders if needed in `database/seeders/`

### 3. Asset Management
1. Add CSS in `resources/css/`
2. Add JavaScript in `resources/js/`
3. Compile with Vite: `npm run dev` or `npm run build`

## Best Practices

### 1. File Organization
- Keep related files together
- Use descriptive names
- Follow Laravel conventions
- Maintain consistent structure

### 2. Code Organization
- Single responsibility principle
- Clear separation of concerns
- Reusable components
- Consistent naming conventions

### 3. Documentation
- Keep documentation up to date
- Document complex logic
- Include setup instructions
- Provide usage examples

This structure provides a clear, organized foundation for the website project, making it easy for developers to understand and contribute to the codebase.