<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/welcome', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::post('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::post('/post/getUserNames/','App\Http\Controllers\PostController@getUserNames')->name('post.getUserNames');

Route::post('/post/incrementViews/','App\Http\Controllers\PostController@incrementViews')->name('post.incrementViews');

Route::post('/post/likePhoto/','App\Http\Controllers\PostController@likePhoto')->name('post.likePhoto');
Route::post('/post/dislikePhoto/','App\Http\Controllers\PostController@dislikePhoto')->name('post.dislikePhoto');

Route::post('/post/addComment/','App\Http\Controllers\PostController@addComment')->name('post.addComment');

Route::post('/profile/followUser/', 'App\Http\Controllers\ProfileController@followUser')->name('profile.followUser');
Route::post('/profile/unfollowUser/', 'App\Http\Controllers\ProfileController@unfollowUser')->name('profile.unfollowUser');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
 	Route::get('post', ['as' => 'post.create', 'uses' => 'App\Http\Controllers\PostController@create']);
 	Route::put('post', ['as' => 'post.createPost', 'uses' => 'App\Http\Controllers\PostController@createPost']);
  	Route::get('editpost', ['as' => 'post.edit', 'uses' => 'App\Http\Controllers\PostController@edit']);
  	Route::put('editpost', ['as' => 'post.editPost', 'uses' => 'App\Http\Controllers\PostController@editPost']);
 	//Route::put('post', ['as' => 'post.delete', 'uses' => 'App\Http\Controllers\PostController@delete']);
	Route::get('dashboard', ['as' => 'dashboard.view', 'uses' => 'App\Http\Controllers\DashboardController@loadDashboard']);
	Route::put('search', ['as' => 'search.search', 'uses' => 'App\Http\Controllers\SearchController@search']);
	Route::get('myprofile/edit', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('myprofile', ['as' => 'profile.myprofile', 'uses' => 'App\Http\Controllers\ProfileController@myProfile']);
	Route::put('myprofile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('myprofile/followers', ['as' => 'profile.myfollowers', 'uses' => 'App\Http\Controllers\ProfileController@myFollowers']);
	Route::get('myprofile/following', ['as' => 'profile.myfollowing', 'uses' => 'App\Http\Controllers\ProfileController@myFollowing']);
	Route::put('myprofile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::any('profile/{userId}', ['as' => 'profile.getProfile', 'uses' => 'App\Http\Controllers\ProfileController@getProfile']);
	Route::any('profile/{userId}/followers', ['as' => 'profile.userfollowers', 'uses' => 'App\Http\Controllers\ProfileController@userFollowers']);
	Route::any('profile/{userId}/following', ['as' => 'profile.userfollowing', 'uses' => 'App\Http\Controllers\ProfileController@userFollowing']);
	Route::get('popular/users', ['as' => 'popular.users', 'uses' => 'App\Http\Controllers\PopularController@popularUsers']);
	Route::get('popular/posts', ['as' => 'popular.posts', 'uses' => 'App\Http\Controllers\PopularController@popularPosts']);
});

// Route::post('/search', 'App\Http\Controllers\SearchController@search')->name('search.search');

// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('table-list', function () {
// 		return view('pages.table_list');
// 	})->name('table');

// 	Route::get('typography', function () {
// 		return view('pages.typography');
// 	})->name('typography');

// 	Route::get('icons', function () {
// 		return view('pages.icons');
// 	})->name('icons');

// 	Route::get('map', function () {
// 		return view('pages.map');
// 	})->name('map');

// 	Route::get('notifications', function () {
// 		return view('pages.notifications');
// 	})->name('notifications');

// 	Route::get('rtl-support', function () {
// 		return view('pages.language');
// 	})->name('language');

// 	Route::get('upgrade', function () {
// 		return view('pages.upgrade');
// 	})->name('upgrade');
// });
