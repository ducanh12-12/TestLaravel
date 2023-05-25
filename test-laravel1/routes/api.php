<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoachController;
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

Route::group(['prefix' => '/web', 'middleware' => ['web']], function () {
    Route::group(['middleware' => 'api','prefix'=> 'auth'], function() {
        Route::post('/login',[AuthController::class,'login']);
        Route::post('register',[AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::get('users',[UserController::class,'index']);
    Route::post('users',[UserController::class,'create']);
    Route::get('users/{id}',[UserController::class,'show']);

    Route::resource('coaches',CoachController::class);
    Route::resource('messages',MessageController::class);
});
