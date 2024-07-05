# Driving School Management System

![Image](https://github.com/itzAymvn/AutoEcoleLaravel/blob/main/public/images/og.png?raw=true)

<!-- Menu -->

-   [About](#about)
-   [Description](#description)
-   [Installation](#installation)
-   [Usage](#usage)

### Description

This project is a web application for managing a driving school. It allows for the management of students, instructors, vehicles, driving sessions, and exams.

### Installation

**Prerequisites**

-   PHP 8.2
-   Composer
-   MySQL
-   NodeJS

**Option 1: Traditional Installation**

1. Clone the project

    ```sh
    git clone https://github.com/itzAymvn/auto-ecole-laravel.git
    cd auto-ecole-laravel
    ```

2. Install dependencies

    ```sh
    composer update
    composer install
    npm install
    ```

3. Create a `.env` file from the `.env.example` file

    ```sh
    cp .env.example .env
    ```

4. Generate an application key

    ```sh
    php artisan key:generate
    ```

5. Create a database and configure the `.env` file

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

**Option 2: Docker Installation**

1.  Clone the project

    ```sh
    git clone https://github.com/itzAymvn/auto-ecole-laravel.git
    cd auto-ecole-laravel
    ```

2.  Create a `.env` file from the `.env.example` file

        ```sh
        cp .env.example .env
        ```

3.  Replace the following values in the `.env` file:

    ```sh
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=auto_ecole
    DB_USERNAME=user
    DB_PASSWORD=password
    ```

4.  Start the application using Docker Compose

    ```sh
    docker-compose up -d
    ```

    or

    ```sh
    docker compose up -d
    ```

5.  Run migrations within the Docker container

    ```sh
    docker exec auto-ecole-app php artisan migrate
    ```

6.  Seed the database with test data

    ```sh
    docker exec auto-ecole-app php artisan db:seed
    ```

### Usage

Access the application at `http://localhost:8000`

To log in, use the following credentials:

    - Administrator:
        - email: admin@mail.com
        - password: password
    - Instructor:
        - email: instructor1@mail.com / instructor2@mail.com
        - password: password

Or create an account to access the application.
