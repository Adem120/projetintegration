<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\CategorieResource;

class FilmResource extends JsonResource

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
            'titre'=>$this->titre,
            'description'=>$this->description,
            'categorie_id'=>new CategorieResource($this->categorie),
            'thumbnial_url'=>$this->thumbnial_url,
            'duration'=>$this->duration,
            'url'=>str_replace('http://localhost:8000/storage/',URL::to('/').'/storage/',$this->url),
            'réalisateur'=>$this->réalisateur,
            'langue'=>$this->langue,
        ];
    }
}
