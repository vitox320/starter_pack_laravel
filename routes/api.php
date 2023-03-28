<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ParametersController;
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


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/me', [AuthController::class, 'me'])->middleware('abilities:user_list');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'filter'])->middleware('abilities:user_list');
        Route::patch('/{id}', [UserController::class, 'update'])->middleware('abilities:user_edit');
        Route::post('/', [UserController::class, 'store'])->middleware('abilities:user_create');
    });

    Route::prefix('parameters')->group(function () {
        Route::post('/', [ParametersController::class, 'store'])->middleware('abilities:parameter_create');
    });

});
