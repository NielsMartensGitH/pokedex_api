<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            SpecieSeeder::class,
            PokemonSeeder::class,
            TypeSeeder::class,
            PokemonTypeSeeder::class,
            AbilitySeeder::class,
            SpriteCategorySeeder::class,
            SpriteSeeder::class,
            MoveSeeder::class,
            PokemonMoveSeeder::class
        ]);
    }
}
