<?php
/**
 * Created by PhpStorm.
 * User: Bellal
 * Date: 9/9/2018
 * Time: 11:19 PM
 */

namespace App\Http\Controllers;

use App\Http\Models\Users;
use App\Http\Models\ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB ; 
use Carbon\Carbon;


class AdvsController extends Controller
{
    function push_special(){
        $title = 'عرض جديد من لودوك' ;
        $message = 'أضغط لمشاهدة آخر عروض لودوك' ; 
        $data=["click_action"=>"FLUTTER_NOTIFICATION_CLICK"];
        return $this->pushAds($message,$title,$data);
    }
    function pushAds($message,$title,$data)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAqF_qKgA:APA91bEGPPp-9gfkQs7qvOquiOmtOD0zVY7IuDDWtXcPjcHgDkMsNmfwgGLUNRyePswCr_9NTkdijL3tfJDVVabJYVHSuOg7iWGhA_PML9wV4Putr2Qgs-l5p9wFAWow4MGK_hySinvw';
        // $data = array('notification_data' => $notification , 'advertise_data' => $advertise);
        $notification = array('title' => $title, 'text' => $message, 'sound' => 'default', 'badge' => '1', 'click_action' => 'FLUTTER_NOTIFICATION_CLICK');

        
        $arrayToSend = array('to' => '/topics/all_devices',
                            'notification' => $notification,
                            'priority' => 'high'
                        );

        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
     if ($response === FALSE) {
         die('FCM Send Error: ' . curl_error($ch));
      } else {
        //    echo $response;
        }
        curl_close($ch);
        return $response;
    }
      
     
    /*function pushAds($message,$title,$data)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AIzaSyDHAC0YXg-dJtPwjHDWeQM-Ym6ImltR6Ag';
        $notification = array('title' => $title, 'text' => $message, 'sound' => 'default', 'badge' => '1' , "click_action"=>"FLUTTER_NOTIFICATION_CLICK");
        $arrayToSend = array('to' => '/topics/all_devices', 'notification' => $notification,'data' => $data, 'priority' => 'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
     if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    } else {
          echo $response;
       }
        curl_close($ch);
       
    }*/
    public function showAds(){
        $ads = DB::table('ads')
        ->where('pending','=',1)
        ->whereDate('to_date', '>=', Carbon::today()->toDateString())
        ->get(); 
        return response()->json($ads) ;
    }

}