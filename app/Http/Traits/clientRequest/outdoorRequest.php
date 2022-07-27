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
trait outdoorRequest
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, clientRequestTableTrait;
    public function sendMailToClientForOutdoor(Request $request){
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
            
            if($request->outdoorCreativeAvail=="1" || $request->outdoorCreativeAvail=="2"){
                $details3 = [
                    'title'=> 'Creative Reminder',
                    'body' => 'Creative is to be developed by BOC and you have one week buffer to submit.'
                ];
                $this->sendMailToClient($emails,$details3);
            }
            
            //end call sms and mail function
    }
    public function getOutdoorMediaName($reqnum=''){
        return $res = DB::table($this->tblClientRequestHeader)->select('Print','Outdoor')
                ->where('Client Request No',  $reqnum)->first();
    }
    public function deleteAllOutdoorSelection($Client_ReqNo){
        $mName=$this->getOutdoorMediaName($Client_ReqNo);
            if($mName && $mName->Outdoor=="1"){
                $mediaName="OD";
            }
        $delsql1 = DB::table($this->tblStateSelection)->where('Media Name',$mediaName)->where('Client Request No_',$Client_ReqNo)->delete();
        $delsql2 = DB::table($this->tblCitySelection)->where('Media Name',$mediaName)->where('Client Request No_',$Client_ReqNo)->delete();
       
        if($delsql1 && $delsql2){
            $msg = 'deleteAllPrintSelection Successfully!';
            return $this->sendResponse([], $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }
    }


    public function saveOutdoorStateAndCitySelection($outdoorTArea='', $GroupState='', $Client_ReqNo='', $OD_Request_Line_No='' ,$outdoorGroupCity='', $outdoorRandomCityList='' ){
        //State selection
        if ($outdoorTArea == "2" && count($GroupState) > 0) { 
            //dd($GroupState);
            //$this->deleteAllOutdoorSelection($Client_ReqNo);
            $mName=$this->getOutdoorMediaName($Client_ReqNo);
            if($mName && $mName->Outdoor=="1"){
                $mediaName="OD";
            }
            
            foreach ($GroupState as $skey => $svalue) {
                $outdoorGroupState = $svalue;
                if ($outdoorGroupState!='' || $outdoorGroupState!=null) {
                    $line_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$State Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
                    if(empty($line_no)) {
                        $line_no = 10000;
                    }else {
                        $line_no = $line_no[0]->{"Line No_"}; $line_no = $line_no + 10000;
                    }
                    $StNameData = DB::table($this->tblState)->select('Description')
                    ->where('Code',  $outdoorGroupState)->first();
                    $print_stateName = $StNameData->Description;
                    $state_selected = 1;
                    $statePostData = array(
                        'Client Request No_'=>$Client_ReqNo,
                        'Line No_'=>$line_no,
                        'OD Request Line No_'=>$OD_Request_Line_No,
                        'Selected' => $state_selected,
                        'State Code' => $outdoorGroupState,
                        'State Name' => $print_stateName,
                        'Media Name' => $mediaName
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
        /*if ( $outdoorTArea == "1"  )  {
            $mName=$this->getOutdoorMediaName($Client_ReqNo);
            if($mName && $mName->Outdoor=="1"){
                $mediaName="OD";
            }
            
            $cityName = isset($outdoorCityList) ? $outdoorCityList : '';
            $cityData = DB::table('BOC$Indian City')->select('Name AS CityName', 'State Code AS StateCode', 'State Name AS StateName')->where('Name',  $cityName)->first();
            $CityName =$cityData->CityName;
            $state_name = $cityData->StateName;
            $state_code = $cityData->StateCode;
            $selected_city = 1;
            $Cityline_no = DB::select('select TOP 1 [Line No_] from dbo.[BOC$City Selection] order by [Line No_] desc');
            if (empty($Cityline_no)) {
                $Cityline_no = 10000;
            } else {
                $Cityline_no = $Cityline_no[0]->{"Line No_"};
                $Cityline_no = $Cityline_no + 10000;
            }
            $cityPostData = array(
                'Client Request No_'=>$Client_ReqNo,
                'Line No_'=>$Cityline_no,
                'OD Request Line No_'=>$OD_Request_Line_No,
                'Selected' => $selected_city,
                'State Code' => $state_code,
                'State Name' => $state_name,
                'City Name'=>$CityName,
                'Media Name' => $mediaName
            );
            $sql = DB::table('BOC$City Selection')->insert($cityPostData); 
            if($sql){
                $msg = 'Citye Save Successfully!';
                return $this->sendResponse([], $msg);
            }else{
                return $this->sendError('Some Error Occurred!.');
            }      
        }*/
        //end indivisual city with state
        //City selection
        if ($outdoorTArea == "3" && $outdoorGroupCity == "5" ) {
            if (count($outdoorRandomCityList) > 0) {
                $mName=$this->getOutdoorMediaName($Client_ReqNo);
                if($mName && $mName->Outdoor=="1"){
                    $mediaName="OD";
                }
                
                foreach ($outdoorRandomCityList as $citykey => $cityvalue) {
                    $cityName = isset($outdoorRandomCityList[$citykey]) ? $outdoorRandomCityList[$citykey] : '';
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
                            'Client Request No_'=>$Client_ReqNo,
                            'Line No_'=>$Cityline_no,
                            'OD Request Line No_'=>$OD_Request_Line_No,
                            'Selected' => $selected_city,
                            'State Code' => $state_code,
                            'State Name' => $state_name,
                            'City Name'=>$CityName,
                            'Media Name' => $mediaName
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