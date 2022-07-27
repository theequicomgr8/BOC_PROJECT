@extends('admin.layouts.layout')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
  body {
    color: #6c757d !important;

    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }

  .multiselect-search {
    width: 100% !important;
    margin-right: 10px;
  }

  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }

  .multiselect-clear-filter {
    display: none !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  a.disabled {
    pointer-events: none;
  }

  .ui-datepicker-trigger {
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .form-control-new {
    display: block;
    width: 100%;
    /* padding: 0.375rem 0.75rem; */
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>
@section('content')
@php 
$today = date('Y-m-d');
$dataline= !empty(@$dataline) ? $dataline : [1];

if(count(@$dataline)==0)
{
  $dataline=[1];

}
else {
   $dataline=$dataline;
}
$url=url()->current();
$disabled='';
$pointer='';
$none='';
if(@$RO_id->{'online Bill Submitted'}==1)
{
  $disabled='disabled';
  $pointer='none';
  $none='none';
}
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>Bill Submission For AV-Radio </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      @if(Session::has('excel_error'))
      <div align="center" class="alert alert-danger">{{Session::get('excel_error')}}</div>
      @endif

      @if(Session::has('msg'))
      <div align="center" class="alert alert-danger">{{Session::get('msg')}}</div>
      @endif
      <form  class="AVradioMediaBillingFrm" id="AVradioMediaBillingFrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row">
             
                <!-- <div class="col-md-4 mousedisable">
                  <div class="form-group">
                  <label class="form-control-label">AV Type<font color="red">*</font></label>
                  <select class="form-control form-control-sm" id="sel1">
                    <option>Select Type</option>
                    <option>AT-TV</option>
                    <option>AT-Radio</option>                                    
                  </select>
                </div>
                </div> -->
              </div>
              @php
              if(@$RO_id->{'Vendor Bill No_'}=='')
              {
                $invoiceNo=sprintf("%s%02s", 'B',rand(100,100000).session('UserName'));
              }
              else
              {
                $invoiceNo=@$RO_id->{'Vendor Bill No_'} ?? '';
              }
              
              
              @endphp
              <div class="row">
                  <input type="hidden" name="RO_Code" value="{{$RO_id->{'RO No_'} ?? ''}}">
                  <input type="hidden" name="line_no" value="{{$RO_id->{'Line No_'} ?? ''}}">

                  <div class="col-md-4 mousedisable">
                    <div class="form-group">
                      <label class="form-control-label">Agency Code / Name<font color="red"></font></label>
                      <input type="text" class="form-control form-control-sm" name="RO_No2"  value="{{Session::get('UserName') .' / '.@$RO_id->{'Agency Name'} }}" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 mousedisable">
                    <div class="form-group">
                      <label class="form-control-label">RO No.<font color="red"></font></label>
                      <input type="text" maxlength="20" class="form-control form-control-sm" name="RO_No1"  value="{{@$RO_id->{'RO No_'} ?? ''}}" readonly>
                    </div>
                  </div>

                  <div class="col-md-4 mousedisable">
                    <div class="form-group">
                      <label class="form-control-label">GST No.<font color="red"></font></label>
                      <input type="text" maxlength="20" class="form-control form-control-sm" name="RO_No1"  value="{{@$RO_id->{'Vendor GST No_'} ?? ''}}" readonly>
                    </div>
                  </div>




                <div class="col-md-4 mousedisable">
                  <div class="form-group">
                    <label class="form-control-label">Invoice ID.<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="Invoice_id" id="billno" value="{{$RO_id->{'Vendor Bill No_'} ?? ''}}" {{ $disabled }}>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Invoice Date  <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="Invoice_date" id="bill_date1"  placeholder="DD-MM-YYYY"  value="{{ (!empty(@$RO_id->{'Vendor Bill Date'}) && @$RO_id->{'Vendor Bill Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Vendor Bill Date'})) : ''}}" {{ $disabled }}>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>

                @php
                if(@$RO_id->{'Order No_'}=='')
                {
                  $orderID=sprintf("%s%02s", 'O',rand(100,100000).session('UserName'));

                }
                else
                {
                  
                  $orderID=$RO_id->{'Order No_'} ?? '';
                }
               @endphp
              <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Order ID<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="Order_id" id="published_pageno" onkeypress="return isNumber(event)"  value="{{$RO_id->{'Order No_'} ?? '' }}" {{ $disabled }}>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Account Rep.<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="Account_rep"  maxlength="10" value="{{@$RO_id->{'Bill Submitted By'} ?? ''}}" {{ $disabled }}>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <!-- <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">GST No.<font color="red">*</font></label>
                    <input type="text" maxlength="15" class="form-control form-control-sm" name="gstno" id="gstno" return onchange="checksum(this.value);" value="">
                    <span class="gstvalidationMsg"></span>
                    <span class="validcheck"></span>
                    </div>
                  </div>                     -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Name<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerName" id="billOfficerName" value="{{@$RO_id->{'Bill Officer Name'} ?? ''}}" {{ $disabled }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Designation<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerDesign" id="billOfficerDesign" value="{{@$RO_id->{'Bill Officer Designation'} ?? ''}}"  style="pointer-events: none1;" {{ $disabled }}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">E-mail ID<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="email" id="email" value="{{@$RO_id->{'Email Id'} ?? ''}}"  style="pointer-events: none1;" {{ $disabled }}>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">From Date  <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="from_date" id="f_date"   placeholder="DD-MM-YYYY" value="{{ (!empty(@$RO_id->{'Aired From Date'}) && @$RO_id->{'Aired From Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Aired From Date'})) : ''}}"  {{ $disabled }} max="{{ $today }}">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">To Date <font color="red">*</font></label>
                    <input  type="date" class="form-control form-control-sm" name="to_date" id="t_date"  placeholder="DD-MM-YYYY" value="{{ (!empty(@$RO_id->{'Aired To Date'}) && @$RO_id->{'Aired To Date'} != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$RO_id->{'Aired To Date'})) : ''}}" {{ $disabled }} max="{{ $today }}">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                
                  <div class="col-md-4" style="display: {{$none}}">
                    <label>You want to upload excel</label>
                    <input type="radio" name="xls" id="xlxyes" value="1" class="xls"> Yes &nbsp;
                    <input type="radio" name="xls" id="xlxno" value="0" class="xls" checked="checked"> No<br>
                    <a href="{{asset('uploads/av.xlsx')}}" target="_blank" id="doenload">Download demo file</a>
                  </div>

                

                @php
                $wing=Session::get('WingType');
                @endphp

                @if($wing==4 || $wing==5)
                <div class="col-md-4" id="excel" style="display: none;">
                  <div class="form-group">
                    <label class="form-control-label">Excel Upload<font color="red">*</font></label>
                    <input type="file" class="form-control form-control-sm" name="avtv_excel" id="avtv_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div><!--end div advt image upload file end-->
                <div class="col-md-4" id="upload" style="display: none;"><br>
                  <input class="btn btn-primary submit-button btn-sm m-0" id="submit" type="submit" name="submit" value="Upload">
                </div>
                @endif
              </div>
              </div>
              

              <div class="row pt-4">
                <div class="col-md-12">
                  <!-- HG -->  <!-- card-body -->
                  <div class="row p-12"> 
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">RO No.</th> --}}
                                    <th scope="col">Date </th>
                                    <th scope="col">Time </th>
                                    {{-- <th scope="col">GST No.</th> --}}
                                    <th scope="col" style="widows: 60px;">Duration</th>
                                    <th scope="col">Bill Claim Amount</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="table">
                              
                              @if(count($dataline)>0)
                              @php 
                              $i =1; 
                              $count31=0;
                              $count32=0;
                              $count33=0;

                              $count61=0;
                              $count62=0;
                              $count63=0;
                              $count64=0;
                              $count65=0;
                              $count66=0;

                              $ary31=[];
                              $ary32=[];
                              $ary33=[];

                              $ary61=[];
                              $ary62=[];
                              $ary63=[];
                              $ary64=[];
                              $ary65=[];
                              $ary66=[];
                              
                              @endphp
                               
                                @foreach($dataline as $key => $line)
                                  
                                  @php 
                                  
                                  $time=substr(@$line->{'Aired Time'},11,2);
                                  //1 -GC, 2- Non-GC
                                  if(@$RO_id->Category==2)
                                  {
                                    if($time >=06 && $time <=12)
                                    {
                                      $count31=$count31+=1;
                                      $ary31[]=$count31;
                                      $Slot31=$RO_id->Slot31;
                                    }  
                                    elseif($time >=12 && $time <=17)
                                    {
                                       $count32=$count32+=1;
                                       $ary32[]=$count32;
                                       $Slot32=$RO_id->Slot32;
                                    }
                                    elseif($time >=17 && $time <=23)
                                    {
                                      $count33=$count33+=1;
                                      $ary33[]=$count33;
                                      $Slot33=$RO_id->Slot33;
                                    }
                                  }
                                  else
                                  {
                                    if($time >=7 && $time <=9)
                                    {
                                      $count61=$count61+=1;
                                      $ary61[]=$count61;
                                      $Slot61=$RO_id->Slot61;
                                    }  
                                    elseif($time >=9 && $time <=12)
                                    {
                                      $count62=$count62+=1;
                                      $ary62[]=$count62;
                                      //dd($count62);
                                      $Slot62=$RO_id->Slot62;
                                    }
                                    elseif($time >=12 && $time <=19)
                                    {
                                      $count63=$count63+=1;
                                      $ary63[]=$count63;
                                      $Slot63=$RO_id->Slot63;
                                    }
                                    elseif($time >=19 && $time <=20)
                                    {
                                      $count64=$count64+=1;
                                      $ary64[]=$count64;
                                      $Slot64=$RO_id->Slot64;
                                    }
                                    elseif($time >=20 && $time <=22)
                                    {
                                      $count65=$count65+=1;
                                      $ary65[]=$count65;
                                      $Slot65=$RO_id->Slot65;
                                    }
                                    elseif($time >=22 && $time <=23)
                                    {
                                      $count66=$count66+=1;
                                      $ary66[]=$count66;
                                      $Slot66=$RO_id->Slot66;
                                    }
                                  }
                                                                   
                                  @endphp
                                  
                                <tr>
                                  <!-- <input type="hidden" name="count[]" value="{{ $count62 }}"> -->
                                  <input type="hidden" name="RO_No[]" id="RO_No" class="form-control-new" value="{{ @$RO_id->{'RO No_'} }}">
                                  <input type="hidden" name="gst[]" id="gst" class="form-control-new" value="{{ @$RO_id->{'Vendor GST No_'} ?? '' }}">
                                  <input type="hidden" name="amount[]" id="amount" class="form-control-new" value="{{ @$RO_id->{'Amount'} ?? '' }}">
                                    <td>
                                      <input type="date" name="date[]"   class="form-control-new date" value="{{substr(@$line->{'Aired Date'},0,10) ?? '' }}" {{ $disabled }}>
                                    </td>
                                    <td>
                                      <input type="time" name="time[]"  class="form-control-new" value="{{substr(@$line->{'Aired Time'},11,16) ?? '' }}" {{ $disabled }}>
                                    </td>
                                    
                                    <td>
                                      <input type="text" name="duration[]" id="duration" class="form-control-new" value="{{ round(@$line->{'Spot Duration'},2) ?? '' }}" {{ $disabled }}>
                                    </td>
                                    <td>
                                      <input type="text" name="bill_claim_amount[]" id="bill_claim_amount" class="form-control-new" value="{{ round(@$line->{'Bill Claim Amount'},2) ?? '' }}" {{ $disabled }}>
                                    </td>
                                    <td style="display: {{$none}}">
                                      <!-- <input type="hidden" name="rono[]" class="rono" value="{{@$line->{'RO No_'} ?? '' }}">
                                      <input type="hidden" name="rolineno[]" class="rolineno" value="{{@$line->{'Ro Line No_'} ?? '' }}">
                                      <input type="hidden" name="roline[]" class="roline" value="{{@$line->{'Line No_'} ?? '' }}"> -->
                                      <span class="btn btn-danger rounded-0 delete" data-rono="{{@$line->{'RO No_'} ?? '' }}" data-rolineno="{{@$line->{'Ro Line No_'} ?? '' }}" data-roline="{{ @$line->{'Line No_'} ?? '' }}">
                                        <i class="fa fa-trash"></i>
                                      </span>
                                    </td>
                                </tr>
                                @php 
                                $i++; 

                                @endphp
                                
                                @endforeach
                                @include('admin.pages.billing.RedioMediaBilling.message')
                                @endif
                                
                                @php
                                //print_r(count($ary63));
                                @endphp
                            </tbody>
                        </table>
                    </div>

                    <!-- Add rows button-->
                    <a class="btn btn-primary rounded-0 btn-block" id="insertRow" href="#" style="display: {{$none}}">Add new row</a>
                </div>
                </div>
              </div>
              <div class="row">

                <div class="col-md-4" id="diff-results" style="display:none;">
                  <div class="form-group">
                    <label class="form-control-label"> Match Image Difference(in %)<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="ImageMatchPercentage" id="ImageMatchPercentage" value="" readonly>

                  </div>
                  <span id="alert_img_compare" class="" style="display:none;"></span>

                </div>                
              </div>
              <div class="col-sm-6">
                <div class="form-group clearfix">
                  <label for="owner_newspaper"></label><br>
                  <div class="icheck-primary d-inline">

                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12 text-right">

              </div>
            </div>
          </div>
          @php
          $sum=@$RO_id->Slot61+@$RO_id->Slot62+@$RO_id->Slot63+@$RO_id->Slot64+@$RO_id->Slot65+@$RO_id->Slot66+@$RO_id->Slot31+@$RO_id->Slot32+@$RO_id->Slot33;
          @endphp
          <input type="hidden" name="totalslot" value="{{$sum}}">
          <input type="hidden" name="countid" id="countid" value="{{$key+1 ?? ''}}">
          <div class="row" style="display: {{$none}}">
            <div class="col-sm-12 text-right">            
              <input class="btn btn-primary submit-button btn-sm m-0" id="submit2" type="submit" name="submit" value="submit"> 
              <!-- <a class="btn btn-primary btn-submit" id="submit2" style="display: {{$none}}">submit <i class="fa fa-arrow-circle-right fa-lg"></i></a> -->
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endsection
@section('custom_js')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="{{ url('/js') }}/validator.js"></script>
<script src="{{ url('/js') }}/avBilling.js"></script>
<script src="https://rsmbl.github.io/Resemble.js/resemble.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"></script> --}}
<script type="text/javascript">


    $(document).ready(function() {
      $("#submit").click(function(){
        var form=$("#AVradioMediaBillingFrm");
          form.validate({
            rules : {
              Invoice_id : {
                required: true
              },
              Invoice_date : {
                required: true
              },
              Order_id : {
                required: true
              },
              Account_rep : {
                required: true
              },
              billOfficerName : {
                required: true
              },
              billOfficerDesign : {
                required: true
              },
              email : {
                required: true
              },
              from_date : {
                required: true
              },
              to_date : {
                required: true
              },
              "bill_claim_amount[]" : {
                required : true
              },
              "date[]" : {
                required : true
              },
              "time[]" : {
                required : true
              },
              "duration[]" : {
                required : true
              },

            },
            messages : {
              Invoice_id : {
                required : "This field is required"
              },
              Invoice_date : {
                required : "This field is required"
              },
              Order_id : {
                required : "This field is required"
              },
              Account_rep : {
                required : "This field is required"
              },
              billOfficerName : {
                required : "This field is required"
              },
              billOfficerDesign : {
                required : "This field is required"
              },
              email : {
                required : "This field is required"
              },
              from_date : {
                required : "This field is required"
              },
              to_date : {
                required : "This field is required"
              },
              
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            },

            submitHandler: function(form) {
              if ($('#avtv_excel').get(0).files.length === 0) {
                  alert("Please upload excel file");
              }
              else
              {
                dataSave();
              }
              // dataSave();
            }


            
            


          });
      });

      // $("#submit2").click(function(){
      //   finaldataSave();
      // });

      $(document).on("click focus",".date",function(){
        var from=$("#f_date").val(); 
        var to=$("#t_date").val();
        if(from.length==0 && to.length==0)
        {
          // $("#date").attr('value','');
          swal("Error","Please select from and to date","error");
        }
        else
        {
          $(".date").attr('min',from);
          $(".date").attr('max',to);
        }     
      });


      $(document).ready(function(){
        $("#doenload").hide();
        $("#xlxyes").click(function () {
            var xlsvalue = $(this).val();
            if (xlsvalue == '1') {
              $("#excel").show();
              $("#upload").show();
              $("#table").hide();
              $("#insertRow").hide();
              $("#doenload").show();
            }
          });
          $("#xlxno").click(function () {
            var xlsvalue = $(this).val();
            if (xlsvalue == '0') {
              $("#excel").hide();
              $("#upload").hide();
              $("#table").show();
              $("#doenload").hide();
              $("#insertRow").show();
              var $el = $('#avtv_excel'); //for refresh excel import field add 21 Apr 
              $el.wrap('<form>').closest('form').get(0).reset(); //add 21 Apr 
              $el.unwrap(); //add 21 Apr  
            }
          });
      });

        function dataSave()
        {
            //$(".btn-submit1").click(function(e){
                //e.preventDefault();
                var data =new FormData($("#AVradioMediaBillingFrm")[0]);
                $.ajax({
                    url: "/savebilling",
                    type:'POST',
                    data: data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            swal("Success","Excel Upload Success","success").then(function () {
                              window.location = '{{ $url }}';
                            });
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
          
            //}); 
        }

        function finaldataSave()
        {
            //$(".btn-submit1").click(function(e){
                //e.preventDefault();
                var data =new FormData($("#AVradioMediaBillingFrm")[0]);
                $.ajax({
                    url: "/finalsavebilling",
                    type:'POST',
                    data: data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            swal("Success","Data Saved  Success","success").then(function () {
                              window.location = '{{ $url }}';
                            });
                        }else{
                            swal("Error","Some error Accoupied","error").then(function () {
                              window.location = '{{ $url }}';
                            });
                            // printErrorMsg(data.error);
                        }
                    }
                });
          
            //}); 
        }
        
       
        function printErrorMsg (msg) {
            
            var obj = JSON.parse(msg);
            $.each(obj, function (key, val) {
              var split_obj = val.split('.');
              var get_id = split_obj[1].split('field');
              $("#msg_"+get_id[0]).html("This field "+get_id[1]);
          });
            
        }
    });








// $(document).ready(function(){
//    $("#add_row").click(function(){
// 		$("#add_davp").append('<div class="row"><div class="col-md-4"><div class="form-group"><label for="agency_contract_details">Date</label><input type="date" name="agency_contract_details" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Time</label><input type="time" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Length (Sec)</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Description</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Copy ID/ISCI Code</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-4"><div class="form-group"><label for="S">Cost</label><input type="text" name="" placeholder="" class="form-control form-control-sm" maxlength="30"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 60px;"><button class="btn btn-danger remove_row mr-1">Remove</button></div></div><br />');
// 	});
//     $("#add_davp").on('click','.remove_row',function(){
//         $(this).parent().parent().remove();
//     });
// });

  function convertImgToBase64(url, callback, outputFormat) {
    var canvas = document.createElement('CANVAS'),
    ctx = canvas.getContext('2d'),
    img = new Image;
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
      var dataURL;
      canvas.height = img.height;
      canvas.width = img.width;
      ctx.drawImage(img, 0, 0);
      dataURL = canvas.toDataURL(outputFormat);
      callback.call(this, dataURL);
      canvas = null;
    };
    img.src = url;
  }

  function encodeImageFileAsURL(element) {
    $('#alert_img_msg').hide();
    function onComplete(data) {
      var time = Date.now();
      var diffImage = new Image();
      diffImage.src = data.getImageDataUrl();

      $("#image-diff").html(diffImage);

      $(diffImage).click(function() {
        var w = window.open("about:blank", "_blank");
        var html = w.document.documentElement;
        var body = w.document.body;

        html.style.margin = 0;
        html.style.padding = 0;
        body.style.margin = 0;
        body.style.padding = 0;

        var img = w.document.createElement("img");
        img.src = diffImage.src;
        img.alt = "image diff";
        img.style.maxWidth = "100%";
        img.addEventListener("click", function() {
          this.style.maxWidth =
          this.style.maxWidth === "100%" ? "" : "100%";
        });
        body.appendChild(img);
      });

      console.log(data.misMatchPercentage);
      // if (data.misMatchPercentage == 0) {
                //$("#thesame").show();
                $('#ImageMatchPercentage').val("100");
                $('#alert_img_compare').show();
                $('#alert_img_compare').removeClass('alert-danger');                
                $('#alert_img_compare').addClass('alert-success');                
                $('#alert_img_compare').text("Both image are same");
                $("#diff-results").show();
            //   } else {
            //    $('#ImageMatchPercentage').val(data.misMatchPercentage);
            //    $('#alert_img_compare').show();
            //    $('#alert_img_compare').addClass('alert-danger');                
            //    $('#alert_img_compare').removeClass('alert-success');   
            //    $('#alert_img_compare').text("The second image is "+data.misMatchPercentage+"% different compared to the first.");
            //    $("#mismatch").text(data.misMatchPercentage);
            //    if (!data.isSameDimensions) {
            //     $("#differentdimensions").show();
            //   } else {
            //     $("#differentdimensions").hide();
            //   }
            //   $("#diff-results").show();

            // }
          }


          var file = element.files[0];
          var filePath1 = $("#img1").val();
          var filePath1_name = $("#img1_name").val();
          if(filePath1_name == "")
          {
            $('#alert_img_msg').show();
          }
          else
          {
            $('#alert_img_msg').hide();
            var filePath2 = URL.createObjectURL(file);
            console.log(filePath1);
            console.log(filePath2);
            var img1 = filePath1,
            img2 = filePath2;
            convertImgToBase64(img1, function(base64Img1) {
              convertImgToBase64(img2, function(base64Img2) {
                if (base64Img1 == base64Img2) {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("same");
                } else {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("diff");
                }

              });
            });
          }

        }
      </script>
      <script>


  //  next and previous function for save 

  $('.alert-success').hide();
  $('.alert-danger').hide();

  // function SaveData() {

  //   var formData = new FormData($('#AVradioMediaBillingFrm')[0]);
  //   $.ajax({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
  //     },
  //     type: "POST",
  //     url: "storebilling/",
  //     data: formData,
  //     dataType: "json",
  //     processData: false,
  //     contentType: false,
  //     success: function(data) {
  //       if (data.success == true) {
  //         $('.alert-success').fadeIn().html(data.message);
  //         setTimeout(function() {
  //           $('.alert-success').fadeOut("slow");
  //           window.location.reload();
  //         }, 5000);

  //       }
  //       if (data.success == false) {
  //         $('.alert-danger').fadeIn().html(data.message);
  //         setTimeout(function() {
  //           $('.alert-danger').fadeOut("slow");
  //         }, 5000);
  //       }
  //     },
  //     error: function(error) {

  //       console.log('error');
  //       //window.location.reload();
  //     }
  //   });


  // }

