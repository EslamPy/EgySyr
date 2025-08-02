# Development Guide

This guide provides standards, best practices, and workflows for developers working on the website project.

## Code Standards

### PHP/Laravel Standards

#### 1. PSR-12 Coding Standards
Follow PSR-12 for PHP code formatting:
- Use 4 spaces for indentation
- Use UTF-8 encoding
- Use Unix line endings (LF)
- End files with a single newline
- Use camelCase for method names
- Use PascalCase for class names

#### 2. Laravel Conventions
- **Controllers**: Use singular form (e.g., `UserController`, not `UsersController`)
- **Models**: Use singular form (e.g., `User`, not `Users`)
- **Database Tables**: Use plural form (e.g., `users`, not `user`)
- **Routes**: Use kebab-case (e.g., `/user-profile`, not `/userProfile`)

#### 3. File Organization
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin-specific controllers
│   │   ├── Api/            # API controllers (future)
│   │   └── PageController.php
│   ├── Middleware/
│   └── Requests/           # Form request validation
├── Models/
├── Services/               # Business logic
└── Providers/
```

### Frontend Standards

#### 1. CSS/SCSS
- Use Tailwind CSS utility classes when possible
- Custom styles in `resources/css/style.css`
- Follow BEM methodology for custom components
- Use responsive design principles

#### 2. JavaScript
- Use ES6+ syntax
- Keep functions small and focused
- Use meaningful variable and function names
- Comment complex logic

#### 3. Blade Templates
- Use descriptive variable names
- Keep templates clean and readable
- Use Blade components for reusable elements
- Avoid complex logic in templates

## Development Workflow

### 1. Git Workflow

#### Branch Naming Convention
```
feature/user-authentication
bugfix/contact-form-validation
hotfix/security-patch
```

#### Commit Message Format
```
type(scope): description

[optional body]

[optional footer]
```

**Types**:
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes
- `refactor`: Code refactoring
- `test`: Adding tests
- `chore`: Maintenance tasks

**Examples**:
```
feat(auth): add user registration functionality
fix(blog): resolve search pagination issue
docs(readme): update installation instructions
```

### 2. Feature Development Process

1. **Create Feature Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make Changes**
   - Follow coding standards
   - Write meaningful commit messages
   - Test your changes

3. **Test Your Changes**
   ```bash
   php artisan test
   npm run test  # if tests exist
   ```

4. **Create Pull Request**
   - Provide clear description
   - Include screenshots if UI changes
   - Reference related issues

### 3. Code Review Checklist

#### Backend Review
- [ ] Follows PSR-12 standards
- [ ] Uses Laravel conventions
- [ ] Includes proper error handling
- [ ] Validates user input
- [ ] Uses appropriate database queries
- [ ] Includes necessary comments
- [ ] No security vulnerabilities

#### Frontend Review
- [ ] Responsive design
- [ ] Accessibility considerations
- [ ] Cross-browser compatibility
- [ ] Performance optimization
- [ ] Clean, readable code
- [ ] Proper asset organization

## Database Development

### 1. Migration Guidelines

#### Creating Migrations
```bash
php artisan make:migration create_table_name
```

#### Migration Best Practices
- Use descriptive table and column names
- Include proper indexes
- Use appropriate data types
- Add foreign key constraints
- Include rollback functionality

#### Example Migration
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('category_id')->constrained();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
```

### 2. Model Guidelines

#### Model Best Practices
- Use proper relationships
- Include fillable/guarded properties
- Add accessors/mutators when needed
- Use scopes for common queries
- Include proper validation rules

#### Example Model
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
```

## Testing Guidelines

### 1. Test Structure
```
tests/
├── Feature/           # Feature tests
├── Unit/             # Unit tests
└── Browser/          # Browser tests (if using Dusk)
```

### 2. Writing Tests

#### Feature Test Example
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleTest extends TestCase
{
    public function test_user_can_view_articles()
    {
        $article = Article::factory()->create();

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($article->title);
    }

    public function test_user_can_search_articles()
    {
        $article = Article::factory()->create(['title' => 'Test Article']);

        $response = $this->get('/blog?search=Test');

        $response->assertStatus(200);
        $response->assertSee($article->title);
    }
}
```

### 3. Running Tests
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ArticleTest.php

# Run with coverage
php artisan test --coverage
```

## Security Guidelines

### 1. Input Validation
- Always validate user input
- Use Laravel's built-in validation
- Sanitize data before database operations
- Use prepared statements (Laravel handles this)

### 2. Authentication & Authorization
- Use Laravel's built-in authentication
- Implement proper role-based access control
- Validate user permissions on all protected routes
- Use middleware for route protection

### 3. Data Protection
- Never store sensitive data in plain text
- Use Laravel's encryption for sensitive data
- Implement proper session management
- Use HTTPS in production

### 4. Common Security Practices
```php
// Always validate input
$request->validate([
    'title' => 'required|string|max:255',
    'email' => 'required|email',
]);

// Use proper authorization
if (auth()->user()->can('edit', $article)) {
    // Allow editing
}

// Sanitize output
{{ e($user->name) }}
```

## Performance Guidelines

### 1. Database Optimization
- Use eager loading for relationships
- Add proper indexes
- Use pagination for large datasets
- Optimize queries

### 2. Caching Strategy
```php
// Cache expensive operations
$articles = Cache::remember('articles', 3600, function () {
    return Article::with('category')->get();
});

// Cache views
@cache('sidebar', 3600)
    @include('partials.sidebar')
@endcache
```

### 3. Asset Optimization
- Use Vite for asset compilation
- Minify CSS and JavaScript
- Optimize images
- Use CDN for static assets

## Debugging Guidelines

### 1. Logging
```php
// Use Laravel's logging
Log::info('User action', ['user_id' => $user->id]);
Log::error('Error occurred', ['error' => $e->getMessage()]);
```

### 2. Debugging Tools
- Laravel Debugbar (development)
- Laravel Telescope (advanced debugging)
- Browser developer tools
- Database query logging

### 3. Common Debugging Commands
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Show routes
php artisan route:list

# Show environment
php artisan env
```

## Deployment Guidelines

### 1. Pre-deployment Checklist
- [ ] All tests pass
- [ ] Environment variables configured
- [ ] Database migrations run
- [ ] Assets compiled
- [ ] Cache cleared
- [ ] Permissions set correctly

### 2. Production Optimization
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### 3. Monitoring
- Set up error logging
- Monitor application performance
- Set up database backups
- Configure uptime monitoring

## Documentation Standards

### 1. Code Documentation
- Document complex business logic
- Use PHPDoc for classes and methods
- Include examples for public APIs
- Keep documentation up to date

### 2. API Documentation
- Document all API endpoints
- Include request/response examples
- Specify authentication requirements
- Document error codes

### 3. README Updates
- Update README when adding new features
- Include setup instructions for new dependencies
- Document breaking changes
- Keep installation steps current

## Code Review Process

### 1. Review Checklist
- [ ] Code follows standards
- [ ] Tests included and passing
- [ ] Documentation updated
- [ ] Security considerations addressed
- [ ] Performance impact assessed
- [ ] No breaking changes (or documented)

### 2. Review Comments
- Be constructive and specific
- Suggest improvements
- Ask questions when unclear
- Provide examples when helpful

### 3. Approval Criteria
- All tests pass
- Code review approved
- Documentation updated
- No security issues
- Performance acceptable

## Resources

### Learning Resources
- [Laravel Documentation](https://laravel.com/docs)
- [PHP PSR Standards](https://www.php-fig.org/psr/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/)

### Tools
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Laravel Telescope](https://laravel.com/docs/telescope)
- [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)