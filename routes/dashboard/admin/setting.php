<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Admin\Settings\GeneralController;
use App\Http\Controllers\Dashboard\Admin\Settings\WebsitController;
use App\Http\Controllers\Dashboard\Admin\Settings\MetaController;
use App\Http\Controllers\Dashboard\Admin\Settings\ContactController;
use App\Http\Controllers\Dashboard\Admin\Settings\MediaController;
use App\Http\Controllers\Dashboard\Admin\Settings\MenuController;
use App\Http\Controllers\Dashboard\Admin\Settings\PageController;
use App\Http\Controllers\Dashboard\Admin\Settings\LinkController;
use App\Http\Controllers\Dashboard\Admin\Settings\TitleController;
use App\Http\Controllers\Dashboard\Admin\Settings\TitlePageController;
use App\Http\Controllers\Dashboard\Admin\Settings\PartnerController;
use App\Http\Controllers\Dashboard\Admin\Settings\VideoController;
use App\Http\Controllers\Dashboard\Admin\Settings\CategoryBannerController;
use App\Http\Controllers\Dashboard\Admin\Settings\VisionController;

//general settings
Route::controller(GeneralController::class)
    ->prefix('general')->name('general.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');

});

//website menus
Route::controller(MenuController::class)
    ->prefix('menus')->name('menus.')
    ->group(function () {

        Route::get('data', 'data')->name('data');
        Route::post('status', 'status')->name('status');
        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
        Route::post('store', 'storeSortable')->name('sortable.store');

         Route::prefix('sortable')->name('sortable.')->group(function () {

            Route::get('/', 'sortablePage')->name('index');
            Route::post('/store', 'storeSortable')->name('store');

        });

    });
Route::resource('menus', MenuController::class)->except('show');

//website pages
//Route::controller(PageController::class)
//    ->prefix('pages')->name('pages.')
//    ->group(function () {

//        Route::get('data', 'data')->name('data');
//        Route::post('status', 'status')->name('status');
//        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
//        Route::post('/store', 'storeSortable')->name('sortable.store');

//    });
//Route::resource('pages', PageController::class)->except('show');

////website links
//Route::controller(LinkController::class)
//    ->prefix('links')->name('links.')
//    ->group(function () {

//        Route::get('data', 'data')->name('data');
//        Route::post('status', 'status')->name('status');
//        Route::delete('bulk_delete', 'bulkDelete')->name('bulk_delete');
//        Route::post('/store', 'storeSortable')->name('sortable.store');

//    });
//Route::resource('links', LinkController::class)->except('show');


////settings meta
//Route::controller(MetaController::class)
//    ->prefix('meta')->name('meta.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings websit
//Route::controller(WebsitController::class)
//    ->prefix('websit')->name('websit.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings contact
//Route::controller(ContactController::class)
//    ->prefix('contact')->name('contact.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings media
//Route::controller(MediaController::class)
//    ->prefix('media')->name('media.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings titles
//Route::controller(TitleController::class)
//    ->prefix('titles')->name('titles.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings titles_pages
//Route::controller(TitlePageController::class)
//    ->prefix('titles_pages')->name('titles_pages.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings partners
//Route::controller(PartnerController::class)
//    ->prefix('partner')->name('partner.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings videos
//Route::controller(VideoController::class)
//    ->prefix('videos')->name('videos.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('upload-large', 'uploadLarge')->name('uploadLarge');

//});

////settings category banner
//Route::controller(CategoryBannerController::class)
//    ->prefix('category_banner')->name('category_banner.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});

////settings Vision
//Route::controller(VisionController::class)
//    ->prefix('visions')->name('visions.')->group(function () {

//    Route::get('/', 'index')->name('index');
//    Route::post('store', 'store')->name('store');

//});