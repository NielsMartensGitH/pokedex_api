<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Sprite;

class SpriteSeeder extends Seeder
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
        DB::table('sprites')->delete();
        $pokemon_ids = DB::table('pokemon')->pluck('id'); // get all pokemon ids in order from DB
        $sprite_category_ids = DB::table('sprite_categories')->pluck('id');
        foreach ($data as $i => $pokemon) {
            $sprites = [];
            array_push(
                $sprites,
                $pokemon->sprites->back_default,
                $pokemon->sprites->back_female,
                $pokemon->sprites->back_shiny,
                $pokemon->sprites->back_shiny_female,
                $pokemon->sprites->front_default,
                $pokemon->sprites->front_female,
                $pokemon->sprites->front_shiny,
                $pokemon->sprites->front_shiny_female
            );
            foreach ($sprites as $j => $sprite) {
                Sprite::create(array(
                    'pokemon_id' => $pokemon_ids[$i],
                    'sprite_category_id' => $sprite_category_ids[$j],
                    'image_path' => $sprite
                ));
            }
        }
    }
}
