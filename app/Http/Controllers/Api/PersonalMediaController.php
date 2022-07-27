<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use DB;
use Carbon\Carbon;
use App\Models\Api\ApiFreshEmpanelment;
use App\Models\Api\RateSettlementPersonalMedia;
use Session;

use App\Models\Api\MediaCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonalMediaExcelsImport;
use App\Models\Api\MediaCirculationDone;
use App\Imports\PersonalMediaExcelsImportDone;


class PersonalMediaController extends Controller
{
    use CommonTrait;

    public function RateSettlPersonalMediaSave(Request $request)
    {
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $unique_id = array();
        $user_id = Session::get('UserID');
        //dd($Userid);
        //$ownerids = explode(",", $request->ownerid[0]);
        $checkOwner=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Email ID',$request->owner_email)->first();
        
        if (($request->owner_email) >= 0) {
            foreach ($request->owner_email as $key => $value) {
                //dd($request);
                //if (@$ownerids[$key] == null || @$ownerids[$key] == '') {
                // if ($request->ownerid == '' || $request->ownerid == null) {
                if(empty($checkOwner)) {
                    $owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2] order by [Owner ID] desc');
                    if (empty($owner_id)) {
                        $owner_id = 'EMPOW1';
                    } else {
                        $owner_id = $owner_id[0]->{"Owner ID"};
                        $owner_id++;
                    }
                    $owner_name =
                        isset($request->owner_name[$key]) ? $request->owner_name[$key] : '';
                    $mobile =
                        isset($request->owner_mobile[$key]) ? $request->owner_mobile[$key] : '';
                    $email =
                        isset($request->owner_email[$key]) ? $request->owner_email[$key] : '';
                    $phone = '';
                    // isset($request->phone[$key]) ? $request->phone[$key] : '';
                    $fax_no =
                        isset($request->fax_no[$key]) ? $request->fax_no[$key] : '';
                    $address =
                        isset($request->address[$key]) ? $request->address[$key] : '';
                    $city = '';
                    //  isset($request->city[$key]) ? $request->city[$key] : '';
                    $district = '';
                    //  isset($request->district[$key]) ? $request->district[$key] : '';
                    $state = '';
                    //  isset($request->state[$key]) ? $request->state[$key] : '';

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
					[User ID]
                    ,[Group Name]
                    ,[Printed]
                    ,[BR Code]
                    ,[Pay Mode]
                    ,[Account No]
                    ,[Account Type]
                    ,[MICR Code]
                    ,[MICR City Code]
                    ,[Local]
                    ,[RBI AG Code]
                    ,[RBI BR Code]
                    ,[State Code]
                    ,[STEPS BR Code]
                    ,[STEPS Account NO]
                    ,[GRP Password]
                    ,[STEPS CoreBank]
                    ,[AUTH Sign Name]
                    ,[AUTH Sign Desgn]
                    ,[IFSC Code]
                    ,[IFSC Account Name]
                    ,[IFSC Account NO]
                    ,[IFSC Address]
                    ,[IFSC File]
                    ,[Adwing Pay Mode]
                    ,[PFMS UniqueCode]
                    ,[Group New Name]
                    ,[Sanction Payee]
                    ,[Owner Type]
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
					'',
					'',
					'',
					0,'','','','','','','','','','','".$user_id."',
                    '','','',0,'','','','','','','','','','','','','','','','','','','',0,'','','',0
					)"
                    );
                    $unique_id[] = $owner_id;
                    $msg = 'Owner Data Insert Successfully!';
                } else {
                    //  $owner_id = @$ownerids[$key];
                    $owner_id = $request->owner_email;
                    $Owner_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
                    $phone = '';
                    $request->fax_no = $request->fax_no[$key] ?? '';
                    $update = array(
                        'Owner Name' => $request->owner_name[$key],
                        'Mobile No_' => $request->owner_mobile[$key],
                        'Email ID' => $request->owner_email[$key],
                        'Phone No_' => $phone,
                        'Fax No_' => '',
                        'Address 1' => $request->address[$key],
                    );
                    $where = array('Email ID' => $owner_id);
                    $sql = ApiFreshEmpanelment::updateAllRecords($Owner_table, $update, $where);
                    $unique_id[] = $owner_id;
                    $msg = 'Owner Data Updated Successfully!';
                }
            }
        }
        if ($sql) {
            return $this->sendResponse($unique_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }

    // 2 tab
    public function personalRightSaveVendorData(Request $request)
    {
        $userid = Session::get('UserID');
        // dd($userid);
        //GET OWNER ID - 5 MARCH
        $ownerCheck=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('User ID',$userid)->first();
        // dd($ownerCheck);
        $owner_id=@$ownerCheck->{'Owner ID'};
        
        //$ownerids = explode(",", $request->ownerid[0]);
        $unique_id = array();
        $msg = '';
        $lineno1 = [];
        $lineno2 = [];
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $table3 = '[BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2]';
        $od_media_category = 1;
        $Check_vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';

        

        

        $fwhere=array("User ID"=>$userid,"OD Category"=>1,"Modification"=>0);
        $find_odmedia=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($fwhere)->orderBy('OD Media ID','desc')->first();
        

        if ($find_odmedia == '' || $find_odmedia == null) {
            $destinationPath = public_path() . '/uploads/personal-media/';
            // $owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2] order by [Owner ID] desc');
            // if (empty($owner_id)) {
            //     $owner_id = 'EMPOW1';
            // } else {
            //     $owner_id = $owner_id[0]->{"Owner ID"};
            //     $owner_id++;
            // }
            $odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2] order by [OD Media ID] desc');
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
            $HO_Address =isset($request->HO_Address) ? $request->HO_Address : '';
            $HO_Landline_No =isset($request->HO_Landline_No) ? $request->HO_Landline_No : '';
            $HO_Fax_No =isset($request->HO_Fax_No) ? $request->HO_Fax_No : '';
            $HO_Email =isset($request->HO_Email) ? $request->HO_Email : '';
            $HO_Mobile_No =isset($request->HO_Mobile_No) ? $request->HO_Mobile_No : '';
            $BO_Address =isset($request->BO_Address) ? $request->BO_Address : '';
            $BO_Landline_No =isset($request->BO_Landline_No) ? $request->BO_Landline_No : '';
            $BO_Fax_No =isset($request->BO_Fax_No) ? $request->BO_Fax_No : '';
            $BO_Email =isset($request->BO_Email) ? $request->BO_Email : '';
            $BO_Mobile =isset($request->BO_Mobile) ? $request->BO_Mobile : '';
            // if($request->optradio == 1 && $request->optradio !=''){
            $DO_Address =isset($request->DO_Address) ? $request->DO_Address : '';
            $DO_Landline_No =isset($request->DO_Landline_No) ? $request->DO_Landline_No : '';
            $DO_Fax_No =isset($request->DO_Fax_No) ? $request->DO_Fax_No : '';
            $DO_Email =isset($request->DO_Email) ? $request->DO_Email : '';
            $DO_Mobile =isset($request->DO_Mobile) ? $request->DO_Mobile : '';
            $Legal_Status_of_Company =isset($request->Legal_Status_of_Company) ? $request->Legal_Status_of_Company : 0;
            $Other_Relevant_Information =isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';
            $Authorized_Rep_Name =isset($request->Authorized_Rep_Name) ? $request->Authorized_Rep_Name : '';
            $AR_Address =isset($request->AR_Address) ? $request->AR_Address : '';
            $AR_Landline_No =isset($request->AR_Landline_No) ? $request->AR_Landline_No : '';
            $AR_FAX_No =isset($request->AR_FAX_No) ? $request->AR_FAX_No : '';
            $AR_Email =isset($request->AR_Email) ? $request->AR_Email : '';
            $AR_Mobile_No =isset($request->AR_Mobile_No) ? $request->AR_Mobile_No : '';

            $Authority_Which_granted_Media =isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';
            $Amount_paid_to_Authority =isset($request->Amount_paid_to_Authority) ? $request->Amount_paid_to_Authority : 0;

            $Contract_No =isset($request->Contract_No) ? $request->Contract_No : '';
            $License_Fee =isset($request->License_Fee) ? $request->License_Fee : 0;
            $Quantity_Of_Display =isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =isset($request->License_From) ? $request->License_From : '';
            $License_To =isset($request->License_To) ? $request->License_To : '';
            $Media_Type =isset($request->Media_Type) ? $request->Media_Type : '1753-01-01';
            $Rental_Agreement =isset($request->Rental_Agreement) ? $request->Rental_Agreement : 0;
            $Applying_For_OD_Media_Type =0;
            $sub_category_outdoor ='';
            $ODMFO_Display_Size_Of_Media =isset($request->ODMFO_Display_Size_Of_Media) ? $request->ODMFO_Display_Size_Of_Media : '';
            $Illumination_media =0;
            $GST_No =isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $DD_No =isset($request->DD_No) ? $request->DD_No : '';
            $DD_Date =isset($request->DD_Date) ? $request->DD_Date : '';
            $DD_Bank_Name =isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
            $DD_Bank_Branch_Name =isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
            $Application_Amount =isset($request->Application_Amount) ? $request->Application_Amount : 0;
            $PM_Agency_Name =isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
            $PAN =isset($request->PAN) ? $request->PAN : '';
            $Bank_Name =isset($request->Bank_Name) ? $request->Bank_Name : '';
            $Bank_Branch =isset($request->Bank_Branch) ? $request->Bank_Branch : '';
            $IFSC_Code =isset($request->IFSC_Code) ? $request->IFSC_Code : '';
            $Account_No =isset($request->Account_No) ? $request->Account_No : '';

                 //Get value for Receiver ID.
            $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
            $get_receiver_code = DB::select("select TOP 1 [OD Vend Landing UID] from dbo.$receiver_table");
            $recervier_id = $get_receiver_code[0]->{"OD Vend Landing UID"};
            // $recervier_id = "MKTA";

            $user_id = Session::get('UserID');  //for get user id
            $mytime = Carbon::now();
            $doc_date = $mytime->format('Y-m-d');
            $table2 = '[BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2]';
            DB::unprepared('SET ANSI_WARNINGS OFF');
            //second tab file
            //second tab file upload
            $file_name_status = 0;
            $file_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->first();
            $destinationPath = public_path() . '/uploads/personal-media/';
            $file_name = $file_check->{'File Name'} ?? '';
            if ($request->hasFile('file_name') || $request->hasFile('file_name_modify')) {
                $file = $request->file('file_name') ?? $request->file('file_name_modify');
                $file_name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $file_name);
                if ($file_uploaded) {
                    $file_name_status = 1;
                } else {
                    $file_name = '';
                }
            } 


            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]'; 
            
            if($request->xls=='0')
            {
                if(!empty($request->Applying_For_OD_Media_Type))
                {
                    // dd('fhkdj');
                    foreach($request->Applying_For_OD_Media_Type as $key => $value)
                    {
                        // $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        $line_no=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_','Sole Media ID')->where("Sole Media ID",$odmedia_id)->orderBy('Line No_','desc')->first();
                        if (empty($line_no)) 
                        {
                            $line_no = 10000;
                        } else 
                        {
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
            



            //7 March insert time branch address
            if($request->boradio==1)
            {
                if($request->BO_Address!='')
                {
                    foreach($request->BO_Address as $key => $branch_address)
                    {
                        $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                        if (empty($line_no)) 
                        {
                            $line_no = 10000;
                        } else 
                        {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }

                        $branch_data=array(
                            "OD Media Type" =>1,
                            "OD Media ID" =>$odmedia_id,
                            "Line No_" =>$line_no,
                            "State" => $request->BO_state[$key] ?? '',
                            "BO Address"=> $branch_address,
                            "BO Landline No_"=> $request->BO_Landline_No[$key] ?? '',
                            "BO E-mail" => $request->BO_Email[$key] ?? '',
                            "BO Mobile No_" => $request->BO_Mobile[$key] ?? '',
                            "User ID"=>Session::get('UserID')
                        );
                        
                        $branch=DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert($branch_data);
                    }
                    if (!$branch) {
                        return $this->sendError('Some Error Occurred! In Branch Detail');
                        exit;
                    }
                }
            }
            


               



            $vendorArray=array(
                "OD Category" => $od_media_category,
                "OD Media ID" => $odmedia_id,
                "HO Address" => $HO_Address,
                "HO Landline No_" => $HO_Landline_No,
                "HO Fax No_" => $HO_Fax_No,
                "HO E-Mail" => $HO_Email,
                "HO Mobile No_" => $HO_Mobile_No,
                "DO Address" => $DO_Address,
                "DO Landline No_" => $DO_Landline_No,
                "DO Fax No_" => $DO_Fax_No,
                "DO E-Mail" => $DO_Email,
                "DO Mobile No_" => $DO_Mobile,
                "Legal Status of Company" => $Legal_Status_of_Company,
                "Authority Which granted Media" => $Authority_Which_granted_Media,
                "Amount paid to Authority" => $Amount_paid_to_Authority,
                "Contract No_" => $Contract_No,
                "License Fees" => $License_Fee,
                "Quantity Of Display" => $Quantity_Of_Display,
                "License From" => $License_From,
                "License To" => $License_To,
                "Duration" => $Media_Type,
                "Rental Agreement" => $Rental_Agreement,
                "Applying For OD Media Type" => $Applying_For_OD_Media_Type,
                "Media Display size" => $ODMFO_Display_Size_Of_Media,
                "Illumination" => $Illumination_media,
                "GST No_" => $GST_No,
                "TIN_TAN_VAT No_" => $TIN_TAN_VAT_No,
                "Other Relevant Information" => $Other_Relevant_Information,
                "DD No_" => $DD_No,
                "DD Date" => $DD_Date,
                "DD Bank Name" => $DD_Bank_Name,
                "DD Bank Branch Name" => $DD_Bank_Branch_Name,
                "Application Amount" => $Application_Amount,
                "PM Agency Name" => $PM_Agency_Name,
                "PAN" => $PAN,
                "Bank Name" => $Bank_Name,
                "Bank Branch" => $Bank_Branch,
                "IFSC Code" => $IFSC_Code,
                "Account No_" => $Account_No,
                "Notarized Copy File Name" => $Notarized_Copy_File_Name,
                "PAN File Name" => $Attach_Copy_Of_Pan_Number_File_Name,
                "Affidavit File Name" => $Affidavit_File_Name,
                "Photo File Name" => $Photo_File_Name,
                "Legal Doc File Name" => $Legal_Doc_File_Name,
                "GST File Name" => $GST_File_Name,
                "Balance Sheet File Name" => $Balance_Sheet_File_Name,
                "Notarized Copy Of Agreement" => $Notarized_Copy_Of_Agreement,
                "PAN Attached" => $Attach_Copy_Of_Pan_Number,
                "Affidavit Of Oath" => $Affidavit_Of_Oath,
                "Photographs" => $Photographs,
                "Company Legal Documents" => $Company_Legal_Documents,
                "GST Registration" => $GST_Registration,
                "CA Certified Balance Sheet" => $CA_Certified_Balance_Sheet,
                "Self-declaration" => $Self_declaration,
                "User Id" => $user_id,
                "Status" => 0,
                "Global Dimension 1 Code" => 'M003',
                "Global Dimension 2 Code" => '',
                "Sender ID" => '',
                "Receiver ID" => $recervier_id,
                "Recommended To Committee" => 0,
                "Modification" => 0,
                "Media Sub Category" => $sub_category_outdoor,
                "Rate" => 0,
                "Rate Status" => 0,
                "Rate Remark" => '',
                "Rate Status Date" => '',
                "Agr File Path" => '',
                "Agr File Name" => '',
                "Allocated Vendor Code" => '',
                "Document Date" => $doc_date,
                "Empanelment Category" => 0,
                "From Date" => '1753-01-01 00:00:00.000',
                "To Date" => '1753-01-01 00:00:00.000',
                "Application Type" => 0,
                "File Name" => $file_name,
                "File Uploaded" => $file_name_status
            );
            
            $sq12=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->insert($vendorArray);
            
            // foreach ($ownerids as $owner) {
            // $owner_id = $request->ownerid ?? ''; 5 March 
            $detailArray=array(
                "OD Media Type"=>$od_media_category,
                "OD Media ID" =>$odmedia_id,
                "Owner ID" =>$owner_id,
                "Allocated Vendor Code"=> ''
            );
            $sq13=DB::table('BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2')->insert($detailArray);
        
            //}

            if (!$sq13) {
                return $this->sendError('Some Error Occurred!.');
                exit;
            }
            
            //media work donedata   save
            $table4 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
            if($request->xls2==0)
            {
                if (count($request->ODMFO_Quantity_Of_Display_Or_Duration) > 0) 
                {
                    $dataFile = array();
                    foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) 
                    {

                        $line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        if (empty($line_no)) 
                        {
                            $line_no = 10000;
                        } else 
                        {
                            $line_no = $line_no[0]->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }

                        $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';
                        $ODMFO_Year = isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                        $ODMFO_Quantity_Of_Display_Or_Duration = isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                        $ODMFO_Billing_Amount = isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;
                        $Document_FileName = isset($dataFile['Upload_Document_FileName'][$key]) ? $dataFile['Upload_Document_FileName'][$key] : '';
                        // $from_date=date('Y-m-d ');
                        $from_date=isset($request->from_date[$key]) ? $request->from_date[$key] : '';   
                        $to_date=isset($request->to_date[$key]) ? $request->to_date[$key] : ''; 
                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $workArray=array(
                            "OD Media Type"=>$od_media_category,
                            "OD Media ID"=>$odmedia_id,
                            "Line No_"=>$line_no,
                            "Work Name"=>$workName,
                            "Year"=>$ODMFO_Year,
                            "Qty Of Display_Duration"=>$ODMFO_Quantity_Of_Display_Or_Duration,
                            "Billing Amount"=>$ODMFO_Billing_Amount,
                            "Allocated Vendor Code"=>'',
                            "From Date"=>$from_date,   
                            "To Date"=>$to_date
                        );
                        $sql4=DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert($workArray);
                        //  $lineno2[] = $line_no;
                        // $request->session()->put('line2', $lineno2);
                        DB::unprepared('SET ANSI_WARNINGS ON');
                    }
                    if (!$sql4) 
                    {
                        return $this->sendError('Some Error Occurred!.');
                        exit;
                    }
                }
            }


            //excel upload start
            $odmediaid=$odmedia_id;
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
            if($request->xls=='1' || $request->xls2=='1')
            {
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
                }
                elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import2')) {
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
            

            $msg = 'Personal Media Vendor Data Save Successfully!';
            $unique_id =  $odmedia_id;
            return $this->sendResponse($unique_id, $msg);
        } else {
            //$line2 = $request->line_no;

            $f_where=array("User ID"=>$userid,"OD Category"=>1,"Modification"=>0);
            @$find_odmedia=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->select('OD Media ID')->where($f_where)->orderBy('OD Media ID','desc')->first(); 
            $odmedia_id=@$find_odmedia->{'OD Media ID'};

            // $odmedia_id = $request->vendorid_tab_2;

            //sole media 
            $table5 = '[BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2]'; 
            $check = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('Sole Media ID', $odmedia_id)->first();
            if ($check) 
            {
                DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where('Sole Media ID', $odmedia_id)->delete();
            }
            // dd($request->Applying_For_OD_Media_Type[0]);
            if($request->xls=='0')
            {
                if(!empty($request->Applying_For_OD_Media_Type))
                {
                    foreach($request->Applying_For_OD_Media_Type as $key => $value)
                    {
                        
                        // $line_no = DB::select("select TOP 1 [Line No_] from $table5 where [Sole Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        $line_no=DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_','Sole Media ID')->where("Sole Media ID",$odmedia_id)->orderBy('Line No_','desc')->first();
                        if (empty($line_no)) 
                        {
                            $line_no = 10000;
                        } else 
                        {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
                        // $soleArray=array(
                        //     "OD Media Type"=>$value,  //$request->Applying_For_OD_Media_Type[$key] : 0,
                        //     "Sole Media ID"=>$odmedia_id,
                        //     "Line No_"=>$line_no,
                        //     "City"=> '',
                        //     "State"=>'',
                        //     "District"=>'',
                        //     "Zone"=>0,
                        //     "Latitude"=>0,
                        //     "Longitde"=>0,
                        //     "Landmark"=>'',
                        //     "Image File Name"=>'',
                        //     "OD Media ID"=>$request->od_media_type[$key] ?? 0,
                        //     "Display Size"=>0,
                        //     "Illumination Type"=>0,
                        //     "Availability Start Date"=>'1753-01-01',
                        //     "Availability End Date"=>'1753-01-01',
                        //     "Length"=>0,
                        //     "Width"=>0,
                        //     "Total Area"=>0,
                        //     "Rental"=>0,
                        //     "Rental Type"=>0,
                        //     "Quantity"=>0,
                        //     "Train Number"=>'',
                        //     "Train Name"=>'',
                        //     "Size Type"=>0,
                        //     "Duration"=>0,
                        //     "No Of Spot"=>0,
                        //     "Lit Type"=>0
                        // );

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



             //7 March update time branch address
             if($request->boradio==1)
             {
                if($request->BO_Address!='')
                {
                    $where=array('OD Media ID' => $odmedia_id,"OD Media Type" =>1);
                    DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->delete();
                    foreach($request->BO_Address as $key => $branch_address)
                    {
                        $line_no = DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $odmedia_id)->orderBy('Line No_', 'desc')->first();
                        if (empty($line_no)) 
                        {
                            $line_no = 10000;
                        } 
                        else
                        {
                            $line_no = $line_no->{"Line No_"};
                            $line_no = $line_no + 10000;
                        }
    
                        $branch_data=array(
                            "OD Media Type" =>1,
                            "OD Media ID" =>$odmedia_id,
                            "Line No_" =>$line_no,
                            "State" => $request->BO_state[$key] ?? '',
                            "BO Address"=> $branch_address,
                            "BO Landline No_"=> $request->BO_Landline_No[$key] ?? '',
                            "BO E-mail" => $request->BO_Email[$key] ?? '',
                            "BO Mobile No_" => $request->BO_Mobile[$key] ?? '',
                            "User ID"=>Session::get('UserID')
                        );
                        
                        $branch=DB::table('BOC$OD Branch Offices$3f88596c-e20d-438c-a694-309eb14559b2')->insert($branch_data);
                    }
                    if (!$branch) 
                    {
                        return $this->sendError('Some Error Occurred! In Branch Detail');
                        exit;
                    }
                }
            }


            if($request->xls2==0)
            {
                if (count($request->ODMFO_Quantity_Of_Display_Or_Duration) > 0) 
                {
                    $table6 = '[BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2]';
                    $table5 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';
                    $line_no_val = DB::select("select [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "'");

                    $linenn_no = !empty($line_no_val) ? count($line_no_val) : 0;
                    if ($linenn_no > 0) 
                    {
                        DB::table($table5)->where('OD Media ID', $odmedia_id)->delete();
                    }
                    foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) 
                    { //ram code start
                        $ODMFO_Year  =
                            isset($request->ODMFO_Year[$key]) ? $request->ODMFO_Year[$key] : '';
                        $ODMFO_Quantity_Of_Display_Or_Duration =
                            isset($request->ODMFO_Quantity_Of_Display_Or_Duration[$key]) ? $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] : 0;
                        $ODMFO_Billing_Amount =
                            isset($request->ODMFO_Billing_Amount[$key]) ? $request->ODMFO_Billing_Amount[$key] : 0;

                        $unique_id = $odmedia_id;
                        // $from_date=date('Y-m-d');   
                        $from_date=isset($request->from_date[$key]) ? $request->from_date[$key] : '';
                        $to_date=isset($request->to_date[$key]) ? $request->to_date[$key] : '';
                        $msg = 'Personal Media Vender Data Updated Successfully!';
                        // } else {

                        $workName = isset($request->Work_Name[$key]) ? $request->Work_Name[$key] : '';

                        $next_line_no = DB::select("select TOP 1 [Line No_] from $table6 where [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
                        if (empty($next_line_no)) 
                        {
                            $next_line_no = 10000;
                        } else 
                        {
                            $next_line_no = $next_line_no[0]->{"Line No_"};
                            $next_line_no = $next_line_no + 10000;
                        }

                        DB::unprepared('SET ANSI_WARNINGS OFF');

                        $workArray2=array(
                            "OD Media Type"=>$od_media_category,
                            "OD Media ID"=>$odmedia_id,
                            "Line No_"=>$next_line_no,
                            "Work Name"=>$workName,
                            "Year"=>$ODMFO_Year,
                            "Qty Of Display_Duration"=>$ODMFO_Quantity_Of_Display_Or_Duration,
                            "Billing Amount"=>$ODMFO_Billing_Amount,
                            "Allocated Vendor Code"=>'',
                            "From Date"=>$from_date,   
                            "To Date"=>$to_date
                        );
                        $sq14=DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->insert($workArray2);
                        DB::unprepared('SET ANSI_WARNINGS ON');
                        // }
                    } //ram code end
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
            $DO_Address = isset($request->DO_Address) ? $request->DO_Address : '';
            $DO_Landline = isset($request->DO_Landline_No) ? $request->DO_Landline_No : '';
            $DO_Fax_No = isset($request->DO_Fax_No) ? $request->DO_Fax_No : '';
            $DO_Email = isset($request->DO_Email) ? $request->DO_Email : '';
            $DO_Mobile = isset($request->DO_Mobile) ? $request->DO_Mobile : '';
            $Legal_Status_of_Company = isset($request->Legal_Status_of_Company) ? $request->Legal_Status_of_Company : 0;
            $Other_Relevant_Information = isset($request->Other_Relevant_Information) ? $request->Other_Relevant_Information : '';

            $DO_legal_status_company = isset($request->DO_legal_status_company) ? $request->DO_legal_status_company : 0;
            $Do_relevant_information = isset($request->Do_relevant_information) ? $request->Do_relevant_information : '';
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

            $Authority_Which_granted_Media =
                isset($request->Authority_Which_granted_Media) ? $request->Authority_Which_granted_Media : '';
            $Amount_paid_to_Authority =
                isset($request->Amount_paid_to_Authority) ? $request->Amount_paid_to_Authority : 0;

            $Contract_No =
                isset($request->Contract_No) ? $request->Contract_No : '';
            $Quantity_Of_Display =
                isset($request->Quantity_Of_Display) ? $request->Quantity_Of_Display : 0;
            $License_From =
                isset($request->License_From) ? date("Y-m-d", strtotime($request->License_From)) : '';
            $License_To =
                isset($request->License_To) ? date("Y-m-d", strtotime($request->License_To)) : '';
            $Applying_For_OD_Media_Type =0;
            $sub_category_outdoor = '';
            $GST_No =
                isset($request->GST_No) ? $request->GST_No : '';
            $TIN_TAN_VAT_No =
                isset($request->TIN_TAN_VAT_No) ? $request->TIN_TAN_VAT_No : '';
            $Media_Type =
                isset($request->Media_Type) ? $request->Media_Type : '1753-01-01';
            $Rental_Agreement =
                isset($request->Rental_Agreement) ? $request->Rental_Agreement : 0;

            //second tab file upload
            $file_name_status = 0;
            $file_check = DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('OD Media ID', $odmedia_id)->first();
            $destinationPath = public_path() . '/uploads/personal-media/';
            $file_name = $file_check->{'File Name'} ?? '';
            if ($request->hasFile('file_name') || $request->hasFile('file_name_modify')) {
                $file = $request->file('file_name') ?? $request->file('file_name_modify');
                $file_name = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $file_name);
                if ($file_uploaded) {
                    $file_name_status = 1;
                } else {
                    $file_name = '';
                }
            }

            $table2 = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
            $update = array(
                'HO Address' => $HO_Address,
                'HO Landline No_' => $HO_Landline_No,
                'HO Fax No_' => $HO_Fax_No,
                'HO E-Mail' => $HO_Email,
                'HO Mobile No_' => $HO_Mobile_No,
                // 'BO Address' => $BO_Address,
                // 'BO Landline No_' => $BO_Landline_No,
                // 'BO Fax No_' => $BO_Fax_No,
                // 'BO E-Mail' => $BO_Email,
                // 'BO Mobile No_' => $BO_Mobile,
                'DO Address' => $DO_Address,
                'DO Landline No_' => $DO_Landline,
                'DO Fax No_' => $DO_Fax_No,
                'DO E-Mail' => $DO_Email,
                'DO Mobile No_' => $DO_Mobile,
                // 'Authorized Rep Name' => $Authorized_Rep_Name,
                // 'AR Address' => $AR_Address,
                // 'AR Landline No_' => $AR_Landline_No,
                // 'AR FAX No_' => $AR_FAX_No,
                // 'AR E-mail' => $AR_Email,
                // 'AR Mobile No_' => $AR_Mobile_No,
                'Legal Status of Company' => $Legal_Status_of_Company,
                'Authority Which granted Media' => $Authority_Which_granted_Media,
                'Amount paid to Authority' =>  $Amount_paid_to_Authority,
                'Contract No_' => $Contract_No,
                'Quantity Of Display' => $Quantity_Of_Display,
                'License From' => $License_From,
                'License To' => $License_To,
                'Applying For OD Media Type' => $Applying_For_OD_Media_Type,
                'GST No_' => $GST_No,
                'TIN_TAN_VAT No_' => $TIN_TAN_VAT_No,
                'Other Relevant Information' => $Other_Relevant_Information,
                'Duration' => $Media_Type,
                'Rental Agreement' => $Rental_Agreement,
                'Media Sub Category' => $sub_category_outdoor,
                'File Name'=>$file_name
            );
            $where = array('OD Media ID' => $odmedia_id);
            $sql2 = ApiFreshEmpanelment::updateAllRecords($table2, $update, $where);


            $ownerCheck=DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('User ID',$userid)->orderBy('Owner ID','desc')->first();
            $owner_id=$ownerCheck->{'Owner ID'};

            $table31 = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
            // $owner_id = $request->ownerid ?? '';
            $update1 = array('Owner ID' => $owner_id);
            $sql21 = ApiFreshEmpanelment::updateAllRecords($table31, $update1, $where);


            //excel upload start
            $odmediaid=$odmedia_id;
            $excel_odmedia_id = Session::put('ex_odmediaid', $odmediaid);
            if($request->xls=='1' || $request->xls2=='1')
            {
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
                }
                elseif ($request->hasfile('media_import')) {
                    try {
                        Excel::import(new PersonalMediaExcelsImport, request()->file('media_import')); //for import
                        // return $this->sendResponse('', 'Data Import successfully first');
                    } catch (ValidationException $ex) {

                        $failures = $ex->failures();
                        foreach ($failures as $failure) {
                            return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                        }
                    }
                }
                elseif ($request->hasfile('media_import2')) {
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
            

            $unique_id = $odmedia_id;
            $msg = 'Data Updated Successfully!';

            return $this->sendResponse($unique_id, $msg);
        }

        

        DB::unprepared('SET ANSI_WARNINGS ON');
        // if (!$sql2 && !$sql4 && !$sql5) {
        //     return $this->sendError('Some Error Occurred!.');
        //     exit;
        // } else {
        //     return $this->sendResponse($unique_id, $msg);
        // }
        
    }


    /* Third Tab Data Insert */

    public function personalSaveVendorAccount(Request $request)
    {
        $vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
        // $od_media = $request->vendorid_tab_2;
        // $odmedia_id = $request->vendorid_tab_3 ?? '';
        

        //when show click on view from listing
        // $url=last(request()->segments());
        // if($url!='rate-settlement-personal-media')
        // {
        //     return $this->sendResponse($url, '');
        // }

        //get od media id
        $userid = Session::get('UserID'); 
        $where=array("User ID"=>$userid,"OD Category"=>1,"Modification"=>0); //add Modification 15 feb
        $data=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
        $od_media=@$data->{'OD Media ID'};
        $odmedia_id=@$data->{'OD Media ID'};
        // dd($od_media);
        // account information variable
        $request->DD_No =isset($request->DD_No) ? $request->DD_No : '';
        $request->DD_Date =isset($request->DD_Date) ? date("Y-m-d", strtotime($request->DD_Date)) : '1970-01-01';
        $request->DD_Bank_Name =isset($request->DD_Bank_Name) ? $request->DD_Bank_Name : '';
        $request->DD_Bank_Branch_Name =isset($request->DD_Bank_Branch_Name) ? $request->DD_Bank_Branch_Name : '';
        $request->Application_Amount =isset($request->Application_Amount) ? $request->Application_Amount : 0;
        $request->PM_Agency_Name =isset($request->PM_Agency_Name) ? $request->PM_Agency_Name : '';
        $request->PAN =isset($request->PAN) ? $request->PAN : '';
        $request->Bank_Name =isset($request->Bank_Name) ? $request->Bank_Name : '';
        $request->Bank_Branch =isset($request->Bank_Branch) ? $request->Bank_Branch : '';
        $request->IFSC_Code =isset($request->IFSC_Code) ? $request->IFSC_Code : '';
        $request->Account_No =isset($request->Account_No) ? $request->Account_No : '';

        $update = array(
            // 'DD No_' => $request->DD_No,
            // 'DD Date' => $request->DD_Date,
            // 'DD Bank Name' => $request->DD_Bank_Name,
            // 'DD Bank Branch Name' => $request->DD_Bank_Branch_Name,
            // 'Application Amount' => $request->Application_Amount,
            'PM Agency Name' => $request->PM_Agency_Name,
            'PAN' => $request->PAN,
            'Bank Name' => $request->Bank_Name,
            'Bank Branch' => $request->Bank_Branch,
            'IFSC Code' => $request->IFSC_Code,
            'Account No_' => $request->Account_No,
        );
        $where = array('OD Category' => 1, 'OD Media ID' => $od_media);
   
        $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);
        //dd($sql1);
        if ($sql1) {
            return $this->sendResponse($od_media, 'Data Updated Successfully! Please note the ' . $od_media . ' reference number for future use.');
            //return $this->sendResponse($odmedia_id, 'Data Updated Successfully! Please note the ' . $odmedia_id. ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }

    /* Vendor account data end */

    /* Docs file tab 4 */

    public function personalSaveVendorDocs(Request $request)
    { 
        // $odmedia_id = $request->vendorid_tab_2;
        

        //get od media id
        $userid = Session::get('UserID');
        $where=array("User ID"=>$userid,"OD Category"=>1,"Modification"=>0); //add Modification 15 feb
        $data=DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
        $odmedia_id=@$data->{'OD Media ID'};

        //dd($odmedia_id);
        $destinationPath = public_path() . '/uploads/personal-media/';
        $Notarized_Copy_Of_Agreement = 0;
        $Attach_Copy_Of_Pan_Number = 0;
        $Affidavit_Of_Oath = 0;
        $Photographs = 0;
        $Company_Legal_Documents = 0;
        $GST_Registration = 0;
        $CA_Certified_Balance_Sheet = 0;
        $Status = 0;

        $Notarized_Copy_File_Name = $request->Notarized_Copy_File_Name_value ?? '';
        $Notarized_Copy_Of_Agreement = ($request->Notarized_Copy_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('Notarized_Copy_File_Name') || $request->hasFile('Notarized_Copy_File_Name_modify')) {
            $file = $request->file('Notarized_Copy_File_Name') ?? $request->file('Notarized_Copy_File_Name_modify');
            $Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Notarized_Copy_File_Name);
            if ($fileUploaded) {
                $Notarized_Copy_Of_Agreement = 1;
            } else {
                $Notarized_Copy_File_Name = '';
            }
        }

        $Attach_Copy_Of_Pan_Number_File_Name = $request->Attach_Copy_Of_Pan_Number_File_Name_value ?? '';
        $Attach_Copy_Of_Pan_Number = ($request->Attach_Copy_Of_Pan_Number_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('Attach_Copy_Of_Pan_Number_File_Name') || $request->hasFile('Attach_Copy_Of_Pan_Number_File_Name_modify')) {
            $file = $request->file('Attach_Copy_Of_Pan_Number_File_Name') ?? $request->file('Attach_Copy_Of_Pan_Number_File_Name_modify');
            $Attach_Copy_Of_Pan_Number_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded =  $file->move($destinationPath, $Attach_Copy_Of_Pan_Number_File_Name);
            if ($fileUploaded) {
                $Attach_Copy_Of_Pan_Number = 1;
            } else {
                $Attach_Copy_Of_Pan_Number_File_Name = '';
            }
        }

        $Affidavit_File_Name = $request->Affidavit_File_Name_value ?? '';
        $Affidavit_Of_Oath = ($request->Affidavit_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('Affidavit_File_Name') || $request->hasFile('Affidavit_File_Name_modify')) {
            $file = $request->file('Affidavit_File_Name') ?? $request->file('Affidavit_File_Name_modify');
            $Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Affidavit_File_Name);
            if ($fileUploaded) {
                $Affidavit_Of_Oath = 1;
            } else {
                $Affidavit_File_Name = '';
            }
        }

        $Photo_File_Name = $request->Photo_File_Name_value ?? '';
        $Photographs = ($request->Photo_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('Photo_File_Name') || $request->hasFile('Photo_File_Name_modify')) {
            $file = $request->file('Photo_File_Name') ?? $request->file('Photo_File_Name_modify');
            $Photo_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Photo_File_Name);
            if ($fileUploaded) {
                $Photographs = 1;
            } else {
                $Photo_File_Name = '';
            }
        }

        $Legal_Doc_File_Name = $request->Legal_Doc_File_Name_value ?? '';
        $Company_Legal_Documents = ($request->Legal_Doc_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('Legal_Doc_File_Name') || $request->hasFile('Legal_Doc_File_Name_modify')) {
            $file = $request->file('Legal_Doc_File_Name') ?? $request->file('Legal_Doc_File_Name_modify');
            $Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $Legal_Doc_File_Name);
            if ($fileUploaded) {
                $Company_Legal_Documents = 1;
            } else {
                $Legal_Doc_File_Name = '';
            }
        }

        $GST_File_Name = $request->GST_File_Name_value ?? '';
        $GST_Registration = ($request->GST_File_Name_value != '') ? 1 : 0;
        if ($request->hasFile('GST_File_Name') || $request->hasFile('GST_File_Name_modify')) {
            $file = $request->file('GST_File_Name') ?? $request->file('GST_File_Name_modify');
            $GST_File_Name = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $GST_File_Name);
            if ($fileUploaded) {
                $GST_Registration = 1;
            } else {
                $GST_File_Name = '';
            }
        }

        // if ($request->hasFile('Balance_Sheet_File_Name')) {
        //     $file = $request->file('Balance_Sheet_File_Name');
        //     $Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $Balance_Sheet_File_Name);
        //     if ($fileUploaded) {
        //         $CA_Certified_Balance_Sheet = 1;
        //     } else {
        //         $Balance_Sheet_File_Name = '';
        //     }
        // }

        if ($request->self_declaration == "on" || $request->self_declaration == "On" || $request->self_declaration == "ON") {
            $Self_declaration = 1;
        } else {
            $Self_declaration = 0;
        }
        if ($odmedia_id != null || $odmedia_id != '' || $odmedia_id != 0) {
            if ($request->allocated_VC != '') {
                $vendor_table = 'BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2';
                $where = array('Status' => 0, 'OD Media ID' => $odmedia_id);
                $odmedia_id = $request->allocated_VC;
            } else {
                $vendor_table = 'BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2';
                $where = array('OD Category' => 1, 'OD Media ID' => $odmedia_id);
            }
            $owner_id = $request->ownerid ?? '';
            $newspaper_code = $request->vendorid_tab_4 ?? '';
            $update = array(
                'Notarized Copy File Name' => $Notarized_Copy_File_Name,
                'PAN File Name' => $Attach_Copy_Of_Pan_Number_File_Name,
                'Affidavit File Name' => $Affidavit_File_Name,
                'Photo File Name' => $Photo_File_Name,
                'Legal Doc File Name' => $Legal_Doc_File_Name,
                'GST File Name' => $GST_File_Name,
                // 'Balance Sheet File Name' => $Balance_Sheet_File_Name,
                'Notarized Copy Of Agreement' => $Notarized_Copy_Of_Agreement,
                'PAN Attached' => $Attach_Copy_Of_Pan_Number,
                'Affidavit Of Oath' => $Affidavit_Of_Oath,
                'Photographs' => $Photographs,
                'Company Legal Documents' => $Company_Legal_Documents,
                'GST Registration' => $GST_Registration,
                'CA Certified Balance Sheet' => $CA_Certified_Balance_Sheet,
                'Self-declaration' => $Self_declaration,
                'Status' => $Status,
                'Modification' => 1
            );

            $sql22 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);
            $msg = 'Data Save Successfully! Please note the ' . $odmedia_id . ' reference number for future use.';
            if (!$sql22) {


                return $this->sendError('Some Error Occurred!.');
                exit;
            } else {

                return $this->sendResponse($odmedia_id, $msg);
            }
        } else {
            return $this->sendError('Od media id not exist!.');
            exit;
        }
    }



    //   public function showDetailsom($od_mediaid=''){
    //       //echo $od_media_id;exit;

    //      $aa=  DB::table('BOC$Vendor Emp - OD Media$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID','=', 'EMPTQ3')->first();

    //     return $this->sendResponse($aa,"successfully");
    // }
    public function showDetails($where, $table_media)
    {
        $userid[] = Session::get('UserID');
        $table2 = $table_media;
        // $select = array('*');
        
        $select = array(
            // 'OD Category',
            'OD Media ID',
            'PM Agency Name',
            'HO Address',
            'HO Landline No_',
            'HO Fax No_',
            'HO E-Mail',
            'HO Mobile No_',
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
            // 'Authorized Rep Name',
            // 'AR Address',
            // 'AR Landline No_',
            // 'AR FAX No_',
            // 'AR Mobile No_',
            // 'AR E-mail',
            'Contract No_',
            'Quantity Of Display',
            'License Fees',
            'Media Display size',
            'Illumination',
            'PAN Attached',
            'PAN File Name',
            'Status',
            'Media Sub Category',
            'Modification',
            'Allocated Vendor Code',
            'File Name'
        );
 
        $orderBy = '';
        $sort = '';
        if ($table2 == 'BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2') {
            $orderBy = 'Line No_';
            $sort = 'DESC';
        }
        
        $OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($table2, $select, $orderBy, $sort,  $where, '', '');
        
        
        $array = json_decode(json_encode($OD_vendors), true);
        $od_media_id = $array[0]['OD Media ID'] ?? '';
        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('OD Media ID', 'Owner ID');
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $pluck = 'Owner ID';
        $result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck);

        $table3 = 'BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2';

        $select = array(
            'OD Media Type',
            'OD Media ID',
            'Line No_',
            'Work Name',
            'Year',
            'Qty Of Display_Duration',
            'Billing Amount',
            // 'File Name',
            // 'File Uploaded',
            'Allocated Vendor Code',
            'From Date',
            'To Date'
        );
        $where = array('OD Media Type' => 1, 'OD Media ID' => $od_media_id);
        $OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($table3, $select, '', '',  $where, '', '');

        $table1 = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
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
        $OD_owners = RateSettlementPersonalMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn);

        $table4 = 'BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2';
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
            'Total Area',
            'Quantity',
            'Train Number',
            'Train Name',
            'Size Type',
            'Duration',
            'No Of Spot',
            'Lit Type',
        );
        $where = array('Sole Media ID' => $od_media_id);
        $OD_media_address = RateSettlementPersonalMedia::fetchAllRecords($table4, $select, '', '',  $where, '', '');
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

        return $this->sendResponse($response, 'Data retrieved successfully.');
    }

    public function fetchOwnerRecord(Request $request)
    {
        $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'Owner Name', 'Mobile No_', 'Email ID', 'Fax No_', 'Address 1');
        $where = array($request->key => $request->owner_id);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function fetchOwnerVendorMapped(Request $request)
    {
        $table = 'BOC$OD Media Owner Detail$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID');
        $where = array($request->key => $request->owner_id, 'OD Media Type' => 1);
        $response = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', '');
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function getMediaSubCategory(Request $request)
    {
        $sub_category = $this->getMediaSubCat($request->cat_id);
        if (!empty($sub_category)) {
            $data = "<option value=''>Select Sub Category</option>";
            foreach ($sub_category as $item) {
                $data .= "<option value='" . $item->{'OD Media UID'} . "'>" . $item->{'Name'} . "</option>";
            }
            return response()->json(['status' => 0, 'message' => $data]);
        } else {
            return response()->json(['status' => 1, 'message' => "<option value=''>No Data Found!</option>"]);
        }
    }
    public function getMediaSubCat($cat_id)
    {
        $media_code = $cat_id;
        $table='BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        return DB::table($table)->where(['Category Group'=>$media_code,'Active'=>1])->get();
       // $table = '[BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2]';
       // return $sub_category = DB::select("select [OD Media UID],[Name] from $table where Active = 1");
    }

    // renewal process insert and update date 03-01-2021 by rimmi

    public function removeWorkdoneData($line_no, $od_media_id)
    {
        $sql = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where(['Line No_' => $line_no, 'OD Media ID' => $od_media_id])->delete();
        if ($sql) {
            return $this->sendResponse('', 'Data deleted successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }

    public function removeMediaData($line_no, $od_media_id)
    {
        $sql = DB::table('BOC$Sole Medias Address$3f88596c-e20d-438c-a694-309eb14559b2')->where(['Line No_' => $line_no, 'Sole Media ID' => $od_media_id])->delete();
        if ($sql) {
            return $this->sendResponse('', 'Data deleted successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }

    public function renewalBasicUpdate(Request $request)
    {
        $owner_id = $request->ownerid;
        $Owner_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $update = array(
            'Owner Name' => $request->owner_name[0],
            'Mobile No_' => $request->owner_mobile[0],
            'Email ID' => $request->owner_email[0],
            'Fax No_' => $request->fax_no[0] ?? '',
            'Address 1' => $request->address[0],
        );
        $where = array('Owner ID' => $owner_id);
        $sql = ApiFreshEmpanelment::updateAllRecords($Owner_table, $update, $where);
        $msg = 'Owner Data Updated Successfully!';

        if ($sql) {
            return $this->sendResponse($owner_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }

    public function renewalOutdoorSave(Request $request)
    {

        $od_data = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $request->vendorid_tab_2)->orderBy('Line No_', 'desc')->first();
        if (empty($od_data)) {
            $od_line_no = 10000;
        } else {
            $od_line_no = $od_data->{"Line No_"};
            $od_line_no = $od_line_no + 10000;
        }
        $mytime = Carbon::now();
        $doc_date = $mytime->format('Y-m-d');
        //Get value for Receiver ID.
        $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
        $get_receiver_code = DB::select("select TOP 1 [OD Vend Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"OD Vend Landing UID"};
        // $recervier_id = "MKTA";

        $insertArray = array(
            "OD Media ID" => $request->vendorid_tab_2,
            "PM Agency Name" => $request->PM_Agency_Name ?? '',
            "Agreement Start Date" => '1753-01-01',
            "Agreement End Date" => '1753-01-01',
            "HO Address" => $request->HO_Address ?? '',
            "HO Landline No_" => $request->HO_Landline_No ?? '',
            "HO Fax No_" => $request->HO_Fax_No ?? '',
            "HO E-Mail" => $request->HO_Email ?? '',
            "HO Mobile No_" => $request->HO_Mobile_No ?? '',
            // "BO Address" => $request->BO_Address ?? '',
            // "BO Landline No_" => $request->BO_Landline_No ?? '',
            // "BO Fax No_" => $request->BO_Fax_No ?? '',
            // "BO E-Mail" => $request->BO_Email ?? '',
            // "BO Mobile No_" => $request->BO_Mobile ?? '',
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
            //"Duration" => $request->Media_Type ?? '1753-01-01',
            "Media Type" =>0,
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
            "Company Legal Documents" => ($request->Legal_Doc_File_Name_value != '') ? 1 : 0,
            "Notarized Copy Of Agreement" => ($request->Notarized_Copy_File_Name_value != '') ? 1 : 0,
            "Photographs" => ($request->Photo_File_Name_value != '') ? 1 : 0,
            "Affidavit Of Oath" => ($request->Affidavit_File_Name_value != '') ? 1 : 0,
            "GST Registration" => ($request->GST_File_Name_value != '') ? 1 : 0,
            "CA Certified Balance Sheet" => 0,
            "Self-declaration" => 0,
            "Legal Doc File Name" => $request->Legal_Doc_File_Name_value ?? '',
            "Notarized Copy File Name" => $request->Notarized_Copy_File_Name_value ?? '', //
            "Photo File Name" => $request->Photo_File_Name_value ?? '',
            "Affidavit File Name" => $request->Affidavit_File_Name_value ?? '',
            "GST File Name" => $request->GST_File_Name_value ?? '',
            "Balance Sheet File Name" => '',
            // "Authorized Rep Name" => $request->Authorized_Rep_Name ?? '',
            // "AR Address" => $request->AR_Address ?? '',
            // "AR Landline No_" => $request->AR_Landline_No ?? '',
            // "AR FAX No_" => $request->AR_FAX_No ?? '',
            // "AR Mobile No_" => $request->AR_Mobile_No ?? '',
            // "AR E-mail" => $request->AR_Email ?? '',
            "Contract No_" => $request->Contract_No ?? '',
            "Quantity Of Display" => $request->Quantity_Of_Display ?? 0,
            "License Fees" => $request->License_Fee ?? 0,
            "PAN Attached" => ($request->Attach_Copy_Of_Pan_Number_File_Name_value != '') ? 1 : 0,
            "PAN File Name" => $request->Attach_Copy_Of_Pan_Number_File_Name_value ?? '',
            "User ID" => Session::get('UserID'),
            "Global Dimension 1 Code" => 'MOO3',
            "Global Dimension 2 Code" => '',
            "Sender ID" => '',
            "Receiver ID" => $recervier_id,
            "Recommended To Committee" => 0,
            "Modification" => 0,
            "Media Sub Category" => $request->sub_category_outdoor ?? '',
            "Rate" => 0,
            "Rate Status" => 0,
            "Rate Remark" => '',
            "Rate Status Date" => '1753-01-01',
            "Agr File Path" => '',
            "Agr File Name" => '',
            "Document Date" => $doc_date,
            'Allocated Vendor Code' => $request->allocated_VC ?? $request->vendorid_tab_2
        );

        $v_data = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('Status', 'Line No_')->where('OD Media ID', $request->vendorid_tab_2)->orderBy('Line No_', 'desc')->first();
        if (empty($v_data) || $v_data->Status == 6) {
            $insertArray['Line No_'] = $od_line_no;
            $insertArray['Status'] = 0;

            $od_sql = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->Insert($insertArray);
        } else {

            $od_sql = DB::table('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where(['OD Media ID' => $request->vendorid_tab_2, 'Line No_' => $v_data->{'Line No_'}])->update($insertArray);
        }

        $line_array = [];
        if (!empty($request->ODMFO_Quantity_Of_Display_Or_Duration)) {

            $workdonedata = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Year', 'Line No_', 'File Name')->where([['OD Media ID', '=', $request->vendorid_tab_2], ['Allocated Vendor Code', '=', '']])->get();

            
            foreach ($request->ODMFO_Quantity_Of_Display_Or_Duration as $key => $value) {

                $line_no = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where('OD Media ID', $request->vendorid_tab_2)->orderBy('Line No_', 'desc')->first();

                if (empty($line_no)) {
                    $line_no = 10000;
                } else {
                    $line_no = $line_no->{"Line No_"};
                    $line_no = $line_no + 10000;
                }

                // $File_Uploaded_Status = (@$workdonedata[$key]->{"File Name"} != '') ? 1 : 0;
                // $Upload_Document_FileName = @$workdonedata[$key]->{"File Name"} ?? '';
                // if ($request->hasfile('ODMFO_Upload_Document') && @$request->file('ODMFO_Upload_Document')[$key] != '') {
                //     $file = $request->file('ODMFO_Upload_Document')[$key];
                //     $fileName = time() . '-' . $file->getClientOriginalName();

                //     $fileUploaded = $file->move(public_path() . '/uploads/personal-media/', $fileName);
                //     if ($fileUploaded) {
                //         $File_Uploaded_Status = 1;
                //         $Upload_Document_FileName = $fileName;
                //     }
                // }
                $from_date=isset($request->from_date[$key]) ? $request->from_date[$key] : '';
                $to_date=isset($request->to_date[$key]) ? $request->to_date[$key] : '';
                $insertworkdone = array(
                    "OD Media Type" => 1,
                    "OD Media ID" => $request->vendorid_tab_2,
                    "Work Name" => '',
                    "Year" => $request->ODMFO_Year[$key] ?? '',
                    "Qty Of Display_Duration" => $request->ODMFO_Quantity_Of_Display_Or_Duration[$key] ?? 0,
                    "Billing Amount" => $request->ODMFO_Billing_Amount[$key] ?? 0,
                    "Allocated Vendor Code"=>'',
                    "From Date"=>$from_date,
                    "To Date"=>$to_date
                );

                $data = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where(['Line No_' => @$workdonedata[$key]->{'Line No_'}, 'OD Media ID' => $request->vendorid_tab_2])->first();

                if (empty($data)) {
                    $insertworkdone['Line No_'] = $line_no;
                    $insertworkdone['Allocated Vendor Code'] = '';
                    array_push($line_array, $line_no);
                    $od_sql = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->Insert($insertworkdone);
                } else {
                    array_push($line_array, @$workdonedata[$key]->{'Line No_'});
                    $od_sql = DB::table('BOC$OD Media Work done$3f88596c-e20d-438c-a694-309eb14559b2')->where(['Line No_' => @$workdonedata[$key]->{'Line No_'}, 'OD Media ID' => $request->vendorid_tab_2])->update($insertworkdone);
                }
            }
        }

        $msg = 'Vendor Data Updated Successfully!';
        if ($od_sql) {
            return $this->sendResponse($line_array, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }
    public function renewalAccountSave(Request $request)
    { //dd($request);
        $update = array(
            'PM Agency Name' => $request->PM_Agency_Name,
            'PAN' => $request->PAN,
            'Bank Name' => $request->Bank_Name,
            'Bank Branch' => $request->Bank_Branch,
            'IFSC Code' => $request->IFSC_Code,
            'Account No_' => $request->Account_No,
        );
        $where = array('Status' => 0, 'OD Media ID' => $request->vendorid_tab_3);
        $sql1 = ApiFreshEmpanelment::updateAllRecords('BOC$OD Vendor Renewal$3f88596c-e20d-438c-a694-309eb14559b2', $update, $where);

        if ($sql1) {
            return $this->sendResponse($request->vendorid_tab_3, 'Data Updated Successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
        }
    }
    // public function renewalDocsSave(Request $request)
    // {
    //     $this->personalSaveVendorDocs($request);
    // }
}
