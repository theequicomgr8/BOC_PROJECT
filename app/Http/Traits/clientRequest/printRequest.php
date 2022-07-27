<?php
namespace App\Http\Traits\clientRequest;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Api\ApiLogsController as apiLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;
trait printRequest
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, clientRequestTableTrait;
    public function sendMailToClientForPrint(Request $request){
        //call sms and mail function
            if (isset($request->govt_email_id)) {
                $emails = array($request->email, $request->govt_email_id);
            } else {
                $emails = array($request->email);
            }
            $details = [
                'title'=> 'Reminder',
                'body' => 'Data has been Successfully Submitted.'
            ];
            $this->smsSend($request->mobile);
            $this->sendMailToClient($emails,$details);
            //$this->mailSend('Data has been Successfully Submitted','pmbocerp@gmail.com');
            if($request->print_advertisement_display_select=="0" && $request->print_creative!="0" ){
                $details1 = [
                    'title'=> 'Creative Reminder',
                    'body' => 'Kindly upload the pending creative by login on the portal.'
                ];
                $this->sendMailToClient($emails,$details1);
                
            }
            if($request->print_advertisement_display_select=="1"){
                $details2 = [
                    'title'=> 'QR Code Reminder',
                    'body' => 'Please send QR code.'
                ];
                $this->sendMailToClient($emails,$details2);

            }
            
            if($request->print_creative=="1" || $request->print_creative=="2"){
                $details3 = [
                    'title'=> 'Creative Reminder',
                    'body' => 'Creative is to be developed by CBC and you have one week buffer to submit.'
                ];
                $this->sendMailToClient($emails,$details3);
            }
            
            //end call sms and mail function
    }
    public function getPrintMediaName($reqnum=''){
        return $res = DB::table($this->tblClientRequestHeader)->select('Print','Outdoor')
                ->where('Client Request No',  $reqnum)->first();
    }
    public function deleteAllPrintSelection(Request $request){
        $mName=$this->getPrintMediaName($request->Client_ReqNo);
            if($mName && $mName->Print=="1"){
                $mediaName="PRINT";
            }
        $delsql1 = DB::table($this->tblStateSelection)->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
        $delsql2 = DB::table($this->tblCitySelection)->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
        $delsql3 = DB::table($this->tblLanguageSelection)->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
        if($delsql1 && $delsql2 && $delsql3){
            $msg = 'deleteAllPrintSelection Successfully!';
            return $this->sendResponse([], $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }
    }

    public function savePrintLanguage(Request $request){
        //start Language Selection save
        $print_language=$request->print_language;
        if ($print_language == "0" || $print_language == "1" || $print_language == "2") {

            if (count($request->multi_langauge_select) > 0) {
                $mName=$this->getPrintMediaName($request->Client_ReqNo);
                if($mName && $mName->Print=="1"){
                    $mediaName="PRINT";
                }
                
                foreach ($request->multi_langauge_select as $langkey => $langvalue) {
                    $langauge_Code =
                        isset($request->multi_langauge_select[$langkey]) ? $request->multi_langauge_select[$langkey] : '';
                    //dd($langauge_Code);
                    $printLangtData='';
                    if($langauge_Code!='' || $langauge_Code!=null){
                        $printLangtData = DB::table($this->tblLanguage)->select('Name')->where('Code',  $langauge_Code)->first();
                        $print_langName = $printLangtData->Name;
                    $selected_langVal = 1;
                    $line_no1 = DB::select('select TOP 1 [Line No_] from dbo.[BOC$Language Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                    if (empty($line_no1)) {
                        $line_no1 = 10000;
                    } else {
                        $line_no1 = $line_no1[0]->{"Line No_"};
                        $line_no1 = $line_no1 + 10000;
                    }
                    $lanPostData = array(
                        'Client Request No_'=>$request->Client_ReqNo,
                        'Line No_'=>$line_no1,
                        'Selected' => $selected_langVal,
                        'Media Name' => $mediaName,
                        'Lang(S_M)'=>$print_language  ,          
                        'Language Code'=>$langauge_Code ,    
                        'Language Name'=>$print_langName,
                        'Budget Percentage'=>0,
                        'Media Plan No_'=>0,
                        'Plan Type'=>0,
                        'Old Budget Pct_'=>0
                    );
                    $sql = DB::table($this->tblLanguageSelection)->insert($lanPostData);  

                    }
                       
                }
                if($sql){
                    $msg = 'Language Save Successfully!';
                    return $this->sendResponse([], $msg);
                }else{
                    return $this->sendError('Some Error Occurred!.');
                }

            }
        }
        //End Language Selection
    }
    public function savePrintStateAndCity(Request $request){
        //State selection
        if ($request->print_target_area == "2" && count($request->group_s) > 0) { 
            $mName=$this->getPrintMediaName($request->Client_ReqNo);
            if($mName && $mName->Print=="1"){
                $mediaName="PRINT";
            }
            
            foreach ($request->group_s as $skey => $svalue) {
                $group_s =isset($request->group_s[$skey]) ? $request->group_s[$skey] : '';
                if ($group_s!='' || $group_s!=null) {
                    $line_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$State Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                    if(empty($line_no)) {
                        $line_no = 10000;
                    }else {
                        $line_no = $line_no[0]->{"Line No_"}; $line_no = $line_no + 10000;
                    }
                    $StNameData = DB::table($this->tblState)->select('Description')
                    ->where('Code',  $group_s)->first();
                    $print_stateName = $StNameData->Description;
                    $state_selected = 1;
                    $statePostData = array(
                        'Client Request No_'=>$request->Client_ReqNo,
                        'Line No_'=>$line_no,
                        'Selected' => $state_selected,
                        'State Code' => $group_s,
                        'State Name' => $print_stateName,
                        'Media Name' => $mediaName,
                        'OD Request Line No_' =>0
                    );
                    $sql = DB::table($this->tblStateSelection)->insert($statePostData);
                }
            }
            if($sql){
                $msg = 'Group State Save Successfully!';
                return $this->sendResponse([], $msg);
            }else{
                return $this->sendError('Some Error Occurred!.');
            }
        } //end State Selection save
        //individual city with state
        //City selection
        if ($request->print_target_area == "1" && $request->city_with_state == 'on') {
            $mName=$this->getPrintMediaName($request->Client_ReqNo);
            if($mName && $mName->Print=="1"){
                $mediaName="PRINT";
            }
            
            $cityName = isset($request->cityList) ? $request->cityList : '';
            $cityData = DB::table($this->tblIndianCity)->select('Name AS CityName', 'State Code AS StateCode', 'State Name AS StateName')->where('Name',  $cityName)->first();
            $CityName =$cityData->CityName;
            $state_name = $cityData->StateName;
            $state_code = $cityData->StateCode;
            $selected_city = 1;
            $Cityline_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$City Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
            if (empty($Cityline_no)) {
                $Cityline_no = 10000;
            } else {
                $Cityline_no = $Cityline_no[0]->{"Line No_"};
                $Cityline_no = $Cityline_no + 10000;
            }
            $cityPostData = array(
                'Client Request No_'=>$request->Client_ReqNo,
                'Line No_'=>$Cityline_no,
                'Selected' => $selected_city,
                'State Code' => $state_code,
                'State Name' => $state_name,
                'City Name'=>$CityName,
                'Media Name' => $mediaName,
                'OD Request Line No_' =>0
            );
            $sql = DB::table($this->tblCitySelection)->insert($cityPostData); 
            if($sql){
                $msg = 'Citye Save Successfully!';
                return $this->sendResponse([], $msg);
            }else{
                return $this->sendError('Some Error Occurred!.');
            }      
        }
        //end indivisual city with state
        //City selection
        if ($request->print_target_area == "3" && $request->group_of_city == "5" ) {
            if (count($request->randomCityList) > 0) {
                $mName=$this->getPrintMediaName($request->Client_ReqNo);
                if($mName && $mName->Print=="1"){
                    $mediaName="PRINT";
                }
                
                foreach ($request->randomCityList as $citykey => $cityvalue) {
                    $cityName = isset($request->randomCityList[$citykey]) ? $request->randomCityList[$citykey] : '';
                    if ($cityName!='' || $cityName!=null) {
                        $cityData = DB::table($this->tblIndianCity)->select('Name AS CityName', 'State Code AS StateCode', 'State Name AS StateName')->where('Name',  $cityName)->first();
                        $CityName =$cityData->CityName;
                        $state_name = $cityData->StateName;
                        $state_code = $cityData->StateCode;
                        $selected_city = 1;
                        $Cityline_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$City Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                        if (empty($Cityline_no)) {
                            $Cityline_no = 10000;
                        } else {
                            $Cityline_no = $Cityline_no[0]->{"Line No_"};
                            $Cityline_no = $Cityline_no + 10000;
                        }
                        $cityPostData = array(
                            'Client Request No_'=>$request->Client_ReqNo,
                            'Line No_'=>$Cityline_no,
                            'Selected' => $selected_city,
                            'State Code' => $state_code,
                            'State Name' => $state_name,
                            'City Name'=>$CityName,
                            'Media Name' => $mediaName,
                            'OD Request Line No_' =>0
                        );
                        $sql = DB::table($this->tblCitySelection)->insert($cityPostData); 
                    }
                } 
                if($sql){
                    $msg = 'Citye Save Successfully!';
                    return $this->sendResponse([], $msg);
                }else{
                    return $this->sendError('Some Error Occurred!.');
                } 
            }
        }
        

    }
   
}


?>