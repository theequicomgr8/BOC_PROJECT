<?php

namespace App\Http\Controllers\billing\AV_RadioMediabilling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use Validator;
use URL;
use App\Models\Api\AVTVCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AVTVExcelsImport;
use Session;
class RadioController extends Controller
{

    public function index(){   
        $username=Session::get('UserName');  

        $data=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2 as line')
                    ->where('line.Agency Code',$username)
                    ->distinct()
                    ->get();

        return view('admin.pages.billing.RedioMediaBilling.index',['data'=>$data]);
    }
    public function create($id =''){
        $username=Session::get('UserName');
        $code=str_replace("-", "/", $id);
        $ro_no=Session::put('ro_no',$code);
        $data =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where(['Agency Code'=>$username,"RO No_"=>$code])->first();
        
        $dataline =DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO NO_',$code)->get();
        // $avmaster =DB::table('BOC$AV Rate Master$3f88596c-e20d-438c-a694-309eb14559b2')->where('Agency Code',$username)->get();

        Session::put('amount',@$data->Amount);

        return view('admin.pages.billing.RedioMediaBilling.create',['RO_id'=>$data,'dataline'=>$dataline]);
    }
    public function storebilling(Request $request)
    {       
            $agencycode=Session::get('UserName');
            // $where =['RO No_'=>$request->RoCode,"Agency Code"=>$agencycode];
            // $getheader =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();
            // dd($request->RO_Code);

            $wing=Session::get('WingType');
            if($wing==4) //av-tv
            {
                $type=1;
            }
            elseif($wing==5)  //av-radio
            {
                $type=0;
            }
            elseif($wing==7)  //av-producere
            {
                $type=2;
            }

            //genereate control no
            $agencycode=Session::get('UserName');
            $year=date('Y');
            
            // $table2='[BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2]';
            // $control_no=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')
            $control_no=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')
                                ->select('Control No_')
                                ->where(['RO No_'=>$request->RO_No[0],"Agency Code" =>$agencycode])
                                ->where('Control No_','<>','')
                                ->orderBy('Control No_','desc')
                                ->first();

            if(empty($control_no))
            {
                    $control_no=$agencycode.'/'.$year."/".'0001';
            }
            else
            {
                // $control_no = 'TC1234/2022/0009';                                 
                $control_no = @$control_no->{"Control No_"};
                
                $first_code=substr($control_no,0,12);
                
                $second_code=substr($control_no,12,4) + 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                $input = 1;
                $num = str_pad($second_code, 4, "0", STR_PAD_LEFT);

                $control_no=$first_code.$num;
            }
        //end generate control no

        $today = date('Y-m-d');
        $updatehead=array(
            "Vendor Bill No_"=>$request->Invoice_id,
            "Vendor Bill Date"=>$request->Invoice_date,
            "Order No_"=>$request->Order_id,
            "Bill Submitted By"=>$request->Account_rep,
            "Bill Officer Name"=>$request->billOfficerName,
            "Bill Officer Designation"=>$request->billOfficerDesign,
            "Email Id"=>$request->email,
            "Aired From Date"=>$request->from_date,
            "Aired To Date"=>$request->to_date,
            "AV Type"=>$type,
            "online Bill Submitted"=>0,
            "Control No_" => $control_no,
            "Submission Date" => $today
        );



        $where =['RO No_'=>$request->RO_Code,"Agency Code"=>$agencycode,"Line No_"=>$request->line_no];
        $header =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($updatehead);

        if($request->xls==0)
        {
            if(!empty($request->RO_No))
            {
                $data=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO No_',$request->RO_No[0])->delete();
                foreach($request->RO_No as $key => $value)
                {

                    $line_no = DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where(['Agency Code'=> Session::get('UserName'),"RO No_"=>$request->RO_No])->orderBy('Line No_', 'desc')->first();
                    if (empty($line_no)) {
                        $line_no = 10000;
                    } else {
                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }

                    $where =['RO No_'=>$request->RO_Code,"Agency Code"=>Session::get('UserName')];
                    $roLine =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();

                    $insert=array(
                        "RO No_" => $request->RO_No[$key] ?? 0,
                        "RO Line No_"=>$roLine->{'Line No_'} ?? '',
                        "Line No_" => $line_no,
                        "Agency Code" => Session::get('UserName') ?? '',
                        "Amount" => 0,
                        "Agency Name" => $roLine->{'Agency Name'} ?? '',
                        "Language" => $roLine->{'Language'} ?? '',
                        "Remarks" => '',
                        "Aired Time" => $request->time[$key] ?? 0,
                        "Aired Date" => $request->date[$key] ?? 0,
                        "Spot Duration" => $request->duration[$key] ?? 0,
                        "Description" => '',
                        "TV Channel Code" => $roLine->{'TV Channel Code'} ?? '',
                        "TV Channel Name" => $roLine->{'TV Channel Name'} ?? '',
                        "Head Quarter Code" => '' ,
                        "Head Quarter Name" => '',
                        "Telecast_Broadcast From Date" => '1753-01-01 00:00:00.000', 
                        "Telecast_Broadcast To Date" => '1753-01-01 00:00:00.000',  
                        "RO Code" => '',
                        "Station Code" => '',
                        "Station Name" =>'' ,
                        "State" => '',
                        "State Name" => '',
                        "Vendor No_" => '',
                        "Vendor GST No_" => $request->gst[$key] ?? '',
                        "Vendor Bill No_" => '' ,
                        "Vendor Bill Date" => '1753-01-01 00:00:00.000',
                        "Submission Date" => '1753-01-01 00:00:00.000', 
                        "Bill Claim Amount" => $request->bill_claim_amount[$key] ?? 0,
                        "Bill Approved Amount" => 0,
                        "Compliance DateTime(Audit)" => '1753-01-01 00:00:00.000',
                        "Billing DateTime(Audit)" => '1753-01-01 00:00:00.000', 
                        "Purchase Invoice No_" => '',
                        "Time Band"=>''
                    );
                    $data=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insert);
                }
            }
        }

