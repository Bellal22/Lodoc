<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\MedicalSpecialties;
use App\Http\Models\Users;
use App\Http\Models\Doctors;
use App\Http\Models\Specializations;
use App\Http\Models\Favourit;
use App\Http\Models\Reservations;
use DB;
use App\Http\Models\map;

class MedicalSpecialtiesController extends Controller
{
    //
    public function __construct()
    {
        $this->medical_specialties = new MedicalSpecialties();
        $this->users = new Users();
        $this->doctors = new Doctors();
        $this->specializations = new Specializations();
        $this->favourite = new Favourit();
        $this->reservations = new Reservations();
        $this->maps = new map();
    }

    public function GetallSpcecialties()
    {
        return $this->medical_specialties->all();
    }

    public function GetSpecializations($medical_specialist_id, $type, $user_id, $city_id, $zone_id,$lat,$lng)
    {


        if ($city_id == 0 && $zone_id == 0) {
            $map;
            $doctor = $this->doctors

                ->where('type', '=', $type)
                ->withCount('Reservations')
                ->join('specializations', 'specializations.doctors_id', 'doctors.doctors_id')
                ->Join('maps','maps.user_id','doctors.user_id')
                ->where('medical_specialties_id', $medical_specialist_id)
               
                // // ->join('maps','maps.lat,maps.long')->where(  'maps.user_id', 'doctors.user_id')
                
                // /*->join($this->specializations->getTable(), $this->doctors->getTable() . '.doctors_id', $this->specializations->getTable() . '.doctors_id')
                // ->where('medical_specialties_id', '=', $medical_specialist_id)*/
                ->with(['Users', 'DoctrsSpecializations' => function ($query) use ($medical_specialist_id) {
                    $query->with('Specializations')
                        ->where('medical_specialties_id', '=', $medical_specialist_id);
                }, 'Favorite' => function ($query) use ($user_id) {
                    $query->where($this->favourite->getTable() . '.user_id', $user_id);
                }, 'Reservations' => function ($query) use ($user_id) {
                    $query->where($this->reservations->getTable() . '.user_id', $user_id);
                }
                ])
                ->with('maps')
                
                // // ->Join('maps','maps.user_id','doctors.user_id')
                ->get();
                ////////////////////////////////////////////
            $providor = new map();
                // $ProvderQuery = $providor
                //     ->select(
                //         $providor->getTable() . '.*',
                //         DB::raw('(3959 * acos(cos(radians(' . $lat . ')) * cos(radians("lat")) * cos( radians("long") - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * 
                //             sin(radians("lat")))) 
                //              AS distance_in_km')
                //     )
            $ProvderQuery = map::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $lat . ') ) * cos( radians( "lat" ) ) * cos( radians( "long" ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( "lat" ) ) ) ) AS distance'))
                ->having('distance', '>', 10)
                ->orderBy('distance')
                ->get();

            $x = array();
            foreach ($ProvderQuery as $n) {
                $hos = DB::table('users')->where('user_id', $n->user_id)->get();
                array_push($x, $hos);
            }
            if ($lat == null or $lng == null or ($lat == null and $lng == null)) {
                $result = DB::table('maps')->get();

            }
        //     $arr_res=array();
        //   array_push($arr_res,$ProvderQuery,$doctor);
           
        
           

           
               
               
               
                //my code :) //
                // $x1=DB::table('doctors')->where('user_id', $user_id)->first();
                // $x11=$x1->doctors_id;
               
                // $x2=DB::table('specializations')->where('doctors_id',$x11)->first();
               
                //  $x3=DB::table('city')->where('city_id',$city_id)->get();
                
                //     $yy=DB::table('zone')->where('zone_id',$zone_id)->get();
                //     $map=DB::table('maps')->where('user_id',$user_id)->get();
                
