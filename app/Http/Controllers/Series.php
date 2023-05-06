<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Http\Resources\SerieResource;
use Illuminate\Support\Facades\DB;

class Series extends Controller
{
    public function addserie(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'thumbnail_url' => 'required',
            'réalisateur' => 'required',
            'langue' => 'required',
            'nbepisodes' => 'required',
            'categorie_id' => 'required',
        ]);
     
   $s= new Serie();
    $s->titre=$request->titre;
    $s->description=$request->description;
    $s->thumbnail_url=$request->thumbnail_url;
    $s->réalisateur=$request->réalisateur;
    $s->langue=$request->langue;
    $s->nbepisodes=$request->nbepisodes;
    $s->categorie_id=$request->categorie_id;
    $s->save();
        return response()->json($s,201);
    }
    public function getseries(){
        $series=Serie::all();
return SerieResource::collection($series);
    }
    public function getseriebyid($id){
        $serie=Serie::find($id);
        return new SerieResource($serie);
    }
    public function updateserie(Request $request,Serie $serie){
        $serie->update($request->all());
        return response()->json($serie,200);
    }
    public function deleteserie($id){
        $serie=Serie::find($id);
        $serie->delete();
        return response()->json(['message'=>'deleted'],200);
    }
    public function getseriesbycat($id){
        $series=DB::table('series')->where('categorie_id',$id)->get();
        return response()->json($series,200);
    }
    
}
