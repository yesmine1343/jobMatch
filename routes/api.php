<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\RecruiterProfileController;
use App\Http\Controllers\RoleSelectionController;
use App\Http\Controllers\jobOfferController;

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
    Route::get('/user/candidate-profile', function (Request $request) {
        return $request->user()->candidateProfile;
    });
    Route::get('/user/recruiter-profile', function (Request $request) {
        return $request->user()->recruiterProfile;
    });
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/user/select-role', [RoleSelectionController::class, 'selectRole']);
});

// Candidate routes
Route::middleware('auth:sanctum')->prefix('candidate')->group(function () {
    Route::post('/profile-setup', [CandidateProfileController::class, 'store']);
    Route::get('/matches', [CandidateProfileController::class, 'getMatches']);
    Route::post('/matches', [CandidateProfileController::class, 'getMatches']);
    Route::get('jobs/index', [JobOfferController::class, 'index']);
    Route::get('/jobs/{id}', [CandidateProfileController::class, 'show']);


});

// Recruiter routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('recruiter/profile-setup', [RecruiterProfileController::class, 'store']);
    Route::prefix('recruiter')->group(function () {
            // POST & GET list must come BEFORE parameterized routes to avoid matching /index as {id}
            Route::post('jobs', [JobOfferController::class, 'store']);
            Route::get('jobs/index', [JobOfferController::class, 'index']);
            // Parameterized routes (specific job by ID) come AFTER list routes
            Route::get('jobs/{id}', [JobOfferController::class, 'show']);
            Route::put('jobs/{id}', [JobOfferController::class, 'update']);
            Route::delete('jobs/{id}', [JobOfferController::class, 'destroy']);
            Route::patch('jobs/{id}/status', [JobOfferController::class, 'updateStatus']);
    });
});
//username fetching route
Route::middleware('auth:sanctum')->get('/user/username', [UserController::class, 'getUsername']);
