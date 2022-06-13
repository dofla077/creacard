## About Test

The application test is config by laravel Sail.
You may have Docker install in you local machine to run this application

## Composer

After clone project run `composer install` to install all dependency.

## Sail

[sail  documentation
](https://laravel.com/docs/9.x/sail)

When you finish to install all dependencies (and have setup docker on your local machine)
you can run `./vendor/bin/sail up -d` to run the project with sail.

If it's success you need to run migration on docker container.
For enter in docker container run `./vendor/bin/sail shell`

After that run `php artisan migrate --seed`

## Login
login: dupuis@gmail.com
password: password

you can register new login

## Mail

To send a quotation you must add a customer at this one.

You can access mail on [http://localhost:8025](http://localhost:8025) or change mail config on **.env**
