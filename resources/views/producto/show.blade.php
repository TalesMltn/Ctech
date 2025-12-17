@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto">
        <a href="javascript:history.back()" class="text-blue-600 mb-4 inline-block">&larr; Volver</a>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-gray-200 border-2 border-dashed rounded-lg w-full h-96 flex items-center justify-center">
                <span class="text-2xl text-gray-500">Imagen del producto</span>
            </div>
            
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $producto->nombre }}</h1>
                <p class="text-gray-600 mb-6">Categoría: {{ $producto->categoria->nombre }}</p>
                <p class="text-4xl font-bold text-blue-600 mb-6">S/. {{ number_format($producto->precio, 2) }}</p>
                <p class="text-lg mb-4"><strong>Stock:</strong> {{ $producto->stock }} unidades</p>
                <button class="bg-green-600 text-white px-8 py-4 rounded-lg text-xl font-semibold hover:bg-green-700 w-full">
                    🛒 Agregar al Carrito
                </button>
            </div>
        </div>
    </div>
@endsection