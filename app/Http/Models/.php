<?php
namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;
class Specializations extends Model
{

    protected $table = 'specializations';
    protected $primaryKey = 'specializations_id';
    protected $fillable = ['medical_specialties_id', 'doctors_id'];
    public function Specializations(){
        return $this->belongsTo('App\Http\Models\MedicalSpecialties','medical_specialties_id');
    }

}