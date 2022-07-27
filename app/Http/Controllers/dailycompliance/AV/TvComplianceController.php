<?php

namespace App\Http\Controllers\dailycompliance\AV;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequestTableTrait;
use App\Http\Controllers\Api\ApiFreshEmpanelmentController as api;
use App\Http\Controllers\Api\dailycompliance\DailyComplianceController as APis;

class TvComplianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait,clientRequestTableTrait;
    public function index(Request $request)
    {
        $userid = Session::get('UserID');
        //dd($userid);
        $complianceType = $request->complianceType ?? 1;
        $agency_code = Session::get('UserName');
        $response = array();
       //dd($complianceType);
        if ($userid != '' || $userid != null) {
            if (Session::has('UserName')) {
                DB::enableQueryLog();
                $response = DB::table($this->tblAVROHeader.' as ROH')
                ->select(
                    'ROH.RO Code',
                    'ROH.Agency Code',
                    'ROH.Agency Name',
                    'lan.Name',
                    'st.Description',
                    'ROH.Head Quarter Name',
                    'ROH.Telecast_Broadcast From Date',
                    'ROH.Telecast_Broadcast To Date',
                    'ROH.Remarks',
                    'ROH.AV Type',
                    'ROH.Billing Status'
                )
                ->leftJoin($this->tblLanguage.' as lan', 'lan.Code', '=', 'ROH.Language')
                ->leftJoin($this->tblState.' as st', 'st.Code', '=', 'ROH.State')
                ->where('ROH.AV Type', $complianceType)
                ->orderBy('ROH.Telecast_Broadcast From Date', 'desc')
                ->get();
                //  $response=$data->paginate(25);
                $query = DB::getQueryLog();
            }
           //dd($response);
            return view('admin.pages.dailycompliance.avcompliance.tvcompliance.index', compact('response'));
        } else {
            return Redirect('vendor-login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $state_array = (new api)->getStates();
        $statess = json_decode(json_encode($state_array),true);
        $states =$statess['original']['data'];
        //dd($states);
        $state_code = "";
        $lang = (new api)->getLanguages();
        $languag1 = json_decode(json_encode($lang),true);
        $languag=$languag1['original']['data'];
        //dd($languag);
        //$this->gettvChannelDetail(session('UserName'));
        //$userid = Session::get('UserID');
        //dd($userid);
        $agency_code=DB::table($this->tblAVVendor)->select('Agency Code as agency_code','Name')
            ->where(['User ID'=> session('UserID'),'Agency Type'=>1])
            ->get();
        //dd($agency_code);
        return view('admin.pages.dailycompliance.avcompliance.tvcompliance.create',compact('agency_code','states','languag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function gettvChannelDetail($agencycode = '')
    {
        // return  $getData = DB::table('BOC$AV RO Line')->select('Language', 'Agency Name AS agencyname', 'State Name AS statename',  'Publishing City AS publication_place', 'RO NO_ AS rocode')->where('Agency Code', $agencycode)->first();

        // $data_comp_avtv = DB::table('BOC$AV RO Header as ROH')
        // ->select(
        //     'TV Channel Code AS tv_channel_code',
        //     'TV Channel Name AS tv_channel_name',
        //     'Language',
        //     'Head Ouarter Name AS head_quarter_name',
        //     'State Name AS statename',
        //     'RO Code AS ro_code',
        //     'Telecast_Broadcast From Date AS telecaste_broadcast_from_date',
        //     'Telecast_Broadcast To Date AS telecaste_broadcast_to_date',
        //     'Remarks'
        // )
        // ->leftJoin('BOC$Language as language')
        // ->where('Agency Code', $agencycode)
        // ->first();
        // dd($data_comp_avtv);
    }

    public function getrodetail($rocode = '')
    {
        $arr = explode(",", $rocode);
        $code = implode("/", $arr);
        return  $getData = DB::table($this->tblODROHeader)->select('Advertisement Type AS advtype')->where('RO Code', $code)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        $arrayName = array(
            'Agency Name' => $request->channel_name,
            'Language' => $request->language,
            'State' => $request->state,
            'Head Quarter Name' => $request->head_quater,
            'Telecast_Broadcast From Date'=>$request->startpublished_from_date,
            'Telecast_Broadcast To Date'=>$request->startpublished_to_date,
            'Remarks' => $request->remark
        );
        $where = array('RO Code'=> $request->rocode,'Agency Code' => $request->agencyCode,'AV Type' => $request->compliance_type);
        $sql = DB::table($this->tblAVROHeader)
        ->where($where)
        ->update($arrayName);
        //dd($sql);
        if($sql){
            return response()->json(['status' => true, 'message' => 'Data updated successfully!']);
        }else{
            return response()->json(['status' => false, 'message' => 'Some error occured!']);
        }
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

    /* Get Ro List for av tv compliance */
    public function getrolist($angcode){
        $ro_list = DB::table($this->tblAVROHeader)
        ->select('RO Code as ro_code')
        ->where('Agency Code',$angcode)
        ->get();
        //dd($ro_list);
        if(!empty($ro_list)){
        $ro_data = "<option value=''>Select</option>";
        foreach ($ro_list as $rodata) {
            $ro_data .= "<option value='" . $rodata->ro_code . "'>" . $rodata->ro_code . "</option>";
          }
            return response()->json(['status' => 1,'ro_data' => $ro_data]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    /* Get TV Channel List */
    public function gettvchannellist($compliacetype){
        //dd($compliacetype[0]);
        $tvchannellist=DB::table($this->tblAVVendor)->select('Agency Code as agency_code','Name')
        ->where(['User ID'=> session('UserID'),'Agency Type'=>$compliacetype])
        ->get();
        if(!empty($tvchannellist)){
        $tvchannel_data = "<option value=''>Select</option>";
        foreach ($tvchannellist as $value) {
            $tvchannel_data .= "<option value='" . $value->agency_code . "' data-id='".$value->Name ."'>" . $value->agency_code . "</option>";
          }
            return response()->json(['status' => 1,'tvchannel_data' => $tvchannel_data]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No data found']);
        }
    }

    public function tvcompliancePdf($complianceType) {
        $userid = Session::get('UserID');
        $tvcompliancePdf = DB::table($this->tblAVROHeader.' as ROH')
        ->select(
            'ROH.RO Code',
            'ROH.Agency Code',
            'ROH.Agency Name',
            'lan.Name',
            'st.Description',
            'ROH.Head Quarter Name',
            'ROH.Telecast_Broadcast From Date',
            'ROH.Telecast_Broadcast To Date',
            'ROH.Remarks',
            'ROH.AV Type',
            'ROH.Billing Status'
        )
        ->leftJoin($this->tblLanguage.' as lan', 'lan.Code', '=', 'ROH.Language')
        ->leftJoin($this->tblState.' as st', 'st.Code', '=', 'ROH.State')
        ->where('ROH.AV Type', $complianceType)
        ->orderBy('ROH.Telecast_Broadcast From Date', 'desc')
        ->get();
        $pdf = \PDF::loadView('admin.pages.dailycompliance.avcompliance.tvcompliance.tvcompliancepdf', compact('tvcompliancePdf'));
        return $pdf->download($userid . '.pdf');
    }
}
