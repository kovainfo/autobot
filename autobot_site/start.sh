#!/bin/bash

php artisan migrate
php artisan key:generate
php artisan db:seed
php artisan serve