<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $productos = [
        // 1. Laptops de Oficina (categoria_id = 1)
        ['categoria_id' => 1, 'nombre' => 'Laptop Core i3 10ª Gen – 8GB RAM – 256GB SSD', 'precio' => 1950.00, 'stock' => 15],
        ['categoria_id' => 1, 'nombre' => 'Laptop Ryzen 3 – 8GB RAM – 512GB SSD', 'precio' => 2100.00, 'stock' => 12],
        ['categoria_id' => 1, 'nombre' => 'Laptop Core i5 – 8GB RAM – Pantalla 14”', 'precio' => 2450.00, 'stock' => 10],
        ['categoria_id' => 1, 'nombre' => 'Laptop Core i5 – 16GB RAM – SSD 512GB', 'precio' => 2850.00, 'stock' => 8],
        ['categoria_id' => 1, 'nombre' => 'Laptop Ryzen 5 – 8GB RAM – SSD 256GB', 'precio' => 2300.00, 'stock' => 14],
        ['categoria_id' => 1, 'nombre' => 'Laptop Ultrabook Slim – Oficina', 'precio' => 2600.00, 'stock' => 9],
        ['categoria_id' => 1, 'nombre' => 'Laptop Empresarial con lector huella', 'precio' => 2900.00, 'stock' => 7],
        ['categoria_id' => 1, 'nombre' => 'Laptop 15.6” Full HD – Oficina', 'precio' => 2250.00, 'stock' => 20],
        ['categoria_id' => 1, 'nombre' => 'Laptop básica para estudiantes', 'precio' => 1700.00, 'stock' => 25],
        ['categoria_id' => 1, 'nombre' => 'Laptop Windows 11 Pro – Oficina', 'precio' => 2750.00, 'stock' => 11],
        ['categoria_id' => 1, 'nombre' => 'Laptop con teclado numérico', 'precio' => 2350.00, 'stock' => 13],
        ['categoria_id' => 1, 'nombre' => 'Laptop bajo consumo energético', 'precio' => 2200.00, 'stock' => 18],

        // 2. Laptops Gaming (categoria_id = 2)
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming Core i5 + GTX 1650', 'precio' => 3900.00, 'stock' => 8],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming Ryzen 5 + RTX 3050', 'precio' => 4800.00, 'stock' => 6],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming Core i7 + RTX 3060', 'precio' => 5800.00, 'stock' => 5],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming Ryzen 7 + RTX 3070', 'precio' => 6800.00, 'stock' => 4],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming 144Hz Full HD', 'precio' => 5200.00, 'stock' => 7],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming RGB Keyboard', 'precio' => 4600.00, 'stock' => 9],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming 16GB RAM – SSD 1TB', 'precio' => 5500.00, 'stock' => 6],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming pantalla 17”', 'precio' => 6200.00, 'stock' => 5],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming refrigeración avanzada', 'precio' => 5700.00, 'stock' => 7],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming portátil ligera', 'precio' => 5000.00, 'stock' => 8],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming con Thunderbolt', 'precio' => 6000.00, 'stock' => 4],
        ['categoria_id' => 2, 'nombre' => 'Laptop Gaming edición esports', 'precio' => 6500.00, 'stock' => 3],

        // 3. PCs de Oficina (categoria_id = 3)
        ['categoria_id' => 3, 'nombre' => 'PC Oficina Core i3 – 8GB RAM', 'precio' => 1600.00, 'stock' => 20],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina Ryzen 3 – SSD 256GB', 'precio' => 1550.00, 'stock' => 18],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina Core i5 – SSD 512GB', 'precio' => 2100.00, 'stock' => 15],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina Mini Tower', 'precio' => 1700.00, 'stock' => 12],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina con Windows 11', 'precio' => 1900.00, 'stock' => 14],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina silencioso', 'precio' => 2000.00, 'stock' => 10],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina multitarea', 'precio' => 2200.00, 'stock' => 11],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina con monitor incluido', 'precio' => 2500.00, 'stock' => 8],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina para contabilidad', 'precio' => 2300.00, 'stock' => 13],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina bajo consumo', 'precio' => 1800.00, 'stock' => 16],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina con UPS básico', 'precio' => 2450.00, 'stock' => 9],
        ['categoria_id' => 3, 'nombre' => 'PC Oficina empresarial', 'precio' => 2600.00, 'stock' => 7],

        // 4. PCs Gaming (categoria_id = 4)
        ['categoria_id' => 4, 'nombre' => 'PC Gaming Core i5 + GTX 1660', 'precio' => 3800.00, 'stock' => 10],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming Ryzen 5 + RTX 3050', 'precio' => 4500.00, 'stock' => 8],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming Core i7 + RTX 3060', 'precio' => 5500.00, 'stock' => 6],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming Ryzen 7 + RTX 3070', 'precio' => 6300.00, 'stock' => 5],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming RGB completo', 'precio' => 4200.00, 'stock' => 12],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming refrigeración líquida', 'precio' => 5800.00, 'stock' => 7],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming 32GB RAM', 'precio' => 5200.00, 'stock' => 9],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming SSD NVMe 1TB', 'precio' => 4900.00, 'stock' => 11],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming para streaming', 'precio' => 6000.00, 'stock' => 6],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming edición competitiva', 'precio' => 6400.00, 'stock' => 4],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming torre ATX', 'precio' => 4300.00, 'stock' => 10],
        ['categoria_id' => 4, 'nombre' => 'PC Gaming alto rendimiento 4K', 'precio' => 7200.00, 'stock' => 3],

        // 5. Teclados Gaming (categoria_id = 5)
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming mecánico RGB', 'precio' => 280.00, 'stock' => 30],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming membrana', 'precio' => 120.00, 'stock' => 40],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming TKL', 'precio' => 220.00, 'stock' => 25],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming inalámbrico', 'precio' => 260.00, 'stock' => 20],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming switches rojos', 'precio' => 300.00, 'stock' => 18],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming switches azules', 'precio' => 290.00, 'stock' => 17],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming antighosting', 'precio' => 180.00, 'stock' => 35],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming compacto 60%', 'precio' => 240.00, 'stock' => 22],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming con reposamuñecas', 'precio' => 270.00, 'stock' => 19],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming metálico', 'precio' => 320.00, 'stock' => 15],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming para FPS', 'precio' => 250.00, 'stock' => 21],
        ['categoria_id' => 5, 'nombre' => 'Teclado Gaming retroiluminado', 'precio' => 200.00, 'stock' => 28],

        // 6. Mouse Gaming (categoria_id = 6)
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming RGB', 'precio' => 120.00, 'stock' => 45],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming 7200 DPI', 'precio' => 140.00, 'stock' => 40],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming 16000 DPI', 'precio' => 220.00, 'stock' => 25],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming inalámbrico', 'precio' => 200.00, 'stock' => 30],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming ergonómico', 'precio' => 180.00, 'stock' => 35],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming ultraligero', 'precio' => 190.00, 'stock' => 32],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming para FPS', 'precio' => 210.00, 'stock' => 28],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming para MOBA', 'precio' => 170.00, 'stock' => 33],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming con botones laterales', 'precio' => 160.00, 'stock' => 38],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming profesional', 'precio' => 250.00, 'stock' => 20],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming recargable', 'precio' => 230.00, 'stock' => 24],
        ['categoria_id' => 6, 'nombre' => 'Mouse Gaming honeycomb', 'precio' => 200.00, 'stock' => 29],

        // 7. Audífonos Gaming (categoria_id = 7)
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming RGB', 'precio' => 220.00, 'stock' => 35],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming 7.1 Surround', 'precio' => 300.00, 'stock' => 20],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming con micrófono', 'precio' => 180.00, 'stock' => 40],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming inalámbricos', 'precio' => 350.00, 'stock' => 15],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming multiplataforma', 'precio' => 260.00, 'stock' => 25],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming ligeros', 'precio' => 200.00, 'stock' => 38],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming cancelación ruido', 'precio' => 380.00, 'stock' => 12],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming USB', 'precio' => 240.00, 'stock' => 28],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming jack 3.5mm', 'precio' => 170.00, 'stock' => 42],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming profesionales', 'precio' => 420.00, 'stock' => 10],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming streaming', 'precio' => 450.00, 'stock' => 8],
        ['categoria_id' => 7, 'nombre' => 'Audífonos Gaming con control volumen', 'precio' => 230.00, 'stock' => 30],

        // 8. Cables (categoria_id = 8)
        ['categoria_id' => 8, 'nombre' => 'Cable HDMI 2.1', 'precio' => 45.00, 'stock' => 100],
        ['categoria_id' => 8, 'nombre' => 'Cable DisplayPort', 'precio' => 40.00, 'stock' => 90],
        ['categoria_id' => 8, 'nombre' => 'Cable USB Tipo C', 'precio' => 35.00, 'stock' => 120],
        ['categoria_id' => 8, 'nombre' => 'Cable USB 3.0', 'precio' => 30.00, 'stock' => 110],
        ['categoria_id' => 8, 'nombre' => 'Cable Ethernet Cat 6', 'precio' => 25.00, 'stock' => 150],
        ['categoria_id' => 8, 'nombre' => 'Cable Ethernet Cat 7', 'precio' => 35.00, 'stock' => 80],
        ['categoria_id' => 8, 'nombre' => 'Cable VGA', 'precio' => 20.00, 'stock' => 70],
        ['categoria_id' => 8, 'nombre' => 'Cable de poder PC', 'precio' => 30.00, 'stock' => 100],
        ['categoria_id' => 8, 'nombre' => 'Cable audio 3.5mm', 'precio' => 18.00, 'stock' => 130],
        ['categoria_id' => 8, 'nombre' => 'Cable SATA', 'precio' => 15.00, 'stock' => 90],
        ['categoria_id' => 8, 'nombre' => 'Cable cargador laptop', 'precio' => 90.00, 'stock' => 50],
        ['categoria_id' => 8, 'nombre' => 'Cable extensión USB', 'precio' => 28.00, 'stock' => 85],

        // 9. Adaptadores (categoria_id = 9)
        ['categoria_id' => 9, 'nombre' => 'Adaptador Tipo C multipuerto', 'precio' => 120.00, 'stock' => 40],
        ['categoria_id' => 9, 'nombre' => 'Adaptador USB a HDMI', 'precio' => 80.00, 'stock' => 50],
        ['categoria_id' => 9, 'nombre' => 'Adaptador Bluetooth USB', 'precio' => 45.00, 'stock' => 70],
        ['categoria_id' => 9, 'nombre' => 'Adaptador USB a Ethernet', 'precio' => 60.00, 'stock' => 55],
        ['categoria_id' => 9, 'nombre' => 'Adaptador Tipo C a HDMI', 'precio' => 90.00, 'stock' => 45],
        ['categoria_id' => 9, 'nombre' => 'Adaptador WiFi USB', 'precio' => 50.00, 'stock' => 65],
        ['categoria_id' => 9, 'nombre' => 'Adaptador HDMI a VGA', 'precio' => 55.00, 'stock' => 60],
        ['categoria_id' => 9, 'nombre' => 'Adaptador corriente universal', 'precio' => 70.00, 'stock' => 40],
        ['categoria_id' => 9, 'nombre' => 'Adaptador lector SD', 'precio' => 40.00, 'stock' => 75],
        ['categoria_id' => 9, 'nombre' => 'Adaptador OTG', 'precio' => 30.00, 'stock' => 100],
        ['categoria_id' => 9, 'nombre' => 'Adaptador audio USB', 'precio' => 35.00, 'stock' => 80],
        ['categoria_id' => 9, 'nombre' => 'Adaptador DisplayPort a HDMI', 'precio' => 75.00, 'stock' => 50],

        // 10. Mochilas (categoria_id = 10)
        ['categoria_id' => 10, 'nombre' => 'Mochila para laptop 15”', 'precio' => 120.00, 'stock' => 60],
        ['categoria_id' => 10, 'nombre' => 'Mochila para laptop 17”', 'precio' => 140.00, 'stock' => 50],
        ['categoria_id' => 10, 'nombre' => 'Mochila antirrobo', 'precio' => 180.00, 'stock' => 35],
        ['categoria_id' => 10, 'nombre' => 'Mochila impermeable', 'precio' => 160.00, 'stock' => 40],
        ['categoria_id' => 10, 'nombre' => 'Mochila gamer RGB', 'precio' => 180.00, 'stock' => 30],
        ['categoria_id' => 10, 'nombre' => 'Mochila ejecutiva', 'precio' => 200.00, 'stock' => 25],
        ['categoria_id' => 10, 'nombre' => 'Mochila con puerto USB', 'precio' => 150.00, 'stock' => 45],
        ['categoria_id' => 10, 'nombre' => 'Mochila acolchada', 'precio' => 130.00, 'stock' => 55],
        ['categoria_id' => 10, 'nombre' => 'Mochila ligera', 'precio' => 90.00, 'stock' => 70],
        ['categoria_id' => 10, 'nombre' => 'Mochila para estudiantes', 'precio' => 100.00, 'stock' => 65],
        ['categoria_id' => 10, 'nombre' => 'Mochila para viajes', 'precio' => 170.00, 'stock' => 38],
        ['categoria_id' => 10, 'nombre' => 'Mochila premium laptop', 'precio' => 220.00, 'stock' => 20],

        // 11. Soportes (categoria_id = 11)
        ['categoria_id' => 11, 'nombre' => 'Soporte para laptop ajustable', 'precio' => 80.00, 'stock' => 60],
        ['categoria_id' => 11, 'nombre' => 'Soporte para monitor', 'precio' => 120.00, 'stock' => 40],
        ['categoria_id' => 11, 'nombre' => 'Soporte doble monitor', 'precio' => 220.00, 'stock' => 25],
        ['categoria_id' => 11, 'nombre' => 'Soporte brazo articulado', 'precio' => 180.00, 'stock' => 30],
        ['categoria_id' => 11, 'nombre' => 'Soporte para CPU', 'precio' => 100.00, 'stock' => 50],
        ['categoria_id' => 11, 'nombre' => 'Soporte refrigerante laptop', 'precio' => 160.00, 'stock' => 35],
        ['categoria_id' => 11, 'nombre' => 'Soporte vertical laptop', 'precio' => 90.00, 'stock' => 55],
        ['categoria_id' => 11, 'nombre' => 'Soporte para audífonos', 'precio' => 80.00, 'stock' => 70],
        ['categoria_id' => 11, 'nombre' => 'Soporte para celular', 'precio' => 50.00, 'stock' => 80],
        ['categoria_id' => 11, 'nombre' => 'Soporte para tablet', 'precio' => 70.00, 'stock' => 60],
        ['categoria_id' => 11, 'nombre' => 'Soporte gamer RGB', 'precio' => 180.00, 'stock' => 28],
        ['categoria_id' => 11, 'nombre' => 'Soporte ergonómico escritorio', 'precio' => 150.00, 'stock' => 32],
    ];

    foreach ($productos as $prod) {
        Producto::create($prod);
    }
}
}