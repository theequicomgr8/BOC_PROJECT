<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Api\BlukSms;
use Carbon\Carbon;
use DB;
use Session;

class ApiBulkSmsController extends Controller
{

	use CommonTrait;
  private $vendorTable='BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2';

	public function bulkSmssaveData(Request $request)
	{
		$table='[BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2]';
		$msg= '';
			$agency_name =$request->agency_name ?? '';
			$email= $request->email ?? '';
			$bulk_address = $request->bulk_address ?? '';
			$state = $request->state ?? '';
			$district = $request->district ?? '';
			$city = $request->city ?? '';
			$mobile = $request->mobile ?? '';
			$phone_no = $request->phone_no ?? '';
			$fax_no = $request->fax_no ?? '';
			$tel_circle_cat = $request->tel_circle_cat ?? '';
			$tel_circle = $request->tel_circle ?? '';
      //accout Details
      $bank_account= $request->bank_account ?? '';
      $acc_holder_name= $request->acc_holder_name ?? '';
      $bank_name= $request->bank_name ?? '';
      $branch= $request->branch ?? '';
      $ifsc_code= $request->ifsc_code ?? '';
      $bank_address= $request->bank_address ?? '';
      $pan_card= $request->pan_card ?? '';
      $gst= $request->gst ?? '';
      $esi_acc_number= $request->esi_acc_number ?? '';
      $esi_employees_covered= $request->esi_employees_covered ?? '';
      $esp_acc_number= $request->esp_acc_number ?? '';
      $esp_employees_covered= $request->esp_employees_covered ?? '';
      //Doc File
                    $TRAI_Registration_Certificate ='';
                    $PAN_Upload ='';
                    $GST_Upload ='';
                    $Job_Order_Copy ='';
                    $Throughput_Report ='';
                    $Bulk_SMS_Doc_Proof ='';
                    $L10_OBD_Call_Doc_Proof ='';
                    $L50_OBD_Call_Doc_Proof ='';
                    $Affidavit_For_Non_Suspension ='';
                    $Affidavit_For_Director ='';
                    $Mobile_number_Own_DB ='';
                    $Incorporation_Certificate ='';
    $user_id = Session::get('UserID');
       $Agency_id = DB::table($this->vendorTable)
       ->where('User ID',$user_id)
       ->first();
    $destinationPath =public_path().'/uploads/bulk-sms/';

    $TRAI =@$Agency_id->{'TRAI RC File Name'} ?? '';
    if($request->hasFile('TRAI_RC_File_Name')){
    $file =$request->file('TRAI_RC_File_Name');
    $TRAI_RC_File_Name =time().'-'.$file->getClientOriginalName();
    $upload_ancelled_cheq =$file->move($destinationPath,$TRAI_RC_File_Name);
    if($upload_ancelled_cheq){
        $TRAI_Registration_Certificate =1;
    }

    }else{
      if(!empty($TRAI)){
        $TRAI_RC_File_Name=$TRAI;
        $TRAI_Registration_Certificate =1;

      }else{
        $TRAI_RC_File_Name ='';
      }

      }

    $JOC_File_DB =@$Agency_id->{'JOC File Name'} ?? '';
    if($request->hasFile('JOC_File_Name')){
      $JOC_File_Name =$request->file('JOC_File_Name');
      $JOC_File_Name_re =time().'_'.$JOC_File_Name->getClientOriginalName();
      $upload_JOC_File_Name =$JOC_File_Name->move($destinationPath,$JOC_File_Name_re);
      if($upload_JOC_File_Name){
        $Job_Order_Copy =1;
      }
    }else{
      if(!empty($JOC_File_DB)){
         $Job_Order_Copy =1;
        $JOC_File_Name_re =$JOC_File_DB;
      }else{
        $JOC_File_Name_re='';
      }

    }

    //Throughput_File_Name
    $Throughput_DB =@$Agency_id->{'Throughput File Name'} ?? '';
    if($request->hasFile('Throughput_File_Name')){
      $Throughput_File_Name =$request->file('Throughput_File_Name');
      $Throughput_File_Name_re =time().'-'.$Throughput_File_Name->getClientOriginalName();
      $upload_Throughput = $Throughput_File_Name->move($destinationPath,$Throughput_File_Name_re);
      if($upload_Throughput){
        $Throughput_Report =1;
      }
    }else{
      if(!empty($Throughput_DB)){
        $Throughput_File_Name_re =$Throughput_DB;
        $Throughput_Report =1;
      }else{
        $Throughput_File_Name_re ='';
      }

    }
    //Bulk SDP File Name
    $Bulk_SDP_DB =@$Agency_id->{'Bulk SDP File Name'} ?? '';
    if($request->hasFile('Bulk_SDP_File_Name')){
      $Bulk_SDP_File_Name =$request->file('Bulk_SDP_File_Name');
      $Bulk_SDP_File_Name_re =time().'-'.$Bulk_SDP_File_Name->getClientOriginalName();
      $upload_Bulk_SDP =$Bulk_SDP_File_Name->move($destinationPath,$Bulk_SDP_File_Name_re);
      if($upload_Bulk_SDP){
        $Bulk_SMS_Doc_Proof =1;
      }
    }else{
      if(!empty($Bulk_SDP_DB)){
        $Bulk_SMS_Doc_Proof =1;
        $Bulk_SDP_File_Name_re =$Bulk_SDP_DB;
      }else{
        $Bulk_SDP_File_Name_re ='';
      }

    }
    //10L OBD Call File Name
    $OBD_DB =@$Agency_id->{'10L OBD Call File Name'} ?? '';
    if($request->hasFile('OBD_Call_File_Name1')){
      $OBD_Call_File_Name1 =$request->file('OBD_Call_File_Name1');
      $OBD_Call_File_Name1_re =time().'-'.$OBD_Call_File_Name1->getClientOriginalName();
      $uploads_OBD =$OBD_Call_File_Name1->move($destinationPath,$OBD_Call_File_Name1_re);
      if($uploads_OBD){
            $L10_OBD_Call_Doc_Proof=1;
      }
    }else{
      if(!empty($OBD_DB)){
        $L10_OBD_Call_Doc_Proof=1;
        $OBD_Call_File_Name1_re=$OBD_DB;
      }else{
        $OBD_Call_File_Name1_re='';
      }

    }

    //50L OBD Cal File Name
    $OBD_DB50 =@$Agency_id->{'50L OBD Cal File Name'} ?? '';
    if($request->hasFile('OBD_Call_File_Name2')){
      $OBD_Call_File_Name2 =$request->file('OBD_Call_File_Name2');
      $OBD_Call_File_Name2_re =time().'-'.$OBD_Call_File_Name2->getClientOriginalName();
      $uploads_OBD_CallName2 =$OBD_Call_File_Name2->move($destinationPath,$OBD_Call_File_Name2_re);
      if($uploads_OBD_CallName2){
        $L50_OBD_Call_Doc_Proof =1;
      }
    }else{
      if(!empty($OBD_DB50)){
        $L50_OBD_Call_Doc_Proof =1;
        $OBD_Call_File_Name2_re=$OBD_DB50;
      }else{
         $OBD_Call_File_Name2_re='';
      }

    }

    //Affidavit For NS File Name
    $Affidavit_ns_DB =@$Agency_id->{'Affidavit For NS File Name'} ?? '';
    if($request->hasFile('Affidavit_For_NS_File_Name')){
    $Affidavit_For_NS_File_Name =$request->file('Affidavit_For_NS_File_Name');
    $Affidavit_For_NS_File_Name_re  =time().'-'.$Affidavit_For_NS_File_Name->getClientOriginalName();
    $upload_Affidavit_NS_File =$Affidavit_For_NS_File_Name->move($destinationPath,$Affidavit_For_NS_File_Name_re);
    if($upload_Affidavit_NS_File){
     $Affidavit_For_Non_Suspension =1;
    }

    }else{
      if(!empty($Affidavit_ns_DB)){
        $Affidavit_For_Non_Suspension =1;
         $Affidavit_For_NS_File_Name_re =$Affidavit_ns_DB;
      }else{
        $Affidavit_For_NS_File_Name_re ='';
      }


    }

    //Affidavit_For_Dir_File_Name
    $Affidavit_Dir_DB =@$Agency_id->{'Affidavit For Dir File Name'} ?? '';
    if($request->hasFile('Affidavit_For_Dir_File_Name')){
      $Affidavit_For_Dir_File_Name =$request->file('Affidavit_For_Dir_File_Name');
      $Affidavit_For_Dir_re =time().'-'.$Affidavit_For_Dir_File_Name->getClientOriginalName();
      $uploads_Affidavit_For_Dir =$Affidavit_For_Dir_File_Name->move($destinationPath,$Affidavit_For_Dir_re);
      if($uploads_Affidavit_For_Dir){
        $Affidavit_For_Director =1;
      }
    }else{
      if(!empty($Affidavit_Dir_DB)){
        $Affidavit_For_Director =1;
        $Affidavit_For_Dir_re =$Affidavit_Dir_DB;
      }else{
        $Affidavit_For_Dir_re ='';
      }

    }
    //Mobile number ODB File Name
     $Mobile_DB =@$Agency_id->{'Mobile number ODB File Name'} ?? '';
    if($request->hasFile('Mobile_number_ODB_File_Name')){
      $Mobile_number_ODB_File_Name =$request->file('Mobile_number_ODB_File_Name');
      $Mobile_number_ODB_File_Name_re =time().'-'.$Mobile_number_ODB_File_Name->getClientOriginalName();
          $uploads_Mobile_number =$Mobile_number_ODB_File_Name->move($destinationPath,$Mobile_number_ODB_File_Name);
      if($uploads_Mobile_number){
        $Mobile_number_Own_DB =1;
      }
    }else{
      if(!empty($Mobile_DB)){
        $Mobile_number_Own_DB =1;
        $Mobile_number_ODB_File_Name_re =$Mobile_DB;
      }else{
        $Mobile_number_ODB_File_Name_re ='';
      }

    }
    //Incorporation_Cert_File_Name
    $Incorporation_DB =@$Agency_id->{'Incorporation Cert File Name'} ?? '';
    if($request->hasFile('Incorporation_Cert_File_Name')){
      $Incorporation_Cert_File_Name =$request->file('Incorporation_Cert_File_Name');
      $Incorporation_Cert_File_Name_re =time().'-'.$Incorporation_Cert_File_Name->getClientOriginalName();
      $uploads_Incorporation = $Incorporation_Cert_File_Name->move($destinationPath,$Incorporation_Cert_File_Name);
      if($uploads_Incorporation){
        $Incorporation_Certificate =1;
      }
    }else{
      if(!empty($Incorporation_DB)){
        $Incorporation_Certificate =1;
        $Incorporation_Cert_File_Name_re =$Incorporation_DB;
      }else{
        $Incorporation_Cert_File_Name_re ='';
      }

    }

    //PAN_Upload_File_Name
    $pan_DB =@$Agency_id->{'PAN Upload File Name'} ?? '';
    if($request->hasFile('PAN_Upload_File_Name')){
      $PAN_Upload_File_Name =$request->file('PAN_Upload_File_Name');
      $PAN_Upload_File_Name_re =time().'-'.$PAN_Upload_File_Name->getClientOriginalName();
      $upload_PAN =$PAN_Upload_File_Name->move($destinationPath,$PAN_Upload_File_Name_re);
      if($upload_PAN){
        $PAN_Upload =1;
      }

    }else{
      if(!empty($pan_DB)){
        $PAN_Upload =1;
        $PAN_Upload_File_Name_re =$pan_DB;
      }else{
         $PAN_Upload_File_Name_re ='';
      }

    }
    //GST Upload
      $gst_DB =@$Agency_id->{'GST Upload File Name'} ?? '';
    if($request->hasFile('GST_Upload_File_Name')){
      $GST_Upload_File_Name =$request->file('GST_Upload_File_Name');
      $GST_Upload_File_Name_re =time().'-'.$GST_Upload_File_Name->getClientOriginalName();
      $upload_gst =$GST_Upload_File_Name->move($destinationPath,$GST_Upload_File_Name_re);
      if($upload_gst){
        $GST_Upload = 1;
      }

    }else{
      if(!empty($gst_DB)){
        $GST_Upload = 1;
        $GST_Upload_File_Name_re = $gst_DB;
      }else{
        $GST_Upload_File_Name_re ='';
      }

    }

        if(!empty($GST_Upload_File_Name_re)){
          $modification =1;
        }else{
          $modification =0;
        }
    $Agency_Code ='';
      if (@$Agency_id->{'Agency Code'} == '') {
            // $Agency_Code = DB::select('select TOP 1 [Agency Code] from dbo.[BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2] order by [Agency Code] desc');
            $Agency_Code=DB::table('BOC$Vend Emp Bulk SMS$3f88596c-e20d-438c-a694-309eb14559b2')->select('Agency Code')->where('Agency Code','LIKE','%'.'SMS'.'%')->orderBy('Agency Code','desc')->first();
            if (empty($Agency_Code)) {
                $Agency_Code = 'SMS00001'; // New Create Agency Code
            } else {
                $Agency_Code = $Agency_Code->{"Agency Code"};
                $Agency_Code++;
            }

   			 // Get seesion userid

		$sql =DB::insert("
				insert into $table(
	  [timestamp],
      [Agency Code],
      [Agency Name],
      [Address 1],
      [Address 2],
      [City],
      [District],
      [State],
      [Mobile],
      [E-Mail],
      [Phone],
      [Fax],
      [Telecom Circle Category],
      [Telecom circle],
      [Account No_],
      [A_C Holder Name],
      [Bank Name],
      [Branch Name],
      [IFSC Code],
      [Account Address],
      [PAN],
      [GSTN],
      [ESI A_C No_],
      [No_ Of Emp in ESI],
      [EPF A_c No_],
      [No_ Of Emp in EPF],
      [TRAI Registration Certificate],
      [TRAI RC File Name],
      [PAN Upload],
      [PAN Upload File Name],
      [GST Upload],
      [GST Upload File Name],
      [Job Order Copy],
      [JOC File Name],
      [Throughput Report],
      [Throughput File Name],
      [Bulk SMS Doc Proof],
      [Bulk SDP File Name],
      [10L OBD Call Doc Proof],
      [10L OBD Call File Name],
      [50L OBD Call Doc Proof],
      [50L OBD Cal File Name],
      [Empanelment Category],
      [Global Dimension 1 Code],
      [Global Dimension 2 Code],
      [Affidavit For Non Suspension],
      [Affidavit For NS File Name],
      [Affidavit For Director],
      [Affidavit For Dir File Name],
      [Mobile number Own DB],
      [Mobile number ODB File Name],
      [Incorporation Certificate],
      [Incorporation Cert File Name],
      [User ID],
      [Status],
      [Recommended To Committee],
      [Agr File Path],
      [Agr File Name],
      [Sender ID],
      [Receiver ID],
      [Modification],
      [Alocated BS Code],
      [From Date],
      [To Date]
      )
      	values
            (
                DEFAULT,
                '".$Agency_Code."',
                '".$agency_name."',
                '".$bulk_address."',
                '',
                '".$city."',
                '".$district."',
                '".$state."',
                '".$mobile."',
                '".$email."',
                '".$phone_no."',
                '".$fax_no."',
                '".$tel_circle_cat."',
                '".$tel_circle."',
                '','','','','','','','','',0,'',0,0,'',0,'',0,'',0,'',0,'',0,'',0,'',0 ,'',8,'M004',
                '',0,'',0,'',0,'',0,'','".$user_id."',0,0,'','','','',0,'','1900-01-01 00:00:00.000',
                '1900-01-01 00:00:00.000')");
			$AGcode =$Agency_Code;
            //dd($AGcode);
			 $msg = 'Data Saved Successfully!';
       if($sql){
            return $this->sendResponse($AGcode, $msg);
        }
			 }
			 else {
                //dd($Agency_Code );
                $update = array(
                    'Agency Name' => $agency_name,
                    'Mobile' => $mobile,
                    'E-Mail' => $email,
                    'Phone' => $phone_no,
                    'Fax' => $fax_no,
                    'Address 1' => $bulk_address,
                    'City' => $city,
                    'State' => $state,
                    'District' => $district,
                    'Telecom Circle Category' => $tel_circle_cat,
                    'Telecom circle' => $tel_circle,
                    'Account No_'=> $bank_account,
                    'A_C Holder Name'=>$acc_holder_name,
                    'Bank Name'=> $bank_name,
                    'Branch Name'=> $branch,
                    'IFSC Code'=> $ifsc_code,
                    'Account Address'=> $bank_address,
                    'PAN'=> $pan_card,
                    'GSTN'=> $gst,
                    'ESI A_C No_'=> $esi_acc_number,
                    'No_ Of Emp in ESI'=> $esi_employees_covered,
                    'EPF A_C No_'=> $esp_acc_number,
                    'No_ Of Emp in EPF'=> $esp_employees_covered,
                    'TRAI Registration Certificate'=>$TRAI_Registration_Certificate,
                    'TRAI RC File Name'=>$TRAI_RC_File_Name,
                    'PAN Upload'=>$PAN_Upload,
                    'PAN Upload File Name'=>$PAN_Upload_File_Name_re,
                    'GST Upload'=>$GST_Upload,
                    'GST Upload File Name'=>$GST_Upload_File_Name_re,
                    'Job Order Copy'=>$Job_Order_Copy,
                    'JOC File Name'=>$JOC_File_Name_re,
                    'Throughput Report'=>$Throughput_Report,
                    'Throughput File Name'=>$Throughput_File_Name_re,
                    'Bulk SMS Doc Proof'=>$Bulk_SMS_Doc_Proof,
                    'Bulk SDP File Name'=>$Bulk_SDP_File_Name_re,
                    '10L OBD Call Doc Proof'=>$L10_OBD_Call_Doc_Proof,
                    '10L OBD Call File Name'=>$OBD_Call_File_Name1_re,
                    '50L OBD Call Doc Proof'=>$L50_OBD_Call_Doc_Proof,
                    '50L OBD Cal File Name'=>$OBD_Call_File_Name2_re,
                    'Affidavit For Non Suspension' =>$Affidavit_For_Non_Suspension,
                    'Affidavit For NS File Name' =>$Affidavit_For_NS_File_Name_re,
                    'Affidavit For Director' =>$Affidavit_For_Director,
                    'Affidavit For Dir File Name' =>$Affidavit_For_Dir_re,
                    'Mobile number Own DB' =>$Mobile_number_Own_DB,
                    'Mobile number ODB File Name' =>$Mobile_number_ODB_File_Name_re,
                    'Incorporation Certificate' =>$Incorporation_Certificate,
                    'Incorporation Cert File Name' =>$Incorporation_Cert_File_Name_re,
                    'Modification' => $modification
                );

                $sql = DB::table($this->vendorTable)->where('Agency Code',$Agency_id->{'Agency Code'})->update($update);
                $msg ='Data Save Successfully! Please note the '.$Agency_id->{'Agency Code'}. ' reference number for future use.';
			if($sql)
			 {

             		return $this->sendResponse($Agency_id->{'Agency Code'}, $msg);
			 }
    }

	}

/*========================================Start Show Details ======================================*/
     public function ShowAllDetails($user_ID = '')
     {
      $Bluksms = DB::table($this->vendorTable)->where('User ID',$user_ID)->first();
         return $Bluksms;
     }
/*===========================================End Show Details ======================================*/

}
