<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Traits\CommonTrait;

class ApiAudioVideoController extends Controller
{
    use CommonTrait;
    public static function ftab_insert($request)
    {
        $request->validate([
            'name_executive_producers' => 'required',
            'email' => 'required',
        ]);
        $user_id=Session::get('UserID');
        $table='[BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2]';
        $tab1 =DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')->select('AV Producer ID')->where('User ID',$user_id)->first();
       //dd($tab1);
        if(is_null($tab1))
        {
            $category = $request->category ?? '';
            $other_category = $request->other_category ?? '0';
            $name_executive_producers = $request->name_executive_producers ?? '';
            $organization_name = $request->organization_name ?? '';
            $office_address = $request->office_address ?? '';
            $residential_address = $request->residential_address ?? '';
            $office_telephone_no = $request->office_telephone_no ?? '';
            $resident_telephone_no = $request->resident_telephone_no ?? '';
            $mobile = $request->mobile ?? '';
            $email = $request->email ?? '';
            $have_office = $request->have_office ?? '';
            $contact_person = $request->contact_person ?? '';
            $phone = $request->phone ?? '';
            $Contact_Person_Fax = $request->Contact_Person_Fax ?? '';

            $dataid=DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')->select('AV Producer ID')->where('AV Producer ID','LIKE','%'.'PRF'.'%')->orderBy('AV Producer ID','DESC')->first();

            if (empty($dataid)) {
                $id = 'PRF000001';
            } else {
                $id = $dataid->{"AV Producer ID"};
                $id++;
            }

            $user_id=Session('UserID');
            //Receiver ID
            $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
            $get_receiver_code = DB::select("select TOP 1 [AV Pro_ Empanel Landing UID] from dbo.$receiver_table");
            $recervier_id = $get_receiver_code[0]->{"AV Pro_ Empanel Landing UID"};
            $insert_array=array(
                "AV Producer Type" =>$category,
                "AV Producer ID" => $id,
                "Branch Office" => $other_category,
                "Executive Producer Name" => $name_executive_producers,
                "Organization Name" => $organization_name,
                "Office Address" => $office_address,
                "Residential Address Of EP" =>$residential_address,
                "Office Phone" =>$office_telephone_no,
                "Residential Phone" => $resident_telephone_no,
                "Fax" =>'',
                "Mobile" =>$mobile,
                "Email ID" =>$email,
                "Branch Office Address" =>$have_office,
                "Contact Person at Delhi" =>$contact_person,
                "Contact Person Phone" =>$phone,
                "Contact Person Fax" =>$Contact_Person_Fax,
                "Organization Registered" =>0,
                "Org_ Reg_ State" => '',
                "Org_ Type" => 0,
                "Org_ Legal Status" => 0,
                "Net Worth"=>0.0,
                "Studio Address" => '',
                "Studio Phone" =>'',
                "Studio Fax" => '',
                "Studio Type" =>0,
                "No_ Of Audio-Spots_video" => 0,
                "No_ For Others" =>0,
                "Institution Name" =>'',
                "Degree_Diploma Year" =>0,
                "Degree_Diploma Area" =>'',
                "List Of Award" =>'',
                "List Of Program" =>'',
                "Other Information" => '',
                "PAN" => '',
                "DD No_" =>'',
                "DD Amount"=>0.0,
                "DD Bank Name"=>'',
                "Social sector" =>0,
                "Infrastructure sector" =>0,
                "Financial Sector" =>0,
                "National Integration" =>0,
                "Defence and security" =>0,
                "Payee Name" =>'',
                "Account Type" =>0,
                "Bank Name" =>'',
                "Bank Branch" =>'',
                "IFSC Code" =>'',
                "Account No_"=>'',
                "CSC File Name" =>'',
                "I_T Return File Name" =>'',
                "Cancelled Cheque File Name" =>'',
                "Bio-data File Name" =>'',
                "Show Reel File Name" => '',
                "Org_ Address" =>'',
                "Org_ Legal Status" =>0,
                "Legal cert_ of regist_" =>'',
                "Ownership_Of_Company" =>'',
                "Telecatst_Channel" => '',
                "Telecast_DateTime" =>0000-00-00,
                "TRP_Ratings" =>'',
                "Program Detail" =>'',
                "User ID" =>$user_id,
                "Status" =>0,
                "Sender ID" =>'',
                "Receiver ID" =>$recervier_id,
                "Agr File Path" =>'',
                "Agr File Name" =>'wewe',
                "Modification" =>0,
                "Company Status Cert_" =>0,
                "I_T Return"=>0,
                "Cancelled Cheque" =>0,
                "Key Person Bio-data" =>0,
                "Show Reel Submitted" =>0,
                "Empanelment Category" =>3,
                "Global Dimension 1 Code" =>'M002',
                "Global Dimension 2 Code" =>'',
                "Agr File Path" =>'',
                "Agr File Name"=>'',
                "Alocated AVPRO Code" =>'',
                'From Date' =>'1900-01-01 00:00:00.000',
                'To Date' =>'1900-01-01 00:00:00.000',
                'Recommended To Committee' => 0,
                'Rate' => 0,
                'Acceptance'=> 0
            );
            $sql=DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insert_array);
               if($sql)
            {
                return response()->json(["msg"=>"Data Save Successfully!"]);
            }
            else
            {
                return response()->json(["msg"=>"Teshnical issues"]);
            }

        }
        else
        {
            $date=date('m/d/Y h:i:s a', time());
            $category = $request->category ?? '';
            $other_category = $request->other_category ?? 0;
            $name_executive_producers = $request->name_executive_producers ?? '';
            $organization_name = $request->organization_name ?? '';
            $office_address = $request->office_address ?? '';
            $residential_address = $request->residential_address ?? '';
            $office_telephone_no = $request->office_telephone_no ?? '';
            $resident_telephone_no = $request->resident_telephone_no ?? '';
            $mobile = $request->mobile ?? '';
            $email = $request->email ?? '';
            $have_office = $request->have_office ?? '';
            $contact_person = $request->contact_person ?? '';
            $phone = $request->phone ?? '';
            $Contact_Person_Fax = $request->Contact_Person_Fax ?? '';
            $organization_register = $request->organization_register ?? 0;
            $org_type = $request->org_type ?? 0;
            $org_legal_status = $request->org_legal_status ?? 0;
            $partnership_firm_state = $request->partnership_firm_state ?? '';
            $partners_address = $request->partners_address ?? '';
            $net_worth = $request->net_worth ?? 0.0;
            $Channel = $request->Channel ?? '';
            $telecast_date = $request->telecast_date ?? $date;
            $TRP = $request->TRP ?? '';
            $address_studio = $request->address_studio ?? '';
            $landline_no = $request->landline_no ?? '';
            $organization_registered = $request->organization_registered ?? '';
            $number_of_audio = $request->number_of_audio ?? 0;
            $government_departments = $request->government_departments ?? 0;
            $institution_name = $request->institution_name ?? '';
            $degree_year = $request->degree_year ?? 0;
            $degree_area = $request->degree_area ?? '';
            $list_of_award = $request->list_of_award ?? '';
            $list_of_programme = $request->list_of_programme ?? '';
            $social_sector = $request->social_sector ?? 0;
            $infrastructure_sector = $request->infrastructure_sector ?? 0;
            $finance = $request->finance ?? 0;
            $national_integration = $request->national_integration ?? 0;
            $defence_national = $request->defence_national ?? 0;
            $other_relevant_information = $request->other_relevant_information ?? '';
            $payee_name = $request->A_C_Holder_name ?? '';
            $pan_number = $request->PAN_No ?? '';
            $dd_no = $request->dd_no ?? '';
            $drawn_on_bank = $request->drawn_on_bank ?? '';
            $details_programme=$request->details_programme ?? '';
            $IFSC_code =$request->IFSC_code ?? '';
            $Bank_account_number =$request->Bank_account_number ?? '';
            $Bank_name =$request->Bank_name ?? '';
            $Branch_name =$request->Branch_name ?? '';
            $destinationPath = public_path() . '/uploads/audio/';
            $ITReturn = 0;
            $CancelledChequeNum = 0;
            $PersonBioData = 0;
            $Org_LegalStatus = 0;
            if($request->hasfile('income_tax_return') || $request->hasfile('income_tax_return_modify'))
            {
                $file = $request->file('income_tax_return') ?? $request->file('income_tax_return_modify');
                $income_tax_return = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $income_tax_return);
                if ($file_uploaded) {
                    $ITReturn = 1;
                } else {
                    $income_tax_return = '';
                }
            }else {
                $income_tax_return = '';
            }

