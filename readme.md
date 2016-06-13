# Laravel Tracker

[![Latest Version](https://img.shields.io/packagist/v/mangopixel/laravel-tracker.svg?style=flat-square)](https://packagist.org/packages/mangopixel/laravel-tracker)
[![Build Status](https://img.shields.io/travis/mangopixel/laravel-tracker/master.svg?style=flat-square)](https://travis-ci.org/mangopixel/laravel-tracker)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](license.md)

A Laravel package for keeping track of your model changes.

## Installation

Install the package through Composer:

```shell
composer require mangopixel/laravel-tracker
```

After updating Composer, append the following service provider to the `providers` key in `app/config.php`:

```php
\Mangopixel\Tracker\TrackerServiceProvider::class
```

You may also publish the package configuration file and migrations using the following Artisan command:

```shell
php artisan vendor:publish --provider=\Mangopixel\Tracker\TrackerServiceProvider
```

The configuration file is well documented and you may edit it to suit your needs.

## Usage



## License

Laravel Adjuster is free software distributed under the terms of the MIT license.
