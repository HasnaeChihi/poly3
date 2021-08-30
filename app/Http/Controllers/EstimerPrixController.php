<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\System_iso_statisme;
use App\Models\System_go_ngo;
use App\Models\System_comparateur;
use App\Models\System_fixation;
use DataTables;
use Illuminate\Support\Facades\Auth;

class EstimerPrixController extends Controller
{
    public function index()
    {
       // dd(Auth::user()->roles->first()->role);
       if (Auth::user()->roles->first()->role!="admin") {
            return abort(403);}
       
        return view('pages.estimerprixmdc');
    }
    
    public function store(Request $request){
       $sm= System_iso_statisme::create(['rps'=>$request,'rps_qte'=>$request,'support_rps'=>$request,'support_rps_qte'=>$request]);
       $ngo=System_go_ngo::create(['user_id','qte_bm','support_bm','nbr_bm']);
       $cmp=System_comparateur::create(['user_id','qte_pc','qte_support','nbr_pc']);
       $fix=System_fixation::create(['user_id','str_type','str_qte','support_str_type','support_str_qte','clip_qte','bridage_qte']);
        $ds=Projet::create(['user_id'=>Auth::id(),'famille_id'=>$request->famille,'ngo_id'=>$ngo->id,'comparateur_id'=>$cmp->id,'fixation_id'=>$fix->id,'iso_statisme_id'=>$sm->id,'cout_mdc_id'=>$request->cout_mdc_nom,'nom'=>$request->nom,'client'=>$request->client,'client_final'=>$request->client_final,'id_designation'=>$request->designation,'nbr_mdc'=>$request->nbr_mdc,'type_mdc'=>$request->type_mdc]);
        return response()->json(["message"=>"user add successfull"]);
    }

    public function read(Request $request){

        $data=Projet::
        all();
        return DataTables::of($data)->toJson();
    }

    public function supprimer(Request $request){

        Projet::where('id',$request->id)->delete();
        return response()->json(['message'=>'deleted successfuly']);
        
    }

    public function edit(Request $request){

        $data=Projet::where('id',$request->id)->first();
        return $data;
        
    }

    public function update(Request $request){

        Projet::where('id',$request->id)->update(['name'=>$request->name,'fonction'=>$request->fonction,'email'=>$request->email,'password'=>bcrypt($request->password)]);
        return response()->json(['message'=>'Updated Successfuly']);
    }
}
