<?php

/*
|--------------------------------------------------------------------------
| Backpack\NewsCRUD Routes
|--------------------------------------------------------------------------
|
| This file is where you may define or change all of the routes that are
| handled by the Backpack\NewsCRUD package.
|
*/

Route::group([
				'namespace' => 'Backpack\NewsCRUD\app\Http\Controllers\Admin',
				'prefix' => config('backpack.base.route_prefix', 'admin'),
				'middleware' => ['web', 'admin'],
			], function () {
    CRUD::resource('article', 'ArticleCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('tag', 'TagCrudController');
});