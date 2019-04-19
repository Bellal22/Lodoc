<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Doctors;
use App\Http\Models\MedicalSpecialties;
use App\Http\Models\DoctorsCalender;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class statisticsController extends Controller
{

	public function getdoctors (){
        $doctors= DB::table('reservations')
        ->leftjoin('doctors_calendar','doctors_calendar.doctors_calendar_id','reservations.doctors_calendar_id')
        ->leftjoin('doctors','doctors.doctors_id','reservations.doctors_id')
        ->leftjoin('specializations','specializations.doctors_id','doctors.doctors_id')
        ->leftjoin('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
        ->leftjoin('users','users.user_id','doctors.user_id')
        ->select('users.name','users.phone','medical_specialties.medical_specialties_ar','doctors_calendar.from_hr',
        'reservations.health_insurance','reservations.health_insurance_pic','users.address')
        ->get(); 
	    // $doctors = DB::table('doctors')
        //     ->leftJoin('users', 'doctors.doctors_id', '=', 'users.user_id')
        //     ->leftJoin('doctors_calendar', 'doctors.doctors_id', '=', 'doctors_calendar.doctors_id')
        //     ->leftJoin('docotrs_phone', 'doctors.doctors_id', '=', 'docotrs_phone.doctors_id')
        //     ->leftJoin('specializations', 'doctors.doctors_id', '=', 'specializations.doctors_id')
        //     ->leftJoin('medical_specialties', 'specializations.medical_specialties_id', '=', 'medical_specialties.medical_specialties_id')
        //     ->leftjoin('reservations', 'reservations.doctors_id', '=', 'doctors.doctors_id')
        //     ->get();
        return $doctors;

    }

public function searchdoctors (Request $request){
    $input =Request()->all();
    $specialist= DB::table('medical_specialties')->where('medical_specialties_id',$input['specialists'] )->value('medical_specialties_ar');

        if(!empty($input['name'])) {
            $user = DB::table('reservations')
            ->leftjoin('doctors_calendar','doctors_calendar.doctors_calendar_id','reservations.doctors_calendar_id')
            ->leftjoin('doctors','doctors.doctors_id','reservations.doctors_id')
            ->leftjoin('specializations','specializations.doctors_id','doctors.doctors_id')
            ->leftjoin('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
            ->leftjoin('users','users.user_id','doctors.user_id')
            
                ->where('users.name', 'LIKE', '%'.$input['name'].'%')
                ->select('users.name','users.phone','medical_specialties.medical_specialties_ar','doctors_calendar.from_hr',
            'reservations.health_insurance','reservations.health_insurance_pic','users.address')
                ->get();
            return $user;
        }elseif(!empty($input['specialists'])){
            $user = DB::table('reservations')
            ->leftjoin('doctors_calendar','doctors_calendar.doctors_calendar_id','reservations.doctors_calendar_id')
            ->leftjoin('doctors','doctors.doctors_id','reservations.doctors_id')
            ->leftjoin('specializations','specializations.doctors_id','doctors.doctors_id')
            ->leftjoin('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
            ->leftjoin('users','users.user_id','doctors.user_id')
                ->where('medical_specialties.medical_specialties_ar','=',$specialist)
                ->select('users.name','users.phone','medical_specialties.medical_specialties_ar','doctors_calendar.from_hr',
            'reservations.health_insurance','reservations.health_insurance_pic','users.address')
                ->get();
            return $user;

        }else {
            $user = DB::table('reservations')
            ->leftjoin('doctors_calendar','doctors_calendar.doctors_calendar_id','reservations.doctors_calendar_id')
            ->leftjoin('doctors','doctors.doctors_id','reservations.doctors_id')
            ->leftjoin('specializations','specializations.doctors_id','doctors.doctors_id')
            ->leftjoin('medical_specialties','medical_specialties.medical_specialties_id','specializations.medical_specialties_id')
            ->leftjoin('users','users.user_id','doctors.user_id')
                ->where('doctors_calendar.from_hr', '=', $input['value1'])
                ->select('users.name','users.phone','medical_specialties.medical_specialties_ar','doctors_calendar.from_hr',
        'reservations.health_insurance','reservations.health_insurance_pic','users.address')
                ->get();
            return $user;
        }
}






    public function Getspecialist (){
        $specialist= DB::table('medical_specialties')->get();
        return $specialist;

    }
        public function AddSpecialist(request $request){
            //take object of model
            $media_spe=new MedicalSpecialties();
            //make variable of file 
            $icon =$request->file("icon");
             $name_icon=time().$icon->getClientOriginalName();
             $upload="specialty/".$name_icon;
            //take my request
            $media_spe->medical_specialties_ar=$request->ar;
            $media_spe->medical_specialties_en=$request->en;
        $media_spe->icone=$upload;
            //select the destinition
            $bath='specialty';
            //  Image::make($icon->getRealPath())->resize(17, 24)->save($path);
             $bath='specialty';
             //upload
            $icon->move($bath,$name_icon);
             $media_spe->save();
             return redirect()->back()->with('alert', 'تمت الاضافة بنجاح');

         





        }


}
