<?php

namespace App\Http\Controllers\RO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequestTableTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

class ROController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait,clientRequestTableTrait;
    public function index(Request $request)
    {
        
        return $this->roList($request);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return $this->viewRO($npcode = '', $lineno = '', $PlanId = '', $ClientId = '');
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
    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function roList(Request $request)
    {

        $userid = Session::get('UserID');
        $response = [];
        if ( $userid!='') {
            //$odmImpanelData=DB::table('BOC$Vendor Emp - OD Media')->select('*')->where('User ID',$userid)->first();
            $UserType=Session::get('UserType');
            $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime(strtr($request->from_date, '/', '-'))) : '';
            $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime(strtr($request->to_date, '/', '-'))) : '';

           // $odmediaType = isset($request->odmediaType) ? $request->odmediaType : '';
            $WingType=Session::get('WingType');
            $odmediaType=$WingType;
            $agency_code = Session::get('AgencyCode');
            DB::enableQueryLog();
            $data = DB::table($this->tblODROHeader.' as ROH')
            ->select(
                'ROH.RO Code AS RoCode',
                'ROH.Plan ID AS PlanId',
                'ROH.Client ID AS ClientId',
                'ROH.RO Date AS PublishDate',
                'RL.Agency Code AS agencyCode',
                'RL.Line No_ As lineno',
                'RL.Pdf File Name As Pdf File Name',
                'MPL.Client Request No_ AS CLRCode',
                'ODMR.Creative File Name',
                'RL.Media Type AS ODMediaType'
            )
            ->Join($this->tblODROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
            ->leftJoin($this->tblODMediaPlanHeader.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->leftJoin($this->tblODMediaRequestHeader.' AS ODMR', 'ODMR.Client Request No', '=', 'MPL.Client Request No_')
            ->orderBy('RL.Line No_', 'DESC')
             ->where('RL.Media Type', $odmediaType)
            ->Where('RL.Agency Code', Session::get('AgencyCode'));

            if (($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != '') {
                $data->whereDate('ROH.RO Date', '>=', $from_date)->whereDate('ROH.RO Date', '<=', $to_date);
            }
            /*if($request->has('odmediaType')){
                $data->where('RL.Media Type', $odmediaType);
            }*/
            $response = $data->paginate(25);
            $query = DB::getQueryLog();
            return view('admin.pages.release-order.ODMediaRO.index', compact('response','odmediaType','from_date','to_date'));
        } else {
            return Redirect('vendor-login');
        }
    }
    public function viewRO($npcode = '', $lineno = '', $PlanId = '', $ClientId = '')
    {

        $np_code = decrypt($npcode);
        $line_no = decrypt($lineno);
        $Plan_Id = decrypt($PlanId);
        $Client_Id = decrypt($ClientId);
        $userid = Session::get('UserID');

        if ($userid != '' || $userid != null) {
            $response = array();
            DB::enableQueryLog();
            $response = DB::table($this->tblODROHeader.' as ROH')
            ->select(
                'ROH.*',
                'MPL.*'
            )
                //->leftJoin('BOC$RO Line as RL', 'RL.NP Code','=','')
            ->leftJoin($this->tblODMediaPlanHeader.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
            ->where('ROH.Plan ID', $Plan_Id)
            ->first();
            $query = DB::getQueryLog();
            //dd($query);
            
            return view('admin.pages.release-order.view', compact('response'));
        } else {
            return Redirect('vendor-login');
        }
    }
}
