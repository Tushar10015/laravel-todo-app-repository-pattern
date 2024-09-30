# Laravel Advanced Todo App with Docker

## Introduction

This is an advanced Todo application built with Laravel, showcasing various advanced features of the Laravel framework. The application allows users to manage their tasks efficiently and demonstrates best practices in Laravel development. The project is containerized using Docker for easy setup and deployment.

## Features

-   **User Authentication**: Secure user registration and login using Laravel Breeze.
-   **CRUD Operations**: Create, read, update, and delete todos.
-   **Repository Pattern**: Abstract data access logic for maintainability.
-   **Service Layer**: Encapsulate business logic in service classes.
-   **Dependency Injection**: Use Laravel's IoC container for injecting dependencies.
-   **Eloquent Advanced Features**:
    -   Scopes
    -   Accessors and Mutators
-   **Event and Listener**: Implement events and listeners for decoupled architecture.
-   **Task Scheduling**: Automated tasks using Laravel's scheduler.
-   **Queues and Jobs**: Offload tasks to the background using queues.
-   **Testing with Pest**: Write expressive tests using the Pest testing framework.
-   **Blade Components**: Use reusable components for views with Tailwind CSS.
-   **Dockerized Environment**: Containerize the application for consistent development and deployment environments.

## Technologies Used

-   **Laravel 11.x**
-   **PHP 8.x**
-   **MySQL**
-   **Docker**
-   **Tailwind CSS**
-   **Pest (Testing Framework)**
-   **Laravel Breeze**
-   **Sail**

## Laravel Features Used

### 1. **Authentication with Laravel Breeze**

-   Provides a starter kit for authentication.
-   Includes login, registration, and password reset functionalities.

### 2. **Repository Pattern**

-   Abstracts data access logic.
-   Promotes loose coupling and testability.

### 3. **Service Layer**

-   Encapsulates business logic.
-   Keeps controllers thin and focused on handling HTTP requests.

### 4. **Dependency Injection**

-   Uses Laravel's IoC container.
-   Injects services and repositories into controllers.

### 5. **Eloquent Advanced Features**

-   **Scopes**: Reusable query constraints.
-   **Accessors and Mutators**: Customize attribute values on retrieval or before saving.

### 6. **Events and Listeners**

-   Decouples components.
-   Triggers actions (like sending notifications) on specific events.

### 7. **Task Scheduling**

-   Automates tasks like cleaning up old todos.
-   Uses Laravel's scheduler in `app/Console/Kernel.php`.

### 8. **Queues and Jobs**

-   Offloads tasks to the background.
-   Improves application performance and responsiveness.

### 10. **Testing with Pest**

-   Provides a concise and expressive syntax.
-   Simplifies writing and maintaining tests.

### 11. **Blade Components with Tailwind CSS**

-   Uses reusable Blade components.
-   Simplifies views and promotes consistency.

### 12. **Dockerization**

-   Containerizes the application.
-   Ensures consistent development and production environments.
