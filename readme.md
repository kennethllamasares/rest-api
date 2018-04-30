# REST API

A simple REST API sample using Laravel Framework and Vue

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installing

Clone this repo

```
git clone https://github.com/kennethllamasares/rest-api.git rest-api
```

```
cd rest-api
```

Run composer install

```
composer install
```
Rename .env.example to .env then setup your database configuration

```
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Migrate database

```
php artisan migrate
```

Setup development server

```
php artisan serve
```

Now you can point your browser to http://localhost:8000 and see the application.

Press Ctrl-C to stop the server.