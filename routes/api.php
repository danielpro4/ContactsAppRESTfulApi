<?php

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function($request) {

    $request->post('details', 'API\UserController@details');

    $request->get('contacts', 'ContactController@index');

    $request->post('contacts', 'ContactController@store');

    $request->get('contacts/{query?}', 'ContactController@search')->where('query', '[A-Za-z]+');
});
