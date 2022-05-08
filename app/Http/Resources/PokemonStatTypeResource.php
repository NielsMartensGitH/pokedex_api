<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\StatType;

class PokemonStatTypeResource extends JsonResource
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
            'stat' => StatType::where('id', $this->stat_type_id)->first()->name,
            'base_stat' => $this->base_stat,
            'effort' => $this->effort
        ];
    }
}
