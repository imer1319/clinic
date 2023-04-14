<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptions = [
            'Rayos x',
            'Quimica Sanguinea',
            'Tomografía computada multicorte',
            'Mastografía digital tomosintesis',
            'Densitometría',
            'Ultrasonido mamario volumétrico automatizado',
            'Elastografía ',
            'Radiología digital',
            'Ultrasonido',
            'Ultrasonido Doppler colon',
            'Biometría Hemática',
            'Ac. Anti Toxoplasma gondii IgG',
            'Velocidad de Eritrosedimentacion',
            'Reticulocitos',
            'Eosinofilos en moco nasal',
            'Plasmodium (busqueda en sangre)',
            'Grupo Sanguineo y factor Rh',
            'Ac. Anti Toxoplasma gondi IgM',
            'Ac. Anti Rubeola IgG',
            'Coombs Directo por Cromatografia',
            'Coombs Directo',
            'Coombs Indirecto',
            'Tiempo de Sangrado',
            'Tiempo de Protrombina (TP)',
            'Tiempo de Tromboplastina Parcial Activada (APPT)',
            'Tiempo de Trombina(3)',
            'Fibrinógeno',
            'Dimero D',
            'Factor VIII Antigenico(10)',
            'Inv. de Anticoag. circulantes',
            'Piruvato Cinasa(6)',
            'Antitrombina III (3)',
            'Plasminogeno(5)'
        ];
        foreach ($descriptions as $description) {
            Laboratory::create([
                'description' => $description,
                'status' => 'ACTIVO'
            ]);
        }
    }
}
