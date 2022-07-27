<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;
use App\Models\Api\PrivateMedia;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\RateSettlementPrivateMediaController as private_madia_api;
use App\Http\Traits\CommonTrait;

class PrivateMediaController extends Controller
{
    use CommonTrait;
    public function Privatemedia()
    {

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $state_code = "";
        $userid = Session::get('UserID');

        // Lat Long code start 
        $latlongData = DB::table('BOC$OD Latlong Detail')->select("Latitude", "Longitude", "Image File Name", "Remarks")->where('OD Vendor ID', $userid)->get();

        $data = (new private_madia_api)->showDetails($userid);
        $response = json_decode(json_encode($data), true);
        $owner_data = @$response['original']['data']['OD_owners'];
        $vendor_data = @$response['original']['data']['OD_vendors'];
        $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];
        $OD_media_address_data = @$response['original']['data']['OD_media_address'];
        if (@$vendor_data[0]['Status'] == 1 || @$vendor_data[0]['Status'] != '') {

            return view('admin.pages.rate-settlement-private-media-form', ['latlongData' => $latlongData, 'states' => $states['original']['data']])->with(compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data'));
        }
        return view('admin.pages.rate-settlement-private-media-form', ['states' => $states['original']['data'], 'latlongData' => $latlongData]);
    }
    public function fetchStates()
    {
        $states = (new api)->getStates();
        return $states;
    }
    public function fetchDistricts(Request $request)
    {
       // dd($request);
        $state_code = $request->state_code;
        $district_array = (new api)->getDistricts($state_code);
        $district['result'] = json_encode($district_array);
        return $district;
    }
    public function private_media(Request $request)
    {
        //dd($request);
        $request->session()->reflash();
        if ($request->next_tab_1 == 1) {

            // $request->validate(
            //     [
            //         // 'email_owner' => 'required',
            //         // 'mobile_owner' => 'required',
            //         // 'address' => 'required',
            //         // 'state_owner' => 'required',
            //         // 'city' => 'required',
            //         // 'district_owner' => 'required'
            //     ]
            // );

            $resp = (new private_madia_api)->privateMediaSave($request);

            $response = json_decode(json_encode($resp), true);
            //dd($response);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            }
        }


        if ($request->next_tab_2 == 1) {

            //   $request->validate
            // (
            //     [
            //         // 'HO_Address' => 'required',
            //         // 'HO_Landline_No' => 'required',
            //         // 'HO_Fax_No' => 'required',
            //         // 'HO_Email' => 'required',
            //         // 'HO_Mobile_No' => 'required',
            //         // 'BO_Address' => 'required',
            //         // 'BO_Landline_No' => 'required',
            //         // 'BO_Fax_No' => 'required',
            //         // 'BO_Email' => 'required',
            //         // 'BO_Mobile' => 'required',
            //         // 'Authorized_Rep_Name' => 'required',
            //         // 'Legal_Status_of_Company' => 'required',
            //         // 'Authority_Which_granted_Media' => 'required',
            //         // 'Contract_No' => 'required',
            //         // 'Quantity_Of_Display' => 'required',
            //         // 'License_From' => 'required',
            //         // 'License_To' => 'required',
            //         // 'MA_State' => 'required',
            //         // 'MA_District' => 'required',
            //         // 'MA_City' => 'required',
            //         // 'MA_Zone' => 'required',
            //         // 'MA_Latitude' => 'required',
            //         // 'MA_Longitude' => 'required',
            //         // 'MA_Property_Landmark' => 'required',
            //         // 'ODMFO_Year' => 'required',
            //         // 'ODMFO_Quantity_Of_Display_Or_Duration' => 'required',
            //         // 'ODMFO_Billing_Amount' => 'required',
            //         //'ODMFO_Upload_Document' => 'required',

            //     ]
            // );


            $resp1 = (new private_madia_api)->savevendordata($request);
            $response = json_decode(json_encode($resp1), true);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            }
        }
        if ($request->next_tab_3 == 1) {

            // $request->validate
            //     (
            //         [
            //             'DD_No'=>'required',
            //             'DD_Bank_Name'=>'required',
            //             'DD_Bank_Branch_Name'=>'required',
            //             'Application_Amount'=>'required',
            //             'PM_Agency_Name'=>'required',
            //             'PAN'=>'required',
            //             'Bank_Name'=>'required',
            //             'Bank_Branch'=>'required',
            //             'IFSC_Code'=>'required',
            //             'Account_No'=>'required',

            //         ]
            //     );

            $resp = (new private_madia_api)->pivateMediaSaveVendorAccount($request);
            $response = json_decode(json_encode($resp), true);
            //dd($response);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            }
            // dd($request->next_tab_3);
        }

