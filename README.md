# Sales Manager

Application for managing sales operations.

## Deployment Server

The application is hosted on Heroku. It can be accessed using the following link. Make sure it is being acessed using HTTPS protocol.

``https://sales-manager-guilherme.herokuapp.com``

## Documentation

Database documentation can be found in *docs/database* folder.

## Requirements

* PHP 7.3 or newer.

## Installation

Start by cloning this repository. 

``` git clone https://github.com/Guilherme-Ferreti/sales-manager.git```

After that, install project dependencies by running the following command in your application's root folder:

```composer install```

Copy .env.example to create your own .env file.

```cp .env.example .env```

Configure database connection and run the migrations and seeder.

```php artisan migrate --seed```

Generate the application encryption key:

```php artisan key:generate```

Finally, serve the application:

```php artisan serve```