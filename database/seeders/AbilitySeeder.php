<?php

namespace Database\Seeders;

use App\Models\Ability;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ability = [
            [
                'name' => 'Criar Usuário',
                'slug' => 'user_create',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Editar Usuário',
                'slug' => 'user_edit',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Listar Usuário',
                'slug' => 'user_list',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Deletar Usuário',
                'slug' => 'user_delete',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Ability::insert($ability);
    }
}
