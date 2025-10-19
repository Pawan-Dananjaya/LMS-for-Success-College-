# Learning Management System (LMS) for Success College

This is a Laravel-based Learning Management System (LMS) developed for Success College. The system manages courses, lessons, user enrollments, and content delivery.

## Project Structure Overview

### Models
- `User` - Handles user management
- `Course` - Manages course information
- `Lesson` - Contains lesson details
- `Enrollment` - Tracks student course enrollments

### Database Structure

#### Migrations
1. Users Table (2025_10_14_035510_create_users_table.php)
2. Courses Table (2025_10_14_040606_create_courses_table.php)
3. Lessons Table (2025_10_14_043248_create_lessons_table.php)
4. Enrollments Table (2025_10_14_044214_create_enrollments_table.php)

Additional system tables:
- Password Resets Table
- Failed Jobs Table
- Personal Access Tokens Table

### Directory Structure

```
app/
├── Http/
│   ├── Controllers/     # Application controllers
│   └── Middleware/      # Custom middleware
├── Models/              # Database models
│   ├── courses.php
│   ├── enrollments.php
│   ├── lessons.php
│   └── users.php
├── Providers/          # Service providers
└── Console/           # Console commands

resources/
├── views/             # Blade templates
│   ├── auth/
│   ├── dashboard/
│   ├── layouts/
│   └── welcome.blade.php
├── css/
└── js/

public/
├── image/            # Public images
└── pdfs/            # PDF resources

database/
├── migrations/      # Database migrations
└── seeders/        # Database seeders

routes/
├── api.php         # API routes
├── channels.php    # Broadcasting channels
├── console.php    # Console routes
└── web.php        # Web routes
```

## Key Technologies

- Laravel Framework
- PHP
- Blade Templating Engine
- MySQL Database
- Vite for asset compilation

## Configuration Files

The project includes standard Laravel configuration files in the `config/` directory:
- app.php
- auth.php
- database.php
- filesystems.php
- mail.php
- services.php
- session.php

## Development Setup

1. Clone the repository
2. Install PHP dependencies: `composer install`
3. Install NPM dependencies: `npm install`
4. Configure `.env` file
5. Run migrations: `php artisan migrate`
6. Start development server: `php artisan serve`

## Project Features

1. User Authentication System
2. Course Management
3. Lesson Management
4. Student Enrollment System
5. Content Delivery System
6. User Role Management
7. File Upload System

## Database Schema

### Users Table
- id (primary key)
- name
- email
- password
- role
- timestamps

### Courses Table
- id (primary key)
- title
- description
- instructor_id (foreign key to users)
- timestamps

### Lessons Table
- id (primary key)
- course_id (foreign key to courses)
- title
- content
- order
- timestamps

### Enrollments Table
- id (primary key)
- user_id (foreign key to users)
- course_id (foreign key to courses)
- status
- timestamps

## API Routes

The system includes API endpoints for:
- User management
- Course operations
- Lesson management
- Enrollment handling

## Security

The application implements:
- Laravel's built-in authentication
- Middleware for route protection
- CSRF protection
- Session management
- Role-based access control

## File Storage

- Public storage for course materials
- Private storage for sensitive documents
- Image storage for course thumbnails
- PDF storage for course materials

## Additional Information

- Project uses Laravel's standard MVC architecture
- Implements repository pattern for data access
- Uses Laravel's built-in authentication system
- Includes custom middleware for role-based access
- Follows PSR-4 autoloading standards