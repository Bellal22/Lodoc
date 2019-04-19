<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 13/06/2018
 * Time: 12:58 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ContactUs extends Model
{
    protected $table='contact_us';
    protected $primaryKey = 'id';
    protected $fillable = ['phone','address_ar','address_en','email'];

    public function getAddressArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->address_en;

        return $value;

    }
}