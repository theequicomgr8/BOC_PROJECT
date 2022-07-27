<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Api\ApiInternetWebController as Webapi;
class InternetWebsiteController extends Controller
{
      public function internetWebSave(Request $request) {
        $data =(new Webapi)->getStates();
        $da =json_decode(json_encode($data),true);
        $state =$da['original']['data'];
        //Show all detail
        $userid =session::get('UserID');
        $VendorData =(new Webapi)->ShowDetails($userid);
        if(!empty($VendorData)){
        return view('admin.pages.internet-website',['state'=>$state,'VendorData'=>$VendorData]);
        }
        return view('admin.pages.internet-website',['state'=>$state]);
    }

        //get city 
        public function websitegetCITY($state_code="")
        { 
       
        
            $data =(new bulk_sms)->getallCity($state_code);
             $getdis =json_decode(json_encode($data),true);
            $city =$getdis['original']['data'];
            //dd($city);
            $html="<option>Select City</option>";
            foreach ($city as $key => $value) {
            $html.='<option value="'.$value['CityName'].'">'.$value['CityName'].'</option>';
          
            }
             echo $html;
          
        }
      
        public function websitegetinsertedcity($city)
        { 
        
        
            $data =(new bulk_sms)->getallCity($city);
            $getdis =json_decode(json_encode($data),true);
            $city =$getdis['original']['data'];
            // dd($city[0]['CityName']);
            return $city;
          
        }
    public function saveInternetWebsite(Request $request)
    {
            $resp = (new Webapi)->internetWebSave($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }

            if($request->next_tab_1 == 1){
                $resp =(new Webapi)->internetWebSave($request);
                    $response = json_decode(json_encode($resp), true);
                if ($response == true) {
                     return response()->json($response['original']);
                }

            }

    }

    public function intfetchDistricts(Request $request)
    {
        $district_array = (new  Webapi)->getDistricts($request->state_id);
        $districts = json_decode(json_encode($district_array), true);
        //dd($districts);
        $dist_data = "<option value=''>Select District</option>";
        if ($districts['original']['success'] == true) {
            foreach ($districts['original']['data'] as $district) {
                $dist_data .= "<option value='" . $district['District'] . "'>" . $district['District'] . "</option>";
            }
            return response()->json(['status' => 1, 'message' => $dist_data]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkgst(Request $request)
    {
        $getGST=$request->gstNumber;
        //Server url 09AADCS2308B1ZU
        $url = "https://apisetu.gov.in/gstn/v1/taxpayers/".$getGST;
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
        $result = json_decode($response);
        // dd($response->legalName);
        // dd($result->legalName);
        // echo $result->legalName;
        return $result;
    }

    public function internetWebPDF($userid)
    {
        $userid =session::get('UserID');
        $VendorDatapdf =(new Webapi)->ShowDetails($userid);
        $pdf = \PDF::loadView('admin.pages.internetWebsite-pdf', compact('VendorDatapdf'));
        return $pdf->download($userid . '.pdf');
    }

}
