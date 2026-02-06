<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

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