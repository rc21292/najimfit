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

Route::resource('datas','ApplicationDataController');

Route::get('renew-workout-clients','ApplicationDataController@renewWorkoutClients')->name('renew-workout-clients');

Route::get('renew-table-clients','ApplicationDataController@renewTableClients')->name('renew-table-clients');

Route::get('clients-by-package/{id}','ApplicationDataController@clientsByPackageId')->name('clients-by-package');

Route::get('older-clients','ApplicationDataController@olderClients')->name('older-clients');

Route::get('new-clients','ApplicationDataController@newClients')->name('new-clients');

Route::get('clients-all','ApplicationDataController@allClients')->name('clients-all');

Route::resource('notifications','NotificationController');

Route::get('send-push-notification','NotificationController@sendPushNotification')->name('send-push-notification');
Route::post('/send-push-notification','NotificationController@postPushNotification')->name('send-push-notification');

Route::post('/send-general-push-notification','NotificationController@postGeneralPushNotification')->name('send-general-push-notification');

Route::post('/send-broadcast-general-push-notification','NotificationController@postBroadcastGeneralPushNotification')->name('send-broadcast-general-push-notification');

Route::get('send-personalized-push-notification','NotificationController@sendPersonalizedPushNotification')->name('send-personalized-push-notification');

Route::get('send-personalized-in-chat-broadcast','NotificationController@sendPersonalizedInChatBroadcast')->name('send-personalized-in-chat-broadcast');

Route::post('send-broadcast-personalized-in-chat-broadcast','NotificationController@postBroadcastPushNotification')->name('send-broadcast-personalized-in-chat-broadcast');

Route::get('send-in-chat-broadcast','NotificationController@sendInChatBroadcast')->name('send-in-chat-broadcast');

Route::get('notifications-history','NotificationController@notificationsHistory')->name('notifications-history');
Route::get('broadcasts-history','NotificationController@broadcastsHistory')->name('broadcasts-history');

Route::resource('subscriptions','SubscriptionController');

Route::get('accept-subscriptions','SubscriptionController@AcceptSubscriptions')->name('accept-subscriptions');
Route::get('close-subscriptions','SubscriptionController@CloseSubscriptions')->name('close-subscriptions');
Route::get('cancel-subscription','SubscriptionController@cancelSubscription')->name('cancel-subscription');

Route::get('cancel-client-subscription/{id}','SubscriptionController@cancelSubscriptionByClient')->name('cancel-client-subscription');
Route::get('uncancel-client-subscription/{id}','SubscriptionController@uncancelSubscriptionByClient')->name('uncancel-client-subscription');

Route::get('uncancel-subscription','SubscriptionController@uncancelSubscription')->name('uncancel-subscription');
Route::post('uncancel-subscription','SubscriptionController@uncancelSubscriptionByClient')->name('uncancel-subscription');
Route::get('extend-subscription','SubscriptionController@ExtendSubscription')->name('extend-subscription');
Route::post('extend-subscription','SubscriptionController@ExtendSubscriptionByClient')->name('extend-subscription');
Route::get('block-user','SubscriptionController@BlockUserFromApp')->name('block-user');
Route::get('unblock-user','SubscriptionController@UnblockUserFromApp')->name('unblock-user');
Route::post('update-suscription-settings','SubscriptionController@updateSuscriptionSettings')->name('update-suscription-settings');
Route::get('block-user-from-app/{id}','SubscriptionController@BlockClientFromApp')->name('block-user-from-app');
Route::get('unblock-user-from-app/{id}','SubscriptionController@UnblockClientFromApp')->name('unblock-user-from-app');
Route::get('custom-messages','SubscriptionController@customMessages')->name('custom-messages');
Route::post('update-custom-messages','SubscriptionController@updateCustomMessages')->name('update-custom-messages');
Route::get('notify-clients','SubscriptionController@notifyClients')->name('notify-clients');
Route::post('notify-clients','SubscriptionController@notifyClientMessage')->name('notify-clients');

Route::resource('appointments','AppointmentController');
Route::resource('employees','EmployeeController');
Route::resource('access','AccesController');

Route::resource('notes','NoteController');
Route::get('send-note/{id}','NoteController@sendNote')->name('send-note');

Route::resource('client-chats','ClientChatController');
Route::get('mark-unread/{id}','ClientChatController@markUnread')->name('mark-unread');
Route::get('block-nutritionist/{id}','ClientChatController@blockNutritionist')->name('block-nutritionist');
Route::get('unblock-nutritionist/{id}','ClientChatController@unblockNutritionist')->name('unblock-nutritionist');
Route::get('block-client/{id}','ClientChatController@blockClient')->name('block-client');
Route::get('unblock-client/{id}','ClientChatController@unblockClient')->name('unblock-client');

Route::get('nutritionist-clients/{id}','ClientChatController@showClients')->name('nutritionist-clients');

Route::get('chat-defer-client/{id}','ClientChatController@deferClient')->name('chat-defer-client');

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
Route::resource('admin-requests','AdminRequestController');
Route::get('save-admin-request/{id}','AdminRequestController@store');

Route::get('defer/{id}','RequestController@create')->name('defer');
Route::get('defer-client/{id}','RequestController@deferClient')->name('defer-client');
Route::get('client-defer/{id}','ComplaintController@deferClient')->name('defer-client');
Route::post('assign-nutritionist','RequestController@assignToNutritionist')->name('assign-nutritionist');
Route::post('assign-to-nutritionist','ComplaintController@assignToNutritionist')->name('assign-to-nutritionist');
Route::post('assign-client-to-nutritionist','ClientChatController@assignToNutritionist')->name('assign-client-to-nutritionist');

Route::resource('complaints','ComplaintController');
Route::get('post-complaint/{id}','ComplaintController@create')->name('post-complaint');

Route::resource('intake-substances','IntakeSubstanceController');
Route::get('view-diets/{id}','IntakeSubstanceController@viewDiet')->name('view-diets');
Route::get('view-comments/{id}','IntakeSubstanceController@viewComments')->name('view-comments');

Route::resource('client-full-profile','ClientProfileController');
Route::post('block-unblock-user','ClientProfileController@blockUnblockUser')->name('block-unblock-user');
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
//fullcalender

Route::get('/fullcalendar','FullCalendarController@index')->name('fullcalendar-index');

Route::post('/fullcalendar/create','FullCalendarController@create')->name('fullcalendar-create');

Route::post('/fullcalendar/update','FullCalendarController@update')->name('fullcalendar-update');

Route::post('/fullcalendar/delete','FullCalendarController@destroy')->name('fullcalendar-destroy');
Route::post('/fullcalendar/event','FullCalendarController@save_event')->name('fullcalendar-save-event');
Route::post('/fullcalendar/appointment','FullCalendarController@save_appointment')->name('fullcalendar-save-appointment');

Route::resource('/meeting', 'MeetingController');

Route::resource('/teams', 'TeamController');

Route::get('/meeting-notifications','MeetingController@notifications');
});
