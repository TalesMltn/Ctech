<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Producto;

class AddToCart extends Component
{
    protected $listeners = ['addToCart' => 'add'];

    public function add($id, $name, $price, $image = null)
    {
        $producto = Producto::findOrFail($id);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => 1,
                'image' => $image,
            ];
        }

        Session::put('cart', $cart);

        // ← ESTO ACTUALIZA EL CONTADOR EN EL NAVBAR EN TIEMPO REAL
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}