<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::post('/', [IndexController::class, 'booking'])->name('store');
Route::get('/payment/{bookingId}', [PaymentController::class, 'show'])->name('payment.show'); // Payment page
Route::post('/payment/{bookingId}/complete', [PaymentController::class, 'complete'])->name('payment.complete'); // Process payment


Route::get('/invoice/{bookingId}', function ($bookingId) {
    $booking = \App\Models\Booking::findOrFail($bookingId);
    return view('invoice', compact('booking'));
})->name('invoice');


Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  ................ admin login , 

Route::middleware('guest:admin')->prefix('admin')->group(function () {

    Route::get('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'store']);

    // Route::get('register', [App\Http\Controllers\Auth\Admin\RegisterController::class, 'create'])->name('admin.register');
    // Route::post('register', [App\Http\Controllers\Auth\Admin\RegisterController::class, 'store']);

});

Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::post('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'destroy'])->name('admin.logout');

    Route::view('/dashboard', 'backend.admin_dashboard');

    Route::resource('event', EventController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('venue', VenueController::class);
    Route::resource('booking', BookingController::class);
});

require __DIR__ . '/auth.php';
