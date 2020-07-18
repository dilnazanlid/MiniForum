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

Route::get('/', function () { return view('main');})->name('main');

Route::get('/logout', 'UserController@Logout')->name('logout');

Route::get('/userlogin', 'UserController@SigninPage')->name('login_page');

Route::get('/usersignup', 'UserController@SignupPage')->name('signup_page');

Route::post('/signup', 'UserController@userSignUp')->name('signup');

Route::post('/signin', 'UserController@userSignIn')->name('signin');

Route::get('/dashboard', ['uses' => 'PostController@dashboardShow', 'middleware' => 'auth'])->name('dashboard');

Route::post('/newpost', 'PostController@addNewPost')->name('new_post');

Route::get('/posts', 'PostController@getAllPosts')->name('all_posts');

Route::get('/post/{id}', 'PostController@getOnePosts')->name('one_post');

Route::post('/like', 'PostController@likePost')->name('like');

Route::post('/cat', 'PostController@addCat')->name('add_category');
