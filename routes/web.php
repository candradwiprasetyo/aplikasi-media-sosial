<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::resource('users', UserController::class);
// Route::resource('posts', PostController::class);
// Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
// Route::post('posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
// Route::delete('posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [PostController::class, 'index'])->name('index');
  Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
  Route::resource('posts', PostController::class);
  Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
  Route::post('posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
  Route::delete('posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
  Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
