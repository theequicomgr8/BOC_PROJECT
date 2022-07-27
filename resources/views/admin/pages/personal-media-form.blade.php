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
if(Session::has('Gst'))
{
$gst_value = Session::get('Gst');
}
else {
$gst_value='';
}
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
$show='';
$media_id =@$vendor_data[0]['OD Media ID'];
if(@$vendor_data[0]['OD Media ID'] != '')
if(@$vendor_data[0]['Status'] >= 1 && $media_id !='' && @$vendor_data[0]['Modification'] == 0)
{
$disabled = 'disabled';
$readonly = 'readonly';
$checked = 'checked';
$Self_Dec = $vendor_data[0]['Self-declaration'] == 1 ? "checked" : "";
}

$readonlyvendor = '';
$read='';
$tab='';
$pointer='';
$click='';
if(@$vendor_data[0]['Modification'] == 1){
$readonly = '';
$disabled = '';
$checked = '';
$Self_Dec='';
$show='none';
$read='readonly';
$tab='-1';
$pointer='none';
$click='preventLeftClick';

$readonlyvendor = 'readonly';
}

@endphp


<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-normal text-primary">Empanelment of outdoor personal media</h4>
      @if(@$vendor_data[0]['Modification'] == 1)
      <p><a href="{{url('personalmediaPDF/'.@$vendor_data[0]['OD Media ID'])}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> Personal media application Receipt</a></p>
      @endif

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
            <a class="nav-link active show" data-toggle="tab" id="#tab1">Basic Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" id="#tab2">Outdoor Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" id="#tab3">Account Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" id="#tab4">Upload Document</a>
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
                  <label for="owner_name">Owner Name / मालिक का नाम<font color="red">*</font></label>
                  <p>
                    <input type="text" name="owner_name[]" id="owner_name0" placeholder="Enter Publication Name" class="form-control form-control-sm owner_name" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']??  ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <span id="alert_owner_email0" style="color:red;display: none;"></span>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail ID(Owner) / ई मेल आईडी(मालिक)<font color="red">*</font>
                  </label>
                  <p>
                    <input type="email" class="form-control form-control-sm" id="owner_email0" name="owner_email[]" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onchange="return checkUniqueOwnerpersonalmedia(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <span id="alert_owner_email0" style="color:red;display: none;"></span>
                  </p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font>
                  </label>
                  <input type="text" name="owner_mobile[]" id="owner_mobile0" maxlength="10" placeholder="Enter Mobile" class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_'] ?? ''}}" onchange="return checkUniqueOwnerpersonalmedia(this, this.value,0)" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="alert_owner_mobile0" style="color:red;display: none;"></span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font>
                  </label>
                  <p>
                    <textarea type="text" name="address[]" id="owner_address0" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">{{$ownerlist['Address 1']?? ''}}</textarea>
                  </p>
                </div>
              </div>
              <!--<div class="col-md-4">
                <div class="form-group">
                  <label for="fax">Fax / फैक्स</label>
                  <input type="text" name="fax_no[]" id="owner_fax0" onkeypress="return onlyNumberKey(event)" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14" value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}}>
                  <input type="hidden" name="ownerid" id="ownerid" value="{{$ownerlist['Owner ID'] ?? ''}}">
                </div>
              </div>-->
            </div>
            @endforeach

            <div class="row" id="add_row_davp" style="float:right;margin-top:6px;">
              <input type="hidden" name="increse_i" id="increse_i" value="0">
              <!-- <a class="btn btn-primary {{$disabled}}" id="add_row" style="margin-right: 7px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> -->
            </div>
            <input type="hidden" name="mobilecheck" id="mobilecheck">
            <input type="hidden" name="owner_input_clean" id="owner_input_clean" value="1">
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
              <h4 class="subheading">Details of GST / जीएसटी का विवरण :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="GST_No">GST No. / जीएसटी संख्या</label>
                  <input type="text" readonly class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." onkeypress="return isAlphaNumeric(event)" onchange="return checksum(this.value)" maxlength="15" value="{{$vendor_data[0]['GST No_']?? $gst_value}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span class="gstvalidationMsg"></span>
                  <span class="validcheck"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*</font></label>
                  <input type="text" name="PM_Agency_Name" id="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" maxlength="40" value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="`">TIN/TAN/VAT No. / टिन/टैन/वैट संख्या </label>
                  <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="TIN_TAN_VAT_No" placeholder="Enter TIN/TAN/VAT No.(if applicable)" maxlength="15" value="{{$vendor_data[0]['TIN_TAN_VAT No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="alert_TIN_TAN_VAT_No" style="color: red;"></span>
                </div>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Head Office / प्रधान कार्यालय :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address">Address / पता<font color="red">*</font></label>
                  <textarea type="text" name="HO_Address" id="HO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="120" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">{{$vendor_data[0]['HO Address']??''}}</textarea>
                  <span id="alert_address1" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red"></font></label>
                  <input type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Landline No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="alert_landline_no" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">E-mail. / ईमेल
                    <font color="red">*</font>
                  </label>
                  <input type="text" name="HO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" value="{{$vendor_data[0]['HO E-Mail'] ?? ''}}" maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="v_alert_email" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="mobile_1">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="mobile" name="HO_Mobile_No" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['HO Mobile No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};" onkeyup="return checkUniqueVendor('mobile', this.value)">
                  <span id="v_alert_mobile" style="color: red;"></span>
                </div>
              </div>
              <!--<div class="col-md-4">
                <div class="form-group">
                  <label for="fax_1">Fax No. / फ़ैक्स नंबर</label>
                  <input type="text" name="HO_Fax_No" placeholder="Enter Fax No" class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Fax No_']??''}}" {{$disabled}}>
                  <span id="alert_fax_1" style="color: red;"></span>
                </div>
              </div>-->
            </div>


            @php
            $check1 = '';
            $check0 = '';
            $display = '';
            if(@$branch[0]->{'BO Landline No_'} !=''){
            $check1 = 'checked';
            $display = 'block';
            }
            else if(@$branch[0]->{'BO Landline No_'}==''){
            $check0 = 'checked';
            $display = 'none';
            }
            else{
            $check0 = 'checked'; //old $check0
            $display = 'block';
            }
            @endphp
            <div class="row">
              <div class="col-md-5">
                <h4 class="subheading" style="width: 402px;">Branch Office (If any) / शाखा कार्यालय / (यदि कोई):-</h4>
              </div>
              <div class="col-md-4" style="margin-top: 5px;">
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input h5" name="boradio" value="1" {{ $check1 }}> Yes / हाँ &nbsp;
                    <input type="radio" class="form-check-input h5" name="boradio" value="0" {{ $check0 }}>No / नहीं
                  </label>
                </div>
              </div>
            </div> <!-- id='boradio' -->
            <div id="branch" style="display: {{ $display }};">
              <div id="radio">
                @forelse($branch as $key => $branches)
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Name">State / राज्य<font color="red">*</font></label>
                      <p>
                        <select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                          <option value="">Select State</option>
                          @if(count($states) > 0)
                          @foreach($states as $statesData)
                          <option value="{{ $statesData['Code'] }}" {{@$branches->State == $statesData['Code'] ? 'selected' : ''}}>
                            {{$statesData['Description']}}
                          </option>
                          @endforeach
                          @endif
                        </select>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="address">Address / पता <font color="red">*</font></label>
                      <textarea type="text" name="BO_Address[]" id="BO_Address maxlength=" 120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">{{$branches->{'BO Address'} ??''}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font>
                      </label>
                      <input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$branches->{'BO Landline No_'} ??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                      <input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" value="{{$branches->{'BO E-Mail'} ??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                      <input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$branches->{'BO Mobile No_'} ??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </div>
                  </div>
                </div>
                @empty
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="Name">State / राज्य<font color="red">*</font></label>
                      <p>
                        <select name="BO_state[]" class="form-control form-control-sm call_district">
                          <option value="">Select State</option>
                          @foreach($states as $statesData)
                          <option value="{{ $statesData['Code'] }}">
                            {{$statesData['Description']}}
                          </option>
                          @endforeach
                        </select>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="address">Address / पता <font color="red">*</font></label>
                      <textarea type="text" name="BO_Address[]" id="BO_Address maxlength=" 120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font>
                      </label>
                      <input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="email">E-mail. / ईमेल <font color="red">*</font></label>
                      <input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label>
                      <input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                    </div>
                  </div>
                </div>
                <br>
                @endforelse
              </div>
              <!-- For Add function 8-Feb -->
              <div class="row" style="float:right;margin-top: 6px;margin-right: 0px; display: {{ $show; }}" id="addid">
                <input type="hidden" name="count_branch_id" id="count_branch_id" value="{{$key ?? 0}}">
                <a class="btn btn-primary" id="add_branch" style="pointer-events: {{$pointer}};"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
              </div><br><br><br>
            </div>
            <!-- For Add function 8-Feb end -->


            <div class="row">
              <div class="col-md-5">
                <h4 class="subheading" style="width: 380px;">Delhi Office (If any) / दिल्ली कार्यालय (यदि कोई):-</h4>
              </div>
              <div class="col-md-4" style="margin-top: 5px;">
                @php
                $check1 = '';
                $check0 = '';
                $display = '';
                if(@$vendor_data[0]['DO Address'] !=''){
                $check1 = 'checked';
                $display = 'block';
                }else if(@$vendor_data[0]['DO Address']==''){
                $check0 = 'checked';
                $display = 'none';
                }else{
                $check1 = 'checked';
                $display = 'block';
                }
                @endphp
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input h5" name="optradio" value="1" {{ $check1 }}> Yes / हाँ &nbsp;
                    <input type="radio" class="form-check-input h5" name="optradio" value="0" {{ $check0 }}>No / नहीं
                  </label>
                </div>
              </div>

            </div>

            <div id="radio11" style="display: {{ $display }}">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Address">Address / पता<font color="red">*</font></label>
                    <textarea type="text" name="DO_Address" id="DO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="50" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">{{$vendor_data[0]['DO Address']??''}}</textarea>
                    <!-- <span id="alert_address3" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Landline_No">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                    <input type="text" name="DO_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="DO_Landline_No" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['DO Landline No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <!-- <span id="alert_landline_no2" style="color: red;"></span> -->
                  </div>
                </div>
                <!--<div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Fax_No">Fax No. / फ़ैक्स नंबर</label>
                    <input type="text" name="DO_Fax_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="DO_Fax_No" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['DO Fax No_']??''}}" {{$disabled}}>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="DO_Email">E-mail. / ईमेल<font color="red">*</font></label>
                    <input type="text" name="DO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="DO_Email" maxlength="30" value="{{$vendor_data[0]['DO E-Mail']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <!-- <span id="alert_email3" style="color: red;"></span> -->
                  </div>
                </div>
                <div class="col-md-4"><br>
                  <div class="form-group">
                    <label for="DO_Mobile">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                    <input type="text" name="DO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="DO_Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['DO Mobile No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <!-- <span id="alert_mobile3" style="color: red;"></span> -->
                  </div>
                </div>
                @php
                $arr =array(0=>'Proprietorship', 1=>'Partnership', 2=>'Limited liability partnership', 3=>'PSU', 4=>'NGO');
                @endphp
                <!--<div class="col-md-4">
                  <div class="form-group">
                    <label>Legal Status Of Company / कंपनी की कानूनी स्थिति<font color="red">*</font></label>
                    <select {{$disabled}} name="Legal_Status_of_Company" id="Legal_Status_of_Company" class="form-control form-control-sm" style="width: 100%;">
                      <option value="">Select Category</option>
                      @foreach($arr as $key =>$value)
                      <option value="{{$key}}" @if( @$vendor_data[0]['Legal Status of Company']==$key ) selected="selected" @endif>{{$value}}</option>
                      @endforeach
                    </select>
                    <span id="alert_DO_legal_status_company" style="color: red;"></span>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="relevant_information">Any Other Relevant Information / कोई अन्य प्रासंगिक जानकारी<font color="red">*</font></label>
                    <input type="text" name="Other_Relevant_Information" placeholder="Enter Any Other Relevant Information" class="form-control form-control-sm" id="Other_Relevant_Information" value="{{$vendor_data[0]['Other Relevant Information']??''}}" onkeypress="return isAlphaNumericSpace(event)" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    <span id="alert_relevant_information" style="color: red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Authority Details / प्राधिकरण विवरण :-</h4>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Authority_Which_granted_Media">Authority Which Granted Media With Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया<font color="red">*</font></label>
                  <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="Authority_Which_granted_Media" maxlength="50" value="{{$vendor_data[0]['Authority Which granted Media']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Amount_paid_to_Authority">Amount Paid to Authority For The Current Year / चालू वर्ष के लिए प्राधिकरण को भुगतान की गई राशि</label>
                  <input type="text" name="Amount_paid_to_Authority" placeholder="Enter Amount Paid to Authority For The Current Year" class="form-control form-control-sm" id="fax_no4" onkeypress="return onlyNumberKey(event)" value="{{ @$vendor_data[0]['Amount paid to Authority'] != '' ? round($vendor_data[0]['Amount paid to Authority'],2):''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="alert_Amount_paid_to_Authority" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4"><br>
                <div class="form-group">
                  <label for="license_from">License start date / लाइसेंस शुरू होने
                    की दिनांक<font color="red">*</font></label>
                  <input type="date" name="License_From" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d', strtotime('-10 years')) }}" max="{{date('Y-m-d')}}" value="{{ @$vendor_data[0]['License From'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License From'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="date_error" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                    <font color="red">*</font>
                  </label>
                  <input type="date" name="License_To" placeholder="DD/MM/YYYY" maxlength="10" class="form-control form-control-sm" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ @$vendor_data[0]['License To'] ? date('Y-m-d', strtotime(@$vendor_data[0]['License To'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="date_error" style="color:red;display: none;"></span>
                </div>
              </div>
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label>Duration / अवधि </label>
                  <input type="date" name="Media_Type" placeholder="DD/MM/YYYY" maxlength="10" class="form-control form-control-sm" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ (!empty($vendor_data[0]['Duration']) && @$vendor_data[0]['Duration'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$vendor_data[0]['Duration'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div> -->
              @php
              $arr =array(0=>'Size per unit', 1=>'Size per sqft',2=> 'Spot per unit');
              @endphp
              <div class="col-md-4">
                <div class="form-group">
                  <label>Rental Type / किराये का प्रकार</label>
                  <select name="Rental_Agreement" class="form-control form-control-sm {{ $click }}" style="width: 100%; pointer-events: {{$pointer}};" id="rental_type" {{$read}} tabindex="{{$tab}}">
                    <option value="">Select Type</option>

                    @foreach($arr as $key =>$value)
                    <!-- !empty( @$vendor_data[0]['Rental Agreement'] ) && @$vendor_data[0]['Rental Agreement']==$key -->
                    <option value="{{$key}}" @if(@$vendor_data[0]['Rental Agreement']==$key) selected="selected" @endif>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row col-md-12">
              <h4 class="subheading">Details Of Outdoor Media Formatted Offered / ऑफ़र किए गए आउटडोर मीडिया का विवरण: :-</h4>
            </div>
            <div class="row" style="display: {{$show}};">
              <div class="col-md-6">
                <h6>If you want to import through XLS <a href="{{asset('uploads/location_details_personal.xlsx')}}" target="_blank">Download Sample File</a></h6>
              </div>
              <div class="col-md-3">
                <input type="radio" name="xls" id="xlxyes" value="1" class="xls"> Yes &nbsp;
                <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked"> No
              </div>
            </div><br><br>

            <div class="row" id="xls_show">
              <div class="col-md-4">
                <input type="file" name="media_import" id="media_address_import" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              </div><br><br><br><br>
            </div>

            <div id="media_address">
              @forelse($soleaddress as $key => $sole)
              <div class="row" id="workid{{$key}}">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Media category / मीडिया श्रेणी <font color="red">*</font>
                    </label>
                    <p>
                      <select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm mediaclass" style="width: 100%;" id="applying_media_{{$key}}" data-val="showcategory_{{$key}}" tabindex="{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                        <option value="">Select Category</option>
                        <option value="0" {{@$sole->{'OD Media Type'}=='0' ? 'selected' : ''}}>Airport </option>
                        <option value="1" {{@$sole->{'OD Media Type'}=='1' ? 'selected' : ''}}>Railway Station</option>
                        <option value="2" {{@$sole->{'OD Media Type'}=='2' ? 'selected' : ''}}>Road side </option>
                        <option value="3" {{@$sole->{'OD Media Type'}=='3' ? 'selected' : ''}}>Moving Media</option>
                        <option value="4" {{@$sole->{'OD Media Type'}=='4' ? 'selected' : ''}}>Public utility</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-4" id="subcategory">
                  <div class="form-group">
                    <label>Media Sub-Category / मीडिया उप-श्रेणी : <font color="red">*</font>
                    </label>
                    <p>
                      <select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat{{$key}} " id="showcategory_{{$key}}" tabindex="{{$key}}" data-eid="showcategory_{{$key}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                        <option value="">Select Sub-Category</option>
                        @if(@$sole->{'OD Media Type'}!='')
                        @foreach($getcat as $cat)
                        <option value="{{$cat->media_uid}}" {{@$sole->{'OD Media ID'}==$cat->media_uid ? 'selected' : ''}}>
                          {{$cat->name}}
                        </option>
                        @endforeach
                        @endif
                      </select>
                    </p>
                  </div>
                </div>
                <input type="hidden" name="od_media_id[]" value="{{@$sole->{'Sole Media ID'} ?? ''}}">
                <input type="hidden" name="line_no[]" value="{{@$sole->{'Line No_'} ?? ''}}">
                <div class="col-md-6"></div>
                <!--<div class="col-md-2" style="padding: 2% 0 0 90%;">Remove</div>-->

                <div class="col-md-2" style="padding: 2% 0 5 88%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger remove_row_next" data="{{$key}}" data-hide="workid{{$key}}" style="display: {{ $show; }}"><i class="fa fa-minus"></i> Remove</button>

                  <input type="hidden" value="{{$sole->{'Line No_'} ?? ''}}" name="line_no[]" id="line_no_{{$key}}">
                  <input type="hidden" value="{{$sole->{'Sole Media ID'} ?? ''}}" name="odmedia_id[]" id="odmedia_id_{{$key}}">
                </div>

              </div>
              @empty
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Media category / मीडिया श्रेणी <font color="red">*</font>
                    </label>
                    <p>
                      <select name="Applying_For_OD_Media_Type[]" class="form-control form-control-sm mediaclass" style="width: 100%;" id="applying_media_0" data-val="showcategory_0" tabindex="0">
                        <option value="">Select Category</option>
                        <option value="0">Airport </option>
                        <option value="1">Railway Station</option>
                        <option value="2">Road side </option>
                        <option value="3">Moving Media</option>
                        <option value="4">Public utility</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-4" id="subcategory">
                  <div class="form-group">
                    <label>Media Sub-Category / मीडिया उप-श्रेणी : <font color="red">*</font>
                    </label>
                    <p>
                      <select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat0 " id="showcategory_0" tabindex="0" data-eid="showcategory_0">
                        <option value="">Select Sub-Category</option>
                      </select>
                    </p>
                  </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2" style="padding: 2% 0 0 5%;"></div>
                @php
                $key=0;
                @endphp
              </div>
              @endforelse
            </div>
            <!-- media_address id close -->
            <input type="hidden" name="lineno1" id="lineno1" value="{{$extline1 ?? ''}}">
            <div class="row" style="float:right;margin-top: 6px;margin-right: 0px;">
              <input type="hidden" name="count_id" id="count_id" value="{{$key ?? 0}}">
              <a class="btn btn-primary" id="add_row_media_add" style="display:{{ $show; }}">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </div>





            <div class="row col-md-12">
              <h4 class="subheading">Details of work in last six months, for the applied media only, if any (As per format given below)<br>
                केवल लागू मीडिया के लिए पिछले छह महीनों में कार्य का विवरण, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार) :-</h4>
            </div>
            <div class="row" style="display: {{$show}};">
              <div class="col-md-6">
                <h6>If you want to import through XLS <a href="{{asset('uploads/work_done_excel.xlsx')}}" target="_blank">Download Sample File</a>
                </h6>
              </div>
              <div class="col-md-3">
                <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2"> Yes &nbsp;
                <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" checked="checked"> No
              </div>
            </div>
            <div class="row" id="xls_show2" style="display: none;">
              <div class="col-md-4">
                <input type="file" name="media_import2" id="media_work_import" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              </div>
            </div>

            <div id="details_of_work_done">
              @foreach($OD_work_dones_data as $key => $work_done_data)
              <div class="row" id="workid{{$key}}">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="year">Year / वर्ष<font color="red">*</font></label>
                    <p>
                      <select name="ODMFO_Year[]" id="Years{{$key}}" class="form-control form-control-sm ddlYears" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
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
                      <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};" step="1">
                    </p>
                    <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
                  </div>
                </div>
                <div class="col-md-4">
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
                      <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>From Date / की दिनांक से<font color="red">*</font></label>
                    <p>
                      <input type="date" name="from_date[]" id="from_date{{$key}}" maxlength="10" value="{{ (!empty(@$work_done_data['From Date']) && @$work_done_data['From Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['From Date'])) : ''}}" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>To Date / दिनांक तक :<font color="red">*</font></label>
                    <p>
                      <input type="date" name="to_date[]" id="to_date{{$key}}" maxlength="10" value="{{ (!empty(@$work_done_data['To Date']) && @$work_done_data['To Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['To Date'])) : ''}}" class="form-control form-control-sm" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                    </p>
                  </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2" style="padding: 2% 0 5 88%; display: {{$key==0 ? 'none' :'block'}}"><button class="btn btn-danger remove_row_next" data="{{$key}}" data-hide="workid{{$key}}" style="display: {{ $show; }}"><i class="fa fa-minus"></i> Remove</button>
                  <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no" id="line_no_{{$key}}">
                  <input type="hidden" value="{{$work_done_data['OD Media ID'] ?? ''}}" name="odmedia_id" id="odmedia_id_{{$key}}">
                </div>
              </div>
              @endforeach
            </div>
            <div class="row">
              <div class="col-md-11"></div>
              <div class="col-md-1" style="padding-left: 88%;">
                <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                <a class="btn btn-primary" id="add_rows_next" style="display:{{ $show; }}"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
              </div>
            </div>

            <!-- remove file upload from work done section and put here 10-Feb -->
            <div class="row">
              <div class="col-md-4">
                @if(@$vendor_data[0]['File Name']=="")
                <div class="form-group">
                  <label for="exampleInputFile">Upload Document / दस्तावेज़ अपलोड करें {{ @$vendor_data[0]['File Name'] }}
                    <font color="red">*</font>
                  </label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="file_name" class="custom-file-input" id="file_name">
                      <label class="custom-file-label" id="file_name2" for="file_name">Choose file</label>
                    </div>
                    @if(@$vendor_data[0]['File Name'] != '')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ @$vendor_data[0]['File Name'] }}" target="_blank">View</a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="file_name3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="file_name1" class="error invalid-feedback"></span>
                </div>
                @else
                <div class="form-group">
                  <label for="exampleInputFile">Upload Document / दस्तावेज़ अपलोड करें <font color="red">*</font></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="file_name_modify" class="custom-file-input {{ $click }}" id="file_name_modify" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                      <label class="custom-file-label" id="file_name_modify2" for="file_name_modify">{{@$vendor_data[0]['File Name'] ?? 'Choose file' }}</label>
                    </div>
                    @if(@$vendor_data[0]['File Name'] != '')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ @$vendor_data[0]['File Name'] }}" target="_blank">View</a></span>
                    </div>
                    @else
                    <div class="input-group-append">
                      <span class="input-group-text" id="file_name_modify3">Upload</span>
                    </div>
                    @endif
                  </div>
                  <span id="file_name_modify1" class="error invalid-feedback"></span>
                </div>
                @endif
              </div>
            </div>


            @if(!empty($vendor_data[0]['OD Media ID']))
            <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="{{$vendor_data[0]['OD Media ID']}}">
            @else
            <input type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="">
            @endif
            <input type="hidden" name="next_tab_2" id="next_tab_2" value="0">
            <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a> <!-- Add 10 march -->
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
                  <input type="text" class="form-control form-control-sm" name="DD_No" id="dd_no" placeholder="Enter DD No." onkeypress="return onlyNumberKey(event)" maxlength="4" value="{{$vendor_data[0]['DD No_']??''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dd_date">DD Date / डीडी दिनांक<font color="red">*</font></label>
                  <input type="date" class="form-control form-control-sm" name="DD_Date" id="dd_date" placeholder="Enter DD Date" min="{{ date('Y-m-d',strtotime('-3 months')) }}" value="{{ @$vendor_data[0]['DD Date'] ? date('Y-m-d', strtotime(@$vendor_data[0]['DD Date'])) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="DD_Bank_Name" id="bank_name_1" placeholder="Enter Bank Name" maxlength="30" onkeypress=" return onlyAlphabets(event)" value="{{$vendor_data[0]['DD Bank Name'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="alert_bank_name_1" style="color: red;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch Name/ शाखा का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" name="DD_Bank_Branch_Name" id="DD_Bank_Branch_Name" placeholder="Enter Branch Name" maxlength="30" value="{{$vendor_data[0]['DD Bank Branch Name'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dd_account">DD Amount / डीडी राशि<font color="red">*</font></label>
                  <input type="text" name="Application_Amount" id="dd_amount" class="form-control form-control-sm" placeholder="Enter DD Account" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{@$vendor_data[0]['Application Amount'] ? round(@$vendor_data[0]['Application Amount'],2) : ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">

                </div>
              </div>

            </div>
            <div class="row" id="neft_div">
              <div class="col-md-12" style="display: flex;">
                <h4 class="subheading">NEFT Details / एनईएफटी विवरण :- </h4>
                <!-- <h4 class="subheading">Fee/NEFT Details :- </h4>&nbsp; <p>Application fee Rs.1000/- (non refundable)</p> -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font></label>
                  <input type="text" name="PAN" class="form-control form-control-sm" id="pan_no" placeholder="Enter Pan No." maxlength="10" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['PAN'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="PAN_No_Error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font></label>
                  <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                  <span id="IFSC_code_Error"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" name="Bank_Name" id="bank_name" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
                  <input type="text" name="Bank_Branch" id="branch_name" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="account_no">Account no / खाता नंबर<font color="red">*</font></label>
                  <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{$read}} tabindex="{{$tab}}" style="pointer-events: {{$pointer}};">
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
                  <!-- (@$vendor_data[0]['Modification'] == 1) && @$vendor_data[0]['Legal Doc File Name'] != '' ) -->
                  <div class="input-group">
                    @if(@$vendor_data[0]['Legal Doc File Name'] != '' )
                    <div class="custom-file">
                      <input type="file" name="Legal_Doc_File_Name_modify" class="custom-file-input {{ $click }}" id="Legal_Doc_File_Name_modify" {{$disabled}}>
                      <label class="custom-f
                      ile-label" id="Legal_Doc_File_Name_modify2" for="Legal_Doc_File_Name_modify">{{ @$vendor_data[0]['Legal Doc File Name'] ? @$vendor_data[0]['Legal Doc File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Legal_Doc_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="Legal_Doc_File_Name" class="custom-file-input {{ $click }}" id="Legal_Doc_File_Name">
                      <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">{{ @$vendor_data[0]['Legal Doc File Name'] ? @$vendor_data[0]['Legal Doc File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Legal_Doc_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['Legal Doc File Name'] != '')
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="Legal_Doc_File_Name_value" value="{{ $vendor_data[0]['Legal Doc File Name'] ?? '' }}">
                  <span id="Legal_Doc_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Attach copy of Pan Number and authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें<font color="red">*</font></label>
                  <div class="input-group">
                    @if(@$vendor_data[0]['PAN Attached'] == '1')
                    <div class="custom-file">
                      <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name_modify" class="custom-file-input {{ $click }}" id="Attach_Copy_Of_Pan_Number_File_Name_modify">
                      <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name_modify2" for="Attach_Copy_Of_Pan_Number_File_Name_modify">{{ @$vendor_data[0]['PAN File Name'] ? @$vendor_data[0]['PAN File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input {{ $click }}" id="Attach_Copy_Of_Pan_Number_File_Name">
                      <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">{{ @$vendor_data[0]['PAN File Name'] ? @$vendor_data[0]['PAN File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['PAN Attached'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['PAN File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="Attach_Copy_Of_Pan_Number_File_Name_value" value="{{ @$vendor_data[0]['PAN File Name'] ?? ''}}">
                  <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Upload document of outdoor media format(attach supportive documents viz, Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed) / आउटडोर मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें, जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत, भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता निष्पादित नहीं किया गया है)<font color="red">*</font></label>
                  <div class="input-group">
                    @if(@$vendor_data[0]['Notarized Copy File Name'] !='')
                    <div class="custom-file">
                      <input type="file" name="Notarized_Copy_File_Name_modify" class="custom-file-input {{ $click }}" id="Notarized_Copy_File_Name_modify">
                      <label class="custom-file-label" for="Notarized_Copy_File_Name_modify" id="Notarized_Copy_File_Name_modify2">{{ @$vendor_data[0]['Notarized Copy File Name'] ? @$vendor_data[0]['Notarized Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Notarized_Copy_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="Notarized_Copy_File_Name" class="custom-file-input {{ $click }}" id="Notarized_Copy_File_Name">
                      <label class="custom-file-label" for="Notarized_Copy_File_Name" id="Notarized_Copy_File_Name2">{{ @$vendor_data[0]['Notarized Copy File Name'] ? @$vendor_data[0]['Notarized Copy File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['Notarized Copy File Name'] !='')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="Notarized_Copy_File_Name_value" value="{{ @$vendor_data[0]['Notarized Copy File Name'] ?? ''}}">
                  <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6"><br><br>
                <div class="form-group">
                  <label for="exampleInputFile">Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit / स्टाम्प पेपर पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे में<font color="red">*</font></label>
                  <div class="input-group">
                    @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                    <div class="custom-file">
                      <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input {{ $click }}" id="Affidavit_File_Name_modify">
                      <label class="custom-file-label" id="Affidavit_File_Name_modify2" for="Affidavit_File_Name_modify">{{ @$vendor_data[0]['Affidavit File Name'] ? @$vendor_data[0]['Affidavit File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Affidavit_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="Affidavit_File_Name" class="custom-file-input {{ $click }}" id="Affidavit_File_Name">
                      <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{ @$vendor_data[0]['Affidavit File Name'] ? @$vendor_data[0]['Affidavit File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Affidavit File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="Affidavit_File_Name_value" value="{{ $vendor_data[0]['Affidavit File Name'] ?? '' }}">
                  <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Photographs of displayed medium (Separate photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक संपत्ति के लिए अलग फोटो)<font color="red">*</font></label>
                  <div class="input-group">
                    @if(@$vendor_data[0]['Photographs'] == '1')
                    <div class="custom-file">
                      <input type="file" name="Photo_File_Name_modify" class="custom-file-input {{ $click }}" data="0" onchange="return uploadFile(0,this)" id="Photo_File_Name_modify">
                      <label class="custom-file-label" id="Photo_File_Name_modify2" for="Photo_File_Name_modify">{{ @$vendor_data[0]['Photo File Name'] ? $vendor_data[0]['Photo File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Photo_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="Photo_File_Name" class="custom-file-input {{ $click }}" data="0" onchange="return uploadFile(0,this)" id="Photo_File_Name">
                      <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">{{ @$vendor_data[0]['Photo File Name'] ? $vendor_data[0]['Photo File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['Photographs'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Photo File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="Photo_File_Name_value" value="{{ $vendor_data[0]['Photo File Name'] ?? ''}}">
                  <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-6"><br>
                <div class="form-group">
                  <label for="exampleInputFile">GST registration Certificate / जीएसटी पंजीकरण प्रमाणपत्र<font color="red">*</font></label>
                  <div class="input-group">
                    @if(@$vendor_data[0]['GST Registration'] == '1')
                    <div class="custom-file">
                      <input type="file" name="GST_File_Name_modify" class="custom-file-input {{ $click }}" id="GST_File_Name_modify">
                      <label class="custom-file-label" id="GST_File_Name_modify2" for="GST_File_Name_modify">{{ @$vendor_data[0]['GST File Name'] ? $vendor_data[0]['GST File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="GST_File_Name_modify3">Upload</span>
                    </div>
                    @else
                    <div class="custom-file">
                      <input type="file" name="GST_File_Name" class="custom-file-input {{ $click }}" id="GST_File_Name">
                      <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">{{ @$vendor_data[0]['GST File Name'] ? $vendor_data[0]['GST File Name'] : 'Choose file' }}</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="GST_File_Name3">Upload</span>
                    </div>
                    @endif
                    @if(@$vendor_data[0]['GST Registration'] == '1')
                    <div class="input-group-append">
                      <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['GST File Name'] }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                    </div>
                    @endif
                  </div>
                  <input type="hidden" name="GST_File_Name_value" value="{{ $vendor_data[0]['GST File Name'] ?? '' }}">
                  <span id="GST_File_Name1" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>
            <!-- checkbox -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="icheck-success d-inline">
                    <input type="checkbox" class="{{ $click }}" name="self_declaration" id="self_declaration" {{ @$vendor_data[0]['Self-declaration'] == 1 ? "checked" : "" }}>
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

            <input type="hidden" name="read_only_form" id="read_only_form">
            @if(@$vendor_data[0]['Modification'] != '1')
            <a class="btn btn-primary set-pm-next-button  "><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
            @else
            <a class="btn btn-primary {{$click}} "><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</a>
            @endif
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
  //  next and previous function for save
  function nextSaveData(id) {
    @if(@$vendor_data[0]['Modification'] != '1')
    console.log(id);
    if ($("#read_only_form").val() == '') {
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
                // window.location.reload();
                window.location.href = 'personal-list';
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
    } else {
      console.log('readonly form');
    }

    @endif
  }

  $(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
      e.preventDefault();
      return false;
    });
  });

  //add more for branch 7-March
  $(document).ready(function() {
    $("#add_branch").click(function() {
      var i = $("#count_branch_id").val();
      i++;
      var append = '<div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="Name">State / राज्य<font color="red">*</font></label><p><select id="owner_state0" name="BO_state[]" class="form-control form-control-sm call_district" data="owner_district' + i + '"><option value="">Select State</option>@if(count($states) > 0)@foreach($states as $statesData)<option value="{{ $statesData['Code'] }}">{{$statesData['Description']}}</option>@endforeach @endif </select></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea  type="text" name="BO_Address[]" id="BO_Address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><input type="text" name="BO_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="bo_landline_no' + i + '" maxlength="14" onkeypress="return onlyNumberKey(event)"></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="BO_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email' + i + '" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><input type="text" name="BO_Mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding: 2% 0 0 5%;"><button class="btn btn-danger remove_branch_row" id="' + i + '"><i class="fa fa-minus"></i> Remove</button></div></div>';
      $("#radio").append(append);
      $("#count_branch_id").val(i);
    });
    $(document).on('click', '.remove_branch_row', function(e) {
      // var ind = $(this).attr('data');
      e.preventDefault();
      var id = $(this).attr('id');
      $("#row" + id).remove();

      var add_count = $("#count_branch_id").val();
      $("#count_branch_id").val(add_count - 1);
    });
  });



  //for media category
  $(document).ready(function() {
    $("#add_row_media_add").click(function() {
      var i = $("#count_id").val();
      i++;
      $.ajax({
        url: "{{url('fetchStates')}}",
        type: "GET",
        dataType: 'json',
        success: function(result) {
          // var obj = JSON.parse(data);
          var html = '';
          var html = '<option value="">Select any state</option>';
          $.each(result.data, function(key, value) {
            html += '<option value="' + value.Code + '">' + value
              .Description + '</option>';
          });

          $("#media_address").append(
            '<div class="row"><div class="col-md-4"><div class="form-group"><label>Media category / मीडिया श्रेणी <font color="red">*</font></label><p><select name="Applying_For_OD_Media_Type[]" tabindex="' + i + '" id="applying_media_' +
            i + '" data-val="showcategory_' + i +
            '" class="form-control form-control-sm mediaclass" style="width: 100%;"><option value="">Select Category</option><option value="0">Airport</option><option value="1">Railway Station</option><option value="2">Road side</option><option value="3">Moving Media</option><option value="4">Public utility</option></select></p></div></div><div class="col-md-4" id="subcategory" ><div class="form-group"><label>Media Sub-Category / मीडिया उप-श्रेणी : </label><p><select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat' + i + '" tabindex="' + i + '" data-eid="showcategory_' + i + '" id="showcategory_' +
            i +
            '"><option value="">Select Sub-Category</option></select></p></div></div><div class="col-md-6"></div><div class="col-md-2" style="padding: 2% 0 0 90%;"><button class="btn btn-danger remove_row"><i class="fa fa-minus"></i> Remove</button></div></div>'
          );
        }
      });
      $("#count_id").val(i);
    });
    $("#media_address").on('click', '.remove_row', function() {
      var ind = $(this).attr('data');
      var line_no = $("#line_no_m" + ind).val();
      var odmedia_id = $("#odmedia_id_m" + ind).val();
      if (line_no != '' && odmedia_id != '') {
        if (confirm("Are you sure you want to delete this?")) {

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'get',
            url: 'remove-mediaaddress-data',
            data: {
              line_no: line_no,
              od_media_id: odmedia_id
            },
            success: function(response) {
              console.log(response);
            }
          });
        } else {
          return false;
        }
      }
      $(this).parent().parent().remove();
      var add_count = $("#count_id").val();
      $("#count_id").val(add_count - 1);
    });
  });




  //sk for subcategory
  $(document).on('change', '.mediaclass', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data-val");
      var i;
      var dyn_sub = [];
      var tabindex = $(this).attr("tabindex");

      for (i = 0; i <= tabindex; i++) {

        if (i > 0) {
          var autoid = i - 1;
          var idattrdynsub = $('.dynemicsub_cat' + autoid).attr('id');
          var id_attrdyn_sub12 = idattrdynsub.slice(0, 13);
          var id_attrdyn_sub = id_attrdyn_sub12.concat(autoid);
          dyn_sub.push($('#' + id_attrdyn_sub).val());
        }
      }

      console.log(dyn_sub);
      $("#" + id).empty();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'POST',
        url: "{{Route('perfetchmedia')}}",
        data: {
          media_code: $(this).val(),
          dyn_sub: dyn_sub
        },
        success: function(response) {
          $("#" + id).html(response);

        }
      });
    }
  });

  $("#xls_show").hide();
  $("#xlxyes").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '1') {
      $("#xls_show").show();
      // $("input[name='MA_City[]'").val('');
      // $("select[name='MA_State[]'").val('').html('<option value="" selected="selected">Select State</option>');
      // $("select[name='MA_District[]'").val('').html('<option value="" selected="selected">Select District</option>');
      // $("input[name='MA_Zone[]'").val('');
      // $("select[name='Applying_For_OD_Media_Type[]'").val('').html('<option value="" selected="selected">Select Category</option>');
      // $("select[name='od_media_type[]'").val('').html('<option value="" selected="selected">Select Sub-Category</option>');
      // $("input[name='ODMFO_Display_Size_Of_Media[]'").val('');
      // $("select[name='Illumination_media[]'").val('').html('<option value="" selected="selected">Select Illumination</option>');
      // $("input[name='av_start_date[]'").val('');
      // $("input[name='av_end_date[]'").val('');
      $("#media_address").hide();
      $("#add_row_media_add").hide();
    }

  });
  $("#xlxno").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '0') {
      //for reset input file box
      var $el = $('#media_address_import');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();

      $("#xls_show").hide();
      $("#media_address").show();
      $("#add_row_media_add").show();

    }

  });

  $("#xlxyes2").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '1') {
      $("#xls_show2").show();
      $("#details_of_work_done").hide();
      $("#add_row_next").hide();
    }

  });
  $("#xlxno2").click(function() {
    var xlsvalue = $(this).val();
    if (xlsvalue == '0') {

      //for reset input file box
      var $el = $('#media_work_import');
      $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();

      $("#xls_show2").hide();
      $("#details_of_work_done").show();
      $("#add_row_next").show();
    }

  });
</script>
@endsection