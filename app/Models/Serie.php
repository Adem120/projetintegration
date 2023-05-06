<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class Serie extends Model
{
    use HasFactory;

    protected $fillable=[
        'titre',
        'description',
        'thumbnial_url',
        'réalisateur',
        'langue',
        'nbepisodes',
        'categorie_id',

    ];
    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
  



    

}
