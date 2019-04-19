<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 06/06/2018
 * Time: 11:11 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class DocotrsPhone extends Model
{

    protected $table = 'docotrs_phone';
    protected $primaryKey = 'doctors_id';
    protected $fillable = ['doctors_id', 'hospital_id', 'phone'];
}