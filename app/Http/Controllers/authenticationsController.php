<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use App\Http\Models\Doctors;
use App\Http\Models\DoctorsPhone;
use App\Http\Models\Reservation;
use App\Http\HospitalBranch;
use App\Http\Models\DoctorsCalendar;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Routing\Redirector;
use Session;

use DB;

class authenticationsController extends Controller
{
    private $x;
    private $y;
    
    public function Login()
    {

        $input = Request()->all();

        $check = Users::where('mail', $input['mail'])
            ->where('password', md5($input['password']))
            ->select('user_id', 'type')
            ->get();
        //return $check ;
        foreach ($check as $che) {
            $x = $che['type'];
            $y = $che['user_id'];
        }


        if (count($check) > 0) {
            // return redirect()->route('Admin/users');

            if ($x == 0) {
                session()->regenerate();
                Session::put('id', $y);
                return view('admin.statistics.users');
            } elseif ($x == 2) {
                session()->regenerate();
                Session::put('id', $y);
                return redirect('clinic/info');


            } elseif ($x == 3) {
                session()->regenerate();
                Session::put('id', $y);
                
                return redirect('hospital/info');
            } else {
                return "you can't browse The Panel";
            }

        } elseif (count($check) == 0) {
           
            $admin_v = DB::table('users_admins')->where('email', $input['mail'])->where('password', $input['password'])->get();
if(count($admin_v)>0){
            foreach ($admin_v as $ad) {
                $role_aw = DB::table('admin_role')->where('admin_id', $ad->id)->get();

            }
            session()->regenerate();
            Session::put('id', $ad->id);
            foreach ($role_aw as $ro) {
                $role = DB::table('roles')->where('id', $ro->role_id)->get();
            }
            foreach ($role as $all_premission) {
                $per = DB::table('permission_role')->where('role_id', $all_premission->id)->get();



            }

            foreach ($per as $per_sessions) {

                session()->regenerate();
                Session::put('per'. $per_sessions->permission_id, $per_sessions->permission_id);
                // $_SESSION['per'. $per_sessions->permission_id] = $per_sessions->permission_id;
                       
                      }
                    
                      
           return redirect('Admin/users');

        }
    else {
            return "your email or password is not correct";
        }
        
        } else {
            return "your email or password is not correct";
        }
       


    }
     function logout(){
       
        Session::flush();
        return view('login'); 

     }

}
