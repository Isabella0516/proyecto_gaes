<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    public function run()
    {
        $productos = [
            ['nombre' => 'Aceite para motor'],
            ['nombre' => 'Filtro de aceite'],
            ['nombre' => 'Filtro de aire'],
            ['nombre' => 'Bujías'],
            ['nombre' => 'Pastillas de freno'],
            ['nombre' => 'Discos de freno'],
            ['nombre' => 'Kit de arrastre (cadena, piñón y catalina)'],
            ['nombre' => 'Baterías para moto'],
            ['nombre' => 'Llantas'],
            ['nombre' => 'Amortiguadores'],
            ['nombre' => 'Carburadores'],
            ['nombre' => 'Cables de acelerador y embrague'],
            ['nombre' => 'Bombillos LED y halógenos'],
            ['nombre' => 'Espejos retrovisores'],
            ['nombre' => 'Maniguetas de freno y embrague'],
            ['nombre' => 'Rodamientos'],
            ['nombre' => 'Cadena de transmisión'],
            ['nombre' => 'Piñón de salida y catalina'],
            ['nombre' => 'Lubricantes y grasas'],
            ['nombre' => 'Juego de herramientas para motos'],
        ];

        foreach ($productos as $producto) {
            Producto::firstOrCreate(['nombre' => $producto['nombre']]);
        }
    }
}