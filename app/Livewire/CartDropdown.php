<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartDropdown extends Component
{
    public $cart = [];
    public $count = 0;
    public $total = 0;

    protected $listeners = ['cart-updated' => '$refresh'];

    public function mount()
    {
        // ← OPCIÓN 1: Comentado o borrado (render lo hace)
        // $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->count = array_sum(array_column($this->cart, 'quantity'));
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        $this->loadCart(); // ← Siempre datos frescos

        return view('livewire.cart-dropdown');
    }
}