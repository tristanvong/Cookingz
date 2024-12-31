<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(RecipeController::class)->group(function(){
    Route::get('/recipes', 'index')->name('recipes.index');
    Route::get('/recipe/{id}', 'show')->name('recipe');
});

Route::middleware('auth')->controller(RecipeController::class)->group(function(){
    Route::get('/recipes/create', 'create')->name('recipes.create');
    Route::post('/recipes/create', 'store')->name('recipes.store');
    Route::get('/recipes/{id}/edit', 'edit')->name('recipes.edit');
    Route::put('/recipes/{id}', 'update')->name('recipes.update');
    Route::delete('/recipes/{id}', 'destroy')->name('recipes.destroy');
    Route::get('/my-recipes', 'listUserRecipes')->name('recipes.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(FAQController::class)->group(function() {
    Route::get('/faqs', 'index')->name('faqs.index');
    Route::get('/faqs/category/{id}', 'showCategory')->name('faqs.category');
});

// only admin -> middleware is WIP [work in progress] will add middleware later
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/faq/create', [FAQController::class, 'create'])->name('faqs.create');
Route::post('/faq/create', [FAQController::class, 'store'])->name('faqs.store');

Route::get('/faq/{id}/edit', [FAQController::class, 'edit'])->name('faqs.edit');
Route::put('/faq/{id}', [FAQController::class, 'update'])->name('faqs.update');

Route::delete('/faq/{id}', [FAQController::class, 'destroy'])->name('faqs.destroy');

Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/make-admin/{id}', [UserController::class, 'makeAdmin'])->name('makeAdmin');
// only admin
require __DIR__.'/auth.php';