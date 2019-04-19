<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 06/06/2018
 * Time: 10:58 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Week extends Model
{
    protected $table = 'week';
    protected $primaryKey = 'week_id';
    protected $fillable = ['day_ar','day_en'];

    public function getDayArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->day_en;

        return $value;

    }
    public function DoctorsCalendar(){
        return $this->hasMany('App\Http\Models\DoctorsCalendar','week_id');
    }

}