        //for excel
        if($request->xls==1)
        {
            if ($request->hasfile('avtv_excel')) {
                try {
                    Excel::import(new AVTVExcelsImport, request()->file('avtv_excel')); //for import
                } catch (ValidationException $ex) {
                    // Session::flash('excel_error','Excel Upload Error');
                    dd('error');
                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
        }



        if($header)
        {
            return redirect('radio-billing/')->with('message','billing details updated successfully !');
        }
    }




    //final save
    public function finalstorebilling(Request $request)
    {       
            $agencycode=Session::get('UserName');
            $wing=Session::get('WingType');
            if($wing==4) //av-tv
            {
                $type=1;
            }
            elseif($wing==5)  //av-radio
            {
                $type=0;
            }
            elseif($wing==7)  //av-producere
            {
                $type=2;
            }

            //genereate control no
            $agencycode=Session::get('UserName');
            $year=date('Y');
            
            // $table2='[BOC$RO Bill Detail Lines$3f88596c-e20d-438c-a694-309eb14559b2]';
            // $control_no=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')
            $control_no=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')
                                ->select('Control No_')
                                ->where(['RO No_'=>$request->RO_No[0],"Agency Code" =>$agencycode])
                                ->where('Control No_','<>','')
                                ->orderBy('Control No_','desc')
                                ->first();

            if(empty($control_no))
            {
                    $control_no=$agencycode.'/'.$year."/".'0001';
            }
            else
            {
                // $control_no = 'TC1234/2022/0009';                                 
                $control_no = @$control_no->{"Control No_"};
                
                $first_code=substr($control_no,0,12);
                
                $second_code=substr($control_no,12,4) + 1;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                $input = 1;
                $num = str_pad($second_code, 4, "0", STR_PAD_LEFT);

                $control_no=$first_code.$num;
            }
        //end generate control no

        $today = date('Y-m-d');

        //check time sloat start
        $total_sloat=DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')
                                    ->where(['RO No_'=>$request->RO_No[0],"Agency Code" =>$agencycode])
                                    ->orderBy('Line No_','desc')
                                    ->first();
        $category=$total_sloat->Category;
          $count31=0;
          $count32=0;
          $count33=0;

          $count61=0;
          $count62=0;
          $count63=0;
          $count64=0;
          $count65=0;
          $count66=0;

          $ary31=[];
          $ary32=[];
          $ary33=[];

          $ary61=[];
          $ary62=[];
          $ary63=[];
          $ary64=[];
          $ary65=[];
          $ary66=[];
        if($category==1)  //0  GC
        {
           foreach($request->time as $key => $time_sloat)
           {
                $time=$request->time[$key];
                if($time >=7 && $time <=9)
                {
                    $count61=$count61+=1;
                    $ary61[]=$count61;
                    $Slot61=$total_sloat->Slot61;
                }
                elseif($time >=9 && $time <=12)
                {
                    $count62=$count62+=1;
                    $ary62[]=$count62;
                    //dd($count62);
                    $Slot62=$total_sloat->Slot62;
                }
                elseif($time >=12 && $time <=19)
                {
                  $count63=$count63+=1;
                  $ary63[]=$count63;
                  $Slot63=$total_sloat->Slot63;
                }
                elseif($time >=19 && $time <=20)
                {
                  $count64=$count64+=1;
                  $ary64[]=$count64;
                  $Slot64=$total_sloat->Slot64;
                }
                elseif($time >=20 && $time <=22)
                {
                  $count65=$count65+=1;
                  $ary65[]=$count65;
                  $Slot65=$total_sloat->Slot65;
                }
                elseif($time >=22 && $time <=23)
                {
                  $count66=$count66+=1;
                  $ary66[]=$count66;
                  $Slot66=$total_sloat->Slot66;
                }
            } 

            $sloat61=count($ary61);
            $sloat62=count($ary62);  //2
            $sloat63=count($ary63);  //2  current 1
            $sloat64=count($ary64);
            $sloat65=count($ary65);
            $sloat66=count($ary66);
            if($sloat61!=$total_sloat->Slot61)
            {
                // dd('sloat 7-9');
                Session::flash('msg','Please check sloat 7-9');
                return response()->json(["error"=>"Please check sloat 7-9"]);
            }
            elseif($sloat62!=$total_sloat->Slot62)
            {
                // dd('sloat 9-12 pm');
                Session::flash('msg','Please check sloat 9-12');
                return response()->json(["error"=>"Please check sloat 9-12"]);
            }
            elseif($sloat63!=$total_sloat->Slot63)
            {
                Session::flash('msg','Please check sloat 12-19');
                return response()->json(["error"=>"Please check sloat 12-19"]);
            }
            elseif($sloat64!=$total_sloat->Slot64)
            {
                // dd('sloat 19-20 pm');
                Session::flash('msg','Please check sloat 19-20');
                return response()->json(["error"=>"Please check sloat 19-20"]);
            }
            elseif($sloat65!=$total_sloat->Slot65)
            {
                // dd('sloat 20-22 pm');
                Session::flash('msg','Please check sloat 20-22');
                return response()->json(["error"=>"Please check sloat 20-22"]);
            }
            elseif($sloat66!=$total_sloat->Slot66)
            {
                // dd('sloat 22-23 pm');
                Session::flash('msg','Please check sloat 22-23');
                return response()->json(["error"=>"Please check sloat 22-23"]);
            }
        }

        if($category==2) //non gc
        {
           foreach($request->time as $key => $time_sloat)
           {
                $time=$request->time[$key];
                if($time >=06 && $time <=12)
                {
                    $count31=$count31+=1;
                    $ary31[]=$count31;
                    $Slot31=$total_sloat->Slot31;
                }
                elseif($time >=12 && $time <=17)
                {
                    $count32=$count32+=1;
                    $ary32[]=$count32;
                    $Slot32=$total_sloat->Slot32;
                }
                elseif($time >=17 && $time <=23)
                {
                  $count33=$count33+=1;
                  $ary33[]=$count33;
                  $Slot33=$total_sloat->Slot33;
                }
                
            } 

            $sloat31=count($ary31);
            $sloat32=count($ary32);
            $sloat33=count($ary33); 
            if($sloat31!=$total_sloat->Slot31)
            {
                Session::flash('msg','Please check sloat 6-12');
                return response()->json(["error"=>"Please check sloat 6-12"]);
            }
            elseif($sloat32!=$total_sloat->Slot32)
            {
                Session::flash('msg','Please check sloat 12-17');
                return response()->json(["error"=>"Please check sloat 12-17"]);
            }
            elseif($sloat33!=$total_sloat->Slot33)
            {
                Session::flash('msg','Please check sloat 17-23');
                return response()->json(["error"=>"Please check sloat 17-23"]);
            }
           
        }


        
        //check time sloat end


        $updatehead=array(
            "Vendor Bill No_"=>$request->Invoice_id,
            "Vendor Bill Date"=>$request->Invoice_date,
            "Order No_"=>$request->Order_id,
            "Bill Submitted By"=>$request->Account_rep,
            "Bill Officer Name"=>$request->billOfficerName,
            "Bill Officer Designation"=>$request->billOfficerDesign,
            "Email Id"=>$request->email,
            "Aired From Date"=>$request->from_date,
            "Aired To Date"=>$request->to_date,
            "AV Type"=>$type,
            "online Bill Submitted"=>1,
            "Control No_" => $control_no,
            "Submission Date" => $today
        );

        $where =['RO No_'=>$request->RO_Code,"Agency Code"=>$agencycode,"Line No_"=>$request->line_no];
        $header =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($updatehead);

        if($request->xls==0)
        {
            if(!empty($request->RO_No))
            {
                $data=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->where('RO No_',$request->RO_No[0])->delete();
                foreach($request->RO_No as $key => $value)
                {

                    $line_no = DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->select('Line No_')->where(['Agency Code'=> Session::get('UserName'),"RO No_"=>$request->RO_No])->orderBy('Line No_', 'desc')->first();
                    if (empty($line_no)) {
                        $line_no = 10000;
                    } else {
                        $line_no = $line_no->{"Line No_"};
                        $line_no = $line_no + 10000;
                    }

                    $where =['RO No_'=>$request->RO_Code,"Agency Code"=>Session::get('UserName')];
                    $roLine =DB::table('BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->first();

                    $insert=array(
                        "RO No_" => $request->RO_No[$key] ?? 0,
                        "RO Line No_"=>$roLine->{'Line No_'} ?? '',
                        "Line No_" => $line_no,
                        "Agency Code" => Session::get('UserName') ?? '',
                        "Amount" => 0,
                        "Agency Name" => $roLine->{'Agency Name'} ?? '',
                        "Language" => $roLine->{'Language'} ?? '',
                        "Remarks" => '',
                        "Aired Time" => $request->time[$key] ?? 0,
                        "Aired Date" => $request->date[$key] ?? 0,
                        "Spot Duration" => $request->duration[$key] ?? 0,
                        "Description" => '',
                        "TV Channel Code" => $roLine->{'TV Channel Code'} ?? '',
                        "TV Channel Name" => $roLine->{'TV Channel Name'} ?? '',
                        "Head Quarter Code" => '' ,
                        "Head Quarter Name" => '',
                        "Telecast_Broadcast From Date" => '1753-01-01 00:00:00.000', 
                        "Telecast_Broadcast To Date" => '1753-01-01 00:00:00.000',  
                        "RO Code" => '',
                        "Station Code" => '',
                        "Station Name" =>'' ,
                        "State" => '',
                        "State Name" => '',
                        "Vendor No_" => '',
                        "Vendor GST No_" => $request->gst[$key] ?? '',
                        "Vendor Bill No_" => '' ,
                        "Vendor Bill Date" => '1753-01-01 00:00:00.000',
                        "Submission Date" => '1753-01-01 00:00:00.000', 
                        "Bill Claim Amount" => $request->bill_claim_amount[$key] ?? 0,
                        "Bill Approved Amount" => 0,
                        "Compliance DateTime(Audit)" => '1753-01-01 00:00:00.000',
                        "Billing DateTime(Audit)" => '1753-01-01 00:00:00.000', 
                        "Purchase Invoice No_" => '',
                        "Time Band"=>''
                    );
                    $data=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insert);
                }
            }
        }

        //for excel
        if($request->xls==1)
        {
            if ($request->hasfile('avtv_excel')) {
                try {
                    Excel::import(new AVTVExcelsImport, request()->file('avtv_excel')); //for import
                } catch (ValidationException $ex) {

                    $failures = $ex->failures();
                    foreach ($failures as $failure) {
                        return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                    }
                }
            }
        }



        if($header)
        {
            return redirect('radio-billing/')->with('message','billing details updated successfully !');
        }
    }


    public function avBillingDelete(Request $request)
    {
        $agencycode=Session::get('UserName');
        $data=DB::table('BOC$AV RO Line Details$3f88596c-e20d-438c-a694-309eb14559b2')
                       ->where(['RO No_'=>$request->rono,"Agency Code" =>$agencycode,"Ro Line No_"=>$request->rolineno,"Line No_"=>$request->roline])
                       ->delete();
        return response()->json(["RO No"=>$request->rono,"Line No"=>$request->roline,"message"=>"data delete success"]); 
    }




}
