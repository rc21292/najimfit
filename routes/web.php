<?php

use Illuminate\Support\Facades\Route;
use PragmaRX\Countries\Package\Countries;
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


Route::get(
    'cache-clear',
    function () {
        \Artisan::call('cache:clear');
	\Artisan::call('view:clear');
	\Artisan::call('route:clear');
	\Artisan::call('clear-compiled');
	\Artisan::call('config:cache');

        return 'cleared';
    }
);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', function () {
    return view('packages');
});

Route::get('/contact-us', function () {
    return view('contact_us');
});




Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
