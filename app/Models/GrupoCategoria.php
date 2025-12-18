<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrupoCategoria extends Model
{
    use HasFactory;

    protected $table = 'grupo_categorias';

    protected $fillable = [
        'nombre', 'slug', 'icono', 'imagen', 'orden', 'oculta' // si ya agregaste el toggle
    ];

    // MÉTODO RECOMENDADO: más claro
    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'grupo_categoria_id');
    }
}