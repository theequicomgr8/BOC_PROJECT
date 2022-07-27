<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use App\Http\Controllers\Api\ClientController as api;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Http\Traits\clientRequestTableTrait;
use Redirect;
use Imagick;
use Hash;

class ClientSubmissionController extends Controller
{
    use CommonTrait, clientRequestTableTrait;
    public function client_details()
    {
        $UserName = Session::get('UserName');

        $dbresponse['ministry_Code'] = DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as m')
                            ->select('Ministry Name as ministry_name')
                            ->leftjoin('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh','m.Ministry Code','=','mh.New Ministry Code')
                            ->where('mh.Ministries Head',$UserName)
                            ->first();
        // print_r($dbresponse['ministry_Code']);die;
        return view('admin.pages.client-request.client-login-details',$dbresponse);
    }

    public function index(Request $request)
    {

        /*password update for op */
        //password update
       /*$arrayName = array( 'password'=>Hash::make('123456'));
        $sql = DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2 as usr')
        ->join('BOC$OD Agency$3f88596c-e20d-438c-a694-309eb14559b2 as ag', 'ag.Agency Code', '=', 'usr.User ID')
        ->where('usr.User Type',1)
        ->where('usr.wing type',0)
        ->where('usr.User ID', 'LIKE', '%'.'OP'.'%')
        ->update($arrayName);
        dd('success');
        dd('hh');*/

        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            
            $wingType=@$_GET['wingType']?? 1;
            $mpstatus=@$_GET['mpstatus'] ?? '';
            $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime(strtr($request->from_date, '/', '-'))) : '';
            $to_date = isset($request->to_date)? date('Y-m-d',strtotime(strtr($request->to_date, '/', '-'))) : '';
            if($wingType == 1){
                $wingType_text = 'Print';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'PRCL.Publication From Date As FromDate',
                'PRCL.Publication  To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'PMP.MP No_ as MPNO',
                'PMP.Client Remarks AS MPClientRemarks',
                'PMP.Client Name as MPClientName',
                'PMP.Target Area as MPTargetArea',
                'PMP.Status as MPStatus',
                'PMP.Version as MPVersion',
                'PMP.Client Request Code as MPClientRequestCode',
                'PRCL.Print Budget AS budgetAmount',
                'PRCL.Newspaper Type AS newspaperType',
                'PRCL.Crative File Name AS creativefname',

                DB::raw("(CASE 
                WHEN PRCL.Color = 0 THEN 'Color' 
                WHEN PRCL.Color = 1 THEN 'B/W' 
                ELSE 'NA' END) AS colorType")
            ];
            }else if($wingType == 2){
                $wingType_text = 'Outdoor';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'ODMR.From Date As FromDate',
                'ODMR.To Date AS ToDate',
                'ODMR.Creative File Name AS creativefname',
                'ODMR.OD Budget AS budgetAmount',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'ODMP.MP No_ as MPNO',
                'ODMP.Client Remarks AS MPClientRemarks',
                'ODMP.Client Name as MPClientName',
                'ODMP.Target Area as MPTargetArea',
                'ODMP.Status as MPStatus',
                'ODMP.OD Media Type AS MPODMediaType'];

            }else if($wingType == 3){
                $wingType_text = 'AV-TV';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'TVM.From Date As FromDate',
                'TVM.To Date AS ToDate',
                'TVM.Creative File Name AS creativefname',
                'TVM.Allocated Budget AS budgetAmount',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'AVMP.MP No_ as MPNO',
                'AVMP.Client Remarks AS MPClientRemarks',
                'AVMP.Client Name as MPClientName',
                'AVMP.Target Area as MPTargetArea',
                'AVMP.Approval Status', //Approval Status
                'AVMP.Status as MPStatus'];
            }else if($wingType == 4){
                $wingType_text = 'AV-Radio';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'CRSM.From Date As FromDate',
                'CRSM.To Date AS ToDate',
                'CRSM.Creative File Name AS creativefname',
                'CRSM.Budget Amount AS budgetAmount',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'radio.MP No_ as MPNO',
                //'radio.Client Name as MPClientName',
                'radio.Target Area as MPTargetArea',
                //'radio.Approval Status', //Approval Status
                'radio.Client Approval',
                'radio.Client Remarks AS MPClientRemarks',
                'radio.Radio Type AS RadioType',
                DB::raw("(CASE 
                WHEN radio.Status = 0 THEN 'Open' 
                WHEN radio.Status = 1 THEN 'Under Approval' 
                WHEN radio.Status = 2 THEN 'Approved' 
                WHEN radio.Status = 3 THEN 'Rejected' 
                WHEN radio.Status = 4 THEN 'Forwarded' 
                WHEN radio.Status = 5 THEN 'Finally Approved'
                WHEN radio.Status = 6 THEN 'Finally Reject'
                ELSE 'NA' END) AS MPStatus")];
            }
            $data = DB::table($this->tblClientRequestHeader. ' as CL')
            ->select($select)
            ->leftjoin($this->tblPrintClientRequest.' as PRCL', 'CL.Client Request No', '=', 'PRCL.Client Request No_')
            ->leftjoin($this->tblODMediaRequestHeader.' as ODMR', 'CL.Client Request No', '=', 'ODMR.Client Request No')
            ->leftjoin($this->tblAVMedia.' as TVM', 'CL.Client Request No', '=', 'TVM.Client Request No')
            ->leftjoin($this->tblRadioMediaRequest.' as CRSM', 'CL.Client Request No', '=', 'CRSM.Client Request No')  
            ->orderBy('CL.Request Date', 'DESC')
            ->where('CL.User Id', $userid);
            if($wingType==1 ){
                $data->leftjoin($this->tblPrintMediaPlan.' as PMP', 'PMP.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('PMP.Ministry Head', $UserName);
                //$data->where('PMP.Send To Client', 1);
                //$data->where('PMP.Version', 2);
                $data->where('CL.Print',1);
                if(($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                   $data->whereDate('CL.Request Date', '>=', $from_date)->whereDate('CL.Request Date', '<=', $to_date);  
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', 1);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', 2);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', 3);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', 4);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('PMP.Status', $mpstatus);
                    }
                   
                }
                   /* if($mpstatus==0 && $mpstatus!=''){
                       
                        $data->where('PMP.Status', $mpstatus);
                       // $data->where('CL.Status', $mpstatus);
                    }else{
                     $data->where('PMP.Status', $mpstatus);   
                    }*/

            }else if($wingType==2 ){
                $data->leftjoin($this->tblODMediaPlanHeader.' as ODMP', 'ODMP.Client Request No_', '=', 'CL.Client Request No');
                // $data->where('ODMP.Ministry Head', $UserName);
                //$data->where('ODMP.Send To Client', 1);
                $data->where('CL.Outdoor',1);
                if( ($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                   //$data->whereDate('ODMR.From Date', '>=', $from_date)->whereDate('ODMR.To Date', '<=', $to_date);  
                     $data->whereDate('CL.Request Date', '>=', $from_date)->whereDate('CL.Request Date', '<=', $to_date);
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('ODMP.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('ODMP.Status', $mpstatus);
                }*/
            }else if($wingType==3 ){
                $data->leftjoin($this->tblAVMediaPlan.' as AVMP', 'AVMP.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('AVMP.Ministry Head', $UserName);
                $data->where('CL.AV - TV',1);
                if( ($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                  //$data->whereDate('TVM.From Date', '>=', $from_date)->whereDate('TVM.To Date', '<=', $to_date);   
                     $data->whereDate('CL.Request Date', '>=', $from_date)->whereDate('CL.Request Date', '<=', $to_date);
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('AVMP.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('AVMP.Status', $mpstatus);
                } */  
            }else if($wingType==4 ){
                 $data->leftjoin($this->tblFMRadioMediaPlanHeader.' as radio', 'radio.Client Request Code', '=', 'CL.Client Request No');
                // $data->where('radio.Ministry Head', $UserName);
                // ->where('AVMP.Send To Client', 1) //x
                $data->where('CL.AV - Radio',1);
                if(($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != ''){
                  //$data->whereDate('CRSM.From Date', '>=', $from_date)->whereDate('CRSM.To Date', '<=', $to_date);  
                     $data->whereDate('CL.Request Date', '>=', $from_date)->whereDate('CL.Request Date', '<=', $to_date);
                }
                if($request->has('mpstatus') && $mpstatus!='' ){

                    if($mpstatus=="7" || $mpstatus=="8" || $mpstatus=="9" || $mpstatus=="10" || $mpstatus=="11" ){

                        if($mpstatus=="7"){
                            $clmpstatus=1;
                            $data->where('CL.Status', $clmpstatus);
                        }elseif($mpstatus=="8"){
                             $clmpstatus=2;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="9"){
                             $clmpstatus=3;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="10"){
                             $clmpstatus=4;
                             $data->where('CL.Status', $clmpstatus);
                        }
                        elseif($mpstatus=="11"){
                            //dd($mpstatus);
                             $clmpstatus=0;
                             $data->where('CL.Status',0);
                        }
                    }else{
                        $data->where('radio.Status', $mpstatus);
                    }
                   
                }
                /*if($request->has('mpstatus') && $mpstatus!='' ){
                    $data->where('radio.Status', $mpstatus);
                } */ 
            }
           $dategat =$data->get();
           $response=$data->paginate($this->perpage);  
            $fromdate= $request->from_date;
            $todate= $request->to_date;
           // dd($to_date);
           // dd($todate);
           $dataPDF =['response'=>$dategat,'wingType' =>$wingType,'wingType_text' =>$wingType_text,'mpstatus'=>$mpstatus,'from_date' =>$from_date,'to_date'=>$to_date];
           Session::put('response',$dategat);
           Session::put('wingType',$wingType);
           Session::put('wingType_text',$wingType_text);
           Session::put('mpstatus',$mpstatus);
           Session::put('from_date',$from_date);
           Session::put('to_date',$to_date);
           if (isset($_REQUEST["submitreset"])) {
            return Redirect('client-submission-list');
            }else{
                 return view('admin.pages.client-request.index', compact('response','wingType','wingType_text','mpstatus','fromdate','todate'));
            }
            //return view('admin.pages.client-request.index', compact('response','wingType','wingType_text','mpstatus','from_date','to_date'));
           
        // }elseif($request->user !=''){
        //     $pdf =PDF::loadView('admin.pages.client-request.client-request-form-pdf', compact('response','wingType','wingType_text','mpstatus','from_date','to_date'));
        //     return $pdf->download($id.'.pdf');
        // }else{
            return Redirect('client-login');
        }
    }
    public function clientPendingCreativeList(){
      
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            $wingType=@$_GET['wingType']?? 1;
            if($wingType == 1){
                $wingType_text = 'Print';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'PRCL.Publication From Date As FromDate',
                'PRCL.Publication  To Date AS ToDate',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'CL.Outdoor',
                'CL.AV - TV AS AVTV',
                'CL.AV - Radio AS AVRadio',
                'PRCL.Print Budget AS budgetAmount',
                'PRCL.Newspaper Type AS newspaperType',
                'PRCL.Crative File Name AS creativefname',

                'PRCL.Crative File Name AS Printcreativefname',
                'ODMR.Creative File Name AS ODcreativefname',
                'TVM.Creative File Name AS TVcreativefname',
                'CRSM.Creative File Name AS Radiocreativefname',

                'PRCL.Creative Availability AS PrintCreativeAvailable',
                'ODMR.Creative Availability AS ODCreativeAvailable',
                'TVM.Creative Available AS TVCreativeAvailable',
                'CRSM.Creative Available AS RadioCreativeAvailable',

            ];
            }else if($wingType == 2){
                $wingType_text = 'Outdoor';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'ODMR.From Date As FromDate',
                'ODMR.To Date AS ToDate',
                'ODMR.Creative File Name AS creativefname',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'CL.Outdoor',
                'CL.AV - TV AS AVTV',
                'CL.AV - Radio AS AVRadio',
                'PRCL.Crative File Name AS Printcreativefname',
                'ODMR.Creative File Name AS ODcreativefname',
                'TVM.Creative File Name AS TVcreativefname',
                'CRSM.Creative File Name AS Radiocreativefname',
                'PRCL.Creative Availability AS PrintCreativeAvailable',
                'ODMR.Creative Availability AS ODCreativeAvailable',
                'TVM.Creative Available AS TVCreativeAvailable',
                'CRSM.Creative Available AS RadioCreativeAvailable',
                'ODMR.OD Budget AS budgetAmount',
            ];

            }else if($wingType == 3){
                $wingType_text = 'AV-TV';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'TVM.From Date As FromDate',
                'TVM.To Date AS ToDate',
                'TVM.Creative File Name AS creativefname',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'CL.Outdoor',
                'CL.AV - TV AS AVTV',
                'CL.AV - Radio AS AVRadio',
                'PRCL.Crative File Name AS Printcreativefname',
                'ODMR.Creative File Name AS ODcreativefname',
                'TVM.Creative File Name AS TVcreativefname',
                'CRSM.Creative File Name AS Radiocreativefname',
                'PRCL.Creative Availability AS PrintCreativeAvailable',
                'ODMR.Creative Availability AS ODCreativeAvailable',
                'TVM.Creative Available AS TVCreativeAvailable',
                'CRSM.Creative Available AS RadioCreativeAvailable',
                'TVM.Allocated Budget AS budgetAmount',
            ];
            }else if($wingType == 4){
                $wingType_text = 'AV-Radio';
                $select=['CL.Client Request No AS ClientRequestNo',
                'CL.Request Date AS RequestDate',
                'CL.Print',
                'CL.Email Id AS EmailId',
                'CL.Status',
                'CRSM.From Date As FromDate',
                'CRSM.To Date AS ToDate',
                'CRSM.Creative File Name AS creativefname',
                'CL.Status AS CLStatus',
                'CL.Client Request No AS CRHID',
                'PRCL.Client Request No_ AS PRCRHID',
                'ODMR.Client Request No AS ODMRId',
                'TVM.Client Request No AS TVMId',
                'CRSM.Client Request No AS CRSMId',
                'CL.Print',
                'CL.Outdoor',
                'CL.AV - TV AS AVTV',
                'CL.AV - Radio AS AVRadio',
                'PRCL.Crative File Name AS Printcreativefname',
                'ODMR.Creative File Name AS ODcreativefname',
                'TVM.Creative File Name AS TVcreativefname',
                'CRSM.Creative File Name AS Radiocreativefname',
                'PRCL.Creative Availability AS PrintCreativeAvailable',
                'ODMR.Creative Availability AS ODCreativeAvailable',
                'TVM.Creative Available AS TVCreativeAvailable',
                'CRSM.Creative Available AS RadioCreativeAvailable',
                'CRSM.Budget Amount AS budgetAmount',
            ];
            }
            $data = DB::table($this->tblClientRequestHeader. ' as CL')
            ->select($select)
            ->leftjoin($this->tblPrintClientRequest.' as PRCL', 'CL.Client Request No', '=', 'PRCL.Client Request No_')
            ->leftjoin($this->tblODMediaRequestHeader.' as ODMR', 'CL.Client Request No', '=', 'ODMR.Client Request No')
            ->leftjoin($this->tblAVMedia.' as TVM', 'CL.Client Request No', '=', 'TVM.Client Request No')
            ->leftjoin($this->tblRadioMediaRequest.' as CRSM', 'CL.Client Request No', '=', 'CRSM.Client Request No')  
            ->orderBy('CL.Request Date', 'DESC')
            ->where('CL.User Id', $userid);
            if($wingType==1 ){
                $data->where('CL.Print',1);
                $data->where('PRCL.Creative Availability',1);
            }else if($wingType==2 ){
                $data->where('CL.Outdoor',1);
                $data->where('ODMR.Creative Availability',1);
            }else if($wingType==3 ){
                $data->where('CL.AV - TV',1);
                $data->where('TVM.Creative Available',1);
            }else if($wingType==4 ){
                $data->where('CL.AV - Radio',1);
                $data->where('CRSM.Creative Available',1);
            }
           $dategat =$data->get();
           $response=$data->paginate($this->perpage);
           //dd($response);    
            return view('admin.pages.client-request.pending-creative-list',compact('response','wingType','wingType_text'));
        }else{
            return Redirect('client-login'); 
        }
           
    }
    //show pending creative upload form
    public function uploadpendingcreative(Request $request){
        $userid = Session::get('UserID');
         $aValues=[];
        if ($userid != '' || $userid != null) {
            $aValues = array(
                'clrno'=>@$request->clrno,
                'PrintCreativeAvailable'=>@$request->PrintCreativeAvailable,
                'ODCreativeAvailable'=>@$request->ODCreativeAvailable,
                'TVCreativeAvailable'=>@$request->TVCreativeAvailable,
                'RadioCreativeAvailable'=>@$request->RadioCreativeAvailable,
                'Print'=>@$request->Print,
                'Outdoor'=>@$request->Outdoor,
                'AVTV'=>@$request->AVTV,
                'AVRadio'=>@$request->AVRadio
                );
            return view('admin.pages.client-request.upload-pending-creative',compact('aValues'));
        }else{
            return Redirect('client-login'); 
        }  

    }
    //update pending creative
    public function updatependingcreative(Request $request){
        $userid = Session::get('UserID');
        if($userid == '' || $userid == null) {
            return Redirect('client-login'); 
        }
            $destinationPath = public_path() . '/uploads/client-request/';
                //print file upload
                // dd($request);
            if( $request->has('print_upload_creative_fileName_img') ||  $request->has('outdoor_upload_creative_fileName_img') ||  $request->hasFile('tvCreativeFileName') || $request->hasFile('radioCreativeFileName') ) {
                 $radiores='';
                 $pres='';
                  $odres ='';
                   $tvres='';

                   if(!empty($request->has('print_upload_creative_fileName_img'))) {

                    $file = $request->{'print_upload_creative_fileName_img'};
                    if(!empty($file))
                    {
                        // dd($file);
                        $print_upload_creative_fileName = uniqid() . '.png';
                        $file = str_replace('data:image/png;base64,', '', $file);
                        $file = str_replace(' ', '+', $file);
                        $file = base64_decode($file);
                        $new_file = imagecreatefromstring($file);
                        header('Content-Type: image/png');
                        $filep = $destinationPath.$print_upload_creative_fileName;
                        $PrintfileUploaded = imagepng($new_file,$filep);

                    }
                    else{
                        $print_upload_creative_fileName = '';
    
                    }
                    if($PrintfileUploaded){
                        $print_iscreative=0;
                    }
                     $pres = DB::table($this->tblPrintClientRequest)
                    ->where('Client Request No_', $request->clrno)
                    ->update([
                        'Creative Availability' => $print_iscreative,
                        'Crative File Name' => $print_upload_creative_fileName,
                    ]);
                }
               
                //outdoor file upload
                if(!empty($request->has('outdoor_upload_creative_fileName_img'))) {

                    $file = $request->{'outdoor_upload_creative_fileName_img'};
                    if(!empty($file))
                    {
                        $outdoor_upload_creative_fileName = uniqid() . '.png';
                        $file = str_replace('data:image/png;base64,', '', $file);
                        $file = str_replace(' ', '+', $file);
                        $file = base64_decode($file);
                        $new_file = imagecreatefromstring($file);
                        header('Content-Type: image/png');
                        $filep = $destinationPath.$outdoor_upload_creative_fileName;
                        $odfileUploaded = imagepng($new_file,$filep);

                    }
                    else{
                        $outdoor_upload_creative_fileName = '';
    
                    }
                    if($odfileUploaded){
                        $od_iscreative=0;
                    }
                    $odres = DB::table($this->tblODMediaRequestHeader)
                    ->where('Client Request No', $request->clrno)
                    ->update([
                        'Creative Availability' => $od_iscreative,
                        'Creative File Name' => $outdoor_upload_creative_fileName,
                    ]);
                }
                
                //AVTV file upload
                if($request->hasFile('tvCreativeFileName')) {
                    $file = $request->file('tvCreativeFileName');
                    $tv_upload_creative_fileName = time() . '-' . $file->getClientOriginalName();
                    $tvfileUploaded = $file->move($destinationPath, $tv_upload_creative_fileName);
                    if($tvfileUploaded){
                        $tv_iscreative=0;
                    }
                    $tvres = DB::table($this->tblAVMedia)
                    ->where('Client Request No', $request->clrno)
                    ->update([
                        'Creative Available' => $tv_iscreative,
                        'Creative File Name' => $tv_upload_creative_fileName,
                    ]);
                }
                 //AV radio file upload
                if($request->hasFile('radioCreativeFileName')) {
                    $file = $request->file('radioCreativeFileName');
                    $radio_upload_creative_fileName = time() . '-' . $file->getClientOriginalName();
                    $radiofileUploaded = $file->move($destinationPath, $radio_upload_creative_fileName);
                    if($radiofileUploaded){
                        $radio_iscreative=0;
                    }
                    $radiores = DB::table($this->tblODMediaRequestHeader)
                    ->where('Client Request No', $request->clrno)
                    ->update([
                       'Creative Available' => $radio_iscreative,
                        'Creative File Name' => $radio_upload_creative_fileName,
                    ]);
                }

                if($radiores || $tvres || $odres || $pres ){
                    $msg = 'File upload successfuly!';
                    return $this->sendResponse([], $msg);
                }else{
                    return $this->sendError('You have not choose any file,please choose file.');
                }
               
            }else{
                return $this->sendError('You have not choose any file,please choose file');
            }
        

    }
    public function mediaPlanList(Request $request, $mpNo = '')
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            $response = DB::table($this->tblPrintMediaPlan.' as PMP')
                ->select(
                    'PMP.MP No_',
                    'PMP.Client Request Code',
                    'PMP.Client Name',
                    'PMP.Target Area',
                    'PMP.Status',
                    'PMP.Version'
                )
                ->orderBy('PMP.MP No_', 'DESC')
                ->where('PMP.Ministry Head', $UserName)
                ->where('PMP.Send To Client', 1)
                ->paginate($this->perpage);
            return view('admin.pages.client-request.media-plan-list', compact('response'));
        }else{
            return Redirect('client-login');
        }
    }
    public function mediaPlanView( Request $request, $mpNo = '', $planVersion='' )
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        $npActualAmt1='';
        $npActualAmt='';
        $tblLanguageSelectionData='';
        $LanguageName='';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblPrintMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                //get language
            if(!empty($mpdetails)){
                 //ministry data get
                $MinistryData=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')
                ->select("Ministry Name AS MinistryName")
                ->where('Ministry Code', $mpdetails->{'Ministry'})->first();
                if($MinistryData!=''){
                    $MinistryName=$MinistryData->MinistryName;
                }//end ministry
                $tblLanguageSelectionData = DB::table($this->tblLanguageSelection)
                ->select("Language Name AS LanguageName")
                ->where('Media Name', 'Print')
                ->where('Client Request No_', $mpdetails->{'Client Request Code'})->get()->toArray();
                if(!empty($tblLanguageSelectionData)){
                    $lang_names = array_column($tblLanguageSelectionData, 'LanguageName');
                    $LanguageName=implode(' , ', $lang_names);
                }
            }
            //selected newspaper detail
            $npLists = DB::table($this->tblNewspaperSelect)
                ->select("*")
                //->orderBy('Line No_', 'DESC')
                ->where('Version',$planVersion)
                ->where('Document No_', $mpNo)
                ->orderBy('State Name','ASC')
                ->orderBy('Category','ASC')
                ->orderBy('NP Name','ASC')
                ->paginate($this->perpage);
            $npActualAmt1 = DB::table($this->tblNewspaperSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1);
            return view('admin.pages.client-request.media-plan-view', compact('mpdetails', 'npLists', 'npActualAmt', 'LanguageName','MinistryName'));
        }else{
            return Redirect('client-login');
        }
    }

   public function mediaPlanViewPDF( Request $request, $mpNo = '', $planVersion='' )
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        $npActualAmt1='';
        $npActualAmt='';
        $tblLanguageSelectionData='';
        $LanguageName='';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblPrintMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                //get language
            if(!empty($mpdetails)){
                //ministry data get
                $MinistryData=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')
                ->select("Ministry Name AS MinistryName")
                ->where('Ministry Code', $mpdetails->{'Ministry'})->first();
                if($MinistryData!=''){
                    $MinistryName=$MinistryData->MinistryName;
                }//end ministry
                $tblLanguageSelectionData = DB::table($this->tblLanguageSelection)
                ->select("Language Name AS LanguageName")
                ->where('Media Name', 'Print')
                ->where('Client Request No_', $mpdetails->{'Client Request Code'})->get()->toArray();
                if(!empty($tblLanguageSelectionData)){
                    $lang_names = array_column($tblLanguageSelectionData, 'LanguageName');
                    $LanguageName=implode(' , ', $lang_names);
                }
            }
            //selected newspaper detail
            $npLists = DB::table($this->tblNewspaperSelect)
                ->select("*")
                //->orderBy('Line No_', 'DESC')
                ->where('Version',$planVersion)
                ->where('Document No_', $mpNo)
                //->orderBy('NP Code','DESC')
                ->orderBy('State Name','ASC')
                ->orderBy('Category','ASC')
                ->orderBy('NP Name','ASC')
                ->get();//->paginate($this->perpage);
            $npActualAmt1 = DB::table($this->tblNewspaperSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1);
           $pdfmediaplan =PDF::loadView('admin.pages.client-request.media-plan-view-pdf', compact('mpdetails', 'npLists', 'npActualAmt', 'LanguageName','MinistryName'));
           return $pdfmediaplan->download($mpNo.'.pdf');
        }else{
            return Redirect('client-login');
        }
    }
    
    public function saveCommentOfmp(Request $request)
    {
        $resp = (new api)->saveCommentOfmp($request);
        $response = json_decode(json_encode($resp), true);
        if($response['original']['success'] == false) {
            return response()->json($response['original']);
        }elseif($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }

    
    public function clientSave(Request $request)
    {
        if ($request->nextTabName == 'Basic Information') {
            $resp = (new api)->saveClientBasicInfo($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }else if ($request->nextTabName == 'Print') {
            $resp = (new api)->savePrintMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }else if ($request->nextTabName == 'Outdoor') {
            $resp = (new api)->saveOutdoorMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        else if ($request->nextTabName == 'AV-TV') {
            $resp = (new api)->saveTvMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        else if ($request->nextTabName == 'AV-Radio') {
            $resp = (new api)->savecrsRadioMedia($request);
            $response = json_decode(json_encode($resp), true);
            if ($response['original']['success'] == false) {
                return response()->json($response['original']);
            }
        }
        if ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }
    public function getClientForm($clid = '')
    { 
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            $regionalLang = $this->getRegionalLanguages();
            $client_req_header = array(); $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData=$this->getTrain();
            $getAllCityForFMStationOne = $this->getAllCityForFMStationOne();
            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';
            $Creq_number = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)->orderBy('Client Request No', 'DESC')
                ->first();
            if (!empty($Creq_number)) {
                $table2 = '[BOC$Print Client Request]';
                $print_req = DB::table($this->tblPrintClientRequest)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})->first();
                $odmReq = DB::table($this->tblODMediaRequest)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $tvmReq = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $radiomReq = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
            }
            if (isset($Creq_number->{'Client Request No'})) {
                $client_req_header = DB::table($this->tblClientRequestHeader)
                    ->select('*')
                    ->where('User ID', $userid)
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
            }
            $printCitySelectionData=array();
            $printStateSelectionData=array();
            $langSelectionData=array();
            $clientOutdoorData=array();
            $clientTVData=array();
            $clientRadioData=array();
            if (!empty($client_req_header)) {
                $table2 = '[BOC$Print Client Request$3f88596c-e20d-438c-a694-309eb14559b2]';
                $print_client_req = DB::table($this->tblPrintClientRequest)
                    ->select('*')
                    ->where('Client Request No_ ', $client_req_header->{'Client Request No'})->first();
                $clientOutdoorData = DB::table($this->tblODMediaRequest)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                 $clientTVData = DB::table($this->tblAVMedia)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
                $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                    ->where('Client Request No', $Creq_number->{'Client Request No'})->first();
            }
            if(!empty($client_req_header)){
                /* get city for Print*/
                $printCitySelection=array();
                if($client_req_header->Print==1){
                    $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})->where('Media Name', 'PRINT')->get()->toArray();
                }
                if (is_array($printCitySelection)) {
                    $distarr = array();
                    foreach ($printCitySelection as  $Dist) { $distarr[] = $Dist->{'City Name'}; }
                    if (is_array($distarr)) { $printCitySelectionData = implode(',', $distarr);  }
                }else { $printCitySelectionData = ''; }
                /* get State for Print*/
                $printStateSelection=array();
                if($client_req_header->Print==1){
                     $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})
                    ->where('Media Name', 'PRINT')
                    ->get()->toArray();
                }
                if(is_array($printStateSelection)) {
                    $stcode = array();
                    foreach ($printStateSelection as  $st) { $stcode[] = $st->{'State Code'}; }
                    if (is_array($stcode)) { $printStateSelectionData = implode(',', $stcode); }
                }else { $printStateSelectionData= '';}
                /* get Lang for Print*/
                $langSelection=array();
                if($client_req_header->Print==1){
                    $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                    ->where('Client Request No_', $Creq_number->{'Client Request No'})
                    ->where('Media Name', 'PRINT')
                    ->get()->toArray();
                }
                if(is_array($langSelection)) {
                    $langarr = array();
                    foreach ($langSelection as  $lang) { $langarr[] = $lang->{'Language Code'}; }
                    if(is_array($langarr)) { $langSelectionData = implode(',', $langarr); }
                }else{ $langSelectionData = '';}
                /* get Lang for TV*/
                $tvLangSelection=array();
                if($client_req_header->{'AV - TV'}==1){
                    $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                    ->where('Client Request No_', $clid)
                    ->where('AV Type', '0')
                    ->get()->toArray();
                }
                if(is_array($tvLangSelection)) {
                    $langarr = array();
                    foreach ($tvLangSelection as  $lang) { $langarr[] = $lang->{'Language Code'}; }
                    if(is_array($langarr)) { $tvLangSelectionData = implode(',', $langarr); }
                }else{ $tvLangSelectionData = ''; }
                /* get Lang for FM Radio*/
                $radioLangSelection=array();
                if($client_req_header->{'AV - Radio'}==1){
                    $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                    ->where('Client Request No_', $clid)
                    ->where('Media Name', 'CRS')
                    ->get()->toArray();
                }
                if(is_array($radioLangSelection)) {
                    $langarr = array();
                    foreach ($radioLangSelection as  $lang) { $langarr[] = $lang->{'Language Code'};}
                    if(is_array($langarr)) { $radioLangSelectionData = implode(',', $langarr); }
                }else{ $radioLangSelectionData = '';}
                /*END Lang for FM Radio*/
                // get FM radio state and city
                $fmStateSelection=array();
                if($client_req_header->{'AV - Radio'}==1){
                    $fmStateSelection = DB::table($this->tblStateSelection)->select('*')
                    ->where('Client Request No_', $clid)
                    ->where('Media Name', 'FM')
                    ->get()->toArray();
                }
                if (is_array($fmStateSelection)) {
                    $fmstateCode = array();
                    foreach ($fmStateSelection as  $fmstate) {$fmstateCode[] = $fmstate->{'State Code'}; }
                    if (is_array($fmstateCode)) { $fmStateSelectionData = implode(',', $fmstateCode); }
                }else {$fmStateSelectionData = '';}
                //get city for fm radio
                $fmCitySelection=array();
                if($client_req_header->{'AV - Radio'}==1){
                    $fmCitySelection = DB::table($this->tblCitySelection)->select('*')
                    ->where('Client Request No_', $clid)
                    ->where('Media Name', 'FM')
                    ->get()->toArray();
                }
                if (is_array($fmCitySelection)) {
                    $fmcityCode = array();
                    foreach ($fmCitySelection as  $fmcity) { $fmcityCode[] = $fmcity->{'City Name'}; }
                    if (is_array($fmcityCode)) { $fmCitySelectionData = implode(',', $fmcityCode); }
                }else {$fmCitySelectionData = ''; }
                //endfm radio state an city
            }
            if ( (isset($Creq_number->{'Client Request No'})== false  && isset($print_req->{'Client Request No_'})== false && isset($odmReq->{'Client Request No'})== false ) 
            || (isset($Creq_number->{'Client Request No'})  && isset($print_req->{'Client Request No_'}) && isset($odmReq->{'Client Request No'}) == false ) 
            || (isset($Creq_number->{'Client Request No'}) && isset($odmReq->{'Client Request No'})  && isset($print_req->{'Client Request No_'}) == false ) 
            || (isset($Creq_number->{'Client Request No'})== false  && isset($print_req->{'Client Request No_'})== false  )
            || (isset($Creq_number->{'Client Request No'})  && isset($odmReq->{'Client Request No'})  )
            || (isset($Creq_number->{'Client Request No'})  && isset($tvmReq->{'Client Request No'})  ) 
            || (isset($Creq_number->{'Client Request No'})  && isset($radiomReq->{'Client Request No'})  ) ) 
            {
                return view('admin.pages.client-request.application-for-client-submission-for-advertisement', [
                'languages' => $languages->original['data'],
                'regionalLang'=>$regionalLang->original['data'],
                'states' => $states->original['data'],
                'districts' => $districts->original['data'],
                'allCityData'=>$allCityData->original['data'],
                'ministries_head' => $ministries_head,
                'printCitySelectionData' => '',
                'printStateSelectionData' => '',
                'langSelectionData' => '',
                'tvLangSelectionData' => '',
                'radioLangSelectionData' => '',
                'email' => isset($client_req_header->{'Email Id'})? $client_req_header->{'Email Id'}:'',
                'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:'',
                'getAllCityForFMStationOne'=>isset($getAllCityForFMStationOne->original['data']) ? $getAllCityForFMStationOne->original['data']:'',
                'fmStateSelectionData'=>'',
                'fmCitySelectionData'=>''
                
                ]);    
            }else{ 
                return view('admin.pages.client-request.application-for-client-submission-for-advertisement', [
                'languages' => $languages->original['data'],
                'regionalLang'=>$regionalLang->original['data'],
                'states' => $states->original['data'],
                'districts' => $districts->original['data'],
                'allCityData'=>$allCityData->original['data'],
                'client_req_header' => $client_req_header,
                'print_client_req' => $print_client_req,
                'clientOutdoorData'=>$clientOutdoorData,
                'clientTVData'=>$clientTVData,
                'clientRadioData'=>$clientRadioData,
                'ministries_head' => $ministries_head,
                'printCitySelectionData' => $printCitySelectionData,
                'printStateSelectionData' => $printStateSelectionData,
                'langSelectionData' => $langSelectionData,
                'tvLangSelectionData' => $tvLangSelectionData,
                'radioLangSelectionData' => $radioLangSelectionData,
                'email' => isset($client_req_header->{'Email Id'})? $client_req_header->{'Email Id'}:'',
                'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:'',
                'getAllCityForFMStationOne'=>isset($getAllCityForFMStationOne->original['data']) ? $getAllCityForFMStationOne->original['data']:'',
                'fmStateSelectionData'=>isset($fmStateSelectionData) ? $fmStateSelectionData:[],
                'fmCitySelectionData'=>isset($fmCitySelectionData) ? $fmCitySelectionData:[]
                ]);
            }
        }else{
            return Redirect('client-login');
        }
    }
    //client detail
     public function clientview($clid = '')
    { 
        $userid = Session::get('UserID');
        if (($userid != '' || $userid != null) && ($clid !== '')) {
            $regionalLang = $this->getRegionalLanguages();
            $client_req_header = array();
            $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData = $this->getTrain();
            $getAllCityForFMStationOne = $this->getAllCityForFMStationOne();
            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';
            $client_req_header = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)
                ->where('Client Request No ', $clid)->first();
            $print_client_req = DB::table($this->tblPrintClientRequest)->select('*')
                ->where('Client Request No_', $clid)->first();
            $clientOutdoorData = DB::table($this->tblODMediaRequestHeader.' AS ODMRH')->select('ODMRH.*', 'ODR.*')
            ->leftjoin($this->tblODMediaRequest.' AS ODR', 'ODMRH.Client Request No', '=', 'ODR.Client Request No')
            ->where('ODMRH.Client Request No', $clid)->get();
            $clientTVData = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $clid)->first();
            $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $clid)->first();
            /* get city for print*/
            $printCitySelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                ->where('Client Request No_', $clid)->where('Media Name', 'PRINT')->get()->toArray();   
            }
            if (is_array($printCitySelection)) {
                $distarr = array();
                foreach ($printCitySelection as  $Dist) { $distarr[] = $Dist->{'City Name'};  }
                if (is_array($distarr)) { $printCitySelectionData = implode(',', $distarr);  }
            }else {  $printCitySelectionData = ''; }
            /* get state for print*/
            $printStateSelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }
            if (is_array($printStateSelection)) {
                $stcode = array();
                foreach ($printStateSelection as  $st) {  $stcode[] = $st->{'State Code'}; }
                if (is_array($stcode)) { $printStateSelectionData = implode(',', $stcode); }
            }else { $printStateSelectionData= '';}
            /* get lang for print*/
            $langSelection=array();
            if($client_req_header->Print==1){
                $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }
            if (is_array($langSelection)) {
                $langarr = array();
                foreach ($langSelection as  $lang) {    $langarr[] = $lang->{'Language Code'}; }
                if (is_array($langarr)) { $langSelectionData = implode(',', $langarr); }
            }else { $langSelectionData = ''; }
            //regional lang for tv
            $tvLangSelection=array();
            if($client_req_header->{'AV - TV'}==1){
                $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('AV Type', '0')
                ->get()->toArray();
            }
            if (is_array($tvLangSelection)) {
                $langarr = array();
                foreach ($tvLangSelection as  $lang) {  $langarr[] = $lang->{'Language Code'}; }
                if (is_array($langarr)) {    $tvLangSelectionData = implode(',', $langarr); }
            }else {  $tvLangSelectionData = '';}
            //regional lang for radio
            $radioLangSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'CRS')
                ->get()->toArray();
            }
            if (is_array($radioLangSelection)) {
                $langarr = array();
                foreach ($radioLangSelection as  $lang) {  $langarr[] = $lang->{'Language Code'};}
                if (is_array($langarr)) {  $radioLangSelectionData = implode(',', $langarr);}
            }else { $radioLangSelectionData = ''; }
            // get FM radio state and city
            $fmStateSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $fmStateSelection = DB::table($this->tblStateSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'FM')
                ->get()->toArray();
            }
            if (is_array($fmStateSelection)) {
                $fmstateCode = array();
                foreach ($fmStateSelection as  $fmstate) {  $fmstateCode[] = $fmstate->{'State Code'}; }
                if (is_array($fmstateCode)) {  $fmStateSelectionData = implode(',', $fmstateCode);}
            }else { $fmStateSelectionData = ''; }
            //get city for fm radio
            $fmCitySelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $fmCitySelection = DB::table($this->tblCitySelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'FM')
                ->get()->toArray();
            }
            if (is_array($fmCitySelection)) {
                $fmcityCode = array();
                foreach ($fmCitySelection as  $fmcity) {  $fmcityCode[] = $fmcity->{'City Name'}; }
                if (is_array($fmcityCode)) {    $fmCitySelectionData = implode(',', $fmcityCode); }
            }else { $fmCitySelectionData = ''; }
            //endfm radio state an city
            $disabled = 'disabled';
            return view(
                'admin.pages.client-request.clientdetail',
                [
                    'languages' => $languages->original['data'],
                    'regionalLang'=>$regionalLang->original['data'],
                    'states' => $states->original['data'],
                    'districts' => $districts->original['data'],
                    'allCityData'=>$allCityData->original['data'],
                    'client_req_header' => $client_req_header,
                    'print_client_req' => $print_client_req,
                    'clientOutdoorData'=>$clientOutdoorData,
                    'clientTVData'=>$clientTVData,
                    'clientRadioData'=>$clientRadioData,
                    'ministries_head' => $ministries_head,
                    'disabled' => $disabled,
                    'printCitySelectionData' => $printCitySelectionData,
                    'printStateSelectionData' => $printStateSelectionData,
                    'langSelectionData' => $langSelectionData,
                    'tvLangSelectionData' => $tvLangSelectionData,
                    'radioLangSelectionData' => $radioLangSelectionData,
                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:'',
                    'getAllCityForFMStationOne'=>isset($getAllCityForFMStationOne->original['data']) ? $getAllCityForFMStationOne->original['data']:'',
                    'fmStateSelectionData'=>isset($fmStateSelectionData) ? $fmStateSelectionData:[],
                    'fmCitySelectionData'=>isset($fmCitySelectionData) ? $fmCitySelectionData:[]

                ]
            );
        }else {
            return Redirect('client-login');
        }
    }
    //end client detail

    public function previousLogs()
    {
        /*$current_url = url()->previous();

        $data = ['Activity_id'=> '10', 'module_id' => '2','current_url'=>$current_url];
        $logData=$this->saveLogs($data);*/
    }
    public function getCity($stateCode = '')
    {
        $districts = $this->getDistricts($stateCode);
        $response = json_decode(json_encode($districts), true);
        // echo"<pre>";print_r($districts->original['data']);die;
        // return response()->json($response['original']['data']);
        return  $districts->original['data'];
    }
    public function getCityStateBased($stateCode = '')
    {
        $getCityStateBased = $this->getAllCity($stateCode);
        $response = json_decode(json_encode($getCityStateBased), true);
        // echo"<pre>";print_r($districts->original['data']);die;
        // return response()->json($response['original']['data']);
        return  $getCityStateBased->original['data'];
    }
    public function getFMCityStateBased($stateCode = '')
    {
        //dd($stateCode);
        $getCityStateBased = $this->getAllCityForFMStationOne($stateCode);
        $response = json_decode(json_encode($getCityStateBased), true);
        return  $getCityStateBased->original['data'];
    }
    public function roList(Request $request)
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null && Session::has('UserName') ) {
            $response = array();
            $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime(strtr($request->from_date, '/', '-'))) : '';
            $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime(strtr($request->to_date, '/', '-'))) : '';
            $npcode = Session::get('UserName');
            
            $data = DB::table($this->tblROHeader.' as ROH')
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
                'RL.Amount AS RO_amount'
            )
            ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->orderBy('ROH.RO Date','DESC')->distinct('ROH.RO Code')  
            // ->where('ROH.Status','<>',4)           
            ->where('ROH.Status',3)           
            ->Where('RL.NP Code', $npcode);                    

            if (($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != '') {
                $data->whereDate('ROH.RO Date', '>=', $from_date)->whereDate('ROH.RO Date', '<=', $to_date);
            }
            $response = $data->paginate($this->perpage);
            if (isset($_REQUEST["submitreset"])) {
            return Redirect('release-order-list');
            }else{
                return view('admin.pages.release-order.ROList', compact('response','from_date','to_date'));
            }
            
        }else {
            return Redirect('vendor-login');
        }
    }
    public function viewRO($npcode = '', $lineno = '', $PlanId = '', $ClientId = '')
    {
        $np_code = decrypt($npcode);
        $line_no = decrypt($lineno);
        $Plan_Id = decrypt($PlanId);
        $Client_Id = decrypt($ClientId);
        $userid = Session::get('UserID');

        if ($userid != '' || $userid != null) {
            $response = array();
            DB::enableQueryLog();
            $response = DB::table($this->tblROHeader.' as ROH')
                ->select(
                    'ROH.*',
                    'MPL.*'
                )
                //->leftJoin('BOC$RO Line as RL', 'RL.NP Code','=','')
                ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                ->where('ROH.Plan ID', $Plan_Id)
                ->first();
            $query = DB::getQueryLog();
            //dd($query);

            return view('admin.pages.release-order.ROView', compact('response'));
        } else {

            return Redirect('vendor-login');
        }
    }
    public function getEmail(Request $request)
    {
        $resp = (new api)->getEmail($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json($response['original']['data']);
        } else {
            return response()->json($response['original']['message']);
        }
    }

    public function mailSendToClient($param = '')
    {
        $resp = (new api)->sendMailToClient($param);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == true) {
            return response()->json($response['original']['data']);
        } else {
            return response()->json($response['original']['message']);
        }
    }
    public function getODMediaSubCat($mgroupCatId = '',$mUIDCode='')
    {
        $mdata = $this->getODMediaSubCatList($mgroupCatId, $mUIDCode);
        return  $mdata->original['data'];
    }
    public function getClientcallbackForm()
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            return view('admin.pages.client-request.requestcallback');
         }else{
            return Redirect('client-login');
         }
    }
    public function MailForCallBack(Request $request){
        $mhcode = Session::get('UserName');
        if ($mhcode) {
            $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
            $ministries_head = DB::table($this->tblMinistriesHead)->select('Head Name as headName')
                ->where('Ministries Head', $mhcode)->first();
        }
        $mHeadName=isset($ministries_head->headName)?$ministries_head->headName:'';
       $details = [
                'title'=> 'Reminder',
                'name'=>isset($request->name)?$request->name:'',
                'mobile'=>isset($request->mobile)?$request->mobile:'',
                'mHeadName'=>$mHeadName,
                'body'=> isset($request->issue)?$request->issue:''
            ];
        $email=isset($request->email)?$request->email:'';
        $response=Mail::to($email)->send(new \App\Mail\clientcallbackmail($details));
        if($response) {
            return response()->json(['success'=>'true', 200]);
        } else {
            return response()->json(['success'=>'false', 400]);
        }

    }
    

    public function clientRequestPDF($userId =""){  
            $response       = Session::get('response');
            $wingType       = Session::get('wingType');
            $wingType_text  = Session::get('wingType_text');
            $mpstatus       =  Session::get('mpstatus');
            $from_date      = Session::get('from_date');
            
            $to_date        = Session::get('to_date');

            if($from_date == "" && $to_date == "")
            {
                // print_r("expression");die;
                $today_date    = date('d');
                $today_month    = date('m');
                // $today_month    = '03';
                $previous_year  = date('Y') - 1;
                $today_year     = date('Y');
                // print_r($today_date);die;

                if($today_month > 03)
                {
                    $from_date = $today_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                else
                {
                    $from_date = $previous_year.'-04-01';
                    $to_date = $today_year.'-'.$today_month.'-'.$today_date;
                }
                
            }
            // print_r($from_date); echo"<br>";
                // print_r("to:".$to_date);die;
            // echo"<pre>";print_r($response);die;
            //dd($response, $wingType, $wingType_text,  $mpstatus, $from_date, $to_date);
            $pdf =PDF::loadView('admin.pages.client-request.client-request-list-pdf',compact('response', 'wingType','wingType_text', 'mpstatus','from_date','to_date'));
            // return $pdf->download($userId. '.pdf');
            return $pdf->download('Media Request List.pdf');
        }

    public function roPrintPDF($npcode)
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) 
        {
            $response = [];
            if (Session::has('UserName') && Session('UserName') != '') {
            $response = DB::table($this->tblROHeader.' as ROH')
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
                'MPL.Version AS planVersion'
            )
            ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->orderBy('RL.Line No_', 'DESC')
            // ->where('ROH.Status','<>',4)
            ->where('ROH.Status',3)
            ->Where('RL.NP Code', $npcode)->get();
            }
            $pdf = \PDF::loadView('admin.pages.release-order.ROList-pdf', compact('response'));
        }
        return $pdf->download($npcode . '.pdf');
    }

    
