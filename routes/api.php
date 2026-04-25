<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Route as RouteModel;

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

Route::middleware(['throttle:api'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('bus', [BusController::class, 'index']);
    Route::get('bus/{bus}', [BusController::class, 'show']);

    Route::get('route', [RouteController::class, 'index']);
    Route::get('route/{route}', [RouteController::class, 'show']);
});

Route::middleware(['throttle:api', 'check.token', 'auth:sanctum',])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
