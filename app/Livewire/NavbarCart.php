<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class NavbarCart extends Component
{
    public $cart = [];
    public $open = false;

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
        return view('livewire.navbar-cart');
    }
}