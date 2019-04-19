<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Http\Models\City;
use App\Http\Models\MedicalSpecialties;


class CitiesController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Request()->all();
        $check = City::where('city_en',$input['city_en'])
            ->orWhere('city_ar',$input['city_ar'])
            ->get();
        if(count($check)>0){
            return 0 ;
        }else{
            $city = new City;
            $cities = $city->create($input);
            return $cities;
        }

    }
    public function storeSpecialist(Request $request) {
        $input = Request()->all();
        $check = MedicalSpecialties::where('medical_specialties_en',$input['medical_specialties_en'])
            ->orWhere('medical_specialties_ar',$input['medical_specialties_ar'])
            ->get();
        if(count($check)>0){
            return 0 ;
        }else{
            $special = new MedicalSpecialties;
            $specialist = $special->create($input);
            return $specialist;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usersData = City::select('city_id','city_ar','city_en')
            ->orderBy('city_en', 'asc')
            ->get() ;
        return $usersData ;
    }
    public function ShowSpecialist() {
        $tableData = MedicalSpecialties::select('medical_specialties_id','medical_specialties_ar','medical_specialties_en','icone')->get();
        return $tableData ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($city_id)
    {
        $input = Request()->all();
        City::where('city_id','=',$city_id)->update($input);
        return $input;
    }
    public function editSpecialist($medical_specialties_id){
        $input = Request()->all();
        MedicalSpecialties::where('medical_specialties_id','=',$medical_specialties_id)->update($input);
        return $input;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city= City::find($id);
        $city->delete();
        return $city;
    }
    public function destroySpecialist($id){
        $special= MedicalSpecialties::find($id);
        $special->delete();
        return $special;
    }
}
