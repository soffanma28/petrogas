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
    return redirect()->route('backpack.dashboard');
});

// Route::get('api/user', 'App\Http\Controllers\Api\UserController@index');
// Route::get('api/user/{id}', 'App\Http\Controllers\Api\UserController@show');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => 'admin',
], function () { // custom admin routes

	Route::prefix('item_request')->group(function(){

		// Route::get('/', 'Admin\ItemRequestController@index')->name('item_request.index');
		Route::get('create', 'Admin\ItemRequestController@create')->name('item_request.create');
		Route::get('create/dept', 'Admin\ItemRequestController@dept');
		Route::post('store', 'Admin\ItemRequestController@store')->name('item_request.store');
		Route::post('{id}/draft', 'Admin\ItemRequestController@draft')->name('item_request.draft');
		Route::post('{id}/send', 'Admin\ItemRequestController@send')->name('item_request.send');
		Route::get('{id}/approve', 'Admin\ItemRequestController@approve')->name('item_request.approve');
		Route::get('{id}/edit', 'Admin\ItemRequestController@edit')->name('item_request.edit');
		Route::post('{id}/update', 'Admin\ItemRequestController@update')->name('item_request.update');
		
		// Route::post('storeitem', 'Admin\ItemRequestController@storeitem')->name('item_list.store');
	});

	Route::prefix('adminrequest')->group(function(){
		Route::get('{id}/request', 'Admin\ItemRequestController@request')->name('adminrequest.request');
		Route::post('{id}/adminrequest', 'Admin\ItemRequestController@adminrequest')->name('adminrequest.adminrequest');
		Route::get('{id}/approve', 'Admin\ItemRequestController@request')->name('adminrequest.approve');
		Route::post('{id}/update', 'Admin\ItemRequestController@adminupdate')->name('adminrequest.update');
		Route::get('{id}/process', 'Admin\ItemRequestController@process')->name('item_request.process');
		Route::post('{id}/processed', 'Admin\ItemRequestController@processed')->name('item_request.processed');
		Route::post('{id}/complete', 'Admin\ItemRequestController@complete')->name('item_request.complete');
	});

}); // this should be the absolute last line of this file


