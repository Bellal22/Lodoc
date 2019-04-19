<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 06/06/2018
 * Time: 10:53 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Zone extends Model
{
    protected $table = 'zone';
    protected $primaryKey = 'zone_id';
    protected $fillable = ['city_id', 'zone_ar', 'zone_en'];

    public function getZoneArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->zone_en;

        return $value;

    }

    public function City()
    {
        return $this->belongsTo('App\Http\Models\City', 'city_id');
    }

}