<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class HospitalBranch extends Model
{
    // Table Name
    protected $table = 'hospital_branch';
    // Primary Key
    public $primaryKey = 'branch_id';
    // Timestamps
    //  public $timestamps = false ;
    protected $fillable = ['branch_name','city_id','zone_id'];


    


}
