<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use App\Models\Api\Reginal_National;
use DB;
use Session;
class ResionalNaController extends Controller
{
    use CommonTrait;
 /*==========================Start first Tab Insert and update data =======================*/
      public function reginalOwnerData(Request $request)
    {
       $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $OwnerTable ='BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $msg = '';
        $unique_id ='';
        $userid =session::get('UserID');
            $emailFind=DB::table($OwnerTable)->select('Owner ID','Email ID')->where('Email ID',$request->email)->first();
           //dd($emailFind->{'Owner ID'});
                  $owner_name=
                    isset($request->owner_name) ? $request->owner_name:'';
                    $mobile=
                    isset($request->mobile) ? $request->mobile:'';
                    $email=
                    isset($request->email) ? $request->email:'';
                    $phone=
                    isset($request->phone_no) ? $request->phone_no:'';
                    $fax_no=
                    isset($request->fax) ? $request->fax:'';
                    $address=
                    isset($request->address) ? $request->address:'';
                    $city=
                    isset($request->city) ? $request->city:'';
                    $district=
                    isset($request->district) ? $request->district:'';
                    $state=
                    isset($request->state) ? $request->state:'';
            if(empty(@$emailFind->{'Email ID'}))
            {
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
                0,'','','','','','','','','','','".$userid."'
                ,'','','','','','','','','','','','','','','','','','','','','','','','','',
                '','',0)"
                );


                $msg = 'Data Saved Successfully!';
                if ($sql){
                return $this->sendResponse($owner_id, $msg);
                }
            }
            else
            {

                $update = array(
                    'Owner Name' => $request->owner_name,
                    'Mobile No_' => $request->mobile,
                    'Email ID' => $request->email,
                    'Phone No_' => $phone,
                    'Fax No_' => $fax_no,
                    'Address 1' => $request->address,
                    'City' => $request->city,
                    'District' => $request->district,
                    'State' => $request->state,
                    'User ID' =>$userid
                );
                //dd($OwnerTable);
                $sql =DB::table($OwnerTable)->where('Email ID',$request->email)->update($update);
                //dd($sql);
                $msg = 'Data Updated Successfully!';
            }
        if($sql){
            return $this->sendResponse(@$emailFind->{'Owner ID'}, $msg);
            }else{
            return $this->sendError('Some Error Occurred!.');
            exit;
           }
    }
