<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Users ;
use App\Http\Models\Doctors ;
use App\Http\Models\ads ;
use DB ;
use App\Mail\register;
use Carbon\Carbon ;
use Mail;

// use Illuminate\Support\Facades\Storage ;


class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $usersData = Users::join('doctors','doctors.user_id','users.user_id')
        ->select('users.user_id','users.name','users.phone','users.address','users.type','users.state','users.created_at','doctors.image')
        ->where('users.pending','=',1)
        ->orderby('created_at','desc')->get() ;
        return $usersData ;


    }
    public function showRequests()
    {

        $users = DB::table('users')

        ->select('users.user_id','users.name','users.phone','users.address','users.type','users.state','users.created_at')
            ->where('users.pending','=',0)
            ->where('users.type','!=',1)
            ->orderby('created_at','desc')->get() ;
            
        
        return $users ;


    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $user = Users::find($id);
        //
        //$final = $input->only([''])
        //
        if($user['state'] == 0) {
            $user['state'] = 1 ;
        }else {
            $user['state'] = 0 ;
        }
         
         
         $user->save() ;

       return $user ;

    }
    public function acceptPending($id) {
        //$input = Request()->all();
        $users = Users::find($id);

        if($users['pending'] == 0) {
            $users['pending'] = 1 ;
            $msg = 'السلام عليكم' ;
            $newPass =str_random(6);
            $hash = $newPass;

            $data = array('name'=>$users['name'], "body" => $hash);
            
            $mail = Mail::send('emails.registerMail', $data, function($message)use($users) {

               $message->to($users['mail'], 'Lodoc User')
                   ->subject('Lodoc Confirmation');
               $message->from('postmaster@admin.locationdoctor.com','LoDoc Admin');
           });
           
           $users['password']=md5($newPass);

        }else {
            $users['pending'] = 0 ;
            return 0;
        }
        $users->save();
        return 1 ;
    }
    public function storePass($newPass){


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        $doctors = Doctors::where('user_id',$id)->delete() ; 
        $user->delete();
        return $user ;
    }
    public function sendmail()
    {
        global $body;
        global $ordersDetails;
        $from = "info@ar5ss.com";
        $request = Request()->all();
        $from = "info@ar5ss.com";
        $ClintMail = $request['ClintMail'];
        $SupplierMail = $request['SupplierMail'];
        $message = $request['message'];
        $orders = $request['orderdetails'];
//        $ClintMail = $ClintMail;
//        $SupplierMail = $SupplierMail;
//        $message = $message;
//        $orders =$orders;
        for ($i = 0; $i < count($orders); $i++) {
            $ordersDetails .= 'ItemName' . $orders[$i]['product_name'] . ' | ItemPrice ' . ': ' . $orders[$i]['ProductPriceDesc'] . ' | ItemCont' . ': ' . $orders[$i]['QTY'];
            $body = $ordersDetails;
        }
        $ehead = "From: " . $from . "\r\n";
        $to = $ClintMail;
        $to_2 = $ClintMail;
        $subject = $message;
        $to = $ClintMail;
        $to_2 = $SupplierMail;
        $from = $from;
        $headers = "From: " . ($from) . "" . "\r\n";
        $headers .= "Reply-To:" . ($from) . "\r\n";
        $headers .= "Return-Path: The Sender <" . ($from) . ">\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
        $headers .= "X-Priority: 3\r\n";
        $result = mail($to, $subject, $body, $headers);
        $result2 = mail($to_2, $subject, $body, $headers);
        echo $result;
//       return $output = ["msg" => "send a new password please check your email"];
    }
    public function updatepending($ad_id){
        $ad = ads::find($ad_id);
       
        if($ad['pending'] == 0) {
            $ad['pending'] = 1 ;
            app('App\Http\Controllers\AdvsController')->push_special();
        }else {
            $ad['pending'] = 0 ;
        }
         $ad->update() ;
         

       return $ad ;
    }
    public function showAds($admin_id){
        $ads = DB::table('ads')
        ->whereDate('to_date', '>=', Carbon::today()->toDateString())
        ->orderBy('ad_id', 'desc')
        ->get();
        return $ads ; 
    }
    public function updateToHour($ad_id){
        $input = Request()->all();  
        ads::where('ad_id',$ad_id)->update(['to_date' => $input[0]]) ; 
        return 1 ; 
    }
}