</script>


<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    //var dateFormat = "mm/dd/yy",
    from = $( "#bill_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    })
    $('#bill_date').click(function() {
      $('#bill_date').datepicker("show");
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#publication_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#publication_date').click(function() {
      $('#publication_date').datepicker("show");
    });
  } );

  //from date
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#from_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#from-date').click(function() {
      $('#from_date').datepicker("show");
    });
  } );

  //to date
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#to_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#to_date').click(function() {
      $('#to_date').datepicker("show");
    });
  } );

 
</script>


<script>

 ////////////// file upload size  512kb ////////////////
 $(document).ready(function() {

  $(".custom-file-input").change(function() {
    var id = $(this).attr("id");
    id.slice(1);
      // console.log(id);
      var file = this.files[0].name;
      var totalBytes = this.files[0].size;
      var sizemb = (totalBytes / (1024*1024));
      var ext = file.split('.').pop();
      if ((file!= "" && sizemb <= 2)){
        $("#" + id + 2).empty();
        $("#" + id + 2).text(file);
        $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");

        $("#" + id + 1).hide();

      } else {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 1).text('File size should be 2MB');
        $("#" + id + 1).show();
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + "-error").addClass("hide-msg");
      }
    });

});


 function uploadFile(i, thiss) {
  var file = thiss.files[0].name;
  var totalBytes =  thiss.files[0].size;
  var sizemb = (totalBytes / (1024*1024));
    // console.log('totalBytes',totalBytes);
    console.log('sizemb',sizemb);
     // console.log('file',file);
     var ext = file.split('.').pop();

    // if ((sizemb <= 2) && (ext == "jpeg" || ext == "jpg" || ext == "png")) 
    if ((file!= "" && sizemb <= 2)) 
    {
      console.log("if");
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } 
    else 
    {
      console.log("hello");
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text(file);
      $("#upload_doc_error" + i).text('File size should be 2MB');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }

  $('.diffdatemsgLabel').removeClass('alert-info-msg');

</script>
<script >
  function checksum(g){
  
    let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(g)

    if(regTest){
      var gstMsg='GST No. is valid format';
       $('.gstvalidationMsg').removeClass('alert-info-msg2');
      $('.gstvalidationMsg').addClass('alert-info-msg');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
      return true;
     //  let a=65,b=55,c=36;
     //  return Array['from'](g).reduce((i,j,k,g)=>{ 
     //   p=(p=(j.charCodeAt(0)<a?parseInt(j):j.charCodeAt(0)-b)*(k%2+1))>c?1+(p-c):p;
     //   return k<14?i+p:j==((c=(c-(i%c)))<10?c:String.fromCharCode(c+b));
     // },0); 
    }else{
      var gstMsg='Enter Valid format GST No. like(18AABCU9603R1ZM)';
      $('.gstvalidationMsg').removeClass('alert-info-msg');
      $('.gstvalidationMsg').addClass('alert-info-msg2');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("");
      return false;

    }
    
}
$(document).ready(function() {
    $('.preventLeftClick').on('click', function(e) {
        e.preventDefault();
        return false;
    });
});

var event = $(".mousedisable").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    e.stopImmediatePropagation();
    return false;
});
</script>