/*==========================End  first Tab Insert and update data =======================*/
/*=====================Start Second Tab Insert and update data ===========================*/
public function ChanalInformation(Request $request){
    $datalang =(new api)->getLanguages();
    $datala =json_decode(json_encode($datalang),true);
    $Languages=$datala['original']['data'];
    $msg ='';
    $WBdata =DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')->select('Owner ID')->where('Email ID',$request->email)->first();
    $userid =session::get('UserID');
    $Channel = 'BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2';
/*=================================Start Generate Channel ID=================================*/
    // $Channel_id = DB::select('select TOP 1 [Channel ID] from [dbo].[BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2] order by [Channel ID] desc');

    $Channel_id=DB::table('BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2')->select('Channel ID')->where('Channel ID','LIKE','%'.'TCF'.'%')->orderBy('Channel ID','DESC')->first();
    if (empty($Channel_id)) {
        $Channel_id = 'TCF000001';
    } else {
       $Channel_id = $Channel_id->{"Channel ID"};
       $Channel_id++;
    }
/*=================================End Generate Channel ID=================================*/

/*=================================Get Channel ID=================================*/
    $chanelID =DB::table($Channel)->select('Channel ID')->where('User ID',$userid)->first();
/*=================================End Get Channel ID=================================*/
    //AV TV Information
    $chanel_name = $request->chanel_name ?? '';
    $company_Group = $request->company_Group ?? '';
    $Uplinking_valid_upto = $request->Uplinking_valid_upto ?? '';
    $Down_linking_valid_upto = $request->Down_linking_valid_upto ?? '';
    $EMMC_License_No = $request->EMMC_License_No ?? '';
    $Date_of_EMMC =$request->Date_of_EMMC ?? '1970-01-01 00:00:00.000';
    $Legal_status_of_company =$request->Legal_status_of_company ?? '';
    $Head_of_Company =$request->Head_of_Company ?? '';
    $Month_launch = $request->Month_launch ?? '0';
    $Year_launch = $request->Year_launch ?? '0';
    $Genre_of_channel =$request->Genre_of_channel ?? '';
    $Regional_Language ='';
    $DO_Address = $request->DO_Address ?? '';
    $Do_contact_name = $request->Do_contact_name ?? '';
    $DO_State =$request->DO_State ?? '';
    $DO_District =$request->DO_District ?? '';
    $DO_City  =$request->DO_City ?? '';
    $DO_Phone =$request->DO_Phone ?? '';
    $DO_Fax =$request->DO_Fax ?? '';
    $DO_Mobile =$request->DO_Mobile ?? '';
    $DO_Email  = $request->DO_Email ?? '';
    $HO_contact_name = $request->HO_contact_name ?? '';
    $HO_contact_name = $request->HO_contact_name ?? '';
    $HO_Address =$request->HO_Address ?? '';
    $HO_State =$request->HO_State ?? '';
    $HO_District =$request->HO_District ?? '';
    $HO_City =$request->HO_City ?? '';
    $HO_Phone =$request->HO_Phone ?? '';
    $HO_Fax =$request->HO_Fax ?? '';
    $HO_Mobile =$request->HO_Mobile ?? '';
    $HO_Email =$request->HO_Email ?? '';
    //End AV TV Information
    //Account Details
    $bank_account_no =$request->bank_account_no ?? '';
    $account_holder_name =$request->account_holder_name ?? '';
    $ifsc_code =$request->ifsc_code ?? '';
    $bank_name =$request->bank_name ?? '';
    $branch_name =$request->branch_name ?? '';
    $address_of_account =$request->address_of_account ?? '';
    $pan_card =$request->pan_card ?? '';
    $GST_No =$request->GST_No ?? '';
    $ESI_account_no =$request->ESI_account_no ?? '';
    $ESI_no_employees =$request->ESI_no_employees ?? 0;
    $EPF_account_no =$request->EPF_account_no ?? '';
    $EPF_no_of_employees =$request->EPF_no_of_employees ?? '';
    $Streaming_Start_Date =$request->Streaming_Start_Date ?? '';
    //End Account Dettails
    //Upload document
    $FetchAllDoc =DB::table('BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
    $destinationPath =public_path().'/uploads/AV-TV-Reginal-National/';
    $Linking_Certificate ='';
    $EMMC_Certificate_EM ='';
    $Fixed_Point_Chart_cr ='';
    $Cancelled_Cheque  ='';
    $Teleport_Operator_Certifitel ='';
    $Auditor_Certificate ='';
    $Sr_Management_Attestation ='';
    $affirm=$request->affirm ?? 0;
    $Third_Party_Certification = '';
    $Different_CS_Signed_List = '';
    //Uplinking & Down-linking certificate of the channel.
    $Up_Down_lig_re_DB =$FetchAllDoc->{'Linking Certificate File Name'} ?? '';
    if($request->hasFile('Uplinking_Down_linking') || $request->hasFile('Uplinking_Down_linking_modify')){
    $Uplinking_Down_linking =$request->file('Uplinking_Down_linking') ?? $request->file('Uplinking_Down_linking_modify');
    $Up_Down_lig_re =time().'-'.$Uplinking_Down_linking->getClientOriginalName();
    $upload_up_down =$Uplinking_Down_linking->move($destinationPath,$Up_Down_lig_re);
    if($upload_up_down){
      $Linking_Certificate =1;
    }
    }else{
        $Up_Down_lig_re ='';
        if($Up_Down_lig_re_DB !=''){
            $Up_Down_lig_re =$Up_Down_lig_re_DB;
            $Linking_Certificate =1;
        }

    }




    //reginal and national
    $Reginal_National='';
    if($request->reginal_type =='Regional'){
        $Reginal_National =0;
    }else{
        $Reginal_National =1;
    }
    //dd($Up_Down_lig_re);
    //- EMMC certificate telecasting over the last 12 months.
    $EMMC_certificate_re_DB =$FetchAllDoc->{'EMMC File Name'} ?? '';
    if($request->hasFile('EMMC_certificate') || $request->hasFile('EMMC_certificate_modify')){
    $EMMC_certificate =$request->file('EMMC_certificate') ?? $request->file('EMMC_certificate_modify');
    $EMMC_certificate_re =time().'-'.$EMMC_certificate->getClientOriginalName();
    $upload_EMMC_cer =$EMMC_certificate->move($destinationPath,$EMMC_certificate_re);
    if($upload_EMMC_cer){
      $EMMC_Certificate_EM =1;
    }
    }else{
        $EMMC_certificate_re ='';
        if($EMMC_certificate_re_DB !=''){
            $EMMC_certificate_re =$EMMC_certificate_re_DB;
            $EMMC_Certificate_EM =1;
        }

    }
    //- Fixed Point Chart (FPC) for the previous 12 months from 6AM to 11PM during
    $Fixed_Point_Chart_re_DB =$FetchAllDoc->{'FP Chart File Name'} ?? '';
    if($request->hasFile('Fixed_Point_Chart') || $request->hasFile('Fixed_Point_Chart_modify')){
    $Fixed_Point_Chart =$request->file('Fixed_Point_Chart') ?? $request->file('Fixed_Point_Chart_modify');
    $Fixed_Point_Chart_re =time().'-'.$Fixed_Point_Chart->getClientOriginalName();
    $upload_Fixed_Point =$Fixed_Point_Chart->move($destinationPath, $Fixed_Point_Chart_re);
    if($upload_Fixed_Point){
        $Fixed_Point_Chart_cr =1;
    }
    }else{
        $Fixed_Point_Chart_re ='';
        if($Fixed_Point_Chart_re_DB !=''){
            $Fixed_Point_Chart_re =$Fixed_Point_Chart_re_DB;
            $Fixed_Point_Chart_cr =1;
        }

    }
    //Scan copy of cancelled cheque.
    $ancelled_cheque_re_DB =$FetchAllDoc->{'Cancelled Cheque File Name'} ?? '';
    if($request->hasFile('ancelled_cheque') || $request->hasFile('ancelled_cheque_modify')){
    $ancelled_cheque =$request->file('ancelled_cheque') ?? $request->file('ancelled_cheque_modify');
    $ancelled_cheque_re =time().'-'.$ancelled_cheque->getClientOriginalName();
    $upload_ancelled_cheq =$ancelled_cheque->move($destinationPath,$ancelled_cheque_re);
    if($upload_ancelled_cheq){
        $Cancelled_Cheque =1;
    }

    }else{
        $ancelled_cheque_re ='';
        if($ancelled_cheque_re_DB!=''){
            $ancelled_cheque_re=$ancelled_cheque_re_DB;
            $Cancelled_Cheque =1;
        }

    }
    //Teleport operator certificate.
    $Teleport_operator_certificate_re_DB =$FetchAllDoc->{'TOC File Name'} ?? '';
    if($request->hasFile('Teleport_operator_certificate') || $request->hasFile('Teleport_operator_certificate_modify')){
       $Teleport_op_cert =$request->file('Teleport_operator_certificate') ?? $request->file('Teleport_operator_certificate_modify');
       $Teleport_operator_certificate_re=time().'-'.$Teleport_op_cert->getClientOriginalName();
       $upload_Teleport_op_cert =$Teleport_op_cert->move($destinationPath,$Teleport_operator_certificate_re);
       if($upload_Teleport_op_cert){
            $Teleport_Operator_Certifitel =1;
        }
    }else{
        $Teleport_operator_certificate_re ='';
        if($Teleport_operator_certificate_re_DB !=''){
            $Teleport_operator_certificate_re=$Teleport_operator_certificate_re_DB;
            $Teleport_Operator_Certifitel =1;
        }
    }
    //Last year's certificate duly signed by the Auditor/Company.
    $Last_year_cr_re_DB =$FetchAllDoc->{'Auditor File Name'} ?? '';
    if($request->hasFile('Last_year_certificate') || $request->hasFile('Last_year_certificate_modify')){
        $Last_year_certificate =$request->file('Last_year_certificate') ?? $request->file('Last_year_certificate_modify');
        $Last_year_cr_re=time().'-'.$Last_year_certificate->getClientOriginalName();
$upload_year_certificate =$Last_year_certificate->move($destinationPath,$Last_year_cr_re);
        if($upload_year_certificate){
            $Auditor_Certificate =1;
        }
    }else{
        $Last_year_cr_re ='';
        if($Last_year_cr_re_DB !=''){
        $Last_year_cr_re=$Last_year_cr_re_DB;
        $Auditor_Certificate =1;
        }

    }
    //- A letter attested by Senior Management Level Executive,Giving Name, Designation &  Signatures.
    $letter_attested_re_DB =$FetchAllDoc->{'SMA File Name'} ?? '';
    if($request->hasFile('letter_attested') || $request->hasFile('letter_attested_modify')){
    $letter_attested =$request->file('letter_attested') ?? $request->file('letter_attested_modify');
    $letter_attested_re =time().'-'.$letter_attested->getClientOriginalName();
    $upload_letter_attested =$letter_attested->move($destinationPath,$letter_attested_re);
    if($upload_letter_attested){
        $Sr_Management_Attestation =1;
        }
    }else{
        $letter_attested_re ='';
        if($letter_attested_re_DB !=''){
            $letter_attested_re=$letter_attested_re_DB;
            $Sr_Management_Attestation =1;
        }

    }
    //A letter indicating whether or not the channel would be able to provide a third party certification of the Advertisement telecast for DAVP/ Government of India.
    $Government_India_re_DB =$FetchAllDoc->{'TPC File Name'} ?? '';
    if($request->hasFile('Government_India') || $request->hasFile('Government_India_modify')){
    $Government_India =$request->file('Government_India') ?? $request->file('Government_India_modify');
    $Government_India_re =time().'-'.$Government_India->getClientOriginalName();
    $upload_Government_India =$Government_India->move($destinationPath,$Government_India_re);
    if($upload_Government_India){
        $Third_Party_Certification=1;
    }
    }else{
        $Government_India_re='';
        if($Government_India_re_DB !=''){
            $Government_India_re=$Government_India_re_DB;
            $Third_Party_Certification=1;
        }

    }
    //A signed list of the different C&S. TV Channel in the Group/Holding Company/ Company to which the applicant channel belongs to.
    //End Upload document
    $applicant_appl_chnel_re_DB =$FetchAllDoc->{'DC&SL File Name'} ?? '';
    if($request->hasFile('applicant_channel_belongs') || $request->hasFile('applicant_channel_belongs_modify')){
    $appl_chnel_belongs =$request->file('applicant_channel_belongs') ?? $request->file('applicant_channel_belongs_modify');
    $applicant_appl_chnel_re =time().'-'.$appl_chnel_belongs->getClientOriginalName();
    $upload_appl_chnel =$appl_chnel_belongs->move($destinationPath,$applicant_appl_chnel_re);
    if($upload_appl_chnel){
        $Different_CS_Signed_List =1;
    }
    }else{
        $applicant_appl_chnel_re ='';
        if($applicant_appl_chnel_re_DB !=''){
            $applicant_appl_chnel_re =$applicant_appl_chnel_re_DB;
            $Different_CS_Signed_List =1;
        }

    }
    if(!empty($request->HO_same_as_DO)){
        $HO_same_as_DO = $request->HO_same_as_DO;
    }else{
         $HO_same_as_DO = 0;
    }

      //Modification update
    if($request->submit_doc == 1){
        $modification = 1;
    }else{
        $modification = 0;
    }
    //Receiver ID
    $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
    $get_receiver_code = DB::select("select TOP 1 [AV Empanel Landing UID] from dbo.$receiver_table");
    $recervier_id = $get_receiver_code[0]->{"AV Empanel Landing UID"};
    $ldate = date('Y-m-d');
    //End Receiver ID
    if($chanelID ==''){
    $insert =array(
      "Channel ID" => $Channel_id,
      "Channel Name"=>$chanel_name,
      "Parent Company Name" =>$company_Group,
      "Owner ID"=>$WBdata->{'Owner ID'},
      "EMMC License No_" =>$EMMC_License_No,
      "EMMC Date" =>$Date_of_EMMC,
      "Regional_Language Type" =>$Regional_Language,
      "HO Contact Name" => $HO_contact_name,
      "HO Address" =>$HO_Address,
      "HO Landline No_(with STD)" =>$HO_Phone,
      "HO Fax No_" =>$HO_Fax,
      "HO E-Mail" =>$HO_Email,
      "HO Mobile No_" =>$HO_Mobile,
      "HO Same Address DO" =>$HO_same_as_DO,
      "HO PIN Code" =>'',
      "HO City" =>$HO_City,
      "HO State" =>$HO_State,
      "HO District" =>$HO_District,
      "DO Contact Name" =>$Do_contact_name,
      "DO Address" =>$DO_Address,
      "DO Landline No_(with STD)" =>$DO_Phone,
      "DO Fax No_" =>$DO_Fax,
      "DO E-Mail" =>$DO_Email,
      "DO Mobile No_" =>$DO_Mobile,
      "DO PIN Code" =>'',
      "DO City" =>$DO_City,
      "DO State" =>$DO_State,
      "DO District" =>$DO_District,
      "Channel Type" =>$Reginal_National,
      "GST No_" =>'',
      "ESI A_C No_" =>'',
      "ESI - No_ Of Employee" =>'',
      "EPF A_C No_" =>'',
      "EPF - No_ Of Employee" =>'',
      "A_C Holder Name" =>'',
      "Bank A_C Address" =>'',
      "PAN" =>'',
      "Bank Name"=>'',
      "Bank Branch" =>'',
      "IFSC Code"=>'',
      "Account No_"=>'',
      "Linking Certificate"=>0,
      "EMMC Certificate" =>0,
      "Fixed Point Chart" =>'',
      "Cancelled Cheque" =>'',
      "Teleport Operator Certificate" =>0,
      "Auditor Certificate" =>0,
      "Sr_ Management Attestation" =>'',
      "Self-declaration" =>0,
      "Linking Certificate File Name" =>'',
      "EMMC File Name" =>'',
      "FP Chart File Name" =>'',
      "Cancelled Cheque File Name" =>'',
      "TOC File Name" =>'',
      "Auditor File Name" =>'',
      "Authorized Rep Name" =>'',
      "AR Address" =>'',
      "AR Landline No_" =>'',
      "AR FAX No_" =>'',
      "AR Mobile No_" =>'',
      "AR E-mail" =>'',
      "SMA File Name" =>'',
      "Third Party Certification"=>0,
      "TPC File Name" =>'',
      "PAN Attached"=>'',
      "PAN File Name"=>'',
      "Uplinking Validity Date" =>$Uplinking_valid_upto,
      "Downlinking Validity Date" =>$Down_linking_valid_upto,
      "Company Legal Status" =>$Legal_status_of_company,
      "Launch Month" =>$Month_launch,
      "Launch Year" =>$Year_launch,
      "Channel Director_CEO" =>$Head_of_Company,
      "Channel Genre" =>$Genre_of_channel,
      "Different C&S Signed List" =>'',
      "DC&SL File Name" =>'',
      "OHO Same Address ODO" =>0,
      "User ID" => $userid,
      "Status" =>0,
      "Sender ID"=>'',
      "Receiver ID"=>$recervier_id,
      "Rate 6-12" =>0,
      "Empanelment Category"=>2,
      "Global Dimension 1 Code"=>'M002',
      "Global Dimension 2 Code"=>0,
       "Modification" =>0,
       "Alocated AV Code" =>'',
       "Agr File Path" =>'',
       "Agr File Name" =>'',
       "From Date" =>'1970-01-01 00:00:00.000',
       "To Date" =>'1970-01-01 00:00:00.000',
       'Recommended To Committee'=>0,
       'Streaming Start Date' =>$Streaming_Start_Date,
       'Rate 12-17'=>0,
       "Rate 17-23"=>0,
       "Rate 7-9" =>0,
       "Rate 9-12"=>0,
       "Rate 12-19"=>0,
       "Rate 19-20"=>0,
       "Rate 20-22"=>0,
       "Rate 22-23"=>0,
       "Application Date"=>$ldate,
       'Empanel Date' => '1753-01-01'
      );
    $sql2 =DB::table($Channel)->insert($insert);
    $msg ="AV TV Information Save Successfully";
            if($sql2){
                return $this->sendResponse($Channel_id,$msg);
            }else{
                return $this->sendError('Went Something Wrong!');
            }

    }else{
    $update =[
      "Channel Name"=>$chanel_name,
      "Parent Company Name" =>$company_Group,
      "Owner ID"=>$WBdata->{'Owner ID'},
      "EMMC License No_" =>$EMMC_License_No,
      "EMMC Date" =>$Date_of_EMMC,
      "Regional_Language Type" =>$Regional_Language,
      "HO Contact Name" =>$HO_contact_name,
      "HO Address" =>$HO_Address,
      "HO Landline No_(with STD)" =>$HO_Phone,
      "HO Fax No_" =>$HO_Fax,
      "HO E-Mail" =>$HO_Email,
      "HO Mobile No_" =>$HO_Mobile,
      "HO Same Address DO" =>$HO_same_as_DO,
      "HO City" =>$HO_City,
      "HO State" =>$HO_State,
      "HO District" =>$HO_District,
      "DO Address" =>$DO_Address,
      "DO Contact Name" =>$Do_contact_name,
      "DO Landline No_(with STD)" =>$DO_Phone,
      "DO Fax No_" =>$DO_Fax,
      "DO E-Mail" =>$DO_Email,
      "DO Mobile No_" =>$DO_Mobile,
      "DO City" =>$DO_City,
      "DO State" =>$DO_State,
      "DO District" =>$DO_District,
      "Channel Type" =>$Reginal_National,
      "ESI A_C No_" =>$ESI_account_no,
      "ESI - No_ Of Employee" =>$ESI_no_employees,
      "EPF A_C No_" =>$EPF_account_no,
      "EPF - No_ Of Employee" =>$EPF_no_of_employees,
      "A_C Holder Name" =>$account_holder_name,
      "Bank A_C Address" =>$address_of_account,
      "PAN" =>$pan_card,
      "GST No_" =>$GST_No,
      "Bank Name"=>$bank_name,
      "Bank Branch" =>$branch_name,
      "IFSC Code"=>$ifsc_code,
      "Account No_"=>$bank_account_no,
      "Linking Certificate"=>$Linking_Certificate,
      "EMMC Certificate" =>$EMMC_Certificate_EM,
      "Fixed Point Chart" =>$Fixed_Point_Chart_cr,
      "Cancelled Cheque" =>$Cancelled_Cheque,
      "Teleport Operator Certificate" =>$Teleport_Operator_Certifitel,
      "Auditor Certificate" =>$Auditor_Certificate,
      "Sr_ Management Attestation" =>$Sr_Management_Attestation,
      "Self-declaration" =>$affirm,
      "Linking Certificate File Name" =>$Up_Down_lig_re,
      "EMMC File Name" =>$EMMC_certificate_re,
      "FP Chart File Name" =>$Fixed_Point_Chart_re,
      "Cancelled Cheque File Name" =>$ancelled_cheque_re,
      "TOC File Name" =>$Teleport_operator_certificate_re,
      "Auditor File Name" =>$Last_year_cr_re,
      "SMA File Name" =>$letter_attested_re,
      "Third Party Certification"=>$Third_Party_Certification,
      "TPC File Name" =>$Government_India_re,
      "Different C&S Signed List"=>$Different_CS_Signed_List,
      "DC&SL File Name"=>$applicant_appl_chnel_re,
      "Uplinking Validity Date" =>$Uplinking_valid_upto,
      "Downlinking Validity Date" =>$Down_linking_valid_upto,
      "Company Legal Status" =>$Legal_status_of_company,
      "Launch Month" =>$Month_launch,
      "Launch Year" =>$Year_launch,
      "Channel Director_CEO" =>$Head_of_Company,
      "Channel Genre" =>$Genre_of_channel,
      "Status"=>0,
      "Modification" =>$modification,
      "Streaming Start Date" =>$Streaming_Start_Date
        ];
    $sql2 =DB::table($Channel)->where('Channel ID',$chanelID->{'Channel ID'})->update($update);
    $msg ='Data Save Successfully! Please note the '.$chanelID->{'Channel ID'}.' reference number for future use.';
            if($sql2){
            return $this->sendResponse($chanelID->{'Channel ID'},$msg);
        }else{
            return $this->sendError('Went Something Wrong!');
        }
        }

    }
    /*================================End Second Tab Insert data ===========================*/
    /*================================Start ShowDetails ====================================*/
    public function ShowDetailsAVTV($UserID =''){
    $msg ='';
    $Chanal_Details =DB::table('BOC$Vendor Emp - Channel$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$UserID)->first();
    $OwnerDetails =DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2')
    ->where('Owner ID',@$Chanal_Details->{'Owner ID'})
    ->first();
    $response =
    [
    'Chanal_Details' =>$Chanal_Details,
    'OwnerDetails' =>$OwnerDetails
    ];
    return $response;
    }
     /*================================End ShowDetails ====================================*/
}
