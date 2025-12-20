<!-- Carrito -->
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center space-x-2 bg-black hover:bg-gray-800 px-4 py-2.5 rounded-lg transition text-sm font-medium">
        <i class="fas fa-shopping-cart text-lg"></i>
        <span>
            Carrito
            <span class="text-green-400 font-bold">
                
            </span>
        </span>
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-96 bg-gray-800 rounded-lg shadow-2xl z-50 border border-gray-700 overflow-hidden" x-transition>
        <div class="max-h-96 overflow-y-auto">
            <livewire:cart-dropdown />
        </div>
        <div class="p-4 border-t border-gray-700">
            <a href="{{ route('carrito') }}" class="block w-full bg-green-600 hover:bg-green-700 text-center py-3 rounded-lg font-bold transition">
                Ver Carrito Completo
            </a>
        </div>
    </div>
</div>