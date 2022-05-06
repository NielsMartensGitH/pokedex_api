<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Type;

class TypeSeeder extends Seeder
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
        DB::table('types')->delete();
        $pokemonTypes = []; // here we store all the types which appear in json file

        foreach ($data as $pokemon) {
            $types = $pokemon->types;
            foreach ($types as $type) {
                    $type_name = $type->type->name;
                if (!in_array($type_name, $pokemonTypes)) {
                    $pokemonTypes[] = $type_name;
                }
            }
        }

        foreach($pokemonTypes as $type) {
            Type::create(array('name' => $type));
        }
    }
}
