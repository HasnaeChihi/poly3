<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class UserManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';

        if (Auth::user()->roles->first()->role!="admin") {
            return abort(403);
       }
        
        return view('pages.form');
    }
    public function store(Request $request){

        $ds=User::create(['name'=>$request->name,'fonction'=>$request->fonction,'email'=>$request->email,'password'=>bcrypt($request->password)]);
        UserRole::create(['role_id'=>2,'user_id'=>$ds->id]);
        return response()->json(["message"=>"user add successfull"]);
    }

    public function read(Request $request){

        $data=User::
        all();
        return DataTables::of($data)->toJson();
    }

    public function supprimer(Request $request){

        User::where('id',$request->id)->delete();
        return response()->json(['message'=>'deleted successfuly']);
        
    }

    public function edit(Request $request){

        $data=User::where('id',$request->id)->first();
        return $data;
        
    }

    public function update(Request $request){

        User::where('id',$request->id)->update(['name'=>$request->name,'fonction'=>$request->fonction,'email'=>$request->email,'password'=>bcrypt($request->password)]);
        return response()->json(['message'=>'Updated Successfuly']);
    }
}
