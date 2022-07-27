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

    .subheading1 {
      font-size: 16px;
      font-weight: 500;
      color: #060606;
      border-bottom: solid 1px #060606;
      margin-bottom: 15px;
    }
    .divmargin {
      margin-top: 19px;
    }

    </style>

@section('content')
@php
$branchcheckyes = '';
$branchcheckno = 'checked';
$branchdisplayform = 'none';
if(!empty($data->{'other_category'})){
$branchcheckyes = 'checked';
$branchcheckno = '';
$branchdisplayform = 'block';
}

// $organizationcheckyes = '';
// $organizationcheckno = 'checked';
// $organizationdisplayform = 'none';
// if(!empty($data->{'organization_register'})){
// $organizationcheckyes = 'checked';
// $organizationcheckno = '';
// $organizationdisplayform = 'block';
// }

@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <!--<h1>Application Form for Fresh Empanelment of Newspaper</h1>-->
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-default">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of AV Producer</h6>
                <div class="col-xl-4" style="margin-right: -104px;">
                    @if($data != '' && @$data->Modification == 1)
                    <a href="{{url('av-pdf/'.@$data->userid) }}" class="m-0 font-weight-normal text-primary" download><i class="fa fa-download"></i> Audio Video Application Receipt</a>
                    @endif
                   </div>
              </div>
            <!-- /.end card-header -->
          <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
            @if(Session::has('show_msg'))
            <div id="show_box" class="alert alert-success">
                <div id="show_msg" align="center" class="alert alert-success text-primary">{{Session::get('show_msg')}}</div>
            </div>
            @endif
            <div class="card-body p-3">
              <form method="post"  id="av_media_producers">
               @csrf
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active show" style="pointer-events: none;" data-toggle="tab" href="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" style="pointer-events: none;" data-toggle="tab" href="#tab2">AV Producer Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" style="pointer-events: none;" data-toggle="tab" href="#tab3">Account Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" style="pointer-events: none;" data-toggle="tab" href="#tab4">Upload Document</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    @php
                      // dd($data->Modification);
                    if(@$data->Modification=='1')
                    {
                      $readonly_field='readonly';
                      $disabled_field='';
                      $tab='-1';
                      $pointer='none';
                      $click='preventLeftClick';
                      $checked = 'checked';
                      $disablcheck = 'disabled';
                    }
                    else{
                      $readonly_field='';
                      $disabled_field='';
                      $tab='';
                      $pointer='';
                      $click='';
                      $checked='';
                      $disablcheck = '';
                    }
                    @endphp
                    <!-- your steps content here -->
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row">
                        <div class="row col-md-12 ml-1">
                          <h4 class="subheading">Category / श्रेणी :</h4>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Category Applied For / श्रेणी के लिए आवेदन किया : <span style="color: red;">*</span></label>
                            <!-- select2bs4 -->
                            <select name="category" id="category" {{$readonly_field}}  class="form-control form-control-sm {{$click}}" style="width: 100%; pointer-events: {{$pointer}};" tabindex="{{$tab}}">
                              <option value="">Please Select</option>
                              <option value="0" {{@$data->{'category'} == "0"  ? 'selected' : ''}}>A</option>
                              <option value="1" {{@$data->{'category'} == "1"  ? 'selected' : ''}}>B</option>
                              <option value="2" {{@$data->{'category'} == "2"  ? 'selected' : ''}}>C</option>
                              <option value="3" {{@$data->{'category'} == "3"  ? 'selected' : ''}}>Special Category</option>
                            </select>
                          </div>
                        </div>
                        <br><br>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="other_category">Do you have Branch Office in Delhi or Outside Delhi / क्या आपका शाखा कार्यालय दिल्ली में है या दिल्ली के बाहर है</label>
                                <input type="radio" name="other_category" value="1" onclick="BranchOfficeDiv(this)" {{ $branchcheckyes }}> Yes
                                <input type="radio" name="other_category" value="0" onclick="BranchOfficeDiv(this)" {{ $branchcheckno }}> No
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="have_office" style="display: {{ $branchdisplayform }}">
                            <label for="other_category">Branch Office Address / शाखा कार्यालय का पता:</label>
                            <input type="text" name="have_office" value="{{$data->have_office ?? ''}}" {{$readonly_field}}  placeholder="Enter Office Address" class="form-control form-control-sm"onkeypress="isAlphaNumeric(event)" maxlength="150">
                           </div><br>
                        </div>
                    </div>
                      <div class="row">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Contact Details / सम्पर्क करने का विवरण:</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name_executive_producers">Name of the Executive Producer / कार्यकारी निर्माता का नाम <span style="color: red;">*</span></label>
                            <input type="text" name="name_executive_producers" value="{{$data->name ?? ''}}" {{$readonly_field}}  id="name_executive_producers"  placeholder="Enter Name of the Executive Producer" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this);" maxlength="100">
                          </div>
                        </div>
                        <br><br>
                        <div class="col-md-6"></div>
                        <div class="row col-md-12 ml-1">
                          <h6 class="subheading">Organization Details / संगठन विवरण :</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="office_address">Name of Organization / संगठन का नाम <span style="color: red;">*</span></label>
                              <input type="text" name="organization_name" value="{{$data->organization_name ?? ''}}" {{$readonly_field}}  id="organization_name"  placeholder="Enter Name of the Organization" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this);" maxlength="100">
                            </div>
                          </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="office_address">Office Address in Full / कार्यालय का पूरा पता <span style="color: red;">*</span></label>
                            <textarea type="text" name="office_address"  rows="2" {{$readonly_field}}  placeholder="Enter Office Address In full" class="form-control form-control-sm"  maxlength="220">{{$data->office_address ?? ''}}</textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="residential_address">Residential Address of the Executive Producer / कार्यकारी निर्माता का आवासीय पता <span style="color: red;">*</span></label>
                            <input type="text" name="residential_address" value="{{ $data->residential_address ?? '' }}" {{$readonly_field}}  placeholder="Enter Residential Address of The Executive Producer" maxlength="220" class="form-control form-control-sm">
                          </div>
                        </div>
                        {{-- <div class="col-md-12">
                          <h5>Phone No. :</h5>
                        </div> --}}
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="office_telephone_no">Office Telephone / कार्यालय टेलीफोन</label>
                            <input type="text" name="office_telephone_no" value="{{ $data->office_telephone_no ?? '' }}" {{$readonly_field}}  placeholder="Enter Office Telephone" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="15">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="resident_telephone_no">Resident Telephone / निवासी टेलीफोन</label>
                            <input type="text" name="resident_telephone_no" value="{{ $data->resident_telephone_no ?? '' }}" {{$readonly_field}} placeholder="Enter Resident Telephone" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="15">
                          </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="form-group">
                            <label for="fax_noo">Fax No. / फ़ैक्स नंबर</label>
                            <input type="text" name="fax_noo" value="{{$data->fax_noo ?? ''}}"  placeholder="Enter Fax No." {{$readonly_field}} class="form-control form-control-sm" id="fax_noo" onkeypress="return onlyNumberKey(event)" maxlength="15">
                          </div>
                        </div> --}}
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="mobile">Mobile No./ मोबाइल नंबर <span style="color: red;">*</span></label>
                            <input type="text" name="mobile" value="{{$data->mobile ?? ''}}"  placeholder="Enter Mobile No." {{$readonly_field}} class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">E-Mail ID / ई-मेल आईडी <span style="color: red;">*</span></label>
                            <input type="text" name="email" value="{{$data->email ?? ''}}"  placeholder="Enter E-Mail ID" {{$readonly_field}} class="form-control form-control-sm" id="email" maxlength="40">
                            <span style="color: red;" id="email_err"></span>
                          </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="form-group">
                            <label for="have_office">Branch Office / Offices other than indicated above in Delhi or outside Delhi / दिल्ली में या दिल्ली के बाहर ऊपर बताए गए के अलावा शाखा कार्यालय / कार्यालय</label>
                            <input id="have_office" name="have_office" value="{{$data->have_office ?? ''}}" {{$readonly_field}}  placeholder="Enter Office Details" class="form-control form-control-sm" type="text" maxlength="150">
                          </div>
                        </div> --}}
                        <div class="row col-md-12 ml-1">
                            <h6 class="subheading">Delhi Address if Headquarters is not in Delhi / दिल्ली का पता अगर मुख्यालय दिल्ली में नहीं है:</h6>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="contact_person">Contact Person / संपर्क व्यक्ति</label>
                            <input id="contact_person" name="contact_person" value="{{$data->contact_person ?? ''}}" {{$readonly_field}}  onkeypress="return onlyAlphabets(event,this);" placeholder="Enter Contact Person" class="form-control form-control-sm" type="text" maxlength="50">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="telephone_no">Phone No. / फ़ोन नंबर</label>
                            <input id="telephone_no" name="phone" value="{{$data->phone ?? ''}}"  placeholder="Enter Phone No." {{$readonly_field}} class="form-control form-control-sm" type="text" maxlength="15" onkeypress="return onlyNumberKey(event)">
                          </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="form-group">
                            <label for="Contact_Person_Fax">Fax No. / फैक्स नंबर</label>
                            <input id="Contact_Person_Fax" value="{{$data->Contact_Person_Fax ?? ''}}" {{$readonly_field}}  onkeypress="return onlyNumberKey(event)" name="Contact_Person_Fax" placeholder="Enter Office Details" class="form-control form-control-sm" type="text" maxlength="15">
                          </div>
                        </div> --}}
                      </div>
                      <!--  <button class="btn btn-primary media_producers-next-button" onclick="stepper.next()">Next</button> -->
                    @if (!empty($data->name)!='')
                    <input type="hidden" name="tab_one" id="tab-one" value="0">
                    @else
                    <input type="hidden" name="tab_one" id="tab-one" value="1">
                    @endif

                      @if(@$data->status==1)
                      <a class="btn btn-primary media-producers-next-button" id="tab_11111" tab1-one="1">Next</a>
                      @else
                      <a class="btn btn-primary media-producers-next-button" id="tab_1" tab1-one="1">Next</a>
                      @endif
                    </div>
                    <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row col-md-12 ml-1">
                        <h5 class="subheading">Legal Status of Organization / संगठन की कानूनी स्थिति:</h5>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-12">
                          <!-- radio -->
                          <div class="form-group clearfix">
                            <label for="organization_registered">If your Organization Registered Under Companies Act? / क्या प्रेस का स्वामित्व अखबार के मालिक के पास है?</label>
                            <br>
                            <div class="icheck-primary d-inline">
                              <input type="radio" id="organization_registered1"  name="organization_register" {{$disabled_field}}  value="1" @if(!empty($data->organization_register)=="1") {{'checked'}} @endif>
                              <label for="organization_registered1">Yes / हाँ </label>&nbsp;&nbsp;
                            </div>
                            <div class="icheck-primary d-inline">
                              <input type="radio" id="organization_registered2"  name="organization_register" {{$disabled_field}}  value="0" @if(!empty($data->organization_register)=="0") {{'checked'}} @endif>
                              <label for="organization_registered2">No / नहीं</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      @php
                          if(!empty($data->organization_register)=='1')
                          {
                            $display='';
                            $disabled='';
                          }
                          else
                          {
                            $display='none';
                            $disabled='disabled';
                          }
                      @endphp
                      <div class="row" id="org_type" style="display: {{$display}};">
                        <div class="col-xl-6">
                          <div class="form-group">
                            <label for="">Select Organization Type / संगठन का प्रकार चुनें : <span style="color: red;">*</span></label>
                            <select name="org_type" id="sel_type"  {{ $disabled }} {{$disabled_field}} {{ $readonly_field }} class="form-control form-control-sm {{$click}}" style="width: 100%; pointer-events: {{$pointer}};" tabindex="{{$tab}}">
                              <option value="">Select Organization</option>
                              <option value="1" {{@$data->org_type ==1  ? 'selected' : ''}}>Partnership Firm</option>
                              <option value="2" {{@$data->org_type ==2  ? 'selected' : ''}}>Company</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      @php
                          if(@$data->org_type=='1') //both condition check
                          {
                            $display_firm='';
                            $disabled='';
                          }
                          else
                          {
                            $display_firm='none';
                            $disabled='disabled';
                          }
                      @endphp
                      <div class="row" id="partnership_firm1" style="display:{{$display_firm}}">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Partnership Firm :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="partnership_firm_state">State / राज्य <span style="color: red;">*</span></label> <!-- add class for search select2bs4 -->
                            <select name="partnership_firm_state" id="p_state" class="form-control form-control-sm  {{$click}}" {{ $readonly_field }} style="width: 100%; pointer-events: {{$pointer}};" tabindex="{{$tab}}" {{$disabled}} {{$disabled_field}} >
                              <option value="">Please Select State</option>
                              <!--<option value="0" @if(!empty($data->partnership_firm_state)=='0') {{'selected'}} @endif >A</option>
                              <option value="1" @if(!empty($data->partnership_firm_state)=='1') {{'selected'}} @endif >B</option>-->

                              <option value="0" {{@$data->{'partnership_firm_state'} == "0"  ? 'selected' : ''}} >Andhra Pradesh</option>
                              <option value="1" {{@$data->{'partnership_firm_state'} == "1"  ? 'selected' : ''}} >Arunachal Pradesh</option>
                              <option value="2" {{@$data->{'partnership_firm_state'} == "2"  ? 'selected' : ''}}>Assam</option>
                              <option value="3" {{@$data->{'partnership_firm_state'} == "3"  ? 'selected' : ''}}>Bihar</option>
                              <option value="4" {{@$data->{'partnership_firm_state'} == "4"  ? 'selected' : ''}}>Chhattisgarh</option>
                              <option value="5" {{@$data->{'partnership_firm_state'} == "5"  ? 'selected' : ''}}>Goa</option>
                              <option value="6" {{@$data->{'partnership_firm_state'} == "6"  ? 'selected' : ''}}>Gujarat</option>
                              <option value="7" {{@$data->{'partnership_firm_state'} == "7"  ? 'selected' : ''}}>Haryana</option>
                              <option value="8" {{@$data->{'partnership_firm_state'} == "8"  ? 'selected' : ''}}>Himachal Pradesh</option>
                              <option value="9" {{@$data->{'partnership_firm_state'} == "9"  ? 'selected' : ''}}>Jharkhand</option>
                              <option value="10" {{@$data->{'partnership_firm_state'} == "10"  ? 'selected' : ''}}>Karnataka</option>
                              <option value="11" {{@$data->{'partnership_firm_state'} == "11"  ? 'selected' : ''}}>Kerala</option>
                              <option value="12" {{@$data->{'partnership_firm_state'} == "12"  ? 'selected' : ''}}>Madhya Pradesh</option>
                              <option value="13" {{@$data->{'partnership_firm_state'} == "13"  ? 'selected' : ''}}>Maharashtra</option>
                              <option value="14" {{@$data->{'partnership_firm_state'} == "14"  ? 'selected' : ''}}>Manipur</option>
                              <option value="15" {{@$data->{'partnership_firm_state'} == "15"  ? 'selected' : ''}}>Meghalaya</option>
                              <option value="16" {{@$data->{'partnership_firm_state'} == "16"  ? 'selected' : ''}}>Mizoram</option>
                              <option value="17" {{@$data->{'partnership_firm_state'} == "17"  ? 'selected' : ''}}>Nagaland</option>
                              <option value="18" {{@$data->{'partnership_firm_state'} == "18"  ? 'selected' : ''}}>Odisha</option>
                              <option value="19" {{@$data->{'partnership_firm_state'} == "19"  ? 'selected' : ''}}>Punjab</option>
                              <option value="20" {{@$data->{'partnership_firm_state'} == "20"  ? 'selected' : ''}}>Rajasthan</option>
                              <option value="21" {{@$data->{'partnership_firm_state'} == "21"  ? 'selected' : ''}}>Sikkim</option>
                              <option value="22" {{@$data->{'partnership_firm_state'} == "22"  ? 'selected' : ''}}>Tamil Nadu</option>
                              <option value="23" {{@$data->{'partnership_firm_state'} == "23"  ? 'selected' : ''}}>Telangana</option>
                              <option value="24" {{@$data->{'partnership_firm_state'} == "24"  ? 'selected' : ''}}>Tripura</option>
                              <option value="25" {{@$data->{'partnership_firm_state'} == "25"  ? 'selected' : ''}}>Uttar Pradesh</option>
                              <option value="26" {{@$data->{'partnership_firm_state'} == "26"  ? 'selected' : ''}}>Uttarakhand</option>
                              <option value="27" {{@$data->{'partnership_firm_state'} == "27"  ? 'selected' : ''}}>West Bengal</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="partners_address">Address of Partners / भागीदारों का पता <span style="color: red;">*</span></label>
                            <textarea type="text" name="partners_address" id="p_address" {{$disabled}} {{$readonly_field}} placeholder="Enter Address of Partners" rows="2" class="form-control form-control-sm">{{$data->partners_address ?? ''}}</textarea>
                          </div>
                        </div>
                      </div>
                      @php
                        if(@$data->org_type=='2')
                        {
                          $display_company='';
                          $disabled='';
                        }
                        else
                        {
                          $display_company='none';
                          $disabled='disabled';
                        }
                    @endphp
                      <div class="row {{$click}}" id="company_firm1" style="display:{{$display_company}}">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">If Company :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="company_state">State / राज्य <span style="color: red;">*</span></label>
                            <select name="partnership_firm_state" id="c_state" class="form-control form-control-sm  {{$click}}" {{$disabled}} {{$disabled_field}} {{ $readonly_field }} style="width: 100%; pointer-events: {{$pointer}};" tabindex="{{$tab}}">
                              <option value="">Please Select State</option>
                              <option value="0" {{@$data->{'partnership_firm_state'} == "0"  ? 'selected' : ''}} >Andhra Pradesh</option>
                              <option value="1" {{@$data->{'partnership_firm_state'} == "1"  ? 'selected' : ''}} >Arunachal Pradesh</option>
                              <option value="2" {{@$data->{'partnership_firm_state'} == "2"  ? 'selected' : ''}}>Assam</option>
                              <option value="3" {{@$data->{'partnership_firm_state'} == "3"  ? 'selected' : ''}}>Bihar</option>
                              <option value="4" {{@$data->{'partnership_firm_state'} == "4"  ? 'selected' : ''}}>Chhattisgarh</option>
                              <option value="5" {{@$data->{'partnership_firm_state'} == "5"  ? 'selected' : ''}}>Goa</option>
                              <option value="6" {{@$data->{'partnership_firm_state'} == "6"  ? 'selected' : ''}}>Gujarat</option>
                              <option value="7" {{@$data->{'partnership_firm_state'} == "7"  ? 'selected' : ''}}>Haryana</option>
                              <option value="8" {{@$data->{'partnership_firm_state'} == "8"  ? 'selected' : ''}}>Himachal Pradesh</option>
                              <option value="9" {{@$data->{'partnership_firm_state'} == "9"  ? 'selected' : ''}}>Jharkhand</option>
                              <option value="10" {{@$data->{'partnership_firm_state'} == "10"  ? 'selected' : ''}}>Karnataka</option>
                              <option value="11" {{@$data->{'partnership_firm_state'} == "11"  ? 'selected' : ''}}>Kerala</option>
                              <option value="12" {{@$data->{'partnership_firm_state'} == "12"  ? 'selected' : ''}}>Madhya Pradesh</option>
                              <option value="13" {{@$data->{'partnership_firm_state'} == "13"  ? 'selected' : ''}}>Maharashtra</option>
                              <option value="14" {{@$data->{'partnership_firm_state'} == "14"  ? 'selected' : ''}}>Manipur</option>
                              <option value="15" {{@$data->{'partnership_firm_state'} == "15"  ? 'selected' : ''}}>Meghalaya</option>
                              <option value="16" {{@$data->{'partnership_firm_state'} == "16"  ? 'selected' : ''}}>Mizoram</option>
                              <option value="17" {{@$data->{'partnership_firm_state'} == "17"  ? 'selected' : ''}}>Nagaland</option>
                              <option value="18" {{@$data->{'partnership_firm_state'} == "18"  ? 'selected' : ''}}>Odisha</option>
                              <option value="19" {{@$data->{'partnership_firm_state'} == "19"  ? 'selected' : ''}}>Punjab</option>
                              <option value="20" {{@$data->{'partnership_firm_state'} == "20"  ? 'selected' : ''}}>Rajasthan</option>
                              <option value="21" {{@$data->{'partnership_firm_state'} == "21"  ? 'selected' : ''}}>Sikkim</option>
                              <option value="22" {{@$data->{'partnership_firm_state'} == "22"  ? 'selected' : ''}}>Tamil Nadu</option>
                              <option value="23" {{@$data->{'partnership_firm_state'} == "23"  ? 'selected' : ''}}>Telangana</option>
                              <option value="24" {{@$data->{'partnership_firm_state'} == "24"  ? 'selected' : ''}}>Tripura</option>
                              <option value="25" {{@$data->{'partnership_firm_state'} == "25"  ? 'selected' : ''}}>Uttar Pradesh</option>
                              <option value="26" {{@$data->{'partnership_firm_state'} == "26"  ? 'selected' : ''}}>Uttarakhand</option>
                              <option value="27" {{@$data->{'partnership_firm_state'} == "27"  ? 'selected' : ''}}>West Bengal</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="directors_address">Address of Directors / निर्देशकों का पता <span style="color: red;">*</span></label>
                            <textarea type="text" name="partners_address" id="c_address" {{$disabled}} {{$readonly_field}} placeholder="Enter Address of Directors" rows="2" class="form-control form-control-sm">{{$data->partners_address ?? ''}}</textarea>
                          </div>
                        </div>
                      </div>
                      @php
                        if(!empty($data->category)==0)
                        {
                          $display_a='';
                          $disabled_a='';
                        }
                        else
                        {
                          $display_a='none';
                          $disabled_a='disabled';
                        }
                      @endphp

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Select Organization Legal Status / संगठन कानूनी स्थिति चुनें : <span style="color: red;">*</span></label>
                              <select name="org_legal_status" id="org_legal_status" {{$readonly_field}} class="form-control form-control-sm {{$click}}" style="width: 100%; pointer-events: {{$pointer}};" tabindex="{{$tab}}">
                                <option value="">Select Organization Legal Status</option>
                                <option value="0" {{@$data->{'org_legal_status'} =="0"  ? 'selected' : ''}}>Private</option>
                                <option value="1" {{@$data->{'org_legal_status'} =="1"  ? 'selected' : ''}}>Public</option>
                                <option value="2" {{@$data->{'org_legal_status'} =="2"  ? 'selected' : ''}}>Ltd</option>
                                <option value="3" {{@$data->{'org_legal_status'} =="3"  ? 'selected' : ''}}>Others</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div class="row" id="section_a" style="display: {{$display_a}};">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Eligibility Criteria / पात्रता मापदंड :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="net_worth">Net Worth (For A/B/C Categories) / निवल मूल्य (ए/बी/सी श्रेणियों के लिए) <span style="color: red;">*</span></label>
                            <input type="text" name="net_worth" onkeypress="return onlyNumberKey(event);" value="@if(@$data->{'net_worth'} >0.0){{round(@$data->{'net_worth'},2) ?? ''}}@endif" {{$readonly_field}}  placeholder="Enter Net Worth (For A/B/C Categories)" class="form-control form-control-sm" id="net_worth_a" maxlength="38">
                            <div class="col-md-12">Please see annexure for Details</div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="details_programme">Details of Programme / कार्यक्रम का विवरण <span style="color: red;">*</span></label>
                            <input type="text" name="details_programme" value="{{$data->details_programme ?? ''}}" {{$readonly_field}}   placeholder="Enter Details of Programme" class="form-control form-control-sm" id="details_programme_a" maxlength="100">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Channel">Channel in which Telecast/Broadcast / चैनल जिसमें प्रसारण/प्रसारण <span style="color: red;">*</span></label>
                            <input type="text" name="Channel" value="{{$data->Channel ?? ''}}" {{$readonly_field}}   placeholder="Enter Channel in Which Telecast/Broadcast ." class="form-control form-control-sm" id="Channel_a" maxlength="50">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            @php
                                // $date=date('m/d/Y h:i:s a', time());
                                // date('d-m-Y', strtotime($data->telecast_date));
                                $today=date('Y-m-d');
                            @endphp
                            <label for="telecast_date">Date/Time of Telecast / प्रसारण की तिथि/समय <span style="color: red;">*</span></label>
                            {{-- <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY"  value="{{date('Y-m-d', strtotime($data->telecast_date)) ?? ''}}" {{$readonly_field}}  placeholder="DD/MM/YYYY" class="form-control form-control-sm"> --}}

                            {{-- <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY" value="{{date('Y-m-d', strtotime(@$data->telecast_date)) ?? ''}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_a"> --}}
                            @if ((@date('Y-m-d', strtotime(@$data->telecast_date))=='1970-01-01') || (@date('Y-m-d', strtotime(@$data->telecast_date))=='1900-01-01'))
                                <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY"  min="{{$today}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_a">
                            @else
                                <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY" min="{{$today}}" value="{{date('Y-m-d', strtotime(@$data->telecast_date)) ?? ''}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_a">
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="trp">TRP Ratings of Programme / कार्यक्रम की टीआरपी रेटिंग <span style="color: red;">*</span></label>
                            <input type="text" name="TRP" value="{{$data->TRP ?? ''}}" {{$readonly_field}}  onkeypress="return onlyNumberKey(event);"  placeholder="Enter TRP Ratings of Programme" class="form-control form-control-sm" id="TRP_a" maxlength="5">
                          </div>
                        </div>
                      </div>
                      <!-- end abc -->
                      @php
                        if(@$data->{'category'} == 1)
                        {
                          $display_b='';
                          $disabled_b='';
                        }
                        else
                        {
                          $display_b='none';
                          $disabled_b='disabled';
                        }
                      @endphp
                      <div class="row" id="section_b" style="display: {{$display_b}};">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Eligibility Criteria / पात्रता मापदंड :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="net_worth">Net Worth (for A/B/C Categories) / निवल मूल्य (ए/बी/सी श्रेणियों के लिए) <span style="color: red;">*</span></label>
                            <input type="text" name="net_worth" value="@if(@$data->{'net_worth'} > 0.0){{round(@$data->{'net_worth'},2) ?? ''}}@endif" {{$readonly_field}}   placeholder="Enter Net worth (for A/B/C Categories)" class="form-control form-control-sm" id="net_worth_b" onkeypress="return onlyNumberKey(event);" maxlength="38">
                            <div class="col-md-12">(Please see annexure for Details)</div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="details_programme">Details of Programme / कार्यक्रम का विवरण <span style="color: red;">*</span></label>
                            <input type="text" name="details_programme" value="{{$data->details_programme ?? ''}}" {{$readonly_field}}   placeholder="Enter Details of Programme" class="form-control form-control-sm" id="details_programme_b" maxlength="100">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="Channel">Channel in Which Telecast/Broadcast / चैनल जिसमें प्रसारण/प्रसारण <span style="color: red;">*</span></label>
                            <input type="text" name="Channel" value="{{$data->Channel ?? ''}}" {{$readonly_field}}  placeholder="Enter Channel in which Telecast/Broadcast ." class="form-control form-control-sm" id="Channel_b" maxlength="50">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">

                            <label for="telecast">Date/Time of Telecast / प्रसारण की तिथि/समय <span style="color: red;">*</span></label>
                            <!--<input type="date" name="telecast_date" value="{{$data->telecast_date ?? ''}}" {{$readonly_field}}  placeholder="DD/MM/YYYY" class="form-control form-control-sm hasDatepicker" id="datepicker1_b">-->
                            @if ((@date('Y-m-d', strtotime(@$data->telecast_date))=='1970-01-01') || (@date('Y-m-d', strtotime(@$data->telecast_date))=='1900-01-01'))
                                <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY" min="{{$today}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_b">
                            @else
                                <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY" min="{{$today}}" value="{{date('Y-m-d', strtotime(@$data->telecast_date)) ?? ''}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_b">
                            @endif
                            {{-- <input type="date" name="telecast_date" data-date="" data-date-format="DD MM YYYY" min="{{$today}}" value="{{date('Y-m-d', strtotime(@$data->telecast_date)) ?? ''}}" {{$readonly_field}}  class="form-control form-control-sm" id="datepicker1_b"> --}}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="trp">TRP Ratings of Programme / कार्यक्रम की टीआरपी रेटिंग <span style="color: red;">*</span></label>
                            <input type="text" name="TRP" value="{{$data->TRP ?? ''}}" {{$readonly_field}} onkeypress="return onlyNumberKey(event);" placeholder="Enter TRP Ratings of Programme" class="form-control form-control-sm" id="TRP_b" maxlength="5">
                          </div>
                        </div>
                        <div class="col-md-12">In Case Of Application for Category b, Please Provide Details of Studio Below :</div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="address_studio">Address of Studio / स्टूडियो का पता <span style="color: red;">*</span></label>
                            <textarea type="text" name="address_studio"   id="address_studio_b" {{$readonly_field}} placeholder="Enter Address of Studio" rows="2" class="form-control form-control-sm" maxlength="250">{{$data->address_studio ?? ''}}</textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="landline_no">Phone No. / फ़ोन नंबर <span style="color: red;">*</span></label>
                            <input type="text" name="landline_no" value="{{$data->landline_no ?? ''}}" {{$readonly_field}}  placeholder="Enter Phone No." class="form-control form-control-sm" id="landline_no_b" onkeypress="return onlyNumberKey(event)" maxlength="15">
                          </div>
                        </div>

                      </div>
                      @php
                        if(@$data->{'category'} == 2)
                        {
                          $display_c='';
                          $disabledc='';
                        }
                        else
                        {
                          $display_c='none';
                          $disabledc='disabled';
                        }
                      @endphp

                      <div class="row" id="section_c" style="display: {{$display_c}};">
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Eligibility Criteria / पात्रता मापदंड :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="net_worth">Net Worth (for a/b/c categories) / निवल मूल्य (ए/बी/सी श्रेणियों के लिए) <span style="color: red;">*</span></label>
                            <input type="text" name="net_worth" onkeypress="return onlyNumberKey(event);" value="@if(@$data->{'net_worth'} > 0.0){{round(@$data->{'net_worth'},2) ?? ''}}@endif" {{$readonly_field}}   placeholder="Enter Net Worth (for A/B/C Categories)" class="form-control form-control-sm" id="net_worth_c" maxlength="38">
                            <div class="col-md-12">Please see annexure for Details</div>
                          </div>
                        </div>
                        <div class="col-md-12">In Case of Application for Category C, You May Provide :</div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="number_of_audio">The number of audio-spots/jingles/video spots produced by you in the last three years / पिछले तीन वर्षों में आपके द्वारा उत्पादित ऑडियो-स्पॉट/जिंगल्स/वीडियो स्पॉट की संख्या <span style="color: red;">*</span></label>
                            <input type="text" name="number_of_audio" value="@if(@$data->{'number_of_audio'} >0){{@$data->{'number_of_audio'}  ?? ''}}@endif" {{$readonly_field}}  onkeypress="return onlyNumberKey(event);" class="form-control form-control-sm" id="number_of_audio_c" maxlength="50" placeholder="Enter Number of audio spots">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="government_departments">How many of above has been for clients other than davp/government departments / उपरोक्त में से कितने डीएवीपी/सरकारी विभागों के अलावा अन्य ग्राहकों के लिए हैं</label>
                            <input type="text" name="government_departments" value="@if(@$data->{'government_departments'} > 0){{@$data->{'government_departments'}  ?? ''}}@endif" {{$readonly_field}} onkeypress="return onlyNumberKey(event);" class="form-control form-control-sm" id="government_departments_c" maxlength="50" placeholder="Enter Please fill clients">
                          </div>
                        </div>
                        <div class="col-md-12">If applying for special category, please give details below of professional experience :</div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="diploma_obtained">Institution from which degree/diploma was obtained / संस्थान जहां से डिग्री/डिप्लोमा प्राप्त किया था <span style="color: red;">*</span></label>
                            <input type="text" name="institution_name" value="{{$data->institution_name ?? ''}}" {{$readonly_field}}  class="form-control form-control-sm" id="diploma_obtained_c" onkeypress="return onlyAlphabets(event,this);" maxlength="80" placeholder="Enter Institution form Degree/Diploma">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="degree_year">Year in which obtained / वर्ष जिसमें प्राप्त <span style="color: red;">*</span></label>
                            <input type="text" name="degree_year" value="@if(@$data->{'degree_year'} > 0){{@$data->{'degree_year'}  ?? ''}}@endif" {{$readonly_field}}  onkeypress="return onlyNumberKey(event);" placeholder="Enter Year Year In Which Obtained" class="form-control form-control-sm" id="year_obtained_c" maxlength="4">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="degree_area">Area in which degree/diploma was obtained / क्षेत्र जिसमें डिग्री/डिप्लोमा प्राप्त किया था <span style="color: red;">*</span></label>
                            <input type="text" name="degree_area"  value="{{$data->degree_area ?? ''}}" {{$readonly_field}} class="form-control form-control-sm" id="area_c" maxlength="50" placeholder="Enter Area Of Degree/Diploma">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="list_of_award">Award if any / पुरस्कार यदि कोई हो</label>
                            <input type="text" name="list_of_award"  value="{{$data->list_of_award ?? ''}}" {{$readonly_field}} class="form-control form-control-sm" id="award_if_any_c" maxlength="200" placeholder="Any Award">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="list_of_programme">Name at least one programme in the applied category which has been produced by you, along with duration / लागू श्रेणी में कम से कम एक कार्यक्रम का नाम बताएं, जो अवधि के साथ आपके द्वारा तैयार किया गया है <span style="color: red;">*</span></label>
                            <input type="text" name="list_of_programme"  value="{{$data->list_of_programme ?? ''}}" {{$readonly_field}} class="form-control form-control-sm" id="one_programme_c" maxlength="200" placeholder="Programme applied">
                          </div>
                        </div>
                        <div class="row col-md-12 ml-1">
                          <h5 class="subheading">Preferred area work :</h5>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="checkbox" name="social_sector" id="social_sector_b" value="1" {{$disabled_field}}
                            @if(!empty($data->social_sector)==1) {{'checked'}} style="pointer-events: none;" @endif>
                            Social sector covering health & related issues, education, women & children issues, social & welfare issues etc.<br>
                            <input type="checkbox" name="infrastructure_sector"  id="social_sector_b" value="1" {{$disabled_field}}
                            @if(!empty($data->infrastructure_sector)==1) {{'checked'}} style="pointer-events: none;" @endif >
                            Infrastructure sector covering water resources irrigation, agriculture, road safety, rural development etc.<br>
                            <input type="checkbox" name="finance"  id="social_sector_b" value="1" {{$disabled_field}}
                            @if(!empty($data->finance)==1) {{'checked'}} style="pointer-events: none;" @endif>
                            Finance and others like tax compliance, consumer right awareness etc<br>
                            <input type="checkbox" name="national_integration"  id="social_sector_b" value="1" {{$disabled_field}}
                            @if(!empty($data->national_integration)==1) {{'checked'}} style="pointer-events: none;" @endif>
                            National integration, communal harmony and social harmony<br>
                            <input type="checkbox" name="defence_national"  id="social_sector_b" value="1" {{$disabled_field}}
                            @if(!empty($data->defence_national)==1) {{'checked'}} style="pointer-events: none;" @endif>
                            Defence and national security related subjects<br>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="other_relevant_information">Any other relevant information / कोई अन्य प्रासंगिक जानकारी</label>
                            <input type="text" name="other_relevant_information" {{$readonly_field}} value="{{$data->other_relevant_information ?? ''}}" class="form-control form-control-sm" id="other_relevant_information_c" maxlength="250" placeholder="Enter Any other information">
                          </div>
                        </div>
                      </div>
                      <a class="btn btn-primary reg-previous-button" id="previous_one">Previous</a>
                      @if(@$data->status==1)
                      <a class="btn btn-primary media-producers-next-button" id="tab_22222">Next</a>
                      @else
                      <a class="btn btn-primary media-producers-next-button" id="tab_2">Next</a>
                      @endif
                      {{-- <a class="btn btn-primary media-producers-next-button" id="tab_2">Next</a> --}}
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Bank Account Number for Receiving Payment / भुगतान प्राप्त करने के लिए बैंक खाता संख्या <font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Bank_account_number" id="Bank_account_number" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly_field}}  value="{{@$data->Account_No ?? ''}}">
                        </div>
                      </div>

                      <div class="col-md-4" style="margin-top: 25px;">
                        <div class="form-group">
                          <label for="Name">Account Holder Name / खाता धारक का नाम <font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="A_C_Holder_name" id="A_C_Holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly_field}}  value="{{@$data->payee_name ?? ''}}">
                        </div>
                      </div>
                      <div class="col-md-4" style="margin-top: 25px;">
                        <div class="form-group">
                          <label for="Name">IFSC Code / आईएफएससी कोड <font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="IFSC_code" id="IFSC_code" placeholder="Enter IFSC Code" maxlength="15" onkeypress="isAlphaNumeric(event)" onkeyup="ifscCodeFunction(this.value)" value="{{@$data->IFSC_Code ?? ''}}" {{$readonly_field}}>
                          <span id="IFSC_code_Error"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Bank Name / बैंक का नाम <font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Bank_name" id="Bank_name" placeholder="Enter Bank Name" maxlength="40"  onkeypress="return onlyAlphabets(event)" {{$readonly_field}}  value="{{@$data->Bank_Name ?? ''}}">

                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">Branch / शाखा <font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="Branch_name" id="Branch_name" placeholder="Enter Branch"  {{$readonly_field}} maxlength="50" value="{{@$data->Bank_Branch ?? ''}}">
                        </div>
                      </div>

                     <!--  <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address of account / खाते का पता<font color="red">*</font></label>
                         <textarea name="Bank_account_address" class="form-control form-control-sm" id="Bank_account_address" placeholder="Enter Address of account" maxlength="120">{{@$FMdata->{'Bank A_C Address'} ?? ''}}</textarea>


                        </div>
                      </div> -->
                     <!--   <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">GST No. / जीएसटी संख्या<font color="red">*</font></label>
                          <input type="text" name="GST_No" id="GST_No" class="form-control form-control-sm" placeholder="Enter GST No." maxlength="15" onkeypress="return isAlphaNumeric(event)"  value="{{@$FMdata->{'GST No_'} ?? ''}}">
                           <span id="GST_No_Error"></span>
                        </div>
                      </div> -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">PAN Card No./ पैन कार्ड नंबर <font color="red">*</font></label>
                         <input type="text" name="PAN_No" id="PAN_No" class="form-control form-control-sm inputUC" placeholder="Enter PAN card No." maxlength="10"
                         onkeypress="return isAlphaNumeric(event)" {{$readonly_field}}  value="{{@$data->pan_number ?? ''}}">
                         <span id="PAN_No_Error"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="dd_no1">Draft No. / ड्राफ्ट संख्या <span style="color: red;">*</span></label>
                            <input type="text" name="dd_no"  class="form-control form-control-sm" placeholder="Enter Draft No." maxlength="20" onkeypress="return onlyNumberKey(event);" {{$readonly_field}} value="{{@$data->dd_no ?? ''}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="drawn_on_bank2">Drawn on bank / बैंक पर ड्रा <span style="color: red;">*</span></label>
                            <input type="text" name="drawn_on_bank"  class="form-control form-control-sm" placeholder="Enter Drawn on Bank" onkeypress="return onlyAlphabets(event,this);" {{$readonly_field}} maxlength="50" value="{{@$data->drawn_on_bank ?? ''}}">
                          </div>
                        </div>
                      </div>
                      <a class="btn btn-primary reg-previous-button">Previous</a>
                      @if(@$data->status=='1')
                      <a class="btn btn-primary media-producers-next-button" id="tab_3333">Next</a>
                      @else
                      <a class="btn btn-primary media-producers-next-button" id="tab_3">Next</a>
                      @endif
                      {{-- <a class="btn btn-primary media-producers-next-button" id="tab_3">Next</a> --}}
                    </div>
                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                        <div class="row">
                          <div class="col-md-6">
                        <div class="form-group">
                            <label for="registration_certificate1">Legal status of organization copy of the certificate of registration may be attached / संगठन की कानूनी स्थिति पंजीकरण प्रमाण पत्र की प्रति संलग्न की जा सकती है<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$data->registration_certificate != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="registration_certificate_modify" id="registration_certificate_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="registration_certificate_modify" id="registration_certificate_modify2">{{ @$data->registration_certificate ? @$data->registration_certificate : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="registration_certificate_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="registration_certificate" id="registration_certificate">
                                    <label class="custom-file-label" id="registration_certificate2" for="registration_certificate">{{ @$data->registration_certificate != '' ? $data->registration_certificate : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="registration_certificate3">Upload</span>
                                </div>
                              @endif
                                @if(@$data->registration_certificate !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/audio/{{ @$data->registration_certificate ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="registration_certificate_File_Name" id="registration_certificate_File_Name" value="{{ @$data->registration_certificate }}">
                                </div>
                            @endif
                          </div>
                          <span id="registration_certificate1" class="error invalid-feedback"></span>
                          <span id="registration_certificate_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="income_tax_return1">Copy of income-tax return of last financial year to be attached /
                                पिछले वित्तीय वर्ष के आयकर रिटर्न की प्रति संलग्न की जाए<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$data->income_tax_return != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="income_tax_return_modify" id="income_tax_return_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="income_tax_return_modify" id="income_tax_return_modify2">{{ @$data->income_tax_return ? @$data->income_tax_return : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="income_tax_return_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="income_tax_return" id="income_tax_return">
                                    <label class="custom-file-label" id="income_tax_return2" for="income_tax_return">{{ @$data->income_tax_return != '' ? $data->income_tax_return : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="income_tax_return3">Upload</span>
                                </div>
                              @endif
                                @if(@$data->income_tax_return !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/audio/{{ @$data->income_tax_return ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="income_tax_return_File_Name" id="income_tax_return_File_Name" value="{{ @$data->income_tax_return }}">
                                </div>
                            @endif
                          </div>
                          <span id="income_tax_return1" class="error invalid-feedback"></span>
                          <span id="income_tax_return_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cancelled_cheque1">Copy of income-tax return of last financial year to be attached /
                                पिछले वित्तीय वर्ष के आयकर रिटर्न की प्रति संलग्न की जाए<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$data->cancelled_cheque != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cancelled_cheque_modify" id="cancelled_cheque_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="cancelled_cheque_modify" id="cancelled_cheque_modify2">{{ @$data->cancelled_cheque ? @$data->cancelled_cheque : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="cancelled_cheque_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="cancelled_cheque" id="cancelled_cheque">
                                    <label class="custom-file-label" id="cancelled_cheque2" for="cancelled_cheque">{{ @$data->cancelled_cheque != '' ? $data->cancelled_cheque : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="cancelled_cheque3">Upload</span>
                                </div>
                              @endif
                                @if(@$data->cancelled_cheque !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/audio/{{ @$data->cancelled_cheque ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="cancelled_cheque_File_Name" id="cancelled_cheque_File_Name" value="{{ @$data->cancelled_cheque }}">
                                </div>
                            @endif
                          </div>
                          <span id="cancelled_cheque1" class="error invalid-feedback"></span>
                          <span id="cancelled_cheque_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bio_data1">Copy of income-tax return of last financial year to be attached /
                                पिछले वित्तीय वर्ष के आयकर रिटर्न की प्रति संलग्न की जाए<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$data->bio_data != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="bio_data_modify" id="bio_data_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="bio_data_modify" id="bio_data_modify2">{{ @$data->bio_data ? @$data->bio_data : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="bio_data_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="bio_data" id="bio_data">
                                    <label class="custom-file-label" id="bio_data2" for="bio_data">{{ @$data->bio_data != '' ? $data->bio_data : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="bio_data3">Upload</span>
                                </div>
                              @endif
                                @if(@$data->bio_data !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/audio/{{ @$data->bio_data ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="bio_data_File_Name" id="bio_data_File_Name" value="{{ @$data->bio_data }}">
                                </div>
                            @endif
                          </div>
                          <span id="bio_data1" class="error invalid-feedback"></span>
                          <span id="bio_data_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>
                </div>
                      <div class="row">
                        <div class="col-md-12">
                         <!-- checkbox -->
                         <div class="form-group clearfix">
                           <div class="icheck-primary d-inline">
                             <input type="checkbox" id="davp_panel" name="Acceptance" value="1"  {{$disablcheck}} {{!empty($data->Acceptance) && $data->Acceptance == 1 ? 'checked' : ''}}>
                             <label for="davp_panel">Acceptance of the policy guideline.An undertaking of the acceptance of the policy guidelines by av producer.(नीति दिशानिर्देश की स्वीकृति। निर्माता द्वारा नीति दिशानिर्देशों की स्वीकृति का एक उपक्रम.) <span style="color: red;">*</span></label>
                           </div>
                         </div>
                        </div>
                      </div>
                      <input type="hidden" name="doc[]" id="doc_data">
                      <input type="hidden" name="modify" id="modify" value="{{@$data->Modification}}">
                      @php
                          if(@$data->Modification=='1')
                          {
                            $dis='disabled';
                          }
                          else {
                            $dis='';
                          }
                      @endphp
                      @if(@$data->Modification!='1')
                      <a class="btn btn-primary reg-previous-button">Previous</a>&nbsp; <a id="submit" class="btn btn-primary media-producers-next-button">Submit</a>
                      @else
                      <a class="btn btn-primary reg-previous-button">Previous</a>
                      @endif
                    </div>
                  </div>
              </form>
            </div>
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
<!-- /.content-wrapper --> @endsection @section('custom_js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/av_producers.js"></script>
<script src="{{ url('/js') }}/avtv_comman.js"></script>
<!-- <script src="{{ url('/js') }}/audio_video.js"></script> -->

<script type="text/javascript">
    function BranchOfficeDiv(btnbranchoffice) {
        var have_office = document.getElementById("have_office");
        have_office.style.display = btnbranchoffice.value == "1" ? "block" : "none";
    }
</script>

<script>
  // DropzoneJS Demo Code End
  $(document).ready(function() {
    $("#organization_registered1").click(function() {
    if ($(this).is(":checked")) {
      $("#org_type").show();
      $("#sel_type").removeAttr('disabled');
      // $("#company_firm1").hide()
    }
  });

  $("#organization_registered2").click(function() {
    if ($(this).is(":checked")) {
      $("#org_type").hide();
      $("#partnership_firm1").hide();
      $("#company_firm1").hide();

    }
  });


    $("#sel_type").change(function() {
    var res=$("#sel_type").val();
    if(res=='1')
    {
      $("#partnership_firm1").show();
      $("#p_state").removeAttr('disabled');
      $("#p_address").removeAttr('disabled');
    }
    else
    {
      $("#partnership_firm1").hide();
      $("#p_state").attr('disabled','disabled');
      $("#p_address").attr('disabled','disabled');
    }


    if(res=='2')
    {
      $("#company_firm1").show();
      $("#c_state").removeAttr('disabled');
      $("#c_address").removeAttr('disabled');
    }
    else
    {
      $("#company_firm1").hide();
      $("#c_state").attr('disabled','disabled');
      $("#c_address").attr('disabled','disabled');
    }

  });
  });
$(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
});
</script>
@endsection
