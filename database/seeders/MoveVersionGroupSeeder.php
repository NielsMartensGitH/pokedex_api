<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\MoveVersionGroup;
use App\Models\VersionGroup;
use App\Models\MoveLearnMethod;
use App\Models\Move;

class MoveVersionGroupSeeder extends Seeder
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
        DB::table('move_version_groups')->delete();

        $move_ids = DB::table('moves')->pluck('id');

        foreach ($data as $pokemon) {
            foreach ($pokemon->moves as $move_details) {
                    $move_name = $move_details->move->name;
                    $move_id = Move::where('name', $move_name)->first();

                    foreach ($move_details->version_group_details as $version_group_detail) {
                        $level_learned_at = $version_group_detail->level_learned_at;
                        $learn_method_name = $version_group_detail->move_learn_method->name;
                        $version_group_name = $version_group_detail->version_group->name;
                        $learn_method_id = MoveLearnMethod::where('name', $learn_method_name)->first();
                        $version_group_id = VersionGroup::where('name', $version_group_name)->first();


                        MoveVersionGroup::firstOrCreate([
                            'move_id' => $move_id->id,
                            'version_group_id' => $version_group_id->id,
                            'move_learn_method_id' => $learn_method_id->id,
                            'level_learned_at' => $level_learned_at
                        ]);
                    };
            }
        }
    }
}
