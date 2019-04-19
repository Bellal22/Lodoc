<?php

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;

class Favourit extends Model
{

    protected $table = 'favourite';
    protected $primaryKey = 'favourite_id';
    protected $fillable = ['user_id', 'doctors_id', 'token_id'];


    public function Doctors()
    {
        return $this->belongsTo('App\Http\Models\Doctors', 'doctors_id');
    }

}