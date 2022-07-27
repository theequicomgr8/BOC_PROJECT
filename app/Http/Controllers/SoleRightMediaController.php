<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use App\Models\Ummuser;
use Session;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\SoleRightMediaController as solerightMedapi;
use Mail;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\outdoorMediaTableTrait;
use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\MediaExcelsImport;
use App\Models\Api\MediaCirculationDone;
use App\Imports\MediaExcelsImportDone;
use App\Exports\Outdoor\SoleRightMediaExcelExport;
use App\Imports\Outdoor\Media\SoleRightMediaSheets;
use Hash;
use PDF;
use PhpParser\Node\Expr\Print_;

class SoleRightMediaController extends Controller
{
    use CommonTrait, outdoorMediaTableTrait;

    public function __construct()
    {
        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        }
    }
    public function outdoorMediaEmpanelment()
    {
      
        $user_id = Session::get('UserID'); 
        $od_media_id = '';
        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $state_code = "";
        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);

        //for all category display
        $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->get();


        if (Session::has('modification') && Session::get('modification') == 1) {
            // $where = array('OD Category' => 0, 'User ID' => $user_id, 'Modification' => 0);
            $where = array('OD Category' => 0, 'User ID' => $user_id);
        } else {
            $where = array('OD Category' => 0, 'User ID' => $user_id);
        }
        $odmedia_id = DB::table($this->tableVendorEmpODMedia)->select('OD Media ID as OD_Media_ID')->where($where)->where('Notarized Copy File Name','=','')->first();

        $owner_response = (new solerightMedapi)->getOwnerData();
        $owner_res = json_decode(json_encode($owner_response), true);
        $owner_data = $owner_res['original']['success'] == true ? $owner_res['original']['data'] : [1];

        $owner_agency_name = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')
                                ->select('PM Agency Name as AgencyName')
                                ->where('User ID',$user_id)
                                ->first();
        if(!empty($owner_agency_name))
        {
            $agency_name = $owner_agency_name->AgencyName;
        }
        else
        {
            $agency_name = "";
        }
        
        if (@$odmedia_id->OD_Media_ID != '') {
            $od_media_id = $odmedia_id->OD_Media_ID;

            // get vendor data
            $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id, 'User ID' => $user_id);
            $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
            $vendor_res = json_decode(json_encode($vendor_response), true);
            $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [];

            // get media address data
            $media_address_response = (new solerightMedapi)->getMediaAddressData($od_media_id);
            $media_address_res = json_decode(json_encode($media_address_response), true);
            $OD_media_address_data = $media_address_res['original']['success'] == true ? $media_address_res['original']['data'] : [];

            // get details of work done data
            $work_dones_response = (new solerightMedapi)->getDetailsWorkDone($od_media_id);
            $work_dones_res = json_decode(json_encode($work_dones_response), true);
            $OD_work_dones_data = $work_dones_res['original']['success'] == true ? $work_dones_res['original']['data'] : [];
        } else {
            $vendor_data = [];
            $OD_media_address_data = [];
            $OD_work_dones_data = [];
        }
        // get all sub category of login user
        $subcategory_response = (new solerightMedapi)->getSubCategoryData($od_media_id);
        $subcategory_res = json_decode(json_encode($subcategory_response), true);
        $OD_subcategory_data = $subcategory_res['original']['success'] == true ? $subcategory_res['original']['data'] : [];

        if (!empty($OD_media_address_data)) {
            //for all category display
            $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
        }
        return view('admin.pages.outdoor-media.empanelment.outdoor-media-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor_data', 'OD_media_address_data', 'OD_work_dones_data', 'getcat', 'OD_subcategory_data','owner_data','agency_name'));
    }
    public function outdoorMediaEmpSave(Request $request)
    {
        $user_id = Session::get('UserID');
        if (Session::has('modification') && Session::get('modification') == 1 && $request->EMP_OD_Media_ID == '') {
            $vendor_response = (new solerightMedapi)->outdoorMediaOtherEmpSave($request);
        } else {
            $vendor_response = (new solerightMedapi)->outdoorMediaEmpSave($request);
        }
        if ($vendor_response == true) 
        {
            if (session('EMP_OD_Media_ID') != '') {
                $EMP_OD_Media_ID = session('EMP_OD_Media_ID');
                $request['EMP_OD_Media_ID'] = $EMP_OD_Media_ID;
            } else {
                $EMP_OD_Media_ID = $request->EMP_OD_Media_ID;
            }
            Session::put('ex_odmediaid', $EMP_OD_Media_ID);
            // save data of media address
            if ($request->xls == 0) {
                if (count($request->Applying_For_OD_Media_Type) > 0) {
                    $media_response = (new solerightMedapi)->mediaAddressSave($request);
                    if ($media_response == false) {
                        return $this->sendError('Error1:' . 'Some Error Occurred!');
                        exit;
                    }
                } else {
                    return $this->sendError('Empty media address array!');
                    exit;
                }
            } else {
                if ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                    } catch (ValidationException $ex) {
                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }

            // save data of work done
            $applicant_name = $request->applicant_name;
            if ($applicant_name != '' || $applicant_name != NULL) {
                Session::put('applicant_name', $applicant_name);
            } else {
                Session::put('applicant_name', '');
            }
            $destinationPath = public_path() . '/uploads/sole-right-media/';
            // dd($request->xls2);
            if ($request->xls2 == 0) {

                $Non_receipt_file_name = '';
                if ($request->hasFile('media_import3')) {
                    $file = $request->file('media_import3');
                    $Non_receipt_file_name = time() . '-' . $user_id . 'NonReceipt';
                    $file_uploaded = $file->move($destinationPath, $Non_receipt_file_name);
                    if ($file_uploaded) {
                        $Non_receipt_file_name = $Non_receipt_file_name;
                    } else {
                        $Non_receipt_file_name = '';
                    }
                }
                $data = [
                    'OD Media Type' => 0,  //0 replace by 2
                    'Work Name' => '',
                    'Year' => '',
                    'Qty Of Display_Duration' => 0,
                    'Billing Amount' => 0,
                    'Allocated Vendor Code' => '',
                    'From Date' => '',
                    'To Date' => '',
                    'Work Done Status' => 0,
                    'Client Name' => '',
                    'Invoice Number' => '',
                    'GST Party 1' => '',
                    'GST Party 2' => '',
                    'Proof GST Submitted' => '',
                    'Name of applicant' => $applicant_name,
                    'Online application number'=>$request->EMP_OD_Media_ID,
                    'Non receipt file name'=>$Non_receipt_file_name,
                    'GST Receipts File Name'=>'',
                    'GST Invoices File Name'=>''
                ];
                $detailswork_response = (new solerightMedapi)->detailsWorkDoneSave($request,$data);
                    if ($detailswork_response == false) {
                        return $this->sendError('Error2:' . 'Some Error Occurred!');
                        exit;
                    }
                    else {
                        return ["Msg" => "Data Update Success", "media_id" => $request->EMP_OD_Media_ID];
                        exit;
                    }
                } 
                else if($request->xls2 == 1)
                {
                    $GSTCertificate = '';
                    if ($request->hasFile('media_import4')) {
                        $file = $request->file('media_import4');
                        $GSTCertificate = time() . '-' . $user_id . 'GSTCertificate';
                        $file_uploaded = $file->move($destinationPath, $GSTCertificate);
                        if ($file_uploaded) {
                            $GSTCertificate = $GSTCertificate;
                        } else {
                            $GSTCertificate = '';
                        }
                    }
                    $Invoice = '';
                    if ($request->hasFile('media_import5')) {
                        $file = $request->file('media_import5');
                        $Invoice = time() . '-' . $user_id . 'Invoice';
                        $file_uploaded = $file->move($destinationPath, $Invoice);
                        if ($file_uploaded) {
                            $Invoice = $Invoice;
                        } else {
                            $Invoice = '';
                        }
                    } 
                    if ($request->hasfile('media_import2')) {
                        try {
                            Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                        } catch (ValidationException $ex) {
                            $failures = $ex->failures();
                            foreach ($failures as $failure) {
                                return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                            }
                        }
                    }

                    DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID',$request->EMP_OD_Media_ID)->where('Line No_',10000)->update([
                        'GST Receipts File Name'=>$GSTCertificate,
                        'GST Invoices File Name'=>$Invoice
                    ]);
                   
                    
                return ["Msg" => "Data Update Success", "media_id" => $request->EMP_OD_Media_ID];
            } else {
                return $this->sendError('Some Error Occurred!');
                exit;
            }
        }
    }
    public function outdoorMediaView($od_media_id)
    {

        $user_id = Session::get('UserID');

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $state_code = "";
        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);

        //for all category display
        $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->get();

        // get vendor data
        // $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id, 'User ID' => $user_id, 'Modification' => 1);
         $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id, 'User ID' => $user_id);
        $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
        $vendor_res = json_decode(json_encode($vendor_response), true);
        $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [];

        // get media address data
        $media_address_response = (new solerightMedapi)->getMediaAddressData($od_media_id);
        $media_address_res = json_decode(json_encode($media_address_response), true);
        $OD_media_address_data = $media_address_res['original']['success'] == true ? $media_address_res['original']['data'] : [];

        // get details of work done data
        $work_dones_response = (new solerightMedapi)->getDetailsWorkDone($od_media_id);
        $work_dones_res = json_decode(json_encode($work_dones_response), true);
        $OD_work_dones_data = $work_dones_res['original']['success'] == true ? $work_dones_res['original']['data'] : [];
        
        //get Lat Long details data
        $get_latlong_data = (new solerightMedapi)->getLatlongDetails($od_media_id);
        $work_lat_res = json_decode(json_encode($get_latlong_data), true);
        $OD_lat_data = $work_dones_res['original']['success'] == true ? $work_lat_res['original']['data'] : [];

        //Get Agency Name
        $owner_agency_name = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')
                                ->select('PM Agency Name as AgencyName')
                                ->where('User ID',$user_id)
                                ->first();
        if(!empty($owner_agency_name))
        {
            $agency_name = $owner_agency_name->AgencyName;
        }
        else
        {
            $agency_name = "";
        }

        if (!empty($OD_media_address_data)) {
            //for all category display
            $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
        }
        // dd($vendor_data);
        return view('admin.pages.outdoor-media.outdoor-media-view', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor_data', 'OD_media_address_data', 'OD_work_dones_data', 'getcat','OD_lat_data','agency_name'));
    }

    public function outdoorMediaRenewal($od_media_id = '')
    {
        if ($od_media_id != '') {

            $user_id = Session::get('UserID');

            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);

            $state_code = "";
            $district_array = (new api)->getDistricts();
            $districts = json_decode(json_encode($district_array), true);

            //for all category display
            $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->get();

            // get vendor data
            $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id, 'User ID' => $user_id);

            $vendor_response = (new solerightMedapi)->getOutdoorMediaRenewalData($where);
            $vendor_res = json_decode(json_encode($vendor_response), true);
            $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [];

            if (empty(@$vendor_res['original']['data'])) {
                $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
                $vendor_res = json_decode(json_encode($vendor_response), true);
                $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [];
                $vendor_data[0]['Modification'] = 0;
            }

            // get media address data
            $media_address_response = (new solerightMedapi)->getMediaAddressData($od_media_id);
            $media_address_res = json_decode(json_encode($media_address_response), true);
            $OD_media_address_data = $media_address_res['original']['success'] == true ? $media_address_res['original']['data'] : [];

            // get details of work done data
            $work_dones_response = (new solerightMedapi)->getDetailsWorkDone($od_media_id);
            $work_dones_res = json_decode(json_encode($work_dones_response), true);
            $OD_work_dones_data = $work_dones_res['original']['success'] == true ? $work_dones_res['original']['data'] : [];
            $OD_subcategory_data = [];
            if (!empty($OD_media_address_data)) {
                //for all category display
                $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();

                // get all sub category of login user
                $subcategory_response = (new solerightMedapi)->getSubCategoryData($od_media_id);
                $subcategory_res = json_decode(json_encode($subcategory_response), true);
                $OD_subcategory_data = $subcategory_res['original']['success'] == true ? $subcategory_res['original']['data'] : [];
            }
            return view('admin.pages.outdoor-media.renewal.outdoor-media-renewal-form', ['states' => $states['original']['data'], 'districts' => $districts['original']['data']], compact('vendor_data', 'OD_media_address_data', 'OD_work_dones_data', 'getcat', 'OD_subcategory_data'));
        } else {
            return redirect()->route('outdoor-media-list');
        }
    }

    public function outdoorMediaRenewalSave(Request $request)
    {

        $vendor_response = (new solerightMedapi)->outdoorMediaRenewalSave($request);

        if ($vendor_response == true) {
            $EMP_OD_Media_ID = $request->EMP_OD_Media_ID;

            // save data of media address
            if ($request->xls == 0) {
                if (count($request->Applying_For_OD_Media_Type) > 0) {
                    $media_response = (new solerightMedapi)->mediaAddressSave($request);
                    if ($media_response == false) {
                        return $this->sendError('Error1:' . 'Some Error Occurred!');
                        exit;
                    }
                } else {
                    return $this->sendError('Empty media address array!');
                    exit;
                }
            } else {
                if ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new SoleRightMediaSheets, request()->file('media_import')); //for import
                    } catch (ValidationException $ex) {
                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
            }

            // save data of work done
            $applicant_name = $request->applicant_name;
            if ($applicant_name != '' || $applicant_name != NULL) {
                Session::put('applicant_name', $applicant_name);
            } else {
                Session::put('applicant_name', '');
            }
            $destinationPath = public_path() . '/uploads/sole-right-media/';
            // dd($request->xls2);
            if ($request->xls2 == 0) {

                $Non_receipt_file_name = '';
                if ($request->hasFile('media_import3')) {
                    $file = $request->file('media_import3');
                    $Non_receipt_file_name = time() . '-' . $user_id . 'NonReceipt';
                    $file_uploaded = $file->move($destinationPath, $Non_receipt_file_name);
                    if ($file_uploaded) {
                        $Non_receipt_file_name = $Non_receipt_file_name;
                    } else {
                        $Non_receipt_file_name = '';
                    }
                }
                $data = [
                    'OD Media Type' => 0,  //0 replace by 2
                    'Work Name' => '',
                    'Year' => '',
                    'Qty Of Display_Duration' => 0,
                    'Billing Amount' => 0,
                    'Allocated Vendor Code' => '',
                    'From Date' => '',
                    'To Date' => '',
                    'Work Done Status' => 0,
                    'Client Name' => '',
                    'Invoice Number' => '',
                    'GST Party 1' => '',
                    'GST Party 2' => '',
                    'Proof GST Submitted' => '',
                    'Name of applicant' => $applicant_name,
                    'Online application number' => $request->EMP_OD_Media_ID,
                    'Non receipt file name' => $Non_receipt_file_name
                ];
                $detailswork_response = (new solerightMedapi)->detailsWorkDoneSave($request, $data);
                if ($detailswork_response == false) {
                    return $this->sendError('Error2:' . 'Some Error Occurred!');
                    exit;
                }
                /*else {
                        return $this->sendError('Empty details work done array!');
                        exit;
                    }*/
            } else if ($request->xls2 == 1) {
                if ($request->hasfile('media_import2')) {
                    try {
                        Excel::import(new MediaExcelsImportDone, request()->file('media_import2')); //for import
                    } catch (ValidationException $ex) {
                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                return ["Msg" => "Data Update Success", "media_id" => $request->EMP_OD_Media_ID];
            } else {
                return $this->sendError('Some Error Occurred!');
                exit;
            }
        }
    }

    public function companyDetail(Request $request)
    {
        $user_id = Session::get('UserID');

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $owner_response = (new solerightMedapi)->getOwnerData();
        $owner_res = json_decode(json_encode($owner_response), true);
        $owner_data = $owner_res['original']['success'] == true ? $owner_res['original']['data'] : [1];

        if (!empty($owner_data)) {
            $where = array('OD Category' => 0, 'User ID' => $user_id);
            $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
            $vendor_res = json_decode(json_encode($vendor_response), true);
            $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [1];

            $where = array('OD Media Type' => 0, 'User ID' => $user_id);

            $branch_response = (new solerightMedapi)->getOutdoorMediaBranchOfficeData($where);
            $branch_res = json_decode(json_encode($branch_response), true);
            $branch_data = $branch_res['original']['success'] == true ? $branch_res['original']['data'] : [1];

            $authorize_response = (new solerightMedapi)->getOutdoorMediaAuthorizedData($where);
            $authorize_res = json_decode(json_encode($authorize_response), true);
            $authorize_data = $authorize_res['original']['success'] == true ? $authorize_res['original']['data'] : [1];
        } else {
            $owner_data = [1];
            $vendor_data = [1];
            $branch_data = [1];
            $authorize_data = [1];
        }

        if (!empty($vendor_data) && @$vendor_data[0]['GST No_'] != '') {
            Session::Put('ODGSTID', $vendor_data[0]['GST No_']);
            Session::Put('IFSCCODE', $vendor_data[0]['IFSC Code']);
        }

        $state_code = @$owner_data[0]['State'] ?? "";
        $city_array = $this->getcities($state_code);
        $ownerCities = json_decode(json_encode($city_array), true);
        $district_array = $this->getDistricts($state_code);
        $ownerDistricts = json_decode(json_encode($district_array), true);

        return view('admin.pages.outdoor-media.company-detail.outdoor-company-detail', ['states' => $states['original']['data'], 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']])->with(compact('owner_data', 'vendor_data', 'authorize_data', 'branch_data'));
    }

    public function companyDetailSave(Request $request)
    {
        $owner_res = (new solerightMedapi)->OwnerDataSave($request);
        if ($owner_res == false) {
            return $this->sendError('Error1:' . 'Some Error Occurred!');
            exit;
        }
        $company_res = (new solerightMedapi)->companyDetailSave($request);
        if ($company_res == false) {
            return $this->sendError('Error2:' . 'Some Error Occurred!');
            exit;
        }

        $agency_res = (new solerightMedapi)->updateAgencyData($request);
        if ($agency_res == false) {
            return $this->sendError('Error3:' . 'Some Error Occurred!');
            exit;
        }

        $branch_res = (new solerightMedapi)->branchOfficesSave($request);
        if ($branch_res == false) {
            return $this->sendError('Error4:' . 'Some Error Occurred!');
            exit;
        }
        $authorized_res = (new solerightMedapi)->authorizedSave($request);
        if ($authorized_res == false) {
            return $this->sendError('Error5:' . 'Some Error Occurred!');
            exit;
        }

        if ($authorized_res) {
            Session::flash('success', "Data Save Successfully");
            return redirect()->route('company-details');
        }
    }

    public function outdoorMediaList()
    {
        $userid = Session::get('UserID');
        $vendor_data = (new solerightMedapi)->getMediaList();
        $pending_count = 0;
        $vendor_arr = array();
        $vendor = array();

        foreach ($vendor_data as $key => $val) {
            if ($val->payment_status == 'SUCCESS') {
                array_push($vendor_arr, $val);
            } else {
                $getcat = DB::table($this->tableSoleMediasAddress)->select('OD Media Type as category')->where('Sole Media ID', $val->media_id)->first();

                $val->category = @$getcat->category;
                array_push($vendor, $val);
                $pending_count++;
            }
        }

        if (count($vendor_arr) > 0) {
            foreach ($vendor_arr as $key => $val) {
                $getcat = DB::table($this->tableSoleMediasAddress)->select('OD Media Type as category')->where('Sole Media ID', $val->media_id)->first();
                $val->category = $getcat->category;
                array_push($vendor, $val);
            }
        }

        $vendorData = DB::table($this->tableVendorEmpODMedia)->select('GST No_ as gst', 'IFSC Code as ifsc_code')->where("User ID", $userid)->first();
        if (!empty($vendorData) && $vendorData->gst != '') {
            Session::put('ODGSTID', $vendorData->gst);
            Session::put('IFSCCODE', $vendorData->ifsc_code);
        } else {
            Session::put('ODGSTID', "");
            Session::put('IFSCCODE', "");
        }

        return view('admin.pages.outdoor-media.outdoor-media-list', ["vendor" => $vendor, 'pending_count' => $pending_count]);
    }

    public function approvedList()
    {
        $vendor_data = (new solerightMedapi)->getApprovedMediaList();
        $vendor_arr = array();
        $vendor = array();
        foreach ($vendor_data as $key => $val) {
            $getcat = DB::table($this->tableSoleMediasAddress)->select('OD Media Type as category')->where('Sole Media ID', $val->media_id)->first();
            $val->category = @$getcat->category;
            array_push($vendor, $val);
        }
        return view('admin.pages.outdoor-media.outdoor-media-approved-list', ["vendor" => $vendor]);
    }

    public function fetchStates()
    {
        $states = (new solerightMedapi)->getStates();

        return $states;
    }

    public function fetchDistricts(Request $request)
    {

        $state_code = $request->state_code;
        // cities dropdown
        $city_array = $this->getcities($state_code);
        $cities = json_decode(json_encode($city_array), true);
        $city_data = "<option value=''>Select City</option>";
        if ($cities['original']['success'] == true) {
            foreach ($cities['original']['data'] as $city) {
                $city_data .= "<option value='" . $city['cityName'] . "'>" . ucfirst(strtolower($city['cityName'])) . "</option>";
            }
        }

        // district dropdown
        $district_array = (new api)->getDistricts($state_code);
        $districts = json_decode(json_encode($district_array), true);
        $dist_data = "<option value=''>Select District</option>";
        if ($districts['original']['success'] == true) {
            foreach ($districts['original']['data'] as $district) {
                $dist_data .= "<option value='" . $district['District'] . "'>" . $district['District'] . "</option>";
            }
            return response()->json(['status' => 1, 'districts' => $dist_data, 'cities' => $city_data]);
        } else {
            return response()->json(['status' => 0]);
        }

        // $data=DB::table('')-
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
        $userid = Session::get('UserID');
        if (is_numeric($request->data)) {
            $where = array(
                ["Mobile No_", "=", $request->data],
                ["User ID", "!=", $userid]
            );
        } else {
            $where = array(
                ["Email ID", "=", $request->data],
                ["User ID", "!=", $userid]
            );
        }
        $count_id = DB::table($this->tableOwner)->where($where)->count();

        if ($count_id > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor(Request $request)
    {

        $userid = Session::get('UserID');
        if (is_numeric($request->data)) {
            $where = array(
                ["HO Mobile No_", "=", $request->data], ["User ID", "!=", $userid]
            );
        } else {
            $where = array(
                ["HO E-Mail", "=", $request->data],
                ["User ID", "!=", $userid]
            );
        }
        $count_id = DB::table($this->tableVendorEmpODMedia)->where($where)->count();

        if ($count_id > 0) {
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
        $ownerdatas = (new solerightMedapi)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdatas), true);

        $ownerID = '';

        if ($ownerdatas['original']['success'] == true) {
            $request['key'] = 'Owner ID';
            $request['owner_id'] = $ownerdatas['original']['data'][0]['Owner ID'];
            $ownerID = (new solerightMedapi)->fetchOwnerVendorMapped($request);
            $ownerID = json_decode(json_encode($ownerID), true);
            $ownerID = count($ownerID['original']['data']);

            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $state_data = "<option value=''>Select State</option>";
            foreach ($states['original']['data'] as $state) {
                $selected =  $ownerdatas['original']['data'][0]['State'] === $state['Code']  ? 'selected' : '';
                $state_data .= "<option value='" . $state['Code'] . "' $selected>" . $state['Description'] . "</option>";
            }

            $dist_array = (new solerightMedapi)->getAllDistricts();
            $districts = json_decode(json_encode($dist_array), true);
            $dist_data = "<option value=''>Select District</option>";
            foreach ($districts['original']['data'] as $district) {
                $selected =  $ownerdatas['original']['data'][0]['District'] === $district['District']  ? 'selected' : '';
                $dist_data .= "<option value='" . $district['District'] . "' $selected>" . $district['District'] . "</option>";
            }

            $state_code = $ownerdatas['original']['data'][0]['State'];
            $city_array = $this->getcities($state_code);
            $cities = json_decode(json_encode($city_array), true);
            $city_data = "<option value=''>Select City</option>";
            if ($cities['original']['success'] == true) {
                foreach ($cities['original']['data'] as $city) {
                    $selected =  $ownerdatas['original']['data'][0]['City'] === $city['cityName']  ? 'selected' : '';
                    $city_data .= "<option value='" . $city['cityName'] . "' $selected>" . $city['cityName'] . "</option>";
                }
            }

            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'state' => $state_data, 'districts' => $dist_data, 'cities' => $city_data, 'ownerID' => $ownerID]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function getSubCategory(Request $request)
    {
        $media_code = $request->media_code;
        $dyn_sub = $request->dyn_sub ?? [];
        // get all sub category of login user
        $subcategory_response = (new solerightMedapi)->getSubCategoryData('');
        $subcategory_res = json_decode(json_encode($subcategory_response), true);
        $OD_subcategory_data = $subcategory_res['original']['success'] == true ? $subcategory_res['original']['data'] : [];
        if (!empty($dyn_sub)) {
            foreach ($dyn_sub as $val) {
                array_push($OD_subcategory_data, $val);
            }
        }

        $table = $this->tableODMediaCategory;
        $data = DB::table($table)->where(['Category Group' => $media_code, 'Active' => 1, "OD Media Type" => 0])->get();
        $html = "<option>Select Sub Category</option>";

        foreach ($data as $cat) {
            if (!empty($OD_subcategory_data)) {
                if (!in_array($cat->{'OD Media UID'}, $OD_subcategory_data)) {
                    $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
                }
            } else {
                $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
            }
        }
        echo $html;
    }

    public function getSubCategoryExcel(Request $request)
    {

        // get all sub category of login user
        $od_media_id = '';
        $subcategory_response = (new solerightMedapi)->getSubCategoryData($od_media_id);
        $subcategory_res = json_decode(json_encode($subcategory_response), true);
        $OD_subcategory_data = $subcategory_res['original']['success'] == true ? $subcategory_res['original']['data'] : [];

        $media_code = $request->media_code;
        $data = DB::table($this->tableODMediaCategory)->where(['Category Group' => $media_code, 'Active' => 1, "OD Media Type" => 0])->get();
        $html = "";
        foreach ($data as $cat) {
            if (!in_array($cat->{'OD Media UID'}, $OD_subcategory_data)) {
                $html .= "<option value='" . $cat->{'OD Media UID'} . "'>" . $cat->Name . "</option>";
            }
        }
        echo $html;
    }

    public function getMediaExcel(Request $request)
    {
        // dd($request->quantity[0]);
        // lit type section
        $litdata_array = array();
        $excel_data_array = array();
        $litStr = "Bus Panel,Hoarding,Digital Display,Train Inside,Train Outside";

        $lit_arr_data = explode(",", $litStr);
        $subCatTextArr = explode(",", $request->subcattext);
        $i = 0;
        $nonlit = 0;
        foreach ($subCatTextArr as $subcattext) {

            $nonlit = 0;
            foreach ($lit_arr_data as $val) {
                if (str_contains($subcattext, $val)) {
                    $nonlit = 1;
                }
            }

            $litdata_array[$i]['cat'] = $request->cattext;
            $litdata_array[$i]['sub_cat'] = $subcattext;

            if ($nonlit == 1) {

                $litdata_array[$i]['illumination'] = 'Non Lit';
                $litdata_array[$i]['lit_type'] = '';
            } else {

                $litdata_array[$i]['illumination'] = 'Lit';
                $litdata_array[$i]['lit_type'] = 'Front Lit';
            }
            $i++;
        }

        //end lit type section

        $traindata_array = array();
        $no_ofspots_array = array();
        $size_array = array();
        $key_data = array();
        $train_arr_data = "OD029,OD030,OD084,OD108";
        $no_ofspots_arr_data = "OD006,OD013,OD072,OD073,OD110,OD122,OD086,OD087,OD123,OD127";
        //$no_ofspots_arr_data = '';
        $size_arr_data = "OD053,OD010,OD011,OD014,OD017,OD018,OD019,OD020,OD021,OD023,OD024,OD025,OD036,OD037,OD038,OD044,OD047,OD048,OD054,OD055,OD057,OD071,OD082,OD084,OD088,OD089,OD090,OD092,OD095,OD108,OD113,OD117,OD041,OD120,OD035,OD051";

        foreach ($request->subcatvalue as $key => $subcatval) {
            if (strpos($no_ofspots_arr_data, $subcatval) !== false) {
                // no of spots section
                $excel_data_array[$key]['noOfSpotsArray']['State'] = $request->MAState;
                $excel_data_array[$key]['noOfSpotsArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['noOfSpotsArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['noOfSpotsArray']['Quantity'] = $request->quantity[$key];
                $excel_data_array[$key]['noOfSpotsArray']['No Of Spots'] = '1';
                $excel_data_array[$key]['noOfSpotsArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['noOfSpotsArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'noOfSpotsArray');
            } else if (strpos($size_arr_data, $subcatval) !== false) {

                if (strpos($train_arr_data, $subcatval)  !== false) {
                    // size and train section 
                    $excel_data_array[$key]['sizeTrainArray']['State'] = $request->MAState;
                    $excel_data_array[$key]['sizeTrainArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeTrainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                    $excel_data_array[$key]['sizeTrainArray']['Quantity'] = $request->quantity[$key];
                    $excel_data_array[$key]['sizeTrainArray']['Train Number'] = '';
                    $excel_data_array[$key]['sizeTrainArray']['Train Name'] = '';

                    $excel_data_array[$key]['sizeTrainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeTrainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeTrainArray');
                } else {
                    // size section
                    $excel_data_array[$key]['sizeArray']['State'] = $request->MAState;
                    $excel_data_array[$key]['sizeArray']['Category'] = $request->cattext;
                    $excel_data_array[$key]['sizeArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                    $excel_data_array[$key]['sizeArray']['Quantity'] = $request->quantity[$key];
                    $excel_data_array[$key]['sizeArray']['Illumination'] = $litdata_array[$key]['illumination'];
                    if ($litdata_array[$key]['lit_type'] != '') {
                        $excel_data_array[$key]['sizeArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                    }

                    array_push($key_data, 'sizeArray');
                }
            } else if (strpos($train_arr_data, $subcatval)  !== false) {
                // train section
                $excel_data_array[$key]['trainArray']['State'] = $request->MAState;
                $excel_data_array[$key]['trainArray']['Category'] = $request->cattext;
                $excel_data_array[$key]['trainArray']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['trainArray']['Quantity'] = $request->quantity[$key];
                $excel_data_array[$key]['trainArray']['Train Number'] = '23409';
                $excel_data_array[$key]['trainArray']['Train Name'] = 'Taj';

                $excel_data_array[$key]['trainArray']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['trainArray']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'trainArray');
            } else {
                //default section
                $excel_data_array[$key]['default']['State'] = $request->MAState;
                $excel_data_array[$key]['default']['Category'] = $request->cattext;
                $excel_data_array[$key]['default']['Sub Category'] = $litdata_array[$key]['sub_cat'];
                $excel_data_array[$key]['default']['Quantity'] = $request->quantity[$key];
                $excel_data_array[$key]['default']['Illumination'] = $litdata_array[$key]['illumination'];
                if ($litdata_array[$key]['lit_type'] != '') {
                    $excel_data_array[$key]['default']['Lit Type'] = $litdata_array[$key]['lit_type'];
                }
                array_push($key_data, 'default');
            }
        }

        $myFile =  Excel::raw(new SoleRightMediaExcelExport($key_data, $excel_data_array), 'Xlsx');

        $response =  array(
            'name' => "outdoor_sample.xlsx",
            'file' => "data:application/vnd.ms-excel;base64," . base64_encode($myFile)
        );
        return response()->json($response);
    }

    public function checkgst(Request $request)
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

    public function removeMediaaddressData(Request $request)
    {
        $resp = (new solerightMedapi)->removeMediaaddress($request->line_no, $request->od_media_id);
        $response = json_decode(json_encode($resp), true);

        $resp1 = (new solerightMedapi)->removeSubcatLocation($request->subcatval, $request->od_media_id);
        $response1 = json_decode(json_encode($resp), true);

        if ($response['original']['success'] == true && $response1['original']['success'] == true) {

            return response()->json($response['original']['message']);
        } else {
            return response()->json($response['original']['message']);
        }
    }

    public function removeBranchOfficeData(Request $request)
    {
        // dd($request);
        $where = array("OD Media ID" => $request->od_media_id, 'Line No_' => $request->line_no);
        $sql = DB::table($this->tableODBranchOffices)->where($where)->delete();

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }
    public function removeAuthorizedData(Request $request)
    {
        $where = array("OD Media ID" => $request->od_media_id, 'Line No_' => $request->line_no);
        $sql = DB::table($this->tableODAuthRepresentative)->where($where)->delete();
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function MediaWorkDone_delete(Request $request)
    {
        $line_no = $request->line_no;
        $od_media_id = $request->od_media_id;
        $where = array("OD Media ID" => $od_media_id, 'Line No_' => $line_no);
        $data = DB::table($this->tableODMediaWorkDone)->where($where)->delete();
        return "Data Delete Successfully";
    }

    public function findSubCategory(Request $request)
    {
        //sweet alert
        $subcat = $request->sub_category_val;
        $userid = Session::get('UserID');
        $where = array("User ID" => $userid, "OD Category" => 0);
        $vendor = DB::table($this->tableVendorEmpODMedia)->where($where)->pluck('OD Media ID')->toArray();
        if ($vendor) {
            $od_media_id = implode(",", $vendor);
            $sole = DB::table($this->tableSoleMediasAddress)->select('OD Media ID')->where("OD Media ID", $subcat)->whereIn("Sole Media ID", [$vendor])->get();
            if (@$sole[0]->{'OD Media ID'} != '') {
                return ["status" => '1'];
            } else {
                return ["status" => '0'];
            }
        }
    }

    public function show_subcategory(Request $request)
    {
        $cat_id = $request->cat_id;
        $data = DB::table($this->tableSoleMediasAddress)->select('OD Media Type as cat', 'OD Media ID as subcat')->where('Sole Media ID', $cat_id)->get();
        $cat_temp = [];
        $sub_temp = [];
        $temp1 = [];
        foreach ($data as $list) {
            $cat_data = DB::table($this->tableODMediaCategory)->select('*')->where("OD Media UID", $list->subcat)->get();
            foreach ($cat_data as $cat_list) {
                $temp1[] = $cat_list->Name;
            }
        }
        return implode(" <br>", $temp1);
    }

    public function show_category(Request $request)
    {
        $cat_id = $request->cat_id;
        $data = DB::table($this->tableSoleMediasAddress)->select('OD Media Type as cat', 'OD Media ID as subcat')->where('Sole Media ID', $cat_id)->get();
        $cat_temp = [];
        $sub_temp = [];
        $temp1 = [];
        foreach ($data as $list) {
            $cat_temp[] = $list->cat;
        }
        return ["result" => $cat_temp];
    }

    public function viewLocationData(Request $request)
    {
        $subcattxt = $request->subcattxt;
        $subcat = $request->subcat;
        $cat = $request->cat;
        $od_media_id = $request->odmedia_id;
        $userid = Session::get('UserID');

        $select = array(
            'Location Name as location_name',
            'OD Asset ID as od_asset_id',
            'Length',
            'Width',
            'Illumination Type as Illumination_Type',
            'Lit Type as Lit_Type',
            'Train Number as Train_Number',
            'Train Name as Train_Name',
            'Commercial Rate as Commercial_Rate',
            'OD Media Type as media_cat',
            'OD Media UID as media_subcat',
            'Categorization as categorization'
        );

        $where = array(['OD Vendor ID' => $od_media_id, 'User ID' => $userid, 'OD Media Type' => $cat, 'OD Media UID' => $subcat]);
        $locations = DB::table($this->tableODLatlongDetail)->select($select)->where(['OD Vendor ID' => $od_media_id, 'User ID' => $userid, 'OD Media Type' => $cat, 'OD Media UID' => $subcat])->get();

        $location_data = '';
        $train_tab = '';
        $lit_tab = '';
        $location_tab = '';
        $lit_type = '';
        $train_field = '';
        foreach ($locations as $key => $location) {
            $ind = $key;
            $ind++;
            $illumination1 = $location->Illumination_Type == '1' ? 'selected' : '';
            $illumination2 = $location->Illumination_Type == '2' ? 'selected' : '';

            if ($location->Illumination_Type == '1') {
                $Lit_Type1 = $location->Lit_Type == '1' ? 'selected' : '';
                $Lit_Type2 = $location->Lit_Type == '2' ? 'selected' : '';
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "' readonly style='pointer-events:none'><option value=''>Please Select</option><option value='1' $Lit_Type1 >Front Lit</option><option value='2' $Lit_Type2 >Back Lit</option></select></p></td>";
                $displaylit = 'block';
            } else {
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "' readonly style='pointer-events:none'><option value=''>Please Select</option><option value='1' >Front Lit</option><option value='2'>Back Lit</option></select></p></td>";
                $displaylit = 'none';
            }

            if ($location->Train_Number != '0' && $location->Train_Name != '') {
                $train_field = "<td><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" . $key . "' value='" . @$location->Train_Number . " - " . @$location->Train_Name . "' tabindex='" . $key . "' autocomplete='off' readonly style='pointer-events:none'></p></td>";
            } else {
                $train_field = '';
            }

            $location_data .= "<tr><td>$ind</td><td><p><textarea type='text' name='location_name[]' placeholder='Enter Location' class='form-control form-control-sm' id='location_name_" . $key . "' tabindex='" . $key . "' rows='1' maxlength='150' readonly style='pointer-events:none'>$location->location_name</textarea></p></td><td><p><input type='text' name='length[]' placeholder='Enter Length' class='form-control form-control-sm size_area size_len_digit' id='length_" . $key . "' maxlength='3' tabindex='" . $key . "' value='" . round($location->Length, 2) . "' onkeypress='return onlyNumberKey(event)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='width[]' placeholder='Enter Width' class='form-control form-control-sm size_area size_width_digit' id='width_" . $key . "' tabindex='" . $key . "' value='" . round($location->Width, 2) . "' maxlength='3' onkeypress='return onlyNumberKey(event)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='total_area[]' placeholder='Enter Total Area' class='form-control form-control-sm' id='Total_Area_" . $key . "' value='" . round($location->Length * $location->Width, 2) . "' readonly onkeypress='return onlyNumberKey(event)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='Categorization[]' placeholder='Enter Categorization' class='form-control form-control-sm' id='Categorization" . $key . "' value='" . $location->categorization . "' onkeypress='return onlyAlphabets(event,this)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='Commercial_Rate[]' placeholder='Enter Rate Offered to CBC' class='form-control form-control-sm' id='Commercial_Rate_" . $key . "' value='" . round($location->Commercial_Rate, 2) . "' onkeypress='return onlyNumberKey(event)' readonly style='pointer-events:none'></p></td><td><p><select name='Illumination_media[]' id='Illumination_media_" . $key . "' class='form-control form-control-sm illuminationType' tabindex='" . $key . "' readonly style='pointer-events:none'><option value=''>Select Illumination</option>
            <option value='1' $illumination1  style='display:" . $displaylit . "'>Lit</option><option value='2' $illumination2 >Non Lit</option></select></p></td>$lit_type  $train_field </tr>";
        }

        if ($lit_type != '') {
            $lit_tab = "<th width='11%'>Lit Type</th>";
        }
        if ($train_field != '') {
            $train_tab = "<th width='20%'>Train Number/Name<font color='red'>*</font></th>";
        }

        $location_tab = "<input type='hidden' name='odmediaid_data' value='" . $od_media_id . "' id='odmediaid_data'><input type='hidden' name='media_cat' id='media_cat' value='" . $cat . "'><input type='hidden' name='media_subcat' id='media_subcat' value='" . $subcat . "'><table class='table' style='border: 1px solid gainsboro;' id='TableId'><thead><tr><th scope='col'>Sr.No.</th><th scope='col' width='24%'>Location<font color='red'>*</font></th><th scope='col'>Length<font color='red'>*</font></th><th scope='col'>Width<font color='red'>*</font></th><th scope='col' width='14%'>Total Area (sq. ft)<font color='red'>*</font></th><th scope='col' width='12%'>Categorization<font color='red'>*</font></th><th scope='col' width='12%'>Rate Offered to CBC<font color='red'>*</font></th><th>Illumination</th>$lit_tab $train_tab</tr></thead><tbody>";
        $location_tab .= $location_data . "</tbody></table>";
        return $location_tab;
    }
    // get media adress location 
    public function getLocationDetails(Request $request)
    {
        $od_media_id = $request->od_media_id;
        $line_no = $request->lineNo;
        $cat = $request->cat;
        $subcat = $request->subcat;
        $subcattxt = $request->subcattxt;
        $userid = Session::get('UserID');

        $select = array(
            'Location Name as location_name',
            'OD Asset ID as od_asset_id',
            'Length',
            'Width',
            'Illumination Type as Illumination_Type',
            'Lit Type as Lit_Type',
            'Train Number as Train_Number',
            'Train Name as Train_Name',
            'Commercial Rate as Commercial_Rate',
            'OD Media Type as media_cat',
            'OD Media UID as media_subcat',
            'Categorization as categorization'
        );

        $where = array(['OD Vendor ID' => $od_media_id, 'User ID' => $userid, 'OD Media Type' => $cat, 'OD Media UID' => $subcat]);
        $locations = DB::table($this->tableODLatlongDetail)->select($select)->where(['OD Vendor ID' => $od_media_id, 'User ID' => $userid, 'OD Media Type' => $cat, 'OD Media UID' => $subcat])->get();

        $location_data = '';
        $train_tab = '';
        $lit_tab = '';
        $location_tab = '';
        $lit_type = '';
        $train_field = '';
        foreach ($locations as $key => $location) {
            $ind = $key;
            $ind++;
            $illumination1 = $location->Illumination_Type == '1' ? 'selected' : '';
            $illumination2 = $location->Illumination_Type == '2' ? 'selected' : '';

            if ($location->Illumination_Type == '1') {
                $Lit_Type1 = $location->Lit_Type == '1' ? 'selected' : '';
                $Lit_Type2 = $location->Lit_Type == '2' ? 'selected' : '';
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "'><option value=''>Please Select</option><option value='1' $Lit_Type1 >Front Lit</option><option value='2' $Lit_Type2 >Back Lit</option></select></p></td>";
                $displaylit = 'block';
            } else {
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "' readonly style='pointer-events:none'><option value=''>Please Select</option><option value='1' >Front Lit</option><option value='2'>Back Lit</option></select></p></td>";
                $displaylit = 'none';
            }

            if ($location->Train_Number != '0' && $location->Train_Name != '') {
                $train_field = "<td><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" . $key . "' value='" . @$location->Train_Number . " - " . @$location->Train_Name . "' tabindex='" . $key . "' autocomplete='off'></p></td>";
            } else {
                $train_field = '';
            }

            $location_data .= "<tr><td>$ind</td><td><p><textarea type='text' name='location_name[]' placeholder='Enter Location' class='form-control form-control-sm' id='location_name_" . $key . "' tabindex='" . $key . "' rows='1' maxlength='150'>$location->location_name</textarea></p></td><td><p><input type='text' name='length[]' placeholder='Enter Length' class='form-control form-control-sm size_area size_len_digit' id='length_" . $key . "' maxlength='3' tabindex='" . $key . "' value='" . round($location->Length, 2) . "' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='width[]' placeholder='Enter Width' class='form-control form-control-sm size_area size_width_digit' id='width_" . $key . "' tabindex='" . $key . "' value='" . round($location->Width, 2) . "' maxlength='3' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='total_area[]' placeholder='Enter Total Area' class='form-control form-control-sm' id='Total_Area_" . $key . "' value='" . round($location->Length * $location->Width, 2) . "' readonly onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='Categorization[]' placeholder='Enter Categorization' class='form-control form-control-sm' id='Categorization" . $key . "' value='" . $location->categorization . "' onkeypress='return onlyAlphabets(event,this)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='Commercial_Rate[]' placeholder='Enter Rate Offered to CBC' class='form-control form-control-sm' id='Commercial_Rate_" . $key . "' value='" . round($location->Commercial_Rate, 2) . "' onkeypress='return onlyNumberKey(event)'></p></td><td><p><select name='Illumination_media[]' id='Illumination_media_" . $key . "' class='form-control form-control-sm illuminationType' tabindex='" . $key . "'><option value=''>Select Illumination</option>
            <option value='1' $illumination1  style='display:" . $displaylit . "'>Lit</option><option value='2' $illumination2 >Non Lit</option></select></p></td>$lit_type  $train_field <td><a href='javascript:void(0);' class='btn btn-danger btn-sm m-0 remove_trrow' data='" . $key . "' style='font-size: 12px;'><i class='fa fa-minus'></i> Remove</a></td><input type='hidden' name='od_asset_id[]' id='od_asset_id_" . $key . "' value='" . $location->od_asset_id . "'><input type='hidden' name='od_vendor_id[]' id='od_vendor_id_" . $key . "' value='" . $od_media_id . "'></tr>";
        }

        if ($lit_type != '') {
            $lit_tab = "<th width='11%'>Lit Type</th>";
        }
        if ($train_field != '') {
            $train_tab = "<th width='20%'>Train Number/Name<font color='red'>*</font></th>";
        }

        $location_tab = "<input type='hidden' name='odmediaid_data' value='" . $od_media_id . "' id='odmediaid_data'><input type='hidden' name='media_cat' id='media_cat' value='" . $locations[0]->media_cat . "'><input type='hidden' name='media_subcat' id='media_subcat' value='" . $locations[0]->media_subcat . "'><table class='table' style='border: 1px solid gainsboro;' id='TableId'><thead><tr><th scope='col'>Sr.No.</th><th scope='col' width='24%'>Location<font color='red'>*</font></th><th scope='col'>Length<font color='red'>*</font></th><th scope='col'>Width<font color='red'>*</font></th><th scope='col' width='14%'>Total Area (sq. ft)<font color='red'>*</font></th><th scope='col' width='12%'>Categorization<font color='red'>*</font></th><th scope='col' width='12%'>Rate Offered to CBC<font color='red'>*</font></th><th>Illumination</th>$lit_tab $train_tab <th>Remove</th></tr></thead><tbody>";
        $location_tab .= $location_data . "</tbody></table>";
        return $location_tab;
    }

    // save location data
    public function saveLocationData(Request $request)
    {
        if ($request->EMP_OD_Media_ID != '') {
            $data = (new solerightMedapi)->locationDetailUpdate($request);
        } else {
            $data = (new solerightMedapi)->locationDetailSave($request);
        }
        $asset_ids = json_decode(json_encode($data), true);
        // dd($asset_ids);
        if ($asset_ids['original']['success'] == true) {
            return response()->json(['status' => true, 'asset_ids' => $asset_ids['original']['data']]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function getLocationTempData(Request $request)
    {
        $userid = Session::get('UserID');

        $location_data = '';
        $train_tab = '';
        $lit_tab = '';
        $location_tab = '';
        $lit_type = '';
        $train_field = '';
        $asset_ID = explode(',', $request->asset_ID);

        foreach ($asset_ID as $key => $od_asset_id) {
            $select = array(
                'Location Name as location_name',
                'OD Asset ID as od_asset_id',
                'Length',
                'Width',
                'Illumination Type as Illumination_Type',
                'Lit Type as Lit_Type',
                'Train Number as Train_Number',
                'Train Name as Train_Name',
                'Commercial Rate as Commercial_Rate',
                'OD Media Type as media_cat',
                'OD Media UID as media_subcat',
                'Categorization as categorization'
            );

            $where = array('OD Asset ID' => $od_asset_id, 'User ID' => $userid);
            $table = '';
            if ($request->EMP_OD_Media_ID != '') {
                $table = $this->tableODLatlongDetail;
            } else {
                $table = $this->tableODLatlongDetailTemp;
            }

            $location = DB::table($table)->select($select)->where($where)->first();

            $ind = $key;
            $ind++;
            $illumination1 = @$location->Illumination_Type == '1' ? 'selected' : '';
            $illumination2 = @$location->Illumination_Type == '2' ? 'selected' : '';

            if (@$location->Illumination_Type == '1') {
                $Lit_Type1 = @$location->Lit_Type == '1' ? 'selected' : '';
                $Lit_Type2 = @$location->Lit_Type == '2' ? 'selected' : '';
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "'><option value=''>Please Select</option><option value='1' $Lit_Type1 >Front Lit</option><option value='2' $Lit_Type2 >Back Lit</option></select></p></td>";
                $displaylit = 'block';
            } else {
                $lit_type = "<td><p><select name='lit_type[]' id='lit_type_" . $key . "' class='form-control form-control-sm' tabindex='" . $key . "' readonly style='pointer-events:none'><option value=''>Please Select</option><option value='1' >Front Lit</option><option value='2'>Back Lit</option></select></p></td>";
                $displaylit = 'none';
            }

            if (@$location->Train_Number != '0' && @$location->Train_Name != '') {
                $train_field = "<td><p><input type='text' name='Train_Data[]' placeholder='Search By Train Number/Name' class='form-control form-control-sm traindata ui-autocomplete-input' id='Train_Data_" . $key . "' value='" . @$location->Train_Number . " - " . @$location->Train_Name . "' tabindex='" . $key . "' autocomplete='off'></p></td>";
            } else {
                $train_field = '';
            }
            $location_name = $location->location_name ?? '';
            $location_data .= "<tr><td>$ind</td><td><p><textarea type='text' name='location_name[]' placeholder='Enter Location' class='form-control form-control-sm' id='location_name_" . $key . "' tabindex='" . $key . "' rows='1' maxlength='150'>$location_name</textarea></p></td><td><p><input type='text' name='length[]' placeholder='Enter Length' class='form-control form-control-sm size_area size_len_digit' id='length_" . $key . "' maxlength='3' tabindex='" . $key . "' value='" . round(@$location->Length, 2) . "' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='width[]' placeholder='Enter Width' class='form-control form-control-sm size_area size_width_digit' id='width_" . $key . "' tabindex='" . $key . "' value='" . round(@$location->Width, 2) . "' maxlength='3' onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='total_area[]' placeholder='Enter Total Area' class='form-control form-control-sm' id='Total_Area_" . $key . "' value='" . round(@$location->Length * @$location->Width, 2) . "' readonly onkeypress='return onlyNumberKey(event)'></p></td><td><p><input type='text' name='Categorization[]' placeholder='Enter Categorization' class='form-control form-control-sm' id='Categorization" . $key . "' value='" . $location->categorization . "' onkeypress='return onlyAlphabets(event,this)' readonly style='pointer-events:none'></p></td><td><p><input type='text' name='Commercial_Rate[]' placeholder='Enter Rate Offered to CBC' class='form-control form-control-sm' id='Commercial_Rate_" . $key . "' value='" . round(@$location->Commercial_Rate, 2) . "' onkeypress='return onlyNumberKey(event)'></p></td><td><p><select name='Illumination_media[]' id='Illumination_media_" . $key . "' class='form-control form-control-sm illuminationType' tabindex='" . $key . "'><option value=''>Select Illumination</option>
            <option value='1' $illumination1  style='display:" . $displaylit . "'>Lit</option><option value='2' $illumination2 >Non Lit</option></select></p></td>$lit_type  $train_field <td><a href='javascript:void(0);' class='btn btn-danger btn-sm m-0 remove_trrow' data='" . $key . "' style='font-size: 12px;pointer-events:none' readonly><i class='fa fa-minus'></i> Remove</a></td><input type='hidden' name='od_asset_id[]' id='od_asset_id_" . $key . "' value='" . $od_asset_id . "'></tr>";
        }

        if ($lit_type != '') {
            $lit_tab = "<th width='11%'>Lit Type</th>";
        }
        if ($train_field != '') {
            $train_tab = "<th width='20%'>Train Number/Name<font color='red'>*</font></th>";
        }

        $location_tab = "<table class='table' style='border: 1px solid gainsboro;' id='TableId'><thead><tr><th scope='col'>Sr.No.</th><th scope='col' width='24%'>Location<font color='red'>*</font></th><th scope='col'>Length<font color='red'>*</font></th><th scope='col'>Width<font color='red'>*</font></th><th scope='col' width='14%'>Total Area (sq. ft)<font color='red'>*</font></th><th scope='col' width='12%'>Categorization<font color='red'>*</font></th><th scope='col' width='12%'>Rate Offered to CBC<font color='red'>*</font></th><th>Illumination</th>$lit_tab $train_tab <th>Remove</th></tr></thead><tbody>";
        $location_tab .= $location_data . "</tbody></table>";
        return $location_tab;
    }
    // remove location data
    public function removeLocationData(Request $request)
    {

        $where = array("OD Vendor ID" => $request->od_media_id, 'OD Asset ID' => $request->asset_id);

        $data = DB::table($this->tableODLatlongDetail)->select("OD Media Type as od_media_type", 'OD Media UID as od_media_uid')->where($where)->first();
        $sql = DB::table($this->tableODLatlongDetail)->where($where)->delete();

        if ($sql) {
            $where = array('Sole Media ID' => $request->od_media_id, 'OD Media Type' => $data->od_media_type, 'OD Media ID' => $data->od_media_uid);
            DB::table($this->tableSoleMediasAddress)->where($where)->decrement('Quantity', 1);
            return true;
        } else {
            return false;
        }
    }

    public function accountDetail()
    {
        $userid = Session::get('UserID');
        $data = DB::table($this->tableVendorEmpODMedia)->where(['User ID' => $userid])->first();
        return view('admin.pages.outdoor-media.account_detail', compact('data'));
    }

    public function updateAccountDetail(Request $request)
    {

        $sql = (new solerightMedapi)->accountDetailSave($request);

        if ($sql) {
            return back()->with(['status' => true, 'message' => 'Data Updated Successfully!']);
        } else {
            return back()->with(['status' => false, 'message' => 'Some Error Occurred!']);
        }
    }

    public function outdoorsoleRightPdf()
    {
        $userid = Session::get('UserID');

        $solepdfdata = DB::table($this->tableVendorEmpODMedia . ' as odv')
            ->Join($this->tableSoleMediasAddress . ' as sma', 'sma.Sole Media ID', '=', 'odv.OD Media ID')
            ->join($this->tableODMediaCategory . ' as smc', 'smc.OD Media UID', '=', 'sma.OD Media ID')
            ->select(
                'odv.OD Media ID as mediaID',
                'odv.HO E-Mail as ho_email',
                'odv.HO Mobile No_ as mobile',
                DB::raw("string_agg(smc.Name,',') as subcat_name")
            )
            ->groupBy('odv.OD Media ID', 'odv.HO E-Mail', 'odv.HO Mobile No_')
            ->orderBy('odv.OD Media ID', 'desc')
            ->where(['odv.User ID' => $userid, "odv.Modification" => 1, 'odv.OD Category' => 0])
            ->get();
        $pdf = \PDF::loadView('admin.pages.outdoor-media.sole-right-pdf', compact('solepdfdata'));
        return $pdf->download($userid . '.pdf');
    }
    public function autocompletetrain(Request $request)
    {
        $res = DB::table($this->tableTrains)->select('Train No_ as train_no', 'Name as name')
            ->where("Train No_", "LIKE", "%{$request->term}%")
            ->orWhere("Name", "LIKE", "%{$request->term}%")
            ->get();
        return response()->json($res);
    }
    //svn check
    public function datainsert($email, $wing, $user_name = '')
    {
        dd($email);
        $table2 = '[' . $this->tableUMMUser . ']';
        $user_id = DB::select("select TOP 1 [User ID] from $table2 order by [User ID] desc");

        if (empty($user_id)) {
            $user_id = 'EMPOW1';
        } else {
            $user_id = $user_id[0]->{"User ID"};
            $user_id++;
        }
        if ($wing == "soleright") {
            $wing = 0;
        } elseif ($wing == "personal") {
            $wing = 1;
        } elseif ($wing == "print") {
            $wing = 3;
        } elseif ($wing == "tv") {
            $wing = 4;
        } elseif ($wing == "radio") {
            $wing = 5;
        } elseif ($wing == "producer") {
            $wing = 7;
        }

        DB::table($this->tableUMMUser)->insert([
            "User Type" => 1,
            "User ID" => $user_id,
            "User Name" => $user_name,
            "Gender" => 0,
            "password" => Hash::make('Dav@123$'),
            "email" => $email,
            "Mobile No_" => '',
            "Employee Code" => '',
            "Active" => 1,
            "Last Updated By" => '',
            "Last Update Date Time" => '2021-09-22 00:00:00.000',
            "OTP" => '',
            "Email Verification" => 1,
            "GST" => '',
            "Global Dimension 1 Code" => '',
            "Email OTP" => '',
            "wing type" => $wing
        ]);
    }

    public function getStatePDF($State_pdf = "")
    {
        $state = DB::table($this->tableState)->select('Description')->where('Code', $State_pdf)->first();
        return $state->{'Description'};
    }
    //multistate
    public function getStatemulti()
    {
        $state = DB::table($this->tableState)->select('Code', 'Description')->get();
        return $state;
    }

    public function solerightPDF($od_media_id)
    {
        $user_id = Session::get('UserID');

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $state_code = "";
        $district_array = (new api)->getDistricts();
        $districts = json_decode(json_encode($district_array), true);

        //for all category display
        $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->get();
        // get vendor data
        $where = array('OD Category' => 0, 'OD Media ID' => $od_media_id, 'User ID' => $user_id, 'Modification' => 1);
        $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
        $vendor_res = json_decode(json_encode($vendor_response), true);
        $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [];

        // get media address data
        $media_address_response = (new solerightMedapi)->getMediaAddressData($od_media_id);
        $media_address_res = json_decode(json_encode($media_address_response), true);
        $OD_media_address_data = $media_address_res['original']['success'] == true ? $media_address_res['original']['data'] : [];

        // get details of work done data
        $work_dones_response = (new solerightMedapi)->getDetailsWorkDone($od_media_id);
        $work_dones_res = json_decode(json_encode($work_dones_response), true);
        $OD_work_dones_data = $work_dones_res['original']['success'] == true ? $work_dones_res['original']['data'] : [];

        if (!empty($OD_media_address_data)) {
            //for all category display
            $getcat = DB::table($this->tableODMediaCategory)->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
        }
            //for all category display sk
            $getcat = DB::table('BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media UID as media_uid', 'Name as name')->where('Category Group', @$OD_media_address_data[0]['OD Media Type'])->get();
            $account_details = DB::table($this->tableVendorEmpODMedia)->where(['User ID' => $user_id])->first();
            //dd($OD_media_address_data);
            //company details
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
    
            $owner_response = (new solerightMedapi)->getOwnerData();
            $owner_res = json_decode(json_encode($owner_response), true);
            $owner_data = $owner_res['original']['success'] == true ? $owner_res['original']['data'] : [1];
            if (!empty($owner_data)) {
                $where = array('OD Category' => 0, 'User ID' => $user_id);
                $vendor_response = (new solerightMedapi)->getOutdoorMediaData($where);
                $vendor_res = json_decode(json_encode($vendor_response), true);
                $vendor_data = $vendor_res['original']['success'] == true ? $vendor_res['original']['data'] : [1];
    
                $where = array('OD Media Type' => 0, 'User ID' => $user_id);
    
                $branch_response = (new solerightMedapi)->getOutdoorMediaBranchOfficeData($where);
                $branch_res = json_decode(json_encode($branch_response), true);
                $branch_data = $branch_res['original']['success'] == true ? $branch_res['original']['data'] : [1];
    
                $authorize_response = (new solerightMedapi)->getOutdoorMediaAuthorizedData($where);
                $authorize_res = json_decode(json_encode($authorize_response), true);
                $authorize_data = $authorize_res['original']['success'] == true ? $authorize_res['original']['data'] : [1];
            } else {
                $owner_data = [1];
                $vendor_data = [1];
                $branch_data = [1];
                $authorize_data = [1];
            }
    
            if (!empty($vendor_data) && @$vendor_data[0]['GST No_'] != '') {
                Session::Put('ODGSTID', $vendor_data[0]['GST No_']);
                Session::Put('IFSCCODE', $vendor_data[0]['IFSC Code']);
            }
    
            $state_code = @$owner_data[0]['State'] ?? "";
            $city_array = $this->getcities($state_code);
            $ownerCities = json_decode(json_encode($city_array), true);
            $district_array = $this->getDistricts($state_code);
            $ownerDistricts = json_decode(json_encode($district_array), true);
            //getLetlong
            $select = array(
                'Location Name as location_name',
                'OD Asset ID as od_asset_id', 
                'Length', 
                'Width', 
                'Illumination Type as Illumination_Type', 
                'Lit Type as Lit_Type', 
                'Train Number as Train_Number', 
                'Train Name as Train_Name',
                'Commercial Rate as Commercial_Rate',
                'OD Media Type as media_cat',
                'OD Media UID as media_subcat'
            );
            $locations = DB::table($this->tableODLatlongDetail)->select($select)->where(['OD Vendor ID' => $od_media_id, 'User ID' => $user_id])->get();
            //dd($locations);

     //get Lat Long details data
        $get_latlong_data = (new solerightMedapi)->getLatlongDetails($od_media_id);
        $work_lat_res = json_decode(json_encode($get_latlong_data), true);
        $OD_lat_data = $work_dones_res['original']['success'] == true ? $work_lat_res['original']['data'] : [];

    $pdf = PDF::loadView('admin.pages.outdoor-media.empanelment-sole-right-pdf',['states' => $states['original']['data'], 'districts' => $districts['original']['data'],'account_details'=>$account_details , 'ownerDistricts' => $ownerDistricts['original']['data'], 'ownerCities' => $ownerCities['original']['data']], compact('vendor_data', 'OD_media_address_data' , 'getcat','owner_data', 'vendor_data', 'authorize_data', 'branch_data', 'locations','OD_work_dones_data','OD_lat_data'));
    return $pdf->download($od_media_id. '.pdf');
    }


  
        // public function errorshow($user)
        // {
        //     $password=Hash::make('Cbc@123$');
        //     $data=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$user)->update([
        //         "password"=>$password
        //     ]);
        //     if($data)
        //     {
        //         dd('Password Change');
        //     }
        //     else
        //     {
        //         dd('Error');
        //     }
    
        // }
      
}
