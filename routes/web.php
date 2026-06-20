<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Mail\NewUserWelcomeMail;
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

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail;
});

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/search', [ProfileController::class, 'search'])->middleware('auth')->name('profiles.search');

Route::get('/', [PostController::class, 'index']);
Route::get('/p/create', [PostController::class, 'create']);
Route::post('/p', [PostController::class, 'store']);
Route::get('/p/{post}', [PostController::class, 'show']);

Route::post('follow/{user}', [FollowController::class, 'store']);
