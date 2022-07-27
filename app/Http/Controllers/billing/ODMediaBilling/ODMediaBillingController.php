<?php

namespace App\Http\Controllers\billing\ODMediaBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use Session;
use App\Http\Traits\clientRequestTableTrait;
class ODMediaBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait, clientRequestTableTrait; 
    
    public function index()
    {
        $userid = Session::get('UserID');
        //$odmediaType=@$_GET['odmediaType']?? '';
        $WingType=Session::get('WingType');
        $odmediaType=$WingType;
        $agency_code = Session::get('AgencyCode');
       // dd($agency_code);
        //$agency_code = Session::get('UserName');
        if ($userid != '' || $userid != null) {
            if (Session::has('UserName')) {
                $response = array();
                DB::enableQueryLog();
                $data = DB::table($this->tblODROHeader.' as ROH')
                ->select(
                   'MPL.Client Request No_ AS CLRCode',
                    'ROH.Plan ID',
                    'PCR.Creative File Name',
                    //'PCR.Advt_ Area AS advtSize',
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
                ->leftJoin($this->tblODMediaRequestHeader.' AS PCR', 'PCR.Client Request No', '=', 'MPL.Client Request No_')
                //->where('RL.Compliance Status', 1)
                ->where('RL.Billing Status', 0)
                ->where('RL.Media Type', $odmediaType)
                ->where('RL.Agency Code', $agency_code)
                ->orderBy('RL.Line No_', 'desc');
                 /*if($odmediaType!=''){
                    $data->where('RL.Media Type', $odmediaType);
                }*/
                $response=$data->paginate(25);
                $query = DB::getQueryLog();
            }
            return view('admin.pages.billing.ODMediaBilling.index', compact('response','odmediaType'));
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
        return view('admin.pages.billing.ODMediaBilling.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resp =$this->storeBilling($request);
        $response = json_decode(json_encode($resp), true);
        if ($response['original']['success'] == false) {
            return response()->json($response['original']);
        }
        elseif ($response['original']['success'] == true) {
            return response()->json($response['original']);
        }
        
    }
    public function getnpDetail($npcode='')
    {
        return  $getData=DB::table($this->tblROLine)->select('Language','NP Name AS npname','State Name AS statename','Periodicity Name AS periodicityname','Publishing City AS publication_place','RO NO_ AS rocode')->where('NP Code',$npcode)->first();
    }
    public function getrodetail($rocode='')
    {
        $arr=explode(",",$rocode);
        $code=implode("/",$arr);
        return  $getData=DB::table($this->tblROHeader)->select('Advertisement Type AS advtype')->where('RO Code',$code)->first();
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
    public function storeBilling(Request $request){
        $vendorno=Session::get('AgencyCode');
        $currentDate=now();
        $destinationPath = public_path() . '/uploads/billing/';
        if ($request->hasFile('advtImage')) {
            $file = $request->file('advtImage');
            $advtImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $advtImage);
        } else {
            $advtImage = '';
        }
        if ($request->hasFile('agencyImage')) {
            $file = $request->file('agencyImage');
            $npImage = time() . '-' . $file->getClientOriginalName();
            $fileUploaded = $file->move($destinationPath, $npImage);
        } else {
            $npImage = '';
        }
        $arrayName=array(
            'Vendor Bill No_' => $request->billno,
              'Vendor Bill Date' =>  date('Y-m-d', strtotime($request->bill_date)),
              'Submission Date' =>  date('Y-m-d', strtotime($request->publication_date)),
              'Vendor GST No_' => $request->gstno,
              //'Billing Advertisement Type' => $request->bublishedIn,
              'Advertisement Length' => $request->advtLen,
              'Advertisement Width' => $request->advtWidth,
              'Advertisement Diff_' => $request->diff,
              'Bill Claim Amount' => $request->claimedAmount,
              'Bill Approved Amount'=>$request->claimedAmount, //$request->ap_amount,
              'Bill Officer Name' => $request->billOfficerName,
              'Bill Officer Designation' => $request->billOfficerDesign,
              'Email Id' => $request->email,
              'Bill Submitted By' => $request->SignatoryName,
              'Bill Submitted - Designation' => $request->SignatoryDesign,
              'Advertisement Img FileName'=>$advtImage,
              'Agency Img FileName'=>$npImage,
              'Image Match Percentage'=>isset($request->ImageMatchPercentage)? $request->ImageMatchPercentage:0 ,
              'Billing Status'=>1,
              'Billing DateTime(Audit)'=>$currentDate,
              'Vendor No_'=>$vendorno
        );
        //dd($request->all());
         DB::unprepared('SET ANSI_WARNINGS OFF');

        $sql = DB::table($this->tblODROLine)
        ->where('Agency Code', Session::get('AgencyCode'))
        ->where('RO NO_', $request->rocode)
        ->update($arrayName);

        DB::unprepared('SET ANSI_WARNINGS ON');
        if ($sql) {
            return $this->sendResponse('', 'Data Successfully saved');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
}
