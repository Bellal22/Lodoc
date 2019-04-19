<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 20/06/2018
 * Time: 12:41 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class map extends Model
{
  
 protected $table="maps";
 public $timestamps = false ;
    // public function HospitalBranch()
    // {
    //     return $this->hasMany('App\Http\Models\Hospital', 'hospital_id');
    // }


}