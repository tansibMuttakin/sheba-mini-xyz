#!/bin/bash

# Wait until MySQL is ready
until nc -z -v -w30 $DB_HOST 3306
do
  echo "Waiting for MySQL..."
  sleep 5
done

# Run Laravel migrations
php artisan migrate --force --seed

# Start PHP-FPM
exec php-fpm