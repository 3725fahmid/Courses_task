<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">🚀 Laravel Project</h2>

<p align="center">
  A modern Laravel-based web application built for performance, scalability, and simplicity.
</p>


📂 Project Structure
---

app/
 ├── Models/
 │   ├── Course.php
 │   ├── CourseModule.php
 │   └── CourseModuleContent.php
 ├── Http/
 │   └── Controllers/
 │       └── CourseController.php
resources/
 ├── views/
 │   └── backend/
 │       └── modules/
 │           └── course/
 │               ├── index.blade.php
 │               └── create.blade.php
database/
 ├── migrations/
 └── seeders/


# 📘 Laravel Course Management System

A simple **Course Management System** built with Laravel that manages **Courses**, **Modules**, and **Contents**.  
Each course can have multiple modules, and each module can contain multiple contents.

---

## 🚀 Features

- 🧩 Course CRUD (Create, Read, Update, Delete)
- 📦 Module management (linked to courses)
- 🗂️ Content management per module
- 🔁 Relationships:
  - `Course → hasMany → Modules`
  - `CourseModule → hasMany → Contents`
- 🧱 Clean Blade templates for frontend
- ⚡ Laravel Eloquent relationships for smooth data handling

---

## 🧩 Tech Stack

| Layer | Technology |
|--------|-------------|
| Backend | **Laravel 10+** |
| Frontend | **Blade Templates, Bootstrap 5** |
| Database | **MySQL** |
| ORM | **Eloquent ORM** |
| Authentication | *Laravel Breeze* |

---

## 🛠️ Project Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/yourusername/laravel-course-management.git
cd laravel-course-management

## 🧩 About the Project
This Laravel application is designed to provide a clean, modular foundation for building dynamic web platforms.  
You can customize it for dashboards, CMS systems, API-driven apps, or e-commerce solutions.

---

## 🧭 Project Setup

### Prerequisites
Make sure you have the following installed:
- PHP >= 8.2  
- Composer  
- Node.js & NPM  
- MySQL or PostgreSQL  
- Git

---

## ⚡ Environment Setup

```bash
# Clone the repository
git clone [https://github.com/yourusername/your-laravel-project.git](https://github.com/3725fahmid/Courses_task.git)

# Navigate to the project directory
cd your-laravel-project

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database credentials in .env
# Then run migrations
php artisan migrate --seed



# Start the Laravel development server
php artisan serve

# Then visit:
👉 http://127.0.0.1:8000