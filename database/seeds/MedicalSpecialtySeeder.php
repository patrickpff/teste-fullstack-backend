<?php

use Illuminate\Database\Seeder;
use App\MedicalSpecialty;

class MedicalSpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            'Alergia e Imunologia',
            'Anestesiologia',
            'Cardiologia',
            'Cirurgia Geral',
            'Cirurgia Pediátrica',
            'Cirurgia Plástica',
            'Clínica Médica',
            'Dermatologia',
            'Endocrinologia',
            'Gastroenterologia',
            'Geriatria',
            'Ginecologia e Obstetrícia',
            'Hematologia',
            'Infectologia',
            'Mastologia',
            'Nefrologia',
            'Neurologia',
            'Nutrologia',
            'Oftalmologia',
            'Oncologia',
            'Ortopedia e Traumatologia',
            'Otorrinolaringologia',
            'Pediatria',
            'Pneumologia',
            'Psiquiatria',
            'Radiologia',
            'Reumatologia',
            'Urologia',
        ];

        foreach($specialties as $specialty) {
            MedicalSpecialty::create([
                "name" => $specialty,
            ]);
        }
    }
}
