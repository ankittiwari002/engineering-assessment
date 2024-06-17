<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\UserAuthController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('/api',function(){
    return "Test api";
});
Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('store',[APIController::class,'store'])->middleware('auth:sanctum');
Route::get('getById/{id}',[APIController::class,'getById'])->middleware('auth:sanctum');
Route::get('getAll',[APIController::class,'getAll'])->middleware('auth:sanctum');
Route::post('deleteById/{id}',[APIController::class,'deleteById'])->middleware('auth:sanctum');
Route::post('update',[APIController::class,'update'])->middleware('auth:sanctum');
