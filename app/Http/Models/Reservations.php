<?php

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{

    protected $table = 'reservations';
    protected $primaryKey = 'reservations_id';
    protected $fillable = ['user_id', 'doctors_id', 'token_id', 'patient_name', 'mobile', 'doctors_calendar_id', 'health_insurance', 'health_insurance_pic','zone_id','city_id'];

    public function Doctors()
    {
        return $this->belongsTo('App\Http\Models\Doctors', 'doctors_id');

    }
    public function DoctorsCalendar(){

        return $this->belongsTo('App\Http\Models\DoctorsCalendar','doctors_calendar_id');
    }
    public function City(){
        return $this->belongsTo('App\Http\Models\City','city_id');
    }
    public function Zone(){
        return $this->belongsTo('App\Http\Models\Zone','Zone_id');
    }

}