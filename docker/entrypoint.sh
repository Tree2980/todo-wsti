#!/bin/bash

npm install -g semver
npm install -g n
n 16.13.0
npm install
npm run prod


composer install --no-interaction --no-progress

php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

composer dump-autoload -o

cd public && ln -sf ../storage/app/public/ storage

chown -R www-data:www-data /var/www/html

#php artisan serve --port=$PORT --host=0.0.0.0

exec docker-php-entrypoint apache2-foreground