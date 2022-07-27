@extends('admin.layouts.layout')
<style>
body {
    color: #6c757d !important;
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
</style>
@section('content')

    @php
        $VendorData = $VendorData ?? [1];
        $readonly = '';
        $disabled = '';
        $checked = '';
        $Self_Dec='';
        $pointer ='';
        $click='';
        $tab ='';
        if(@$VendorData->{'Status'} == 1){
        $disabled = '';
        $readonly = 'readonly';
        $checked = 'checked';
        $pointer='none';
        $read='readonly';
        $click='preventLeftClick';
        $tab='-1';
        }
    @endphp

<!-- @php
$OD_owners = $OD_owners ?? [1];
@endphp -->

<!-- Content Wrapper. Contains page content -->
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Empanelment Internet Website</h6>
            <div class="col-xl-6">
                @if(Session::has('UserID'))
                <a href="{{url('internetWebPDF/'.session('UserID'))}}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download Reports</a>
                @endif
              </div>
        </div>
         <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="card-body">
            <form method="post" id="internet_website" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" id="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab2">Internet Website Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab"  id="#tab3">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab4">Upload Document</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"
                        aria-labelledby="tab1-trigger">
                        <!-- @foreach($OD_owners as $key => $ownerlist) -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">E-mail ID / ई मेल आईडी <font color="red">*</font></label>
                                    <input type="email" class="form-control form-control-sm" name="owner_email"
                                        id="owner_email" placeholder="Enter Email"
                                        value="{{@$VendorData->{'E-Mail'} ?? ''}}" {{$readonly}}>
                                    <span id="first_email" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Mobile No / मोबाइल नंबर <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="owner_mobile"
                                        id="owner_mobile" placeholder="Enter Mobile"
                                        onkeypress="return onlyNumberKey(event)" maxlength="10"
                                        value="{{@$VendorData->{'Mobile'} ?? ''}}" {{$readonly}}>
                                    <span id="first_mobile" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Address / पता <font color="red">*</font></label>
                                    <textarea name="address" id="address" placeholder="Enter Address"
                                        class="form-control form-control-sm" {{$readonly}}>{{@$VendorData->{'Address 2'} ?? ''}}</textarea>
                                    <span id="first_address" style="color:red;display:none;"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">State / राज्य<font color="red">*</font></label>
                                    <p>
                                        <select id="owner_state0" name="state"
                                            class="form-control form-control-sm call_district" data="owner_district" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <option value="">Select State</option>
                                            @if($state >0)
                                            @foreach($state as $st)
                                            <option value="{{$st['Code'] ?? ''}}" @if(@$VendorData->{'State'} == $st['Code']) selected="selected" @endif> {{$st['Description'] ?? ''}} </option>
                                            @endforeach
                                           @endif
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">District / ज़िला<font color="red">*</font></label>
                                    <p>
                                        <select id="owner_district" name="district"
                                            class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            @if(@$VendorData->{'District'} == '')
                                            <option value="">Select District</option>
                                            @endif
                                            <option>{{@$VendorData->{'District'} ?? ''}}</option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="District">City / नगर {{@$Bluksms->{'City'} }}<font color="red">*</font></label>
                                    <select id="city" name="city" {{$readonly}} class="form-control form-control-sm {{$click}}" style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                        <option value="">Select City</option>
                                  
                                        <option value="{{@$VendorData->{'City'} }}" {{@$VendorData->{'City'} ? 'selected':''}}>{{@$VendorData->{'City'} }}</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Phone No / फोन नंबर</label>
                                    <input type="text" name="phone_no" class="form-control form-control-sm" id="phone"
                                        placeholder="Enter Phone Number" maxlength="15"
                                        onkeypress="return onlyNumberKey(event)"
                                        value="{{@$VendorData->{'Phone'} ?? ''}}" {{$readonly}}>
                                </div>
                            </div>

                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Fax / फैक्स</label>
                                    <input type="text" name="fax_no" class="form-control form-control-sm" id="fax"
                                        placeholder="Enter Fax" maxlength="15" onkeypress="return onlyNumberKey(event)"
                                        minlength="15" maxlength="15" value="{{@$VendorData->{'Fax'} ?? ''}}" {{$readonly}}>
                                </div>
                            </div> --}}
                        </div>
                        <!-- @endforeach -->
                        <input type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                        <a class="btn btn-primary internet-next-button" id="tab_1">Next <i
                                class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>

                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gst_no">GST No. / जीएसटी संख्या <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm inputUC" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" value="{{@$VendorData->{'GSTIN'} ?? ''}}" tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" onkeypress="return isAlphaNumeric(event)" onkeyup="return checksumsole(this.value)" {{$readonly}}>
                                    <span class="gstvalidationMsg"></span>
                                    <span class="validcheck"></span>
                                </div>
                            </div>
                            {{-- {{dd($VendorData)}} --}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="agency_name" class="form-control form-control-sm"
                                        placeholder="Enter Agency Name" maxlength="40" id="agency_name"
                                        value="{{@$VendorData->{'Agency Name'} ?? ''}}" {{$readonly}}
                                        tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name">Name of Group/Company/ समूह/कंपनी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="group_name" placeholder="Enter company/Group"
                                        class="form-control form-control-sm" id="company_name"
                                        onkeypress="return onlyAlphabets(event,this)"
                                        value="{{@$VendorData->{'Group Name'} ?? ''}}" {{$readonly}}>
                                    <span id="first_company_name" style="color:red;display:none;"></span>
                                </div>
                            </div>
                         @php
                         $date_of_registration =substr(@$VendorData->{'Domain Registration Date'}, 0,10);
                         $EM_DA ='';
                         if($date_of_registration != '1900-01-01'){
                          $EM_DA  = $date_of_registration;
                          }else{
                          $EM_DA  ='';
                          }
                         @endphp
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_registration">Date of registration of website domain /
                                        वेबसाइट डोमेन के पंजीकरण की तिथि<font color="red">*</font></label>
                                    <input type="date" name="date_of_registration" class="form-control form-control-sm" max="{{ date('Y-m-d') }}" id="date_of_registration" OnKeypress="javascript:return isAlphaNumeric(event,this.value);" value="{{$EM_DA ?? ''}}" {{$readonly}}>
                                    <span id="first_date_of_registration" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rni_registration_no">Website URL / वेबसाइट यू.आर. एल<font color="red">*
                                        </font></label>
                                    <input type="text" name="website_url" placeholder="Enter Website URL." class="form-control form-control-sm" id="website_url" value="{{@$VendorData->{'Website URL'} ?? ''}}" {{$readonly}}>
                                    <span id="first_website_url" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category of Websites / वेबसाइटों की श्रेणी<font color="red">*</font></label>
                                    <select name="website_category" id="website_category"
                                        class="form-control form-control-sm"
                                        OnKeypress="javascript:return isAlphaNumeric(event,this.value);" {{$readonly}} style="pointer-events: {{$pointer}}"tabindex="{{$tab}}">
                                        <option value="">Select category</option>
                                            <option value="1" @if(@$VendorData->{'Website Category'} == 1) selected="selected"@endif>Above 5 million</option>
                                            <option value="2" @if(@$VendorData->{'Website Category'} == 2) selected="selected"@endif>2 million to less than 5
                                                million</option>
                                            <option value="3" @if(@$VendorData->{'Website Category'} == 3) selected="selected"@endif>0.25 million to less than 2 million</option>
                                    </select>
                                    <span id="first_website_category" style="color:red;display:none;"></span>
                                </div>
                            </div>
                        </div><br>
                        {{-- <div class="row col-md-12">
                            <div class="row col-md-4">
                                <h5>Add Type :- </h5>
                            </div>
                            <div class="row" style="margin-left: -203px;">
                                <div class="row col-md-4" style="margin-left: 10;">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            @if(@$VendorData->{'Banner Type'}> 0)
                                            <input type="checkbox" id="davp_panel" name="video" value="Video" checked="checked">
                                            @else
                                            <input type="checkbox" id="davp_panel" name="video" value="Video">
                                            @endif
                                            <label for="davp_panel">Banner</label>
                                            <br /><span id="first_checkbox" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-left: 53px;">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="davp_panel-2" value="Video">
                                            <label for="davp_panel-2">Video</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="add_davp">
                            <div class="col-md-12">
                                <h5></h5>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Banner Type</label>
                                    <select id="select1" name="select1" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}" {{$readonly}}>
                                        <option value="">select banner type</option>
                                        <option value="1" @if(@$VendorData->{'Banner Type'} == 1) selected="selected" @endif>Standard</option>
                                        <option value="2" @if(@$VendorData->{'Banner Type'} == 2) selected="selected" @endif>Fixed</option>
                                    </select>
                                    <span id="first_rena_office_laf" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Banner Size</label>
                                    <select id="select2" name="select2" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                        <option value="">select banner size</option>
                                        <option value="1" @if(@$VendorData->{'Banner Size'} == 1) selected="selected" @endif>300X250 PX, 728X90 PX</option>
                                        <option value="2" @if(@$VendorData->{'Banner Size'} == 1) selected="selected" @endif>Min 300X250 PX</option>
                                    </select>
                                    <span id="first_rena_office_laf" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div> --}}
                        <a class="btn btn-primary reg-previous-button">Previous</a>
                        <a class="btn btn-primary internet-next-button" id="tab_2">Next</a>
                    </div>

                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Bank account no. for receiving payments / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{@$VendorData->{'Account No_'} ?? ''}}" {{$readonly}}>
                                    <span id="first_bank_account_no" style="color:red;display:none;"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Account holder name / खाता धारक का नाम<font color="red">*</font>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" name="account_holder_name" placeholder="Enter Account holder Name" onkeypress="return onlyAlphabets(event,this)" value="{{@$VendorData->{'A_C Holder Name'} ?? ''}}" {{$readonly}}>
                                    <span id="first_account_holder_name" style="color:red;display: none;"></span>
                                </div>
                            </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm inputUC" name="ifsc_code"
                                        id="ifsc_code" placeholder="Enter IFSC Code" maxlength="15"
                                        onkeypress="return isAlphaNumeric(event)" onchange="validateIfscCode(this);" value="{{@$VendorData->{'IFSC Code'} ?? ''}}" {{$readonly}}>
                                    <span id="alert_ifsc_code" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="bank_name" id="bank_name" placeholder="Enter Bank Name" onkeypress="return onlyAlphabets(event,this)" maxlength="30" value="{{@$VendorData->{'Bank Name'} ?? ''}}" {{$readonly}}>
                                    <span id="first_bank_name" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Branch / शाखा<font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="branch_name" id="branch_name" placeholder="Enter Branch" value="{{@$VendorData->{'Branch Name'} ?? ''}}" {{$readonly}}>
                                    <span id="first_branch_name" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Address of account / खाते का पता<font color="red">*</font></label>
                                    <textarea name="address_of_account" class="form-control form-control-sm" id="address_of_account" placeholder="Enter Address of account" {{$readonly}}>{{@$VendorData->{'Account Address'} ?? ''}}</textarea>
                                    <span id="first_address_of_account" style="color: red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">PAN card no. / पैन कार्ड नंबर<font color="red">*</font></label>
                                    <input type="text" name="pan_card" class="form-control form-control-sm inputUC"
                                        id="pan_card" placeholder="Enter Pan card " maxlength="15"
                                        onkeypress="return isAlphaNumeric(event)" onchange="validatePanNumber(this);" value="{{@$VendorData->{'PAN'} ?? ''}}" {{$readonly}}>
                                    <span id="alert_pan_card" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <fieldset class="fieldset-border">
                                <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="ESI_account_no">Account No. / खाता नंबर<font color="red">*</font></label>
                                      <input type="text" name="ESI_account_no" class="form-control form-control-sm" id="ESI_account_no" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{@$VendorData->{'ESI A_C No_'} ?? ''}}" {{$readonly}}>
                                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="ESI_no_employees">No of employees covered / कवर किए गए कर्मचारियों की संख्या<font color="red">*</font></label>
                                       <input type="text" name="ESI_no_employees" class="form-control form-control-sm" id="ESI_no_employees" placeholder="Enter No of employees covered"onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ @$VendorData->{'No_ Of Emp iun ESI'} ?? ''}}" {{$readonly}}>
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
                                      <input type="text" name="EPF_account_no" class="form-control form-control-sm" id="EPF_account_no" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{@$VendorData->{'EPF A_c No_'} ?? ''}}" {{$readonly}}>
                                    </div>
                                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="Name">No of employees covered / कवर किए गए कर्मचारियों की संख्या<font color="red">*</font></label>
                                      <input type="text" name="EPF_no_of_employees" class="form-control form-control-sm" id="EPF_no_of_employees" placeholder="Enter No of employees covered" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{@$VendorData->{'No_ Of Emp in EPF'} ?? ''}}" {{$readonly}}>
                                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                                    </div>
                                  </div>
                                </div>
                            </fieldset>
                        </div>
                        <a class="btn btn-primary reg-previous-button">Previous</a>
                        <a class="btn btn-primary internet-next-button" id="tab_3">Next</a>
                    </div>

                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Report of average monthly unique user count for last
                                                        6 months certified by website auditor / वेबसाइट
                                                        ऑडिटर द्वारा प्रमाणित पिछले 6 महीनों की औसत मासिक यूनिक यूजर काउंट की रिपोर्ट <font color="red">*</font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="auditor_report" id="auditor_report" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="auditor_report2"  for="auditor_report">{{ @$VendorData->{'Auditor Report File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'Auditor Report File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'Auditor Report File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="auditor_report3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="auditor_report1" class="error invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Upload document for Pan Card / पैन कार्ड के लिए
                                        दस्तावेज अपलोड करें <font color="red">*</font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="pan_upload_file_name" id="pan_upload_file_name" {$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="pan_upload_file_name2"  for="pan_upload_file_name">{{ @$VendorData->{'PAN Upload File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'PAN Upload File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'PAN Upload File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="pan_upload_file_name3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="pan_upload_file_name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Upload document for GST. / जीएसटी के लिए दस्तावेज
                                        अपलोड करें। <font color="red">*</font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="gst_upload_file_name" id="gst_upload_file_name"  {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="gst_upload_file_name2"  for="gst_upload_file_name">{{ @$VendorData->{'GST Upload File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'GST Upload File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'GST Upload File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="gst_upload_file_name3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="gst_upload_file_name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> 3PAS (party at server) certificate engagement with
                                        BOC / बीओसी के साथ 3PAS (सर्वर पर पार्टी) प्रमाणपत्र जुड़ाव <font color="red">*
                                        </font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="pas_certificate_file_name" id="pas_certificate_file_name" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="pas_certificate_file_name2"  for="pas_certificate_file_name">{{ @$VendorData->{'3PAS Certificate File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'3PAS Certificate File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'3PAS Certificate File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="pas_certificate_file_name3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="pas_certificate_file_name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Certificate to insure that websites work owned and
                                        operated in india / यह सुनिश्चित करने के लिए प्रमाणपत्र कि वेबसाइटें भारत में
                                        स्वामित्व और संचालन में काम करती हैं <font color="red">*</font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="ooic_file_name" id="ooic_file_name" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="ooic_file_name2"  for="ooic_file_name">{{ @$VendorData->{'OOIC File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'OOIC File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'OOIC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="ooic_file_name3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="ooic_file_name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile">Annexure-A for rates / दरों के लिए अनुलग्नक-ए <font
                                            color="red">*</font></label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="annexure_a_file_name" id="annexure_a_file_name" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="annexure_a_file_name2"  for="annexure_a_file_name">{{ @$VendorData->{'Annexure A File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'Annexure A File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'Annexure A File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="annexure_a_file_name3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="annexure_a_file_name1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Notarized certificate under name, signature and seal
                                        stating that information is correct /नाम, हस्ताक्षर और मुहर के तहत नोटरीकृत
                                        प्रमाण पत्र जिसमें कहा गया है कि जानकारी सही है <font color="red">*</font>
                                    </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="notarized_certificate" id="notarized_certificate" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="notarized_certificate2"  for="notarized_certificate">{{ @$VendorData->{'Notorized Cert_ File Name'} ?? 'Choose file' }}</label>
                                        </div>

                                        @if(@$VendorData->{'Notorized Cert_ File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'Notorized Cert_ File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="notarized_certificate3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="notarized_certificate1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputFile"> Payment fee for Rs. 5000/- (INR) / भुगतान शुल्क रु. 5000/- (INR) <font color="red">*</font></label>
                                    </label>
                                        <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" {{$disabled}} class="custom-file-input {{$click}}" name="fees_payment" id="fees_payment" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="fees_payment2"  for="fees_payment">{{ @$VendorData->{'Fees Payment File Name'} ?? 'Choose file' }}</label>
                                        </div>
                                        @if(@$VendorData->{'Fees Payment File Name'} != '')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/internet_website/{{ @$VendorData->{'Fees Payment File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            </div>
                                            @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="fees_payment3">Upload</span>
                                        </div>
                                        @endif
                                        </div>
                                        <span id="fees_payment1" class="error invalid-feedback"></span>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" name="doc[]" id="doc_data">
                        <a class="btn btn-primary reg-previous-button">Previous</a>
                        @if(@$VendorData->{'Status'} == 1)
                        <a class="btn btn-primary callfinal" id="tab_4" style="pointer-events:none;">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                        @else
                        <a class="btn btn-primary internet-next-button" id="tab_4">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                        @endif
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
<script src="{{ url('/js') }}/fresh-internet-website.js"></script>
<script>
//upload file validation
function validateImage() {
    var formData = new FormData();
    var file = document.getElementById("img").files[0];
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        alert('Please select a valid image file');
        document.getElementById("img").value = '';
        return false;
    }
    return true;
}

//ps code
$(document).ready(function() {
    $("#owner_state0").on('change', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data");
       //alert($(this).attr("data"));
      $("#owner_district").empty();
      $.ajax({
        type: 'get',
        url: "/intfetchDistricts",
        data: { state_id: $(this).val() },
        success: function(data) {
          console.log(data);
          $("#owner_district").html(data.message);
        }
      });
    }
  });
});

$(document).ready(function() {
    $("#owner_state0").on('change', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data");
       //alert($(this).attr("data"));
      $("#city").empty();
      $.ajax({
        type: 'get',
        url: "/intfetchDistricts",
        data: { state_id: $(this).val() },
        success: function(data) {
          console.log(data);
          $("#city").html(data.message);
        }
      });
    }
  });
});
$("#add_davp").hide();
$("#add_row_davp").hide();
 if ($("#davp_panel").is(':checked')) {
        $("#add_davp").show();
        $("#add_row_davp").show();
    } else {
        $("#add_davp").hide();
        $("#add_row_davp").hide();
    }
$("#davp_panel").click(function() {
    if ($(this).is(':checked')) {
        $("#add_davp").show();
        $("#add_row_davp").show();
    } else {
        $("#add_davp").hide();
        $("#add_row_davp").hide();
    }
});

//select dropdown
var $select1 = $('#select1'),
    $select2 = $('#select2'),
    $options = $select2.find('option');

$select1.on('change', function() {
    $select2.html($options.filter('[value="' + this.value + '"]'));
}).trigger('change');
//end select dropdown

$(document).ready(function() {
    $("#add_row").click(function() {
        $("#add_davp").append(
            '<div class="row"><div class="col-md-4"><div class="form-group"><label for="title">Title / शीषक</label><input type="text" name="title[]" placeholder="Enter Title" class="form-control form-control-sm" id="title"></div></div><div class="col-md-4"><div class="form-group"><label>Language / भाषा<font color="red">*</font></label><select name="lang[]" class="form-control form-control-sm select2bs4" style="width: 100%;"><option selected="selected">Alabama</option><option>Alaska</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="publication">Place of Publication / प्रकाशन का स्थान</label><input type="text" placeholder="Enter Place of Publication" name="publication[]" class="form-control form-control-sm" id="publication"></div></div><div class="col-md-4"><div class="form-group"><label>Periodicity / आवधि</label><select name="periodicity[]" class="form-control form-control-sm select2bs4" style="width: 100%;"><option selected="selected">Alabama</option><option>Alaska</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="davp">DAVP Code (If empanelled) / डीएवीपी कोड ( अगर पैनल म है )</label><input type="text" name="davp[]" placeholder="Enter DAVP Code" class="form-control form-control-sm" id="davp"></div></div><div class="col-md-4"><div class="form-group"><label for="edition_distance">Distance from this Edition(In Km) / इस संरण की दूरी (िक.मी. म)</label><input type="text" Place of placeholder="Enter Distance" name="edition_distance[]" class="form-control form-control-sm" id="edition_distance"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row">Remove</button></div></div>'
        );
    });
    $("#add_davp").on('click', '.remove_row', function() {
        $(this).parent().parent().remove();
    });
});

//Date range picker
$('#reservation').daterangepicker()
//Date range picker with time picker
$('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
        format: 'MM/DD/YYYY hh:mm A'
    }
})
//Date range as a button
$('#daterange-btn').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    },
    function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
)

//Pan card validation
function validatePanNumber(pan) {
    let pannumber = $(pan).val().toUpperCase();
    if (pannumber.match(/^[A-z]{5}\d{4}[A-Z]{1}$/)) {
        $(pan).val(pannumber);
        $("#alert_" + pan.id).text(" Valid PAN number").show().css("color", "green");
    } else {
        $("#alert_" + pan.id).text(" Invalid PAN number").show().css("color", "red");
        // $(pan).val("");
    }
}

//IFSC Code validation
function validateIfscCode(ifsc) {
    let ifscnumber = $(ifsc).val().toUpperCase();
    if (ifscnumber.match(/^[A-Z]{4}0[0-9]{6}$/)) {
        $(ifsc).val(ifscnumber);
        $("#alert_" + ifsc.id).text("Valid IFSC code").show().css("color", "green");
    } else {
        $("#alert_" + ifsc.id).text("Invalid IFSC code").show().css("color", "red");
        //  $(ifsc).val("");
    }
}

//GST No Validation

function checksumsole(gst_no) {
    // alert('priyanshi');
    let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(gst_no);
    if (regTest) {
        var gstMsg = 'GST No. is valid format';
        $('.gstvalidationMsg').removeClass('alert-info-msg2');
        $('.gstvalidationMsg').addClass('alert-info-msg');
        $('.gstvalidationMsg').text(gstMsg);
        $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
        return true;
    } else {
        var gstMsg = 'Enter Valid format GST No. like(18AABCU9603R1ZM)';
        $('.gstvalidationMsg').removeClass('alert-info-msg');
        $('.gstvalidationMsg').addClass('alert-info-msg2');
        $('.gstvalidationMsg').text(gstMsg);
        $('.validcheck').html("");
        return false;
    }
}
</script>
@endsection
