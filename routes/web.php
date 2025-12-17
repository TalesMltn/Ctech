<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categorias/{slug}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');