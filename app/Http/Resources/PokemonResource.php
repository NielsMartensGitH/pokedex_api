<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SpriteResource;
use App\Http\Resources\TypeResource;
use App\Models\Sprite;

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
            'sprites' => SpriteResource::collection($this->sprites)->where('sprite_category_id', 5)->first(),
            // 'types' =>  TypeResource::collection($this->types)
            'types' => PokemonTypeResource::collection($this->pokemon_types)
        ];
    }
}
