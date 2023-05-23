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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); // home page is coming login now

Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store'); // create route for store message
Route::get('/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index'); // create route for showing all messages

// create route for checking others messages who followed by you
Route::get('/usersmessages/{id}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');

// create route for showing all users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

// create route for following and unfollowing
Route::post('/users/{user}/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('users.follow');
Route::post('/users/{user}/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('users.unfollow');