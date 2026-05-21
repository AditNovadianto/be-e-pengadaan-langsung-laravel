<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\LaporanController;

// Auth Routes (Public)
Route::post('/auth/user/register', [AuthController::class, 'registerUser']);
Route::post('/auth/user/login', [AuthController::class, 'loginUser']);
Route::post('/auth/penyedia/register', [AuthController::class, 'registerPenyedia']);
Route::post('/auth/penyedia/login', [AuthController::class, 'loginPenyedia']);

// Protected Routes (Require Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Get currently authenticated user/penyedia
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/penyedia', [AuthController::class, 'getAllPenyedia']);

    // API Resource Routes
    Route::apiResource('pengadaan', PengadaanController::class);
    Route::apiResource('progress', ProgressController::class);
    Route::apiResource('laporan', LaporanController::class);
});
