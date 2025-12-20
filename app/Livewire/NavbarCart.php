<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class NavbarCart extends Component
{
    public $cart = [];
    public $open = false;

    // ← CAMBIO 1: Eliminamos el listener viejo 'addToCart' (ya no lo usamos)
    // ← CAMBIO 2: Agregamos el nuevo listener para actualización en tiempo real
    protected $listeners = ['cart-updated' => '$refresh'];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

    // ← OPCIONAL: Puedes eliminar todo este método addProduct()
    // porque ya no lo usamos (ahora solo AddToCart.php agrega al carrito)
    // Pero si quieres dejarlo por si acaso, no hay problema.
    // Si lo dejas, no hará daño porque ya no se llama.
    public function addProduct($productId, $name, $price, $image = null)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);
        $this->cart = $cart;
        $this->dispatch('cartUpdated');
    }

    public function toggle()
    {
        $this->open = !$this->open;
    }

    public function getTotalProperty()
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));
    }

    public function getCountProperty()
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    public function render()
    {
        // ← IMPORTANTE: Actualizamos $this->cart cada vez que se renderiza
        $this->cart = Session::get('cart', []);

        return view('livewire.navbar-cart');
    }
}