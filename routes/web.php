<?php

use App\Http\Controllers\{

    HomeController,
};

use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Public frontend pages
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/booking', [HomeController::class, 'booking'])->name('home.booking');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/services', [HomeController::class, 'services'])->name('home.services');
Route::get('/venues', [HomeController::class, 'venues'])->name('home.venues');


// Guest User Routes (Login & Register)
Route::prefix('user')->name('user.')->middleware('guest:web')->group(function () {
    // Login Routes
    Route::get('login', [UserLoginController::class, 'create'])->name('login');
    Route::post('login', [UserLoginController::class, 'store']);

    // Register Routes
    Route::get('register', [UserRegisterController::class, 'create'])->name('register');
    Route::post('register', [UserRegisterController::class, 'store']);
});

// Guest Admin Routes
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store']);
});



require __DIR__ . '/auth.php';
