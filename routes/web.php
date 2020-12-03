<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
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
    return view('home');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
});

// routa /forum till CategoryController klassen, funktionen index
Route::get('/forum', [CategoryController::class, 'show']);
Route::get('/forum/{forumID}', [ForumController::class, 'show']);
Route::get('/forum/{forumID}/thread/{threadID}', [ThreadController::class, 'show']);



Route::get('/laravel', function () {
    return view('welcome');
});

Route::post("user", [Auth::class, 'Login']);
