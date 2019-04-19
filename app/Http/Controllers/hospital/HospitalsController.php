<?php

namespace App\Http\Controllers\hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use App\Http\Models\Doctors;
use App\Http\Models\DoctorsPhone;
use App\Http\Models\Reservation;
use App\Http\Models\Specializations;
use App\HospitalBranch;
use App\Http\Models\DoctorsCalendar;
use Validator;
use Image;
use Carbon\Carbon;
use DB;

use App\Http\Models\map;
use Session;

class HospitalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewmap($id){
        $db=DB::table('maps')->where('user_id',$id)->first();
        return view('hospital.map' ,compact('db'));
    }
    public function map(Request $r ,$id)
    {
        
    $map=new map();
     ///////////this code to update doctor lat and long in there hosptials/////////////////////////////////
     $hospital_table=DB::table('hospital')->where('user_id',$id)->first();
     $H_ID=$hospital_table->hospital_id;
     $Doctor_table=DB::table('doctors')->where('hospital_id',$H_ID)->get();
    
    
    
     foreach($Doctor_table as $d_id){
        $res=map::where('user_id',$d_id->user_id)->first();
          
       $res->long= $r->longr;
       $res->lat= $r->latr;
       $res->user_id=$d_id->user_id;
       $res->save();
     }
     //////////////////////////////////////////////////////////////////
     $db=map::where('user_id',$id)->first();
    session()->regenerate();
    $id=Session('id');

   if(count($db)==null){
    $map=new map();
    $map->long= $r->longr;
    $map->lat= $r->latr;
    $map->user_id=$id;
    $map->save();
    return back();
   }else{
    $db->long= $r->longr;
    $db->lat= $r->latr;
    $db->user_id=$id;
    $db->save();
    return redirect("http://admin.locationdoctor.com/hospital/info");
    }
   
  
    
    
  
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetRegion()
    {
        $region = DB::table('zone')
            ->join('city','zone.city_id','=','city.city_id')
            ->select('city.city_ar','city.city_id','zone.zone_id','zone.zone_ar')
            ->get();
        return $region ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addDoctor($hospital_id)
    {
        $input = Request()->all();
        $input['type'] = 3 ;
        $input['pending']=1 ;
        $input['state'] = 1 ;

        $input['hospital_id'] =$hospital_id ;

        // in users table
        //$user = $input->except(['image']);

        $new = new Users ;
        $user_id = $new->create($input);

        // image editor
        $image = $input['image'];
        if (strpos($image, '/png;') !== false) {

            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'docsprofile/'.'doctor-'.time().'.'.'jpeg';
            \File::put(public_path().'/'.$imageName, base64_decode($image));
            $input['image']=$imageName;

        }else if (strpos($image, '/jpg;')!== false) {
            $image = str_replace('data:image/jpg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'docsprofile/'.'doctor-'.time().'.'.'jpeg';
            \File::put(public_path().'/'.$imageName, base64_decode($image));
            $input['image']=$imageName;
        }else if (strpos($image, '/jpeg;')!== false) {
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'docsprofile/'.'doctor-'.time().'.'.'jpeg';
            \File::put(public_path().'/'.$imageName, base64_decode($image));
            $input['image']=$imageName;
        }




        //in doctor table
        $input['type'] = 2 ;
        $input['rate'] = 5 ; 
        //$doctor = $input->except(['week_id','to_hr','from_hr','name']);
        $input['user_id']= $user_id['user_id'];
        $doc = new Doctors ;
        $doctors_id = $doc->create($input);

        //in Doctors_calendar
                //from_hr
                $date = explode("T",$input['from_hr']);
                $time = explode(".",$date[1]);
                $formTime = explode(':',$time[0]);
                $formHr = (int)$formTime[0] +2 ;
                $formTime[0]=$formHr ;
                $finalFromHr = implode(':',$formTime);
                $input['from_hr']= $finalFromHr ;
                //to_hr
                $date = explode("T",$input['to_hr']);
                $time = explode(".",$date[1]);
                $formTime = explode(':',$time[0]);
                $formHr = (int)$formTime[0] +2 ;
                $formTime[0]=$formHr ;
                $finalFromHr = implode(':',$formTime);
                $input['to_hr']= $finalFromHr ;
        
        //$calendar = $input->only(['week_id','to_hr','from_hr']);
        $input['doctors_id']= $doctors_id['doctors_id'];
        $date = new DoctorsCalendar ;
        $date->create($input);

        // in specilizations
        $date = new Specializations ;
        $date->create($input);
        return  $input ;


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $hospital = DB::table('users')
            ->where('users.user_id', '=', $id)
            ->join('hospital', 'hospital.user_id', '=', 'users.user_id')
            ->select('users.name','users.phone','users.mail','hospital.c-register as register'
                ,'hospital.hospital_id','users.address')
            ->get();
        return $hospital;
    }

    /*public function showBranchEdit($user_id)
    {
        $branch = DB::table('users')
            ->where('users.user_id', '=', $user_id)
            ->join('doctors', 'doctors.user_id', '=', 'users.user_id')
            ->leftjoin('hospital', 'doctors.hospital_id', '=', 'hospital.hospital_id')
            ->leftjoin('hospital_branch', 'hospital_branch.hospital_id', '=', 'hospital.hospital_id')
            ->select('hospital_branch.branch_id', 'hospital_branch.branch_name','hospital.hospital_id')
            ->get();
        return $branch;
    }*/

    public function showBranch($hospital_id)
    {
        $branch = DB::table('hospital_branch')
            ->join('hospital', 'hospital.hospital_id', '=', 'hospital_branch.hospital_id')
            ->where('hospital_branch.hospital_id', '=', $hospital_id)
            ->select('hospital_branch.branch_id', 'hospital_branch.branch_name','hospital_branch.hospital_id')
            ->get();
        if(!empty($branch)){
            return $branch;
        }else{
            return 0 ;
        }

    }

    public function ShowDoctor($branch_id,$hospital_id)
    {
        if ($branch_id == 0){
            $doctor = DB::table('doctors')
                ->join('users', 'users.user_id', '=', 'doctors.user_id')
                ->where('doctors.hospital_id', '=', $hospital_id)
                ->select('doctors.visita', 'doctors.specialization', 'users.name', 'doctors.doctors_id','doctors.image')
                ->get();
        }else{
            $doctor = DB::table('doctors')
                ->join('users', 'users.user_id', '=', 'doctors.user_id')
                ->select('doctors.visita', 'doctors.specialization', 'users.name', 'doctors.doctors_id','doctors.image')
                ->where('doctors.branch_id', '=', $branch_id)
                ->get();
        }

        return $doctor;
    }


    public function ShowDay() {
        $day = DB::table('week')
            ->select('week_id','day_ar')
            ->get() ;
        return $day ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showDoctorStatistics($hospital_id)
    {
        $hospital = DB::table('hospital')
            ->where('hospital.user_id',$hospital_id)
            ->select('hospital.hospital_id')
            ->first();

        $var = $hospital->hospital_id;

        $doctor = DB::table('doctors')
            ->join('users', 'users.user_id', '=', 'doctors.user_id')
            ->where('doctors.hospital_id', $var)
            ->join('specializations','specializations.doctors_id','doctors.doctors_id')
            ->join('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
            ->select('doctors.visita','doctors.rate', 'doctors.specialization', 'users.name', 'doctors.doctors_id',
                'doctors.image','medical_specialties.medical_specialties_id','medical_specialties.medical_specialties_ar')
            ->get();


        return $doctor ;
    }
    public function getSpecialist(){
        $medical_specialist = DB::table('medical_specialties')->get();
        return $medical_specialist ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($doctor_id, $week_id)
    {
        $input = Request()->all();
        //from_hr
        $date = explode("T",$input['from_hr']);
        $time = explode(".",$date[1]);
        $formTime = explode(':',$time[0]);
        $formHr = (int)$formTime[0] +2 ;
        $formTime[0]=$formHr ;
        $finalFromHr = implode(':',$formTime);
        $input['from_hr']= $finalFromHr ;
        //to_hr
        $date = explode("T",$input['to_hr']);
        $time = explode(".",$date[1]);
        $formTime = explode(':',$time[0]);
        $formHr = (int)$formTime[0] +2 ;
        $formTime[0]=$formHr ;
        $finalFromHr = implode(':',$formTime);
        $input['to_hr']= $finalFromHr ;

        $check = DB::table('doctors_calendar')
            ->where('doctors_calendar.doctors_id',$doctor_id)
            ->where('doctors_calendar.week_id',$week_id)
            ->get();
        if(count($check)>0){
            doctorsCalendar::where('doctors_id', '=', $doctor_id)->where('week_id', '=', $week_id)->update($input);

        }else {
            $input['doctors_id']= $doctor_id;
            doctorsCalendar::create($input);

        }

    }

    public function updateRegion($branch)
    {
        $input = Request()->all();
        HospitalBranch::where('branch_id','=',$branch)->update($input);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctors::find($id);
        $user = $doctor['user_id'] ; 
        $doctor->delete();
        $doctor = Users::find($user) ; 
        $doctor->delete();
        return $doctor;

    }
    public function  searchDoctors($hospital_id) {
        $input = Request()->all() ;
        $hospital = DB::table('hospital')
            ->where('hospital.user_id',$hospital_id)
            ->select('hospital.hospital_id')
            ->first();

        $var = $hospital->hospital_id;
        $specialist= DB::table('medical_specialties')->where('medical_specialties_id',$input['specialists'] )->value('medical_specialties_ar');

        if(!empty($input['name'])) {
            $doctor = DB::table('doctors')
                ->join('users', 'users.user_id', '=', 'doctors.user_id')
                ->where('doctors.hospital_id', $var)
                ->where('users.name', 'LIKE', '%'.$input['name'].'%')
                ->select('doctors.visita','doctors.rate', 'doctors.specialization', 'users.name', 'doctors.doctors_id','doctors.image')
                ->get();
            return $doctor;
        }else if (!empty($input['specialists'])) {
            $doctor = DB::table('doctors')
                ->join('users', 'users.user_id', '=', 'doctors.user_id')
                ->where('doctors.hospital_id', $var)
                ->join('specializations','specializations.doctors_id','doctors.doctors_id')
                ->join('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
                ->where('medical_specialties_ar',$specialist)
                ->select('doctors.visita','doctors.rate', 'doctors.specialization', 'users.name', 'doctors.doctors_id',
                    'doctors.image','medical_specialties.medical_specialties_id','medical_specialties.medical_specialties_ar')
                ->get();
            return $doctor;
        }
    }
}
