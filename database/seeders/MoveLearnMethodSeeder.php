<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\MoveLearnMethod;

class MoveLearnMethodSeeder extends Seeder
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
        DB::table('move_learn_methods')->delete();
        $learnMethods = []; // here we store all the learn_methods which appear in json file

        foreach ($data as $pokemon) {
            $moves = $pokemon->moves;
            foreach ($moves as $move) {
                foreach ($move->version_group_details as $detail) {
                    if (!in_array($detail->move_learn_method->name, $learnMethods)) {
                        $learnMethods[] = $detail->move_learn_method->name;
                    }
                }
            }
            }

            foreach ($learnMethods as $learnMethod) {
                MoveLearnMethod::create(['name' => $learnMethod]);
            }

        // foreach($pokemonTypes as $type) {
        //     Type::create(['name' => $type]);
        // }

        // MoveLearnMethod::create(['name' => 'egg']);
        // MoveLearnMethod::create(['name' => 'machine']);
        // MoveLearnMethod::create(['name' => 'tutor']);
        // MoveLearnMethod::create(['name' => 'level_up']);

    }
}
