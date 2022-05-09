<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\PokemonStatType;
use App\Models\StatType;

class PokemonStatTypeSeeder extends Seeder
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
        $stat_type_ids = DB::table('stat_types')->pluck('id');
        DB::table('pokemon_stat_types')->delete();

        foreach ($data as $i => $pokemon) {
            $pokemon_stats = $pokemon->stats;
            foreach($pokemon_stats as $j => $stat) {
                PokemonStatType::create([
                    'pokemon_id' => $pokemon_ids[$i],
                    'stat_type_id' => $stat_type_ids[$j],
                    'base_stat' => $stat->base_stat,
                    'effort' => $stat->effort
                ]);
            }
        }
    }
}
