<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Accessor para obtener la URL completa de la imagen.
     * Si no hay imagen, devuelve un placeholder.
     */
    public function getImagenUrlAttribute(): string
    {
        return $this->imagen
            ? asset('storage/' . $this->imagen)
            : asset('images/placeholder-producto.jpg'); // Cambia por tu imagen placeholder real
    }
}