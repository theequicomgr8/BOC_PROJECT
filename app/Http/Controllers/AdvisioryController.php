<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use App\Models\Advisiory;

class AdvisioryController extends Controller
{
    public function vennotiemp(Request $request)
    {
        //dd($request);
        //return view('admin.pages.vendor-notifi-empanelment');
        $table = 'BOC$Advisory';
        $table1 = 'BOC$General Ledger Setup';
        $advisiory = DB::table($table)
                        ->select('No_', 'Title_Subject', 'Start Date as start_date', 'End Date as end_date', 'Publish Date as publish_date')
                        ->where('No_','=','BOC/0001')
                        ->first();    
        
        $dbresponse = DB::table($table1)
                            ->select('BOC FTP Path as boc_ftp_path')
                            ->first(); 
        // dd($dbresponse);
        // print_r($advisiory);die;
        // return view('admin.pages.client-request',['languages' => $languages]);
        return view('admin.pages.print.vendor-notifi-empanelment',['advisiory' => $advisiory],['dbresponse' => $dbresponse]);
    }
}
