<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use DB;
use Carbon\Carbon;
use App\Models\Api\PrivateMedia;
use App\Models\Api\ApiFreshEmpanelment;
use App\Models\Api\RateSettlementPersonalMedia;
use Session;

class RateSettlementPrivateMediaController extends Controller
{
    use CommonTrait;

    public function privateMediaSave(Request $request)
    {
        $table1 = '[BOC$Owner]';
        $unique_id = array();
        $userid = Session::get('UserID');
        //dd($userid);
        // $ownerids = explode(",",$request->ownerid[0]);
        if (($request->email_owner) >= 0) {
            foreach ($request->email_owner as $key => $value) {
                //  if(@$ownerids[$key] == null || @$ownerids[$key] == '')
                if ($request->ownerid == '' || $request->ownerid == null) {
                    $owner_id
                        = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner] order by [Owner ID] desc');
                    if (empty($owner_id)) {
                        $owner_id = 'EMPOW1';
                    } else {
                        $owner_id = $owner_id[0]->{"Owner ID"};
                        $owner_id++;
                    }

                    $owner_name =
                        isset($request->owner_name[$key]) ? $request->owner_name[$key] : '';
                    $mobile =
                        isset($request->mobile_owner[$key]) ? $request->mobile_owner[$key] : '';
                    $email =
                        isset($request->email_owner[$key]) ? $request->email_owner[$key] : '';
                    $phone =
                        isset($request->phone[$key]) ? $request->phone[$key] : '';
                    $fax_no =
                        isset($request->fax_no[$key]) ? $request->fax_no[$key] : '';
                    $address =
                        isset($request->address_owner[$key]) ? $request->address_owner[$key] : '';
                    $city =
                        isset($request->city[$key]) ? $request->city[$key] : '';
                    $district =
                        isset($request->district_owner[$key]) ? $request->district_owner[$key] : '';
                    $state =
                        isset($request->state_owner[$key]) ? $request->state_owner[$key] : '';
                    $user_id = Session::get('UserID');
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
                        '','','','','','','','',
                        '','','','" . $user_id . "',
                        '','','','','','','','','','','','','','','','','',
                        '','','','','','','','','','',0
                        )"
                    );

                    $unique_id[] = $owner_id;
                    $msg = 'Owner data Saved Successfully!';
                } else {

                    // $owner_id = @$ownerids[$key];
                    $owner_id = $request->ownerid;
                    $Owner_table = 'BOC$Owner';
                    // $request->phone = $request->phone[$key] ?? '';
                    // dd($request->phone[$key]);
                    // $request->fax_no = $request->fax_no[$key] ?? '';
                    $update = array(
                        'Owner Name' => $request->owner_name[$key],
                        'Mobile No_' => $request->mobile_owner[$key],
                        'Email ID' => $request->email_owner[$key],
                        'Phone No_' => $request->phone[$key] ?? '',
                        'Fax No_' => $request->fax_no[$key] ?? '',
                        'Address 1' => $request->address_owner[$key],
                        'City' => $request->city[$key],
                        'District' => $request->district_owner[$key],
                        'State' => $request->state_owner[$key],

                    );
                    $where = array('Owner ID' => $owner_id);
                    $sql = PrivateMedia::updateAllRecords($Owner_table, $update, $where);
                    $unique_id[] = $owner_id;
                    $msg = 'Owner data Updated Successfully!';
                }
            }
        }


        if ($sql) {
            //$unique_id = array('Owner_ID' => $owner_id);
            return $this->sendResponse($unique_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }

    public function savevendordata(Request $request)
    { //dd($request);
        $userid = Session::get('UserID');
        // $ownerids = explode(",", $request->ownerid[0]);
        $unique_id = array();
        $msg = '';
        $lineno1 = [];
        $lineno2 = [];

        $table1 = '[BOC$Owner]';
        $table3 = '[BOC$OD Media Owner Detail]';
        $od_media_category = 1;
        if ($request->vendorid_tab_2 == '') {
            $od_media_category = 1;
            $destinationPath = public_path() . '/uploads/private-media/';
            $odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media] order by [OD Media ID] desc');
            if (empty($odmedia_id)) {
                $odmedia_id = 'POD00001';
            } else {
                $odmedia_id = $odmedia_id[0]->{"OD Media ID"};
                $odmedia_id++;
            }

            $Notarized_Copy_Of_Agreement = 0;
            $Attach_Copy_Of_Pan_Number = 0;
            $Affidavit_Of_Oath = 0;
            $Photographs = 0;
            $Company_Legal_Documents = 0;
            $GST_Registration = 0;
            $CA_Certified_Balance_Sheet = 0;

            if ($request->hasFile('Notarized_Copy_File_Name')) {
                $file = $request->file('Notarized_Copy_File_Name');
                $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
                if ($fileUploaded) {
                    $Notarized_Copy_Of_Agreement = 1;
                }
            } else {
                $Notarized_Copy_File_Name = '';
            }
            if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name')) {
                $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name');
                $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
                if ($fileUploaded) {
                    $Attach_Copy_Of_Pan_Number = 1;
                }
            } else {
                $Attach_Copy_Of_Pan_Number_File_Name = '';
            }
            if ($request->hasFile('Affidavit_File_Name')) {
                $file = $request->file('Affidavit_File_Name');
                $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
                if ($fileUploaded) {
                    $Affidavit_Of_Oath = 1;
                }
            } else {
                $Affidavit_File_Name = '';
            }
            if ($request->hasFile('Photo_File_Name')) {
                $file = $request->file('Photo_File_Name');
                $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
                if ($fileUploaded) {
                    $Photographs = 1;
                }
            } else {
                $Photo_File_Name = '';
            }
            if ($request->hasFile('Legal_Doc_File_Name')) {
                $file = $request->file('Legal_Doc_File_Name');
                $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
                if ($fileUploaded) {
                    $Company_Legal_Documents = 1;
                }
            } else {
                $Legal_Doc_File_Name = '';
            }
            if ($request->hasFile('GST_File_Name')) {

                $file = $request->file('GST_File_Name');
                $GST_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $GST_File_Name);
                if ($fileUploaded) {
                    $GST_Registration = 1;
                }
            } else {
                $GST_File_Name = '';
            }
            if ($request->hasFile('Balance_Sheet_File_Name')) {
                $file = $request->file('Balance_Sheet_File_Name');
                $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
                $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
                if ($fileUploaded) {
                    $CA_Certified_Balance_Sheet = 1;
                }
            } else {
                $Balance_Sheet_File_Name = '';
            }

            if ($request->self_declaration == "on" || $request->self_declaration == "On" || $request->self_declaration == "ON") {
                $Self_declaration = 1;
            } else {
                $Self_declaration = 0;
            }

            $HO_Address =
                isset($request->HO_Address) ? $request->HO_Address : '';
            $HO_Landline_No =
                isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
            $HO_Fax_No =
                isset($request->HO_Fax_No) ? $request->HO_Fax_No : '';
            $HO_Email =
                isset($request->HO_Email) ? $request->HO_Email : '';
            $HO_Mobile_No =
                isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
            $BO_Address =
                isset($request->BO_Address) ? $request->BO_Address : '';
            $BO_Landline_No =
                isset($request->BO_Landline_No) ? $request->BO_Landline_No : '';
            $BO_Fax_No =
                isset($request->BO_Fax_No) ? $request->BO_Fax_No : '';
            $BO_Email =
                isset($request->BO_Email) ? $request->BO_Email : '';
            $BO_Mobile =
                isset($request->BO_Mobile) ? $request->BO_Mobile : '';
            $DO_Address =
                isset($request->DO_Address) ? $request->DO_Address : '';
            $DO_Landline_No =
                isset($request->BO_DO_Landline_NoMobile) ? $request->DO_Landline_No : '';
            $DO_Fax_No =
                isset($request->DO_Fax_No) ? $request->DO_Fax_No : '';
            $DO_Email =
                isset($request->DO_Email) ? $request->DO_Email : '';
            $DO_Mobile =
                isset($request->DO_Mobile) ? $request->DO_Mobile : '';
            $Authorized_Rep_Name =
                isset($request->Authorized_Rep_Name) ? $request->Authorized_Rep_Name : '';
            $AR_Address =
                isset($request->AR_Address) ? $request->AR_Address : '';
            $AR_Landline_No =
                isset($request->AR_Landline_No) ? $request->AR_Landline_No : '';
            $AR_FAX_No =
                isset($request->AR_FAX_No) ? $request->AR_FAX_No : '';
            $AR_Email =
                isset($request->AR_Email) ? $request->AR_Email : '';
            $AR_Mobile_No =
                isset($request->AR_Mobile_No) ? $request->AR_Mobile_No : '';
            $Legal_Status_of_Company =
                isset($request->Legal_Status_of_Company) ? $request->Legal_Status_of_Company : 0;
            $Authority_Which_granted_Media =
                isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';
            $Amount_paid_to_Authority =
                isset($request->Amount_paid_to_Authority) ? $request->Amount_paid_to_Authority : 0;

            $Contract_No =
                isset($request->Contract_No) ? $request->Contract_No : '';
            $License_Fee =
                isset($request->License_Fee) ? $request->License_Fee : 0;
            $Quantity_Of_Display =
                isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =
                isset($request->License_From) ? date("Y-m-d", strtotime($request->License_From)) : '';
            $License_To =
                isset($request->License_To) ? date("Y-m-d", strtotime($request->License_To)) : '';
            $Media_Type =
                isset($request->Media_Type) ? $request->Media_Type : '1753-01-01';
            $Rental_Agreement =
                isset($request->Rental_Agreement) ? $request->Rental_Agreement : 0;
            $Applying_For_OD_Media_Type =
                isset($request->Applying_For_OD_Media_Type) ? $request->Applying_For_OD_Media_Type : 0;
            $ODMFO_Display_Size_Of_Media =
                isset($request->ODMFO_Display_Size_Of_Media) ? $request->ODMFO_Display_Size_Of_Media : 0;
            $Illumination_media =
                isset($request->Illumination_media) ? $request->Illumination_media : 0;
            $GST_No =
                isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =
                isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $Other_Relevant_Information =
                isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';
            $DD_No =
                isset($request->DD_No) ? $request->DD_No : '';
            $DD_Date =
                isset($request->DD_Date) ? date("Y-m-d", strtotime($request->DD_Date)) : '';
            $DD_Bank_Name =
                isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
            $DD_Bank_Branch_Name =
                isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
            $Application_Amount =
                isset($request->Application_Amount) ? $request->Application_Amount : 0;
            $PM_Agency_Name =
                isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
            $PAN =
                isset($request->PAN) ? $request->PAN : '';
            $Bank_Name =
                isset($request->Bank_Name) ? $request->Bank_Name : '';
            $Bank_Branch =
                isset($request->Bank_Branch) ? $request->Bank_Branch : '';
            $IFSC_Code =
                isset($request->IFSC_Code) ? $request->IFSC_Code : '';
            $Account_No =
                isset($request->Account_No) ? $request->Account_No : '';

                //Get value for Receiver ID.
                $receiver_table = '[BOC$Media Plan Setup]';
                $get_receiver_code = DB::select("select TOP 1 [OD Vend Landing UID] from dbo.$receiver_table");
                $recervier_id = $get_receiver_code[0]->{"OD Vend Landing UID"};
                // $recervier_id = "MKTA";
            $table2 = '[BOC$Vendor Emp - OD Media]';
            $sql2 =
                DB::insert("insert into $table2
        (
         [timestamp],
          [OD Category],
          [OD Media ID],
          [HO Address],
          [HO Landline No_],
          [HO Fax No_],
          [HO E-Mail],
          [HO Mobile No_],
          [BO Address],
          [BO Landline No_],
          [BO Fax No_],
          [BO E-Mail],
          [BO Mobile No_],
          [DO Address],
          [DO Landline No_],
          [DO Fax No_],
          [DO E-Mail],
          [DO Mobile No_],
          [Authorized Rep Name],
          [AR Address],
          [AR Landline No_],
          [AR FAX No_],
          [AR E-mail],
          [AR Mobile No_],
          [Legal Status of Company],
          [Authority Which granted Media],
          [Amount paid to Authority],
          [Contract No_],
          [License Fees],
          [Quantity Of Display],
          [License From],
          [License To],
          [Duration],
          [Rental Agreement],
          [Applying For OD Media Type],
          [Media Display size],
          [Illumination],
          [GST No_],
          [TIN_TAN_VAT No_],
          [Other Relevant Information],
          [DD No_],
          [DD Date],
          [DD Bank Name],
          [DD Bank Branch Name],
          [Application Amount],
          [PM Agency Name],
          [PAN],
          [Bank Name],
          [Bank Branch],
          [IFSC Code],
          [Account No_],
          [Notarized Copy File Name],
          [PAN File Name],
          [Affidavit File Name],
          [Photo File Name],
          [Legal Doc File Name],
          [GST File Name],
          [Balance Sheet File Name],
          [Notarized Copy Of Agreement],
          [PAN Attached],
          [Affidavit Of Oath],
          [Photographs],
          [Company Legal Documents],
          [GST Registration],
          [CA Certified Balance Sheet],
          [Self-declaration],
          [Status],
          [User ID],
          [Global Dimension 1 Code],
          [Global Dimension 2 Code],
          [Sender ID],
          [Receiver ID],
          [Recommended To Committee],
          [Modification],
          [Media Sub Category],
          [Rate],
          [Rate Status],
          [Rate Remark],
          [Rate Status Date],
          [Agr File Path],
          [Agr File Name],
          [Allocated Vendor Code],
          [Document Date],
          [Empanelment Category],
          [From Date],
          [To Date]
        
        )
        values
        (
            DEFAULT,
            $od_media_category,
            '" . $odmedia_id . "',
            '" . $HO_Address . "',
            '" . $HO_Landline_No . "',
            '" . $HO_Fax_No . "',
            '" . $HO_Email . "',
            '" . $HO_Mobile_No . "',
            '" . $BO_Address . "',
            '" . $BO_Landline_No . "',
            '" . $BO_Fax_No . "',
            '" . $BO_Email . "',
            '" . $BO_Mobile . "',
            '" . $DO_Address . "',
            '" . $DO_Landline_No . "',
            '" . $DO_Fax_No . "',
            '" . $DO_Email . "',
            '" . $DO_Mobile . "',
            '" . $Authorized_Rep_Name . "',
            '" . $AR_Address . "',
            '" . $AR_Landline_No . "',
            '" . $AR_FAX_No . "',
            '" . $AR_Email . "',
            '" . $AR_Mobile_No . "',
            $Legal_Status_of_Company,
            '" . $Authority_Which_granted_Media . "',
            $Amount_paid_to_Authority,
            '" . $Contract_No . "',
            $License_Fee,
            $Quantity_Of_Display,
            '" . $License_From . "',
            '" . $License_To . "',
            $Media_Type,
            $Rental_Agreement,
            $Applying_For_OD_Media_Type,
             $ODMFO_Display_Size_Of_Media,
             $Illumination_media,
            '" . $GST_No . "',
            '" . $TIN_TAN_VAT_No . "',
            '" . $Other_Relevant_Information . "',
            '" . $DD_No . "',
            '" . $DD_Date . "',
            '" . $DD_Bank_Name . "',
            '" . $DD_Bank_Branch_Name . "',
            $Application_Amount,
            '" . $PM_Agency_Name . "',
            '" . $PAN . "',
            '" . $Bank_Name . "',
            '" . $Bank_Branch . "',
            '" . $IFSC_Code . "',
            '" . $Account_No . "',
            '" . $Notarized_Copy_File_Name . "',
            '" . $Attach_Copy_Of_Pan_Number_File_Name . "',
            '" . $Affidavit_File_Name . "',
            '" . $Photo_File_Name . "',
            '" . $Legal_Doc_File_Name . "',
            '" . $GST_File_Name . "',
            '" . $Balance_Sheet_File_Name . "',
            $Notarized_Copy_Of_Agreement,
            $Attach_Copy_Of_Pan_Number,
            $Affidavit_Of_Oath,
            $Photographs,
            $Company_Legal_Documents,
            $GST_Registration,
            $CA_Certified_Balance_Sheet,
            $Self_declaration,
            0,'" . $userid . "',
            'M003',
            '',
            '',
            '".$recervier_id."',
            0,
            1,
            '',
            0,
            0,
            '',
            '1753-01-01',
            '',
            '',
            '',
            '1753-01-01',
            1,
            '1753-01-01 00:00:00.000',
            '1753-01-01 00:00:00.000'

        )");

            // foreach ($ownerids as $owner) {
            $owner_id = $request->ownerid ?? '';
            $sql3 =  DB::insert("insert into $table3
                (
                    [timestamp],
                    [OD Media Type],
                    [OD Media ID],
                    [Owner ID],
                    [Allocated Vendor Code]
                )
                values
                (
                    DEFAULT,
                        $od_media_category,
                    '" . $odmedia_id . "',
                    '" . $owner_id . "',
                    ''
                )");
            //  }

            //media work donedata   save
            $table4 = '[BOC$OD Media Work done]';
            if (count($request->ODMFO_Year) > 0) {
                //$data=array();

                $dataFile = array();
                $File_Uploaded_Status = 0;

                if ($request->hasfile('ODMFO_Upload_Document')) {

                    foreach ($request->file('ODMFO_Upload_Document') as $file) {
                        $fileName = time() . '-' . $file->getClientOriginalName();
                        $fileUploaded = $file->move(public_path() . '/uploads/private-media/', $fileName);
                        if ($fileUploaded) {
                            $File_Uploaded_Status = 1;
                            $dataFile['Upload_Document_FileName'][] = $fileName;
                        }
                    }
                } else {
                    $dataFile['Upload_Document_FileName'] = '';
                }

                foreach ($request->ODMFO_Year as $key => $value) {

                    $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");

                    if (empty($line_no)) {

                        $line_no = 10000;
                    } else {

                        $line_no = $line_no[0]->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }
                    $workName =
                        isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;

                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $Document_FileName =
                        isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                    $sql4 =
                        DB::insert("insert into $table4
                    (
                    [timestamp],
                    [OD Media Type],
                    [OD Media ID],
                    [Line No_],
                    [Work Name],
                    [Year],
                    [Qty Of Display_Duration],
                    [Billing Amount],
                    [File Name],
                    [File Uploaded],
                    [Allocated Vendor Code]
                    )
                    values
                    (
                    DEFAULT,
                    $od_media_category,
                    '" . $odmedia_id . "',
                    $line_no,
                    '" . $workName . "',
                    '" . $ODMFO_Year . "',
                    $ODMFO_Quantity_Of_Display_Or_Duration,
                    $ODMFO_Billing_Amount,
                    '" . $Document_FileName . "',
                    $File_Uploaded_Status,
                    ''

                )");
                    // $lineno2[] = $line_no;

                    // $request->session()->put('lineno2', $lineno2);
                    //dd($sql4);
                }
                if (!$sql4) {
                    return $this->sendError('Some Error Occurred!.');
                    exit;
                }
            }

            $table5 = '[BOC$Sole Medias Address]';
            if (count($request->MA_City) > 0) {


                foreach ($request->MA_City as $key => $value) {

                    $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");

                    if (empty($line_no)) {

                        $line_no = 10000;
                    } else {

                        $line_no = $line_no[0]->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }


                    $MA_City =
                        isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';

                    $MA_State  =
                        isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                    $MA_District =
                        isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';

                    $MA_Zone =
                        isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;
                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : '';
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';

                    $sql5 =
                        DB::insert("insert into $table5
                    (
                    [timestamp],
                    [OD Media Type],
                    [Sole Media ID],
                    [Line No_],
                    [City],
                    [State],
                    [District],
                    [Zone],
                    [Latitude],
                    [Longitde],
                    [Landmark],
                    [Image File Name],
                    [OD Media ID],
                    [Display Size],
                    [Illumination Type],
                    [Availability Start Date],
                    [Availability End Date],
                    [Length],
                    [Width],
                    [Total Area],
                    [Rental],
                    [Rental Type],
                    [Quantity]
                    )
                    values
                    (
                    DEFAULT,
                    $od_media_category,
                    '" . $odmedia_id . "',
                    $line_no,
                    '" . $MA_City . "',
                    '" . $MA_State . "',
                    '" . $MA_District . "',
                    $MA_Zone,
                    $MA_Latitude,
                    $MA_Longitude,
                    '" . $MA_Property_Landmark . "',
                    '" . $Image_File_Name . "',
                    '',0,0,'1753-01-01','1753-01-01',
                    0,0,0,0,0,0
                )");
                    $lineno1[] = $line_no;
                }
                if (!$sql5) {
                    return $this->sendError('Some Error Occurred!.');
                    exit;
                }
            }

            $msg = 'Data Save Successfully!';
            $unique_id =  $odmedia_id;
        } else {

            // $lineno1 = explode(",", $request->lineno1[0]);
            // $lineno2 = explode(",", $request->lineno2[0]);

            // $table6 = 'BOC$OD Media Work done';
            $odmedia_id = $request->vendorid_tab_2;
            if (count($request->ODMFO_Year) > 0) {
                $table6 = '[BOC$OD Media Work done]';
                $table5 = 'BOC$OD Media Work done';
                $line_no_val = DB::select("select [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "'");

                $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                if ($linenn_no > 0) {
                    DB::table($table5)->where('OD Media ID', $odmedia_id)->delete();
                }
                foreach ($request->ODMFO_Year as $key => $value) { //ram code start

                    $Document_FileName = '';
                    $File_Uploaded_Status = 0;
                    //  dd($request->file('ODMFO_Upload_Document'));
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
                        //dd($request->ODMFO_Upload_Document_);
                        if (array_key_exists($key, $request->ODMFO_Upload_Document_)) {
                            $Document_FileName = $request->ODMFO_Upload_Document_[$key];
                        } else {
                            $Document_FileName = '';
                        }
                    }

                    $ODMFO_Year  =
                        isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                    $ODMFO_Quantity_Of_Display_Or_Duration =
                        isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                    $ODMFO_Billing_Amount =
                        isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                    $allocated_vendor_code = isset($request->allocated_vendor_code[$key]) ? $request->allocated_vendor_code[$key] : '';
                    $unique_id = $odmedia_id;
                    $msg = 'Private Media Vender Data Updated Successfully!';
                    // } else {

                    $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                    $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                    if (empty($next_line_no)) {
                        $next_line_no = 10000;
                    } else {
                        $next_line_no = $next_line_no[0]->{"Line No_"};
                        $next_line_no = $next_line_no + 10000;
                    }

                    DB::unprepared('SET ANSI_WARNINGS OFF');

                    $sql4 = DB::insert(
                        "insert into $table6 
                        ([timestamp],
                        [OD Media Type],
                        [OD Media ID],
                        [Line No_],
                        [Work Name],
                        [Year],
                        [Qty Of Display_Duration],
                        [Billing Amount],
                        [File Name],
                        [File Uploaded],
                        [Allocated Vendor Code]
                        ) values(DEFAULT,
                        $od_media_category,
                        '" . $odmedia_id . "',
                        $next_line_no,
                        '" . $workName . "',
                        '" . $ODMFO_Year . "',
                        $ODMFO_Quantity_Of_Display_Or_Duration,$ODMFO_Billing_Amount,
                        '" . $Document_FileName . "',
                        $File_Uploaded_Status,
                        '" . $allocated_vendor_code . "'
                        )"
                    );

                    DB::unprepared('SET ANSI_WARNINGS ON');
                    // }
                } //ram code end
            }

            $table5 = '[BOC$Sole Medias Address]';
            $table55 = 'BOC$Sole Medias Address';

            if (count($request->MA_City) > 0) {
                $check = DB::table($table55)->where('Sole Media ID', $odmedia_id)->first();
                if ($check) {
                    DB::table($table55)->where('Sole Media ID', $odmedia_id)->delete();
                }
                foreach ($request->MA_City as $key => $value) {

                    // $line_no = DB::select("select TOP 1 [Line No_] from $table55 where [Sole Media ID] = '".$odmedia_id."' order by [Line No_] desc");
                    $line_no = DB::table($table55)->select('Line No_')->where('Sole Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();

                    if (empty($line_no)) {

                        $line_no = 10000;
                    } else {

                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }
                    $MA_City =
                        isset($request->MA_City[$key]) ? $request->MA_City[$key] : '';

                    $MA_State  =
                        isset($request->MA_State[$key]) ? $request->MA_State[$key] : '';
                    $MA_District =
                        isset($request->MA_District[$key]) ? $request->MA_District[$key] : '';

                    $MA_Zone =
                        isset($request->MA_Zone[$key]) ? $request->MA_Zone[$key] : 0;
                    $MA_Latitude =
                        isset($request->MA_Latitude[$key]) ? $request->MA_Latitude[$key] : 0;
                    $MA_Longitude =
                        isset($request->MA_Longitude[$key]) ? $request->MA_Longitude[$key] : 0;
                    $MA_Property_Landmark =
                        isset($request->MA_Property_Landmark[$key]) ? $request->MA_Property_Landmark[$key] : '';
                    $Image_File_Name =
                        isset($request->Image_File_Name[$key]) ? $request->Image_File_Name[$key] : '';
                    // $line_exit ="select [Line No_] from $table5 where [Sole Media ID] = '".$odmedia_id."' AND  [Line No_] ='".@$lineno1[$key]."'";

                    $sql5 = DB::insert("insert into $table5
                    (
                    [timestamp],
                    [OD Media Type],
                    [Sole Media ID],
                    [Line No_],
                    [City],
                    [State],
                    [District],
                    [Zone],
                    [Latitude],
                    [Longitde],
                    [Landmark],
                    [Image File Name],
                    [OD Media ID],
                    [Display Size],
                    [Illumination Type],
                    [Availability Start Date],
                    [Availability End Date],
                    [Length],
                    [Width],
                    [Total Area],
                    [Rental],
                    [Rental Type],
                    [Quantity]
                    )
                    values
                    (
                    DEFAULT,
                    $od_media_category,
                    '" . $odmedia_id . "',
                    $line_no,
                    '" . $MA_City . "',
                    '" . $MA_State . "',
                    '" . $MA_District . "',
                    $MA_Zone,
                    $MA_Latitude,
                    $MA_Longitude,
                    '" . $MA_Property_Landmark . "',
                    '" . $Image_File_Name . "',
                    '',0,0,'1753-01-01','1753-01-01',
                    0,0,0,0,0,0
                    )");
                    $unique_id = $odmedia_id;
                    $msg = 'Data Updated Successfully!';
                }
            }

            $HO_Address =
                isset($request->HO_Address) ? $request->HO_Address : '';
            $HO_Landline_No =
                isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
            $HO_Fax_No =
                isset($request->HO_Fax_No) ? $request->HO_Fax_No : '';
            $HO_Email =
                isset($request->HO_Email) ? $request->HO_Email : '';
            $HO_Mobile_No =
                isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
            $BO_Address =
                isset($request->BO_Address) ? $request->BO_Address : '';
            $BO_Landline_No =
                isset($request->BO_Landline_No) ? $request->BO_Landline_No : '';
            $BO_Fax_No =
                isset($request->BO_Fax_No) ? $request->BO_Fax_No : '';
            $BO_Email =
                isset($request->BO_Email) ? $request->BO_Email : '';
            $BO_Mobile =
                isset($request->BO_Mobile) ? $request->BO_Mobile : '';
            $Authorized_Rep_Name =
                isset($request->Authorized_Rep_Name) ? $request->Authorized_Rep_Name : '';
            $AR_Address =
                isset($request->AR_Address) ? $request->AR_Address : '';
            $AR_Landline_No =
                isset($request->AR_Landline_No) ? $request->AR_Landline_No : '';
            $AR_FAX_No =
                isset($request->AR_FAX_No) ? $request->AR_FAX_No : '';
            $AR_Email =
                isset($request->AR_Email) ? $request->AR_Email : '';
            $AR_Mobile_No =
                isset($request->AR_Mobile_No) ? $request->AR_Mobile_No : '';
            $Legal_Status_of_Company =
                isset($request->Legal_Status_of_Company) ? $request->Legal_Status_of_Company : 0;
            $Authority_Which_granted_Media =
                isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';

            $Contract_No =
                isset($request->Contract_No) ? $request->Contract_No : '';
            $Quantity_Of_Display =
                isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =
                isset($request->License_From) ? date("Y-m-d", strtotime($request->License_From)) : '';
            $License_To =
                isset($request->License_To) ? date("Y-m-d", strtotime($request->License_To)) : '';
            $Applying_For_OD_Media_Type =
                isset($request->Applying_For_OD_Media_Type) ? $request->Applying_For_OD_Media_Type : 0;
            $GST_No =
                isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =
                isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $Other_Relevant_Information =
                isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';


            $table2 = 'BOC$Vendor Emp - OD Media';

            $update = array(
                'HO Address' => $HO_Address,
                'HO Landline No_' => $HO_Landline_No,
                'HO Fax No_' => $HO_Fax_No,
                'HO E-Mail' => $HO_Email,
                'HO Mobile No_' => $HO_Mobile_No,
                'BO Address' => $BO_Address,
                'BO Landline No_' => $BO_Landline_No,
                'BO Fax No_' => $BO_Fax_No,
                'BO E-Mail' => $BO_Email,
                'BO Mobile No_' => $BO_Mobile,
                'Authorized Rep Name' => $Authorized_Rep_Name,
                'AR Address' => $AR_Address,
                'AR Landline No_' => $AR_Landline_No,
                'AR FAX No_' => $AR_FAX_No,
                'AR E-mail' => $AR_Email,
                'AR Mobile No_' => $AR_Mobile_No,
                'Legal Status of Company' => $Legal_Status_of_Company,
                'Authority Which granted Media' => $Authority_Which_granted_Media,
                'Contract No_' => $Contract_No,
                'Quantity Of Display' => $Quantity_Of_Display,
                'License From' => $License_From,
                'License To' => $License_To,
                'Applying For OD Media Type' => $Applying_For_OD_Media_Type,
                'GST No_' => $GST_No,
                'TIN_TAN_VAT No_' => $TIN_TAN_VAT_No,
                'Other Relevant Information' => $Other_Relevant_Information,
            );
            $where = array('OD Media ID' => $odmedia_id);
            $sql2 = PrivateMedia::updateAllRecords($table2, $update, $where);

            $table31 = 'BOC$OD Media Owner Detail';
            $owner_id = $request->ownerid ?? '';
            $update1 = array('Owner ID' => $owner_id);
            $sql21 = ApiFreshEmpanelment::updateAllRecords($table31, $update1, $where);

            $unique_id = $odmedia_id;
            $msg = 'Data Updated Successfully!';
        }

        if (!$sql2 && !$sql4 && !$sql5) {
            return $this->sendError('Some Error Occurred!.');
            exit;
        } else {
            $lin1 = $request->session()->get('lineno1');
            $lin2 = $request->session()->get('lineno2');
            $allIDs = [
                'unique_id' => $unique_id,
                'lineno1' => $lineno1,
                'lineno2' => $lineno2
            ];
            return $this->sendResponse($allIDs,  $msg);
        }
    }
    // public function pivateMediaSaveVendorAccount(Request $request)
    //  {
    //     $vendor_table = 'BOC$Vendor Emp - OD Media';
    //      //$odmediaid = $request->odmediaid ?? '';
    //      $od_media = $request->vendorid_tab_2;
    //      $odmedia_id = $request->vendorid_tab_3 ?? '';

    //      // account information variable
    //      $DD_No=
    //           isset($request->DD_No) ? $request->DD_No :'';
    //      $DD_Date=
    //           isset($request->DD_Date) ? date("Y-m-d", strtotime($request->DD_Date)) :'';
    //      $DD_Bank_Name=
    //           isset($request->DD_Bank_Name) ? $request->DD_Bank_Name :'';
    //      $DD_Bank_Branch_Name=
    //           isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name :'';
    //      $Application_Amount=
    //           isset($request->Application_Amount) ? $request->Application_Amount :0;
    //      $PM_Agency_Name=
    //           isset($request->PM_Agency_Name) ? $request->PM_Agency_Name :'';
    //      $PAN=
    //           isset($request->PAN) ? $request->PAN :'';
    //      $Bank_Name=
    //           isset($request->Bank_Name) ? $request->Bank_Name :'';
    //      $Bank_Branch=
    //           isset($request->Bank_Branch) ? $request->Bank_Branch :'';
    //      $IFSC_Code=
    //           isset($request->IFSC_Code) ? $request->IFSC_Code :'';
    //      $Account_No=
    //           isset($request->Account_No) ? $request->Account_No :'';
    //    if($request->PM_Agency_Name!= ''){
    //       $update=array(
    //          'PM Agency Name' =>$request->PM_Agency_Name,
    //          'PAN' =>$request->PAN,
    //          'Bank Name' =>$request->Bank_Name,
    //          'Bank Branch' =>$request->Bank_Branch,
    //          'IFSC Code' =>$request->IFSC_Code,
    //          'Account No_' =>$request->Account_No,
    //      );
    //    }else{
    //          $update = array(
    //          'DD No_' =>$request->DD_No,
    //          'DD Date' =>$request->DD_Date,
    //          'DD Bank Name' =>$request->DD_Bank_Name,
    //          'DD Bank Branch Name' =>$request->DD_Bank_Branch_Name,
    //          'Application Amount' =>$request->Application_Amount,
    //      );
    //    }
    //      $where = array('OD Category' => 1, 'OD Media ID' => $od_media);
    //      // dd($where);
    //      $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);

    //      // dd($where);
    //      if ($sql1) {
    //          //return $this->sendResponse($unique_id, $msg);

    //          return $this->sendResponse($odmedia_id, 'Data Save Successfully! Please note the ' . $odmedia_id. ' reference number for future use.');
    //      } else {
    //          return $this->sendError('Some Error Occurred!.');
    //          exit;
    //      }
    //  }

    public function pivateMediaSaveVendorAccount(Request $request)
    {
        // dd($request->Account_No);
        $vendor_table = 'BOC$Vendor Emp - OD Media';
        //$odmediaid = $request->odmediaid ?? '';
        $od_media = $request->vendorid_tab_2;
        // dd($od_media);
        $odmedia_id = $request->vendorid_tab_3 ?? '';
        $DD_No =
            isset($request->DD_No) ? $request->DD_No : '';
        $DD_Date =
            isset($request->DD_Date) ? date("Y-m-d", strtotime($request->DD_Date)) : '';
        $DD_Bank_Name =
            isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
        $DD_Bank_Branch_Name =
            isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
        $Application_Amount =
            isset($request->Application_Amount) ? $request->Application_Amount : 0;
        $PM_Agency_Name =
            isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
        $PAN =
            isset($request->PAN) ? $request->PAN : '';
        $Bank_Name =
            isset($request->Bank_Name) ? $request->Bank_Name : '';
        $Bank_Branch =
            isset($request->Bank_Branch) ? $request->Bank_Branch : '';
        $IFSC_Code =
            isset($request->IFSC_Code) ? $request->IFSC_Code : '';
        $Account_No =
            isset($request->Account_No) ? $request->Account_No : '';
        $update = array(
            'PM Agency Name' => $request->PM_Agency_Name,
            'PAN' => $request->PAN,
            'Bank Name' => $request->Bank_Name,
            'Bank Branch' => $request->Bank_Branch,
            'IFSC Code' => $request->IFSC_Code,
            'Account No_' => $request->Account_No,
            //'DD No_' => $request->DD_No,
            //'DD Date' => $request->DD_Date,
            //'DD Bank Name' => $request->DD_Bank_Name,
            // 'DD Bank Branch Name' => $request->DD_Bank_Branch_Name,
            // 'Application Amount' => $request->Application_Amount,
        );

        $where = array('OD Category' => 1, 'OD Media ID' => $od_media);
        // dd($where);
        $sql1 = PrivateMedia::updateAllRecords($vendor_table, $update, $where);
        // dd($sql1);
        // dd($where);
        if ($sql1) {
            //return $this->sendResponse($unique_id, $msg);

            return $this->sendResponse($odmedia_id, 'Data Save Successfully! Please note the ' . $odmedia_id . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }


    public function privateMediaSaveVendorDocs(Request $request)
    {

        $msg = "";
        $odmedia_id = $request->vendorid_tab_2;
        $destinationPath = public_path() . '/uploads/private-media/';
        $Notarized_Copy_Of_Agreement = 0;
        $Attach_Copy_Of_Pan_Number = 0;
        $Affidavit_Of_Oath = 0;
        $Photographs = 0;
        $Company_Legal_Documents = 0;
        $GST_Registration = 0;
        $CA_Certified_Balance_Sheet = 0;
        $Status = 1;


        $mtable = 'BOC$Vendor Emp - OD Media';
        $mod = DB::table($mtable)->where('OD Media ID', $odmedia_id)->first();


        $Notarized_Copy_File_Name = $mod->{'Notarized Copy File Name'} ?? '';

        if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
            $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
            $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
            if ($fileUploaded) {
                $Notarized_Copy_Of_Agreement = 1;
            }
        } else {
            $Notarized_Copy_File_Name = $Notarized_Copy_File_Name;
        }
        // dd($Notarized_Copy_File_Name);
        $Attach_Copy_Of_Pan_Number_File_Name = $mod->{'PAN File Name'} ?? '';
        if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
            $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
            $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
            if ($fileUploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            }
        } else {
            $Attach_Copy_Of_Pan_Number_File_Name = $Attach_Copy_Of_Pan_Number_File_Name;
        }


        $Affidavit_File_Name = $mod->{'Affidavit File Name'} ?? '';
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($fileUploaded) {
                $Affidavit_Of_Oath = 1;
            }
        } else {
            $Affidavit_File_Name = $Affidavit_File_Name;
        }
        $Photo_File_Name = $mod->{'Photo File Name'} ?? '';
        if ($request->hasFile('Photo_File_Name') || $request->hasFile('Photo_File_Name_modify')) {
            $file = $request->file('Photo_File_Name') ?? $request->file('Photo_File_Name_modify');
            $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
            if ($fileUploaded) {
                $Photographs = 1;
            }
        } else {
            $Photo_File_Name = $Photo_File_Name;
        }

        $Legal_Doc_File_Name = $mod->{'Legal Doc File Name'} ?? '';
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($fileUploaded) {
                $Company_Legal_Documents = 1;
            }
        } else {
            $Legal_Doc_File_Name = $Legal_Doc_File_Name;
        }

        $GST_File_Name = $mod->{'GST File Name'} ?? '';
        if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
            $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
            $GST_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $GST_File_Name);
            if ($fileUploaded) {
                $GST_Registration = 1;
            }
        } else {
            $GST_File_Name = $GST_File_Name;
        }

        $Balance_Sheet_File_Name = $mod->{'Balance Sheet File Name'} ?? '';
        if ($request->hasFile('Balance_Sheet_File_Name') || $request->hasFile('Balance_Sheet_File_Name_modify')) {
            $file = $request->file('Balance_Sheet_File_Name') ?? $request->file('Balance_Sheet_File_Name_modify');
            $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
            if ($fileUploaded) {
                $CA_Certified_Balance_Sheet = 1;
            }
        } else {
            $Balance_Sheet_File_Name = $Balance_Sheet_File_Name;
        }

        if ($request->self_declaration == "on" || $request->self_declaration == "On" || $request->self_declaration == "ON") {
            $Self_declaration = 1;
        } else {
            $Self_declaration = 0;
        }

        $vendor_table = 'BOC$Vendor Emp - OD Media';
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_4 ?? '';
        $update = array(
            'Notarized Copy File Name' => $Notarized_Copy_File_Name,
            'PAN File Name' => $Attach_Copy_Of_Pan_Number_File_Name,
            'Affidavit File Name' => $Affidavit_File_Name,
            'Photo File Name' => $Photo_File_Name,
            'Legal Doc File Name' => $Legal_Doc_File_Name,
            'GST File Name' => $GST_File_Name,
            'Balance Sheet File Name' => $Balance_Sheet_File_Name,
            'Notarized Copy Of Agreement' => $Notarized_Copy_Of_Agreement,
            'PAN Attached' => $Attach_Copy_Of_Pan_Number,
            'Affidavit Of Oath' => $Affidavit_Of_Oath,
            'Photographs' => $Photographs,
            'Company Legal Documents' => $Company_Legal_Documents,
            'GST Registration' => $GST_Registration,
            'CA Certified Balance Sheet' => $CA_Certified_Balance_Sheet,
            'Self-declaration' => $Self_declaration,
            'Status' => $Status
        );

        $where = array('OD Category' => 1, 'OD Media ID' => $odmedia_id);

        $sqlDoc = PrivateMedia::updateAllRecords($vendor_table, $update, $where);
        $msg = 'Data Save Successfully! Please note the ' . $odmedia_id . ' reference number for future use.';
        if (!$sqlDoc) {
            return $this->sendError('Some Error Occurred!.');
            exit;
        } else {

            return $this->sendResponse($odmedia_id, $msg);
        }
    }
    public function showDetails($od_media_id = '')
    {

        $userid[] = Session::get('UserID');
        $table2 = 'BOC$Vendor Emp - OD Media';
        // $select = array('*');
        $select = array(
            'OD Category',
            'OD Media ID',
            'PM Agency Name',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            'BO Address',
            'BO Landline No_',
            'BO Fax No_',
            'BO E-Mail',
            'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            'Authorized Rep Name',
            'AR Address',
            'AR Landline No_',
            'AR FAX No_',
            'AR Mobile No_',
            'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status'
        );
        $where = array('OD Category' => 1, 'User ID' => $userid);
        $OD_vendors = PrivateMedia::fetchAllRecords($table2, $select, '', '',  $where, '', '');
        $array = json_decode(json_encode($OD_vendors), true);
        $od_media_id = $array[0]['OD Media ID'] ?? '';
        $table = 'BOC$OD Media Owner Detail';
        $select = array('OD Media ID', 'Owner ID');
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $pluck = 'Owner ID';
        $result = PrivateMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck);
        // dd($result);
        $table1 = 'BOC$Owner';
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        $whereIn = array('Owner ID' => $result);
        $OD_owners = PrivateMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

        $table3 = 'BOC$OD Media Work done';
        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            'File Name',
            'File Uploaded',
            'Allocated Vendor Code'
        );
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $OD_work_dones = PrivateMedia::fetchAllRecords(
            $table3,
            $select,
            '',
            '',
            $where,
            '',
            ''
        );
        $table4 = 'BOC$Sole Medias Address';

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
            'Image File Name'
        );
        $where = array('OD Media Type' => 1, 'Sole Media ID' => $od_media_id);
        $OD_media_address = PrivateMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');

        //dd($OD_media_address);

        if (empty($result)) {
            return $this->sendError('Data not found!.');
            exit;
        }

        $response = [
            'OD_owners' => $OD_owners,
            'OD_vendors' => $OD_vendors,
            'OD_work_dones' => $OD_work_dones,
            'OD_media_address' => $OD_media_address
        ];

        //dd($response);
        return $this->sendResponse($response, 'Data retrieved successfully.');

        //return response()->json($OD_owners,200);

    }
    public function privateMediaUpdate(Request $request, $odmediaid)
    {
        $Contract_No = $request->Contract_No ? $request->Contract_No : '';
        $License_Fee = $request->License_Fee ? $request->License_Fee : 0;
        $Quantity_Of_Display = $request->Quantity_Of_Display ? $request->Quantity_Of_Display : 0;
        $License_From = $request->License_From ? $request->License_From : '';
        $License_To = $request->License_To ? $request->License_To : '';
        $License_From1 = date('Y-m-d', strtotime($License_From));
        $License_To1 = date('Y-m-d', strtotime($License_To));

        $table2 = '[BOC$Vendor Emp - OD Media]';
        $sqlupdate =  DB::update("UPDATE $table2 set
            [Contract No_] = $Contract_No,
            [Quantity Of Display] = $Quantity_Of_Display,
            [License Fees] = $License_Fee,
            [License From] = '" . $License_From1 . "',
            [License To]   = '" . $License_To1 . "'
           where [OD Media ID] ='" . $odmediaid . "' ");
        if ($sqlupdate) {
            return $this->sendResponse('', 'Data Updated Successfully! Please note the ' . $odmediaid . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }



    public function fetchVendorRecord(Request $request)
    {
        $table = 'BOC$Vendor Emp - OD Media';
        $where = array('User ID' => $request->user_id);
        $response = PrivateMedia::fetchAllRecords($table, '*', '', '', $where, '', '');
        if (count($response) > 0) {
            unset($response[0]->{'timestamp'});
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function fetchOwnerRecord(Request $request)
    {
        $table = 'BOC$Owner';
        $select = array('Owner ID', 'Owner Name', 'Mobile No_', 'Email ID', 'Phone No_', 'Fax No_', 'Address 1', 'City', 'District', 'State');
        $where = array($request->key => $request->owner_id);
        $response = PrivateMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        $table2 = '[BOC$OD Media Owner Detail]';
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function fetchOwnerVendorMapped(Request $request)
    {
        $table = 'BOC$OD Media Owner Detail';
        $select = array('Owner ID');
        $where = array($request->key => $request->owner_id, 'OD Media Type' => 1);
        $response = PrivateMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function getAllDistricts()
    {
        $table = 'BOC$District';
        $select = array('District');
        $response = PrivateMedia::fetchAllRecords($table, $select, 'District', 'ASC', '', '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function countVendorRecords(Request $request)
    {
        $table = 'BOC$Vendor Emp - OD Media';
        $where = array('Owner ID' => $request->Owner_ID);
        $response = PrivateMedia::fetchAllRecords($table, '*', '', '', $where, '', '');
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }




    //for private renewal 7-Jan 2022 suman
    public function showRenewalDetails($od_media_id = '')
    {

        $userid[] = Session::get('UserID');
        $table2 = 'BOC$OD Vendor Renewal';
        // $select = array('*');
        $select = array(
            'OD Media ID',
            'PM Agency Name',
            'PM Agency Name as agency', //
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
            'BO Address',
            'BO Landline No_',
            'BO Fax No_',
            'BO E-Mail',
            'BO Mobile No_',
            'DO Address',
            'DO Landline No_',
            'DO Fax No_',
            'DO E-Mail',
            'DO Mobile No_',
            'Legal Status of Company',
            'Other Relevant Information',
            'Authority Which granted Media',
            'Amount paid to Authority',
            'License From',
            'License To',
            // 'Duration',
            'Rental Agreement',
            'Applying For OD Media Type',
            'GST No_',
            'TIN_TAN_VAT No_',
            'DD Date',
            'DD No_',
            'DD Bank Name',
            'DD Bank Branch Name',
            'Application Amount',
            'PAN',
            'Bank Name',
            'Bank Branch',
            'IFSC Code',
            'Account No_',
            'Company Legal Documents',
            'Notarized Copy Of Agreement',
            'Photographs',
            'Affidavit Of Oath',
            'GST Registration',
            'CA Certified Balance Sheet',
            'Self-declaration',
            'Legal Doc File Name',
            'Notarized Copy File Name',
            'Photo File Name',
            'Affidavit File Name',
            'GST File Name',
            'Balance Sheet File Name',
            'Authorized Rep Name',
            'AR Address',
            'AR Landline No_',
            'AR FAX No_',
            'AR Mobile No_',
            'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Allocated Vendor Code'
        );
        $where = array('User ID' => $userid);
        $OD_vendors = PrivateMedia::fetchAllRecords($table2, $select, 'Line No_', 'DESC',  $where, '', '');
        $array = json_decode(json_encode($OD_vendors), true);
        $od_media_id = $array[0]['OD Media ID'] ?? '';
        $table = 'BOC$OD Media Owner Detail';
        $select = array('OD Media ID', 'Owner ID');
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $pluck = 'Owner ID';
        $result = PrivateMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck);
        // dd($result);
        $table1 = 'BOC$Owner';
        $select = array(
            'Owner ID',
            'Owner Name',
            'Mobile No_',
            'Email ID',
            'Phone No_',
            'Fax No_',
            'Address 1',
            'Address 2',
            'City',
            'District',
            'State'
        );
        $whereIn = array('Owner ID' => $result);
        $OD_owners = PrivateMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

        $table3 = 'BOC$OD Media Work done';
        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            'File Name',
            'File Uploaded',
            'Allocated Vendor Code'
        );
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $OD_work_dones = PrivateMedia::fetchAllRecords(
            $table3,
            $select,
            '',
            '',
            $where,
            '',
            ''
        );
        $table4 = 'BOC$Sole Medias Address';

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
            'Image File Name'
        );
        $where = array('OD Media Type' => 1, 'Sole Media ID' => $od_media_id);
        $OD_media_address = PrivateMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');

        //dd($OD_media_address);

        if (empty($result)) {
            return $this->sendError('Data not found!.');
            exit;
        }

        $response = [
            'OD_owners' => $OD_owners,
            'OD_vendors' => $OD_vendors,
            'OD_work_dones' => $OD_work_dones,
            'OD_media_address' => $OD_media_address
        ];

        //dd($response);
        return $this->sendResponse($response, 'Data retrieved successfully.');

        //return response()->json($OD_owners,200);

    }

}
