<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use DB;
use Session;
use App\Models\Api\TAMCirculation;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TAMExcelsImport;
use App\Models\Ummuser;

class GenralMainController extends Controller
{
    use CommonTrait;
    
    public function ministry_code_list()
    {
        $dbresponse['ministry_data'] = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh')
                                        ->select('mh.Ministries Head as ministry_head','my.Ministry Name as ministry_name','mh.Head Name as head_name')
                                        ->leftjoin('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as my','mh.New Ministry Code','=','my.Ministry Code')
                                        ->get();

        // echo"<pre>";print_r($ministry_data);die;
        return view('admin.pages.general.ministry_code_list',$dbresponse);
    }
    public function ministry_code_code()
    {
        $dbresponse['ministry_data'] = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh')
                                        ->select('mh.Ministries Head as ministry_head','my.Ministry Name as ministry_name','mh.Head Name as head_name')
                                        ->leftjoin('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as my','mh.New Ministry Code','=','my.Ministry Code')
                                        ->get();

        // echo"<pre>";print_r($ministry_data);die;
        return view('admin.pages.general.ministry_wise_code_list',$dbresponse);
    }

    public function upload_tam_data(Request $request)
    {
        return view('admin.pages.general.upload_tam_data');
    }

    public function import_tam_data(Request $request)
    {

        if ($request->hasfile('tam_file')) {
            
            try {
                $response =  Excel::import(new TAMExcelsImport, request()->file('tam_file')); //for import
                return back()->with('success', 'Data imported successfully!');
            } catch (ValidationException $ex) {

                $failures = $ex->failures();
                foreach ($failures as $failure) {
                    return response()->json(['message' => 'Row - ' . $failure->row() . ', ' . $failure->errors()[0]], 500);
                }
            }
        }

        return view('admin.pages.general.upload_tam_data');
    }

    public function TVchannellist(){
        $datadb  =DB::table('BOC$AV Vendor$3f88596c-e20d-438c-a694-309eb14559b2')->select('Name','Agency Code')
        ->where('Agency Type',1)
        ->get();
        return view('admin.pages.general.tv-channel-list',['datadb'=>$datadb]);
    }

    public function TVchannellistdashboard(){
        $datadb  =DB::table('BOC$AV Vendor$3f88596c-e20d-438c-a694-309eb14559b2')->select('Name','Agency Code')
        ->where('Agency Type',1)
        ->get();
        return view('admin.pages.general.tv-channel-in-side-dashboard',['datadb'=>$datadb]);
    }

    public function outdoor_instruction()
    {
        return view('admin.pages.general.outdoor_instruction');
    }

    public function checkuser(Request $request)
    {         
        return view('admin.pages.general.user-check');
    }
 
    public function checkuserexist(Request $request)
    {
                # code...
        $type = $request->type;
        $value = $request->value;
        $data= '';

        if($type == '1')
        {
            $where = ['email'=>$value];
        }
        else  if($type == '2')
        {
            $where = ['Mobile No_'=>$value];
        }
        else  if($type == '3')
        {
            $where = ['GST'=>$value];
        }
        else  if($type == '4')
        {
            $where = ['User Name'=>$value];
        }
        else  if($type == '5')
        {
            $where = ['User ID'=>$value];
        }
        else
        {
            $where = '';
        }
        if($type)
        {
            $data = Ummuser::select(
                'email',
                'Mobile No_  AS Mobile',
                'GST'  )
                ->where($where)
                ->first();
        }
        if(($data != NULL) || $data != '' )
        {    
            $status ='Found';
            return view('admin.pages.general.user-check')->with(['data'=>$data,'status'=>$status]);
        }
        else{
            $data = '';
            $status ='Not Found';
            return view('admin.pages.general.user-check')->with(['data'=>$data,'status'=>$status]);
        }                        
    }
}