<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use DB;
use Carbon\Carbon;
use App\Models\Api\RateSettlementPersonalMedia;

class RateSettlementPersonalMediaController extends Controller
{
	use CommonTrait;

	public function apiPersonalMediaSave(Request $request)
	{
		$odmedia_id = DB::select('select TOP 1 [OD Media ID] from dbo.[BOC$Vendor Emp - OD Media] order by [OD Media ID] desc');
		if (empty($odmedia_id)) {
			$odmedia_id = 'POD00001';
			$odmedia_id++;
		} else {
			$odmedia_id = $odmedia_id[0]->{"OD Media ID"};
			$odmedia_id++;
		}
		$table1 = '[BOC$Owner]';
		$table3 = '[BOC$OD Media Owner Detail]';
		$od_media_category = 0; //for personal media
		if (count($request->email) > 0) {
			foreach ($request->email as $key => $email) {
				$owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner] order by [Owner ID] desc');
				if (empty($owner_id)) {
					$owner_id = 'EMPOW1';
				} else {
					$owner_id = $owner_id[0]->{"Owner ID"};
					$owner_id++;
				}
				$sql =  DB::insert("insert into $table1
        	(
	        	[timestamp],
	        	[Owner ID],
	        	[Owner Name],
	        	[Mobile No_],
	            [Email ID],
	            [Phone No_],
	            [Fax No_],
	            [Address 1],
	            [Address 2],
	            [City],
	            [District],
	            [State],
				[HO Same Address as DO],
				[DO Address],
				[DO Landline No_(with STD)],
				[DO Fax No_],
				[DO E-Mail],
				[DO Mobile No_],
				[DO PIN Code],
				[DO City],
				[DO State],
				[DO District],
				[PIN Code]
            ) 
            values
           	(
	            DEFAULT,
	            '" . $owner_id . "',
	            '" . $request->owner_name[$key] . "',
	            '" . $request->mobile[$key] . "',
	            '" . $email . "',
	            ' ',
	            '" . $request->fax[$key] . "',
	            '" . $request->address[$key] . "',
	            '','','','',0,'','','','','','','','','',''
	        )");

				$sql3 =  DB::insert("insert into $table3
				(
					[timestamp],
					[OD Media Type],
					[OD Media ID],
					[Owner ID]					
				)
				values
				(
					DEFAULT,
						$od_media_category,	            
					'" . $odmedia_id . "',
					'" . $owner_id . "' 				
				)");
			}
		}
		if (!$sql && !$sql3) {
			return $this->sendError('Some Error Occurred!.');
			exit;
		}

		$Company_Legal_Documents = 0;
		$Notarized_Copy_Of_Agreement = 0;
		$Photographs = 0;
		$Affidavit_Of_Oath = 0;
		$GST_Registration = 0;
		$CA_Certified_Balance_Sheet = 0;
		$self_declaration = 0;
		$request->License_From = $request->License_From ?? '0000-00-00';
		$request->License_To = $request->License_To ?? '0000-00-00';
		$request->media_type = $request->media_type ?? 0;
		$request->rental_agreement = $request->rental_agreement ?? 0;
		$request->Applying_For_OD_Media_Type = $request->Applying_For_OD_Media_Type ?? 0;
		$request->Application_Amount = $request->Application_Amount ?? 0;
		if ($request->Self_declaration == 'on') {
			$self_declaration = 1;
		}
		//echo $self_declaration;
		//dd($request);
		$destinationPath = public_path() . '/uploads/ratesettl-personal-media/';

		if ($request->hasFile('Legal_Doc_File_Name')) {
			$Company_Legal_Documents = 1;

			$file = $request->file('Legal_Doc_File_Name');
			$Legal_Doc_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $Legal_Doc_File_Name);
		}
		if ($request->hasFile('Notarized_Copy_File_Name')) {
			$Notarized_Copy_Of_Agreement = 1;
			$file = $request->file('Notarized_Copy_File_Name');
			$Notarized_Copy_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $Notarized_Copy_File_Name);
		}

