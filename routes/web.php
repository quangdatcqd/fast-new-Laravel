<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('users')->group(function () {
        Route::get("list", [UserController::class, "index"])->name('users.list');
        Route::get("edit/{id}", [UserController::class, "edit"])->name('users.edit');;
        Route::delete("delete/{id}", [UserController::class, "destroy"])->name('users.delete');
        Route::get("create", [UserController::class, "create"])->name('users.create');

        Route::post("update/{id}", [UserController::class, "update"]);
        Route::get("store", [UserController::class, "store"]);
    });

    Route::prefix('posts')->group(function () {
        Route::get("list", [PostController::class, "index"])->name('posts.list');
        Route::get("list-category/{id}", [PostController::class, "listCategory"])->name('posts.list-category');

        Route::get("edit/{id}", [PostController::class, "edit"])->name('posts.edit');
        Route::delete("delete/{id}", [PostController::class, "destroy"])->name('posts.delete');
        Route::get("create", [PostController::class, "create"])->name('posts.create');

        Route::post("update/{id}", [PostController::class, "update"])->name('posts.update');
        Route::post("store", [PostController::class, "store"])->name('posts.store');
    });

    Route::prefix('categories')->group(function () {
        Route::get("list", [CategoryController::class, "index"])->name('categories.list');
        Route::get("edit/{id}", [CategoryController::class, "edit"])->name('categories.edit');
        Route::delete("delete/{id}", [CategoryController::class, "destroy"])->name('categories.delete');
        Route::get("create", [CategoryController::class, "create"])->name('categories.create');
        Route::get("reorder", [CategoryController::class, "reorder"])->name('categories.reorder');

        Route::post("update/{id}", [CategoryController::class, "update"])->name('categories.update');
        Route::post("update-reorder", [CategoryController::class, "updateReorder"]);
        Route::post("store", [CategoryController::class, "store"])->name('categories.store');
    });


    Route::prefix('tags')->group(function () {
        Route::get("list", [TagController::class, "index"])->name('tags.list');
        Route::get("edit/{id}", [TagController::class, "edit"])->name('tags.edit');
        Route::get("create", [TagController::class, "create"])->name('tags.create');
        Route::get("search", [TagController::class, "search"]);

        Route::delete("delete/{id}", [TagController::class, "destroy"])->name('tags.delete');
        Route::post("update/{id}", [TagController::class, "update"])->name('tags.update');
        Route::post("store", [TagController::class, "store"])->name('tags.store');
    });
});
