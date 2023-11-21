#!/bin/bash

trap "exit" INT

if ! [ -f ".env" ]; then
  echo ".env file not found, copying from .env.example"
  cp ".env.example" ".env"
else
  echo ".env file already exists"
fi

if ! [ -x "$(command -v docker)" ]; then
  echo "Install docker first!"
  exit
else
  echo "Docker found"
fi

echo 'Initializing project using docker...'
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

echo "Executing Laravel Sail..."
vendor/bin/sail up -d

echo "Waiting 10 seconds for mysql..."
sleep 10
echo "Generating app key"
vendor/bin/sail artisan key:generate
echo "Migrating database"
vendor/bin/sail artisan migrate
echo "Seeding database"
vendor/bin/sail artisan db:seed

echo "Installing NPM dependencies"
vendor/bin/sail npm install
echo "Compiling frontend resources"
vendor/bin/sail npm run dev
