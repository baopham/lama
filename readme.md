# LAMB Stack
LAMB is a boilerplate that provides a nice starting point for Laravel and AngularJS based applications.

## Credits
[Using Laravel 4 with Sentry 2](https://github.com/rydurham/L4withSentry)

### Tools Prerequisites
* Composer - Dependency Manager for PHP, installing [Composer](https://getcomposer.org/)
* Bower - Web package manager, installing [Bower](http://bower.io/)

## Quick Install
    git clone https://github.com/whisher/lamb.git
    cd lamb
    php composer.phar install
    chmod -R 0777 app/storage
    bower install
    configuring your database app/config/database.php
    php artisan migrate --package=cartalyst/sentry
    php artisan migrate
    php artisan db:seed