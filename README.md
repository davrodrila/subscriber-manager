# Subscribers Manager
A simple app that provides a REST API to manage subscribers and associated fields made using Laravel for the API and Vue.js and Vue-Routes as a helper to make it a Single Page Application.

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
