<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\ProfileAbility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileAbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = Ability::all();

        //Cadastrando permissões para administrador
        $adminAbilities = [];
        foreach ($abilities as $key => $ability) {
            $adminAbilities[$key] = ['profile_id' => 1, 'ability_id' => $ability->id];
        }
        ProfileAbility::insert($adminAbilities);
    }
}
