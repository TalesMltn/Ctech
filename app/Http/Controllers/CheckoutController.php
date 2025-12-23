<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        // Leer el archivo config.json creado por el admin
        $configPath = storage_path('app/pagos/config.json');
        $paymentConfig = file_exists($configPath) 
            ? json_decode(file_get_contents($configPath), true) 
            : [
                'qr_yape' => 'qr-yape.png',
                'phone_yape' => '927573591',
                'owner_yape' => 'Tech Merch SAC',
                'qr_plin' => 'qr-plin.png',
                'phone_plin' => '927573591',
                'owner_plin' => 'Tech Merch SAC'
            ];

        // Obtener el carrito de la sesión para mostrar resumen si quieres (opcional)
        $cart = Session::get('cart', []);

        return view('checkout', compact('paymentConfig', 'cart'));
    }

    public function process(Request $request)
    {
        // Validación estricta
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9]{9}$/',
            'payment_method' => 'required|in:card,yape,plin,transfer',
        ]);

        // Obtener el carrito
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular total
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Aquí puedes guardar el pedido en la base de datos
        // Order::create([...]);

        // O enviar por WhatsApp, email, etc.
        // Por ahora solo limpiamos el carrito

        Session::forget('cart');

        // Mensaje de éxito
        return redirect()->route('home')->with('success', '¡Pedido realizado con éxito! Pronto te contactaremos para confirmar el pago.');
    }
}