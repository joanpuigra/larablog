<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// POSTS
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Create new post
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');
Route::post('/', [PostController::class, 'store'])->middleware('auth')->name('posts.store');
 
// Read more
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Update post
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth')->name('posts.edit');
Route::patch('/posts/{post}/update', [PostController::class, 'update'])->middleware('auth')->name('posts.update');

// Delete post
Route::get('/posts/{post}/delete', [PostController::class, 'destroy'])->middleware('auth')->name('posts.destroy');

// COMMENTS
Route::get('/posts/{post}/comments/create', [CommentController::class, 'create'])->middleware('auth')->name('posts.comments.create');
Route::post('/posts/{post}/comments', [CommentController::class, 'storeComment'])->middleware('auth')->name('posts.comments.store');

Route::get('/posts/{post}/{comment}/delete', [CommentController::class, 'destroyComment'])->middleware('auth')->name('posts.comments.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
