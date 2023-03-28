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
            //Permissoes usuarios
            [
                'name' => 'Criar Usuário',
                'slug' => 'user_create',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Editar Usuário',
                'slug' => 'user_update',
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
            ],
            //Permissoes Perfil
            [
                'name' => 'Criar Perfil',
                'slug' => 'profile_create',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Editar Perfil',
                'slug' => 'profile_update',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Listar Perfil',
                'slug' => 'profile_list',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Excluir Perfil',
                'slug' => 'profile_delete',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            //Permissoes parametros
            [
                'name' => 'Criar Parâmetros',
                'slug' => 'parameter_create',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Editar Parâmetros',
                'slug' => 'parameter_update',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Listar Parâmetros',
                'slug' => 'parameter_list',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Excluir Parâmetros',
                'slug' => 'parameter_delete',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Ability::insert($ability);
    }
}
