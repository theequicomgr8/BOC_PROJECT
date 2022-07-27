<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use PDF;
use DB;

class MapController extends Controller
{    
    public function map_details($od_vendor_id = null)
    {

        $table = 'BOC$OD Latlong Detail';
        $dbresponse['latlong_details'] = DB::table($table)
                                            ->select('City','Latitude','Longitude')
                                            ->where('OD Vendor ID',$od_vendor_id)
                                            ->get(); 
        
        $dbresponse['od_vendor_id'] = $od_vendor_id;
        // echo"<pre>";print_r($dbresponse);die;                                                   
        return view('admin.pages.map_location',$dbresponse);
    }

    public function map_location_details($od_vendor_id = null)
    {

        $table = 'BOC$OD Latlong Detail';
        $dbresponse['latlong_details'] = DB::table($table)
                                            ->select('Latitude','Longitude','City')
                                            ->where('OD Vendor ID',$od_vendor_id)
                                            ->get(); 
        $dbresponse['od_vendor_id'] = $od_vendor_id;
        // echo"<pre>";print_r($dbresponse);die;  
        return json_encode($dbresponse);                                                 
        
    }
    
}