# Subscribers Manager
A simple app that provides a REST API to manage subscribers and associated fields. The goal of this small app is to teach myself Laravel using TDD aswell as getting started with Vue.JS on the front. I took the chance of learning how to make SPA's as I never had done anything like it, for that I used Vue-Routes.

# Instructions
Clonate the git repository and run 
```
composer install
```
To install all the dependencies for laravel.

An .env file is provided for convenience, so no further configuration is needed. The app uses a sqlite database so its easier to run on a local environment.
To make it work, first populate the database. It's required to use the seeds because they are automatically populating the State and Type tables. 
```
php artisan migrate:fresh --seed
```

Once the database is populated, simply run
```
php artisan serve
```

And type the url provided on the console.

# Testing
Tests for the REST API have been written, they can be run using phpunit. To run the tests on Linux:
```
.\vendor\bin\phpunit
```
On Windows:
```
.\vendor\bin\phpunit.bat
```
