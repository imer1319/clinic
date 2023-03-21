<?php

namespace Database\Seeders;

use App\Models\HistoryType;
use Illuminate\Database\Seeder;

class HistoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $historyTypes = [
            'Antecedentes Patologicos',
            'Antecedentes No Patologicos',
            'Antecedentes Gineco-Obstetricios',
            'Antecedentes Heredofamiliares',
            'Otros',
        ];
        foreach ($historyTypes as $history) {
            HistoryType::create([
                'title' => $history,
            ]);
        }
    }
}
