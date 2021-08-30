<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilleController extends Controller
{
    public function index()
    {
        return view('famille');
    }

    public function store(Request $request)
    {
       /* $nom=$request->input('nom');*/

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
