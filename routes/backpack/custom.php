<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Prologue\Alerts\Facades\Alert;

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
    // ------------
    // Custom Pages
    // ------------
    Route::get('new-in-v7', 'AdminPageController@newInV7')->name('new-in-v7');

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
    Route::crud('column-monster', 'ColumnMonsterCrudController');
    Route::crud('fluent-monster', 'FluentMonsterCrudController');
    Route::crud('field-monster', 'FieldMonsterCrudController');
    Route::crud('editable-monster', 'EditableMonsterCrudController');
    Route::crud('icon', 'IconCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('dummy', 'DummyCrudController');
    Route::crud('meeting', 'MeetingCrudController');

    // Allow demo users to switch between available themes and layouts
    Route::post('switch-layout', function (Request $request) {
        $theme = 'backpack.theme-'.$request->get('theme', 'tabler').'::';

        // if the theme has changed, let's show a success message
        if (Session::get('backpack.ui.view_namespace') !== $theme) {
            Alert::success('Now using theme: '.$request->get('theme', 'tabler'))->flash();
        }

        Session::put('backpack.ui.view_namespace', $theme);

        if ($theme === 'backpack.theme-tabler::') {
            // if the layout has changed, let's show a success message
            if (Session::get('backpack.theme-tabler.layout') !== $request->get('layout', 'horizontal')) {
                Alert::success('Now using layout: '.$request->get('layout', 'horizontal'))->flash();
            }

            Session::put('backpack.theme-tabler.layout', $request->get('layout', 'horizontal'));
        }

        return Redirect::back();
    })->name('tabler.switch.layout');

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
}); // this should be the absolute last line of this file
