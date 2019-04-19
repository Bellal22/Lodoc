<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 20/06/2018
 * Time: 12:41 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospital';
    protected $primaryKey = 'hospital_id';
    protected $fillable = [
        'hospital_name',
        'c-register',
        'address',
        'mail',
        'user_id'
    ];

    public function HospitalBranch()
    {
        return $this->hasMany('App\Http\HospitalBranch', 'branch_id');
    }
    // public function map()
    // {
    //     return $this->hasMany('App\Http\Models\map', 'Hos_id');
    // }


}