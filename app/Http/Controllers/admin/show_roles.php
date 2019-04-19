<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use App\admin;
use App\role;
use App\permission_role;
// use Illuminate\Support\Facades\Storage ;


class show_roles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function view()
    {
        $rol = DB::table('roles')->get();

        return view('admin.statistics.show_roles', compact('rol'));
    }
    public function delete($id)
    {


        $D_pavot = DB::table('permission_role')->where('role_id', $id)->get();
        role::where('id', $id)->delete();
        foreach ($D_pavot as $id) {
            DB::table('permission_role')->where('role_id', $id->role_id)->delete();

        }
       
           return back();


    }





}
