<?php

namespace App\Http\Controllers;
use App\Http\Traits\CommonTrait;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Traits\clientRequestTableTrait;
use PDF;

class AVROController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use CommonTrait, clientRequestTableTrait;
    public function avRoList(Request $request)
    {
        # code...
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            $response = [];
            $WingType=Session::get('WingType');
            if($WingType == '4')
            {
                $avType = '0';
            }
            elseif($WingType == '5')
            {
                $avType = '1';
            }
            elseif($WingType == '7')
            {
                $avType = '3';
            }

            if (Session::has('UserName') && Session('UserName') != '') {
                $UserType=Session::get('UserType');
                $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime($request->from_date)) : '';
                $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime($request->to_date)) : '';
                $agency_code = isset($request->agency_code) ? $request->agency_code : Session::get('UserName');
                // $agency_code = Session::get('UserName');
                $data = DB::table($this->tblAVROHeader.' as ROH')
                            ->select(
                                'ROH.RO Code AS RoCode',
                                'ROH.Plan ID AS PlanId',
                                'ROH.Client ID AS ClientId',
                                'ROH.RO Date AS PublishDate',
                                'RL.Agency Code AS agencyCode',
                                'RL.Line No_ As lineno',
                                'RL.Pdf File Name As Pdf File Name',
                                'RL.AV Type AS avType',
                                'MPL.Client Request Code AS CLRCode',
                                'AVMedia.Creative File Name'
                            )
                            ->Join($this->tblAVROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                            ->leftJoin($this->tblAVMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                            ->leftJoin($this->tblAVMedia.' AS AVMedia', 'AVMedia.Client Request No', '=', 'MPL.Client Request Code')
                            ->orderBy('RL.Line No_', 'DESC')
                            // ->where('RL.AV Type', '0')
                            ->where('ROH.AV Type', $avType)
                            ->where('RL.Agency Code', $agency_code);
                            //dd($data);

                if (($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != '') {
                    $data->whereDate('ROH.RO Date', '>=', $from_date)->whereDate('ROH.RO Date', '<=', $to_date);
                }
                $response = $data->paginate(25);
            }
            return view('admin.pages.release-order.AV.rolist', compact('response','avType'));
        }
        else {
            return Redirect('vendor-login');
        }

    }

    public function index(Request $request)
    {
        # code...
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            $response = [];
            $WingType=Session::get('WingType');
            if($WingType == '4')
            {
                $avType = '0';
            }
            elseif($WingType == '5')
            {
                $avType = '1';
            }
            elseif($WingType == '7')
            {
                $avType = '3';
            }
            $UserType=Session::get('UserType');
            $from_date = isset($request->from_date)  ? date('Y-m-d', strtotime($request->from_date)) : '';
            $to_date = isset($request->to_date)  ? date('Y-m-d', strtotime($request->to_date)) : '';

            $agency_code = isset($request->agency_code) ? $request->agency_code : Session::get('UserName');
            // $agency_code = Session::get('UserName');
            $data = DB::table($this->tblAVROHeader.' as ROH')
                        ->select(
                            'ROH.RO Code AS RoCode',
                            'ROH.Plan ID AS PlanId',
                            'ROH.Client ID AS ClientId',
                            'ROH.RO Date AS PublishDate',
                            'RL.Agency Code AS agencyCode',
                            'RL.Line No_ As lineno',
                            'RL.Pdf File Name As Pdf File Name',
                            'RL.AV Type AS avType',
                            'MPL.Client Request Code AS CLRCode',
                            'AVMedia.Creative File Name'
                        )
                        ->Join($this->tblAVROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                        ->leftJoin($this->tblAVMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                        ->leftJoin($this->tblAVMedia.' AS AVMedia', 'AVMedia.Client Request No', '=', 'MPL.Client Request Code')
                        ->orderBy('RL.Line No_', 'DESC')
                        // ->where('RL.AV Type', '0')
                        ->where('ROH.AV Type', $avType)
                        ->where('RL.Agency Code', $agency_code);

            if (($request->has('from_date')  && $request->has('to_date')) && $from_date != '' && $to_date != '') {
                $data->whereDate('ROH.RO Date', '>=', $from_date)->whereDate('ROH.RO Date', '<=', $to_date);

            $response = $data->paginate(25);
        }
        return view('admin.pages.release-order.AV.rolist', compact('response','avType'));
        }
    }

    public function AvRoPDF($agency_code='')
    {
        $userid = Session::get('UserID');
        if ($userid != '' || $userid != null) {
            $response = [];
            $WingType=Session::get('WingType');
            if($WingType == '4')
            {
                $avType = '0';
            }
            elseif($WingType == '5')
            {
                $avType = '1';
            }
            elseif($WingType == '7')
            {
                $avType = '3';
            }

            if (Session::has('UserName') && Session('UserName') != '') {
                $avRodata = DB::table($this->tblAVROHeader.' as ROH')
                ->select(
                    'ROH.RO Code AS RoCode',
                    'ROH.Plan ID AS PlanId',
                    'ROH.Client ID AS ClientId',
                    'ROH.RO Date AS PublishDate',
                    'RL.Agency Code AS agencyCode',
                    'RL.Line No_ As lineno',
                    'RL.Pdf File Name As Pdf File Name',
                    'RL.AV Type AS avType',
                    'MPL.Client Request Code AS CLRCode',
                    'AVMedia.Creative File Name'
                )
                ->Join($this->tblAVROLine.' as RL', 'ROH.RO Code', '=', 'RL.RO No_')
                ->leftJoin($this->tblAVMediaPlan.' as MPL', 'MPL.MP No_', '=', 'ROH.Plan ID')
                ->leftJoin($this->tblAVMedia.' AS AVMedia', 'AVMedia.Client Request No', '=', 'MPL.Client Request Code')
                ->orderBy('RL.Line No_', 'DESC')
                ->where('ROH.AV Type', $avType)
                ->where('RL.Agency Code', $agency_code)
                ->get();
            }
            $pdf = \PDF::loadView('admin.pages.release-order.AV.avPDF', compact('avRodata'));
        }
        return $pdf->download($agency_code . '.pdf');
    }
}
