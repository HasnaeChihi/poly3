<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cout_mdc;
use DataTables;

class CoutConceptionController extends Controller
{
    public function index()
    {
       // dd(Auth::user()->roles->first()->role);
       /* if (Auth::user()->roles->first()->role!="admin") {
            return abort(403);
       }*/
        return view('pages.coutconception');
    }
    
    public function store(Request $request){

        $ds=Cout_mdc::create(['nom'=>$request->nom,'price'=>$request->price]);
        return response()->json(["message"=>" Le cout a été bien ajouté"]);
    }

    public function read(Request $request){

        $data=Cout_mdc::
        all();
        return DataTables::of($data)->toJson();
    }

    public function supprimer(Request $request){

        Cout_mdc::where('id',$request->id)->delete();
        return response()->json(['message'=>'deleted successfuly']);
        
    }

    public function edit(Request $request){

        $data=Cout_mdc::where('id',$request->id)->first();
        return $data;
        
    }

    public function update(Request $request){

        Cout_mdc::where('id',$request->id)->update(['nom'=>$request->nom,'price'=>$request->price]);
        return response()->json(['message'=>'Updated Successfuly']);
    }
}
