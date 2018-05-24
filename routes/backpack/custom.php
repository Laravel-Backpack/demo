<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::get('api/article', 'App\Http\Controllers\Api\ArticleController@index');
Route::get('api/article-search', 'App\Http\Controllers\Api\ArticleController@search');
Route::get('api/article/{id}', 'App\Http\Controllers\Api\ArticleController@show');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // CRUD resources and other admin routes
    CRUD::resource('monster', 'MonsterCrudController');
    CRUD::resource('icon', 'IconCrudController');
    CRUD::resource('product', 'ProductCrudController');
}); // this should be the absolute last line of this file