        if ($request->submit_btn == 1) {
            //  $request->validate
            // (
            //     [
            //         // 'Legal_Doc_File_Name'=>'required',
            //         // 'Notarized_Copy_File_Name'=>'required',
            //         // 'Attach_Copy_Of_Pan_Number_File_Name'=>'required',
            //         // 'Affidavit_File_Name'=>'required',
            //         // 'Photo_File_Name'=>'required',
            //         // 'GST_File_Name'=>'required',
            //     ]
            // );
            $resp = (new private_madia_api)->privateMediaSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {
                Session::forget('line1');
                Session::forget('line2');
                return response()->json($response['original']);
            }
        }
    }

    public function updatePrivateMedia(Request $request, $media_id = '')
    {
        $request->session()->reflash();
        $sole_right_array = (new private_madia_api)->privateMediaUpdate($request, $media_id);
        $response = json_decode(json_encode($sole_right_array), true);

        if ($response['original']['success'] == true) {
            return back()->with(['status' => 'Success', 'message' => $response['original']['message']]);
        } else {
            return back()->with(['status' => 'Fail', 'message' => $response['original']['message']]);
        }
    }

    // Check uniqe Mobile no
    // check duplicate records into database
    public function checkUniqueOwner(Request $request)
    {
        //echo Session('email');
        session(['email' => $request->email, 'id' => $request->id]);
        $request->session()->reflash();
        $table1 = '[BOC$Owner]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Email ID] = '" . $request->data . "' or [Mobile No_] = '" . $request->data . "'");
        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor(Request $request)
    {
        $table1 = '[BOC$Vendor Emp - OD Media]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [HO E-Mail] = '" . $request->data . "' or [HO Mobile No_] = '" . $request->data . "' and [User ID] != '" . Session('id') . "'");
        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }





    public function fetchOwnerRecord(Request $request)
    {
        $request->session()->reflash();
        $request['key'] = 'Email ID';
        $request['owner_id'] = $request->data;
        $ownerdatas = (new private_madia_api)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdatas), true);
        //get vendor edition
        $countvendordatas = '';
        $vendorDatas = '';
        $ownerID = '';
        // $request['Owner_ID'] = $ownerdatas['original']['data'][0]['Owner ID'];
        // $vendordata = (new private_madia_api)->countVendorRecords($request);
        // $vendordata = json_decode(json_encode($vendordata), true);

        // if ($vendordata['original']['success'] == true) {
        //     $countvendordatas = count($vendordata['original']['data']);
        //     $vendorDatas = $vendordata['original']['data'];
        // }

        if ($ownerdatas['original']['success'] == true) {
            $request['key'] = 'Owner ID';
            $request['owner_id'] = $ownerdatas['original']['data'][0]['Owner ID'];
            $ownerID = (new private_madia_api)->fetchOwnerVendorMapped($request);
            $ownerID = json_decode(json_encode($ownerID), true);
            $ownerID = count($ownerID['original']['data']);

            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $state_data = "<option value=''>Select District</option>";
            foreach ($states['original']['data'] as $state) {
                $selected =  $ownerdatas['original']['data'][0]['State'] === $state['Code']  ? 'selected' : '';
                $state_data .= "<option value='" . $state['Code'] . "' $selected>" . $state['Description'] . "</option>";
            }

            $dist_array = (new private_madia_api)->getAllDistricts();
            $districts = json_decode(json_encode($dist_array), true);
            $dist_data = "<option value=''>Select District</option>";
            foreach ($districts['original']['data'] as $district) {
                $selected =  $ownerdatas['original']['data'][0]['District'] === $district['District']  ? 'selected' : '';
                $dist_data .= "<option value='" . $district['District'] . "' $selected>" . $district['District'] . "</option>";
            }
            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'state' => $state_data, 'districts' => $dist_data, 'ownerID' => $ownerID]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }





    //for private renewal 7-Dec suman
    public function privateRenewal()
    {
        return view('admin.pages.private.Private-renewal-form');
    }

    public function privateRenewalView(Request $request)
    {

        //start 7-Jan
        $boc_code = $request->boc_code;
        Session::put('vendorCode', $boc_code);

        //For Get UserID Start
        $where = array('Allocated Vendor Code' => $boc_code, "OD Media Type" => 1);
        $owner_detail_data = DB::table('BOC$OD Media Owner Detail')->select('OD Media ID as od_media_id', 'Allocated Vendor Code as vendor_code', 'Owner ID as ownerId')->where($where)->first();
        if (!empty($owner_detail_data) && $owner_detail_data != null) {
            $ownerId = $owner_detail_data->ownerId; //find ownerid from detail table
            $od_media_id = $owner_detail_data->od_media_id; //find OD Media ID from detail table 
            Session::put('ODmediaCode', $od_media_id);
            Session::put('vendorCode', $boc_code); //its Vendor Allocated Code
        } else {
            Session::flash('not_found', 'Record Not Found!' . $boc_code);
            //if record not found then redirect renewal form 3-Dec Suman
            return view('admin.pages.private.Private-renewal-form');
        }



        $find_owner_data = DB::table('BOC$Vendor Emp - OD Media')->select('User ID as UserID')->where('OD Media ID', $od_media_id)->first();
        $UserID = $find_owner_data->UserID;
        $userid = $UserID;
        //For get UserID  End  


        //check user only own data renewal start -7-Jan
        $loginid = Session::get('UserID'); //get login user ID
        if ($loginid != $userid) {
            Session::flash('not_found', 'Authorization Error!' . $boc_code);
            return view('admin.pages.private.Private-renewal-form');
        }
        //check user only own data renewal end -7-Jan
        //end

        //old code
        // $userid = Session::get('UserID'); comment by suman 7-Jan

        // Lat Long code start 
        $latlongData = DB::table('BOC$OD Latlong Detail')->select("Latitude", "Longitude", "Image File Name", "Remarks")->where('OD Vendor ID', $userid)->get();
        // $latlongData = DB::table('BOC$OD Latlong Detail')->select("Latitude","Longitude", "Image File Name","Remarks")->get();
        // dd($latlongData);
        // Lat Long code End

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $state_code = "";
        // $data = (new private_madia_api)->showRenewalDetails($userid);  old code comment by sk 7-Jan

        //check record in renewal table(OD Vendor Renewal) start sk 29-Dec
        $renewalTableRecord = DB::table('BOC$OD Vendor Renewal')->where('OD Media ID', $od_media_id)->orderBy('Line No_', 'desc')->first();
        if (!empty($renewalTableRecord)) //data exists in renewal table(OD Vendor Renewal) then run this code
        {
            $data = (new private_madia_api)->showRenewalDetails($userid);
            $response = json_decode(json_encode($data), true);
        } else {
            $data = (new private_madia_api)->showDetails($userid);
            $response = json_decode(json_encode($data), true);
        }
        //check record in renewal table end sk




        $response = json_decode(json_encode($data), true);
        $owner_data = @$response['original']['data']['OD_owners'];
        $vendor_data = @$response['original']['data']['OD_vendors'];
        $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];
        $OD_media_address_data = @$response['original']['data']['OD_media_address'];
        if (@$vendor_data[0]['Status'] == 1 || @$vendor_data[0]['Status'] != '') {

            // dd(count($latlongData));
            return view('admin.pages.private.rate-settlement-private-renewal-form', ['latlongData' => $latlongData, 'states' => $states['original']['data']])->with(compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data'));
        }

        return view('admin.pages.private.rate-settlement-private-renewal-form', ['states' => $states['original']['data']]);
    }



    //Tab 1
    public function ownerRenewal(Request $request)
    {
        $email = $request->email_owner;
        $ownerData = DB::table('BOC$Owner')->select('Email ID')->where('Email ID', $email)->first();
        if (!empty($ownerData)) {
            $update = array(
                'Owner Name' => $request->owner_name,
                'Mobile No_' => $request->mobile_owner,
                'Phone No_' => $request->phone ?? '',
                'Fax No_' => $request->fax_no ?? '',
                'Address 1' => $request->address_owner,
                'City' => $request->city,
                'District' => $request->district_owner,
                'State' => $request->state_owner
            );
            $owner_renewal = DB::table('BOC$Owner')->where('Email ID', $email)->update($update);
            // return "Owner Update Success";
            if ($owner_renewal) {
                return response()->json(["msg" => "Owner Renewal data saved", "email" => $email]);
            } else {
                return response()->json(["msg" => "Technical issues"]);
            }
        } else {
            return response()->json(["msg" => "Email Not Exists in table", "Email" => $email]);
        }
    }




    // for tab2,tab3,tab4
    public function privateRenewall(Request $request)
    {
        $userid = Session::get('UserID'); //get login user ID sk 10-Jan sk
        $getID = $request->getID;
        $ODmediaCode = Session::get('ODmediaCode'); //its OD Media ID
        $vendorCode = Session::get('vendorCode'); //get allocated vendor code
        if ($getID == 0) {
            // return "Insert";
            // $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
            $line_no = DB::table('BOC$OD Vendor Renewal')->select('Line No_')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
            if (empty($line_no)) {
                $line_no = 10000;
            } else {
                $line_no = $line_no->{"Line No_"};
                $line_no = $line_no + 10000;
            }

            //for tab 4 file upload code start
            $destinationPath = public_path() . '/uploads/private-media/';
            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;

            $odmedia_id = $request->vendorid_tab_3;
            $mtable = 'BOC$Vendor Emp - OD Media';
            $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();


            $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
            if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
                $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($file_uploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                } else {
                    $Notarized_Copy_File_Name = '';
                }
            }

            $Photo_File_Name = $mod->{'Photo File Name'} ?? '';
            if ($request->hasFile('Photo_File_Name') || $request->hasFile('Photo_File_Name_modify')) {
                $file = $request->file('Photo_File_Name') ?? $request->file('Photo_File_Name_modify');
                $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Photo_File_Name);
                if ($file_uploaded) {
                    $Photo_File_Of_Agreement = 1;
                } else {
                    $Photo_File_Name = '';
                }
            }


            $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($file_uploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                } else {
                    $Attach_Copy_Of_Pan_Number_File_Name = '';
                }
            }

            $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
            if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
                $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($file_uploaded) {
                    $Affidavit_Of_Oath = 1;
                } else {
                    $Affidavit_File_Name = '';
                }
            }


            $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
            if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($file_uploaded) {
                    $Company_Legal_Documents = 1;
                } else {
                    $Legal_Doc_File_Name = '';
                }
            }


            $GST_File_Name = $mod->{'GST File Name'} ?? '';
            if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                if ($file_uploaded) {
                    $GST_Registration = 1;
                } else {
                    $GST_File_Name = '';
                }
            }
            //for tab 4 file upload code end

            $insertArray = array(
                "OD Media ID" => $ODmediaCode,
                "Line No_" => $line_no,
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "OD Category" =>0,
                "Agreement Start Date" => '1753-01-01 00:00:00.000',
                "Agreement End Date" => '1753-01-01 00:00:00.000',
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO Fax No_" => $request->HO_Fax_No ?? '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "BO Address" => $request->BO_Address ?? '',
                "BO Landline No_" => $request->BO_Landline_No ?? '',
                "BO Fax No_" => $request->BO_Fax_No ?? '',
                "BO E-Mail" => $request->BO_Email ?? '',
                "BO Mobile No_" => $request->BO_Mobile ?? '',
                "DO Address" => $request->DO_Address ?? '',
                "DO Landline No_" => $request->DO_Landline_No ?? '',
                "DO Fax No_" => $request->DO_Fax_No  ?? '',
                "DO E-Mail" => $request->DO_Email ?? '',
                "DO Mobile No_" => $request->DO_Mobile ?? '',
                "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                "License From" => $request->License_From ?? '1753-01-01 00:00:00.000',
                "License To" => $request->License_To ?? '1753-01-01 00:00:00.000',
                // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                "Media Type"=>2,
                "Rental Agreement" => $request->Rental_Agreement ?? 0,
                "Applying For OD Media Type" => $request->Applying_For_OD_Media_Type ?? 0,
                "Media Display size" => '',
                "Illumination" => 0,
                "GST No_" => $request->GST_No ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "DD Date" => $request->DD_Date ?? '1753-01-01 00:00:00.000',
                "DD No_" => $request->DD_No ?? '',
                "DD Bank Name" => $request->DD_Bank_Name ?? '',
                "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                "Application Amount" => $request->Application_Amount ?? 0,
                "PAN" => $request->PAN ?? '',
                "Bank Name" => $request->Bank_Name ?? '',
                "Bank Branch" => $request->Bank_Branch ?? '',
                "IFSC Code" => $request->IFSC_Code ?? '',
                "Account No_" => $request->Account_No ?? '',
                "Company Legal Documents" => 0,
                "Notarized Copy Of Agreement" => 0,
                "Photographs" => 0,
                "Affidavit Of Oath" => 0,
                "GST Registration" => 0,
                "CA Certified Balance Sheet" => 0,
                "Self-declaration" => 0,
                "Legal Doc File Name" => $Legal_Doc_File_Name,
                "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                "Photo File Name" => $Photo_File_Name,
                "Affidavit File Name" => $Affidavit_File_Name,
                "GST File Name" => $GST_File_Name,
                "Balance Sheet File Name" => '',
                "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                "AR Address" => $request->AR_Address ?? '',
                "AR Landline No_" => $request->AR_Landline_No ?? '',
                "AR FAX No_" => $request->AR_FAX_No ?? '',
                "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                "AR E-mail" => $request->AR_Email ?? '',
                "Contract No_" => $request->Contract_No ?? '',
                "Quantity Of Display" => $request->Quantity_Of_Display ?? 0,


                "License Fees" => $request->License_Fee ?? 0,

                "PAN Attached" => 0,
                "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                "User ID" => $userid,
                "Status" => 0,
                "Global Dimension 1 Code" => '',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => '',
                "Recommended To Committee" => 0,
                "Modification" => 1,
                "Media Sub Category" => '',
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '1753-01-01 00:00:00.000',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $vendorCode,
                "Document Date" => '1753-01-01 00:00:00.000',
                "Empanelment Category"=>0
            );
            $vendor_renewal = DB::table('BOC$OD Vendor Renewal')->insert($insertArray); //Insert Query In Vendor renewal table 10-Jan Suman
            if ($vendor_renewal) {
                // return response()->json(["msg"=>"Renewal data saved","code"=>$vendorCode]);
                $success = ["Message" => "Renewal Data Saved", "Code" => $vendorCode];
            } else {
                // return response()->json(["msg"=>"Technical issues"]);
                $error = ["Message" => "Technical Issue"];
            }
            //insert data end in Vendor renewal table 30-Dec

            // Array Data Insert In Sole Media Address start 10-Jan suman
            $odmedia_id = $request->vendorid_tab_2;
            $line1 = $request->session()->get('line1');
            $table5 = '[BOC$Sole Medias Address]';
            $check = DB::table('BOC$Sole Medias Address')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address')->where('Sole Media ID', $odmedia_id)->delete();
            }


            if (!empty($request->MA_City[0])) {

                foreach ($request->MA_City as $key => $value) {
                    $MA_City =
                        isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';

                    $MA_State  =
                        isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                    $MA_District =
                        isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';

                    $MA_Zone =
                        isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;

                    //add extra field sk start
                    $Applying_For_OD_Media_Type = isset($request->Applying_For_OD_Media_Type[$key]) ? $request->Applying_For_OD_Media_Type[$key] : 1;
                    $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0;
                    $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0;

                    $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : '';

                    $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : '1753-01-01 00:00:00.000';
                    $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : '1753-01-01 00:00:00.000';
                    //add extra field sk end

                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : '';
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';
                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    $mediaaatable = 'BOC$Sole Medias Address';
                    // $line_id = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Sole Medias Address] where [Sole Media ID]="'.$odmedia_id.'" order by [Line No_] desc');
                    $line_id = DB::table($mediaaatable)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                    if (empty($line_id)) {
                        $line_id = '10000';
                    } else {
                        $line_id = $line_id->{"Line No_"};
                        $line_id++;
                    }
                    $sole_media = DB::table('BOC$Sole Medias Address')->insert([
                        "OD Media Type" => $Applying_For_OD_Media_Type,
                        "Sole Media ID" => $odmedia_id,
                        "Line No_" => $line_id,
                        "City" => $value,
                        "State" => $MA_State,
                        "District" => $MA_District,
                        "Zone" => $MA_Zone,
                        "Latitude" => 0,
                        "Longitde" => 0,
                        "Landmark" => $MA_Property_Landmark,
                        "Image File Name" => '',
                        "OD Media ID" => $od_media_type,
                        "Display Size" => $ODMFO_Display_Size_Of_Media,
                        "Illumination Type" => $Illumination_media,
                        "Availability Start Date" => $av_start_date,
                        "Availability End Date" => $av_end_date,
                        "Length" =>0,
                        "Width" =>0,
                        "Total Area" =>0,
                        "Rental" =>0,
                        "Rental Type" =>0,
                        "Quantity" =>0
                    ]);

                    $unique_id = $odmedia_id;
                    if (!$sole_media) {
                        // return response()->json(["msg"=>"Address Not Insert"]);
                        $success = ["Message" => "Address Insert"];
                    } else {
                        $error = ["Message" => "Address Not Insert"];
                    }


                    // $msg = 'Data Updated Successfully!';
                }
            }
            // Array Data Insert In Sole Media Address End 10-Jan

            //excel file upload start 10-Jan suman
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->hasfile('media_import')) {
                try {
                    Excel::import(new MediaExcelsImport, request()->file('media_import')); //for import
                    return $this->sendResponse('', 'Data retrieved successfully');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
            //excel file upload ebd 10-Jan Suman


            //Data add in OD Media Work Done (2nd Tab Last Add More Option) 10-Jan sk
            $table4 = 'BOC$OD Media Work done';
            $odmedia_id = $request->vendorid_tab_2;
            if (count($request->ODMFO_Year) > 0) {
                $table66 = '[BOC$OD Media Work done]';
                $table55 = 'BOC$OD Media Work done';
                $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");

                $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                if ($linenn_no > 0) {
                    DB::table('BOC$OD Media Work done')->where('OD Media ID', $odmedia_id)->where('OD Media Type', 1)->delete();
                }

                foreach ($request->ODMFO_Year as $key => $value) { //ram code start

                    $Document_FileName = '';
                    $File_Uploaded_Status = 0;
                    if (!empty($request->file('ODMFO_Upload_Document')[$key]) && array_key_exists($key, $request->file('ODMFO_Upload_Document'))) {
                        if ($request->hasFile('ODMFO_Upload_Document')) {
                            $file = $request->file('ODMFO_Upload_Document')[$key];
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $fileUploaded = $file->move(public_path() . '/uploads/private-media/', $fileName);
                            if ($fileUploaded) {
                                $File_Uploaded_Status = 1;
                                $Document_FileName = $fileName;
                            }
                        } else {
                            $Document_FileName = '';
                        }
                    } else {
                        $Document_FileName = $request->ODMFO_Upload_Document_[$key];
                    }

                    $table6 = '[BOC$OD Media Work done]';
                    $table5 = 'BOC$OD Media Work done';
                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';

                    $unique_id = $odmedia_id;
                    $msg = 'Personal Media Vender Data Updated Successfully!';


                    $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    //Find Last Line No_ by "OD Media ID" in "BOC$OD Media Work done" table 10-Jan
                    $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                    if (empty($next_line_no)) {
                        $next_line_no = 10000;
                    } else {
                        $next_line_no = $next_line_no[0]->{"Line No_"};
                        $next_line_no = $next_line_no + 10000;
                    }

                    DB::unprepared('SET ANSI_WARNINGS OFF');



                    //insert data in OD Media Work done table 10-Jan sk
                    $work_done_insert = DB::table('BOC$OD Media Work done')->insert([
                        "OD Media Type" => 1,
                        "OD Media ID" => $odmedia_id,
                        "Line No_" => $next_line_no,
                        "Work Name" => $workName,
                        "Year" => $ODMFO_Year,
                        "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                        "Billing Amount" => $ODMFO_Billing_Amount,
                        "File Name" => $Document_FileName,
                        "File Uploaded" => $File_Uploaded_Status,
                        'Allocated Vendor Code' => $allocated_vendor_code
                    ]);

                    DB::unprepared('SET ANSI_WARNINGS ON');
                    if ($work_done_insert) {
                        // return response()->json(["msg"=>"Media Not Insert"]);
                        $success = ["Message" => "Data Insert", "Code" => $allocated_vendor_code];
                    } else {
                        $error = ["Message" => "Media Address Not Insert"];
                    }
                    // }
                }
            }
            //End Data OD Media Work Done 10-Jan sk
            // return "Data Saved";
        } else //update query
        {
            // $line_no=DB::table('BOC$OD Vendor Renewal')->select('Line No_')->where('OD Media ID')->orderBy('Line No_','desc')->first();
            // if (empty($line_no)) {
            //     $line_no = 10000;
            // } else {
            //     $line_no = $line_no[0]->{"Line No_"};
            //     $line_no = $line_no + 10000;
            // }

            //for tab 4 file upload code start
            $destinationPath = public_path() . '/uploads/private-media/';
            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;

            $odmedia_id = $request->vendorid_tab_3;
            $mtable = 'BOC$OD Vendor Renewal';
            $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();


            $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';
            if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
                $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($file_uploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                } else {
                    $Notarized_Copy_File_Name = '';
                }
            }

            $Photo_File_Name = $mod->{'Photo File Name'} ?? '';
            if ($request->hasFile('Photo_File_Name') || $request->hasFile('Photo_File_Name_modify')) {
                $file = $request->file('Photo_File_Name') ?? $request->file('Photo_File_Name_modify');
                $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Photo_File_Name);
                if ($file_uploaded) {
                    $Photo_File_Of_Agreement = 1;
                } else {
                    $Photo_File_Name = '';
                }
            }

            $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($file_uploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                } else {
                    $Attach_Copy_Of_Pan_Number_File_Name = '';
                }
            }

            $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
            if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
                $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($file_uploaded) {
                    $Affidavit_Of_Oath = 1;
                } else {
                    $Affidavit_File_Name = '';
                }
            }


            $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
            if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
                $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($file_uploaded) {
                    $Company_Legal_Documents = 1;
                } else {
                    $Legal_Doc_File_Name = '';
                }
            }


            $GST_File_Name = $mod->{'GST File Name'} ?? '';
            if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
                $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $GST_File_Name);
                if ($file_uploaded) {
                    $GST_Registration = 1;
                } else {
                    $GST_File_Name = '';
                }
            }
            //for tab 4 file upload code end

            $updateArray = array(
                "OD Media ID" => $ODmediaCode,
                // "Line No_" => $line_no,
                "PM Agency Name" => $request->PM_Agency_Name ?? '',
                "OD Category"=>0,
                "Agreement Start Date" => '1753-01-01 00:00:00.000',
                "Agreement End Date" => '1753-01-01 00:00:00.000',
                "HO Address" => $request->HO_Address ?? '',
                "HO Landline No_" => $request->HO_Landline_No ?? '',
                "HO Fax No_" => $request->HO_Fax_No ?? '',
                "HO E-Mail" => $request->HO_Email ?? '',
                "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                "BO Address" => $request->BO_Address ?? '',
                "BO Landline No_" => $request->BO_Landline_No ?? '',
                "BO Fax No_" => $request->BO_Fax_No ?? '',
                "BO E-Mail" => $request->BO_Email ?? '',
                "BO Mobile No_" => $request->BO_Mobile ?? '',
                "DO Address" => $request->DO_Address ?? '',
                "DO Landline No_" => $request->DO_Landline_No ?? '',
                "DO Fax No_" => $request->DO_Fax_No  ?? '',
                "DO E-Mail" => $request->DO_Email ?? '',
                "DO Mobile No_" => $request->DO_Mobile ?? '',
                "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                "License From" => $request->License_From ?? '',
                "License To" => $request->License_To ?? '',
                // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                "Media Type"=>2,
                "Rental Agreement" => $request->Rental_Agreement ?? 0,
                "Applying For OD Media Type" => 0,
                "Media Display size" => '',
                "Illumination" => 0,
                "GST No_" => $request->GST_No ?? '',
                "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                "DD Date" => $request->DD_Date ?? '',
                "DD No_" => $request->DD_No ?? '',
                "DD Bank Name" => $request->DD_Bank_Name ?? '',
                "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                "Application Amount" => $request->Application_Amount ?? 0,
                "PAN" => $request->PAN ?? '',
                "Bank Name" => $request->Bank_Name ?? '',
                "Bank Branch" => $request->Bank_Branch ?? '',
                "IFSC Code" => $request->IFSC_Code ?? '',
                "Account No_" => $request->Account_No ?? '',
                "Company Legal Documents" => 0,
                "Notarized Copy Of Agreement" => 0,
                "Photographs" => 0,
                "Affidavit Of Oath" => 0,
                "GST Registration" => 0,
                "CA Certified Balance Sheet" => 0,
                "Self-declaration" => $request->self_declaration ?? 0,
                "Legal Doc File Name" => $Legal_Doc_File_Name,
                "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                "Photo File Name" => $Photo_File_Name,
                "Affidavit File Name" => $Affidavit_File_Name,
                "GST File Name" => $GST_File_Name,
                "Balance Sheet File Name" => '',
                "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                "AR Address" => $request->AR_Address ?? '',
                "AR Landline No_" => $request->AR_Landline_No ?? '',
                "AR FAX No_" => $request->AR_FAX_No ?? '',
                "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                "AR E-mail" => $request->AR_Email ?? '',
                "Contract No_" => $request->Contract_No ?? '',
                "Quantity Of Display" => $request->Quantity_Of_Display ?? 0,
                "License Fees" => $request->License_Fee ?? 0,
                "PAN Attached" => 0,
                "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                "User ID" => $userid,
                "Status" => 0,
                "Global Dimension 1 Code" => '',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => '',
                "Recommended To Committee" => 0,
                "Modification" => 1,
                "Media Sub Category" => '',
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '1753-01-01 00:00:00.000',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $vendorCode,
                "Document Date" => '1753-01-01 00:00:00.000',
                "Empanelment Category"=>0
            );
            //if status =6 then data again insert, or if status=0 then do Nothing (This Work Not Start Now) 10-Jan Suman start 
            @$check_status = DB::table('BOC$OD Vendor Renewal')->select('Status', 'Line No_ as lineno')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
            if (@$check_status->Status != "6") {
                $updatewhere = array('OD Media ID' => $ODmediaCode, 'Line No_' => @$check_status->lineno);
                $up = DB::table('BOC$OD Vendor Renewal')->where($updatewhere)->orderBy('Line No_', 'desc')->update($updateArray);
                if ($up) {
                    // return response()->json(["msg"=>"Renewal data Update","code"=>$vendorCode]);
                    $success = ["Message" => "Renewal data update", "Code" => $ODmediaCode];
                } else {
                    $error = ["Message" => "Renewal data not update"];
                }

                //when you chhose moving media in all Media category then status change, for readable
                // if($up)
                // {
                //     $movingmedia=implode(",",$request->Applying_For_OD_Media_Type);//convert into string                       
                //     $ary=explode(",", $movingmedia); //again convert array
                //     $total_media=count($ary); //array count

                //     $str=$movingmedia;
                //     $length=0;
                //     for($i=0;$i<strlen($str);$i++)
                //     {
                //         if($str[$i]=='3')
                //         {
                //             $length=$length+1;
                //         }
                //     }
                //     //return $length;
                //     if($length==$total_media)
                //     {
                //         $da=array(
                //             "Status"=>1
                //         );
                //         DB::table('BOC$OD Vendor Renewal')->where($updatewhere)->update($da);
                //     }
                // }

            } else {
                $line_no = DB::table('BOC$OD Vendor Renewal')->select('Line No_')->where('OD Media ID', $ODmediaCode)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }

                $againInsert = array(
                    "OD Media ID" => $ODmediaCode,
                    "Line No_" => $line_no,
                    "PM Agency Name" => $request->PM_Agency_Name ?? '',
                    "OD Category"=>0,
                    "Agreement Start Date" => '1753-01-01 00:00:00.000',
                    "Agreement End Date" => '1753-01-01 00:00:00.000',
                    "HO Address" => $request->HO_Address ?? '',
                    "HO Landline No_" => $request->HO_Landline_No ?? '',
                    "HO Fax No_" => $request->HO_Fax_No ?? '',
                    "HO E-Mail" => $request->HO_Email ?? '',
                    "HO Mobile No_" => $request->HO_Mobile_No ?? '',
                    "BO Address" => $request->BO_Address ?? '',
                    "BO Landline No_" => $request->BO_Landline_No ?? '',
                    "BO Fax No_" => $request->BO_Fax_No ?? '',
                    "BO E-Mail" => $request->BO_Email ?? '',
                    "BO Mobile No_" => $request->BO_Mobile ?? '',
                    "DO Address" => $request->DO_Address ?? '',
                    "DO Landline No_" => $request->DO_Landline_No ?? '',
                    "DO Fax No_" => $request->DO_Fax_No  ?? '',
                    "DO E-Mail" => $request->DO_Email ?? '',
                    "DO Mobile No_" => $request->DO_Mobile ?? '',
                    "Legal Status of Company" => $request->Legal_Status_of_Company ?? 0,
                    "Other Relevant Information" => $request->Other_Relevant_Information ?? '',
                    "Authority Which granted Media" => $request->Authority_Which_granted_Media ?? '',
                    "Amount paid to Authority" => $request->Amount_paid_to_Authority ?? 0,
                    "License From" => $request->License_From ?? '1753-01-01 00:00:00.000',
                    "License To" => $request->License_To ?? '1753-01-01 00:00:00.000',
                    // "Duration" => $request->Media_Type ?? '1753-01-01 00:00:00.000',
                    "Media Type"=>2,
                    "Rental Agreement" => $request->Rental_Agreement ?? 0,
                    "Applying For OD Media Type" => $request->Applying_For_OD_Media_Type ?? 0,
                    "Media Display size" => '',
                    "Illumination" => 0,
                    "GST No_" => $request->GST_No ?? '',
                    "TIN_TAN_VAT No_" => $request->TIN_TAN_VAT_No ?? '',
                    "DD Date" => $request->DD_Date ?? '',
                    "DD No_" => $request->DD_No ?? '',
                    "DD Bank Name" => $request->DD_Bank_Name ?? '',
                    "DD Bank Branch Name" => $request->DD_Bank_Branch_Name ?? '',
                    "Application Amount" => $request->Application_Amount ?? 0,
                    "PAN" => $request->PAN ?? '',
                    "Bank Name" => $request->Bank_Name ?? '',
                    "Bank Branch" => $request->Bank_Branch ?? '',
                    "IFSC Code" => $request->IFSC_Code ?? '',
                    "Account No_" => $request->Account_No ?? '',
                    "Company Legal Documents" => 0,
                    "Notarized Copy Of Agreement" => 0,
                    "Photographs" => 0,
                    "Affidavit Of Oath" => 0,
                    "GST Registration" => 0,
                    "CA Certified Balance Sheet" => 0,
                    "Self-declaration" => 0,
                    "Legal Doc File Name" => $Legal_Doc_File_Name,
                    "Notarized Copy File Name" => $Notarized_Copy_File_Name, //
                    "Photo File Name" => $Photo_File_Name,
                    "Affidavit File Name" => $Affidavit_File_Name,
                    "GST File Name" => $GST_File_Name,
                    "Balance Sheet File Name" => '',
                    "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
                    "AR Address" => $request->AR_Address ?? '',
                    "AR Landline No_" => $request->AR_Landline_No ?? '',
                    "AR FAX No_" => $request->AR_FAX_No ?? '',
                    "AR Mobile No_" => $request->AR_Mobile_No ?? '',
                    "AR E-mail" => $request->AR_Email ?? '',
                    "Contract No_" => $request->Contract_No ?? '',
                    "Quantity Of Display" => $request->Quantity_Of_Display ?? 0,
                    "License Fees" => $request->License_Fee ?? 0,
                    "PAN Attached" => 0,
                    "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                    "User ID" => $userid,
                    "Status" => 0,
                    "Global Dimension 1 Code" => '',
                    "Global Dimension 2 Code" => '',
                    "Sender ID" => '',
                    "Receiver ID" => '',
                    "Recommended To Committee" => 0,
                    "Modification" => 1,
                    "Media Sub Category" => '',
                    "Rate" => 0,
                    "Rate Status" => 0,
                    "Rate Remark" => '',
                    "Rate Status Date" => '1753-01-01 00:00:00.000',
                    "Agr File Path" => '',
                    "Agr File Name" => '',
                    "Allocated Vendor Code" => $vendorCode,
                    "Document Date" => '1753-01-01 00:00:00.000',
                    "Empanelment Category"=>0
                );
                $sql = DB::table('BOC$OD Vendor Renewal')->insert($againInsert);
                if ($sql) {
                    // $msg="Data insert in renewal success";
                    // return response()->json(["msg"=>"Again Renewal","Code"=>$vendorCode]);
                    $success = ["Message" => "Again Renewal Success", "Code" => $vendorCode];
                } else {
                    // return response()->json(["msg"=>"Again Renewal faield"]);
                    $error = ["Message" => "Again Renewal Faield"];
                }
            }
            //if status =6 then data again insert, or if status=0 then do Nothing (This Work Not Start Now) 3-Dec end


            // DB::table('BOC$OD Vendor Renewal')->where('OD Media ID',$ODmediaCode)->update($updateArray);
            //Vendor Renewal update data end 30-Dec

            // Array Data Insert In Sole Media Address start 10-Jan
            $odmedia_id = $request->vendorid_tab_2;
            $line1 = $request->session()->get('line1');
            $table5 = '[BOC$Sole Medias Address]';
            $check = DB::table('BOC$Sole Medias Address')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address')->where('Sole Media ID', $odmedia_id)->delete();
            }


            if (!empty($request->MA_City[0])) {

                foreach ($request->MA_City as $key => $value) {
                    $MA_City =
                        isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';

                    $MA_State  =
                        isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                    $MA_District =
                        isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';

                    $MA_Zone =
                        isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;

                    //add extra field sk start
                    $Applying_For_OD_Media_Type = isset($request->Applying_For_OD_Media_Type[$key]) ? $request->Applying_For_OD_Media_Type[$key] : 1;
                    $ODMFO_Display_Size_Of_Media = isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0;
                    $Illumination_media = isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0;

                    $od_media_type = isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : '';

                    $av_start_date = isset($request->av_start_date[$key]) ? $request->av_start_date[$key] : '1753-01-01 00:00:00.000';
                    $av_end_date = isset($request->av_end_date[$key]) ? $request->av_end_date[$key] : '1753-01-01 00:00:00.000';
                    //add extra field sk end

                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : '';
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';
                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    $mediaaatable = 'BOC$Sole Medias Address';
                    // $line_id = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Sole Medias Address] where [Sole Media ID]="'.$odmedia_id.'" order by [Line No_] desc');
                    $line_id = DB::table($mediaaatable)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                    if (empty($line_id)) {
                        $line_id = '10000';
                    } else {
                        $line_id = $line_id->{"Line No_"};
                        $line_id++;
                    }
                    $sole_media2 = DB::table('BOC$Sole Medias Address')->insert([
                        "OD Media Type" => $Applying_For_OD_Media_Type,
                        "Sole Media ID" => $odmedia_id,
                        "Line No_" => $line_id,
                        "City" => $value,
                        "State" => $MA_State,
                        "District" => $MA_District,
                        "Zone" => $MA_Zone,
                        "Latitude" => 0,
                        "Longitde" => 0,
                        "Landmark" => $MA_Property_Landmark,
                        "Image File Name" => '',
                        "OD Media ID" => $od_media_type,
                        "Display Size" => $ODMFO_Display_Size_Of_Media,
                        "Illumination Type" => $Illumination_media,
                        "Availability Start Date" => $av_start_date,
                        "Availability End Date" => $av_end_date,
                        "Length" =>0,
                        "Width" =>0,
                        "Total Area" =>0,
                        "Rental" =>0,
                        "Rental Type" =>0,
                        "Quantity" =>0
                    ]);

                    $unique_id = $odmedia_id;
                    // if ($sole_media2) {
                    //     $success = ["Message" => "Data Update", "Code" => $vendorCode];
                    //     // return response()->json(["msg"=>"New Media Not Insert"]);
                    // } else {
                    //     $error = ["Message" => "Media Address Not Update"];
                    // }
                    // $msg = 'Data Updated Successfully!';
                }
            }


            // Array Data Insert In Sole Media Address End 10-Jan

            //excel file upload start 3-Dec suman
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->hasfile('media_import')) {
                try {
                    Excel::import(new MediaExcelsImport, request()->file('media_import')); //for import
                    return $this->sendResponse('', 'Data retrieved successfully');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
            //excel file upload ebd 10-Jan Suman



            $table4 = 'BOC$OD Media Work done';
            $odmedia_id = $request->vendorid_tab_2;
            if (count($request->ODMFO_Year) > 0) {
                // dd($request->allocated_vendor_code);   
                $table66 = '[BOC$OD Media Work done]';
                $table55 = 'BOC$OD Media Work done';
                //Old Code
                $line_no_val = DB::select("select [Line No_] from $table66 where [OD Media ID] = '" . $odmedia_id . "'");


                $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                if ($linenn_no > 0) {
                    DB::table('BOC$OD Media Work done')->where('OD Media ID', $odmedia_id)->where('OD Media Type', 1)->delete();
                }

                foreach ($request->ODMFO_Year as $key => $value) { //ram code start

                    $Document_FileName = '';
                    $File_Uploaded_Status = 0;
                    if (!empty($request->file('ODMFO_Upload_Document')[$key]) && array_key_exists($key, $request->file('ODMFO_Upload_Document'))) {
                        if ($request->hasFile('ODMFO_Upload_Document')) {
                            $file = $request->file('ODMFO_Upload_Document')[$key];
                            $fileName = time() . '-' . $file->getClientOriginalName();
                            $fileUploaded = $file->move(public_path() . '/uploads/private-media/', $fileName);
                            if ($fileUploaded) {
                                $File_Uploaded_Status = 1;
                                $Document_FileName = $fileName;
                            }
                        } else {
                            $Document_FileName = '';
                            // unlink(public_path() . '/uploads/personal-media/'.$request->ODMFO_Upload_Document_[$key]); 
                        }
                    } else {
                        $Document_FileName = $request->ODMFO_Upload_Document_[$key];
                    }

                    $table6 = '[BOC$OD Media Work done]';
                    $table5 = 'BOC$OD Media Work done';
                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';


                    $unique_id = $odmedia_id;
                    $msg = 'Personal Media Vender Data Updated Successfully!';


                    $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    //Find Last Line No_ by "OD Media ID" in "BOC$OD Media Work done" table 10-Jan
                    $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");

                    if (empty($next_line_no)) {
                        $next_line_no = 10000;
                    } else {
                        $next_line_no = $next_line_no[0]->{"Line No_"};
                        $next_line_no = $next_line_no + 10000;
                    }

                    // DB::unprepared('SET ANSI_WARNINGS OFF');

                    // dd($allocated_vendor_code);
                    //insert data in OD Media Work done table 10-Jan sk
                    $done = DB::table('BOC$OD Media Work done')->insert([
                        "OD Media Type" => 1,
                        "OD Media ID" => $odmedia_id,
                        "Line No_" => $next_line_no,
                        "Work Name" => $workName,
                        "Year" => $ODMFO_Year,
                        "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                        "Billing Amount" => $ODMFO_Billing_Amount,
                        "File Name" => $Document_FileName,
                        "File Uploaded" => $File_Uploaded_Status,
                        'Allocated Vendor Code' => $allocated_vendor_code
                    ]);
                    // dd($ODMFO_Year);
                    DB::unprepared('SET ANSI_WARNINGS ON');

                    // }
                }
                // if ($done) {
                //     return response()->json($success);
                // } else {
                //     return response()->json($error);
                // }
                return response()->json(["msg"=>"Data Update Success"]);
            }

            //end media work done

            //End Data OD Media Work Done 10-Jan sk
            // return "Data Update Success..";

        }

    }

    public function getAgencyNameFromgst(Request $request)
    {
        $gstNumber = $request->gstNumber;
        $data = $this->AgencyNameFromgst($gstNumber);
        $gst_data = json_decode(json_encode($data), true);
        if ($gst_data['original']['success'] == true) {
            return response()->json($gst_data['original']['data']);
        } else {
            return response()->json($gst_data['original']['data']);
        }
    }
}
