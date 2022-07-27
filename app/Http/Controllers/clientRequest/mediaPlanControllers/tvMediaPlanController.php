<?php

namespace App\Http\Controllers\ClientRequest\mediaPlanControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\clientRequestTableTrait;

class tvMediaPlanController extends Controller
{
    use CommonTrait, clientRequestTableTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $table1;
    private $user_id;
    public function __construct()
    {
         $this->table1 = 'User';
         $this->user_id = Session::get('UserID');
    }
    
    public function index(Request $request)
    {
        // return $this->user_id;
        // return $this->table1;
        // return Session::get('UserID');
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $response=array();
        // $odmediaType=$request->odmediaType;
        if ($userid != '' || $userid != null) {
            $data = DB::table($this->tblAVMediaPlan.' as AVMP')
                ->select(
                    'AVMP.MP No_',
                    'AVMP.Client Request Code',//Client Request Code
                    // 'AVMP.Client Name',
                    'AVMP.Target Area',
                    'AVMP.Approval Status', //Approval Status
                    'AVMP.Status',
                    //'AVMP.OD Media Type AS ODMediaType', //x
                )
                ->where('AVMP.Ministry Head', $UserName)
                // ->where('AVMP.Send To Client', 1) //x
                ->orderBy('AVMP.MP No_', 'DESC');
                // if($request->has('odmediaType')){
                //     $data->where('AVMP.OD Media Type', $odmediaType);
                // }
                 $response = $data->paginate(25);
            return view('admin.pages.client-request.mediaPlan.avMediaPlan.tv.index', compact('response'));
            // return view('admin.pages.client-request.mediaPlan.avMediaPlan.tv.index', compact('response','odmediaType'));
        } else {
            return Redirect('client-login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = $this->saveODMPlanComment($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == false) {
            return response()->json($response['original']);
        } elseif ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mpNo)
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName');
        $mpdetails = '';
        $npLists = '';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblAVMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                 //ministry data get
            if(!empty($mpdetails)){
                $MinistryData=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')
                ->select("Ministry Name AS MinistryName")
                ->where('Ministry Code', $mpdetails->{'Ministry'})->first();
                if($MinistryData!=''){
                    $MinistryName=$MinistryData->MinistryName;
                }//end ministry
            }
             $npActualAmt1 = DB::table($this->tblChannelSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt=number_format($npActualAmt1);
            //selected newspaper detail
            $npLists = DB::table($this->tblChannelSelect)
                ->select("*")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->paginate(25);
            //dd($npLists);
            //for language
            $lang=[];
            if(!empty(@$mpdetails)){
                $lang=DB::table($this->tblLanguageSelection)->select('Client Request No_','Language Name as language')->where('Client Request No_',$mpdetails->{'Client Request Code'})->get();
            }
            // dd($lang[0]->language);
            $lan=array();
            foreach($lang as $langs)
            {
                $lan[]=$langs->language;
            }
            // dd($lan);
            $languages=implode(",", $lan);
            
            return view('admin.pages.client-request.mediaPlan.avMediaPlan.tv.viewPlan', compact('mpdetails', 'npLists','languages','npActualAmt','MinistryName'));
        } else {
            return Redirect('client-login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
   
     public function saveODMPlanComment(Request $request)
    {
        // dd("demo");
        if ($request->Consent != '') {
            $Consent = $request->Consent;
            $remark = isset($request->Comment) ? $request->Comment : '';
            $mpno = $request->mpno;
            $clApprovalReceived=1;
            
            if ($Consent==1 && $remark!='') {
                $sentTOClient=0;
            } else {
                $sentTOClient=1;
            }
            // $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark, 'Cl Approval Received' => $clApprovalReceived, 'Send TO Client'=>$sentTOClient);
            $update = array('Client Consent' => $Consent, 'Client Remarks' => $remark,'Cl Approval Received' => $clApprovalReceived,'Send To Client'=>$sentTOClient);
            DB::unprepared('SET ANSI_WARNINGS OFF');
            $pmptable = $this->tblAVMediaPlan;
            $where = array('MP No_' => $mpno);
            $sql = $this->updateAllRecords($pmptable, $update, $where);
            $msg = 'Forwarded to boc for approval!';
            DB::unprepared('SET ANSI_WARNINGS ON');
            if ($sql) {
                return $this->sendResponse('', $msg);
            } else {
                return $this->sendError('Some Error Occurred!.');
                exit;
            }
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
     public function tvMediaPlanpdf($mpNo)
    {
        $userid = Session::get('UserID');
        $UserName = Session::get('UserName') != '' ? Session::get('UserName') : '';
        $mpdetails = '';
        $npLists = '';
        $MinistryName = '';
        if (($userid != '' || $userid != null) && $mpNo != '') {
            //media plan  detail
            $mpdetails = DB::table($this->tblAVMediaPlan)
                ->select("*")
                ->orderBy('MP No_', 'DESC')
                ->where('Ministry Head', $UserName)
                ->where('MP No_', $mpNo)->first();
                 //ministry data get
            if(!empty($mpdetails)){
                $MinistryData=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')
                ->select("Ministry Name AS MinistryName")
                ->where('Ministry Code', $mpdetails->{'Ministry'})->first();
                if(!empty($MinistryData)){
                    $MinistryName=$MinistryData->MinistryName;
                }//end ministry
            }
             $npActualAmt1 = DB::table($this->tblChannelSelect)
                ->select("Amount")
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->sum('Amount');
            //dd(number_format($npActualAmt,2));
            $npActualAmt= $npActualAmt1 !='' ? number_format($npActualAmt1) : '';
            //selected newspaper detail
            $npLists = DB::table($this->tblChannelSelect)
                ->select('*')
                ->orderBy('Line No_', 'DESC')
                ->where('Document No_', $mpNo)->get();
            //for language
            $lang=[];
            if(!empty(@$mpdetails)){
                $lang=DB::table($this->tblLanguageSelection)->select('Client Request No_','Language Name as language')->where('Client Request No_',$mpdetails->{'Client Request Code'})->get();
            }
            // dd($lang[0]->language);
            $lan=array();
            foreach($lang as $langs)
            {
                $lan[]=$langs->language;
            }
            // dd($lan);
            $languages=implode(",", $lan);
            // dd($mpdetails);
           
           $pdf = \PDF::loadView('admin.pages.client-request.mediaPlan.avMediaPlan.tv.tvMediaPlanpdf',['mpdetails'=>$mpdetails, 'npLists'=>$npLists,'languages'=>$languages,'npActualAmt'=>$npActualAmt,'MinistryName'=>$MinistryName]);
           return $pdf->download($mpNo . '.pdf');
        }
    }
}
