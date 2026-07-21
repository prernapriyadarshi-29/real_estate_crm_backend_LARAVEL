<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;

Route::get('/admin/properties', [PropertyController::class, 'index']);
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/properties/{id}', [PropertyController::class, 'show']);
Route::post('/admin/properties/{id}/approve', [PropertyController::class, 'approve']);
Route::post('/admin/properties/{id}/reject', [PropertyController::class, 'reject']);