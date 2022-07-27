@extends('admin.layouts.wallayout')

@section('content')

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Evaluation of Technical bid for Hoarding</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
     <!--  <link href="{{ asset('theme/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
      <style>
         .container {
         width: 70%;
         height: 50%;

         }
         .form-group.col-md-12 {
             display: flex;
             align-items: center;
         }

      </style>
   </head>
   <body>
      <div class="container pt-4">
         <h4 class="text-center"><u>Evaluation of Technical bid for Hoarding</u></h4><br>
         <p>A. Detail of company<a href="{{URL::to('bidHoarding')}}" title="Home" class="pull-right"><i class="fa fa-home" style="font-size:30px;"></i></a></p>
         <form Method="post" action="{{url('/bidHoarding-edit/')}}/{{$bid_id}}" enctype="multipart/form-data" id="company_details">
         @csrf
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th class="col-1">S No.</th>
                  <th class="col-3">Description</th>
                  <th colspan ="5">Documents</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Name of Agency <font class="text-danger">*</font></td>
                  <td colspan ="5">
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" value="{{ $bid_hoarding_data->agency_name }}"  name="agency_name" placeholder="Please enter agency name" required="required" onkeypress="return onlyAlphabets(event,this)">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Bid Security declaration</td>
                  <td colspan ="5">Annexure "A" - Yes/No
                     <label class="form-check-label ml-4">
                     <input type="radio"  class="form-check-input" name="bid_security"<?php echo ($bid_hoarding_data->bid_security == 1) ? 'checked="checked"' : '' ?> value="1">Yes
                     </label>
                     <label class="form-check-label ml-4">
                     <input type="radio" class="form-check-input" name="bid_security" <?php echo ($bid_hoarding_data->bid_security == 0 || $bid_hoarding_data->bid_security == 2) ? 'checked="checked"' : '' ?>  value="2">No
                     </label>
                  </td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Head office with telephone no. & email(Ownership document of premises/ rent agreement and electricity bill of past six months)</td>
                  <td colspan ="5">
                   <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">State:</label>
                        <select class="form-control form-control-sm" name="headoffice_state">
                           <option value="">Select option</option>
                           @foreach($state as $st)
                           <option <?php echo ($bid_hoarding_data->headoffice_state == $st->Description) ? 'selected="selected"' : '' ?> value="{{$st->Description}}">{{$st->Description}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Address:</label>
                        <textarea class="form-control form-control-sm" name="headoffice_address">{{ $bid_hoarding_data->headoffice_address }}</textarea>
                    </div>
                     <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Telephone no.:</label>
                        <input type="text" class="form-control form-control-sm" name="headoffice_telephone" value="{{ $bid_hoarding_data->headoffice_telephone }}" onkeypress="return onlyNumberKey(event)" maxlength="15">
                    </div>
                     <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Email:</label>
                        <input type="email" class="form-control form-control-sm" name="headoffice_email" value="{{ $bid_hoarding_data->headoffice_email }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Contact person:</label>
                        <input type="text" class="form-control form-control-sm" name="headoffice_contact_person" value="{{ $bid_hoarding_data->headoffice_contact_person }}" onkeypress="return onlyAlphabets(event,this)" maxlength="50">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Whether electricity bill of past six months submitted:</label>
                        <label class="form-check-label ml-4">
                           <input type="radio"  class="form-check-input" name="headoffice_electricity_bill" <?php echo ($bid_hoarding_data->headoffice_electricity_bill == 1) ? 'checked="checked"' : '' ?> value="1">Yes
                           </label>
                           <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="headoffice_electricity_bill" <?php echo ($bid_hoarding_data->headoffice_electricity_bill == 0 || $bid_hoarding_data->headoffice_electricity_bill == 2) ? 'checked="checked"' : '' ?> value="2">No
                        </label>
                    </div>
                         <div class="form-group ml-3">
                        <label for="companyName" class="mr-2 col-form-label-sm">Whether head office owned or rented:</label><br />
                        <label class="form-check-label ml-4">
                           <input type="radio"  class="form-check-input" name="headoffice_owned_rented" <?php echo ($bid_hoarding_data->headoffice_owned_rented == 1) ? 'checked="checked"' : '' ?> value="1">Owned
                           </label>
                           <br />
                           <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="headoffice_owned_rented" <?php echo ($bid_hoarding_data->headoffice_owned_rented == 2) ? 'checked="checked"' : '' ?> value="2">Rented
                        </label>
                        <br />
                          <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="headoffice_owned_rented" <?php echo ($bid_hoarding_data->headoffice_owned_rented == 3) ? 'checked="checked"' : '' ?> value="3">Document not submitted
                        </label>
                    </div>
                  </td>
               </tr>
               <tr class="Branch_office_section">
                  <td>4</td>
                  <td>Branch office with tel no.Ownership document of premises/ rent agreement and electricity bill of past six months</td>
                  <td colspan="5">
                     @if (count($branch_office_data) > 0)
                        @foreach ($branch_office_data as $branch_office)
                     <div id="dynamicTable">
                     <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">State:</label>
                        <select class="form-control form-control-sm" name="branchoffice_state[]">
                           <option value="">Select option</option>
                           @foreach($state as $st)
                           <option <?php echo ($branch_office->branchoffice_state == $st->Description) ? 'selected="selected"' : '' ?> value="{{$st->Description}}">{{$st->Description}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Address:</label>
                        <textarea class="form-control form-control-sm" name="branchoffice_address[]">{{ $branch_office->branchoffice_address }}</textarea>
                    </div>
                     <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Telephone no.:</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $branch_office->branchoffice_telephone }}" name="branchoffice_telephone[]"
                        onkeypress="return onlyNumberKey(event)"  maxlength="15">
                    </div>
                     <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Email:</label>
                        <input type="email" class="form-control form-control-sm" value="{{ $branch_office->branchoffice_email }}" name="branchoffice_email[]">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Contact person:</label>
                        <input type="text" class="form-control form-control-sm" value="{{ $branch_office->branchoffice_contact_person }}" name="branchoffice_contact_person[]" onkeypress="return onlyAlphabets(event,this)" maxlength="50">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="companyName" class="mr-2 col-form-label-sm">Whether electricity bill of past six months submitted:</label>
                        <label class="form-check-label ml-4">
                           <input type="radio"  class="form-check-input" <?php echo ($branch_office->branchoffice_electricity_bill == 1) ? 'checked="checked"' : '' ?> name="branchoffice_electricity_bill[]" value="1">Yes
                           </label>
                           <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="branchoffice_electricity_bill[]" <?php echo ($branch_office->branchoffice_electricity_bill == 0) ? 'checked="checked"' : '' ?> value="0">No
                        </label>
                    </div>
                     <div class="form-group  ml-3">

                        <label for="companyName" class="mr-2 col-form-label-sm">Whether head office owned or rented:</label><br />
                        <label class="form-check-label ml-4">
                           <input type="radio"  class="form-check-input" name="branchoffice_owned_rented[]" <?php echo ($branch_office->branchoffice_owned_rented == 1) ? 'checked="checked"' : '' ?> value="1">Owned
                           </label>
                           <br />
                           <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="branchoffice_owned_rented[]"  <?php echo ($branch_office->branchoffice_owned_rented == 2) ? 'checked="checked"' : '' ?> value="2">Rented
                        </label>
                        <br />
                          <label class="form-check-label ml-4">
                           <input type="radio" class="form-check-input" name="branchoffice_owned_rented[]"  <?php echo ($branch_office->branchoffice_owned_rented == 2) ? 'checked="checked"' : '' ?> value="3">Document not submitted
                        </label>
                    </div>
                  </div>
                  @endforeach
                  @endif
                  </td>
               </tr>
                 <tr>
                  <td colspan ="7"><div name="add" id="Branch_add" class="btn btn-success float-right">Add More</div></td>
               </tr>
               <tr rowspan="2">
                  <td rowspan="6">5</td>
                  <td rowspan="6">Legal Status of company</td>
                  <th colspan ="4">Document</th>
                  <th>Yes/No</th>
               </tr>
               <tr>
                  <td colspan ="3">1. Certificate Of Incorporation:</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="legal_document_certificate" id="sel1">
                           <option <?php echo ($bid_hoarding_data->legal_document_certificate == 0) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_certificate == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_certificate == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">2. GST Registration Certificate:</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="legal_document_gst_registration" id="gst_number">
                           <option <?php echo ($bid_hoarding_data->legal_document_gst_registration == 0) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_gst_registration == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_gst_registration == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                        <br>
                        @if($bid_hoarding_data->legal_document_gst_registration == 1)
                           <input type="text" name="gst_number" class="form-control form-control-sm" id="gst_number_input" value="{{$bid_hoarding_data->gst_number}}">
                        @else
                           <input type="text" name="gst_number" class="form-control form-control-sm" id="gst_number_input" value="{{$bid_hoarding_data->gst_number}}" style="display:none;">
                        @endif
                        <span class="text-danger" id="Get_GST_Error"></span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">3. PAN/TAN Card:</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="legal_document_pan" id="pan_card">
                           <option <?php echo ($bid_hoarding_data->legal_document_pan == 0) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_pan == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_pan == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                        <br>
                        @if($bid_hoarding_data->legal_document_pan == 1)
                           <input type="text" name="pan_card" class="form-control form-control-sm" id="pan_card_input" value="{{$bid_hoarding_data->pan_card}}">
                        @else
                           <input type="text" name="pan_card" class="form-control form-control-sm" id="pan_card_input" value="{{$bid_hoarding_data->pan_card}}" style="display:none;">
                        @endif

                         <span class="text-danger" id="Get_pan_Error"></span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">4. Registration of Startup:</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="legal_document_whether_startup" id="sel1">
                           <option <?php echo ($bid_hoarding_data->legal_document_whether_startup == 0) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_whether_startup == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_whether_startup == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">5. Any Other document:</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="legal_document_other" id="sel1">
                           <option <?php echo ($bid_hoarding_data->legal_document_other == 0) ? 'selected="selected"' : '' ?>  value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_other == 1) ? 'selected="selected"' : '' ?>  value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->legal_document_other == 2) ? 'selected="selected"' : '' ?>  value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                <td>6</td>
                <td>Total years of experience in display of Hoarding in applied state/s</td>
                <td colspan ="5">
                   <div class="form-group col-md-12">
                      <label for="companyName" class="mr-2 col-form-label-sm">Dropdown:</label>
                      <select class="form-control form-control-sm" name="total_years_experience">
                         <option <?php echo ($bid_hoarding_data->total_years_experience == NULL) ? 'selected="selected"' : '' ?> value="">Select option</option>
                        <option <?php echo ($bid_hoarding_data->total_years_experience == '1 Year') ? 'selected="selected"' : '' ?> value="1 Year">1 Year</option>
                        <option <?php echo ($bid_hoarding_data->total_years_experience == '2 Years') ? 'selected="selected"' : '' ?> value="2 Years">2 Years</option>
                        <option <?php echo ($bid_hoarding_data->total_years_experience == '3 Years') ? 'selected="selected"' : '' ?> value="3 Years">3 Years</option>
                      </select>
                  </div>
                </td>
             </tr>
               <tr>
                  <td rowspan="4">7</td>
                  <td rowspan="4">Work order of past three years (Hoarding only)</td>
                  <td>F Year</td>
                  <td>Qty. of PO's</td>
                  <td>Qty. of hoardings </td>
                  <td>Amount (in rupees)</td>
                  <td>Remarks</td>
               </tr>
               <tr>
                  <td>2018-19</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2018_19_qty_pos" placeholder="Please enter Qty. of POs" value="{{ $bid_hoarding_data->work_order_2018_19_qty_pos }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2018_19_qty_hording" placeholder="Please enter Qty. of hoardings" value="{{ $bid_hoarding_data->work_order_2018_19_qty_hording }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2018_19_amount" placeholder="Please enter Amount (in rupees)" value="{{ $bid_hoarding_data->work_order_2018_19_amount }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                   <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2018_19_remarks" placeholder="Please enter Remarks" value="{{ $bid_hoarding_data->work_order_2018_19_remarks }}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2019-20</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2019_20_qty_pos" placeholder="Please enter Qty. of POs" value="{{ $bid_hoarding_data->work_order_2019_20_qty_hording }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2019_20_qty_hording" placeholder="Please enter Qty. of hoardings" value="{{ $bid_hoarding_data->work_order_2019_20_amount }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2019_20_amount" placeholder="Please enter Amount (in rupees)" value="{{ $bid_hoarding_data->work_order_2019_20_amount }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                   <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2019_20_remarks" placeholder="Please enter Remarks" value="{{ $bid_hoarding_data->work_order_2019_20_remarks }}">
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>2020-21</td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2020_21_qty_pos" placeholder="Please enter Qty. of POs" value="{{ $bid_hoarding_data->work_order_2020_21_qty_pos}}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2020_21_qty_hording" placeholder="Please enter Qty. of hoardings" value="{{ $bid_hoarding_data->work_order_2020_21_qty_hording }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2020_21_amount" placeholder="Please enter Amount (in rupees)" value="{{ $bid_hoarding_data->work_order_2020_21_amount }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10">
                     </div>
                  </td>
                    <td>
                     <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="work_order_2020_21_remarks" placeholder="Please enter Remarks" value="{{ $bid_hoarding_data->work_order_2020_21_remarks }}">
                     </div>
                  </td>

                   <tr rowspan="2">
                  <td rowspan="3">8</td>
                  <td rowspan="3">Annual turnover of FY 2019-20 and 2020-21 (notarized copy of annual return/CA certified return)</td>
                  <td colspan ="3"> FY 2019-20  </td>
                  <td colspan ="2"><input type="text" class="form-control form-control-sm" name="annual_turnover_2019_20_rs" placeholder="Please enter Rs." value="{{ $bid_hoarding_data->annual_turnover_2019_20_rs }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10"></td>
               </tr>
               <tr>
                  <td colspan ="3">FY 2020-21</td>
                  <td colspan ="2"><input type="text" class="form-control form-control-sm" name="annual_turnover_2020_21_rs" placeholder="Please enter Rs." value="{{ $bid_hoarding_data->annual_turnover_2020_21_rs }}" onkeypress="return onlyDotNumberKey(event)"  maxlength="10"></td>
               </tr>
               <tr>
                  <td colspan ="3"> If Startup, DPIIT certificate no.:</td>
                  <td colspan ="2">
                 <input type="text" class="form-control form-control-sm" name="annual_turnover_startup_dpiit" value="{{ $bid_hoarding_data->annual_turnover_startup_dpiit }}" placeholder="Please enter certificate no.">
                  </td>
               </tr>
                  <div>
                     @if (count($details_authorized_data) > 0)
                        @foreach ($details_authorized_data as $details_authorized)
                  <tr rowspan="2">
                  <td rowspan="4">9</td>
                  <td>Name of state</td>
                  <td colspan ="5"> <div class="form-group">
                        <select class="form-control form-control-sm" name="details_authorized_state[]" id="sel1">
                           <option value="">Select options</option>
                           @foreach($state as $st)
                           <option <?php echo ($details_authorized->details_authorized_state == $st->Description) ? 'selected="selected"' : '' ?> value="{{$st->Description}}">{{$st->Description}}</option>
                           @endforeach
                        </select>
                     </div>
                  </td>
               </tr>
                <tr>
                   <td rowspan="3">Details of authorized access of hoardings (state wise)
                  </td>
                 <td colspan ="3">Whether document supporting access to more than 50 hoardings submitted?</td>
                  <td colspan ="2"> <div class="form-group">
                        <select class="form-control form-control-sm" name="details_authorized_document_support[]" id="sel1">
                           <option <?php echo ($details_authorized->details_authorized_document_support == NULL) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($details_authorized->details_authorized_document_support == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($details_authorized->details_authorized_document_support == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               
               <tr>
                  <td colspan ="3">Whether Geo tagged location submitted in CD/Pendrive</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="details_authorized_geo_tagged[]" id="sel1">
                           <option <?php echo ($details_authorized->details_authorized_geo_tagged == NULL) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($details_authorized->details_authorized_geo_tagged == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($details_authorized->details_authorized_geo_tagged == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr class="Add_section">
                  <td colspan ="3">Hard copy of list of location</td>
                  <td colspan ="2">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name=" details_authorized_list_location[]" id="sel1">
                           <option <?php echo ($details_authorized->details_authorized_list_location == NULL) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($details_authorized->details_authorized_list_location == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($details_authorized->details_authorized_list_location == 3) ? 'selected="selected"' : '' ?> value="3">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               @endforeach
               @endif
            </div>
               <!-- <tr >

               </tr> -->
                <tr>
                  <td colspan ="7"><div name="add" id="add" class="btn btn-success float-right">Add More</div></td>
               </tr>
               <tr rowspan="2">
                  <td rowspan="4">10</td>
                  <td rowspan="4">Flex/vinyl printing:
                  Printing capacity of the company – Own printing machine/Vendor (Proof of own machine/vendor)
                  </td>
                  <td colspan ="3">Document supporting own printing machine submitted?</td>
                  <td colspan ="2"> <div class="form-group">
                        <select class="form-control form-control-sm" name="flex_own_printing" id="sel1">
                           <option <?php echo ($bid_hoarding_data->flex_own_printing == NULL) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->flex_own_printing == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->flex_own_printing == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div></td>
               </tr>
               <tr>
                  <td colspan ="3">Document supporting rented printing machine submitted?</td>
                  <td colspan ="3">
                     <div class="form-group">
                        <select class="form-control form-control-sm" name="flex_rented_printing" id="sel1">
                           <option <?php echo ($bid_hoarding_data->flex_rented_printing == NULL) ? 'selected="selected"' : '' ?> value="">Select options</option>
                           <option <?php echo ($bid_hoarding_data->flex_rented_printing == 1) ? 'selected="selected"' : '' ?> value="1">Yes</option>
                           <option <?php echo ($bid_hoarding_data->flex_rented_printing == 2) ? 'selected="selected"' : '' ?> value="2">No</option>
                        </select>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">Address of printing press</td>
                  <td colspan ="2">
                     <textarea class="form-control form-control-sm" name="flex_address" placeholder="Please enter address">{{ $bid_hoarding_data->flex_address}}</textarea>
                  </td>
               </tr>
               <tr>
                  <td colspan ="3">Remarks</td>
                  <td colspan ="2">
                   <textarea class="form-control form-control-sm" name="flex_remarks" placeholder="Please enter Remarks">{{ $bid_hoarding_data->flex_remarks}}</textarea>
                  </td>
               </tr>
            </tbody>
         </table>
         <div class="row">
         	<div class="form-group col-9"></div>
         	 <div class="form-group col-3">
                <input type="submit" class="form-control form-control-sm btn btn-success" name="Print" id="submit_id" placeholder="Please enter Agreement with other vendor">
            </div>
         </div>

         <form>

      </div>
@endsection @section('custom_js')
<script type="text/javascript">

   $('#pan_card').change(function (){
      var pan_card = $('#pan_card').val();

      if(pan_card == 1)
      {
         $('#pan_card_input').show();
      }
      else
      {
         $('#pan_card_input').hide();
      }

   });   


   $('#gst_number').change(function (){
      var gst_number = $('#gst_number').val();

      if(gst_number == 1)
      {
         $('#gst_number_input').show();
      }
      else
      {
         $('#gst_number_input').hide();
      }

   });

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
function emailmatch(element) {

  let branchemail =element.id;
  var value =$("#"+branchemail).val();
       
        if(value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/) || value ==''){
         // alert(1);
          return true;
        }
    
    };

$("#Get_GST_Error").hide();
$("#Get_pan_Error").hide();
 $("#Get_email_Error").hide();
$("#company_details").on('submit',function(){
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
 
 $("#company_details").on('submit',function(){
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
 
  $("#company_details").on('submit',function(){
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
 


 var i = 0;

    $("#add").click(function(){

       ++i;
        $("table tbody .Add_section").after('<tr class="row_id'+i+'" rowspan="2"><td rowspan="4">9</td><td>Name of state</td><td colspan ="5"><div class="form-group"><select class="form-control form-control-sm" name="details_authorized_state[]" id="sel1"><option value="">select option</option>@foreach($state as $st)<option value="{{$st->Description}}">{{$st->Description}}</option>@endforeach</select></div></td></tr><tr class="row_id'+i+'"><td rowspan="3">Details of authorized access of hoardings (state wise)</td><td colspan ="3">Whether document supporting access to more than 50 hoardings submitted?</td><td colspan ="2"><div class="form-group"><select class="form-control form-control-sm" name="details_authorized_document_support[]" id="sel1"><option value="">Select options</option><option value="1">Yes</option><option value="2">No</option></select></div></td></tr><tr class="row_id'+i+'"><td colspan ="3">Whether Geo tagged location submitted in CD/Pendrive</td><td colspan ="2"><div class="form-group"><select class="form-control form-control-sm" name="details_authorized_geo_tagged[]" id="sel1"><option value="">Select options</option><option value="1">Yes</option><option value="2">No</option></select></div></td></tr><tr class="row_id'+i+'" ><td colspan ="3">Hard copy of list of location</td><td colspan ="2"><div class="form-group"><select class="form-control form-control-sm" name="details_authorized_list_location[]" id="sel1"><option value="">Select options</option><option value="1">Yes</option><option value="0">No</option></select></div></td></tr><tr class="row_id'+i+'"><td colspan="7"><button type="button" class="btn btn-danger remove float-right" id="'+i+'">Remove</button></td></tr></tr>');

 });

    $(document).on('click', '.remove', function(){
         var id=$(this).attr('id');
            $(".row_id"+id).remove();
    });

    $(document).ready(function(){
      $i =0;
      $("#Branch_add").click(function(){
          i++;



         $("table tbody .Branch_office_section").after('<tr class="row'+i+'"><td>4</td><td>Branch office with tel no.  Ownership document of premises/ rent agreement and electricity bill of past six months</td><td colspan ="5"><div id="dynamicTable"><div class="form-group col-md-12"><label for="companyName" class="mr-2 col-form-label-sm">State:</label><select class="form-control form-control-sm" name="branchoffice_state[]"><option value="">Select option</option>@foreach($state as $st)<option value="{{$st->Description}}">{{$st->Description}}</option>@endforeach</select></div><div class="form-group col-md-12"><label for="companyName" class="mr-2 col-form-label-sm">Address:</label><textarea class="form-control form-control-sm" name="branchoffice_address[]"></textarea></div><div class="form-group col-md-12"><label for="companyName" class="mr-2 col-form-label-sm">Telephone no.:</label><input type="text" class="form-control form-control-sm" name="branchoffice_telephone[]" onkeypress="return onlyNumberKey(event)"  maxlength="15"></div><div class="form-group col-md-12"><label for="companyName" class="mr-2 col-form-label-sm">Email:</label><input type="email" class="form-control form-control-sm" name="branchoffice_email[]"></div><div class="form-group col-md-12"><label for="companyName" class="mr-2 col-form-label-sm">Contact person:</label><input type="text" class="form-control form-control-sm" name="branchoffice_contact_person[]" onkeypress="return onlyAlphabets(event,this)" maxlength="50"></div><div class="form-group col-md-12"<label for="companyName" class="mr-2 col-form-label-sm">Whether electricity bill of past six months submitted:</label><label class="form-check-label ml-4"><input type="radio"  class="form-check-input" name="name="branchoffice_electricity_bill[]"" value="1">Yes</label><label class="form-check-label ml-4"><input type="radio" class="form-check-input" name="name="branchoffice_electricity_bill[]"" value="0">No</label></div><div class="form-group  ml-3"><label for="companyName" class="mr-2 col-form-label-sm">Whether head office owned or rented:</label><br /><label class="form-check-label ml-4"><input type="radio"  class="form-check-input" name="branchoffice_owned_rented[]" value="1">Owned</label><br /><label class="form-check-label ml-4"><input type="radio" class="form-check-input" name="branchoffice_owned_rented[]">Rented</label><br /><label class="form-check-label ml-4"><input type="radio" class="form-check-input" name="branchoffice_owned_rented[]" value="0">Document not submitted</label></div></div></tr><tr class="row'+i+'"><td colspan="7"><button type="button" class="btn btn-danger remove-tr float-right" id="'+i+'">Remove</button></td></tr>');
      })
    })

        $(document).on("click",'.remove-tr',function(e){
            e.preventDefault();
            var id=$(this).attr('id');
            $(".row"+id).remove();
        });

</script>

@endsection
