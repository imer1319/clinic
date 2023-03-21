<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicines = [
            'Abacavir, Sulfato de - lamivudina tableta',
            'Abacavir, Sulfato de SOLUCION',
            'Abacavir, Sulfato de tableta',
            'Abatacept SOLUCION inyectable',
            'Abatacept SOLUCION inyectable',
            'Abciximab SOLUCION inyectable',
            'Abiraterona acetato de tableta',
            'Acarbosa tableta',
            'Aceite de almendras dulces e hidroxido de calcio crema',
            'Aceite de almendras dulces, lanolina, glicerina, propilenglicol, sorbitol crema',
            'Aceite de ricino SOLUCION',
            'Aceite mineral SOLUCION',
            'Acemetacina cApsula',
            'Acemetacina cApsula de liberacion prolongada',
            'Acenocumarol tableta',
            'Acetazolamida sodica SOLUCION inyectable',
            'Acetazolamida tableta',
            'Acetilcisteina (GT13) SOLUCION al 20 %',
            'Acetilcolina, Cloruro de SOLUCION oftAlmica',
            'Aciclovir comprimido o tableta',
            'Aciclovir comprimido o tableta',
            'Aciclovir sodico SOLUCION inyectable',
            'Aciclovir unguento oftAlmico',
            'ACIDO ACETILSALICILICO GRAGEA O TABLETA CON CAPA ENTERICA',
            'Acido acetilsalicilico tableta',
            'ACIDO ACETILSALICILICO TABLETA',
            'Acido acetilsalicilico tableta soluble o efervescente',
            'Acido alendronico (Alendronato de sodio) tableta o comprimido',
            'Acido alendronico (Alendronato de sodio) tableta o comprimido',
            'Acido aminocaproico SOLUCION inyectable',
            'Acido Ascorbico SOLUCION inyectable',
        ];
        $concentrations = [
            '300 MG / 150 MG / 300 MG',
            '600 MG / 300 MG',
            '2 G',
            '300 MG',
            '250 mg',
            '125 mg',
            '10 mg / 5 ml',
            '250 mg',
            '50 mg',
            '',
            '',
            'Aceite de ricino',
            'Aceite mineral',
            '60 mg',
            '90 mg',
            '4 MG',
            '500 MG/5 ML',
            '250 MG',
            '400 MG/2ML',
            '20 MG / ML',
            '200 MG',
            '400 MG',
            '250 MG',
            '3 G / 100 G',
            '500 MG',
            '500 MG',
            '100 MG',
            '300 MG',
            '10 MG',
            '70 MG',
            '5 G / 20 ML',
        ];
        for ($i = 0; $i < count($medicines); $i++) {
            Medicine::create([
                'medicine' => $medicines[$i],
                'concentration' => $concentrations[$i],
                'status' => 'ACTIVO'
            ]);
        }
    }
}
