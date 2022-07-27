<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ApiFreshEmpanelment;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\vendorPrintTableTrait;
use App\Models\User;
use Session;
use Carbon\Carbon;
use File;
use Hash;

class ApiFreshEmpanelmentController extends Controller
{
    use CommonTrait, vendorPrintTableTrait;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function freshEmpanelmentSaveOwnerData(Request $request)
    {
        $table1 = '[' . $this->tableOwner . ']';
        $msg = '';
        $unique_id = array();
        if ($request->exist_owner_id != "") {
            $owner_id = DB::select("select [Owner ID] from $table1 where [Email ID] = '" . $request->email . "' and [Mobile No_] = '" . $request->mobile . "' and [Owner ID] = '" . $request->exist_owner_id . "' ");

            $owner_id = $owner_id[0]->{"Owner ID"};
            $sql = $owner_id != '' ? true : false;
            $msg = 'Successfully!';
        } else {
            $request->phone = $request->phone ?? '';
            $request->fax_no = $request->fax_no ?? '';
            $request->owner_name = $request->owner_name ?? '';
            $request->owner_type = $request->owner_type ?? '';

            if ($request->ownerid == '') {
                $owner_id = DB::table($this->tableOwner)->select('Owner ID')->orderBy('Owner ID', 'desc')->first();
                if (empty($owner_id)) {
                    // owner id formate
                    $owner_id = 'EMPOW1';
                } else {
                    $owner_id = $owner_id->{"Owner ID"};
                    $owner_id++;
                }
                $sql =  $this->insertOwnerData($request, $owner_id);
                $msg = 'Data Saved Successfully!';
            } else {
                $owner_id = $request->ownerid;
                $sql =  $this->updateOwnerData($request, $owner_id);
                $msg = 'Data Updated Successfully!';
            }
        }
        if ($sql) {
            $unique_id = array('Owner_ID' => $owner_id);
            return $this->sendResponse($owner_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }

    public function getStateCode($name)
    {
        # code...
        $table = 'BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c';
        $result = DB::table($table)->select('State Code for eTDS_TCS As StateCode')->where('Code',$name)->first();
        return $result;
       
    }

    public function freshEmpanelmentSaveVendorData(Request $request)
    {

        // define vendor info variables
        $mytime = Carbon::now();
        $application_date = $mytime->format('Y-m-d');
        $status = 0;
        $davp_checkbox = $request->davp_checkbox == "on" ? 1 : 0;
        $self_declaration = $request->self_declaration == "on" ? 1 : 0;
        $dm_declaration_date = '1970-01-01';
        $rate_status_date = '1970-01-01';
        if ($request->dm_declaration_date != '') {
            $dm_declaration_date = date('Y-m-d', strtotime($request->dm_declaration_date));
        }
        //use variable for RNI
        $rni_registration_no = '';
        $rni_efiling_no = '';
        $claimed_circulation = 0;
        $rni_reg_no_verified = 0;
        $rni_annual_valid = 0;
        $rni_claimed_circulation_verified = 0;
        $RNI_Validation_Date = '1970-01-01';

        //use variable for ABC
        $abc_certificate_no = '';
        $abc_claimed_circulation = '';
        $abc_reg_no_verified = 0;
        $abc_annual_valid = 0;
        $abc_claimed_circulation_verified = 0;
        $ABC_Validation_Date = '1970-01-01';

        // use variable for CA
        $caregistration_no = '';
        $ca_claimed_circulation = '';

        if ($request->cir_base == 0) {
            $rni_registration_no = $request->rni_registration_no ?? '';
            $rni_efiling_no = $request->rni_efiling_no ?? '';
            $claimed_circulation = $request->claimed_circulation ?? 0;

            $rni_reg_no_verified = $request->rni_reg_no_verified ?? 0;
            $rni_annual_valid = $request->rni_annual_valid ?? 0;
            $rni_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old) {
                $RNI_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $RNI_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        if ($request->cir_base == 1) {
            $ca_claimed_circulation = $request->claimed_circulation ?? '';
        }

        if ($request->cir_base == 3) {
            $abc_certificate_no = $request->abc_certificate_no ?? '';
            $abc_claimed_circulation = $request->claimed_circulation ?? '';

            $abc_reg_no_verified = $request->abc_reg_no_verified ?? 0;
            $abc_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old) {
                $ABC_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $ABC_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        if ($request->date_of_first_publication) {
            $date_of_first_publication = date('Y-m-d', strtotime($request->date_of_first_publication));
        } else {
            $date_of_first_publication = $mytime->format('Y-m-d');
        }

        //Get value for Receiver ID.
        $get_receiver_code = DB::table($this->tableMediaPlanSetup)->select("Print Empanel Landing UID")->first();
        $recervier_id = $get_receiver_code->{"Print Empanel Landing UID"};

        // common data for insert and update
        $data = array(
            'Newspaper Name' => $request->newspaper_name,
            'Place of Publication' => $request->place_of_publication,
            'Language' => $request->language,
            'RNI Registration No_' => $rni_registration_no,
            'Claimed Circulation' => $claimed_circulation,
            'CIR Base' => $request->cir_base,
            'RNI E-filling No_' => $rni_efiling_no,
            'Address' => $request->v_address ?? '',
            'City' => $request->v_city ?? '',
            'State' => $request->v_state ?? '',
            'District' => $request->v_district ?? '',
            'Pin Code' => $request->pin_code ?? '',
            'Phone No' => $request->v_phone ?? '',
            'Fax' => $request->v_fax_no ?? '',
            'Mobile No_' => $request->v_mobile ?? '',
            'E-mail ID' => $request->v_email ?? '',
            'Page Length' => $request->page_length ?? 0,
            'Page Width' => $request->page_width ?? 0,
            'Page Area per page' => $request->print_area ?? 0,
            'No_ Of pages' => $request->no_of_page ?? 0,
            'Total Print Area' => $request->total_print_area ?? 0,
            'Minimum Current Card Rate(B_W)' => $request->black_white ?? 0,
            'Minimum Current Card Rate(c)' => $request->colour ?? 0,
            'Annual Turn-over' => $request->total_annual_turn_over ?? 0,
            'Quality of Paper' => $request->quality_paper_used ?? 0,
            'Printing in colour' => $request->printing_colour ?? 0,
            'No_ of pages in colour' => $request->colour_pages ?? 0,
            'News Agencies Subscribed To' => $request->news_agencies_subscribed ?? 0,
            'Agencies Name' => $request->agencies ?? '',
            'Price of NewsPaper' => $request->price_newspaper ?? 0,
            'Publisher_s Name' => $request->publisher_name ?? '',
            'Printer_s Name' => $request->printer_name ?? '',
            'Name of Press' => $request->name_of_press ?? '',
            'Address of Press' => $request->address_of_press ?? '',
            'Distance from office to press' => $request->distance_office_to_press ?? 0,
            'Press owned by owner' => $request->press_owned_by_owner ?? 0,
            'CA Name' => $request->ca_name ?? '',
            'CA Address' => $request->ca_address ?? '',
            'CA Registration No_' => $request->ca_registration_no ?? '',
            'Status' => $status,
            'Application Date' => $application_date,
            'Periodicity' => $request->periodicity ?? 0,
            'Any Other Publication of Owner' => $davp_checkbox,
            'CA Phone No_' => $request->ca_phone ?? '',
            'CA Email' => $request->ca_email ?? '',
            'CA Mobile No_' => $request->ca_mobile ?? '',
            'DM Declaration' => $request->dm_declaration ?? 0,
            'DM Declaration Date' => $dm_declaration_date,
            'Vendor Edition' => $request->vendor_edition ?? 0,
            'CIN Number' => $request->cin_no ?? '',
            'Change In Company Address' => $request->change_address ?? 0,
            'Editor Name' => $request->name_of_editor ?? '',
            'Editor Email' => $request->editor_email ?? '',
            'Editor Phone' => $request->editor_phone ?? '',
            'Editor Mobile' => $request->editor_mobile ?? '',
            'Publisher Email' => $request->publisher_email ?? '',
            'Publisher Phone' => $request->publisher_phone ?? '',
            'Publisher Mobile' => $request->publisher_mobile ?? '',
            'Printer Email' => $request->printer_email ?? '',
            'Printer Phone' => $request->printer_phone ?? '',
            'Printer Mobile' => $request->printer_mobile ?? '',
            'Press Email' => $request->press_email ?? '',
            'Press Phone' => $request->press_phone ?? '',
            'Press Mobile' => $request->press_mobile ?? '',
            'Receiver ID' => $recervier_id,
            'CA Unique No_' => $request->ca_unique_no ?? '',
            'ABC Number' => $abc_certificate_no,
            'ABC Circulation Number' => $abc_claimed_circulation,
            'CA Number' => $caregistration_no,
            'CA Circulation Number' => $ca_claimed_circulation,
            'RNI Circulation Validation' => $rni_claimed_circulation_verified,
            'RNI Registration Validation' => $rni_reg_no_verified,
            'RNI Annual Validation' => $rni_annual_valid,
            'RNI Validation Date' => $RNI_Validation_Date,
            'ABC Circulation Validation' => $abc_claimed_circulation_verified,
            'ABC Registration Validation' => $abc_reg_no_verified,
            'ABC Validation Date' => $ABC_Validation_Date,
            'GST No_' => $request->GST_No??'',
            'ABC Certificate No_' => $abc_certificate_no,
            'Primary Edition' => $request->is_primary ?? 0,
            'Date Of First Publication' => $date_of_first_publication,
            'Average Circulation Copies' => $request->average_circulation_copies ?? '',
            'UDIN' => $request->ca_udin_number ?? ''
        );
        //end

        if ($request->vendorid_tab_2 == '') {
            $year =  date("y");
            $month = date("m");
            $year = substr($year, -2);
            $state_code = $this->getStateCode($request->v_state);
            $digit_lang = $this->getLanguageCode($request->language);
            $digit_periodcity = $request->periodicity;
            // dd($state_code);
            $newspaper_code = DB::table($this->tableVendorEmpPrint)->select('Newspaper Code')->where('Newspaper Code', 'LIKE', '__'. $year . '____%')->orderBy('Newspaper Code', 'desc')->first();
            // dd($newspaper_code);
            if(empty($newspaper_code)){
                $newspaper_code = $month . $year .'F'. $state_code->{'StateCode'} . $digit_lang .$digit_periodcity .'-'.'001';
            }else{
                $newspaper_code = $newspaper_code->{"Newspaper Code"}; 
                // dd($newspaper_code)  ;
                $secondcode = substr($newspaper_code,11);
                $secondcode++;
                $code = str_pad($secondcode, 3, "0", STR_PAD_LEFT);

                $newspaper_code = $month . $year .'F'. $state_code->{'StateCode'} . $digit_lang .$digit_periodcity .'-'.$code;  
                
            }
     
            $data['Newspaper Code'] = $newspaper_code;
            $data['Bank Account No_'] = '';
            $data['Account Holder Name'] = '';
            $data['Account Address'] = '';
            $data['IFSC Code'] = '';
            $data['Bank Name'] = '';
            $data['Branch'] = '';
            $data['ESI Account No'] = '';
            $data['No_of Employees covered'] = 0;
            $data['EPF Account No_'] = '';
            $data['No_ of EPF Employees covered'] = 0;
            $data['PAN'] = '';
            $data['Owner ID'] = $request->ownerid;
            $data['RNI Registration Certificate'] = 0;
            $data['Annexure - XII_A'] = 0;
            $data['Self Declaration'] = $request->self_declaration == "on" ? 1 : 0;
            $data['Circulation Certificate'] = 0;
            $data['Specimen Copies'] = 0;
            $data['Commercial Rate'] = 0;
            $data['No Dues Certificate'] = 0;
            $data['GST Registration Certificate'] = 0;
            $data['RNI Reg File Name'] = '';
            $data['Annexure File Name'] = '';
            $data['Circulation Cert File Name'] = '';
            $data['Specimen Copy File Name'] = '';
            $data['Commercial Rate File Name'] = '';
            $data['No Dues Cert File Name'] = '';
            $data['GST Reg Cert File Name'] = '';
            $data['Copy Of Declaration Reg_ Cer_'] = '';
            $data['Annual Return Submitted to RNI'] = 0;
            $data['PAN Copy'] = 0;
            $data['Declaration Filed Before Auth_'] = 0;
            $data['DM Decl_ in case of Change'] = 0;
            $data['Annual Return File Name'] = '';
            $data['PAN Copy File Name'] = '';
            $data['Decl_ Filed Before File Name'] = '';
            $data['DM Declaration File Name'] = '';
            $data['Digital Signature'] = 0;
            $data['Digital Signature File Name'] = '';
            $data['Change in address uploaded'] = 0;
            $data['Change in address File Name'] = '';
            $data['ABC Annual Validation'] = 0;
            $data['Sender ID'] = '';
            $data['Rate'] = 0;
            $data['Circulation Accepted'] = 0;
            $data['Bound Publications'] = 0;
            $data['Unbound Publications'] = 0;
            $data['C1'] = 0;
            $data['Increase'] = 0;
            $data['Rate Year'] = 0;
            $data['User ID'] = $request->user_id;
            $data['Modification'] = 1;
            $data['Rate Status'] = 0;
            $data['Rate Remark'] = '';
            $data['Rate Status Date'] = '';
            $data['Agr File Path'] = '';
            $data['Agr File Name'] = '';
            $data['Alocated NP Code'] = '';
            $data['Empanelment Category'] = 0;
            $data['Global Dimension 1 Code'] = 'M001';
            $data['Global Dimension 2 Code'] = '';
            $data['Account Type'] = $request->account_type ?? '';
            $data['From Date'] = '';
            $data['To Date'] = '';
            $data['Physically Verified'] = '';
            $data['Verification Date'] = '';
            $data['Empanel Date'] = '';
            $data['Profile pic'] = '';
            $data['Vendor Scan signature'] = '';
            $data['Profile'] = '';
            $data['Signature'] = '';
            // insert data query
            $sql = DB::table($this->tableVendorEmpPrint)->insert($data);
            $msg = 'Data Save Successfully! Please note the ' . $newspaper_code . ' reference number for future use.';
        } else {

            $newspaper_code = $request->vendorid_tab_2;
            $where = array('Owner ID' => $request->ownerid, 'Newspaper Code' => $newspaper_code);
            // update data query
            $sql = ApiFreshEmpanelment::updateAllRecords($this->tableVendorEmpPrint, $data, $where);
            $msg = 'Data Updated Successfully! Please note the ' . $newspaper_code . ' reference number for future use.';
        }

        if ($sql) {
            return $this->sendResponse($newspaper_code, $msg);
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }
    public function freshEmpanelmentSaveVendorAccount(Request $request)
    {
        $vendor_table = $this->tableVendorEmpPrint;
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_3 ?? '';
        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);

        $sql1 = $this->updateAccountData($request, $where, $vendor_table);

        if ($sql1) {
            
            $Agency_code = Session('UserName');
            $group_code = $this->generateGroupCode($request,$Agency_code);

            return $this->sendResponse($newspaper_code, 'Data Updated Successfully! Please note the ' . $owner_id . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }
    public function generateOTP()
    {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }
    public function generateGroupCode(Request $request,$Agency_code)
    {
        # code...
        // dd($request);
        $vendor_table = $this->tableVendor;
        // $tableVendorBank = 'BOC$Vendor Bank Account$437dbf0e-84ff-417a-965d-ed2bb9650972';
        $ummTable = 'BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2';
        $tableMainNewspaper = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
     
        // check if vendor code exist in main newspaper 
        $vendor_code_exist = DB::table($tableMainNewspaper)->select('Vendor Code')->where('Newspaper Code',$Agency_code)->first();
        $vendor_code = DB::table($vendor_table)->select('No_')->where('No_', 'LIKE', 'V0'.'%')->orderBy('No_','DESC')->first();
       
        // $check_umm_user = DB::table($ummTable)->where('User ID',$vendor_code_exist->{'Vendor Code'})->first();
        // dd($vendor_code_exist);
        if($vendor_code_exist)
        {
            $vendor_code = $vendor_code_exist->{'Vendor Code'};
        }
        else{
            $vendor_code = $vendor_code->{"No_"};
            $vendor_code++;
        }
        $mytime = Carbon::now();
        $application_date = $mytime->format('Y-m-d');
        // if vendor code exist then update main newspaper and vendor
        if($vendor_code_exist->{'Vendor Code'} !='' || $vendor_code_exist->{'Vendor Code'} != NULL)
        {
            $update = array(
                        "Bank Account No_"=>$request->bank_account_no,
                        "IFSC Code"=>$request->ifsc_code,
                        "Bank Name"=>$request->bank_name,
                        "Account Holder Name"=>$request->account_holder_name,
                        "Account Address" =>$request->address_of_account,
                        "Branch" => $request->branch_name,
                );
            $sql = DB::table($tableMainNewspaper)->where('Newspaper Code',$Agency_code)->update($update);

            $update_data = DB::table($vendor_table)
                                ->where('No_',$vendor_code_exist->{'Vendor Code'})->update( [
                                    "No_"=>$vendor_code_exist->{'Vendor Code'},
                                    "Vendor Account No_"=>$request->bank_account_no,
                                    "IFSC Code"=>$request->ifsc_code,
                                    "Bank Name"=>$request->bank_name,
                                    "Account Name"=>$request->account_holder_name,
                                    "Approval Status" =>1,
                            ]);        
              
            $UMMuser = DB::table($ummTable)->insert([
                            "User Type" => 1,
                            "User ID" => $vendor_code,
                            "User Name" => '',
                            "Gender" => 0,
                            "password" => Hash::make('Cbc@123$'),
                            "email" => '',
                            "Mobile No_" => '',
                            "Employee Code" => '',
                            "Active" => 1,
                            "Last Updated By" => '',
                            "Last Update Date Time" => $application_date,
                            "OTP" => '',
                            "Email Verification" => 1,
                            "GST" => '',
                            "Global Dimension 1 Code" => '',
                            "Email OTP" => '',
                            "wing type" => 6,
                            "Designation" =>'',
                            "Address" =>'',
                            "name" =>'',
                        ]);                            
           
            
       }
        else if($vendor_code_exist->{'Vendor Code'} == '' || $vendor_code_exist->{'Vendor Code'} == NULL)
        {
            $data = DB::table($vendor_table)
                            ->insert([
                                "No_"=>$vendor_code,
                                "GeM Vendor"=>0,
                                "Vendor Account No_"=>$request->bank_account_no,
                                "IFSC Code"=>$request->ifsc_code,
                                "Bank Name"=>$request->bank_name,
                                "Account Name"=>$request->account_holder_name,
                                "Contract Expiry Date"=>'',
                                "Renewal Request sent"=> 0,
                                "Renewal Status"=>0,
                                "BOC Vendor Code"=>'',
                                "PFMS Code"=>'',
                                "Approval Status" => 1,
                                "Approved User ID" =>'',
                                "Approved Date" =>'',
                                "Rejected Reason"=>''
                            ]); 
                           
            $UMMuser = DB::table($ummTable)->insert([
                            "User Type" => 1,
                            "User ID" => $vendor_code,
                            "User Name" => '',
                            "Gender" => 0,
                            "password" => Hash::make('Cbc@123$'),
                            "email" => '',
                            "Mobile No_" => '',
                            "Employee Code" => '',
                            "Active" => 1,
                            "Last Updated By" => '',
                            "Last Update Date Time" => $application_date,
                            "OTP" => '',
                            "Email Verification" => 1,
                            "GST" => '',
                            "Global Dimension 1 Code" => '',
                            "Email OTP" => '',
                            "wing type" => 6,
                            "Designation" =>'',
                            "Address" =>'',
                            "name" =>'',
                        ]);
 
        }
            

    }

    public function freshEmpanelmentSaveVendorDocs(Request $request)
    {

        $vendor_table = $this->tableVendorEmpPrint;
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_4 ?? '';

        $select = array(
            'RNI Reg File Name',
            'Annexure File Name',
            'Circulation Cert File Name',
            'Specimen Copy File Name',
            'Commercial Rate File Name',
            'No Dues Cert File Name',
            'GST Reg Cert File Name',
            'Annual Return File Name',
            'PAN Copy File Name',
            'Decl_ Filed Before File Name',
            'DM Declaration File Name',
            'Change in address File Name',
            'RNI Registration Certificate',
            'Annexure - XII_A',
            'Circulation Certificate',
            'Specimen Copies',
            'Commercial Rate',
            'No Dues Certificate',
            'GST Registration Certificate',
            'Annual Return Submitted to RNI',
            'PAN Copy',
            'Declaration Filed Before Auth_',
            'DM Decl_ in case of Change',
            'Change in address uploaded',
            'Profile pic',
            'Vendor Scan signature',
        );

        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);

        $response = ApiFreshEmpanelment::fetchAllRecords($vendor_table, $select, '', '', $where);

        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $mypath = public_path() . '/uploads/fresh-empanelment/' . $newspaper_code . "/";
        if (!File::isDirectory($mypath)) {
            File::makeDirectory($mypath, 0777, true, true);
        }
        
        $profile ='';
        $profile_picture = '';
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $profile_picture = time() . '-' . $request->newspaper_code . '-Profile';
            $file_uploaded = $file->move($destinationPath, $profile_picture);
            File::copy($destinationPath . $profile_picture, $mypath . $profile_picture);
            if ($file_uploaded) {
                $profile = 1;
            } else {
                $profile_picture = '';
            }
        }

        $signature ='';
        $vendor_scan_signature = '';
        if ($request->hasFile('vendor_scan_signature')) {
            $file = $request->file('vendor_scan_signature');
            $vendor_scan_signature = time() . '-' . $request->newspaper_code . '-Signature';
            $file_uploaded = $file->move($destinationPath, $vendor_scan_signature);
            File::copy($destinationPath . $vendor_scan_signature, $mypath . $vendor_scan_signature);
            if ($file_uploaded) {
                $signature = 1;
            } else {
                $vendor_scan_signature = '';
            }
        }

        $rni_reg_file_name = $response[0]->{'RNI Reg File Name'} ?? '';
        $rni_registration_certificate = $response[0]->{'RNI Registration Certificate'} ?? 0;
        if ($request->hasFile('rni_reg_file_name') || $request->hasFile('rni_reg_file_name_modify')) {
            $file = $request->file('rni_reg_file_name') ?? $request->file('rni_reg_file_name_modify');
            $rni_reg_file_name = time() . '-' . $newspaper_code . '-RNIReg';
            $file_uploaded = $file->move($destinationPath, $rni_reg_file_name);
            File::copy($destinationPath . $rni_reg_file_name, $mypath . $rni_reg_file_name);
            if ($file_uploaded) {
                $rni_registration_certificate = 1;
            } else {
                $rni_reg_file_name = '';
            }
        }
        $annexure_file_name = $response[0]->{'Annexure File Name'} ?? '';
        $annexure_XII_A = $response[0]->{'Annexure - XII_A'} ?? 0;
        if ($request->hasFile('annexure_file_name') || $request->hasFile('annexure_file_name_modify')) {
            $file = $request->file('annexure_file_name') ?? $request->file('annexure_file_name_modify');
            $annexure_file_name = time() . '-' . $newspaper_code . '-Annexure';
            $file_uploaded = $file->move($destinationPath, $annexure_file_name);
            File::copy($destinationPath . $annexure_file_name, $mypath . $annexure_file_name);
            if ($file_uploaded) {
                $annexure_XII_A = 1;
            } else {
                $annexure_file_name = '';
            }
        }
        $circulation_cert_file_name = $response[0]->{'Circulation Cert File Name'} ?? '';
        $circulation_certificate = $response[0]->{'Circulation Certificate'} ?? 0;
        if ($request->hasFile('circulation_cert_file_name') || $request->hasFile('circulation_cert_file_name_modify')) {

            $file = $request->file('circulation_cert_file_name') ?? $request->file('circulation_cert_file_name_modify');
            $circulation_cert_file_name = time() . '-' . $newspaper_code . '-CIRCert';
            $file_uploaded = $file->move($destinationPath, $circulation_cert_file_name);
            File::copy($destinationPath . $circulation_cert_file_name, $mypath . $circulation_cert_file_name);
            if ($file_uploaded) {
                $circulation_certificate = 1;
            } else {
                $circulation_cert_file_name = '';
            }
        }

        $annual_return_file_name =  $response[0]->{'Annual Return File Name'} ?? '';
        $annual_return_submitted_rni = $response[0]->{'Annual Return Submitted to RNI'} ?? 0;
        if ($request->hasFile('annual_return_file_name') || $request->hasFile('annual_return_file_name_modify')) {

            $file = $request->file('annual_return_file_name') ?? $request->file('annual_return_file_name_modify');
            $annual_return_file_name = time() . '-' . $newspaper_code . '-AnnualReturn';
            $file_uploaded = $file->move($destinationPath, $annual_return_file_name);
            File::copy($destinationPath . $annual_return_file_name, $mypath . $annual_return_file_name);
            if ($file_uploaded) {
                $annual_return_submitted_rni = 1;
            } else {
                $annual_return_file_name = '';
            }
        }

        $specimen_copy_file_name = $response[0]->{'Specimen Copy File Name'} ?? '';
        $specimen_copies =  $response[0]->{'Specimen Copies'} ?? 0;
        if ($request->hasFile('specimen_copy_file_name') || $request->hasFile('specimen_copy_file_name_modify')) {

            $file = $request->file('specimen_copy_file_name') ?? $request->file('specimen_copy_file_name_modify');
            $specimen_copy_file_name = time() . '-' . $newspaper_code . '-SpecimenCopy';
            $file_uploaded = $file->move($destinationPath, $specimen_copy_file_name);
            File::copy($destinationPath . $specimen_copy_file_name, $mypath . $specimen_copy_file_name);
            if ($file_uploaded) {
                $specimen_copies = 1;
            } else {
                $specimen_copy_file_name = '';
            }
        }
        $commercial_rate_file_name = $response[0]->{'Commercial Rate File Name'} ?? '';
        $commercial_rate = $response[0]->{'Commercial Rate'} ?? 0;
        if ($request->hasFile('commercial_rate_file_name') || $request->hasFile('commercial_rate_file_name_modify')) {

            $file = $request->file('commercial_rate_file_name') ?? $request->file('commercial_rate_file_name_modify');
            $commercial_rate_file_name = time() . '-' . $newspaper_code . '-CommercialRate';
            $file_uploaded = $file->move($destinationPath, $commercial_rate_file_name);
            File::copy($destinationPath . $commercial_rate_file_name, $mypath . $commercial_rate_file_name);
            if ($file_uploaded) {
                $commercial_rate = 1;
            } else {
                $commercial_rate_file_name = '';
            }
        }
        $no_dues_cert_file_name =  $response[0]->{'No Dues Cert File Name'} ?? '';
        $no_dues_certificate = $response[0]->{'No Dues Certificate'} ?? 0;
        if ($request->hasFile('no_dues_cert_file_name') || $request->hasFile('no_dues_cert_file_name_modify')) {

            $file = $request->file('no_dues_cert_file_name') ?? $request->file('no_dues_cert_file_name_modify');
            $no_dues_cert_file_name = time() . '-' . $newspaper_code . '-NoDuesCert';
            $file_uploaded = $file->move($destinationPath, $no_dues_cert_file_name);
            File::copy($destinationPath . $no_dues_cert_file_name, $mypath . $no_dues_cert_file_name);
            if ($file_uploaded) {
                $no_dues_certificate = 1;
            } else {
                $no_dues_cert_file_name = '';
            }
        }

        $gst_reg_cert_file_name = $response[0]->{'GST Reg Cert File Name'} ?? '';
        $gst_registration_certificate = $response[0]->{'GST Registration Certificate'} ?? 0;
        if ($request->hasFile('gst_reg_cert_file_name') || $request->hasFile('gst_reg_cert_file_name_modify')) {

            $file = $request->file('gst_reg_cert_file_name') ?? $request->file('gst_reg_cert_file_name_modify');
            $gst_reg_cert_file_name = time() . '-' . $newspaper_code . '-GSTRegCert';
            $file_uploaded = $file->move($destinationPath, $gst_reg_cert_file_name);
            File::copy($destinationPath . $gst_reg_cert_file_name, $mypath . $gst_reg_cert_file_name);
            if ($file_uploaded) {
                $gst_registration_certificate = 1;
            } else {
                $gst_reg_cert_file_name = '';
            }
        }
        $declaration_field_file_name =  $response[0]->{'Decl_ Filed Before File Name'} ?? '';
        $declaration_field = $response[0]->{'Declaration Filed Before Auth_'} ?? 0;
        if ($request->hasFile('declaration_field_file_name') || $request->hasFile('declaration_field_file_name_modify')) {

            $file = $request->file('declaration_field_file_name') ?? $request->file('declaration_field_file_name_modify');
            $declaration_field_file_name = time() . '-' . $newspaper_code . '-DeclFiled';
            $file_uploaded = $file->move($destinationPath, $declaration_field_file_name);
            File::copy($destinationPath . $declaration_field_file_name, $mypath . $declaration_field_file_name);
            if ($file_uploaded) {
                $declaration_field = 1;
            } else {
                $declaration_field_file_name = '';
            }
        }

        $pan_copy_file_name = $response[0]->{'PAN Copy File Name'} ?? '';
        $pan_copy = $response[0]->{'PAN Copy'} ?? 0;
        if ($request->hasFile('pan_copy_file_name') || $request->hasFile('pan_copy_file_name_modify')) {

            $file = $request->file('pan_copy_file_name') ?? $request->file('pan_copy_file_name_modify');
            $pan_copy_file_name = time() . '-' . $newspaper_code . '-PANCopy';
            $file_uploaded = $file->move($destinationPath, $pan_copy_file_name);
            File::copy($destinationPath . $pan_copy_file_name, $mypath . $pan_copy_file_name);
            if ($file_uploaded) {
                $pan_copy = 1;
            } else {
                $pan_copy_file_name = '';
            }
        }

        if ($request->change_address == 1) {
            $change_in_address_file_name = $response[0]->{'Change in address File Name'} ?? '';
            $change_in_address_uploaded = $response[0]->{'Change in address uploaded'} ?? 0;
            if ($request->hasFile('change_in_address_file_name') || $request->hasFile('change_in_address_file_name_modify')) {

                $file = $request->file('change_in_address_file_name') ?? $request->file('change_in_address_file_name_modify');
                $change_in_address_file_name = time() . '-' . $newspaper_code . '-ChangeAdd';
                $file_uploaded = $file->move($destinationPath, $change_in_address_file_name);
                File::copy($destinationPath . $change_in_address_file_name, $mypath . $change_in_address_file_name);
                if ($file_uploaded) {
                    $change_in_address_uploaded = 1;
                } else {
                    $change_in_address_file_name = '';
                }
            }
        } else {
            $change_in_address_uploaded = 0;
            $change_in_address_file_name = ' ';
        }

        $self_declaration = $request->self_declaration == "on" ? 1 : 0;
        $vendor_table = $this->tableVendorEmpPrint;
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_4 ?? '';
        $update = array(
            'RNI Registration Certificate' => $rni_registration_certificate,
            'Annexure - XII_A' => $annexure_XII_A,
            'Self Declaration' => $self_declaration,
            'Circulation Certificate' => $circulation_certificate,
            'Specimen Copies' => $specimen_copies,
            'Commercial Rate' => $commercial_rate,
            'No Dues Certificate' => $no_dues_certificate,
            'GST Registration Certificate' => $gst_registration_certificate,
            'RNI Reg File Name' => $rni_reg_file_name,
            'Annexure File Name' => $annexure_file_name,
            'Circulation Cert File Name' => $circulation_cert_file_name,
            'Specimen Copy File Name' => $specimen_copy_file_name,
            'Commercial Rate File Name' => $commercial_rate_file_name,
            'No Dues Cert File Name' => $no_dues_cert_file_name,
            'GST Reg Cert File Name' => $gst_reg_cert_file_name,
            'Annual Return Submitted to RNI' => $annual_return_submitted_rni,
            'PAN Copy' => $pan_copy,
            'Declaration Filed Before Auth_' => $declaration_field,
            'Annual Return File Name' => $annual_return_file_name,
            'PAN Copy File Name' => $pan_copy_file_name,
            'Decl_ Filed Before File Name' => $declaration_field_file_name,
            'Change in address uploaded' => $change_in_address_uploaded,
            'Change in address File Name' => $change_in_address_file_name,
            'Profile pic' =>$profile_picture,
            'Vendor Scan signature'=>$vendor_scan_signature,
            'Profile' => $profile,
            'Signature' =>$signature,
            'Modification' => 0
        );
        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);
        $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);

        if ($sql1) {
            return $this->sendResponse($newspaper_code, 'Data Save Successfully! Please note the ' . $newspaper_code . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }
    public function getDistrictByState(Request $request)
    {

        $dis_name = DB::table($this->tableDistrict)->select('District')->where('State Code', $request->state_id)->first();
        if (!empty($dis_name)) {
            $data = "<option value=''>Select District</option>";
            foreach ($dis_name as $item) {
                $data .= "<option value='" . $item->{'District'} . "'>" . $item->{'District'} . "</option>";
            }
            return response()->json(['status' => 0, 'message' => $data]);
        } else {
            return response()->json(['status' => 1, 'message' => "<option value=''>No Data Found!</option>"]);
        }
    }
    public function existingOwnerData(Request $request)
    {
        $tableVendorEmpPrint = $this->tableVendorEmpPrint;
        $tableOwner = $this->tableOwner;
        $tableState = $this->tableState;
        $tableLanguage = $this->tableLanguage;
        $owner_datas = DB::table($tableOwner . ' as own')
            ->join($tableState . ' as st', 'st.Code', '=', 'own.State')
            ->select('own.Owner Name', 'own.Owner Type', 'own.Mobile No_', 'own.Email ID', 'own.Phone No_', 'own.Fax No_', 'own.Address 1', 'own.City', 'own.District', 'st.Description', 'st.Code')
            ->WhereIn('own.Owner ID', [$request->owner_id])
            ->get();

        $owner_other_datas = DB::table($tableVendorEmpPrint . ' as bvp')
            ->join($tableLanguage . ' as bl', 'bl.Code', '=', 'bvp.Language')
            ->select('bvp.Newspaper Code', 'bvp.Newspaper Name', 'bvp.Place of Publication', 'bvp.Language', 'bvp.Periodicity', 'bvp.Distance from office to press', 'bvp.Date Of First Publication', 'bl.Name as lang_name')
            ->WhereIn('bvp.Owner ID', [$request->owner_id])
            ->get();

        if (count($owner_datas) > 0 || count($owner_other_datas) > 0) {
            $data = array('owner_datas' => $owner_datas[0], 'owner_other_datas' => $owner_other_datas);
            return response()->json(['status' => 0, 'message' => $data]);
        } else {
            return response()->json(['status' => 1, 'message' => "No Data Found!"]);
        }
    }
    public function checkFile(Request $request)
    {
        $file = public_path('uploads/fresh-empanelment/' . $request->file_name);
        if (file_exists($file)) {
            return response()->json(['status' => 1, 'message' => $request->file_name]);
        } else {
            return response()->json(['status' => 0, 'message' => $request->file_name]);
        }
    }
    public function fetchVendorRecord(Request $request)
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('User ID' => $request->user_id);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, '*', '', '', $where);

        if (count($response) > 0) {
            unset($response[0]->{'timestamp'});
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function fetchOwnerRecord(Request $request)
    {
        $table = $this->tableOwner;
        $select = array('Owner ID', 'Owner Name', 'Owner Type', 'Mobile No_', 'Email ID', 'Phone No_', 'Fax No_', 'Address 1', 'City', 'District', 'State');
        $where = array($request->key => $request->owner_id);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function getAllDistricts()
    {
        $table = $this->tableDistrict;
        $select = array('District');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, 'District', 'ASC', '');

        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }

    public function fetchOwnerOtherRecord(Request $request)
    {
        $table = $this->tableVendorEmpPrint;

        $where = array(
            ['User ID', '!=', $request->user_id],
            ['Owner ID', '=', $request->owner_id]
        );
        $select = array('Newspaper Name', 'Language', 'Place of Publication', 'Periodicity', 'Newspaper Code', 'Distance from office to press');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function countVendorRecords(Request $request)
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('Owner ID' => $request->Owner_ID);
        $select = array('Newspaper Name', 'Language', 'Place of Publication', 'Periodicity', 'Newspaper Code', 'Distance from office to press', 'Date Of First Publication');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }

    public function printRateOffered()
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('Newspaper Code' => session('UserName'));
        $select = array('Newspaper Name', 'Newspaper Code', 'Rate', 'Rate Status', 'Rate Remark');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function printRateStatusupdate(Request $request)
    {
        $mytime = Carbon::now();
        $date = $mytime->format('Y-m-d');
        $table = $this->tableVendorEmpPrint;
        $update = array(
            'Rate Status' => $request->rate_status,
            'Rate Remark' => $request->rate_remark,
            'Rate Status Date' => $date,
        );
        $where = array('Newspaper Code' => session('UserName'));
        $sql = ApiFreshEmpanelment::updateAllRecords($table, $update, $where);

        if ($sql) {
            return $this->sendResponse('', 'Data Updated Successfully!');
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }
    public function checkRegCirBase(Request $request)
    {
        $res = $this->checkRegistrationNo($request->cir_no, $request->reg_no);
        if ($res == false) {
            return $this->sendError('Data already exist!');
        } else {
            $response = [];
            if ($request->cir_no == 0) {
                $table = $this->tableRNIEfilling;
                $where = array('Regn Number' => $request->reg_no);
                $select = array('Efile Number', 'Sold Circulation', 'Efiling Number Valid', 'Efiling veryfied', 'Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
            }
            if ($request->cir_no == 3) {
                $table = $this->tableABCCirculations;
                $where = array('Certificate No_' => $request->reg_no);
                $select = array('Average Circulation Jan - Jun 2019', 'Average Circulation Jul - Dec 2019', 'Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

                if (!empty($response[0])) {
                    $response[0]->{'Sold Circulation'} = $response[0]->{'Average Circulation Jul - Dec 2019'} != 0 ? $response[0]->{'Average Circulation Jul - Dec 2019'} : $response[0]->{'Average Circulation Jan - Jun 2019'};
                }
            }
            if (count($response) > 0) {
                return $this->sendResponse($response, 'Verified!');
            } else {
                return $this->sendError('Not Verified!');
                exit;
            }
        }
    }

    public function checkRenewalRegCirBase($cir_no, $reg_no, $np_code)
    {
        if ($cir_no == 0) {
            $where = array(['RNI Registration No_', '=', $reg_no], ['NP Code', '!=', $np_code]);
        }
        if ($cir_no == 3) {
            $where = array(['ABC Certificate No_', '=', $reg_no], ['NP Code', '!=', $np_code]);
        }
        $response = DB::table($this->tableNPRateRenewal)->select('NP Code')->where($where)->get();
        if (count($response) > 0) {
            return $this->sendError('Data already exist!');
        } else {
            $response = [];
            if ($cir_no == 0) {
                $table = $this->tableRNIEfilling;
                $where = array('Regn Number' => $reg_no);
                $select = array('Efile Number', 'Sold Circulation', 'Efiling Number Valid', 'Efiling veryfied', 'Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
            }
            if ($cir_no == 3) {
                $table = $this->tableABCCirculations;
                $where = array('Certificate No_' => $reg_no);
                $select = array('Average Circulation Jan - Jun 2019', 'Average Circulation Jul - Dec 2019','Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

                if (!empty($response[0])) {
                    $response[0]->{'Sold Circulation'} = $response[0]->{'Average Circulation Jul - Dec 2019'} != 0 ? $response[0]->{'Average Circulation Jul - Dec 2019'} : $response[0]->{'Average Circulation Jan - Jun 2019'};
                }
            }
            if (count($response) > 0) {
                return $this->sendResponse($response, 'Verified!');
            } else {
                return $this->sendError('Not Verified!');
                exit;
            }
        }
    }

    public function checkRegCirBaseNew($cir_no,$rni_file,$np_code,$periodcity,$reg_no)
    {
        $tableRNIEfilling = 'BOC$RNI EFile Master';       
        if($periodcity == '0')
        {
            $percity = 'DAILY';
        }
        else if($periodcity == '1')
        {
            $percity = 'MONTHLY';
        }
        else if($periodcity == '2')
        {
            $percity = 'DAILY(MONDAY TO SATURDAY)';
        }
        else if($periodcity == '3')
        {
            $percity = 'WEEKLY';
        }
        else if($periodcity == '4')
        {
            $percity = 'WEEKLY';
        }
        else if($periodcity == '5')
        {
            $percity = 'FORTNIGHTLY';
        }
        else if($periodcity == '5')
        {
            $percity = 'MONTHLY';
        }
        $where = array(['RNI Registration No_', '=', $reg_no], ['NP Code', '==', $np_code]);
        $response = DB::table($this->tableNPRateRenewal)->select('NP Code')->where($where)->get();
        if (count($response) > 0) {
            return $this->sendError('Data already exist!');
        } else {
            $response = [];
            // dd($reg_no);
            if ($cir_no == 0) {
                $table = $tableRNIEfilling;
                $where = array('NEWREGN_NO' => $reg_no,'np_code' => $np_code,'Periodicity' =>$percity);
                $select = array('*');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
                
            }
            if ($cir_no == 3) {
                $table = $this->tableABCCirculations;
                $where = array('Certificate No_' => $reg_no);
                $select = array('Average Circulation Jan - Jun 2019', 'Average Circulation Jul - Dec 2019','Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

                if (!empty($response[0])) {
                    $response[0]->{'Sold Circulation'} = $response[0]->{'Average Circulation Jul - Dec 2019'} != 0 ? $response[0]->{'Average Circulation Jul - Dec 2019'} : $response[0]->{'Average Circulation Jan - Jun 2019'};
                }
            }
            if (count($response) > 0) {
                return $this->sendResponse($response, 'Verified!');
            } else {
                return $this->sendError('Not Verified!');
                exit;
            }
        }
    }

    public function getPressOwnerData(Request $request)
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('Owner ID' => $request->owner_id);
        $select = array('Name of Press', 'Press Email', 'Press Mobile', 'Press Phone', 'Address of Press', 'Distance from office to press');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }

    public function printRenewalSave(Request $request)
    {
        
        $tablePayeeMasterRenewal = 'BOC$Payee Master Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
        $month = date("m");
        $year = substr(date("y"), -2);
        // $state_code = $this->getStateCode($request->v_state);
        // $digit_lang = $this->getLanguageCode($request->language);
        // $digit_periodcity = $request->periodicity;
        $application_no = DB::table($this->tableNPRateRenewal)->select('Application No_')->where('Application No_', 'LIKE', '__'. $year . '____%')->orderBy('Application No_', 'desc')->first();

        if (strlen(@$application_no->{'Application No_'}) <> 8 || empty($application_no)) {
            $application_no = $month . $year .'R'. $request->newspaper_code;
        } else {
            $application_no = $application_no->{"Application No_"};               

            $str = substr($application_no, 0, 2);
            if ($month != $str) {
                $application_no = $month . $year .'R'. $request->newspaper_code;
            }else{
                $application_no = str_pad(intval($application_no) + 1, strlen($application_no), '0', STR_PAD_LEFT);
            }
        }
        
        
        $renewal_table = '[' . $this->tableNPRateRenewal . ']';
        $request->total_print_area = $request->total_print_area ?? 0;
        $request->colour_pages = $request->colour_pages ?? 0;
        
        $dm_declaration_date = $request->dm_declaration_date;
        // dd($dm_declaration_date);
        if ($dm_declaration_date != '') {
            $dm_declaration_date = date('Y-m-d', strtotime(Session('latest_dm_declaration_date')));
        }
        

        $mytime = Carbon::now();
        $year = $mytime->format('Y');
        $start_date = $mytime->format('Y-m-d');
        $application_date = $mytime->format('Y-m-d');

        $end_date = date('Y-m-d', strtotime($mytime->addDays(364)));

        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $mypath = public_path() . '/uploads/fresh-empanelment/' . $request->newspaper_code . "/";
        if (!File::isDirectory($mypath)) {
            File::makeDirectory($mypath, 0777, true, true);
        }
        $profile ='';
        $profile_picture = '';
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $profile_picture = time() . '-' . $request->newspaper_code . '-Profile';
            $file_uploaded = $file->move($destinationPath, $profile_picture);
            File::copy($destinationPath . $profile_picture, $mypath . $profile_picture);
            if ($file_uploaded) {
                $profile = 1;
            } else {
                $profile_picture = '';
            }
        }

        $signature ='';
        $vendor_scan_signature = '';
        if ($request->hasFile('vendor_scan_signature')) {
            $file = $request->file('vendor_scan_signature');
            $vendor_scan_signature = time() . '-' . $request->newspaper_code . '-Signature';
            $file_uploaded = $file->move($destinationPath, $vendor_scan_signature);
            File::copy($destinationPath . $vendor_scan_signature, $mypath . $vendor_scan_signature);
            if ($file_uploaded) {
                $signature = 1;
            } else {
                $vendor_scan_signature = '';
            }
        }

        $dm_declaration = 0;
        $dm_declaration_file_name = '';
        if ($request->hasFile('DMD_File_Name')) {
            $file = $request->file('DMD_File_Name');
            $dm_declaration_file_name = time() . '-' . $request->newspaper_code . '-DMDFile';
            $file_uploaded = $file->move($destinationPath, $dm_declaration_file_name);
            File::copy($destinationPath . $dm_declaration_file_name, $mypath . $dm_declaration_file_name);
            if ($file_uploaded) {
                $dm_declaration = 1;
            } else {
                $dm_declaration_file_name = '';
            }
        }

    

        $RNI_Circulation = 0;
        $ABC_Circulation = 0;
        $CA_Circulation = 0;
        
        $Circulation_File_Name = '';
        if ($request->hasFile('Circulation_File_Name')) {
            $file = $request->file('Circulation_File_Name');
            $Circulation_File_Name = time() . '-' . $request->newspaper_code . '-CIRBase';
            $file_uploaded = $file->move($destinationPath, $Circulation_File_Name);
            File::copy($destinationPath . $Circulation_File_Name, $mypath . $Circulation_File_Name);
            if ($file_uploaded) {
                if ($request->cir_base == 0) {
                    $RNI_Circulation = 1;
                }
                if ($request->cir_base == 1) {
                    $CA_Circulation = 1;
                }
                if ($request->cir_base == 3) {
                    $ABC_Circulation = 1;
                }
            } else {
                $Circulation_File_Name = '';
            }
        }

        $annexure_file_name = '';
        $annexure_XII_A = 0;
        if ($request->hasFile('annexure_file_name') || $request->hasFile('annexure_file_name_modify')) {
            $file = $request->file('annexure_file_name') ?? $request->file('annexure_file_name_modify');
            $annexure_file_name = time() . '-' . $request->newspaper_code . '-Annexure';
            $file_uploaded = $file->move($destinationPath, $annexure_file_name);
            File::copy($destinationPath . $annexure_file_name, $mypath . $annexure_file_name);
            if ($file_uploaded) {
                $annexure_XII_A = 1;
            } else {
                $annexure_file_name = '';
            }
        }

        $annual_return_file_name =  '';
        $annual_return_submitted_rni = 0;
        if ($request->hasFile('annual_return_file_name') || $request->hasFile('annual_return_file_name_modify')) {

            $file = $request->file('annual_return_file_name') ?? $request->file('annual_return_file_name_modify');
            $annual_return_file_name = time() . '-' . $request->newspaper_code . '-AnnualReturn';
            $file_uploaded = $file->move($destinationPath, $annual_return_file_name);
            File::copy($destinationPath . $annual_return_file_name, $mypath . $annual_return_file_name);
            if ($file_uploaded) {
                $annual_return_submitted_rni = 1;
            } else {
                $annual_return_file_name = '';
            }
        }

        $gst_reg_cert_file_name = '';
        $GST_cert = 0;

        if ($request->hasFile('gst_reg_cert_file_name') || $request->hasFile('gst_reg_cert_file_name_modify')) {

            $file = $request->file('gst_reg_cert_file_name') ?? $request->file('gst_reg_cert_file_name_modify');
            $gst_reg_cert_file_name = time() . '-' . $request->newspaper_code . '-GSTRegCert';
            $file_uploaded = $file->move($destinationPath, $gst_reg_cert_file_name);
            File::copy($destinationPath . $gst_reg_cert_file_name, $mypath . $gst_reg_cert_file_name);
            if ($file_uploaded) {
                $GST_cert = 1;
            } else {
                $gst_reg_cert_file_name = '';
            }
        }

        $no_dues_cert = 0;
        $no_dues_cert_file_name = '';
        if ($request->hasFile('no_dues_cert_file_name')) {
            $file = $request->file('no_dues_cert_file_name');
            $no_dues_cert_file_name = time() . '-' . $request->newspaper_code . '-NoDuesCert';
            $file_uploaded = $file->move($destinationPath, $no_dues_cert_file_name);
            
            File::copy($destinationPath . $no_dues_cert_file_name, $mypath . $no_dues_cert_file_name);
            if ($file_uploaded) {
                $no_dues_cert = 1;
            } else {
                $no_dues_cert_file_name = '';
            }
        }

        $rni_reg_file_name = '';
        $rni_registration_certificate = 0;
        if ($request->hasFile('rni_reg_file_name') || $request->hasFile('rni_reg_file_name_modify')) {
            $file = $request->file('rni_reg_file_name') ?? $request->file('rni_reg_file_name_modify');
            $rni_reg_file_name = time() . '-' . $request->newspaper_code . '-RNIReg';
            $file_uploaded = $file->move($destinationPath, $rni_reg_file_name);
            File::copy($destinationPath . $rni_reg_file_name, $mypath . $rni_reg_file_name);
            if ($file_uploaded) {
                $rni_registration_certificate = 1;
            } else {
                $rni_reg_file_name = '';
            }
        }

        
        $specimen_copy_file_name = '';
        $specimen_copies =  0;
        if ($request->hasFile('specimen_copy_file_name') || $request->hasFile('specimen_copy_file_name_modify')) {

            $file = $request->file('specimen_copy_file_name') ?? $request->file('specimen_copy_file_name_modify');
            $specimen_copy_file_name = time() . '-' . $request->newspaper_code . '-SpecimenCopy';
            $file_uploaded = $file->move($destinationPath, $specimen_copy_file_name);
            File::copy($destinationPath . $specimen_copy_file_name, $mypath . $specimen_copy_file_name);
            if ($file_uploaded) {
                $specimen_copies = 1;
            } else {
                $specimen_copy_file_name = '';
            }
        }

        $declaration_field_file_name =  '';
        $declaration_field = 0;
        if ($request->hasFile('declaration_field_file_name') || $request->hasFile('declaration_field_file_name_modify')) {

            $file = $request->file('declaration_field_file_name') ?? $request->file('declaration_field_file_name_modify');
            $declaration_field_file_name = time() . '-' . $request->newspaper_code . '-DeclFiled';
            $file_uploaded = $file->move($destinationPath, $declaration_field_file_name);
            File::copy($destinationPath . $declaration_field_file_name, $mypath . $declaration_field_file_name);
            if ($file_uploaded) {
                $declaration_field = 1;
            } else {
                $declaration_field_file_name = '';
            }
        }
        $circulation_cert_file_name = '';
        $circulation_certificate = 0;
        if ($request->hasFile('circulation_cert_file_name') || $request->hasFile('circulation_cert_file_name_modify')) {
        
            $file = $request->file('circulation_cert_file_name') ?? $request->file('circulation_cert_file_name_modify');
            $circulation_cert_file_name = time() . '-' . $request->newspaper_code . '-CIRCert';
            $file_uploaded = $file->move($destinationPath, $circulation_cert_file_name);
            File::copy($destinationPath . $circulation_cert_file_name, $mypath . $circulation_cert_file_name);
            if ($file_uploaded) {
                $circulation_certificate = 1;
            } else {
                $circulation_cert_file_name = '';
            }
        }
        if ($request->change_address == 1) {
                $change_in_address_file_name = '';
                $change_in_address_uploaded = 0;
                if ($request->hasFile('change_in_address_file_name') || $request->hasFile('change_in_address_file_name_modify')) {

                    $file = $request->file('change_in_address_file_name') ?? $request->file('change_in_address_file_name_modify');
                    $change_in_address_file_name = time() . '-' . $request->newspaper_code . '-ChangeAdd';
                    $file_uploaded = $file->move($destinationPath, $change_in_address_file_name);
                    File::copy($destinationPath . $change_in_address_file_name, $mypath . $change_in_address_file_name);
                    if ($file_uploaded) {
                        $change_in_address_uploaded = 1;
                    } else {
                        $change_in_address_file_name = '';
                    }
                }
            } else {
                $change_in_address_uploaded = 0;
                $change_in_address_file_name = ' ';
            }
        $abc_cert_file_name = '';
        $abc_cert = 0;
        $pib_cert = 0;
        $pib_cert_file_name = '';
        $copy_of_return_cert = 0;
        $copy_of_return_file_name = '';


        $rni_registration_no = '';
        $rni_efiling_no = '';
        $claimed_circulation = 0;
        $caregistration_no = '';
        $ca_claimed_circulation = '';
        $abc_certificate_no = '';
        $abc_claimed_circulation = '';

        $rni_reg_no_verified = 0;
        $rni_annual_valid = 0;
        $rni_claimed_circulation_verified = 0;
        $RNI_Validation_Date = '1970-01-01';

        $abc_reg_no_verified = 0;
        $abc_annual_valid = 0;
        $abc_claimed_circulation_verified = 0;
        $ABC_Validation_Date = '1970-01-01';

        if ($request->cir_base == 0) {

            $rni_reg_no_verified = $request->rni_reg_no_verified ?? 0;
            $rni_annual_valid = $request->rni_annual_valid ?? 0;
            $rni_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old && $request->date_verified_old != '1753-01-01 00:00:00.000') {
                $RNI_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $RNI_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        if ($request->cir_base == 3) {

            $abc_reg_no_verified = $request->abc_reg_no_verified ?? 0;
            $abc_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old && $request->date_verified_old != '1753-01-01 00:00:00.000') {
                $ABC_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $ABC_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        $line_code = DB::table($this->tableNPRateRenewal)->select('Status', 'NP Code')->where('NP Code', $request->newspaper_code)->first();

        if (empty($line_code)) {
            $line_no = "10000";
            $lineNo = "10000";
        } else {
            $line_no = "10000";
            $lineNo = $line_no + 10000;
            $line_no = $line_no + 10000;
        }

        //Get value for Receiver ID.
        $get_receiver_code = DB::table($this->tableMediaPlanSetup)->select('Print Renewal Landing UID')->first();
        $recervier_id = $get_receiver_code->{"Print Renewal Landing UID"};
        if ($request->next_tab_1 == 1) {
        // dd(request());
            $array = array( 
                'NP Code' =>$request->newspaper_code,
                'Line No_' => $lineNo,
                'Payee Name' => $request->owner_name ?? '',
                'Owner type' => $request->owner_type ?? '',
                'Owner email' => $request->email ?? '',
                'Owner mobile' => $request->mobile ?? '',
                'Owner address' => $request->address ?? '',
                'local Code' => '',
                'Payee Code' => '',
                'BR Code' => ''
            );
            $where = array('NP Code' => $request->newspaper_code, 'Line No_' => $lineNo);
            $check_exist = DB::table($tablePayeeMasterRenewal)->where($where)->first();
            // dd($check_exist);
            if($check_exist)
            {
                $sql = DB::table($tablePayeeMasterRenewal)->where($where)->update($array);
            }
            else{
                $sql = DB::table($tablePayeeMasterRenewal)->insert($array);
            }
        }

        if ($request->next_tab_2 == 1) {
            
            $data_array = array(
                'Newspaper Name' => $request->newspaper_name ?? '',
                'Address' => $request->v_address ?? '',
                'Phone No' => $request->v_phone ?? '',
                'E-mail ID' => $request->v_email,
                'Pin Code' => $request->pin_code ?? '',
                'Mobile No' => $request->v_mobile ?? '',
                'Print Area' => $request->total_print_area ?? '',
                'Length' => $request->page_length ?? '',
                'Breadth' => $request->page_width ?? '',
                'Place of Publication' => $request->place_of_publication?? '',
                'No_ Of pages' => $request->no_of_page ?? 0,
                'Page Area per page' =>$request->print_area??'',
                'Renewal Year' => $year,
                'Contract Start Date' => '',
                'Contract End Date' => '',
                'New Rate' => 0,
                'Periodicity' => $request->periodicity??'',
                'circulation' => floatval($request->claimed_circulation)?? 0,
                'Printing in color' => $request->printing_colour??'',
                'No_ of pages in colour' => $request->colour_pages ?? 0,
                'Minimum Current Card Rate(B_W)' => $request->black_white ?? 0,
                'Minimum Current Card Rate(c)' => $request->colour ?? 0,
                'Annual Turn-over' => $request->total_annual_turn_over ?? 0,
                'Quality of Paper' => $request->quality_paper_used ?? 0,
                'News Agencies Subscribed To' => $request->news_agencies_subscribed ?? 0,
                'Agencies Name' => $request->agencies ?? '',
                'Price of NewsPaper' => $request->price_newspaper ?? 0,
                'DM Declaration' => $dm_declaration??'',
                'DMD File Name' => $dm_declaration_file_name??'',
                'RNI Circulation' => $RNI_Circulation??'',
                'Editor Name' => $request->name_of_editor ?? '',
                'Editor Email' => $request->editor_email ?? '',
                'Editor Phone' => $request->editor_phone ?? '',
                'Editor Mobile' => $request->editor_mobile ?? '',
                'Publisher Email' => $request->publisher_email?? '',
                'Publisher Mobile' => $request->publisher_mobile?? '',
                'Printer Email' => $request->printer_email?? '',
                'Printer Phone' => $request->printer_mobile?? '',               
                'Printer Name' => $request->printer_name?? '',
                'Printer Address' => '',
                'Publisher Name' => $request->publisher_name ?? '',
                'Publisher Address' => '',
                'Name of Press' => $request->name_of_press ?? '',
                'Address of Press' => $request->address_of_press ?? '',
                'Press Email' => $request->press_email ?? '',
                'Press Phone' => $request->press_phone ?? '',
                'Press Mobile' => $request->press_mobile ?? '',
                'Distance from office to press' => $request->distance_office_to_press ?? 0,
                'CA Registration No_' => $request->ca_registration_no ?? '',
                'CA Name' => $request->ca_name?? '',
                'CA Email' => $request->ca_email?? '',
                'CA Address' => $request->ca_address ?? '',
                'CA Mobile No_' =>$request->ca_mobile ?? '',
                'CA Phone No_' => '',
                'DM Declaration Date' => $dm_declaration_date??'',
                'ABC Circulation' => $ABC_Circulation??'',
                'CA Circulation' => $CA_Circulation??'',
                'Circulation File Name' => $Circulation_File_Name??'',
                'No Dues Certificate' => $no_dues_cert??'',
                'No Dues Cert File Name' => $no_dues_cert_file_name??'',
                'Print Area' => $request->total_print_area??'',
                'Status' => 0,
                'Sender ID' => '',
                'Receiver ID' => $recervier_id??'',
                'Agr File Name' => '',
                'Agr File Path' => '',
                'Approval Document' => '',
                'GST No_' => $request->GST_No ?? '',
                'ABC Certificate No_' => $request->abc_certificate_no ?? '',
                'RNI Registration No_' => $request->rni_registration_no ?? '',
                'RNI E-filling No_' => $request->rni_efiling_no  ?? '',
                'CIR Base' => $request->cir_base??'',
                'RNI Validation Date' => $RNI_Validation_Date??'',
                'RNI Registration Validation' => $rni_reg_no_verified??'',
                'RNI Circulation Validation' => $rni_claimed_circulation_verified??'',
                'RNI Annual Validation' => $rni_annual_valid??'',
                'ABC Validation Date' => $ABC_Validation_Date??'',
                'ABC Registration Validation' => $abc_reg_no_verified??'',
                'ABC Circulation Validation' => $abc_claimed_circulation_verified??'',
                'Application Date' => '',
                'GST FileName' => $gst_reg_cert_file_name??'',
                'GST Bool' =>$GST_cert??'',
                'Application No_' => $application_no,
                'ABC Cert_' => $abc_cert ?? '',
                'ABC Cert_ file Name' => $abc_cert_file_name ?? '',
                'Annexure - XII_A' => $annexure_XII_A??'',
                'Annexure File Name' => $annexure_file_name??'',
                'Annual Return Submitted to RNI' => $annual_return_submitted_rni??'',
                'Annual Return RNI File Name' => $annual_return_file_name??'',
                'Profile pic' => $profile_picture??'',
                'Vendor Scan signature' => $vendor_scan_signature??'',
                'Profile' => $profile??'',
                'Signature' => $signature??'',
                'Physically Verified' => 0,
                'Verification Date' =>'',
                'Specimen Copies' => $specimen_copies??'',
                'Specimen Copy File Name' => $specimen_copy_file_name??'',
                'Declaration Filed Before Auth_' => $declaration_field??'',
                'Decl_ Filed Before File Name' => $declaration_field_file_name??'',
                'RNI Reg File Name' => $rni_reg_file_name??'',
                'RNI Registration Cert' => $rni_registration_certificate??'',          
                'Circulation Cert' => $circulation_certificate??'',
                'Circulation Cert File Name' => $circulation_cert_file_name??'',
                'Change In Company Address' => $request->change_address ?? 0,
                'Press owned by owner' => $request->press_owned_by_owner ?? 0,
                'bound_unbound' => $request->bound_unbound??'',
                'UDIN' => $request->ca_udin_number ?? '',
                'Change in address uploaded' =>'',
                'Change in address File Name' => '',
                'Rejection reason'=>'',
                'Check Status' => 0,                       
                'Disqualification by CBC ' => 0,      
                'Legible' => 0,                
                'Neat' => 0,                                
                'Tempering' => 0,                           
                'Repetition matter in same pub_' => 0,      
                'Repetition remark' => '',                   
                'Reproduction matter other pub' => 0,       
                'Reproduction remark' =>'',                 
                'Source of News' => 0,                      
                'Title' => 0,                               
                'Place' => 0,                               
                'Date' => 0,                                
                'Day' => 0,                                
                'RNI NO' => 0,                              
                'Volume' => 0,                            
                'Issue No' => 0,                         
                'No of Pages' => 0,
                'Price' => 0,
                'Publisher & Printer name' => 0,            
                'Printing Press per RNI' => 0, 
                'Obs_ Submission'=>0,
                'Clubbing'=>0,
                'Language'=>'',
                'Modification'=>0,

            );
            if (@$line_code->{"Status"} == 1 ||@$line_code->{"Status"} == 3 || @$line_code->{"Status"} == 6 || @$line_code->{"NP Code"} == '') {

                $data_array['NP Code'] = $request->newspaper_code;
                // $data_array['Line No_'] = $line_no;
                $sql = DB::table($this->tableNPRateRenewal)->insert($data_array);
            } else {
                
                $where = array('NP Code' => $request->newspaper_code,'Status' => 0);
                $sql = DB::table($this->tableNPRateRenewal)->where($where)->update($data_array);
            }
        } else if ($request->submit_btn == 1) {
            // dd($no_dues_cert_file_name);
            $data_array = array(
                'DM Declaration' => $dm_declaration,
                'DMD File Name' => $dm_declaration_file_name,
                'RNI Circulation' => $RNI_Circulation,
                'ABC Circulation' => $ABC_Circulation,
                'CA Circulation' => $CA_Circulation,
                'Circulation File Name' => $Circulation_File_Name,
                'No Dues Certificate' => $no_dues_cert,
                'No Dues Cert File Name' => $no_dues_cert_file_name,
                'GST FileName' => $gst_reg_cert_file_name,
                'GST Bool' =>$GST_cert,
                'Application Date' => $application_date,
                'ABC Cert_' => $abc_cert ?? '',
                'ABC Cert_ file Name' => $abc_cert_file_name?? '',
                'Annexure - XII_A' => $annexure_XII_A,
                'Annexure File Name' => $annexure_file_name,
                'Annual Return Submitted to RNI' => $annual_return_submitted_rni,
                'Annual Return RNI File Name' => $annual_return_file_name,
                'Profile pic' => $profile_picture,
                'Vendor Scan signature' => $vendor_scan_signature,
                'Profile' => $profile,
                'Signature' => $signature,
                'Specimen Copies' => $specimen_copies,
                'Specimen Copy File Name' => $specimen_copy_file_name,
                'Declaration Filed Before Auth_' => $declaration_field,
                'Decl_ Filed Before File Name' => $declaration_field_file_name,
                'RNI Reg File Name' => $rni_reg_file_name,
                'RNI Registration Cert' => $rni_registration_certificate,
                'Circulation Cert' => $circulation_certificate,
                'Circulation Cert File Name' => $circulation_cert_file_name,
                'Change in address uploaded' => $change_in_address_uploaded,
                'Change in address File Name' => $change_in_address_file_name,
                'Status' => 0,
                'Modification'=>1,
            );

            $where = array('NP Code' => $request->newspaper_code,  'Status' => 0);
            $sql = DB::table($this->tableNPRateRenewal)->where($where)->update($data_array);
            // dd($sql);
        }
        if ($sql) {
            return $this->sendResponse($request->newspaper_code, 'Data Save Successfully! Please note the ' . $application_no . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!',$sql);
            exit;
        }
    }

    public function checkUniqueEmailVendor($email, $np_code)
    {
        $response = DB::table($this->tableNPRateRenewal)
            ->select('E-mail ID')
            ->where([['E-mail ID', '=', $email], ['NP Code', '!=', $np_code]])
            ->get();
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function checkGSTNo(Request $request)
    {
        $table = $this->tableVendorEmpPrint;
        $owner_id = DB::table($table)->select('Owner ID')->where('User ID', Session::get('id'))->first();
        if (!empty($owner_id)) {
            $where = array(['GST No_', '=', $request->gst_no], ['Owner ID', '!=', $owner_id->{'Owner ID'}]);
        } else {
            $where = array('GST No_' => $request->gst_no);
        }

        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'GST No_', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }
    public function checkRenewalGSTNo($gst_no, $ownerid)
    {
        $table = $this->tableMainNewspaperMaster;
        $Vendor_Codes = DB::table($table)->select('Newspaper Code')->where('Owner ID', $ownerid)->get()->toArray();
        $np_array = [];
        foreach ($Vendor_Codes as $Vendor_Code) {
            $np_array[] = $Vendor_Code->{'Newspaper Code'};
        }

        $response = DB::table($this->tableNPRateRenewal)
            ->select('GST No_')
            ->where('GST No_', $gst_no)
            ->whereNotIn('NP Code', $np_array)
            ->get();
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
            exit;
        }
    }

    public function checkRegistrationNo($cir_no, $reg_no)
    {
        $table = $this->tableMainNewspaperMaster;
        $where = '';
        if ($cir_no == 0) {
            $where = array('RNI Registration No_' => $reg_no);
        }
        if ($cir_no == 3) {
            $where = array('ABC Number' => $reg_no);
        }

        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Newspaper Code', '', '', $where);

        if (count($response) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function accountDetail($table = '', $select = '', $where = '')
    {
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
        }
    }

    public function accountDetailSave(Request $request)
    {

        if (Session::has('UserName') && Session('UserName') != '') {
            $table = $this->tableMainNewspaperMaster;
            $where = array('Newspaper Code' => Session('UserName'));
            $response = DB::table($table)->select('Owner ID', 'E-mail ID')->where($where)->first();
        } else {
            $table = $this->tableVendorEmpPrint;
            $where = array('User ID' => Session('id'));
            $response = DB::table($table)->select('Owner ID', 'E-mail ID')->where($where)->first();
        }
        // if(!empty($response) && $response->{'Owner ID'} != ''){
        // $where = array('Owner ID' => $response->{'Owner ID'});
        // }
        $sql = $this->updateAccountData($request, $where, $table);

        if ($sql) {
            if (!empty($response)) {
                $where = array('Owner ID' => $response->{'Owner ID'});
                $email_id = DB::table($this->tableOwner)->select('Email ID')->where($where)->first();
                if (!empty($email_id)) {
                    $details = [
                        'subject' => 'Account Information changed',
                        'body' => 'Your account information has been changed. If you have not changed your account information then please contact administrator.',
                        'template' => 'emails.vendorAccountMail'
                    ];
                    // send mail to owner
                    $res = $this->mailSendBankAccount($details, $email_id->{'Email ID'});
                    // send mail to vendor
                    if ($response->{'E-mail ID'} != '') {
                        $vemail = $response->{'E-mail ID'};
                        $res = $this->mailSendBankAccount($details, $vemail);
                    }
                }
            }
            return $this->sendResponse('', 'Data Saved successfully!');
        } else {
            return $this->sendError('Some Error Occurred!');
            exit;
        }
    }

    public function isPrimaryEdition($owner_id)
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('Owner ID' => $owner_id, 'Primary Edition' => 1);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Newspaper Name', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
        }
    }

    public function dateOfFirstPublication($owner_id)
    {
        $table = $this->tableVendorEmpPrint;
        $where = array('Owner ID' => $owner_id);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Date Of First Publication', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
        }
    }
    public function printPDFData($np_code)
    {
        $tableVendorEmpPrint = $this->tableVendorEmpPrint;
        $tableOwner = $this->tableOwner;
        $tableState = $this->tableState;
        $tableLanguage = $this->tableLanguage;
        $vendor_details = DB::table($tableVendorEmpPrint . ' as bvp')
            ->join($tableLanguage . ' as bl', 'bl.Code', '=', 'bvp.Language')
            ->join($tableState . ' as st', 'st.Code', '=', 'bvp.State')
            ->select('bvp.*', 'st.Description as state_name', 'bl.Code', 'bl.Name as lang_name', 'st.Code as state_code', 'bvp.Language')
            ->Where('bvp.Newspaper Code', [$np_code])
            ->get();

        $owner_details = DB::table($tableOwner . ' as own')
            ->join($tableState . ' as st', 'st.Code', '=', 'own.State')
            ->select('own.Owner ID', 'own.Owner Name', 'own.Owner Type', 'own.Mobile No_', 'own.Email ID', 'own.Phone No_', 'own.Fax No_', 'own.Address 1', 'own.City', 'own.District', 'st.Description as state_name', 'st.Code as state_code')
            ->Where('own.Owner ID', [@$vendor_details[0]->{'Owner ID'}])
            ->get();
        if (count($owner_details) > 0 || count($vendor_details) > 0) {
            $data = array('owner_details' => $owner_details[0], 'vendor_details' => $vendor_details[0]);
            unset($vendor_details[0]->timestamp);
            return $this->sendResponse($data, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
        }
    }


    public function printRenewalPDFData($np_code)
    {
        //dd($np_code);
        $tableMainNewspaperMaster = $this->tableMainNewspaperMaster;
        $tableOwner = $this->tableOwner;
        $tableState = $this->tableState;
        $tableLanguage = $this->tableLanguage;
        //  $np_rate_renewal = DB::table($this->tableMainNewspaperMaster)->select("*")->where('Newspaper Code', $np_code)->first();
        $vendor_details = DB::table($tableMainNewspaperMaster . ' as bvp')
            // ->join($tableLanguage . ' as bl', 'bl.Code', '=', 'bvp.Language')
            ->join($tableState . ' as st', 'st.Code', '=', 'bvp.State')
            ->select('bvp.*', 'st.Description as state_name','st.Code as state_code', 'bvp.Language')
            ->Where('bvp.Newspaper Code', [$np_code])
            ->get();
        //dd($vendor_details);
        $owner_details = DB::table($tableOwner . ' as own')
            ->join($tableState . ' as st', 'st.Code', '=', 'own.State')
            ->select('own.Owner ID', 'own.Owner Name', 'own.Owner Type', 'own.Mobile No_', 'own.Email ID', 'own.Phone No_', 'own.Fax No_', 'own.Address 1', 'own.City', 'own.District', 'st.Description as state_name', 'st.Code as state_code')
            ->Where('own.Owner ID', [@$vendor_details[0]->{'Owner ID'}])
            ->first();
            //dd($owner_details);
            $np_rate_renewal = DB::table($this->tableNPRateRenewal)->select("*")->where('NP Code', $np_code)->first();
        if ($owner_details !=Null || count($vendor_details) > 0) {
            $data = array('owner_details' => $owner_details, 'vendor_details' => $vendor_details[0], 'np_rate_renewal' => $np_rate_renewal);
            unset($vendor_details[0]->timestamp);
            unset($np_rate_renewal->timestamp);
            //dd($data);
            return $this->sendResponse($data, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!');
        }
    }

    public function saveCompanyOwnerData(Request $request, $owner_id)
    {
        if (empty($owner_id)) {
            $owner_id = DB::table($this->tableOwner)->select('Owner ID')->orderBy('Owner ID', 'desc')->first();
            if (empty($owner_id)) {
                $owner_id = 'EMPOW1';
            } else {
                $owner_id = $owner_id->{"Owner ID"};
                $owner_id++;
            }
            $sql =  $this->insertOwnerData($request, $owner_id);
            $msg = "Save successfully  $owner_id";
        } else {
            $owner_id = $owner_id;
            $sql =  $this->updateOwnerData($request, $owner_id);
            $msg = "Update successfully $owner_id";
        }
        if ($sql) {
            return $owner_id;
        } else {
            return false;
        }
    }

    public function insertOwnerData(Request $request, $owner_id)
    {
        $table1 = '[' . $this->tableOwner . ']';
        $request->owner_name = $request->owner_name ?? '';
        $request->phone = $request->phone ?? '';
        return DB::insert(
            "insert into $table1 (
        [timestamp],[Owner ID],[Owner Name],[Mobile No_],[Email ID],[Phone No_],[Fax No_],[Address 1],[Address 2],[City],[District],
        [State],[HO Same Address as DO],[DO Address],[DO Landline No_(with STD)],[DO Fax No_],[DO E-Mail],[DO Mobile No_],[DO PIN Code],
        [DO City],[DO State],[DO District],[PIN Code],[User ID],[Group Name],[Printed],[BR Code],[Pay Mode],[Account No],[Account Type],
        [MICR Code],[MICR City Code],[Local],[RBI AG Code],[RBI BR Code],[State Code],[STEPS BR Code],[STEPS Account NO],[GRP Password],
        [STEPS CoreBank],[AUTH Sign Name],[AUTH Sign Desgn],[IFSC Code],[IFSC Account Name],[IFSC Account NO],[IFSC Address],[IFSC File],
        [Adwing Pay Mode],[PFMS UniqueCode],[Group New Name],[Sanction Payee],[Owner Type]
        )
    values (
        DEFAULT,
        '" . $owner_id . "','" . $request->owner_name . "','" . $request->mobile . "','" . $request->email . "','" . $request->phone . "','','" . $request->address . "','','" . $request->city . "','" . $request->district . "','" . $request->state . "',
        0,'','','','','','','','','','','','','','',0,'','','','','','','','','','','','','','','','','','','',0,'','','',
         $request->owner_type
        )"
        );
    }

    public function updateOwnerData(Request $request, $owner_id)
    {
        $update = array(
            'Owner Name' => $request->owner_name,
            'Email ID' => $request->email,
            'Mobile No_' => $request->mobile,
            'Owner Type' => $request->owner_type,
            'Address 1' => $request->address,
            'State' => $request->state,
            'District' => $request->district,
            'City' => $request->city,
            'Phone No_' => $request->phone ?? ''
        );
        $where = array('Owner ID' => $owner_id);

        return ApiFreshEmpanelment::updateAllRecords($this->tableOwner, $update, $where);
    }

    public function updateAccountData(Request $request, $where, $table)
    {
        $update = array(
            'Bank Account No_' => $request->bank_account_no ?? '',
            'Account Holder Name' => $request->account_holder_name ?? '',
            'Account Address' => $request->address_of_account ?? '',
            'IFSC Code' => $request->ifsc_code ?? '',
            'Bank Name' => $request->bank_name ?? '',
            'Branch' => $request->branch_name ?? '',
            'ESI Account No' => $request->ESI_account_no ?? '',
            'No_of Employees covered' => $request->ESI_no_employees ?? 0,
            'EPF Account No_' => $request->EPF_account_no ?? '',
            'No_ of EPF Employees covered' => $request->EPF_no_of_employees ?? 0,
            'PAN' => $request->pan_card ?? '',
            'Account Type' => $request->account_type ?? ''
        );

        return ApiFreshEmpanelment::updateAllRecords($table, $update, $where);
    }
}
