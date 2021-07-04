<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

# Public routes
Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

# Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::get('user',[UserController::class, 'index']);
	Route::get('user/{user}',[UserController::class, 'show']);
	Route::put('user/{user}',[UserController::class, 'update']);
	Route::delete('user/{user}',[UserController::class, 'destroy']);

	Route::get('logout',[AuthController::class, 'logout']);
});