		if ($request->hasFile('Photo_File_Name')) {
			$Photographs = 1;
			$file = $request->file('Photo_File_Name');
			$Photo_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $Photo_File_Name);
		}

		if ($request->hasFile('Affidavit_File_Name')) {
			$Affidavit_Of_Oath = 1;
			$file = $request->file('Affidavit_File_Name');
			$Affidavit_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $Affidavit_File_Name);
		}

		if ($request->hasFile('GST_File_Name')) {
			$GST_Registration = 1;
			$file = $request->file('GST_File_Name');
			$GST_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $GST_File_Name);
		}
		if ($request->hasFile('Balance_Sheet_File_Name')) {
			$CA_Certified_Balance_Sheet = 1;
			$file = $request->file('Balance_Sheet_File_Name');
			$Balance_Sheet_File_Name = time() . '-' . $file->getClientOriginalName();
			$file->move($destinationPath, $Balance_Sheet_File_Name);
		}

		$table2 = '[BOC$Vendor Emp - OD Media]';
		
		$sql2 =  DB::insert("insert into $table2
        (
			[timestamp]
			,[OD Category]
			,[OD Media ID]
			,[PM Agency Name]
			,[HO Address]
			,[HO Landline No_]
			,[HO Fax No_]
			,[HO E-Mail]
			,[HO Mobile No_]
			,[BO Address]
			,[BO Landline No_]
			,[BO Fax No_]
			,[BO E-Mail]
			,[BO Mobile No_]
			,[DO Address]
			,[DO Landline No_]
			,[DO Fax No_]
			,[DO E-Mail]
			,[DO Mobile No_]
			,[Legal Status of Company]
			,[Other Relevant Information]
			,[Authority Which granted Media]
			,[Amount paid to Authority]
			,[License From]
			,[License To]
			,[Media Type]
			,[Rental Agreement]
			,[Applying For OD Media Type]
			,[GST No_]
			,[TIN_TAN_VAT No_]
			,[DD Date]
			,[DD No_]
			,[DD Bank Name]
			,[DD Bank Branch Name]
			,[Application Amount]
			,[PAN]
			,[Bank Name]
			,[Bank Branch]
			,[IFSC Code]
			,[Account No_]
			,[Company Legal Documents]
			,[Notarized Copy Of Agreement]
			,[Photographs]
			,[Affidavit Of Oath]
			,[GST Registration]
			,[CA Certified Balance Sheet]
			,[Self-declaration]
			,[Legal Doc File Name]
			,[Notarized Copy File Name]
			,[Photo File Name]
			,[Affidavit File Name]
			,[GST File Name]
			,[Balance Sheet File Name]
			,[Authorized Rep Name]
			,[AR Address]
			,[AR Landline No_]
			,[AR FAX No_]
			,[AR Mobile No_]
			,[AR E-mail]
			,[Contract No_]
			,[Quantity Of Display]
			,[License Fees]
			,[Media Display size]
			,[Illumination]
			,[PAN Attached]
			,[PAN File Name]	      
        ) 
        values
        (
	    DEFAULT,
	         $od_media_category,
	    '" . $odmedia_id . "',
		'" . $request->agency_name1 . "',

		'" . $request->HO_Address . "',
		'" . $request->HO_Landline_No_ . "',
		'" . $request->HO_Fax_No_ . "',
		'" . $request->HO_Email . "',
		'" . $request->HO_Mobile_No_ . "',

		'" . $request->BO_Address . "',
		'" . $request->BO_Landline_No_ . "',
		'" . $request->BO_Fax_No_ . "',
		'" . $request->BO_Email . "',
		'" . $request->BO_Mobile . "',

		'" . $request->DO_Address . "',
		'" . $request->DO_Landline_No_ . "',
		'" . $request->DO_Fax_No_ . "',
		'" . $request->DO_Email . "',
		'" . $request->DO_Mobile . "',
		     $request->legal_status_company,
		'" . $request->relevant_information . "',
		
		'" . $request->Authority_Which_granted_Media . "',
		     $request->Amount_paid_Authority,
		'" . $request->License_From . "',
		'" . $request->License_To . "',
			 $request->media_type,
			 $request->rental_agreement,
			 $request->Applying_For_OD_Media_Type,

		'" . $request->GST_No_ . "',
		'" . $request->TIN_TAN_VAT_No_ . "',
		
		'" . $request->DD_Date . "',
		'" . $request->DD_No_ . "',		
		'" . $request->DD_Bank_Name . "',
		'" . $request->DD_Bank_Branch_Name . "',
		     $request->Application_Amount,

		'" . $request->PAN . "',
		'" . $request->Bank_Name . "',
		'" . $request->Bank_Branch . "',
		'" . $request->IFSC_Code . "',
		'" . $request->Account_No_ . "',

		     $Company_Legal_Documents ,
	         $Notarized_Copy_Of_Agreement ,
	         $Affidavit_Of_Oath ,
	         $Photographs ,
	         $GST_Registration ,
			 $CA_Certified_Balance_Sheet,
			 $self_declaration,

		'" . $Legal_Doc_File_Name . "',
		'" . $Notarized_Copy_File_Name . "',
		'" . $Affidavit_File_Name . "',
		'" . $Photo_File_Name . "',
		'" . $GST_File_Name . "',
		'" . $Balance_Sheet_File_Name . "',
		' ',' ',' ',' ',' ',' ',' ',0,0,0,0,0,' '
	    )");
		if (!$sql2) {
			return $this->sendError('Some Error Occurred!.');
			exit;
		}

		$table4 = '[BOC$OD Media Work done]';
		if (count($request->year) > 0) {
			$upload_doc_num = 0;
			$upload_doc = '';
			foreach ($request->year as $key => $year) {
				$line_no = DB::select("select TOP 1 [Line No_] from $table4 where [OD Media Type] = 0 and [OD Media ID] = '" . $odmedia_id . "' order by [Line No_] desc");
				if (empty($line_no)) {
					$line_no = 10000;
				} else {
					$line_no = $line_no[0]->{"Line No_"};
					$line_no = $line_no + 10000;
				}
				if ($request->hasFile('upload_doc')) {
					$upload_doc_num = 1;
					$file = $request->upload_doc[$key];
					$upload_doc = time() . '-' . $file->getClientOriginalName();
					$file->move($destinationPath, $upload_doc);
				}
				$sql4 =  DB::insert("insert into $table4
        	(
	        	 [timestamp]
				,[OD Media Type]
				,[OD Media ID]
				,[Line No_]
				,[Work Name]
				,[Year]
				,[Qty Of Display_Duration]
				,[Billing Amount]
				,[File Name]
				,[File Uploaded]
            ) 
            values
           	(
	            DEFAULT,
	                 $od_media_category,	            
	            '" . $odmedia_id . "',
	                 $line_no,
	            ' ',
	            '" . $year . "',
	              " . $request->quantity_duration[$key] . ",
	              " . $request->billing_amount[$key] . ",
	            '" . $upload_doc . "',
	                 $upload_doc_num
	        )");
			}
		}
		if ($sql4) {
			return $this->sendResponse('', 'Data Save Successfully! Please note the ' . $odmedia_id . ' reference number for future use.');
		} else {
			return $this->sendError('Some Error Occurred!.');
			exit;
		}
	}

	public function apiPersonalMediaView(Request $request)
	{
		$table = 'BOC$OD Media Owner Detail';
		$select = array('OD Media ID', 'Owner ID');
		$where = array('OD Media Type' => 0, 'OD Media ID' => $request->davp_code);
		$pluck = 'Owner ID';
		$result = RateSettlementPersonalMedia::fetchAllRecords($table, $select, '', '', $where, '', $pluck);

		$table1 = 'BOC$Owner';
		$select = array('Owner ID', 'Owner Name', 'Mobile No_', 'Email ID', 'Fax No_', 'Address 1');
		$whereIn = array('Owner ID' => $result);
		$OD_owners = RateSettlementPersonalMedia::fetchAllRecords($table1, $select, '', '', '', $whereIn, '');

		$table2 = 'BOC$Vendor Emp - OD Media';
		$select = array('*');
		$where = array('OD Category' => 0, 'OD Media ID' => $request->davp_code);
		$OD_vendors = RateSettlementPersonalMedia::fetchAllRecords($table2, $select, '', '',  $where, '', '');

		$table3 = 'BOC$OD Media Work done';
		$select = array('OD Media Type','OD Media ID','Line No_','Work Name','Year','Qty Of Display_Duration','Billing Amount','File Name',
		'File Uploaded');
		$where = array('OD Media Type' => 0, 'OD Media ID' => $request->davp_code);
		$OD_work_dones = RateSettlementPersonalMedia::fetchAllRecords($table3, $select, '', '',  $where, '', '');

		unset($OD_vendors[0]->{'timestamp'});
		//dd($OD_vendors);
		if (empty($result)) {
			return $this->sendError('Data not found!.');
			exit;
		}
		$results = array('OD_owners' => $OD_owners, 'OD_vendors' => $OD_vendors, 'OD_work_dones' => $OD_work_dones);
		//dd($results);
		return $this->sendResponse($results, 'Data retrieved successfully.');
	}

	public function apiPersonalMediaUpdate(Request $request)
	{

		$table1 = 'BOC$Vendor Emp - OD Media';
		$update = array('License From' => $request->License_From, 'License To' => $request->License_To);
		$where = array('OD Category' => 0, 'OD Media ID' => $request->od_media_id);
		$sql = RateSettlementPersonalMedia::updateAllRecords($table1, $update, $where);
		if (!$sql) {
			return $this->sendError('Some Error Occurred!.');
			exit;
		}
		if (count($request->quantity_duration) > 0) {
			$table2 = 'BOC$OD Media Work done';
			foreach ($request->quantity_duration as $key => $qty_duration) {
				$update = array('Qty Of Display_Duration' => $qty_duration);
				$where = array('OD Media Type' => 0, 'OD Media ID' => $request->od_media_id, 'Line No_' => $request->line_no[$key]);
				$sql1 = RateSettlementPersonalMedia::updateAllRecords($table2, $update, $where);
			}
			if ($sql1) {
				return $this->sendResponse('', 'Data Updated Successfully! Please note the '.$request->od_media_id.' reference number for future use');
			} else {
				return $this->sendError('Some Error Occurred!.');
			}
		}
	}
}
