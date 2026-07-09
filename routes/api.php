<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication Routes
Route::post('/register', [AuthController::class, 'register'])->name ('register');
Route::post('/login', [AuthController::class, 'login'])->name ('login');

Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Property Routes (Protected - User must be logged in)
    Route::middleware('auth:sanctum')->group(function () {
    // Get all properties of logged-in user
    Route::get('/properties', [PropertyController::class, 'index']);
    
    // Create a new property
    Route::post('/properties', [PropertyController::class, 'store']);
    
    // Get single property
    Route::get('/properties/{id}', [PropertyController::class, 'show']);
    
    // Update property
    Route::put('/properties/{id}', [PropertyController::class, 'update']);
    
    // Delete property
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);
});

    // Property CRUD
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::get('/properties/{property}', [PropertyController::class, 'show']);
    Route::put('/properties/{property}', [PropertyController::class, 'update']);
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);

});

// Lead Routes (Protected - User must be logged in)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/leads', [LeadController::class, 'index']);
    Route::post('/leads', [LeadController::class, 'store']);
    Route::get('/leads/{id}', [LeadController::class, 'show']);
    Route::put('/leads/{id}', [LeadController::class, 'update']);
    Route::delete('/leads/{id}', [LeadController::class, 'destroy']);
});

// Customer Routes (Protected - User must be logged in)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
});

// Profile Routes (Protected - User must be logged in)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
});