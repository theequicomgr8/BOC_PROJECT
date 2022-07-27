<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DateTime;

class wallPrintingController extends Controller
{
    use CommonTrait;

    public function companyDetails(Request $request) {
        if($request->isMethod('post')) {
                $data =DB::table('wall_painting')->select('id')->orderBy('id','desc')->first();
            if(!empty($data)) {
                $data =$data->id;
                $data++;
            }else{
                $data ="1000";
            }
            //dd($data);
            //$ownership_document_rent_agreement = '';
            $wall_print_data = DB::table('wall_painting')->where('id',$request->id)->first();
          $ownership_document_db = $wall_print_data->ownership_document_rent_agreement ?? '';
            $destinationPath = public_path() .'/uploads/CompanyDetails';
             if($request->hasFile('ownership_document_rent_agreement')) {
                    $file3= $request->file('ownership_document_rent_agreement');
                    $ownership_document_rent_agreement =time().'-'.$file3->getClientOriginalName();
                    $fileUploaded_Undertaking_file=$file3->move($destinationPath, $ownership_document_rent_agreement);
                    if($fileUploaded_Undertaking_file){
                        $ownership_document_rent_agreement=$ownership_document_rent_agreement;
                    }
              } else {
                  if($ownership_document_db !=""){
                    $ownership_document_rent_agreement =$ownership_document_db;
                  }else{
                    $ownership_document_rent_agreement ="";
                  }
                        
                     
              }
              $other_document_file_db = $wall_print_data->other_document_file ?? '';
              if($request->hasFile('other_document_file')){
                  $otherfile =$request->file('other_document_file');
                  $other_document_file_r =time().'-'.$otherfile->getClientOriginalName();
                  $otherfile_uploade =$otherfile->move($destinationPath, $other_document_file_r);
                  if($otherfile_uploade){
                    $otherfileuploade= $other_document_file_r;
                }
                } else {
                    if($other_document_file_db !=''){
                        $otherfileuploade =$other_document_file_db;
                    }else{
                        $otherfileuploade ="";
                    }
                    
                }
                $Premises_Ownership_db = $wall_print_data->Premises_Ownership_Rent_agreement ?? '';
                if($request->hasFile('Premises_Ownership_Rent_agreement')){
                    $Premises =$request->file('Premises_Ownership_Rent_agreement');
                    $Premises_Ownership_r =time().'-'.$Premises->getClientOriginalName();
                    $Premises_Ownership_uploade =$Premises->move($destinationPath,  $Premises_Ownership_r);
                    if($Premises_Ownership_uploade){
                      $Premisesuploade= $Premises_Ownership_r;
                  }
                  } else {
                      if($Premises_Ownership_db !=''){
                        $Premisesuploade =$Premises_Ownership_db;
                      }else{
                        $Premisesuploade ="";
                      }
                     
                  }
                  $purchase_invoice_db = $wall_print_data->purchase_invoice_file ?? '';
                  if($request->hasFile('purchase_invoice_file')){
                    $purchase =$request->file('purchase_invoice_file');
                    $purchase_r =time().'-'.$purchase->getClientOriginalName();
                    $purchase_uploade =$purchase->move($destinationPath,  $purchase_r);
                    if($purchase_uploade){
                      $purchaseuploade= $purchase_r;
                  }
                  } else {
                      if($purchase_invoice_db !=''){
                        $purchaseuploade =$purchase_invoice_db;
                      }else{
                        $purchaseuploade ="";
                      }
                      
                  }
                  $Copy_of_agreement_db = $wall_print_data->Copy_of_agreement_file ?? '';
                  if($request->hasFile('Copy_of_agreement')){
                    $agreement =$request->file('Copy_of_agreement');
                    $agreement_r =time().'-'.$agreement->getClientOriginalName();
                    $agreement_uploade =$agreement->move($destinationPath,  $agreement_r);
                    if($agreement_uploade){
                      $agreementuploade= $agreement_r;
                  }
                  } else {
                      if($Copy_of_agreement_db !=''){
                        $agreementuploade =$Copy_of_agreement_db;
                      }else{
                        $agreementuploade ="";
                      }
                      
                  }  
                  $copy_of_bill_db = $wall_print_data->copy_of_bill_file ?? '';       
                  if($request->hasFile('copy_of_bill')){
                    $copy_of_bill =$request->file('copy_of_bill');
                    $copy_of_bill_r =time().'-'.$copy_of_bill->getClientOriginalName();
                    $copy_of_bill_uploade =$copy_of_bill->move($destinationPath,  $copy_of_bill_r);
                    if($copy_of_bill_uploade){
                      $copy_of_billuploade= $copy_of_bill_r;
                  }
                  } else {
                      if($copy_of_bill_db !=''){
                        $copy_of_billuploade =$copy_of_bill_db;
                      }else{
                        $copy_of_billuploade ="";
                      } 
                  }
                  //get current Date and time;
                  $now = new DateTime();
                  $dat =$now->format('Y-m-d H:i:s');
             $arrt =   [
                "id" =>$data,
                "name_of_agency" =>$request->name_of_agency,
                "bid_security_declaration" =>$request->bid_security_declaration,
                "head_office_email" =>$request->head_office_telphone_email,
                "branch_telephone" =>$request->branch_telephone,
                "certificate_incorporation" =>$request->certificate_incorporation,
                "gst_certificate"=>$request->gst_certificate,
                "Pan_tan_card"=>$request->Pan_tan_card,
                "registration_startup"=>$request->registration_startup,
                "other_document" =>$request->other_document,
                "area_work_name_state_city" =>$request->area_work_name_state_city,
                "details_of_past_work_wall_painting" =>$request->details_of_past_work_wall_painting,
                "total_years_exp_wall_painting" =>$request->total_years_exp_wall_painting,
                "total_years_exp_digital_painting" =>$request->total_years_exp_digital_painting,
                "annual_turn_2019_20_wp"=>$request->annual_turn_2019_20_wp,
                "annual_turn_2019_20_dwp"=>$request->annual_turn_2019_20_dwp,
                "annual_turn_2020_21_wp"=>$request->annual_turn_2020_21_wp,
                "annual_turn_2020_21_dwp"=>$request->annual_turn_2020_21_dwp,
                "annual_turn_2021_22_wp"=>$request->annual_turn_2021_22_wp,
                "annual_turn_2021_22_dwp"=>$request->annual_turn_2021_22_dwp,
                "work_past_three_2018_19_area_of_painting"=>$request->work_past_three_2018_19_area_of_painting,
                "work_past_three_2018_19_amt_rs" =>$request->work_past_three_2018_19_amt_rs,
                "work_past_three_2018_19_wp_dwp"=>$request->work_past_three_2018_19_wp_dwp,
                "work_past_three_2018_19_area_claimed"=>$request->work_past_three_2018_19_area_claimed,
                "work_past_three_2018_19_area_gst"=>$request->work_past_three_2018_19_area_gst,
                "work_past_three_2019_20_area_of_painting"=>$request->work_past_three_2019_20_area_of_painting,
                "work_past_three_2019_20_amt_rs"=>$request->work_past_three_2019_20_amt_rs,
                "work_past_three_2019_20_wp_dwp"=>$request->work_past_three_2019_20_wp_dwp,
                "work_past_three_2019_20_area_claimed"=>$request->work_past_three_2019_20_area_claimed,
                "work_past_three_2019_20_area_gst"=>$request->work_past_three_2019_20_area_gst,
                "work_past_three_2020_21_area_of_painting"=>$request->work_past_three_2020_21_area_of_painting,
                "work_past_three_2020_21_amt_rs"=>$request->work_past_three_2020_21_amt_rs,
                "work_past_three_2020_21_wp_dwp"=>$request->work_past_three_2020_21_wp_dwp,
                "work_past_three_2020_21_area_claimed"=>$request->work_past_three_2020_21_area_claimed,
                "work_past_three_2020_21_area_gst"=>$request->work_past_three_2020_21_area_gst,
                "work_past_three_2021_22_area_of_painting"=>$request->work_past_three_2021_22_area_of_painting,
                "work_past_three_2021_22_amt_rs"=>$request->work_past_three_2021_22_amt_rs,
                "work_past_three_2021_22_wp_dwp"=>$request->work_past_three_2021_22_wp_dwp,
                "work_past_three_2021_22_area_claimed"=>$request->work_past_three_2021_22_area_claimed,
                "work_past_three_2021_22_area_gst"=>$request->work_past_three_2021_22_area_gst,
                "owner_printing_machine" =>$request->owner_printing_machine,
                "agreement_with_vendor" =>$request->agreement_with_vendor,
                "ownership_document_rent_agreement" =>$ownership_document_rent_agreement,
                "details_of_past_work_digital_painting"=>$request->details_of_past_work_digital_painting,
                "startup_certificate_wp"=>$request->startup_certificate_wp,
                "startup_certificate_dwp"=>$request->startup_certificate_dwp,
                "Tender_number"=>$request->Tender_number,
                "branch_address"=>$request->branch_address,
                "branch_email"=>$request->branch_email,
                "head_office_telephone"=>$request->head_office_telephone,
                "head_office_address"=>$request->head_office_address,
                "pan_card"=>$request->pan_card,
                "gst_number"=>$request->gst_number,
                "other_document_file"=>$otherfileuploade,
                "registration_startup_input"=>$request->registration_startup_input,
                "Premises_Ownership_Rent_agreement"=>$Premisesuploade,
                "purchase_invoice_file"=> $purchaseuploade,
                "Copy_of_agreement_file"=>$agreementuploade,
                "copy_of_bill_file"=>$copy_of_billuploade,
                "currant_date"=>$dat
                ];
                if($request->id==''){
                    $insert =DB::table('wall_painting')->insert($arrt);
                }else{
                    $insert =DB::table('wall_painting')->where('id',$request->id)->update($arrt);
                }
                
            $wall_print_data ="";
            if($insert == true) {
                $insert_id=DB::table('wall_painting')->select('id')->orderBy('id','desc')->first();
                $id=$insert_id->id;
                return redirect('wallPainting-view/'.$id)->with('msg','Information saved successfully!');
            }
        }
            return view('admin.pages.wall-painting.wall_printing_edit');
        }

