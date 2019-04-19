<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = "roles";
    public function admin(){
       return $this->belongstomany('App\admin')->withTimestamps();
    }
    public function permission(){
        return  $this->belongstomany('App\permission')->withTimestamps();
   
       }
}
