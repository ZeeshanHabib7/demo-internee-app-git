<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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


//-------- Auth Routes --------
Route::post('login', [AuthController::class,'login']);
Route::post('signup', [AuthController::class,'signUp']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('me', [AuthController::class,'me']); //user route
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']); //token refresh route
});
Route::get('/users', [UserController::class, 'getAllUsers']);

