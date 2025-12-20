<div class="container mx-auto px-4 py-12">
    <h1 class="text-5xl font-bold text-center text-green-400 mb-12 neon-glow">Tu Carrito de Compras</h1>

    @if(count($cart) == 0)
        <div class="text-center py-20 bg-gray-800 rounded-xl">
            <i class="fas fa-shopping-cart text-8xl text-gray-600 mb-6"></i>
            <p class="text-3xl text-gray-400 mb-4">Tu carrito está vacío</p>
            <p class="text-xl text-gray-500 mb-8">Explora el catálogo y agrega productos</p>
            <a href="{{ route('home') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-bold text-xl transition hover:shadow-neon transform hover:scale-105">
                Seguir Comprando
            </a>
        </div>
    @else
        <div class="bg-gray-800 rounded-xl shadow-2xl p-8">
            <div class="space-y-6">
                @foreach($cart as $id => $item)
                    <div class="flex items-center bg-gray-900 rounded-lg p-6 hover:bg-gray-700 transition">
                        @if($item['image'])
                            <img src="{{ asset('storage/productos/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg mr-6">
                        @else
                            <div class="w-24 h-24 bg-gray-700 rounded-lg mr-6 flex items-center justify-center">
                                <i class="fas fa-box text-4xl text-gray-500"></i>
                            </div>
                        @endif

                        <div class="flex-1">
                            <h3 class="text-xl font-bold">{{ $item['name'] }}</h3>
                            <p class="text-gray-400">S/. {{ number_format($item['price'], 2) }}</p>
                        </div>

                        <!-- Controles de cantidad -->
                        <div class="flex items-center space-x-4 mr-6">
                            <button wire:click="decrease({{ $id }})" class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-full font-bold text-xl">
                                -
                            </button>
                            <span class="text-2xl font-bold w-16 text-center">{{ $item['quantity'] }}</span>
                            <button wire:click="increase({{ $id }})" class="bg-green-600 hover:bg-green-700 text-white w-10 h-10 rounded-full font-bold text-xl">
                                +
                            </button>
                        </div>

                        <p class="text-2xl font-bold text-green-400 mr-6">
                            S/. {{ number_format($item['price'] * $item['quantity'], 2) }}
                        </p>

                        <!-- Botón eliminar -->
                        <button wire:click="remove({{ $id }})" class="text-red-500 hover:text-red-400 text-3xl">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 border-t border-gray-700 pt-8">
                <div class="flex justify-between items-center mb-8">
                    <span class="text-3xl font-bold">Total:</span>
                    <span class="text-4xl font-bold text-green-400">
                        S/. {{ number_format($total, 2) }}
                    </span>
                </div>
                <div class="text-center">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-12 py-5 rounded-lg font-bold text-2xl transition hover:shadow-neon transform hover:scale-105">
                        Proceder al Pago
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>