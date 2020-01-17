<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('api/user', 'App\Http\Controllers\Api\UserController@index');
// Route::get('api/user/{id}', 'App\Http\Controllers\Api\UserController@show');

Route::get('admin/item_request/create', 'Admin\ItemRequestController@index');
Route::get('admin/item_request/create/dept', 'Admin\ItemRequestController@dept');

