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
        'grupo_categoria_id',
    ];

    // Relación con el Grupo Principal (un grupo tiene muchas subcategorías)
    public function grupoCategoria()
    {
        return $this->belongsTo(GrupoCategoria::class, 'grupo_categoria_id');
    }

    // Relación con los Productos (una categoría tiene muchos productos)
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}