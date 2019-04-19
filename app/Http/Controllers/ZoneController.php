<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Zone;

class ZoneController extends Controller
{
    //
    public function __construct()
    {
        $this->zone = new Zone();
    }

    public function getZone($id)
    {

        return $this->zone->where('city_id', $id)->get();
    }
}
