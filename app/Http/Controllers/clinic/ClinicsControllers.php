<?php

namespace App\Http\Controllers\clinic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users ;
use App\Http\Models\Doctors ;
use App\Http\Models\DoctorsPhone ;
use App\Http\Models\Reservation ;
use App\Http\Models\DoctorsCalendar ;
use App\Http\Models\Week ;
use App\Http\Models\ads ;
use App\Http\Models\Zone ;
use Carbon\Carbon ;
use DB ;

use App\Http\Models\map;
use Session;


class ClinicsControllers extends Controller
{
    public function viewmap($id){
        $db=DB::table('maps')->where('user_id',$id)->first();
        return view('clinic.map' ,compact('db'));
    }
    public function map(Request $r ,$id)
    {
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
    return redirect("http://admin.locationdoctor.com/clinic/info");
    }
    
    
    
  
    }
    public function show($doctor_id)
    {
        $user = DB::table('reservations')
            ->where('reservations.doctors_id','=',$doctor_id)
             ->join('doctors_calendar','reservations.doctors_calendar_id','=','doctors_calendar.doctors_calendar_id')
             ->join('week', 'week.week_id', '=', 'doctors_calendar.week_id')
            // //->join('doctors','doctors.doctors_id','=','reservations.doctors_id')
             ->select('reservations.patient_name', 'reservations.mobile', 'week.day_ar','week.week_id'
                    ,'reservations.health_insurance_pic','reservations.doctors_id')
                    ->orderBy('reservations.reservations_id', 'DESC')
                    ->get();
            
        return $user ;

    }
    public function ShowData($id)
    {
        $doctor = DB::table('doctors')
            ->join('users','doctors.user_id','=','users.user_id')
            // ->join('docotrs_phone','doctors.doctors_id','=','docotrs_phone.doctors_id')
            ->where('doctors.user_id','=',$id)
            ->select('users.name','doctors.doctors_id','doctors.c-register as register','users.mail','users.phone','doctors.user_id','doctors.image')
            ->get();
        return $doctor ;
    }
    public function ShowCity(){
        $city= DB::table('city')
            ->select('city_ar','city_id')
            ->get() ;
        return $city ;
    }
    public function ShowZone($city_id){
        $zone= DB::table('zone')
            ->select('zone_ar','zone_id')
            ->where('city_id','=',$city_id)
            ->get() ;
        return $zone ;
    }
    public function ShowDay($doctor_id)
    {
        $day = DB::table('doctors_calendar')
            ->join('week', 'doctors_calendar.week_id', '=', 'week.week_id')
            ->select('doctors_calendar.week_id', 'week.day_ar')
            ->where('doctors_calendar.doctors_id', '=', $doctor_id)
            ->get();
        return $day;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRegion($id)
    {
        $input = Request()->all();
        Doctors::where('doctors_id','=',$id)->update($input);
        return $input;
    }
    public function getId($user_id) {
        // find doctor_id
        $doctor_id = DB::table('doctors')
            ->where('user_id',$user_id)
            ->select('doctors_id')
            ->get(); 
        return $doctor_id ; 
    }
    public function updateDate($doctor_id,$week_id){
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
    public function updatePhone($id){
        $input = Request()->all();
        Users::where('user_id','=',$id)->update($input);
        return $input;
    }
    public function updateWaiting($id){
        $input = Request()->all();
        Doctors::where('user_id','=',$id)->update($input);
        return $input;
    }

    ///////////////////////
    /// statistics Page
    ///////////////////////
    public function showStatistics($user_id)
    {
        $user = DB::table('doctors')
                    ->where('doctors.user_id',$user_id)
                    ->join('reservations','reservations.doctors_id','doctors.doctors_id')
                    ->join('doctors_calendar','reservations.doctors_calendar_id','=','doctors_calendar.doctors_calendar_id')
                    ->join('week', 'week.week_id', '=', 'doctors_calendar.week_id')
                   // //->join('doctors','doctors.doctors_id','=','reservations.doctors_id')
                    ->select('reservations.patient_name', 'reservations.mobile', 'week.day_ar','week.week_id'
                           ,'reservations.doctors_id')
                           ->orderBy('reservations.reservations_id', 'DESC')
                           ->get();
       
        return $user ;

    }
    public function searchdoctors ($id)
    {
        $input = Request()->all();
        $doctor_id = DB::table('doctors')
                ->where('doctors.user_id',$id)
                ->select('doctors.doctors_id')
                ->first() ; 
        $var = $doctor_id->doctors_id ; 

        if(!empty($input['name'])) {
            $patient = DB::table('reservations')
                ->join('doctors_calendar', 'doctors_calendar.doctors_calendar_id', '=', 'reservations.doctors_calendar_id')
                ->leftjoin('week', 'doctors_calendar.week_id', '=', 'week.week_id')
                ->where('reservations.doctors_id', '=', $var)
                ->where('doctors_calendar.week_id','=',$input['week_id'])
                ->where('reservations.patient_name', 'LIKE', '%'.$input['name'].'%')
                ->select('reservations.doctors_id','reservations.patient_name', 'reservations.mobile'
                , 'week.day_ar', 'reservations.health_insurance', 'reservations.health_insurance_pic')
                ->get();
            return $patient;
        }
        elseif(!empty($input['week_id'])) {
            $user = DB::table('doctors_calendar')
                ->join('reservations','reservations.doctors_calendar_id','=','doctors_calendar.doctors_calendar_id')
                ->join('week', 'doctors_calendar.week_id', '=', 'week.week_id')
                ->where('reservations.doctors_id', '=', $var)
                ->where('doctors_calendar.week_id','=',$input['week_id'])
                ->where('reservations.patient_name', 'LIKE', '%'.$input['name'].'%')
                ->select('reservations.doctors_id','reservations.patient_name', 'reservations.mobile', 
                'week.day_ar', 'reservations.health_insurance', 'reservations.health_insurance_pic')
                ->get();

            return $user;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($doctor_id,$week_id)
    {
        $input = Request()->all();
        $check = DB::table('doctors_calendar')
            ->where('doctors_calendar.doctors_id',$doctor_id)
            ->where('doctors_calendar.week_id',$week_id)
            ->get();
        if(count($check)>0){
            doctorsCalendar::where('doctors_id', '=', $doctor_id)->where('week_id', '=', $week_id)->delete($input);

        }else {
            return 0 ; 

        }
    }
    public function addAds($user_id){
        $ad = new ads() ; 
        $input = Request()->all() ;
        $image = $input['ad_image'];
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        // return $image ; 
        $imageName = 'docsprofile/'.'advirtisment-'.time().'.'.'jpeg';
        \File::put(public_path().'/'.$imageName, base64_decode($image));
        $input['ad_image']=$imageName;
        $ad->create($input); 
        return 1 ; 

    }
    public function getAds($user_id){
        $ad = DB::table('ads')
        ->where('user_id',$user_id)
        ->orderBy('ad_id', 'desc')
        ->get() ; 
        return $ad ; 
    }
   
}
