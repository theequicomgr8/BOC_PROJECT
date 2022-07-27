<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;
use Session;
use response;
use Redirect;
use PDF;
use Carbon\Carbon;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\CommunityRadioController as community_radio_station;

class CommunityRadioController extends Controller
{
    public function InsertRadioForm(){

    $state_array = (new api)->getStates();
    $states = json_decode(json_encode($state_array), true);
    $state_code = "";
    $lang = (new api)->getLanguages();
    $languag2 = json_decode(json_encode($lang),true);
    $languag=$languag2['original']['data'];
    $userID =  Session::get('UserID');
    $data= (new community_radio_station)->ShowAllDetails($userID);
    //$response = json_decode(json_encode($data), true);
   //echo"<pre>"; print_r($data['OD_owners'][0]['Owner Name']);exit;
   $OD_owners =$data['OD_owners'];
   $CM_radio= $data['CM_radio'];
   $Time_Band= $data['Time_Band'];
// dd($Time_Band);

    if(!empty($data)){
      return view('admin.pages.community-radio-station-form',['result' => $states['original']['data']])->with(compact('OD_owners','CM_radio','Time_Band','languag'));
          }
    return view('admin.pages.community-radio-station-form')->with(['result'=>$states['original']['data']] );
 }

	public function saveRadio(Request $request){
		//dd($request);
		if($request->next_tab_1 == 1){

  		$resp =(new community_radio_station)->cmRadioOwnerData($request);
  			$response = json_decode(json_encode($resp), true);
          if ($response == true) {
                return response()->json($response['original']);
            }
  			}

        if($request->next_tab_2 == 1){
        	$resp= (new community_radio_station)->saveChannelDetails($request);
        	$response= json_decode(json_encode($resp), true);
        	 if($response == true)
        	{
        		 return response()->json($response['original']);
        	}
        }
        if($request->next_tab_3 == 1){
          $resp= (new community_radio_station)->AccountDetails($request);
          $response= json_decode(json_encode($resp), true);
          if($response == true)
          {
            return response()->json($response['original']);
          }

        }
        if($request->submit_btn == 1){
          $resp= (new community_radio_station)->storeDocument($request);
          $response= json_decode(json_encode($resp), true);
          if($response['original']['success'] == true)
          {
            return response()->json($response['original']);
          }

        }

		}
 public function fetchStates()
    {
        $states = (new api)->getStates();
        return $states;

    }
  public function fetchDistricts(Request $request)
  {
    $state_code = $request->state_code;
    // $district_array = (new api)->getDistricts($state_code);
    // $district['result']= json_encode($district_array);
    // dd($district);
    // return $district;
    $table2 = 'BOC$District';
    $getDist=DB::table($table2)->where('State Code',$state_code)->get();
     $html="<option value=''>Select District</option>";
    foreach($getDist as $dist)
    {
      $html.="<option value='".$dist->District."'>".$dist->District."</option>";
    }
    echo $html;
    }


 public function getAllCommRadio($Community_Radio_ID = '')
    {
        if (!empty($Community_Radio_ID)) {
            $data = (new community_radio_station)->showAllDetails($Community_Radio_ID);
            $response = json_decode(json_encode($data), true);
            if ($response['original']['success'] != '' || $response['original']['success'] != false) {
                $owner_data = $response['original']['data']['OD_owners'];
                $cmradio_data = $response['original']['data']['CM_radio'];
                $Time_Band = $response['original']['data']['Time_Band'];
                //dd($Time_Band);
                return redirect()->route('get-all-CommRadio')->with(
                    compact(
                        'owner_data',
                        'cmradio_data',
                        'Time_Band'

                    )
                );
            } else {
                return back()->with(['status' => 'Fail', 'message' => ' not found!']);
            }
        } else {
            return back()->with(['status' => 'Fail', 'message' => 'not found!']);
        }
    }


     public function findcr(Request $request){

          $tableOwner ='BOC$Owner';
          $ownerdata =DB::table($tableOwner)
          ->select('Owner ID as owner_id',
                    'Owner Name as owner_name',
                    'Mobile No_ as mobile0',
                    'Email ID as email',
                    'Phone No_ as phone',
                    'Fax No_ as fax0',
                    'Address 1 as address1',
                    'City as city0',
                    'District as ds',
                    'State as state')
          ->where('Email ID',$request->email)
          ->first();
          $response=['data1' => $ownerdata,
                    'status'=>true];
           return response()->json($response);

}
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
    $state =DB::table('BOC$State')->select('Description')->where('Code',$State_pdf)->first();
    return $state->{'Description'};
  }
  public function getLanguage($lang=''){
    $getlan =DB::table('BOC$Language')->select('name')->where('Code',$lang)->first();
    return $getlan->{'name'};
  }

   // print pdf av
    public function commuPDF($id){
        $commu_radio_table ='BOC$Vend Emp - Community Radio';
        $Owner_table ='BOC$Owner';
        $Time_band_table ='BOC$Radio Time Band';
        $commudata = DB::table($commu_radio_table)->where('Community Radio ID',$id)->first();
        //dd($commudata);
        $commu_owner_ID =@$commudata->{'Owner ID'};          //Owner Id
        $commu_Radio_id = @$commudata->{'Community Radio ID'};    //communi Radio Id
        $OD_owners=DB::table($Owner_table)->where('Owner ID',$commu_owner_ID)->first();
        $Time_band =DB::table($Time_band_table)->where(' Radio ID',$id)->first();
        //dd($Time_band);
        $Owner_State =$this->getStatePDF(@$OD_owners->{'State'});
        $getlang =$this->getLanguage(@$commudata->{'Language'});
        $pdf= PDF::loadView('admin.pages.communityprint.community-pdf',compact('commudata', 'OD_owners', 'Time_band', 'Owner_State' , 'getlang' ));
       // $pdf =PDF::loadView('admin.pages.communityprint.community-pdf');
        return $pdf->download($id. '.pdf');
    }
}
