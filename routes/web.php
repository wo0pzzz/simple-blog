<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/add', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.add');
    Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'posts'])->name('category.posts');
    Route::post('/category/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');

    Route::get('/post/add', [\App\Http\Controllers\PostController::class, 'create'])->name('post.add');
    Route::post('/post/store', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::post('/post/search', [\App\Http\Controllers\PostController::class, 'search'])->name('post.search');
    Route::delete('/post/delete/{id}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');

    Route::post('/comment/add', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/delete/{id}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.delete');
});

Route::get('/post/{id}', [\App\Http\Controllers\PostController::class, 'index'])->name('post.index');

require __DIR__.'/auth.php';
