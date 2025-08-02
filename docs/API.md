# API Documentation

This document outlines the available routes and endpoints in the website application. While this is primarily a web application using Blade templates, understanding the routes helps developers work with the application.

## Base URL

- **Development**: `http://localhost:8000`
- **Production**: `https://yourdomain.com`

## Authentication

The application uses Laravel's built-in authentication system with session-based authentication.

### Authentication Endpoints

| Method | Endpoint | Description | Middleware |
|--------|----------|-------------|------------|
| GET | `/login` | Display login form | `guest` |
| POST | `/login` | Process login | `guest` |
| GET | `/register` | Display registration form | `guest` |
| POST | `/register` | Process registration | `guest` |
| GET | `/forgot-password` | Display password reset form | `guest` |
| POST | `/forgot-password` | Process password reset | `guest` |
| POST | `/logout` | Logout user | `auth` |
| GET | `/profile` | Display user profile | `auth` |

### Authentication Response Examples

#### Login Form (GET /login)
```html
<form method="POST" action="/login">
    @csrf
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
```

#### Login Response (POST /login)
- **Success**: Redirect to `/dashboard`
- **Error**: Return to login form with validation errors

## Public Pages

### Main Pages

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/` | Home page | `PageController@welcome` |
| GET | `/about` | About page | `PageController@about` |
| GET | `/contact` | Contact page | `PageController@contact` |
| POST | `/contact` | Submit contact form | `PageController@storeContact` |
| GET | `/custom` | Custom page | `PageController@custom` |

### Blog System

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/blog` | Blog listing page | `PageController@blog` |
| GET | `/blog/{id}` | Blog article details | `PageController@blogDetails` |
| GET | `/articles/search` | Search articles | `PageController@searchArticles` |

#### Blog Query Parameters

**GET /blog**
```
?category=1          # Filter by category ID
?search=keyword      # Search in title, summary, content
?page=2             # Pagination
```

#### Blog Response Example
```php
// Response data structure
[
    'articles' => [
        [
            'id' => 1,
            'title' => 'Article Title',
            'summary' => 'Article summary...',
            'content' => 'Full article content...',
            'category_id' => 1,
            'created_at' => '2024-01-01 12:00:00',
            'category' => [
                'id' => 1,
                'name' => 'Technology'
            ]
        ]
    ],
    'categories' => [
        [
            'id' => 1,
            'name' => 'Technology'
        ]
    ]
]
```

### Service Pages

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/services` | Services main page | `PageController@services` |
| GET | `/services/application` | Application service | `PageController@serviceApplication` |
| GET | `/services/graphic` | Graphic design service | `PageController@serviceGraphic` |
| GET | `/services/hosting` | Hosting service | `PageController@serviceHosting` |
| GET | `/services/marketing` | Marketing service | `PageController@serviceMarketing` |
| GET | `/services/protection-systems` | Protection systems service | `PageController@serviceProtectionSystems` |
| GET | `/services/system` | System service | `PageController@serviceSystem` |
| GET | `/services/web` | Web development service | `PageController@serviceWeb` |

### Policy Pages

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/data-security` | Data security policy | `PageController@dataSecurity` |
| GET | `/maintenance-policy` | Maintenance policy | `PageController@maintenancePolicy` |
| GET | `/policy` | General policy | `PageController@policy` |

## Admin Panel

All admin routes are protected by authentication middleware and require admin privileges.

### Admin Base URL
- **Development**: `http://localhost:8000/admin`
- **Production**: `https://yourdomain.com/admin`

### Dashboard

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/dashboard` | Admin dashboard | `AdminController@dashboard` |

### Blog Management

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/blogs` | List all blogs | `AdminController@listBlogs` |
| GET | `/admin/blogs/create` | Create blog form | `AdminController@createBlog` |
| POST | `/admin/blogs` | Store new blog | `AdminController@storeBlog` |
| GET | `/admin/blogs/{id}` | Show blog details | `AdminController@showBlog` |
| GET | `/admin/blogs/{id}/edit` | Edit blog form | `AdminController@editBlog` |
| PUT | `/admin/blogs/{id}` | Update blog | `AdminController@updateBlog` |
| DELETE | `/admin/blogs/{id}` | Delete blog | `AdminController@destroyBlog` |

#### Blog Management Request Examples

**POST /admin/blogs** (Create Blog)
```php
// Request data
[
    'title' => 'Blog Title',
    'summary' => 'Blog summary...',
    'content' => 'Blog content...',
    'category_id' => 1,
    'status' => 'published'
]
```

**PUT /admin/blogs/{id}** (Update Blog)
```php
// Request data
[
    'title' => 'Updated Blog Title',
    'summary' => 'Updated summary...',
    'content' => 'Updated content...',
    'category_id' => 2,
    'status' => 'draft'
]
```

