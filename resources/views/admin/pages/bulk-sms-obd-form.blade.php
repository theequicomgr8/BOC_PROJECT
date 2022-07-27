@extends('admin.layouts.layout')
<style>
body{color: #6c757d !important;}
div#to {margin-right: 16px;}
label:not(.form-check-label):not(.custom-file-label) {font-weight: 500!important;}
@media (min-width: 768px){.col-md-2 {
   max-width: 13.666667%!important;}}
   .error {
     color: red;
    font-size: 14px;
}

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  .input-group-text {
    height: 32px !important;
  }

  .custom-file-label {
    height: 32px !important;
    overflow: hidden;
  }

  .custom-file-label::after {
    height: 30px !important;
  }

  .input-group-text {
    font-size: 0.8rem !important;
  }

  /* .input-group {
     width: 80% !important;
     float: right !important;
  } */

  .flexview {
    display: inline-flex;
  }
  .eyecolor{
    color: #007bff !important;
  }
  .iframemargin{
    margin-bottom: -50px;
  }
  .fieldset-border {
    width: 100%;
    border: solid 1px #ccc;
    border-radius: 5px;
    margin: 0 10px 15px 10px;
    padding: 0 15px;
}
.fieldset-border legend {
  width: auto;
  background: #fff;
  padding: 0 10px;
  font-size: 14px;
  font-weight: 600;
  color: #3d63d2;
}
.subheading {
  font-size: 16px;
  font-weight: 500;
  color: #4066d4;
  border-bottom: solid 1px #4066d4;
  margin-bottom: 15px;
}
.divmargin {
  margin-top: 19px;
}
.form-control-sm, .input-group-sm>.form-control, .input-group-sm>.input-group-append>.btn, .input-group-sm>.input-group-append>.input-group-text, .input-group-sm>.input-group-prepend>.btn, .input-group-sm>.input-group-prepend>.input-group-text {
    padding: 0.25rem 0.2rem !important;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

</style>

@section('content')

@php

                  $Bluksms=$Bluksms ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  $click='';
                  $tab ='';
                  if(@$Bluksms->{'Modification'} == 1){
                  $disabled = '';
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  $read='readonly';
                  $click='preventLeftClick';
                  $tab='-1';
                  }

@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of Bulk SMS & OBD</h6>
                            <p>
                    @if($Bluksms != '' && @$Bluksms->{'Modification'} == 1)
            <a href="{{url('pdfbulk-sms/'.session::get('UserID'))}}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Bulk SMS Application Receipt</a>
            @endif
                </p>
        </div>
        <div class="card-body">
           <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="post" action="" id="emp_bulk_sms" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab1" id="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab2" id="#tab2">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab3" id="#tab3">Upload Document</a>
                    </li>
                </ul>

<div class="tab-content">
    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"aria-labelledby="tab1-trigger">
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
            <label for="Email">E-mail ID / ई मेल आईडी <font color="red">*</font></label>
            <input type="email" class="form-control form-control-sm"{{$disabled}} name="email"id="email" placeholder="Enter Email" {{$readonly}} value="{{@$Bluksms->{'E-Mail'} ?? ''}}">
            <span id="first_email" style="color:red;display:none;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="mobile"id="mobile" {{$disabled}} placeholder="Enter mobile number"onkeypress="return onlyNumberKey(event)" maxlength="10" {{$readonly}} value="{{@$Bluksms->{'Mobile'} ?? ''}}">
                <span id="first_mobile" style="color:red;display:none;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Address">Address / पता <font color="red">*</font></label>
                <textarea name="bulk_address" id="bulk_address" {{$readonly}} placeholder="Enter address" class="form-control form-control-sm">{{@$Bluksms->{'Address 1'} ?? ''}}</textarea>
                <span id="first_address" style="color:red;display:none;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="State">State / राज्य <font color="red">*</font></label>
                <select id="state_id" name="state" {{$readonly}} class="form-control form-control-sm {{$click}}" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                  <option value="">Select State</option>
                      @if(count($result) > 0)
                     @foreach($result as $statesData)
                    <option {{$readonly}} value="{{$statesData['Code']}}" @if(@$Bluksms->{'State'} == $statesData['Code']) selected="selected" @endif>{{$statesData['Description']}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="District">District / ज़िला<font color="red">*</font></label>
                <select id="district_id" name="district" {{$readonly}} class="form-control form-control-sm {{$click}}" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                    <option value="">Select District</option>
                   @if($dist > 0)
                   @foreach($dist as $st)
                    <option value="{{@$st['District'] ?? ''}}" @if(@$Bluksms->{'District'} == $st['District']) selected="selected" @endif>{{@$st['District'] ?? ''}}</option>
                    @endforeach
                    @endif

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="District">City / नगर {{@$Bluksms->{'City'} }}<font color="red">*</font></label>
                <select id="city" name="city" {{$readonly}} class="form-control form-control-sm {{$click}}" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                    <option value="">Select City</option>
                   @if($city > 0)
                   @foreach($city as $st)
                    <option value="{{@$st['CityName']}}" @if($st['CityName'] == @$Bluksms->{'City'}) selected="selected" @endif>{{@$st['CityName'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">Phone No. / फोन नंबर</label>
                <input type="text" name="phone_no" class="form-control form-control-sm" id="phone"
                    placeholder="Enter phone number" {{$disabled}} maxlength="15"
                    onkeypress="return onlyNumberKey(event)"
                    {{$readonly}} value="{{@$Bluksms->{'Phone'} ?? ''}}">
            </div>
        </div>

        <!-- <div class="col-md-4">
            <div class="form-group">
                <label for="Name">Fax / फैक्स</label>
                <input type="text" name="fax_no" class="form-control form-control-sm" id="fax"
                    placeholder="Enter Fax" maxlength="15" {{$disabled}} onkeypress="return onlyNumberKey(event)"
                    minlength="15" maxlength="15" {{$readonly}} value="{{@$Bluksms->{'Fax'} ?? ''}}">
            </div>
        </div> -->
        @php
        $arr =array(1=>'Metro', 2=>'A',3=>'B', 3=>'C', 4=>'D',5=>'E');
        @endphp
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">Telecom circle Category / टेलीकॉम सर्किल श्रेणी<font color="red">*
                    </font></label>
                <select name="tel_circle_cat" id="tel_circle_cat" {{$readonly}} class="form-control form-control-sm {{$click}}" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                <option  value="">Select Telecom circle category</option>
                @foreach($arr as $key=>$value){
                <option  value="{{$key}}" @if(@$Bluksms->{'Telecom Circle Category'} == $key)  selected="selected" @endif > {{$value}}</option>
                 @endforeach
                }
                </select>
            </div>
        </div>
        @php
        $aar =array(1=>'data coming', 2=>'data coming',3=>'data coming', 3=>'data coming', 4=>'data coming');
        @endphp
        <div class="col-md-4">
            <div class="form-group">
                <label for="Name">Telecom circle / टेलीकॉम सर्कल</label>
                <!-- <select id="tel_circle" name="tel_circle" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                    <option value="">Select Telecom circle</option>
                    @foreach($aar as $key=>$value){
                <option value="{{$key}}" @if(@$Bluksms->{'Telecom circle'} == $key)  selected="selected" @endif > {{$value}}</option>
                 @endforeach
                }
                </select> -->
                <input type="text" name="tel_circle" placeholder="Enter telecom circle"
                    class="form-control form-control-sm" id="tel_circle"   {{$readonly}} value="{{@$Bluksms->{'Telecom circle'} ?? ''}}" {{$disabled}} onkeypress="return onlyNumberKey(event)">
            </div>
        </div>
    </div>
    <a class="btn btn-primary bulk-sms" id="tab_1">Next <i
            class="fa fa-arrow-circle-right fa-lg"></i></a>
</div>

<div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
    <div class="row">
       <div class="col-md-4">
            <div class="form-group">
                <label for="pan_card">GST / जीएसटी<font color="red">*</font></label>
                <input type="text" name="gst" placeholder="Enter GST"
                    class="form-control form-control-sm inputUC" id="gst_no" onkeypress="return isAlphaNumeric(event)"  {{$readonly}} value="{{@$Bluksms->{'GSTN'} ?? ''}}" {{$disabled}} maxlength="15">
                    <span id="GST_No_Error" style="display: none;"></span>
                    <span class="validcheck"></span>
            </div>
        </div>
          <div class="col-md-4">
                <div class="form-group">
                <label for="Name">Agency Name / एजेंसी का नाम <font color="red">*</font></label>
                <input type="text" class="form-control form-control-sm" name="agency_name" id="agency_name" placeholder="Enter agency name" onkeypress="return onlyAlphabets(event,this)" maxlength="100"
                        {{$readonly}} value="{{@$Bluksms->{'Agency Name'} ?? ''}}">
                <span id="first_agency_name" style="color:red;display:none;"></span>
                </div>
            </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="address">Bank account number for receiving payment / भुगतान प्राप्त करने
                    के
                    लिए बैंक खाता संख्या<font color="red">*</font></label>
                <input type="text" name="bank_account" id="bank_account" maxlength="15" placeholder="Enter bank account number" rows="1" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$Bluksms->{'Account No_'} ?? ''}}" {{$disabled}}>
                <span id="alert_bank_account" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="landline_no">Account holder name / खाता धारक का नाम<font color="red">*
                    </font></label>
                <input type="text" name="acc_holder_name" id="acc_holder_name"
                    placeholder="Enter account holder name." class="form-control form-control-sm" id="acc_holder_name" maxlength="30" onkeypress="return onlyAlphabets(event,this);" {{$readonly}} value="{{@$Bluksms->{'A_C Holder Name'} ?? ''}}" {{$disabled}}>
                <span id="alert_acc_holder_name" style="color: red;"></span>
            </div>
        </div>
          <div class="col-md-4">
            <div class="form-group">
                <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font></label>
                <input type="text" name="ifsc_code" id="ifsc_code"
                    class="form-control form-control-sm inputUC" placeholder="Enter IFSC code"
                    onkeypress="return isAlphaNumeric(event)"  maxlength="15" {{$readonly}} value="{{@$Bluksms->{'IFSC Code'} ?? ''}}" {{$disabled}}>
                    <span id="IFSC_code_Error" style="display: none;"></span>
            </div>
          </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                <input type="text" name="bank_name" id="bank_name"
                    class="form-control form-control-sm" placeholder="Enter bank name"
                    maxlength="30" onkeypress="return onlyAlphabets(event,this);" {{$readonly}} value="{{@$Bluksms->{'Bank Name'} ?? ''}}" {{$disabled}}>
                <span id="alert_bank_name" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="branch">Branch / शाखा<font color="red">*</font></label>
                <input type="text" name="branch" id="branch" class="form-control form-control-sm"
                    placeholder="Enter branch" maxlength="40" onkeypress="return onlyAlphabets(event,this);" {{$readonly}} value="{{@$Bluksms->{'Branch Name'} ?? ''}}" {{$disabled}}>
                <span id="alert_branch" style="color: red;"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="address">Address of account / खाते का पता <font color="red">*</font></label>
                <textarea type="text"  name="bank_address" rows="1" class="form-control form-control-sm" id="bank_address" placeholder="Address of account" maxlength="110" onkeypress="return onlyAlphabets(event,this);" {{$readonly}}>{{@$Bluksms->{'Account Address'} ?? ''}} </textarea>
                <span id="alert_address1" style="color: red;"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="pan_card">PAN card no. / पैन कार्ड नंबर <font color="red">*</font></label>
                <input type="text" name="pan_card" placeholder="Enter pan card no."
                    class="form-control form-control-sm inputUC" id="pan_card" maxlength="15"  onkeypress="return isAlphaNumeric(event)" onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Bluksms->{'PAN'} ?? ''}}" {{$disabled}}>
                    <span id="PAN_No_Error" style="display: none;" ></span>
            </div>
        </div>

         <fieldset class="fieldset-border">
                <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_account_no">Account No. / खाता नंबर<font color="red">*</font></label>
                       <input type="text" name="esi_acc_number" placeholder="Enter account no." rows="1" id="esi_acc_number" class="form-control form-control-sm"
                    onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$Bluksms->{'ESI A_C No_'} ?? ''}}" {{$disabled}}>
                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_no_employees">No. of employees covered / कवर किए गए कर्मचारियों की संख्या<font color="red">*</font></label>
                      <input type="text"name="esi_employees_covered" id="esi_employees_covered" placeholder="Enter No. of employees covered"  class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="6" {{$readonly}} value="@if(@$Bluksms->{'No_ Of Emp in ESI'} > 0){{@$Bluksms->{'No_ Of Emp in ESI'} ?? ''}}@endif">
                      <span id="alert_ESI_no_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
              <fieldset class="fieldset-border">
                <legend>EPF Account Details / ईपीएफ खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">Account No. / खाता नंबर<font color="red">*</font></label>
                     <input type="text" name="esp_acc_number" id="esp_acc_number"
                    placeholder="Enter account no."  id="acc_number1"
                    class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$Bluksms->{'EPF A_c No_'} ?? ''}}" {{$disabled}}>
                    </div>
                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">No. of employees covered / कवर किए गए कर्मचारियों की संख्या<font color="red">*</font></label>
                      <input type="text" name="esp_employees_covered" id="esp_employees_covered"
                    placeholder="Enter no. of employees covered"
                    class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="6" {{$readonly}} value="@if(@$Bluksms->{'No_ Of Emp in EPF'} > 0){{@$Bluksms->{'No_ Of Emp in EPF'} ?? ''}}@endif">
                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>




    <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
    <a class="btn btn-primary bulk-sms" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
