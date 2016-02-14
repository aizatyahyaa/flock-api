<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['prefix' => 'api', 'middleware' => ['api', 'cors'], 'namespace' => 'Api'], function () {

    Route::get('test', function () {
        echo 'test';
    });
    /*AuthController*/
    Route::post('login/post', 'AuthController@login');

    /*RegisterController*/
    Route::post('register/post', 'RegisterController@register');

    Route::group(['middleware' => 'jwt.auth'], function () {

        Route::resource('user', 'UserController');
        Route::get('current/user', 'UserController@currentUser');
        Route::resource('place', 'PlaceController');

        Route::get('logout', 'AuthController@logout');

    });
});
