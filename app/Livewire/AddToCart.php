<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Producto;

class AddToCart extends Component
{
    // Escuchamos solo nuestro evento único para evitar duplicados
    protected $listeners = ['agregarProductoUnico' => 'add'];

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

        // ← Eventos para actualización en tiempo real (Livewire + JS)
        $this->dispatch('cart-updated');
        $this->js('Livewire.dispatch("cart-updated")');
    }

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}