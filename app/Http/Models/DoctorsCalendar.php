<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 06/06/2018
 * Time: 11:00 ص
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DoctorsCalendar extends Model
{
    protected $table = 'doctors_calendar';
    protected $primaryKey = 'doctors_calendar_id';
    protected $fillable = ['week_id','doctors_id', 'from_hr','to_hr'];

    public function Week(){
        return $this->belongsTo('App\Http\Models\Week','week_id');
    }
    public function Doctors() {
        return $this->belongsTo('App\Http\Models\Doctors','doctors_id');
    }
}