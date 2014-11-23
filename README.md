# LAMA Stack
LAMA is a boilerplate that provides a nice starting point for Laravel/Sentry and AngularJS based applications.

## Credits
* [L4withSentry](https://github.com/rydurham/L4withSentry)
* [MEAN fullstack javascript framework](http://mean.io)

## Features
* Handy assetsmanager don't need to add your assets (css,js) in the main template and in the gruntfile
* JSON Vulnerability Protection
* Cross Site Request Forgery (XSRF) Protection
* Run with grunt (php artisan serve)

## Tools Prerequisites
* Composer - Dependency Manager for PHP, installing [Composer](https://getcomposer.org/)
* Node.js platform, installing [Node.js](http://www.nodejs.org/download/)
* Grunt - The JavaScript Task Runner, installing [Grunt](http://gruntjs.com/)
* Bower - Web package manager, installing [Bower](http://bower.io/)
* Karma - A test runner for angularjs, installing [Karma](http://karma-runner.github.io/0.12/index.html/)  
* Protractor - Protractor is an end-to-end test framework, installing [Protractor](http://angular.github.io/protractor/#/tutorial) 

## Quick Install
    git clone https://github.com/whisher/lama.git
    cd lama
    php composer.phar install
    chmod -R 0777 app/storage

Configure your environment by adding your machine name (run `hostname`) in `bootstrap/start.php`:
```php
$env = $app->detectEnvironment(array(

    'local' => array('*.local'),

));
```

Then copy `app/config/app.php`, `app/config/database.php`, `app/config/mail.php`, `app/config/lama.php` to your local config directory: `app/config/local` (you will have to create the local folder) and configure the settings.
`app/config/local/app.php` will probably look like this, as the rest of the configuration can be left to their defaults:

```php
<?php

return array(

    'url' => 'http://myproject.local',

    'timezone' => 'UTC',

    'key' => 'secretkey',

    'providers' => append_config( array(

            /* Uncomment for use in development */
            //'Way\Generators\GeneratorsServiceProvider', // Generators

        )
    ),

);
```
Then run:

    php artisan migrate --package=cartalyst/sentry
    php artisan migrate
    php artisan db:seed
    php artisan key:generate
    npm install
    bower install

## Grunt
    grunt (run the app at http://localhost:8000)
    grunt prod (build css and js)
    grunt unit (unit test) 
    grunt e2e (end to end test)

