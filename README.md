# Sales Manager

Application for managing sales operations.

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