<style type="text/css">
  .multiselect-container {
    overflow-x: scroll;
    height: 400px;
  }

  .multiselect-container>li>a>label {
    height: auto;
  }

  .alert-info-msg2 {
    font-size: 80%;
    color: #ef1721;
}
</style>


<script>
  $(function () {

// Start counting from the third row
var counter = 3;

$("#insertRow").on("click", function (event) {
    event.preventDefault();

    var newRow = $("<tr>");
    var cols = '';

    // Table columns
    // cols +='<input type="hidden" name="RO_No[]" id="RO_No" class="form-control-new" value="{{ @$RO_id->{'RO No_'} }}">';
    // cols +='<input type="hidden" name="gst[]" id="gst" class="form-control-new" value="{{ @$RO_id->{'Vendor GST No_'} ?? '' }}">';

    // cols += '<td><input type="text" name="RO_No[]" id="RO_No" class="form-control" value="{{ @$RO_id->{'RO No_'} }}"></td>';
    cols += '<td>'
    cols+= '<input type="date"  name="date[]"  class="form-control date">';
    cols +='<input type="hidden" name="RO_No[]" id="RO_No" class="form-control-new" value="{{ @$RO_id->{'RO No_'} }}">';
    cols +='<input type="hidden" name="gst[]" id="gst" class="form-control-new" value="{{ @$RO_id->{'Vendor GST No_'} ?? '' }}">';
    cols+='</td>';
    cols += '<td><input type="time" name="time[]"  class="form-control"></td>';
    // cols += '<td><input type="text" name="gst[]" id="gst" class="form-control"></td>';
    cols += '<td><input type="text" name="duration[]"  class="form-control"></td>';
    cols += '<td><input type="text" name="bill_claim_amount[]"  class="form-control"></td>';
    cols += '<td><button class="btn btn-danger rounded-0" id ="deleteRow"><i class="fa fa-trash"></i></button></td>';

    // Insert the columns inside a row
    newRow.append(cols);

    // Insert the row inside a table
    $("table").append(newRow);

    // Increase counter after each row insertion
    counter++;
    console.log(counter);
    $("#countid").val(counter);
 });

// Remove row when delete btn is clicked
$("table").on("click", "#deleteRow", function (event) {
    $(this).closest("tr").remove();
    counter -= 1
});
});



function finaldataSave()
{
    //$(".btn-submit1").click(function(e){
        //e.preventDefault();
        var data =new FormData($("#AVradioMediaBillingFrm")[0]);
        $.ajax({
            url: "/finalsavebilling",
            type:'POST',
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    swal("Success","Data Saved  Success","success").then(function () {
                      window.location = '{{ $url }}';  //route("radiobilling.index")
                    });
                }else{
                    // printErrorMsg(data.error);
                    swal("Error","Some error in time slot","error").then(function () {
                          window.location = '{{ $url }}';
                        });
                }
            }
        });
  
    //}); 
}

$(document).ready(function(){
  //for row delete
  $(document).on("click",".delete",function(){
    var rono=$(this).attr('data-rono');
    var rolineno=$(this).attr('data-rolineno');
    var roline=$(this).attr('data-roline');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      url : '/avBillingDelete',
      type: 'POST',
      data: {rono:rono,rolineno:rolineno,roline:roline},
      success:function(data)
      {
        swal("Success","Data delete  Success","success").then(function () {
          window.location = '{{ $url }}';  //route("radiobilling.index")
        });

        console.log(data);
      }
    });
  });
});
</script>



@endsection