<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Imports\DigitalCinema\DigitalCinema;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\CommonTrait;
use Carbon\Carbon;
class DigitalCinemaController extends Controller
{
  use CommonTrait;

    private $vendorTable ='BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2';

    public function __Constructor($vendorTable){
        return $this->vendorTable =$vendorTable;
    }
/* ==================================start Owner Insert Update======================================*/
    public function DCOwnerData(Request $request)
    {
        $table1 = '[BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2]';
        $msg = '';
        $userid =Session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)->select('Agency Code')->where('User ID',$userid)->first();
            //dd($agencyFind->{'Agency Code'});
        $agency_Name=isset($request->Owner_Name) ? $request->Owner_Name:'';
        $mobile=isset($request->digital_mobile) ? $request->digital_mobile:'';
        $email=isset($request->digital_email) ? $request->digital_email:'';
        $phone=isset($request->digital_phone_no) ? $request->digital_phone_no:'';
        $address=isset($request->digital_address) ? $request->digital_address:'';
        $city=isset($request->digital_city) ? $request->digital_city:'';
        $district=isset($request->digital_district) ? $request->digital_district:'';
        $state=isset($request->digital_state) ? $request->digital_state:'';
        $secondary_mobile=isset($request->secondary_mobile) ? $request->secondary_mobile:'';
        $digital_pin_code=isset($request->digital_pin_code) ? $request->digital_pin_code:'';
        $Authorized_Rep_Name=isset($request->Authorized_Rep_Name) ? $request->Authorized_Rep_Name:'';
        $AR_Address=isset($request->AR_Address) ? $request->AR_Address:'';
        $AR_Landline_No=isset($request->AR_Landline_No) ? $request->AR_Landline_No:'';
        $AR_Email=isset($request->AR_Email) ? $request->AR_Email:'';
        $AR_Mobile_No=isset($request->AR_Mobile_No) ? $request->AR_Mobile_No:'';
        $altername_mobile=isset($request->altername_mobile) ? $request->altername_mobile:'';
        $Head_name=isset($request->Head_name) ? $request->Head_name:'';
        $Head_state=isset($request->Head_state) ? $request->Head_state:'';
        $Head_district=isset($request->Head_district) ? $request->Head_district:'';
        $Head_city=isset($request->Head_city) ? $request->Head_city:'';
        $Head_address=isset($request->Head_address) ? $request->Head_address:'';
        $Head_Designation=isset($request->Head_Designation) ? $request->Head_Designation:'';
        $Head_Landline_No=isset($request->Head_Landline_No) ? $request->Head_Landline_No:'';
        $Head_Mobile_No=isset($request->Head_Mobile_No) ? $request->Head_Mobile_No:'';
        $Head_Email=isset($request->Head_Email) ? $request->Head_Email:'';
        $loc_Same_Address_as_HQ=isset($request->loc_Same_Address_as_HQ) ? $request->loc_Same_Address_as_HQ:'';
        $Location_address=isset($request->Location_address) ? $request->Location_address:'';
        $Location_Designation=isset($request->Location_Designation) ? $request->Location_Designation:'';
        $Location_Landline_No=isset($request->Location_Landline_No) ? $request->Location_Landline_No:'';
        $Location_Mobile_No=isset($request->Location_Mobile_No) ? $request->Location_Mobile_No:'';
        $Location_Email=isset($request->Location_Email) ? $request->Location_Email:'';
        $Location_state=isset($request->Location_state) ? $request->Location_state:'';
        $Location_district=isset($request->Location_district) ? $request->Location_district:'';
        $Location_city=isset($request->Location_city) ? $request->Location_city:'';
        $Location_Contact_name=isset($request->Location_Contact_name) ? $request->Location_Contact_name:'';
            if(@$agencyFind->{'Agency Code'} == ''){
                $msg ='';
                $agency_code=DB::table('BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2')->select('Agency Code')->where('Agency Code','LIKE','%'.'DCF'.'%')->orderBy('Agency Code','desc')->first();
            if(empty($agency_code)){
                $agency_code ='DCF000001';
            }else{
               $agency_code =$agency_code->{'Agency Code'};
               $agency_code++;
            }
            $ldate =date('Y-m-d H:i:s');;
            //dd($agency_code);
            $insert =[
                "Agency Code"=>$agency_code,
                "Agency Name"=>$agency_Name,
                "Address 1"=>$address,
                "Address 2"=>'',
                "City"=>$city,
                "District"=>$district,
                "State"=>$state,
                "Mobile"=>$mobile,
                "E-Mail"=>$email,
                "Phone"=>$phone,
                "Account No_"=>'',
                "A_C Holder Name"=>'',
                "Bank Name"=>'',
                "Branch Name"=>'',
                "IFSC Code"=>'',
                "Account Address"=>'',
                "PAN"=>'',
                "ESI A_C No_"=>'',
                "No_ Of Emp in ESI"=>'',
                "EPF A_c No_"=>'',
                "No_ Of Emp in EPF"=>'',
                "Agreement Between Parties"=>'',
                "Agreement File Name"=>'',
                "Self Declaration"=>'',
                "Self Dclr File Name"=>'',
                "Empanelment Category"=>7,
                "Global Dimension 1 Code"=>'M004',
                "Global Dimension 2 Code"=>'',
                "User ID"=>$userid,
                "Status"=>'',
                "Agr File Path"=>'',
                "Agr File Name"=>'',
                "Affidavit For Non Suspension"=>'',
                "Affidavit For NS File Naame"=>'',
                "Affidavit For Director"=>'',
                "Affidavit For Dir File Name"=>'',
                "Mobile number Own DB"=>'',
                "Mobile number ODB File Name"=>'',
                "Incorporation Certificate"=>'',
                "Incorporation Cert File Name"=>'',
                "Sender ID"=>'',
                "Receiver ID"=>'',
                "Modification"=>'',
                "Alocated DC Code"=>'',
                "From Date"=>'',
                "To Date"=>'',
                "Recommended To Committee"=>'',
                "AR Name"=>$Authorized_Rep_Name,
                "AR Address"=>$AR_Address,
                "AR Mobile"=>$AR_Mobile_No,
                "AR Phone No_"=>$AR_Landline_No,
                "AR Email"=>$AR_Email,
                "Alternate Mobile No_"=> $altername_mobile,
                "Post Code"=>0,
                "HO Same Address DO"=>'',
                "HO Address 1"=>$Head_address,
                "HO Address 2"=>'',
                "HO City"=>$Head_city,
                "HO District"=>$Head_district,
                "HO State"=>$Head_state,
                "HO Mobile"=>$Head_Mobile_No,
                "HO E-Mail"=>$Head_Email,
                "HO Phone"=>$Head_Landline_No,
                "HO Post Code"=>0,
                "Application Date"=>$ldate,
                "Empanel Date"=>'1900-01-01 00:00:00.000',
                "Loc Same Address_as_DO"=>$loc_Same_Address_as_HQ,
                "LOC Address 1"=>$Location_address,
                "LOC Address 2"=>'',
                "LOC City"=>$Location_city,
                "LOC District"=>$Location_district,
                "LOC State"=>$Location_state,
                "LOC Mobile"=>$Location_Mobile_No,
                "LOC E-Mail"=>$Location_Email,
                "LOC Phone"=>$Location_Landline_No,
                "LOC Post Code"=>0,
                "Owner Post Code"=>$digital_pin_code,
                "Owner Secondary mobile no"=>$secondary_mobile,
                "LOC contact name"=>$Location_Contact_name,
                "LOC Designation"=>$Location_Designation,
                "HO contact name"=>$Head_name,
                "HO Designation"=>$Head_Designation,
                "Incorporation Certificate" =>0,
                "Incorporation Cert File Name" =>'',
                "Balance sheet_Auditor Fin_" =>0,
                "BS_AF File Name" =>'',
                "GST No_"=>'',
            ];
            $sql =DB::table('BOC$Vend Emp Digital Cinema$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insert);
            //$sql =DB::teble('')insert($insert)
                $msg = 'Data Saved Successfully!';
                if ($sql){
                return $this->sendResponse($agency_code, $msg);
                }
            }else {
                
                $update = array(
                "Agency Name" =>$agency_Name,
                "Address 1" =>$address,
                "City" =>$city,
                "District" =>$district,
                "State" =>$state,
                "Mobile" =>$mobile,
                "E-Mail" =>$email,
                "Phone" =>$phone,
                "AR Name"=>$Authorized_Rep_Name,
                "AR Address"=>$AR_Address,
                "AR Mobile"=>$AR_Mobile_No,
                "AR Phone No_"=>$AR_Landline_No,
                "AR Email"=>$AR_Email,
                "Alternate Mobile No_"=>$altername_mobile,
                "HO Address 1"=>$Head_address,
                "HO City"=>$Head_city,
                "HO District"=>$Head_district,
                "HO State"=>$Head_state,
                "HO Mobile"=>$Head_Mobile_No,
                "HO E-Mail"=>$Head_Email,
                "HO Phone"=>$Head_Landline_No,
                "Loc Same Address_as_DO"=>$loc_Same_Address_as_HQ,
                 "LOC Address 1"=>$Location_address,
                "LOC City"=>$Location_city,
                "LOC District"=>$Location_district,
                 "LOC State"=>$Location_state,
                "LOC Mobile"=>$Location_Mobile_No,
                "LOC E-Mail"=>$Location_Email,
                "LOC Phone"=>$Location_Landline_No,
                "Owner Post Code"=>$digital_pin_code,
                "Owner Secondary mobile no"=>$secondary_mobile,
                "LOC contact name"=>$Location_Contact_name,
                "LOC Designation"=>$Location_Designation,
                "HO contact name"=>$Head_name,
                "HO Designation"=>$Head_Designation,
                );
                 $sql =DB::table($this->vendorTable)->where('Agency Code',@$agencyFind->{'Agency Code'})->update($update);
                //dd($sql);
                 $msg = 'Data Updated Successfully!';
            if ($sql) {
            return $this->sendResponse(@$agencyFind->{'Agency Code'}, $msg);
            }else{
            return $this->sendError('Some Error Occurred!.');
            exit;
           }
        }
    }

/* ==================================End Owner Insert Update======================================*/
/*==================================Start Second Insert Update=====================================*/
public function addSeatsdetails(Request $request){
   
    if($request->xls == 1){
        Excel::import(new DigitalCinema,request()->file('file'));
        return $this->sendResponse(@$agencyFind->{'Agency Code'},"Excel Uploaded Successfully!");
    }else{
        return DB::transaction(function() use ($request) {
            $msg ='';
            $sql1 ='';
            $userid = session::get('UserID');
                 $agencyFind=DB::table($this->vendorTable)
                    ->select('Agency Code')->where('User ID',$userid)->first();
                        if(count($request->company_name) > 0){
                             $where2=array("Agency Code"=>@$agencyFind->{'Agency Code'});
                            $checkData=DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->where($where2)->delete();
                        foreach ($request->company_name as $key => $value) {
                            $where=array("Agency Code"=>@$agencyFind->{'Agency Code'});
                            $line=DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where($where)->orderBy('Line No_','desc')->first();
                            $line_no=@$line->{'Line No_'};
                            // dd($line_no);
                            if(empty($line))
                            {
                                $lineNo='1000';
                            }
                            else
                            {
                                $lineNo=$line_no+1;
                            }
                            $company_name =$request->company_name[$key] ?? '';
                            $exc_agency_name =$request->exc_agency_name[$key] ?? '';
                            $teatre_name =$request->teatre_name[$key] ?? '';
                            $excel_state =$request->excel_state [$key] ?? '';
                            $excel_district =$request->excel_district[$key] ?? '';
                            $excel_city =$request->excel_city[$key] ?? '';
                            $excel_address =$request->excel_address[$key] ?? '';
                            $excel_pin_code  =$request->excel_pin_code  [$key] ?? '';
                            $excel_Seating_Capacity =$request->excel_Seating_Capacity[$key] ?? '';
                            $excel_Screen_type =$request->excel_Screen_type[$key] ?? '';
                            $excel_Web_code =$request->excel_Web_code[$key] ?? '';
                            $insert =[
                              "Agency Code" =>@$agencyFind->{'Agency Code'},
                              "Line No_" =>$lineNo,
                              "Screen Unique Code"=> $excel_Web_code,
                              "Agency Contract Detail" =>'',
                              "No_ Of Seats" =>$excel_Seating_Capacity,
                              "Company Name"=>$company_name,
                              "Agency Name"=>$exc_agency_name,
                              "Theatre Name"=>$teatre_name,
                              "Address"=>$excel_address,
                              "District"=>$excel_district,
                              "City"=>$excel_city,
                              "State"=>$excel_state,
                              "Pin code"=>$excel_pin_code,
                              "Screen Type"=>$excel_Screen_type,
                                ];
                                 $sql1 =DB::table('BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2')
                                ->insert( $insert);
                            $msg ="Sreens data save Successfully!";
                        }
                    }
                // Lets add some custom validation that will prohibit the transaction:
                if(!$sql1) {
                    throw AnyException('Please rollback this transaction');
                     //return $this->sendError('Some Error Occurred!');
                }
                return $this->sendResponse(@$agencyFind->{'Agency Code'},$msg);
            });//transection close
    }
   
}
  /*==================================End Second Insert Update=====================================*/
public function SaveAccountDetails(Request $request){
        $bank_account_no =$request->bank_account_no ?? '';
        $account_holder_name =$request->account_holder_name ?? '';
        $IFSC_Code =$request->IFSC_Code ?? '';
        $bank_name =$request->bank_name ?? '';
        $branch =$request->branch ?? '';
        $address_account =$request->address_account ?? '';
        $PAN =$request->PAN ?? '';
        $GST_No =$request->GST_No ?? '';
        $ESI_account_no =$request->ESI_account_no ?? '';
        $ESI_employees_covered =$request->ESI_employees_covered ?? '';
        $EPF_account_no =$request->EPF_account_no ?? '';
        $EPF_employees_covered =$request->EPF_employees_covered ?? '';
        $msg ="";
        $userid = session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)
        ->select('Agency Code')->where('User ID',$userid)->first();
        $updateAC=[
                "Account No_" =>$bank_account_no,
                "A_C Holder Name" =>$account_holder_name,
                "Bank Name" =>$bank_name,
                "Branch Name" =>$branch,
                "IFSC Code" =>$IFSC_Code,
                "Account Address" =>$address_account,
                "PAN" =>$PAN,
                "ESI A_c No_"=>$ESI_account_no,
                "No_ Of Emp in ESI" =>$ESI_employees_covered,
                "EPF A_c No_" =>$EPF_account_no,
                "No_ Of Emp in EPF" =>$EPF_employees_covered,
                "GST No_" => $GST_No
        ];
        //dd($ESI_employees_covered);
        $sqlAC =DB::table($this->vendorTable)->where('Agency Code',@$agencyFind->{'Agency Code'})->update($updateAC);
        $msg ="Account Save Successfully !";
        if($sqlAC){
            return $this->sendResponse(@$agencyFind->{'Agency Code'},$msg);
        }
}
/*==================================End Third Insert Update=====================================*/
/*==================================Start Fourth Insert Update=====================================*/
public function DOCStore(Request $request){
        $msg ="";
        $userid = session::get('UserID');
        $agencyFind=DB::table($this->vendorTable)
        ->select('Agency Code','Agreement File Name')->where('User ID',$userid)->first();
        $agreement_parties ='';
        $Agreement_Between_Parties ='';
        $Certificate_Incorporation ='';
        $Certificate_Incorporation_wt =0;
        $Balance_sheet_wt =0;
        $Uploaded_file =$agencyFind->{'Agreement File Name'} ?? '';
        $destinationPath =public_path().'/uploads/Digital-Cinema/';
        if($request->hasFile('agreement_parties')){
            $file =$request->file('agreement_parties');
             $agreement_parties =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $agreement_parties);
            if($fileUploaded){
                $agreement_parties_wt = 1;
            }
            }else{
                $agreement_parties =$Uploaded_file;
            }
            $Uploaded_incorporation =$agencyFind->{'Incorporation Cert File Name'} ?? '';
        if($request->hasFile('Certificate_Incorporation') ){
            $file =$request->file('Certificate_Incorporation');
             $Certificate_Incorporation =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $Certificate_Incorporation);
            if($fileUploaded){
                $Certificate_Incorporation_wt = 1;
            }
            }else{
                $Certificate_Incorporation =$Uploaded_incorporation;
            }
            $Uploaded_BS_AF =$agencyFind->{'BS_AF File Name'} ?? '';
            if($request->hasFile('Balance_sheet')){
                $file =$request->file('Balance_sheet');
                 $Balance_sheet =time().'-'.$file->getClientOriginalName();
                $fileUploaded=$file->move($destinationPath, $Balance_sheet);
                if($fileUploaded){
                    $Balance_sheet_wt = 1;
                }
                }else{
                    $Balance_sheet =$Uploaded_BS_AF;
                }
            $Self_declaration =$request->Self_declaration ?? 0;
            $agreement_parties =$agreement_parties ?$agreement_parties :$request->Agreement_File_Path;

    $DOCupdate =[
        "Agreement Between Parties" =>$Agreement_Between_Parties,
        "Agreement File Name" =>$agreement_parties,
        "Self Declaration" =>$Self_declaration,
        "Self Dclr File Name" =>'',
        "Incorporation Certificate" =>$Certificate_Incorporation_wt,
        "Incorporation Cert File Name" =>$Certificate_Incorporation,
        "Balance sheet_Auditor Fin_" =>$Balance_sheet_wt,
        "BS_AF File Name" =>$Balance_sheet,
        "Modification" =>1
    ];
    $sqlDOC =DB::table($this->vendorTable)
    ->where('Agency Code',@$agencyFind->{'Agency Code'})
    ->update($DOCupdate);
    $data_id =@$agencyFind->{'Agency Code'};
    $msg ='Data Save Successfully! Please note the '.$data_id.' reference number for future use.';
        if($sqlDOC){
            return $this->sendResponse($data_id,$msg);
        }else{
            return $this->sendError('Some Error Occurred !');
        }
}
/* ===================================End Fourth Insert Update======================================*/
/*====================================Start Show Details =========================================*/

public function ShowDetails($userID =''){
        $screentable ='BOC$Digital Cinema Screen$3f88596c-e20d-438c-a694-309eb14559b2';
        $vendorData =DB::table($this->vendorTable)->where('User ID',$userID)->first();
        $DigitalScreen =DB::table($screentable)
        ->where('Agency Code',@$vendorData->{'Agency Code'})
        ->get();
        $response =[
                'vendorData' =>$vendorData,
                'DigitalScreen' =>$DigitalScreen
                ];
        return $response;
}


// public function import() 
// {
   
// }
/*====================================End Show Details============================================*/
}
