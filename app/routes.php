<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* There is no need to change
 * the delimeters from {{}} to <%%>
 * just to separate the realms of laravel from that of angular
 */
Blade::setContentTags('<%', '%>');          // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>'); // for escaped data


/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('user', '[0-9]+');

/** ------------------------------------------
 *  Index
 *  ------------------------------------------
 */
Route::get('/', array(
    'as' => 'home',
    'uses' => 'App\Controllers\HomeController@index'
));

/** ------------------------------------------
 *  API routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'api/v1', 'before' => 'xhr|xsrf'), function () {

    /* Session */
    Route::post('signin', array(
        'as' => 'sessions.store',
        'uses' => 'App\Controllers\SessionsController@store'
    ))->before('isSessionedIn');

    Route::get('isSessionedIn', array(
        'before' => 'isSessionedIn',
        function () {
        }
    ));

    Route::get('isLoggedIn', array(
        'before' => 'isLoggedIn',
        function () {
        }
    ));

    Route::get('hasAccess/{permission}', array(
        'before' => 'hasAccessSession',
        function () {
        }
    ));

    /* User */
    Route::post('users', array(
        'as' => 'users.register',
        'uses' => 'App\Controllers\UsersController@register'
    ))->before('isSessionedIn');

    Route::post('users/create', array(
        'as' => 'users.create',
        'uses' => 'App\Controllers\UsersController@create'
    ))->before('hasAccess:users');

    Route::post('users/forgot', array(
        'as' => 'users.forgot',
        'uses' => 'App\Controllers\UsersController@forgot'
    ));

    Route::get('users', array(
        'as' => 'users.index',
        'uses' => 'App\Controllers\UsersController@index'
    ))->before('hasAccess:users');

    Route::get('users/{user}', array(
        'as' => 'users.show',
        'uses' => 'App\Controllers\UsersController@show'
    ))->before('hasAccessAndIsOwner:users.show');

    Route::put('users/{user}', array(
        'as' => 'users.edit',
        'uses' => 'App\Controllers\UsersController@edit'
    ))->before('hasAccess:users');

    Route::put('users/{user}/account', array(
        'as' => 'users.account',
        'uses' => 'App\Controllers\UsersController@account'
    ))->before('hasAccessAndIsOwner:users.account');

    Route::put('users/{user}/password', array(
        'as' => 'users.password',
        'uses' => 'App\Controllers\UsersController@password'
    ))->before('hasAccessAndIsOwner:users.password');

    Route::put('users/{user}/suspend', array(
        'as' => 'users.suspend',
        'uses' => 'App\Controllers\UsersController@suspend'
    ))->before('hasAccess:users');

    Route::put('users/{user}/unsuspend', array(
        'as' => 'users.unsuspend',
        'uses' => 'App\Controllers\UsersController@unsuspend'
    ))->before('hasAccess:users');

    Route::put('users/{user}/ban', array(
        'as' => 'users.ban',
        'uses' => 'App\Controllers\UsersController@ban'
    ))->before('hasAccess:users');

    Route::delete('users/{user}', array(
        'as' => 'users.destroy',
        'uses' => 'App\Controllers\UsersController@destroy'
    ))->before('hasAccess:users');

    /* Group */
    Route::get('groups', array(
        'as' => 'groups.index',
        'uses' => 'App\Controllers\GroupsController@index'
    ))->before('hasAccess:users');

    /* Menu */
    Route::get('users/menus', array(
        'as' => 'menus',
        'uses' => 'App\Controllers\MenusController@index'
    ));

});

Route::get('users/{user}/activate/{code}', array(
    'as' => 'users.activate',
    'uses' => 'App\Controllers\UsersController@activate'
));

Route::get('users/{user}/reset/{code}', array(
    'as' => 'users.reset',
    'uses' => 'App\Controllers\UsersController@reset'
));

Route::get('users/newpassword', array(
    'as' => 'users.newpassword',
    function () {
        return View::make('users.newpassword');
    }
));

/* Session */
Route::get('logout', array(
    'as' => 'sessions.destroy',
    'uses' => 'App\Controllers\SessionsController@destroy'
));
