<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, "create"]);

// Store listing form
Route::post('/listings', [ListingController::class, "store"]);

// Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, "edit"]);

// Edit Submit listing form
Route::put('/listings/{listing}', [ListingController::class, "update"]);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, "show"]);
