<?php

namespace App\Http\Controllers\dailycompliance\ODMediaCompliance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequestTableTrait;
use Session;
use App\Http\Controllers\Api\dailycompliance\DailyComplianceController as api;

class ODMediaComplianceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait,clientRequestTableTrait;
    public function index()
    {
        $userid = Session::get('UserID');
        $WingType=Session::get('WingType');
        $odmediaType=$WingType;
        $agency_code = Session::get('AgencyCode');
        if ($userid != '' || $userid != null) {
            if (Session::has('UserName')) {
                $response = array();
                DB::enableQueryLog();
                $data = DB::table($this->tblODROHeader.' as ROH')
                ->select(
                    'MPL.Client Request No_ AS CLRCode',
                    'ROH.Plan ID',
                    'PCR.Creative File Name',
                    'PCR.Advt_ Area AS advtSize',
                    'RL.RO No_',
                    'RL.Agency Code',
                    'RL.Amount',
                    'RL.Language',
                    'RL.Publishing City',
                    'RL.Agency Name',
                    'RL.State Name',
                    'RL.Publishing Start Date',
                    'RL.Compliance Status',
                    'RL.Remarks',
                    'RL.Amount',
                    'RL.Billing Status',
                    'RL.Vendor Bill No_ AS ReferenceNo',
                    'RL.Media Type AS ODMediaType'
                )
                ->leftJoin($this->tblODMediaPlanHeader.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                ->leftJoin($this->tblODROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
                ->leftJoin($this->tblODMediaRequest.' AS PCR', 'PCR.Client Request No', '=', 'MPL.Client Request No_')
                ->where('RL.Compliance Status', 1)
                ->where('RL.Billing Status', 0)
                ->where('RL.Media Type', $odmediaType)
                ->where('RL.Agency Code', $agency_code)
                ->orderBy('RL.Line No_', 'desc');
                /*if($odmediaType){
                    $data->where('RL.Media Type', $odmediaType);
                }*/
                $response=$data->paginate(25);
                $query = DB::getQueryLog();;
            }
            return view('admin.pages.dailycompliance.ODMediaCompliance.index', compact('response','odmediaType'));
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
        $rocodedata=DB::table($this->tblODROLine)->select('RO NO_ AS rocode')
            ->where('Agency Code',session('AgencyCode'))
            ->where('Compliance Status',0)->get();

        return view('admin.pages.dailycompliance.ODMediaCompliance.create',compact('rocodedata'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = $this->storeCompliance($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == false) {
            return response()->json($response['original']);
        } elseif ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
    }
    public function getSelectedAgencyDetail($agencycode = '')
    {
        return  $getData = DB::table($this->tblODROLine)->select('Language', 'Agency Name AS agencyname', 'State Name AS statename',  'Publishing City AS publication_place', 'RO NO_ AS rocode')->where('Agency Code', $agencycode)->first();
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
    public function storeCompliance(Request $request){
        $currentDate=now();
        $destinationPath = public_path() . '/uploads/dailycompliance/';
        if ($request->hasFile('print_upload_creative_fileName')) {
            $file = $request->file('print_upload_creative_fileName');
            $print_upload_creative_fileName = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $print_upload_creative_fileName);
        } else {
            $print_upload_creative_fileName = '';
        }

        $date1 = date('Y-m-d', strtotime($request->startpublished_date));
        $date2 = date('Y-m-d', strtotime($currentDate));
        $seconds = strtotime($date2) - strtotime($date1);
        $hours = $seconds / 60 / 60;
        if($hours>24){
            $msg='You have submitted your compliance after 24hrs of Publish date';

        }else{
            $msg='Data Successfully saved';
        }
        $arrayName = array(
            'Publishing Start Date' =>date('Y-m-d', strtotime($request->startpublished_date)),
            'Remarks' =>isset($request->remark)?$request->remark:'',
            'File Name'=>$print_upload_creative_fileName,
            'Compliance Status'=>1,
            'Compliance DateTime(Audit)'=>$currentDate
        );
        $sql = DB::table($this->tblODROLine)
        ->where('Agency Code', $request->agencyCode)
        ->where('RO NO_', $request->rocode)
        ->update($arrayName);
        if ($sql) {

            return $this->sendResponse('', $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
}
