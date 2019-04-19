<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 31/05/2018
 * Time: 03:39 م
 */

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class MedicalSpecialties extends Model
{

    protected $table = 'medical_specialties';
    protected $primaryKey = 'medical_specialties_id';
    protected $fillable = ['medical_specialties_ar', 'medical_specialties_en', 'icone'];

    public function Specializations(){
        return $this->hasMany('App\Http\Models\Specializations','medical_specialties_id');
    }


    public function getMedicalSpecialtiesArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->medical_specialties_en;

        return $value;

    }
}