<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FilmM;

class categorie extends Model
{
    use HasFactory;
    protected $fillable=[
      'nomcategorie'
    ];
    public function films(){
        return $this->hasMany(FilmM::class);
    }
}
