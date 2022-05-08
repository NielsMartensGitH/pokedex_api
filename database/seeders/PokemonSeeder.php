<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Pokemon;

class PokemonSeeder extends Seeder
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

        $specie_ids = DB::table('species')->pluck('id'); // get all the created ids from specieSeeder
        DB::table('pokemon')->delete();
        foreach ($data as $i => $pokemon) {
            $name = $pokemon->forms[0]->name; // each forms array in the loop has only one property
            $height = $pokemon->height;
            $weight = $pokemon->weight;
            $order = $pokemon->order;
            $form = $pokemon->forms[0]->name;
            $specie_id = $specie_ids[$i];

            Pokemon::create(array(
                'name' => $name,
                'height' => $height,
                'weight' => $weight,
                'order' => $order,
                'form' => $form,
                'specie_id' => $specie_id
            ));
        }
    }
}
