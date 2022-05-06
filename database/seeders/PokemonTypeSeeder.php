<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\PokemonType;
use App\Models\Type;

class PokemonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/pokemons.json");
        $data = json_decode($json);

        $pokemon_ids = DB::table('pokemon')->pluck('id'); // get all pokemon ids in order from DB
        DB::table('pokemon_types')->delete();

        foreach ($data as $i => $pokemon) {
            $types = $pokemon->types;
            foreach ($types as $type) { // loop over all the types for each pokemon
                $slot = $type->slot;
                $type_name = $type->type->name;
                $type_id = Type::where('name', $type_name)->first(); // get the id from types table that has the same name
                PokemonType::create(array(
                    'pokemon_id' => $pokemon_ids[$i],
                    'type_id' => $type_id->id,
                    'slot' => $slot
                ));
            }
        }
    }
}
