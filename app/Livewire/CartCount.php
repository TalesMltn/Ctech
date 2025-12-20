<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartCount extends Component
{
    public $count = 0;

    protected $listeners = ['cart-updated' => '$refresh'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $cart = Session::get('cart', []);
        $this->count = array_sum(array_column($cart, 'quantity'));
    }

    public function render()
    {
        $this->updateCount(); // Siempre fresco
    
        return view('livewire.cart-count');
    }
}