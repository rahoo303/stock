<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/getItemMaster', [ItemController::class, 'getItemMaster']);
    Route::get('/searchItem', [ItemController::class, 'searchItem']);
    Route::get('/getSales', [SalesController::class, 'getSales']);
    Route::resource('items',ItemController::class);
    Route::post('/createSales', [SalesController::class, 'createSale']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::post('/login', [LoginController::class, 'login']);
 