            if($request->hasfile('cancelled_cheque') || $request->hasfile('cancelled_cheque_modify'))
            {
                $file = $request->file('cancelled_cheque') ?? $request->file('cancelled_cheque_modify');
                $cancelled_cheque = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $cancelled_cheque);
                if ($file_uploaded) {
                    $CancelledChequeNum = 1;
                } else {
                    $cancelled_cheque = '';
                }
            }else {
                $cancelled_cheque = '';
            }

            if($request->hasfile('bio_data') || $request->hasfile('bio_data_modify'))
            {
                $file = $request->file('bio_data') ?? $request->file('bio_data_modify');
                $bio_data = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $bio_data);
                if ($file_uploaded) {
                    $PersonBioData = 1;
                } else {
                    $bio_data = '';
                }
            }else {
                $bio_data = '';
            }

            if($request->hasfile('registration_certificate') || $request->hasfile('registration_certificate_modify'))
            {
                $file = $request->file('registration_certificate') ?? $request->file('registration_certificate_modify');
                $registration_certificate = time() . '-' . $file->getClientOriginalName();
                $file_uploaded = $file->move($destinationPath, $registration_certificate);
                if ($file_uploaded) {
                    $Org_LegalStatus = 1;
                } else {
                    $registration_certificate = '';
                }
            }else {
                $registration_certificate = '';
            }

            if(isset($request->Acceptance)){
                $Acceptance =1;
            }else{
                $Acceptance =0;
            }

            $sql =  DB::update("UPDATE $table set
                [AV Producer Type] = '".$category."',
                [Branch Office]=  '".$other_category."',
                [Executive Producer Name] = '".$name_executive_producers."',
                [Organization Name] = '".$organization_name."',
                [Office Address] = '".$office_address."',
                [Residential Address Of EP] = '".$residential_address."',
                [Office Phone]   = '".$office_telephone_no."',
                [Residential Phone]= '".$resident_telephone_no."',
                [Fax]= '',
                [Mobile]= '".$mobile."',
                [Email ID]= '".$email."',
                [Branch Office Address]= '".$have_office."',
                [Contact Person at Delhi]= '".$contact_person."',
                [Contact Person Phone]= '".$phone."',
                [Contact Person Fax]= '".$Contact_Person_Fax."',
                [Organization Registered]= '".$organization_register."',
                [Org_ Type] = '".$org_type."',
                [Org_ Legal Status] = '".$org_legal_status."',
                [Org_ Reg_ State]='".$partnership_firm_state."',
                [Org_ Address] = '".$partners_address."',
                [Net Worth]= '".$net_worth."',
                [Telecatst_Channel]='".$Channel."',
                [Telecast_DateTime]='".$telecast_date."',
                [TRP_Ratings]='".$TRP."',
                [Studio Address]='".$address_studio."',
                [Studio Phone]= '".$landline_no."',
                [Studio Fax]='',
                [Ownership_Of_Company]='".$organization_registered."',
                [No_ Of Audio-Spots_video]='".$number_of_audio."',
                [No_ For Others]='".$government_departments."',
                [Institution Name]='".$institution_name."',
                [Degree_Diploma Year]='".$degree_year."',
                [Degree_Diploma Area]='".$degree_area."',
                [List Of Award]='".$list_of_award."',
                [List Of Program]='".$list_of_programme."',
                [Social sector]= '".$social_sector."',
                [Infrastructure sector]= '".$infrastructure_sector."',
                [Financial Sector]= '".$finance."',
                [National Integration]= '".$national_integration."',
                [Defence and security]= '".$defence_national."',
                [Other Information]='".$other_relevant_information."',
                [Payee Name]='".$payee_name."',
                [PAN]='".$pan_number."',
                [Bank Name] ='".$Bank_name."',
                [Bank Branch] ='".$Branch_name."',
                [IFSC Code] ='".$IFSC_code."',
                [Account No_]='".$Bank_account_number."',
                [DD No_]='".$dd_no."',
                [DD Bank Name]='".$drawn_on_bank."',
                [I_T Return File Name]= '".$income_tax_return."',
                [Cancelled Cheque File Name]= '".$cancelled_cheque."',
                [Bio-data File Name]= '".$bio_data."',
                [Program Detail]='".$details_programme."',
                [Legal cert_ of regist_]='".$registration_certificate."',
                [Acceptance]        =$Acceptance,
                [I_T Return]=$ITReturn,
                [Cancelled Cheque]=$CancelledChequeNum,
                [Key Person Bio-data]=$PersonBioData,
                [Legal Cert_ of Reg] =$Org_LegalStatus
                where [User ID] ='".$user_id."' "
            );
            if($sql)
            {
                return response()->json(["msg"=>"Data Save Successfully!"]);
            }
            else
            {
                return response()->json(["msg"=>"Teshnical issues"]);
            }
            // [Defence and national]= '".$defence_national."', 279
        }

        // [List Of Program]='".$details_programme."',155
        // [Degree_Diploma Year]='".$request->degree_year."',
        // [Social sector]= '".$request->social_sector."', integer
        // [Telecast_DateTime]='".$telecast_date."', 250
        // [Legal cert_ of regist_]='".$registration_certificate."'
        // [I_T Return File Name]= '".$income_tax_return."',
        //         [Cancelled Cheque File Name]= '".$cancelled_cheque."',
        //         [Bio-data File Name]= '".$bio_data."'
        // [Telecast_DateTime]='".$telecast_date."',
    }

    public function status_change($request)
    {
        $user_id = Session('UserID');
        $av_id = DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')->select('AV Producer ID')->where('User ID',$user_id)->first();
        //dd($av_id->{'AV Producer ID'});
        $table='[BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2]';
        $sql =  DB::update("UPDATE $table set
                [Modification] = '1'
            where [User ID] ='".$user_id."' ");
        if($this->ftab_insert($request) == true){
             return response()->json(['msg'=>'Data Save Successfully! Please note the '.$av_id->{'AV Producer ID'}.' reference number for future use.']);
         }else {
            return response()->json(['msg'=>'Some Error Occurred!.']);
        }
    }

    public function get_av_pdf($user_id)
    {
        $data = DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')->select('*')->where('User ID',$user_id)->first();
        if($data){
            unset($data->timestamp);
            return $this->sendResponse($data, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
        }
    }


}
