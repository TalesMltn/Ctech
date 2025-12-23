<div>
    <!-- Header -->
    <div class="p-4 border-b border-gray-700 flex justify-between items-center bg-gray-900">
        <div>
            <h3 class="text-xl font-bold text-white">Tu Carrito</h3>
            <p class="text-sm text-gray-400">{{ count($cart) }} productos</p>
        </div>
        <button @click="$parent.open = false" class="text-gray-400 hover:text-white text-lg transition">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Lista de items -->
    <div class="max-h-96 overflow-y-auto">
        @if(count($cart) === 0)
            <div class="text-center py-12">
                <i class="fas fa-shopping-cart text-6xl text-gray-600 mb-4"></i>
                <p class="text-lg text-gray-400">Tu carrito está vacío</p>
                <p class="text-sm text-gray-500 mt-2">Agrega productos para comenzar</p>
            </div>
        @else
            @foreach($cart as $id => $item)
                <div class="flex items-start bg-gray-900 rounded-lg mx-4 my-3 p-4 transition hover:bg-blue-900/40">
                    <!-- Imagen -->
                    @if($item['image'] ?? false)
                        <img src="{{ asset('storage/productos/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                    @else
                        <div class="w-16 h-16 bg-gray-700 rounded-lg mr-4 flex items-center justify-center">
                            <i class="fas fa-box text-2xl text-gray-400"></i>
                        </div>
                    @endif

                    <!-- Info -->
                    <div class="flex-1">
                        <p class="font-medium text-sm truncate">{{ $item['name'] }}</p>
                        <p class="text-xs text-gray-400">S/. {{ number_format($item['price'], 2) }}</p>

                        <!-- Cantidad (solo visual en dropdown, no editable) -->
                        <p class="text-xs text-gray-500 mt-1">Cantidad: {{ $item['quantity'] }}</p>
                    </div>

                    <!-- Subtotal -->
                    <p class="font-bold text-green-400 text-right">
                        S/. {{ number_format($item['price'] * $item['quantity'], 2) }}
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Total -->
    @if(count($cart) > 0)
        <div class="p-4 bg-gray-900 border-t border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-lg">Total:</span>
                <span class="font-bold text-green-400 text-xl">
                    S/. {{ number_format($total, 2) }}
                </span>
            </div>
            <a href="{{ route('carrito') }}" class="block w-full bg-green-600 hover:bg-green-700 text-center py-3 rounded-lg font-bold transition">
                Ver Carrito Completo
            </a>
        </div>
    @endif
</div>