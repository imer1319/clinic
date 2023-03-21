<?php

namespace Database\Seeders;

use App\Models\HistoryQuestion;
use Illuminate\Database\Seeder;

class HistoryQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $historyQuestions = [
            'Hospitalizacion Previa',
            'Cirugias Pevias',
            'Diabetes',
            'Enfermedades Tiroideas',
            'Hipertension Arterial',
            'Cardiopatias',
            'Traumatismos',
            'Cancer',
            'Tuberculosis',
            'Transfusiones',
            'Otros',
            'Actividad Fisica',
            'Tabaquismo',
            'Alcoholismo',
            'Uso Sustancias o Drogas',
            'Vacunas recientes',
            'Otros',
            'F. de primera menstruacion',
            'F. de ultima menstruacion',
            'Caract. menstruacion',
            'Embarazos',
            'Cancer Cervico',
            'Cancer Uterino',
            'Cancer de Mama',
            'Otros',
            'Diabetes',
            'Hipertension',
            'Enf. Toriodeas',
            'Otros',
            'Alergias',
            'Medicamentos',
        ];
        $ids = [1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,3,3,3,3,3,3,3,3,4,4,4,4,5,5];
        for ($i = 0; $i<count($historyQuestions); $i++) {
            HistoryQuestion::create([
                'history_question_id' => $ids[$i],
                'question' => $historyQuestions[$i],
                'status' => 'ACTIVO',
            ]);
        }
    }
}
