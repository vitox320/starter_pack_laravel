<?php

namespace Database\Seeders;

use App\Models\Parameters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parameters = [
            [
                'name' => 'ADM_GERAL_PROFILE',
                'value' => 1
            ],
            [
                'name' => 'COLABORADOR_PROFILE',
                'value' => 2
            ]
        ];
        Parameters::insert($parameters);
    }
}
