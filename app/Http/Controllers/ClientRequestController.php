<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Session;

class ClientRequestController extends Controller
{
    
 
    public function clientRequest(){      
        $languages = DB::select('select Code,Name from [BOC$Language]');
        $states = DB::select('select Code,Description from [BOC$State]');
        $ministries = DB::select('select [Ministry Code],Description from [BOC$Ministries]');    
        $departments = DB::select('select pk_deptid,description from [Department_mst] order by description');
        $cities = DB::select('select Name,[State Name],[State Code] from [BOC$Indian City]');
        if (\Session::exists('user')) {
            $session_data = \Session::get('user');
            $contact_person = $session_data[0]->{'User Name'};
            return view('admin.pages.client-request',['languages' => $languages,'states' => $states,'cities' => $cities,'ministries' => $ministries,'user_name' =>$contact_person,'departments'=>$departments]);
        }  else{
            return redirect('/login'); 
        }
    }

    public function ministryCode(Request $request){
         $table = '[BOC$Ministries Head]';
         $ministries_head = DB::select("select [Ministry Code],[Ministries Head],[Head Name] from $table where [Ministry Code] = '".$request->ministry_code."' ");
         if(!empty($ministries_head)){
             $data="<option value=''>Please Select</option>";
             foreach($ministries_head as $item){
             $data.='<option value='.$item->{'Ministries Head'}.'>'.$item->{'Ministry Code'}.'~'.$item->{'Ministries Head'}.'</option>';
             }
             return response()->json(['status' => 0, 'message' => $data]);
         }else{
             return response()->json(['status' => 1, 'message' => '<option value="">No Data Found!</option>']);
         }
    }

    public function ministryHead(Request $request){
        $table = '[BOC$Ministries Head]';
        $ministries_head = DB::select("select [Head Name] from $table where [Ministries Head] = '".$request->ministry_head."' ");
        if(!empty($ministries_head)){           
            return response()->json(['status' => 0, 'message' => $ministries_head[0]->{'Head Name'}]);
        }else{
            return response()->json(['status' => 1, 'message' => '<option value="">No Data Found!</option>']);
        }        
    }

    public function stateCities(Request $request){
        $table = '[BOC$Indian City]';
        $city_name = DB::select("select [Name],[State Name],[State Code] from $table where [State Code] = '".$request->state_id."'");
        if(!empty($city_name)){
            $data="";
            foreach($city_name as $item){
            $data.='<option value='.$item->{'Name'}.'~'.$item->{'State Name'}.'~'.$item->{'State Code'}.'>'.$item->{'Name'}.'</option>';
            }
            return response()->json(['status' => 0, 'message' => $data]);
        }else{
            return response()->json(['status' => 1, 'message' => 'No Data Found!']);
        }
    }

