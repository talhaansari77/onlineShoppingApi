<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductVariantsController;

// msg for unkown user
Route::get("Info", function () {
    return ("<h1>Please Register To Access This Page</h1>");
})->name("login");
// for user registration and auth
Route::post("signup", [UserController::class, "register"]);
Route::post("login", [UserController::class, "authenticate"]);

Route::middleware(['auth:sanctum', 'verified'])->group(static function () {
    Route::get("users", [UserController::class, "index"]);
    Route::post('logout', [UserController::class, 'logout']);
    // product management
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('discounts', DiscountsController::class);
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('orders', CategoriesController::class);
    Route::apiResource('orderDetails', CategoriesController::class);
    
});


// Route::resource('categories', CategoriesController::class);
// Route::resource('products', ProductsController::class);
// Route::resource('colors', ColorsController::class);
// Route::resource('sizes', SizesController::class);
// Route::resource('productVariants', ProductVariantsController::class);
// Route::resource('discounts', DiscountsController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
