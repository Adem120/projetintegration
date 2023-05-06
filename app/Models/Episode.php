<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Serie;

class Episode extends Model
{
    use HasFactory;  

    
    protected $fillable=[
        'titre',
        'duree',
        'url',
        'thumbnial_url',
        'numero_episode',
        'numero_saison',
        'serie_id',
    ];
    public function serie(){
        return $this->belongsTo(Serie::class);
    }
    
}
