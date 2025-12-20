<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartDropdown extends Component
{
    public $cart = [];
    public $count = 0;       // ← Agrega esta línea
    public $total = 0;       // ← También agrega esta si usas $total en la vista

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->count = array_sum(array_column($this->cart, 'quantity')); // Calcula cantidad total de items
        $this->total = collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function render()
    {
        $this->loadCart(); // Siempre actualizado
        return view('livewire.cart-dropdown');
    }
}