public function GeneratePDFclientReq($clid =""){
        $userid = Session::get('UserID');
        $regionalLang = $this->getRegionalLanguages();
        if (($userid != '' || $userid != null) && ($clid !== '')) {
            $client_req_header = array();
            $print_client_req = array();
            $languages = $this->getLanguages();
            $states = $this->getStates();
            $districts = $this->getDistricts();
            $allCityData = $this->getAllCity();
            $allTrainData = $this->getTrain();

            $mhcode = Session::get('UserName');
            if ($mhcode) {
                $MHeadTable = '[BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2]';
                $ministries_head = DB::table($this->tblMinistriesHead)->select('*')
                    ->where('Ministries Head', $mhcode)->first();
            }
            $table1 = '[BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2]';
            $client_req_header = DB::table($this->tblClientRequestHeader)->select('*')
                ->where('User ID', $userid)
                ->where('Client Request No ', $clid)->first();
            $print_client_req = DB::table($this->tblPrintClientRequest)->select('*')
                ->where('Client Request No_', $clid)->first();
            $clientOutdoorData = DB::table($this->tblODMediaRequestHeader.' AS ODMRH')->select('ODMRH.*', 'ODR.*')
            ->leftjoin($this->tblODMediaRequest.' AS ODR', 'ODMRH.Client Request No', '=', 'ODR.Client Request No')
            ->where('ODMRH.Client Request No', $clid)->get();
            $clientTVData = DB::table($this->tblAVMedia)->select('*')
                ->where('Client Request No', $clid)->first();
            $clientRadioData = DB::table($this->tblRadioMediaRequest)->select('*')
                ->where('Client Request No', $clid)->first();

             $printCitySelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printCitySelection = DB::table($this->tblCitySelection)->select('*')
                ->where('Client Request No_', $clid)->where('Media Name', 'PRINT')->get()->toArray();   
            }
            if (is_array($printCitySelection)) {

                $distarr = array();
                foreach ($printCitySelection as  $Dist) {
                    $distarr[] = $Dist->{'City Name'};
                }
                if (is_array($distarr)) {

                    $printCitySelectionData = implode(',', $distarr);
                }
            } else {
                $printCitySelectionData = '';
            }
            $printStateSelection=array();
            if( ($client_req_header->Print==1 && $client_req_header->Outdoor==1) || ($client_req_header->Print==1 ) || ($client_req_header->Outdoor==1 ) ){
                $printStateSelection = DB::table($this->tblStateSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($printStateSelection)) {
                $stcode = array();
                foreach ($printStateSelection as  $st) {
                    $stcode[] = $st->{'State Code'};
                }
                if (is_array($stcode)) {
                    $printStateSelectionData = implode(',', $stcode);
                }
            } else {

                $printStateSelectionData= '';
            }
            $langSelection=array();
            if($client_req_header->Print==1){
                $langSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'PRINT')
                ->get()->toArray();
            }

            if (is_array($langSelection)) {

                $langarr = array();
                foreach ($langSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $langSelectionData = implode(',', $langarr);
                }
            } else {

                $langSelectionData = '';
            }
            //regional lang for tv
            $tvLangSelection=array();
            if($client_req_header->{'AV - TV'}==1){
                $tvLangSelection = DB::table($this->tblAVLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('AV Type', '0')
                ->get()->toArray();
            }

            if (is_array($tvLangSelection)) {

                $langarr = array();
                foreach ($tvLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $tvLangSelectionData = implode(',', $langarr);
                }
            } else {

                $tvLangSelectionData = '';
            }
            //dd($tvLangSelectionData);
            //regional lang for radio
            $radioLangSelection=array();
            if($client_req_header->{'AV - Radio'}==1){
                $radioLangSelection = DB::table($this->tblLanguageSelection)->select('*')
                ->where('Client Request No_', $clid)
                ->where('Media Name', 'CRS')
                ->get()->toArray();
            }

            if (is_array($radioLangSelection)) {

                $langarr = array();
                foreach ($radioLangSelection as  $lang) {
                    $langarr[] = $lang->{'Language Code'};
                }
                if (is_array($langarr)) {
                    $radioLangSelectionData = implode(',', $langarr);
                }
            } else {

                $radioLangSelectionData = '';
            }


             // get FM radio state and city
             $fmStateSelection=array();
             if($client_req_header->{'AV - Radio'}==1){
                 $fmStateSelection = DB::table($this->tblStateSelection)->select('*')
                 ->where('Client Request No_', $clid)
                 ->where('Media Name', 'FM')
                 ->get()->toArray();
             }
             if (is_array($fmStateSelection)) {
                 $fmstateCode = array();
                 foreach ($fmStateSelection as  $fmstate) {  $fmstateCode[] = $fmstate->{'State Name'}; }
                 if (is_array($fmstateCode)) {  $fmStateSelectionData = implode(',', $fmstateCode);}
             }else { $fmStateSelectionData = ''; }
             //get city for fm radio
             $fmCitySelection=array();
             if($client_req_header->{'AV - Radio'}==1){
                 $fmCitySelection = DB::table($this->tblCitySelection)->select('*')
                 ->where('Client Request No_', $clid)
                 ->where('Media Name', 'FM')
                 ->get()->toArray();
             }
             if (is_array($fmCitySelection)) {
                 $fmcityCode = array();
                 foreach ($fmCitySelection as  $fmcity) {  $fmcityCode[] = $fmcity->{'City Name'}; }
                 if (is_array($fmcityCode)) {    $fmCitySelectionData = implode(',', $fmcityCode); }
             }else { $fmCitySelectionData = ''; }
             //endfm radio state an city
            $outdata =[];
                       //dd($clientOutdoorData);
                      $IndianCi =DB::table('BOC$Indian City$3f88596c-e20d-438c-a694-309eb14559b2')->get();
                      $UserName = Session::get('UserName');
            
                      $dbresponse = DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as m')
                                          ->select('Ministry Name as ministry_name')
                                          ->leftjoin('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh','m.Ministry Code','=','mh.New Ministry Code')
                                          ->where('mh.Ministries Head',$UserName)
                                          ->first();
            $pdf =PDF::loadView('admin.pages.client-request.client-request-form-pdf',
                                [
                                    'languages' => $languages->original['data'],
                                    'regionalLang'=>$regionalLang->original['data'],
                                    'states' => $states->original['data'],
                                    'districts' => $districts->original['data'],
                                    'allCityData'=>$allCityData->original['data'],
                                    'client_req_header' => $client_req_header,
                                    'print_client_req' => $print_client_req,
                                    'clientOutdoorData'=>$clientOutdoorData,
                                    'clientTVData'=>$clientTVData,
                                    'clientRadioData'=>$clientRadioData,
                                    'ministries_head' => $ministries_head,
                                    'printCitySelectionData' => $printCitySelectionData,
                                    'printStateSelectionData' => $printStateSelectionData,
                                    'langSelectionData' => $langSelectionData,
                                    'tvLangSelectionData' => $tvLangSelectionData,
                                    'radioLangSelectionData' => $radioLangSelectionData,
                                    //'mediasubcategory'=>$outdata,
                                    //'IndianCi' => $IndianCi,
                                    'dbresponse' =>$dbresponse,
                                    //'trantNo' =>$trantNo,
                                    'fmStateSelectionData'=>$fmStateSelectionData,
                                    'fmCitySelectionData' =>$fmCitySelectionData,
                                    'allTrainData'=>isset($allTrainData->original['data'])?$allTrainData->original['data']:''
                    
                                ]
                            );
                           return $pdf->download($clid.'.pdf');
                    
        }
    }


     /*Start Fund status */
    public function fundstatusList()
    {
        
    $mhcode = Session::get('UserName');
    $head_code = ltrim($mhcode,0);
    $table = 'BOC$LOA Ledger$3f88596c-e20d-438c-a694-309eb14559b2';
    $get_amount = DB::table($table)->select('Authorized Amount as amount')->where('Head Code',$head_code)->first();
    $get_atotal =DB::table('BOC$print_status')->select('amount')->where('HEAD_NO',$mhcode)->sum('amount');
    $get_mhcode=DB::table('BOC$print_status')->select('HEAD_NO')->where('HEAD_NO',$mhcode)->first();
    $get_camt =DB::table('BOC$print_cmt')->select('amount')->where('HEAD_NO',$mhcode) ->sum('amount');
    $gemcmt=DB::table('BOC$print_cmt')->select('HEAD_NO')->where('HEAD_NO',$mhcode)->first();
    $get_expd =DB::table('BOC$print_expd')->select('amount')->where('HEAD_NO',$mhcode) ->sum('amount');
        $get_mhexpd=DB::table('BOC$print_expd')->select('HEAD_NO')->where('HEAD_NO',$mhcode)->first();
        if(!empty($get_amount))
        {
            $dbresponse['amount'] = round($get_amount->amount);
        }
        else{
            $dbresponse['amount'] = 0.00;
        }
        if($mhcode == 10101)
        {
            $dbresponse['opening_amount'] = '1187959';
            $dbresponse['closing_amount'] = '146';
        }
        else if($mhcode == 10103)
        {
            $dbresponse['opening_amount']  = '175339';
            $dbresponse['closing_amount'] = '610';
        }

        else if($mhcode == 10104)
        {
            $dbresponse['opening_amount']  = '150000';
            $dbresponse['closing_amount'] = '1975';
        }
        else if($mhcode == 10105)
        {
            $dbresponse['opening_amount']  = '11880';
            $dbresponse['closing_amount'] = '349';
        }
        else if($mhcode == 10109)
        {
            $dbresponse['opening_amount']  = '2100002';
            $dbresponse['closing_amount'] = '3420';
        }
        else if($mhcode == 15401)
        {
            $dbresponse['opening_amount']  = '104781116';
            $dbresponse['closing_amount'] = '244912';
        }
        else if($mhcode == 15402)
        {
            $dbresponse['opening_amount']  = '1826062';
            $dbresponse['closing_amount'] = '5207';
        }
        else
        {
            $dbresponse['opening_amount']  = '0.00';
            $dbresponse['closing_amount'] = '0.00';
        }
        return view('admin.pages.client-request.fund-status.fundstatuslist',$dbresponse,
        ['get_atotal' =>$get_atotal, 'get_mhcode' =>$get_mhcode,
        'get_expd'=>$get_expd,'get_mhexpd'=>$get_mhexpd, 'get_camt'=>$get_camt, 'gemcmt'=>$gemcmt]);

    }

    public function print_status($mt ='')
    {
        
        $get_tl =DB::table('BOC$print_status')->select('amount')->where('HEAD_NO',$mt) ->sum('amount');

        $get_mt_data=DB::table('BOC$print_status')
                        ->select('ROCODE',DB::raw('sum(amount) as sum'),DB::raw('count(amount) as count'))
                        ->where('HEAD_NO',$mt)
                        ->groupBy('ROCODE')
                        ->get();
        
        foreach($get_mt_data as $getData)
        {
            $get_mt_data=DB::table('BOC$print_status')
                        ->select('HEAD_NO','RO_RELEASED_DT','SUBJECT','no_of_insertion','AD_SPACE')
                        ->where('ROCODE',$getData->ROCODE)
                        ->first();
            $temp = [];


            $temp['ROCODE'] = $getData->ROCODE;
            $temp['HEAD_NO'] = $get_mt_data->HEAD_NO;
            $temp['RO_RELEASED_DT'] = $get_mt_data->RO_RELEASED_DT;
            $temp['SUBJECT'] = $get_mt_data->SUBJECT;
            $temp['NO_OF_INSERTION'] = $get_mt_data->no_of_insertion;
            $temp['NO_OF_ROS'] = $getData->count;
            $temp['AD_SPACE'] = $get_mt_data->AD_SPACE;
            $temp['amount'] = $getData->sum;

            $get_mt[] = $temp;

        } 

        $table  = 'print_status';        
        $Listname ='Bills Pending';
        return view('admin.pages.client-request.fund-status.fund-status-list-details',['get_mt'=>$get_mt, 'get_tl'=>$get_tl,'Listname'=>$Listname,'tb_name'=>$table]);
    }
    public function print_expd($mt ='')
    {
        // $get_mt=DB::table('BOC$print_expd')->where('HEAD_NO',$mt)->get();
        $get_tl =DB::table('BOC$print_expd')->select('amount')->where('HEAD_NO',$mt) ->sum('amount');

        $get_mt_data=DB::table('BOC$print_expd')
                        ->select('ROCODE',DB::raw('sum(amount) as sum'),DB::raw('count(amount) as count'))
                        ->where('HEAD_NO',$mt)
                        ->groupBy('ROCODE')
                        ->get();
        
        foreach($get_mt_data as $getData)
        {
            $get_mt_data=DB::table('BOC$print_expd')
                        ->select('HEAD_NO','RO_RELEASED_DT','SUBJECT','no_of_insertion','AD_SPACE')
                        ->where('ROCODE',$getData->ROCODE)
                        ->first();
            $temp = [];


            $temp['ROCODE'] = $getData->ROCODE;
            $temp['HEAD_NO'] = $get_mt_data->HEAD_NO;
            $temp['RO_RELEASED_DT'] = $get_mt_data->RO_RELEASED_DT;
            $temp['SUBJECT'] = $get_mt_data->SUBJECT;
            $temp['NO_OF_INSERTION'] = $get_mt_data->no_of_insertion;
            $temp['NO_OF_ROS'] = $getData->count;
            $temp['AD_SPACE'] = $get_mt_data->AD_SPACE;
            $temp['amount'] = $getData->sum;

            $get_mt[] = $temp;

        } 
        $table  = 'print_expd';
        $Listname ='Bills Expenditure';
        return view('admin.pages.client-request.fund-status.fund-status-list-details',['get_mt'=>$get_mt, 'get_tl'=>$get_tl,'Listname'=>$Listname,'tb_name'=>$table]);
    }

    public function print_cmt($mt =''){
        $get_mt_data=DB::table('BOC$print_cmt')
                        ->select('RO_CODE as ROCODE',DB::raw('sum(amount) as sum'),DB::raw('count(amount) as count'))
                        ->where('HEAD_NO',$mt)
                        ->groupBy('RO_CODE')
                        ->get();
        
        foreach($get_mt_data as $getData)
        {
            $get_mt_data=DB::table('BOC$print_cmt')
                        ->select('HEAD_NO','RO_RELEASED_DT','SUBJECT','NO_OF_INSERTION','AD_SPACE')
                        ->where('RO_CODE',$getData->ROCODE)
                        ->first();
            $temp = [];


            $temp['ROCODE'] = $getData->ROCODE;
            $temp['HEAD_NO'] = $get_mt_data->HEAD_NO;
            $temp['RO_RELEASED_DT'] = $get_mt_data->RO_RELEASED_DT;
            $temp['SUBJECT'] = $get_mt_data->SUBJECT;
            $temp['NO_OF_INSERTION'] = $get_mt_data->NO_OF_INSERTION;
            $temp['NO_OF_ROS'] = $getData->count;
            $temp['AD_SPACE'] = $get_mt_data->AD_SPACE;
            $temp['amount'] = $getData->sum;

            $get_mt[] = $temp;

        }    
        $get_tl =DB::table('BOC$print_cmt')->select('amount')->where('HEAD_NO',$mt) ->sum('amount');
        $Listname ='Release orders/Commitment';
        $table ='print_cmt';
        // echo"<pre>";print_r($get_mt);die;
        return view('admin.pages.client-request.fund-status.fund-status-list-details',['get_mt'=>$get_mt, 'get_tl'=>$get_tl,'Listname'=>$Listname,'tb_name'=>$table]);
    }

    public function release_order_details($rocode)
    {

        $roCode = str_replace("_","/",$rocode);


        $dbresponse['get_release_order']=DB::table('BOC$print_cmt')
                                    ->select('NEWSPAPER_CODE','NEWSPAPER_NAME','PUBLICATION_CITY','STATE_UT_NAME','amount')
                                    ->where('RO_CODE',$roCode)
                                    ->orderBy('NEWSPAPER_NAME','asc')
                                    ->get();
        $dbresponse['head_no'] =  Session::get('UserName');
        $dbresponse['ro_code'] =  $roCode;
        $dbresponse['get_tl'] =DB::table('BOC$print_cmt')->select('amount') ->where('RO_CODE',$roCode)->sum('amount');                                    
        return view('admin.pages.client-request.fund-status.release_order',$dbresponse);
    }

    public function bills_cleared_details($rocode)
    {

        $roCode = str_replace("_","/",$rocode);


        $dbresponse['get_release_order']=DB::table('BOC$print_expd')
                                    ->select('NEWSPAPER_CODE','NEWSPAPER_NAME','PUBLICATION_CITY','STATE_UT_NAME','amount')
                                    ->where('ROCODE',$roCode)
                                    ->orderBy('NEWSPAPER_NAME','asc')
                                    ->get();
        $dbresponse['head_no'] =  Session::get('UserName');
        $dbresponse['ro_code'] =  $roCode;
        $dbresponse['get_tl'] =DB::table('BOC$print_expd')->select('amount') ->where('ROCODE',$roCode)->sum('amount');                                    
        return view('admin.pages.client-request.fund-status.release_order',$dbresponse);
    }

    public function bills_pending_details($rocode)
    {

        $roCode = str_replace("_","/",$rocode);


        $dbresponse['get_release_order']=DB::table('BOC$print_cmt')
                                    ->select('NEWSPAPER_CODE','NEWSPAPER_NAME','PUBLICATION_CITY','STATE_UT_NAME','amount')
                                    ->where('RO_CODE',$roCode)
                                    ->orderBy('NEWSPAPER_NAME','asc')
                                    ->get();
        $dbresponse['head_no'] =  Session::get('UserName');
        $dbresponse['ro_code'] =  $roCode;
        $dbresponse['get_tl'] =DB::table('BOC$print_cmt')->select('amount') ->where('RO_CODE',$roCode)->sum('amount');                                    
        return view('admin.pages.client-request.fund-status.release_order',$dbresponse);
    }
    /*End Fund status */

    public function  client_profile(Request $request){
        $usertable ='BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2';
        if($request->isMethod('post')){
            $name =$request->name ?? '';
            $email=$request->email ?? '';
            $Mobile =$request->mobile ?? '';
            $Designation=$request->Designation ?? '';
            $Address =$request->Address ?? '';
            $storeinfo =[
                'name' =>$name,
                'email'     =>$email,
                'Mobile No_' =>$Mobile,
                'Designation' =>$Designation,
                'Address'     =>$Address
            ];
            $update =DB::table($usertable)
            ->where('User Name',$request->username)
            ->where('User Type',0)
            ->update($storeinfo);
            if($update){
                    Session::put('email', $email);
                    Session::put('Mobile', $Mobile);
                    Session::put('profile_name',$name);
                    Session::put('profile_designation',$Designation);
                    Session::put('profile_address',$Address);
                    return $this->sendResponse('', 'Profile has been updated successfully');
                    //return back()->with('message','Profile has been updated successfully');
            }else{
                return $this->sendError('Some Error Occurred!.');
                //return back()->with('error','Went something wrong');
            }
  
        }
        $userid =Session::get('UserName');
        $clientdata =DB::table($usertable)
        ->select('*')
        ->where('User Name',$userid)
        ->where('User Type',0)
        ->first();
        return view('admin.pages.client-request.client-profile',['clientdata'=>$clientdata]);
    }

 
}
