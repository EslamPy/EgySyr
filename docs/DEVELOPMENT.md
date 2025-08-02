# Development Guide

## Table of Contents
- [Getting Started](#getting-started)
- [Development Workflow](#development-workflow)
- [Coding Standards](#coding-standards)
- [Database Guidelines](#database-guidelines)
- [Frontend Development](#frontend-development)
- [Testing Guidelines](#testing-guidelines)
- [Git Workflow](#git-workflow)
- [Code Review Process](#code-review-process)
- [Performance Guidelines](#performance-guidelines)
- [Security Best Practices](#security-best-practices)

## Getting Started

### Development Environment Setup

1. **Prerequisites**
   ```bash
   # Check PHP version (8.2+)
   php --version
   
   # Check Composer
   composer --version
   
   # Check Node.js (18+)
   node --version
   npm --version
   ```

2. **Initial Setup**
   ```bash
   # Clone repository
   git clone <repository-url>
   cd laravel-blog-cms
   
   # Install dependencies
   composer install
   npm install
   
   # Environment setup
   cp .env.example .env
   php artisan key:generate
   
   # Database setup
   php artisan migrate
   php artisan db:seed
   
   # Build assets
   npm run dev
   ```

3. **Development Servers**
   ```bash
   # Terminal 1: Laravel server
   php artisan serve
   
   # Terminal 2: Vite dev server (for hot reloading)
   npm run dev
   ```

### IDE Configuration

#### VS Code Extensions
- **PHP Intelephense**: PHP language support
- **Laravel Extension Pack**: Laravel-specific tools
- **Blade Formatter**: Blade template formatting
- **Tailwind CSS IntelliSense**: TailwindCSS autocomplete
- **GitLens**: Enhanced Git integration

#### PHPStorm Configuration
- Enable Laravel plugin
- Configure PHP interpreter
- Set up Blade template support
- Configure Tailwind CSS support

## Development Workflow

### Feature Development Process

1. **Create Feature Branch**
   ```bash
   git checkout -b feature/feature-name
   ```

2. **Development Cycle**
   - Write code following standards
   - Write/update tests
   - Run local tests
   - Commit changes with descriptive messages

3. **Before Push**
   ```bash
   # Format code
   ./vendor/bin/pint
   
   # Run tests
   php artisan test
   
   # Check for issues
   php artisan route:list
   php artisan config:clear
   ```

4. **Create Pull Request**
   - Fill out PR template
   - Request code review
   - Address feedback
   - Merge after approval

### Local Development Commands

```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Database operations
php artisan migrate:fresh --seed
php artisan migrate:rollback
php artisan make:migration create_table_name

# Generate Laravel components
php artisan make:controller ControllerName
php artisan make:model ModelName -m
php artisan make:request RequestName
php artisan make:job JobName

# Asset building
npm run dev          # Development build with watch
npm run build        # Production build
npm run production   # Optimized production build
```

## Coding Standards

### PHP Standards (PSR-12)

#### Class and Method Naming
```php
<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index(): View
    {
        // Method implementation
    }
    
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        // Method implementation
    }
}
```

#### Variable Naming
```php
// Good
$userAccount = User::find($id);
$blogPosts = Article::published()->get();
$isAuthenticated = auth()->check();

// Avoid
$u = User::find($id);
$data = Article::published()->get();
$flag = auth()->check();
```

#### Array and Collection Usage
```php
// Good - Use Laravel collections
$publishedArticles = Article::published()
    ->with('category')
    ->get()
    ->map(function ($article) {
        return [
            'title' => $article->title,
            'category' => $article->category->name,
        ];
    });

// Use early returns
public function show(Article $article): View
{
    if (!$article->isPublished()) {
        abort(404);
    }
    
    return view('blog.show', compact('article'));
}
```

### Laravel-Specific Standards

#### Controller Guidelines
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $articles = Article::published()
            ->with('category', 'user')
            ->latest()
            ->paginate(10);
            
        return view('blog.index', compact('articles'));
    }
    
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);
        
        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }
}
```

#### Model Guidelines
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'user_id',
        'featured_image',
        'status',
        'published_at',
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'string',
    ];
    
    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }
    
    // Accessors/Mutators
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 150);
    }
}
```

#### Request Validation
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
        ];
    }
    
    public function messages(): array
    {
        return [
            'title.required' => 'The article title is required.',
            'category_id.exists' => 'Please select a valid category.',
        ];
    }
}
```

## Database Guidelines

### Migration Best Practices

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['status', 'published_at']);
            $table->index('slug');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
```

### Query Optimization

```php
// Good - Eager loading
$articles = Article::with('category', 'user')
    ->published()
    ->latest()
    ->paginate(10);

// Good - Specific columns
$categories = Category::select('id', 'name')
    ->orderBy('name')
    ->get();

// Good - Chunking for large datasets
Article::published()
    ->chunk(100, function ($articles) {
        foreach ($articles as $article) {
            // Process article
        }
    });
```

## Frontend Development

### Blade Template Guidelines

```php
{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Latest Blog Posts</h1>
    
    @if($articles->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($articles as $article)
                @include('blog.partials.article-card', ['article' => $article])
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @else
        <p class="text-gray-600">No articles found.</p>
    @endif
</div>
@endsection
```

### JavaScript Standards

```javascript
// Use modern ES6+ syntax
const fetchArticles = async (page = 1) => {
    try {
        const response = await fetch(`/api/articles?page=${page}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching articles:', error);
        throw error;
    }
};

// Use const/let instead of var
const articleElements = document.querySelectorAll('.article-card');
let currentPage = 1;

// Event delegation for dynamic content
document.addEventListener('click', (event) => {
    if (event.target.matches('.load-more-btn')) {
        loadMoreArticles();
    }
});
```

### CSS/TailwindCSS Guidelines

```html
<!-- Component-based approach -->
<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <img 
        src="{{ $article->featured_image }}" 
        alt="{{ $article->title }}"
        class="w-full h-48 object-cover"
    >
    
    <div class="p-6">
        <h2 class="text-xl font-semibold mb-2 text-gray-900">
            {{ $article->title }}
        </h2>
        
        <p class="text-gray-600 mb-4">
            {{ $article->excerpt }}
        </p>
        
        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">
                {{ $article->published_at->format('M d, Y') }}
            </span>
            
            <a 
                href="{{ route('blog.show', $article->slug) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors duration-200"
            >
                Read More
            </a>
        </div>
    </div>
</article>
```

## Testing Guidelines

### Feature Tests

```php
<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_view_published_articles(): void
    {
        $article = Article::factory()->published()->create();
        
        $response = $this->get('/blog');
        
        $response->assertStatus(200);
        $response->assertSee($article->title);
    }
    
    public function test_admin_can_create_article(): void
    {
        $user = User::factory()->create();
        
        $articleData = [
            'title' => 'Test Article',
            'content' => 'Test content',
            'category_id' => 1,
            'status' => 'published',
        ];
        
        $response = $this->actingAs($user)
            ->post('/admin/blogs', $articleData);
            
        $response->assertRedirect('/admin/blogs');
        $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
    }
}
```

### Unit Tests

```php
<?php

