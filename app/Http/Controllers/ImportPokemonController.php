<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PokePHP\PokeApi;
use Illuminate\Support\Facades\DB;
use App\Models\Ability;
use App\Models\Specie;
use App\Models\Pokemon;
use App\Models\Type;
use App\Models\PokemonAbility;
use App\Models\PokemonType;
use App\Models\Sprite;
use App\Models\Move;
use App\Models\PokemonMove;
use App\Models\PokemonStatType;
use App\Models\MoveLearnMethod;
use App\Models\VersionGroup;
use App\Models\MoveVersionGroup;

class ImportPokemonController extends Controller
{
    public function index() {
        $api = new PokeApi;
        $pokemon = $api->pokemon('chikorita');
        $data = json_decode($pokemon);

        //  ----------- IMPORT METHODS ------------  \\
        $specie_id = $this->importSpecies($data);
        $pokemon_id = $this->importPokemon($data, $specie_id);
        $this->importTypes($data);
        $this->importPokemonTypes($data, $pokemon_id);
        $this->importAbilities($data);
        $this->ImportPokemonAbilities($data, $pokemon_id);
        $this->ImportSprites($data, $pokemon_id);
        $this->importMoves($data);
        $this->importPokemonMoves($data, $pokemon_id);
        $this->importPokemonStatTypes($data, $pokemon_id);
        $this->importMoveLearnMethods($data);
        $this->importVersionGroups($data);
        $this->importMoveVersionGroups($data);
    }

    public function importSpecies($data) {
            $specie = Specie::create(array('name' => $data->species->name));
            return $specie->id;
    }

    public function importPokemon($data, $specie_id) {
        $name = $data->forms[0]->name;
        $height = $data->height;
        $weight = $data->weight;
        $order = $data->order;
        $form = $data->forms[0]->name;
        $specie_id = $specie_id;

        $pokemon = Pokemon::create(array(
            'name' => $name,
            'height' => $height,
            'weight' => $weight,
            'order' => $order,
            'form' => $form,
            'specie_id' => $specie_id
        ));

        return $pokemon->id;
    }

    public function importTypes($data) {

        $pokemonTypes = DB::table('types')->pluck('name')->toArray();
        $types = $data->types;
            foreach ($types as $type) {
                $type_name = $type->type->name;
                if (!in_array($type_name, $pokemonTypes)) {
                    Type::create(['name' => $type_name]);
                }
            }
    }

    public function importPokemonTypes($data, $pokemon_id) {
        $types = $data->types;
            foreach ($types as $type) { // loop over all the types for each pokemon
                $slot = $type->slot;
                $type_name = $type->type->name;
                $type_id = Type::where('name', $type_name)->first(); // get the id from types table that has the same name
                PokemonType::create([
                    'pokemon_id' => $pokemon_id,
                    'type_id' => $type_id->id,
                    'slot' => $slot
                ]);
            }
    }

    public function importAbilities($data) {

        $pokemonAbilities = DB::table('abilities')->pluck('name')->toArray();
        $abilities = $data->abilities;
        foreach ($abilities as $ability) {
                $ability_name = $ability->ability->name;
            if (!in_array($ability_name, $pokemonAbilities)) {
                Ability::create(array('name' => $ability_name));
            }
        }
    }

    public function ImportPokemonAbilities($data, $pokemon_id) {
        $abilities = $data->abilities;
        foreach ($abilities as $ability) { // loop over all the abilities for each pokemon
            $slot = $ability->slot;
            $is_hidden = $ability->is_hidden;
            $ability_name = $ability->ability->name;
            $ability_id = Ability::where('name', $ability_name)->first(); // get the id from types table that has the same name
            PokemonAbility::create([
                'pokemon_id' => $pokemon_id,
                'ability_id' => $ability_id->id,
                'is_hidden' => $is_hidden,
                'slot' => $slot
            ]);
        }
    }

    public function ImportSprites($data, $pokemon_id) {
        $sprite_category_ids = DB::table('sprite_categories')->pluck('id')->toArray();
            $sprites = [];
            array_push(
                $sprites,
                $data->sprites->back_default,
                $data->sprites->back_female,
                $data->sprites->back_shiny,
                $data->sprites->back_shiny_female,
                $data->sprites->front_default,
                $data->sprites->front_female,
                $data->sprites->front_shiny,
                $data->sprites->front_shiny_female
            );
            foreach ($sprites as $j => $sprite) {
                Sprite::create(array(
                    'pokemon_id' => $pokemon_id,
                    'sprite_category_id' => $sprite_category_ids[$j],
                    'image_path' => $sprite
                ));
            }
    }

    public function importMoves($data) {
        $pokemonMoves = DB::table('moves')->pluck('name')->toArray();
        $moves = $data->moves;
            foreach ($moves as $move) {
                    $move_name = 'mlkj';
                if (!in_array($move_name, $pokemonMoves)) {
                    Move::create(['name' => $move_name]);
                }
            }
    }

    public function importPokemonMoves($data, $pokemon_id) {
        $moves = $data->moves;
            foreach ($moves as $move) { // loop over all the moves for each pokemon
                $move_name = $move->move->name;
                $move_id = Move::where('name', $move_name)->first(); // get the id from types table that has the same name
                PokemonMove::create(array(
                    'pokemon_id' => $pokemon_id,
                    'move_id' => $move_id->id,
                ));
            }
    }

    public function importPokemonStatTypes($data, $pokemon_id) {
        $stat_type_ids = DB::table('stat_types')->pluck('id')->toArray();

        $pokemon_stats = $data->stats;
            foreach($pokemon_stats as $j => $stat) {
                PokemonStatType::create([
                    'pokemon_id' => $pokemon_id,
                    'stat_type_id' => $stat_type_ids[$j],
                    'base_stat' => $stat->base_stat,
                    'effort' => $stat->effort
                ]);
            }
    }

    public function importMoveLearnMethods($data) {
        $newLearnMethods = [];
        $learnMethods = DB::table('move_learn_methods')->pluck('name')->toArray();
        $moves = $data->moves;
            foreach ($moves as $move) {
                foreach ($move->version_group_details as $detail) {
                    if (!in_array($detail->move_learn_method->name, $learnMethods)) {
                        $newLearnMethods[] = $detail->move_learn_method->name;
                    }
                }
            }

            foreach ($newLearnMethods as $newLearnMethod) {
                MoveLearnMethod::create(['name' => $newLearnMethod]);
            }
    }

    public function importVersionGroups($data) {
        $new_version_group_names = [];
        $version_group_names = DB::table('version_groups')->pluck('name')->toArray();
        foreach ($data->moves as $move) {
            foreach($move->version_group_details as $version_group_detail) {
                if (!in_array($version_group_detail->version_group->name, $version_group_names)) {
                    $new_version_group_names[] = $version_group_detail->version_group->name;
                }
            }
        }

        foreach ($new_version_group_names as $new_version_group_name) {
            VersionGroup::create(['name' => $new_version_group_name]);
        }
    }

    public function importMoveVersionGroups($data) {
        foreach ($data->moves as $move_details) {
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
