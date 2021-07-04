<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;

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
	Route::apiResource('user',UserController::class);
	Route::apiResource('role',RoleController::class);

	Route::post('logout',[AuthController::class, 'logout']);
});