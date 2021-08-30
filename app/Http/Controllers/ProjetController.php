<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index()
    {
        return view('projet');
    }

    public function store(Request $request)
    {
       /*
        $user_id=$request->input('user_id');
        $famille_id=$request->input('famille_id');
        $ngo_id=$request->input('ngo_id');
        $comparateur_id=$request->input('comparateur_id');
        $fixation_id=$request->input('fixation_id');
        $iso_statisme_id=$request->input('iso_statisme_id');
        $cout_mdc_id=$request->input('cout_mdc_id');
        $nom=$request->input('nom');
        $client=$request->input('client');
        $client_final=$request->input('client_final');
        $id_designation=$request->input('id_designation');
        $nbr_mdc=$request->input('nbr_mdc');
        $type_mdc=$request->input('type_mdc');
        */
    }

    public function update(Request $request)
    {
        
    }

    
    public function edit(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

    public function show(Request $request)
    {
        
    }
}
