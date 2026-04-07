<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// ==============================================
// AUTH CONTROLLERS
// ==============================================
use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\User\RegisterController as UserRegisterController;

// ==============================================
// ADMIN CONTROLLERS
// ==============================================
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    UserController as AdminUserController,
    EventController as AdminEventController,
    VenueController as AdminVenueController,
    BookingController as AdminBookingController,
    PaymentController as AdminPaymentController,
    ReviewController as AdminReviewController,
    CouponController as AdminCouponController,
    ProfileController as AdminProfileController,
};

// ==============================================
// USER CONTROLLERS
// ==============================================
use App\Http\Controllers\User\{
    DashboardController as UserDashboardController,
    ProfileController as UserProfileController,
    EventController as UserEventController,
    BookingController as UserBookingController,
    PaymentController as UserPaymentController,
    ReviewController as UserReviewController
};

// ==============================================
// PUBLIC / GUEST ROUTES
// ==============================================
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/blog', [HomeController::class, 'blog'])->name('home.blog');
Route::get('/booking', [HomeController::class, 'booking'])->name('home.booking');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/services', [HomeController::class, 'services'])->name('home.services');
Route::get('/venues', [HomeController::class, 'venues'])->name('home.venues');
Route::get('/events', [HomeController::class, 'venues'])->name('events.index');
Route::get('/event/{id}', [HomeController::class, 'showEvent'])->name('events.show');

// ==============================================
// BOOKING & PAYMENT ROUTES (PUBLIC)
// ==============================================
Route::post('/event/book/{id}', [App\Http\Controllers\BookingController::class, 'store'])->name('events.book');
Route::get('/payment/{bookingId}', [App\Http\Controllers\BookingController::class, 'paymentPage'])->name('payment.page');
Route::post('/payment/process/{bookingId}', [App\Http\Controllers\BookingController::class, 'processDummyPayment'])->name('payment.process');
Route::get('/booking/confirmation/{bookingId}', [App\Http\Controllers\BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/booking/ticket/{bookingId}', [App\Http\Controllers\BookingController::class, 'showDigitalTicket'])->name('booking.ticket');
Route::get('/booking/ticket/{bookingId}/download', [App\Http\Controllers\BookingController::class, 'downloadTicket'])->name('ticket.download');

// ==============================================
// GUEST USER ROUTES (LOGIN & REGISTER)
// ==============================================
Route::prefix('user')->name('user.')->middleware('guest:web')->group(function () {
    Route::get('login', [UserLoginController::class, 'create'])->name('login');
    Route::post('login', [UserLoginController::class, 'store']);
    Route::get('register', [UserRegisterController::class, 'create'])->name('register');
    Route::post('register', [UserRegisterController::class, 'store']);
});

// ==============================================
// GUEST ADMIN ROUTES
// ==============================================
Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

// ==============================================
// AUTHENTICATED ADMIN ROUTES
// ==============================================
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Management Resources
    Route::resource('users', AdminUserController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('venues', AdminVenueController::class);
    Route::resource('bookings', AdminBookingController::class);
    Route::resource('payments', AdminPaymentController::class);
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'show', 'destroy']);
    Route::resource('coupons', AdminCouponController::class);

    // Admin Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'index'])->name('index');
        Route::get('/edit', [AdminProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [AdminProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [AdminProfileController::class, 'changePasswordForm'])->name('change-password');
        Route::post('/update-password', [AdminProfileController::class, 'updatePassword'])->name('update-password');
        Route::delete('/remove-avatar', [AdminProfileController::class, 'removeAvatar'])->name('remove-avatar');
        Route::post('/update-notifications', [AdminProfileController::class, 'updateNotifications'])->name('update-notifications');
        Route::get('/activity', [AdminProfileController::class, 'activityLog'])->name('activity');
    });
});

// ==============================================
// AUTHENTICATED USER ROUTES
// ==============================================
Route::prefix('user')->name('user.')->middleware(['auth:web'])->group(function () {
    Route::post('logout', [UserLoginController::class, 'destroy'])->name('logout');
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // User Resources
    Route::resource('events', UserEventController::class)->only(['index', 'show']);
    Route::resource('bookings', UserBookingController::class)->except(['edit', 'update', 'destroy']);
    Route::resource('payments', UserPaymentController::class)->only(['index', 'show']);
    Route::resource('reviews', UserReviewController::class)->except(['edit', 'update']);

    // User Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('index');
        Route::get('/edit', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [UserProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [UserProfileController::class, 'changePasswordForm'])->name('change-password');
        Route::post('/update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');
        Route::delete('/remove-avatar', [UserProfileController::class, 'removeAvatar'])->name('remove-avatar');
        Route::post('/update-notifications', [UserProfileController::class, 'updateNotifications'])->name('update-notifications');
        Route::get('/activity', [UserProfileController::class, 'activityLog'])->name('activity');
    });
});

// ==============================================
// ADDITIONAL AUTH ROUTES
// ==============================================
require __DIR__ . '/auth.php';
