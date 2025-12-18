<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categorias/{slug}', [CategoriaController::class, 'show'])->name('categorias.show');

Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Ruta personalizada para logout de Filament → redirige al home
Route::post('/admin/logout', function (Request $request) {
    Filament::auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('filament.admin.auth.logout');