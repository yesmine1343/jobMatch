<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//ie
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OpenAIController;
//ie


//ie
Route::post('/auth/login', [AuthController::class, 'login']);
//ie


Route::post('/auth/forgot-password',[AuthController::class,'forgotPassword']);

Route::post('/auth/register',[AuthController::class,'register']);

Route::post('/auth/check-username',[AuthController::class,'checkUsername']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::post('/auth/reset-password', [AuthController::class, 'ResetPassword']);
//zerobounce email is real or not verification 
Route::post('/email-submit', [AuthController::class, 'handleEmail']); 
//user identity verification
Route::post('/user-identity-verification', [AuthController::class, 'userIdentityVerification']);