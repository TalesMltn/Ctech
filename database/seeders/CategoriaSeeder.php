<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Laptops de Oficina',       'slug' => 'laptops-oficina',       'icono' => '💻'],
            ['nombre' => 'Laptops Gaming',           'slug' => 'laptops-gaming',        'icono' => '🎮'],
            ['nombre' => 'PCs de Oficina',           'slug' => 'pcs-oficina',           'icono' => '🖥️'],
            ['nombre' => 'PCs Gaming',               'slug' => 'pcs-gaming',            'icono' => '🎮'],
            ['nombre' => 'Teclados Gaming',          'slug' => 'teclados-gaming',       'icono' => '⌨️'],
            ['nombre' => 'Mouse Gaming',             'slug' => 'mouse-gaming',          'icono' => '🖱️'],
            ['nombre' => 'Audífonos Gaming',         'slug' => 'audifonos-gaming',      'icono' => '🎧'],
            ['nombre' => 'Cables',                   'slug' => 'cables',                'icono' => '🔌'],
            ['nombre' => 'Adaptadores',              'slug' => 'adaptadores',           'icono' => '🔄'],
            ['nombre' => 'Mochilas',                 'slug' => 'mochilas',              'icono' => '🎒'],
            ['nombre' => 'Soportes',                 'slug' => 'soportes',              'icono' => '🧱'],
        ];
    
        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}