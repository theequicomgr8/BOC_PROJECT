<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Api\CommunityRadio;
use Carbon\Carbon;
use DB;
use Session;



class CommunityRadioController extends Controller
{

use CommonTrait;

	public function cmRadioOwnerData(Request $request) //Save Owner Data function
	{
        $table1 = '[BOC$Owner]';
        $msg = '';
        $unique_id ='';
        $user_id = Session::get('UserID');
            if($request->ownerid == '') {
                //dd($owner_id);
                // owner id formate
                $owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner] order by [Owner ID] desc');
                if (empty($owner_id)) {
                    $owner_id = 'EMPOW1';
                } else {
                    $owner_id = $owner_id[0]->{"Owner ID"};
                    $owner_id++;
                }
                	$owner_name=
                    isset($request->owner_name) ? $request->owner_name:'';
                    $mobile=
                    isset($request->mobile) ? $request->mobile:'';
                    $email=
                    isset($request->email) ? $request->email:'';
                    $phone=
                    isset($request->phone) ? $request->phone:'';
                    $address1=
                    isset($request->address1) ? $request->address1:'';
                    $city=
                    isset($request->city) ? $request->city:'';
                    $district=
                    isset($request->district) ? $request->district:'';
                    $state=
                    isset($request->state) ? $request->state:'';
                $sql =  DB::insert(
                "insert into $table1 (
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
				[PIN Code],
                [User ID],
                [Group Name],
                [Printed],
                [BR Code],
                [Pay Mode],
                [Account No],
                [Account Type],
                [MICR Code],
                [MICR City Code],
                [Local],
                [RBI AG Code],
                [RBI BR Code],
                [State Code],
                [STEPS BR Code],
                [STEPS Account NO],
                [GRP Password],
                [STEPS CoreBank],
                [AUTH Sign Name],
                [AUTH Sign Desgn],
                [IFSC Code],
                [IFSC Account Name],
                [IFSC Account NO],
                [IFSC Address],
                [IFSC File],
                [Adwing Pay Mode],
                [PFMS UniqueCode],
                [Group New Name],
                [Sanction Payee],
                [Owner Type]

            )
            values (
                DEFAULT,
                '" . $owner_id . "',
                '" . $owner_name . "',
                '" . $mobile . "',
                '" . $email . "',
                '" . $phone . "',
                '',
                '" . $address1 . "',
                ' ',
                '" . $city . "',
                '" . $district . "',
                '" . $state . "',
                0,'','','','','','','','','','','".$user_id."'
                ,'','','','','','','','','','','','','','','','','','','','','','','','','',
                '','',0
                )"
                );
                $msg = 'Data Saved Successfully!';
            }else {
                $owner_id = $request->ownerid;
                $Owner_table = 'BOC$Owner';
                $request->phone = $request->phone ?? '';
                $update = array(
                    'Owner Name' => $request->owner_name,
                    'Mobile No_' => $request->mobile,
                    'Email ID' => $request->email,
                    'Phone No_' => $request->phone,
                    'Address 1' => $request->address1,
                    'City' => $request->city,
                    'District' => $request->district,
                    'State' => $request->state
                );
                $where = array('Owner ID' => $owner_id);
                $sql = CommunityRadio::CommRadioupdateAlldata($Owner_table, $update, $where);
                $msg = 'Data Updated Successfully!';
            }

        if ($sql) {
            $unique_id = array('Owner_ID' => $owner_id);
               session::put('owner_id',$unique_id); //Put session on Owner_id
            return $this->sendResponse($owner_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function saveChannelDetails(Request $request) //Save Channel Details Function
    {
        //$owner_id= session::get('owner_id');
    	$owner_id = $request->ownerid;
        $msg ='';
        $table1= '[BOC$Radio Time Band]';
    	$table2= '[BOC$Vend Emp - Community Radio]';
    	// $CMRadio= DB::select('select Top 1 [Radio ID] form dbo.[BOC$Radio Time Band] order by [Radio ID] desc');
    	//dd($request->HO_Same_Address_DO);
            $Name =$request->Name ?? '';
            $Agency_Code= $request->Agency_Code ?? '';
            $Frequency= $request->Frequency ?? '';
			$Language=$request->Language ?? '';
			$GOPA_Signing_Date= $request->GOPA_Signing_Date ?? '0000-00-00';
			$GOPA_Valid_upto= $request->GOPA_Valid_upto ?? '0000-00-00';
			$WOL_Number=$request->WOL_Number ?? '';
			$WOL_Signing_Date= $request->WOL_Signing_Date ?? '0000-00-00';
			$WOL_Valid_Upto= $request->WOL_Valid_Upto ?? '0000-00-00';
			$Company_Legal_Status= $request->Company_Legal_Status ?? '';
			$Cnannel_Head= $request->Cnannel_Head ?? '';
			$Channel_Launch_Date= $request->Channel_Launch_Date ?? '0000-00-00';
			$Address= $request->Address ?? '';
			$City= $request->City ?? '';
			$District= $request->District ?? '';
			$State= $request->State ?? '';
			$PIN_Code= $request->PIN_Code ?? '';
			$Phone_No= $request->Phone_No ??'';
			$Fax= $request->Fax ?? '';
			$Mobile_No= $request->Mobile_No ?? '';
			$E_Mail= $request->E_Mail ?? '';
			$HO_Same_Address_DO= $request->HO_Same_Address_DO ?? '0';
			$HO_Address= $request->HO_Address ?? '';
			$HO_City= $request->HO_City ?? '';
			$HO_District= $request->HO_District ?? '';
			$HO_State= $request->HO_State ?? '';
			$HO_PIN_Code= $request->HO_PIN_Code ?? '';
			$HO_Phone_No= $request->HO_Phone_No ?? '';
			$HO_Fax= $request->HO_Fax ?? '';
			$HO_Mobile_No= $request->HO_Mobile_No ?? '';
			$HO_E_Mail= $request->HO_E_Mail ?? '';
			$OHO_Same_Address_DO= $request->OHO_Same_Address_DO ?? '0';
			$OHO_Address= $request->OHO_Address ?? '';
			$OHO_City= $request->OHO_City ?? '';
			$OHO_District= $request->OHO_District ?? '';
			$OHO_State= $request->OHO_State ?? '';
			$OHO_PIN_Code= $request->OHO_PIN_Code ?? '';
			$OHO_Phone_No= $request->OHO_Phone_No ??'';
			$OHO_Fax= $request->OHO_Fax ?? '';
			$OHO_Mobile_No= $request->OHO_Mobile_No ?? '';
			$OHO_E_Mail= $request->OHO_E_Mail ?? '';

    	$unique_id = '';
    	$Community_Radio_ID ='';
        //Receiver ID
    	$receiver_table = '[BOC$Media Plan Setup]';
        $get_receiver_code = DB::select("select TOP 1 [CRS Empanel Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"CRS Empanel Landing UID"};


    	if ($request->CMRadio == '') {
            $Community_Radio_ID = DB::select('select TOP 1 [Community Radio ID] from dbo.[BOC$Vend Emp - Community Radio] order by [Community Radio ID] desc');
            if (empty($Community_Radio_ID)) {
                $Community_Radio_ID = 'CR00001'; // New Create Communtiy Radio ID
            } else {
                $Community_Radio_ID = $Community_Radio_ID[0]->{"Community Radio ID"};
                $Community_Radio_ID++;
            }
   			$user_id = Session::get('UserID'); // Get seesion owner_id
			$sql1= DB::insert("
				insert into $table2(
				[timestamp],
				[Community Radio ID],
				[Name],
				[Owner ID],
				[Agency Code],
				[Frequency],
				[Language],
				[GOPA Signing Date],
				[GOPA Valid upto],
				[WOL Number],
				[WOL Signing Date],
				[WOL Valid Upto],
				[Company Legal Status],
				[Cnannel Head],
				[Channel Launch Date],
				[Address],
				[City],
				[District],
				[State],
				[PIN Code],
				[Phone No_(with STD)],
				[Fax],
				[Mobile No_],
				[E-Mail],
				[HO Same Address DO],
				[HO Address],
				[HO City],
				[HO District],
				[HO State],
				[HO PIN Code],
				[HO Phone No_(with STD)],
				[HO Fax],
				[HO Mobile No_],
				[HO E-Mail],
				[OHO Same Address DO],
				[OHO Address],
				[OHO City],
				[OHO District],
				[OHO State],
				[OHO PIN Code],
				[OHO Phone No_(with STD)],
				[OHO Fax],
				[OHO Mobile No_],
				[OHO E-Mail],
				[User ID],
				[Status],
				[WOL Certificate],
              	[GOPA Certificate],
              	[Fixed Point Chart],
              	[PAN Card],
              	[GST Certificate],
              	[Content Tel CD],
              	[Rate Undertaking],
              	[CRS Certificate],
              	[Acceptance],
				[Bank A_c No_],
				[A_C Holder Name],
				[Bank Name],
				[IFSC Code],
				[Bank Branch],
				[Bank A_C Address],
				[PAN],
				[GST No_],
				[ESI A_C No_],
				[ESI - No_ Of Employee],
				[EPF A_C No_],
				[EPF - No_ Of Employee],
				[FPC File Name],
				[GOPA File Name],
				[WOL File Name],
				[GST Cert File Name],
				[PAN Card File Name],
				[Content TCD File Name],
				[CRS Cert File Name],
				[Rate UT File Name],
                [Empanelment Category],
                [Global Dimension 1 Code],
                [Global Dimension 2 Code],
                [Sender ID],
                [Receiver ID],
                [Rate],
                [Modification],
                [Agr File Path],
                [Agr File Name],
                [Allocated Vendor Code],
                [From Date],
                [To Date],
                [Recommended To Committee]
				)
				values(
				DEFAULT,
				'".$Community_Radio_ID."',
				'".$Name."',
				'".$request->ownerid."',
            	'".$Agency_Code."',
            	'".$Frequency."',
            	'".$Language."',
            	'".$GOPA_Signing_Date."',
            	'".$GOPA_Valid_upto."',
            	'".$WOL_Number."',
            	'".$WOL_Signing_Date."',
            	'".$WOL_Valid_Upto."',
            	'".$Company_Legal_Status."',
            	'".$Cnannel_Head."',
            	'".$Channel_Launch_Date."',
            	'".$Address."',
            	'".$City."',
            	'".$District."',
            	'".$State."',
            	'".$PIN_Code."',
            	'".$Phone_No."',
            	'".$Fax."',
            	'".$Mobile_No."',
            	'".$E_Mail."',
            	'".$HO_Same_Address_DO."',
            	'".$HO_Address."',
            	'".$HO_City."',
            	'".$HO_District."',
            	'".$HO_State."',
            	'".$HO_PIN_Code."',
            	'".$HO_Phone_No."',
            	'".$HO_Fax."',
            	'".$HO_Mobile_No."',
            	'".$HO_E_Mail."',
            	'".$OHO_Same_Address_DO."',
            	'".$OHO_Address."',
            	'".$OHO_City."',
            	'".$OHO_District."',
            	'".$OHO_State."',
            	'".$OHO_PIN_Code."',
            	'".$OHO_Phone_No."',
            	'".$OHO_Fax."',
            	'".$OHO_Mobile_No."',
            	'".$OHO_E_Mail."',
            	'".$user_id."',
            	0,1,1,0,0,1,0,0,1,0,'','','','','','','','','','','','','','','',
            	'','','','',1,5,'M002','','','".$recervier_id."',0,0,'','','','1900-01-01 00:00:00.000','1900-01-01 00:00:00.000',0
            )" );
			$CMRadio =$Community_Radio_ID; // Store Communty radio id in CMRadio
			$msg ="Community Radio Information Added Successfully !";

			for($key=0;$key<7;$key++)
        	{
        		// echo"<pre>";print_r($key);
        		//Insert value for Time band 1
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>0,
        			'Start Time'=>$request->TB_From1[$key],
        			'End Time'=>$request->TB_To1[$key],
        		]);

        		//Insert value for Time band 2
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>1,
        			'Start Time'=>$request->TB_From2[$key],
        			'End Time'=>$request->TB_To2[$key],
        		]);

        		//Insert value for Time band 3
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>2,
        			'Start Time'=>$request->TB_From3[$key],
        			'End Time'=>$request->TB_To3[$key],
        		]);
        	}

			if($sql1){
        		return $this->sendResponse($CMRadio, $msg);
    		}
		}
		else {
			//dd($owner_id);
			$owner_id = $request->ownerid;
           	$Community_Radio_ID= $request->CMRadio;
            $table2 = 'BOC$Vend Emp - Community Radio';
           	$request->Name =$request->Name ?? '';
            $request->Agency_Code= $request->Agency_Code ?? '';
            $request->Frequency= $request->Frequency ?? '';
			$request->Language=$request->Language ?? '';
			$request->GOPA_Signing_Date= $request->GOPA_Signing_Date ?? '0000-00-00';
			$request->GOPA_Valid_upto= $request->GOPA_Valid_upto ?? '0000-00-00';
			$request->WOL_Number=$request->WOL_Number ?? '';
			$request->WOL_Signing_Date= $request->WOL_Signing_Date ?? '0000-00-00';
			$request->WOL_Valid_Upto= $request->WOL_Valid_Upto ?? '0000-00-00';
			$request->Company_Legal_Status= $request->Company_Legal_Status ?? '';
			$request->Cnannel_Head= $request->Cnannel_Head ?? '';
			$request->Channel_Launch_Date= $request->Channel_Launch_Date ?? '0000-00-00';
			$request->Address= $request->Address ?? '';
			$request->City= $request->City ?? '';
			$request->District= $request->District ?? '';
			$request->State= $request->State ?? '';
			$request->PIN_Code= $request->PIN_Code ?? '';
			$request->Phone_No= $request->Phone_No ??'';
			$request->Fax= $request->Fax ?? '';
			$request->Mobile_No= $request->Mobile_No ?? '';
			$request->E_Mail= $request->E_Mail ?? '';
			$request->HO_Same_Address_DO= $request->HO_Same_Address_DO ?? '0';
			$request->HO_Address= $request->HO_Address ?? '';
			$request->HO_City= $request->HO_City ?? '';
			$request->HO_District= $request->HO_District ?? '';
			$request->HO_State= $request->HO_State ?? '';
			$request->HO_PIN_Code= $request->HO_PIN_Code ?? '';
			$request->HO_Phone_No= $request->HO_Phone_No ?? '';
			$request->HO_Fax= $request->HO_Fax ?? '';
			$request->HO_Mobile_No= $request->HO_Mobile_No ?? '';
			$request->HO_E_Mail= $request->HO_E_Mail ?? '';
			$request->OHO_Same_Address_DO= $request->OHO_Same_Address_DO ?? '0';
			$request->OHO_Address= $request->OHO_Address ?? '';
			$request->OHO_City= $request->OHO_City ?? '';
			$request->OHO_District= $request->OHO_District ?? '';
			$request->OHO_State= $request->OHO_State ?? '';
			$request->OHO_PIN_Code= $request->OHO_PIN_Code ?? '';
			$request->OHO_Phone_No= $request->OHO_Phone_No ??'';
			$request->OHO_Fax= $request->OHO_Fax ?? '';
			$request->OHO_Mobile_No= $request->OHO_Mobile_No ?? '';
			$request->OHO_E_Mail= $request->OHO_E_Mail ?? '';
			$update= array(
				'Name'=> $request->Name,
				'Agency Code'=>$request->Agency_Code,
				'Frequency'=>$request->Frequency,
				'Language'=>$request->Language,
				'GOPA Signing Date'=>$request->GOPA_Signing_Date,
				'GOPA Valid upto'=>$request->GOPA_Valid_upto,
				'WOL Number'=>$request->WOL_Number,
				'WOL Signing Date'=>$request->WOL_Signing_Date,
				'WOL Valid Upto'=>$request->WOL_Valid_Upto,
				'Company Legal Status'=>$request->Company_Legal_Status,
				'Cnannel Head'=>$request->Cnannel_Head,
				'Channel Launch Date'=>$request->Channel_Launch_Date,
				'Address' =>$request->Address,
				'City' =>$request->HO_City,
				'District' =>$request->District,
				'State' =>$request->State,
				'PIN Code'=>$request->PIN_Code,
				'Phone No_(with STD)' =>$request->Phone_No,
				'Fax' =>$request->Fax,
				'Mobile No_' =>$request->Mobile_No,
				'E-Mail' =>$request->E_Mail,
				'HO Same Address DO' =>$request->HO_Same_Address_DO,
				'HO Address' =>$request->HO_Address,
				'HO City' =>$request->HO_City,
				'HO District' =>$request->HO_District,
				'HO State' =>$request->HO_State,
				'HO PIN Code' =>$request->HO_PIN_Code,
				'HO Phone No_(with STD)' =>$request->HO_Phone_No,
				'HO Fax' =>$request->HO_Fax,
				'HO Mobile No_' =>$request->HO_Mobile_No,
				'HO E-Mail' =>$request->HO_E_Mail,
				'OHO Same Address DO' =>$request->OHO_Same_Address_DO,
				'OHO Address' =>$request->OHO_Address,
				'OHO City' =>$request->OHO_City,
				'OHO District' =>$request->OHO_District,
				'OHO State' =>$request->OHO_State,
				'OHO PIN Code' =>$request->OHO_PIN_Code,
				'OHO Phone No_(with STD)' =>$request->OHO_Phone_No,
				'OHO Fax' =>$request->OHO_Fax,
				'OHO Mobile No_' =>$request->OHO_Mobile_No,
				'OHO E-Mail' =>$request->OHO_E_Mail
			);
			$CMRadio =$Community_Radio_ID;
			 $where = array('Community Radio ID' => $CMRadio);
			 $sql1 = CommunityRadio::CommRadioupdateAlldata($table2, $update, $where);
            $msg = 'Community Radio Information Updated Successfully!';
            // echo"<pre>";print_r($request->weekday);die;
            // foreach($weekday as $key => $value)

        }
        $data=DB::table('BOC$Radio Time Band')->where(' Radio ID',$Community_Radio_ID)->delete();
        	for($key=0;$key<7;$key++)
        	{
        		// echo"<pre>";print_r($key);
        		//Insert value for Time band 1
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>0,
        			'Start Time'=>$request->TB_From1[$key],
        			'End Time'=>$request->TB_To1[$key],

        		]);

        		//Insert value for Time band 2
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>1,
        			'Start Time'=>$request->TB_From2[$key],
        			'End Time'=>$request->TB_To2[$key],

        		]);

        		//Insert value for Time band 3
        		DB::table('BOC$Radio Time Band')->insert([
        			' Radio ID'=> $CMRadio,
        			'Weekday'=> $request->weekday[$key],
        			'Time Band'=>2,
        			'Start Time'=>$request->TB_From3[$key],
        			'End Time'=>$request->TB_To3[$key],

        		]);

			}
        	//dd($request->TB_From1, $request->TB_To);

			if($sql1)
			{
        		return $this->sendResponse($CMRadio, $msg);

            }
		}

	public function AccountDetails(Request $request) //Save Accout Details function
	{
    $msg ='';
	$table3= 'BOC$Vend Emp - Community Radio';
	$Bank_Ac_No= $request->Bank_Ac_No ?? '';
	$AC_Holder_Name= $request->AC_Holder_Name ?? '';
	$Bank_Name= $request->Bank_Name ?? '';
	$IFSC_Code= $request->IFSC_Code ?? '';
	$Bank_Branch= $request->Bank_Branch ?? '';
	$Bank_AC_Address= $request->Bank_AC_Address ?? '';
	$PAN= $request->PAN ?? '';
	$GST_No= $request->GST_No ?? '';
	$ESI_AC_No= $request->ESI_AC_No ?? '';
	$ESI_No_Of_Employee= $request->ESI_No_Of_Employee ?? '';
	$EPF_AC_No= $request->EPF_AC_No ?? '';
	$EPF_No_Of_Employee= $request->EPF_No_Of_Employee ?? '';
	$update= array(
		'Bank A_c No_'=> $request->Bank_Ac_No,
		'A_C Holder Name'=>$request->AC_Holder_Name,
		'Bank Name'=> $request->Bank_Name,
		'IFSC Code'=> $request->IFSC_Code,
		'Bank Branch'=> $request->Bank_Branch,
		'Bank A_C Address'=> $request->Bank_AC_Address,
		'PAN'=> $request->PAN,
		'GST No_'=> $request->GST_No,
		'ESI A_C No_'=> $request->ESI_AC_No,
		'ESI - No_ Of Employee'=> $request->ESI_No_Of_Employee,
		'EPF A_C No_'=> $request->EPF_AC_No,
		'EPF - No_ Of Employee'=> $request->EPF_No_Of_Employee

	);

	//dd($update);
	$where= array('Community Radio ID'=>$request->CMRadio);
	//dd($request->CMRadio);
	$sql5= CommunityRadio::CommRadioupdateAlldata($table3, $update, $where);
	$msg ="Account Details Added Successfully!";
	if(!$sql5)
	{
		$this->sendError('Some Error Occurred'); exit();
	}
	else{
		return $this->sendResponse($request->CMRadio, $msg);
	}
	}
	public function storeDocument(Request $request)
	{
		//dd($request);
		$msg= "";
		$destinationPath= public_path() .'/uploads/cm_radio_station/';
		$table2 = 'BOC$Vend Emp - Community Radio';
		$Fixed_Point_Chart= '';
		$GOPA_Certificate= '';
		$WOL_Certificate= '';
		$GST_Certificate= '';
		$PAN_Card= '';
		$Content_Tel_CD= '';
		$CRS_Certificate= '';
		$Rate_Undertaking= '';
		if($request->hasFile('FPC_File_Name')){
            $file = $request->file('FPC_File_Name');
            $FPC_File_Name =time().'-'.$file->getClientOriginalName(); //Pre define fuction
            $fileUploaded=$file->move($destinationPath, $FPC_File_Name);// upload img fuction
            if($fileUploaded){
                $Fixed_Point_Chart=1;
            }
        }else{
            $FPC_File_Name='';
        }
        if($request->hasFile('GOPA_File_Name')){
            $file = $request->file('GOPA_File_Name');
            $GOPA_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $GOPA_File_Name);
            if($fileUploaded){
                $GOPA_Certificate=1;
            }
        }else{
            $GOPA_File_Name='';
        }
        if($request->hasFile('WOL_File_Name')){
            $file = $request->file('WOL_File_Name');
            $WOL_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $WOL_File_Name);
            if($fileUploaded){
                $WOL_Certificate=1;
            }
        }else{
            $WOL_File_Name='';
        }
        if($request->hasFile('GST_Cert_File_Name')){
            $file = $request->file('GST_Cert_File_Name');
            $GST_Cert_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $GST_Cert_File_Name);
            if($fileUploaded){
                $GST_Certificate=1;
            }
        }else{
            $GST_Cert_File_Name='';
        }
        if($request->hasFile('PAN_Card_File_Name')){
            $file = $request->file('PAN_Card_File_Name');
            $PAN_Card_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $PAN_Card_File_Name);
            if($fileUploaded){
                $PAN_Card=1;
            }
        }else{
            $PAN_Card_File_Name='';
        }
        if($request->hasFile('Content_TCD_File_Name')){
            $file = $request->file('Content_TCD_File_Name');
            $Content_TCD_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $Content_TCD_File_Name);
            if($fileUploaded){
                $Content_Tel_CD=1;
            }
        }else{
            $Content_TCD_File_Name='';
        }
         if($request->hasFile('CRS_Cert_File_Name')){
            $file = $request->file('CRS_Cert_File_Name');
            $CRS_Cert_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $CRS_Cert_File_Name);
            if($fileUploaded){
                $CRS_Certificate=1;
            }
        }else{
            $CRS_Cert_File_Name='';
        }
         if($request->hasFile('Rate_UT_File_Name')){
            $file = $request->file('Rate_UT_File_Name');
            $Rate_UT_File_Name =time().'-'.$file->getClientOriginalName();
            $fileUploaded=$file->move($destinationPath, $Rate_UT_File_Name);
            if($fileUploaded){
                $Rate_Undertaking=1;
            }
        }else{
            $Rate_UT_File_Name='';
        }
        if(isset($request->Acceptance)){
                $Acceptance =1;
            }else{
                $Acceptance =0;
            }
            $update= array(
            	'Fixed Point Chart'=>$Fixed_Point_Chart,
              	'GOPA Certificate'=>$GOPA_Certificate,
              	'WOL Certificate'=>$WOL_Certificate,
              	'GST Certificate'=>$GST_Certificate,
              	'PAN Card'=>$PAN_Card,
              	'Content Tel CD'=>$Content_Tel_CD,
              	'CRS Certificate'=>$CRS_Certificate,
              	'Rate Undertaking'=>$Rate_Undertaking,
              	'FPC File Name'=>$FPC_File_Name,
				'GOPA File Name'=>$GOPA_File_Name,
				'WOL File Name'=>$WOL_File_Name,
				'GST Cert File Name'=>$GST_Cert_File_Name,
				'PAN Card File Name'=>$PAN_Card_File_Name,
				'Content TCD File Name'=>$Content_TCD_File_Name,
				'CRS Cert File Name'=>$CRS_Cert_File_Name,
				'Rate UT File Name'=>$Rate_UT_File_Name,
				'Acceptance'=>$Acceptance,
				'Modification' =>'1'
            );
            $where= array('Community Radio ID'=>$request->CMRadio);
            $sql6= CommunityRadio::CommRadioupdateAlldata($table2, $update, $where);
            $msg ='Data Save Successfully! Please note the ' .$request->CMRadio. ' reference number for future use.';
   		if (!$sql6){
                return $this->sendError('Some Error Occurred!.');
            exit;

        } else {
            return $this->sendResponse($request->CMRadio,$msg);
        }

	}

	public function ShowAllDetails($user_ID = '') //Store all Data
    {
    	//dd($user_ID);
    	$table1 = 'BOC$Owner';
	    $select = array('Owner ID',
                    'Owner Name',
                    'Mobile No_',
                    'Email ID',
                    'Phone No_',
                    'Fax No_',
                    'Address 1',
                    'Address 2',
                    'City',
                    'District',
                    'State');
	    $where = array('User ID' => $user_ID);
	    $OD_owners = CommunityRadio::FetchAllCommRadio($table1,$select,$where);
	    $OD_owners= json_decode(json_encode($OD_owners), true);
	    $OwnerID =@$OD_owners[0]['Owner ID'];
    	$table2= 'BOC$Vend Emp - Community Radio';
    	$select= array(
		'timestamp',
		'Community Radio ID',
		'Name',
		'Owner ID',
		'Agency Code',
		'Frequency',
		'Language',
		'GOPA Signing Date',
		'GOPA Valid upto',
		'WOL Number',
		'WOL Signing Date',
		'WOL Valid Upto',
		'Company Legal Status',
		'Cnannel Head',
		'Channel Launch Date',
		'Address',
		'City',
		'District',
		'State',
		'PIN Code',
		'Phone No_(with STD)',
		'Fax',
		'Mobile No_',
		'E-Mail',
		'HO Same Address DO',
		'HO Address',
		'HO City',
		'HO District',
		'HO State',
		'HO PIN Code',
		'HO Phone No_(with STD)',
		'HO Fax',
		'HO Mobile No_',
		'HO E-Mail',
		'OHO Same Address DO',
		'OHO Address',
		'OHO City',
		'OHO District',
		'OHO State',
		'OHO PIN Code',
		'OHO Phone No_(with STD)',
		'OHO Fax',
		'OHO Mobile No_',
		'OHO E-Mail',
		'WOL Certificate',
      	'GOPA Certificate',
      	'Fixed Point Chart',
      	'PAN Card',
      	'GST Certificate',
      	'Content Tel CD',
      	'Rate Undertaking',
      	'CRS Certificate',
      	'Acceptance',
		'Bank A_c No_',
		'A_C Holder Name',
		'Bank Name',
		'IFSC Code',
		'Bank Branch',
		'Bank A_C Address',
		'PAN',
		'GST No_',
		'ESI A_C No_',
		'ESI - No_ Of Employee',
		'EPF A_C No_',
		'EPF - No_ Of Employee',
		'FPC File Name',
		'GOPA File Name',
		'WOL File Name',
		'GST Cert File Name',
		'PAN Card File Name',
		'Content TCD File Name',
		'CRS Cert File Name',
		'Rate UT File Name',
		'Status',
        'Modification'
		);
		$where= array('Owner ID' => $OwnerID);
		$CM_radio = CommunityRadio::FetchAllCommRadio($table2,$select,$where);
	       $RadioID =@$CM_radio[0]->{'Community Radio ID'};
		//dd($RadioID->{'Community Radio ID'});
		$table3 = 'BOC$Radio Time Band';
		$select= array(
			'timestamp',
			'Weekday',
			'Start Time',
			'End Time'
		);
		$where= array(' Radio ID'=>$RadioID);
		// dd($RadioID);
		$Time_Band= CommunityRadio::FetchAllCommRadio($table3,$select,$where);
	        $response = [
            'OD_owners' => $OD_owners,
            'CM_radio' => $CM_radio,
            'Time_Band' =>$Time_Band,
           ];
            //dd($Time_Band);
          return $response;
		}

       }


