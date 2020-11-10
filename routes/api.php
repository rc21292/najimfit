<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
	Route::get('/user', 'Api\AuthController@getuserdetails');
	Route::get('/subscriptions', 'Api\SubscriptionController@subscriptions');
	Route::get('/user-body-profile', 'Api\AuthController@getuserbodyprofile');

	Route::post('/edit-user', 'Api\AuthController@update');

	Route::post('/select-gender', 'Api\AuthController@selectgender')->name('selectgender.api');

	Route::post('/get-questions', 'Api\QuestionController@getquestions')->name('getquestions.api');

	Route::post('/save-order', 'Api\AuthController@selectpackage')->name('selectpackage.api');

	Route::post('/get-answers', 'Api\QuestionController@getclientanswers')->name('getclientanswers.api');

	Route::post('/submit-answers', 'Api\QuestionController@saveanswers')->name('saveanswers.api');

	Route::post('/update-body-health', 'Api\QuestionController@updateAnswers')->name('updateanswers.api');

	Route::post('/logout', 'Api\AuthController@logout')->name('logout.api');

	Route::get('/get-cart', 'Api\CartController@getcart')->name('getcart.api');

	Route::get('/get-coupons', 'Api\CartController@coupons')->name('coupons.api');

	Route::post('/addtocart', 'Api\CartController@addtocart')->name('addtocart.api');

	Route::get('/delete-cart', 'Api\CartController@deletecart')->name('deletecart.api');
	Route::get('/terms', 'Api\AuthController@terms')->name('terms.api');

	Route::get('/about', 'Api\AuthController@about')->name('about.api');

	Route::get('/privacy-policy', 'Api\AuthController@privacyPolicy')->name('privacypolicy.api');

	Route::post('/update-cart', 'Api\CartController@updatecart')->name('updatecart.api');

	Route::post('/get-workouts', 'Api\WorkoutController@getworkouts')->name('getworkout.api');

	Route::post('/get-workout-details', 'Api\WorkoutController@getexercisedetails')->name('getexercisedetails.api');

	Route::post('/get-workout-instructions', 'Api\WorkoutController@getworkoutinstructions')->name('getworkoutinstructions.api');

	Route::post('/view-diets', 'Api\TableController@gettable')->name('gettable.api');

	Route::post('/intake-subs', 'Api\DietController@intakeSubs')->name('intakesubs.api');
	Route::post('/intake-subs-comment', 'Api\DietController@intakeSubsComment')->name('intakesubscomment.api');
	Route::post('/intake-subs-list', 'Api\DietController@intakeSubsList')->name('intakesubslist.api');
	
	Route::post('/get-breakfast', 'Api\TableController@getbreakfast')->name('gettable.api');
	Route::post('/get-lunch', 'Api\TableController@getlunch')->name('getlunch.api');
	Route::post('/get-dinner', 'Api\TableController@getdinner')->name('getdinner.api');
	Route::post('/get-snacks', 'Api\TableController@getsnacks')->name('getsnacks.api');

	Route::post('/complete-workout', 'Api\WorkoutController@completeworkout')->name('completeworkout.api');
	Route::post('/summary-workout', 'Api\WorkoutController@summaryworkout')->name('summaryworkout.api');

});

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // Public routes
	Route::get('/get-packages', 'Api\AuthController@getpackages')->name('getpackages.api');
	Route::post('/login', 'Api\AuthController@login')->name('login.api');
	Route::post('/register','Api\AuthController@register')->name('register.api');

    //Forget Password routes
	Route::post('create', 'Api\PasswordResetController@create');
	Route::get('password/find/{token}', 'Api\PasswordResetController@find');
	Route::post('reset', 'Api\PasswordResetController@reset');
	Route::get('getcountryflags','Api\AuthController@getcountryflags');
	Route::get('terms','Api\AuthController@terms');
	

});