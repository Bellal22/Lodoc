<?php

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;


class ads extends Model
{

    protected $table = 'ads';
    protected $primaryKey = 'ad_id';
    protected $fillable = ['user_id', 'ad_image','from_date', 'to_date'];
    public function getAboutappArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->aboutapp_en;

        return $value;

    }
}