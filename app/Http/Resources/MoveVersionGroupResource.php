<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MoveLearnMethod;
use App\Models\VersionGroup;

class MoveVersionGroupResource extends JsonResource
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
            'move_learn_method' => MoveLearnMethod::where('id', $this->move_learn_method_id)->first()->name,
            'version_group' => VersionGroup::where('id',$this->version_group_id)->first()->name,
            'level_learned_at' => $this->level_learned_at
        ];
    }
}
