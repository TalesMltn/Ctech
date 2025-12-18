<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'imagen',
        'icono',
        'oculta',
        'orden',
        'grupo_categoria_id', // <-- Importante: este campo
    ];

    // RELACIÓN CON EL GRUPO PRINCIPAL
    public function grupoCategoria()
    {
        return $this->belongsTo(GrupoCategoria::class, 'grupo_categoria_id');
    }
}