### Category Management

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/categories` | List all categories | `AdminController@listCategories` |
| POST | `/admin/categories` | Store new category | `AdminController@storeCategory` |
| PUT | `/admin/categories/{id}` | Update category | `AdminController@updateCategory` |
| DELETE | `/admin/categories/{id}` | Delete category | `AdminController@destroyCategory` |

#### Category Request Examples

**POST /admin/categories** (Create Category)
```php
// Request data
[
    'name' => 'Technology',
    'description' => 'Technology related articles'
]
```

### Message Management

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/messages` | List all messages | `AdminController@listMessages` |
| GET | `/admin/messages/{id}` | Show message details | `AdminController@showMessage` |
| PUT | `/admin/messages/{id}/read` | Mark as read | `AdminController@markAsRead` |
| DELETE | `/admin/messages/{id}` | Delete message | `AdminController@destroyMessage` |
| POST | `/admin/messages/reply` | Reply to message | `AdminController@replyToMessage` |

#### Message Response Example
```php
// Message data structure
[
    'id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'subject' => 'Inquiry',
    'message' => 'Message content...',
    'status' => 'unread',
    'created_at' => '2024-01-01 12:00:00'
]
```

### Review Management

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/reviews` | List all reviews | `AdminController@listReviews` |
| GET | `/admin/reviews/{id}` | Show review details | `AdminController@showReview` |
| PUT | `/admin/reviews/{id}/status` | Update review status | `AdminController@updateReviewStatus` |
| DELETE | `/admin/reviews/{id}` | Delete review | `AdminController@destroyReview` |

#### Review Status Update Example

**PUT /admin/reviews/{id}/status**
```php
// Request data
[
    'status' => 'publication'  // or 'unread'
]
```

### Settings Management

| Method | Endpoint | Description | Controller Method |
|--------|----------|-------------|-------------------|
| GET | `/admin/settings` | Show settings | `AdminController@showSettings` |
| POST | `/admin/settings/update` | Update settings | `AdminController@updateSettings` |

## Data Models

### User Model
```php
// User attributes
[
    'id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'email_verified_at' => '2024-01-01 12:00:00',
    'created_at' => '2024-01-01 12:00:00',
    'updated_at' => '2024-01-01 12:00:00'
]
```

### Article Model
```php
// Article attributes
[
    'id' => 1,
    'title' => 'Article Title',
    'summary' => 'Article summary...',
    'content' => 'Article content...',
    'category_id' => 1,
    'status' => 'published',
    'created_at' => '2024-01-01 12:00:00',
    'updated_at' => '2024-01-01 12:00:00',
    'category' => [
        'id' => 1,
        'name' => 'Technology'
    ]
]
```

### Category Model
```php
// Category attributes
[
    'id' => 1,
    'name' => 'Technology',
    'description' => 'Technology related articles',
    'created_at' => '2024-01-01 12:00:00',
    'updated_at' => '2024-01-01 12:00:00'
]
```

### Review Model
```php
// Review attributes
[
    'id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'rating' => 5,
    'comment' => 'Great service!',
    'service_type' => 'service_Application',
    'status' => 'publication',
    'created_at' => '2024-01-01 12:00:00',
    'updated_at' => '2024-01-01 12:00:00'
]
```

### Contact Model
```php
// Contact attributes
[
    'id' => 1,
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'subject' => 'Inquiry',
    'message' => 'Message content...',
    'status' => 'unread',
    'created_at' => '2024-01-01 12:00:00',
    'updated_at' => '2024-01-01 12:00:00'
]
```

## Error Handling

### Common HTTP Status Codes

| Status Code | Description |
|-------------|-------------|
| 200 | OK - Request successful |
| 201 | Created - Resource created successfully |
| 400 | Bad Request - Invalid request data |
| 401 | Unauthorized - Authentication required |
| 403 | Forbidden - Access denied |
| 404 | Not Found - Resource not found |
| 422 | Unprocessable Entity - Validation errors |
| 500 | Internal Server Error - Server error |

### Validation Error Response
```php
// 422 Unprocessable Entity
[
    'message' => 'The given data was invalid.',
    'errors' => [
        'title' => ['The title field is required.'],
        'email' => ['The email must be a valid email address.']
    ]
]
```

### Authentication Error Response
```php
// 401 Unauthorized
[
    'message' => 'Unauthenticated.'
]
```

## Security Considerations

### CSRF Protection
All POST, PUT, PATCH, and DELETE requests require CSRF token:
```html
@csrf
```

### Authentication
- Session-based authentication
- Middleware protection on admin routes
- Password hashing for user accounts

### Input Validation
- Server-side validation on all forms
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade templating

## Rate Limiting

The application implements rate limiting on:
- Login attempts
- Contact form submissions
- API endpoints (if implemented)

## Caching

### Route Caching
```bash
php artisan route:cache
```

### Config Caching
```bash
php artisan config:cache
```

### View Caching
```bash
php artisan view:cache
```

## Development Tools

### Route List
```bash
php artisan route:list
```

### Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Future API Development

When implementing a RESTful API:

1. **Create API Controllers**
   ```bash
   php artisan make:controller Api/ArticleController --api
   ```

2. **API Routes**
   ```php
   Route::prefix('api/v1')->group(function () {
       Route::apiResource('articles', Api\ArticleController::class);
   });
   ```

3. **API Authentication**
   - Implement token-based authentication
   - Use Laravel Sanctum or Passport
   - Implement API rate limiting

4. **API Documentation**
   - Use tools like Swagger/OpenAPI
   - Document all endpoints
   - Include request/response examples