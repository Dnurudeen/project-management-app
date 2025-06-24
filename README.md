# Laravel Project Management App

## Features
- Auth via Laravel Breeze
- Projects & tasks CRUD
- Task filtering
- Dashboard metrics
- Blade frontend

## Setup
1. Clone repo
2. `composer install`
3. `npm install && npm run dev`
4. Setup `.env`
5. `php artisan migrate`
6. `php artisan serve`

## Tech Stack
- Laravel 12
- Blade
- Breeze (Auth)
- MySQL

## Architecture & Design Decisions
- MVC Pattern: Keeps controllers light and logic encapsulated in models and policies.
- Breeze: For simple and extendable auth scaffolding.
- Policies: Used for authorizing actions on projects and tasks.
- AJAX + Blade: Tasks can be edited inline without full page reloads.
- Component-based Views: Blade partials used for cleaner and reusable UI components.
- RESTful Routing: Clean route organization using resource controllers.

## Optional
- Tests
- API routes
