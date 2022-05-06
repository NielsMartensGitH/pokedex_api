<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Move;

class MoveSeeder extends Seeder
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
        DB::table('moves')->delete();
        $pokemonMoves = [];

        foreach ($data as $pokemon) {
            $moves = $pokemon->moves;
            foreach ($moves as $move) {
                    $move_name = $move->move->name;
                if (!in_array($move_name, $pokemonMoves)) {
                    $pokemonMoves[] = $move_name;
                }
            }
        }

        foreach ($pokemonMoves as $pokemonMove) {
            Move::create([
                'name' => $pokemonMove
            ]);
        }
    }


}