<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use Redirect;
use response;
use PDF;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\PrivateFMStationController as FMapi;
class FmStationController extends Controller
{
   public function StateDropdown()
  {
    $state_array = (new api)->getStates();
    $statess = json_decode(json_encode($state_array),true);
    $states =$statess['original']['data'];
    $state_code = "";
    $lang = (new api)->getLanguages();
    $languag1 = json_decode(json_encode($lang),true);
    $languag=$languag1['original']['data'];
    $userid = Session::get('UserID');
    $response =(new FMapi)->ShowAllDetails($userid);
    $FMdata=$response['FMdata'];
    $OD_owners =$response['OD_owners'];
    $Time_band =$response['Time_band'];
    $Payment_Status =$response['Payment_Status'];
    $dist="";
    $city =""; 
    //dd($FMdata);
    if($FMdata !=''){
      $dist=$this->FMDistricts(@$OD_owners->State);
      $city =$this->FMCITY(@$OD_owners->State);
      //dd($city);
   return view('admin.pages.fm-station-form' ,['dist'=>$dist,'city'=>$city])->with(compact('languag','states', 'FMdata','OD_owners','Time_band','Payment_Status'));
          }
      return view('admin.pages.fm-station-form',['dist'=>$dist,'city'=>$city])->with(compact('languag','states'));    
      }
  //Get District function    
   public function FMfetchDistricts(Request $request)
  { 
     $state_code = $request->state_code;  
      $data =(new api)->getDistricts($state_code);
       $getdis =json_decode(json_encode($data),true);
      $district =$getdis['original']['data'];
      $html="<option value=''>Select District</option>";
      foreach ($district as $key => $value) {
      $html.='<option value="'.$value['District'].'">'.$value['District'].'</option>';
    
      }
      echo $html;
    
  }

  public function FMDistricts($state_code)
  { 
     $state_code = $state_code;  
      $data =(new api)->getDistricts($state_code);
       $getdis =json_decode(json_encode($data),true);
      $district =$getdis['original']['data'];
     return $district;
  }


  public function FMgetCITY(Request $request)
  { 
      $data =(new api)->getallCity($request->state_code);
       $getdis =json_decode(json_encode($data),true);
      $city =$getdis['original']['data'];
      $html="<option>Select City</option>";
      foreach ($city as $key => $value) {
           
        $html.='<option value="'.$value['CityName'].'">'.$value['CityName'].'</option>';
      
        }
       echo $html;
    
  }

  public function FMCITY($statecode)
  { 
      $data =(new api)->getallCity($statecode);
       $getdis =json_decode(json_encode($data),true);
      $city =$getdis['original']['data'];
      return $city;
      // $html="<option>Select City</option>";
      // // foreach ($city as $key => $value) {
      // // $html.='<option value="'.$value['CityName'].'">'.$value['CityName'].'</option>';
    
      // // }
      // //  echo $html;
    
  }

  public function fmStation(Request $request){
  	if($request->next_tab_1 == 1){
   
  		$resp =(new FMapi)->fmStationOwnerData($request);
  			$response = json_decode(json_encode($resp), true);
          if ($response == true) {
                return response()->json($response['original']);
  				}
  			}  
        if($request->next_tab_2 == 1){
          $resp =(new FMapi)->saveVanderdetails($request);
        $response =json_decode(json_encode($resp), true);
        if($response == true){
          return response()->json($response['original']);
        }
        }
        if($request->next_tab_3 == 1){
           $resp =(new FMapi)->ACdetails($request);
          $response = json_decode(json_encode($resp), true);
          if($response == true){
            return response()->json($response['original']);
          }
        }

        if($request->submit_btn == 1){
          $resp =(new FMapi)->storeDOC($request);
          $response =json_decode(json_encode($resp), true);
       if($response['original']['success'] == true){
       return response()->json($response['original']);
        }
        
        }
    
		}
    public function findfm(Request $request){
           $tableOwner ='BOC$Owner';
          $ownerdata =DB::table($tableOwner)
          ->select('Owner ID as owner_id',
                    'Owner Name as owner_name',
                    'Mobile No_ as mobile_no',
                    'Email ID as email_id',
                    'Phone No_ as phone_no',
                    'Fax No_ as fax_no',
                    'Address 1 as address_a',
                    'Address 2 as address_b',
                    'City as city',
                    'District as d',
                    'State as state')
          ->where('Email ID',$request->Email_data)
          ->first();
          $response=['owner' => $ownerdata,
                    'status'=>true];
            return $response;
            

}

 public function checkgst(Request $request)
    {
      
       $getGST=$request->GST_name;

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
         //dd($result);
        return $result;
    }
//IFSC Code Api
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
public function getStatePDF($State_pdf =""){
  $state =DB::table('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c')->select('Description')->where('Code',$State_pdf)->first();
  return $state->{'Description'};
}
// print pdf av
public function avPDF($id){
  $gst =Session::get('Gst');
  $lang = (new api)->getLanguages();
  $languag1 = json_decode(json_encode($lang),true);
  $languag=$languag1['original']['data'];
 $Pvt_FM_table ='BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2'; 
 $Owner_table ='BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
 $Time_band_table ='BOC$FM Program Schedule$3f88596c-e20d-438c-a694-309eb14559b2';
 $FMdata = DB::table($Pvt_FM_table)->where('FM Station ID',$id)->first();
 $FM_owner_ID =@$FMdata->{'Owner ID'};          //Owner Id
 $FM_Radio_id = @$FMdata->{'FM Station ID'};    //FM Radio Station Id
 $OD_owners=DB::table($Owner_table)->where('Owner ID',$FM_owner_ID)->first();
$Time_band =DB::table($Time_band_table)->where('Station ID',$id)->first(); 
$Owner_State =$this->getStatePDF(@$OD_owners->{'State'});
$pdf= PDF::loadView('admin.pages.AV-pdf.pvt-fm-station',[ 'FMdata'=>$FMdata,'OD_owners'=>$OD_owners,'Time_band'=> $Time_band, 'Owner_State' =>$Owner_State, 'getlang'=>$languag,'gst'=>$gst]);
return $pdf->download($id. '.pdf');

}

public function channelAPI()
{
  //  dd('asfsdf');

    //Server url 09AADCS2308B1ZU
    $url = "http://alb-sit-boweb-1132114032.ap-south-1.elb.amazonaws.com/rest/GenericService/executeProcessWithJson";
   
    $headers = array(
        "accept: application/json", 
        "serviceName:getTviChannelDetailsForBOC",
        "channelName: Aajtak HD",
    );
    // Send request to Server
    $ch = curl_init($url);
    // To save response in a variable from server, set headers;
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // Get response
    $response = curl_exec($ch);
    // Decode
   //dd($response);
    $result = json_decode($response);
     dd($result);
    return $result;
}

}