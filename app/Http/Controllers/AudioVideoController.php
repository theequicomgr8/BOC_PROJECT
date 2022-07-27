<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiAudioVideoController as Audioapi;
use DB;
use Session;
use PDF;
class AudioVideoController extends Controller
{
    public function index() {
        $user_id=Session('UserID');
        $data = DB::table('BOC$Vend Emp - AV Producer$3f88596c-e20d-438c-a694-309eb14559b2')
        ->select(
        'Status as status',
        'AV Producer Type as category',
        'User ID as userid',
        'Executive Producer Name as name',
        'Branch Office as  other_category',
        'Organization Name as organization_name',
        'Office Address as office_address',
        'Residential Address Of EP as residential_address',
        'Office Phone as office_telephone_no',
        'Residential Phone as resident_telephone_no',
        'Fax as fax_noo',
        'Mobile as mobile',
        'Email ID as email',
        'Branch Office Address as have_office',
        'Contact Person at Delhi as contact_person',
        'Contact Person Phone as phone',
        'Contact Person Fax as Contact_Person_Fax',
        'Organization Registered as organization_register',
        'Org_ Type  as org_type',
        'Org_ Legal Status as org_legal_status',
        'Org_ Reg_ State as partnership_firm_state',
        'Org_ Address as partners_address',
        'Net Worth as net_worth',
        'Program Detail as details_programme',
        'Telecatst_Channel as Channel',
        'Telecast_DateTime as telecast_date',
        'TRP_Ratings as TRP',
        'Studio Address as address_studio',
        'Studio Phone as landline_no',
        'Studio Fax as fax_no',
        'Ownership_Of_Company as organization_registered',
        'No_ Of Audio-Spots_video as number_of_audio',
        'No_ For Others as government_departments',
        'Institution Name as institution_name',
        'Degree_Diploma Year as degree_year',
        'Degree_Diploma Area as degree_area',
        'List Of Award as list_of_award',
        'List Of Program as list_of_programme',
        'Social sector as social_sector',
        'Infrastructure sector as infrastructure_sector',
        'Financial Sector as finance',
        'National Integration as national_integration',
        'Defence and security as defence_national',
        'Other Information as other_relevant_information',
        'Payee Name as payee_name',
        'PAN as pan_number',
        'DD No_ as dd_no',
        'DD Bank Name as drawn_on_bank',
        'I_T Return File Name as income_tax_return',
        'Cancelled Cheque File Name as cancelled_cheque',
        'Bio-data File Name as bio_data',
        'Legal cert_ of regist_ as registration_certificate',
        'Bank Name as Bank_Name',
        'Bank Branch as Bank_Branch',
        'IFSC Code as IFSC_Code',
        'Account No_ as Account_No',
        'Modification',
        'Acceptance'
    )
        ->where('User ID', $user_id)->first();

        return view('admin.pages.fresh-empanelment-av-media-form',compact('data'));
    }

    public function first_tab_insert(Request $request)
    {
        $res=(new Audioapi)->ftab_insert($request);
        return $res;
    }

    public function final_submit(Request $request)
    {
        $res=(new Audioapi)->status_change($request);
        return $res;
    }

    public function avproducerPDF(Request $request)
    {
        $response = (new Audioapi)->get_av_pdf($request->av_code);
        $av_data = json_decode(json_encode($response), true);
        $avdatas = $av_data['original']['data'];
        //dd($avdatas);
        $pdf = PDF::loadView('admin.pages.avprint.av-pdf', compact('avdatas'));
        return $pdf->download($request->av_code . '.pdf');
    }
}
