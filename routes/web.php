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

#TICKETS ROUTES
Route::post('/ticket', 'TicketsController@generate')->name('ticket');

#QUIZ ROUTES
Route::post('/quiz', 'QuizController@store')->name('quiz');
