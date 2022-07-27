@extends('admin.layouts.layout')

@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />
@endsection
<style>
    .error {
        color: red;
        font-size: 14px;
    }

    input[type=radio] {
        width: 20px;
        height: 20px;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Outdoor Personal Renewal Media</h6>
        </div>
        <!-- Card Body -->
        @php
            if(($vendor->Modification=='1') && ($vendorcheck=='1'))
            {
                $show="none";
            }
            else
            {
                $show="";
            }
        @endphp

    <div class="card-body">
        <div class="alert alert-success" id="show_msg" style="display: none;">
            <div align="center" class="alert alert-success text-primary" id="show_msg2"></div>
        </div>
        <div align="center" class="alert alert-danger" style="display: none;"></div>

        <!--  here form-->
        <form enctype="multipart/form-data" id="personal_media">
            @csrf
            @php
            $renewal_code=Request::segment(2);
            @endphp
            <input type="hidden" name="od_media_id" value="{{$renewal_code}}">
          <div class="tab-content">
            <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
              <!-- your steps content here -->
              <div id="details_of_owner">
                <input type="hidden" name="vendorcheck" value="{{@$vendorcheck}}">
                <div class="row col-md-12">
                            <h4 class="subheading">Authority Details / प्राधिकरण विवरण :-</h4>
                        </div><br>
                        <div class="row" id="authority_details">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authority">Authority Which Granted Media With
                                        Address / प्राधिकरण जिसने मीडिया को पते के साथ प्रदान किया
                                        <font color="red">*</font>
                                    </label>
                                    <input  type="text" name="Authority_Which_granted_Media" placeholder="Enter Authority Which Granted Media With Address" class="form-control form-control-sm" id="authority" maxlength="120" value="{{$vendor->{'Authority Which granted Media'} ?? '' }}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <div class="form-group">
                                    <label for="Contract_No">Contract No / अनुबंध क्रमांक<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Contract_No" placeholder="Enter Amount Paid to Authority For The Current Year" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" id="Contract_No" maxlength="13" value="{{$vendor->{'Contract No_'} ?? ''}}">
                                </div>
                            </div>-->
                            <div class="col-md-4"> <!-- Add -->
                                <div class="form-group">
                                  <label for="Amount_paid_to_Authority">Amount Paid to Authority For The Current Year / चालू वर्ष के लिए प्राधिकरण को भुगतान की गई राशि</label>
                                  <input type="text" name="Amount_paid_to_Authority" placeholder="Enter Amount Paid to Authority For The Current Year" class="form-control form-control-sm" id="fax_no4" onkeypress="return onlyNumberKey(event)" value="{{ @$vendor->{'Amount paid to Authority'} != '' ? round($vendor->{'Amount paid to Authority'},2):''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                  <span id="alert_Amount_paid_to_Authority" style="color: red;"></span>
                                </div>
                            </div>
                            <!--<div class="col-md-4">
                                <div class="form-group">
                                    <label for="License_Fee">License Fee / लाइसेंस शुल्क<font color="red">*
                                        </font></label>
                                    <input type="text" name="License_Fee" id="license_fee" placeholder="Enter License Fee" onkeypress="return onlyNumberKey(event)" class="form-control form-control-sm" maxlength="8" value="{{round(@$vendor->{'License Fees'},5) ?? ''}}">
                                </div>
                            </div>-->
                            <div class="col-md-4"> <!-- Add -->
                                <div class="form-group">
                                  <label>Duration / अवधि </label>
                                  <input type="date" name="Media_Type" placeholder="DD/MM/YYYY" class="form-control form-control-sm" min="{{ date('Y-m-d',strtotime('-10 years')) }}" value="{{ (!empty($vendor->{'Duration'}) && @$vendor->{'Duration'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$vendor->{'Duration'})) : ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                </div>
                            </div>

                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">Quantity of Display / प्रदर्शन की
                                        मात्रा<font color="red">*</font></label>
                                    <input type="text" name="Quantity_Of_Display" id="quantity_of_dis" placeholder="Quantity of Display" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$vendor->{'Quantity Of Display'} ?? ''}}">
                                </div>
                            </div> -->
                            @php
                            $arr =array(0=>'Size per unit', 1=>'Size per sqft',2=> 'Spot per unit');
                            @endphp
                            <div class="col-md-4"> <!-- Add -->
                                <div class="form-group">
                                <label>Rental Type / किराये का प्रकार</label>
                                <select name="Rental_Agreement" class="form-control form-control-sm" style="width: 100%;" id="rental_type" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                    <option value="">Select Type</option>

                                    @foreach($arr as $key =>$value)
                                    <option value="{{$key}}" @if( !empty( @$vendor->{'Rental Agreement'} ) && @$vendor->{'Rental Agreement'}==$key) selected="selected" @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_from">License start date / लाइसेंस शुरू होने
                                        की दिनांक<font color="red">*</font></label>
                                    <input type="date" name="License_From" id="txt_from" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License From'} ? date('Y-m-d', strtotime($vendor->{'License From'})) : ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="license_to">License end date / लाइसेंस समाप्ति दिनांक
                                        <font color="red">*</font>
                                    </label>
                                    <input type="date" name="License_To" id="txt_to" placeholder="DD/MM/YYYY" class="form-control form-control-sm" value="{{ @$vendor->{'License To'} ? date('Y-m-d', strtotime($vendor->{'License To'})) : ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                    <span id="date_error" style="color:red;display: none;"></span>
                                </div>
                            </div>
                        </div><br>




                <!-- <div class="row" style="margin-left: 8px;">
                  <br>
                  <div class="row col-md-12">
                    <div class="row col-md-4">
                      <h4 class="subheading">Authorized Representative :-</h4>
                    </div>
                  </div>
                  <br>
                  <div id="radioar">
                    <div class="row" id="auth_detail">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font>
                          </label>
                          <textarea type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" onkeypress="return onlyAlphabets(event)"></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="address">Address / पता <font color="red">*</font>
                          </label>
                          <textarea type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm"></textarea>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font>
                          </label>
                          <input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email">E-mail. / ईमेल <font color="red">*</font>
                          </label>
                          <input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="mobile">Mobile / मोबाइल <font color="red">*</font>
                          </label>
                          <input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="mobile"> Alternate Mobile / मोबाइल <font color="red">*</font>
                          </label>
                          <input type="text" name="altername_mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10">
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                  </div>
                </div>

                <div class="row">
                  <input type="hidden" name="count_id" id="countID" value="{{$key ?? 0}}">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                    <a class="btn btn-primary " style="float: right;" id="add_Auth">
                      <i class="fa fa-plus" aria-hidden="true"></i> Add </a>
                  </div>
                </div> -->
                <!--  work done section start-->
                
                
                
                @include('admin.pages.personal-outdoor.media-address')
                
                
                <br>
                <div class="row col-md-12">
                  <h4 class="subheading">Details of work done in last year, for the applied media only, if any (As per format given below) /<br> पिछले वर्ष में किए गए कार्य का विवरण, केवल एप्लाइड मीडिया के लिए, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार) :-</h4>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <h6>If you want to import through XLS <a href="{{asset('uploads/work_done_excel.xlsx')}}" target="_blank">Download Sample File</a>
                    </h6>
                  </div>
                  <div class="col-md-3">
                    <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2" style="pointer-events: {{$pointer}};"> Yes &nbsp;
                    <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" checked="checked" style="pointer-events: {{$pointer}};"> No
                  </div>
                </div>
                <br>
                <br>
                <div class="row" id="xls_show2" style="display: none;">
                  <div class="col-md-4">
                    <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div>
                <div id="details_of_work_done">
                  @forelse($work as $key => $works)
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="year">Year / वर्ष <font color="red">*</font>
                        </label>
                        <p>
                          <select name="ODMFO_Year[]" id="Years" class="form-control form-control-sm ddlYears" {{ $disabled }} style="pointer-events: {{$pointer}};">
                            @if(@$works->Year == '')
                            <option value="">Select Year</option>
                            @else
                            <option value="{{ $works->Year }}">
                                {{ $works->Year }}
                            </option>
                            @endif
                          </select>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$works->{'Qty Of Display_Duration'} ?? ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु) <font color="red">*</font>
                            @php
                            if(@$works->{'Billing Amount'} == 0)
                            {
                            $work_done_data1 = '';
                            }
                            else
                            {
                            $work_done_data1 = round(@$works->{'Billing Amount'},2);
                            }
                            @endphp
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>From Date / की दिनांक से : <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="from_date[]" id="from_date" class="form-control form-control-sm" value="{{ (!empty(@$works->{'From Date'}) && @$works->{'From Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'From Date'})) : ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To Date <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="to_date[]" id="to_date" class="form-control form-control-sm" value="{{ (!empty(@$works->{'To Date'}) && @$works->{'To Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$works->{'To Date'})) : ''}}" {{ $disabled }} style="pointer-events: {{$pointer}};">
                        </p>
                      </div>
                    </div>
                    <input type="hidden" name="work_od_media_id[]" value="{{@$works->{'OD Media ID'} ?? ''}}">
                    <input type="hidden" name="work_od_media_id[]" value="{{@$works->{'Line No_'} ?? ''}}">
                  </div>
                  @empty
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="year">Year / वर्ष <font color="red">*</font>
                        </label>
                        <p>
                          <select name="ODMFO_Year[]" id="Years" class="form-control form-control-sm ddlYears">
                            <option>Select Year</option>
                          </select>
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु) <font color="red">*</font>
                        </label>
                        <p>
                          <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>From Date / की दिनांक से : <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="from_date[]" id="from_date" class="form-control form-control-sm">
                        </p>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To Date <font color="red">*</font>
                        </label>
                        <p>
                          <input type="date" name="to_date[]" id="to_date" class="form-control form-control-sm">
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforelse
                </div>
                <input type="hidden" name="lineno2" id="lineno2" value="{{$exline2 ?? ''}}">
                <div class="row" style="float:right;margin: 6px 0 0 0;">
                  <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
                  <a class="btn btn-primary" id="add_row_next" style="display: {{ $show }};">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add </a>
                </div>
                <br>
                <br>
                <!--  work done section end -->
                <br>
                <br>
                <!--  file upload start -->
                <div class="row col-md-12">
                  <h4 class="subheading">Upload Document:- </h4>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    @if(@$vendor->{'Legal Doc File Name'}=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name" class="custom-file-input" id="Legal_Doc_File_Name">
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name">
                                        Choose file
                                    </label>
                                </div>
                                @if(@@$vendor->{'Legal Doc File Name'} != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/personal-media/{{ @$vendor->{'Legal Doc File Name'} }}" target="_blank">View</a>
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
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">Upload document of legal status of company
                                / कंपनी की कानूनी स्थिति का दस्तावेज अपलोड करें <font color="red">*</font></label><br><br>

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Legal_Doc_File_Name_modify" class="custom-file-input" id="Legal_Doc_File_Name" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                    <label class="custom-file-label" id="Legal_Doc_File_Name2" for="Legal_Doc_File_Name" >
                                        {{ @$vendor->{'Legal Doc File Name'} ?? 'Choose file' }}
                                    </label>
                                </div>
                                @if(@$vendor->{'Legal Doc File Name'} != '')
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href="{{ url('/uploads') }}/personal-media/{{ @$vendor->{'Legal Doc File Name'} }}" target="_blank">View</a>
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
                        @endif
                  </div>
                  <div class="col-md-8">
                    @if(@$vendor->{'Affidavit File Name'}=="")
                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र  प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name" class="custom-file-input" id="Affidavit_File_Name">
                                    <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">Choose file</label>
                                </div>
                                @if(@$vendor->{'Affidavit File Name'} != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ @$vendor->{'Affidavit File Name'} }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="exampleInputFile">Submit an affidavit on stamp paper stating
                                on oath that the details submitted by you on performa are true and
                                correct.Mention the application no. in affidavit / स्टाम्प पेपर पर
                                शपथ पत्र  प्रस्तुत करें कि आपके द्वारा प्रस्तुत किए गए
                                विवरण सत्य और सही हैं। आवेदन संख्या का उल्लेख करें। हलफनामे
                                में <font color="red">*</font></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="Affidavit_File_Name_modify" class="custom-file-input" id="Affidavit_File_Name" {{ $disabled }} style="pointer-events: {{$pointer}};">
                                    <label class="custom-file-label" id="Affidavit_File_Name2" for="Affidavit_File_Name">{{ @$vendor->{'Affidavit File Name'} ?? 'Choose file' }}</label>
                                </div>
                                @if(@$vendor->{'Affidavit File Name'} != '')
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="{{ url('/uploads') }}/personal-media/{{ @$vendor->{'Affidavit File Name'} }}" target="_blank">View</a></span>
                                </div>
                                @else
                                <div class="input-group-append">
                                    <span class="input-group-text" id="Affidavit_File_Name3">Upload</span>
                                </div>
                                @endif
                            </div>
                            <span id="Affidavit_File_Name1" class="error invalid-feedback"></span>
                        </div>
                        @endif
                  </div>
                </div>
                <input type="hidden" name="doc[]" id="doc_data">  <!-- add 25-feb -->
                <!--  file upload end -->
                <br><br>
                <!--  App section start -->
                        <!--<div class="card bg-light text-dark w-100">
                            <h6 class="text-center">Please submit location data through app</h6>
                            <a href="#" class="card-link text-center">App link</a>
                        </div> -->
                <!-- App section end -->
              </div>
            </div><br><br>
            <a class="btn btn-primary set-pm-next-button" id="tab_1" style="pointer-events: {{$pointer}};" >Save <i class="fa fa-arrow-circle-right fa-lg"></i>
            </a>
          </div>
          </div>
    </form>
</div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection

@section('custom_js')
<script src="{{ url('/js') }}/personal_renewal.js"></script>
{{-- <script src="{{ url('/js') }}/add.js"></script> --}}
<script>
    //Show and hide div for payment type(DD and NEFT)
    $('#select_payment').change(function() {
        var payment_type = $('#select_payment').val();
        if (payment_type == 0) {
            $('#dd_div').show();
            $('#neft_div').hide();
        } else {
            $('#dd_div').hide();
            $('#neft_div').show()
        }
    });

    //google map api start
    function initialize() {

        $(document).on('keyup keypress', '.map-input', function(e) {

            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }

            const locationInputs = document.getElementsByClassName("map-input");
            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            var ind = $(this).attr("data");
            for (let i = 0; i < locationInputs.length; i++) {
                const input = locationInputs[i];
                // const fieldKey = input.id.replace("-input-"+ind, "");
                const fieldKey = 'address';
                const isEdit = document.getElementById(fieldKey + "-latitude" + ind).value != '' && document
                    .getElementById(fieldKey + "-longitude" + ind).value != '';
                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude" + ind).value) || -
                    33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude" + ind).value) ||
                    151.2195;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {
                        lat: latitude,
                        lng: longitude
                    },
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({
                    input: input,
                    map: map,
                    marker: marker,
                    autocomplete: autocomplete
                });
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({
                        'placeId': place.place_id
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng, ind);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        });

    }

    function setLocationCoordinates(key, lat, lng, ind) {
        const latitudeField = document.getElementById(key + "-" + "latitude" + ind);
        const longitudeField = document.getElementById(key + "-" + "longitude" + ind);
        latitudeField.value = lat;
        longitudeField.value = lng;
    }
    /* End searching location */

    //payment mode script
    $(document).ready(function() {
        $("#payment_type").change(function() {
            var mode = $("#payment_type").val();
            if (mode == 'DD') {
                $("#payment_mode1").show();
            } else {
                $("#payment_mode1").hide();
            }
            if (mode == 'NTFT') {
                $("#payment_mode2").show();
            } else {
                $("#payment_mode2").hide();
            }
            if (mode == 'BHARAT') {
                $("#payment_mode3").show();
            } else {
                $("#payment_mode3").hide();
            }
        });
    });

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
                        '<div class="row"><div class="col-md-4"><div class="form-group"><label>Media category / मीडिया श्रेणी <font color="red">*</font></label><p><select name="Applying_For_OD_Media_Type[]" tabindex="'+i+'" id="applying_media_' +
                        i + '" data-val="showcategory_' + i +
                        '" class="form-control form-control-sm mediaclass" style="width: 100%;"><option value="">Select Category</option><option value="0">Airport</option><option value="1">Railway Station</option><option value="2">Road side</option><option value="3">Moving Media</option><option value="4">Public utility</option></select></p></div></div><div class="col-md-4" id="subcategory" ><div class="form-group"><label>Media Sub-Category / मीडिया उप-श्रेणी : </label><p><select name="od_media_type[]" class="form-control-sm form-control subcategory dynemicsub_cat'+i+'" tabindex="'+i+'" data-eid="showcategory_'+i+'" id="showcategory_' +
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



    $(document).ready(function() {
        var currentYear = (new Date()).getFullYear();
        for (var i = 1980; i <= currentYear; i++) {
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            $(".ddlYears").append(option);
        }
        $("#add_row_next").click(function() {
            var i = $("#count_i").val();
            i++;

            var html =
                '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><p><select name="ODMFO_Year[]" id="Years' +
                i +
                '" class="form-control form-control-sm ddlYears"><option value="">Select Year</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' +
                i +
                '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm"></p></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' +
                i +
                '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="from_date">From date / की दिनांक से<font color="red">*</font></label><p><input type="date" name="from_date[]" id="from_date' +
                i +
                '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-4"><div class="form-group"><label for="to_date">To date<font color="red">*</font></label><p><input type="date" name="to_date[]" id="to_date' +
                i +
                '" class="form-control form-control-sm" maxlength="14"></p></div></div><div class="col-md-6"></div><div class="col-md-6"><button class="btn btn-danger remove_row_next" style="margin: 1% 0 0 78%;"><i class="fa fa-minus"></i> Remove</button></div></div><br>';
            $("#details_of_work_done").append(html);
            $("#count_i").val(i);
            for (var i = 1980; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                $(".ddlYears").append(option);
            }
        });
        $("#details_of_work_done").on('click', '.remove_row_next', function() {
            var ind = $(this).attr('data');
            var line_no = $("#line_no_" + ind).val();
            var odmedia_id = $("#odmedia_id_" + ind).val();
            if (line_no != '' && odmedia_id != '') {
                if (confirm("Are you sure you want to delete this?")) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                        },
                        type: 'get',
                        url: 'remove-workdone-data',
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

            var add_count = $("#count_i").val();

            $("#count_i").val(add_count - 1);
        });

        //Loop and add the Year values to DropDownList.

    });

    $(document).on('change', '.call_district', function() {
        if ($(this).val() != '') {
            var id = $(this).attr("data");
            $("#" + id).empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'POST',
                url: "{{Route('fetchDistricts')}}",
                data: {
                    state_code: $(this).val()
                },
                success: function(response) {
                    // console.log(response);
                    $("#" + id).html(response.message);
                }
            });
        }
    });


    //sk for subcategory
    $(document).on('change', '.mediaclass', function() {
        if ($(this).val() != '') {
            var id = $(this).attr("data-val");
             var i;
             var dyn_sub=[];
            var tabindex=$(this).attr("tabindex");
            for(i=0; i<=tabindex;i++){

              if(i>0){
                var autoid=i-1;
                var idattrdynsub=$('.dynemicsub_cat'+autoid).attr('id');
                var id_attrdyn_sub12=idattrdynsub.slice(0,13);
                var id_attrdyn_sub=id_attrdyn_sub12.concat(autoid);
                dyn_sub.push($('#'+id_attrdyn_sub).val());
                }
            }

           console.log(dyn_sub);
            $("#" + id).empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'POST',
                url: "{{Route('fetchmedia')}}",
                data: {
                    media_code: $(this).val(),
                    dyn_sub:dyn_sub
                },
                success: function(response) {
                    $("#" + id).html(response);

                }
            });
        }
    });





    //});

    //file size 2MB start
    // $(document).ready(function() {
    //     $(".custom-file-input").change(function() {
    //         var id = $(this).attr("id");
    //         var file = this.files[0].name;
    //         var file1 = $('#' + id + 2).text();
    //         var totalBytes = this.files[0].size;
    //         var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    //         var ext = file.split('.').pop();
    //         if (file != '' && sizemb <= 2 && ext == "pdf") {
    //             $("#" + id + 2).empty();
    //             $("#" + id + 2).text(file);
    //             $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass(
    //                 "input-group-text");
    //             $("#" + id + 4).show();
    //             $("#" + id + 1).hide();
    //             if ($("#doc_data").val() == '') {
    //                 $("#doc_data").val(file);
    //             } else {
    //                 var names = $("#doc_data").val();
    //                 var numbersArray = names.split(',');
    //                 //comment 25-Feb
    //                 // if (isinArray(file, numbersArray) == false) {
    //                 //     $("#doc_data").val(function() {
    //                 //         return $("#doc_data").val() + ',' + file;
    //                 //     });
    //                 //     var namess = $("#doc_data").val();
    //                 //     var numbersArray1 = namess.split(',');
    //                 //     numbersArray1 = $.grep(numbersArray1, function(value) {
    //                 //         return value != file1;
    //                 //     });
    //                 //     $("#doc_data").val(numbersArray1);
    //                 //     $("#" + id + 1).hide();
    //                 // } else {
    //                 //     var namess = $("#doc_data").val();
    //                 //     var numbersArray1 = namess.split(',');
    //                 //     numbersArray1 = $.grep(numbersArray1, function(value) {
    //                 //         return value != file1;
    //                 //     });
    //                 //     $("#doc_data").val(numbersArray1);
    //                 //     $("#" + id).val('');
    //                 //     $("#" + id + 2).text("Choose file");
    //                 //     $("#" + id + 3).html("Upload").addClass("input-group-text");
    //                 //     $("#" + id + 1).text('File already selected!');
    //                 //     $("#" + id + 1).show();
    //                 //     $("#" + id + "-error").addClass("hide-msg");
    //                 // }
    //             }
    //         } else {
    //             $("#" + id).val('');
    //             $("#" + id + 2).text("Choose file");
    //             $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
    //             $("#" + id + 1).show();
    //             $("#" + id + 3).html("Upload").addClass("input-group-text");
    //             $("#" + id + "-error").addClass("hide-msg");
    //             $("#" + id + 4).hide();
    //         }
    //     });
    // });

    function uploadFile(i, thiss) {
        // condole.log('data');
        var file = thiss.files[0].name;
        var totalBytes = thiss.files[0].size;
        var sizeKb = Math.floor(totalBytes / 1000);
        console.log(sizeKb);
        var ext = file.split('.').pop();
        if (file != '' && sizeKb < 26000 && ext == "pdf") {
            $("#choose_file" + i).empty();
            $("#choose_file" + i).text(file);
            $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
            $("#upload_doc_error" + i).hide();
        } else {
            //console.log("hello");
            $("#upload_doc" + i).val('');
            $("#choose_file" + i).text("Choose file");
            $("#upload_doc_error" + i).text('File size should be less than 25mb and file should be only pdf !');
            $("#upload_doc_error" + i).show();
            $("#upload_file" + i).html("Upload").addClass("input-group-text");
            $("#upload_doc" + i + "-error").addClass("hide-msg");
        }
    }
    //file size end

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })

    $(document).ready(function() {
        $('body').on('focus', ".datepicker", function() {
            //$(this).datepicker();

            $(this).click(function() {
                $('.ui-datepicker-calendar').css("display", "none");
            });
            $(this).focusin(function() {
                $('.ui-datepicker-calendar').css("display", "none");
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
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst
                        .selectedMonth, 1));
                    $(this).datepicker('widget').addClass('hide-calendar');
                }
            });
        });
    });

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

    //Only Numeric Number

    function onlyAlphaNumeric(e) {
        var keyCode = e.which;
        // Not allow special
        if (!((keyCode >= 48 && keyCode <= 57) ||
                (keyCode >= 65 && keyCode <= 90) ||
                (keyCode >= 97 && keyCode <= 122)) &&
            keyCode != 32) {
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


    // Check Unique Data
    function checkUniqueVendor(id, val) {
        //console.log(id +'~'+ val)
        if (val != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'POST',
                url: "{{Route('solerightcheckuniquevendor')}}",
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



    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }

    function titleCase(string) {
        return string[0].toUpperCase() + string.slice(1).toLowerCase();
    }
    $(document).on('change', '.owner_name', function() {
        $("#owner_input_clean").val(1);
    });
    // $('.alert-success').hide()
    $('.alert-danger').hide()
    //  next and previous function for save
    // function nextSaveData(id) {
    //     if ($("#" + id).val() == 0) {
    //         $("#" + id).val(1);
    //         if (id == "next_tab_2") {
    //             $("#next_tab_1").val(0);
    //         } else if (id == "next_tab_3") {
    //             // $("#next_tab_1").val(0);
    //             $("#next_tab_2").val(0);
    //         } else if (id == "submit_btn") {
    //             //console.log(id);
    //             $("#next_tab_3").val(0);
    //         }
    //     }
    //     if (id != "next_tab_4") {
    //         var data = new FormData($("#sole_right_media")[0]);
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{Route('saveSoleMedia')}}",
    //             data: data,
    //             dataType: "json",
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             //autoUpload: true,

    //             success: function(data) {
    //                 if (data.success == true) {
    //                     if (id == 'next_tab_1') {
    //                         console.log(data['data']);
    //                         $("#ownerid").val(data.data);
    //                     } else {

    //                         $("#vendorid_tab_2").val(data.data['unique_id']);
    //                         $("#lineno1").val(data.data['lineno1']);
    //                         $("#lineno2").val(data.data['lineno2']);
    //                         $("#vendorid_tab_3").val(data.data);
    //                         $("#vendorid_tab_4").val(data.data[0]);
    //                         if (id == "submit_btn") {
    //                             $('.alert-success').fadeIn().html(data.message);
    //                             // setTimeout(function() {
    //                             //     $('.alert-success').fadeOut("slow");
    //                             //     window.location.href = 'viewSoleRightMedia/' + data.data;
    //                             //     //window.location.href("{{ url('viewSoleRightMedia/')}}");
    //                             // }, 5000);

    //                         }
    //                     }
    //                 }
    //             },
    //             error: function(error) {
    //                 console.log('error');
    //             }
    //         });
    //     } else {
    //         console.log('Property Details');
    //     }
    // }

    $(document).ready(function() {
        $("input[name='boradio']").click(function() {
            var radioValue = $("input[name='boradio']:checked").val();
            console.log(radioValue);
            if (radioValue == '1') {
                $("#radio").show();
                $("#addid").show();
            } else {
                $("#radio").hide();
                $("#addid").hide();
            }
        });

        // $("input[name='arradio']").click(function() {
        //     var radioValue = $("input[name='arradio']:checked").val();
        //     console.log(radioValue);
        //     if (radioValue == '1') {
        //         $("#radioar").show();
        //     } else {
        //         $("#radioar").hide();
        //     }
        // });
    });

    //Validation for number and .(Dot)
    function onlyDotNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
            return false;
        return true;
    }


    $(document).ready(function() {
        $("#txt_from").on('change', function() {
            $("#txt_to").val('');
        });
    });

    //Licence Start date and End date
    $(document).ready(function() {
        $("#txt_from").on('focus', function() {
            var to = $("#txt_from").val();
            if (to.length == '') {
                $("#txt_to").removeAttr('disabled');
            }0
        });
    });
    $(document).ready(function() {
        $("#txt_to").focus(function() {
            var txt_from = $("#txt_from").val();
            $("#txt_to").attr('min', txt_from);
        });
    });


    $(document).ready(function() {
        $('.preventLeftClick').on('click', function(e) {
            e.preventDefault();
            return false;
        });
    });


    $("#xls_show").hide();
    $("#xlxyes").click(function() {
        var xlsvalue = $(this).val();
        if (xlsvalue == '1') {
            $("#xls_show").show();
            $("#media_address").hide();
            $("#add_row_media_add").hide();
        }

    });
    $("#xlxno").click(function() {
        var xlsvalue = $(this).val();
        if (xlsvalue == '0') {
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
        $("#xls_show2").hide();
        $("#details_of_work_done").show();
        $("#add_row_next").show();
    }

});

    //Pan card valida





//for auth section
$(document).ready(function() {

        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function(){
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function(){
            $("#exist_owner_ids").hide();
        });


    });





//for auth section
$(document).ready(function() {
        $("#add_Auth").click(function() {
            var i = $("#countID").val();
            i++;
            var append='<div class="row" id="row'+i+'"><div class="col-md-4"><div class="form-group"><label for="address">Contact Person / संपर्क व्यक्ति <font color="red">*</font></label><textarea  type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" rows="1" class="form-control form-control-sm" maxlength="40" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता <font color="red">*</font></label><textarea type="text" name="AR_Address[]" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" ></textarea></div></div><div class="col-md-4"><div class="form-group"><label for="landline_no">Landline No. / लैंडलाइन नंबर <font color="red">*</font></label><input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="landline_no" onkeypress="return onlyNumberKey(event)" maxlength="14" ></div></div><div class="col-md-4"><div class="form-group"><label for="email">E-mail. / ईमेल <font color="red">*</font></label><input type="text" name="AR_Email[]" placeholder="Enter E-mail" class="form-control form-control-sm" id="email" maxlength="30" ></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-4"><div class="form-group"><label for="mobile">Alternate Mobile / मोबाइल <font color="red">*</font></label><input type="text" name="altername_mobile[]" placeholder="Enter Mobile" class="form-control form-control-sm" id="altername_mobile" onkeypress="return onlyNumberKey(event)" maxlength="10" ></div></div> <div class="col-md-10"></div><div class="col-md-2" style="padding: 2% 0 0 5%;"><button class="btn btn-danger remove_row" id="'+i+'"><i class="fa fa-minus"></i> Remove</button></div></div>';
            $("#radioar").append(append);
            $("#countID").val(i);
        });
        $(document).on('click', '.remove_row', function(e) {
            // var ind = $(this).attr('data');
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();

            var add_count = $("#countID").val();
            $("#countID").val(add_count - 1);
        });



        $("#exist_owner1").click(function(){
            $("#exist_owner_ids").show();
        });

        $("#exist_owner2").click(function(){
            $("#exist_owner_ids").hide();
        });


    });
</script>
@endsection
