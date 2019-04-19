<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 13/06/2018
 * Time: 11:38 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Aboutapp extends Model
{

    protected $table = 'aboutapp';
    protected $fillable = ['aboutapp_ar', 'aboutapp_en'];
    protected $primaryKey = 'id';

    public function getAboutappArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->aboutapp_en;

        return $value;

    }
}