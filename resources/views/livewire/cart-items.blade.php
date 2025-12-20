<div x-data="cartManager()">
    <div class="space-y-8">
        @foreach($cart as $id => $item)
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

                    <!-- Botones - cantidad + con Alpine.js (instantáneo) -->
                    <div class="flex items-center space-x-3 mt-3">
                        <button @click="decrease({{ $id }})" 
                                class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-xl transition">
                            -
                        </button>
                        <span class="text-2xl font-bold w-16 text-center" x-text="getQuantity({{ $id }})"></span>
                        <button @click="increase({{ $id }})" 
                                class="bg-green-600 hover:bg-green-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold text-xl transition">
                            +
                        </button>
                    </div>
                </div>

                <!-- Subtotal y eliminar -->
                <div class="flex items-center space-x-6">
                    <p class="text-xl font-bold text-green-400" x-text="'S/. ' + formatPrice(getSubtotal({{ $id }}))">
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

    <!-- Total general (se actualiza al instante) -->
    <div class="mt-12 border-t border-gray-700 pt-8">
        <div class="flex justify-between items-center mb-8">
            <span class="text-3xl font-bold">Total:</span>
            <span class="text-4xl font-bold text-green-400" x-text="'S/. ' + formatPrice(total())">
                S/. {{ number_format($total, 2) }}
            </span>
        </div>
        <div class="text-center">
            <button class="bg-green-600 hover:bg-green-700 text-white px-12 py-5 rounded-lg font-bold text-2xl transition hover:shadow-neon transform hover:scale-105">
                Proceder al Pago
            </button>
        </div>
    </div>

    <!-- Alpine.js script para manejar el carrito en el navegador (instantáneo) -->
    <script>
        function cartManager() {
            return {
                cart: @json($cart), // Copia del carrito del servidor

                increase(id) {
                    if (this.cart[id]) {
                        this.cart[id].quantity++;
                        this.saveToSession(); // Guardamos en session (con Livewire dispatch)
                    }
                },
                decrease(id) {
                    if (this.cart[id] && this.cart[id].quantity > 1) {
                        this.cart[id].quantity--;
                        this.saveToSession();
                    }
                },
                getQuantity(id) {
                    return this.cart[id] ? this.cart[id].quantity : 0;
                },
                getSubtotal(id) {
                    return this.cart[id] ? this.cart[id].price * this.cart[id].quantity : 0;
                },
                total() {
                    return Object.values(this.cart).reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },
                formatPrice(price) {
                    return price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                },
                saveToSession() {
                    // Enviamos al servidor para guardar en session y actualizar navbar
                    @this.set('cart', this.cart);
                    @this.dispatch('cartUpdated');
                }
            }
        }
    </script>
</div>