<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 6/2/2018
 * Time: 12:57 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Users;
use App\Http\Models\Favourit;
use App\Http\Models\MedicalSpecialties;
use App\Http\Models\Doctors;
use App\Http\Models\Specializations;


class FavouriteController extends Controller
{

    public function __construct()
    {
        $this->medical_specialties = new MedicalSpecialties();
        $this->users = new Users();
        $this->doctors = new Doctors();
        $this->specializations = new Specializations();
        $this->favourit = new Favourit();
    }


    public function AddToFavourit($lang)
    {

        $input = Request()->all();

        $check = $this->favourit
            ->where('user_id', $input['user_id'])
            ->where('doctors_id', $input['doctors_id'])
            ->get();
        if (count($check) > 0) {
            if ($lang == 'ar')
                return ['error' => 'تم اضافه الطبيب الى المفضله من قبل'];
            if ($lang == 'en')
                return ['error' => 'The doctor has been added to the favorite Before'];
        } else {
            return $this->favourit->create($input);

        }

    }

    public function DeleteFromFavourit($id)
    {
        $this->favourit->find($id)->delete();
        return ['state' => 202];
    }

    public function GetMyfavourit($id)
    {

        if (is_numeric($id)) {

            $output = $this->favourit->with(['Doctors' => function ($query) {
                $query->with('DoctrsSpecializations.Specializations')
                    ->with('Users');
            }])
                ->where('user_id', '=', $id)
                ->get();
        } else {

            $output = $this->favourit->with(['Doctors' => function ($query) {
                $query->with('DoctrsSpecializations.Specializations')
                    ->with('Users');
            }])
                ->where('token_id', '=', $id)
                ->get();
        }

        return $output;
    }


}