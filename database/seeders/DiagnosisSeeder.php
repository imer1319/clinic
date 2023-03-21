<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnoses = [
            'Cólera debido a Vibrio cholerae 01, biotipo cholerae',
            'Cólera debido a Vibrio cholerae 01, biotipo el Tor',
            'Cólera, no especificado',
            'Fiebres tifoidea y paratifoidea',
            'Fiebre tifoidea',
            'Fiebre paratifoidea A',
            'Fiebre paratifoidea B',
            'Fiebre paratifoidea C',
            'Fiebre paratifoidea, no especificada',
            'Otras infecciones debidas a Salmonella',
            'Enteritis debida a Salmonella',
            'Sepsis debida a Salmonella',
            'Infecciones localizadas debidas a Salmonella',
            'Otras infecciones especificadas como debidas a Salmonella',
            'Infección debida a Salmonella, no especificada',
            'Shigelosis',
            'Shigelosis debida a Shigella dysenteriae',
            'Shigelosis debida a Shigella flexneri',
            'Shigelosis debida a Shigella boydii',
            'Shigelosis debida a Shigella sonnei',
            'Otras shigelosis',
            'Shigelosis de tipo no especificado',
            'Otras infecciones intestinales bacterianas',
            'Infección debida a Escherichia coli enteropatógena',
            'Infección debida a Escherichia coli enterotoxígena',
            'Infección debida a Escherichia coli enteroinvasiva',
            'Infección debida a Escherichia coli enterohemorrágica',
            'Otras infecciones intestinales debidas a Escherichia coli',
            'Enteritis debida a Campylobacter',
            'Enteritis debida a Yersinia enterocolitica',
            'Enterocolitis debida a Clostridium difficile',
            'Otras infecciones intestinales bacterianas especificadas',
            'Cólera',
            'Infección intestinal bacteriana, no especificada',
            'Otras intoxicaciones alimentarias bacterianas, no clasificadas en otra parte',
            'Intoxicación alimentaria estafilocócica',
            'Botulismo',
            'Intoxicación alimentaria debida a Clostridium perfringens [Clostridium welchii]',
            'Intoxicación alimentaria debida a Vibrio parahaemolyticus',
            'Intoxicación alimentaria debida a Bacillus cereus',
            'Otras intoxicaciones alimentarias debidas a bacterias especificadas',
            'Intoxicación alimentaria bacteriana, no especificada',
            'Amebiasis',
            'Disentería amebiana aguda',
            'Amebiasis intestinal crónica',
            'Colitis amebiana no disentérica',
            'Ameboma intestinal',
            'Absceso amebiano del hígado',
            'Absceso amebiano del pulmón',
            'Absceso amebiano del cerebro',
            'Amebiasis cutánea',
            'Infección amebiana de otras localizaciones',
            'Amebiasis, no especificada',
            'Otras enfermedades intestinales debidas a protozoarios',
            'Balantidiasis',
            'Giardiasis [lambliasis]',
            'Criptosporidiosis',
            'Isosporiasis',
            'Otras enfermedades intestinales especificadas debidas a protozoarios',
            'Enfermedad intestinal debida a protozoarios, no especificada',
            'Infecciones intestinales debidas a virus y otros organismos especificados',
            'Enteritis debida a rotavirus',
            'Gastroenteropatía aguda debida al agente de Norwalk',
            'Enteritis debida a adenovirus',
            'Otras enteritis virales',
        ];
        foreach ($diagnoses as $diagnosis) {
            Diagnosis::create([
                'name' => $diagnosis,
                'status' => 'ACTIVO'
            ]);
        }
    }
}
