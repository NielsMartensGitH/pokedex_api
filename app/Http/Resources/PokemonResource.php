<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SpriteResource;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sprites' => $this->when($request->id, SpriteResource::collection($this->sprites), SpriteResource::collection($this->sprites)->where('sprite_category_id', 5)->first()),
            'types' => PokemonTypeResource::collection($this->pokemon_types),
            'height' => $this->when($request->id, $this->height),
            'weight' => $this->when($request->id, $this->weight),
            'moves' => $this->when($request->id, MoveResource::collection($this->moves)),
            'order' => $this->when($request->id, $this->order),
            'species' => $this->when($request->id, $this->specie->name),
            'stats' => $this->when($request->id, PokemonStatTypeResource::collection($this->pokemon_stats)),
            'abilities' => $this->when($request->id, PokemonAbilityResource::collection($this->pokemon_abilities)),
            'form' => $this->when($request->id, $this->form)
        ];
    }
}
