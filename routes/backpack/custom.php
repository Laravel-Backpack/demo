<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::get('api/article', 'App\Http\Controllers\Api\ArticleController@index');
Route::get('api/article-search', 'App\Http\Controllers\Api\ArticleController@search');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // ----------------
    // Monsters & Stuff
    // ----------------
    Route::crud('monster', 'MonsterCrudController');
    Route::crud('hero', 'HeroCrudController');
    Route::crud('story', 'StoryCrudController');
    Route::crud('cave', 'CaveCrudController');

    // ----------------
    // Other entities
    // ----------------
    Route::crud('fluent-monster', 'FluentMonsterCrudController');
    Route::crud('icon', 'IconCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('dummy', 'DummyCrudController');

    // ------------------
    // AJAX Chart Widgets
    // ------------------
    Route::get('charts/users', 'Charts\LatestUsersChartController@response');
    Route::get('charts/new-entries', 'Charts\NewEntriesChartController@response');

    // ---------------------------
    // Backpack DEMO Custom Routes
    // Prevent people from doing nasty stuff in the online demo
    // ---------------------------
    if (app('env') == 'production') {
        // disable delete and bulk delete for all CRUDs
        $cruds = ['article', 'category', 'tag', 'monster', 'icon', 'product', 'page', 'menu-item', 'user', 'role', 'permission', 'hero', 'story', 'cave', 'owner', 'invoice', 'pet', 'passport', 'skill', 'comment', 'badge'];
        foreach ($cruds as $name) {
            Route::delete($name.'/{id}', function () {
                return false;
            });
            Route::post($name.'/bulk-delete', function () {
                return false;
            });
        }
    }
    Route::group([
        'prefix'    => 'pet-shop',
        'namespace' => 'PetShop',
    ], function () {
        Route::get('about', function () {
            return view('admin.petshop_about');
        });
        Route::crud('owner', 'OwnerCrudController');
        Route::crud('invoice', 'InvoiceCrudController');
        Route::crud('pet', 'PetCrudController');
        Route::crud('passport', 'PassportCrudController');
        Route::crud('skill', 'SkillCrudController');
        Route::crud('comment', 'CommentCrudController');
        Route::crud('badge', 'BadgeCrudController');
    });
}); // this should be the absolute last line of this file
