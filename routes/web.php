<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ProjectController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service/{slug}', [HomeController::class, 'service'])->name('service.show');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/callback', [BookingController::class, 'callback'])->name('booking.callback');

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login'); // Name 'login' required for auth middleware redirect
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('services', ServiceController::class);
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('banners', BannerController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('projects', ProjectController::class);
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
