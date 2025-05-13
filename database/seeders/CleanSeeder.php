<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clean;
use Carbon\Carbon;

class CleanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ubicacion' => 'Iruña',       'fecha' => '10-10-2021', 'cantidadRecogida_Kg' => 100, 'participantes' => 50, 'descripcion' => 'Cauce del rio Arga'],
            ['ubicacion' => 'Mendebaldea', 'fecha' => '04-11-2022', 'cantidadRecogida_Kg' => 80,  'participantes' => 25, 'descripcion' => 'Zonas verdes'],
            ['ubicacion' => 'Iruña',       'fecha' => '21-02-2023', 'cantidadRecogida_Kg' => 110, 'participantes' => 34, 'descripcion' => 'Cauce del rio Elortz'],
            ['ubicacion' => 'Monreal',     'fecha' => '19-10-2023', 'cantidadRecogida_Kg' => 140, 'participantes' => 50, 'descripcion' => 'Monte Higa de monreal'],
            ['ubicacion' => 'Zariquiegui', 'fecha' => '02-12-2023', 'cantidadRecogida_Kg' => 300, 'participantes' => 62, 'descripcion' => 'Monte Malkaitz y Tangorri'],
            ['ubicacion' => 'Gares',       'fecha' => '22-11-2024', 'cantidadRecogida_Kg' => 220, 'participantes' => 75, 'descripcion' => 'Monte Perdon'],
        ];

        foreach ($data as $item) {
            $item['fecha'] = Carbon::createFromFormat('d-m-Y', $item['fecha'])->format('Y-m-d');
            Clean::create($item);
        }
    }
}
