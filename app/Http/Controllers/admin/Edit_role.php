<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use App\admin;
use App\role;
use App\permission_role;

class Edit_role extends Controller
{
    function view($id)
    {
        $per = DB::table('permissions')->get();

        return view('admin.statistics.edit_roles', compact('per'));
    }
    function edit($id, Request $r)
    {
        $ro = role::where('id', $id)->first();

        $ro->titles = $r->role;
    //   role::find($id)->sync($ro->permissi);
        $ro->save();

         $ro->permission()->sync($r->permissi);
    //    role::find($id)->permission()->sync($ro->permissi);
    //    dd($r);
       
        return back();

    }


}
