<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 13/06/2018
 * Time: 12:29 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class TermsConditions extends Model
{
    protected $table = 'terms_conditions';
    protected $primaryKey = 'id';
    protected $fillable = ['terms_conditions_ar','terms_conditions_en'];

    public function getTermsConditionsArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->terms_conditions_en;

        return $value;

    }

}