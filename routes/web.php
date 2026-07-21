<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\UserController;


Route::get('/admin/properties', [PropertyController::class, 'index']);
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/properties/{id}', [PropertyController::class, 'show']);
Route::post('/admin/properties/{id}/approve', [PropertyController::class, 'approve']);
Route::post('/admin/properties/{id}/reject', [PropertyController::class, 'reject']);

Route::get('/properties/{id}/book', [BookingController::class, 'create']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::get('/admin/agents', [App\Http\Controllers\admin\AgentController::class, 'index']);
Route::get('/admin/agents/{id}', [App\Http\Controllers\admin\AgentController::class, 'show']);

Route::get('/admin/agents', [App\Http\Controllers\admin\AgentController::class, 'index']);
Route::get('/admin/agents/{id}', [App\Http\Controllers\admin\AgentController::class, 'show']);
Route::post('/admin/agents/{id}/approve', [App\Http\Controllers\admin\AgentController::class, 'approve']);
Route::post('/admin/agents/{id}/reject', [App\Http\Controllers\admin\AgentController::class, 'reject']);

// Users Management
Route::get('/admin/users', [UserController::class, 'index']);
Route::get('/admin/users/{id}', [UserController::class, 'show']);
Route::post('/admin/users/{id}/block', [UserController::class, 'block']);
Route::post('/admin/users/{id}/activate', [UserController::class, 'activate']);