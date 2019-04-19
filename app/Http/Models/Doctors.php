<?php

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;


class Doctors extends Model
{

    protected $table = 'doctors';
    protected $primaryKey = 'doctors_id';
    protected $fillable = ['user_id', 'hospital_id','specialization', 'image', 'visita', 'wating', 'type', 'rate','city_id', 'zone_id'];

    public function DoctrsSpecializations()
    {
        return $this->hasMany('App\Http\Models\Specializations', 'doctors_id');
    }

    public function Users()
    {
        return $this->belongsTo('App\Http\Models\Users', 'user_id');
    }

    public function Favorite()
    {
        return $this->hasMany('App\Http\Models\Favourit', 'doctors_id');
    }

    public function DoctorsCalendar()
    {
        return $this->hasMany('App\Http\Models\DoctorsCalendar', 'doctors_id');
    }
    public function Reservations(){
        return $this->hasMany('App\Http\Models\Reservations','doctors_id');
    }

    public function City()
    {
        return $this->belongsTo('App\Http\Models\City', 'city_id');
    }

    public function Zone()
    {
        return $this->belongsTo('App\Http\Models\Zone', 'zone_id');
    }
    public function maps(){
        return $this->hasMany('App\Http\Models\map','user_id','user_id');
    }

}