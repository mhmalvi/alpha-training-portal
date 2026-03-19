# Alpha Training Portal

The official website and content management portal for **Alpha Training**, built with Laravel 8 and Jetstream. This platform provides a public-facing training institute website with blog publishing, course showcases, and a secure admin panel.

## Overview

Alpha Training Portal is a server-rendered Laravel application that serves as the public website and CMS for the training organization. It features Jetstream authentication with Livewire for interactive functionality, Tailwind CSS for responsive design, and a comprehensive admin dashboard for managing site content.

## Tech Stack

| Layer       | Technology                                        |
|-------------|---------------------------------------------------|
| Backend     | PHP 7.3+ / 8.0, Laravel 8                       |
| Frontend    | Blade Templates, Livewire, Tailwind CSS           |
| Auth        | Laravel Jetstream (Livewire stack), Fortify        |
| Database    | MySQL                                             |
| Media       | Intervention Image                                |
| SEO         | Eloquent Sluggable                                |
| Build Tools | Laravel Mix 5, Webpack                            |
| Testing     | PHPUnit                                           |

## Key Features

### Public Website
- Homepage with training program information
- Course and program catalog
- Blog with categorized articles
- SEO-friendly URLs via sluggable models

### Blog Management
- Full blog CRUD with create, edit, and delete workflows
- Category-based content organization
- Rich-text content editing
- Image uploads and media processing
- Admin scripts for enhanced editor functionality

### Admin Panel
- Secure admin dashboard
- Blog and category management
- Profile and account settings
- Breadcrumb navigation
- Responsive admin layout

### Authentication & Security
- User registration and login
- Two-factor authentication support
- Password reset and recovery
- Profile management with photo uploads

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/              # Blog, category, and dashboard controllers
│   ├── BlogController.php  # Public blog display
│   └── HomeController.php  # Homepage
├── Models/                 # Blog, Category, User
├── Http/Requests/          # Form validation (BlogCreate, BlogUpdate, Profile)
├── Actions/Fortify/        # Authentication actions
└── Actions/Jetstream/      # User management actions
resources/views/
├── admin/                  # Admin panel templates
│   ├── blogs/              # Blog management views
│   ├── categories/         # Category management
│   ├── components/         # Shared admin components
│   ├── layouts/            # Admin layout and assets
│   └── settings/           # Profile settings
├── auth/                   # Authentication views
└── api/                    # API token management
routes/
├── web.php                 # Public and admin web routes
└── api.php                 # API routes
```

## Prerequisites

- PHP >= 7.3
- Composer
- Node.js & npm
- MySQL

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mhmalvi/alpha-training-portal.git
   cd alpha-training-portal
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up the database**

   Configure your MySQL connection in `.env` and run:
   ```bash
   php artisan migrate
   ```

5. **Build frontend assets**
   ```bash
   npm run dev        # Development
   npm run production # Production
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## License

This project is proprietary software developed for Alpha Training.