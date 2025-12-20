<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra la lista de todos los productos (catálogo general)
     */
    public function index()
    {
        $productos = Producto::all(); // Puedes agregar ->orderBy('nombre') o paginación después
        return view('producto.index', compact('productos'));
    }

    /**
     * Muestra el detalle de un producto específico
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }
}