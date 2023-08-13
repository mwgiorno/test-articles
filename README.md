## About Laravel

A simple API service application for articles.

## Examples



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
