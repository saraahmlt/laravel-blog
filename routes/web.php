<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagecontrol;
use App\Http\Controllers\pageAboutUs;
use App\Http\Controllers\pagewelcome;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PageAdminController;
use App\Http\Controllers\CategorieController;

Route::get('/', [pagewelcome::class, 'welcome'])->name('page.welcome');
Route::get('/legals', [pagecontrol::class, 'legals'])->name('page.legals');
Route::get('/aboutus', [pageAboutUs::class, 'aboutus'])->name('page.aboutus');

Route::group(['prefix' => '/dashboard'],function () {
    Route::get('/', [PageAdminController::class, 'dashboard'])->middleware(['auth'])->name('admin.dashboard');
    Route::get('/my-posts', [PageAdminController::class, 'myposts'])->middleware(['auth'])->name('admin.myposts');

    Route::get('/post', [AdminPostController::class, 'create'])->middleware(['auth'])->name('admin.create.posts');
    Route::post('/post', [AdminPostController::class, 'store'])->middleware(['auth'])->name('admin.store.posts');

    Route::get('/post/{id}/edit', [AdminPostController::class, 'edit'])->middleware(['auth'])->name('admin.edit.posts');
    Route::put('/post/{id}/edit', [AdminPostController::class, 'update'])->middleware(['auth'])->name('admin.update.posts');
    Route::delete('/post/{id}/edit', [AdminPostController::class, 'destroy'])->middleware(['auth'])->name('admin.destroy.posts');
    Route::get('/admin/posts/{id}', [AdminPostController::class, 'show'])->name('admin.posts.show');

    
    Route::get('/categories', [CategorieController::class, 'index'])->middleware(['auth'])->name('admin.index.categories');

    Route::get('/categorie', [CategorieController::class, 'create'])->middleware(['auth'])->name('admin.create.categories');
    Route::post('/categorie', [CategorieController::class, 'store'])->middleware(['auth'])->name('admin.store.categories');

    Route::get('/categorie/{id}/edit', [CategorieController::class, 'edit'])->middleware(['auth'])->name('admin.edit.categories');
    Route::put('/categorie/{id}/edit', [CategorieController::class, 'update'])->middleware(['auth'])->name('admin.update.categories');
    Route::delete('/categorie/{id}/edit', [CategorieController::class, 'destroy'])->middleware(['auth'])->name('admin.destroy.categories');
    Route::get('/admin/categories/{id}', [CategorieController::class, 'show'])->name('admin.categories.show');


});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('edit.profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy.profile');
});

require __DIR__.'/auth.php';
