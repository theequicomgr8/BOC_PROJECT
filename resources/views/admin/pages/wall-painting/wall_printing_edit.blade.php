@extends('admin.layouts.wallayout')

@section('content')

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Wall Painting</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
         .container {
         width: 70%;
         height: 50%;
         }
         .fa-check {
            color: green;
         }
      </style>
   </head>
   <body>

      <div class="container pt-4">
         <h6 class="text-center"><u>Evaluation of technical bid for wall painting / Digital wall painting</u></h6><br>
         <p>A. Detail of company<a href="{{URL::to('wallPainting')}}" title="Home" class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a></p>
         <form Method="post" action="{{url('/wall-painting')}}" enctype="multipart/form-data" id="wall_painting_details">
         @csrf
         <input type="hidden" name="id" value="{{ @$wall_print_data->id ?? ''}}">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th class="col-1">S No.</th>
                  <th class="col-3">Description</th>
                  <th colspan ="4">Documents</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Tender number <font class="text-danger">*</font></td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm"  name="Tender_number" placeholder="Please enter tender number"  required maxlength="10" value="{{ @$wall_print_data->Tender_number ?? ''}}"  onkeypress="return isAlphaNumeric(event)">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Name of Agency</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm"  name="name_of_agency" placeholder="Please enter agency name"  maxlength="50" 
                        value="{{ @$wall_print_data->name_of_agency ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Bid Security declaration</td>
                  <td colspan ="4">Annexure "A" - Yes/No
                   <label class="form-check-label ml-4">
                     <input type="radio"  class="form-check-input" name="bid_security_declaration" value="1"  {{ @$wall_print_data->bid_security_declaration == 1 ? "checked" : "" }}>Yes
                     </label>
                     <label class="form-check-label ml-4">
                     <input type="radio" class="form-check-input" name="bid_security_declaration" value="0"  {{ @$wall_print_data->bid_security_declaration == 0 ? "checked"  : "" }}>No
                  </label>
                  </td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Head office email</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="email" name="head_office_telphone_email" maxlength="50" class="form-control form-control-sm" placeholder="Please enter head office email id" value="{{ @$wall_print_data->head_office_email ?? ''}}">
                     </div>
                     <br />
                  <div class="form-group">
                        <input type="text" name="head_office_telephone" onkeypress="return onlyNumberKey(event,this)" class="form-control form-control-sm" placeholder="Please enter head office tel no." maxlength="15" value="{{@@$wall_print_data->head_office_telephone ?? ''}}">
                     </div>
                     <br />
                     <div class="form-group">
                        <textarea name="head_office_address" rows="4" cols="50" class="form-control form-control-sm"  placeholder = "Enter head Office address" maxlength="100">{{@@$wall_print_data->head_office_address ?? ''}}</textarea>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>5</td>
                  <td>Ownership documents premises / rent agreement and electricity bill of past six months</td>
                  <td colspan ="4">
                  <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="ownership_document_rent_agreement" id="ownership_document_rent_agreement">
                            <label class="custom-file-label" id="ownership_document_rent_agreement2" for="ownership_document_rent_agreement">
                               {{@$wall_print_data->ownership_document_rent_agreement ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="ownership_document_rent_agreement3">Upload</span>
                        </div>
                        @if(!empty(@$wall_print_data->ownership_document_rent_agreement))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->ownership_document_rent_agreement}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                        @endif
                         </div>
                        <span id="ownership_document_rent_agreement1" class="error invalid-feedback"></span>
                 </div>
                  </td>
               </tr>
               <tr>
                  <td>6</td>
                  <td>Branch office address with telephone no.</td>
                  <td colspan ="4">
                  <div class="form-group">
                        <input type="email" name="branch_email"  class="form-control form-control-sm" placeholder="Please enter Branch Email" maxlength="40" value="{{@$wall_print_data->branch_email ?? ''}}">
                     </div>
                     <br />
                  <div class="form-group">
                        <input type="text" name="branch_telephone" onkeypress="return onlyNumberKey(event,this)" class="form-control form-control-sm" placeholder="Please enter Branch tel no." maxlength="15" value="{{@$wall_print_data->branch_telephone ?? ''}}">
                     </div>
                     <br />
                     <div class="form-group">
                        <textarea name="branch_address" rows="4" cols="50" class="form-control form-control-sm"  placeholder = "Enter branch address" maxlength="100">{{@$wall_print_data->branch_address ?? ''}}</textarea>
                     </div>
                     
                  </td>
               </tr>
               <tr rowspan="2">
                  <td rowspan="6">7</td>
                  <td rowspan="6">Legal Status of company</td>
                  <th colspan ="2">Document</th>
                  <th colspan ="2">Yes/No</th>
               </tr>
               <tr>
                  <td>1. Certificate of Incorporation:</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="certificate_incorporation" id="sel1">
                           <option value="">Select options</option>
                           <option value="1" {{@$wall_print_data->gst_certificate == 1 ? "selected" :""}}>Yes</option>
                           <option value="0" {{@$wall_print_data->gst_certificate == 0 ? "selected" :""}}>No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2. GST Registration Certificate:</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="gst_certificate" id="gst_certificate">
                           <option value="">Select options</option>
                           <option value="1" {{@$wall_print_data->gst_certificate == 1 ? "selected" : ""}}>Yes</option>
                           <option value="0"  {{@$wall_print_data->gst_certificate == 0 ? "selected" : ""}}>No</option>
                        </select>
                       
                        <br />
                        <input type="text" name="gst_number" class="form-control form-control-sm" id="gst_number_input" style="display:none;" value="{{@$wall_print_data->gst_number ?? ''}}">
                        <span class="text-danger" id="Get_GST_Error"></span>
                       
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>3. PAN/TAN Card:</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="Pan_tan_card" id="Pan_tan_card">
                           <option value="">Select options</option>
                           <option value="1" {{@$wall_print_data->Pan_tan_card == 1 ? "selected" : ""}}>Yes</option>
                           <option value="0" {{@$wall_print_data->Pan_tan_card == 0 ? "selected" : ""}}>No</option>
                        </select>
                       
                        <br>
                        <input type="text" name="pan_card" class="form-control form-control-sm" id="pan_card_input" style="display:none;" value="{{@$wall_print_data->pan_card ?? ''}}">
                        <span class="text-danger" id="Get_pan_Error"></span>
                      
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>4. Registration of Startup:</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="registration_startup" id="registration_startup">
                           <option value="">Select options</option>
                           <option value="1" {{ @$wall_print_data->registration_startup == 1 ? "selected" : "" }}>Yes</option>
                           <option value="0" {{ @$wall_print_data->registration_startup == 0 ? "selected" : "" }}>No</option>
                        </select>
                        
                        <br>
                        <input type="text" name="registration_startup_input" class="form-control form-control-sm" id="registration_startup_input"  style="display:none;" value="{{@$wall_print_data->registration_startup_input ?? ''}}" maxlength="15" value="" onkeypress="return isAlphaNumeric(event)">
                        <span class="text-danger" id="Get_pan_Error"></span>
                      
                     </div>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>5. Any Other document:</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="other_document" id="other_document">
                           <option value="">Select options</option>
                           <option value="1" {{ @$wall_print_data->other_document == 1 ? "selected" :""}}>Yes</option>
                           <option value="0" {{ @$wall_print_data->other_document == 0 ? "selected" :""}}>No</option>
                        </select>
                      
                        <br />
                        <div class="form-group" id="other_document_file_input" style="display:none;">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="other_document_file" id="other_document_file">
                            <label class="custom-file-label" id="other_document_file2" for="other_document_file">
                            {{@$wall_print_data->other_document_file ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="other_document_file3">Upload</span>
                        </div>
                        @if(!empty(@$wall_print_data->other_document_file))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->Premises_Ownership_Rent_agreement}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                            @endif
                        </div>
                        <span id="other_document_file1" class="error invalid-feedback"></span>
                 </div>
              
               </div>
                  </td>
               </tr>
               <tr>
                  <td>8</td>
                  <td>Area of work (name of state/city)</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="area_work_name_state_city" placeholder="Please enter Area of work (name of state/city)" onkeypress="return onlyAlphabets(event,this)" maxlength="50" value="{{ @$wall_print_data->area_work_name_state_city ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">9</td>
                  <td rowspan="2">Details of past work executed (state wise)- 50,0000 sq.ft each state for wall painting</td>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="details_of_past_work_wall_painting" placeholder="Please enter Wall painting"  maxlength="50" value="{{ @$wall_print_data->details_of_past_work_wall_painting ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="details_of_past_work_digital_painting" placeholder="Please enter Digital wall painting"  maxlength="50" 
                        value="{{ @$wall_print_data->details_of_past_work_digital_painting ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">10</td>
                  <td rowspan="2">Total Year of experience in wall painting / Digital Wall Painting in applied state</td>
                  <td colspan="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event,this)" maxlength="50" name="total_years_exp_wall_painting" placeholder="Please enter year of experience in wall painting" value="{{ @$wall_print_data->details_of_past_work_wall_painting ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="4">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="total_years_exp_digital_painting" placeholder="Please enter year of experience in digital wall painting" onkeypress="return onlyNumberKey(event,this)" maxlength="50" value="{{@$wall_print_data->total_years_exp_digital_painting ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="12">11</td>
                  <td rowspan="12">Annual turn over of FY 2019-20 and 2020-21 (notarized copy of annual return / CA certified return)</td>
                  <td rowspan="3">a. FY 2019-20</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2019_20_wp" class="form-control form-control-sm" placeholder="Please enter Rs."  onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{ @$wall_print_data->annual_turn_2019_20_wp ?? ''}}"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2019_20_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{ @$wall_print_data->annual_turn_2019_20_dwp ?? ''}}"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2020-21</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2020_21_wp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->annual_turn_2020_21_wp ?? ''}}"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2020_21_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->annual_turn_2020_21_dwp ?? ''}}"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">b. FY 2021-22</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2021_22_wp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->annual_turn_2021_22_wp ?? ''}}"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" name="annual_turn_2021_22_dwp" class="form-control form-control-sm" placeholder="Please enter Rs."
                     	 onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->annual_turn_2021_22_dwp ?? ''}}"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="3">c. If start-up, DPIIT Certificate no.</td>
               <tr>
                  <td colspan="2">WP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" class="form-control form-control-sm" name="startup_certificate_wp" placeholder="Please enter Rs." onkeypress="return isAlphaNumeric(event)" maxlength="80" value="{{@$wall_print_data->startup_certificate_wp ?? ''}}"></div>
                  </td>
               </tr>
               </tr>
               <tr>
                  <td colspan="2">DWP</td>
                  <td colspan="2">
                     <div class="form-group"><input type="text" class="form-control form-control-sm"  name="startup_certificate_dwp" placeholder="Please enter Rs."
                     onkeypress="return isAlphaNumeric(event)" maxlength="80" value="{{@$wall_print_data->startup_certificate_dwp ?? ''}}"></div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="5">12</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Of Painting (in sq.ft)</td>
                  <td>Amount in Rs.</td>
                  <td>WP/DWP not specified</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2018_19_area_of_painting ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_amt_rs" placeholder="Please enter Amount in Rs." onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2018_19_amt_rs ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_wp_dwp" placeholder="Please enter WP/DWP not specified" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2018_19_wp_dwp ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2019_20_area_of_painting ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_amt_rs" placeholder="Please enter Amount in Rs." onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2019_20_amt_rs ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_wp_dwp" placeholder="Please enter WP/DWP not specified" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2019_20_wp_dwp ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2020_21_area_of_painting ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_amt_rs" placeholder="Please enter Amount in Rs." onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2020_21_amt_rs ?? ''}}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_wp_dwp" placeholder="Please enter WP/DWP not specified" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2020_21_wp_dwp ?? ''}}">
                     </div>
                  </td>
               </tr>
               <td>2021-22</td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_of_painting" placeholder="Please enter Area Of Painting (in sq.ft)" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2021_22_area_of_painting ?? ''}}">
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_amt_rs" placeholder="Please enter Amount in Rs." onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2021_22_amt_rs ?? ''}}">
                  </div>
               </td>
               <td>
                  <div class="form-group">
                     <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_wp_dwp" placeholder="Please enter WP/DWP not specified" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2021_22_wp_dwp ?? ''}}">
                  </div>
               </td>
               </tr>
               <tr>
                  <td rowspan="5">13</td>
                  <td rowspan="5">work order of past three years (wall painting only)</td>
                  <td>F Year</td>
                  <td>Area Claimed as painted</td>
                  <td colspan="2">Area marked with GST</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_claimed" placeholder="Please enter Area Claimed as painted" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2018_19_area_claimed ?? ''}}">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2018_19_area_gst" placeholder="Please enter area marked with GST" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2018_19_area_gst ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_claimed" placeholder="Please enter Area Claimed as painted" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2019_20_area_claimed ?? ''}}">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2019_20_area_gst" placeholder="Please enter area marked with GST" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2019_20_area_gst ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_claimed" placeholder="Please enter Area Claimed as painted" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2020_21_area_claimed ?? ''}}">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2020_21_area_gst" placeholder="Please enter area marked with GST" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2020_21_area_gst ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2021-22</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_claimed" placeholder="Please enter Area Claimed as painted" onkeypress="return onlyNumberKey(event)" maxlength="80"
                        value="{{@$wall_print_data->work_past_three_2021_22_area_claimed ?? ''}}">
                     </div>
                  </td>
                  <td colspan="2">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_past_three_2021_22_area_gst" placeholder="Please enter area marked with GST" onkeypress="return onlyNumberKey(event)" maxlength="80" value="{{@$wall_print_data->work_past_three_2021_22_area_gst ?? ''}}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td rowspan="2">14</td>
                  <td rowspan="2">Painting Printing capacity of the company - Own Printing machine /Vendor (Proof of own machine / Vendor)</td>
                  <td>Own Printing machine:<br />
                     <b>a.</b> Premises Ownership/Rent agreement<br />
                     <b>b.</b> Machine details with purchase invoice
                  </td>
                  <td colspan="3">

                  <span class="text-warning">Please upload first two pages of agreement</span>
                  <br />
                  <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" 
                            name="Premises_Ownership_Rent_agreement" id="Premises_Ownership_Rent_agreement">
                            <label class="custom-file-label" id="Premises_Ownership_Rent_agreement2" for="Premises_Ownership_Rent_agreement">
                               {{@$wall_print_data->purchase_invoice_file ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="Premises_Ownership_Rent_agreement3">Upload</span>
                        @if(!empty(@$wall_print_data->Premises_Ownership_Rent_agreement))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->Premises_Ownership_Rent_agreement}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                        @endif
                        </div>
                        </div>
                        <span id="Premises_Ownership_Rent_agreement1" class="error invalid-feedback"></span>
                 </div>
               </div>
               <br />
               <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="purchase_invoice_file" id="purchase_invoice_file">
                            <label class="custom-file-label" id="purchase_invoice_file2" for="purchase_invoice_file">
                            {{@$wall_print_data->purchase_invoice_file ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="purchase_invoice_file3">Upload</span>
                        @if(!empty(@$wall_print_data->purchase_invoice_file))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->purchase_invoice_file}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                        @endif
                        </div>
                        </div>
                        <span id="purchase_invoice_file1" class="error invalid-feedback"></span>
                 </div>
               </div>
                  </td>
               </tr>
               <tr>
                  <td>Agreement with other vendor: <br />
                     <b> a.</b> Copy of agreement <br />
                     <b> b.</b> copy of bill
                  </td>
                  <td colspan="3">
                  <span class="text-warning">Please upload first two pages of agreement</span>
                  <br />
                  <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" 
                            name="Copy_of_agreement" id="Copy_of_agreement">
                            <label class="custom-file-label" id="Copy_of_agreement2" for="Copy_of_agreement">
                            {{@$wall_print_data->Copy_of_agreement_file ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="Copy_of_agreement3">Upload</span>
                        </div>
                        @if(!empty(@$wall_print_data->Copy_of_agreement_file))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->Copy_of_agreement_file}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                        @endif
                        </div>
                        <span id="Copy_of_agreement1" class="error invalid-feedback"></span>
                 </div>
               </div>
               <br />
               <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="copy_of_bill" id="copy_of_bill">
                            <label class="custom-file-label" id="copy_of_bill2" for="copy_of_bill">
                            {{@$wall_print_data->copy_of_bill_file ?? "Choose file"}}</label>
                          </div>
                          <div class="input-group-append">
                        <span class="input-group-text" id="copy_of_bill3">Upload</span>
                        </div>
                        @if(!empty(@$wall_print_data->copy_of_bill_file))
                        <div class="input-group-append">
                              <span class="input-group-text"><a href="{{ url('/uploads') }}/CompanyDetails/{{@$wall_print_data->copy_of_bill_file}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                            </div>
                        @endif
                        </div>
                        <span id="copy_of_bill1" class="error invalid-feedback"></span>
                 </div>
               </div>
                  </td>
               </tr>
            </tbody>
         </table>
         <div class="row">
         	<div class="form-group col-9"></div>
         	 <div class="form-group col-3">
                <input type="submit" class="form-control form-control-sm btn btn-success" value="{{@$wall_print_data->id ? 'Update':'Submit'}}">
            </div>
         </div>

         <form>
      </div>
      @endsection
      @section('custom_js')
<script type="text/javascript">

$('#Pan_tan_card').change(function (){
   var pan_card = $('#Pan_tan_card').val();
   if(pan_card == 1)
   {
      $('#pan_card_input').show();
   }
   else
   {
      $('#pan_card_input').hide();
   }
});


$('#gst_certificate').change(function (){
   var gst_number = $('#gst_certificate').val();
   if(gst_number == 1)
   {
      $('#gst_number_input').show();
   }
   else
   {
      $('#gst_number_input').hide();
   }

});
$('#other_document_file_input').hide();
$('#other_document').change(function (){
   
   var other_document = $('#other_document').val();
   if(other_document == 1)
   {
      $('#other_document_file_input').show();
   }
   else
   {
      $('#other_document_file_input').hide();
   }

});


$('#registration_startup').change(function (){
   
   var other_document = $('#registration_startup').val();
   if(other_document == 1)
   {
      $('#registration_startup_input').show();
   }
   else
   {
      $('#registration_startup_input').hide();
   }

});

$("#Get_GST_Error").hide();
$("#Get_pan_Error").hide();
 $("#Get_email_Error").hide();
$("#wall_painting_details").on('submit',function(){
 let x = $("#gst_number_input").val();
  let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/;

  
  if (x.match(regTest) || x =='') {
    $("#Get_GST_Error").hide()
    return true;
  }else{
    $("#Get_GST_Error").show()
     $("#Get_GST_Error").text("Invalid GST No.");
    return false;
  }
 
})
 
 $("#wall_painting_details").on('submit',function(){
  let y =$("input[name='pan_card']").val(); 
  var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;
  if(y.match(regExp) || y ==''){
     $("#Get_pan_Error").hide()
     return true;
   }else{

     $("#Get_pan_Error").show()
      $("#Get_pan_Error").text("Invalid Pan No.");
     return false;
   }
})
 
  $("#wall_painting_details").on('submit',function(){
  let z =emailmatch(element);
 
  if(z == true || y ==''){
     $("#Get_email_Error").hide();
     return true;
   }else{
     $("#Get_email_Error").show()
      $("#Get_email_Error").text("Invalid Email Address.");
     return false;
   }
})

///alpha numeric
// validation for Alphanumeric only
function isAlphaNumeric(e) {
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || k == 0 ||(k== 32));
}
function onlyNumberKey(evt) {

 // Only ASCII character in that range allowed
 var ASCIICode = (evt.which) ? evt.which : evt.keyCode
 if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
     return false;
 return true;
}
function onlyAlphabets(e, t) {
 try {
     if (window.event) {
         var charCode = window.event.keyCode;
     } else if (e) {
         var charCode = e.which;
     } else {
         return true;
     }
     if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
         return true;
     else
         return false;
 } catch (err) {
     alert(err.Description);
 }
}

function onlyDotNumberKey(evt) {
 var ASCIICode = (evt.which) ? evt.which : evt.keyCode
 if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
     return false;
 return true;
}

//email validation formate
function validateEmail(email) {
alert(1);
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
return regex.test(email);
}
	function onlyNumberKey(evt) {
    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}


   ////////////// file upload size  512kb ////////////////
   $(document).ready(function () {
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    var nolimit = '';
    if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
      nolimit = id;
    }
    if (file != '' && (sizemb <= 2 || nolimit != '') && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#" + id + 4).show();
      $("#" + id + 1).hide();
      if ($("#doc_data").val() == '') {
        $("#doc_data").val(file);
      } else {
        var names = $("#doc_data").val();
        var numbersArray = names.split(',');

        if (isInArray(file, numbersArray) == false) {
          $("#doc_data").val(function () {
            return $("#doc_data").val() + ',' + file;
          });
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id + 1).hide();
        } else {
          var namess = $("#doc_data").val();
          var numbersArray1 = namess.split(',');
          numbersArray1 = $.grep(numbersArray1, function (value) {
            return value != file1;
          });
          $("#doc_data").val(numbersArray1);
          $("#" + id).val('');
          $("#" + id + 2).text("Choose file");
          $("#" + id + 3).html("Upload").addClass("input-group-text");
          $("#" + id + 1).text('File already selected!');
          $("#" + id + 1).show();
          $("#" + id + "-error").addClass("hide-msg");
        }
      }
    } else {
      $("#" + id).val('');
      $("#" + id + 2).text("Choose file");
      $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
      $("#" + id + 4).hide();
    }
  });
});


function show(){
var gst_certificate =$("#gst_certificate").val();
var Pan_tan_card =$("#Pan_tan_card").val();
var registration_startup =$("#registration_startup").val();
var other_document =$("#other_document").val();
if(gst_certificate == 1){
   $("#gst_number_input").show();
}else{
   $("#gst_number_input").hide();
}

if(Pan_tan_card == 1){
   $("#pan_card_input").show();
}else{
   $("#pan_card_input").hide();
}

if(registration_startup == 1){
   $("#registration_startup_input").show();
}else{
   $("#registration_startup_input").hide();
}

if(other_document == 1){
   $("#other_document_file_input").show();
}else{
   $("#other_document_file_input").hide();
}
}
show();
</script>
   </body>
</html>
@endsection
