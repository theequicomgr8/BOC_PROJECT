<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Api\DigitalCinemaController as api;
use PDF;
class DigitalCinemaController extends Controller
{
    public function Digitalview(){
    $state_array = (new api)->getStates();
    $statess = json_decode(json_encode($state_array),true);
    $states =$statess['original']['data'];

    //Get Vendor Details
    $userID =session::get('UserID');
    $Vendorres =(new api)->ShowDetails($userID);
    //dd($Vendorres);
    $vendorData =$Vendorres['vendorData'];
    $DigitalScreen =$Vendorres['DigitalScreen'];
    $district ="";
    $city ="";
    if(!empty($vendorData)){
    	$district =$this->fetchStateDistricts($vendorData->{'State'});
        $city =$this->digitalgetinsertedcity($vendorData->{'State'});
    	//dd($district);
    	return view('admin.pages.fresh-empanelment-digital-cinema-form',['states' =>$states,
    		'vendorData' =>$vendorData,'DigitalScreen'=>$DigitalScreen,'district'=>$district, 'city'=>$city]);
    }
    	return view('admin.pages.fresh-empanelment-digital-cinema-form',['states' =>$states,
    		'district'=>$district,'city'=>$city]);
    }
    public function fetchStateDistricts($state_code)
    {
            $data =(new api)->getDistricts($state_code);
            $getdis =json_decode(json_encode($data),true);
            $district =$getdis['original']['data'];
            return $district;
    }
    //GETDistrict
    public function DigitalgetDistricts(Request $request)
    {
        $state_code = $request->State_code;
        $data =(new api)->getDistricts($state_code);
        $getdis =json_decode(json_encode($data),true);
        $district =$getdis['original']['data'];
        $html="<option value=''>Select District</option>";
        foreach ($district as $key => $value) {
        $html.='<option value="'.$value['District'].'">'.$value['District'].'</option>';
    }
    echo $html;
  }


  public function DigitalgetState()
  {

    $state_array = (new api)->getStates();
    $statess = json_decode(json_encode($state_array),true);
    $states =$statess['original']['data'];
    //dd($states);
    return  $states;
    
}
    //Store first tab data

    public function DGCOwner(Request $request){
    	$resp =(new api)->DCOwnerData($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }


    //get language

    public function digitalgetCITY(Request $request)
    { 
   
    
        $data =(new api)->getallCity($request->State_code);
         $getdis =json_decode(json_encode($data),true);
        $city =$getdis['original']['data'];
        //dd($city);
        $html="<option>Select City</option>";
        foreach ($city as $key => $value) {
           
        $html.='<option value="'.$value['CityName'].'">'.$value['CityName'].'</option>';
      
        }
         echo $html;
      
    }
  
    public function digitalgetinsertedcity($city)
    { 
    
    
        $data =(new api)->getallCity($city);
        $getdis =json_decode(json_encode($data),true);
        $city =$getdis['original']['data'];
        // dd($city[0]['CityName']);
        return $city;
      
    }

    //stor second tab data

    public function DigitalSeats(Request $request){
    	//dd($request);
    	$resp =(new api)->addSeatsdetails($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }

    //Account Details

    public function AccountDetails(Request $request){
    	$resp =(new api)->SaveAccountDetails($request);
    	$response = json_decode(json_encode($resp), true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }

    public function SaveDocFile(Request $request){
    	$resp =(new api)->DOCStore($request);
    	$response =json_decode(json_encode($resp),true);
    	if($response['original']['success'] == true){
    		return response()->json($response['original']);
    	}
    }
    //IFSC api
    public function getifsc(Request $request){
    $IFSC_CODE = rawurlencode($request->IFSC);
    $url = "https://ifsc.razorpay.com/".$IFSC_CODE;
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,"$url");
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_HEADER, false);
    $postoffice_data = curl_exec($curl_handle);
    return $postoffice_data;
    }



    public function GeneratePDF($userID =''){
        $state_array = (new api)->getStates();
        $statess = json_decode(json_encode($state_array),true);
        $states =$statess['original']['data'];
    
        //Get Vendor Details
        $userID =session::get('UserID');
        $Vendorres =(new api)->ShowDetails($userID);
        //dd($Vendorres);
        $vendorData =$Vendorres['vendorData'];
        $DigitalScreen =$Vendorres['DigitalScreen'];
        $district ="";
            $district =$this->fetchStateDistricts($vendorData->{'State'});
            $pdf = PDF::loadView('admin.pages.digital-cinema-pdf',['states' =>$states,
                'vendorData' =>$vendorData,'DigitalScreen'=>$DigitalScreen,'district'=>$district]);
            return $pdf->download('Digital-cinema.pdf');
          
        }
}
