<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/produto', [ProdutoController::class, 'index']);
Route::get('/produto/{id}', [ProdutoController::class, 'show']);
Route::post('/produto', [ProdutoController::class, 'store']);
Route::put('/produto/{id}', [ProdutoController::class, 'update']);
Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']);


Route::get('/vendedor', [VendedorController::class, 'index']);
Route::get('/vendedor/{id}', [VendedorController::class, 'show']);
Route::post('/vendedor', [VendedorController::class, 'store']);
Route::put('/vendedor/{id}', [VendedorController::class, 'update']);
Route::delete('/vendedor/{id}', [VendedorController::class, 'destroy']);