<?php

namespace App\Http\Controllers\dailycompliance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequestTableTrait;
use Session;
use App\Http\Controllers\Api\dailycompliance\DailyComplianceController as api;

class DailyComplianceController extends Controller
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
        $np_code = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            $response = array();
            if (Session::has('UserName')) {
                $response = $this->getDailyComplianceData($np_code);
            }
            return view('admin.pages.dailycompliance.index', compact('response'));
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
        $npcode = session('UserName');
        $rocodedata = DB::table($this->tblROHeader.' as ROH')->select('RL.RO NO_ AS rocode')
        ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->where('RL.NP Code', $npcode)
            ->where('PCR.Creative Availability',0)
             // ->where('ROH.Status', '<>', 4)
             ->where('ROH.Status',3)
            ->where('RL.Compliance Status', 0)->get();
        return view('admin.pages.dailycompliance.create', compact('rocodedata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = (new api)->storeCompliance($request);
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
    public function getnpDetail($rocode = '')
    {
         $npcode = session('UserName');
         $arr = explode(",", $rocode);
        $code = implode("/", $arr);
        return  $getData = DB::table($this->tblROHeader.' AS ROH' )->select('RL.Language', 'RL.NP Name AS npname', 'RL.State Name AS statename', 'RL.Periodicity Name AS periodicityname', 'RL.Publishing City AS publication_place', 'RL.RO NO_ AS rocode','RL.Publishing Date AS PublishingDate','ROH.Tentative Publishing Date AS compliacePublishedDate')
        ->leftJoin($this->tblROLine.' AS RL','ROH.RO Code','=','RL.RO No_')
        ->where('RL.RO No_', $code)->where('RL.NP Code', $npcode)
        ->where('ROH.Status',3)
        ->first();
    }
    public function getrodetail($rocode = '')
    {   
        $arr = explode(",", $rocode);
        $code = implode("/", $arr);
        return  $getData = DB::table($this->tblROHeader)->select('Advertisement Type AS advtype')->where('RO Code', $code)->first();
    }

    public function getDailyComplianceData($np_code)
    {
        DB::enableQueryLog();
        $response = DB::table($this->tblROHeader.' as ROH')
            ->select(
                DB::raw("(CASE
                WHEN ROH.Status = 0 THEN 'Open'
                WHEN ROH.Status = 1 THEN 'Approved'
                WHEN ROH.Status = 2 THEN 'end to Vendor'
                WHEN ROH.Status = 3 THEN 'PDF Created'
                WHEN ROH.Status = 4 THEN 'Rolled Back'
                ELSE 'NA'
                END) AS StatusLable"),
                'MPL.Client Request Code AS CLRCode',
                'ROH.Plan ID',
                //'ROH.Status',
                'PCR.Crative File Name',
                'PCR.Size of Advt_ AS advtSize',
                'RL.RO No_',
                'RL.NP Code',
                'RL.Amount',
                'RL.Periodicity Name',
                'RL.Language',
                'RL.Publishing City',
                'RL.NP Name',
                'RL.State Name',
                'RL.Publishing Date',
                'RL.Page No_',
                'RL.Compliance Status',
                'RL.Remarks',
                'RL.Amount',
                'RL.Billing Status',
                'RL.Control No_ AS ReferenceNo',
                'MPL.Version AS planVersion',
                'RL.Token ID',
                'RL.Token Date',
                'ROH.Tentative Publishing Date AS TentativePublishingDate',
            )
            ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->where('RL.Compliance Status', 1)
            ->where('RL.Billing Status', 0)
            ->where('RL.NP Code', $np_code)
            // ->where('ROH.Status', '<>', 4)
            ->where('ROH.Status', 3)
            ->where('PCR.Creative Availability',0)
            ->orderBy('RL.Line No_', 'desc')
            // ->paginate(25);
            ->get();
        $query = DB::getQueryLog();
        return $response;
    }

    public function dailyCompliancePrintPDF($np_code)
    {
        $response = $this->getDailyComplianceData($np_code);
        $pdf = \PDF::loadView('admin.pages.dailycompliance.print-pdf', compact('response'));
        return $pdf->download($np_code . '.pdf');
    }
     public function getrodata(Request $request)
    {
      return $response = DB::table($this->tblROHeader . ' as ROH')
        ->select('PCR.Publication From Date AS publication_from_date', 'PCR.Publication  To Date AS publication_to_date','RL.Page No_ AS page_no','RL.Remarks AS Remarks')
        ->leftJoin($this->tblROLine . ' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
        ->leftJoin($this->tblPrintMediaPlan . ' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
        ->leftJoin($this->tblPrintClientRequest . ' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
        ->where(['RL.NP Code' => $request->npcode, 'RL.RO NO_' => $request->rocode, 'RL.Compliance Status' => 0])
        // ->where('ROH.Status', '<>', 4)
        ->where('ROH.Status',3)
        ->first();
    }
}
