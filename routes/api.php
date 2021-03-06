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
	Route::post('/check-phone', 'Api\AuthController@checkPhone');

	Route::post('/select-gender', 'Api\AuthController@selectgender')->name('selectgender.api');

	Route::get('/in-app-purchase', 'Api\AuthController@inAppPurchase')->name('inapppurchase.api');

	Route::post('/get-questions', 'Api\QuestionController@getquestions')->name('getquestions.api');

	Route::post('/save-order', 'Api\AuthController@selectpackage')->name('selectpackage.api');

	Route::get('/get-package', 'Api\AuthController@getpackage')->name('getpackage.api');

	Route::post('/get-answers', 'Api\QuestionController@getclientanswers')->name('getclientanswers.api');

	Route::post('/submit-answers', 'Api\QuestionController@saveanswers')->name('saveanswers.api');

	Route::post('/update-body-health', 'Api\QuestionController@updateAnswers')->name('updateanswers.api');

	Route::post('/logout', 'Api\AuthController@logout')->name('logout.api');

	Route::get('/get-cart', 'Api\CartController@getcart')->name('getcart.api');

	Route::get('/get-coupons', 'Api\CartController@coupons')->name('coupons.api');

	Route::post('/addtocart', 'Api\CartController@addtocart')->name('addtocart.api');

	Route::get('/delete-cart', 'Api\CartController@deletecart')->name('deletecart.api');
	Route::get('/terms', 'Api\AuthController@terms')->name('terms.api');
	Route::post('/send-sms', 'Api\AuthController@sendSms')->name('sendsms.api');

	Route::get('/faqs', 'Api\AuthController@faqs')->name('faqs.api');

	Route::get('/gdpr', 'Api\AuthController@gdpr')->name('gdpr.api');

	Route::get('/about', 'Api\AuthController@about')->name('about.api');

	Route::get('/privacy-policy', 'Api\AuthController@privacyPolicy')->name('privacypolicy.api');

	Route::post('/update-cart', 'Api\CartController@updatecart')->name('updatecart.api');

	Route::post('/get-workouts', 'Api\WorkoutController@getworkouts')->name('getworkout.api');

	Route::post('/get-workout-details', 'Api\WorkoutController@getexercisedetails')->name('getexercisedetails.api');

	Route::post('/get-home', 'Api\AuthController@getHomeData')->name('gethomedata.api');

	Route::post('/get-workout-instructions', 'Api\WorkoutController@getworkoutinstructions')->name('getworkoutinstructions.api');
	

	Route::post('/view-diets', 'Api\TableController@gettable')->name('gettable.api');
	Route::post('/diet-instructions', 'Api\TableController@getDietsInstructions')->name('getdietsinstructions.api');

	Route::post('/intake-subs', 'Api\DietController@intakeSubs')->name('intakesubs.api');
	Route::post('/intake-subs-comment', 'Api\DietController@intakeSubsComment')->name('intakesubscomment.api');
	Route::post('/intake-subs-comment-list', 'Api\DietController@intakeSubsCommentList')->name('intakesubscommentlist.api');
	Route::post('/intake-subs-list', 'Api\DietController@intakeSubsList')->name('intakesubslist.api');
	
	Route::post('/get-breakfast', 'Api\TableController@getbreakfast')->name('gettable.api');
	Route::post('/get-lunch', 'Api\TableController@getlunch')->name('getlunch.api');
	Route::post('/get-dinner', 'Api\TableController@getdinner')->name('getdinner.api');
	Route::post('/get-snacks', 'Api\TableController@getsnacks')->name('getsnacks.api');
	Route::post('save-chat', 'Api\ChatController@store')->name('insertchat.api');
	Route::post('chat-list', 'Api\ChatController@getChat')->name('getchat.api');

	Route::get('nutritionist-detail', 'Api\AuthController@nutritionistDetail')->name('nutritionistdetail.api');

	Route::post('/complete-workout', 'Api\WorkoutController@completeworkout')->name('completeworkout.api');
	Route::post('/summary-workout', 'Api\WorkoutController@summaryworkout')->name('summaryworkout.api');

	Route::get('/workout-days', 'Api\WorkoutController@workoutDays')->name('workoutdays.api');

});

/*use these api without login also*/
Route::get('/terms', 'Api\AuthController@terms')->name('terms.api');
Route::get('/gdpr', 'Api\AuthController@gdpr')->name('gdpr.api');

Route::get('/about', 'Api\AuthController@about')->name('about.api');

Route::get('/faqs', 'Api\AuthController@faqs')->name('faqs.api');

Route::post('/forget-password-sms', 'Api\AuthController@forgetPasswordSms')->name('sendsms.api');

Route::get('/privacy-policy', 'Api\AuthController@privacyPolicy')->name('privacypolicy.api');
/*end*/


Route::group(['middleware' => ['cors', 'json.response']], function () {

    // Public routes
	Route::get('/get-packages', 'Api\AuthController@getpackages')->name('getpackages.api');
	Route::post('/login', 'Api\AuthController@login')->name('login.api');
	Route::post('/register','Api\AuthController@register')->name('register.api');
	Route::get('/nutritionist-list','Api\AuthController@nutritionistList')->name('nutritionistlist.api');

    //Forget Password routes
	Route::post('create', 'Api\PasswordResetController@create');
	Route::get('password/find/{token}', 'Api\PasswordResetController@find');
	Route::post('reset', 'Api\PasswordResetController@reset');

	Route::post('reset-mobile', 'Api\PasswordResetController@resetByMobile');

	Route::post('/send-otp', 'Api\AuthController@sendOtp')->name('sendotp.api');
	Route::post('/resend-otp', 'Api\AuthController@resendOtp')->name('resendotp.api');
	Route::post('/verify-otp', 'Api\AuthController@verifyOtp')->name('verifyotp.api');

	Route::get('getcountryflags','Api\AuthController@getcountryflags');
	Route::post('convert-currency','Api\AuthController@currencyConverter');
	Route::get('terms','Api\AuthController@terms');
	

});