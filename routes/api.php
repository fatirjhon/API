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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('tasks','TaskController@index');

Route::get('task/{id}','TaskController@show');

Route::delete('task/{id}','TaskController@destroy');

Route::put('task','TaskController@store');

Route::post('task','TaskController@store');

Route::post('login', 'AuthenticateController@login');

Route::post('register', 'AuthenticateController@register');

Route::group(['prefix' => 'coba', 'middleware' => ['jwt.auth']], function(){
	Route::resource('user', 'UserController');
});

// Route::resource('tasks', 'TaskController');