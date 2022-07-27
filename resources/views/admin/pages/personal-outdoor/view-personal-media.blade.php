@extends('admin.layouts.layout')
<style>
    body {
        color: #6c757d !important;
    }
</style>
<style>
    a.disabled {
        pointer-events: none;
        color: #ccc;
    }

    .hide-msg {
        display: none !important;
    }

    .fa-check {
        color: green;
    }

    .error {
        color: red;
        font-size: 14px;
    }
</style>
@section('content')

                @php 
                  $owner_data=$owner_data ?? [1];
                  $OD_work_dones=$OD_work_dones_data ?? [1];
                  $OD_media_address_data=$OD_media_address_data ?? [1];
                  $vendor_data =$vendor_data ?? '';
                 // $ODMFO_Billing_Amount= ODMFO_Billing_Amount ?? [1];
                  $readonly = ' ';
                  $disabled = ' ';
                  $checked = ' ';
                  $Self_Dec='';
                  $media_id =@$vendor_data[0]['OD Media ID'];
                  if(@$vendor_data[0]['OD Media ID'] != ''){
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
                  @if(Session::has('success'))
                      <div class="alert alert-success">
                          {{ Session::get('success') }}
                      </div>
                  @endif
            <!-- /.end card-header -->
                <form action="" method="POST" id="personal_media">
                  @csrf
                    <!-- your steps here -->
                    <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab1">Basic Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab2">Outdoor Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab3">Account Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab4">Upload Document</a>
                    </li>
                </ul>
                <div class="tab-content">
                <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger"> 
                @foreach($owner_data as $ownerlist)                                
                      <div class="row" id="details_of_owner">
                      <div class="col-md-4">
                          <div class="form-group">
                          <label for="owner_name">Publication Name / प्रकाशन का नाम</label>
                            <p>
                              <input {{$disabled}} type="text" name="owner_name[]" id="owner_name" placeholder="Enter Publication Name" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event,this);" maxlength="40" value="{{$ownerlist['Owner Name']?? ''}}" {{$disabled}}  >
                            </p>
                          </div>
                      </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="email">E-mail ID(Owner) / ई मेल आईडी<font color="red">*</font></label>
                          <p>
                            <input {{$disabled}} type="email" class="form-control form-control-sm" id="email" name="email1[]" maxlength="50" placeholder="Enter Email ID" value="{{$ownerlist['Email ID']?? ''}}" onkeyup="return checkUniqueOwner('email', this.value)" {{$disabled}}>
                          <span id="alert_email" style="color:red;display: none;"></span>
                          </p>
                        </div>
                      </div>
                    
                      <div class="col-md-4">
                          <div class="form-group">
                          <label for="mobile">Mobile / मोबाइल<font color="red">*</font></label>
                          <p>
                              <input {{$disabled}} type="text" name="mobile1[]" id="mobile" maxlength="10" placeholder="Enter Mobile" class="form-control input-imperial form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$ownerlist['Mobile No_']?? ''}}" onkeyup="return checkUniqueOwner('mobile', this.value)" {{$disabled}}>
                              <span id="alert_mobile" style="color:red;display: none;"></span>
                          </p>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="address">Address / पता<font color="red">*</font></label>
                          <p>
                          <textarea {{$disabled}} type="text" name="addressS[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" {{$disabled}}>{{$ownerlist['Address 1']?? ''}}</textarea>
                        </p>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="fax">Fax / फैक्स</label>
                        <input {{$disabled}} type="text" name="fax_no[]" id="fax" onkeypress="return onlyNumberKey(event)" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14" value="{{$ownerlist['Fax No_']?? ''}}" {{$disabled}}>
                      </div>
                    </div>
                    </div>
                    @endforeach
                    <div class="row" id="add_row_davp" style="float:right;margin-top:
                    6px;">
                    <input {{$disabled}} type="hidden" name="increse_i" id="increse_i" value="0">
                      <a  class="btn btn-primary {{$disabled}}" id="add_row">Add</a>
                    </div>
                    <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    <input {{$disabled}} type="hidden" name="ownerid[]" id="ownerid" value="">
                    <input {{$disabled}} type="hidden" name="next_tab_1" id="next_tab_1" value="0">
                    <a class="btn btn-primary set-pm-next-button" id="tab_1">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    <!-- <input {{$disabled}} type="submit" name="submit" value="submit"> -->
                  
                  </div>
                  <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                    <div class="row col-md-12">
                      <h5>Head Office :-</h5></div><br>
                    <div class="row">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="address">Address / पता<font color="red">*</font></label>
                           <textarea {{$disabled}} type="text" name="HO_Address" id="HO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="120">{{$vendor_data[0]['HO Address']?? ''}}</textarea>
                           <span id="alert_address1" style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="landline_no">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                        <input {{$disabled}} type="text" name="HO_Landline_No" id="landline_no" placeholder="Enter Landline No." class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Landline No_']?? ''}}">
                        <span id="alert_landline_no" style="color: red;"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="fax_1">Fax No. / फ़ैक्स  नंबर<font color="red">*</font></label>
                      <input {{$disabled}} type="text" name="HO_Fax_No" placeholder="Enter Fax No" class="form-control form-control-sm" id="fax_no" onkeypress="return onlyNumberKey(event)" maxlength="14" value="{{$vendor_data[0]['HO Fax No_']?? ''}}">
                        <span id="alert_fax_1" style="color: red;"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="email">E-mail. / ईमेल<font color="red">*</font></label>
                      <input {{$disabled}} type="text" name="HO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="HO_Email" value="{{$vendor_data[0]['HO E-Mail']?? ''}}" maxlength="50" onkeyup="return checkUniqueVendor('email', this.value)">
                        <span id="alert_email_1" style="color: red;"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="mobile_1">Mobile / मोबाइल<font color="red">*</font></label>
                      <input {{$disabled}} type="text" class="form-control form-control-sm" id="HO_Mobile_No" name="HO_Mobile_No" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['HO Mobile No_']?? ''}}" onkeyup="return checkUniqueVendor('mobile', this.value)">
                         <span id="alert_mobile_1" style="color: red;"></span>
                      </div>
                      </div>
                      </div><br>
                      <div class="row col-md-12"><h5>Branch Office (if any) :-</h5></div><br>
                      <div class="row">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="address2">Address / पता<font color="red">*</font></label>
                        <textarea {{$disabled}} type="text" name="BO_Address" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm">{{$vendor_data[0]['BO Address']?? ''}}</textarea>
                           <!-- <span id="alert_address2" style="color: red;"></span> -->
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="landline_no_1">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                        <input {{$disabled}} type="text" name="BO_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$vendor_data[0]['BO Landline No_']?? ''}}">
                        <!-- <span id="alert_landline_no1" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="fax_no_1">Fax No. / फ़ैक्स  नंबर<font color="red">*</font></label>
                      <input {{$disabled}} type="text" name="BO_Fax_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="fax_no" maxlength="14" onkeypress="return onlyNumberKey(event)" value="{{$vendor_data[0]['BO Fax No_']?? ''}}">
                        <!-- <span id="alert_fax_no2" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="email2">E-mail. / ईमेल<font color="red">*</font></label>
                      <input {{$disabled}} type="text" name="BO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" value="{{$vendor_data[0]['BO E-Mail']?? ''}}">
                        <!-- <span id="alert_email2" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="mobile2">Mobile / मोबाइल<font color="red">*</font></label>
                      <input {{$disabled}} type="text" name="BO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{$vendor_data[0]['BO Mobile No_']?? ''}}">
                         <!-- <span id="alert_mobile2" style="color: red;"></span> -->
                      </div>
                      </div>
                    </div>      
                    <div class="row col-md-12"><h5>Delhi Office (if any) :-</h5></div><br>
                      <div class="row">
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="DO_Address">Address / पता<font color="red">*</font></label>
                           <textarea {{$disabled}} type="text" name="DO_Address" id="DO_Address" placeholder="Enter Address" rows="1" class="form-control form-control-sm" maxlength="100">{{$vendor_data[0]['DO Address']?? ''}}</textarea>
                           <!-- <span id="alert_address3" style="color: red;"></span> -->
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="DO_Landline">Landline No. / लैंडलाइन नंबर<font color="red">*</font></label>
                        <input {{$disabled}} type="text" name="DO_Landline_No" placeholder="Enter Landline No." class="form-control form-control-sm" id="DO_Landline_No" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['DO Landline No_'] ?? ''}}">
                        <!-- <span id="alert_landline_no2" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="DO_Fax_No">Fax No. / फ़ैक्स  नंबर<font color="red">*</font></label>
                        <input {{$disabled}} type="text" name="DO_Fax_No" placeholder="Enter Fax No." class="form-control form-control-sm" id="DO_Fax_No" onkeypress="return onlyNumberKey(event)" maxlength="`5" value="{{$vendor_data[0]['DO Fax No_']?? ''}}">
                        <!-- <span id="alert_fax_no3" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                        <label for="DO_Email">E-mail. / ईमेल<font color="red">*</font></label>
                        <input {{$disabled}} type="text" name="DO_Email" placeholder="Enter E-mail" class="form-control form-control-sm" id="DO_Email" value="{{$vendor_data[0]['DO E-Mail']?? ''}}">
                        <!-- <span id="alert_email3" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="DO_Mobile">Mobile / मोबाइल<font color="red">*</font></label>
                         <input {{$disabled}} type="text" name="DO_Mobile" placeholder="Enter Mobile" class="form-control form-control-sm" id="DO_Mobile" onkeypress="return onlyNumberKey(event)" maxlength="15" value="{{$vendor_data[0]['DO Mobile No_']?? ''}}">
                         <!-- <span id="alert_mobile3" style="color: red;"></span> -->
                      </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label>Legal Status Of Company / कंपनी की कानूनी स्थिति<font color="red">*</font></label>
                            <select {{$disabled}} name="Legal_Status_of_Company" id="Legal_Status_of_Company" class="form-control form-control-sm" style="width: 100%;" >
                              <option value="" {{@$vendor_data[0]['Legal Status of Company'] == "" ? 'selected' : ''}} >Select Proprietorship</option>
                                <option value="1" {{@$vendor_data[0]['Legal Status of Company'] == "1"  && @$vendor_data[0]['Legal Status of Company'] != ""  ? 'selected' : '' }}>Proprietorship0</option>
                                <option value="2" {{@$vendor_data[0]['Legal Status of Company'] == "2" && @$vendor_data[0]['Legal Status of Company'] != ""  ? 'selected' : '' }}>Proprietorship1</option>
                                <option value="3" {{@$vendor_data[0]['Legal Status of Company'] == "3"  && @$vendor_data[0]['Legal Status of Company'] != ""  ? 'selected' : '' }}>Proprietorship2</option>
                            </select>
                            <span id="alert_DO_legal_status_company" style="color: red;"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label for="relevant_information">Any Other Relevant Information / कोई अन्य प्रासंगिक जानकारी<font color="red">*</font></label>
                           <input {{$disabled}} type="text" name="Other_Relevant_Information" placeholder="Enter Any Other Relevant Information" class="form-control form-control-sm" id="Other_Relevant_Information" value="{{$vendor_data[0]['Other Relevant Information']?? ''}}">
                           <span id="alert_relevant_information" style="color: red;"></span>
                        </div>
                      </div>
                    </div>   
                    <br>
                    <div class="row col-md-12">
                      <h5>Authority Details :-</h5></div><br>
                      <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="Authority_Which_granted_Media">Authority Which Granted Media With Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया</label>
                          <input type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="Authority_Which_granted_Media" value="{{$vendor_data[0]['Authority Which granted Media']?? ''}}" {{$disabled}}>
                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="form-group">
                      <label for="Amount_paid_to_Authority">Amount Paid to Authority For The Current Year / चालू वर्ष के लिए प्राधिकरण को भुगतान की गई राशि</label>
                        <input type="text" name="Amount_paid_to_Authority" placeholder="Enter Amount Paid to Authority For The Current Year" class="form-control form-control-sm" id="fax_no4" onkeypress="return onlyNumberKey(event)" value="{{$vendor_data[0]['Amount paid to Authority']?? ''}}" {{$disabled}}>
                        <span id="alert_Amount_paid_to_Authority" style="color: red;"></span>
                      </div>
                      </div>
                      <div class="col-md-4">
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
                      <div class="col-md-4">
                        <div class="form-group">
                        <label>Select Type / प्रकार चुनें</label>
                            <select {{$disabled}} name="Media_Type" class="form-control form-control-sm" style="width: 100%;" id="select_type">
                                <option value="" {{@$vendor_data[0]['Media Type'] == "" ? 'selected' : ''}}>Select Type</option>
                                <option value="1" {{@$vendor_data[0]['Media Type'] == "1"  && @$vendor_data[0]['Media Type'] != "" ? 'selected' : '' }}>Testing1</option>
                                <option value="2" {{@$vendor_data[0]['Media Type'] == "2" &&  @$vendor_data[0]['Media Type'] != "" ? 'selected' : '' }}>Testing2</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                        <label>Rental Type / किराये का प्रकार</label>
                            <select {{$disabled}} name="rental_type" class="form-control form-control-sm" style="width: 100%;" id="rental_type">
                                <option value="" {{@$vendor_data[0]['Rental Agreement'] == "" ? 'selected' : ''}}>Select Annum</option>
                                <option value="1" {{@$vendor_data[0]['Rental Agreement'] == "1" &&  @$vendor_data[0]['Rental Agreement'] != "0" ? 'selected' : ''}}>Per Annum1</option>
                                <option value="2" {{@$vendor_data[0]['Rental Agreement'] == "2" &&  @$vendor_data[0]['Rental Agreement'] != "0" ? 'selected' : ''}}>Per Annum2</option>
                                <option value="3" {{@$vendor_data[0]['Rental Agreement'] == "3" &&  @$vendor_data[0]['Rental Agreement'] != "0" ? 'selected' : ''}}>Per Annum3</option>
                            </select>
                            <!-- <span id="alert_rental_type" style="color: red;"></span> -->
                        </div>
                      </div>
                      </div>
                      <br>
                      <div class="row col-md-12"><h5>Details Of Outdoor Media Formatted Offered :-</h5></div><br>
                      <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Outdoor media format for which applying / बाहरी मीडिया
                                        प्रारूप जिसके लिए आवेदन किया जा रहा है</label>
                                    <select name="Applying_For_OD_Media_Type" class="form-control form-control-sm" style="width: 100%;" {{$disabled}}>
                                        <option value="">Select Per Annum</option>
                                        @if(@$OD_media_address['Applying For OD Media Type']==1)
                                        <option value="1" selected="selected">Per Annum 1</option>
                                        @else
                                        <option value="2" selected="selected">Per Annum 2</option>
                                        @endif
                                        <option value="1">Per Annum 1</option>
                                        <option value="2">Per Annum 2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row col-md-12">
                      <h5>Details of work done in last year, for the applied media only, if any (As per format given below) :-</h5>
                    </div><br>
                    @foreach($OD_work_dones as $work_done_data)
                        <div class="row" id="details_of_work_done">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="year">Year / वर्ष<font color="red">*</font></label>
                                    <select name="ODMFO_Year[]" id="Years0" class="form-control form-control-sm ddlYears" {{$disabled}}>
                                        @if(@$work_done_data['Year'] == '')
                                        <option value="">Select Year</option>
                                        @else
                                        <option value="{{ $work_done_data['Year'] }}">
                                            {{ $work_done_data['Year'] }}
                                        </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity_duration">Quantity of Display or Duration /
                                        प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
                                    <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{$disabled}}>
                                    <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि
                                        (रु)<font color="red">*</font></label>
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
                                    <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="upload_doc1">Upload Document / दस्तावेज़ अपलोड
                                        करें</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="ODMFO_Upload_Document[]" class="custom-file-doc" data="0" onchange="return uploadFile(0,this)" id="upload_doc_0" {{$disabled}} accept="application/pdf">
                                            <label class="custom-file-label" for="upload_doc_0" id="choose_file0">Choose
                                                file</label>
                                            <!-- <span id="alert_upload_doc" style="color: red;"></span> -->
                                            <input type="hidden" name="" value="{{ @$work_done_data['File Name']}}">
                                        </div>

                                        @if(@$work_done_data['File Uploaded'] == '1')
                                        <div class="input-group-append">
                                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $work_done_data['File Name'] }}" target="_blank">View</a></span>
                                        </div>
                                        @else
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="upload_file0">Upload</span>
                                        </div>
                                        @endif
                                    </div>
                                    <span id="upload_doc_error0" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                 <div class="row" style="float:right;margin-top: 6px;">
                    <button {{$disabled}} class="btn btn-primary {{$disabled}}" id="add_row_next">Add</button>                  
                  </div><br><br>    
                  <div class="row col-md-12"><h5>Details of GST :-</h5></div>  
                  <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="GST_No">GST No. / जीएसटी संख्या</label>
                                    <input type="text" class="form-control form-control-sm" name="GST_No" id="GST_No" placeholder="Enter GST No." maxlength="15" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['GST No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tin_tan_vat_no">TIN/TAN/VAT No.(if applicable) /
                                        टिन/टैन/वैट संख्या (यदि लागू हो)</label>
                                    <input type="text" class="form-control form-control-sm" name="TIN_TAN_VAT_No" id="TIN_TAN_VAT_No" placeholder="Enter TIN/TAN/VAT No.(if applicable)" maxlength="15" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['TIN_TAN_VAT No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                  </div>  
                      <input {{$disabled}} type="hidden" name="vendorid_tab_2" id="vendorid_tab_2" value="">
                      <input {{$disabled}} type="hidden" name="next_tab_2" id="next_tab_2" value="0"> 
                      <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                      <a class="btn btn-primary set-pm-next-button" id="tab_2">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                      <!-- <a class="btn btn-primary" onclick="stepper.next()">Next</a> -->
                    </div> 
                    <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                        <br>
                        <div class="row col-md-12">
                        <h5>Fee/DD Details :-</h5>
                        <p>Application fee Rs.1000/- (non refundable) per media format (in the shape of DD in favor of PAO BOC ETC)</p>
                        </div><br>
                        <div class="row">
                        <div class="row col-md-12">
                        <p style="padding-left: 14px;">DD Details :-</p>
                        </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="DD_No">DD No. / डीडी संख्या<font color="red">*
                                        </font></label>
                                    <input type="text" class="form-control form-control-sm" name="DD_No" id="DD_No" placeholder="Enter DD No." onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{ $vendor_data[0]['DD No_'] ?? ''}}" {{$disabled}}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dd_date">DD Date / डीडी तिथि<font color="red">*
                                        </font></label>
                                    <input type="date" class="form-control form-control-sm" name="DD_Date" id="dd_date" placeholder="Enter DD Date" min="{{ date('Y-m-d',strtotime('-3 months')) }}" value="{{ @$vendor_data[0]['DD Date'] ? date('Y-m-d', strtotime(@$vendor_data[0]['DD Date'])) : ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Name" id="bank_name_1" placeholder="Enter Bank Name" maxlength="30" onkeypress=" return onlyAlphabets(event)" value="{{$vendor_data[0]['DD Bank Name'] ?? ''}}" {{ $disabled }}>
                                    <span id="alert_bank_name_1" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch_name">Branch Name/ शाखा का नाम<font color="red">*</font>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" name="DD_Bank_Branch_Name" placeholder="Enter Branch Name" maxlength="30" value="{{$vendor_data[0]['DD Bank Branch Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dd_account">DD Amount / डीडी राशि </label>
                                    <input type="text" name="Application_Amount" id="dd_amount" class="form-control form-control-sm" placeholder="Enter DD Account" onkeypress="return onlyNumberKey(event)" maxlength="10" value="{{@$vendor_data[0]['Application Amount'] ? round(@$vendor_data[0]['Application Amount'],2) : ''}}" {{ $disabled }}>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                        <div class="row col-md-12">
                        <p style="padding-left: 14px;">NTFT Details :-</p>
                        </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="agency_name">Agency Name / एजेंसी का नाम<font color="red">*
                                        </font></label>
                                    <input type="text" name="PM_Agency_Name" class="form-control form-control-sm" placeholder="Enter Agency Name" maxlength="40" value="{{$vendor_data[0]['PM Agency Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_no">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" class="form-control form-control-sm" placeholder="Enter Pan No." maxlength="10" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['PAN'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name_2" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$vendor_data[0]['Bank Name'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch_2" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$vendor_data[0]['Bank Branch'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code_sole" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" onkeypress="return isAlphaNumeric(event)" value="{{$vendor_data[0]['IFSC Code'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">
                                            *</font></label>
                                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{$vendor_data[0]['Account No_'] ?? ''}}" {{ $disabled }}>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="payment_mode3" style="display:none;">
                        
                   
                        </div>
                        <input type="hidden" name="vendorid_tab_3" id="vendorid_tab_3" value="">
                        <input type="hidden" name="next_tab_3" id="next_tab_3" value="0">
                        <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>
                        <a class="btn btn-primary set-pm-next-button" id="tab_3">Next <i class="fa fa-arrow-circle-right fa-lg"></i></a>
                    </div>
                    <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab1-trigger">
                      <div class="form-group">
                        <label for="exampleInputFile">Upload document of legal status of company / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें</label>
                        <div class="input-group">
                          <div class="custom-file">
                             <input {{$disabled}} type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name" {{$disabled}}>
                            <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">Choose file</label>
                          </div>
                           @if(@$vendor_data[0]['Company Legal Documents'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Legal Doc File Name'] }}" target="_blank">View</a>
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
                      <div class="form-group">
                        <label for="exampleInputFile">Upload document of outdoor media format(attach supportive documents viz,Notarized copy of agreement of sole right indicating location, receipt of amount paid, validity etc/ allotment letter where agreement is not executed) / आउटडोर मीडिया प्रारूप का दस्तावेज अपलोड करें (समर्थक दस्तावेज संलग्न करें, जैसे कि एकमात्र अधिकार के समझौते की नोटरीकृत प्रति, स्थान का संकेत, भुगतान की गई राशि की प्राप्ति, वैधता आदि / आवंटन पत्र जहां समझौता निष्पादित नहीं किया गया है)</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input {{$disabled}} type="file" name="Notarized_Copy_File_Name" class="custom-file-input" id="Notarized_Copy_File_Name" {{$disabled}}>
                            <label class="custom-file-label" for="Notarized_Copy_File_Name" id="Notarized_Copy_File_Name2">Choose file</label>
                          </div>
                          @if(@$vendor_data[0]['Notarized Copy Of Agreement'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Notarized Copy File Name'] }}" target="_blank">View</a></span>
                          </div>
                          @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Notarized_Copy_File_Name3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="Notarized_Copy_File_Name1" class="error invalid-feedback"></span>
                      </div>

                       <div class="form-group">
                        <label for="exampleInputFile">Attach copy of Pan Number and authorization of Bank for NEFT payment / एनईएफटी भुगतान के लिए पैन नंबर और बैंक के प्राधिकरण की प्रति संलग्न करें</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input {{$disabled}} type="file" name="Attach_Copy_Of_Pan_Number_File_Name" class="custom-file-input" id="Attach_Copy_Of_Pan_Number_File_Name" {{$disabled}}>
                            <label class="custom-file-label" id="Attach_Copy_Of_Pan_Number_File_Name2" for="Attach_Copy_Of_Pan_Number_File_Name">Choose file</label>
                          </div>
                          @if(@$vendor_data[0]['PAN Attached'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['PAN File Name'] }}" target="_blank">View</a></span>
                          </div>
                          @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Attach_Copy_Of_Pan_Number_File_Name3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="Attach_Copy_Of_Pan_Number_File_Name1" class="error invalid-feedback"></span>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputFile">Submit an affidavit on stamp paper stating on oath that the details submitted by you on performa are true and correct.Mention the application no. in affidavit / स्टाम्प पेपर पर शपथ पत्र पर शपथ पत्र प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे में</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input {{$disabled}} type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name" {{$disabled}}>
                            <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">Choose file</label>
                          </div>
                          @if(@$vendor_data[0]['Affidavit Of Oath'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Affidavit File Name'] }}" target="_blank">View</a></span>
                          </div>
                          @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Photographs of displayed medium (Separate photo for each property) / प्रदर्शित माध्यम की तस्वीरें (प्रत्येक संपत्ति के लिए अलग फोटो)</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input {{$disabled}} type="file" name="Photo_File_Name" class="custom-file-input" data="0" onchange="return uploadFile(0,this)" id="Photo_File_Name" {{$disabled}}>
                            <label class="custom-file-label" id="Photo_File_Name2" for="Photo_File_Name">Choose file</label>
                          </div>
                           @if(@$vendor_data[0]['Photographs'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['Photo File Name'] }}" target="_blank">View</a></span>
                          </div>
                          @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="Photo_File_Name3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="Photo_File_Name1" class="error invalid-feedback"></span>
                      </div>
                
                      <div class="form-group">
                        <label for="exampleInputFile">GST registration Certificate / जीएसटी पंजीकरण प्रमाणपत्र</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input {{$disabled}} type="file" name="GST_File_Name" class="custom-file-input" id="GST_File_Name" {{$disabled}}>
                            <label class="custom-file-label" id="GST_File_Name2" for="GST_File_Name">Choose file</label>
                          </div>
                          @if(@$vendor_data[0]['GST Registration'] == '1')
                          <div class="input-group-append">
                            <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ $vendor_data[0]['GST File Name'] }}" target="_blank">View</a></span>
                          </div>
                          @else
                          <div class="input-group-append">
                            <span class="input-group-text" id="GST_File_Name3">Upload</span>
                          </div>
                          @endif
                        </div>
                        <span id="GST_File_Name1" class="error invalid-feedback"></span>
                      </div>
                     
                       <!-- checkbox -->
                        <div class="col-md-12">
                          <div class="form-group">
                             <div class="icheck-success d-inline">
                               <input {{$disabled}} type="checkbox" name="self_declaration" id="self_declaration" {{ $Self_Dec }} {{$disabled}}>
                               <label for="self_declaration">Self declaration / स्वयं घोषित</label>
                           </div>
                          </div>
                        </div>
                        <input {{$disabled}} type="hidden" name="odmedia_id" id="odmedia_id" value="">
                      <input {{$disabled}} type="hidden" name="submit_btn" id="submit_btn" value="0">
                      <input {{$disabled}} type="hidden" name="vendorid_tab_4" value="">
                      <a class="btn btn-primary reg-previous-button"><i class="fa fa-arrow-circle-left fa-lg"></i> Previous</a>&nbsp;
                      <input {{$disabled}} type="hidden" name="od_media_id" value="{{$media_id}}">
                     
                      <a {{$disabled}} class="btn btn-primary" onclick="nextSaveData('submit_btn');"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</a>
                      <!--<button type="submit" id="sub_btn" class="btn btn-primary" onclick="nextSaveData('submit_btn');">Submit</button>
                        -->
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ url('/js') }}/jquery-validation/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
	$("#add_row").click(function(){
    var i = $("#increse_i").val();
    i++;

		$("#details_of_owners").append('<div class="row" style="padding: 10px 18px 0 18px;"><div class="col-md-4"><div class="form-group"><label for="owner_name">Publication Name / प्रकाशन का नाम</label><p><input type="text" name="owner_name[]" id="owner_name' + i + '" placeholder="Enter Owner`s Name" maxlength="40" class="form-control form-control-sm owner_name"></p></div></div><div class="col-md-4"><div class="form-group"><label for="email">Email / ईमेल<font color="red">*</font></label><p><input type="text" name="owner_email[]" id="owner_email' + i + '" placeholder="Enter Email" maxlength="30" onkeyup="return checkUniqueOwnerpersonalmedia(this, this.value,' + i + ')" class="form-control form-control-sm "><span id="alert_owner_email' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल<font color="red">*</font></label><p><input type="text" name="owner_mobile[]" id="owner_mobile' + i + '" maxlength="10" placeholder="Enter Mobile" onkeyup="return checkUniqueOwnerpersonalmedia(this, this.value,' + i + ')" class="form-control form-control-sm"><span id="alert_owner_mobile' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता<font color="red">*</font></label><p><textarea type="text" name="address[]" id="owner_address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea></p></div></div><div class="col-md-4"><div class="form-group"> <label for="fax">Fax / फैक्स</label><input type="text" name="fax_no[]" id="owner_fax' + i + '" placeholder="Enter Fax" class="form-control form-control-sm" maxlength="14"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row">Remove</button></div></div>');
	});
  $("#increse_i").val(i);
  $("#details_of_owners").on('click', '.remove_row', function() {
    $(this).parent().parent().remove();
  });
});
$(document).ready(function(){
	$("#add_row_next").click(function(){
		$("#details_of_work_done").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष*</label><input {{$disabled}} type="text" name="year[]" placeholder="YYYY" class="form-control form-control-sm" id="datepicker"></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा*</label><input {{$disabled}} type="text" name="quantity_duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)*</label><input {{$disabled}} type="text" name="billing_amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm"></div></div><div class="col-md-4"><div class="form-group"><label for="upload_doc">Upload Document / दस्तावेज़ अपलोड करें</label><div class="input-group"><div class="custom-file"><input {{$disabled}} type="file" name="upload_doc[]" class="custom-file-input" id="upload_doc"><label class="custom-file-label" for="exampleInputFile">Choose file</label></div><div class="input-group-append"><span class="input-group-text">Upload</span></div></div></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 87px;"><button class="btn btn-danger remove_row_next">Remove</button></div></div>');
	});
    $("#details_of_work_done").on('click','.remove_row_next',function(){
        $(this).parent().parent().remove();
    });
});


 //$(document).ready(function () {

    $(document).on('change','.call_district',function() {
      // console.log($(this).val() + '~' + $(this).attr("data"));
      if ($(this).val() != '') {
  
      var id = $(this).attr("data");
        var idState= $(this).val();
         //console.log(idState);    

       $.ajax({
          url: "{{url('fetchDistricts')}}",
          type: "POST",
          data: {
              state_code: idState,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (data){
            //console.log(data);
            var obj = JSON.parse(data.result);
            console.log(obj.original.data);
            var html = '';
           var html = '<option value="">Select District</option>';
            $.each(obj.original.data, function (key, value) 
            {
               html += '<option value="' + value.District + '">' + value.District + '</option>';

            });
          //  console.log(html);
             $("#"+id).html(html);
          }
        }); 
        }       
      });
    //});

////////////// file upload size  512kb ////////////////
$(document).ready(function () {

  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    id.slice(1);
   // console.log(id);
    var file = this.files[0].name;
    var totalBytes = this.files[0].size;
    var sizeKb = Math.floor(totalBytes / 1000);
    var ext = file.split('.').pop();
    if (file != '' && sizeKb < 512 && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
    
      $("#" + id + 1).hide();
       
    } else {
      $("#" + id).val('');
      $("#" + id + 2).text("Choose file");
      $("#" + id + 1).text('File size should be less than 512kb and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
    }
  });

});
 function uploadFile(i,thiss) {
    var file = thiss.files[0].name;
    var totalBytes = thiss.files[0].size;
    var sizeKb = Math.floor(totalBytes / 1000);
    var ext = file.split('.').pop();
    if (file != '' && sizeKb < 512 && ext == "pdf") {
      $("#choose_file" + i ).empty();
      $("#choose_file" + i ).text(file);
      $("#upload_file" + i ).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } else {
      //console.log("hello");
      $("#upload_doc" + i).val('');
      $("#choose_file" + i ).text("Choose file");
      $("#upload_doc_error" + i).text('File size should be less than 512kb and file should be pdf!');
      $("#upload_doc_error" + i ).show();
      $("#upload_file" + i ).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })

$(document).ready(function(){
  $('body').on('focus',".datepicker", function(){
    //$(this).datepicker();

    $(this).click(function(){
  $('.ui-datepicker-calendar').css("display","none");
});
$(this).focusin(function(){
  $('.ui-datepicker-calendar').css("display","none");
});
$(this).datepicker({
       // changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        beforeShow: function(input) {
        $(input).datepicker("widget").addClass('hide-calendar');
        },
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            $(this).datepicker('widget').addClass('hide-calendar');
        }
    });
  });
});

   function onlyAlphabets(e, t) {
      try {
          if (window.event) {
              var charCode = window.event.keyCode;
          }
          else if (e) {
              var charCode = e.which;
          }
          else { return true; }
          if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
              return true;
          else
              return false;
      }
      catch (err) {
          alert(err.Description);
      }
  }

  //Only Numeric Number

  function onlyAlphaNumeric(e)
  {
     var keyCode = e.which;
     // Not allow special 
     if ( !( (keyCode >= 48 && keyCode <= 57) 
       ||(keyCode >= 65 && keyCode <= 90) 
       || (keyCode >= 97 && keyCode <= 122) ) 
        && keyCode != 32 ) {
       e.preventDefault();
     }
  } 

  function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // Check Unique Data 
  function checkUniqueVendor(id, val) {
    //console.log(id +'~'+ val)
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
          //console.log(response)
           if (response.status == 0) {
            $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
            $("#v_alert_" + id).show();
            //$("#v_" + id).val('');
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
                console.log(response);
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
            // $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
            // $("#v_alert_" + id).show();
            // $("#v_" + id).val('');
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

  function titleCase(string) {
  return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }

  //  next and previous function for save 
  function nextSaveData(id) {
    //console.log($("#" + id).val() );
    if ($("#" + id).val() == 0) {
      $("#" + id).val(1);

      if(id == "next_tab_2")
      {
        $("#next_tab_1").val(0);
      }
      else if(id == "next_tab_3")
      {
        // $("#next_tab_1").val(0);
        $("#next_tab_2").val(0);
      }
      else if(id == "submit_btn")
      {
        console.log(id);
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
      cache:false,
      contentType: false,
      processData: false,
      //autoUpload: true,
      
      success: function(data) {
        console.log(data);
        if (data.success == false) {
          $('.alert-danger').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                //window.location.reload();
              }, 5000 );
        }
        if (data.success == true) {
          if (id == 'next_tab_1') {
            $("#ownerid").val(data.data);
            console.log(data.data);

          } else {
            $("#vendorid_tab_2").val(data.data);
            $("#vendorid_tab_3").val(data.data);
            $("#vendorid_tab_4").val(data.data[0]);
            if(id == "submit_btn"){
              $('.alert-success').fadeIn().html(data.message);
              setTimeout(function() {
                $('.alert-success').fadeOut("slow");
                 window.location.href = 'viewPersonal/' +data.data;
                //window.location.href("{{ url('viewSoleRightMedia/')}}");
              }, 5000 );

            }
          }
        }
      },
      error: function(error) {
        console.log('error');
      }
    });
  }
    $('.alert-success').fadeOut()
    $('.alert-danger').fadeOut()
</script>
@endsection