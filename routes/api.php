<?php

use App\Http\Controllers\ArrivalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
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

Route::prefix('user')->group(function (){
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/registration',[AuthController::class,'registration']);
});
Route::prefix('category')->group(function(){
    Route::get('/',[CategoryController::class,'index']);
    Route::get('/{id}',[CategoryController::class,'show']);
});
Route::prefix('equipment')->group(function(){
    Route::get('/',[EquipmentController::class,'index']);
    Route::get('/{id}',[EquipmentController::class,'show']);
});
Route::prefix('arrival')->group(function(){
    Route::get('/',[ArrivalController::class,'index']);
    Route::get('/{id}',[ArrivalController::class,'show']);
});

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('user')->group(function(){
        Route::get('/',[UserController::class,'get']);
        Route::get('/logout',[AuthController::class,'logout']);
    });
    Route::prefix('category')->group(function(){
        Route::post('/',[CategoryController::class,'store']);
        Route::put('/{id}',[CategoryController::class,'update']);
        Route::delete('/{id}',[CategoryController::class,'destroy']);
    });
    Route::prefix('equipment')->group(function(){
        Route::post('/',[EquipmentController::class,'store']);
        Route::put('/{id}',[EquipmentController::class,'update']);
        Route::delete('/{id}',[EquipmentController::class,'destroy']);
    });
    Route::prefix('arrival')->group(function(){
        Route::post('/',[ArrivalController::class,'store']);
        Route::put('/{id}',[ArrivalController::class,'update']);
        Route::delete('/{id}',[ArrivalController::class,'destroy']);
    });
});

