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
trait tvRequest
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, clientRequestTableTrait;
    public function sendMailToClientFortv(Request $request){
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
            
           /* if($request->tvCreativeAvail=="1" || $request->tvCreativeAvail=="2"){
                $details3 = [
                    'title'=> 'Creative Reminder',
                    'body' => 'Creative is to be developed by BOC and you have one week buffer to submit.'
                ];
                $this->sendMailToClient($emails,$details3);
            }*/
            
            //end call sms and mail function
    }
    public function gettvMediaName($reqnum=''){
        return $res = DB::table($this->tblClientRequestHeader)->select('Print','AV - Tv AS tv' )
                ->where('Client Request No',  $reqnum)->first();
    }
    public function deleteAlltvSelection(Request $request){
        /*$mName=$this->gettvMediaName($request->Client_ReqNo);
            if($mName && $mName->tv=="1"){
                $mediaName="TV";
            }*/
        $delsql1 = DB::table($this->tblAVLanguageSelection)->where('AV Type',0)->where('Client Request No_',$request->Client_ReqNo)->delete();
       // $delsql2 = DB::table('BOC$Genre Selection')->where('Media Name',$mediaName)->where('Client Request No_',$request->Client_ReqNo)->delete();
       
        if($delsql1 ){
            $msg = 'deleteAllPrintSelection Successfully!';
            return $this->sendResponse([], $msg);
        }else{
            return $this->sendError('Some Error Occurred!.');
        }
    }
    public function savetvRegLangAndGenre(Request $request){
        //start Language Selection save
        $tvRegion=$request->tvRegion;
        if ($request->tvTargetArea == "1" || $request->tvTargetArea == "2") {
            if (count($request->tvRegion) > 0) {
                //dd($tvRegion);
                /*$mName=$this->gettvMediaName($request->Client_ReqNo);
                if($mName && $mName->tv=="1"){
                    $mediaName="TV";
                }*/
                foreach ($request->tvRegion as $langkey => $langvalue) {
                    $langauge_Code =
                        isset($request->tvRegion[$langkey]) ? $request->tvRegion[$langkey] : '';
                    $tvLangtData='';
                    if($langauge_Code!='' || $langauge_Code!=null){
                        $tvLangtData = DB::table($this->tblLanguage)->select('Name')->where('Code',  $langauge_Code)->first();
                        $tv_langName = $tvLangtData->Name;
                        $selected_langVal = 1;
                        $line_no1 = DB::select('select TOP 1 [Line No_] from dbo.[BOC$AV Language Selection$3f88596c-e20d-438c-a694-309eb14559b2] order by [Line No_] desc');
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
                            'AV Type' =>0,
                            //'Lang(S_M)'=>0,          
                            'Language Code'=>$langauge_Code ,    
                            'Language Name'=>$tv_langName,
                            'Budget Percentage'=>0,
                            'Media Plan No_'=>0,
                            'Plan Type'=>0,
                            'Old Budget Pct_'=>0
                        );
                        $sql = DB::table($this->tblAVLanguageSelection)->insert($lanPostData);
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
   
}


?>