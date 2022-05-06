<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\StatType;

class StatTypeSeeder extends Seeder
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
        DB::table('stat_types')->delete();

        StatType::create(['name' => 'hp']);
        StatType::create(['name' => 'attack']);
        StatType::create(['name' => 'defense']);
        StatType::create(['name' => 'special_attack']);
        StatType::create(['name' => 'special_defense']);
        StatType::create(['name' => 'speed']);

    }
}
