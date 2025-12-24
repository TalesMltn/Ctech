@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-4xl mx-auto">
        <!-- Botón Volver -->
        <a href="javascript:history.back()"
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold rounded-lg shadow-lg hover:shadow-neon transition transform hover:scale-105 duration-200 mb-8">
            <i class="fas fa-arrow-left mr-3"></i>
            Volver
        </a>
        
        <div class="grid md:grid-cols-2 gap-8 mt-8">
            <!-- Imagen del producto -->
            <div class="bg-gray-200 border-2 border-dashed rounded-lg w-full h-96 flex items-center justify-center overflow-hidden">
                <img src="{{ $producto->imagen_url }}" 
                     alt="{{ $producto->nombre }}" 
                     class="w-full h-full object-cover">
            </div>
            
            <!-- Información del producto -->
            <div>
                <h1 class="text-3xl font-bold mb-4 text-blue-800">{{ $producto->nombre }}</h1>
                <p class="text-gray-600 mb-6">Categoría: {{ $producto->categoria->nombre }}</p>
                <p class="text-4xl font-bold text-blue-600 mb-6">S/. {{ number_format($producto->precio, 2) }}</p>
                <p class="text-lg mb-8 text-gray-700">
                    <strong class="font-bold">Stock:</strong> {{ $producto->stock }} unidades disponibles
                </p>

                <!-- Botón Agregar al Carrito + Mensaje de éxito -->
                <div x-data="{ adding: false, success: false }">
                    <button 
                        type="button"
                        @click="
                            adding = true;
                            success = false;
                            Livewire.dispatch('agregarProductoUnico', [{{ $producto->id }}, '{{ addslashes($producto->nombre) }}', {{ $producto->precio }}, '{{ $producto->imagen ?? '' }}']);
                            setTimeout(() => { 
                                adding = false; 
                                success = true; 
                                setTimeout(() => success = false, 3000); 
                            }, 800);
                        "
                        :disabled="adding"
                        class="w-full bg-gradient-to-r from-green-500 to-green-400 
                               hover:from-green-600 hover:to-green-500 
                               py-5 rounded-lg font-bold text-xl text-white 
                               drop-shadow-md shadow-lg hover:shadow-neon 
                               transform hover:scale-105 transition duration-200 
                               flex items-center justify-center 
                               disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none">
                        
                        <!-- Estado normal -->
                        <span x-show="!adding && !success" x-transition>
                            <i class="fas fa-cart-plus mr-3"></i> Agregar al Carrito
                        </span>
                        
                        <!-- Cargando -->
                        <span x-show="adding" x-transition>
                            <i class="fas fa-spinner fa-spin mr-3"></i> Agregando...
                        </span>
                        
                        <!-- Éxito -->
                        <span x-show="success" x-transition class="flex items-center text-green-200">
                            <i class="fas fa-check-circle mr-3 text-green-300"></i> ¡Agregado!
                        </span>
                    </button>

                    <!-- Mensaje de éxito grande -->
                    <div 
                        x-show="success"
                        x-transition
                        class="mt-6 text-center text-green-800 font-bold text-xl bg-gradient-to-r from-green-100 to-green-200 
                               border-2 border-green-400 rounded-xl py-4 px-8 shadow-lg hover:shadow-neon transform hover:scale-105 transition duration-200">
                        <i class="fas fa-check-circle text-2xl mr-3 text-green-600"></i>
                        ¡Producto agregado al carrito con éxito! ✔️
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection