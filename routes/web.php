<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'publicIndex'])->name('home');

// Authenticated users (admins)
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['show']);
});


use App\Http\Controllers\CommentController;

Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

use App\Http\Controllers\LikeController;

Route::middleware('auth')->post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
Route::middleware('auth')->post('/posts/{post}/dislike', [LikeController::class, 'dislike'])->name('posts.dislike');
