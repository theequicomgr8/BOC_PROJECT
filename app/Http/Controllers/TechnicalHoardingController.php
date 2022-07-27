<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use PDF;

class TechnicalHoardingController extends Controller
{
    public function TechnicalHoarding(Request $request){

    	  $state =DB::table('BOC$State')->select('Code','Description')->orderBy('Description','ASC')->get();
    	  //dd($state);
    	if($request->isMethod('post')){
    		//get top id
		$data =DB::table('bid_hoarding')->select('id')->orderBy('id','desc')->first();
		if(!empty($data)){
		       $data =$data->id;
		       $data++;
		} else {
		    $data =10001;
		}

      $insert =[
	     "id"=>$data,
	     "agency_name"=>$request->agency_name,
	     "bid_security"=>$request->bid_security ?? 0,
	     "headoffice_state"=>$request->headoffice_state ,
	     "headoffice_address"=>$request->headoffice_address,
	     "headoffice_telephone"=>$request->headoffice_telephone,
	     "headoffice_email"=>$request->headoffice_email,
	     "headoffice_contact_person"=>$request->headoffice_contact_person,
	     "headoffice_owned_rented"=>$request->headoffice_owned_rented ?? 0,
	     "headoffice_electricity_bill"=>$request->headoffice_electricity_bill ?? 0,
	     "legal_document_certificate"=>$request->legal_document_certificate ?? 0,
	     "legal_document_gst_registration"=>$request->legal_document_gst_registration ?? 0,
         "gst_number" => $request->gst_number ?? '',
	     "legal_document_pan"=>$request->legal_document_pan ?? 0,
         "pan_card"=>$request->pan_card ?? '',
	     "legal_document_whether_startup"=>$request->legal_document_whether_startup ?? 0,
	     "total_years_experience"=>$request->total_years_experience,
	     "work_order_2018_19_qty_pos"=>$request->work_order_2018_19_qty_pos,
	     "work_order_2018_19_qty_hording"=>$request->work_order_2018_19_qty_hording,
	     "work_order_2018_19_amount"=>$request->work_order_2018_19_amount,
	     "work_order_2018_19_remarks"=>$request->work_order_2018_19_remarks,
	     "work_order_2019_20_qty_pos"=>$request->work_order_2019_20_qty_pos,
	     "work_order_2019_20_qty_hording"=>$request->work_order_2019_20_qty_hording,
	     "work_order_2019_20_amount"=>$request->work_order_2019_20_amount,
	     "work_order_2019_20_remarks"=>$request->work_order_2019_20_remarks,
	     "work_order_2020_21_qty_pos"=>$request->work_order_2020_21_qty_pos,
	     "work_order_2020_21_qty_hording"=>$request->work_order_2020_21_qty_hording,
	     "work_order_2020_21_amount"=>$request->work_order_2020_21_amount,
	     "work_order_2020_21_remarks"=>$request->work_order_2020_21_remarks,
	     "annual_turnover_2019_20_rs"=>$request->annual_turnover_2019_20_rs,
	     "annual_turnover_2020_21_rs"=>$request->annual_turnover_2020_21_rs,
	     "annual_turnover_startup_dpiit"=>$request->annual_turnover_2020_21_rs,
	     "flex_own_printing"=>$request->flex_own_printing ?? 0,
	     "flex_rented_printing"=>$request->flex_rented_printing ?? 0,
	     "flex_address"=>$request->flex_address,
	     "flex_remarks"=>$request->flex_remarks,
	     "legal_document_other"=>$request->legal_document_other ?? ''
      ];
      $inserted =DB::table('bid_hoarding')->insert($insert);
      if(count($request->details_authorized_state) > 0) {
      	foreach ($request->details_authorized_state as $key => $value) {
      	$authid =DB::table('details_authorized')->select('authorized_id')->orderBy('authorized_id','desc')->first();
        if(!empty($authid)){
            $authid =$authid->authorized_id;
                   $authid++;
        }else{
            $authid =101;
        }

	 $second_table =[
      "authorized_id" =>$authid,
      "bid_hording_id" =>$data,
      "details_authorized_state"=>$request->details_authorized_state[$key],
      "details_authorized_document_support"=>$request->details_authorized_document_support[$key],
      "details_authorized_geo_tagged"=>$request->details_authorized_geo_tagged[$key],
      "details_authorized_list_location"=>$request->details_authorized_geo_tagged[$key]
	 ];

  	$sectable =DB::table('details_authorized')->insert($second_table);
      	}

      }

      if(count($request->branchoffice_state) > 0){
      	foreach ($request->branchoffice_state as $key => $value) {
      		 $branchid =DB::table('branch_office')->select('branch_id')->orderBy('branch_id','desc')->first();
            if(!empty($branchid)){
                $branchid =$branchid->branch_id;
                       $branchid++;
            }else{
                $branchid =201;
            }

      $brenchtable =[
      "branch_id"=>$branchid,
      "bid_hording_id"=>$data,
      "branchoffice_state"=>$request->branchoffice_state[$key],
      "branchoffice_address"=>$request->branchoffice_address[$key],
      "branchoffice_telephone"=>$request->branchoffice_telephone[$key],
      "branchoffice_email"=>$request->branchoffice_email[$key],
      "branchoffice_contact_person"=>$request->branchoffice_contact_person[$key],
      "branchoffice_owned_rented"=>$request->branchoffice_owned_rented[$key] ?? 0,
      "branchoffice_electricity_bill"=>$request->branchoffice_electricity_bill[$key] ?? 0,
      ];

      $branch_office_table =DB::table('branch_office')->insert( $brenchtable);
      	}
      }
      $insert_id=DB::table('bid_hoarding')->select('id')->orderBy('id','desc')->first();
      $Ids =$insert_id->{'id'};
       return redirect('bidHoarding-view/'.$Ids)->with('message','Data save successfully!');
      }
     return view('admin.pages.technical-bid-hoarding.technical-bid-Hoarding',['state'=> $state]);
    }


