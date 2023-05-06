<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategorieResource;
class categories extends Controller
{
    public function addcategorie(Request $request){
        $request->validate([
            'nomcategorie'=>'required|unique:categories'
        ]);

      $c=DB::table('categories')->insert([
          'nomcategorie'=>$request->nomcategorie
      ]);
      return response()->json($c);
    
    }
    public function getcategorie(){
        return  CategorieResource::collection(Categorie::all());
    }
   public function updatecat(Request $r){
    $r->validate([
        'nomcategorie'=>'required'
    ]);
    $c=DB::table('categories')->where('id',$r->id)->update([
        'nomcategorie'=>$r->nomcategorie
    ]);
    return response()->json(['message'=>'updated'],200);
   }
   public function deletecat(Request $r){
    $c=DB::table('categories')->where('id',$r->id)->delete();
    return response()->json(['message'=>'deleted'],200);
   }
   public function getcatbyid($id){
    $c=Categorie::find($id);
    return new CategorieResource($c);
   }
}
