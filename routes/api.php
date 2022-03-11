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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'Api\ProductController@index');
Route::get('/posts/random', 'Api\ProductController@inRandomOrder');
Route::get('/posts/{id}', 'Api\ProductController@show')->middleware('api.auth');

Route::post('/contacts', 'Api\ContactController@sendMessage')->middleware('api.auth');