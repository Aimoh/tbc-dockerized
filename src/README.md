# Installation

    - docker-compose up nginx -d
    - docker-compose run composer install
    - docker-compose run artisan migrate:fresh
    - docker-compose run artisan db:seed
