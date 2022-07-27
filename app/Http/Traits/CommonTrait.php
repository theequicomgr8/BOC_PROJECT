<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Api\ApiLogsController as apiLog;
use Illuminate\Support\Facades\Mail;
use App\Mail\vendorSignupMail as vendorSendMail;
trait CommonTrait 
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   protected $perpage=10;
   public function sendResponse($result, $message)
   {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    
    public function sendMailVendorSignup($detail='', $emails='')
     {   
        Mail::to($emails)->send(new vendorSendMail($detail)); 
        return true;
    }


    
    // public function getLanguages(){
    //     $table = 'BOC$Language$3f88596c-e20d-438c-a694-309eb14559b2';
    //     $orderBy = 'Name';
    //     $select = array('Name','Code');
    //     $sort = 'ASC';         
    //     $where = 'BOC used Indian Language';
    //     $param = 1;
    //     $result = $this->fetchAllRecords($table,$select,$orderBy,$sort,$where,$param);
    //     if (($result->isEmpty())) {
    //         return $this->sendError('Language not found.');
    //         exit;
    //     }
        
    //     return $this->sendResponse($result, 'Language retrieved successfully.');
    // }

        public function getLanguages()
    {
        $host = request()->getHost();

        if(($host == '127.0.0.1') || ($host == '192.168.10.74'))
        {
            $url ="http://192.168.10.60:7048/BC180/ODataV4/Company('BOC')/Language";
        }
        else{

            $url = "http://20.219.125.221:7048/BC180/ODataV4/Company('BOC')/Language";
        }
        
        $userName = 'RATAN';
        $password = 'omiUOOOpuzuV/0MjAtVCgCb51NEADiB7WQw/ocWlgWE=';
        $headers = array(
           'Content-Type:application/json',
            'Authorization: Basic '. base64_encode($userName.':'.$password)
        );
        // Send request to Server
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        // Decode
       $resultt = json_decode($response);
        $result =$resultt->value;
        $LanguageData=[];
        foreach ($result as $key => $langvalue) {
            if($langvalue->BOC_used_Indian_Language==true){
                $LanguageData[]=$langvalue;
            }
        }
        if (($result)){
            return $this->sendResponse($LanguageData, 'Language retrieved successfully.');
        }else{
                return $this->sendError('Language not found.');
                exit;
            }
    }


    public function getStates(){
        $table = 'BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c';
        $orderBy = 'Description';
        $select = array('Code','Description');
        $sort = 'ASC';
        $result = $this->fetchAllRecords($table,$select,$orderBy,$sort);
        
        if (($result->isEmpty())) {
            return $this->sendError('State not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'State retrieved successfully.');
    }

    public function getLanguageCode($name)
    {
        # code...
        $host = request()->getHost();

        if(($host == '127.0.0.1') || ($host == '192.168.10.74'))
        {
            $url ="http://192.168.10.60:7048/BC180/ODataV4/Company('BOC')/Language";
        }
        else{

            $url = "http://20.219.125.221:7048/BC180/ODataV4/Company('BOC')/Language";
        }

        $userName = 'RATAN';
        $password = 'omiUOOOpuzuV/0MjAtVCgCb51NEADiB7WQw/ocWlgWE=';
        $headers = array(
           'Content-Type:application/json',
            'Authorization: Basic '. base64_encode($userName.':'.$password)
        );
        // Send request to Server
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        // Decode
        $resultt = json_decode($response);
        $result =$resultt->value;
        $LanguageData=[];
        $langCode = '';
        foreach ($result as $key => $langvalue) {
            if($langvalue->BOC_used_AV_Language==true){
                
                if($langvalue->Code == $name)
                { 
                    $langCode = $langvalue->BOC_Lang_Code;
                    // dd($langCode);
                }
                
            }
        }
        if (($langCode)){
            return $langCode;
        }else{
                return $this->sendError('Language not found.');
                exit;
            }

    }

   
    public function getRegionalLanguages(){
        $host = request()->getHost();

        if(($host == '127.0.0.1') || ($host == '192.168.10.74'))
        {
            $url ="http://192.168.10.60:7048/BC180/ODataV4/Company('BOC')/Language";
        }
        else{

            $url = "http://20.219.125.221:7048/BC180/ODataV4/Company('BOC')/Language";
        }
        
        $userName = 'RATAN';
        $password = 'omiUOOOpuzuV/0MjAtVCgCb51NEADiB7WQw/ocWlgWE=';
        $headers = array(
           'Content-Type:application/json',
            'Authorization: Basic '. base64_encode($userName.':'.$password)
        );
        // Send request to Server
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        // Decode
        $resultt = json_decode($response);
        $result =$resultt->value;
        $LanguageData=[];
        foreach ($result as $key => $langvalue) {
            if($langvalue->BOC_used_AV_Language==true){
                $LanguageData[]=$langvalue;
            }
        }
        if (($result)){
            return $this->sendResponse($LanguageData, 'Language retrieved successfully.');
        }else{
                return $this->sendError('Language not found.');
                exit;
            }
    }
    public function getDistricts($state_code=''){
    	//echo $request->state_code;exit;
        $table = 'BOC$District$3f88596c-e20d-438c-a694-309eb14559b2';
        $orderBy = 'District';
        $select = array('District');
        $sort = 'ASC';
        $where='State Code';
        $param=$state_code?$state_code:'';
        $result = $this->fetchAllRecords($table,$select,$orderBy,$sort,$where, $param);
        if (($result->isEmpty())) {
            return $this->sendError('District not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'District retrieved successfully.');
    }
    public function getAllCity($state_code=''){
        //echo $request->state_code;exit;
        $table = 'BOC$Indian City$3f88596c-e20d-438c-a694-309eb14559b2';
        $orderBy = 'Name';
        $select = array('Name AS CityName');
        $sort = 'ASC';
        $where='State Code';
        $param=$state_code?$state_code:'';
        $result = $this->fetchAllRecords($table,$select,$orderBy,$sort,$where, $param);
        if (($result->isEmpty())) {
            return $this->sendError('City not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'City retrieved successfully.');
    }
   public function getAllCityForFMStationOne($state_code='',$FMStation=1){
        $table = 'BOC$Indian City$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Name AS CityName');
        if($state_code!=''){
            $arr=explode(',',$state_code);
            $result = DB::table($table)->select($select)->where('FM Station',1)->whereIn('State Code',$arr)->get();
        }else{
           $result = DB::table($table)->select($select)->where('FM Station',1)->get();  
        }
       
        if (($result->isEmpty())) {
            return $this->sendError('City not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'City retrieved successfully.');
    }
    public function getODMediaSubCatList($mediaGroupId='', $mediaUIDCode=''){
        //echo $request->state_code;exit;
        $table = 'BOC$OD Media Category$3f88596c-e20d-438c-a694-309eb14559b2';
        $orderBy = 'Name';
        $select = array('Name','OD Media UID AS ODMediaUID');
        $sort = 'ASC';
        $where='Category Group';
        $param=$mediaGroupId?$mediaGroupId:'';
        if($mediaUIDCode!=''&& $mediaGroupId!=''){
           $result= DB::table($table)->select($select)->where('Category Group',$mediaGroupId)->where('OD Media UID',$mediaUIDCode)->get();
        }else{
           //$result = $this->fetchAllRecords($table,$select,$orderBy,$sort,$where, $param); 
            $result= DB::table($table)->select($select)->where('Category Group',$mediaGroupId)->get();
        } 
        
        if (($result->isEmpty())) {
            return $this->sendError('Sub media Category not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'City retrieved successfully.');
    }

    

    public static function fetchAllRecords($table,$select,$orderBy,$sort,$where='', $param='')
    {
        $response = DB::table($table); 
        $response->select($select);                    
        $response->OrderBy($orderBy,$sort);
        if(!empty($param)){
            $response->where($where,$param);
        } 
        $res=  $response->get();
        return $res;
    }

    public static function updateAllRecords($table,$update,$where){
        return $res = DB::table($table)->where($where)->update($update);
    }

    public function saveLogs($data)
    { 
        $Client_IP   = file_get_contents('http://ipecho.net/plain');  
        $User_id     = Session::get('UserID');
        $Activity_id = $data['Activity_id'];
        $PageURL     =  $data['current_url'];
        $Module_id   = $data['module_id'];
        $logData=array(
            'Client_IP'=>$Client_IP,
            'User_id'=>$User_id,
            'Activity_id'=>$Activity_id,
            'PageURL'=>$PageURL,
            'Module_id'=>$Module_id,

        );

        $resp = (new apiLog)->save_logs($logData);
        $response = json_decode(json_encode($resp), true);
            // dd($response);
            // if ($response['original']['success'] == false) {
            //     return response()->json($response['original']);
            // }
            // if ($response['original']['success'] == true) {
            // return response()->json($response['original']);
    }

    //SEND MAIL AND SMS FUNCTION

   public  function smsSend($mobile = '')
    {
        $username = urlencode("expediensadmin");
        $password = urlencode("Pass@123");
        $sender_id = urlencode("IUMSAP");
        $message = urlencode("आपका नाम UG Sports की XXXX XXXX अस्थाई वरियता सूची में हैं आप अपने फॉर्म की हार्ड कॉपी आवश्यक दस्तावेजों के साथ XXXX XXXX (अंतिम तिथि)तक संबंधित संकाय/विभाग जमा करवाए तथा फॉर्म को ऑनलाइन सत्यापित करवाकर शुल्क XXXX XXXX(अंतिम तिथि)तक जमा करवाए।-IUMS");
        $mobile = $mobile;
        $api = "https://api.instaalerts.zone/SendSMS/sendmsg.php?uname=" . $username . "&pass=" . $password . "&send=" . $sender_id . "&dest=" . $mobile . "&msg=" . $message . "&unicode=1&dlt_entity_id=1601100000000007973&dlt_template_id=1607100000000153392";
        $response = file_get_contents($api);
        return true;
    }
   public function otpsmsSend($mobile = '', $message1='')
    {
        $username = urlencode("expediensadmin");
        $password = urlencode("Pass@123");
        $sender_id = urlencode("IUMSAP");
        $message = urlencode("आपका नाम UG Sports की XXXX XXXX अस्थाई वरियता सूची में हैं आप अपने फॉर्म की हार्ड कॉपी आवश्यक दस्तावेजों के साथ XXXX XXXX (अंतिम तिथि)तक संबंधित संकाय/विभाग जमा करवाए तथा फॉर्म को ऑनलाइन सत्यापित करवाकर शुल्क XXXX XXXX(अंतिम तिथि)तक जमा करवाए।-IUMS");
        $mobile=$mobile;
        $api = "https://api.instaalerts.zone/SendSMS/sendmsg.php?uname=" . $username . "&pass=" . $password . "&send=" . $sender_id . "&dest=" . $mobile . "&msg=" . $message . "&unicode=1&dlt_entity_id=1601100000000007973&dlt_template_id=1607100000000153392";
        $response = file_get_contents($api);
        return true;
    }

    public function mailSend($detail='', $emails='')
    {
        
        Mail::to($emails)->send(new \App\Mail\BocMail($detail));
        return true;
    }

    public function getOwnerID($table,$np_code)
    {         
        $orderBy = 'Newspaper Code';
        $select = array('Owner ID');
        $sort = 'ASC';
        $where = 'Newspaper Code';
        $param = $np_code;
        $result = $this->fetchAllRecords($table,$select,$orderBy,$sort,$where, $param);
        
        if (($result->isEmpty())) {
            return $this->sendError('Data not found!');
            exit;
        }        
        return $this->sendResponse($result, 'Data retrieved successfully.');   
    }

    public function AgencyNameFromgst($gstNumber)
    {
        //gst no 09AADCS2308B1ZU
        $url = "https://apisetu.gov.in/gstn/v1/taxpayers/" . $gstNumber;
        $apiKey = 'LoYt543GxbGJJuV6KXbgvs0EmNv9INJk'; // should match with Server key
        $headers = array(
            // 'Authorization: '.$apiKey
            "accept: application/json",
            "X-APISETU-CLIENTID: in.nic.davp",
            "X-APISETU-APIKEY: LoYt543GxbGJJuV6KXbgvs0EmNv9INJk",
        );
        // Send request to Server 
        $ch = curl_init($url);
        // To save response in a variable from server, set headers;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Get response
        $response = curl_exec($ch);
        $result = json_decode($response);
        // dd($result);
        return $this->sendResponse($result, 'Data retrieved successfully.');
    }

    public function ClientMailSend($detail='', $emails='')
    {
        
        Mail::to($emails)->send(new \App\Mail\clientmail($detail));
        return true;
    }

    public function getTrain(){
        $table = 'BOC$Trains$3f88596c-e20d-438c-a694-309eb14559b2';
        $orderBy = 'Train No_';
        $select = array('Train No_','Name as trainName');
        $sort = 'ASC';
        $result = $this->fetchAllRecords($table,$select,$orderBy,$sort);
        
        if (($result->isEmpty())) {
            return $this->sendError('Train number not found.');
            exit;
        }
        
        return $this->sendResponse($result, 'State retrieved successfully.');
    }

    public function getcities($state_code = '')
    {
        $table = 'BOC$OD City$3f88596c-e20d-438c-a694-309eb14559b2';
        $orderBy = 'Name';
        $select = array('Name AS cityName','State Code as stateCode');
        $sort = 'ASC';
        $where = 'State Code';
        $param = $state_code ? $state_code : '';
        $result = $this->fetchAllRecords($table, $select, $orderBy, $sort, $where, $param);
        if (($result->isEmpty())) {
            return $this->sendError('City not found.');
            exit;
        }

        return $this->sendResponse($result, 'City retrieved successfully.');
    }

    public function mailSendBankAccount($detail='', $emails=''){
        Mail::to($emails)->send(new \App\Mail\accountMail($detail));
        return true;
    }

    // PDF To Image
    public function pdfToImage($fileName)
    {
        $destinationPath = public_path() . '/uploads/client-request/';
            
        if($fileName) {
            $file = $fileName;
            // dd($file);
            $creative_name = uniqid() . '.png';
            $file = str_replace('data:image/png;base64,', '', $file);
            $file = str_replace(' ', '+', $file);
            $file = base64_decode($file);
            $new_file = imagecreatefromstring($file);
            header('Content-Type: image/png');
            $filep = $destinationPath.$creative_name;
            $img_jpg = imagepng($new_file,$filep);
                  
        }else {
            $creative_name = '';
        }
        return $creative_name;
      
    }
}

?>