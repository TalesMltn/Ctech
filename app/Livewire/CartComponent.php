<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cart = [];

    protected $listeners = ['addToCart' => 'addProduct'];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

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
        
        $this->dispatch('notification', [
            'title' => '¡Agregado!',
            'message' => $name . ' agregado al carrito',
            'type' => 'success'
        ]);
    }

    public function removeProduct($productId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
        $this->cart = $cart;
        $this->dispatch('cartUpdated');
    }

    public function getCartCountProperty()
    {
        return array_sum(array_column($this->cart, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}