                // // 
                // // $x1=DB::table()->where()->get();

               
                // $doctor=[$x1,$x2,$x3,$yy,$map];



        } else {
            $doctor = $this->doctors
                ->where('city_id', $city_id)
                ->where('zone_id', $zone_id)
                ->where('type', '=', $type)
                ->withCount('Reservations')
                ->join('maps', 'maps.user_id', 'doctors.doctors_id')
                ->join('specializations', 'specializations.doctors_id', 'doctors.doctors_id')
                ->where('medical_specialties_id', $medical_specialist_id)
                /*->join($this->specializations->getTable(), $this->doctors->getTable() . '.doctors_id', $this->specializations->getTable() . '.doctors_id')
                ->where('medical_specialties_id', '=', $medical_specialist_id)*/
                ->with(['Users', 'DoctrsSpecializations' => function ($query) use ($medical_specialist_id) {
                    $query->with('Specializations')
                        ->where('medical_specialties_id', '=', $medical_specialist_id);
                }, 'Favorite' => function ($query) use ($user_id) {
                    $query->where($this->favourite->getTable() . '.user_id', $user_id);
                }, 'Reservations' => function ($query) use ($user_id) {
                    $query->where($this->reservations->getTable() . '.user_id', $user_id);
                }])
                // ->join('maps')->where('maps.user_id','doctors.user_id')

                ->get();
                ///////////////////////////////////////////////////////
            $providor = new map();
            $ProvderQuery = map::select(DB::raw('*, ( 6367 * acos( cos( radians(' . $lat . ') ) * cos( radians( "lat" ) ) * cos( radians( "long" ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians( "lat" ) ) ) ) AS distance'))
                ->having('distance', '>', 10)
                ->orderBy('distance')
                ->get();
            $x = array();
            foreach ($ProvderQuery as $n) {
                $hos = DB::table('users')->where('user_id', $n->user_id)->get();

            }
    

        // }
        
        // return response($ProvderQuery);
        
//return response(["doctor"=>$doctor]);



    }
    // $doctor['result']=$ProvderQuery;
    return response([$doctor,$ProvderQuery]);
}

    public function Search($key_word, $user_id, $type, $city_id, $zone_id)
    {

        $output = $this->doctors
            ->withCount('Reservations')
            ->with([
                'Users' => function ($query) use ($key_word) {

                },
                'DoctrsSpecializations' => function ($query) use ($key_word) {
                    $query->with(['Specializations' => function ($query) use ($key_word) {

//                    $query->where('medical_specialties_ar', '=', $key_word)
//                        ->where('medical_specialties_en', '=', $key_word);
                    }]);

                }, 'Favorite' => function ($query) use ($user_id) {
                    $query->where($this->favourite->getTable() . '.user_id', $user_id);
                }, 'Reservations' => function ($query) use ($user_id) {
                    $query->where($this->reservations->getTable() . '.user_id', $user_id);
                }
            ])
            ->leftjoin($this->users->getTable(), $this->doctors->getTable() . '.user_id', $this->users->getTable() . '.user_id')
            ->leftjoin($this->specializations->getTable(), $this->doctors->getTable() . '.doctors_id', $this->specializations->getTable() . '.doctors_id')
            ->where($this->users->getTable() . '.name', 'Like', '%' . $key_word . '%');
        if (!empty($type)) {
            $output = $output->where($this->doctors->getTable() . '.type', '=', $type);
        }

        if (!empty($city_id)) {
            $output = $output->where($this->doctors->getTable() . '.city_id', $city_id);
        }

        if (!empty($zone_id)) {
            $output = $output->where($this->doctors->getTable() . '.zone_id', $zone_id);
        }
        $output = $output->get();

        return $output;
    }










    // public function near($lat, $lng)
    // {
    //     $cities = map::select(DB::raw('*,(6371 * acos(cos(radians(' . $lat . ')) * cos(radians("lat")) *
    // cos(radians("long") - radians(' . $lng. ')) +
    // sin(radians(' . $lat . ')) * sin(radians("lat")))) AS distance'))
    //     ->having('distance', '>', 10)
    //     ->orderBy('distance')
    //     ->get();
    //     return response($cities);
    
    /*find Nerset Privider within Spicific Kilometer*/
    // $maps=new map();
    //     $ProvderQuery = $maps
    //         ->select(
    //             $maps->getTable() . '.*',
    //             DB::raw('(3959 * acos(cos(radians(' . $lat . ')) * cos(radians("lat")) * cos( radians("long") - radians(' . $lng . ')) + sin(radians(' . $lat . ')) * 
    //                sin(radians("lat")))) 
    //                AS distance_in_km')
    //         )
    //         //->whereIN($this->providor->provider_id, $ProviderRefused)
    //         ->having('distance_in_km', '>',25)
    //         ->get();
           
    //     foreach ($ProvderQuery as $ProviderData) {
    //         $provider_id = $ProviderData->provider_id;
    //     }
  
    //     // $map=DB::table('maps')->get();
    //     // foreach($map as $dis){
    //     //     $x=3959 * acos(cos(radians( $lat )) * cos(radians($dis->lat)) * cos( radians($dis->long) - radians( $lng  )) + sin(radians( $lat )) *  sin(radians($dis->lat)));
    //     //   $map
    //     // }
       ///////////////////////////////////////////////////////////////////////////////////////////////
   
       function distanceQuery($lat, $lng)
       {
    return '(6371 * acos(cos(radians(' . $lat . ')) * cos(radians("lat")) *
    cos(radians("lat") - radians(' . $lng . ')) +
    sin(radians(' . $lat . ')) * sin(radians("lat"))))';
    }

public function getAllServices($lat, $lng)
{

$distance = '(6371 * acos(cos(radians(' . $lat . ')) * cos(radians("lat")) *cos(radians("lat") - radians(' . $lng . ')) +sin(radians(' . $lat . ')) * sin(radians("lat"))))';

$services = map::whereRaw($distance . '<=' . 25)
->selectRaw('*, ' . $distance . ' AS distance')
->orderByRaw($distance)->get();
return $services;


    }
 


}
