## About Laravel

A simple API service application for articles.

## Examples

![1](https://github.com/mwgiorno/test-articles/assets/43139928/0e2c4ce4-e878-4619-85f0-f1991d83d69f)

![2](https://github.com/mwgiorno/test-articles/assets/43139928/a0dcb6b7-2f25-48c1-8476-2a76a22f7a37)

![3](https://github.com/mwgiorno/test-articles/assets/43139928/b78114d5-fb6e-4f50-8536-62bc690ffc02)

## Technologies
Created with:
* Laravel
* TailwindCSS
* VueJS
* MySQL/PostgreSQL
* NodeJS
* InertiaJS

## How To Run Locally

```bash
# Clone this repository
$ git clone https://github.com/mwgiorno/test-articles.git

# Go into the repository
$ cd test-articles

# Create and configure .env file
$ touch .env

# Build the service
$ docker compose build app

# Create and start the containers
$ docker compose up -d

# Start an interactive shell in the app container
$ docker compose exec app bash

# Install the php dependencies
$ composer install

# Generate the application key
$ php artisan key:generate

# Run migrations
$ php artisan migrate

# Create a symbolic link 
$ php artisan storage:link

# Run the bouncer seeder
$ php artisan db:seeder --class BouncerSeeder

# Run the db seeder
$ php artisan db:seeder --class DatabaseSeeder

# Create a superadmin 
$ php artisan user:create-superadmin name email password

# Start an interactive shell in the node container
$ docker compose exec node sh

# Install the php dependencies
$ npm install

# Run dev command
$ npm run dev
