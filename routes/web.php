<?php

use Illuminate\Support\Facades\Auth;
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
/*
Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return '<h1>Hello world</h1>';
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/user/{id}', function ($id) {
    return 'This is user '.$id;
});
*/
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::get('/home', 'PagesController@index')->name('home');
Route::get('/adminpanel', 'AdminPanelController@index');

Route::get('/dashboard', 'DashboardController@index');

Route::resource('posts', 'PostsController');

Auth::routes();

Route::resource('/adminpanel/accounts', 'AccountsController');




