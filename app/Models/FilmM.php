<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class FilmM extends Model
{
    use HasFactory;

    protected $fillable=[
        'titre',
        'description',
        'categorie_id',
        'thumbnial_url',
        'duration',
        'url',
        'réalisateur',
        'langue',
    ];


public function categorie(){
    return $this->belongsTo(Categorie::class);

}

}