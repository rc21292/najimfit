<?php  

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],'namespace'=>'Admin'], function() {

// Profile Account
Route::resource('my-account', 'MyProfileController');
Route::post('account-delete-image/{account}', 'MyProfileController@deleteimage')->name('account-image-delete');
// User Route
Route::resource('roles','RoleController');
Route::resource('users','UserController');
// Questions Route
Route::resource('question','Features\QuestionController');
Route::post('question-delete-image/{question}', 'Features\QuestionController@deleteimage')->name('question-image-delete');

// Package Route
Route::resource('package','Features\PackageController');
Route::post('package-delete-image/{package}', 'Features\PackageController@deleteimage')->name('package-image-delete');
// Workout Category Route
Route::resource('workout-category','Features\WorkoutCategoryController');

// Question Category Route
Route::resource('question-category','Features\QuestionCategoryController');
// Table Category Route
Route::resource('tables','Features\Meals\TableController');
// Meals Route
Route::resource('meals','Features\Meals\MealController');
// Coupons Route
Route::resource('coupons','CouponController');
Route::post('meal-delete-image/{meal}', 'Features\Meals\MealController@deleteimage')->name('meal-image-delete');

Route::resource('terms-and-conditions','TermsController');
Route::resource('privacy-policy','PrivacyPolicyController');
Route::resource('about','AboutUsController');

// Assign Table Nutritionist-wise
Route::resource('assign-table','TableController');
Route::get('all-clients','TableController@allclients')->name('allclients');
Route::post('assign-table/set-session','TableController@setsession')->name('set-table-session');
Route::get('diet-template','TableController@diettemplate')->name('diet-template');
Route::post('get-food-info','TableController@foodinfo')->name('food-info');
 
// Renew Table Nutritionist-wise
Route::resource('renew-table','RenewTableController');
Route::get('all-renew-clients','RenewTableController@allclients')->name('all-renew-clients');
Route::post('renew-table/set-session','RenewTableController@setsession')->name('set-renewtable-session');
Route::get('diet-template-renew/{id}','RenewTableController@diettemplate')->name('edit-diet-template');
Route::post('renew-food-info','RenewTableController@foodinfo')->name('renew-food-info');
Route::resource('labels','LabelController');
// Assign Workout Nutritionist-wise
Route::resource('assign-workout','WorkoutController');
Route::get('due-workout-clients','WorkoutController@allclients')->name('allworkoutclients');
Route::post('assign-workout/set-session','WorkoutController@setsession')->name('set-workout-session');
Route::get('workout-template/{id}','WorkoutController@workouttemplate')->name('workout-template');
Route::get('get-workout-info/{id}','WorkoutController@workoutinfo')->name('workout-info');
Route::post('assign-workout-template','WorkoutController@assigntemplate')->name('assign-workout-template');

// Renew Workout Nutritionist-wise
Route::resource('renew-workout','RenewWorkoutController');
Route::get('all-renew-workout-clients','RenewWorkoutController@allclients')->name('all-renew-workout-clients');
Route::post('renew-workout-template','RenewWorkoutController@renewtemplate')->name('reassign-workout-template');
Route::get('renew-workout-template/{id}','RenewWorkoutController@workouttemplate')->name('renew-workout-template');

// Clients Route
Route::resource('clients','ClientsController');

Route::resource('intake-substances','IntakeSubstanceController');

Route::resource('client-full-profile','ClientProfileController');
Route::post('meal-delete-image/{meal}', 'ClientsController@deleteimage')->name('meal-image-delete');
// Exercise Route
Route::resource('exercise','Features\ExerciseController');
Route::post('exercise-delete-image/{exercise}', 'Features\ExerciseController@deleteimage')->name('exercise-image-delete');
Route::get('workout-informations','Features\ExerciseController@getworkoutinformation')->name('workout-informations');
Route::post('workout-information','Features\ExerciseController@storeinformation')->name('workout-information');
Route::patch('workout-information-update','Features\ExerciseController@updateinformation')->name('workout-information-update');
Route::resource('products','ProductController');
});