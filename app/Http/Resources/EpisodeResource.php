<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    
            return[
                'id' => $this->id,
                'titre' => $this->titre,
                'thumbnial_url' =>str_replace('http://localhost:8000/storage/',URL::to('/').'/storage/thumbnail/',$this->thumbnial_url),
                'duration'=> $this->duration,
                'url'=>str_replace('http://localhost:8000/storage/',URL::to('/').'/storage/',$this->url) ,
                'numero_episode'=> $this->numero_episode,
                'numero_saison'=> $this->numero_saison,
                'serie_id'=> $this->serie_id,
         ];

        
    }
}
