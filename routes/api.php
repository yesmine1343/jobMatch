<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//ie
use App\Http\Controllers\Api\AuthController;
//ie


//ie
Route::post('/auth/login', [AuthController::class, 'login']);
//ie


Route::post('/auth/forgot-password',[AuthController::class,'forgotPassword']);

Route::post('/auth/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
This automatically creates:
- GET /api/jobs → index()
- POST /api/jobs → store()
- GET /api/jobs/{id} → show()
- PUT/PATCH /api/jobs/{id} → update()
- DELETE /api/jobs/{id} → destroy()
*/ 