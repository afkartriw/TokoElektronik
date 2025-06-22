<?php

use App\Http\Controllers\ProdukController;

Route::get('/', [ProdukController::class, 'index']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::put('/produk/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);
Route::get('/produk/export/pdf', [ProdukController::class, 'exportPdf']);
Route::get('/produk/export/xlsx', [ProdukController::class, 'exportXlsx']);
