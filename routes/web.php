<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsItemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FAQProposalController;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\BlacklistController;

Route::get('/', [RecipeController::class, 'index'])->name('home');

Route::prefix('p')
    ->name('profile.')
    ->middleware('auth', 'isNotBlacklisted')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
});

Route::prefix('p')
    ->name('profile.')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/{id}', 'show')->name('show');
});

Route::prefix('messages')
    ->name('messages.')
    ->middleware('auth', 'isNotBlacklisted')
    ->controller(MessageController::class)
    ->group(function () {
        Route::get('/conversations', 'conversations')->name('conversations');
        Route::get('/private/{user}', 'privateMessages')->name('private');
        Route::post('/private/{user}', 'storePrivate')->name('storePrivate');
        Route::get('/public/{user}', 'publicMessages')->name('public');
        Route::post('/public/{user}', 'storePublic')->name('storePublic');
});

Route::name('recipes.')
    ->controller(RecipeController::class)
    ->group(function(){
        Route::get('/recipes', 'index')->name('index');
        Route::get('/recipe/{id}', 'show')->name('recipe');
});

Route::name('recipes.')
    ->middleware('auth', 'isNotBlacklisted')
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
    ->middleware('isAdmin', 'isNotBlacklisted')
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

Route::prefix('faq-proposals')
    ->name('faq-proposals.')
    ->middleware('auth', 'isNotBlacklisted')
    ->controller(FAQProposalController::class)
    ->group(function () {
        Route::get('create', 'create')->name('create');  
        Route::post('create', 'store')->name('store');  
        Route::get('/', 'showOwnProposals')->name('index');
        Route::get('/{id}', 'showProposalByUserId')->name('showProposalByUserId');
});

Route::prefix('faq-proposals')
    ->name('faq-proposals.')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(FAQProposalController::class)
    ->group(function () {
        Route::post('{id}/approve', 'approve')->name('approve');
        Route::post('{id}/reject', 'reject')->name('reject');
});

Route::prefix('faq')
    ->name('faqs.')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(FAQController::class)
    ->group(function () {
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::put('{id}', 'update')->name('update');
        Route::delete('{id}', 'destroy')->name('destroy');
});

Route::prefix('news')
    ->name('news.')
    ->controller(NewsItemController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{newsItem}', 'show')->name('show');
});

Route::name('comments.')
    ->middleware('auth', 'isNotBlacklisted')
    ->controller(CommentController::class)
    ->group(function () {
        Route::post('/news/{newsItem}/comments', 'store')->name('store');
        Route::delete('/comments/{comment}', 'destroy')->name('destroy');
});

Route::prefix('admin/news')
    ->name('admin.news.')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(NewsItemController::class)
    ->group(function () {
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{newsItem}/edit', 'edit')->name('edit');
        Route::put('{newsItem}', 'update')->name('update');
        Route::delete('{newsItem}', 'destroy')->name('destroy');
});

Route::prefix('contact')
    ->name('contact.')
    ->controller(ContactController::class)
    ->group(function () {
        Route::get('/', 'showForm')->name('form');
        Route::post('/', 'submitForm')->name('submit');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(ContactController::class)
    ->group(function () {
        Route::get('/contact-forms', 'listContactForms')->name('contactForms.index');
        Route::get('/contact-forms/{id}', 'showContactForm')->name('contactForms.show');
        Route::post('/contact-forms/{id}/reply', 'replyToContactForm')->name('contactForms.reply');
        Route::delete('/contact-forms/{id}', 'destroy')->name('contactForms.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('users', 'listAllUsers')->name('users.index'); 
        Route::get('users/create', 'create')->name('users.create'); 
        Route::post('users', 'store')->name('users.store'); 
        Route::post('users/make-admin/{id}', 'makeAdmin')->name('users.makeAdmin');
        Route::post('users/revoke-admin/{id}', 'revokeAdmin')->name('users.revokeAdmin'); 
        Route::delete('users/{id}', 'destroy')->name('users.destroy'); 

        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('list-all', 'listAll')->name('listAll');
});

Route::name('reviews.')
    ->middleware('auth', 'isNotBlacklisted')
    ->controller(ReviewController::class)
    ->group(function () {
        Route::post('/recipes/{recipeId}/reviews', 'store')->name('store');
        Route::get('/recipes/{recipeId}/reviews/{id}/edit', 'edit')->name('edit');
        Route::put('/reviews/{id}', 'update')->name('update');
        Route::delete('/recipes/{recipeId}/reviews/{id}', 'destroy')->name('destroy');
});

Route::name('foodtypes.')
    ->prefix('food-types')
    ->middleware('isAdmin', 'isNotBlacklisted')
    ->controller(FoodTypeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::name('blacklists.')
    ->prefix('blacklists')
    ->middleware('auth')
    ->controller(BlacklistController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');               
        Route::get('/create', 'create')->name('create');       
        Route::post('/', 'store')->name('store');              
        Route::delete('/delete/{userId}', 'delete')->name('delete');
});

require __DIR__.'/auth.php';