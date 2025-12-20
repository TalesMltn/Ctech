<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Carrito extends Component
{
    public $cart = [];
    public $open = false;

    // ← Nuevo listener para actualización en tiempo real con browser event
    protected $listeners = ['cart-updated' => '$refresh'];

    public function mount()
    {
        $this->cart = Session::get('cart', []);
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
        // ← Siempre cargamos el carrito fresco desde la sesión al renderizar
        $this->cart = Session::get('cart', []);

        return view('livewire.carrito');
    }
}