<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Photos;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{

    public function __construct()
    {

       
        $this->middleware('auth');
    }
    public function index()
    {
       // dd(Auth::user()->roles->first()->role);
        if (Auth::user()->roles->first()->role!="admin") {
            return abort(403);
       }
        return view('pages.designiation');
    }

    public function store(Request $request)
    {



        $ds=Designation::create(['nom'=>$request->nom,'prix_p'=>$request->price_p,'prix_g'=>$request->price_g,'prix_std'=>$request->price_std]);
        if ($request->file('path')) {
            $path = $request->file('path')->store('public/images');

            Photos::create(['photo'=>$path,'id_projet'=>$ds->id]);

        }
        return response()->json(['message'=>'Added Successfuly']);

    }

    public function update(Request $request)
    {

        if ($request->file('path')) {
            $path = $request->file('path')->store('public/images');
            Photos::where('id_projet',$request->id)->delete();
            Photos::create(['photo'=>$path,'id_projet'=>$ds->id]);

        }
        Designation::where('id',$request->id)->update(['nom'=>$request->nom,'prix_p'=>$request->price_p,'prix_g'=>$request->price_g,'prix_std'=>$request->price_std]);
        return response()->json(['message'=>'Updated Successfuly']);

    }

    public function edit(Request $request)
    {
        $data=Designation::where('id',$request->id)->first();
        return $data;

    }

    public function delete(Request $request)
    {
        Designation::where('id',$request->id)->delete();
        return response()->json(['message'=>'deleted successfuly']);
    }

    public function show(Request $request)
    {
        $data=Designation::
                     select('designations.*',DB::raw('(select photo from photos where id_projet=designations.id) as photo'))->get();
                     return DataTables::of($data)->toJson();
    }
}
