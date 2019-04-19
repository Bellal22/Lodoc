<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Http\Models\Zone;

class inputsController extends Controller
{
    public function Getcities()
    {
        $city = DB::table('city')->get();
        return $city;

    }

    public function addcity(Request $request)
    {
        $input = Request()->all();
        $check = Zone::where('zone_en',$input['zone_en'])
            ->orWhere('zone_ar',$input['zone_ar'])
            ->get();
        if(count($check)>0){
            return 0 ;
        }else{
            $zone = new zone;
            $city = $zone->create($input);
            return $city;
        }


    }

    public function showzones()
    {
        $showzones = DB::table('zone')
            ->leftJoin('city', 'zone.city_id', '=', 'city.city_id')
            ->orderBy('city.city_ar', 'asc')
            ->get();
        return $showzones;

    }
    public function editcity($zone_id)
    {
        $input = Request()->all();
        Zone::where('zone_id','=',$zone_id)->update($input);
        return $input;
    }
    public function deletezone($id){
        $zone= zone::find($id);
       $zone->delete();
        return $zone;
    }

}
