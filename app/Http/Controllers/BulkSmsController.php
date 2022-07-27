<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
use response;
use Redirect;
use Carbon\Carbon;
use PDF;
use App\Http\Controllers\Api\ApiBulkSmsController as bulk_sms;
class BulkSmsController extends Controller
{
 
    public function InsertBulkSms() {
    $state_array = (new bulk_sms)->getStates();
    $district_array= (new bulk_sms)->getDistricts();
    $states = json_decode(json_encode($state_array), true);
    $state_code = "";
    $user_ID = Session::get('UserID');
    $data= (new bulk_sms)->ShowAllDetails($user_ID);
    $district ="";
    $city ="";
    if(!empty($data)){
        $district =$this->fetchStateDistricts($data->{'State'});
        $city =$this->bulkgetinsertedcity($data->{'State'});

      return view('admin.pages.bulk-sms-obd-form',['result' => $states['original']['data'],'Bluksms'=>$data,'dist'=>$district,'city'=>$city]);
          }
    return view('admin.pages.bulk-sms-obd-form')->with(['result'=>$states['original']['data'], 'dist'=>$district,'city'=>$city] );
 }

    public function SaveBulkSms(Request $request)
    {

  		$resp =(new bulk_sms)->bulkSmssaveData($request);
  			$response = json_decode(json_encode($resp), true);
        //dd($response);
          if ($response == true) {
                return response()->json($response['original']);
        }
}

    public function fetchStateDistricts($state_code)
  { 
        $data =(new bulk_sms)->getDistricts($state_code);
         $getdis =json_decode(json_encode($data),true);
        $district =$getdis['original']['data'];
     return $district;
  } 
   public function fetchDistricts(Request $request)
  {
   
    $state_code = $request->state_code;  
    $data =(new bulk_sms)->getDistricts($state_code);
         $getdis =json_decode(json_encode($data),true);
        $district =$getdis['original']['data'];


     $html="<option value=''>Select District</option>";
    foreach($district as $dist)
    {
      $html .="<option value='".$dist['District']."'>".$dist['District']."</option>";
    }
        echo  $html;
    }
    //get city 
    public function bulkgetCITY(Request $request)
    { 

        $data =(new bulk_sms)->getallCity($request->state_code);
         $getdis =json_decode(json_encode($data),true);
        $city =$getdis['original']['data'];
        //dd($city);
        $html="<option>Select City</option>";
        foreach ($city as $key => $value) {
        $html.='<option value="'.$value['CityName'].'">'.$value['CityName'].'</option>';
      
        }
         echo $html;
      
    }
  
    public function bulkgetinsertedcity($city)
    { 
    
    
        $data =(new bulk_sms)->getallCity($city);
        $getdis =json_decode(json_encode($data),true);
        $city =$getdis['original']['data'];
        // dd($city[0]['CityName']);
        return $city;
      
    }
    
    public function getAllBulksms($user_ID = '')
    {
      //dd('hello');
        if (!empty($Agency_Code)) {
            $data = (new bulk_sms)->ShowAllDetails($Agency_Code);
            $response = json_decode(json_encode($data), true);
            if ($response['original']['success'] != '' || $response['original']['success'] != false) {
                $bluksms = $response['original']['data']['Bluksms'];
                
                //dd($bluksms);
                return redirect()->route('get-all-Bluksms')->with(compact('Bluksms'));
            } else {
                return back()->with(['status' => 'Fail', 'message' => ' not found!']);
            }
        } else {
            return back()->with(['status' => 'Fail', 'message' => 'not found!']);
        }
    }

     public function checkgst(Request $request)
    {
       $getGST=$request->GST_NO;

        //Server url 09AADCS2308B1ZU
        $url = "https://apisetu.gov.in/gstn/v1/taxpayers/$getGST";
        $apiKey = 'LoYt543GxbGJJuV6KXbgvs0EmNv9INJk'; // should match with Server key
        $headers = array(
            // 'Authorization: '.$apiKey
            "accept: application/json", 
            "X-APISETU-CLIENTID: in.nic.davp",
            "X-APISETU-APIKEY: LoYt543GxbGJJuV6KXbgvs0EmNv9INJk",

        );
        // Send request to Server
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        // Decode
        $result = json_decode($response);
        // dd($result);
        return $result;
    }

//IFSC Code Api
public function getifsc(Request $request){
    //dd($request->IFSC);
$IFSC_CODE = rawurlencode($request->IFSC);
$url = "https://ifsc.razorpay.com/".$IFSC_CODE;
$curl_handle=curl_init();
curl_setopt($curl_handle, CURLOPT_URL,"$url");
curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_handle, CURLOPT_HEADER, false);
$IFSC_data = curl_exec($curl_handle);
//dd($IFSC_data);
return $IFSC_data;
}

//Generate Pdf code

public function generatepdfBulkSms($userID='') {
    $state_array = (new bulk_sms)->getStates();
    $district_array= (new bulk_sms)->getDistricts();
    $states = json_decode(json_encode($state_array), true);
    $state_code = "";
    $user_ID = Session::get('UserID');
    $data= (new bulk_sms)->ShowAllDetails($user_ID);
    $district ="";
    if(!empty($data)){
        $district =$this->fetchStateDistricts($data->{'State'});
        $pdf =PDF::loadView('admin.pages.bulk-sms-pdf',['result' => $states['original']['data'],'Bluksms'=>$data,'dist'=>$district]);
        return $pdf->download('bulk-sms.pdf');
          }
 }


}
          