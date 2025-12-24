<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'codigo',
        'tipo',
        'cliente_nombre',
        'cliente_correo',
        'cliente_telefono',
        'total',
        'estado',
        'notas',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];
}