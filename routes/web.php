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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});






Auth::routes();
Route::middleware(['auth'])->group(function () {


Route::resource('companies', 'CompaniesController');
Route::resource('comments', 'CommentsController');
Route::resource('followers', 'FollowersController');
Route::resource('users', 'UsersController');


Route::resource('posts', 'PostsController');


Route::resource('votes', 'VotesController');
Route::get('/home', 'HomeController@index');


Route::get('/peoples', 'UsersController@index')->name('peoples');
Route::get('/peoples/{user?}', 'UsersController@show');
Route::get('/peoples/{user}/edit', 'UsersController@edit');


Route::get('/home', 'ViewController@index')->name('home');



});
