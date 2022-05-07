<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Ability;
use App\Models\PokemonAbility;

class PokemonAbilitySeeder extends Seeder
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

        $pokemon_ids = DB::table('pokemon')->pluck('id'); // get all pokemon ids in order from DB
        DB::table('pokemon_abilities')->delete();

        foreach ($data as $i => $pokemon) {
            $abilities = $pokemon->abilities;
            foreach ($abilities as $ability) { // loop over all the abilities for each pokemon
                $slot = $ability->slot;
                $is_hidden = $ability->is_hidden;
                $ability_name = $ability->ability->name;
                $ability_id = Ability::where('name', $ability_name)->first(); // get the id from types table that has the same name
                PokemonAbility::create([
                    'pokemon_id' => $pokemon_ids[$i],
                    'ability_id' => $ability_id->id,
                    'is_hidden' => $is_hidden,
                    'slot' => $slot
                ]);
            }
        }
    }
}
