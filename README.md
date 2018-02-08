# Analogue ORM - Laravel Authentication Driver
[![Build Status](https://travis-ci.org/analogueorm/laravel-auth.svg?branch=5.6)](https://travis-ci.org/analogueorm/laravel-auth.svg?branch=5.6)
[![Latest Version](https://img.shields.io/github/release/analogueorm/laravel-auth.svg?style=flat-square)](https://github.com/analogueorm/laravel-auth/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

This package is an out-of-the-box [Analogue](https://github.com/analogueorm/analogue) authentication driver for Laravel 5. It replaces the Eloquent Model with an Analogue Entity, while using the default database structure found in the default laravel install.

## Installation

```

    composer require "analogue/laravel-auth"

```

## Configuration

Add this line to the Service Providers in `config/app.php` :

```
Analogue\LaravelAuth\AnalogueAuthServiceProvider::class,
```

Then, in `auth.php`

Add a `analogue` provider right after the `users` provider. Of course, you can change the model to your own domain class.

config/auth.php : 

```

    'providers' => [
        'analogue' => [
                'driver' => 'analogue',
                'model' => Analogue\LaravelAuth\User::class,
            ],


```

Then, change the providers used to authenticate in the `guards` section : 

```

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'analogue',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
        ],
      
    ],

```

## Licence

MIT

