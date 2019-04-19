<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Doctors;
use App\Http\Models\Users;
use App\Http\Models\Specializations;
use App\Http\Models\DocotrsPhone;
use App\Http\Models\Hospital;

class JoinUsController extends Controller
{
    //
    public function __construct()
    {
        $this->doctors = new Doctors();
        $this->users = new Users();
        $this->specializations = new Specializations();
        $this->doctors_phone = new DocotrsPhone();
        $this->hospital = new Hospital();
    }

    public function JoinUsAsDoctor()
    {


        $input = Request()->all();
        $input['type'] = 2;
        $users = $this->users->create($input);
        $user_id = $users->user_id;
        $image = $input["image"];
        $jpg_name = "photo-" . time() . ".png";
        $path = public_path() . "/docsprofile/" . $jpg_name;
        $input["image"] = "docsprofile/" . $jpg_name;
        $img = substr($image, strpos($image, ",") + 1);//take string after ,
        $imgdata = base64_decode($img);
        $success = file_put_contents($path, $imgdata);
        $input['user_id'] = $user_id;

        $input['type']=1;
        $input['rate']=5 ; 
        $output = $this->doctors->create($input);
        $output['c-register']=$input['c-register'];
        $output->save();
        $doctor_id = $output->doctors_id;
        $input['doctors_id']=$doctor_id;
        $this->specializations->create($input); //create doctor_id // Bellal

        // for ($i = 0; $i < count($input['doctor_phones']); $i++) {
        //     $input['doctor_phones'][$i]['doctors_id'] = $doctor_id;
        //     $this->doctors_phone->create($input['doctor_phones'][$i]);
        // }

        return ['state' => '202'];

    }

    public function JoinUsAsHospital()
    {
        $input = Request()->all();
        $input['type'] = 3 ;
        $user_id = $this->users->create($input);
        $input['user_id']=$user_id['user_id'] ; 
        $input['hospital_name'] = $user_id['name'] ; 
         $this->hospital->create($input);
        return ['state' => '202'];

    }
}
