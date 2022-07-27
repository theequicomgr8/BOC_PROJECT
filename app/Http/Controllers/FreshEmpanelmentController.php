<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Auth; 
use Session;
use Auth;
use App\Models\Api\ApiFreshEmpanelment;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\ApiLogsController as logapi;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\vendorPrintTableTrait;
use App\Http\Traits\clientRequestTableTrait;
use Redirect;
use PDF;
use Illuminate\Support\Facades\Mail;
use File;


class FreshEmpanelmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, vendorPrintTableTrait,clientRequestTableTrait;

    public function dashboard()
    {
        $price = 0;
        if (Session::has('WingType') == 3) {
            if (Session::has('UserName')) {
                $data = DB::table($this->tablePrintVendorDetail)->select('OS Amount')->where('NP Code', session("UserName"))->first();
                if (!empty($data)) {
                    $price = round($data->{'OS Amount'}, 2);
                }
                $rolist = array();
                $UserType=Session::get('UserType');
                $today = date('Y-m-d');
                $from_date = isset($today)  ? date('Y-m-d', strtotime($today)) : '';
                $npcode = Session::get('UserName');

                //total unpaid bills
                $unpaid_bills = DB::table($this->tblROHeader.' as ROH')
                                    ->select(
                                            'ROH.Plan ID',
                                            'RL.RO No_',
                                            'RL.NP Code',
                                            'RL.Amount',
                                            'RL.Publishing Date',
                                            'RL.Compliance Status',
                                            'RL.Remarks',
                                            'RL.Amount',
                                            'RL.Billing Status',
                                            'RL.Control No_ AS ReferenceNo',
                                            'RL.Token ID',
                                            'RL.Token Date',
                                            'RL.Billing Advertisement Type AS bublished_in',
                                        )
                                    ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                                    ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                    ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                    ->where('RL.Compliance Status', 1)
                                    ->where('RL.Billing Status', 1)
                                    ->where('RL.NP Code', $npcode)
                                    ->where('RL.Physical Bill Received', 1)
                                    //->where('ROH.Status', '<>', 4)
                                    ->where('ROH.Status',3)
                                    ->orderBy('RL.Line No_', 'desc')
                                    ->count();

                $unpaid_bills_amount = DB::table($this->tblROHeader.' as ROH')
                                          ->select(
                                                'ROH.Plan ID',
                                                'RL.RO No_',
                                                'RL.NP Code',
                                                'RL.Amount',
                                                'RL.Publishing Date',
                                                'RL.Compliance Status',
                                                'RL.Remarks',
                                                'RL.Amount',
                                                'RL.Billing Status',
                                                'RL.Control No_ AS ReferenceNo',
                                                'RL.Token ID',
                                                'RL.Token Date',
                                                'RL.Billing Advertisement Type AS bublished_in',
                                                )
                                        ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                                        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                        ->where('RL.Compliance Status', 1)
                                        ->where('RL.Billing Status', 1)
                                        ->where('RL.NP Code', $npcode)
                                        ->where('RL.Physical Bill Received', 1)
                                        ->where('ROH.Status',3)
                                        ->orderBy('RL.Line No_', 'desc')
                                        ->sum('RL.Amount');

                // ro release today
                $rolist = DB::table($this->tblROHeader.' as ROH')
                                ->select(
                                    'ROH.RO Code AS RoCode',
                                    'ROH.Plan ID AS PlanId',
                                    'ROH.Client ID AS ClientId',
                                    'ROH.RO Date AS PublishDate',
                                    'RL.NP Code AS npcode',
                                    'RL.Line No_ As lineno',
                                    'RL.Pdf File Name As Pdf File Name',
                                    'MPL.Client Request Code AS CLRCode',
                                    'PCR.Crative File Name',
                                    'ROH.Plan Version AS planVersion',
                                    'RL.Amount AS Amount',
                                    'RL.Billing Advertisement Type AS bublished_in',
                                )
                                ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                                ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')                                
                                ->orderBy('ROH.RO Date','DESC')->distinct('ROH.RO Code')  
                                ->whereDate('ROH.RO Date', '=', $from_date)
                                ->where('ROH.Status',3)
                                ->Where('RL.NP Code', $npcode)->take(5)->get();
                                // dd($rolist);
                 // payment release today
                $payment_today = DB::table($this->tblROHeader.' as ROH')
                                        ->select(
                                            'ROH.RO Code AS RoCode',
                                            'ROH.Plan ID AS PlanId',
                                            'ROH.Client ID AS ClientId',
                                            'ROH.RO Date AS PublishDate',
                                            'RL.NP Code AS npcode',
                                            'RL.Line No_ As lineno',
                                            'RL.Pdf File Name As Pdf File Name',
                                            'MPL.Client Request Code AS CLRCode',
                                            'PCR.Crative File Name',
                                            'ROH.Plan Version AS planVersion',
                                            'RL.Amount AS Amount',
                                            'RL.Billing Advertisement Type AS bublished_in',
                                        )
                                        ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                                        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                        ->orderBy('ROH.RO Date','DESC')->distinct('ROH.RO Code')  
                                        ->whereDate('RL.Payment Date', '=', $from_date)
                                        ->where('ROH.Status',3)
                                        ->Where('RL.NP Code', $npcode)->take(5)->get();                       
                // bills to be submitted online
                $bill_online =  DB::table($this->tblROHeader.' as ROH')
                                    ->select(
                                        'ROH.Plan ID',
                                        'RL.RO No_',
                                        'RL.NP Code',
                                        'RL.Amount',
                                        'RL.Publishing Date',
                                        'RL.Compliance Status',
                                        'RL.Remarks',
                                        'RL.Amount',
                                        'RL.Billing Status',
                                        'RL.Control No_ AS ReferenceNo',
                                        'RL.Token ID',
                                        'RL.Token Date',
                                        'RL.Billing Advertisement Type AS bublished_in',
                                    )
                                    ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                                    ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                    ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                    ->where('RL.Compliance Status', 1)
                                    ->where('RL.Billing Status', 0)
                                    ->where('RL.Physical Bill Received', 0)
                                    ->where('RL.NP Code', $npcode)
                                    //->where('ROH.Status', '<>', 4)
                                    ->where('ROH.Status',3)
                                    ->orderBy('RL.Line No_', 'desc')
                                    ->take(5)
                                    ->get();


                // bills to be submitted physical
                $bill_physical =  DB::table($this->tblROHeader.' as ROH')
                                        ->select(
                                            'ROH.Plan ID',
                                            'RL.RO No_',
                                            'RL.NP Code',
                                            'RL.Amount',
                                            'RL.Publishing Date',
                                            'RL.Compliance Status',
                                            'RL.Remarks',
                                            'RL.Amount',
                                            'RL.Billing Status',
                                            'RL.Control No_ AS ReferenceNo',
                                            'RL.Token ID',
                                            'RL.Token Date',
                                            'RL.Billing Advertisement Type AS bublished_in',
                                        )
                                        ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                                        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                        ->where('RL.Compliance Status', 1)
                                        ->where('RL.Billing Status', 1)
                                        ->where('RL.Physical Bill Received', 0)
                                        ->where('RL.NP Code', $npcode)
                                        //->where('ROH.Status', '<>', 4)
                                        ->where('ROH.Status',3)
                                        ->orderBy('RL.Line No_', 'desc')
                                        ->take(5)
                                        ->get();
                
                if (Session::has('UserName') && Session('UserName') != '') {
                    $table = $this->tableMainNewspaperMaster;
                    $where = array('Newspaper Code' => Session('UserName'));
                    $select = array('Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
                    $res = (new api)->accountDetail($table, $select, $where);
                    $account_details = json_decode(json_encode($res), true);
                    if ($account_details['original']['success'] == true) {
                        $account_detail = $account_details['original']['data'][0];
                    } else {
                        $account_detail = '';
                    }
                } else {
                    $table = $this->tableVendorEmpPrint;
                    $where = array('User ID' => Session('id'));
                    $select = array('Newspaper Code', 'Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
                    $res = (new api)->accountDetail($table, $select, $where);
                    $account_details = json_decode(json_encode($res), true);
                    if ($account_details['original']['success'] == true) {
                        $account_detail = $account_details['original']['data'][0];
                    } else {
                        $account_detail = '';
                    }
                }

                
            }
            return view('admin.pages.dashboard', compact('price','rolist','bill_online','bill_physical','account_detail','unpaid_bills','unpaid_bills_amount','payment_today'));
        } else {
            return view('admin.pages.dashboard');
        }
    }

    public function freshEmpanelment(Request $request)
    {
        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {

            $request['user_id'] = session('id');
            $vendordata = (new api)->fetchVendorRecord($request);
            $vendordatas = json_decode(json_encode($vendordata), true);
            $ownerdatas = '';
            $ownerotherdata = '';

            if ($vendordatas['original']['success'] == true) {
                $request['key'] = 'Owner ID';
                $request['owner_id'] = $vendordatas['original']['data'][0]['Owner ID'];

                $ownerdata = (new api)->fetchOwnerRecord($request);
                $ownerdatas = json_decode(json_encode($ownerdata), true);

                $ownerdatas = $ownerdatas['original']['data'] ? $ownerdatas['original']['data'][0] : '';
                $vendordatas = $vendordatas['original']['data'] ? $vendordatas['original']['data'][0] : '';
                //dd($vendordatas);
                if (count($vendordatas) > 0) {

                    $owner_other_data = (new api)->fetchOwnerOtherRecord($request);
                    $owner_other_data = json_decode(json_encode($owner_other_data), true);

                    if ($owner_other_data['original']['success'] == true) {
                        $ownerotherdata = $owner_other_data['original']['data'];
                    }
                }
            } else {
                $vendordatas = '';
            }
        }

        $owner_state_code = $ownerdatas['State'] ?? '';
        $vendor_state_code = $vendordatas['State'] ?? '';

        $language_array = (new api)->getLanguages();
        $languages = json_decode(json_encode($language_array), true);

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $owner_district_array = (new api)->getDistricts($owner_state_code);
        $owner_districts = json_decode(json_encode($owner_district_array), true);

        $vendor_district_array = (new api)->getDistricts($vendor_state_code);
        $vendor_districts = json_decode(json_encode($vendor_district_array), true);

        return view('admin.pages.vendor-print.fresh-empanelment-form', ['languages' => $languages['original']['data'], 'states' => $states['original']['data'], 'owner_districts' => $owner_districts['original']['data'], 'vendor_districts' => $vendor_districts['original']['data'], 'ownerdatas' => $ownerdatas, 'vendordatas' => $vendordatas, 'ownerotherdata' => $ownerotherdata]);
    }

    public function freshEmpanelmentSave(Request $request)
    {
        if ($request->next_tab_1 == 1) {
            $request->validate(
                [
                    'email' => 'required',
                    'mobile' => 'required',
                    'address' => 'required',
                    // 'state' => 'required',
                    'city' => 'required',
                    // 'district' => 'required'
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 5;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveOwnerData($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        // Session::put('email',Session('email') ?? $request->v_email);
        if ($request->next_tab_2 == 1) {
            $request->validate(
                [
                    'newspaper_name' => 'required',
                    'place_of_publication' => 'required',
                    'v_email' => 'required',
                    'v_mobile' => 'required',
                    'v_address' => 'required',
                    'v_state' => 'required',
                    'v_city' => 'required',
                    'v_district' => 'required',
                    'pin_code' => 'required',
                    'language' => 'required',
                    'periodicity' => 'required',
                    'cir_base' => 'required',
                    'claimed_circulation' => 'required',
                    'quality_paper_used' => 'required',
                    'printing_colour' => 'required',
                    'news_agencies_subscribed' => 'required',
                    // 'agencies' => 'required',
                    'price_newspaper' => 'required',
                    'name_of_editor' => 'required',
                    'editor_email' => 'required',
                    'editor_mobile' => 'required',
                    // 'editor_phone' => 'required',
                    'publisher_name' => 'required',
                    'publisher_email' => 'required',
                    'publisher_mobile' => 'required',
                    // 'publisher_phone' => 'required',
                    'printer_name' => 'required',
                    'printer_email' => 'required',
                    'printer_mobile' => 'required',
                    //'printer_phone' => 'required',
                    'name_of_press' => 'required',
                    'press_email' => 'required',
                    'press_mobile' => 'required',
                    // 'press_phone' => 'required',
                    // 'ca_email' => 'required',
                    // 'ca_mobile' => 'required',
                    //'ca_phone' => 'required',
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 6;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            //$logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorData($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        if ($request->next_tab_3 == 1) {
            $request->validate(
                [
                    'bank_account_no' => 'required',
                    'account_holder_name' => 'required',
                    'bank_name' => 'required',
                    'ifsc_code' => 'required',
                    'branch_name' => 'required',
                    'address_of_account' => 'required',
                    'pan_card' => 'required',
                ]
            );
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 7;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorAccount($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }

        if ($request->submit_btn == 1 && $request->next_tab_1 == 0) {
            if ($request->Modification  == '') {
                $request->validate(
                    [
                        // 'rni_reg_file_name' => 'required',
                        'annexure_file_name' => 'required',
                        //'circulation_cert_file_name' => 'required',
                        // 'annual_return_file_name' => 'required',
                        'specimen_copy_file_name' => 'required',
                        'commercial_rate_file_name' => 'required',
                        // 'no_dues_cert_file_name' => 'required',
                        //'gst_reg_cert_file_name' => 'required',
                        'declaration_field_file_name' => 'required',
                        'pan_copy_file_name' => 'required',
                        // 'dm_declaration_file_name' => 'required',
                        'advertisement_policy' => 'required'
                    ]
                );
            }
            $request['client_ip'] = $request->ip();
            $request['user_id'] = session('id');
            $request['activity_id'] = 8;
            $request['page_url'] = url()->current();
            $request['Module_Id'] = 1;
            // $logres = (new logapi)->save_activity_logs($request);
            $resp = (new api)->freshEmpanelmentSaveVendorDocs($request);
            $response = json_decode(json_encode($resp), true);

            if ($response['original']['success'] == true) {
                if ($request->vendorid_tab_4 != '') {

                    $res = $this->printPDFCode($request->vendorid_tab_4);
                    $details['body'] = 'Thank you for your application at Central Bureau of Communication. Please find the attached application with the file/reference number';
                    $details['ref_no'] = $request->vendorid_tab_4;
                    $details['content'] = 'The same can be downloaded post login into CBC portal';
                    $details['url'] = 'http://104.211.206.19:8585/vendor-login';
                    $details['pdf'] = $res->output();

                    $details['group_code'] = $request->ownerid ?? '';
                    //'ysharma@expediens.com'
                    $this->mailSend($details, $request->v_email);
                }
                return response()->json(['success' => true, 'message' => $response['original']['message']]);
            } else {
                return response()->json(['success' => false, 'message' => $response['original']['message']]);
            }
        }
        if (@$response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }


    public function getDistrict(Request $request)
    {
        $districts = (new api)->getDistrictByState($request);
        $response = json_decode(json_encode($districts), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }

    // get exist owner data
    public function existingOwnerData(Request $request)
    {
        $owner_datas = (new api)->existingOwnerData($request);
        $response = json_decode(json_encode($owner_datas), true);
        return response()->json(['status' => $response['original']['status'], 'message' => $response['original']['message']]);
    }

    // check duplicate records into database
    public function checkUniqueOwner($emailparam = '')
    {
        $count_id = DB::table($this->tableOwner)->where('Email ID', $emailparam)->orWhere('Mobile No_', $emailparam)->count();

        if ($count_id > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function fetchOwnerRecord(Request $request)
    {
        $request['key'] = 'Email ID';
        $request['owner_id'] = $request->data;
        $ownerdata = (new api)->fetchOwnerRecord($request);
        $ownerdatas = json_decode(json_encode($ownerdata), true);

        //get vendor edition
        $countvendordatas = '';
        $vendorDatas = '';
        $request['Owner_ID'] = $ownerdatas['original']['data'][0]['Owner ID'];
        $vendordatac = (new api)->countVendorRecords($request);
        $vendordata = json_decode(json_encode($vendordatac), true);

        if ($vendordata['original']['success'] == true) {
            $countvendordatas = count($vendordata['original']['data']);
            $vendorDatas = $vendordata['original']['data'];
        }

        if ($ownerdatas['original']['success'] == true) {
            // state dropdown section
            $state_array = (new api)->getStates();
            $states = json_decode(json_encode($state_array), true);
            $state_data = "<option value=''>Please Select</option>";
            foreach ($states['original']['data'] as $state) {
                $selected =  $ownerdatas['original']['data'][0]['State'] === $state['Code']  ? 'selected' : '';
                $state_data .= "<option value='" . $state['Code'] . "' $selected>" . $state['Description'] . "</option>";
            }
            // district dropdown section
            $state_code = $ownerdatas['original']['data'][0]['State'] ?? '';
            $dist_array = (new api)->getDistricts($state_code);
            $districts = json_decode(json_encode($dist_array), true);
            $dist_data = "<option value=''>Please Select</option>";
            foreach ($districts['original']['data'] as $district) {
                $selected =  $ownerdatas['original']['data'][0]['District'] === $district['District']  ? 'selected' : '';
                $dist_data .= "<option value='" . $district['District'] . "' $selected>" . $district['District'] . "</option>";
            }
            // city dropdown section
            $state_code = $ownerdatas['original']['data'][0]['State'] ?? '';
            $city_array = (new api)->getcities($state_code);
            $cities = json_decode(json_encode($city_array), true);
            $city_data = "<option value=''>Please Select</option>";
            foreach ($cities['original']['data'] as $city) {
                $selected =  $ownerdatas['original']['data'][0]['City'] === $city['cityName']  ? 'selected' : '';
                $city_data .= "<option value='" . $city['cityName'] . "' $selected>" . $city['cityName'] . "</option>";
            }

            return response()->json(['status' => 1, 'message' => $ownerdatas['original']['data'][0], 'state' => $state_data, 'districts' => $dist_data, 'cities' => $city_data, 'countvendordatas' => $countvendordatas, 'vendordatas' => $vendorDatas]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkUniqueVendor($emailparam = '')
    {
        $count_id = DB::table($this->tableVendorEmpPrint)->where('E-mail ID', $emailparam)->orWhere('Mobile No_', $emailparam)->count();
        if ($count_id > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function previousLogsave(Request $request)
    {
        // $request->session()->reflash();
        $request['client_ip'] = $request->ip();
        $request['user_id'] = session('id');
        $request['activity_id'] = $request->activity_id;
        $request['page_url'] = url()->current();
        $request['Module_Id'] = 1;
        // $logres = (new logapi)->save_activity_logs($request);
        // $logres = json_decode(json_encode($logres), true);
        //return $logres;
        return true;
    }

    public function checkRegCirBase(Request $request)
    {
        $reg_data = (new api)->checkRegCirBase($request);
        $response = json_decode(json_encode($reg_data), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => '']);
        }
    }

    public function vendorRateOffered()
    {
        $vendor_datas = (new api)->printRateOffered();
        $response = json_decode(json_encode($vendor_datas), true);
        if ($response['original']['success'] == true) {
            return view('admin.pages.vendor-print.vendor-rate-offered-form', ['data' => $response['original']['data'][0]]);
        } else {
            return view('admin.pages.vendor-print.vendor-rate-offered-form', ['data' => '']);
        }
    }

    public function vendorRateStatusupdate(Request $request)
    {
        $resp = (new api)->printRateStatusupdate($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return back()->with(['status_msg' => $response['original']['success'], 'message' =>  $response['original']['message']]);
        } else {
            return back()->with(['status_msg' => $response['original']['success'], 'message' => $response['original']['message']]);
        }
    }

    public function getPressOwnerData(Request $request)
    {
        $resp = (new api)->getPressOwnerData($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true && count($response['original']['data']) > 0) {
            return response()->json(['status' => true, 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => false, 'data' => '']);
        }
    }


    public function printRenewal(Request $request)
    {
        if(Session::has('UserName'))
        {
            $np_code = Session('UserName');
        }
        else{
            $request->validate(
                [
                    'np_code' => 'required'
                ]
            );
            $np_code = $request->np_code;
        }
        $rni_efiling_no = $request->rni_efiling_no;
        $check_rni = explode('-',$rni_efiling_no);
        
        $tableMainNewspaperMaster = $this->tableMainNewspaperMaster;
        $tableNPRateRenewal = $this->tableNPRateRenewal;
        $vendor_datas = '';
        $np_rate_renewal = '';
        $vendor_datas = DB::table($tableMainNewspaperMaster)->select("Owner ID")->where('Newspaper Code', Session('UserName'))->first();
        $RNI_check ='';
        if($check_rni[0]=='E2022')
        {
            // $RNI_check  = DB::table('BOC$RNI Efile Master')->where('EFILE',$rni_efiling_no)->orWhere('np_code',$np_code)->first();
            $RNI_check = 1;
        }
                

        if (!empty($vendor_datas)) {
            // get vendor newspaper data from NP renewal master table
            $np_rate_renewal = DB::table($tableNPRateRenewal)->select("*")->where('NP Code', $np_code)->first();
        }
        if(empty($RNI_check)){
           
            return view('admin.pages.vendor-print.fresh-empanelment-renewal-form')->with([ 'vendor_datas' => $vendor_datas,'np_rate_renewal' => $np_rate_renewal]);

        }else{
            return view('admin.pages.vendor-print.fresh-empanelment-renewal-form')->with([ 'vendor_datas' => $vendor_datas,'np_rate_renewal' => $np_rate_renewal]);
        }
        
        
    }

    public function printRenewalView(Request $request)
    {
       
        if(Session::has('UserName'))
        {
            $np_code = Session('UserName');
        }
        else{
            $request->validate(
                [
                    'np_code' => 'required'
                ]
            );
            $np_code = $request->np_code;
        }
        $rni_efiling_no = $request->rni_efiling_no;
        $check_rni = explode('-',$rni_efiling_no);
        $RNI_check ='';
        if($check_rni[0]=='E2022')
        {
            // $RNI_check  = DB::table('BOC$RNI Efile Master')->where('np_code',$np_code)->first();
            $RNI_check = 1;
        }
        $latest_dm_declaration_date = $request->latest_dm_declaration_date;
        Session::put('latest_dm_declaration_date',$latest_dm_declaration_date);

        // dd($check_rni);
        if($RNI_check)
        {
            if (Session::has('UserName') && Session('UserName') != '') {
                // dd($np_code);
                $tableOwner = $this->tableOwner;
                $tableMainNewspaperMaster = $this->tableMainNewspaperMaster;
                $tableNPRateRenewal = $this->tableNPRateRenewal;
                $tablePayee = 'BOC$Payee Master Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
                $owner_other_publications = [];
                $owner_datas = '';
                $np_rate_renewal = '';
                $vendor_datas = '';
                $payee_datas = '';
           
                // get Owner ID from main newspaper master table
                $vendor_datas = DB::table($tableMainNewspaperMaster)->select("Owner ID")->where('Newspaper Code', Session('UserName'))->first();
                $payee_datas = DB::table($tablePayee)->where('NP Code',Session('UserName'))->first();
    
                if (!empty($vendor_datas->{'Owner ID'})) {
    
                    // get Owner data from Owner table
                    $owner_datas = DB::table($tableOwner)->select("*")->where('Owner ID', $vendor_datas->{'Owner ID'})->first();
    
                    // get owner other publications data from main newspaper master table
                    $where = array(
                        ['Newspaper Code', '!=', $np_code],
                        ['Owner ID', '=', $vendor_datas->{'Owner ID'}]
                    );
                    $select = array('Newspaper Name', 'Language', 'Place of Publication', 'Periodicity', 'Newspaper Code', 'Distance from office to press');
    
                    $owner_other_publications = DB::table($tableMainNewspaperMaster)->select($select)->where($where)->orderBy('Newspaper Code', 'desc')->get();
                    
                    // get vendor newspaper data from main newspaper master table
                    $where = array(
                        ['Newspaper Code', '=', $np_code],
                        ['Owner ID', '=', $vendor_datas->{'Owner ID'}]
                    );
                    $vendor_datas = DB::table($tableMainNewspaperMaster)->select("*")->where($where)->first();
                    // dd($vendor_datas);
                } else {
                    if (Session('UserName') == $np_code) {
                        // get vendor newspaper data from main newspaper master table
                        $where = array('Newspaper Code', $np_code);
                        $vendor_datas = DB::table($tableMainNewspaperMaster)->select("*")->where('Newspaper Code', $np_code)->first();
                        
                    } else {
                        return back()->with(['status' => 'Fail', 'message' => 'No data found!']);
                        exit;
                    }
                }
    
                if (!empty($vendor_datas)) {
                    // get vendor newspaper data from NP renewal master table
                    $np_rate_renewal = DB::table($tableNPRateRenewal)->select("*")->where('NP Code', $np_code)->first();
                }
    
                if (!empty($vendor_datas)) {
    
                    $language_array = (new api)->getLanguages();
                    $languages = json_decode(json_encode($language_array), true);
                    $state_array = (new api)->getStates();
                    $states = json_decode(json_encode($state_array), true);
                    $district_array = (new api)->getDistricts();
                    $district = json_decode(json_encode($district_array), true);

                    return view('admin.pages.vendor-print.fresh-empanelment-renewal-save-form')->with(['owner_datas' => $owner_datas, 'vendor_datas' => $vendor_datas, 'owner_other_publications' => $owner_other_publications, 'np_rate_renewal' => $np_rate_renewal, 'languages' => $languages['original']['data'], 'states' => $states['original']['data'], 'districts' => $district['original']['data'],'payee_datas'=>$payee_datas,'RNI_check'=>$RNI_check,'rni_efiling_no'=>$rni_efiling_no,'latest_dm_declaration_date'=>$latest_dm_declaration_date]);
                } else {
                    return view('admin.pages.vendor-print.fresh-empanelment-renewal-form')->with(['status' => 'Fail', 'message' => 'No data found!']);
                }
            } else {
                return view('admin.pages.vendor-print.fresh-empanelment-renewal-form')->with(['status' => 'Fail', 'message' => 'Not found!']);
                // return back();
            }
        }
        else{
            $status = 'Please enter correct RNI EFilling No.';
            return view('admin.pages.vendor-print.fresh-empanelment-renewal-form')->with(['status' => $status]);

        }
      
        
    }


    public function printRenewalSave(Request $request)
    {

        // $request->validate(
        //     [
        //         'owner_type' => 'required',
        //         'cir_base' => 'required',
        //         // 'v_email' => 'required',
        //         'v_mobile' => 'required',
        //         'v_address' => 'required',
        //         // 'pin_code' => 'required',
        //         // 'claimed_circulation' => 'required',
        //         'print_area' =>'required',
        //         // 'printing_colour' => 'required',
        //         'page_length' => 'required',
        //         'page_width' => 'required',
        //         'no_of_page' => 'required',
        //         // 'publisher_name' => 'required',
        //         // 'publisher_email' => 'required',
        //         // 'publisher_mobile' => 'required',
        //         // 'publisher_address' => 'required',
        //         // 'printer_name' => 'required',
        //         // 'printer_email' => 'required',
        //         // 'printer_phone' => 'required',
        //         // 'printer_address' => 'required',
        //         // 'dm_declaration_date' => 'required',
        //         // 'Circulation_File_Name' => 'required',
        //         // 'DMD_File_Name' => 'required',
        //     ]
        // );
        // dd($request);
        $resp = (new api)->printRenewalSave($request);

        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json(['success' => true, 'message' => $response['original']['message']]);
        } else {
            return response()->json(['success' => false, 'message' => $response['original']['message']]);
        }
    }
    public function checkUniqueEmailVendor(Request $request)
    {
        $resp = (new api)->checkUniqueEmailVendor($request->email, $request->np_code);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => 1, 'message' => 'Email already exist']);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function checkGstno(Request $request)
    {
        $res = (new api)->checkGSTNo($request);
        $response = json_decode(json_encode($res), true);
        //   dd($response);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => 'GST No. already exist']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkRenewalGSTNo(Request $request)
    {
        $res = (new api)->checkRenewalGSTNo($request->gst_no, $request->ownerid);
        $response = json_decode(json_encode($res), true);
        //   dd($response);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => 'GST No. already exist']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkRenewalRegCirBase(Request $request)
    {
        $reg_data = (new api)->checkRenewalRegCirBase($request->cir_no, $request->reg_no, $request->np_code);
        $response = json_decode(json_encode($reg_data), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => '']);
        }
    }

    public function checkRegCirBaseNew(Request $request){
        // dd($request);
        $reg_data = (new api)->checkRegCirBaseNew($request->cir_no,$request->rni_rni_efiling_no,$request->np_code,$request->periodicity,$request->reg_no);
        $response = json_decode(json_encode($reg_data), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => $response['original']['data'][0]]);
        } else {
            return response()->json(['status' => $response['original']['success'], 'message' => $response['original']['message'], 'data' => '']);
        }
    }

    public function accountDetail()
    {
        $account_detail = '';
        if (Session::has('UserName') && Session('UserName') != '') {
            $table = $this->tableMainNewspaperMaster;
            $where = array('Newspaper Code' => Session('UserName'));
            $select = array('Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
            $res = (new api)->accountDetail($table, $select, $where);
            $account_details = json_decode(json_encode($res), true);
            if ($account_details['original']['success'] == true) {
                $account_detail = $account_details['original']['data'][0];
            } else {
                $account_detail = '';
            }
        } else {
            $table = $this->tableVendorEmpPrint;
            $where = array('User ID' => Session('id'));
            $select = array('Newspaper Code', 'Bank Account No_', 'Account Holder Name', 'Account Address', 'IFSC Code', 'Bank Name', 'Branch', 'PAN', 'Account Type', 'ESI Account No', 'No_of Employees covered', 'EPF Account No_', 'No_ of EPF Employees covered');
            $res = (new api)->accountDetail($table, $select, $where);
            $account_details = json_decode(json_encode($res), true);
            if ($account_details['original']['success'] == true) {
                $account_detail = $account_details['original']['data'][0];
            } else {
                $account_detail = '';
            }
        }
        return view('admin.pages.vendor-print.account-detail-form')->with(['account_detail' => $account_detail]);
    }

    public function accountDetailSave(Request $request)
    {
        $request->validate(
            [
                'account_type' => 'required',
                'bank_account_no' => 'required',
                'account_holder_name' => 'required',
                'bank_name' => 'required',
                'ifsc_code' => 'required',
                'branch_name' => 'required',
                'address_of_account' => 'required',
                'pan_card' => 'required'
            ]
        );

        $resp = (new api)->accountDetailSave($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return back()->with(['status' => $response['original']['success'], 'message' =>  $response['original']['message']]);
        } else {
            return back()->with(['status' => $response['original']['success'], 'message' => $response['original']['message']]);
        }
    }

    public function checkIsPrimaryEdition(Request $request)
    {
        $res = (new api)->isPrimaryEdition($request->owner_id);
        $response = json_decode(json_encode($res), true);
        if ($response['original']['success'] == true) {
            return response()->json(['status' => true, 'message' => $response['original']['data'][0]['Newspaper Name'] . ' edition is already primary']);
        } else {
            return response()->json(['status' => false, 'message' => 'No data found']);
        }
    }

    public function checkgstprint(Request $request)
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

    public function printPDF(Request $request)
    {
        $pdf = $this->printPDFCode($request->np_code);
        return $pdf->download($request->np_code . '.pdf');
    }
    public function printPDFCode($np_code)
    {
        $response = (new api)->printPDFData($np_code);
        $print_data = json_decode(json_encode($response), true);
        $owner = $print_data['original']['data']['owner_details'];
        $vendor = $print_data['original']['data']['vendor_details'];
        $owner_datas = array(
            'owner' => $owner
        );
        $vendor_datas = array(
            'vendor' => $vendor
        );
        $pdf = PDF::loadView('admin.pages.vendor-print.print-pdf', compact('owner_datas', 'vendor_datas'));
        return $pdf;
    }

    public function printRenewalPDF(Request $request)
    {
        $pdf = $this->printRenewalPDFCode($request->np_code);
        return $pdf->download($request->np_code . '.pdf');
    }
    public function printRenewalPDFCode($np_code)
    {
       //dd($np_code);
        $response = (new api)->printRenewalPDFData($np_code);
        $language_array = (new api)->getLanguages();
        $languages = json_decode(json_encode($language_array), true);
        $lang = $languages['original']['data'];
         //dd($response);
        $print_data = json_decode(json_encode($response), true);
        $owner = $print_data['original']['data']['owner_details'];
        $vendor = $print_data['original']['data']['vendor_details'];
        $renewal = $print_data['original']['data']['np_rate_renewal'];
        $tablePayee = 'BOC$Payee Master Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
        $payee_datas = '';
        $payee_datas = DB::table($tablePayee)->where('NP Code',$np_code)->first(); 
        $owner_datas = array(
            'owner' => $owner
        );
        $vendor_datas = array(
            'vendor' => $vendor
        );
        $renewal_datas = array(
            'renewal' => $renewal
        );
        $np_code = $np_code;
        //dd($owner_datas);
        $pdf = PDF::loadView('admin.pages.vendor-print.print-renewal-pdf', compact('owner_datas', 'vendor_datas', 'renewal_datas','np_code','payee_datas','lang'));
        return $pdf;
    }

    public function getDistrictCity(Request $request)
    {
        $state_code = $request->state_code;
        // cities dropdown
        $city_array = (new api)->getcities($state_code);
        $cities = json_decode(json_encode($city_array), true);
        $city_data = "<option value=''>Please Select</option>";
        if ($cities['original']['success'] == true) {
            foreach ($cities['original']['data'] as $city) {
                $city_data .= "<option value='" . $city['cityName'] . "'>" . $city['cityName'] . "</option>";
            }
        }

        // district dropdown
        $district_array = (new api)->getDistricts($state_code);
        $districts = json_decode(json_encode($district_array), true);
        $dist_data = "<option value=''>Please Select</option>";
        if ($districts['original']['success'] == true) {
            foreach ($districts['original']['data'] as $district) {
                $dist_data .= "<option value='" . $district['District'] . "'>" . $district['District'] . "</option>";
            }
            return response()->json(['status' => 1, 'districts' => $dist_data, 'cities' => $city_data]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function basic_detail(Request $request)
    {

        if (!Session::has('id')) {
            return Redirect('/vendor-login');
        } else {

            $vendor_master_table = $this->tableMainNewspaperMaster;
            $vendor_table = $this->tableVendorEmpPrint;
            $vendor_res = '';
            $ownerdata = '';
            $user_id = Session::get('id');
            $np_code = Session::get('UserName');

            $orwhere = array('User ID' => $user_id);
            $where = array('Newspaper Code' => $np_code);
            $vendor_res = DB::table($vendor_master_table)->select('Owner ID', 'PAN Copy File Name')->where($where)->first();

            if (empty($vendor_res)) {
                $vendor_res = DB::table($vendor_table)->select('Owner ID', 'PAN Copy File Name')->where($where)->orWhere($orwhere)->first();
            }


            if (!empty($vendor_res)) {
                $request['key'] = 'Owner ID';
                $request['owner_id'] = $vendor_res->{'Owner ID'};
                $ownerdata_array = (new api)->fetchOwnerRecord($request);
                $ownerdatas = json_decode(json_encode($ownerdata_array), true);
                $ownerdata = $ownerdatas['original']['data'] ? $ownerdatas['original']['data'][0] : '';
            }
        }
        $state_code = !empty($ownerdata) ? $ownerdata['State'] : '';

        $state_array = (new api)->getStates();
        $states = json_decode(json_encode($state_array), true);

        $district_array = (new api)->getDistricts($state_code);
        $district = json_decode(json_encode($district_array), true);

        $city_array = (new api)->getcities($state_code);
        $cities = json_decode(json_encode($city_array), true);

        return view('admin.pages.vendor-print.print-basic-detail', ['states' => $states['original']['data'], 'districts' => $district['original']['data'], 'cities' => $cities['original']['data'], 'ownerdatas' => $ownerdata, 'vendordatas' => $vendor_res]);
    }


    public function basic_detail_save(Request $request)
    {
        $user_id = Session::get('id');
        $np_code = Session::get('UserName');
        $owner_id = $request->ownerid ?? '';

        $vendor_table = $this->tableVendorEmpPrint;
        $vendor_master_table = $this->tableMainNewspaperMaster;
        $owner_table = $this->tableOwner;

        // validate owner data
        $request->validate([
            'owner_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'owner_type' => 'required',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
            'city' => 'required'
        ]);

        // select existing data
        $select = array(
            'PAN Copy File Name',
            'Newspaper Code'
        );
        $orwhere = array('User ID' => $user_id);
        $where = array('Newspaper Code' => $np_code);

        $response = DB::table($vendor_master_table)->select($select)->where($where)->first();

        if (empty($response)) {
            $response = DB::table($vendor_table)->select($select)->where($where)->orWhere($orwhere)->first();
        }

        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $mypath = public_path() . '/uploads/fresh-empanelment/' . @$response->{'Newspaper Code'} . "/";
        if (!File::isDirectory($mypath)) {
            File::makeDirectory($mypath, 0777, true, true);
        }

        $pan_copy_file_name = @$response->{'PAN Copy File Name'} ?? '';
        $pan_copy = 0;
        if ($request->hasFile('pan_copy_file_name')  || $request->hasFile('pan_copy_file_name_modify')) {
            $file = $request->file('pan_copy_file_name') ?? $request->file('pan_copy_file_name_modify');
            $pan_copy_file_name = time() . '-' . @$response->{'Newspaper Code'} . '-PANCopy';
            $file_uploaded = $file->move($destinationPath, $pan_copy_file_name);
            File::copy($destinationPath . $pan_copy_file_name, $mypath . $pan_copy_file_name);
            if ($file_uploaded) {
                $pan_copy = 1;
            } else {
                $pan_copy_file_name = '';
            }
        }

        $res_owner_id = (new api)->saveCompanyOwnerData($request, $owner_id);

        // update data to main master table print
        if ($res_owner_id != false) {
            $update_data = [
                "PAN Copy File Name" => $pan_copy_file_name,
                "Owner ID" => $res_owner_id
            ];
            if (Session::has('UserName') && Session('UserName') != '') {
                $vendordata_save = DB::table($vendor_master_table)->Where($where)->update($update_data);
            } else {
                $vendordata_save = DB::table($vendor_table)->Where($orwhere)->update($update_data);
            }
            if ($vendordata_save) {
                Session::flash('update_msg', "Data Saved successfully!");
                return redirect()->route('basic-detail');
            }
        } else {
            Session::flash('update_err', "Some Error Occurred!");
            return redirect()->route('basic-detail');
        }
    }


    // check duplicate records into database
    public function checkUniqueOwnerCompany(Request $request)
    {
        $key = is_numeric($request->data) ? 'Mobile No_' : 'Email ID';
        if ($request->owner_id != '') {
            $where = array(
                [$key, '=', $request->data],
                ['Owner ID', '!=', $request->owner_id]
            );
            $count_id = DB::table($this->tableOwner)->where($where)->count();
        } else {
            $count_id = DB::table($this->tableOwner)->where($key, $request->data)->count();
        }

        if ($count_id > 0) {
            return response()->json(['status' => 0, 'message' => 'already exist']);
        } else {
            return response()->json(['status' => 1, 'message' => 'No data found']);
        }
    }

    public function billsReportStatus(Request $request)
    {
        # code...
        $npcode = Session::get('UserName');
        $status = $request->status;

        if($status == 0)
        { 
            $billing_status = 0;
            $heading = 'Bills to be Submitted Online';
        }
        else{ 
            $billing_status = 1;
            $heading = 'Bills to be Submitted Physical';
        }

        $bills =  DB::table($this->tblROHeader.' as ROH')
                                ->select(
                                    DB::raw("(CASE
                                    WHEN ROH.Status = 0 THEN 'Open'
                                    WHEN ROH.Status = 1 THEN 'Approved'
                                    WHEN ROH.Status = 2 THEN 'end to Vendor'
                                    WHEN ROH.Status = 3 THEN 'PDF Created'
                                    WHEN ROH.Status = 4 THEN 'Rolled Back'
                                    ELSE 'NA'
                                    END) AS StatusLable"),
                                    'ROH.Plan ID',
                                    'RL.RO No_',
                                    'RL.NP Code',
                                    'RL.Amount',
                                    'RL.NP Name',
                                    'RL.Publishing Date',
                                    'RL.Compliance Status',
                                    'RL.Remarks',
                                    'RL.Language',
                                    'RL.State Name',
                                    'RL.Amount',
                                    'PCR.Crative File Name',
                                    'PCR.Size of Advt_ AS advtSize',
                                    'RL.Billing Status',
                                    'RL.Control No_ AS ReferenceNo',
                                    'RL.Token ID',
                                    'RL.Token Date',
                                    'ROH.Tentative Publishing Date AS TentativePublishingDate',
                                    'RL.Billing Advertisement Type AS bublished_in',
                                    'RL.Vendor Bill Date AS VendorBillDate',
                                    'RL.Vendor Bill No_ AS VendorBillNo_'

                                )
                                ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                                ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                                ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
                                ->where('RL.Compliance Status', 1)
                                ->where('RL.Billing Status', $billing_status)
                                ->where('RL.Physical Bill Received',0)
                                ->where('RL.NP Code', $npcode)
                                ->where('ROH.Status',3)
                                ->orderBy('RL.Line No_', 'desc')
                                ->get();

            return view('admin.pages.dailycompliance.bills', compact('bills','heading','status'));
    }
}
