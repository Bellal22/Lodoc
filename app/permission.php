<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table="permissions";
    function role(){
    return $this->belongstomany('App\role')->withTimestamps();

    }
}
