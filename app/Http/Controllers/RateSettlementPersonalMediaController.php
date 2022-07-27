<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use App\Http\Controllers\Api\RateSettlementPersonalMediaController as api;

class RateSettlementPersonalMediaController extends Controller
{

    public function index()
    {
        return view('admin.pages.rate-settlement-personal-media-form');
    }

    public function personalMediaSave(Request $request)
    {  
        $request->validate(
            [
                'email.*' => 'required',        
                  'mobile.*' => 'required',
                  'address.*' => 'required',
                  'HO_Email' => 'required',
                  'HO_Mobile_No_' => 'required',
                  'HO_Landline_No_' => 'required',
                  'HO_Address' => 'required',
                  'HO_Fax_No_' => 'required',
                  'BO_Email' => 'required',            
                  'BO_Mobile' => 'required',
                  'BO_Landline_No_' => 'required',
                  'BO_Address' => 'required',
                  'BO_Fax_No_' => 'required',
                  'DO_Email' => 'required', 
                  'DO_Mobile' => 'required',     
                  'DO_Landline_No_' => 'required',        
                  'DO_Address' => 'required',
                  'DO_Fax_No_' => 'required',                
                  'legal_status_company' => 'required',
                  'relevant_information' => 'required',
                  'Amount_paid_Authority' => 'required',
                  'year.*' => 'required',
                  'quantity_duration.*' => 'required',
                  'billing_amount.*' => 'required',
                  'DD_No_' => 'required',
                  'DD_Date' => 'required',        
                  'DD_Bank_Name' => 'required',
                  'DD_Bank_Branch_Name' => 'required',
                  'agency_name1' => 'required',
                  'PAN' => 'required',
                  'Bank_Name' => 'required',
                  'Bank_Branch' => 'required',
                  'IFSC_Code' => 'required',
                  'Account_No_' => 'required',       
                  'Legal_Doc_File_Name' => 'required',
                  'Notarized_Copy_File_Name' => 'required',
                  'Photo_File_Name' => 'required',
                  'Affidavit_File_Name' => 'required',
                  'GST_File_Name' => 'required', 
            ]
        );
        
        $resp = (new api)->apiPersonalMediaSave($request);        
        $response = json_decode(json_encode($resp),true);
       // dd($response);
        if($response['original']['success'] == true){
           return back()->with(['status' => 'Success', 'message' => $response['original']['message'] ]);
        }else{
            return back()->with(['status' => 'Fail', 'message' => $response['original']['message'] ]);
        }
    }
 
    public function personalMediaView(Request $request)
    {
        $request->validate(
            [
                'davp_code' => 'required'
            ]
        );
        $resp = (new api)->apiPersonalMediaView($request);        
        $response = json_decode(json_encode($resp),true);
       // dd($response);
        if($response['original']['success'] == true){
            return redirect()->route('rate-settlement-personal-media')->with(['OD_owners' => $response['original']['data']['OD_owners'], 'OD_vendors' => $response['original']['data']['OD_vendors'][0], 'OD_work_dones' => $response['original']['data']['OD_work_dones']]);
        }else{
            return back()->with(['status' => 'Fail', 'message' => $response['original']['message'] ]);
        }       
    }

    public function personalMediaUpdate(Request $request)
    {
        $resp = (new api)->apiPersonalMediaUpdate($request);        
        $response = json_decode(json_encode($resp),true);
       // dd($response);
        if($response['original']['success'] == true){
            return back()->with(['status' => 'success', 'message' => $response['original']['message'] ]);
        }else{
            return back()->with(['status' => 'Fail', 'message' => $response['original']['message'] ]);
        }
    }
   
}
