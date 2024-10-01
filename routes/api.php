<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/produks', [ProdukController::class, 'index']);
// Route::post('/produks', [ProdukController::class, 'store']);
// Route::get('/produks/{id}', [ProdukController::class, 'show']);
// Route::put('/produks/{id}', [ProdukController::class, 'update']);
// Route::delete('/produks/{id}', [ProdukController::class, 'destroy']);

Route::resource('produks', ProdukController::class);
Route::resource('transaksi', TransaksiController::class);
Route::patch('/transaksi/{id}/cancel', [TransaksiController::class, 'cancel']);