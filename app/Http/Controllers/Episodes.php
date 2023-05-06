<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Episode;
use App\Http\Resources\EpisodeResource;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Episodes extends Controller
{
    public function addepisode(Request $request){
        $request->validate([
            'titre' => 'required',
            'thumbnial_url' => 'required',
            'duration' => 'required',
            'url' => 'required',
            'numero_episode' => 'required',
            'numero_saison' => 'required',
            'serie_id' => 'required',
          
        ]);
        $videoname = Str::random(20).'.'.$request->file('url')->getClientOriginalExtension();
        $imgname = Str::random(20).'.'.$request->file('thumbnial_url')->getClientOriginalExtension();
        $e= new Episode();
        $e->titre=$request->titre;
        $e->thumbnial_url=Storage::url('thumbnail/'.$imgname);
        $e->duration=$request->duration;
        $e->numero_episode=$request->numero_episode;
        $e->numero_saison=$request->numero_saison;
        $e->url=Storage::url($videoname);
        $e->serie_id=$request->serie_id;
        $e->save();
        Storage::disk('public')->put($videoname, file_get_contents($request->file('url')));
        Storage::disk('thumbnail')->put($imgname, file_get_contents($request->file('thumbnial_url')));
        return response()->json(['message'=>'added'],200);

    }
    public function getepisodes(){
        $episodes=Episode::all();
return EpisodeResource::collection($episodes);
    }
    public function getepisode($id){
        $episode=Episode::find($id);
        return new EpisodeResource($episode);
    }
    public function updateepisode(Request $request){
        $request->validate([
            'titre' => 'required',
            'thumbnial_url' => 'required',
            'duration' => 'required',
            'url' => 'required',
            'numero_episode' => 'required',
            'numero_saison' => 'required',
            'serie_id' => 'required',
          
        ]);
        $videoname = Str::random(20).'.'.$request->file('url')->getClientOriginalExtension();
        $imgname = Str::random(20).'.'.$request->file('thumbnial_url')->getClientOriginalExtension();
        Storage::disk('public')->delete(basename($request->url));
        Storage::disk('thumbnail')->delete(basename($request->thumbnial_url));
        $e= Episode::find($request->id);
        $e->titre=$request->titre;
        $e->thumbnial_url=Storage::url('thumbnail/'.$imgname);
        $e->duration=$request->duration;
        $e->numero_episode=$request->numero_episode;
        $e->numero_saison=$request->numero_saison;
        $e->url=Storage::url($videoname);
        $e->serie_id=$request->serie_id;
        $e->save();
        Storage::disk('public')->put($videoname, file_get_contents($request->file('url')));
        Storage::disk('thumbnail')->put($imgname, file_get_contents($request->file('thumbnial_url')));
        $episode->update($request->all());
        return response()->json(['message'=>'updated'],200);
    }
    public function deleteepisode($id){
        $episode=Episode::find($id);
        Storage::disk('public')->delete(basename($episode->url));
        Storage::disk('thumbnail')->delete(basename($episode->thumbnial_url));
        $episode->delete();
        return response()->json(['message'=>'deleted'],200);
    }
    public function getepisodesbyserie($id){
        $episodes=Episode::where('serie_id',$id)->get();
        return EpisodeResource::collection($episodes);
    }
}
