<?php

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

// Home
Route::get('/', 'LandingController@index')->name('landing_page');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Movies
Route::get('movie/{id}', 'MovieController@show')->name('movie');
Route::get('api/movie/{movie_id}/feed/{page}','MovieController@getPage');
Route::post('api/movie/{id}/review','ReviewController@create');
Route::get('/admin/movies/add', 'MovieController@add_page')->name('add_movie');
Route::post('/admin/movies/add', 'MovieController@create');
Route::get('/api/movie/{id}', 'MovieController@edit_page')->name('edit_movie');
Route::post('/api/movie/{id}', 'MovieController@edit');

//Reviews
Route::get('review/{id}','ReviewController@show')->name('review');
Route::get('api/review/{review_id}','ReviewController@getReview');
Route::delete('api/review/{review_id}', 'ReviewController@delete');
Route::patch('api/review/{review_id}', 'ReviewController@edit');

//User Profile
Route::get('user/{user}','UserController@show')->name('user');
Route::patch('/api/admin/users/{user}/ban','UserController@ban')->name('ban');
Route::patch('/api/admin/users/{user}/unban','UserController@unban')->name('unban');

//Feed
Route::get('feed', 'FeedController@index')->name('feed');
Route::get('api/public_feed/{page}', 'FeedController@getPublicPage');
Route::get('api/friends_feed/{page}', 'FeedController@getFriendPage');

//Notifications
Route::get('notifications', 'NotificationController@index')->name('notifications')->middleware('auth');
Route::get('api/notifications/{page}', 'NotificationController@getNotificationPage');

//Friendship
Route::get('/api/users/{user_id}/friends/', 'FriendController@show_list')->name('friends');
Route::post('/api/users/{user_id}/friend_request/{asker_id}', 'FriendController@invite')->name('friend_request');
Route::post('/api/users/{user_id}/request/friend/accept/{asker_id}', 'FriendController@accept')->name('accept_friend_request');
Route::post('/api/users/{user_id}/request/friend/reject/{asker_id}', 'FriendController@reject')->name('reject_friend_request');
Route::post('/api/users/{user_id}/request/friend/cancel/{asker_id}', 'FriendController@cancel')->name('cancel_friend_request');

//Administrator Dashboard
Route::get('/admin/movies/board', 'AdministrationController@movie_page')->name('movie_dashboard_page');
Route::get('/admin/reviews/board', 'AdministrationController@review_page')->name('review_dashboard_page');
Route::get('/admin/users/board', 'AdministrationController@user_page')->name('user_dashboard_page');