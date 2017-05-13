# shakahl/laravel-eloquent-mysqli
MySQLi driver (connector) for Laravel **5.4** Eloquent database

## Installation

- Install via composer

```sh
composer require shakahl/laravel-eloquent-mysqli
```

- After installing, add provider on config/app.php on your project.

```php
// app.php

    'providers' => [
        ...

        'LaravelEloquentMySQLi\MySQLiServiceProvider',
    ],
```

## Usage

You should configure your database connection to use the ```mysqli``` driver.

**Example**
```php
//...
  'connections' => [
        'mysql' => [
            'driver'    => 'mysqli', // Sets mysqli driver
            'host'      => env('DB_HOST', 'localhost'),
            'port'      => env('DB_PORT', 3306),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => env('DB_PREFIX', ''),
            'timezone'  => env('DB_TIMEZONE', '+00:00'),
            'strict'    => env('DB_STRICT_MODE', false),
        ],
    ]
//...
```

## Notes

### Accessing underlying mysqli instance
There are some inconsistent methods since Laravel only supports PDO officially.
You can access the raw, underlying MySQLi instance using the following methods on a connection instance:

```php
$mysqli = DB::connection()->getMySqli();
// or
$mysqli = DB::connection()->getReadMySqli();
// or
$mysqli = DB::connection()->getPdo();
// or
$mysqli = DB::connection()->getReadPdo();
```

### Escaping

Unfortunately PHP's mysqli driver does not support named parameter binding so this connector uses custom implementation for it.

