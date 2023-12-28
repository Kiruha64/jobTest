## Installation

1. Pull the code from repo.
2. Copy `.env.example` to  `.env` and fill in the proper  information.
3. Build Docker containers `docker-compose build`.
4. Run the containers `docker-compose  up -d`
5. Install composer dependencies `docker-compose exec php-fpm composer install`
6. Create an empty DB (for easy managing use phpmyadmin that should be located on http://localhost:8182).
7. Run the migrations and seeders (if any) `docker-compose exec php-fpm php artisan migrate`

