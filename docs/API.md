# API Documentation

## Overview

This document describes all the routes and endpoints available in the Laravel CMS application.

## Authentication

The application uses Laravel's built-in session-based authentication. Most admin routes require authentication.

### Authentication Headers
For session-based requests, ensure you include:
- `X-CSRF-TOKEN` header with the CSRF token for POST/PUT/DELETE requests
- Session cookies for authenticated requests

## Route Groups

### Public Routes

#### Homepage
- **GET** `/`
- **Controller**: `PageController@welcome`
- **Description**: Display homepage with featured reviews
- **Parameters**: None
- **Response**: Homepage view with reviews data

#### Blog Routes
- **GET** `/blog`
- **Controller**: `PageController@blog`
- **Description**: Display paginated blog posts with filtering options
- **Parameters**:
  - `category` (optional): Filter by category ID
  - `search` (optional): Search in title and content
  - `page` (optional): Pagination page number
- **Example**: `/blog?category=1&search=laravel&page=2`
- **Response**: Blog listing view with filtered articles

- **GET** `/blog/{slug}`
- **Controller**: `PageController@blogDetails`
- **Description**: Display individual blog post
- **Parameters**:
  - `slug` (required): Blog post slug
- **Response**: Blog detail view with article content

#### Static Pages
- **GET** `/about`
- **Controller**: `PageController@about`
- **Description**: Display about page
- **Response**: About page view

- **GET** `/contact`
- **Controller**: `PageController@contact`
- **Description**: Display contact form
- **Response**: Contact form view

- **POST** `/contact`
- **Controller**: `PageController@contact`
- **Description**: Submit contact form
- **Parameters**:
  ```json
  {
    "name": "string|required|max:255",
    "email": "email|required|max:255",
    "subject": "string|required|max:255",
    "message": "string|required|max:1000"
  }
  ```
- **Response**: Redirect with success/error message

#### Policy Pages
- **GET** `/privacy-policy`
- **Controller**: `PageController@policy`
- **Description**: Display privacy policy
- **Response**: Privacy policy view

- **GET** `/data-security`
- **Controller**: `PageController@dataSecurity`
- **Description**: Display data security policy
- **Response**: Data security policy view

- **GET** `/maintenance-policy`
- **Controller**: `PageController@maintenancePolicy`
- **Description**: Display maintenance policy
- **Response**: Maintenance policy view

#### Comments
- **POST** `/add-comment`
- **Controller**: `PageController@addComment`
- **Description**: Submit a comment/review
- **Middleware**: `auth` (requires authentication)
- **Parameters**:
  ```json
  {
    "name": "string|required|max:255",
    "email": "email|required|max:255",
    "message": "string|required|max:1000",
    "rating": "integer|min:1|max:5"
  }
  ```
- **Response**: Redirect with success/error message

### Authentication Routes

#### Guest Routes (Unauthenticated Users Only)

- **GET** `/login`
- **Controller**: `AuthController@showLoginForm`
- **Description**: Display login form
- **Response**: Login form view

- **POST** `/login`
- **Controller**: `AuthController@login`
- **Description**: Authenticate user
- **Parameters**:
  ```json
  {
    "email": "email|required",
    "password": "string|required",
    "remember": "boolean|optional"
  }
  ```
- **Response**: Redirect to dashboard or back to login with errors

- **GET** `/register`
- **Controller**: `AuthController@showRegistrationForm`
- **Description**: Display registration form
- **Response**: Registration form view

- **POST** `/register`
- **Controller**: `AuthController@register`
- **Description**: Register new user
- **Parameters**:
  ```json
  {
    "name": "string|required|max:255",
    "email": "email|required|unique:users|max:255",
    "password": "string|required|min:8|confirmed",
    "password_confirmation": "string|required"
  }
  ```
- **Response**: Redirect to dashboard or back to registration with errors

- **GET** `/forgot-password`
- **Controller**: `AuthController@showForgotPasswordForm`
- **Description**: Display password reset request form
- **Response**: Password reset form view

- **POST** `/forgot-password`
- **Controller**: `AuthController@forgotPassword`
- **Description**: Send password reset email
- **Parameters**:
  ```json
  {
    "email": "email|required|exists:users"
  }
  ```
- **Response**: Redirect with success/error message

#### Authenticated Routes

- **POST** `/logout`
- **Controller**: `AuthController@logout`
- **Description**: Logout current user
- **Middleware**: `auth`
- **Response**: Redirect to homepage

- **GET** `/profile`
- **Controller**: `AuthController@profile`
- **Description**: Display user profile
- **Middleware**: `auth`
- **Response**: Profile view with user data

### Admin Routes

All admin routes are prefixed with `/admin` and require authentication.

#### Dashboard
- **GET** `/admin/dashboard`
- **Controller**: `AdminController@dashboard`
- **Description**: Display admin dashboard with statistics
- **Middleware**: `auth`
- **Response**: Dashboard view with statistics

#### Blog Management

- **GET** `/admin/blogs`
- **Controller**: `AdminController@listBlogs`
- **Description**: Display all blog posts for management
- **Middleware**: `auth`
- **Parameters**:
  - `page` (optional): Pagination page number
  - `search` (optional): Search in title and content
- **Response**: Blog management view with articles list

- **GET** `/admin/blogs/create`
- **Controller**: `AdminController@createBlog`
- **Description**: Display blog creation form
- **Middleware**: `auth`
- **Response**: Blog creation form view

