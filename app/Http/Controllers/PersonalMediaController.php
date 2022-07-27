<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\PersonalMediaController as personalmedapi;
use Session;
use redirect;
use PDF;
use App\Http\Traits\CommonTrait;
use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonalMediaExcelsImport;
use App\Models\Api\MediaCirculationDone;
use App\Imports\PersonalMediaExcelsImportDone;

class PersonalMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait;

    public function InsertpersonalMedia()
    {
        if (!Session::has('id')) {
            return redirect('/vendor-login');
        } else {

            $url = last(request()->segments());

            if ($url == "rate-settlement-personal-media") {
                $state_array = (new api)->getStates();
                $states = json_decode(json_encode($state_array), true);
                $state_code = "";

                $userID =  session::get('UserID');

                $check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $userID, "OD Category" => 1, "Modification" => 0])->orderBy('OD Media ID', 'desc')->first();
                if (!empty($check)) {
                    $where = array('OD Category' => 1, 'User ID' => $userID, "Modification" => 0);
                    $mediaid = $check->{'OD Media ID'};
                } else {
                    $where = array('OD Category' => 1, 'User ID' => $userID);
                    $mediaid = '';
                }

                $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 1);
                // $authorize=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
                $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
                $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $mediaid)->get(); //for media category
                //for all category display sk
                $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
                // $where = array('OD Category' => 1, 'User ID' => $userID);


                $data = (new personalmedapi)->showDetails($where, 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2');

                $response = json_decode(json_encode($data), true);

                $owner_data = @$response['original']['data']['OD_owners'];

                $vendor_data = @$response['original']['data']['OD_vendors'];
                
                $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];

                // $OD_media_address_data_new = @$response['original']['data']['OD_media_address'];

                $OD_media_address_data_new=isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [1];
                $latlongData = [];
                // dd($OD_media_address_data_new);
                // if (@$vendor_data[0]['Status'] == 1 || @$vendor_data[0]['Status'] != '') {
                if (@$vendor_data[0]['Modification'] == 0) {
                    @$mediaSubCatData = (new personalmedapi)->getMediaSubCat($vendor_data[0]['Applying For OD Media Type']);
                    return view('admin.pages.personal-outdoor.personal-media-form', ['states' => $states['original']['data']])->with(compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data_new', 'mediaSubCatData', 'latlongData', 'branch', 'soleaddress', 'getcat'));
                }
                
                $branch = [];
                $soleaddress = [];
                
                return view('admin.pages.personal-outdoor.personal-media-form', ['states' => $states['original']['data'], 'latlongData' => $latlongData])->with(compact('branch', 'soleaddress', 'getcat','OD_media_address_data','vendor_data'));
            } else {
                $url = last(request()->segments());
                $mediaid = $url;

                $state_array = (new api)->getStates();
                $states = json_decode(json_encode($state_array), true);
                $state_code = "";

                $userID =  session::get('UserID');

                $check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where("OD Media ID", $mediaid)->first();
                if (!empty($check)) {
                    $where = array('OD Category' => 1, 'User ID' => $userID, "Modification" => 1, "OD Media ID" => $mediaid);
                } else {
                    $where = array('OD Category' => 1, 'User ID' => $userID);
                }

                $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 1);
                // $authorize=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
                $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
                //for all category display sk
                $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();

                $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $mediaid)->get(); //for media category

                // $where = array('OD Category' => 1, 'User ID' => $userID);


                $data = (new personalmedapi)->showDetails($where, 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2');

                $response = json_decode(json_encode($data), true);

                $owner_data = @$response['original']['data']['OD_owners'];

                $vendor_data = @$response['original']['data']['OD_vendors'];
                
                $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];

                // $OD_media_address_data_new = @$response['original']['data']['OD_media_address'];
                $OD_media_address_data_new=isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];
                // dd($OD_media_address_data_new);
                $latlongData = [];
                // if (@$vendor_data[0]['Status'] == 1 || @$vendor_data[0]['Status'] != '') {
                // if (@$vendor_data[0]['Modification'] == 0) {
                @$mediaSubCatData = (new personalmedapi)->getMediaSubCat($vendor_data[0]['Applying For OD Media Type']);
                return view('admin.pages.personal-outdoor.personal-media-form', ['states' => $states['original']['data']])->with(compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data_new', 'mediaSubCatData', 'latlongData', 'branch', 'soleaddress', 'getcat'));
                // }
                // $branch=[];
                // return view('admin.pages.personal-outdoor.personal-media-form', ['states' => $states['original']['data'],'latlongData'=>$latlongData])->with(compact('branch'));
            }
        }
    }
    public function savePersonalMedia(Request $request)
    {
        if ($request->next_tab_1 == 1) {

            // $request->validate(
            //     [
            //         'email' => 'required',
            //         'mobile' => 'required',
            //         'address' => 'required',
            //         'state' => 'required',
            //         'city' => 'required',
            //         'district' => 'required'
            //     ]
            // );
            $resp = (new personalmedapi)->RateSettlPersonalMediaSave($request);
            $response = json_decode(json_encode($resp), true);
            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }


        //Start tab 2 data insert

        if ($request->next_tab_2 == 1) {

            // $request->validate(
            //     [
            //         'HO_Address' => 'required',
            //         'HO_Landline_No' => 'required',
            //         'HO_Email' => 'required',
            //         'HO_Mobile_No' => 'required',
            //         'Legal_Status_of_Company' => 'required',
            //         'Authority_Which_granted_Media' => 'required',
            //         'Contract_No' => 'required',
            //         'License_Fee' => 'required',
            //         'Quantity_Of_Display' => 'required',
            //         'License_From' => 'required',
            //         'License_To' => 'required',
            //         'MA_State' => 'required',
            //         'MA_District' => 'required',
            //         'MA_City' => 'required',
            //         'MA_Latitude' => 'required',
            //         'MA_Longitude' => 'required',
            //         'MA_Property_Landmark' => 'required',
            //         'ODMFO_Display_Size_Of_Media' => 'required',
            //         'ODMFO_Year' => 'required',
            //         'ODMFO_Quantity_Of_Display_Or_Duration' => 'required',
            //         'ODMFO_Billing_Amount' => 'required'
            //     ]
            // );
            $resp = (new personalmedapi)->personalRightSaveVendorData($request);
            $response = json_decode(json_encode($resp), true);

            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        //End tab 2 data insert

        if ($request->next_tab_3 == 1) {

            // $request->validate(
            //     [
            //         'DD_No' => 'required',
            //         'DD_Date' => 'required',
            //         'DD_Bank_Name' => 'required',
            //         'DD_Bank_Branch_Name' => 'required',
            //         'PM_Agency_Name' => 'required',
            //         'PAN' => 'required',
            //         'Bank_Name' => 'required',
            //         'Bank_Branch' => 'required',
            //         'IFSC_Code' => 'required',
            //         'Account_No' => 'required',
            //     ]
            // );
            $resp = (new personalmedapi)->personalSaveVendorAccount($request);

            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {
                return  response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        if ($request->submit_btn == 1) {

            $resp = (new personalmedapi)->personalSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {

                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }
    }

    // get exist owner data
    public function existingOwnerData(Request $request)
    {
        $sole_right_array = (new api)->existingOwnerData($request);
        $response = json_decode(json_encode($owner_datas), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }


    // check duplicate records into database
    public function checkUniqueOwner(Request $request)
    {
        //session(['email' => $request->email, 'id' => $request->id]);
        $request->session()->reflash();
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Email ID] = '" . $request->data . "' or [Mobile No_] = '" . $request->data . "'");

        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 1, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor(Request $request)
    {
        $request->session()->reflash();
        $table1 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        $count_id = DB::select("select COUNT(*) as count from $table1 where [Ho E-Mail] = '" . $request->data . "' or [HO Mobile No_] = '" . $request->data . "'");
        if ($count_id[0]->count > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function viewPersonal($mediaid = '')
    {
        // dd('hello');
        if (!empty($mediaid)) {
            $where = array('OD Category' => 1, 'OD Media ID' => $mediaid);
            $data = (new personalmedapi)->showDetails($where, 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2');
            $response = json_decode(json_encode($data), true);

            $owner_data = isset($response['original']['data']['OD_owners']) ? $response['original']['data']['OD_owners'] : [];
            $vendor_data = isset($response['original']['data']['OD_vendors']) ? $response['original']['data']['OD_vendors'] : [];
            $OD_work_dones_data = isset($response['original']['data']['OD_work_dones']) ? $response['original']['data']['OD_work_dones'] : [];
            $OD_media_address_data = isset($response['original']['data']['OD_media_address']) ? $response['original']['data']['OD_media_address'] : [];
            return view(
                'admin.pages.personal-outdoor.view-personal-media',
                compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data')
            );
        } else {
            dd('not found');
        }
    }


    public function fetchOwnerRecord(Request $request)

    {
        // $request->session()->reflash(); 
        // $request['key'] = 'Email ID';
        // $request['owner_id'] = $request->data;
        // $ownerID = '';


        $request->session()->reflash();
        $request['key'] = 'Email ID';
        $request['owner_id'] = $request->data;
        $ownerdatas = (new personalmedapi)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdatas), true);
        //get vendor edition
        // $countvendordatas = '';
        // $vendorDatas = '';
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
            $ownerID = (new personalmedapi)->fetchOwnerVendorMapped($request);
            $ownerID = json_decode(json_encode($ownerID), true);
            $ownerID = count($ownerID['original']['data']);
            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'ownerID' => $ownerID]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function getMediaSubCategory(Request $request)
    {
        $districts = (new personalmedapi)->getMediaSubCategory($request);
        $response = json_decode(json_encode($districts), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }

    // renewal process insert and update date 03-01-2021 by rimmi
    public function personalRenewal()
    {
        return view("admin.pages.personal-outdoor.renewal-personal-form");
    }

    public function personalRenewalView(Request $request)
    {
        $request->validate(
            [
                'boc_code' => 'required'
            ]
        );

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $state_code = "";
        $userID =  session::get('UserID');
        $where = array('OD Media ID' => $request->boc_code);
        $data = (new personalmedapi)->showDetails($where, 'BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2');
        $response = json_decode(json_encode($data), true);
        if ($response['original']['success'] == false) {
            $data = (new personalmedapi)->showDetails($where, 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2');
            $response = json_decode(json_encode($data), true);
        }

        if ($response['original']['success'] == true) {
            $owner_data = @$response['original']['data']['OD_owners'];
            $vendor_data = @$response['original']['data']['OD_vendors'];
            $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];
            $OD_media_address_data = @$response['original']['data']['OD_media_address'];
            $mediaSubCatData = (new personalmedapi)->getMediaSubCat($vendor_data[0]['Applying For OD Media Type']);
            // dd($mediaSubCatData );
            return view('admin.pages.personal-outdoor.renewal-personal-view-form', ['states' => $states['original']['data']])->with(compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data', 'mediaSubCatData'));
        } else {
            return back()->with(['status' => 'Fail', 'message' => 'Not found!']);
        }
    }

    public function removeWorkdoneData(Request $request)
    {
        $resp = (new personalmedapi)->removeWorkdoneData($request->line_no, $request->od_media_id);
        $response = json_decode(json_encode($resp), true);

        if ($response['original']['success'] == true) {
            return response()->json($response['original']['message']);
        } else {
            return response()->json($response['original']['message']);
        }
    }

    public function removeMediaData(Request $request)
    {
        $resp = (new personalmedapi)->removeMediaData($request->line_no, $request->od_media_id);
        $response = json_decode(json_encode($resp), true);

        if ($response['original']['success'] == true) {
            return response()->json($response['original']['message']);
        } else {
            return response()->json($response['original']['message']);
        }
    }

    public function personalRenewalSave(Request $request)
    {
        if ($request->next_tab_1 == 1) {
            $resp = (new personalmedapi)->renewalBasicUpdate($request);
            $response = json_decode(json_encode($resp), true);
            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        //Start tab 2 data insert

        if ($request->next_tab_2 == 1) {
            $resp = (new personalmedapi)->renewalOutdoorSave($request);
            $response = json_decode(json_encode($resp), true);
            return response()->json($response['original']);
            if ($response['original']['success'] == true) {
                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        //End tab 2 data insert

        if ($request->next_tab_3 == 1) {
            $resp = (new personalmedapi)->renewalAccountSave($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {
                return  response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
        }

        if ($request->submit_btn == 1) {
            $resp = (new personalmedapi)->personalSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == true) {

                return response()->json($response['original']);
            } else {
                return response()->json($response['original']);
            }
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

    public function show_subcategory(Request $request)
    {
        $cat_id = $request->cat_id;
        $data = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media Type as cat', 'OD Media ID as subcat')->where('Sole Media ID', $cat_id)->get();
        $cat_temp = [];
        $sub_temp = [];
        $temp1 = [];
        foreach ($data as $list) {
            $cat_data = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where("OD Media UID", $list->subcat)->get();
            foreach ($cat_data as $cat_list) {
                $temp1[] = $cat_list->Name;
            }
        }
        // dd($temp1);
        // return response()->json(["result"=>$temp1]);
        return implode(" <br>", $temp1);
    }

    public function fetchmedia(Request $request)
    {
        $media_code = $request->media_code;
        
        $dyn_sub = $request->dyn_sub;
        // dd($dyn_sub);
        $table = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        $data = DB::table($table)->where(['Category Group' => $media_code, 'Active' => 1, "OD Media Type" => 1])->get();
        $html = "<option>Select Sub Media Category</option>";
        foreach ($data as $cat) {
            if (is_array($dyn_sub)) {
                if (!in_array($cat->{'OD Media UID'}, $dyn_sub)) {
                    $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
                }
            } else {
                $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
            }
        }
        echo $html;
    }

    public function personallist()
    {
        $userid = Session::get('UserID');
        $where = array('User ID' => $userid, "Modification" => 1, 'OD Category' => 1);
        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2 as odmedia')->select('odmedia.OD Media ID as media_id', 'odmedia.HO E-Mail as ho_email', 'odmedia.GST No_ as gst', 'odmedia.HO Mobile No_ as mobile', 'odmedia.Modification', 'odmedia.Allocated Vendor Code as vendor_code', 'odmedia.License From as from_date', 'odmedia.License To as to_date', 'odmedia.Media Sub Category as sub_category','renewal.License From as renewal_license_from','renewal.License To as renewal_license_to')
        ->leftJoin('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2 as renewal', "renewal.OD Media ID", "=", "odmedia.OD Media ID")
        ->where(["odmedia.User ID"=>$userid,"odmedia.Modification"=>1,"odmedia.OD Category"=>1])
        ->get();
        // dd($vendor[0]->media_id);
        // dd($vendor);

        return view('admin.pages.personal-outdoor.personal-list', ["vendor" => $vendor]);
    }

    public function existinguser()
    {
        $user_id = Session::get('UserID');
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        // dd($states);
        $state_code = "";
        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);

        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 1, "Modification" => 0])->first();
        if ($vendor) {
            $odmediaid = $vendor->{'OD Media ID'};
            // $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $odmediaid)->get();
            $OD_media_address_datas = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
            $OD_media_address_data_new = json_decode(json_encode($OD_media_address_datas), true);
            $work = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["OD Media ID" => $odmediaid, "OD Media Type" => 1])->get();
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
            $vendorcheck = 0;
        } else {
            $odmediaid = '';
            // $soleaddress = []; 
            $OD_media_address_data_new=[1];
            $work = [];
            $getcat = [];
            $vendorcheck = 1;
        }
        
        // dd($vendor);


        return view('admin.pages.personal-outdoor.personal-existing-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data_new', 'work', 'getcat', 'vendorcheck'));
    }



    public function existingUserSaved(Request $request)
    {
        return DB::transaction(function () use ($request) {
        $user_id = Session::get('UserID');
        // $user_id='EMRVV76';
        $ownerdata = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where('User ID', $user_id)->first();
        $ownerid = $ownerdata->{'Owner ID'};

        $vendordata = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["User ID" => $user_id, "OD Category" => 1])->orderBy('OD Media ID', 'desc')->first();



        $destinationPath = public_path() . '/uploads/personal-media/';

        // if ($request->hasFile('Legal_Doc_File_Name')) {
        //     $file = $request->file('Legal_Doc_File_Name');
        //     $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $file_uploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
        //     if ($file_uploaded) {
        //         $Company_Legal_Documents = 1;
        //     } else {
        //         $Legal_Doc_File_Name = '';
        //     }
        // }


        // if ($request->hasFile('Affidavit_File_Name')) {
        //     $file = $request->file('Affidavit_File_Name');
        //     $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $file_uploaded = $file->move($destinationPath, $Affidavit_File_Name);
        //     if ($file_uploaded) {
        //         $Affidavit_Of_Oath = 1;
        //     } else {
        //         $Affidavit_File_Name = '';
        //     }
        // }

        $mod = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 1, "Modification" => 0])->first();
        // dd($mod->{'Legal Doc File Name'});
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

        if ($request->vendorcheck == 1) {
            // dd('insert');
            $old_odmedia_id = $vendordata->{'OD Media ID'};
            // $odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2] order by [OD Media ID] desc');
            $odmedia_id_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->orderBy('OD Media ID', 'desc')->first();
            if (empty($odmedia_id_check)) {
                // $odmedia_id = 'POD00001';
                $odmedia_id = 'OP0001';
            } else {
                $odmedia_id = $odmedia_id_check->{'OD Media ID'};
                $odmedia_id++;
            }



            // dd($vendorcheck);
            $vendor_array = array(
                "OD Category" => $vendordata->{'OD Category'},
                "OD Media ID" => $odmedia_id,
                "PM Agency Name" => $vendordata->{'PM Agency Name'},
                "HO Address" => $vendordata->{'HO Address'},
                "HO Landline No_" => $vendordata->{'HO Landline No_'},
                "HO Fax No_" => $vendordata->{'HO Fax No_'},
                "HO E-Mail" => $vendordata->{'HO E-Mail'},       //HO E-Mail
                "HO Mobile No_" => $vendordata->{'HO Mobile No_'},
                "DO Address" => $vendordata->{'DO Address'},
                "DO Landline No_" => $vendordata->{'DO Landline No_'},
                "DO Fax No_" => $vendordata->{'DO Fax No_'},
                "DO E-Mail" => $vendordata->{'DO E-Mail'},
                "DO Mobile No_" => $vendordata->{'DO Mobile No_'},
                "Legal Status of Company" => $vendordata->{'Legal Status of Company'},
                "Other Relevant Information" => $vendordata->{'Other Relevant Information'},
                "Authority Which granted Media" => $request->Authority_Which_granted_Media, //$vendordata->{'Authority Which granted Media'},
                "Amount paid to Authority" => $request->Amount_paid_to_Authority, //$vendordata->{'Amount paid to Authority'},
                "License From" => $request->License_From,    //$vendordata->{'License From'},
                "License To" => $request->License_To,       //$vendordata->{'License To'},
                "Duration" => $request->Media_Type ?? date('Y-m-d'), //$vendordata->{'Duration'},
                "Rental Agreement" => $request->Rental_Agreement, //$vendordata->{'Rental Agreement'},
                "Applying For OD Media Type" => $vendordata->{'Applying For OD Media Type'},
                "Media Display size" => $vendordata->{'Media Display size'},
                "Illumination" => $vendordata->{'Illumination'},
                "GST No_" => $vendordata->{'GST No_'},
                "TIN_TAN_VAT No_" => $vendordata->{'TIN_TAN_VAT No_'},
                "DD Date" => $vendordata->{'DD Date'},
                "DD No_" => $vendordata->{'DD No_'},
                "DD Bank Name" => $vendordata->{'DD Bank Name'},
                "DD Bank Branch Name" => $vendordata->{'DD Bank Branch Name'},
                "Application Amount" => $vendordata->{'Application Amount'},
                "PAN" => $vendordata->{'PAN'},
                "Bank Name" => $vendordata->{'Bank Name'},
                "Bank Branch" => $vendordata->{'Bank Branch'},
                "IFSC Code" => $vendordata->{'IFSC Code'},
                "Account No_" => $vendordata->{'Account No_'},
                "Company Legal Documents" => $vendordata->{'Company Legal Documents'},
                "Notarized Copy Of Agreement" => $vendordata->{'Notarized Copy Of Agreement'},
                "Photographs" => $vendordata->{'Photographs'},
                "Affidavit Of Oath" => $vendordata->{'Affidavit Of Oath'},
                "GST Registration" => $vendordata->{'GST Registration'},
                "CA Certified Balance Sheet" => $vendordata->{'CA Certified Balance Sheet'},
                "Self-declaration" => $vendordata->{'Self-declaration'},      //Self-declaration

                "Legal Doc File Name" => $vendordata->{'Legal Doc File Name'} ?? '',  //$Legal_Doc_File_Name ?? '', //upload file

                "Notarized Copy File Name" => $vendordata->{'Notarized Copy File Name'},
                "Photo File Name" => $vendordata->{'Photo File Name'},
                "Affidavit File Name" => $Affidavit_File_Name ?? '',  //upload file

                "GST File Name" => $vendordata->{'GST File Name'},
                "Balance Sheet File Name" => $vendordata->{'Balance Sheet File Name'},
                "Contract No_" => $vendordata->{'Contract No_'}, //$request->Contract_No,  //$vendordata->{'Contract No_'},
                "Quantity Of Display" => $vendordata->{'Quantity Of Display'}, //$request->Quantity_Of_Display,  //$vendordata->{'Quantity Of Display'},
                "License Fees" => $vendordata->{'License Fees'}, //$request->License_Fee, //$vendordata->{'License Fees'},
                "PAN Attached" => $vendordata->{'PAN Attached'},
                "PAN File Name" => $vendordata->{'PAN File Name'},
                "User ID" => $vendordata->{'User ID'},
                "Status" => $vendordata->{'Status'},
                "Global Dimension 1 Code" => $vendordata->{'Global Dimension 1 Code'},
                "Global Dimension 2 Code" => $vendordata->{'Global Dimension 2 Code'},
                "Sender ID" => $vendordata->{'Sender ID'},
                "Receiver ID" => $vendordata->{'Receiver ID'},
                "Recommended To Committee" => $vendordata->{'Recommended To Committee'},
                "Modification" => 1,
                "Media Sub Category" => $vendordata->{'Media Sub Category'},
                "Rate" => $vendordata->{'Rate'},
                "Rate Status" => $vendordata->{'Rate Status'},
                "Rate Remark" => $vendordata->{'Rate Remark'},
                "Rate Status Date" => $vendordata->{'Rate Status Date'},
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => $odmedia_id,
                "Document Date" => $vendordata->{'Document Date'},
                "Empanelment Category" => $vendordata->{'Empanelment Category'},
                "From Date" => $vendordata->{'From Date'},
                "To Date" => $vendordata->{'To Date'},
                "File Name" => $vendordata->{'File Name'},
                "File Uploaded" => $vendordata->{'File Uploaded'},
                "Application Type" => 1
            );


            $getBranch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID" => $old_odmedia_id, "OD Media Type" => 1])->get();
            // $branch_ary=[];
            foreach ($getBranch as $key => $getBranchs) {
                $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type" => 1,
                    "OD Media ID" => $odmedia_id,
                    "Line No_" => $line_no,
                    "State" => $getBranchs->State,
                    "BO Address" => $getBranchs->{'BO Address'},
                    "BO Landline No_" => $getBranchs->{'BO Landline No_'},
                    "BO E-Mail" => $getBranchs->{'BO E-Mail'},
                    "BO Mobile No_" => $getBranchs->{'BO Mobile No_'},
                    "User ID" => Session::get('UserID')
                ]);
            }
            // if (!$branch) 
            // {
            //     return $this->sendError('Some Error Occurred! OD Branch Offices table');
            //     exit;
            // }

            //for Auth Representative

            // $getAuth=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID"=>$old_odmedia_id,"OD Media Type"=>0])->get();
            // foreach($getAuth as $key => $getAuths)
            // {
            //     $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
            //     if (empty($line_no)) {
            //         $line_no = 10000;
            //     } else {
            //         $line_no = $line_no->{"Line No_"};
            //         $line_no = $line_no + 10000;
            //     }
            //     $auth=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
            //         "OD Media Type"=>0,
            //         "OD Media ID"=>$odmedia_id,
            //         "Line No_"=>$line_no,
            //         "AR Name"=>$getAuths->{'AR Name'},
            //         "AR Address"=>$getAuths->{'AR Address'},
            //         "AR Mobile"=>$getAuths->{'AR Mobile'},
            //         "AR Phone No_"=>$getAuths->{'AR Phone No_'},
            //         "AR Email"=>$getAuths->{'AR Email'},
            //         "Company Legal Status"=>$getAuths->{'Company Legal Status'},
            //         "Alternate Mobile No_"=>$getAuths->{'Alternate Mobile No_'},
            //         "User ID"=>Session::get('UserID')
            //     ]);
            // }    
            // if (!$auth) {
            //     return $this->sendError('Some Error Occurred! OD Branch Offices table');
            //     exit;
            // }




            // foreach($request->Authorized_Rep_Name as $key => $rep_name)
            // {
            //     $line_no = DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
            //     if (empty($line_no)) {
            //         $line_no = 10000;
            //     } else {
            //         $line_no = $line_no->{"Line No_"};
            //         $line_no = $line_no + 10000;
            //     }

            //     $authorized_data=array(
            //         "OD Media Type" =>2,
            //         "OD Media ID" =>$odmedia_id,
            //         "Line No_" =>$line_no,
            //         "AR Name" =>$rep_name,
            //         "AR Address"=> $request->AR_Address[$key] ?? '',
            //         "AR Mobile"=> $request->AR_Mobile_No[$key] ?? '',
            //         "AR Phone No_" => $request->AR_Landline_No[$key] ?? '',
            //         "AR Email" => $request->AR_Email[$key] ?? '',
            //         "Company Legal Status"=>$request->Legal_Status_of_Company[$key] ?? '',
            //         "Alternate Mobile No_" =>$request->altername_mobile[$key] ?? ''
            //     );

            //     $aut=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->insert($authorized_data);
            // }
            // if (!$aut) {
            //     return $this->sendError('Some Error Occurred! OD Auth Reper table');
            //     exit;
            // }



            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
            if ($request->xls == 0) {
                if (!empty($request->Applying_For_OD_Media_Type)) {
                    foreach ($request->Applying_For_OD_Media_Type as $key => $value) {
                        // $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        $line_no = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_', 'Sole Media ID')->where("Sole Media ID", $odmedia_id)->orderBy('Line No_', 'desc')->first();
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        $soleArray=array(
                            "OD Media Type"=>$value,  //$request->Applying_For_OD_Media_Type[$key] : 0,
                            "Sole Media ID"=>$odmedia_id,
                            "Line No_"=>$line_no,
                            "City"=> isset($request->MA_City[$key]) ? $request->MA_City[$key] : '',
                            "State"=>isset($request->MA_State[$key]) ? $request->MA_State[$key] : '',
                            "District"=>isset($request->MA_District[$key]) ? $request->MA_District[$key] : '',
                            "Zone"=>isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0,
                            "Latitude"=>isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0,
                            "Longitde"=>isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0,
                            "Landmark"=>'',
                            "Image File Name"=>'',
                            "OD Media ID"=>isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0,
                            "Display Size"=>isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0,
                            "Illumination Type"=>isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0,
                            "Availability Start Date"=>'1753-01-01',
                            "Availability End Date"=>'1753-01-01',
                            "Length"=>0,
                            "Width"=>0,
                            "Total Area"=>0,
                            "Rental"=>0,
                            "Rental Type"=>0,
                            "Quantity"=>isset($request->quantity[$key]) ? $request->quantity[$key] : 0,
                            "Train Number"=>'',
                            "Train Name"=>'',
                            "Size Type"=>0,
                            "Duration"=>isset($request->duration[$key]) ? $request->duration[$key] : 0,
                            "No Of Spot"=>0,
                            "Lit Type"=>0
                        );
                        DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert($soleArray);
                    }
                }
            }


            $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
            // if (count($request->ODMFO_Year) > 0) {
            $od_media_category = 1;
            if ($request->xls2 == 0) {
                if (!empty($request->ODMFO_Billing_Amount[0])) {
                    $dataFile = array();
                    foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) {
                        $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no[0]->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                        $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                        $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                        $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                        // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                        // $from_date=$request->from_date[$key] ?? '';
                        // $to_date=$request->to_date[$key] ?? '';
                        $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                        $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[Allocated Vendor Code],[From Date],[To Date]) values(DEFAULT,$od_media_category,'" . $odmedia_id . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'','" . $from_date . "','" . $to_date . "')");
                        $lineno2[] = $line_no;
                        $request->session()->put('line2', $lineno2);
                        DB::unprepared('SET ANSI_WARNINGS ON');
                    }
                    if (!$sql4) {
                        return $this->sendError('Some Error Occurred!.6666');
                        exit;
                    }
                }
            }

            $vendorinsert = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendor_array);

            $detail_data = DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                "OD Media Type" => 1,
                "OD Media ID" => $odmedia_id,
                "Owner ID" => $ownerid,
                "Allocated Vendor Code" => ''
            ]);

            //When you choose movieing media than modification value set one start
            $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
            $ary = explode(",", $movingmedia); //again convert array
            $total_media = count($ary); //array count

            $str = $movingmedia;
            $length = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                if ($str[$i] == '3') {
                    $length = $length + 1;
                }
            }
            //return $length;
            if ($length == $total_media) {
                $da = array(
                    "Modification" => 1,
                    "Document Date" => date('Y-m-d')
                );
                DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->update($da);
                // return ["Msg"=>"Data Update Success","code"=>$odmedia_id];
            }
            //When you choose movieing media than modification value set one end


            if (!$detail_data || !$vendorinsert) {
                return $this->sendError('Some Error Occurred!.6666');
                exit;
            }


            //excel upload start
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmedia_id);
            if ($request->xls == '1' || $request->xls2 == '1') {
                if ($request->hasfile('media_import') && $request->hasfile('media_import2')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        Excel::import(new PersonalMediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import2')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }
            //excel upload end



            return ["msg" => "Data saved success.! your ", "code" => $odmedia_id];
        } else {
            $vend = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["User ID" => $user_id, "OD Category" => 1, "Modification" => 0])->orderBy('OD Media ID', 'desc')->first();
            $odmediaid = @$vend->{'OD Media ID'};
            // $vendor_array=array(
            //     "Authority Which granted Media"=>$request->Authority_Which_granted_Media, 
            //     "License From"=>$request->License_From,    
            //     "License To"=>$request->License_To,      
            //     "Legal Doc File Name"=>$Legal_Doc_File_Name ?? '', 
            //     "Affidavit File Name"=>$Affidavit_File_Name ?? '',  
            //     "Contract No_"=> $request->Contract_No,  
            //     "Quantity Of Display"=>$request->Quantity_Of_Display,  
            //     "License Fees"=>$request->License_Fee 
            // );
            $vendor_array = array(
                "Authority Which granted Media" => $request->Authority_Which_granted_Media,
                "Amount paid to Authority" => $request->Amount_paid_to_Authority,
                "License From" => $request->License_From,
                "License To" => $request->License_To,
                "Duration" => $request->Media_Type ?? date('Y-m-d'),
                "Rental Agreement" => $request->Rental_Agreement,
                // "Quantity Of Display"=>$request->Quantity_Of_Display,  
                // "License Fees"=>$request->License_Fee,
                "Legal Doc File Name" => $Legal_Doc_File_Name ?? '',
                "Affidavit File Name" => $Affidavit_File_Name ?? '',
            );

            $vendorUpdate = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["OD Media ID" => $odmediaid, "OD Category" => 1, "Modification" => 0])->update($vendor_array);

            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Sole Media ID', $odmediaid)->first();
            if ($check) {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmediaid)->delete();
            }
            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
            // if (count($request->MA_City) > 0) {
            if ($request->xls == 0) {
                if (!empty($request->Applying_For_OD_Media_Type)) {
                    foreach ($request->Applying_For_OD_Media_Type as $key => $value) {
                        $line_no = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_', 'Sole Media ID')->where("Sole Media ID", $odmediaid)->orderBy('Line No_', 'desc')->first();
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        $soleArray=array(
                            "OD Media Type"=>$value,  //$request->Applying_For_OD_Media_Type[$key] : 0,
                            "Sole Media ID"=>$odmedia_id,
                            "Line No_"=>$line_no,
                            "City"=> isset($request->MA_City[$key]) ? $request->MA_City[$key] : '',
                            "State"=>isset($request->MA_State[$key]) ? $request->MA_State[$key] : '',
                            "District"=>isset($request->MA_District[$key]) ? $request->MA_District[$key] : '',
                            "Zone"=>isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0,
                            "Latitude"=>isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0,
                            "Longitde"=>isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0,
                            "Landmark"=>'',
                            "Image File Name"=>'',
                            "OD Media ID"=>isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0,
                            "Display Size"=>isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0,
                            "Illumination Type"=>isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0,
                            "Availability Start Date"=>'1753-01-01',
                            "Availability End Date"=>'1753-01-01',
                            "Length"=>0,
                            "Width"=>0,
                            "Total Area"=>0,
                            "Rental"=>0,
                            "Rental Type"=>0,
                            "Quantity"=>isset($request->quantity[$key]) ? $request->quantity[$key] : 0,
                            "Train Number"=>'',
                            "Train Name"=>'',
                            "Size Type"=>0,
                            "Duration"=>isset($request->duration[$key]) ? $request->duration[$key] : 0,
                            "No Of Spot"=>0,
                            "Lit Type"=>0
                        );
                        $sql5 = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert($soleArray);
                    }
                    if (!$sql5) {
                        return $this->sendError('Some Error Occurred!.7777');
                        exit;
                    }
                } //if close of sole media address
            }


            $check = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->first();
            if ($check) {
                DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->delete();
            }
            $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
            // if (count($request->ODMFO_Year) > 0) {
            $od_media_category = 1;
            if ($request->xls2 == 0) {
                if (!empty($request->ODMFO_Billing_Amount[0])) {
                    $dataFile = array();
                    foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) {
                        $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
                        if (empty($line_no)) {
                            $line_no = 10000;
                        } else {
                            $line_no = $line_no[0]->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                        $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                        $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                        $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                        // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                        // $from_date=$request->from_date[$key] ?? '';
                        // $to_date=$request->to_date[$key] ?? '';
                        $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                        $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $sql4 = DB::insert("insert into $table4([timestamp],[OD Media Type],[OD Media ID],[Line No_],[Work Name],[Year],[Qty Of Display_Duration],[Billing Amount],[Allocated Vendor Code],[From Date],[To Date]) values(DEFAULT,$od_media_category,'" . $odmediaid . "',$line_no,'" . $workName . "','" . $ODMFO_Year . "',$ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,'','" . $from_date . "','" . $to_date . "')");
                        $lineno2[] = $line_no;
                        $request->session()->put('line2', $lineno2);
                        DB::unprepared('SET ANSI_WARNINGS ON');
                    }
                    if (!$sql4) {
                        return $this->sendError('Some Error Occurred!.6666');
                        exit;
                    }
                }
            }






            //When you choose movieing media than modification value set one start
            $movingmedia = implode(",", $request->Applying_For_OD_Media_Type); //convert into string                       
            $ary = explode(",", $movingmedia); //again convert array
            $total_media = count($ary); //array count

            $str = $movingmedia;
            $length = 0;
            for ($i = 0; $i < strlen($str); $i++) {
                if ($str[$i] == '3') {
                    $length = $length + 1;
                }
            }
            //return $length;
            if ($length == $total_media) {
                $da = array(
                    "Modification" => 1,
                    "Document Date" => date('Y-m-d')
                );
                DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->update($da);
                // return ["Msg"=>"Data Update Success","code"=>$odmediaid];
            }
            //When you choose movieing media than modification value set one end(array)

            //excel upload start
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
            if ($request->xls == '1' || $request->xls2 == '1') {
                if ($request->hasfile('media_import') && $request->hasfile('media_import2')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        Excel::import(new PersonalMediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                } elseif ($request->hasfile('media_import2')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImportDone, request()->file('media_import2')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }
            //excel upload end
            // $odmediaid1=Session::get('ex_odmediaid');
            return ["Msg" => "Data Update Success", "code" => $odmediaid];
        } //else close

      }); //tansaction close
    }




    public function findSubCategory(Request $request)
    {
        //sweet alert
        $subcat = $request->sub_category_val;
        // $subcat="OD108";
        $userid = Session::get('UserID');
        $where = array("User ID" => $userid, "OD Category" => 1);
        $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->pluck('OD Media ID')->toArray();
        if ($vendor) {
            $od_media_id = implode(",", $vendor);
            // $od_media_id=$vendor->{'OD Media ID'};
            $sole = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where("OD Media ID", $subcat)->whereIn("Sole Media ID", [$vendor])->get();
            // dd($sole[0]->{'OD Media ID'});
            if (@$sole[0]->{'OD Media ID'} != '') {
                return ["status" => '1'];
            } else {
                return ["status" => '0'];
            }
        }
    }



    //renewal start march 2022
    //renewal feb -2022
    public function personal_right_renewal_form($id = '')
    {
        if ($id != '') {

            $user_id = Session::get('UserID');
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            // dd($states);
            $state_code = "";
            $district_array = (new api)->getDistricts();
            $districts = json_decode(json_encode($district_array), true);
            $select = array(
                'OD Media Type',
                'Sole Media ID',
                'Line No_',
                'City',
                'State',
                'District',
                'Zone',
                'Latitude',
                'Longitde',
                'Landmark',
                'Image File Name',
                'OD Media ID',
                'Display Size',
                'Illumination Type',
                'Availability Start Date',
                'Availability End Date',
                'Length',
                'Width',
                'Quantity',
                'Train Number',
                'Train Name',
                'Size Type',
                'Duration',
                'No Of Spot',
                'Lit Type'
            );
            $getODmediaID = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 1, "OD Media ID" => $id])->first();
            $odmedia_id = @$getODmediaID->{'OD Media ID'};

            $check_data_in_renewal_table = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 1, "OD Media ID" => $odmedia_id])->first();

            if ($check_data_in_renewal_table == '' || $check_data_in_renewal_table == null || $check_data_in_renewal_table == 'null') {
                $vendor = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 1, "Modification" => 1, "OD Media ID" => $odmedia_id])->first();
                
                if ($vendor) {
                    $odmediaid = $vendor->{'OD Media ID'};
                    // $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $odmediaid)->get();
                    $OD_media_address_datas = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
                    $OD_media_address_data_new = json_decode(json_encode($OD_media_address_datas), true);
                    // dd($OD_media_address_data_new);
                    $work = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["OD Media ID" => $odmediaid, "OD Media Type" => 1])->get();
                    $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
                    $vendorcheck = 0;
                } else {
                    $odmediaid = '';
                    // $soleaddress = [];
                    $OD_media_address_data_new=[1];
                    $work = [];
                    $getcat = [];
                    $vendorcheck = 1;
                }
                $disabled = '';
                $pointer = '';
                $modification_renew = 0;
                return view('admin.pages.personal-outdoor.personal-renewal-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data_new', 'work', 'getcat', 'vendorcheck', 'disabled', 'pointer','modification_renew'));
            } else {
                $vendor = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 1, "OD Media ID" => $odmedia_id])->orderBy('Line No_', 'desc')->first();
                $select = array(
                    'OD Media Type',
                    'Sole Media ID',
                    'Line No_',
                    'City',
                    'State',
                    'District',
                    'Zone',
                    'Latitude',
                    'Longitde',
                    'Landmark',
                    'Image File Name',
                    'OD Media ID',
                    'Display Size',
                    'Illumination Type',
                    'Availability Start Date',
                    'Availability End Date',
                    'Length',
                    'Width',
                    'Quantity',
                    'Train Number',
                    'Train Name',
                    'Size Type',
                    'Duration',
                    'No Of Spot',
                    'Lit Type'
                );
                if ($vendor) {
                    $odmediaid = $vendor->{'OD Media ID'};
                    // $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $odmediaid)->get();
                    $OD_media_address_datas = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select($select)->where("Sole Media ID", $odmediaid)->get();
                    $OD_media_address_data_new = json_decode(json_encode($OD_media_address_datas), true);

                    $work = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where(["OD Media ID" => $odmediaid, "OD Media Type" => 1])->get();
                    $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();
                    $vendorcheck = 0;
                } else {
                    $odmediaid = '';
                    // $soleaddress = [];
                    $OD_media_address_data_new=[1];
                    $work = [];
                    $getcat = [];
                    $vendorcheck = 1;
                }
                if ($vendor->Modification == '1') {
                    $disabled = 'disabled';
                    $pointer = 'none';
                } else {
                    $disabled = '';
                    $pointer = '';
                }
                $modification_renew = 1;
                return view('admin.pages.personal-outdoor.personal-renewal-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor', 'OD_media_address_data_new', 'work', 'getcat', 'vendorcheck', 'disabled', 'pointer','modification_renew'));
            }
        } else {
            return redirect()->route('personallist');
        }
    }





    //renewal form submit march-2022
    public function personal_renewal_form_submit(Request $request)
    {
        $user_id = Session::get('UserID');
        $vendor_code = $request->od_media_id;
        $getODmediaID = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where(["User ID" => $user_id, "OD Category" => 1, "OD Media ID" => $request->od_media_id])->first();
        $odmediaid = @$getODmediaID->{'OD Media ID'};

        $destinationPath = public_path() . '/uploads/personal-media/';
        $mod = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where(["User ID" => $user_id, "OD Category" => 1, "OD Media ID" => $odmediaid])->first();
        // dd($mod->{'Legal Doc File Name'});
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
        $table4 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
        // $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
        $line_no = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmediaid)->orderBy('Line No_', 'desc')->first();
        if (empty($line_no)) {
            $line_no = 10000;
        } else {
            $line_no = $line_no->{"Line No_"};
            $line_no = $line_no + 10000;
        }
        // dd($odmediaid);
        $vendor_renewal = array(
            "OD Media ID" => $odmediaid,
            "Line No_" => $line_no,
            "PM Agency Name" => '',
            "OD Category" => 1,
            "HO Address" => '',
            "HO Landline No_" => '',
            "HO Fax No_" => '',
            "HO E-Mail" => '',
            "HO Mobile No_" => '',
            "BO Address" => '',
            "BO Landline No_" => '',
            "BO Fax No_" => '',
            "BO E-Mail" => '',
            "BO Mobile No_" => '',
            "DO Address" => '',
            "DO Landline No_" => '',
            "DO Fax No_" => '',
            "DO E-Mail" => '',
            "DO Mobile No_" => '',
            "Legal Status of Company" => 0,
            "Other Relevant Information" => '',
            "Authority Which granted Media" => $request->Authority_Which_granted_Media, //yes
            "Amount paid to Authority" => $request->Amount_paid_to_Authority, //yes
            "License From" => $request->License_From,  //yes
            "License To" => $request->License_To, //yes
            "Media Type" => 0,
            "Rental Agreement" => $request->Rental_Agreement,  //yes
            "Applying For OD Media Type" => 0,
            "Media Display size" => '',
            "Illumination" => 0,
            "GST No_" => '',
            "TIN_TAN_VAT No_" => '',
            "DD Date" => '1753-01-01 00:00:00.000',
            "DD No_" => '',
            "DD Bank Name" => '',
            "DD Bank Branch Name" => '',
            "Application Amount" => 0,
            "PAN" => '',
            "Bank Name" => '',
            "Bank Branch" => '',
            "IFSC Code" => '',
            "Account No_" => '',
            "Company Legal Documents" => 0,
            "Notarized Copy Of Agreement" => 0,
            "Photographs" => 0,
            "Affidavit Of Oath" => 0,
            "GST Registration" => 0,
            "CA Certified Balance Sheet" => 0,
            "Self-declaration" => 0,
            "Legal Doc File Name" => $Legal_Doc_File_Name ?? '',
            "Notarized Copy File Name" => '',
            "Photo File Name" => '',
            "Affidavit File Name" => $Affidavit_File_Name ?? '',
            "GST File Name" => '',
            "Balance Sheet File Name" => '',
            "Authorized Rep Name" => '',
            "AR Address" => '',
            "AR Landline No_" => '',
            "AR FAX No_" => '',
            "AR Mobile No_" => '',
            "AR E-mail" => '',
            "Contract No_" => $request->Contract_No ?? 0,
            "Quantity Of Display" => $request->Quantity_Of_Display ?? 0,
            "License Fees" => $request->License_Fee ?? 0,
            "PAN Attached" => 0,
            "PAN File Name" => '',
            "User ID" => $user_id,
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
            "Allocated Vendor Code" => '',
            "Document Date" => '1753-01-01 00:00:00.000',
            "Agreement Start Date" => '1753-01-01 00:00:00.000',
            "Agreement End Date" => '1753-01-01 00:00:00.000',
            "Empanelment Category" => 0,
            "Duration" => $request->Media_Type ?? date('Y-m-d')
        );
        // dd($odmediaid);
        $renewalsave = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendor_renewal);

        $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Sole Media ID', $odmediaid)->first();
        if ($check) {
            DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmediaid)->delete();
        }

        $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]';
        if (!empty($request->Applying_For_OD_Media_Type)) {
            foreach ($request->Applying_For_OD_Media_Type as $key => $value) {
                $line_no = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_', 'Sole Media ID')->where("Sole Media ID", $odmediaid)->orderBy('Line No_', 'desc')->first();
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $soleArray=array(
                    "OD Media Type"=>$value,  //$request->Applying_For_OD_Media_Type[$key] : 0,
                    "Sole Media ID"=>$odmediaid,
                    "Line No_"=>$line_no,
                    "City"=> isset($request->MA_City[$key]) ? $request->MA_City[$key] : '',
                    "State"=>isset($request->MA_State[$key]) ? $request->MA_State[$key] : '',
                    "District"=>isset($request->MA_District[$key]) ? $request->MA_District[$key] : '',
                    "Zone"=>isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0,
                    "Latitude"=>isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0,
                    "Longitde"=>isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0,
                    "Landmark"=>'',
                    "Image File Name"=>'',
                    "OD Media ID"=>isset($request->od_media_type[$key]) ? $request->od_media_type[$key] : 0,
                    "Display Size"=>isset($request->ODMFO_Display_Size_Of_Media[$key]) ? $request->ODMFO_Display_Size_Of_Media[$key] : 0,
                    "Illumination Type"=>isset($request->Illumination_media[$key]) ? $request->Illumination_media[$key] : 0,
                    "Availability Start Date"=>'1753-01-01',
                    "Availability End Date"=>'1753-01-01',
                    "Length"=>0,
                    "Width"=>0,
                    "Total Area"=>0,
                    "Rental"=>0,
                    "Rental Type"=>0,
                    "Quantity"=>isset($request->quantity[$key]) ? $request->quantity[$key] : 0,
                    "Train Number"=>'',
                    "Train Name"=>'',
                    "Size Type"=>0,
                    "Duration"=>isset($request->duration[$key]) ? $request->duration[$key] : 0,
                    "No Of Spot"=>0,
                    "Lit Type"=>0
                );
                $sql5 = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->insert($soleArray);
            }
            if (!$sql5) {
                return $this->sendError('Some Error Occurred!.7777');
                exit;
            }
        } //if close of sole media address


        //work done start
        $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
        DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmediaid)->delete();
        // if (count($request->ODMFO_Year) > 0) {
        $od_media_category = 1;
        if (!empty($request->ODMFO_Quantity_Of_Display_Or_Duration[0])) {
            $dataFile = array();
            foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) {
                $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmediaid . "' order by [Line No_] desc");
                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no[0]->{"Line No_"};
                    $line_no = $line_no + 10000;
                }
                $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                // $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                // $from_date=$request->from_date[$key] ?? '';
                // $to_date=$request->to_date[$key] ?? '';
                $from_date = isset($request->from_date[$key]) ? $request->from_date[$key] : '1753-01-01 00:00:00.000';
                $to_date = isset($request->to_date[$key]) ? $request->to_date[$key] : '1753-01-01 00:00:00.000';
                $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';
                DB::unprepared('SET ANSI_WARNINGS OFF');

                $sql4 = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert([
                    "OD Media Type" => $od_media_category,
                    "OD Media ID" => $odmediaid,
                    "Line No_" => $line_no,
                    "Work Name" => $workName,
                    "Year" => $ODMFO_Year,
                    "Qty Of Display_Duration" => $ODMFO_Quantity_Of_Display_Or_Duration,
                    "Billing Amount" => $ODMFO_Billing_Amount,
                    "Allocated Vendor Code" => $allocated_vendor_code,
                    "From Date" => $from_date,
                    "To Date" => $to_date
                ]);


                $lineno2[] = $line_no;
                $request->session()->put('line2', $lineno2);
                DB::unprepared('SET ANSI_WARNINGS ON');
            }
            if (!$sql4) {
                return $this->sendError('Some Error Occurred!.6666');
                exit;
            }
        }


        //excel upload start
        $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
        if ($request->xls == '1' || $request->xls2 == '1') {
            if ($request->hasfile('media_import') && $request->hasfile('media_import2')) {
                try {
                    Excel::import(new MediaExcelsImport, request()->file('media_import')); //for import
                    Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                    // return $this->sendResponse('', 'Data Import successfully first');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            } elseif ($request->hasfile('media_import')) {
                try {
                    Excel::import(new MediaExcelsImport, request()->file('media_import')); //for import
                    // return $this->sendResponse('', 'Data Import successfully first');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            } elseif ($request->hasfile('media_import2')) {
                try {
                    Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                    // return $this->sendResponse('', 'Data Import successfully first');
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
        }
        //excel upload end
        return ["msg" => "Data Saved in renewal table", "media_id" => $odmediaid];
    }
    public function getStatePDF($State_pdf = "")
    {
        $state = DB::table('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c')->select('Description')->where('Code', $State_pdf)->first();
        return $state->{'Description'};
    }
    //multistate
    public function getStatemulti()
    {
        $state = DB::table('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c')->select('Code', 'Description')->get();
        return $state;
    }
    //Generate PDF
    public function personalmediaPDF($id)
    {
        $mediaid = $id;
        // dd($mediaid);
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);
        $state_code = "";

        $userID =  session::get('UserID');

        $check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where("OD Media ID", $mediaid)->first();
        if (!empty($check)) {
            $where = array('OD Category' => 1, 'User ID' => $userID, "Modification" => 1, "OD Media ID" => $mediaid);
        } else {
            $where = array('OD Category' => 1, 'User ID' => $userID);
        }

        $where2 = array("OD Media ID" => $mediaid, "OD Media Type" => 1);
        // $authorize=DB::table('BOC$OD Auth Representative$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
        $branch = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->get();
        //for all category display sk
        $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->get();

        $soleaddress = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select("*")->where("Sole Media ID", $mediaid)->get(); //for media category

        // $where = array('OD Category' => 1, 'User ID' => $userID);


        $data = (new personalmedapi)->showDetails($where, 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2');

        $response = json_decode(json_encode($data), true);

        $owner_data = @$response['original']['data']['OD_owners'];

        $vendor_data = @$response['original']['data']['OD_vendors'];

        $OD_work_dones_data = @$response['original']['data']['OD_work_dones'];

        $OD_media_address_data = @$response['original']['data']['OD_media_address'];
        $latlongData = [];

        // if (@$vendor_data[0]['Status'] == 1 || @$vendor_data[0]['Status'] != '') {
        // if (@$vendor_data[0]['Modification'] == 0) {
        @$mediaSubCatData = (new personalmedapi)->getMediaSubCat($vendor_data[0]['Applying For OD Media Type']);
        $getState = $this->getStatePDF(@$owner_data[0]['State']);
        $getmultiple = $this->getStatemulti();
        $pdf = PDF::loadView('admin.pages.personal-outdoor.personal-media-pdf', ['StateC' => $getState], compact('owner_data', 'vendor_data', 'OD_work_dones_data', 'OD_media_address_data', 'mediaSubCatData', 'latlongData', 'branch', 'soleaddress', 'getcat', 'getmultiple'));
        return $pdf->download($id . '.pdf');
    }

    public function outdoorpersonalmediaPdf() 
    {
        $userid = Session::get('UserID');
        $where = array('User ID' => $userid, "Modification" => 1, 'OD Category' => 1);
        $personalpdf = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID as media_id', 'HO E-Mail as ho_email', 'GST No_ as gst', 'HO Mobile No_ as mobile', 'Modification', 'Allocated Vendor Code as vendor_code', 'License From as from_date', 'License To as to_date', 'Media Sub Category as sub_category')->where($where)->get();
        $pdf = \PDF::loadView('admin.pages.personal-outdoor.personalMedia-pdf', compact('personalpdf'));
        return $pdf->download($userid . '.pdf');
    }
}
