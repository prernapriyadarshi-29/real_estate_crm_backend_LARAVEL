<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\PropertyController as PublicPropertyController;

// PUBLIC HOME PAGE
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/properties/{id}', [App\Http\Controllers\HomeController::class, 'show'])
    ->name('properties.show');

Route::get('/admin/properties', [PropertyController::class, 'index']);
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/properties/{id}', [PropertyController::class, 'show']);
Route::post('/admin/properties/{id}/approve', [PropertyController::class, 'approve']);
Route::post('/admin/properties/{id}/reject', [PropertyController::class, 'reject']);
Route::post('/admin/properties/{id}/mark-featured', [PropertyController::class, 'markFeatured']);
Route::post('/admin/properties/{id}/unmark-featured', [PropertyController::class, 'unmarkFeatured']);

Route::get('/properties/{id}/book', [BookingController::class, 'create']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);

Route::get('/admin/agents', [App\Http\Controllers\admin\AgentController::class, 'index']);
Route::get('/admin/agents/{id}', [App\Http\Controllers\admin\AgentController::class, 'show']);
Route::post('/admin/agents/{id}/approve', [App\Http\Controllers\admin\AgentController::class, 'approve']);
Route::post('/admin/agents/{id}/reject', [App\Http\Controllers\admin\AgentController::class, 'reject']);
Route::post('/admin/agents/{id}/activate', [App\Http\Controllers\admin\AgentController::class, 'activate']);
Route::post('/admin/agents/{id}/deactivate', [App\Http\Controllers\admin\AgentController::class, 'deactivate']);

Route::get('/admin/customers', [CustomerController::class, 'index']);
Route::get('/admin/customers/{id}', [CustomerController::class, 'show']);
Route::post('/admin/customers/{id}/block', [CustomerController::class, 'block']);
Route::post('/admin/customers/{id}/activate', [CustomerController::class, 'activate']);

Route::get('/admin/bookings', [BookingController::class, 'index']);
Route::get('/admin/bookings/{id}', [BookingController::class, 'show']);
Route::post('/admin/bookings/{id}/approve', [BookingController::class, 'approve']);
Route::post('/admin/bookings/{id}/cancel', [BookingController::class, 'cancel']);

// AUTH ROUTES
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

// PUBLIC BOOKING ROUTES (Protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/properties/{id}/book', [App\Http\Controllers\BookingController::class, 'create']);
Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store']);
Route::get('/bookings/{id}', [App\Http\Controllers\BookingController::class, 'show']);
    Route::get('/my-bookings', [App\Http\Controllers\BookingController::class, 'myBookings']);
});