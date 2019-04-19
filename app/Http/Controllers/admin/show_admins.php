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


class show_admins extends Controller
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
        $admin = DB::table('users_admins')->get();
        
        // $admin = DB::table('permission_role')->join('roles','permission_role.role_id','=','roles.id')
        // ->join('users_admins','permission_role.permission_id','=','users_admins.id')
        // ->select('users_admins.name','users_admins.email','roles.titles')->get();
        // dd($admin);
        return view('admin.statistics.show_admins', compact('admin'));
    }



    public function delete($id)
    {
        admin::where('id', $id)->delete();
        return back();


    }
    public function view_edit($id)
    {
        $admm = admin::where('id', $id)->first();
        $rol = DB::table('roles')->get();
        return view('admin.statistics.edit_admins', compact('rol'),compact('admm'));


    }
    public function edit($id, Request $r)
    {
        $adm = admin::where('id', $id)->first();
        $adm->name = $r->name;
        $adm->email = $r->email;
        $adm->password = $r->pass;
       

        $adm->save();  
            $adm->role()->sync($r->role);     
        return redirect('Admin/showadmins');
    }



}
