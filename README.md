#Analogue ORM - Laravel Authentication Driver

This is an out-of-the-box authentication driver for Laravel 4/5. It replaces the Eloquent Model with an Analogue Entity, while using the default database structure found in the default laravel install.

## Installation

Add this line to your composer.json file : 

Laravel 4.2 : 
```
"analogue/laravel-auth": "~4.0"
```

Laravel 5 : 
```
"analogue/laravel-auth": "~5.0"
```

Then run : 

```
composer update
```

## Configuration

Add the Service Provider to config/app.php :

```
'Analogue\LaravelAuth\AnalogueAuthServiceProvider',
```

Change the Authentication driver and User Model :

config/auth.php
```
'driver' => 'analogue',

...

'model' => 'Analogue\LaravelAuth\User',
```


