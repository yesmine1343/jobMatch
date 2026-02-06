<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/app/');
});

Route::get('/app/{any?}', function () {

    return view('app');
})->where('any', '.*');

/* 
Catches any URL under /app
Prevents 404 when user refreshes or pastes a URL
Hands control back to Vue Router
*/

Route::apiResource('jobs', JobController::class);