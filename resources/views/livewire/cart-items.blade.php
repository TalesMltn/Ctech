<div>
    <div class="space-y-8">
        @foreach($cart as $id => $item)
            <!-- Fondo gris-azulado visible + hover celeste sutil -->
            <div class="flex items-start bg-gray-800 rounded-lg p-6 transition hover:bg-blue-900/40">
                <!-- Imagen pequeña -->
                @if($item['image'])
                    <img src="{{ asset('storage/productos/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg mr-6 mt-2">
                @else
                    <div class="w-16 h-16 bg-gray-700 rounded-lg mr-6 mt-2 flex items-center justify-center">
                        <i class="fas fa-box text-3xl text-gray-500"></i>
                    </div>
                @endif

                <!-- Información principal -->
                <div class="flex-1">
                    <h3 class="text-lg font-bold">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-400 mt-1">S/. {{ number_format($item['price'], 2) }}</p>

                    <!-- Botones - cantidad + debajo del precio (Livewire con debounce para respuesta rápida) -->
                    <div class="flex items-center space-x-3 mt-3">
                        <button wire:click.debounce.100ms="decrease({{ $id }})" 
                                class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-xl transition">
                            -
                        </button>
                        <span class="text-2xl font-bold w-16 text-center">{{ $item['quantity'] }}</span>
                        <button wire:click.debounce.100ms="increase({{ $id }})" 
                                class="bg-green-600 hover:bg-green-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-xl transition">
                            +
                        </button>
                    </div>
                </div>

                <!-- Subtotal y eliminar a la derecha -->
                <div class="flex items-center space-x-6">
                    <p class="text-xl font-bold text-green-400">
                        S/. {{ number_format($item['price'] * $item['quantity'], 2) }}
                    </p>
                    <button wire:click="remove({{ $id }})" 
                            class="text-red-500 hover:text-red-400 text-3xl transition">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Total general -->
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