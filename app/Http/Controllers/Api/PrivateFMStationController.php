<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ApiFreshEmpanelment;
use App\Models\Api\FMstation;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use App\Http\Traits\CommonTrait;

class PrivateFMStationController extends Controller
{
    use CommonTrait;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function fmStationOwnerData(Request $request)
    {
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $msg = '';
        $unique_id = '';
        $userid = session::get('UserID');
        $emailFind = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner ID', 'Email ID')->where('Email ID', $request->email)->first();
        $owner_name =
            isset($request->owner_name) ? $request->owner_name : '';
        $mobile =
            isset($request->mobile) ? $request->mobile : '';
        $email =
            isset($request->email) ? $request->email : '';
        $phone =
            isset($request->phone) ? $request->phone : '';
        $fax_no =
            isset($request->fax_no) ? $request->fax_no : '';
        $address =
            isset($request->address) ? $request->address : '';
        $city =
            isset($request->city) ? $request->city : '';
        $district =
            isset($request->district) ? $request->district : '';
        $state =
            isset($request->state) ? $request->state : '';
        if (@$emailFind->{'Email ID'} == '') {
            $owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2] order by [Owner ID] desc');
            if (empty($owner_id)) {
                $owner_id = 'EMPOW1';
            } else {
                $owner_id = $owner_id[0]->{"Owner ID"};
                $owner_id++;
            }
            $sql =  DB::insert(
                "insert into $table1 (
                [timestamp],
                [Owner ID],
                [Owner Name],
                [Mobile No_],
                [Email ID],
                [Phone No_],
                [Fax No_],
                [Address 1],
                [Address 2],
                [City],
                [District],
                [State],
                [HO Same Address as DO],
                [DO Address],
                [DO Landline No_(with STD)],
                [DO Fax No_],
                [DO E-Mail],
                [DO Mobile No_],
                [DO PIN Code],
                [DO City],
                [DO State],
                [DO District],
                [PIN Code],
                [User ID],
                [Group Name],
                [Printed],
                [BR Code],
                [Pay Mode],
                [Account No],
                [Account Type],
                [MICR Code],
                [MICR City Code],
                [Local],
                [RBI AG Code],
                [RBI BR Code],
                [State Code],
                [STEPS BR Code],
                [STEPS Account NO],
                [GRP Password],
                [STEPS CoreBank],
                [AUTH Sign Name],
                [AUTH Sign Desgn],
                [IFSC Code],
                [IFSC Account Name],
                [IFSC Account NO],
                [IFSC Address],
                [IFSC File],
                [Adwing Pay Mode],
                [PFMS UniqueCode],
                [Group New Name],
                [Sanction Payee],
                [Owner Type]
            ) 
            values (
                DEFAULT,
                '" . $owner_id . "',
                '" . $owner_name . "',
                '" . $mobile . "',
                '" . $email . "',
                '" . $phone . "',
                '" . $fax_no . "',
                '" . $address . "',
                '',
                '" . $city . "',
                '" . $district . "',            
                '" . $state . "',
                0,'','','','','','','','','','','" . $userid . "'
                ,'','','','','','','','','','','','','','','','','','','','','','','','','',
                '','',0
                )"
            );
            $msg = 'Data Saved Successfully!';
            if ($sql) {
                return $this->sendResponse($owner_id, $msg);
            }
        } else {
            $request->phone = $request->phone ?? '';
            $request->fax_no = $request->fax_no ?? '';
            $update = array(
                'Owner Name' => $request->owner_name,
                'Mobile No_' => $request->mobile,
                'Email ID' => $request->email,
                'Phone No_' => $request->phone,
                'Fax No_' => $request->fax_no,
                'Address 1' => $request->address,
                'City' => $request->city,
                'District' => $request->district,
                'State' => $request->state,
                'User ID' => $userid
            );
            $sql = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->where('Owner ID', @$emailFind->{'Owner ID'})->update($update);
            $msg = 'Data Updated Successfully!';
        }

        if ($sql) {
            return $this->sendResponse(@$emailFind->{'Owner ID'}, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function saveVanderdetails(Request $request)
    {
        $userid = session::get('UserID');
        $OwnerTable = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $emailFind = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner ID', 'Email ID')->where('Email ID', $request->email)->first();
        $OwnerID = @$emailFind->{'Owner ID'};
        $owner_id = $OwnerID;
        $msg = '';
        $FM_Program_Schedule = 'BOC$FM Program Schedule$3f88596c-e20d-438c-a694-309eb14559b2';
        $Vend_Emp_Pvt_FM = 'BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2';
        $fm_data = DB::table($Vend_Emp_Pvt_FM)
            ->select('FM Station ID as fm_id')
            ->where('User ID', $userid)
            ->orderBy('FM Station ID', 'desc')
            ->first();
        $fm_id = @$fm_data->fm_id;
        $FMstatio = DB::table('BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2')->select('FM Station ID')->where('FM Station ID', 'LIKE', '%' . 'BCF' . '%')->orderBy('FM Station ID', 'desc')->first();
        if (empty($FMstatio)) {
            $FMstatio = 'BCF000001';
        } else {
            $FMstatio = $FMstatio->{'FM Station ID'};
            $FMstatio++;
        }
        $Radio_Station_Type = DB::select('select TOP 1 [Radio Station Type] from dbo.[BOC$FM Program Schedule$3f88596c-e20d-438c-a694-309eb14559b2] order by [Radio Station Type] desc');
        if (empty($Radio_Station_Type)) {
            $Radio_Station_Type = '1991';
        } else {
            $Radio_Station_Type = $Radio_Station_Type[0]->{'Radio Station Type'};
            $Radio_Station_Type++;
        }

        /*=========================Start Main Pvt_ FM  insert Code =================================*/
        $FM_station_name    = isset($request->FM_station_name) ? $request->FM_station_name : '';
        $Broadcast_City     = isset($request->Broadcast_City) ? $request->Broadcast_City : '';
        $Media_Group        = isset($request->Media_Group) ? $request->Media_Group : '';
        $language           = isset($request->language) ? $request->language : '';
        $GOPA_Validity_Date = isset($request->GOPA_Validity_Date) ? $request->GOPA_Validity_Date : '0000-00-00';
        $WOL_Validity_Date  = isset($request->WOL_Validity_Date) ? $request->WOL_Validity_Date : '0000-00-00';
        $legal_company      = isset($request->legal_company) ? $request->legal_company  : '';
        $Commercial_Launch_Date  = isset($request->Commercial_Launch_Date) ? $request->Commercial_Launch_Date : '0000-00-00';
        $DO_Contact_Name    = isset($request->DO_Contact_Name) ? $request->DO_Contact_Name : '';
        $DO_Address         = isset($request->DO_Address) ? $request->DO_Address : '';
        $DO_Designation     = isset($request->DO_Designation) ? $request->DO_Designation : '';
        $DO_Landline_No     = isset($request->DO_Landline_No) ? $request->DO_Landline_No : '';
        $DO_Mobile          = isset($request->DO_Mobile) ? $request->DO_Mobile : '';
        $DO_Email           = isset($request->DO_Email) ? $request->DO_Email : '';
        $OP_contact_name    = isset($request->OP_contact_name) ? $request->OP_contact_name : '';
        $OP_Address         = isset($request->OP_Address) ? $request->OP_Address : '';
        $OP_Designation     = isset($request->OP_Designation) ? $request->OP_Designation : '';
        $OP_Landline_No     = isset($request->OP_Landline_No) ? $request->OP_Landline_No : '';
        $OP_Mobile_No       = isset($request->OP_Mobile_No) ? $request->OP_Mobile_No : '';
        $OP_Email           = isset($request->OP_Email) ? $request->OP_Email : '';
        $OP_Same_Address_as_DO = $request->OP_Same_Address_as_DO ?? '0';
        $HO_Contact_name    = isset($request->HO_Contact_name) ? $request->HO_Contact_name : '';
        $HO_address         = isset($request->HO_address) ? $request->HO_address : '';
        $HO_Designation     = isset($request->HO_Designation) ? $request->HO_Designation : '';
        $HO_Landline_No     = isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
        $HO_Mobile_No       = isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
        $HO_Email           = isset($request->HO_Email) ? $request->HO_Email : '';
        $Bank_account_number = isset($request->Bank_account_number) ? $request->Bank_account_number : '';
        $A_C_Holder_name     = isset($request->A_C_Holder_name) ? $request->A_C_Holder_name : '';
        $Bank_name          = isset($request->Bank_name) ? $request->Bank_name : '';
        $IFSC_code          = isset($request->IFSC_code) ? $request->IFSC_code : '';
        $Branch_name        = isset($request->Branch_name) ? $request->Branch_name : '';
        $Bank_account_address = isset($request->Bank_account_address) ? $request->Bank_account_address : '';
        $PAN_No             = isset($request->PAN_No) ? $request->PAN_No : '';
        $GST_No             = $request->GST_No ?? '';
        $ESI_account_no     = isset($request->ESI_account_no) ? $request->ESI_account_no : '';
        $ESI_employees_covered  = isset($request->ESI_employees_covered) ? $request->ESI_employees_covered : '';
        $EPF_account_no     = isset($request->EPF_account_no) ? $request->EPF_account_no : '';
        $EPF_employees_covered = isset($request->EPF_employees_covered) ? $request->EPF_employees_covered : '';
        $Ho_same_as_op = $request->Ho_same_as_op ?? '0';

        //Get value for Receiver ID.
        $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
        $get_receiver_code = DB::select("select TOP 1 [Pvt_ FM Empanel Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"Pvt_ FM Empanel Landing UID"};

        if (@$fm_id == '') {
            $insertFM = array(
                'FM Station ID' => $FMstatio,
                'FM Station Name' => $FM_station_name,
                'Owner ID' => $owner_id,
                'Broadcast City' => $Broadcast_City,
                'Media Group' => $Media_Group,
                'Language' => $language,
                'GOPA Validity Date' => $GOPA_Validity_Date,
                'HO Address' => $HO_address,
                'HO Landline No_(with STD)' => $HO_Landline_No,
                'HO Contact Name' => $HO_Contact_name,
                'HO E-Mail' => $HO_Email,
                'HO Mobile No_' => $HO_Mobile_No,
                'HO Same Address DO' => $Ho_same_as_op,
                'HO Designation' => $HO_Designation,
                'DO Address' => $DO_Address,
                'DO Landline No_(with STD)' => $DO_Landline_No,
                'DO Contact Name' => $DO_Contact_Name,
                'DO E-Mail' => $DO_Email,
                'DO Mobile No_' => $DO_Mobile,
                'DO Designation' => $DO_Designation,
                'WOL Validity Date' => $WOL_Validity_Date,
                'Company Legal Status' => $legal_company,
                'Commercial Launch Date' => $Commercial_Launch_Date,
                'OP Address' => $OP_Address,
                'OP Landline No_(with STD)' => $OP_Landline_No,
                'OP Contact Name' => $OP_contact_name,
                'OP E-Mail' => $OP_Email,
                'OP Mobile No_' => $OP_Mobile_No,
                'OP Same Address DO' => $OP_Same_Address_as_DO,
                'OP Designation' => $OP_Designation,
                'ESI - No_ Of Employee' => 0,
                'EPF A_C No_' => '',
                'EPF - No_ Of Employee' => 0,
                'GST No_' => '',
                'A_C Holder Name' => '',
                'Bank A_C Address' => '',
                'ESI A_C No_' => '',
                'PAN' => '',
                'Bank Name' => '',
                'Bank Branch' => '',
                'IFSC Code' => '',
                'Bank A_c No_' => '',
                'WOL Certificate' => 0,
                'GOPA Certificate' => 0,
                'Undertaking' => 0,
                'Cancelled Cheque' => 0,
                'Program Scheduling Certificate' => 0,
                'Auditor Certificate' => 0,
                'Sr_ Management Attestation' => 0,
                'Acceptance' => 0,
                'WOL File Name' => '',
                'GOPA File Name' => '',
                'Undertaking File Name' => '',
                'Cancelled Cheque File Name' => '',
                'Program Scheduling File Name' => '',
                'Auditor File Name' => '',
                'SMA File Name' => '',
                'Broadcasting Certificate' => 0,
                'Broadcasting Cert File Name' => '',
                'Signed List' => 0,
                'Signed List File Name' => '',
                'User ID' => $userid,
                'Status' => 0,
                'Sender ID' => '',
                'Receiver ID' => $recervier_id,
                'Rate' => 0,
                'Modification' => '0',
                'Empanelment Category' => 6,
                'Global Dimension 1 Code' => 'M002',
                'Global Dimension 2 Code' => 0,
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => ' ',
                'From Date' => '1900-01-01 00:00:00.000',
                'To Date' => '1900-01-01 00:00:00.000',
                'Recommended To Committee' => 0,
                'Rate11' => 0,
                'Rate22' => 0
            );
            $sql2 = DB::table($Vend_Emp_Pvt_FM)->insert($insertFM);
            //dd($sql2);
            $mag = "PVT. FM Information Added Successfully !";
            /*=========================End Main Pvt_ FM  insert Code=================================*/
            /*=========================Start Timeband insert Code=================================*/
            $Programme_Set = 0;
            if (($request->all == 'on') && ($request->all_1 == 'on') && ($request->all_2 == 'on')) {
                $Mon_TB1_From  = '1900-01-01 07:00:00.000';
                $Mon_TB1_To    = '1900-01-01 11:00:00.000';
                $Mon_TB2_From  = '1900-01-01 11:00:00.000';
                $Mon_TB2_To    = '1900-01-01 18:00:00.000';
                $Mon_TB3_From  = '1900-01-01 18:00:00.000';
                $Mon_TB3_To    = '1900-01-01 23:00:00.000';
                $Tue_TB1_From  = '1900-01-01 07:00:00.000';
                $Tue_TB1_To    = '1900-01-01 11:00:00.000';
                $Tue_TB2_From  = '1900-01-01 11:00:00.000';
                $Tue_TB2_To    = '1900-01-01 18:00:00.000';
                $Tue_TB3_From  = '1900-01-01 18:00:00.000';
                $Tue_TB3_To    = '1900-01-01 23:00:00.000';
                $Wed_TB1_From  = '1900-01-01 07:00:00.000';
                $Wed_TB1_To    = '1900-01-01 11:00:00.000';
                $Wed_TB2_From  = '1900-01-01 11:00:00.000';
                $Wed_TB2_To    = '1900-01-01 18:00:00.000';
                $Wed_TB3_From  = '1900-01-01 18:00:00.000';
                $Wed_TB3_To    = '1900-01-01 23:00:00.000';
                $Thur_TB1_From = '1900-01-01 07:00:00.000';
                $Thur_TB1_To   = '1900-01-01 11:00:00.000';
                $Thur_TB2_From = '1900-01-01 11:00:00.000';
                $Thur_TB2_To   = '1900-01-01 18:00:00.000';
                $Thur_TB3_From = '1900-01-01 18:00:00.000';
                $Thur_TB3_To   = '1900-01-01 23:00:00.000';
                $Fri_TB1_From  = '1900-01-01 07:00:00.000';
                $Fri_TB1_To    = '1900-01-01 11:00:00.000';
                $Fri_TB2_From  = '1900-01-01 11:00:00.000';
                $Fri_TB2_To    = '1900-01-01 18:00:00.000';
                $Fri_TB3_From  = '1900-01-01 18:00:00.000';
                $Fri_TB3_To    = '1900-01-01 23:00:00.000';
                $Sat_TB1_From  = '1900-01-01 07:00:00.000';
                $Sat_TB1_To    = '1900-01-01 11:00:00.000';
                $Sat_TB2_From  = '1900-01-01 11:00:00.000';
                $Sat_TB2_To    = '1900-01-01 18:00:00.000';
                $Sat_TB3_From  = '1900-01-01 18:00:00.000';
                $Sat_TB3_To    = '1900-01-01 23:00:00.000';
                $Sun_TB1_From  = '1900-01-01 07:00:00.000';
                $Sun_TB1_To    = '1900-01-01 11:00:00.000';
                $Sun_TB2_From  = '1900-01-01 11:00:00.000';
                $Sun_TB2_To    = '1900-01-01 18:00:00.000';
                $Sun_TB3_From  = '1900-01-01 18:00:00.000';
                $Sun_TB3_To    = '1900-01-01 23:00:00.000';
            } else if (($request->all != 'on') && ($request->monday_time_1 == 'on')) {
                $Mon_TB1_From  = '1900-01-01 07:00:00.000';
                $Mon_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->tuesday_time_1 == 'on')) {
                $Tue_TB1_From  = '1900-01-01 07:00:00.000';
                $Tue_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->wednesday_time_1 == 'on')) {
                $Wed_TB1_From  = '1900-01-01 07:00:00.000';
                $Wed_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->thursday_time_1 == 'on')) {
                $Thur_TB1_From = '1900-01-01 07:00:00.000';
                $Thur_TB1_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->friday_time_1 == 'on')) {
                $Fri_TB1_From  = '1900-01-01 07:00:00.000';
                $Fri_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->saturday_time_1 == 'on')) {
                $Sat_TB1_From  = '1900-01-01 07:00:00.000';
                $Sat_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->sunday_time_1 == 'on')) {
                $Sun_TB1_From  = '1900-01-01 07:00:00.000';
                $Sun_TB1_To    = '1900-01-01 11:00:00.000';
            } else if (($request->all_1 != 'on') && ($request->monday_time_2 == 'on')) {
                $Mon_TB2_From  = '1900-01-01 07:00:00.000';
                $Mon_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->tuesday_time_2 == 'on')) {
                $Tue_TB2_From  = '1900-01-01 07:00:00.000';
                $Tue_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->wednesday_time_2 == 'on')) {
                $Wed_TB2_From  = '1900-01-01 07:00:00.000';
                $Wed_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->thursday_time_2 == 'on')) {
                $Thur_TB2_From = '1900-01-01 07:00:00.000';
                $Thur_TB2_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->friday_time_2 == 'on')) {
                $Fri_TB2_From  = '1900-01-01 07:00:00.000';
                $Fri_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->saturday_time_2 == 'on')) {
                $Sat_TB2_From  = '1900-01-01 07:00:00.000';
                $Sat_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->sunday_time_2 == 'on')) {
                $Sun_TB2_From  = '1900-01-01 07:00:00.000';
                $Sun_TB2_To    = '1900-01-01 11:00:00.000';
            } else if (($request->all_2 != 'on') && ($request->monday_time_3 == 'on')) {
                $Mon_TB3_From  = '1900-01-01 07:00:00.000';
                $Mon_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->tuesday_time_3 == 'on')) {
                $Tue_TB3_From  = '1900-01-01 07:00:00.000';
                $Tue_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->wednesday_time_3 == 'on')) {
                $Wed_TB3_From  = '1900-01-01 07:00:00.000';
                $Wed_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->thursday_time_3 == 'on')) {
                $Thur_TB3_From = '1900-01-01 07:00:00.000';
                $Thur_TB3_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->friday_time_3 == 'on')) {
                $Fri_TB3_From  = '1900-01-01 07:00:00.000';
                $Fri_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->saturday_time_3 == 'on')) {
                $Sat_TB3_From  = '1900-01-01 07:00:00.000';
                $Sat_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->sunday_time_3 == 'on')) {
                $Sun_TB3_From  = '1900-01-01 07:00:00.000';
                $Sun_TB3_To    = '1900-01-01 11:00:00.000';
            }


            $insert = array(
                'Radio Station Type' => $Radio_Station_Type,
                'Station ID' => $FMstatio,
                'Programme Set' => $Programme_Set,
                'Mon TB1 From' => $Mon_TB1_From,
                'Mon TB1 To'   => $Mon_TB1_To,
                'Mon TB2 From' => $Mon_TB2_From,
                'Mon TB2 To'   => $Mon_TB2_To,
                'Mon TB3 From' => $Mon_TB3_From,
                'Mon TB3 To'   => $Mon_TB3_To,
                'Tue TB1 From' => $Tue_TB1_From,
                'Tue TB1 To'   => $Tue_TB1_To,
                'Tue TB2 From' => $Tue_TB2_From,
                'Tue TB2 To'   => $Tue_TB2_To,
                'Tue TB3 From' => $Tue_TB3_From,
                'Tue TB3 To'   => $Tue_TB3_To,
                'Wed TB1 From' => $Wed_TB1_From,
                'Wed TB1 To'   => $Wed_TB1_To,
                'Wed TB2 From' => $Wed_TB2_From,
                'Wed TB2 To'   => $Wed_TB2_To,
                'Wed TB3 From' => $Wed_TB3_From,
                'Wed TB3 To'   => $Wed_TB3_To,
                'Thur TB1 From' => $Thur_TB1_From,
                'Thur TB1 To'  => $Thur_TB1_To,
                'Thur TB2 From' => $Thur_TB2_From,
                'Thur TB2 To'  => $Thur_TB2_To,
                'Thur TB3 From' => $Thur_TB3_From,
                'Thur TB3 To'  => $Thur_TB3_To,
                'Fri TB1 From' => $Fri_TB1_From,
                'Fri TB1 To'   => $Fri_TB1_To,
                'Fri TB2 From' => $Fri_TB2_From,
                'Fri TB2 To'   => $Fri_TB2_To,
                'Fri TB3 From' => $Fri_TB3_From,
                'Fri TB3 To'   => $Fri_TB3_To,
                'Sat TB1 From' => $Sat_TB1_From,
                'Sat TB1 To'   => $Sat_TB1_To,
                'Sat TB2 From' => $Sat_TB2_From,
                'Sat TB2 To'   => $Sat_TB2_To,
                'Sat TB3 From' => $Sat_TB3_From,
                'Sat TB3 To'   => $Sat_TB3_To,
                'Sun TB1 From' => $Sun_TB1_From,
                'Sun TB1 To'   => $Sun_TB1_To,
                'Sun TB2 From' => $Sun_TB2_From,
                'Sun TB2 To'   => $Sun_TB2_To,
                'Sun TB3 From' => $Sun_TB3_From,
                'Sun TB3 To'   => $Sun_TB3_To
            );
            $sql6 = DB::table($FM_Program_Schedule)->insert($insert);
            $msg = "PVT. FM Information Added Successfully!";
            if (!$sql2 && !$sql6) {
                $this->sendError("Some error Occurred!");
                exit();
            } else {
                return $this->sendResponse($FMstatio, $msg);
            }
            /*============End Time band insert Code=========*/
        } else {
            /*=============End Time band Update Code===============*/
            /*===============Get FM Station ID From [BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2]======*/
            //$owner_id =$request->ownerid;
            $legal_company = isset($request->legal_company) ? $request->legal_company  : '';
            $msg = '';
            $OP_Same_Address_as_DO = $request->OP_Same_Address_as_DO ??  0;
            $Ho_same_as_op = $request->Ho_same_as_op ??   0;
            $update = array(
                'FM Station Name'          => $request->FM_station_name,
                'Owner ID'                 => $owner_id,
                'Broadcast City'           => $request->Broadcast_City,
                'Media Group'              => $request->Media_Group,
                'Language'                 => $request->language,
                'GOPA Validity Date'       => $request->GOPA_Validity_Date,
                'HO Address'               => $request->HO_address,
                'HO Landline No_(with STD)' => $request->HO_Landline_No ?? '',
                'HO Contact Name'          => $request->HO_Contact_name,
                'HO E-Mail'                => $request->HO_Email,
                'HO Mobile No_'            => $request->HO_Mobile_No,
                'HO Same Address DO'       => $Ho_same_as_op,
                'HO Designation'           => $request->HO_Designation,
                'DO Address'               => $request->DO_Address,
                'DO Landline No_(with STD)' => $request->DO_Landline_No ?? '',
                'DO Contact Name'           => $request->DO_Contact_Name,
                'DO E-Mail'                 => $request->DO_Email,
                'DO Mobile No_'             => $request->DO_Mobile,
                'DO Designation'            => $request->DO_Designation,
                'WOL Validity Date'         => $request->WOL_Validity_Date,
                'Company Legal Status'      => $legal_company,
                'Commercial Launch Date'    => $request->Commercial_Launch_Date,
                'OP Address'                => $request->OP_Address,
                'OP Landline No_(with STD)' => $request->OP_Landline_No ?? '',
                'OP Contact Name'           => $request->OP_contact_name,
                'OP E-Mail'                 => $request->OP_Email,
                'OP Mobile No_'             => $request->OP_Mobile_No,
                'OP Same Address DO'        => $OP_Same_Address_as_DO,
                'OP Designation'            => $request->OP_Designation
            );
            $sql2 = DB::table($Vend_Emp_Pvt_FM)
                ->where('FM Station ID', $fm_id)
                ->update($update);
            $msg = "PVT. FM Information Updated Successfully!";
            if (!$sql2) {
                return $this->sendError("Some error Occurred!");
                exit();
            }




            /*==============Time band update code =====================*/
            if (($request->all == 'on') && ($request->all_1 == 'on') && ($request->all_2 == 'on')) {
                $Mon_TB1_From  = '1900-01-01 07:00:00.000';
                $Mon_TB1_To    = '1900-01-01 11:00:00.000';
                $Mon_TB2_From  = '1900-01-01 11:00:00.000';
                $Mon_TB2_To    = '1900-01-01 18:00:00.000';
                $Mon_TB3_From  = '1900-01-01 18:00:00.000';
                $Mon_TB3_To    = '1900-01-01 23:00:00.000';
                $Tue_TB1_From  = '1900-01-01 07:00:00.000';
                $Tue_TB1_To    = '1900-01-01 11:00:00.000';
                $Tue_TB2_From  = '1900-01-01 11:00:00.000';
                $Tue_TB2_To    = '1900-01-01 18:00:00.000';
                $Tue_TB3_From  = '1900-01-01 18:00:00.000';
                $Tue_TB3_To    = '1900-01-01 23:00:00.000';
                $Wed_TB1_From  = '1900-01-01 07:00:00.000';
                $Wed_TB1_To    = '1900-01-01 11:00:00.000';
                $Wed_TB2_From  = '1900-01-01 11:00:00.000';
                $Wed_TB2_To    = '1900-01-01 18:00:00.000';
                $Wed_TB3_From  = '1900-01-01 18:00:00.000';
                $Wed_TB3_To    = '1900-01-01 23:00:00.000';
                $Thur_TB1_From = '1900-01-01 07:00:00.000';
                $Thur_TB1_To   = '1900-01-01 11:00:00.000';
                $Thur_TB2_From = '1900-01-01 11:00:00.000';
                $Thur_TB2_To   = '1900-01-01 18:00:00.000';
                $Thur_TB3_From = '1900-01-01 18:00:00.000';
                $Thur_TB3_To   = '1900-01-01 23:00:00.000';
                $Fri_TB1_From  = '1900-01-01 07:00:00.000';
                $Fri_TB1_To    = '1900-01-01 11:00:00.000';
                $Fri_TB2_From  = '1900-01-01 11:00:00.000';
                $Fri_TB2_To    = '1900-01-01 18:00:00.000';
                $Fri_TB3_From  = '1900-01-01 18:00:00.000';
                $Fri_TB3_To    = '1900-01-01 23:00:00.000';
                $Sat_TB1_From  = '1900-01-01 07:00:00.000';
                $Sat_TB1_To    = '1900-01-01 11:00:00.000';
                $Sat_TB2_From  = '1900-01-01 11:00:00.000';
                $Sat_TB2_To    = '1900-01-01 18:00:00.000';
                $Sat_TB3_From  = '1900-01-01 18:00:00.000';
                $Sat_TB3_To    = '1900-01-01 23:00:00.000';
                $Sun_TB1_From  = '1900-01-01 07:00:00.000';
                $Sun_TB1_To    = '1900-01-01 11:00:00.000';
                $Sun_TB2_From  = '1900-01-01 11:00:00.000';
                $Sun_TB2_To    = '1900-01-01 18:00:00.000';
                $Sun_TB3_From  = '1900-01-01 18:00:00.000';
                $Sun_TB3_To    = '1900-01-01 23:00:00.000';
            } else if (($request->all != 'on') && ($request->monday_time_1 == 'on')) {
                $Mon_TB1_From  = '1900-01-01 07:00:00.000';
                $Mon_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->tuesday_time_1 == 'on')) {
                $Tue_TB1_From  = '1900-01-01 07:00:00.000';
                $Tue_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->wednesday_time_1 == 'on')) {
                $Wed_TB1_From  = '1900-01-01 07:00:00.000';
                $Wed_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->thursday_time_1 == 'on')) {
                $Thur_TB1_From = '1900-01-01 07:00:00.000';
                $Thur_TB1_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->friday_time_1 == 'on')) {
                $Fri_TB1_From  = '1900-01-01 07:00:00.000';
                $Fri_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->saturday_time_1 == 'on')) {
                $Sat_TB1_From  = '1900-01-01 07:00:00.000';
                $Sat_TB1_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all != 'on') && $request->sunday_time_1 == 'on')) {
                $Sun_TB1_From  = '1900-01-01 07:00:00.000';
                $Sun_TB1_To    = '1900-01-01 11:00:00.000';
            } else if (($request->all_1 != 'on') && ($request->monday_time_2 == 'on')) {
                $Mon_TB2_From  = '1900-01-01 07:00:00.000';
                $Mon_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->tuesday_time_2 == 'on')) {
                $Tue_TB2_From  = '1900-01-01 07:00:00.000';
                $Tue_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->wednesday_time_2 == 'on')) {
                $Wed_TB2_From  = '1900-01-01 07:00:00.000';
                $Wed_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->thursday_time_2 == 'on')) {
                $Thur_TB2_From = '1900-01-01 07:00:00.000';
                $Thur_TB2_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->friday_time_2 == 'on')) {
                $Fri_TB2_From  = '1900-01-01 07:00:00.000';
                $Fri_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->saturday_time_2 == 'on')) {
                $Sat_TB2_From  = '1900-01-01 07:00:00.000';
                $Sat_TB2_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_1 != 'on') && $request->sunday_time_2 == 'on')) {
                $Sun_TB2_From  = '1900-01-01 07:00:00.000';
                $Sun_TB2_To    = '1900-01-01 11:00:00.000';
            } else if (($request->all_2 != 'on') && ($request->monday_time_3 == 'on')) {
                $Mon_TB3_From  = '1900-01-01 07:00:00.000';
                $Mon_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->tuesday_time_3 == 'on')) {
                $Tue_TB3_From  = '1900-01-01 07:00:00.000';
                $Tue_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->wednesday_time_3 == 'on')) {
                $Wed_TB3_From  = '1900-01-01 07:00:00.000';
                $Wed_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->thursday_time_3 == 'on')) {
                $Thur_TB3_From = '1900-01-01 07:00:00.000';
                $Thur_TB3_To   = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->friday_time_3 == 'on')) {
                $Fri_TB3_From  = '1900-01-01 07:00:00.000';
                $Fri_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->saturday_time_3 == 'on')) {
                $Sat_TB3_From  = '1900-01-01 07:00:00.000';
                $Sat_TB3_To    = '1900-01-01 11:00:00.000';
            } else if ((($request->all_2 != 'on') && $request->sunday_time_3 == 'on')) {
                $Sun_TB3_From  = '1900-01-01 07:00:00.000';
                $Sun_TB3_To    = '1900-01-01 11:00:00.000';
            }
            $update = array(
                'Mon TB1 From' => $Mon_TB1_From,
                'Mon TB1 To'   => $Mon_TB1_To,
                'Mon TB2 From' => $Mon_TB2_From,
                'Mon TB2 To'   => $Mon_TB2_To,
                'Mon TB3 From' => $Mon_TB3_From,
                'Mon TB3 To'   => $Mon_TB3_To,
                'Tue TB1 From' => $Tue_TB1_From,
                'Tue TB1 To'   => $Tue_TB1_To,
                'Tue TB2 From' => $Tue_TB2_From,
                'Tue TB2 To'   => $Tue_TB2_To,
                'Tue TB3 From' => $Tue_TB3_From,
                'Tue TB3 To'   => $Tue_TB3_To,
                'Wed TB1 From' => $Wed_TB1_From,
                'Wed TB1 To'   => $Wed_TB1_To,
                'Wed TB2 From' => $Wed_TB2_From,
                'Wed TB2 To'   => $Wed_TB2_To,
                'Wed TB3 From' => $Wed_TB3_From,
                'Wed TB3 To'   => $Wed_TB3_To,
                'Thur TB1 From' => $Thur_TB1_From,
                'Thur TB1 To'  => $Thur_TB1_To,
                'Thur TB2 From' => $Thur_TB2_From,
                'Thur TB2 To'  => $Thur_TB2_To,
                'Thur TB3 From' => $Thur_TB3_From,
                'Thur TB3 To'  => $Thur_TB3_To,
                'Fri TB1 From' => $Fri_TB1_From,
                'Fri TB1 To'   => $Fri_TB1_To,
                'Fri TB2 From' => $Fri_TB2_From,
                'Fri TB2 To'   => $Fri_TB2_To,
                'Fri TB3 From' => $Fri_TB3_From,
                'Fri TB3 To'   => $Fri_TB3_To,
                'Sat TB1 From' => $Sat_TB1_From,
                'Sat TB1 To'   => $Sat_TB1_To,
                'Sat TB2 From' => $Sat_TB2_From,
                'Sat TB2 To'   => $Sat_TB2_To,
                'Sat TB3 From' => $Sat_TB3_From,
                'Sat TB3 To'   => $Sat_TB3_To,
                'Sun TB1 From' => $Sun_TB1_From,
                'Sun TB1 To'   => $Sun_TB1_To,
                'Sun TB2 From' => $Sun_TB2_From,
                'Sun TB2 To'   => $Sun_TB2_To,
                'Sun TB3 From' => $Sun_TB3_From,
                'Sun TB3 To'   => $Sun_TB3_To
            );
            $sql6 = DB::table($FM_Program_Schedule)->where('Station ID', $fm_id)->update($update);
            $msg = "PVT. FM Information Updated Successfully!";
            //dd($sql6);
            if (!$sql2 && !$sql6) {
                $this->sendError("Some error Occurred!");
                exit();
            } else {
                return $this->sendResponse($fm_id, $msg);
            }
        }
    }
    /*=====================================================End Second Tab========================================*/
    /*=====================================================Start Third Tab========================================*/
    public function ACdetails(Request $request)
    {
        $userid = session::get('UserID');
        $Vend_Emp_Pvt_FM = 'BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2';
        $fm_data = DB::table($Vend_Emp_Pvt_FM)
            ->select('FM Station ID as fm_id')
            ->where('User ID', $userid)
            ->orderBy('FM Station ID', 'desc')
            ->first();
        $fm_id = @$fm_data->fm_id;
        $msg = "";
        $ESI_account_no  = isset($request->ESI_account_no) ? $request->ESI_account_no : '';
        $ESI_employees_covered  = isset($request->ESI_employees_covered) ? $request->ESI_employees_covered : '';
        $EPF_account_no  = isset($request->EPF_account_no) ? $request->EPF_account_no : '';
        $EPF_employees_covered = isset($request->EPF_employees_covered) ? $request->EPF_employees_covered : '';
        $update = array(
            'ESI - No_ Of Employee' => $ESI_employees_covered,
            'EPF A_C No_'     => $EPF_account_no,
            'EPF - No_ Of Employee' => $EPF_employees_covered,
            'GST No_'        => $request->GST_No,
            'A_C Holder Name' => $request->A_C_Holder_name,
            'Bank A_C Address' => $request->Bank_account_address,
            'ESI A_C No_'     => $ESI_account_no,
            'PAN'             => $request->PAN_No,
            'Bank Name'       => $request->Bank_name,
            'Bank Branch'     => $request->Branch_name,
            'IFSC Code'       => $request->IFSC_code,
            'Bank A_c No_'   => $request->Bank_account_number
        );
        $sql4 = DB::table($Vend_Emp_Pvt_FM)
            ->where('FM Station ID', $fm_id)
            ->update($update);
        $msg = "Account Details Added Successfully!";
        if (!$sql4) {
            $this->sendError('Some Error Occurred!');
            exit();
        } else {
            return $this->sendResponse($fm_id, $msg);
        }
    }
    /*=====================================================End Third Tab========================================*/
    /*=============================================Start add document section========================================*/
    public function storeDOC(Request $request)
    {
        $userid = session::get('UserID');
        $Vend_Emp_Pvt_FM = 'BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2';
        $fm_data = DB::table($Vend_Emp_Pvt_FM)
            ->select('*')
            ->where('User ID', $userid)
            ->orderBy('FM Station ID', 'desc')
            ->first();
        //dd($fm_data);
        $fm_id = @$fm_data->{'FM Station ID'};
        $msg = '';
        $destinationPath = public_path() . '/uploads/FM_radio_station/';
        $bharatkosh_receipt = '';
        $WOL_Certificate = '';
        $GOPA_Certificate = '';
        $Undertaking = '';
        $bharatkosh_cert = '';
        $Program_Scheduling_Certificate = '';
        $Cancelled_Cheque = '';
        $Auditor_Certificate = '';
        $Broadcasting_Certificate = '';
        $Sr_Management_Attestation = '';
        $signed_list = '';
        //dd($fm_data->{'WOL File Name'});


        if ($request->hasFile('WOL_Certificate_file') || $request->hasFile('WOL_Certificate_file_Modify')) {
            $file = $request->file('WOL_Certificate_file') ? $request->file('WOL_Certificate_file') : $request->file('WOL_Certificate_file_Modify');
            $WOL_Certificate_file = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $WOL_Certificate_file);
            if ($fileUploaded) {

                $WOL_Certificate = 1;
            }
        } else {
            if ($fm_data->{'WOL File Name'} != '') {
                $WOL_Certificate_file = $fm_data->{'WOL File Name'};
                $WOL_Certificate = 1;
            } else {
                $WOL_Certificate_file = '';
            }
        }

        if ($request->hasFile('GOPA_Certificate_file') || $request->hasFile('GOPA_Certificate_file_Modify')) {
            $file1 = $request->file('GOPA_Certificate_file') ? $request->file('GOPA_Certificate_file') : $request->file('GOPA_Certificate_file_Modify');
            $GOPA_Certificate_file = time() . '-' . $file1->getClientOriginalName();
            $fileUploaded1 = $file1->move($destinationPath, $GOPA_Certificate_file);
            if ($fileUploaded1) {
                $GOPA_Certificate = 1;
            }
        } else {
            if ($fm_data->{'GOPA File Name'} != '') {
                $GOPA_Certificate_file = $fm_data->{'GOPA File Name'};
                $GOPA_Certificate = 1;
            } else {
                $GOPA_Certificate_file = '';
            }
        }
        if ($request->hasFile('Undertaking_file') || $request->hasFile('Undertaking_file_Modify')) {
            $file3 = $request->file('Undertaking_file') ? $request->file('Undertaking_file') : $request->file('Undertaking_file_Modify');
            $Undertaking_file = time() . '-' . $file3->getClientOriginalName();
            $fileUploaded_Undertaking_file = $file3->move($destinationPath, $Undertaking_file);
            if ($fileUploaded_Undertaking_file) {
                $Undertaking = 1;
            }
        } else {
            if ($fm_data->{'Undertaking File Name'} != '') {
                $Undertaking_file = $fm_data->{'Undertaking File Name'};
                $Undertaking = 1;
            } else {
                $Undertaking_file = '';
            }
        }
        if ($request->hasFile('Program_Scheduling_Certificate_file') || $request->hasFile('Program_Scheduling_Certificate_file_Modify')) {
            $file4 = $request->file('Program_Scheduling_Certificate_file') ? $request->file('Program_Scheduling_Certificate_file') : $request->file('Program_Scheduling_Certificate_file_Modify');
            $Program_Scheduling_Certificate_file = time() . '-' . $file4->getClientOriginalName();
            $fileUploaded_Program_Scheduling_Certificate_file =
                $file4->move($destinationPath, $Program_Scheduling_Certificate_file);
            if ($fileUploaded_Program_Scheduling_Certificate_file) {
                $Program_Scheduling_Certificate = 1;
            }
        } else {
            if ($fm_data->{'Program Scheduling File Name'} != '') {
                $Program_Scheduling_Certificate_file = $fm_data->{'Program Scheduling File Name'};
                $Program_Scheduling_Certificate = 1;
            } else {
                $Program_Scheduling_Certificate_file = '';
            }
        }
        if ($request->hasFile('Cancelled_Cheque_file') || $request->hasFile('Cancelled_Cheque_file_Modify')) {
            $file5 = $request->file('Cancelled_Cheque_file') ? $request->file('Cancelled_Cheque_file') : $request->file('Cancelled_Cheque_file_Modify');
            $Cancelled_Cheque_file = time() . '-' . $file5->getClientOriginalName();
            $fileUploaded_Cancelled_Cheque_file = $file5->move($destinationPath, $Cancelled_Cheque_file);
            if ($fileUploaded_Cancelled_Cheque_file) {
                $Cancelled_Cheque = 1;
            }
        } else {
            if ($fm_data->{'Cancelled Cheque File Name'} != '') {
                $Cancelled_Cheque_file = $fm_data->{'Cancelled Cheque File Name'};
                $Cancelled_Cheque = 1;
            } else {
                $Cancelled_Cheque_file = '';
            }
        }
        if ($request->hasFile('Auditor_Certificate_file') || $request->hasFile('Auditor_Certificate_file_Modify')) {
            $file6 = $request->file('Auditor_Certificate_file') ? $request->file('Auditor_Certificate_file') : $request->file('Auditor_Certificate_file_Modify');
            $Auditor_Certificate_file = time() . '-' . $file6->getClientOriginalName();
            $fileUploaded_Auditor_Certificate_file = $file6->move($destinationPath, $Auditor_Certificate_file);
            if ($fileUploaded_Auditor_Certificate_file) {
                $Auditor_Certificate = 1;
            }
        } else {
            if ($fm_data->{'Auditor File Name'} != '') {
                $Auditor_Certificate_file = $fm_data->{'Auditor File Name'};
                $Auditor_Certificate = 1;
            } else {
                $Auditor_Certificate_file = '';
            }
        }
        if ($request->hasFile('Broadcasting_Certificate_file') || $request->hasFile('Broadcasting_Certificate_file_Modify')) {
            $file7 = $request->file('Broadcasting_Certificate_file') ? $request->file('Broadcasting_Certificate_file') : $request->file('Broadcasting_Certificate_file_Modify');
            $Broadcasting_Certificate_file = time() . '-' . $file7->getClientOriginalName();
            $fileUploaded_Broadcasting_Certificate_file = $file7->move(
                $destinationPath,
                $Broadcasting_Certificate_file
            );
            if ($fileUploaded_Broadcasting_Certificate_file) {
                $Broadcasting_Certificate = 1;
            }
        } else {
            if ($fm_data->{'Broadcasting Cert File Name'} != '') {
                $Broadcasting_Certificate_file = $fm_data->{'Broadcasting Cert File Name'};
                $Broadcasting_Certificate = 1;
            } else {
                $Broadcasting_Certificate_file = '';
            }
        }
        if ($request->hasFile('Sr_Management_Attestation_file') || $request->hasFile('Sr_Management_Attestation_file_Modify')) {
            $file8 = $request->file('Sr_Management_Attestation_file') ? $request->file('Sr_Management_Attestation_file') : $request->file('Sr_Management_Attestation_file_Modify');
            $Sr_Management_Attestation_file = time() . '-' . $file8->getClientOriginalName();
            $fileUploaded_Sr_Management_Attestation_file = $file8->move($destinationPath, $Sr_Management_Attestation_file);
            if ($fileUploaded_Sr_Management_Attestation_file) {
                $Sr_Management_Attestation = 1;
            }
        } else {
            if ($fm_data->{'SMA File Name'} != '') {
                $Sr_Management_Attestation_file = $fm_data->{'SMA File Name'};
                $Sr_Management_Attestation = 1;
            } else {
                $Sr_Management_Attestation_file = '';
            }
        }
        if ($request->hasFile('signed_List_file') || $request->hasFile('signed_List_file_Modify')) {
            $file9 = $request->file('signed_List_file') ? $request->file('signed_List_file') : $request->file('signed_List_file_Modify');
            $signed_list_file = time() . '-' . $file9->getClientOriginalName();
            $fileUploaded_signed_list_file = $file9->move($destinationPath, $signed_list_file);
            if ($fileUploaded_signed_list_file) {
                $signed_list = 1;
            }
        } else {
            if ($fm_data->{'Signed List File Name'} != '') {
                $signed_list_file = $fm_data->{'Signed List File Name'};
                $signed_list = 1;
            } else {
                $signed_list_file = '';
            }
        }


        if ($request->hasFile('Bharatkosh_File') || $request->hasFile('Bharatkosh_File_Modify')) {
            $file0 = $request->file('Bharatkosh_File') ? $request->file('Bharatkosh_File') : $request->file('Bharatkosh_File_Modify');
            $bharatkosh_receipt = time() . '-' . $file0->getClientOriginalName();
            $fileUploaded_bharatkosh_receipt = $file0->move($destinationPath, $bharatkosh_receipt);
            if ($fileUploaded_bharatkosh_receipt) {
                $bharatkosh_cert = 1;
            }
        } else {
            if ($fm_data->{'Bharatkosh Receipt File Name'} != '') {
                $bharatkosh_receipt = $fm_data->{'Bharatkosh Receipt File Name'};
                $bharatkosh_cert = 1;
            } else {
                $bharatkosh_receipt = '';
            }
        }

        if (isset($request->Acceptance)) {
            $Acceptance = 1;
        } else {
            $Acceptance = '';
        }
        $update = array(
            'WOL Certificate' => $WOL_Certificate,
            'GOPA Certificate' => $GOPA_Certificate,
            'Undertaking'     => $Undertaking,
            'Cancelled Cheque' => $Cancelled_Cheque,
            'Program Scheduling Certificate' => $Program_Scheduling_Certificate,
            'Auditor Certificate' => $Auditor_Certificate,
            'Sr_ Management Attestation' => $Sr_Management_Attestation,
            'Acceptance'        => $Acceptance,
            'WOL File Name'     => $WOL_Certificate_file,
            'GOPA File Name'    => $GOPA_Certificate_file,
            'Undertaking File Name' => $Undertaking_file,
            'Cancelled Cheque File Name' => $Cancelled_Cheque_file,
            'Program Scheduling File Name' => $Program_Scheduling_Certificate_file,
            'Auditor File Name'    => $Auditor_Certificate_file,
            'SMA File Name'    => $Sr_Management_Attestation_file,
            'Broadcasting Certificate' => $Broadcasting_Certificate,
            'Broadcasting Cert File Name' => $Broadcasting_Certificate_file,
            'Signed List'    => $signed_list,
            'Signed List File Name' => $signed_list_file,
            'Bharatkosh Receipt File Name' => $bharatkosh_receipt,
            'Bharatkosh Receipt Boolean' => $bharatkosh_cert,
            'Modification' => '1'
        );
        $sql5 = DB::table($Vend_Emp_Pvt_FM)
            ->where('FM Station ID', $fm_id)
            ->update($update);
        $msg = 'Data Save Successfully! Please note the ' . $fm_id . ' reference number for future use.';
        if (!$sql5) {
            return $this->sendError('Some Error Occurred!.');
            exit;
        } else {
            return $this->sendResponse($request->FMstatio, $msg);
        }
    }
    /*=====================================================End add document section========================================*/
    /*=======================================================START PVT FM SHOWDATA=============================*/
    public function ShowAllDetails($User_id = '')
    {

        $Pvt_FM_table = 'BOC$Vend Emp - Pvt_ FM$3f88596c-e20d-438c-a694-309eb14559b2';
        $Owner_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $Time_band_table = 'BOC$FM Program Schedule$3f88596c-e20d-438c-a694-309eb14559b2';
        $Payment_table = 'BOC$Vendor Fees$3f88596c-e20d-438c-a694-309eb14559b2';
        $paymentStatus = '';
        $FMdata = DB::table($Pvt_FM_table)              //Show FM  Data
            ->where('User ID', $User_id)
            ->first();
        $FM_owner_ID = @$FMdata->{'Owner ID'};          //Owner Id
        $FM_Radio_id = @$FMdata->{'FM Station ID'};    //FM Radio Station Id
        $OD_owners = DB::table($Owner_table)
            ->where('Owner ID', $FM_owner_ID)
            ->first();
        $Time_band = DB::table($Time_band_table)         //Show Time Band Data
            ->where('Station ID', $FM_Radio_id)
            ->first();
        if (!empty($FM_Radio_id)) {
            $FM_Payment_Status = DB::table($Payment_table)->select('Status')->where('Media ID', $FM_Radio_id)->first();
            $paymentStatus = $FM_Payment_Status->Ststus ?? 'Pending';
        }
        $response  = [
            'FMdata' => $FMdata,
            'OD_owners' => $OD_owners,
            'Time_band' => $Time_band,
            'Payment_Status' => $paymentStatus
        ];
        return $response;
    }
    /*=============================ENT PVT FM SHOWDATA=============================*/
}
