<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 6/2/2018
 * Time: 1:41 PM
 */

namespace App\Http\Controllers;

use App\Http\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->users = new Users();

    }

    public function Register($lang)
    {

        $input = Request()->all();
        $rules = array('mail' => 'unique:users,mail',
            'phone' => 'unique:users,phone');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            if ($lang == 'ar') {
                return ['error' => 'هذة العضويه مسجلة لدنيا'];
            } else {
                return ['error' => 'this account is exisit'];

            }


        } else {
            if ($input['password'] != $input['c-password']) {

                if ($lang == 'ar') {
                    return ['error' => 'كلمتى المرور غير متطابقتين'];
                } else {
                    return ['error' => 'The two passwords do not match'];

                }

            } else {
                $input['password'] = md5($input['password']);
                $input['c-password'] = md5($input['c-password']);
                $input['type'] = 1;
                return $this->users->create($input);
            }


        }

    }

    public function Login($lang)
    {

        $input = Request()->all();


        $check = $this->users
            ->where('phone', $input['phone'])
            ->where('password', md5($input['password']))
            ->get();
        if (count($check) > 0) {
            return $check['0'];
        } else {
            if ($lang == 'ar') {
                return ['error' => 'هذة العضويه غير مسجله لدينا'];
            } else {
                return ['error' => 'this account is not registerd'];
            }
        }

    }

    public function FaceBookLogin()
    {
        $input = Request()->all();
        $check = $this->users
            ->where('facebook_id', $input['id'])
            ->get();
        if (!empty($check)) {

            return $this->users->create([
                'mail' => $input['email'],
                'facebook_id' => $input['id'],
                'name' => $input['name'],
                'type' => 1
            ]);


        } else {

            return $check;

        }
    }

    public function TwitterLogin()
    {
        $input = Request()->all();
        $check = $this->users
            ->where('twitter_id', $input['id'])
            ->get();
        if (!empty($check)) {

            return $this->users->create([
                'name' => $input['name'],
                'twitter_id' => $input['id'],
                'secret_key' => $input['secret_key'],
                'type' => 1
            ]);


        } else {

            return $check;

        }

    }

    public function InstgramLogin()
    {
        $input = Request()->all();
        $check = $this->users
            ->where('instagram_id', $input['id'])
            ->get();
        if (!empty($check)) {

            return $this->users->create([
                'name' => $input['name'],
                'instagram_id' => $input['id'],
                'type' => 1
            ]);


        } else {

            return $check;

        }

    }

    public function UpdateUserToken($id)
    {
        $input = Request()->all();
        $this->users->find($id)->update(['token_id' => $input['token_id']]);
        return $this->users->where('user_id', $id)->get();
    }

    public function ForegetPassword($lang)
    {
        $input = Request()->all();
        $check = $this->users
            ->where('mail', $input['mail'])
            ->get();

        if (count($check) > 0) {
            $newpassword = $this->GereatePassowrd();
            $url = "http://www.zadalsharq.com/ar5ss/public/api/lodocsendmail";
            $postlength = array(
                'mail' => $input['mail'],
                'name' => $check['0']['name'],
                'newPassword' => $newpassword
            );
            $ch = curl_init($url);
            # Setup request to send json via POST.
            $payload = json_encode($postlength);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            # Return response instead of printing.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            # Send request.
            echo $result = curl_exec($ch);
            curl_close($ch);

            $this->users->where('mail', $input['mail'])->update(['password' => md5($newpassword)]);

            if ($lang == 'ar') {
                return ['success' => 'تم ارسال كلمة المرور الى بريدك الالكترونى'];

            } else {
                return ['success' => 'send new password to email'];
            }
        } else {
            if ($lang == 'ar') {
                return ['error' => 'هذه العضويه غير مسجله'];

            } else {
                return ['error' => 'this account is not vaild'];
            }
        }


    }

    protected function GereatePassowrd()
    {

        return $newpassrod = mt_rand(1000, 9999);
    }

}