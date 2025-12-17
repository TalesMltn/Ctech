<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show($slug)
    {
        $categoria = Categoria::where('slug', $slug)->firstOrFail();
        $productos = $categoria->productos()->paginate(12); // 12 productos por página
        return view('categoria.show', compact('categoria', 'productos'));
    }
}