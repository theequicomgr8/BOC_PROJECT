<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
class SMSController extends Controller
{

    //function sms_send($mobile,$msg){
    function sms_send(Request $request)
    {
        $username = urlencode("expediensadmin"); // Put inside Username
        $password = urlencode("Pass@123"); //Put inside password
        $sender_id = urlencode("IUMSAP"); //Put inside Sender ID
        $message = urlencode("आपका नाम UG Sports की XXXX XXXX अस्थाई वरियता सूची में हैं आप अपने फॉर्म की हार्ड कॉपी आवश्यक दस्तावेजों के साथ XXXX XXXX (अंतिम तिथि)तक संबंधित संकाय/विभाग जमा करवाए तथा फॉर्म को ऑनलाइन सत्यापित करवाकर शुल्क XXXX XXXX(अंतिम तिथि)तक जमा करवाए।-IUMS");
        $mobile = "9625244657";
        $api = "https://api.instaalerts.zone/SendSMS/sendmsg.php?uname=" . $username . "&pass=" . $password . "&send=" . $sender_id . "&dest=" . $mobile . "&msg=" . $message . "&unicode=1&dlt_entity_id=1601100000000007973&dlt_template_id=1607100000000153392";
        $response = file_get_contents($api);
        dd($response);
    }

    // send mail function
    public function mailSend()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
        Mail::to('rkrajput@expediens.com')->send(new \App\Mail\BocMail($details));

        // use for send pdf
        //  $pdf = PDF::loadView('admin.pages.vendor-print.pdf-test');
        
        // $data["email"] = "rkrajput@expediens.com";
        // $data["title"] = "From ItSolutionStuff.com";
        // $data["body"] = "This is Demo";
        // $data["pdf"] = $pdf->output();
  
        // Mail::to('rkrajput@expediens.com')->send(new \App\Mail\BocMail($data));
      
        dd("Email is Sent.");
    }
}
