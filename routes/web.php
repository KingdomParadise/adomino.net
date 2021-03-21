<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
], function()
{
    Route::get('/', 'HomeController')->name('home');

    Route::get('/domain/{hash}', 'LandingpageController@domain')->name('landingpage.domain');
    Route::post('/send-inquiry', 'LandingpageController@send')->name('landingpage.send');

    Route::get('/impressum', 'StaticController@imprint')->name('static.imprint');
    Route::get('/datenschutz', 'StaticController@dataPrivacy')->name('static.dataprivacy');
    Route::get('/bildnachweise', 'StaticController@imageLicences')->name('static.imagelicences');
});
