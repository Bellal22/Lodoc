<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 20/06/2018
 * Time: 01:48 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class DoctorsRate extends Model
{
    protected $table = 'doctors_rate';
    protected $primaryKey = 'doctors_rate_id';
    protected $fillable = [

        'user_id',
        'rate',
        'doctors_id'
    ];

}