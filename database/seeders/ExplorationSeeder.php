<?php

namespace Database\Seeders;

use App\Models\PhysicalExploration;
use Illuminate\Database\Seeder;

class ExplorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PhysicalExploration::create([
            'question' => 'CUELLO',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'ATM',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'GLANDULAS SALIVALES',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'LABIOS',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'MEJILLAS',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'CARRILLAS',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'PALADAR DURO Y BLANDO',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'LENGUA',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'PISO DE BOCA',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'CABEZA',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'CUELLO',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'TORAX',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'CARA POSTERIOR TORAX Y GLUTEO',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'ABDOMEN',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'EXTREMIDADES',
            'status' => 'ACTIVO'
        ]);
        PhysicalExploration::create([
            'question' => 'PIEL Y TEGUMENTO',
            'status' => 'ACTIVO'
        ]);
    }
}
