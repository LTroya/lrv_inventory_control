<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});

/**
 * Auth Routes ...
 */
Route::get('/login', 'AuthController@getLogin');

Route::post('/auth/login', [
    'as' => 'auth.login',
    'uses' => 'AuthController@postLogin'
]);
Route::post('/auth/logout', [
    'as' => 'auth.logout',
    'uses' =>'AuthController@Logout'
]);

/**
 * Product Routes...
 */
Route::get('/products', [
    'middleware' => 'auth',
    'uses' => 'ProductController@index'
]);
Route::get('/products/import', [
    'middleware' => 'auth',
    'uses' => 'ProductController@import'
]);

Route::get('product/check', 'ProductController@getCheck');

Route::post('/products/import', [
    'middleware' => 'auth',
    'as' => 'products.import',
    'uses' => 'ProductController@importSheets'
]);

Route::post('/product', [
    'middleware' => 'auth',
    'uses' => 'ProductController@store'
]);

Route::post('/product/check', [
    'as' => 'products.check',
    'uses' => 'ProductController@check'
]);


Route::delete('/product/{product}', [
    'middleware' => 'auth',
    'uses' => 'ProductController@destroy'
]);

/**
 * Manual Migrations execution commands...
 */
Route::get('migrate', function () {

    echo '<br>init with Migrate tables ...';
    Artisan::call('migrate', ['--quiet' => true, '--force' => true]);
    echo '<br>done with Migrate tables';
    echo '<br>init with seed tables ...';
    Artisan::call('db:seed', ['--quiet' => true, '--force' => true]);
    echo '<br>done with seed tables';
});


