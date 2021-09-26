<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\System_iso_statisme;
use App\Models\System_go_ngo;
use App\Models\System_comparateur;
use App\Models\System_fixation;
use DataTables;
use DB;
use App\Models\Famille;
use Illuminate\Support\Facades\Auth;

class EstimerPrixController extends Controller
{
    public function index()
    {
       // dd(Auth::user()->roles->first()->role);
       $famillies=Famille::all();
       $designations=Designation::all();
       if (Auth::user()->roles->first()->role!="admin") {
            return abort(403);}
       
        return view('pages.estimerprixmdc',['famillies'=>$famillies,'designations'=>$designations]);
    }
    
    public function store(Request $request){
        //
       $sm= System_iso_statisme::create(['rps'=>$request->system_iso_statisme_rps,'rps_qte'=>$request->rps_qte,'support_rps'=>$request->rps_qte,'support_rps_qte'=>$request->system_iso_statisme_support_rps_qte]);
       $ngo=System_go_ngo::create(['user_id'=>Auth::id(),'qte_bm'=>$request->system_go_ngo_support_bm,'support_bm'=>$request->system_go_ngo_support_bm,'nbr_bm'=>$request->system_go_ngo_nbr_bm]);
      
       $cmp=System_comparateur::create(['user_id'=>Auth::id(),'qte_pc'=>$request->system_comparateur_nbr_pc,'qte_support'=>$request->system_comparateur_qte_support,'nbr_pc'=>$request->system_comparateur_nbr_pc]);
       
       $fix=System_fixation::create(['user_id'=>Auth::id(),'str_type'=>$request->system_fixation_support_str_type ,'str_qte'=>$request->system_fixation_support_str_qte,'support_str_type'=>$request->system_fixation_str_type,'support_str_qte'=>$request->system_fixation_str_qte,'clip_qte'=>$request->system_fixation_clip_qte,'bridage_qte'=>$request->system_fixation_bridage_qte]);
               
       $ds=Projet::create(['user_id'=>Auth::id(),'famille_id'=>$request->famille,'ngo_id'=>$ngo->id,'comparateur_id'=>$cmp->id,'fixation_id'=>$fix->id,'iso_statisme_id'=>$sm->id,'cout_mdc_id'=>$request->cout_mdc_nom,'nom'=>$request->projet_nom,'client'=>$request->client,'client_final'=>$request->client_final,'id_designation'=>$request->designation,'nbr_mdc'=>$request->nbr_mdc,'type_mdc'=>$request->type_mdc]);
        return response()->json(["message"=>"user add successfull"]);
    }

    public function read(Request $request){

        $data=Projet::join('designations','projets.id_designation','designations.id')
        ->select('projets.nom as nomprojet',
        'projets.client',
        'projets.id',
        'projets.created_at',
        'projets.type_mdc',
        'projets.nbr_mdc',
        'projets.client_final',
        'designations.nom as nomdesigniation',
        DB::raw('(select familles.nom from familles where id=projets.famille_id) as famille'),
        DB::raw('(select system_go_ngos.qte_bm from system_go_ngos where id=projets.ngo_id) as ngo'),//
        DB::raw('(select system_comparateurs.qte_pc from system_comparateurs where id=projets.comparateur_id) as comp'),//
        DB::raw('(select system_fixations.str_qte from system_fixations where id=projets.fixation_id) as fixation'),//
        DB::raw('(select system_iso_statismes.support_rps_qte from system_iso_statismes where id=projets.iso_statisme_id) as iso'),//
  
        DB::raw('(select price from cout_mdcs where id=projets.cout_mdc_id) as prixtotal5'),//
        
        DB::raw('(select if(system_iso_statismes.rps>1,designations.prix_p*rps_qte,designations.prix_g*rps_qte ) from system_iso_statismes, cout_mdcs where cout_mdcs.id=projets.cout_mdc_id and system_iso_statismes.id=projets.iso_statisme_id) as prixtotal'),//
        DB::raw('(select if(system_iso_statismes.support_rps>1,designations.prix_p*support_rps_qte,designations.prix_g*support_rps_qte ) from system_iso_statismes, cout_mdcs where cout_mdcs.id=projets.cout_mdc_id and system_iso_statismes.id=projets.iso_statisme_id) as prixtotal1'),//
        DB::raw('(select if(system_fixations.str_type>1,designations.prix_p*str_qte,designations.prix_g*str_qte ) from system_fixations, cout_mdcs where cout_mdcs.id=projets.cout_mdc_id and system_fixations.id=projets.fixation_id) as prixtotal2'),//
        DB::raw('(select if(system_fixations.support_str_type>1,designations.prix_p*support_str_qte,designations.prix_g*support_str_qte ) from system_fixations, cout_mdcs where cout_mdcs.id=projets.cout_mdc_id and system_fixations.id=projets.fixation_id) as prixtotal3'),//
        DB::raw('(select designations.prix_std) as prixtotal4'),//
        )->get();
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

        $sm= System_iso_statisme::create(['rps'=>$request,'rps_qte'=>$request,'support_rps'=>$request,'support_rps_qte'=>$request]);
        $ngo=System_go_ngo::create(['user_id','qte_bm','support_bm','nbr_bm']);
        $cmp=System_comparateur::create(['user_id','qte_pc','qte_support','nbr_pc']);
        $fix=System_fixation::create(['user_id','str_type','str_qte','support_str_type','support_str_qte','clip_qte','bridage_qte']); 
        Projet::where('id',$request->id)->update(['user_id'=>Auth::id(),'famille_id'=>$request->famille,'ngo_id'=>$ngo->id,'comparateur_id'=>$cmp->id,'fixation_id'=>$fix->id,'iso_statisme_id'=>$sm->id,'cout_mdc_id'=>$request->cout_mdc_nom,'nom'=>$request->nom,'client'=>$request->client,'client_final'=>$request->client_final,'id_designation'=>$request->designation,'nbr_mdc'=>$request->nbr_mdc,'type_mdc'=>$request->type_mdc]);
        return response()->json(['message'=>'Updated Successfuly']);
    }
}
