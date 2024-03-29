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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/','WelcomeController');
Route::resource('packages','PackageController');
Route::resource('gallery','GalleryController');

Route::get('/aboutus', 'Admin\AboutController@create');

/*Route::get('/gallery', function () {
    return view('gallery');
});*/

Route::get('/contactus', function () {
    return view('contact_us');
});

Route::resource('contact-us', 'ContactController');

Route::get('/terms-conditions', function () {
    return view('terms-conditions');
});

Route::post('newsletter/store','NewsletterController@store');

Route::resource('dashboard/groups','GroupController');
Route::resource('dashboard/conversations','ConversationController');
Route::resource('dashboard/group-chat','ChatController');

Auth::routes();

Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/dashboard/getData', 'HomeController@getNotificationData')->name('get-notification-data');
