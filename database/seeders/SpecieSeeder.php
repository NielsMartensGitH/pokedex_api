<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Specie;

class SpecieSeeder extends Seeder
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

        DB::table('species')->delete();
        foreach ($data as $pokemon) {
            Specie::create(array('name' => $pokemon->species->name));
        }
    }
}
