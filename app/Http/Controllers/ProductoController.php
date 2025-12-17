<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }
}