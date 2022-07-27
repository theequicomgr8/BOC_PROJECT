<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use App\Models\Api\ApiFreshEmpanelment;
use Session;
use DB;

class ApiInternetWebController extends Controller
{
    use CommonTrait;
    //Constructor function
    private $vendorTable ='BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2';
    private $msg ='';

    public function __Constructor($vendorTable,$msg){
         $this->vendorTable =$vendorTable;
         $this->msg =$msg;

    }
    public function internetWebSave(Request $request)
    {
            $table1 = '[BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2]';
             $userid =session::get('UserID');
             $emailFind=DB::table('BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2')->select('Agency Code')->where('User ID',$userid)->first();
                       $agency_name=
                         isset($request->agency_name) ? $request->agency_name:'';
                         $owner_mobile=
                         isset($request->owner_mobile) ? $request->owner_mobile:'';
                         $owner_email=
                         isset($request->owner_email) ? $request->owner_email:'';
                         $phone=
                         isset($request->phone_no) ? $request->phone_no:'';
                         $address=
                         isset($request->address) ? $request->address:'';
                         $city=
                         isset($request->city) ? $request->city:'';
                         $district=
                         isset($request->district) ? $request->district:'';
                         $state=
                         isset($request->state) ? $request->state:'';
                         //tab 2nd start
                         $group_name=
                         isset($request->group_name) ? $request->group_name:'';
                         $date_of_registration=
                         isset($request->date_of_registration) ? $request->date_of_registration:'';
                         $website_url=
                         isset($request->website_url) ? $request->website_url:'';

                         $website_category=
                         isset($request->website_category) ? $request->website_category:'';
                         //dd($website_url,$website_category);
                         $select1=
                         isset($request->select1) ? $request->select1:'';
                         $select2=
                         isset($request->select2) ? $request->select2:'';
                         //tab 3rd start
                         $bank_account_no=
                         isset($request->bank_account_no) ? $request->bank_account_no:'';
                         $account_holder_name=
                         isset($request->account_holder_name) ? $request->account_holder_name:'';
                         $bank_name=
                         isset($request->bank_name) ? $request->bank_name:'';
                         $ifsc_code=
                         isset($request->ifsc_code) ? $request->ifsc_code:'';
                         $branch_name=
                         isset($request->branch_name) ? $request->branch_name:'';
                         $address_of_account=
                         isset($request->address_of_account) ? $request->address_of_account:'';
                         $pan_card=
                         isset($request->pan_card) ? $request->pan_card:'';
                         $GST_No=
                         isset($request->GST_No) ? $request->GST_No:'';
                         $ESI_account_no=
                         isset($request->ESI_account_no) ? $request->ESI_account_no:'';
                         $ESI_no_employees=
                         isset($request->ESI_no_employees) ? $request->ESI_no_employees:'';
                         $EPF_account_no=
                         isset($request->EPF_account_no) ? $request->EPF_account_no:'';
                         $EPF_no_of_employees=
                         isset($request->EPF_no_of_employees) ? $request->EPF_no_of_employees:'';
                         //dd($GST_No);
                         //tab 4 start
                         //upload documents start
                                $FetchAllDoc =DB::table('BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2')->where('User ID',$userid)->first();
                                $destinationPath =public_path().'/uploads/internet_website/';
                                $autitor_Certificate ='';
                                $pan_upload_file_name ='';
                                $gst_upload_file_name ='';
                                $Cpas_certificate_file_name  ='';
                                $ooic_file_name ='';
                                $annexure_a_file_name ='';
                                $notarized_certificate_name ='';
                                $fees_payment_name = '';
                                //dd($fees_payment_name);
                                //auditor report
                                $auditor_rep = @$FetchAllDoc->{'Auditor Report File Name'} ?? '';
                                if($request->hasFile('auditor_report')){
                                $auditor_report =$request->file('auditor_report');
                                $auditor_reportt =time().'-'.$auditor_report->getClientOriginalName();
                                //dd($auditor_reportt);
                                $upload_up_down =$auditor_report->move($destinationPath,$auditor_reportt);
                                if($upload_up_down){
                                $autitor_Certificate = 1;
                                }
                                }else{
                                $auditor_reportt =$auditor_rep;
                                }
                                 //Status update
                                    if($auditor_reportt != ''){
                                        $status = 1;
                                    }else{
                                        $status = 0;
                                    }

                               //PAN upload
                                $pan_upload_file_name_re_DB =$FetchAllDoc->{'PAN Upload File Name'} ?? '';
                                if($request->hasFile('pan_upload_file_name')){
                                $pan_upload_file_name =$request->file('pan_upload_file_name');
                                $pan_upload_file_name_re =time().'-'.$pan_upload_file_name->getClientOriginalName();
                                //dd($pan_upload_file_name_re);
                                $upload_pan_file =$pan_upload_file_name->move($destinationPath,$pan_upload_file_name_re);
                                if($upload_pan_file){
                                $pan_upload_file_name =1;
                                }
                                }else{
                                $pan_upload_file_name_re =$pan_upload_file_name_re_DB;
                                }
                              //GST upload
                                $gst_upload_file_name_re_DB =$FetchAllDoc->{'GST Upload File Name'} ?? '';
                                if($request->hasFile('gst_upload_file_name')){
                                $gst_upload_file_name =$request->file('gst_upload_file_name');
                                $gst_upload_file_name_re =time().'-'.$gst_upload_file_name->getClientOriginalName();
                                //dd($gst_upload_file_name_re);
                                $gst_upload =$gst_upload_file_name->move($destinationPath, $gst_upload_file_name_re);
                                if($gst_upload){
                                    $gst_upload_file_name =1;
                                }
                                }else{
                                    $gst_upload_file_name_re =$gst_upload_file_name_re_DB;
                                }
                                // 3PAS Certificate File Name
                                $pas_certificate_file_name_re_DB =$FetchAllDoc->{'3PAS Certificate File Name'} ?? '';
                                if($request->hasFile('pas_certificate_file_name')){
                                $pas_certificate_file_name =$request->file('pas_certificate_file_name');
                                $pas_certificate_file_name_re =time().'-'.$pas_certificate_file_name->getClientOriginalName();
                                //dd($pas_certificate_file_name_re);
                                $upload_pass_cert =$pas_certificate_file_name->move($destinationPath,$pas_certificate_file_name_re);
                                if($upload_pass_cert){
                                    $Cpas_certificate_file_name =1;
                                }
                                }else{
                                    $pas_certificate_file_name_re=$pas_certificate_file_name_re_DB;
                                }
                               //ooic file name
                                $ooic_file_name_re_DB =$FetchAllDoc->{'OOIC File Name'} ?? '';
                                if($request->hasFile('ooic_file_name')){
                                $ooic_file_name =$request->file('ooic_file_name');
                                $ooic_file_name_re=time().'-'.$ooic_file_name->getClientOriginalName();
                                $upload_ooic_file_name =$ooic_file_name->move($destinationPath,$ooic_file_name_re);
                                //dd($upload_ooic_file_name);
                                if($upload_ooic_file_name){
                                        $ooic_file_name =1;
                                    }
                                }else{
                                    $ooic_file_name_re=$ooic_file_name_re_DB;
                                }
                                // annexure a file name

                                $annexure_a_file_name_re_DB =$FetchAllDoc->{'Annexure A File Name'} ?? '';
                                if($request->hasFile('annexure_a_file_name')){
                                $annexure_a_file_name =$request->file('annexure_a_file_name');
                                $annexure_a_file_name_re=time().'-'.$annexure_a_file_name->getClientOriginalName();
                                //dd($annexure_a_file_name_re);
                                $upload_annexure_a_file_name =$annexure_a_file_name->move($destinationPath,$annexure_a_file_name_re);
                                //dd($upload_annexure_a_file_name);
                                if($upload_annexure_a_file_name){
                                        $annexure_a_file_name =1;
                                    }
                                }else{
                                    $annexure_a_file_name_re=$annexure_a_file_name_re_DB;
                                }

                               //notarized certificate name
                                $notarized_certificate_re_DB =$FetchAllDoc->{'Notorized Cert_ File Name'} ?? '';
                                if($request->hasFile('notarized_certificate')){
                                $notarized_certificate =$request->file('notarized_certificate');
                                $notarized_certificate_re =time().'-'.$notarized_certificate->getClientOriginalName();
                                //dd($notarized_certificate_re);
                                $upload_notarized_certificate =$notarized_certificate->move($destinationPath,$notarized_certificate_re);
                                //dd($upload_notarized_certificate);
                                if($upload_notarized_certificate){
                                    $notarized_certificate_name =1;
                                    }
                                }else{
                                    $notarized_certificate_re=$notarized_certificate_re_DB;
                                }
                               // fees payment
                                $fees_payment_re_DB =$FetchAllDoc->{'Fees Payment File Name'} ?? '';
                                if($request->hasFile('fees_payment')){
                                $fees_payment =$request->file('fees_payment');
                                $fees_payment_re =time().'-'.$fees_payment->getClientOriginalName();
                                $upload_fees_payment = $fees_payment->move($destinationPath,$fees_payment_re);
                                //dd($upload_fees_payment);
                                if($upload_fees_payment){
                                    $fees_payment_name=1;
                                }
                                }else{
                                $fees_payment_re=$fees_payment_re_DB;
                                }
                              //upload document end

                        if(@$emailFind->{'Agency Code'} == '')
                        {
                            $agency_code = DB::table('BOC$Vend Emp Website$3f88596c-e20d-438c-a694-309eb14559b2')->select('Agency Code')->where('Agency Code','LIKE','%'.'INF'.'%')->orderBy('Agency Code','DESC')->first();
                            if (empty($agency_code)) {
                                $agency_code = 'INF000001';
                            } else {
                                $agency_code = $agency_code->{"Agency Code"};
                                $agency_code++;
                        }
                       // dd($agency_code);
                     $sql =  DB::insert(
                     "insert into $table1 (
                        [timestamp]
                        ,[Agency Code]
                        ,[Agency Name]
                        ,[Address 1]
                        ,[Address 2]
                        ,[City]
                        ,[District]
                        ,[State]
                        ,[Mobile]
                        ,[E-Mail]
                        ,[Phone]
                        ,[Fax]
                        ,[Group Name]
                        ,[Website URL]
                        ,[Domain Registration Date]
                        ,[Account No_]
                        ,[A_C Holder Name]
                        ,[Bank Name]
                        ,[Branch Name]
                        ,[IFSC Code]
                        ,[Account Address]
                        ,[PAN]
                        ,[GSTIN]
                        ,[ESI A_C No_]
                        ,[No_ Of Emp iun ESI]
                        ,[EPF A_c No_]
                        ,[No_ Of Emp in EPF]
                        ,[Auditor Report]
                        ,[Auditor Report File Name]
                        ,[PAN Upload]
                        ,[PAN Upload File Name]
                        ,[GST Upload]
                        ,[GST Upload File Name]
                        ,[3PAS Certificate]
                        ,[3PAS Certificate File Name]
                        ,[OOIC File Name]
                        ,[Annexure A ]
                        ,[Annexure A File Name]
                        ,[Notorized Certificate]
                        ,[Fees Payment]
                        ,[Fees Payment File Name]
                        ,[Website Category]
                        ,[Adverisement Type]
                        ,[Banner Type]
                        ,[Banner Size]
                        ,[Own & Op in India Certificate ]
                        ,[Notorized Cert_ File Name]
                        ,[Empanelment Category]
                        ,[Global Dimension 1 Code]
                        ,[Global Dimension 2 Code]
                        ,[User ID]
                        ,[Status]
                        ,[Alocated WS Code]
                        ,[From Date]
                        ,[To Date]
                        ,[Recommended To Committee]
                        ,[Agr File Path]
                        ,[Agr File Name]
                        ,[Sender ID]
                        ,[Receiver ID]
                        ,[Modification]

                 )
                 values (
                     DEFAULT,
                     '" . $agency_code . "',
                     '" . $agency_name . "',
                     '',
                     '" . $address . "',
                     '" . $city . "',
                     '" . $district . "',
                     '" . $state . "',
                     '" . $owner_mobile . "',
                     '" . $owner_email . "',
                     '" . $phone . "',
                     '',
                     '".$group_name."',
                     '".$website_url."',
                     '".$date_of_registration."',
                     '".$website_category."',
                     '".$select1."',
                     '".$select2."',
                     '".$bank_account_no."',
                     '".$account_holder_name."',
                     '".$bank_name."',
                     '".$ifsc_code."',
                     '".$branch_name."',
                     '".$address_of_account."',
                     '".$pan_card."',
                     '".$GST_No."',
                     '".$ESI_account_no."',
                     '".$ESI_no_employees."',
                     '".$EPF_account_no."',
                     '".$EPF_no_of_employees."',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     '',
                     'M004',
                     '',
                     '".$userid."',
                     0,'','1900-01-01 00:00:00.000','1900-01-01 00:00:00.000',0,'','','','',0)");
                     $this->msg = 'Data Saved Successfully!';
                     if ($sql){
                     return $this->sendResponse($userid, $this->msg);
                    }
                 }
                 else
                 {
                     $update = array(
                         'Agency Name' => $agency_name,
                         'Mobile' => $owner_mobile,
                         'E-Mail' => $owner_email,
                         'Phone' => $phone,
                         'Address 2' => $address,
                         'City' => $city,
                         'District' => $district,
                         'State' => $state,
                         'Domain Registration Date' => $date_of_registration,
                         'Group Name'=>$group_name,
                         'Website URL' => $website_url,
                         'Website Category' => $website_category,
                         'Banner Type' => $select1,
                         'Banner Size' => $select2,
                         'Account No_' => $bank_account_no,
                         'A_C Holder Name' => $account_holder_name,
                         'Bank Name' => $bank_name,
                         'Branch Name' => $branch_name,
                         'IFSC Code' => $ifsc_code,
                         'Account Address' => $address_of_account,
                         'PAN' => $pan_card,
                         'GSTIN' => $GST_No,
                         'ESI A_C No_' => $ESI_account_no,
                         'No_ Of Emp iun ESI' => $ESI_no_employees,
                         'EPF A_c No_' => $EPF_account_no,
                         'No_ Of Emp in EPF' => $EPF_no_of_employees,
                         'Auditor Report' => $autitor_Certificate,
                         'Auditor Report File Name' => $auditor_reportt,
                         'PAN Upload' => $pan_upload_file_name,
                         'PAN Upload File Name' => $pan_upload_file_name_re,
                         'GST Upload' => $gst_upload_file_name,
                         'GST Upload File Name'=> $gst_upload_file_name_re,
                         '3PAS Certificate' => $Cpas_certificate_file_name,
                         '3PAS Certificate File Name' => $pas_certificate_file_name_re,
                         'OOIC File Name' => $ooic_file_name_re,
                         'Annexure A ' => $annexure_a_file_name,
                         'Annexure A File Name' => $annexure_a_file_name_re,
                         'Notorized Certificate' => $notarized_certificate_name,
                         'Notorized Cert_ File Name' => $notarized_certificate_re,
                         'Fees Payment' => $fees_payment_name,
                         'Fees Payment File Name' => $fees_payment_re,
                         'Status' => $status
                     );
                    }
                    $sql =DB::table($this->vendorTable)->where('Agency Code',@$emailFind->{'Agency Code'})->update($update);
                    $this->msg = 'Data Save Successfully! Please note the ' .$emailFind->{'Agency Code'}. ' reference number for future use.';
                    if($sql) {
                        return $this->sendResponse(@$emailFind->{'Agency Code'}, $this->msg);
                    }else{
                        return $this->sendError('Some Error Occurred!.');
                        exit;
                    }
               // $sql =DB::table($this->vendorTable)->where('Agency Code', @$emailFind->{'Agency Code'})->update($update);
                //$msg ='Data Save Successfully! Please note the ' .$request->agency_code. ' reference number for future use.';
               // $msg ='Data Save Successfully! Please note the ' .$agency_code. ' reference number for future use.';
                if(!$sql){
                    return $this->sendError('Some Error Occurred!.');
                    exit;
                }else{
                    return $this->sendResponse($request->agency_code,$msg);
                }
    }
/*======================================Start Show All Details======================================*/
        public function ShowDetails($userID =''){
            //dd($userID);
         $getVendor =DB::table($this->vendorTable)->where('User ID',$userID)->first();
         //dd($getVendor);
            return $getVendor;
        }
/*======================================End Show All Details======================================*/
}
