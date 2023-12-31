<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About phGov Detector

User activity log manager. All kind of database activity will be 

### Run the following command to pull in the latest version:

```
composer require dolar/activitylog
```

### Lumen only

Register the provider in your boostrap app file bootstrap/app.php

Add the following line in the "Register Service Providers" section at the bottom of the file.

```
$app->register(\dolar\ActivityLog\LogtrackerServiceProvider::class);
```

For facades, uncomment ```$app->withFacades();``` in your boostrap app file ```bootstrap/app.php```

### After composer update run this command in your project

```
php artisan migrate
```

### Use this Trait in your model

```
use Logtrackerable
```

## License

The myGov Detector is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
