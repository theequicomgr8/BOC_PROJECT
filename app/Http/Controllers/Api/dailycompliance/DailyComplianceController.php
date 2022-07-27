<?php

namespace App\Http\Controllers\Api\dailycompliance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use DB;
use Session;
use App\Http\Traits\clientRequestTableTrait;

class DailyComplianceController extends Controller
{
	use CommonTrait, clientRequestTableTrait;
	public function storeCompliance(Request $request){
		$cntrlnoData=DB::table($this->tblROLine)->select('Control No_ AS controlno')->where('NP Code', $request->npcode)
        ->where('RO NO_', $request->rocode)->first();
        $exparr=explode('/', $request->rocode);
        $ministrycode=substr($exparr[0],0, 2);  
        $randomyear = ( date('m') > 6) ? date('Y') + 1 : date('Y');
        $serno = ( date('m') > 6) ? 1 + 1 : 1;
        $digitno='000';
        $randomcontrolno=sprintf("%s%0s", '',$randomyear.$ministrycode.$digitno.$serno);
      	if($cntrlnoData->controlno ){
        	$currentyear=substr($cntrlnoData->controlno,0, 4);
        	$controlnoReq=$currentyear==$randomyear? $cntrlnoData->controlno:$randomcontrolno;
        }else{
        	$controlnoReq=$randomcontrolno;
        }
		$currentDate=now();
		$destinationPath = public_path() . '/uploads/dailycompliance/';

		if(!empty($request->has('print_upload_creative_fileName_img'))) {

			$file = $request->{'print_upload_creative_fileName_img'};
			if(!empty($file))
			{
				// dd($file);
				$print_upload_creative_fileName = uniqid() . '.png';
				$file = str_replace('data:image/png;base64,', '', $file);
				$file = str_replace(' ', '+', $file);
				$file = base64_decode($file);
				$new_file = imagecreatefromstring($file);
				header('Content-Type: image/png');
				$filep = $destinationPath.$print_upload_creative_fileName;
				$img_jpg = imagepng($new_file,$filep);
			}
			else{
				$print_upload_creative_fileName = '';
			}							
		}else {
			$print_upload_creative_fileName = '';
		}
        // if ($request->hasFile('print_upload_creative_fileName')) {
        //     $file = $request->file('print_upload_creative_fileName');
        //     $print_upload_creative_fileName = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $print_upload_creative_fileName);
        // } else {
        //     $print_upload_creative_fileName = '';
        // }

        $date1 = date('Y-m-d', strtotime($request->published_date));
        $date2 = date('Y-m-d', strtotime($currentDate));
        $seconds = strtotime($date2) - strtotime($date1);
        $hours = $seconds / 60 / 60;
        if($hours>24){
        	//$msg='You have submitted your compliance after 24hrs of Publish date';

        }else{
        	$msg='Data Successfully saved';
        }
        $msg='Data Successfully saved';
		$arrayName = array(
			'Publishing Date' =>date('Y-m-d', strtotime(strtr($request->published_date, '/', '-'))) ,
			'Page No_' =>$request->published_pageno,
			'Remarks' =>isset($request->remark)?$request->remark:'',
			'File Name'=>$print_upload_creative_fileName,
			'Compliance Status'=>1,
			'Compliance DateTime(Audit)'=>$currentDate,
			//'Control No_'=>$controlnoReq
		);
		$sql = DB::table($this->tblROLine)
		->where('NP Code', $request->npcode)
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
