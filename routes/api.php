<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\RecruiterProfileController;
use App\Http\Controllers\RoleSelectionController;

// Public auth routes
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'ResetPassword']);
Route::post('/auth/check-username', [AuthController::class, 'checkUsername']);
Route::post('/user-identity-verification', [AuthController::class, 'userIdentityVerification']);

// Protected routes (require auth token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/user/select-role', [RoleSelectionController::class, 'selectRole']);
});

// Candidate routes
Route::middleware('auth:sanctum')->prefix('candidate')->group(function () {
    Route::post('/profile-setup', [CandidateProfileController::class, 'store']);
});

// Recruiter routes
Route::middleware('auth:sanctum')->prefix('recruiter')->group(function () {
    Route::post('/profile-setup', [RecruiterProfileController::class, 'store']);
    Route::apiResource('jobs', JobOfferController::class);
});