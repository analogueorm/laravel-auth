#Analogue ORM - Laravel Authentication Driver

This is an out-of-the-box authentication driver for Laravel 5. It replaces the Eloquent Model with an Analogue Entity, while using the default database structure found in the default laravel install.

## Installation

Laravel 5 : 
```
composer require "analogue/laravel-auth": "~5.2"
```

## Configuration

Add this line to the Service Providers in `config/app.php` :

```
Analogue\LaravelAuth\AnalogueAuthServiceProvider::class,
```

Then, in `auth.php`

Change the `users` provider driver and model :

config/auth.php
```

'providers' => [
    'users' => [
            'driver' => 'analogue',
            'model' => Analogue\LaravelAuth\User::class,
        ],

...



