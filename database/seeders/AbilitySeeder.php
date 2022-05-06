<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Ability;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(env('JSON_FILE'));
        $data = json_decode($json);
        DB::table('abilities')->delete();

        $pokemonAbilities = [];

        foreach ($data as $pokemon) {
            $abilities = $pokemon->abilities;
            foreach ($abilities as $ability) {
                    $ability_name = $ability->ability->name;
                if (!in_array($ability_name, $pokemonAbilities)) {
                    $pokemonAbilities[] = $ability_name;
                }
            }
        }

        foreach($pokemonAbilities as $pokemon_ability) {
            Ability::create(array('name' => $pokemon_ability));
        }
    }
}
