@extends('layouts.app')

@section('content')
    <section class="py-20">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-center text-green-400 mb-12 neon-glow">
                {{ $categoria->nombre }}
            </h1>

            <!-- Grid de productos de esta categoría -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($productos as $producto)
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden hover:shadow-neon transition-all duration-300 transform hover:scale-105">
                        <!-- Imagen del producto (CORREGIDO: usa imagen real) -->
                        <div class="relative h-64 bg-gray-700">
                            <img src="{{ $producto->imagen_url }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="w-full h-full object-cover">
                            <!-- Badge de categoría -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    {{ $categoria->nombre }}
                                </span>
                            </div>
                        </div>

                        <!-- Información -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 truncate">{{ $producto->nombre }}</h3>
                            <p class="text-3xl font-bold text-green-400 mb-6">
                                S/. {{ number_format($producto->precio, 2) }}
                            </p>
                            <p class="text-lg text-gray-300 mb-4">
                                <strong>Stock:</strong> {{ $producto->stock }} unidades
                            </p>

                            <!-- Botón Ver Detalle -->
                            <a href="{{ route('productos.show', $producto->id) }}" 
                               class="block w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white text-center py-4 rounded-lg font-bold text-lg transition hover:shadow-neon transform hover:scale-105">
                                Ver Detalle
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <i class="fas fa-box-open text-8xl text-gray-600 mb-6"></i>
                        <p class="text-3xl text-gray-400">No hay productos en esta categoría</p>
                        <p class="text-xl text-gray-500 mt-4">Pronto agregaremos más stock</p>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="mt-10">
                {{ $productos->links() }}
            </div>
        </div>
    </section>
@endsection