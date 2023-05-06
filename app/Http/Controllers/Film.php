<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FilmM;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\FilmResource;
use Illuminate\Support\Facades\Storage;
class Film extends Controller
{
    public function addfilm(Request $r){
        $r->validate([

            'titre' => 'required',
            'description' => 'required',
            'thumbnial_url' => 'required',
            'réalisateur' => 'required',
            'langue' => 'required',
            'categorie_id' => 'required',
            'url' => 'required',
            'duration' => 'required',
        ]);
            

        $videoname = Str::random(20).'.'.$r->file('url')->getClientOriginalExtension();
        $imgname = Str::random(20).'.'.$r->file('thumbnial_url')->getClientOriginalExtension();

       

    FilmM::create([
        'titre'=>$r->titre,
        'description'=>$r->description,
        'categorie_id'=>$r->categorie_id,
        'thumbnial_url'=>url(Storage::url('thumbnail/'.$imgname)),
        'duration'=>$r->duration,
         'url'=>url(Storage::url($videoname)),
        
        
        'réalisateur'=>$r->réalisateur,
        'langue'=>$r->langue,
    ]);
    Storage::disk('public')->put($videoname, file_get_contents($r->file('url')));
    Storage::disk('thumbnail')->put($imgname, file_get_contents($r->file('thumbnial_url')));

        return response()->json(['message'=>'added'],200);


    }
    public function getfilm(){
    $film=FilmM::all();
    return FilmResource::collection($film);
    }
    public function getfilmbyid($id){
        $film=FilmM::find($id);
        return new FilmResource($film);
    }
    public function updatefilm(Request $r){
        $r->validate([
         'titre' => 'required',
            'description' => 'required',
            'thumbnial_url' => 'required',
            'réalisateur' => 'required',
            'langue' => 'required',
            'categorie_id' => 'required',
            'url' => 'required',
            'duration' => 'required',
        ]);
        $videoname = Str::random(20).'.'.$r->file('url')->getClientOriginalExtension();
        $imgname = Str::random(20).'.'.$r->file('thumbnial_url')->getClientOriginalExtension();
        Storage::disk('public')->delete(basename($r->url));
        Storage::disk('thumbnail')->delete(basename($r->thumbnial_url));
        $film=FilmM::find($r->id);
        $film->titre=$r->titre;
        $film->description=$r->description;
        $film->thumbnial_url=Storage::url('thumbnail/'.$imgname);
        $film->réalisateur=$r->réalisateur;
        $film->langue=$r->langue;
        $film->categorie_id=$r->categorie_id;
        $film->url=Storage::url($videoname);
        $film->duration=$r->duration;
        $film->save();
        Storage::disk('public')->put($videoname, file_get_contents($r->file('url')));
        Storage::disk('thumbnail')->put($imgname, file_get_contents($r->file('thumbnial_url')));
        return response()->json(['message'=>'updated'],200);

    }
    public function deletefilm($id){
        $film=FilmM::find($id);
        Storage::disk('public')->delete(basename($film->url));
        Storage::disk('thumbnail')->delete(basename($film->thumbnial_url));
        $film->delete();
        return response()->json(['message'=>'deleted'],200);
    }
    public function getfilmbycat($id){
        $films=FilmM::where('categorie_id',$id)->get();
        return response()->json($films,200);
    }

      
}
