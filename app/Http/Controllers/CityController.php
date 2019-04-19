<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\City;
use App\Http\Models\map;
use DB;
class CityController extends Controller
{
    //
    public function __construct()
    {
        $this->city = new City();
       //$this->map = new map();
    }

    public function GetCity(){
       
        $x= $this->city->all();
        
        return response( $x);

    }
    public function viewCity($id){
        $map=DB::table('maps')->where('user_id',$id)->get();
        return response($map);
        
    
       
    }
    public function nearplaces($id){
        $map=DB::table('maps')->where('user_id',$id)->first();
        
        $cities = map::select(DB::raw('*, ( 6367 * acos( cos( radians('.$map->lat.') ) * cos( radians( $map->lat ) ) * cos( radians( $map->lng ) - radians('.$map->long.') ) + sin( radians('.$map->lat.') ) * sin( radians( $map->lat ) ) ) ) AS distance'))
    ->having('distance', '<', 25)
    ->orderBy('distance')
    ->get();
    }

}
