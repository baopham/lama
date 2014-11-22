<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request)
{
    //
});

App::after(function ($request, $response)
{
    // To protect against json injection
    if ($response instanceof \Illuminate\Http\JsonResponse) {
        $json = ")]}',\n" . $response->getContent();
        return $response->setContent($json);
    }
});

/** ------------------------------------------
 *  Check if a user is just logged in
 *  ------------------------------------------
 */
Route::filter('isSessionedIn', function () {
    if (Sentry::check()) {
        return Response::make('Forbidden', 403);
    }
});

/** ------------------------------------------
 *  Check if a user is logged in
 *  ------------------------------------------
 */
Route::filter('isLoggedIn', function () {
    if (!Sentry::check()) {
        return Response::make('Unauthorized', 401);
    }
});

/** ------------------------------------------
 *  Check if a user is the same of the current id
 *  ------------------------------------------
 */
Route::filter('hasAccessAndIsOwner', function ($route, $request, $value) {
    $check = Sentry::check();
    if (!$check) {
        return Response::make('Unauthorized', 401);
    }
    if ($check) {
        $user = Sentry::getUser();
        if (!$user->hasAccess($value)) {
            return Response::make('Unauthorized', 403);
        }

        $admin = Sentry::findGroupByName('Admins');
        if (!$user->inGroup($admin)) {
            $id = $route->getParameter('user');
            if ((string) $id !== (string) $user->id) {
                return Response::make('Unauthorized', 403);
            }
        }
    }
});

/** ------------------------------------------
 *  Check if a user has access
 *  ------------------------------------------
 */
Route::filter('hasAccess', function ($route, $request, $permission) {
    $check = Sentry::check();
    if (!$check) {
        return Response::make('Unauthorized', 401);
    }
    if ($check) {
        $user = Sentry::getUser();
        if (!$user->hasAccess($permission)) {
            return Response::make('Unauthorized', 403);
        }
    }
});

/** ------------------------------------------
 *  Check if a user session has access
 *  ------------------------------------------
 */
Route::filter('hasAccessSession', function ($route) {
    $check = Sentry::check();
    if (!$check) {
        return Response::make('Unauthorized', 401);
    }
    if ($check) {
        $user = Sentry::getUser();
        $permission = $route->getParameter('permission');
        if (!$user->hasAccess($permission)) {
            return Response::make('Unauthorized', 403);
        }
    }
});

/** ------------------------------------------
 *  Check if it is an ajax request
 *  ------------------------------------------
 */
Route::filter('xhr', function () {
    if (!Request::ajax()) {
        return Response::make('Not Found', 404);
    }

});

/** ------------------------------------------
 *  XSRF check
 *  ------------------------------------------
 */
Route::filter('xsrf', function () {
    if ((!isset($_COOKIE['XSRF-TOKEN']) || is_null(Request::header('X-XSRF-TOKEN'))) || ($_COOKIE['XSRF-TOKEN'] !== Request::header('X-XSRF-TOKEN'))) {
        return Response::make('Not Found', 404);
    }
});