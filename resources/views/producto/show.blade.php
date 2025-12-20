@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto">
        <!-- Botón Volver mejorado -->
        <a href="javascript:history.back()"
        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold rounded-lg shadow-lg hover:shadow-neon transition transform hover:scale-105 duration-200 mb-8">
         <i class="fas fa-arrow-left mr-3"></i>
         Volver
     </a>
        
        <div class="grid md:grid-cols-2 gap-8 mt-8">
            <!-- Imagen del producto -->
            <div class="bg-gray-200 border-2 border-dashed rounded-lg w-full h-96 flex items-center justify-center overflow-hidden">
                @if($producto->imagen)
                    <img src="{{ asset('storage/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                @else
                    <span class="text-2xl text-gray-500">Imagen del producto</span>
                @endif
            </div>
            
            <!-- Información del producto -->
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $producto->nombre }}</h1>
                <p class="text-gray-600 mb-6">Categoría: {{ $producto->categoria->nombre }}</p>
                <p class="text-4xl font-bold text-blue-600 mb-6">S/. {{ number_format($producto->precio, 2) }}</p>
                <p class="text-lg mb-8"><strong>Stock:</strong> {{ $producto->stock }} unidades disponibles</p>

                <!-- Botón corregido con onclick + Livewire.dispatch -->
                <button 
                    onclick="Livewire.dispatch('addToCart', [{{ $producto->id }}, '{{ addslashes($producto->nombre) }}', {{ $producto->precio }}, '{{ $producto->imagen ?? '' }}'])"
                    class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 py-5 rounded-lg font-bold text-xl text-white transition hover:shadow-neon transform hover:scale-105 flex items-center justify-center shadow-lg cursor-pointer">
                    <i class="fas fa-cart-plus mr-3"></i>
                    Agregar al Carrito
                </button>
            </div>
        </div>
    </div>

    <!-- Componente invisible para escuchar el evento -->
    @livewire('add-to-cart')
@endsection