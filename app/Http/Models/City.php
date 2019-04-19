<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 06/06/2018
 * Time: 10:49 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class City extends Model
{
    protected $table = 'city';
    protected $primaryKey = 'city_id';
    protected $fillable = ['city_ar', 'city_en'];

    public function getCityArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->city_en;

        return $value;

    }

    public function Zone()
    {
        return $this->hasMany('App\Http\Models\Zone', 'zone_id');
    }

}