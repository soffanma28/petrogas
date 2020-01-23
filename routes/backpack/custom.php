<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('item_category', 'Item_categoryCrudController');
    Route::crud('item', 'ItemCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('item_request', 'Item_requestCrudController');
    Route::crud('employee', 'EmployeeCrudController');
}); // this should be the absolute last line of this file