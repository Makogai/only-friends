<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);

##### REGISTER #####
Route::group([
    'prefix' => 'register'
], function () {
    Route::post("/", [AuthController::class, 'register']);
    Route::get("/data", [AuthController::class, 'getRegistrationData']);
    Route::post("/update", [AuthController::class, 'updateRegistration']);
});

##### LOGIN #####
Route::post("/login", [AuthController::class, 'login']);
Route::post('/refresh-access-token', [AuthController::class, 'refreshAccessToken']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
Route::post('/set-new-password', [ResetPasswordController::class, 'setNewPassword']);

##### AUTH #####
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post("/logout", [AuthController::class, 'logout']);

    ##### USER #####
    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get("/", [UserController::class, 'getUser']);
        Route::post("/update", [UserController::class, 'updateUser']);
        Route::post("/change-password", [UserController::class, 'changePassword']);
    });
});
