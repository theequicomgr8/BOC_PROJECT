@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection

<style>
  a.disabled {
    pointer-events: none;
    color: #ccc;
  }

  .error {
    color: red;
    font-size: 14px;
  }

  input[type=radio] {
    width: 20px;
    height: 20px;
  }
</style>
@section('content')
@php

$owner_data_only =$owner_data_only ?? [1];

$owner_data=!empty($owner_data) ? $owner_data : [1];

$OD_work_dones_data=$OD_work_dones_data ?? [1];
$OD_media_address_data=Session::get('OD_media_address_data') ?? [1];
$vendor_data =$vendor_data ?? [1];
//dd($vendor_data[0]['Legal Doc File Name']);

$ODMFO_Billing_Amount= Session::get('ODMFO_Billing_Amount');
$readonly = '';
$disabled = '';
$checked = '';
$Self_Dec='';
$media_id =@$vendor_data[0]['OD Media ID'];
if(@$vendor_data[0]['OD Media ID'] != '')
if(@$vendor_data[0]['Status'] == 1 && $media_id !='')
{
$disabled = 'disabled';
$readonly = 'readonly';
$checked = 'checked';
$Self_Dec = $vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
}



@endphp


<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-normal text-primary">Empanelment-Outdoor Personal Media</h4>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="alert alert-success text-center" style="display: none;"></div>
      <div class="alert alert-danger text-center" style="display: none;"></div>

      <!-- /.end card-header -->
      <form method="POST" id="personal_media">
        @csrf
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="#tab1">Basic Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab2">Outdoor Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab3">Account Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab4">Upload Document</a>
          </li>
        </ul>

        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <!-- your steps content here -->
            @php
            $ownerid=[];
            @endphp
            @foreach($owner_data as $ownerlist)

            <div class="row" id="details_of_owners">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="owner_name">Publication Name / प्रकाशन का
                    नाम<font color="red">*</font></label>
                  <p>
                    <input type="text" name="owner_name[]" id="owner_name0" placeholder="Enter Publication Name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']??  ''}}" {{$disabled}}>
                    <span id="alert_owner_email0" style="color:red;display: none;"></span>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail ID(Owner) / ई मेल आईडी<font color="red">*</font>
                  </label>
                  <p>
                    <input type="email" class="form-control form-control-sm" id="owner_email0" name="owner_email[]" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwnerpersonalmedia(this, this.value,0)" {{ @$readonly }} {{$disabled}}>
                    <span id="alert_owner_email0" style="color:red;display: none;"></span>
                  </p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile">Mobile / मोबाइल<font color="red">*</font>
                  </label>                  
                    <input type="text" name="owner_mobile[]" id="owner_mobile0" maxlength="10" placeholder="Enter Mobile" class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_'] ?? ''}}" onkeyup="return checkUniqueOwnerpersonalmedia(this, this.value,0)" {{ @$readonly }} {{$disabled}}>
                    <span id="alert_owner_mobile0" style="color:red;display: none;"></span>                  
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font>
                  </label>
                  <p>
                    <textarea type="text" name="address[]" id="owner_address0" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$disabled}}>{{$ownerlist['Address 1']?? ''}}</textarea>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fax">Fax / फैक्स</label>
                  <input type="text" name="fax_no[]" id="owner_fax0" onkeypress="return onlyNumberKey(event)" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14" value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}}>

                  <!-- @php
                  if(!empty($ownerlist['Owner ID'])) {
                  $ownerid[]=$ownerlist['Owner ID'];
                  }

                  @endphp -->
                  <input type="hidden" name="ownerid" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
                </div>
              </div>
            </div>
            @endforeach

            <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">
              <input type="hidden" name="increse_i" id="increse_i" value="0">
              <!-- <a class="btn btn-primary {{$disabled}}" id="add_row" style="margin-right: 7px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> -->
            </div>
            <input type="hidden" name="mobilecheck" id="mobilecheck">
            <input type="hidden" name="owner_input_clean" id="owner_input_clean">
            <input type="hidden" name="user_id" value="{{ session('id') }}">
            <input type="hidden" name="user_email" value="{{ session('email') }}">
            <!-- <input type="hidden" name="owner_id" id="owner_id" value="{{$ownerlist['Owner ID'] ?? ''}}"> -->
            <!-- @php $ownerd = implode(",",$ownerid)@endphp
            @if(!empty($ownerd))
            <input type="hidden" name="ownerid[]" id="ownerid" value="{{$ownerd}}">
            @else
            <input type="hidden" name="ownerid[]" id="ownerid" value="">
            @endif -->
            <input type="hidden" name="emailarr[]" id="emailarr" value="">

            <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
            <a class="btn btn-primary set-pm-next-button" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
            <!-- <input type="submit" name="submit" value="submit"> -->
          </div>
          <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">

            <div class="row col-md-12">
              <h4 class="subheading">Head Office :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font></label>
                  <textarea type="text" name="HO_Address" id="HO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="120" {{$disabled}}>{{$vendor_data[0]['HO Address']??''}}</textarea>
                  <span id="alert_address1" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                  <input type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$disabled}}>
                  <span id="alert_landline_no" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fax_1">Fax No. / फ़ैक्स नंबर</label>
                  <input type="text" name="HO_Fax_No" placeholder="Enter Fax No" class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Fax No_']??''}}" {{$disabled}}>
                  <span id="alert_fax_1" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail. / ईमेल<font color="red">*</font></label>
                  <input type="text" name="HO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" value="{{$vendor_data[0]['HO E-Mail']??session('email')}}" maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)" {{$disabled}}>
                  <span id="v_alert_email" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile_1">Mobile / मोबाइल<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="mobile" name="HO_Mobile_No" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['HO Mobile No_']??''}}" onkeyup="return checkUniqueVendor('mobile', this.value)" {{ @$readonly }}>
                  <span id="v_alert_mobile" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <h4 class="subheading" style="width: 191px;">Branch Office (if any) :-</h4>
              </div>
              <div class="col-md-9" style="margin-top: 5px;">
                @php
                $checked1 = '';
                $checked0 = '';
                $displayed = '';
                if(!empty(@$vendor_data) && (@$vendor_data[0]['BO Address'] !='' || @$vendor_data[0]['BO Landline No_'] !='' || @$vendor_data[0]['BO Fax No_'] !='' || @$vendor_data[0]['BO E-Mail'] !='' || @$vendor_data[0]['BO Mobile No_'] !='')){

                $checked1 = 'checked';
                $displayed = 'block';

                }else if(!empty(@$vendor_data) && (@$vendor_data[0]['BO Address'] =='' || @$vendor_data[0]['BO Landline No_'] =='' || @$vendor_data[0]['BO Fax No_'] =='' || @$vendor_data[0]['BO E-Mail'] =='' || @$vendor_data[0]['BO Mobile No_'] =='') && @$vendor_data[0] !=1){

                $checked0 = 'checked';
                $displayed = 'none';

                }else{

                $checked1 = 'checked';
                $displayed = 'block';

                }
                @endphp
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input h5" name="boradio" value="1" {{$checked1}} {{$disabled}}> Yes / हाँ &nbsp;
                    <input type="radio" class="form-check-input h5" name="boradio" value="0" {{$checked0}} {{$disabled}}>No / नहीं
                  </label>
                </div>
              </div>
            </div>
            <div id="boradio" style="display: {{$displayed}}">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="address2">Address / पता</label>
                    <textarea type="text" name="BO_Address" maxlength="120" id="BO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$disabled}}>{{$vendor_data[0]['BO Address']??''}}</textarea>
                    <!-- <span id="alert_address2" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="landline_no_1">Landline No. / लैंडलाइन नंबर</label>
                    <input type="text" name="BO_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="BO_Landline_No" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$vendor_data[0]['BO Landline No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_landline_no1" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fax_no_1">Fax No. / फ़ैक्स नंबर</label>
                    <input type="text" name="BO_Fax_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="BO_Fax_No" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$vendor_data[0]['BO Fax No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_fax_no2" style="color: red;"></span> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email2">E-mail. / ईमेल</label>
                    <input type="text" name="BO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="BO_Email" maxlength="30" value="{{$vendor_data[0]['BO E-Mail']??''}}" {{$disabled}}>
                    <!-- <span id="alert_email2" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mobile2">Mobile / मोबाइल</label>
                    <input type="text" name="BO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="BO_Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['BO Mobile No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_mobile2" style="color: red;"></span> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <h4 class="subheading" style="width: 173px;">Delhi Office (if any) :-</h4>
              </div>
              <div class="col-md-9" style="margin-top: 5px;">
                @php
                $check1 = '';
                $check0 = '';
                $display = '';
                if(!empty(@$vendor_data) && @$vendor_data[0]['DO Address'] !=''){
                $check1 = 'checked';
                $display = 'block';
                }else if(!empty(@$vendor_data) && (@$vendor_data[0]['DO Address'] =='' && @$vendor_data[0] !=1)){
                $check0 = 'checked';
                $display = 'none';
                }else{
                $check1 = 'checked';
                $display = 'block';
                }
                @endphp
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input h5" name="optradio" value="1" {{$check1}} {{$disabled}}> Yes / हाँ &nbsp;
                    <input type="radio" class="form-check-input h5" name="optradio" value="0" {{$check0}} {{$disabled}}>No / नहीं
                  </label>
                </div>
              </div>

            </div>

            <div id="radio" style="display: {{$display}}">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Address">Address / पता<font color="red">*</font></label>
                    <textarea type="text" name="DO_Address" id="DO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="50" {{$disabled}}>{{$vendor_data[0]['DO Address']??''}}</textarea>
                    <!-- <span id="alert_address3" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Landline_No">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                    <input type="text" name="DO_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="DO_Landline_No" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['DO Landline No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_landline_no2" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Fax_No">Fax No. / फ़ैक्स नंबर</label>
                    <input type="text" name="DO_Fax_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="DO_Fax_No" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['DO Fax No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_fax_no3" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="DO_Email">E-mail. / ईमेल<font color="red">*</font></label>
                    <input type="text" name="DO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="DO_Email" maxlength="30" value="{{$vendor_data[0]['DO E-Mail']??''}}" {{$disabled}}>
                    <!-- <span id="alert_email3" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="DO_Mobile">Mobile / मोबाइल<font color="red">*</font></label>
                    <input type="text" name="DO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="DO_Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['DO Mobile No_']??''}}" {{$disabled}}>
                    <!-- <span id="alert_mobile3" style="color: red;"></span> -->
                  </div>
                </div>
                @php
                $arr =array(1=>'Proprietorship0', 2=>'Proprietorship1', 3=>'Proprietorship2');
                @endphp
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Legal Status Of Company / कंपनी की कानूनी स्थिति<font color="red">*</font></label>
                    <select {{$disabled}} name="Legal_Status_of_Company" id="Legal_Status_of_Company" class="form-control form-control-sm" style="width: 100%;">

                      <option value="">Select Proprietorship</option>

                      @foreach($arr as $key =>$value)
                      <option value="{{$key}}" @if(@$vendor_data[0]['Legal Status of Company']==$key) selected="selected" @endif>{{$value}}</option>
                      @endforeach
                    </select>
                    <span id="alert_DO_legal_status_company" style="color: red;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="relevant_information">Any Other Relevant Information / कोई अन्य प्रासंगिक जानकारी<font color="red">*</font></label>
                    <input type="text" name="Other_Relevant_Information" placeholder="Enter Any Other Relevant Information" class="form-control form-control-sm" id="Other_Relevant_Information" value="{{$vendor_data[0]['Other Relevant Information']??''}}" onkeypress="return isAlphaNumeric(event)" {{$disabled}}>
                    <span id="alert_relevant_information" style="color: red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Authority Details :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Authority_Which_granted_Media">Authority Which Granted Media With Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया<font color="red">*</font></label>
                  <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="Authority_Which_granted_Media" maxlength="50" value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$disabled}}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Amount_paid_to_Authority">Amount Paid to Authority For The Current Year / चालू वर्ष के लिए प्राधिकरण को भुगतान की गई राशि</label>
                  <input type="text" name="Amount_paid_to_Authority" placeholder="Enter Amount Paid to Authority For The Current Year" class="form-control form-control-sm" id="fax_no4" onkeypress="return onlyNumberKey(event)" value="{{ @$vendor_data[0]['Amount paid to Authority'] != '' ? round($vendor_data[0]['Amount paid to Authority'],2):''}}" {{$disabled}}>
                  <span id="alert_Amount_paid_to_Authority" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="license_from">License start date / लाइसेंस शुरू होने
                    की तारीख<font color="red">*</font></label>
                  <input type="date" name="License_From" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}" value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}" {{$disabled}}>
                  <span id="date_error" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="license_to">License end date / लाइसेंस समाप्ति तिथि
                    <font color="red">*</font>
                  </label>
                  <input type="date" name="License_To" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}" {{$disabled}}>
                  <span id="date_error" style="color:red;display: none;"></span>
                </div>
              </div>
              @php
              $arr =array(1=>'Testing1', 2=>'Testing2');
              @endphp
              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Type / प्रकार चुनें</label>
                  <select name="Media_Type" class="form-control form-control-sm" style="width: 100%;" id="select_type" {{$disabled}}>

                    <option value="">Select Type</option>

                    @foreach($arr as $key =>$value)
                    <option value="{{$key}}" @if(@$vendor_data[0]['Applying For OD Media Type']==$key) selected="selected" @endif>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @php
              $arr =array(1=>'Per Annum one', 2=>'Per Annum two',3=> 'Per Annum three', 4=>'Per Annum four');
              @endphp
              <div class="col-md-4">
                <div class="form-group">
                  <label>Rental Type / किराये का प्रकार</label>
                  <select name="Rental_Agreement" class="form-control form-control-sm" style="width: 100%;" id="rental_type" {{$disabled}}>
                    <option value="">Select Type</option>

                    @foreach($arr as $key =>$value)
                    <option value="{{$key}}" @if(@$vendor_data[0]['Rental Agreement']==$key) selected="selected" @endif>{{$value}}</option>
                    @endforeach
                  </select>
                  <!-- <span id="alert_rental_type" style="color: red;"></span> -->
                </div>
              </div>
            </div>

            <div class="row col-md-12">
              <h4 class="subheading">Details Of Outdoor Media Formatted Offered :-</h4>
            </div>
            @php
            $arr =array(1=>'Airport', 2=>'Railway station', 3=>'Moving Media', 4=>'Public utility');
            @endphp
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Outdoor media format for which applying / बाहरी मीडिया प्रारूप जिसके लिए आवेदन किया जा रहा है</label>
                  <select name="Applying_For_OD_Media_Type" class="form-control form-control-sm" style="width: 100%;" {{$disabled}}>
                    <option value="">Select Per Annum</option>
                    @foreach($arr as $key =>$value)
                    <option value="{{$key}}" @if(@$vendor_data[0]['Applying For OD Media Type']==$key) selected="selected" @endif>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Details of work done in last year, for the applied media only, if any (As per format given below) :-</h4>
            </div>
            <div id="details_of_work_done">
              @foreach($OD_work_dones_data as $key => $work_done_data)
              <div class="row">
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="year">Year / वर्ष<font color="red">*</font></label>
                    <p>
                      <select name="ODMFO_Year[]" id="Years{{$key}}" class="form-control form-control-sm ddlYears" {{$disabled}}>
                        @if(@$work_done_data['Year'] == '')
                        <option value="">Select Year</option>
                        @else
                        <option value="{{ $work_done_data['Year'] }}">
                          {{ $work_done_data['Year'] }}
                        </option>
                        @endif
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
                    <p>
                      <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$disabled}} step="1">
                    </p>
                    <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि(रु)<font color="red">*</font></label>
                    @php
                    if(@$work_done_data['Billing Amount'] == 0)
                    {
                    $work_done_data1 = '';
                    }
                    else
                    {
                    $work_done_data1 = round(@$work_done_data['Billing Amount'],2);
                    }
                    @endphp
                    <p>
                      <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{$disabled}}>
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="upload_doc_1{{$key}}">Upload Document / दस्तावेज़ अपलोड करें</label>
                    <div class="input-group">
                      <div class="custom-file">

                        <input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" data="0" onchange="return uploadFile({{$key}},this)" id="upload_doc_{{$key}}" {{$disabled}} accept="application/pdf" style="opacity: 0;">
                        <label class="custom-file-label" for="upload_doc_{{$key}}" id="choose_file{{$key}}">{{ @$work_done_data['File Name'] ? @$work_done_data['File Name'] : 'Choose file' }}</label>
                        <!-- <span id="alert_upload_doc" style="color: red;"></span> -->
                        <input type="hidden" name="ODMFO_Upload_Document_[]" value="{{ @$work_done_data['File Name']}}">
                      </div>

                      @if(@$work_done_data['File Name'] != '')
                      <div class="input-group-append">
                        <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{@$work_done_data['File Name']}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                      </div>
                      @else
                      <div class="input-group-append">
                        <span class="input-group-text" id="upload_file{{$key}}">Upload</span>
                      </div>
                      @endif
                    </div>
                    <span id="upload_doc_error{{$key}}" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="row">
              <div class="col-md-11"></div>
              <div class="col-md-1" style="margin-top: 6px;padding-left: 0px;">
                <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                <a class="btn btn-primary {{$disabled}}" id="add_rows_next"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Details of GST :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="GST_No">GST No. / जीएसटी संख्या</label>
                  <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." onkeypress="return isAlphaNumeric(event)" onchange="return checksum(this.value)" maxlength="15" value="{{$vendor_data[0]['GST No_']??''}}" {{$disabled}}>
                  <span class="gstvalidationMsg"></span>
                  <span class="validcheck"></span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="`">TIN/TAN/VAT No.(if applicable) / टिन/टैन/वैट संख्या (यदि लागू हो)</label>
                  <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="TIN_TAN_VAT_No" placeholder="Enter TIN/TAN/VAT No.(if applicable)" maxlength="15" value="{{$vendor_data[0]['TIN_TAN_VAT No_']??''}}" {{$disabled}}>
                  <span id="alert_TIN_TAN_VAT_No" style="color: red;"></span>
                </div>
              </div>
            </div>
            @if(!empty($vendor_data[0]['OD Media ID']))
            <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$vendor_data[0]['OD Media ID']}}">
            @else
            <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="">
            @endif
            <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
            <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
            <a class="btn btn-primary set-pm-next-button" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
          </div>

          <div id="tab3" class="content content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
            <!-- <div class="row">
              @php
              $paycheck0 = '';
              $paycheck1 = '';
              if(@$vendor_data[0]['DD No_'] !=''){
              $paycheck0 = 'selected';
              }
             
              if(@$vendor_data[0]['PM Agency Name'] !=''){
              $paycheck1 = 'selected';
              }
              @endphp
              <div class="col-md-4">
                <div class="form-group">
                  <label>Payment Type</label>
                  <select class="form-control form-control-sm" id="select_payment" {{$disabled}}>
                    <option value="0" {{$paycheck0}}>Through DD</option>
                    <option value="1" {{$paycheck1}}>Through NEFT</option>
                  </select>
                </div>
              </div>
            </div> -->
            <div class="row" id="dd_div" style="display: none;">
              <div class="col-md-12" style="display: flex;">
                <h4 class="subheading">Fee/DD Details :- </h4>&nbsp; <p>Application fee Rs.1000/- (non refundable) per media format (in the shape of DD in favor of PAO BOC ETC)</p>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dd_no">DD No. / डीडी संख्या<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="DD_No" id="dd_no" placeholder="Enter DD No." onkeypress="return onlyNumberKey(event)" maxlength="4" value="{{$vendor_data[0]['DD No_']??''}}" {{$disabled}}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dd_date">DD Date / डीडी तिथि<font color="red">*</font></label>
                  <input type="date" class="form-control form-control-sm" name="DD_Date" id="dd_date" placeholder="Enter DD Date" min="{{ date('Y-m-d',strtotime('-3 months')) }}" value="{{ @$vendor_data[0]['DD Date'] ? date('Y-m-d', strtotime(@$vendor_data[0]['DD Date'])) : ''}}" {{ $disabled }}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="DD_Bank_Name" id="bank_name_1" placeholder="Enter Bank Name" maxlength="30" onkeypress=" return onlyAlphabets(event)" value="{{$vendor_data[0]['DD Bank Name'] ?? ''}}" {{ $disabled }}>
                  <span id="alert_bank_name_1" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch Name/ शाखा का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="DD_Bank_Branch_Name" id="DD_Bank_Branch_Name" placeholder="Enter Branch Name" maxlength="30" value="{{$vendor_data[0]['DD Bank Branch Name'] ?? ''}}" {{ $disabled }}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dd_account">DD Amount / डीडी राशि<font color="red">*</font></label>
                  <input type="text" name="Application_Amount" id="dd_amount" class="form-control form-control-sm" placeholder="Enter DD Account" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{@$vendor_data[0]['Application Amount'] ? round(@$vendor_data[0]['Application Amount'],2) : ''}}" {{ $disabled }}>

                </div>
              </div>

            </div>
            <div class="row" id="neft_div">
              <div class="col-md-12" style="display: flex;">
              <h4 class="subheading">NEFT Details :- </h4>
                <!-- <h4 class="subheading">Fee/NEFT Details :- </h4>&nbsp; <p>Application fee Rs.1000/- (non refundable)</p> -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*</font></label>
                  <input type="text" name="PM_Agency_Name" id="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" maxlength="40" value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font></label>
                  <input type="text" name="PAN" class="form-control form-control-sm" id="pan_no" placeholder="Enter Pan No." maxlength="10" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }} onchange="validatePanNumber(this)">
                  <span id="alert_pan_no" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name_2">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" name="Bank_Name" id="bank_name_2" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_2">Branch / शाखा<font color="red">*</font></label>
                  <input type="text" name="Bank_Branch" id="branch_2" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }}>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font></label>
                  <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }} onchange="validateIfscCode(this);">
                  <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="account_no">Account no / खाता नंबर<font color="red">*</font></label>
                  <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }}>
                </div>
              </div>
            </div>
            <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="">
            <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
            <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
            <a class="btn btn-primary set-pm-next-button" id="tab_3">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
          </div>
          <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Upload document of legal status of company / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name" {{$disabled}}>
                      <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">{{ @$vendor_data[0]['Legal Doc File Name'] ? @$vendor_data[0]['Legal Doc File Name'] : 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['Legal Doc File Name'])
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Attach copy of Pan Number and authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                      <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{ @$vendor_data[0]['PAN File Name'] ? @$vendor_data[0]['PAN File Name'] : 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['PAN Attached'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Upload document of outdoor media format(attach supportive documents viz,Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed) / आउटडोर मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें, जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत, भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता निष्पादित नहीं किया गया है)<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input" id="Notarized_Copy_File_Name" {{$disabled}}>
                      <label class="custom-file-label" for="Notarized_Copy_File_Name" id="Notarized_Copy_File_Name2">{{ @$vendor_data[0]['Notarized Copy File Name'] ? @$vendor_data[0]['Notarized Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['Notarized Copy File Name'])
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6"><br><br>
                <div class="form-group">
                  <label for="exampleInputFile">Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit / स्टाम्प पेपर पर शपथ पत्र पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे में<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                      <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{ @$vendor_data[0]['Affidavit File Name'] ? @$vendor_data[0]['Affidavit File Name'] : 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Affidavit File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Photographs of displayed medium (Separate photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक संपत्ति के लिए अलग फोटो)<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="Photo_File_Name" class="custom-file-input" data="0" onchange="return uploadFile(0,this)" id="Photo_File_Name" {{$disabled}}>
                      <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">{{ @$vendor_data[0]['Photo File Name'] ? $vendor_data[0]['Photo File Name'] : 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['Photographs'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Photo File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6"><br>
                <div class="form-group">
                  <label for="exampleInputFile">GST registration Certificate / जीएसटी पंजीकरण प्रमाणपत्र<font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name" {{$disabled}}>
                      <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">{{ @$vendor_data[0]['GST File Name'] ? $vendor_data[0]['GST File Name'] : 'Choose file' }}</label>
                    </div>

                    @if(@$vendor_data[0]['GST Registration'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="GST_File_Name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="GST_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <!-- checkbox -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" name="self_declaration" id="self_declaration" {{ $Self_Dec }} {{$disabled}}>
                    <label for="self_declaration">Self declaration / स्वयं घोषित<font color="red">*</font></label>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="doc[]" id="doc_data">
            <input type="hidden" name="submit_btn" id="submit_btn" value="0">
            <input type="hidden" name="vendorid_tab_4" value="">
            <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>&nbsp;
            @if(@$vendor_data[0]['OD Media ID'] != '')
            <input type="hidden" name="od_media_id" id="od_media_id" value="{{ @$vendor_data[0]['OD Media ID']}}">
            @else
            <input type="hidden" name="od_media_id" id="od_media_id" value="">
            @endif
           
            <input type="hidden" name="read_only_form" id="read_only_form" value="{{$disabled}}">
           
            <a class="btn btn-primary set-pm-next-button {{$disabled}} "><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
          </div>
        </div>
    </div>
    </form>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom_js')
<script src="{{ url('/js') }}/fresh-em-personal-media-validation.js"></script>

<script>
   // Check Unique Data 
  function checkUniqueVendor(id, val) {
    if (val != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('personalcheckuniquevendor')}}",
        data: {
          data: val
        },
        success: function(response) {
          if (response.status == 0) {
            $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#v_alert_" + id).show();
          } else {
            $("#v_alert_" + id).hide();
          }
        }
      });
    }
  }

  function checkUniqueOwner(id, val) {
    if (val != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('personalcheckuniqueowner')}}",
        data: {
          data: val
        },
        success: function(response) {
          if (response.status == 0 && id == 'email') {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{ Route('fetchownerrecord') }}",
              data: {
                data: val
              },
              success: function(response) {
                // console.log(response);
                if (response.status == 1) {
                  $("#state").empty();
                  $("#district").empty();
                  $("#name").val(response.message['Owner Name']);
                  $("#mobile").val(response.message['Mobile No_']);
                  $("#address").val(response.message['Address 1']);
                  $("#state").html(response.state);
                  $("#district").html(response.districts);
                  $("#city").val(response.message['City']);
                  $("#phone").val(response.message['Phone No_']);
                  $("#fax").val(response.message['Fax No_']);
                  $("#ownerid").val(response.message['Owner ID']);
                }
              }
            });
          } else if (response.status == 0 && id == 'mobile') {
            console.log(response);
            $("#alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#alert_" + id).show();
          } else {
            $("#alert_" + id).hide();
          }
        }
      });
    }
  }

  //unique Email function start
  function checkUniqueOwnerpersonalmedia(thisd, val, i) {
    if (val != '') {
      var user_id = $('input[name="user_id"]').val();
      var user_email = $('input[name="user_email"]').val();

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('checkpsolerightuniqueowner')}}",
        data: {
          data: val,
          id: user_id,
          email: user_email
        },
        success: function(response) {
          console.log(response);
          if (response.status == 1 && thisd.id == 'owner_email' + i) {
            $("#owner_name" + i).prop("readonly", false);
            $("#owner_mobile" + i).prop("readonly", false);
            $("#owner_address" + i).prop("readonly", false);
            $("#owner_state" + i).prop("disabled", false);
            $("#owner_district" + i).prop("disabled", false);
            $("#owner_city" + i).prop("readonly", false);
            $("#owner_phone" + i).prop("readonly", false);
            $("#owner_fax" + i).prop("readonly", false);
            // owner not exit clean data
            if ($("#owner_input_clean").val() == 0) {
              $("#owner_state" + i).val('');
              $("#owner_district" + i).val('');
              $("#owner_name" + i).val('');
              $("#owner_mobile" + i).val('');
              $("#owner_address" + i).val('');
              $("#owner_city" + i).val('');
              $("#owner_phone" + i).val('');
              $("#owner_fax" + i).val('');
              $("#ownerid").val('');
              $("#mobilecheck").val('');
            }
            var names = $("#emailarr").val();
            var numbersArray = names.split(',');
            if (numbersArray.includes(val) == false) {
              $("#emailarr").val('');
              $('input[name^="owner_email"]').each(function() {
                $("#emailarr").val(function() {
                  return $("#emailarr").val() + ',' + $(this).val();
                });
              });
            }
          }
          if (response.status == 0 && thisd.id == 'owner_email' + i) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'POST',
              url: "{{Route('fetchpersonalownerrecord')}}",
              data: {
                data: val
              },
              success: function(response) {
                if (response.status == 1) {
                  $("#owner_state" + i).empty();
                  $("#owner_district" + i).empty();
                  $("#owner_name" + i).val(response.message['Owner Name']);
                  $("#owner_mobile" + i).val(response.message['Mobile No_']);
                  $("#owner_address" + i).val(response.message['Address 1']);
                  $("#owner_state" + i).html(response.state);
                  $("#owner_district" + i).html(response.districts);
                  $("#owner_city" + i).val(response.message['City']);
                  $("#owner_phone" + i).val(response.message['Phone No_']);
                  $("#owner_fax" + i).val(response.message['Fax No_']);
                  $("#mobilecheck").val(response.message['Mobile No_']);
                  if ($("#emailarr").val() == '') {
                    $("#emailarr").val(val);
                  } else {
                    var names = $("#emailarr").val();
                    var numbersArray = names.split(',');
                    if (numbersArray.includes(val) == false) {
                      $("#emailarr").val('');
                      $('input[name^="owner_email"]').each(function() {
                        $("#emailarr").val(function() {
                          return $("#emailarr").val() + ',' + $(this).val();
                        });
                      });

                    } else {
                      // $("#alert_" + thisd.id).html("Please enter unique Owner ID");
                      // $("#alert_" + thisd.id).show();
                      // $("#owner_state" + i).val('');
                      // $("#owner_district" + i).val('');
                      // $("#owner_name" + i).val('');
                      // $("#owner_mobile" + i).val('');
                      // $("#owner_address" + i).val('');
                      // $("#owner_city" + i).val('');
                      // $("#owner_phone" + i).val('');
                      // $("#owner_fax" + i).val('');
                      // $("#ownerid" + i).val('');
                      // //  $("#exist_owner_id").val('');
                      // $("#mobilecheck").val('');
                    }
                  }
                  if ($("#ownerid").val() == '') {
                    $("#ownerid").val(response.message['Owner ID']);
                  } else {
                    var ownerids = $("#ownerid").val();
                    var ownerArray = ownerids.split(',');
                    if (isInArray(response.message['Owner ID'], ownerArray) == false) {
                      $("#ownerid").val(function() {
                        return $("#ownerid").val() + ',' + response.message['Owner ID'];
                      });
                      var ownerids = $("#ownerid").val();
                      var ownerArray = ownerids.split(',');
                      $("#ownerid").val(ownerArray);
                    }
                  }
                }

                if (response.ownerID > 0) {
                  $("#owner_name" + i).prop("readonly", true);
                  $("#owner_mobile" + i).prop("readonly", true);
                  $("#owner_address" + i).prop("readonly", true);
                  $("#owner_state" + i).prop("disabled", true);
                  $("#owner_district" + i).prop("disabled", true);
                  $("#owner_city" + i).prop("readonly", true);
                  $("#owner_phone" + i).prop("readonly", true);
                  $("#owner_fax" + i).prop("readonly", true);
                }
                $("#owner_input_clean").val(0);
              }
            });

          } else if (response.status == 0 && thisd.id == 'owner_mobile' + i && val != $("#mobilecheck").val()) {
            //console.log(isInArray(thisd.id));
            $("#alert_" + thisd.id).html(titleCase(thisd.id.replaceAll('_', ' ')).replace(/\d+/g,'') + ' ' + response.message);
            $("#alert_" + thisd.id).show();
          } else {
            // console.log(id.id);
            $("#alert_" + thisd.id).hide();
          }
          if (thisd.id == 'owner_mobile' + i) {
            $("#owner_input_clean").val(1);
          }
        }
      });
    }
  }
  //unique Email function End

  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }

  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }

  //  next and previous function for save 
  function nextSaveData(id) {
    console.log(id);
  if($("#read_only_form").val() == ''){
    if ($("#" + id).val() == 0) {
      $("#" + id).val(1);

      if (id == "next_tab_2") {
        $("#next_tab_1").val(0);
      } else if (id == "next_tab_3") {
        // $("#next_tab_1").val(0);
        $("#next_tab_2").val(0);
      } else if (id == "submit_btn") {
        $("#next_tab_3").val(0);
      }
    }
    //console.log(  $("#" + id).val());
    var data = new FormData($("#personal_media")[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: "{{Route('savePersonalMedia')}}",
      data: data,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      //autoUpload: true,

      success: function(data) {
        console.log(data);
        if (data.success == false) {
          if (id == 'submit_btn') {
            $("html, body").animate({
              scrollTop: 0
            }, 1000);

            $('.alert-danger').fadeIn().html(data.message);
            setTimeout(function() {
              $('.alert-danger').fadeOut("slow");
            }, 7000);
          }
        }
        if (data.success == true) {

          if (id == "submit_btn") {
            $("html, body").animate({
              scrollTop: 0
            }, 1000);
            $('.alert-success').fadeIn().html(data.message);
            setTimeout(function() {
              $('.alert-success').fadeOut("slow");
              window.location.reload();
            }, 7000);
          }
          if (id == 'next_tab_1') {
            $("#ownerid").val(data.data);
            //console.log('next_tab_1',data.data);
          } else {
            $("#vendorid_tab_2").val(data.data);
            $("#vendorid_tab_3").val(data.data);
            //$("#od_media_id").val(data.data);
            $("#vendorid_tab_4").val(data.data[0]);

          }

        }
      },
      error: function(error) {
        console.log('error');
      }
    });
  }else{
    console.log('readonly form');
  }
  }
</script>
@endsection