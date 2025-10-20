<?php

use App\Http\Controllers\Api\LicenseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// use App\Http\Controllers\Api\LicenseApiController;

Route::post('/verify-license', [LicenseApiController::class, 'verify']);
// Route::get('/verify-license', [LicenseApiController::class, 'verify']);
