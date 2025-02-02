# Client Payments Management System

A Laravel-based web application for managing clients and their payment records, featuring a dynamic dashboard with date-based filtering capabilities. This project demonstrates modern Laravel development practices, including authentication, database management, and real-time data filtering.

## Project Overview

This application serves as a comprehensive client payment tracking system, allowing users to:
- Manage client information through a complete CRUD interface
- Record and track client payments
- View a dynamic dashboard showing clients with their latest payment information
- Filter payment records by date ranges
- Maintain data security through user authentication

## Technologies Used

### Core Framework and Backend
- Laravel 11.x - The latest version of the Laravel PHP framework
- PHP 8.x - Taking advantage of modern PHP features
- SQLite Database - For efficient local data storage

### Frontend and UI
- Laravel Breeze - For authentication scaffolding and basic UI components
- Tailwind CSS - For responsive and modern styling
- Alpine.js - Included with Breeze for dynamic frontend interactions
- jQuery - Supporting DataTables functionality

### Data Handling and Display
- DataTables - For enhanced table functionality including sorting and searching
- Laravel's Eloquent ORM - For database interactions
- Blade Templating Engine - For view rendering

### Additional Features
- Rate Limiting - Implementing request throttling for security
- Dark Mode Support - Full dark theme implementation
- Form Validation - Server-side validation for data integrity
- Error Handling - Comprehensive error handling and logging

## Installation

1. Clone the repository:
```bash
git clone https://github.com/kostasol/Laravel-App.git
cd Laravel-App
```

2.Install PHP dependencies:
```
composer install
```
3.Install and compile frontend dependencies:
```
npm install
npm run dev
```
4.Configure environment:
```
cp .env.example .env
php artisan key:generate
```
5.Configure database:

The project uses SQLite by default

Create the database file:
```
touch database/database.sqlite
```
6.Run migrations and seed the database:
```
php artisan migrate:fresh --seed
```

<h2>Usage</h2>

After installation, you can:

<ul>
<li>Register a new user account (/register)</li>
<li>Log in to access the dashboard</li>
<li>View the client list with their latest payments</li>
<li>Add, edit, or remove clients</li>
<li>Record new payments</li>
<li>Filter payments by date range</li>
</ul>

<h2>Project Structure</h2>

The application follows Laravel's standard MVC architecture with some additional organizational patterns:

<ul>
<li>app/Http/Controllers - Contains ClientController, PaymentController, and DashboardController</li>
<li>app/Models - Contains Client and Payment models with their relationships</li>
<li>app/Services - Contains the ClientDataTable service for handling DataTables functionality</li>
<li>resources/views - Contains Blade templates organized by feature</li>
<li>routes/web.php - Contains all web routes with proper middleware and rate limiting</li>
</ul>

<h2>Database Design</h2>

The database consists of two main tables:

<h4>clients</h4>

<ul>
<li>id (primary key)</li>
<li>name</li>
<li>surname</li>
<li>timestamps</li>
</ul>


<h4>payments</h4>
<ul>
<li>id (primary key)</li>
<li>client_id (foreign key)</li>
<li>amount</li>
<li>timestamps</li>
</ul>


<h2>Security Features</h2>
    
<ul>
<li>User Authentication (Laravel Breeze)</li>
<li>CSRF Protection</li>
<li>Rate Limiting on Routes</li>
<li>Input Validation</li>
<li>SQL Injection Prevention (through Laravel's Query Builder and Eloquent)</li>
</ul>
    
<h2>Performance Optimizations</h2>

<ul>
<li>Database Indexing</li>
<li>Eager Loading of Relationships</li>
<li>Query Optimization for DataTables</li>
<li>Proper Rate Limiting Configuration</li>
<ul>




