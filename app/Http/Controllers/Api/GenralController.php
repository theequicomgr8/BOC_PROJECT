<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use DB;
use Session;
class GenralController extends Controller
{
    use CommonTrait;
    
    public function ministry_code_list()
    {
        return view('admin.pages.general.ministry_code_list');
    }
    public function get_system_api(Request $request)
    {
        $ip = $request->ip();

        if($ip == '')
        {
            $response['status'] = 400;
            $response['message'] = 'No IP found. Please try again!';            
        }
        else
        {
            $response['status'] = 200;
            $response['message'] = 'Your IP is:';
            $response['system_ip'] = $ip;
            
        }
        return json_encode($response);        
    }


    public function get_login_details($email)
    {
        $user_data = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')
                        ->select('User ID','OTP as Mobile OTP','Email OTP', 'GST')
                        ->where('email',$email)
                        ->first();
        echo"<pre>";print_r($user_data);
    }

}