- **POST** `/admin/blogs`
- **Controller**: `AdminController@storeBlog`
- **Description**: Create new blog post
- **Middleware**: `auth`
- **Parameters**:
  ```json
  {
    "title": "string|required|max:255",
    "content": "string|required",
    "category_id": "integer|required|exists:categories,id",
    "featured_image": "file|optional|image|max:2048",
    "status": "string|required|in:draft,published",
    "published_at": "date|optional"
  }
  ```
- **Response**: Redirect to blogs list with success/error message

- **GET** `/admin/blogs/{id}`
- **Controller**: `AdminController@showBlog`
- **Description**: Display single blog post for preview
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Blog post ID
- **Response**: Blog preview view

- **GET** `/admin/blogs/{id}/edit`
- **Controller**: `AdminController@editBlog`
- **Description**: Display blog edit form
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Blog post ID
- **Response**: Blog edit form view

- **PUT** `/admin/blogs/{id}`
- **Controller**: `AdminController@updateBlog`
- **Description**: Update existing blog post
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Blog post ID
  - Same parameters as POST `/admin/blogs`
- **Response**: Redirect to blogs list with success/error message

- **DELETE** `/admin/blogs/{id}`
- **Controller**: `AdminController@destroyBlog`
- **Description**: Delete blog post
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Blog post ID
- **Response**: Redirect to blogs list with success/error message

#### Category Management

- **GET** `/admin/categories`
- **Controller**: `AdminController@listCategories`
- **Description**: Display all categories for management
- **Middleware**: `auth`
- **Response**: Category management view with categories list

- **POST** `/admin/categories`
- **Controller**: `AdminController@storeCategory`
- **Description**: Create new category
- **Middleware**: `auth`
- **Parameters**:
  ```json
  {
    "name": "string|required|max:255",
    "description": "string|optional|max:500",
    "parent_id": "integer|optional|exists:categories,id"
  }
  ```
- **Response**: Redirect to categories list with success/error message

- **PUT** `/admin/categories/{id}`
- **Controller**: `AdminController@updateCategory`
- **Description**: Update existing category
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Category ID
  - Same parameters as POST `/admin/categories`
- **Response**: Redirect to categories list with success/error message

- **DELETE** `/admin/categories/{id}`
- **Controller**: `AdminController@destroyCategory`
- **Description**: Delete category
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Category ID
- **Response**: Redirect to categories list with success/error message

#### Message Management

- **GET** `/admin/messages`
- **Controller**: `AdminController@listMessages`
- **Description**: Display all contact messages
- **Middleware**: `auth`
- **Parameters**:
  - `status` (optional): Filter by status (unread, read)
  - `page` (optional): Pagination page number
- **Response**: Messages management view

- **GET** `/admin/messages/{id}`
- **Controller**: `AdminController@showMessage`
- **Description**: Display individual message
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Message ID
- **Response**: Message detail view

- **PUT** `/admin/messages/{id}/mark-read`
- **Controller**: `AdminController@markMessageAsRead`
- **Description**: Mark message as read
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Message ID
- **Response**: Redirect to messages list with success message

#### Review Management

- **GET** `/admin/reviews`
- **Controller**: `AdminController@listReviews`
- **Description**: Display all user reviews
- **Middleware**: `auth`
- **Parameters**:
  - `status` (optional): Filter by status (pending, approved, rejected)
  - `page` (optional): Pagination page number
- **Response**: Reviews management view

- **PUT** `/admin/reviews/{id}/status`
- **Controller**: `AdminController@updateReviewStatus`
- **Description**: Update review status (approve/reject)
- **Middleware**: `auth`
- **Parameters**:
  - `id` (required): Review ID
  - `status` (required): New status (approved, rejected, pending)
- **Response**: Redirect to reviews list with success/error message

## Response Formats

### Success Responses
- **Views**: Returns rendered HTML view
- **Redirects**: HTTP 302 redirect with flash messages
- **JSON** (if API): 
  ```json
  {
    "success": true,
    "message": "Operation completed successfully",
    "data": {}
  }
  ```

### Error Responses
- **Validation Errors**: HTTP 422 with validation error messages
- **Authentication Errors**: HTTP 401 redirect to login
- **Authorization Errors**: HTTP 403 with error message
- **Not Found**: HTTP 404 with error page
- **Server Errors**: HTTP 500 with error page

### Pagination
List endpoints return paginated results with:
- `current_page`: Current page number
- `per_page`: Items per page
- `total`: Total number of items
- `last_page`: Last page number
- `next_page_url`: Next page URL
- `prev_page_url`: Previous page URL

## Status Codes

- `200 OK`: Successful GET request
- `201 Created`: Successful POST request creating new resource
- `302 Found`: Successful redirect
- `400 Bad Request`: Invalid request data
- `401 Unauthorized`: Authentication required
- `403 Forbidden`: Access denied
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation errors
- `500 Internal Server Error`: Server error

## CSRF Protection

All POST, PUT, and DELETE requests must include a CSRF token:
- **Forms**: Include `@csrf` directive in Blade templates
- **AJAX**: Include `X-CSRF-TOKEN` header with token from meta tag
- **API**: Use Sanctum tokens for API authentication

## Rate Limiting

The application implements rate limiting on:
- Login attempts: 5 attempts per minute per IP
- Password reset: 3 attempts per hour per email
- Contact form: 10 submissions per hour per IP

## Error Handling

The application provides user-friendly error pages for:
- 404 Not Found
- 403 Forbidden
- 500 Server Error
- 503 Service Unavailable

All errors are logged to Laravel's logging system for debugging.