<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Reservations;
use App\Http\Models\Users;
use App\Http\Models\DoctorsCalendar;
use App\Http\Models\Doctors;
use App\Http\Models\Specializations;
use App\Http\Models\MedicalSpecialties;
use App\Http\Models\Favourit;
use App\Http\Models\Week;
use App\Http\Models\DoctorsRate;
use DB;

class ReservationsController extends Controller
{
    public function __construct()
    {
        $this->medical_specialties = new MedicalSpecialties();
        $this->users = new Users();
        $this->doctors = new Doctors();
        $this->specializations = new Specializations();
        $this->favourite = new Favourit();
        $this->doctors_calandar = new DoctorsCalendar();
        $this->week = new Week();
        $this->reservations = new Reservations();
        $this->doctor_rate = new DoctorsRate();

    }

    public function GetMyReservationsList($id)
    {
        return $this->reservations
//            ->select('reservations_id')
            ->with([
                'DoctorsCalendar',
                'Doctors'
                => function ($query) {
                    $query->with(
                        'Users',
                        'DoctrsSpecializations.Specializations',
                        'Favorite'
                    );
                }
                ,
                'City.Zone',

            ])
            ->where('user_id', $id)
            ->get();
    }

    public function GetDoctorsCalndars($id)
    {
        return $this->doctors_calandar->with('Week')->where('doctors_id', $id)->get();

    }

    public function CreateReservations()
    {
        $input = Request()->all();

        $sub_services_pic = $input['health_insurance_pic'];
        $image_name = "pic - " . time() . " . png";
        $path = public_path() . "/health_insurance/" . $image_name;
        $input['health_insurance_pic'] = "health_insurance/" . $image_name;
        $voc = substr($sub_services_pic, strpos($sub_services_pic, ",") + 1);//take string after ,
        $voicedata = base64_decode($voc);
        $success = file_put_contents($path, $voicedata);

        return $this->reservations->create($input);
    }

    public function CancelReservations($id)
    {
        $this->reservations->find($id)->delete();
        return ['state' => '202'];
    }

    public function RateDoctors()
    {
        $input = Request()->all();
        $output = $this->doctor_rate->create($input);
        $doctors_id = $output->doctors_id;
        return $this->FinalRateDoctors($doctors_id);


    }

    protected function FinalRateDoctors($doctors_id)
    {
        $doctors_rate = $this->doctor_rate
            ->select(
                DB::raw('count(rate) as count_rate'),
                DB::raw('sum(rate)as sum_rate')
            )
            ->where('doctors_id', $doctors_id)
            ->get();
        global $count_rate;
        global $sum_rate;
        foreach ($doctors_rate as $rate) {
            $count_rate = $rate->count_rate;
            $sum_rate = $rate->sum_rate;

        }
        $final_rate = $sum_rate / $count_rate;
        $this->doctors->find($doctors_id)->update(['rate' => $final_rate]);
        return ["docotr_rate" => round($final_rate)];
    }

}
