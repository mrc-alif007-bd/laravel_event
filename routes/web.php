<?php

use App\Http\Controllers\{
    HomeController
};

// Auth controllers
use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;

// Admin controllers
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    UserController as AdminUserController,
    EventController as AdminEventController,
    VenueController as AdminVenueController,
    BookingController as AdminBookingController,
    PaymentController as AdminPaymentController,
    ReviewController as AdminReviewController,
    CouponController as AdminCouponController
};

// User controllers
use App\Http\Controllers\User\{
    DashboardController as UserDashboardController,
    UserController as UserProfileController,
    EventController as UserEventController,
    BookingController as UserBookingController,
    PaymentController as UserPaymentController,
    ReviewController as UserReviewController
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
|
| Pages that anyone can access without login
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/booking', [HomeController::class, 'booking'])->name('home.booking');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/services', [HomeController::class, 'services'])->name('home.services');
Route::get('/venues', [HomeController::class, 'venues'])->name('home.venues');

/*
|--------------------------------------------------------------------------
| Guest User Routes (Login & Register)
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->middleware('guest:web')->group(function () {
    // Login
    Route::get('login', [UserLoginController::class, 'create'])->name('login');
    Route::post('login', [UserLoginController::class, 'store']);

    // Register
    Route::get('register', [UserRegisterController::class, 'create'])->name('register');
    Route::post('register', [UserRegisterController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Guest Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {

    // Admin Dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Users Management
    Route::resource('users', AdminUserController::class);

    // Events Management
    Route::resource('events', AdminEventController::class);

    // Venues Management
    Route::resource('venues', AdminVenueController::class);

    // Bookings Management
    Route::resource('bookings', AdminBookingController::class);

    // Payments Management
    Route::resource('payments', AdminPaymentController::class);

    // Reviews Management
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'show', 'destroy']);

    // Coupons Management
    Route::resource('coupons', AdminCouponController::class);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->middleware(['auth:web'])->group(function () {

    // User Dashboard
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // User Profile
    Route::resource('profile', UserProfileController::class)->only(['index', 'edit', 'update']);

    // Events (view only)
    Route::resource('events', UserEventController::class)->only(['index', 'show']);

    // Bookings
    Route::resource('bookings', UserBookingController::class)->except(['edit', 'update', 'destroy']);

    // Payments
    Route::resource('payments', UserPaymentController::class)->only(['index', 'show']);

    // Reviews
    Route::resource('reviews', UserReviewController::class)->except(['edit', 'update']);
});

require __DIR__ . '/auth.php';
