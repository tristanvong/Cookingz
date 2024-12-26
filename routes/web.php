<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Recipe;
use App\Models\User;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $recipes = Recipe::with('user', 'reviews')->get();
    $users = User::all();
    return view('test', compact('recipes', 'users'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/make-admin/{id}', [UserController::class, 'makeAdmin'])->name('makeAdmin');//have to add middleware to make sure that only admin can do this
require __DIR__.'/auth.php';
