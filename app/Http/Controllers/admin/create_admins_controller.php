<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use App\admin;
use App\role;
// use Illuminate\Support\Facades\Storage ;


class create_admins_controller extends Controller
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
    ////my code in banks account//////////////////////////////////
    //view
    public function view()
    {
        $rol = DB::table('roles')->get();

        return view('admin.statistics.create', compact('rol'));
    }
    public function edit($id){
        return view('admin.statistics.edit_admins');
    }

    //////////////////////////////////////
    public function insert(Request $r)
    {
          //$this->validate($r)[
        //     'email' => 'email',
        //     'password' => 'required|confirmed|min:6'
        // ]);

        $user = new admin();
        //object of admins_roles model ////

        $new_pass = hash::make($r->pass);
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = $r->pass;

        $user->save();

        

        $user->role()->sync($r->role);
        // $user->$a_r()->save($user->id);
 
         return back();

    }
    function view_roles ()
    {
        $permissions = DB::table('permissions')->get();
        return view('admin.statistics.add_roles', compact('permissions'));
    }
    function insert_roles(Request $r)
    {

        $ro = new role();
        $ro->titles = $r->role;

        $ro->save();

        $ro->permission()->sync($r->permissi);
        return back()->withFlashMessage('تمت الأضافة');;





    }




}
