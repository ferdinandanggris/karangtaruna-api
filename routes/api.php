<?php

use App\Http\Controllers\Api\KasController;
use App\Http\Controllers\Api\TransaksiKasController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('transaksi-kas', [TransaksiKasController::class, 'index']);
Route::put('transaksi-kas/{id}', [TransaksiKasController::class, 'update']);
Route::get('transaksi-kas/{id}', [TransaksiKasController::class, 'show']);
Route::post('transaksi-kas', [TransaksiKasController::class, 'store']);
Route::delete('transaksi-kas/{id}', [TransaksiKasController::class, 'destroy']);

Route::get('kas', [KasController::class, 'index']);;
