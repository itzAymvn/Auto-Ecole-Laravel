# Driving School Management System

### Description
This project is a web application for managing a driving school. It allows for the management of students, instructors, vehicles, driving sessions, and exams.

### Features
- User management (students, instructors, administrators)
- Vehicle management
- Driving session management
- Exam management
- Statistics visualization

### Installation

**Prerequisites**

- PHP 8.2
- Composer
- MySQL
- NodeJS

**Installation Steps**

1. Clone the project

    ```sh
    git clone https://github.com/itzAymvn/AutoEcoleLaravel.git
    cd AutoEcoleLaravel
    ```

2. Install dependencies

    ```sh
    composer update
    composer install
    npm install
    ```

3. Create a .env file from the .env.example file

    ```sh
    cp .env.example .env
    ```

4. Generate an application key

    ```sh
    php artisan key:generate
    ```

5. Create a database and configure the .env file

6. Run migrations

    ```sh
    php artisan migrate
    ```

    You can also run seeders to have test data

    ```sh
    php artisan db:seed
    ```

7. Start the server

    ```sh
    php artisan serve
    ```

8. To log in, use your credentials (the password is 'password') or create an account

    - Administrator:
        - email: admin@mail.com
        - password: password
    - Instructor:
        - email: instructor1@mail.com / instructor2@mail.com
        - password: password
