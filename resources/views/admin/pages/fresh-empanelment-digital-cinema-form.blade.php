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
$vendorData =$vendorData ?? '1';
if(empty($DigitalScreen[0]))
{
  $DigitalScreen_dTA=[1];
}
else 
{
  $DigitalScreen_dTA=$DigitalScreen;
}
//dd($DigitalScreen_dTA);
                  $readonly = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  $click='';
                  $tab ='';
                  if(@$vendorData->{'Modification'} == 1){
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  $click='preventLeftClick';
                  $tab='-1';
                  }
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of Digital Cinema</h6>
                <p>
        @if($vendorData != '' && @$vendorData->{'Modification'} == 1)
        <a href="{{url('getDigitalPDF/'.session::get('UserID'))}}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Digital Cinema Application Receipt</a>
        @endif
    </p>

        </div>

        <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <div class="card-body">

            <form method="post" action="" id="digita_cinema">
                @csrf
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" id="#tab1" style="pointer-events:none;" tabindex="-1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab2" style="pointer-events:none;" tabindex="-1">DC Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab3" style="pointer-events:none;" tabindex="-1">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" id="#tab4" style="pointer-events:none;" tabindex="-1">Upload Document</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel"
                        aria-labelledby="tab1-trigger">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Agency / Owner Name / एजेंसी / मालिक का नाम <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="Owner_Name" id="Owner_Name" placeholder="Enter Agency / Owner Name" onkeypress="return onlyAlphabets(event,this)" maxlength="70"
                                    {{$readonly}} value="{{@$vendorData->{'Agency Name'} ?? ''}}">
                                    <span id="first_agency_name" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">E-mail ID / ई मेल आईडी <font color="red">*</font></label>
                                    <input type="email" class="form-control form-control-sm" name="digital_email" id="owner_email" placeholder="Enter E-mail ID" {{$readonly}} value="{{@$vendorData->{'E-Mail'} ?? ''}}">
                                    <span id="first_email" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                    <input type="text" class="form-control form-control-sm" name="digital_mobile" id="owner_mobile" placeholder="Enter Mobile Number" onkeypress="return onlyNumberKey(event)" maxlength="10"
                                    {{$readonly}} value="{{@$vendorData->{'Mobile'} ?? ''}}">
                                    <span id="first_mobile" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Secondary Mobile No. / सेकेंडरी मोबाइल नंबर </label>
                                    <input type="text" class="form-control form-control-sm" name="secondary_mobile" id="secondary_mobile" placeholder="Enter Secondary Mobile Number" onkeypress="return onlyNumberKey(event)" maxlength="10"
                                    {{$readonly}} value="{{@$vendorData->{'Owner Secondary mobile no'} >0  ? @$vendorData->{'Owner Secondary mobile no'} :''}}">
                                    <span id="first_mobile" style="color:red;display:none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Address / पता <font color="red">*</font></label>
                                    <textarea name="digital_address" id="address" placeholder="Enter Address" class="form-control form-control-sm" {{$readonly}}>{{@$vendorData->{'Address 1'} ?? ''}}</textarea>
                                    <span id="first_address" style="color:red;display:none;"></span>
                                </div>
                            </div>

	                    <div class="col-md-4">
	                       <div class="form-group">
	                        <label for="state">State / राज्य <font color="red">*</font></label>
	                        <select  id="digital_state" name="digital_state" class="form-control form-control-sm Digital_state {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}" digital-dist="digital_district" digital-city="digital_city">
	                            <option  value="">Select State</option>
                              @if($states > 0)
                              @foreach($states as $state)
	                            <option  value="{{$state['Code'] ?? ''}}"
                              @if(@$vendorData->{'State'} == $state['Code']) selected="selected"@endif>{{$state['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_state" class="text-danger"></span>
	                       </div>
	                     </div>
	                     <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="district">District / ज़िला <font color="red">*</font></label>
	                        <select  id="digital_district" name="digital_district" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}">
	                            <option  value="">Select District</option>
                              @if($district > 0)
                              @foreach($district as $dist)
                              <option  value="{{@$dist['District'] ?? ''}}" @if(@$dist['District'] == @$vendorData->{'District'}) selected="selected"@endif>{{@$dist['District'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                      
                        <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="City">City / नगर<font color="red">*</font></label>
	                        <select  id="digital_city" name="digital_city" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}">
	                            <option  value="">Select City</option>
                              <option  value="{{@$vendorData->{'City'} ?? ''}}" selected="selected"
                              >@php $City =strtolower(@$vendorData->{'City'}); @endphp
                                {{ucwords($City) ?? ''}}</option>
                            
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                      
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Pin Code / पिन कोड</label>
                                    <input type="text" name="digital_pin_code" class="form-control form-control-sm" id="digital_pin_code"
                                        placeholder="Enter Pin Code"
                                        onkeypress="return onlyNumberKey(event)" maxlength="6" {{$readonly}} value="{{@$vendorData->{'Owner Post Code'} ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Name">Phone No. / फोन नंबर</label>
                                    <input type="text" name="digital_phone_no" class="form-control form-control-sm" id="phone"
                                        placeholder="Enter Phone Number" maxlength="15"
                                        onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$vendorData->{'Phone'} ?? ''}}">
                                </div>
                            </div>
                        </div>
                     
                        <div class="row col-md-12">
                              <h4 class="subheading">Headquarters Address Details/ 
                                  मुख्यालय का पता विवरण :-
                              </h4>
                          </div>
                          <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Contact Name/ संपर्क नाम <font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Head_name" id="Head_name" placeholder="Enter Contact Name" onkeypress="return onlyAlphabets(event,this)"   value="{{@$vendorData->{'HO contact name'} ?? ''}}" {{$readonly}}>
                            </div>
                        </div>
                        <div class="col-md-4">
	                       <div class="form-group">
	                        <label for="state">State / राज्य <font color="red">*</font></label>
	                        <select  id="Head_state" name="Head_state" class="form-control form-control-sm {{$click}} Digital_state" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" digital-dist="Head_district" digital-city="Head_city" {{$readonly}}>
	                            <option  value="">Select State</option>
                              @if($states > 0)
                              @foreach($states as $state)
	                            <option  value="{{$state['Code'] ?? ''}}" {{@$vendorData->{'HO State'} == $state['Code'] ? 'selected':''}}>{{$state['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_state" class="text-danger"></span>
	                       </div>
	                     </div>
	                     <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="district">District / ज़िला <font color="red">*</font></label>
	                        <select  id="Head_district" name="Head_district" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
	                            <option  value="">Select District</option>
                              <option  value="{{@$vendorData->{'HO District'} }}" {{@$vendorData->{'HO District'} != '' ? 'selected' :''}}>{{@$vendorData->{'HO District'} }}</option>
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                        <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="City">City / नगर<font color="red">*</font></label>
	                        <select  id="Head_city" name="Head_city" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
	                            <option  value="">Select City</option>
                              <option  value="{{@$vendorData->{'HO City'} }}" {{@$vendorData->{'HO City'} != '' ? 'selected' :''}}>@php $hoCity =strtolower(@$vendorData->{'HO City'}); @endphp
                                {{ucwords($hoCity) ?? ''}}</option>
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Address/ पता<font color="red">*</font></label>
                                <textarea name="Head_address" id="Head_address" placeholder="Enter Address" rows="2" class="form-control form-control-sm"  maxlength="120" {{$readonly}}>{{@$vendorData->{'HO Address 1'} ?? ''}}</textarea>
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Designation/ पद<font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Head_Designation" id="Head_Designation" placeholder="Enter Designation"   value="{{@$vendorData->{'HO Designation'} ?? ''}}" {{$readonly}}>
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Phone No./ फोन नंबर</label>
                                <input type="text" class="form-control form-control-sm" name="Head_Landline_No" id="Head_Landline_No" placeholder="Enter Phone No." maxlength="15" onkeypress="return onlyNumberKey(event)"   value="{{@$vendorData->{'HO Phone'} ?? ''}}" {{$readonly}}>
                              </div>
                            </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Mobile No./ मोबाइल नंबर<font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Head_Mobile_No" id="Head_Mobile_No" placeholder="Enter Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)"   value="{{@$vendorData->{'HO Mobile'} ?? ''}}" {{$readonly}}>

                            </div>
                            </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                                <input type="email" class="form-control form-control-sm" name="Head_Email" id="Head_Email" placeholder="Enter E-mail ID"   value="{{@$vendorData->{'HO E-Mail'} ?? ''}}" {{$readonly}}>
                                <span id="first_head_office_mail" class="text-danger"></span>
                              </div>
                            </div>
                          </div>

                          <div class="row col-md-12">
                              <h4 class="subheading">Location Address Details/ मुख्यालय और स्थान दोनों का पता विवरण :-
                              </h4>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                 @if(@$vendorData->{'Loc Same Address_as_DO'} !=0)
                                  <input type="checkbox" id="loc_Same_Address_as_HQ" name="loc_Same_Address_as_HQ" class="get_channel_office_data {{$click}}" data="OHO"   value="1" {{$readonly}} checked="checked">
                                  @else
                                  <input type="checkbox" id="loc_Same_Address_as_HQ" name="loc_Same_Address_as_HQ" class="get_channel_office_data" data="OHO"   value="1" {{$readonly}}>
                                @endif
                                  <label for="loc_Same_Address_as_HQ">Same as Headquarters Address Details/ मुख्यालय के पते के विवरण के समान</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Contact Name/ संपर्क नाम <font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Location_Contact_name" id="Location_Contact_name" placeholder="Enter Contact Name" onkeypress="return onlyAlphabets(event,this)"   value="{{@$vendorData->{'LOC contact name'} ?? ''}}" {{$readonly}}>
                            </div>
                          </div>
                          <div class="col-md-4">
	                       <div class="form-group">
	                        <label for="state">State / राज्य <font color="red">*</font></label>
	                        <select  id="Location_state" name="Location_state" class="form-control form-control-sm {{$click}} Digital_state" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}" digital-dist="Location_district" digital-city="Location_city" {{$readonly}}>
	                            <option  value="">Select State</option>
                              @if($states > 0)
                              @foreach($states as $state)
	                            <option  value="{{$state['Code'] ?? ''}}" {{@$vendorData->{'LOC State'} == $state['Code']  ?'selected': ''}}>{{$state['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
	                        </select>
                          <span id="first_state" class="text-danger"></span>
	                       </div>
	                     </div>
	                     <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="district">District / ज़िला <font color="red">*</font></label>
	                        <select  id="Location_district" name="Location_district" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}};width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
	                            <option  value="">Select District</option>
                              <option  value="{{@$vendorData->{'LOC District'} }}" {{@$vendorData->{'LOC District'} != '' ? 'selected' :''}}>{{@$vendorData->{'LOC District'} ?? '' }}</option>
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                        <div class="col-md-4">
	                        <div class="form-group">
	                        <label for="City">City / नगर<font color="red">*</font></label>
	                        <select  id="Location_city" name="Location_city" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
	                            <option  value="">Select City</option>
                              <option  value="{{@$vendorData->{'LOC City'} }}" {{@$vendorData->{'LOC City'} != '' ? 'selected' :''}}>@php $LOCCity =strtolower(@$vendorData->{'LOC City'}); @endphp
                                {{ucwords($LOCCity) ?? ''}}</option>
	                        </select>
                          <span id="first_district" class="text-danger"></span>
	                       </div>
	                      </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Address/ पता<font color="red">*</font></label>
                                <textarea name="Location_address" id="Location_address" placeholder="Enter Address" rows="2" class="form-control form-control-sm"  maxlength="120" {{$readonly}}>{{@$vendorData->{'LOC Address 1'} ?? '' }}</textarea>
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Designation/ पद<font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Location_Designation" id="Location_Designation" placeholder="Enter Designation"   value="{{@$vendorData->{'LOC Designation'} ?? '' }}" {{$readonly}}>
                            </div>
                          </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Phone No./ फोन नंबर</label>
                                <input type="text" class="form-control form-control-sm" name="Location_Landline_No" id="Location_Landline_No" placeholder="Enter Phone No." maxlength="15" onkeypress="return onlyNumberKey(event)"   value="{{@$vendorData->{'LOC Phone'} ?? '' }}" {{$readonly}}>
                              </div>
                            </div>
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">Mobile No./ मोबाइल नंबर<font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="Location_Mobile_No" id="Location_Mobile_No" placeholder="Enter Mobile No." maxlength="10" onkeypress="return onlyNumberKey(event)"   value="{{@$vendorData->{'LOC Mobile'} ?? '' }}" {{$readonly}}>

                            </div>
                            </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label for="To">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                                <input type="email" class="form-control form-control-sm" name="Location_Email" id="Location_Email" placeholder="Enter E-mail ID"   value="{{@$vendorData->{'LOC E-Mail'} ?? '' }}" {{$readonly}}>
                                <span id="first_head_office_mail" class="text-danger"></span>
                              </div>
                            </div>
                          </div>

                          <div class="row col-md-12">
                              <h4 class="subheading">Authorized Representative / अधिकृत प्रतिनिधि :-
                              </h4>
                          </div>
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font>
                                        </label>
                                        <textarea  type="text" name="Authorized_Rep_Name" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40"  tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" onkeypress="return onlyAlphabets(event)" {{$readonly}}>{{@$vendorData->{'AR Name'} ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address / पता <font color="red">*</font></label>
                                        <textarea  type="text" name="AR_Address" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"  tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" {{$readonly}}>{{@$vendorData->{'AR Address'} ?? ''}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="landline_no">Phone No. / फोन नंबर <font color="red"></font>
                                        </label>
                                        <input type="text" name="AR_Landline_No" placeholder="Enter Phone No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{@$vendorData->{'AR Phone No_'} ?? ''}}"   tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" 
                                        {{$readonly}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                                        <input type="text" name="AR_Email" placeholder="Enter E-mail" class="form-control form-control-sm"  maxlength="30" value="{{@$vendorData->{'AR Email'} ?? ''}}"   tabindex="{{$tab}}" style="pointer-events: '$pointer';" {{$readonly}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                                        <input type="text" name="AR_Mobile_No" placeholder="Enter Mobile No." class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{@$vendorData->{'AR Mobile'} ?? ''}}"   tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" {{$readonly}}>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile"> Alternate Mobile No. / वैकल्पिक मोबाइल नंबर </label>
                                        <input type="text" name="altername_mobile" placeholder="Enter Alternate Mobile No." class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" value="{{@$vendorData->{'Alternate Mobile No_'} ?? '' }}" tabindex="{{$tab}}" style="pointer-events: '{{$pointer}}';" {{$readonly}}>
                                    </div>
                                </div>
                            </div>
                        <input type="hidden" name="next_tab_1" id="next_tab_1" {{$readonly}} value="0">
                        <a class="btn btn-primary fm-digital-cinema" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                  <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                  <div class="row col-md-12">
                              <h4 class="subheading">Media Address / मीडिया पता:-
                              </h4>
                          </div>

                          @if(@$vendorData->{'Modification'} != 1)<div class="row" style="display: {{@$show}};">
                            <div class="col-md-6">
                                <h6>If you want to import through XLS <a href="{{asset('dummy-excel/MediaAddress.xlsx')}}" target="_blank">Download Master File</a></h6>
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="xls" id="xlxyes" value="1" class="xls"> Yes &nbsp;
                                <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked"> No
                            </div>
                        </div><br>
                        @endif
                       <div class="row" id="excel_upload">
                      <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Excel / एक्सेल अपलोड करें<font color="red">*</font></label>
                                <div class="input-group">
                                    <!-- <div class="custom-file">
                                        <input type="file" name="upoad_excel" class="custom-file-input {{$click}}" id="upoad_excel"
                                          id="upload_doc_" accept="application/pdf" {{$readonly}}style="pointer-events:;" tabindex="{{$tab}}">
                                        <label class="custom-file-label" id="upoad_excel2" for="upoad_excel">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="upoad_excel3">Upload</span>
                                    </div> -->
                                    <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv">
                                </div>
                                <span id="upoad_excel1" class="error invalid-feedback"></span>
                            </div>
                      </div>
                      </div>
                     
                         <div id="add_davp">
                         @foreach($DigitalScreen_dTA as $key => $DigitalScreen) 
                         <div class="row">
                         <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Company Name (Ex: - UFO movies ltd)/ कंपनी का नाम (उदा: - यूएफओ मूवीज लिमिटेड)<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm"
                            name="company_name[]" id="company_name" placeholder="Enter Contact Name" onkeypress="return onlyAlphabets(event,this)"   value="{{$DigitalScreen->{'Company Name'} ?? ''}}" {{$readonly}}>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Agency Name (Ex: - UFO) / एजेंसी का नाम (उदा: - यूएफओ)<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm"
                            name="exc_agency_name[]" id="exc_agency_name" placeholder="Enter Agency Name" onkeypress="return onlyAlphabets(event,this)"   value="{{$DigitalScreen->{'Agency Name'} ?? ''}}" {{$readonly}}>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Theatre Name/ रंगमंच का नाम<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm"
                            name="teatre_name[]" id="teatre_name" placeholder="Enter Theatre Name" onkeypress="return onlyAlphabets(event,this)"   value="{{$DigitalScreen->{'Theatre Name'} ?? ''}}" {{$readonly}}>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="state">State / राज्य <font color="red">*</font></label>
                        <select  id="excel_state" name="excel_state[]" class="form-control form-control-sm {{$click}} Digital_state" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" digital-dist="excel_district{{$key}}" digital-city="excel_city{{$key}}" {{$readonly}}>
                            <option  value="">Select State</option>
                          @if($states > 0)
                          @foreach($states as $state)
                            <option  value="{{$state['Code'] ?? ''}}" {{@$DigitalScreen->{'State'} == $state['Code'] ? 'selected':''}}>{{$state['Description'] ?? ''}}</option>
                          @endforeach
                          @endif
                        </select>
                      <span id="first_state" class="text-danger"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label for="district">District / ज़िला <font color="red">*</font></label>
                        <select  id="excel_district{{$key}}" name="excel_district[]" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
                            <option  value="">Select District</option>
                          <option  value="{{@$DigitalScreen->{'District'} }}" {{@$DigitalScreen->{'District'} != '' ? 'selected' :''}}>{{@$DigitalScreen->{'District'} }}</option>
                        </select>
                      <span id="first_district" class="text-danger"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label for="City">City / नगर<font color="red">*</font></label>
                        <select  id="excel_city{{$key}}" name="excel_city[]" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
                            <option  value="">Select City</option>
                          <option  value="{{@$DigitalScreen->{'City'} }}" {{@$DigitalScreen->{'City'} != '' ? 'selected' :''}}>@php $multiCity =strtolower(@$DigitalScreen->{'City'}); @endphp
                                {{ucwords($multiCity) ?? ''}}</option>
                        </select>
                      <span id="first_district" class="text-danger"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Address/ पता<font color="red">*</font></label>
                            <textarea name="excel_address[]" id="excel_address" placeholder="Enter Address" rows="2" class="form-control form-control-sm"  maxlength="120" {{$readonly}}>{{$DigitalScreen->{'Address'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Pin Code/ पिन कोड<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="excel_pin_code[]" id="excel_pin_code" placeholder="Enter Pin Code" maxlength="6"  value="{{$DigitalScreen->{'Pin code'} ?? ''}}" {{$readonly}} maxlenth="">
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Seating Capacity/ बैठने की क्षमता<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="excel_Seating_Capacity[]" id="excel_Seating_Capacity" placeholder="Enter Seating Capacity" maxlength="5" onkeypress="return onlyNumberKey(event)"   value="{{$DigitalScreen->{'No_ Of Seats'} ?? ''}}" {{$readonly}}>
                          </div>
                        </div>

                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Type of Screen (Single/Multiplex)/ स्क्रीन का प्रकार (सिंगल/मल्टीप्लेक्स)<font color="red">*</font></label>
                        <select  id="excel_Screen_type" name="excel_Screen_type[]" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events:{{$pointer}}; width: 100%;" tabindex="{{$tab}}" {{$readonly}}>
                            <option  value="">Select Screen</option>
                          <option  value="0" {{@$DigitalScreen->{'Screen Type'} == 0 ? 'selected' :''}}>Single</option>
                          <option  value="1" {{@$DigitalScreen->{'Screen Type'} == 1 ? 'selected' :''}}>Multiplex</option>
                        </select>
                      <span id="first_district" class="text-danger"></span>
                     
                            <!-- <input type="text" class="form-control form-control-sm" name="excel_Screen_type[]" id="excel_Screen_type" placeholder="Enter Type of Screen" maxlength="10" onkeypress="return onlyNumberKey(event)"   value="{{$DigitalScreen->{'Pin code'} ?? ''}}" {{$readonly}}> -->

                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="To">Web code (Map with theater code)./ वेब कोड (थिएटर कोड के साथ मानचित्र)<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" 
                            name="excel_Web_code[]" id="excel_Web_code" placeholder="Enter Web code"   value="{{$DigitalScreen->{'Screen Unique Code'} ?? ''}}" {{$readonly}}>
                            <span id="first_excel_office_mail" class="text-danger"></span>
                          </div>
                        </div>
                      </div>
                        @endforeach
                        </div>
                @if(@$vendorData->{'Modification'} == '1')
                        
                       @else
                       <div class="row">
                      <div class="col-md-12">
                       <div class="row mr-1" id="add_row_davp" {{$readonly}} style="pointer-events:;float:right;margin-top: 6px;">
                         <a class="btn btn-primary" id="add_row">Add More +</a>
                         <input type="hidden" id="count_dist_latitude" value="{{@$key ?@$key :'0'}}">
                       </div>
                </div>
                </div>
                       @endif
                       <div class="row">
                          <div class="col-md-6">
                            
                                <a class="btn btn-primary reg-previous-button"> 
                                  <i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                                <a class="btn btn-primary fm-digital-cinema" id="tab_2">Next 
                                  <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                           
                        </div>
                    </div>
                </div>

                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="bank_account">Bank Account Number for Receiving Payment / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" name="bank_account_no" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$vendorData->{'Account No_'} ?? ''}}">
                          <span id="first_bank_account_no" class="text-danger"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="account_holder_name">Account Holder Name / खाता धारक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="account_holder_name" name="account_holder_name" placeholder="Enter account Holder Name" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'A_C Holder Name'} ?? ''}}">
                          <span id="first_account_holder_name" class="text-danger"></span>
                        </div>
                      </div>
                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="ifsc_code">IFSC Code / IFSC कोड<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm inputUC" id="IFSC_Code" name="IFSC_Code" placeholder="Enter IFSC Code" {{$readonly}} value="{{@$vendorData->{'IFSC Code'} ?? ''}}">
                          <span id="IFSC_code_Error" style="color:red;display: none;"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="bank_name" name="bank_name" placeholder="Enter bank name" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'Bank Name'} ?? ''}}">
                          <span id="first_bank_name" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="branch">Branch / शाखा<font color="red">*</font></label>
                          <input type="text" class="form-control form-control-sm" id="branch_name" name="branch" placeholder="Enter branch"  maxlength="30" onkeypress="return onlyAlphabets(event,this)" {{$readonly}} value="{{@$vendorData->{'Branch Name'} ?? ''}}">
                          <span id="first_branch_name" class="text-danger"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="address_account">Address of Account / खाते का पता<font color="red">*</font></label>
                         <textarea name="address_account" id="address_of_account" class="form-control form-control-sm" rows="2" placeholder="Enter Address of Account" maxlength="80" onkeypress="return onlyAlphabets(event,this)" {{$readonly}}>{{@$vendorData->{'Account Address'} ?? ''}}</textarea>
                         <span id="first_address_of_account" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">PAN Card No./ पैन कार्ड नंबर<font color="red">*</font></label>
                         <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm" placeholder="Enter Pan Card No." maxlength="10" {{$readonly}} value="{{@$vendorData->{'PAN'} ?? ''}}">
                         <span id="PAN_No_Error" style="color:red;display: none;"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">GST No. / जीएसटी संख्या<font color="red">*</font></label>
                          <input type="text" name="GST_No" id="GST_No" class="form-control form-control-sm inputUC" placeholder="Enter GST No." maxlength="15" onkeypress="return isAlphaNumeric(event)" {{$readonly}}  value="{{@$vendorData->{'GST No_'} ?? ''}}">
                           <span id="GST_No_Error"></span>
                        </div>
                      </div>
                        <fieldset class="fieldset-border">
                          <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ESI_account_no">Account No. / खाता नंबर</label>
                                  <input type="text" name="ESI_account_no" id="ESI_account_no" class="form-control form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" maxlength="20"  {{$readonly}} value="{{@$vendorData->{'ESI A_C No_'} ?? ''}}">
                                <span id="alert_address_of_account" style="color:red;display: none;"></span>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="ESI_no_employees">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                                <input type="text" name="ESI_employees_covered" id="ESI_employees_covered" class="form-control form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" maxlength="6"  {{$readonly}} value="@if(@$vendorData->{'No_ Of Emp in ESI'} >0){{@$vendorData->{'No_ Of Emp in ESI'} ?? ''}}@endif">
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
                                <label for="Name">Account No. / खाता नंबर</label>
                               <input type="text" name="EPF_account_no" id="EPF_account_no" class="form-control form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)" maxlength="20"  {{$readonly}} value="{{@$vendorData->{'EPF A_c No_'} ?? ''}}">
                              </div>
                              <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="Name">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                                <input type="text" name="EPF_employees_covered" id="EPF_employees_covered" class="form-control form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)" maxlength="6"  {{$readonly}} value="@if(@$vendorData->{'No_ Of Emp in EPF'} > 0){{@$vendorData->{'No_ Of Emp in EPF'} ?? ''}}@endif">
                                <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                        </div>
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        <a class="btn btn-primary fm-digital-cinema" id="tab_3">Next
                          <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <div class="row">
                        @php $string =@$vendorData->{'Agreement File Name'}; 
                        @endphp
                              @if(filter_var($string, FILTER_VALIDATE_URL)) 
                              <div class="col-md-12">
                              <label for="exampleInputFile">Agreement between parties (Owner & Agencies)  / पार्टियों (मालिक और एजेंसियों) के बीच समझौता 
                                  <font color="red">*</font></label>
                                    <div class="input-group">
                                   <a href="{{filter_var($string, FILTER_VALIDATE_URL)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View PDF Link</a>
                                    </div>
                                </div>    
                              @else       
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Agreement between parties (Owner & Agencies) / पार्टियों (मालिक और एजेंसियों) के बीच समझौता 
                                  <font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="agreement_parties" class="custom-file-input custom-input {{$click}}" id="agreement_parties"
                                              id="upload_doc_" accept="application/pdf" {{$readonly}}style="pointer-events:;" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="agreement_parties2" for="agreement_parties">{{@$vendorData->{'Agreement File Name'} ?@$vendorData->{'Agreement File Name'} : 'Choose file'}}</label>
                                        </div>
                                      @if(@$vendorData->{'Agreement File Name'} !='')
                                          <div class="input-group-append">
                                          <span class="input-group-text"><a href="{{ url('/uploads') }}/Digital-Cinema/{{@$vendorData->{'Agreement File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="agreement_parties3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="agreement_parties1" class="error invalid-feedback"></span>
                                    <div id="greater_then20mb" style="display:none;">
                                        <div class="form-group">
                                        <label for="Name">Agreement File Path / अनुबंध फ़ाइल पथ</label>
                                        <input type="text" name="Agreement_File_Path" id="Agreement_File_Path" class="form-control form-control-sm" placeholder="Please Enter Agreement File Path because your file size greater than 20mb" onkeypress="return onlyNumberKey(event)" maxlength="60"  {{$readonly}}>
                                        <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                                      </div>
                                      </div>
                                </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Balance sheet/ Auditor Financial Statement of past 3 years./ पिछले 3 वर्षों का बैलेंस शीट / ऑडिटर वित्तीय विवरण।<font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="Balance_sheet" class="custom-file-input custom-upload {{$click}}" id="Balance_sheet"
                                              id="upload_doc_" accept="application/pdf" {{$readonly}}style="pointer-events:;" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="Balance_sheet2" for="Balance_sheet">{{@$vendorData->{'BS_AF File Name'} ?@$vendorData->{'BS_AF File Name'} :'Choose file'}}</label>
                                        </div>
                                        @if(@$vendorData->{'BS_AF File Name'} !='')
                                          <div class="input-group-append">
                                          <span class="input-group-text"><a href="{{ url('/uploads') }}/Digital-Cinema/{{@$vendorData->{'BS_AF File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="Balance_sheet3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="Balance_sheet1" class="error invalid-feedback"></span>
                                </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Certificate of Incorporation / निगमन प्रमाणपत्र<font color="red">*</font></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="Certificate_Incorporation" class="custom-file-input custom-upload {{$click}}" id="Certificate_Incorporation"
                                              id="upload_doc_" accept="application/pdf" {{$readonly}}style="pointer-events:;" tabindex="{{$tab}}">
                                            <label class="custom-file-label" id="Certificate_Incorporation2" for="Certificate_Incorporation">{{@$vendorData->{'Incorporation Cert File Name'} ?@$vendorData->{'Incorporation Cert File Name'} : 'Choose file'}}</label>
                                        </div>
                                        @if(@$vendorData->{'Incorporation Cert File Name'} !='')
                                          <div class="input-group-append">
                                          <span class="input-group-text"><a href="{{ url('/uploads') }}/Digital-Cinema/{{@$vendorData->{'Incorporation Cert File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="Certificate_Incorporation3">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="Certificate_Incorporation1" class="error invalid-feedback"></span>
                                </div>
                            </div>

                        </div>
                         <div class="row" style="margin-bottom: 35px;}">
                               <div class="col-md-12">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                  <div class="icheck-primary d-inline">
                                    @if(@$vendorData->{'Self Declaration'} == '1')
                                    <input type="checkbox" id="Self_declaration" name="Self_declaration" {{$readonly}} value="1"  style="pointer-events:;" tabindex="{{$tab}}" checked="checked" class="{{$click}}">
                                    @else
                                    <input type="checkbox" id="Self_declaration" name="Self_declaration" value="1">
                                    @endif
                                    <label for="Self_declaration">Self-declaration /स्व घोषणा<font color="red">*</font></label>
                                 </div>
                                </div>
                               </div>
                             </div>
                             <input type="hidden" name="doc[]" id="doc_data">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        @if(@$vendorData->{'Modification'} == '1')
                       <!--  <a class="btn btn-primary fm-digital-cinema" style="pointer-events:;"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a> -->
                        @else
                        <a class="btn btn-primary fm-digital-cinema"><i class="fa fa-paper-plane" aria-hidden="true">
                        </i> Submit</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js') }}/fress-em-digital-cinema-validation.js"></script>
<script>
$(document).ready(function(){
    $("#add_row").click(function(){
      var i = $('#count_dist_latitude').val();
      i++;
    $.ajax({
      url: "{{url('fetchStates')}}",
                type: "GET",
                dataType: 'json',
                success: function (result){
                  console.log(result);
                  var html = '';
                  var html = '<option value="">Select State</option>';
                  $.each(result.data, function (key, value) 
                  {
                    html += '<option value="' + value.Code + '">' + value.Description + '</option>';
                  });
		$("#add_davp").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="To">Company Name (Ex: - UFO movies ltd)/ कंपनी का नाम (उदा: - यूएफओ मूवीज लिमिटेड)<font color="red">*</font></label><input type="text" class="form-control form-control-sm" name="company_name[]" id="company_name" placeholder="Enter Contact Name" onkeypress="return onlyAlphabets(event,this)"   value="" ></div></div><div class="col-md-4"><div class="form-group"><label for="To">Agency Name (Ex: - UFO) / एजेंसी का नाम (उदा: - यूएफओ)<font color="red">*</font></label><input type="text" class="form-control form-control-sm" name="exc_agency_name[]" id="exc_agency_name" placeholder="Enter Agency Name" onkeypress="return onlyAlphabets(event,this)"  maxlength="60"  value=""></div></div><div class="col-md-4"><div class="form-group"><label for="To">Theatre Name/ रंगमंच का नाम<font color="red">*</font></label><input type="text" class="form-control form-control-sm" name="teatre_name[]" id="teatre_name" placeholder="Enter Theatre Name" onkeypress="return onlyAlphabets(event,this)"   value="" ></div></div><div class="col-md-4"><div class="form-group"><label for="state">State / राज्य <font color="red">*</font></label><select  id="excel_state" name="excel_state[]" class="form-control form-control-sm  Digital_state"  style="pointer-events:; width: 100%;" tabindex="" digital-dist="excel_district'+i+'" digital-city="excel_city'+i+'">'+html+'</select><span id="first_state" class="text-danger"></span></div></div><div class="col-md-4"><div class="form-group"><label for="district">District / ज़िला <font color="red">*</font></label><select  id="excel_district'+i+'" name="excel_district[]" class="form-control form-control-sm "  style="pointer-events:; width: 100%;" tabindex=""><option  value="">Select District</option></select><span id="first_district" class="text-danger"></span></div></div><div class="col-md-4"><div class="form-group"><label for="City">City / नगर<font color="red">*</font></label><select  id="excel_city'+i+'" name="excel_city[]" class="form-control form-control-sm "  style="pointer-events:; width: 100%;" tabindex=""><option  value="">Select City</option></select><span id="first_district" class="text-danger"></span></div></div><div class="col-md-4"><div class="form-group"><label for="To">Address/ पता<font color="red">*</font></label><textarea name="excel_address[]" id="excel_address" placeholder="Enter Address" rows="2" class="form-control form-control-sm"  maxlength="120" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="To">Pin Code/ पिन कोड<font color="red">*</font></label><input type="text" class="form-control form-control-sm" name="excel_pin_code[]" id="excel_pin_code" placeholder="Enter Pin Code"   value="" onkeypress="return onlyNumberKey(event)" maxlength="6"></div></div><div class="col-md-4"><div class="form-group"><label for="To">Seating Capacity/ बैठने की क्षमता</label><input type="text" class="form-control form-control-sm" name="excel_Seating_Capacity[]" id="excel_Seating_Capacity" placeholder="Enter Seating Capacity" maxlength="5" onkeypress="return onlyNumberKey(event)"   value="" ></div></div><div class="col-md-4"><div class="form-group"><label for="To">Type of screen (Single/Multiplex)/ स्क्रीन का प्रकार (सिंगल/मल्टीप्लेक्स)<font color="red">*</font></label><select  id="excel_Screen_type" name="excel_Screen_type[]" class="form-control form-control-sm"  style=" width: 100%;"><option  value="">Select Screen</option><option  value="0">Single</option><option  value="1">Multiplex</option></select></div></div><div class="col-md-4"><div class="form-group"><label for="To">Web code (Map with theater code)./ वेब कोड (थिएटर कोड के साथ मानचित्र)<font color="red">*</font></label><input type="text" class="form-control form-control-sm" name="excel_Web_code[]" id="excel_Web_code" placeholder="Enter E-mail ID"   value=""><span id="first_excel_office_mail" class="text-danger"></span></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 38px;"><button class="btn btn-danger remove_row mr-1">Remove -</button></div></div>');
    $('#count_dist_latitude').val(i);
      } 
    })
	});
    $("#add_davp").on('click','.remove_row',function(){
        $(this).parent().parent().remove();
    });
});


  $(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
    $("#excel_upload").hide();
    $(".xls").change(function(){ // bind a function to the change event
        if( $(this).is(":checked") ){
          if($(this).val() == 1) // check if the radio is checked
          $("#excel_upload").show();
          $("#add_davp").hide();
          $("#add_row").hide();
        }
        if($(this).val() == 0){
          $("#excel_upload").hide();
          $("#add_davp").show();
          $("#add_row").show();
        }
    });


});
function isAlphaNumeric(e) { // Alphanumeric only
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || (k == 32) || k == 0 || k == 46);
}

</script>
@endsection
