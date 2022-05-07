<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\VersionGroup;

class VersionGroupSeeder extends Seeder
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
        $version_group_names = [];

        foreach ($data as $pokemon) {
            foreach ($pokemon->moves as $move) {
                foreach($move->version_group_details as $version_group_detail) {
                    if (!in_array($version_group_detail->version_group->name, $version_group_names)) {
                        $version_group_names[] = $version_group_detail->version_group->name;
                    }
                }
            }
        }

        foreach ($version_group_names as $version_group_name) {
            VersionGroup::create(['name' => $version_group_name]);
        }
    }
}
