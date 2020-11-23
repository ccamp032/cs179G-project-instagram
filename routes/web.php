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

Route::post('/post/getUserNames/','App\Http\Controllers\PostController@getUserNames')->name('post.getUserNames');

// Route::post('/search', 'App\Http\Controllers\SearchController@search')->name('search.search');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
  	Route::get('post', ['as' => 'post.create', 'uses' => 'App\Http\Controllers\PostController@create']);
 	Route::put('post', ['as' => 'post.createPost', 'uses' => 'App\Http\Controllers\PostController@createPost']);
	Route::get('dashboard', ['as' => 'dashboard.view', 'uses' => 'App\Http\Controllers\DashboardController@loadDashboard']);
	Route::put('search', ['as' => 'search.search', 'uses' => 'App\Http\Controllers\SearchController@search']);
	Route::get('myprofile/edit', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('myprofile', ['as' => 'profile.myprofile', 'uses' => 'App\Http\Controllers\ProfileController@myProfile']);
	Route::put('myprofile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('myprofile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::any('profile/{userId}', ['as' => 'profile.getProfile', 'uses' => 'App\Http\Controllers\ProfileController@getProfile']);
});
