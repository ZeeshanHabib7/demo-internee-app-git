<?php


use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\PermissionController_SA;
use App\Http\Controllers\RolesController_SA;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController_SA;
use App\Http\Controllers\LoginRegisterControllers;
use App\Http\Controllers\ProductController;



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




// Route::get('/products', [ProductController::class, 'index']);



Route::post('/users/register', [LoginRegisterControllers::class, 'register']);
Route::post('/users/login', [LoginRegisterControllers::class, 'login']);

//PROTECTED ROUTES

// FOR Admins and Users both
Route::middleware(['AuthGuard', 'RestrictTo:user,admin'])->group(function () {
    Route::get('/products/get-filter-data', [ProductsController_SA::class, 'getData']);
});

//FOR Users Only
Route::middleware(['AuthGuard', 'RestrictTo:user'])->group(function () {
    Route::post('/products/add-to-cart', [AddToCartController::class, 'store'])->middleware('CheckEncryption');
});

//FOR Admins Only
Route::middleware(['AuthGuard', 'RestrictTo:admin'])->group(function () {

    Route::post('/products', [ProductsController_SA::class, 'store'])->middleware('PermissionCheck:product.store');
    Route::get('/products/{id}', [ProductsController_SA::class, 'show'])->middleware('PermissionCheck:product.view');
    Route::put('/products/{id}', [ProductsController_SA::class, 'update'])->middleware('PermissionCheck:product.update');
    Route::delete('/products/{id}', [ProductsController_SA::class, ''])->middleware('PermissionCheck:product.delete');
    Route::post('/products/restore/{id}', [ProductsController_SA::class, 'restore'])->middleware('PermissionCheck:product.restore');
    Route::delete('/products/permanent-delete/{id}', [ProductsController_SA::class, 'permanentDelete'])->middleware('PermissionCheck:product.permanentDelete');


    Route::apiResource('permissions', PermissionController_SA::class);
    Route::apiResource('roles', RolesController_SA::class);

});


//Routes only made for checking the encrypted decrypted data
Route::post('/encrypt', [AddToCartController::class, 'encrypt']);
Route::post('/decrypt', [AddToCartController::class, 'decrypt']);

Route::get('all', [UserController::class, 'getAllUsers']);








