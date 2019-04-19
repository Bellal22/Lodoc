<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 13/06/2018
 * Time: 01:09 م
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SocialMedia extends Model
{
    protected $table='social_media';
    protected $primaryKey = 'id';
    protected $fillable = ['icone','url'];

}