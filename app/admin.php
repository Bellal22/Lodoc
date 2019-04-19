<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table="users_admins";
    public function role(){
        return $this->belongstomany('App\role')->withTimestamps();
    }
}
