<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::post('api/article', 'App\Http\Controllers\Api\ArticleController@index');
Route::post('api/article-search', 'App\Http\Controllers\Api\ArticleController@search');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    // --------
    // Features
    // --------
    // One page per Backpack feature we want to show on its own.
    Route::get('features/components', 'FeaturesController@components')->name('features.components');
    Route::get('features/widgets', 'FeaturesController@widgets')->name('features.widgets');
    Route::get('features/themes', 'FeaturesController@themes')->name('features.themes');
    Route::get('features/skins', 'FeaturesController@skins')->name('features.skins');
    Route::get('features/design', 'FeaturesController@design')->name('features.design');
    Route::get('features/alerts', 'FeaturesController@alerts')->name('features.alerts');
    Route::post('features/alerts', 'FeaturesController@triggerAlert')->name('features.alerts.trigger');
    Route::get('new-in-v7', 'FeaturesController@newInV7')->name('new-in-v7'); // old URL, redirects to Components

    // -----------
    // Paid Add-ons
    // -----------
    // One page per paid add-on (content in config/demo.php).
    Route::get('paid/{addon}', 'PaidAddonsController@show')->name('paid.show');

    // ------------------
    // AJAX Chart Widgets
    // ------------------
    Route::get('charts/revenue', 'Charts\RevenueChartController@response');
    Route::get('charts/users', 'Charts\LatestUsersChartController@response');
    Route::get('charts/new-entries', 'Charts\NewEntriesChartController@response');

    // ---------------------------
    // Examples: Crazy Stuff
    // ---------------------------
    // Every field, column, filter, button and operation, in one place.
    Route::crud('monster', 'MonsterCrudController');
    Route::crud('hero', 'HeroCrudController');
    Route::crud('story', 'StoryCrudController');
    Route::crud('cave', 'CaveCrudController');
    Route::crud('column-monster', 'ColumnMonsterCrudController');
    Route::crud('fluent-monster', 'FluentMonsterCrudController');
    Route::crud('field-monster', 'FieldMonsterCrudController');
    Route::crud('editable-monster', 'EditableMonsterCrudController');
    Route::crud('icon', 'IconCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('dummy', 'DummyCrudController');
    Route::crud('meeting', 'MeetingCrudController');

    // ---------------------------
    // Examples: Pet Shop
    // ---------------------------
    // A small but realistic app: owners, pets, invoices.
    Route::group([
        'prefix'    => 'pet-shop',
        'namespace' => 'PetShop',
    ], function () {
        Route::get('about', function () {
            return view('admin.petshop_about');
        });
        Route::crud('invoice', 'InvoiceCrudController');
        Route::crud('pet', 'PetCrudController');
        Route::crud('passport', 'PassportCrudController');
        Route::crud('skill', 'SkillCrudController');
        Route::crud('comment', 'CommentCrudController');
        Route::crud('badge', 'BadgeCrudController');
        Route::crud('owner', 'OwnerCrudController');
        // nested crud panel for owner pets
        Route::group(['prefix' => 'owner/{owner}'], function () {
            Route::crud('pets', 'OwnerPetsCrudController');
        });
    });

    // ---------------------------
    // Online demo safety net
    // ---------------------------
    // Prevent people from doing nasty stuff in the online demo:
    // no deletes, no bulk deletes.
    if (app('env') == 'production') {
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
}); // this should be the absolute last line of this file
