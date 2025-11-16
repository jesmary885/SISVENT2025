<?php

namespace Database\Seeders;

use App\Models\Negocio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NegocioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Negocio::create([
            'nombre' => 'prueba',
            'email' => 'prueba@prueba.com',
            'telefono' => '5555555555',
            'tipo_documento' => 'RIF',
            'nro_documento' => 'J-1111111-1',
            'logo' => 'logo/logo.png',
        ]);
    }
}
