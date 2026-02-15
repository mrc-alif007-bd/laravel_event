<?php

use App\Http\Controllers\{
    BookingController,
    CategoryController,
    EventController,
    IndexController,
    PaymentController,
    ProfileController,
    UserController,
    VenueController
};
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
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

// Public Routes
Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/venue', 'venue')->name('venue');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/services', 'services')->name('services');
    Route::get('/blog', 'blog')->name('blog');
    Route::post('/', 'booking')->name('booking.store');
});

// Payment Routes
Route::prefix('payment')->name('payment.')->controller(PaymentController::class)->group(function () {
    Route::get('/{bookingId}', 'show')->name('show');
    Route::post('/{bookingId}/complete', 'complete')->name('complete');
});

// Invoice Route
Route::get('/invoice/{bookingId}', function ($bookingId) {
    $booking = \App\Models\Booking::findOrFail($bookingId);
    return view('invoice', compact('booking'));
})->name('invoice');

// Guest Admin Routes
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

// Guest User Routes (Login & Register)
Route::prefix('user')->name('user.')->middleware('guest:web')->group(function () {
    // Login Routes
    Route::get('login', [UserLoginController::class, 'create'])->name('login');
    Route::post('login', [UserLoginController::class, 'store']);

    // Register Routes
    Route::get('register', [UserRegisterController::class, 'create'])->name('register');
    Route::post('register', [UserRegisterController::class, 'store']);
});

// Authenticated User Routes (Profile & Dashboard)
Route::middleware('auth:web')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('backend.dashboard'))->name('dashboard');
    Route::get('/user/dashboard', fn() => view('backend.dashboard'))->name('user.dashboard');
    Route::get('/user/my-bookings', [BookingController::class, 'myBookings'])->name('user.bookings');

    // Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // User Logout
    Route::post('/user/logout', [UserLoginController::class, 'destroy'])->name('user.logout');
});

Route::patch('admin/venue/{id}/toggle-status', [VenueController::class, 'toggleStatus'])->name('admin.venue.toggle-status');
// Authenticated Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', fn() => view('backend.admin_dashboard'))->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Resource Routes
    Route::resources([
        'event' => EventController::class,
        'category' => CategoryController::class,
        'venue' => VenueController::class,
        'booking' => BookingController::class
    ]);
});

require __DIR__ . '/auth.php';
