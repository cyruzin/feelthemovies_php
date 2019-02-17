# Feel the Movies

 This is the old back-end version of Feel the Movies. Written in PHP with Lumen framework.
 
 ### Install
 
First set up your environment, you can check the Lumen server requirements [here](https://lumen.laravel.com/docs/5.7#server-requirements).

Then, inside the project folder run:
 
 ```sh
composer install
```

### Run

Create a database called "api_feelthemovies" on your MySQL and run migrations:

```php
php artisan migrate
```

Once the database is ready. Start the server:

```php
php -S localhost:8000 -t public
```
