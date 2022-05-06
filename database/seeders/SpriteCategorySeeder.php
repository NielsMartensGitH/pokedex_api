<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\SpriteCategory;

class SpriteCategorySeeder extends Seeder
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

        DB::table('sprite_categories')->delete();
        SpriteCategory::create([
            'name' => 'back_default'
        ]);

        SpriteCategory::create([
            'name' => 'back_female'
        ]);

        SpriteCategory::create([
            'name' => 'back_shiny'
        ]);

        SpriteCategory::create([
            'name' => 'back_shiny_female'
        ]);

        SpriteCategory::create([
            'name' => 'front_default'
        ]);

        SpriteCategory::create([
            'name' => 'front_female'
        ]);

        SpriteCategory::create([
            'name' => 'front_shiny'
        ]);

        SpriteCategory::create([
            'name' => 'front_shiny_female'
        ]);

    }
}
