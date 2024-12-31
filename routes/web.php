<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\CategoryController;

Route::prefix('profile')
    ->name('profile.')
    ->middleware('auth')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
});

// this stuff will be overwritten so will keep it for now
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// --- end of overwritten stuff ---

Route::name('recipes.')
    ->controller(RecipeController::class)
    ->group(function(){
        Route::get('/recipes', 'index')->name('index');
        Route::get('/recipe/{id}', 'show')->name('recipe');
});

Route::name('recipes.')
    ->middleware('auth')
    ->controller(RecipeController::class)
    ->group(function(){
        Route::get('/recipes/create', 'create')->name('create');
        Route::post('/recipes/create', 'store')->name('store');
        Route::get('/recipes/{id}/edit', 'edit')->name('edit');
        Route::put('/recipes/{id}', 'update')->name('update');
        Route::delete('/recipes/{id}', 'destroy')->name('destroy');
        Route::get('/my-recipes', 'listUserRecipes')->name('user');
});

Route::prefix('categories')
    ->name('categories.')
    ->middleware('isAdmin')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{category}/edit', 'edit')->name('edit');
        Route::put('{category}', 'update')->name('update');
        Route::delete('{category}', 'destroy')->name('destroy');
});

Route::prefix('faqs')
    ->name('faqs.')
    ->controller(FAQController::class)
    ->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/category/{id}', 'showCategory')->name('category');
});

Route::prefix('faq')
    ->name('faqs.')
    ->middleware('isAdmin')
    ->controller(FAQController::class)
    ->group(function () {
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::delete('{id}', 'destroy')->name('destroy');
});

Route::prefix('user')
    ->name('user.')
    ->middleware('isAdmin')
    ->controller(UserController::class)
    ->group(function () {
        Route::delete('{id}', 'destroy')->name('destroy');
        Route::post('make-admin/{id}', 'makeAdmin')->name('makeAdmin');
});
require __DIR__.'/auth.php';