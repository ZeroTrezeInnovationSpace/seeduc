<?php

#USER ROUTES 
Route::get('/', 'UserController@index')->name('index');
Route::post('/log_in', 'UserController@logIn')->name('log_in');
Route::post('/log_out', 'UserController@logOut')->name('log_out');
Route::get('/register', 'UserController@registerIndex')->name('register');
Route::post('/register_user', 'UserController@register')->name('register_user');
Route::get('/verifyCPF', 'UserController@verifyCPF')->name('verifyCPF');
Route::post('/new_password', 'UserController@newPassword')->name('new_password');
Route::get('/manage_user', 'UserController@manage')->name('manage_user');
Route::post('/edit_user', 'UserController@update')->name('edit_user');

Route::get('/remember_password', 'UserController@rememberPassword')->name('remember_password');
Route::post('/verify_remember_password', 'UserController@verifyRememberPassword')->name('verify_remember_password');


#ACTIVITY ROUTES
Route::get('/activities', 'ActivityController@index')->name('activities');
Route::get('/activities_register', 'ActivityController@create')->name('activities_register');
Route::post('/activities_save', 'ActivityController@store')->name('activities_save');
Route::get('/list', 'ActivityController@show')->name('list');
Route::post('/delete_activity', 'ActivityController@destroy')->name('delete_activity');
Route::get('/activity_manage/', 'ActivityController@manage')->name('activity_manage');
Route::post('/activity_update', 'ActivityController@update')->name('activity_update');
Route::get('/search_activity', 'ActivityController@searchActivity')->name('search_activity');

//Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/subscriptions', 'DashboardController@subscriptions')->name('subscriptions');
Route::get('/dashboard_activity_search', 'DashboardController@searchActivity')->name('dashboard_activity_search');
Route::get('/dashboard_users_search', 'DashboardController@searchUsers')->name('dashboard_users_search');
Route::get('/generate_attendance_list', 'DashboardController@attendanceList')->name('generate_attendance_list');
Route::post('/admin_check_in', 'DashboardController@checkIn')->name('admin_check_in');


#SUBSCRIBE ROUTES
Route::post('/subscribe', 'SubscribeController@store')->name('subscribe');
Route::post('/unsubscribe', 'SubscribeController@destroy')->name('unsubscribe');

#FEED ROUTES
Route::get('/feed', 'FeedController@index')->name('feed');

#SPEAKERS ROUTES
Route::get('/speaker', 'SpeakerController@create')->name('speaker');
Route::post('/store', 'SpeakerController@store')->name('store');

#PLACE/LOCATION ROUTES
Route::get('/location', 'LocationController@create')->name('location');
Route::post('/location_register', 'LocationController@store')->name('location_register');

#ROOM ROUTES
Route::get('/room', 'RoomController@create')->name('room');
Route::post('/room_register', 'RoomController@store')->name('room_register');

#CERTIFICATE ROUTES
Route::get('/certificate', 'CertificateController@generate')->name('certificate');


#TICKETS ROUTES
Route::post('/ticket', 'TicketsController@generate')->name('ticket');

#QUIZ ROUTES
Route::post('/quiz', 'QuizController@store')->name('quiz');

Route::get('/feedback', 'FeedbackQuizController@feedbackQuiz')->name('feedback');
Route::post('/feedbackquiz', 'FeedbackQuizController@store')->name('feedbackquiz');
Route::get('/feedbacklist', 'FeedbackQuizController@index')->name('feedbacklist');
