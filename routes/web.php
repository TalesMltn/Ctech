<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/categorias/{slug}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/servicio-tecnico', function () {
    return view('servicio');
})->name('servicio');

// Carrito completo
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito');

// Acciones del carrito
Route::get('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::get('/carrito/increase/{id}', [CarritoController::class, 'increase'])->name('carrito.increase');
Route::get('/carrito/decrease/{id}', [CarritoController::class, 'decrease'])->name('carrito.decrease');
Route::get('/carrito/remove/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');

// Logout de Filament
Route::post('/admin/logout', function (Request $request) {
    Filament::auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('filament.admin.auth.logout');