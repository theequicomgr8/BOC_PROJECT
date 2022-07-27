<?php

namespace App\Http\Controllers\Api;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvisioryController extends Controller
{
    public function advisiory()
    {
        $advisory_data = DB::table('BOC$Advisory as ad')
                                ->select('No_ as advisory_id','Title_Subject as title', 'Start Date as start_date', 'End Date as end_date','Publish Date as publish_date','File Name as file_name')    
                                ->get();

        if(count($advisory_data) > 0)
        {   
            $response['status'] = 200;
            $response['message'] = "Advisory data list.";
            $temp = [];
            foreach($advisory_data as $advisoryList)
            {
                $temp['advisory_id']  = $advisoryList->advisory_id; 
                $temp['title']        = $advisoryList->title; 
                $temp['start_date']   = $advisoryList->start_date; 
                $temp['end_date']     = $advisoryList->end_date; 
                $temp['publish_date'] = $advisoryList->publish_date; 
                if($advisoryList->file_name == "")
                {
                    $temp['attatchement'] = "";
                }
                else
                {
                    $temp['attatchement'] = "http://104.211.206.19/Boc_ftp/Notice/".$advisoryList->file_name; 
                }
                

                $response['advisory_data'][] = $temp;
            }
            
        }
        else
        {
            $response['status'] = 400;
            $response['message'] = "No Advisory Data Available.";
        }
        return json_encode($response);
    }
}
