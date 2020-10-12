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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries', function () {
	$countries= Countries::all()->pluck('currencies','flag.svg')->toArray();
echo "<hr /><h1>DEBUG</h1><pre>";
print_r($countries);
echo "</pre>";
die();
;
    
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
