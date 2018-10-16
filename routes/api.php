<?php

use Illuminate\Http\Request;

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

// for jwt authentication
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login')->name('api.login');
Route::post('recover', 'AuthController@recover');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout')->name('api.logout');
    Route::get('get-all-url', 'UrlDetailController@getAllUrl')->name('api.get-all-url');
    Route::post('add-expiration-time-to-url', 'UrlDetailController@addExpirationTimeToUrl')->name('api.add-expiration-time-to-url');
});
