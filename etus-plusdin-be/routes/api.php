<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'public'

], function ($router) {
    Route::get('all', 'CardController@all');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([

    'middleware' => ['api','jwt.verify'],
    'prefix' => 'card'

], function ($router) {

    Route::post('create', 'CardController@update');
    Route::post('update', 'CardController@update');
    Route::post('delete', 'CardController@delete');
    Route::get('findall', 'CardController@findall');
    Route::get('findone', 'CardController@findone');

});

Route::group([

    'middleware' => ['api','jwt.verify'],
    'prefix' => 'brand'

], function ($router) {
    Route::get('findall', 'BrandController@findall');
});

Route::group([

    'middleware' => ['api','jwt.verify'],
    'prefix' => 'category'

], function ($router) {
    Route::get('findall', 'CategoryController@findall');
});