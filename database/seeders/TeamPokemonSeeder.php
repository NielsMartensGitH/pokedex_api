<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;
use App\Models\TeamPokemon;

class TeamPokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_pokemon')->delete();
        $team_ids = DB::table('teams')->pluck('id');

        foreach ($team_ids as $i => $team) {
            $numbers = range(1, 151);
            shuffle($numbers);
            for ($j=0; $j < 6; $j++) {
                TeamPokemon::create([
                    'team_id' => $team_ids[$i],
                    'pokemon_id' => $numbers[$j]
                ]);
            }
        }
    }
}
