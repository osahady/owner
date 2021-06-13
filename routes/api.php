<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AdController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\LocationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1')->group(function ()
{
    //public routes
    Route::get('/ads',  [AdController::class, 'index']);
    Route::get('/cats/{cat}/ads',  [AdController::class, 'catAds']);
    Route::get('/cats/{cat}/users/{user}/ads',  [CategoryController::class, 'hisAds']);
    Route::get('/cats/{cat}/locs/{loc}/ads',  [CategoryController::class, 'catLocAds']);
    Route::get('/locs/{loc}/ads',  [LocationController::class, 'locAds']);
    Route::get('/cats',  [CategoryController::class, 'cats']);
});
