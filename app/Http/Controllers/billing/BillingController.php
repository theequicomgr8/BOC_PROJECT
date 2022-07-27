<?php

namespace App\Http\Controllers\billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use Session;
use App\Http\Traits\clientRequestTableTrait;
use App\Http\Controllers\Api\billing\BillingController as api;

class BillingController extends Controller
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
                $response = $this->getBillingData($np_code);
            }
            return view('admin.pages.billing.index', compact('response'));
        } else {
            return Redirect('vendor-login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $npcodeData = DB::table($this->tblROLine)->select('NP Code AS npcode', 'NP Name AS npname', 'Publishing Date AS publishing_date','Vendor GST No_ AS gst_no','Billing Advertisement Type AS billing_type','Page No_ AS page_no','Advertisement Length AS length','Advertisement Width AS width','Advertisement Diff_ AS diff','Bill Claim Amount AS claimed_amount','Bill Officer Name AS bill_officer_name','Bill Officer Designation AS bill_officer_designation','Email Id AS email','Bill Submitted By AS bill_submitted_by','Bill Submitted - Designation AS bill_submitted_designation')
        ->where('NP Code', $request->NPCode)
        ->where('RO NO_', $request->ROCode)
        ->orderBy('Line No_', 'DESC')->get();
        return view('admin.pages.billing.create', compact('npcodeData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp = (new api)->storeBilling($request);
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
    public function getnpDetail($npcode = '')
    {
        return  $getData = DB::table($this->tblROLine)->select('Language', 'NP Name AS npname', 'State Name AS statename', 'Periodicity Name AS periodicityname', 'Publishing City AS publication_place', 'RO NO_ AS rocode')->where('NP Code', $npcode)->first();
    }
    public function getrodetail($rocode = '')
    {
        $arr = explode(",", $rocode);
        $code = implode("/", $arr);
        return  $getData = DB::table($this->tblROHeader)->select('Advertisement Type AS advtype')->where('RO Code', $code)->first();
    }
    public function getBillingData($np_code)
    {
        DB::enableQueryLog();
        $response = DB::table($this->tblROHeader.' as ROH')
            ->select(
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
                DB::raw("(CASE
                WHEN ROH.Status = 0 THEN 'Open'
                WHEN ROH.Status = 1 THEN 'Approved'
                WHEN ROH.Status = 2 THEN 'end to Vendor'
                WHEN ROH.Status = 3 THEN 'PDF Created'
                WHEN ROH.Status = 4 THEN 'Rolled Back'
                ELSE 'NA'
                END) AS StatusLable")
            )
            ->leftJoin($this->tblROLine.' as RL', 'RL.RO No_', '=', 'ROH.RO Code')
            ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
            ->where('RL.Compliance Status', 1)
            ->where('RL.Billing Status', 1)
            ->where('RL.NP Code', $np_code)
            //->where('ROH.Status', '<>', 4)
            ->where('ROH.Status',3)
            ->orderBy('RL.Line No_', 'desc')
            ->get();
        $query = DB::getQueryLog();
        return $response;
        //dd($response);
    }

    public function billingPrintPDF($np_code)
    {
        $response = $this->getBillingData($np_code);
        $pdf = \PDF::loadView('admin.pages.billing.print-pdf', compact('response'));
        return $pdf->download($np_code . '.pdf');
    }
    /* Billing View start Priyanshi */
    public function billingView(Request $request) {
        $response = $this->billingData($request['NPCode'],$request['ROCode'],$request['BillingStatus']);
        //dd($response);
        return view('admin.pages.billing.billing_view', compact('response'));
    }
    public function billingPDF(Request $request)
    {
        $ratetbl='BOC$Rate & Circulation$3f88596c-e20d-438c-a694-309eb14559b2';
        $ROdata = DB::table($this->tblROHeader.' as ROH')
        ->select(
            'ROH.RO Code AS RoCode',
            'ROH.Plan ID AS PlanId',
            'ROH.Client ID AS ClientId',
            'ROH.RO Date AS PublishDate',
            'RL.NP Code AS npcode',
            'RL.Line No_ As lineno',
            'RL.Pdf File Name As Pdf File Name',
            'MPL.Client Request Code AS CLRCode',
            'PCR.Crative File Name',
            'ROH.Plan Version AS planVersion',
            'PCR.Advertisement Type',
            'PCR.Size Of Advt_',
            'RL.Billing Advertisement Type',
            'PCR.Publication From Date AS PublicationFromDate',
            'PCR.Publication  To Date AS PublicationToDate',
            'RL.Amount AS ROAmount',
            'rt.CRate'
        )
        ->Join($this->tblROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
        ->leftJoin($this->tblPrintMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
        ->leftJoin($this->tblPrintClientRequest.' AS PCR', 'PCR.Client Request No_', '=', 'MPL.Client Request Code')
        ->leftJoin($ratetbl.' AS rt', 'rt.NP Code', '=', 'RL.NP Code')

        //->orderBy('RL.Line No_', 'DESC')
        ->orderBy('ROH.RO Date','DESC')->distinct('ROH.RO Code')
        //->where('ROH.Status','<>',4)
        ->where('ROH.Status',3)
        //->groupBy('MPL.Version')
        ->Where('RL.NP Code', $request['NPCode'])
        ->Where('RL.RO No_', $request['ROCode'])
        ->first();
        //dd($ROdata);
        $response = $this->billingData($request['NPCode'],$request['ROCode'],$request['BillingStatus']);
        $pdf = \PDF::loadView('admin.pages.billing.billing-pdf', compact('response','ROdata'));
        return $pdf->download($request['NPCode'] . '.pdf');
    }
    public function billingData($NPCode,$ROCode,$BillingStatus) {
        // dd($NPCode,$ROCode);
        $response = DB::table($this->tblROLine)
                    ->where('Billing Status', $BillingStatus)
                    ->where('NP Code', $NPCode)
                    ->where('RO No_', $ROCode)
                    ->first();
        //dd($response);
        return $response;
    }
    public function submittedBilltokenLength($date = '')
    {
         $dt=date('Y-m-d',strtotime($date));
        $getData = DB::table($this->tblROLine)->select('Token ID AS TokenID')->where('Token Date', $dt)->count('Token ID');
        return response()->json(['tokenLength'=>$getData]);
    }
}
