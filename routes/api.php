<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Функции гостя
Route::middleware(['throttle:api'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('bus', [BusController::class, 'index']);
    Route::get('bus/{bus}', [BusController::class, 'show']);

    Route::get('route', [RouteController::class, 'index']);
    Route::get('route/{route}', [RouteController::class, 'show']);
});

// Функции зарегистрированного
Route::middleware(['throttle:api', 'check.token'])->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // Управление автобусами (диспетчер + админ)
    Route::post('bus', [BusController::class, 'store'])->middleware('role:dispatcher,admin');
    Route::put('bus', [BusController::class, 'update'])->middleware('role:dispatcher,admin');
    Route::delete('bus', [BusController::class, 'destroy'])->middleware('role:dispatcher,admin');

    // Управление маршрутами (диспетчер + админ)
    Route::post('route', [RouteController::class, 'store'])->middleware('role:dispatcher,admin');
    Route::put('route', [RouteController::class, 'update'])->middleware('role:dispatcher,admin');
    Route::delete('route', [RouteController::class, 'destroy'])->middleware('role:dispatcher,admin');

    // Управление рейсами (диспетчер + админ)
    Route::get('trip', [TripController::class, 'index'])->middleware('role:dispatcher,admin');
    Route::get('trip/{trip}', [TripController::class, 'show'])->middleware('role:dispatcher,admin');
    Route::post('trip', [TripController::class, 'store'])->middleware('role:dispatcher,admin');
    Route::put('trip', [TripController::class, 'update'])->middleware('role:dispatcher,admin');
    Route::delete('trip', [TripController::class, 'destroy'])->middleware('role:dispatcher,admin');


    // Функции администратора
    Route::prefix('user')->middleware('role:admin')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'destroy']);
    });
    Route::put('password', [UserController::class, 'changePassword'])->middleware('role:admin');
});
