<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Move;
use App\Models\PokemonMove;

class PokemonMoveSeeder extends Seeder
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
        DB::table('pokemon_moves')->delete();

        foreach ($data as $i => $pokemon) {
            $moves = $pokemon->moves;
            foreach ($moves as $move) { // loop over all the moves for each pokemon
                $move_name = $move->move->name;
                $move_id = Move::where('name', $move_name)->first(); // get the id from types table that has the same name
                PokemonMove::create(array(
                    'pokemon_id' => $pokemon_ids[$i],
                    'move_id' => $move_id->id,
                ));
            }
        }
    }
}
