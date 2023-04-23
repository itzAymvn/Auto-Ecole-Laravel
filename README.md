# Auto Ecole

## Description

Ce projet est une application web permettant de gérer une auto-école. Elle permet de gérer les élèves, les moniteurs, les véhicules, les sessions de conduite et les examens.

## Fonctionnalités

-   Gestion des utilisateurs (élèves, moniteurs, administrateurs)
-   Gestion des véhicules
-   Gestion des sessions de conduite
-   Gestion des examens
-   Visualisation des statistiques

## Installation

### Prérequis

-   PHP 8.2
-   Composer
-   MySQL
-   NodeJS

### Installation

1. Cloner le projet

    ```sh
     git clone https://github.com/itzAymvn/AutoEcoleLaravel.git
     cd AutoEcoleLaravel
    ```

2. Installer les dépendances

    ```sh
    composer update
    composer install
    npm install
    ```

3. Créer un fichier .env à partir du fichier .env.example

    ```sh
    cp .env.example .env
    ```

4. Générer une clé d'application

    ```sh
    php artisan key:generate
    ```

5. Créer une base de données et configurer le fichier .env

6. Lancer les migrations

    ```sh
    php artisan migrate
    ```

    Vous pouvez également lancer les seeders pour avoir des données de test

    ```sh
    php artisan db:seed
    ```

7. Lancer le serveur

    ```sh
    php artisan serve
    ```

8. Pour se connecter, utiliser ses identifiants (le mots de passe est 'password') ou créer un compte

    - Administrateur :
        - email : admin@mail.com
        - mot de passe : password
    - Moniteur :
        - email : instructor1@mail.com / instructor2@mail.com
        - mot de passe : password
