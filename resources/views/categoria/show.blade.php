@extends('layouts.app')

@section('content')
    <h2 class="text-4xl font-bold text-center mb-8">{{ $categoria->icono }} {{ $categoria->nombre }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productos as $producto)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="bg-gray-200 border-2 border-dashed rounded-t-lg w-full h-48 flex items-center justify-center">
                    <span class="text-gray-500">Imagen</span>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg h-16 overflow-hidden">{{ $producto->nombre }}</h3>
                    <p class="text-2xl font-bold text-blue-600 mt-4">S/. {{ number_format($producto->precio, 2) }}</p>
                    <p class="text-sm text-gray-600">Stock: {{ $producto->stock }}</p>
                    <a href="{{ route('productos.show', $producto->id) }}" class="block mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700">
                        Ver detalle
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $productos->links() }}
    </div>
@endsection