## Review Service Sample Project

### Requirements:
* Docker and docker-compose
* php 8.1 or later (8.3 recommended)
* composer 2 or later

### Installation steps
* First execute ``composer install`` command
* Then copy .env.example and rename it to .env
* Then ``./vendor/bin/sail up -d`` to ready mysql
* Then ``php artisan migrate``
* Then ``php artisan db:seed``
* Then ``php artisan serve`` and service is ready to handle requests

### Running Tests
For running tests you only need to run ``php artisan test`` command