</div>

<div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
         <label for="TRAI_RC_File_Name">Upload TRAI registration certificate (Only PDF) Max Size 2MB/ ट्राई पंजीकरण प्रमाणपत्र अपलोड करें (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" {{$disabled}} name="TRAI_RC_File_Name" class="custom-file-input  {{$click}}" id="TRAI_RC_File_Name">
                <label class="custom-file-label" for="TRAI_RC_File_Name" id="TRAI_RC_File_Name2">{{$Bluksms->{'TRAI RC File Name'} ?? 'Choose file'}}</label>
            </div>
             @if(@$Bluksms->{'TRAI RC File Name'} != '')
        <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'TRAI RC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="TRAI_RC_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="TRAI_RC_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="JOC_File_Name">Copy of job order with any ministry, public sector etc. In past 2 years (Only PDF) Max Size 2MB/ पिछले 2 वर्षों में किसी भी मंत्रालय, सार्वजनिक क्षेत्र आदि के जॉब ऑर्डर की कॉपी। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"  name="JOC_File_Name" class="custom-file-input {{$click}}" id="JOC_File_Name">
                    <label class="custom-file-label" for="JOC_File_Name" id="JOC_File_Name2">{{ $Bluksms->{'JOC File Name'} ?? 'Choose file' }}</label>
                </div>
                @if(@$Bluksms->{'JOC File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'JOC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="JOC_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="JOC_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Throughput_File_Name">Throughput per second for empanelment under bulk sms service (Only PDF) Max Size 2MB/
                बल्क एसएमएस सेवा के तहत पैनल में शामिल करने के लिए प्रति सेकेंड प्रवाह। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="Throughput_File_Name" class="custom-file-input {{$click}}" id="Throughput_File_Name">
                    <label class="custom-file-label" for="Throughput_File_Name" id="Throughput_File_Name2">{{$Bluksms->{'Throughput File Name'} ?? 'Choose file'}}</label>
                </div>

                @if(@$Bluksms->{'Throughput File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Throughput File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Throughput_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Throughput_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Bulk_SDP_File_Name">Documentary proof having commercial experience of delivering at least ten (10) crore bulk in a single month for empanelment (Only PDF) Max Size 2MB/ पैनल में शामिल
                होने के लिए एक महीने में कम से कम दस (10) करोड़ बल्क डिलीवर करने का व्यावसायिक अनुभव रखने वाले दस्तावेजी  प्रमाण। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" {{$disabled}} name="Bulk_SDP_File_Name" class="custom-file-input {{$click}}" id="Bulk_SDP_File_Name">
                    <label class="custom-file-label" for="Bulk_SDP_File_Name" id="Bulk_SDP_File_Name2">{{$Bluksms->{'Bulk SDP File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'Bulk SDP File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Bulk SDP File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Bulk_SDP_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Bulk_SDP_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="OBD_Call_File_Name1">Document issued by the operator/service provider for the capacity of ten (10) lakh calls per day for empanelment under obd services (Only PDF) Max Size 2MB/ ओबीडी सेवाओं
                के तहत पैनल
                में शामिल करने के लिए प्रति दिन दस (10) लाख कॉल की क्षमता के लिए ऑपरेटर/सेवा प्रदाता द्वारा जारी दस्तावेज। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"  name="OBD_Call_File_Name1" class="custom-file-input {{$click}}" id="OBD_Call_File_Name1">
                    <label class="custom-file-label" for="OBD_Call_File_Name1" id="OBD_Call_File_Name12">{{$Bluksms->{'10L OBD Call File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'10L OBD Call File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'10L OBD Call File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="OBD_Call_File_Name13">Upload</span>
    </div>
    @endif
        </div>
        <span id="OBD_Call_File_Name11" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="OBD_Call_File_Name2">Documentary proof for having commercial experience of
                making fifty
                (50) lakh calls in a month for empanelment under OBD services (Only PDF) Max Size 2MB/ ओबीडी सेवाओं के
                तहत पैनल में
                शामिल होने के लिए एक महीने में पचास (50) लाख कॉल करने का व्यावसायिक अनुभव होने
                का दस्तावेजी
                प्रमाण (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" {{$disabled}} name="OBD_Call_File_Name2" class="custom-file-input {{$click}}" id="OBD_Call_File_Name2">
                    <label class="custom-file-label" for="OBD_Call_File_Name2" id="OBD_Call_File_Name22">{{ $Bluksms->{'50L OBD Cal File Name'} ?? 'Choose file' }}</label>
                </div>
                @if(@$Bluksms->{'50L OBD Cal File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'50L OBD Cal File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="OBD_Call_File_Name23">Upload</span>
    </div>
    @endif
        </div>
        <span id="OBD_Call_File_Name21" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Affidavit_For_NS_File_Name">An affidavit to the effect that the agency / operator
                has not been
                temporarily suspended or permanently de-empanelment (Only PDF) Max Size 2MB/ इस आशय का एक हलफनामा कि
                एजेंसी /
                ऑपरेटर को अस्थायी रूप से निलंबित या स्थायी रूप से डी-पैनलमेंट नहीं किया गया
                है (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"  name="Affidavit_For_NS_File_Name" class="custom-file-input {{$click}}" id="Affidavit_For_NS_File_Name">
                    <label class="custom-file-label" for="Affidavit_For_NS_File_Name" id="Affidavit_For_NS_File_Name2">{{$Bluksms->{'Affidavit For NS File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'Affidavit For NS File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Affidavit For NS File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Affidavit_For_NS_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Affidavit_For_NS_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Affidavit_For_Dir_File_Name">An affidavit that the proprietor or Director or
                promoter of the
                agency has not been implicated by a court of law and no proceeding are pending
                in a court of
                law and that the agency/ operator with comply all laws in land (Only PDF) Max Size 2MB/ एक हलफनामा कि
                एजेंसी के
                मालिक या निदेशक या प्रमोटर को कानून की अदालत द्वारा फंसाया नहीं गया है और कानून
                की अदालत में
                कोई कार्यवाही लंबित नहीं है और एजेंसी / ऑपरेटर भूमि में सभी कानूनों का पालन करता
                है। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="Affidavit_For_Dir_File_Name" class="custom-file-input {{$click}}" id="Affidavit_For_Dir_File_Name">
                    <label class="custom-file-label" for="Affidavit_For_Dir_File_Name" id="Affidavit_For_Dir_File_Name2">{{$Bluksms->{'Affidavit For Dir File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'Affidavit For Dir File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Affidavit For Dir File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Affidavit_For_Dir_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Affidavit_For_Dir_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Mobile_number_ODB_File_Name">It should have the database of mobile numbers of their
                own for
                dissemination of information. It should provide the necessary proof in this
                regard (Only PDF) Max Size 2MB/ सूचना
                के प्रसार के लिए इसके पास स्वयं के मोबाइल नंबरों का डेटाबेस होना चाहिए। उसे इस
                संबंध में
                आवश्यक प्रमाण उपलब्ध कराने चाहिए। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="Mobile_number_ODB_File_Name" class="custom-file-input {{$click}}" id="Mobile_number_ODB_File_Name">
                    <label class="custom-file-label" for="Mobile_number_ODB_File_Name" id="Mobile_number_ODB_File_Name2">{{$Bluksms->{'Mobile number ODB File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'Mobile number ODB File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Mobile number ODB File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Mobile_number_ODB_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Mobile_number_ODB_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Incorporation_Cert_File_Name">Certificate of incorporation in India (Only PDF) Max Size 2MB/ भारत में निगमन
                का प्रमाण
                पत्र। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"  name="Incorporation_Cert_File_Name" class="custom-file-input {{$click}}" id="Incorporation_Cert_File_Name">
                    <label class="custom-file-label" for="Incorporation_Cert_File_Name" id="Incorporation_Cert_File_Name2">{{$Bluksms->{'Incorporation Cert File Name'} ?? 'Choose file'}}</label>
                </div>
               @if(@$Bluksms->{'Incorporation Cert File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'Incorporation Cert File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="Incorporation_Cert_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="Incorporation_Cert_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="PAN_Upload_File_Name">Upload document for Pan Card (Only PDF) Max Size 2MB/ पैन कार्ड के लिए
                दस्तावेज अपलोड
                करें। (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="PAN_Upload_File_Name" class="custom-file-input {{$click}}" id="PAN_Upload_File_Name">
                    <label class="custom-file-label" for="PAN_Upload_File_Name" id="PAN_Upload_File_Name2">{{$Bluksms->{'PAN Upload File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'PAN Upload File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'PAN Upload File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="PAN_Upload_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="PAN_Upload_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="GST_Upload_File_Name">Upload document for GST (Only PDF) Max Size 2MB/ जीएसटी के लिए दस्तावेज अपलोड
                करें (केवल पीडीएफ) अधिकतम आकार 2 एमबी</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file"  name="GST_Upload_File_Name" class="custom-file-input {{$click}}" id="GST_Upload_File_Name">
                    <label class="custom-file-label" for="GST_Upload_File_Name" id="GST_Upload_File_Name2">{{$Bluksms->{'GST Upload File Name'} ?? 'Choose file'}}</label>
                </div>
                @if(@$Bluksms->{'GST Upload File Name'} != '')
               <div class="input-group-append">
            <span class="input-group-text"><a href="{{ url('/uploads') }}/bulk-sms/{{ @$Bluksms->{'GST Upload File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
        </div>
        @else
        <div class="input-group-append">
      <span class="input-group-text" id="GST_Upload_File_Name3">Upload</span>
    </div>
    @endif
        </div>
        <span id="GST_Upload_File_Name1" class="error invalid-feedback"></span>
    </div>
</div>
<input type="hidden" name="doc[]" id="doc_data">
  <a class="btn btn-primary reg-previous-button ml-3 mr-1"><i class="fa fa-arrow-circle-left fa-lg" ></i> Previous</a>
@if(@$Bluksms->{'Modification'} == 1)
                       <!--  <a class="btn btn-primary bulk-sms" style="pointer-events:{{$pointer}};"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a> -->
                        @else
                        <a class="btn btn-primary bulk-sms"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a>
                        @endif
        <!-- <a class="btn btn-primary reg-previous-button ml-3 mr-1"><i class="fa fa-arrow-circle-left fa-lg" ></i> Previous</a>
        @if(@$Bluksms->{'Status'} == 1)
        <a class="btn btn-primary bulk-sms" id="tab_3" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">  Submit <i class="fa fa-paper-plane"aria-hidden="true"></i></a>
        @else
         <a class="btn btn-primary bulk-sms" id="tab_3"><i class="fa fa-paper-plane" aria-hidden="true">  Submit</i></a>
        @endif -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/empanelment-bulk-sms.js"></script>
<script>
//upload file validation
//ps code
$(document).ready(function(){
$("#state_id").on('change',function() {
    // console.log($(this).val() + '~' + $(this).attr("data"));
     var state_code =$(this).val();

        $.ajax({
            type: 'GET',
            url: "{{Route('getDistrictsms')}}",
            data: {state_code: state_code},
            success: function(data) {
               // console.log(data);
                $("#district_id").html(data);
            }
        });
    });
});
$(document).ready(function(){
$("#state_id").on('change',function() {
    // console.log($(this).val() + '~' + $(this).attr("data"));
     var state_code =$(this).val();

        $.ajax({
            type: 'GET',
            url: "{{Route('get-bulksms-city')}}",
            data: {state_code: state_code},
            success: function(data) {
               // console.log(data);
                $("#city").html(data);
            }
        });
    });
});


</script>
@endsection
