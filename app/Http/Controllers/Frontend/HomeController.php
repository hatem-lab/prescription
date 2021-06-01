<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        return view('home');
    }

    public function testFCM(){
        return view('firebase');
    }

    public function sendNotification(){
        $token = "eVMUQ3JESIGkEYun-XFpoV:APA91bH-AJPITq27H_RWiMX383_yNNw_JO9U4DReI3JN2cfEVRGOn0k9N-7fNSordOyJWQwAjj2ywnw_VhwOgTVn0RZcYLGYwHEFuCD6F1eH_PbpJWSouOhuQKSzRTqJZ0vAr9fW5iQu";
        $from = "AAAAc6K9nB8:APA91bFVodFLeMSucOBK--RCmJaWEQC3JgCoo34y9r4ze-5CistlbIeeSG--hN9uJrON63TUacViVe41ezkQAbVJYXPq2hYCy37XIfL6jpScKwrIz6QoCK27NjyznwxqS1aeAoeI1I2o";
        $msg = array
        (
            'body'  => "Test Test",
            'title' => "Hi, From Diyaa",
            'receiver' => 'erw',
            'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'        => $token,
            'notification'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . $from,
            'Content-Type: application/json'
        );
        //#Send Response To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    }

}