namespace Tests\Unit;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_article_excerpt_is_limited_to_150_characters(): void
    {
        $longContent = str_repeat('Lorem ipsum ', 50);
        
        $article = Article::factory()->create([
            'content' => $longContent
        ]);
        
        $this->assertLessThanOrEqual(150, strlen($article->excerpt));
    }
    
    public function test_published_scope_returns_only_published_articles(): void
    {
        Article::factory()->published()->count(3)->create();
        Article::factory()->draft()->count(2)->create();
        
        $publishedArticles = Article::published()->get();
        
        $this->assertCount(3, $publishedArticles);
    }
}
```

## Git Workflow

### Branch Naming Convention

```bash
# Feature branches
feature/user-authentication
feature/blog-comments
feature/admin-dashboard

# Bug fixes
bugfix/login-validation
bugfix/image-upload

# Hotfixes
hotfix/security-patch
hotfix/critical-bug
```

### Commit Message Format

```
type(scope): description

[optional body]

[optional footer]
```

**Examples:**
```
feat(auth): add password reset functionality

Add password reset via email with secure token generation
and expiration handling.

Closes #123

fix(blog): resolve pagination issue on category filter

The pagination was not working correctly when filtering by category.
Fixed by updating the query builder to maintain filter parameters.

docs(api): update route documentation

Add missing parameter descriptions and response examples
for the blog management endpoints.
```

### Commit Types

- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, semicolons, etc.)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

## Code Review Process

### Pull Request Template

```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Breaking change
- [ ] Documentation update

## Testing
- [ ] Unit tests pass
- [ ] Feature tests pass
- [ ] Manual testing completed

## Checklist
- [ ] Code follows project standards
- [ ] Self-review completed
- [ ] Documentation updated
- [ ] Database migrations included (if applicable)
```

### Review Guidelines

**For Authors:**
- Keep PRs small and focused
- Write clear descriptions
- Include screenshots for UI changes
- Test thoroughly before requesting review

**For Reviewers:**
- Check code quality and standards
- Verify tests are adequate
- Look for security issues
- Ensure documentation is updated

## Performance Guidelines

### Database Performance

```php
// Good - Eager loading
$articles = Article::with('category', 'user')->get();

// Good - Select specific columns
$articles = Article::select('id', 'title', 'slug')->get();

// Good - Use indexes
// In migration:
$table->index(['status', 'published_at']);

// Good - Avoid N+1 queries
$articles = Article::with('category')->get();
foreach ($articles as $article) {
    echo $article->category->name; // No additional query
}
```

### Caching Strategy

```php
// Cache expensive queries
$categories = Cache::remember('categories', 3600, function () {
    return Category::with('articles')->get();
});

// Cache views
return Cache::remember("article.{$slug}", 3600, function () use ($slug) {
    return Article::where('slug', $slug)->firstOrFail();
});
```

## Security Best Practices

### Input Validation

```php
// Always validate input
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);
    
    // Use validated data
    Article::create($validated);
}
```

### Output Escaping

```php
{{-- Blade automatically escapes --}}
<h1>{{ $article->title }}</h1>

{{-- For HTML content, use policy --}}
<div>{!! Purifier::clean($article->content) !!}</div>
```

### File Uploads

```php
public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);
    
    $path = $request->file('image')->store('images', 'public');
    
    return $path;
}
```

This development guide provides the foundation for maintaining code quality and consistency across the Laravel CMS project.