<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Lista general de productos (catálogo principal)
Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');

// Detalle de un producto específico
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Mostrar categoría por slug (con sus productos)
Route::get('/categorias/{slug}', [CategoriaController::class, 'show'])->name('categorias.show');

// Página de Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Página de Servicio Técnico
Route::get('/servicio-tecnico', function () {
    return view('servicio');
})->name('servicio');

// Ruta personalizada para logout de Filament → redirige al home
Route::post('/admin/logout', function (Request $request) {
    Filament::auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('filament.admin.auth.logout');