    public function clientRequestSave(Request $request){ 
        $request->validate(
            [
            'officer_name' => 'required',
            'department_code' => 'required',
            'email_id' => 'required',
            'ministry_code' => 'required',
            'ministry_head' => 'required',
            'mobile_no' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'budget' => 'required',
            'target_area' => 'required',
            'lang_type' => 'required',
            'language1' => 'required',
            'designation' => 'required',
            'reference_no' => 'required',
            'region' => 'required'
            ], 
            [
            'officer_name.required' => 'Officer Name field is required',
            'department_code.required' => 'Department Code field is required',
            'email_id.required' => 'Email ID field is required',
            'ministry_code.required' => 'Ministry Code field is required',
            'ministry_head.required' => 'Ministry Head field is required',
            'mobile_no.required' => 'Mobile No. field is required',
            'from_date.required' => 'From Date field is required',
            'to_date.required' => 'To Date field is required',
            'budget.required' => 'Budget field is required',
            'target_area.required' => 'Target Area field is required',
            'lang_type.required' => 'Language Type field is required',
            'language1.required' => 'Language I field is required',
            'designation.required' => 'Designation field is required',
            'reference_no.required' => 'Reference No. field is required',
            'region.required' => 'Region field is required'
            ]
          );
       
        $destinationPath = public_path().'/uploads/';
        $file = $request->file('document_file');
        $file_name = '0';
        if($request->hasFile('document_file')){
            $file_name =  time().'-'.$file->getClientOriginalName();
            $file->move($destinationPath, $file_name); 
        }
        
        if($request->size == '2' || $request->length == '' || $request->breadth == ''){
            $request->length = 0.00;
            $request->breadth = 0.00;
        }
        if($request->advertisement_type == ''){
            $request->advertisement_type =0;
        }
        
       $lang2 = $request->language2 ? $request->language2 : '0';
       $lang3 = $request->language3 ? $request->language3 : '0';
       $lang4 = $request->language4 ? $request->language4 : '0';
       $lang5 = $request->language5 ? $request->language5 : '0';
       // dd($request);
        $mytime = Carbon::now();
        $request_date = $mytime->format('Y-m-d');
       /* if (\Session::exists('user')) {
            $session_data = \Session::get('user');
            $contact_person = $session_data[0]->{'User Name'};
        }*/
        $state_code = ' ';
        if($request->target_area == '1'){
            $state_code = $request->state;
        }
       
        $media_name0 = 0;$media_name1 = 0; $media_name2 = 0; $media_name3 = 0;$media_name4 = 0;
        if(count($request->media_name)>0){           
           // $media_arr = array('Print','AV','Outdoor','Printed');
        foreach($request->media_name as $media_name){
            if($media_name == 'Print'){
                $media_name0 =1;
            }
            if($media_name == 'AV'){
                $media_name1 =1;
            }
            if($media_name == 'Outdoor'){
                $media_name2 =1;
            }
            if($media_name == 'Printed'){
                $media_name3 =1;
            }
        }
    }
    $req_no = DB::select('select TOP 1 [Client Request No] from dbo.[BOC$Client Request Header] order by [Client Request No] desc');
    if(empty($req_no)){
        $req_number = 'CR-1'; 
    }else{
        $re_no = $req_no[0]->{"Client Request No"};
        $number = "";
        $prefix = "";
        $strArray = str_split($re_no);
        foreach ($strArray as $char) {  
            if (is_numeric($char))  {
                $number .= $char;   
            } else {
                $prefix .= $char;   
            }
        }
        $length = strlen($number);
        $number = sprintf('%0' . $length . 'd', $number + 1);
        $req_number = $prefix . $number;
  
        }

        $omr_id = $req_number.'/'.$request->ministry_head;
        $table = '[BOC$Client Request Header]';       
        $sql =  DB::insert("insert into $table ([timestamp],[Client Request No],[Ministry Code],[Ministry Head],
        [Department Code],[Client Refrence No_],[Requesting officer Name],[Email Id],[Request Date],
        [Overall Budget],[Campaign Type],[Attachment],[No_ Series],[Region],[City],[Designation],[Address],
        [Phone No_],[Fax No_],[Mobile No_],[comment],[comment date],[State],[OMR ID],[Print],[Audio Visual],
        [New Media],[Outdoor],[Outreach]) 
        values (DEFAULT,'".$req_number."','".$request->ministry_code."','".$request->ministry_head."',
        '".$request->department_code."','".$request->reference_no."','".$request->officer_name."',
        '".$request->email_id."','".$request_date."',$request->budget,$request->campaign_type,'".$file_name."',
        'CR-NO',$request->region,' ','".$request->designation."','".$request->address."',
        '".$request->phone_no."',' ','".$request->mobile_no."','".$request->comments."','".$request_date."',
        '".$request->state."','".$omr_id."',$media_name0,$media_name1,$media_name4,$media_name2,$media_name3");
       
        if ($sql) {
            $datefrom = strtotime($request->from_date);
             $dateto = strtotime($request->to_date);
             $from_date1 = date("Y-m-d",$datefrom); 
             $to_date1 = date("Y-m-d",$dateto);
             $fromdate = date_create($from_date1);
             $todate = date_create($to_date1);
             $diff= date_diff($fromdate,$todate);
             $time_duration = $diff->format("%a days");
           if($media_name0 == '1'){
            $table1 = '[BOC$Print Client Request]';
            $advt_size = $request->length * $request->breadth;
            $city_group =$request->city_group ? $request->city_group : 0;
            $statewithcity =$request->statewithcity ? $request->statewithcity : 0;
            $sql = DB::insert("insert into $table1 ([timestamp],[Client Request No_],[Advertisement Type],[Print Budget],
            [Not Before Date],[Not After Date],[Target Area],[Size of Advt_],[Color],[Lang(S_M)],[Language - I],
            [Language - II],[Language - III],[Language - IV],[Language - V],[Remarks],[Advt_ Length],
            [Advt_ Breadth],[Plan Posted],[Posting Date],[State I],[State II],[State III],[State List],
            [City Groups],[City],[State With City])   
            values (DEFAULT,'".$req_number."',$request->advertisement_type,$request->budget,
            '".$from_date1."','".$to_date1."',$request->target_area,$advt_size,$request->color,$request->lang_type,
            '".$request->language1."','".$lang2."','".$lang3."','".$lang4."','".$lang5."','".$request->comments."',
            $request->length,$request->breadth,0,'".$request_date."','".$request->state."',' ',' ','".$request->state."',
            $city_group,' ',$statewithcity)");
            if($request->target_area == 2){
                $table2 = '[BOC$State Selection]';
                foreach($request->states as $state){
                    $state_data = explode('~',$state);
                    $state_code = $state_data[0];
                    $state_name = $state_data[1];
                                 
                    $line_no = DB::select("select TOP 1 [Line No_] from $table2 where [Client Request No_] = '".$req_number."' order by [Line No_] desc");
                    if(empty($line_no)){
                       $line_no = 1000;   
                    }else{
                       $line_no = $line_no[0]->{"Line No_"}+1000;
                    }
                    $sql = DB::insert("insert into $table2 ([timestamp],[Client Request No_],[Line No_],
                    [State Code],[Selected],[State Name])   
                    values (DEFAULT,'".$req_number."','".$line_no."','".$state_code."',
                    '1','".$state_name."')");
                }
            }    
           
            if($request->target_area == 3 && $request->city_group == '5' || $request->statewithcity == '1'){
                $table2 = '[BOC$City Selection]';
                $city_array = $request->cities ? $request->cities : $request->city;
                foreach($city_array as $city){
                    $city_data = explode('~',$city);
                    $city_name = $city_data[0];
                    $state_name = $city_data[1];
                    $state_code = $city_data[2];
                    $line_no = DB::select("select TOP 1 [Line No_] from $table2 where [Client Request No_] = '".$req_number."' order by [Line No_] desc");
                    if(empty($line_no)){
                       $line_no = 1000;   
                    }else{
                       $line_no = $line_no[0]->{"Line No_"}+1000;
                    }
                    $sql = DB::insert("insert into $table2 ([timestamp],[Client Request No_],[Line No_],
                    [City Name],[Selected],[State Name],[State Code])   
                    values (DEFAULT,'".$req_number."','".$line_no."','".$city_name."',
                    '1','".$state_name."','".$state_code."')");
                }
            }   

        //    }elseif($media_name1 == '1'){
        //     $pan_india = ' ';$country = ' ';
        //     foreach($request->submedia_av as $submedia_av){
        //         if($submedia_av ==0){
        //           $pan_india=0;
        //         }
        //      $table1 = '[BOC$AV Media]';             
        //      $line_no = DB::select("select TOP 1 [Line No_] from $table1 where [Client Request No] = '".$req_number."' order by [Line No_] desc");
        //      if(empty($line_no[0])){
        //         $line_no = 1000;   
        //      }else{
        //         $line_no = $line_no[0]->{"Line No_"}+1000;
        //      }
        //     $sql = DB::insert("insert into $table1 ([timestamp],[Client Request No],[Line No_],
        //     [Media Type],[From Date],[To Date],[Time Band],[Pan India],[Region],[State],[City],[Country],[Allocated Budget],
        //     [Lang(S_M)],[Language - I],[Language - II],[Language - III],[Language - IV],[Language - V],[Time Duration],
        //     [Rate],[Secondage],[spots],[Target Area],[category],[AV Media Category Name])   
        //     values (DEFAULT,'".$req_number."','".$line_no."','AV','".$from_date1."','".$to_date1."',
        //     ' ',$pan_india,'".$request->region."','".$request->state."','".$request->city."','".$country."',$request->budget,
        //     $request->lang_type,'".$request->language1."','".$request->language2."','".$request->language3."',
        //     '".$request->language4."','".$request->language5."','".$time_duration."',$request->budget,0,0,
        //     $request->target_area,$request->category,$submedia_av)");
        //     }
        //    }elseif($media_name2 == '2'){
        //     $table = '[BOC$AV Media]';
        //     $datefrom = date_create($request->from_date);
        //     $dateto = date_create($request->to_date);
        //     $from_date = date_format($datefrom,"Y-m-d H:i:s"); 
        //     $to_date = date_format($dateto,"Y-m-d H:i:s");
        //     $sql = DB::insert("insert into $table1 ([timestamp],[Client Request No],[Media Category No],[AV Media Category Name],
        //     [Media Type],[From Date],[To Date],[Time Band],[Pan India],[Region],[State],[City],['Country'],[Allocated Budget],
        //     [Lang(S_M)],[Language - I],[Language - II],[Language - III],[Language - IV],[Language - V],[Time Duration],
        //      Rate],[Secondage],[spots],[Target Area],[category])   
        //     values (DEFAULT,'".$update_req_no."','".$request->ministry_code."','".$request->ministry_head."',
        //     $request->advertisement_type,'".$request->officer_name."','".$request->designation."',
        //     '".$request->email_id."','".$request->mobile_no."','".$request->phone_no."',
        //     '".$request->address."','".$request->reference_no."',$request->budget,'".$from_date."','".$to_date."',
        //     $request->target_area,0.00,$request->color,$request->lang_type,'".$lang_code1."','".$lang_code2."',
        //     '".$lang_code3."','".$lang_code4."','".$lang_code5."','".$request->comments."','0','".$file_name."',
        //     'CLREQUST','".$request->head_name."','0',$request->length,$request->breadth,0,'".$request_date."',
        //     '".$state_code."',' ','0','0','0','0','".$lang_name1."','".$lang_name2."',
        //     '".$lang_name3."','".$lang_code4."','".$lang_name5."','0',$request->campaign_type,'0',0,1,'0')");
        //    }else{
            // foreach($request->media_name as $media_name){
            //    if($media_name == 'Print'){                  
            //     $datefrom = date_create($request->from_date);
            //     $dateto = date_create($request->to_date);
            //     $from_date = date_format($datefrom,"Y-m-d H:i:s"); 
            //     $to_date = date_format($dateto,"Y-m-d H:i:s");                         
            //    $sql = DB::insert("insert into $table1 ([timestamp],[Client Request No],[Media Category No],[AV Media Category Name],
            //     [Media Type],[From Date],[To Date],[Time Band],[Pan India],[Region],[State],[City],['Country'],[Allocated Budget],
            //     [Lang(S_M)],[Language - I],[Language - II],[Language - III],[Language - IV],[Language - V],[Time Duration],
            //      Rate],[Secondage],[spots],[Target Area],[category]) 
            //     values (DEFAULT,'".$request->request_no."','".$request->ministry_code."','".$request->ministry_head."',
            //     $request->advertisement_type,'".$request->officer_name."','".$request->designation."','".$request->email_id."','".$request->mobile_no."','".$request->phone_no."',
            //     '".$request->address."','".$request->reference_no."',$request->budget,'".$from_date."','".$to_date."',
            //     $request->target_area,0.00,$request->color,$request->lang_type,'".$lang_code1."','".$lang_code2."',
            //     '".$lang_code3."','".$lang_code4."','".$lang_code5."','".$request->comments."','0','".$file_name."',
            //     'CLREQUST','".$request->head_name."','0',$request->length,$request->breadth,0,'".$request_date."',
            //     '".$state_code."',' ','0','0','0','0','".$lang_name1."','".$lang_name2."',
            //     '".$lang_name3."','".$lang_code4."','".$lang_name5."','0',$request->campaign_type,'".$request->submedia_print."',0,1,'".$media_name."')");
            //     }
            // }
         
            }
            if($sql){
                return back()->with(['status'=>'Success','message'=>'Data Save Successfully!']);           
             }else{
                return back()->with(['status'=>'Fail','message'=>'Some Error Occurred!']);
            }
                   
    }else{
        return back()->with(['status'=>'Fail','message'=>'Some Error Occurred!']);
    }
}
}