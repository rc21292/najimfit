<?php  

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],'namespace'=>'Admin'], function() {

// Profile Account
Route::resource('my-account', 'MyProfileController');
Route::post('account-delete-image/{account}', 'MyProfileController@deleteimage')->name('account-image-delete');
// User Route
Route::resource('roles','RoleController');
Route::resource('chat','ChatController');
Route::get('view-chat/{id}','ChatController@viewChat')->name('view-chat');
Route::get('show-chat/{id}','ChatController@showChat')->name('show-chat');
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
Route::resource('gdpr','GdprController');
Route::resource('about','AboutUsController');
Route::resource('faqs','FaqController');

Route::resource('controls','ControlController');
Route::resource('notifications','NotificationController');
Route::resource('subscriptions','SubscriptionController');
Route::resource('appointments','AppointmentController');
Route::resource('employees','EmployeeController');
Route::resource('access','AccesController');

Route::resource('notes','NoteController');
Route::get('send-note/{id}','NoteController@sendNote')->name('send-note');

Route::resource('client-chats','ClientChatController');

Route::get('nutritionist-clients/{id}','ClientChatController@showClients')->name('nutritionist-clients');

Route::get('chat-clients','ClientChatController@allclients')->name('chatclients');


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

Route::resource('requests','RequestController');
Route::get('defer/{id}','RequestController@create')->name('defer');
Route::get('defer-client/{id}','RequestController@deferClient')->name('defer-client');
Route::get('client-defer/{id}','ComplaintController@deferClient')->name('defer-client');
Route::post('assign-nutritionist','RequestController@assignToNutritionist')->name('assign-nutritionist');
Route::post('assign-to-nutritionist','ComplaintController@assignToNutritionist')->name('assign-to-nutritionist');
Route::resource('complaints','ComplaintController');
Route::get('post-complaint/{id}','ComplaintController@create')->name('post-complaint');

Route::resource('intake-substances','IntakeSubstanceController');
Route::get('view-diets/{id}','IntakeSubstanceController@viewDiet')->name('view-diets');
Route::get('view-comments/{id}','IntakeSubstanceController@viewComments')->name('view-comments');

Route::resource('client-full-profile','ClientProfileController');
Route::post('meal-delete-image/{meal}', 'ClientsController@deleteimage')->name('meal-image-delete');
// Exercise Route
Route::resource('exercise','Features\ExerciseController');
Route::resource('diet-informations','DietInformationController');

Route::patch('diet-information-update','DietInformationController@updateInformation')->name('diet-information-update');

Route::get('/send-notification','IntakeSubstanceController@sendNotification');

Route::post('exercise-delete-image/{exercise}', 'Features\ExerciseController@deleteimage')->name('exercise-image-delete');
Route::get('workout-informations','Features\ExerciseController@getworkoutinformation')->name('workout-informations');
Route::post('workout-information','Features\ExerciseController@storeinformation')->name('workout-information');
Route::patch('workout-information-update','Features\ExerciseController@updateinformation')->name('workout-information-update');
Route::resource('products','ProductController');
});