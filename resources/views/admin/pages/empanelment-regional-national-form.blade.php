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

  .dropdown-menu.show {
    display: block;
    width: 100% !important;
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


/*css for multiselect scroll */
.multiselect-container.dropdown-menu {
    height: 200px;
    overflow-y: scroll;
}
.multiselect-container>li>a>label {
    height: auto !important;
}
/*End of css for multiselect scroll */

#date_input{text-indent: -500px;height:25px; width:200px;}
</style>
                  @section('content')
                  @php
                  $OwnerDetails=$OwnerDetails ?? [1];
                  $Chanal_Details=$Chanal_Details ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $pointer ='';
                  $click='';
                  $tab ='';
                  if(@$Chanal_Details->{'Modification'} == 1){
                  $disabled = '';
                  $readonly = 'readonly';
                  $checked = 'checked';
                  $pointer='none';
                  $read='readonly';
                  $click='preventLeftClick';
                  $tab='-1';
                  }
                  @endphp

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Fresh Empanelment of AV-TV</h6>
            @if(@$Chanal_Details->{'Modification'} == 1)
            <p><a href="{{url('avtvPDF/'.@$Chanal_Details->{'Channel ID'} ?? '')}}" class="m-0 font-weight-normal text-primary"> <i class="fa fa-download"></i> AV-TV Application Receipt</a></p>
            @endif
        </div>
        <input type="hidden" id="Final_submi_msg">
        <div class="alert alert-success alert-dismissible text-center fade show" id="Final_submi" style="display: none;" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        <!-- Card Body -->
        <div class="card-body">

                <form id="emp_regional_national" method="post"  enctype="multipart/form-data">
                  @csrf
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active show" href="#tab1">Basic Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab2">AV-TV Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab3">Account Details</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#tab4">Upload Document</a>
                        </li>
                      </ul>
                  <div class="tab-content p-3">
                    <!-- your steps content here -->

                   <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label for="Name">Agency Name / प्रकाशन का नाम<font color="red">*</font></label>
                              <input type="text" class="form-control form-control-sm" name="owner_name" id="owner_name" placeholder="Enter Agency Name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} {{$readonly}} value="{{@$OwnerDetails->{'Owner Name'} ?? ''}}">
                          </div>
                         </div>
                         <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">E-mail ID / ई मेल आईडी<font color="red">*</font></label>
                            <input type="text" name="email" class="form-control form-control-sm" id="email" placeholder="Enter E-mail ID" maxlength="50" {{$readonly}} value="{{@$OwnerDetails->{'Email ID'} ?? ''}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" name="mobile" id="mobile" maxlength="10" placeholder="Enter mobile  no." class="form-control form-control-sm input-imperial" onkeypress="return onlyNumberKey(event)"
                            {{$readonly}} value="{{@$OwnerDetails->{'Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                      <div class="row col-md-12 ml-1">
                      <h4 class="subheading">Owner’s Head Office / मालिक का प्रधान कार्यालय:-</h4>
                    </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
                          <textarea name="address" id="address" placeholder="Enter address" maxlength="120" rows="1" cols="50" class="form-control form-control-sm" {{$readonly}}>{{@$OwnerDetails->{'Address 1'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">State / राज्य<font color="red">*</font></label>
                          <input type="hidden" id="tab1_state" value="district">
                          <select  id="state" name="state" class="form-control form-control-sm callstatemulti {{$click}}" data="district" city-data="city" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select State</option>
                              @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option  value="{{$sat['Code']}}" @if(@$OwnerDetails->{'State'} == $sat['Code']) selected="selected" @endif>{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">District / ज़िला <font color="red">*</font></label>
                          <select  id="district" name="district" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}"tabindex="{{$tab}}">
                              <option  value="">Select District</option>
                              @if($dist > 0)
                              @foreach($dist as $distr)
                              <option value="{{$distr['District'] ?? ''}}"
                              @if(@$OwnerDetails->{'District'} == $distr['District']) selected="selected" @endif>{{$distr['District'] ?? ''}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">City / नगर  <font color="red">*</font></label>
                          <select  name="city" id="city" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}"tabindex="{{$tab}}">
                              <option  value="">Select City</option>
                              @php $city = strtolower(@$OwnerDetails->{'City'});@endphp
                              <option value="{{@$OwnerDetails->{'City'} ?? '' }}" {{@$OwnerDetails->{'City'} ? 'selected' : '' }}>
                                {{ucwords($city) ?? ''}}</option>

                          </select>
                         </div>
                        </div>
                        <!-- <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">City / नगर<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="city" id="city" placeholder="Enter city" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$OwnerDetails->{'City'} ?? ''}}">
                         </div>
                      </div> -->
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. (with STD code) /फोन नंबर (एसटीडी कोड के साथ)</label>
                          <input type="text" name="phone_no" class="form-control form-control-sm" id="phone_no" placeholder="Enter phone number" onkeypress="return onlyNumberKey(event)" maxlength="15" {{$readonly}} value="{{@$OwnerDetails->{'Phone No_'} ?? ''}}">
                        </div>
                      </div>
                        </div>
                        <input type="hidden" name="ownerid" id="ownerid" {{$readonly}} value="">
                         <input type="hidden" name="next_tab_1" id="next_tab_1" {{$readonly}} value="0">
                        <a class="btn btn-primary regional-national"  id="tab_1">Next
                          <i class="fa fa-arrow-circle-right fa-lg"></i>
                        </a>
                      <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    </div>
                    <div id="tab2" class="content  pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                    <div class="row">
                      <input type="hidden" name="reginal_type" value="{{$formType ?? ''}}">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="newspaper_name">Name of Parent Company/Group / मूल कंपनी/समूह का नाम<font color="red">*</font></label>
                        <input type="text" name="company_Group" placeholder="Enter company name" class="form-control form-control-sm" id="newspaper_name" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}} value="{{@$Chanal_Details->{'Parent Company Name'} ?? ''}}">
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="place_of_publication">Name of Channel / चैनल का नाम<font color="red">*</font></label>
                        <select name="chanel_name" id="place_of_publication" class="form-control form-control-sm" {{$readonly}}
                            style="pointer-events: {{$pointer}}" tabindex="{{$tab}}" onchange="getChannelDetails(this)">
                            <option value="">Select Channel Name</option>
                                @foreach(@$channeldata as $key=>$chdata)
                                <option value="{{@$chdata->{'channel_name'} ?? '' }}">{{ @$chdata->{'channel_name'} }}</option>
                                @endforeach
                            </select>
                      </div>
                      </div>



                     @php
                        $Uplinking_Validity_Date =substr(@$Chanal_Details->{'Uplinking Validity Date'}, 0,10);
                        $U_V_D ='';
                        if($Uplinking_Validity_Date != '1970-01-01'){
                          $U_V_D  = $Uplinking_Validity_Date;
                          }else{
                          $U_V_D  ='';
                          }
                        @endphp

                        <?php
                        $date=date_create($U_V_D);
                        //echo date_format($date,"d/m/Y H:i:s");
                        ?>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="rni_registration_no">Uplinking Valid Upto / अपलिंकिंग तक वैध है<font color="red">*</font></label>
                        <input type="date" name="Uplinking_valid_upto" data="Down_linking_valid_upto" placeholder="Enter Uplinking Valid Upto." class="form-control form-control-sm" id="Uplinking_valid_upto"  maxlength="15"
                        {{$readonly}} value="{{$U_V_D ?? ''}}">
                       </div>
                      </div>
                        @php
                        $Downlinking_Validity_Date =substr(@$Chanal_Details->{'Downlinking Validity Date'}, 0,10);
                        $D_V_D ='';
                        if($Downlinking_Validity_Date != '1970-01-01'){
                          $D_V_D  = $Downlinking_Validity_Date;
                          }else{
                          $D_V_D  ='';
                          }
                          $format_date = date('d/m/Y',strtotime($D_V_D));
                        @endphp
                      <div class="col-md-4">
                      <div class="form-group date">
                        <label for="claimed_circulation">Downlinking valid upto / डाउन-लिंकिंग तक मान्य है<font color="red">*</font></label>
                        <input type="date" name="Down_linking_valid_upto" placeholder="" class="form-control form-control-sm" id="Down_linking_valid_upto" data="Uplinking_valid_upto"  maxlength="40"
                        {{$readonly}} value="{{$D_V_D ?? ''}}">
                        <span id="Down_linking_Error"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="page_length">EMMC license No. / ईएमएमसी लाइसेंस संख्या
                          <!-- <font color="red">*</font> -->
                        </label>
                        <input type="text" name="EMMC_License_No" class="form-control form-control-sm"
                        id="EMMC_License_No"  placeholder="Enter EMMC License No." onkeypress="return onlyNumberKey(event)"  {{$readonly}} value="{{@$Chanal_Details->{'EMMC License No_'} ?? ''}}">
                      </div>
                      </div>
                       @php
                        $EMMC_Date =substr(@$Chanal_Details->{'EMMC Date'}, 0,10);
                        $EM_DA ='';
                        if($EMMC_Date != '1970-01-01' && $EMMC_Date != '1900-01-01'){
                          $EM_DA  = $EMMC_Date;
                          }else{
                          $EM_DA  ='';
                        }
                      @endphp
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="page_width">Date of EMMC / ईएमएमसी की दिनांक
                          <!-- <font color="red">*</font> -->
                        </label>
                        <input type="date" name="Date_of_EMMC"  class="form-control form-control-sm" id="Date_of_EMMC" placeholder="dd-mm-yyyy" {{$readonly}} value="{{$EM_DA ?? ''}}">
                      </div>
                      </div>

                       <div class="col-md-4">
                        <div class="form-group">
                        <label>Regional/Language of Classification (In Case of Regional Channel) / वर्गीकरण की क्षेत्रीय/भाषा (क्षेत्रीय चैनल के मामले में)<font color="red">*</font></label>
                            <select name="Regional_Language[]" id="Regional_Language"  multiple class="form-control form-control-sm" {{$readonly}}
                            style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option value="">Select Language</option>

                            </select>
                        </div>
                    </div>
                     <div class="col-md-4" >
                        <div class="form-group">
                        <label for="Name">Legal Status of Company / कंपनी की कानूनी स्थिति<font color="red">*</font></label>
                        <select  id="Legal_status_of_company" name="Legal_status_of_company" class="form-control form-control-sm" {{$readonly}}
                        style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option {{$readonly}} value="">Select Legal Status of Company</option>
                            <option {{$readonly}} value="1" @if(@$Chanal_Details->{'Company Legal Status'} ==1) selected="selected" @endif>Partnership</option>
                            <option {{$readonly}} value="2" @if(@$Chanal_Details->{'Company Legal Status'} ==2) selected="selected" @endif>Proprietorship</option>
                            <option {{$readonly}} value="3" @if(@$Chanal_Details->{'Company Legal Status'} ==3) selected="selected" @endif>Public Ltd</option>
                            <option {{$readonly}} value="3" @if(@$Chanal_Details->{'Company Legal Status'} ==4) selected="selected" @endif>Pvt.Ltd</option>
                        </select>
                       </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Director/CEO/Head of Company /Channel / निदेशक/सीईओ/कंपनी/चैनल के प्रमुख<font color="red">*</font></label>
                          <input type="text" name="Head_of_Company" placeholder="Enter Head of Company" class="form-control form-control-sm" id="Head_of_Company"
                          onkeypress="return onlyAlphabets(event,this)"
                          {{$readonly}} value="{{@$Chanal_Details->{'Channel Director_CEO'} ?? ''}}">
                        </div>
                      </div>
                      @php
                      $month =[1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December'];
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Month of Launch of Channel / चैनल के लॉन्च का महीना<font color="red">*</font></label>
                            <select  id="Month_launch" name="Month_launch" id-data-m="Month_launch" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option {{$readonly}} value="">Select month of launch</option>
                            @foreach($month as $key=>$value)
                              <option value="{{$key}}" @if(@$Chanal_Details->{'Launch Month'} == $key) selected="selected" @endif>{{$value}}</option>
                            @endforeach
                            </select>
                        </div>
                      </div>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area"> Year of Launch of Channel / चैनल के शुभारंभ का वर्ष<font color="red">*</font></label>
                            <select  id="yearpicker"  name="Year_launch" class="form-control form-control-sm Year_launch" {{$readonly}}
                            style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option  value="">Select Year of Launch</option>
                            @if(@$Chanal_Details->{'Launch Year'} > 0)
                            <option  value="{{@$Chanal_Details->{'Launch Year'} ?? ''}}" @if(@$Chanal_Details->{'Launch Year'}) selected="selected" @endif>
                              {{@$Chanal_Details->{'Launch Year'} ?? ''}}
                            </option>
                            @endif
                            </select>
                            <span id="Month_launch_Error" class="text-danger"></span>
                        </div>

                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="print_area">Genre of Channel / चैनल की शैली<font color="red">*</font></label>
                          <select  id="Genre_of_channel" name="Genre_of_channel" class="form-control form-control-sm" {{$readonly}}
                          style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            {{-- <option value="0" {{( @$Chanal_Details->{'Channel Genre'} == 0 && @$Chanal_Details->{'Channel Genre'} !='' ? 'selected' : '') }}>Select genre of channel</option> --}}
                            <option  value="1" id="news_current" @if(@$Chanal_Details->{'Channel Genre'} == 1) selected="selected" @endif>News & Current Affairs</option>
                            <option  value="0" id="gec" @if(@$Chanal_Details->{'Channel Genre'} == 0) selected="selected" @endif>GEC</option>
                        </select>
                        </div>
                      </div>

                      @php
                        $Strimg_start =substr(@$Chanal_Details->{'Streaming Start Date'}, 0,10);
                        $streaming ='';
                        if($Strimg_start != '1970-01-01' && $Strimg_start != '1900-01-01'){
                          $streaming  = $Strimg_start;
                          }else{
                          $streaming  ='';
                          }
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Streaming_Start_Date">Streaming Start Date / स्ट्रीमिंग प्रारंभ दिनांक<font color="red">*</font></label>
                          <input type="date" class="form-control form-control-sm" name="Streaming_Start_Date" id="Streaming_Start_Date"placeholder="dd-mm-yyyy" onkeypress="return onlyNumberKey(event)"
                          {{$readonly}} value="{{$streaming ?? ''}}"  maxlength="15"  min="2000-01-01" max="{{date('Y-m-d')}}">
                        </div>
                      </div>
                      </div><br>
                    <div class="row col-md-12">
                      <h4 class="subheading">Delhi Office / दिल्ली कार्यालय :-</h4>
                    </div>
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                             <label for="Name">Contact Name / संपर्क नाम<font color="red">*</font></label>
                             <textarea name="Do_contact_name" id="Do_contact_name" placeholder="Enter Contact Name" rows="1" cols="50" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}}>{{@$Chanal_Details->{'DO Contact Name'} ?? ''}}</textarea>
                           </div>
                         </div>
                    <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
                          <textarea name="DO_Address" id="DO_Address" placeholder="Enter Address" rows="1" cols="50" class="form-control form-control-sm" maxlength="120" {{$readonly}}>{{@$Chanal_Details->{'DO Address'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">State / राज्य<font color="red">*</font></label>
                          <select  id="DO_State" name="DO_State" class="form-control form-control-sm callstatemulti" data="DO_District" city-data="DO_City" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                             <option value="">Select state</option>
                             @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option  value="{{$sat['Code'] ?? ''}}" @if(@$Chanal_Details->{'DO State'} == $sat['Code']) selected="selected" @endif data-DO-state="{{$sat['Description'] ?? ''}}">{{$sat['Description'] ?? ''}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">District / ज़िला<font color="red">*</font></label>
                          <select  id="DO_District" name="DO_District" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select district</option>
                              @if(!empty($district1))
                              @foreach($district1 as $stateDistrict1)
                                <option  value="{{@$Chanal_Details->{'DO District'} ?? ''}}" @if(@$Chanal_Details->{'DO District'} == @$stateDistrict1['District']) selected="selected" @endif>{{@$stateDistrict1['District'] ?? ''}}</option>
                              @endforeach
                            @endif
                          </select>
                         </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">City / नगर<font color="red">*</font></label>
                          <select  id="DO_City" name="DO_City" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select City</option>

                              <option value="{{@$Chanal_Details->{'DO City'} }}" {{@$Chanal_Details->{'DO City'}  ? 'selected' : '' }}>
                                @php $docity = strtolower(@$Chanal_Details->{'DO City'});@endphp
                                {{ucwords($docity) ?? ''}}</option>

                          </select>
                         </div>
                        </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. / फोन नंबर</label>
                          <input type="text" class="form-control form-control-sm" name="DO_Phone" id="DO_Phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)"
                          {{$readonly}} value="{{@$Chanal_Details->{'DO Landline No_(with STD)'} ?? ''}}"  maxlength="15">
                        </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="DO_Mobile" id="DO_Mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10"
                            {{$readonly}} value="{{@$Chanal_Details->{'DO Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">E-mail ID / ईमेल आईडी<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="DO_Email" id="DO_Email" placeholder="Enter E-mail ID" maxlength="50"
                            {{$readonly}} value="{{@$Chanal_Details->{'DO E-Mail'} ?? ''}}">
                          </div>
                      </div>
                   </div>
                   <br>
                  <div class="row col-md-12">
                      <h4 class="subheading">Head Office / प्रधान कार्यालय :-</h4>
                    </div>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              @if(@$Chanal_Details->{'HO Same Address DO'} == 1)
                              <input type="checkbox" id="HO_same_as_DO" name="HO_same_as_DO" class="get_channel_office_data {{$click}}" data="OHO"  {{$readonly}} value="1" checked="checked">
                              @else
                              <input type="checkbox" id="HO_same_as_DO" name="HO_same_as_DO" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                              @endif
                              <label for="HO_same_as_DO">Same as Delhi Office</label>
                            </div>
                          </div>
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                             <label for="Name">Contact Name / संपर्क नाम<font color="red">*</font></label>
                             <textarea name="HO_contact_name" id="HO_contact_name" placeholder="Enter Contact Name" rows="1" cols="50" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this)" maxlength="40" {{$readonly}}>{{@$Chanal_Details->{'HO Contact Name'} ?? ''}}</textarea>
                           </div>
                         </div>
                        <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
                          <textarea name="HO_Address" id="HO_Address" placeholder="Enter address" rows="1" cols="50" class="form-control form-control-sm {{$click}}"  maxlength="120" {{$readonly}}>{{@$Chanal_Details->{'HO Address'} ?? ''}}</textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">State / राज्य<font color="red">*</font></label>

                          <select  id="HO_State" name="HO_State" class="form-control form-control-sm callstatemulti" data="HO_District" city-data="HO_City" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option value="">Select State</option>
                              @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option value="{{$sat['Code']}}" @if(@$Chanal_Details->{'HO State'} == $sat['Code']) selected="selected" @endif>{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">District / ज़िला<font color="red">*</font></label>
                          <select  id="HO_District" name="HO_District" class="form-control form-control-sm" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                            <option  value="">Select district</option>
                            @if(!empty($district2))
                              @foreach($district2 as $stateDistrict2)
                                <option  value="{{@$Chanal_Details->{'HO District'} ?? ''}}" @if(@$Chanal_Details->{'HO District'} == @$stateDistrict2['District']) selected="selected" @endif>{{@$stateDistrict2['District']}}</option>
                              @endforeach
                            @endif
                          </select>
                         </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">City / नगर<font color="red">*</font></label>
                          <select  id="HO_City" name="HO_City" class="form-control form-control-sm {{$click}}" {{$readonly}} style="pointer-events: {{$pointer}}" tabindex="{{$tab}}">
                              <option  value="">Select City</option>
                              @php $hocity = strtolower(@$Chanal_Details->{'HO City'});@endphp
                              <option value="{{@$Chanal_Details->{'HO City'} ?? '' }}" {{ucwords(@$Chanal_Details->{'HO City'}) ? 'selected' : '' }}>{{ucwords($hocity) ?? ''}}</option>

                          </select>
                         </div>
                        </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No. / फोन नंबर</label>
                          <input type="text" class="form-control form-control-sm" name="HO_Phone" id="HO_Phone" placeholder="Enter Phone No." onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$Chanal_Details->{'DO Landline No_(with STD)'} ?? ''}}" maxlength="15">
                        </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No. / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="HO_Mobile" id="HO_Mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10"
                            {{$readonly}} value="{{@$Chanal_Details->{'HO Mobile No_'} ?? ''}}">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">E-mail ID / ईमेल आईडी<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="HO_Email" id="HO_Email" placeholder="Enter E-mail ID" maxlength="50"
                            {{$readonly}} value="{{@$Chanal_Details->{'HO E-Mail'} ?? ''}}">
                          </div>
                      </div>
                    </div>
                    <br>
                   <!--  <div class="row col-md-12">
                      <h4 class="subheading">Owner’s Delhi Office / मालिक का दिल्ली कार्यालय :-</h4>
                    </div> -->
              <!--<div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
                          <textarea name="ODO_Address" id="ODO_Address" placeholder="Enter Address" rows="1" cols="50" class="form-control form-control-sm" maxlength="120"></textarea>
                        </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">State / राज्य<font color="red">*</font></label>
                          <select  id="ODO_State" name="ODO_State" class="form-control form-control-sm callstatemulti" data="ODO_District">
                              <option {{$readonly}} value="">Select State</option>
                               @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option {{$readonly}} value="{{$sat['Code']}}">{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">District / ज़िला<font color="red">*</font></label>
                          <select  id="ODO_District" name="ODO_District" class="form-control form-control-sm">
                              <option {{$readonly}} value="">Select District</option>
                          </select>
                         </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">City / नगर<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="ODO_City" id="ODO_City" placeholder="Enter City" onkeypress="return onlyAlphabets(event,this)" maxlength="40">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No / फोन नंबर</label>
                          <input type="text" class="form-control form-control-sm" id="ODO_Phone" name="ODO_Phone" placeholder="Enter Phon Number" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Fax / फैक्स</label>
                          <input type="text" class="form-control form-control-sm" name="ODO_Fax" id="ODO_Fax" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="ODO_Mobile" id="ODO_Mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                          </div>
                      </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ईमेल आईडी<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="ODO_Email" id="ODO_Email" placeholder="Enter Email ID"  maxlength="50">
                          </div>
                      </div>
                    </div> -->
                <!--   <div class="row col-md-12">
                      <h4 class="subheading">Owner’s Head Office / मालिक का प्रधान कार्यालय:-</h4>
                    </div>
                    <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                            <input type="checkbox" id="ODO_same_as_OWO" name="ODO_same_as_OWO" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                            <label for="ODO_same_as_OWO">Same as Owner Delhi Office</label>
                          </div>
                        </div> -->
                  <!--     <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Address / पता<font color="red">*</font></label>
                          <textarea name="OHO_Address" id="OHO_Address" placeholder="Enter Address" rows="1" cols="50" class="form-control form-control-sm"  maxlength="120"></textarea>
                        </div>
                      </div>

                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">State / राज्य<font color="red">*</font></label>
                          <select  id="OHO_State" name="OHO_State" class="form-control form-control-sm callstatemulti" data="OHO_District">
                              <option {{$readonly}} value="">Select State</option>
                               @if(count($state) > 0)
                              @foreach($state as $sat)
                              <option {{$readonly}} value="{{$sat['Code']}}">{{$sat['Description']}}</option>
                              @endforeach
                              @endif
                          </select>
                         </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                          <label for="Name">District / ज़िला<font color="red">*</font></label>
                          <select  id="OHO_District" name="OHO_District" class="form-control form-control-sm">
                              <option {{$readonly}} value="">Select District</option>
                          </select>
                         </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Name">City / नगर<font color="red">*</font></label>
                           <input type="text" class="form-control form-control-sm" name="OHO_City" id="OHO_City" placeholder="Enter City" onkeypress="return onlyAlphabets(event,this)" maxlength="40">
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Phone No / फोन नंबर</label>
                          <input type="text" class="form-control form-control-sm" id="OHO_Phone" name="OHO_Phone" placeholder="Enter Phon Number" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                          <label for="Name">Fax / फैक्स</label>
                          <input type="text" class="form-control form-control-sm" name="OHO_Fax" id="OHO_Fax" placeholder="Enter Fax" onkeypress="return onlyNumberKey(event)" maxlength="15">
                        </div>
                       </div>
                       <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Mobile No / मोबाइल नंबर<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="OHO_Mobile" id="OHO_Mobile" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                          </div>
                      </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Name">Email ID / ईमेल आईडी<font color="red">*</font></label>
                            <input type="text" class="form-control form-control-sm" name="OHO_Email" id="OHO_Email" placeholder="Enter Email ID" maxlength="50">
                          </div>
                      </div>
                    </div> -->
                      <a class="btn btn-primary reg-previous-button" id="reg-previous-button">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      <!-- <button class="btn btn-primary" onclick="stepper.next()">Next</button> -->
                      <input type="hidden" name="getID" id="getID" {{$readonly}} value="0">
                      <a class="btn btn-primary regional-national" id="tab_2">Next
                        <i class="fa fa-arrow-circle-right fa-lg"></i>
                      </a>
                    </div>
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="logins-part-trigger">
                     <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_account_no">Bank Account Number for Receiving Payment / भुगतान प्राप्त करने के लिए बैंक खाता संख्या<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_account_no" maxlength="20" id="bank_account_no" placeholder="Enter Bank Account Number" onkeypress="return onlyNumberKey(event)" {{$readonly}} value="{{@$Chanal_Details->{'Account No_'} ?? ''}}">
                  <span id="alert_bank_account_no" style="color:#ff0000;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group divmargin">
                  <label for="account_holder_name">Account Holder Name / खाता धारक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="account_holder_name" maxlength="70" id="account_holder_name" placeholder="Enter Account Holder Name" onkeypress="return onlyAlphabets(event,this)"
                  {{$readonly}} value="{{@$Chanal_Details->{'A_C Holder Name'} ?? ''}}">
                  <span id="alert_account_holder_name" style="color:rgb(243, 12, 12);display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group divmargin">
                  <label for="ifsc_code">IFSC Code / आईएफएससी कोड<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm inputUC" name="ifsc_code"
                  id="ifsc_code" maxlength="15" placeholder="Enter IFSC Code"  onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Chanal_Details->{'IFSC Code'} ?? ''}}">
                  <span id="IFSC_code_Error" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bank_name">Bank Name / बैंक का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="bank_name" id="bank_name" maxlength="50" placeholder="Enter Bank Name"
                  {{$readonly}} value="{{@$Chanal_Details->{'Bank Name'} ?? ''}}">
                  <span id="alert_bank_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="branch_name">Branch / शाखा<font color="red">*</font></label>
                  <input type="text" class="form-control  form-control-sm" name="branch_name" id="branch_name" maxlength="40" placeholder="Enter Branch Name"
                  {{$readonly}} value="{{@$Chanal_Details->{'Bank Branch'} ?? ''}}">
                  <span id="alert_branch_name" style="color:red;display: none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="address_of_account">Address of Account / खाते का पता<font color="red">*</font></label>
                  <textarea class="form-control  form-control-sm" placeholder="Enter Address of Account" maxlength="220" name="address_of_account" id="address_of_account"{{$readonly}}>{{@$Chanal_Details->{'Bank A_C Address'} ?? ''}}
                  </textarea>
                  <span id="alert_address_of_account" style="color:red;display: none;"></span>

                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="pan_card">PAN Card No. / पैन कार्ड नंबर<font color="red">*</font></label>
                  <input type="text" name="pan_card" id="pan_card" class="form-control  form-control-sm inputUC" maxlength="10" placeholder="Enter PAN Card No." onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{@$Chanal_Details->PAN ?? ''}}">
                  <span id="PAN_No_Error" style="color:red;display: none;"></span>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="Name">GST No. / जीएसटी संख्या</label>
                    <input type="text" name="GST_No" id="GST_No" class="form-control form-control-sm inputUC" placeholder="Enter GST No." maxlength="15" onkeypress="return isAlphaNumeric(event)" {{$readonly}} value="{{ @$Chanal_Details->{'GST No_'} ?? Session::get('Gst') }}">
                     <span id="GST_No_Error"></span>
                  </div>
                </div>
              <fieldset class="fieldset-border">
                <legend>ESI Account Details / ईएसआई खाता विवरण</legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_account_no">Account No. / खाता नंबर</label>
                      <input type="text" name="ESI_account_no" id="ESI_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)"
                      {{$readonly}} value="{{@$Chanal_Details->{'ESI A_C No_'} ?? ''}}">
                      <span id="alert_address_of_account" style="color:red;display: none;"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ESI_no_employees">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="ESI_no_employees" id="ESI_no_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)"
                      {{$readonly}} value="@if(@$Chanal_Details->{'ESI - No_ Of Employee'} > 0){{@$Chanal_Details->{'ESI - No_ Of Employee'} ?? ''}}@endif">
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
                      <input type="text" name="EPF_account_no" id="EPF_account_no" maxlength="20" class="form-control  form-control-sm" placeholder="Enter Account No." onkeypress="return onlyNumberKey(event)"
                      {{$readonly}} value="{{@$Chanal_Details->{'EPF A_C No_'} ?? ''}}">
                    </div>
                    <span id="alert_EPF_account_no" style="color:red;display: none;"></span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Name">No. of Employees Covered / कवर किए गए कर्मचारियों की संख्या</label>
                      <input type="text" name="EPF_no_of_employees" id="EPF_no_of_employees" maxlength="6" class="form-control  form-control-sm" placeholder="Enter No. of Employees Covered" onkeypress="return onlyNumberKey(event)"
                      {{$readonly}} value="@if(@$Chanal_Details->{'EPF - No_ Of Employee'} > 0){{@$Chanal_Details->{'EPF - No_ Of Employee'} ?? ''}}@endif">
                      <span id="alert_EPF_no_of_employees" style="color:red;display: none;"></span>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
                      <a class="btn btn-primary reg-previous-button" id="prev_3">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      <!-- <button class="btn btn-primary" onclick="stepper.next()">Next</button> -->
                      <a class="btn btn-primary regional-national" id="tab_3">Next
                        <i class="fa fa-arrow-circle-right fa-lg"></i>
                      </a>
                    </div>
                   <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="information-part-trigger">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Uplinking & Downlinking certificate of the channel (Only PDF) Max Size 2MB / चैनल का अपलिंकिंग और डाउनलिंकिंग प्रमाणपत्र (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                              <div class="input-group">
                                  @if(@$Chanal_Details->{'Linking Certificate File Name'} != '')
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="Uplinking_Down_linking_modify" id="Uplinking_Down_linking_modify"  accept="application/pdf">
                                    <label class="custom-file-label" for="Uplinking_Down_linking_modify" id="Uplinking_Down_linking_modify2">{{ @$Chanal_Details->{'Linking Certificate File Name'} ? @$Chanal_Details->{'Linking Certificate File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="Uplinking_Down_linking_modify3">Upload</span>
                                  </div>
                                  @else
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input {{$click}}" name="Uplinking_Down_linking" id="Uplinking_Down_linking" {{$readonly}}>
                                        <label class="custom-file-label" id="Uplinking_Down_linking2" for="Uplinking_Down_linking">{{ @$Chanal_Details->{'Linking Certificate File Name'} != '' ? $Chanal_Details->{'Linking Certificate File Name'} : 'Choose file' }}</label>
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="Uplinking_Down_linking3">Upload</span>
                                    </div>
                                  @endif
                                    @if(@$Chanal_Details->{'Linking Certificate File Name'} !='')
                                    <div class="input-group-append">
                                        <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'Linking Certificate File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                        <input type="hidden" name="Uplinking_Down_linking_File_Name" id="Uplinking_Down_linking_File_Name" value="{{ @$Chanal_Details->{'Linking Certificate File Name'} }}">
                                    </div>
                                @endif
                              </div>
                              <span id="Uplinking_Down_linking1" class="error invalid-feedback"></span>
                              <span id="Uplinking_Down_linking_modify1" class="error invalid-feedback"></span>
                            </div>
                        </div>

                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="EMMC_certificate1">EMMC certificate telecasting over the last 6 months (Only PDF) Max Size 2MB / पिछले 6 महीनों में प्रसारित ईएमएमसी प्रमाणपत्र (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'EMMC File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="EMMC_certificate_modify" id="EMMC_certificate_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="EMMC_certificate_modify" id="EMMC_certificate_modify2">{{ @$Chanal_Details->{'EMMC File Name'} ? @$Chanal_Details->{'EMMC File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="EMMC_certificate_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="EMMC_certificate" id="EMMC_certificate" {{$readonly}}>
                                    <label class="custom-file-label" id="EMMC_certificate2" for="EMMC_certificate">{{ @$Chanal_Details->{'EMMC File Name'} != '' ? $Chanal_Details->{'EMMC File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="EMMC_certificate3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'EMMC File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'EMMC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="EMMC_certificate_File_Name" id="EMMC_certificate_File_Name" value="{{ @$Chanal_Details->{'EMMC File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="EMMC_certificate1" class="error invalid-feedback"></span>
                          <span id="EMMC_certificate_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>


                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="Fixed_Point_Chart1">Fixed point chart (FPC) for the previous 6 months from 6AM to 11PM,  during which the channel operated (Only PDF) Max Size 2MB/पिछले 6 महीनों के लिए सुबह 6 बजे से रात 11 बजे तक फिक्स्ड पॉइंट चार्ट (एफपीसी), जिसके दौरान चैनल संचालित होता है (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'FP Chart File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="Fixed_Point_Chart_modify" id="Fixed_Point_Chart_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="Fixed_Point_Chart_modify" id="Fixed_Point_Chart_modify2">{{ @$Chanal_Details->{'FP Chart File Name'} ? @$Chanal_Details->{'FP Chart File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="Fixed_Point_Chart_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="Fixed_Point_Chart" id="Fixed_Point_Chart" {{$readonly}}>
                                    <label class="custom-file-label" id="Fixed_Point_Chart2" for="Fixed_Point_Chart">{{ @$Chanal_Details->{'FP Chart File Name'} != '' ? $Chanal_Details->{'FP Chart File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="Fixed_Point_Chart3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'FP Chart File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'FP Chart File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="FP_Chart_File_Name" id="FP_Chart_File_Name" value="{{ @$Chanal_Details->{'FP Chart File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="Fixed_Point_Chart1" class="error invalid-feedback"></span>
                          <span id="Fixed_Point_Chart_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ancelled_cheque1">Scan Copy of Cancelled Cheque (Only PDF) Max Size 2MB/ रद्द किए गए चेक की स्कैन कॉपी (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'Cancelled Cheque File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="ancelled_cheque_modify" id="ancelled_cheque_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="ancelled_cheque_modify" id="ancelled_cheque_modify2">{{ @$Chanal_Details->{'Cancelled Cheque File Name'} ? @$Chanal_Details->{'Cancelled Cheque File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="ancelled_cheque_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="ancelled_cheque" id="ancelled_cheque" {{$readonly}}>
                                    <label class="custom-file-label" id="ancelled_cheque2" for="ancelled_cheque">{{ @$Chanal_Details->{'Cancelled Cheque File Name'} != '' ? $Chanal_Details->{'Cancelled Cheque File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="ancelled_cheque3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'Cancelled Cheque File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'Cancelled Cheque File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="ancelled_cheque_File_Name" id="ancelled_cheque_File_Name" value="{{ @$Chanal_Details->{'Cancelled Cheque File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="ancelled_cheque1" class="error invalid-feedback"></span>
                          <span id="ancelled_cheque_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>


                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="Teleport_operator_certificate1">Teleport operator certificate (Only PDF) Max Size 2MB/ टेलीपोर्ट ऑपरेटर प्रमाणपत्र (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'TOC File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="Teleport_operator_certificate_modify" id="Teleport_operator_certificate_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="Teleport_operator_certificate_modify" id="Teleport_operator_certificate_modify2">{{ @$Chanal_Details->{'TOC File Name'} ? @$Chanal_Details->{'TOC File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="Teleport_operator_certificate_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="Teleport_operator_certificate" id="Teleport_operator_certificate" {{$readonly}}>
                                    <label class="custom-file-label" id="Teleport_operator_certificate2" for="Teleport_operator_certificate">{{ @$Chanal_Details->{'TOC File Name'} != '' ? $Chanal_Details->{'TOC File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="Teleport_operator_certificate3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'TOC File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'TOC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="Teleport_operator_certificate_File_Name" id="Teleport_operator_certificate_File_Name" value="{{ @$Chanal_Details->{'TOC File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="Teleport_operator_certificate1" class="error invalid-feedback"></span>
                          <span id="Teleport_operator_certificate_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="Last_year_certificate1">Last year's certificate duly signed by the Auditor /Company  (Only PDF) Max Size 2MB/ पिछले वर्ष का प्रमाणपत्र लेखापरीक्षक/कंपनी द्वारा विधिवत हस्ताक्षरित (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'Auditor File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="Last_year_certificate_modify" id="Last_year_certificate_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="Last_year_certificate_modify" id="Last_year_certificate_modify2">{{ @$Chanal_Details->{'Auditor File Name'} ? @$Chanal_Details->{'Auditor File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="Last_year_certificate_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="Last_year_certificate" id="Last_year_certificate" {{$readonly}}>
                                    <label class="custom-file-label" id="Last_year_certificate2" for="Last_year_certificate">{{ @$Chanal_Details->{'Auditor File Name'} != '' ? $Chanal_Details->{'Auditor File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="Last_year_certificate3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'Auditor File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'Auditor File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="Last_year_certificate_File_Name" id="Last_year_certificate_File_Name" value="{{ @$Chanal_Details->{'Auditor File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="Last_year_certificate1" class="error invalid-feedback"></span>
                          <span id="Last_year_certificate_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="letter_attested1">A letter attested by senior management level executive,giving name, designation &  signatures  (Only PDF) Max Size 2MB/ वरिष्ठ प्रबंधन स्तर के कार्यकारी द्वारा सत्यापित पत्र, नाम, पदनाम और हस्ताक्षर (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'SMA File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="letter_attested_modify" id="letter_attested_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="letter_attested_modify" id="letter_attested_modify2">{{ @$Chanal_Details->{'SMA File Name'} ? @$Chanal_Details->{'SMA File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="letter_attested_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="letter_attested" id="letter_attested" {{$readonly}}>
                                    <label class="custom-file-label" id="letter_attested2" for="letter_attested">{{ @$Chanal_Details->{'SMA File Name'} != '' ? $Chanal_Details->{'SMA File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="letter_attested3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'SMA File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'SMA File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="letter_attested_File_Name" id="letter_attested_File_Name" value="{{ @$Chanal_Details->{'SMA File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="letter_attested1" class="error invalid-feedback"></span>
                          <span id="letter_attested_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                           <label for="Government_India1">A letter indicating whether or not the channel would be able to provide a third party certification of the advertisement telecast for DAVP/ Government of india  (Only PDF) Max Size 2MB / एक पत्र यह दर्शाता है कि चैनल डीएवीपी/भारत सरकार (केवल पीडीएफ) के लिए प्रसारित विज्ञापन का तीसरा पक्ष प्रमाणन प्रदान करने में सक्षम होगा या नहीं (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'TPC File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="Government_India_modify" id="Government_India_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="Government_India_modify" id="Government_India_modify2">{{ @$Chanal_Details->{'TPC File Name'} ? @$Chanal_Details->{'TPC File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="Government_India_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="Government_India" id="Government_India" {{$readonly}}>
                                    <label class="custom-file-label" id="Government_India2" for="Government_India">{{ @$Chanal_Details->{'TPC File Name'} != '' ? $Chanal_Details->{'TPC File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="Government_India3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'TPC File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'TPC File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="Government_India_File_Name" id="Government_India_File_Name" value="{{ @$Chanal_Details->{'TPC File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="Government_India1" class="error invalid-feedback"></span>
                          <span id="Government_India_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="applicant_channel_belongs1">A signed list of the different C&S. TV channel in the Group/Holding Company/ Company to which the applicant channel belongs to (Only PDF) Max Size 2MB/ विभिन्न सी एंड एस की एक हस्ताक्षरित सूची। ग्रुप/होल्डिंग कंपनी/कंपनी में टीवी चैनल जिससे आवेदक चैनल संबंधित है (केवल पीडीएफ) अधिकतम आकार 2 एमबी<font color="red">*</font></label>
                          <div class="input-group">
                              @if(@$Chanal_Details->{'DC&SL File Name'} != '')
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="applicant_channel_belongs_modify" id="applicant_channel_belongs_modify"  accept="application/pdf">
                                <label class="custom-file-label" for="applicant_channel_belongs_modify" id="applicant_channel_belongs_modify2">{{ @$Chanal_Details->{'DC&SL File Name'} ? @$Chanal_Details->{'DC&SL File Name'} : 'Choose file' }}</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="applicant_channel_belongs_modify3">Upload</span>
                              </div>
                              @else
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input {{$click}}" name="applicant_channel_belongs" id="applicant_channel_belongs" {{$readonly}}>
                                    <label class="custom-file-label" id="applicant_channel_belongs2" for="applicant_channel_belongs">{{ @$Chanal_Details->{'DC&SL File Name'} != '' ? $Chanal_Details->{'DC&SL File Name'} : 'Choose file' }}</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="applicant_channel_belongs3">Upload</span>
                                </div>
                              @endif
                                @if(@$Chanal_Details->{'DC&SL File Name'} !='')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/AV-TV-Reginal-National/{{ @$Chanal_Details->{'DC&SL File Name'} ?? '' }}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                    <input type="hidden" name="applicant_channel_belongs_File_Name" id="applicant_channel_belongs_File_Name" value="{{ @$Chanal_Details->{'DC&SL File Name'} }}">
                                </div>
                            @endif
                          </div>
                          <span id="applicant_channel_belongs1" class="error invalid-feedback"></span>
                          <span id="applicant_channel_belongs_modify1" class="error invalid-feedback"></span>
                        </div>
                    </div>


                     <div class="col-md-12">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              @if(@$Chanal_Details->{'Self-declaration'} == 1)
                            <input type="checkbox" id="affirm" name="affirm" class="get_channel_office_data {{$click}}" data="OHO"  {{$readonly}} value="1" checked="checked">
                            @else
                            <input type="checkbox" id="affirm" name="affirm" class="get_channel_office_data" data="OHO"  {{$readonly}} value="1">
                            @endif
                            <label for="affirm">I Confirm that all the information given by me is true and nothing has been concealed /मैं पुष्टि करता हूं कि मेरे द्वारा दी गई सभी जानकारी सत्य है और कुछ भी छुपाया नहीं गया है।<font color="red">*</font></label>
                          </div>
                        </div>
                     </div>
                     </div>
                     <input type="hidden" name="doc[]" id="doc_data">
                     <input type="hidden" name="submit_doc" id="submit_doc">
                     <input type="hidden" name="modification_form" id="modification_form" value="{{ @$Chanal_Details->{'Modification' } }}">
                      <a class="btn btn-primary reg-previous-button" id="prev_4">
                      <i class="fa fa-arrow-circle-left fa-lg"></i>
                      Previous</a>
                      @if(@$Chanal_Details->{'Modification'} == 1)
                      <!-- <a class="btn btn-primary callfinal" id="tab_4"
                      style="pointer-events:none;">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a> -->
                      @else
                      <a class="btn btn-primary regional-national" id="tab_4">Submit <i class="fa fa-arrow-circle-right fa-lg"></i></a>
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
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ url('/js') }}/empanelment-regional-national.js"></script>
<script src="{{ url('/js') }}/avtv_comman.js"></script>
<script type="text/javascript">
  //onchange distsict load


    $(document).on('change', '.callstatemulti', function() {
    if ($(this).val() != '') {
      var id = $(this).attr("data");
       //alert($(this).attr("data"));
      $("#" + id).empty();
      $.ajax({
        type: 'get',
        url: "{{Route('getDistrict-national')}}",
        data: { state_id: $(this).val() },
        success: function(data) {
          //console.log(data);
          $("#" + id).html(data);
        }
      });
    }
  });


  $(document).on('change', '.callstatemulti', function() {
    if ($(this).val() != '') {
        //alert($(this).val());
      var id = $(this).attr("city-data");
       //alert($(this).attr("data"));
      $("#" + id).empty();
      $.ajax({
        type: 'get',
        url: "{{Route('avtv-get-city')}}",
        data: { state_id: $(this).val() },
        success: function(data) {
          //console.log(data);
          $("#" + id).html(data);
        }
      });
    }
  });


$(document).ready(function() {

    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });

});

/* Language api data */
$(document).ready(function(){
  $('#Regional_Language').multiselect({
      nonSelectedText: 'Select Group of language',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      textleft:true,
      includeSelectAllOption:true,
    });
});
function getLanguage(lang)
{
    var new_lang = new Array();
    var new_langs = lang.split(',');
    $.each( new_langs, function( key, val ) {
        new_lang.push(val.trim());
    });
     console.log(new_lang);
    var host = location.hostname;

    if((host == '127.0.0.1') || (host == '192.168.10.74'))
    {
        var url ="http://192.168.10.60:7048/BC180/ODataV4/Company('BOC')/Language";
    }
    else{
        var url = "http://20.219.125.221:7048/BC180/ODataV4/Company('BOC')/Language";
    }
    var userName = 'RATAN';
    var password = 'omiUOOOpuzuV/0MjAtVCgCb51NEADiB7WQw/ocWlgWE=';
    $.ajax({
        url:url,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", "Basic " + btoa(userName + ":" + password));
        },
        success: function(data) {
            console.log(data.value);
            var arrtext = new Array();
            // var $select = $('#Regional_Language');
                var option = '<option value="">Select Language</option>';
            $.each( data.value, function( key, val ) {
                if(val.BOC_used_Indian_Language==true){
                    if(new_lang.includes(val.Name) == true) {
                        // console.log(val.Name);
                        option += '<li><a tabindex="'+key+'"><label class="checkbox" ><input type="checkbox" value="" checked> ' + val.Name + '</label></a></li>'
                    }
                    else{
                        option += '<li><a tabindex="'+key+'"><label class="checkbox"><input type="checkbox" value=""> ' + val.Name + '</label></a></li>'
                    }
                }
                });
                $('.multiselect-container').html(option);
                //console.log(arrtext)
        }
    });
}

function getChannelDetails()
{
    var chName=$('#place_of_publication').val();
    console.log(chName);
    var dateofper = $('#id').val();
    var url ="{{route('channeNameget', ":chName")}}";
    url = url.replace(":chName", chName);
    // console.log(chName);
    $.ajax({
        url:url,
        type: 'get',
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data.data);
            var d =  new Date(data.data.validityOfPermission);
            var datestring = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) +"-"+("0" + d.getDate()).slice(-2)
            var strDate = new Date(data.data.dateOfPermission);
            var streamDate = strDate.getFullYear() + "-" + ("0"+(strDate.getMonth()+1)).slice(-2) +"-"+("0" + strDate.getDate()).slice(-2);
            var lang = data.data.language;
            var genre = data.data.genreOfChannel;

            if(genre == "NEWS and Current Affairs")
            {
                $('#news_current').attr('selected','selected');
                $('#gec').attr('selected',null);
            }
            else if(genre == "NON- News and Current Affairs")
            {
                $('#gec').attr('selected','selected');
                $('#news_current').attr('selected',null);
            }
            else
            {
                $('#news_current').attr('selected',null);
                $('#gec').attr('selected',null);
            }
            $('#Uplinking_valid_upto').val(datestring);
            $('#Down_linking_valid_upto').val(datestring);
            $('#Streaming_Start_Date').val(streamDate);
            $('#Head_of_Company').val(data.data.officials);
            $('#Regional_Language').val(data.data.lang);
            var lang = data.data.language;
            getLanguage(lang);

        }
    });
}

</script>
@endsection
