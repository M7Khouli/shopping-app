<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

//user routes
Route::post('/user/register',[AuthController::class,'register']);
Route::post('/user/login',[AuthController::class,'login']);


//products routes
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/product',[ProductController::class,'index']);
    Route::get('/product/{id}',[ProductController::class,'show']);
    Route::post('/product',[ProductController::class,'store']);
    Route::put('/product/{id}',[ProductController::class,'update']);
    Route::delete('/product/{id}',[ProductController::class,'destroy']);
});

Route::get('/product/img/{id}',[ProductController::class,'getImage']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
