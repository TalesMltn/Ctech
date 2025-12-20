<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Producto;
use Livewire\Livewire;

class CarritoController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('carrito', compact('cart', 'total'));
    }

    // Aumentar cantidad
    public function increase($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            Session::put('cart', $cart);
        }

        Livewire::dispatch('cartUpdated');
        return redirect()->route('carrito');
    }

    // Disminuir cantidad
    public function decrease($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
            Session::put('cart', $cart);
        }

        Livewire::dispatch('cartUpdated');
        return redirect()->route('carrito');
    }

    // Eliminar producto
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        Livewire::dispatch('cartUpdated');
        return redirect()->route('carrito');
    }

    // Método add (por si lo usas)
    public function add($id)
    {
        $producto = Producto::findOrFail($id);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $producto->name,
                'price' => $producto->price,
                'quantity' => 1,
                'image' => $producto->image ?? null,
            ];
        }

        Session::put('cart', $cart);
        Livewire::dispatch('cartUpdated');

        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }
}