<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\ReplyController;
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

Route::get('/create_thread', function () {
    return view('create_thread');
});


Route::get('/login', function () {
    return view('login');
});

// routa /forum till CategoryController klassen, funktionen index
Route::get('/forum', [CategoryController::class, 'show']);
Route::get('/forum/{forumID}', [ForumController::class, 'show']);
Route::get('/forum/{forumID}/thread/{threadID}', [ThreadController::class, 'show']);


/* Calender routes */
Route::get('calendar', [FullCalendarController::class, 'index']);
Route::post('fullcalendar/create', [FullCalendarController::class, 'create']);
Route::post('fullcalendar/update', [FullCalendarController::class, 'update']);
Route::post('fullcalendar/delete', [FullCalendarController::class, 'destroy']);



Route::get('/laravel', function () {
    return view('welcome');
});

Route::post("user", [Auth::class, 'Login']);





/* Routes - Create Forum */
Route::post('/forum/{categoryID}/create_forum', function ($categoryID) {
	// dd($categoryID);
	return view('create_forum')->with('categoryID', $categoryID);
});
Route::post('/forum/{categoryID}/forum/create', [ForumController::class, 'create']);


/* Routes - Create Thread */
Route::post('/forum/{forumID}/create_thread', function ($forumID) {
	return view('create_thread')->with('forumID', $forumID);
});
Route::post('/forum/{forumID}/thread/create', [ThreadController::class, 'create']);

/* Routes - Create Reply */
Route::get('/forum/{forumID}/thread/{threadID}/create_reply', function ($forumID, $threadID) {
	return view('create_reply')->with('forumID', $forumID)
								->with('threadID', $threadID);
});
Route::get('/forum/{forumID}/thread/{threadID}/create', [ReplyController::class, 'create']);



