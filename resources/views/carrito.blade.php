@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-5xl font-bold text-center text-green-400 mb-12 neon-glow">Tu Carrito de Compras</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <livewire:cart-items />
        @else
            <div class="text-center py-20 bg-gray-800 rounded-xl">
                <i class="fas fa-shopping-cart text-8xl text-gray-600 mb-6"></i>
                <p class="text-3xl text-gray-400 mb-4">Tu carrito está vacío</p>
                <p class="text-xl text-gray-500 mb-8">Explora el catálogo y agrega productos</p>
                <a href="{{ route('home') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-bold text-xl transition hover:shadow-neon transform hover:scale-105">
                    Seguir Comprando
                </a>
            </div>
        @endif
    </div>
@endsection