    //listing
    public function bidHoardinglist()
    {
        $title = 'Evaluation of Technical bid for Hoarding';
        $vendor=DB::table('bid_hoarding')
                    ->select('id','agency_name','bid_security','headoffice_address','headoffice_telephone')
                    ->orderBy('id','DESC')
                    ->get();

        return view('admin.pages.technical-bid-hoarding.bidTechList',["vendor"=>$vendor, "title"=>$title]);
    }

    public function bidHoarding_view($id = null)
    {
        $dbreponse['bid_hoarding_data'] = DB::table('bid_hoarding')
                                            ->where('id',$id )
                                            ->orderBy('id','DESC')
                                            ->first();

        $dbreponse['branch_office_data'] = DB::table('branch_office')
                                            ->where('bid_hording_id',$id )
                                            ->get();

        $dbreponse['details_authorized_data'] = DB::table('details_authorized')
                                                ->where('bid_hording_id',$id )
                                                ->get();
        // dd($dbreponse);
        return view('admin.pages.technical-bid-hoarding.technical_bid_hoarding_view',$dbreponse);

    }

    public function bidHoarding_edit(Request $request, $id = null)
    {
        $dbreponse['bid_id'] = $id;
        $dbreponse['state'] =DB::table('BOC$State')->select('Code','Description')->orderBy('Description','ASC')->get();
        $dbreponse['bid_hoarding_data'] = DB::table('bid_hoarding')
                                            ->where('id',$id )
                                            ->orderBy('id','DESC')
                                            ->first();

        $dbreponse['branch_office_data'] = DB::table('branch_office')
                                            ->where('bid_hording_id',$id )
                                            ->get();

        $dbreponse['details_authorized_data'] = DB::table('details_authorized')
                                                ->where('bid_hording_id',$id )
                                                ->get();
        if($request->isMethod('post'))
        {

          $update =[
             "agency_name"=>$request->agency_name,
             "bid_security"=>$request->bid_security ?? 0,
             "headoffice_state"=>$request->headoffice_state ,
             "headoffice_address"=>$request->headoffice_address,
             "headoffice_telephone"=>$request->headoffice_telephone,
             "headoffice_email"=>$request->headoffice_email,
             "headoffice_contact_person"=>$request->headoffice_contact_person,
             "headoffice_owned_rented"=>$request->headoffice_owned_rented ?? 0,
             "headoffice_electricity_bill"=>$request->headoffice_electricity_bill ?? 0,
             "legal_document_certificate"=>$request->legal_document_certificate ?? 0,
             "legal_document_gst_registration"=>$request->legal_document_gst_registration ?? 0,
             "gst_number" => $request->gst_number ?? '',
             "legal_document_pan"=>$request->legal_document_pan ?? 0,
             "pan_card"=>$request->pan_card ?? '',
             "legal_document_whether_startup"=>$request->legal_document_whether_startup ?? 0,
             "total_years_experience"=>$request->total_years_experience,
             "work_order_2018_19_qty_pos"=>$request->work_order_2018_19_qty_pos,
             "work_order_2018_19_qty_hording"=>$request->work_order_2018_19_qty_hording,
             "work_order_2018_19_amount"=>$request->work_order_2018_19_amount,
             "work_order_2018_19_remarks"=>$request->work_order_2018_19_remarks,
             "work_order_2019_20_qty_pos"=>$request->work_order_2019_20_qty_pos,
             "work_order_2019_20_qty_hording"=>$request->work_order_2019_20_qty_hording,
             "work_order_2019_20_amount"=>$request->work_order_2019_20_amount,
             "work_order_2019_20_remarks"=>$request->work_order_2019_20_remarks,
             "work_order_2020_21_qty_pos"=>$request->work_order_2020_21_qty_pos,
             "work_order_2020_21_qty_hording"=>$request->work_order_2020_21_qty_hording,
             "work_order_2020_21_amount"=>$request->work_order_2020_21_amount,
             "work_order_2020_21_remarks"=>$request->work_order_2020_21_remarks,
             "annual_turnover_2019_20_rs"=>$request->annual_turnover_2019_20_rs,
             "annual_turnover_2020_21_rs"=>$request->annual_turnover_2020_21_rs,
             "annual_turnover_startup_dpiit"=>$request->annual_turnover_2020_21_rs,
             "flex_own_printing"=>$request->flex_own_printing ?? 0,
             "flex_rented_printing"=>$request->flex_rented_printing ?? 0,
             "flex_address"=>$request->flex_address,
             "flex_remarks"=>$request->flex_remarks,
             "legal_document_other"=>$request->legal_document_other ?? ''
          ];
          // print_r($id);die;
          $inserted =DB::table('bid_hoarding')->where('id',$id)->update($update);
          if(count($request->details_authorized_state) > 0){
            //Delete previous records.
            $delete = DB::table('details_authorized')->where('bid_hording_id', $id)->delete();
            foreach ($request->details_authorized_state as $key => $value) {
            $authid =DB::table('details_authorized')->select('authorized_id')->orderBy('authorized_id','desc')->first();

            if(!empty($authid)){
                $authid =$authid->authorized_id;
                       $authid++;

            }else{
                $authid =101;
            }

         $second_table =[
          "authorized_id" =>$authid,
          "bid_hording_id" =>$id,
          "details_authorized_state"=>$request->details_authorized_state[$key],
          "details_authorized_document_support"=>$request->details_authorized_document_support[$key],
          "details_authorized_geo_tagged"=>$request->details_authorized_geo_tagged[$key],
          "details_authorized_list_location"=>$request->details_authorized_geo_tagged[$key]
         ];

         //Insert current records
        $sectable =DB::table('details_authorized')->insert($second_table);
            }

          }



          if(count($request->branchoffice_state) > 0){
            //Delete previous records.
            $delete = DB::table('branch_office')->where('bid_hording_id', $id)->delete();

            foreach ($request->branchoffice_state as $key => $value) {
                 $branchid =DB::table('branch_office')->select('branch_id')->orderBy('branch_id','desc')->first();

                if(!empty($branchid)){
                    $branchid =$branchid->branch_id;
                           $branchid++;

                }else{
                    $branchid =201;
                }

          $brenchtable =[
          "branch_id"=>$branchid,
          "bid_hording_id"=>$id,
          "branchoffice_state"=>$request->branchoffice_state[$key],
          "branchoffice_address"=>$request->branchoffice_address[$key],
          "branchoffice_telephone"=>$request->branchoffice_telephone[$key],
          "branchoffice_email"=>$request->branchoffice_email[$key],
          "branchoffice_contact_person"=>$request->branchoffice_contact_person[$key],
          "branchoffice_owned_rented"=>$request->branchoffice_owned_rented[$key] ?? 0,
          "branchoffice_electricity_bill"=>$request->branchoffice_electricity_bill[$key] ?? 0,
          ];




          $branch_office_table =DB::table('branch_office')->insert( $brenchtable);
            }
          }
          $insert_id=DB::table('bid_hoarding')->select('id')->orderBy('id','desc')->first();
          $Ids =$insert_id->{'id'};
           return redirect('bidHoarding-view/'.$id)->with('message','Data updated successfully!');
        }

        return view('admin.pages.technical-bid-hoarding.technical-bid-Hoarding-edit',$dbreponse);

    }

    public function biddownloadPdf($id = null)
    {
        $dbreponse['bid_hoarding_data'] = DB::table('bid_hoarding')
                                            ->where('id',$id )
                                            ->orderBy('id','DESC')
                                            ->first();

        $dbreponse['branch_office_data'] = DB::table('branch_office')
                                            ->where('bid_hording_id',$id )
                                            ->get();

        $dbreponse['details_authorized_data'] = DB::table('details_authorized')
                                                ->where('bid_hording_id',$id )
                                                ->get();
        $dbreponse['pdfdown'] = 'downloadpdf';

        $pdf = PDF::loadView('admin.pages.technical-bid-hoarding.technical_bid_hoarding_view',$dbreponse);
        return  $pdf->download('application-form.pdf');
    }
}
