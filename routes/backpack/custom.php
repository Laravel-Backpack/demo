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
    Route::crud('monster', 'MonsterCrudController');
    Route::crud('icon', 'IconCrudController');
    Route::crud('product', 'ProductCrudController');

    // ---------------------------
    // Backpack DEMO Custom Routes
    // Prevent people from doing nasty stuff in the online demo
    // ---------------------------

    // disable delete and bulk delete for all CRUDs
    $cruds = ['article', 'category', 'tag', 'monster', 'icon', 'product', 'page', 'menu-item', 'user', 'role', 'permission'];
    foreach ($cruds as $name) {
        Route::delete($name.'/{id}', function () {
            return false;
        });
        Route::post($name.'/bulk-delete', function () {
            return false;
        });
    }

    // TODO: disable updating users
    // Route::put('user/{id}', function() { return false; });

    // TODO: disable uploading files
    // TODO: disable creating backups
    // TODO: login screen should have user and password pre-filled

    // TODO: disable file manager screen
    Route::any('elfinder/connector', function () {
        return 'Disabled';
    });

    // disable file manager in field types
    Route::any('elfinder/popup/browse', function () {
        return '<div style="position: relative; padding: 0.75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: 0.25rem; background-color: #ffc107; border-color: #ebb206; color: #fffdf5;">Sorry, the file manager is disabled in the online demo.</div>';
    });
}); // this should be the absolute last line of this file
