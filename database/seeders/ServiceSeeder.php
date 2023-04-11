<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['Radiografias','Ecografias','Laboratorio Clinico','Consulta Medica Gral. y Especializada','Medicina Interna','Ginecologia y Obstreticia','Pediatria','Cirugia Gral.','Traumatologia','Cardiologia','Anestesiologia','Reanimacion y Dolor'];
        foreach ($services as $service) {
            Service::create([
                'name' => $service,
                'status' => 'ACTIVO'
            ]);
        }
    }
}
