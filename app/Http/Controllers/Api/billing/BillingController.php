<?php

namespace App\Http\Controllers\Api\billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Traits\CommonTrait;
use App\Http\Traits\clientRequestTableTrait;
use Illuminate\Support\Facades\Session;
class BillingController extends Controller
{
  	use CommonTrait,clientRequestTableTrait;
	public function storeBilling(Request $request){
		$vendorno=Session::get('UserName');
		$currentDate=now();
		$destinationPath = public_path() . '/uploads/billing/';

		if(!empty($request->has('advtImage_fileName'))) {

			$file = $request->{'advtImage_fileName'};
			if(!empty($file))
			{
				$advtImage = uniqid() . '.png';
				$file = str_replace('data:image/png;base64,', '', $file);
				$file = str_replace(' ', '+', $file);
				$file = base64_decode($file);
				$new_file = imagecreatefromstring($file);
				header('Content-Type: image/png');
				$filep = $destinationPath.$advtImage;
				$img_jpg = imagepng($new_file,$filep);
			}
			else{
				$advtImage = '';
			}							
		}else {
			$advtImage = '';
		}

		if(!empty($request->has('npImage_fileName'))) {

			$file = $request->{'npImage_fileName'};
			if(!empty($file))
			{
				// dd($file);
				$npImage = uniqid() . '.png';
				$file = str_replace('data:image/png;base64,', '', $file);
				$file = str_replace(' ', '+', $file);
				$file = base64_decode($file);
				$new_file = imagecreatefromstring($file);
				header('Content-Type: image/png');
				$filep = $destinationPath.$npImage;
				$img_jpg = imagepng($new_file,$filep);
			}
			else{
				$npImage = '';
			}							
		}else {
			$npImage = '';
		}
        //dd($advtImage.'-----'.$npImage);

        // if ($request->hasFile('advtImage')) {
        //     $file = $request->file('advtImage');
        //     $advtImage = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $advtImage);
        // } else {
        //     $advtImage = '';
        // }
        // if ($request->hasFile('npImage')) {
        //     $file = $request->file('npImage');
        //     $npImage = time() . '-' . $file->getClientOriginalName();
        //     $fileUploaded = $file->move($destinationPath, $npImage);
        // } else {
        //     $npImage = '';
        // }
        //genereate controll no.
         $exparr=explode('/', $request->rocode);
         $ministrycode=substr($exparr[0],0);
         $ministryData='';
         $genMinistryCode=0;
        $ministryData=DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2')
        ->select('Category','New Ministry Code','Ministries Head')
        ->where('Ministries Head',$ministrycode)->first();
        if($ministryData!=''){
        	if($ministryData->Category=='NP'){
        		$genMinistryCode=0;
        	}elseif($ministryData->Category=='PL'){
        		$genMinistryCode=1;
        	}
        	elseif($ministryData->Category=='AB'){
        		$genMinistryCode=2;
        	}
        	elseif($ministryData->{'Ministries Head'}>='01101' && $ministryData->{'Ministries Head'}<='10000'){
        		$genMinistryCode=3;
        	}
        	elseif($ministryData->{'Ministries Head'}>='10001' && $ministryData->{'Ministries Head'}<='20000'){
        		$genMinistryCode=4;
        	}
        	elseif($ministryData->{'Ministries Head'}>='20001' && $ministryData->{'Ministries Head'}<='30000'){
        		$genMinistryCode=5;
        	}
        	elseif($ministryData->{'Ministries Head'}>='30001' && $ministryData->{'Ministries Head'}<='40000'){
        		$genMinistryCode=6;
        	}
        	elseif($ministryData->{'Ministries Head'}>='40001' && $ministryData->{'Ministries Head'}<='50000'){
        		$genMinistryCode=7;
        	}
        	elseif($ministryData->{'Ministries Head'}>='50001' && $ministryData->{'Ministries Head'}<='60000'){
        		$genMinistryCode=8;
        	}
        	elseif($ministryData->{'Ministries Head'}>='60001' && $ministryData->{'Ministries Head'}<='70000'){
        		$genMinistryCode=9;
        	}
        }
        $cntrlnoData='';
        $curryear = date('Y');
       	$num = 1;
        $serno = str_pad($num, 5, "0", STR_PAD_LEFT);
        $genserno= $serno;
        $cntrlnoData=DB::table($this->tblROLine)->select('Control No_ AS controlno')
        ->where('NP Code', $request->npcode)
        ->where('Client ID', $ministrycode)
        //->where('RO NO_', 'LIKE', '%'.$ministrycode.'/'.'%')
		->orderBy('Control No_', 'DESC')
		->first();
        if($cntrlnoData->controlno ){
        	$old_control_serno=substr($cntrlnoData->controlno,5, 6);
        	$db_serno=$old_control_serno+1;
        	$serno = str_pad($db_serno, 5, "0", STR_PAD_LEFT);
        }else{
        	$serno=$genserno;
        }
 
        $randomcontrolno=$curryear.$genMinistryCode.$serno;
      	$controlnoReq=$randomcontrolno;
        // dd($controlnoReq);
        //generate bill token
        //$request->npcode;
        $tokenBillRes='';
        $tcurryear = date('dmy', strtotime($request->token_bill_date));
        //date('d').date('m').date('y');
        $tserno = str_pad(1, 3, "0", STR_PAD_LEFT);
        $tgenserno= $tserno;
        $tokenBillRes=DB::table($this->tblROLine)->select('Token ID AS TokenID','Token Date AS TokenDate')
        ->where('Token Date',date('Y-m-d', strtotime($request->token_bill_date)) )
        ->first();
        if(!empty($tokenBillRes->TokenID)){
            $old_token_serno=substr($tokenBillRes->TokenID,12, 3);
            $db_tserno=$old_token_serno+1;
            $tserno = str_pad($db_tserno, 3, "0", STR_PAD_LEFT);
            //dd($tserno);
        }else{
            $tserno=$tgenserno;
            //dd($tserno);
        }

        $generetedTokenForBill=$request->npcode.$tcurryear.$tserno;
		$arrayName=array(
			'Vendor Bill No_' => $request->billno ?? '',
		      'Vendor Bill Date' =>  date('Y-m-d', strtotime($request->bill_date)),
		      'Submission Date' =>  date('Y-m-d'),
		      'Vendor GST No_' => isset($request->gstno)? $request->gstno :'',
		      'Billing Advertisement Type' => $request->bublishedIn,
		      'Page No_' => $request->published_pageno,
		      'Advertisement Length' => $request->advtLen,
		      'Advertisement Width' => $request->advtWidth,
		      'Advertisement Diff_' => $request->diff,
		      'Bill Claim Amount' => $request->claimedAmount,
		      'Bill Approved Amount'=>$request->ap_amount,
		      'Bill Officer Name' => $request->billOfficerName,
		      'Bill Officer Designation' => $request->billOfficerDesign,
		      'Email Id' => $request->email,
		      'Bill Submitted By' => $request->SignatoryName,
		      'Bill Submitted - Designation' => $request->SignatoryDesign,
		      'Advertisement Img FileName'=>$advtImage,
		      'NP Img FileName'=>$npImage,
		      'Image Match Percentage'=>isset($request->ImageMatchPercentage)?$request->ImageMatchPercentage:0,
		      'Billing Status'=>1,
		      'Billing DateTime(Audit)'=>$currentDate,
		      'Vendor No_'=>$vendorno,
		      'Control No_'=>$controlnoReq,
              'Token ID'=>isset($generetedTokenForBill) ? $generetedTokenForBill:'',
              'Token Date'=>isset($request->token_bill_date) ? date('Y-m-d', strtotime($request->token_bill_date)) :'',

  		);
        // Payment of Online Bills must be done within the 30 days window
        $today = date("d-m-Y");
        $publicationdate = $request->publication_date;
        $targetpublicationdate = date('d-m-Y', strtotime("+30 days", strtotime($publicationdate)));
        // if (strtotime($publicationdate) <= strtotime($today) && strtotime($targetpublicationdate) >= strtotime($today)) {
		
			if (strtotime($targetpublicationdate) >= strtotime($today)) {
    		$sql = DB::table($this->tblROLine)
    		->where('NP Code', $request->npcode)
            ->where('RO NO_', $request->rocode)
    		->update($arrayName);

    		DB::unprepared('SET ANSI_WARNINGS ON');
    		if ($sql) {
    			return $this->sendResponse('', 'Data Successfully saved');
    		} else {
    			return $this->sendError('Some Error Occurred!.');
    			exit;
    		}
        }else{
            return $this->sendError('Payment of Online bills must be done within the 30 days.');
            exit;
        }
	}
}
