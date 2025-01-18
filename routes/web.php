<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, "create"])->middleware("auth");

// Store listing form
Route::post('/listings', [ListingController::class, "store"])->middleware("auth");

// Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, "edit"])->middleware("auth");

// Edit Submit listing form
Route::put('/listings/{listing}', [ListingController::class, "update"])->middleware("auth");

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, "destroy"])->middleware("auth");

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, "show"]);

// Show Register form
Route::get('/register', [UserController::class, "create"])->middleware("guest");

// Register new user
Route::post('/users', [UserController::class, "store"])->middleware("guest");

// Log user out
Route::post('/logout', [UserController::class, "logout"])->middleware("auth");

// Show Login form
Route::get('/login', [UserController::class, "login"])->name('login')->middleware("guest");

// Login user
Route::post('/users/authenticate', [UserController::class, "authenticate"]);