
# Little Emperors Tech Test

## Project Overview

This Laravel project implements a hotel management system with data import functionality and a RESTful API. The application allows importing hotel data from JSON and CSV files, storing them in a database, and performing CRUD operations on hotels. The project follows best practices, including SOLID principles and proper separation of concerns.

## Features

-   **Hotel Data Import:** Import hotel data from JSON and CSV files using a console command.
-   **RESTful API:** CRUD operations for managing hotels.
-   **Soft Delete:** Hotels are not permanently removed but flagged as deleted.
-   **JWT Authentication:** Secure API access with JSON Web Token.

## Setup Instructions

Ensure you have the following installed:

-   PHP 8.x
-   Composer
-   Laravel 10.x
-   MySQL (running on default port `3306`)
-   Postman (optional, for testing API endpoints)

### Installation Steps

1.  Clone the repository:
    ```
    git clone <repository-url>
    cd <project-directory>
    ```
2.  Install dependencies:
    ```
    composer install
    ```
3.  Copy the environment configuration file:
    ```
    cp .env.example .env
    ```
4.  Configure your `.env` file with database settings:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```
5.  Generate application key:
    ```
    php artisan jwt:secret
    ```
6.  Run migrations below to seed the database with 1 admin and 1 guest user (For test purposes):
    ```
    php artisan db:seed UserSeeder
    ```
7.  Run the Laravel development server:
    ```
    php artisan serve
    ```
    
## Importing Hotel Data

The application provides a command-line tool to import hotel data from JSON or CSV files.

### Import Commands
To import hotels from a JSON file:
```
php artisan app:import-hotels hotels.json
```
To import hotels from a CSV file (semicolon `;` as delimiter):
```
php artisan app:import-hotels hotels.csv --delimiter=";"
```
## API Endpoints

### Authentication
-   **Login** (Returns JWT token)
    ```
    POST /api/login
    ```
### Hotels Management

-   **List all hotels**
    ```
    GET /api/hotels
    ```
    _Response:_  `id`, `name`, `image`, `stars`, `city`
    
-   **Retrieve hotel details**
    ```
    GET /api/hotels/{id}
    ```
-   **Create a new hotel**
    ```
    POST /api/hotels
    ```
-   **Update an existing hotel**
    ```
    PUT /api/hotels/{id}
    ```
-   **Soft delete a hotel**
    ```
    DELETE /api/hotels/{id}
    ```

## Testing with Postman

A Postman collection is available in the main directory. Import it into Postman to test the API endpoints easily.