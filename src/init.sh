#!/bin/bash

echo "Install packages..."
composer install

echo "Execute database migrations ..."
php artisan migrate

echo "Execute database seeding ..."
php artisan db:seed

echo "Configuration completed"
