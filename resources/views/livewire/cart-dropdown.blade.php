<div>
    <!-- Header -->
    <div class="p-4 border-b border-gray-700 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold text-white">Tu Carrito</h3>
            <p class="text-sm text-gray-400">{{ $count }} unidades</p>
        </div>
        <button @click="$parent.open = false" class="text-gray-400 hover:text-white text-lg">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Lista de productos -->
    <div class="max-h-96 overflow-y-auto">
        @if($count === 0)
            <div class="text-center py-12">
                <i class="fas fa-shopping-cart text-6xl text-gray-600 mb-4"></i>
                <p class="text-lg text-gray-400">Tu carrito está vacío</p>
                <p class="text-sm text-gray-500 mt-2">Agrega productos para comenzar</p>
            </div>
        @else
            @foreach($cart as $id => $item)  <!-- ← clave $id para iterar correctamente -->
                <div class="flex items-center p-4 border-b border-gray-700 hover:bg-gray-700 transition">
                    @if($item['image'] ?? false)
                        <img src="{{ asset('storage/productos/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded mr-4">
                    @else
                        <div class="w-16 h-16 bg-gray-600 rounded mr-4 flex items-center justify-center">
                            <i class="fas fa-box text-2xl text-gray-400"></i>
                        </div>
                    @endif

                    <div class="flex-1">
                        <p class="font-medium text-sm truncate max-w-xs">{{ $item['name'] }}</p>
                        <p class="text-xs text-gray-400">
                            S/. {{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}
                        </p>
                    </div>

                    <p class="font-bold text-green-400 text-right">
                        S/. {{ number_format($item['price'] * $item['quantity'], 2) }}
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Total -->
    
</div>