    public function wallPrintinglist($id='')
    {
        $vendor=DB::table('wall_painting')
                    ->select('id','name_of_agency','bid_security_declaration','head_office_email','branch_telephone')
                    ->orderBy('id','DESC')
                    ->get();
        return view('admin.pages.wall-painting.wallPrintingList',["vendor"=>$vendor]);
    }

    public function wallPrinting_view($id = null)
    {
        $wall_print_data = DB::table('wall_painting')->select('*')->where('id',$id )->orderBy('id','DESC')->first();
        return view('admin.pages.wall-painting.wall_printing_view',["wall_print_data"=>$wall_print_data]);
    }

    public function downloadPdf($id = null)
    {
        //dd($id);
        $wall_print_data = DB::table('wall_painting')->where('id',$id )->first();
        //dd($wall_print_data);
        $pdf = PDF::loadView('admin.pages.wall-painting.wall_printing_view_pdf',["wall_print_data"=>$wall_print_data]);
        return  $pdf->download('application-form.pdf');
    }

    public function editWallpainting($id)
    {
        //dd($id);
        $wall_print_data = DB::table('wall_painting')->where('id',$id )->first();
        //dd($wall_print_data);
       return view('admin.pages.wall-painting.wall_printing_edit',["wall_print_data"=>$wall_print_data]);
       
    }

}
