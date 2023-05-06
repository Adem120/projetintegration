<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategorieResource;
use App\Http\Resources\Episodparserie;

class SerieResource extends JsonResource
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
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail_url,
            'réalisateur'=> $this->réalisateur,
            'langue'=> $this->langue,
            'nbepisodes'=> $this->nbepisodes,
            'categorie_id'=> new CategorieResource($this->categorie),
     ];

    }
}
