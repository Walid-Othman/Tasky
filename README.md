# 📝 Task Management API (Tasky)

A professional RESTful API built with **Laravel 11** for managing tasks, following best practices and clean code principles.

## 🚀 Technical Highlights

This project demonstrates a solid understanding of Laravel's ecosystem and modern software architecture:

* **Service Layer Pattern**: Business logic is decoupled from Controllers and moved into dedicated Service classes (`TaskService`) for better maintainability and testing.
* **API Resources**: Used `TaskResource` to ensure a consistent and secure JSON response structure, preventing sensitive model data from leaking.
* **Custom Form Requests**: Input validation is handled via `StoreTaskRequest` and `UpdateTaskRequest` to keep controllers clean and focused.
* **Unified Responses**: Implemented a `ResponseTrait` to standardize API success and error messages across the entire application.
* **Authentication-Driven Logic**: All tasks are scoped to the authenticated user using `Auth::id()` and Eloquent relationships.

## 🛠️ Tech Stack

* **Framework**: Laravel 11
* **Database**: MySQL
* **Pattern**: Service Layer & Repository-like approach
* **Authentication**: Laravel Sanctum / Passport (Depends on your setup)

## 📁 Key Files to Review

- **Controller**: `app/Http/Controllers/TaskController.php`
- **Service**: `app/Services/TaskService.php`
- **Resource**: `app/Http/Resources/TaskResource.php`
- **Requests**: `app/Http/Requests/`

## ⚙️ Installation

To get this project running locally, follow these steps:


1-
Clone the repository:
git clone https://github.com/Walid-Othman/Tasky.git
cd Tasky

2-
Install Composer dependencies:
composer install

3-
Set up the Environment file:
cp .env.example .env
Make sure to update your database credentials in the .env file.

4-
Generate Application Key:
php artisan key:generate

5-
Run Migrations:
php artisan migrate

6-
Start the Development Server:
php artisan serve

7-
API Access:
The API will be available at http://127.0.0.1:8000/api.
