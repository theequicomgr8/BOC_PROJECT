@extends('admin.layouts.layout')
@section('custom_css')
<link href="{{ asset('css/comman-css.css')}}" rel="stylesheet" />

<!-- if((date("Y-m-d") >= $start_date) && (date("Y-m-d") <= $end_date)){ $renewal_readonly='readonly' ; $policy_check='checked' ; $renewal_disabled = 'disabled'; }  -->
@endsection
@section('content')
<!-- /.end card-header -->
<!-- renewal data owner_datas and vendor_datas -->
@php
$renewal_readonly = '';
$renewal_disabled = '';
$policy_check = '';
$start_date = date('Y-m-d', strtotime(@$np_rate_renewal->{'Contract Start Date'}));
$end_date = date('Y-m-d', strtotime(@$np_rate_renewal->{'Contract End Date'}));
$current_date = date('2021-03');
$vendor_datas_contract_end_date = date('Y-m',strtotime(@$vendor_datas->{'Cont_ End Date'}));


$company_change_add=@$vendor_datas->{'Change In Company Address'};

$readonly = 'readonly';

if( (@$np_rate_renewal->{'Application Date'} != '') && (@$np_rate_renewal->{'Application Date'} != '1900-01-01 00:00:00.000') ) {
    $application_date = (@$np_rate_renewal->{'Application Date'} <=$vendor_datas_contract_end_date);
}
else{
  $application_date = 'true';
}

if( ($vendor_datas_contract_end_date >= $current_date) && (@$vendor_datas->{'Status'} == '1') || (@$vendor_datas->{'Status'} == '3')  || (@$vendor_datas->{'Status'} == '6') && (@$application_date) || (@$np_rate_renewal->{'Modification'} == '0') ){
  $disabled = 'disabled';
  $read ='';
  $policy_check = '';
  $renewal_readonly = 'readonly';
}
else{
  $disabled = 'disabled';
  $read = 'readonly disabled';
  $policy_check = 'checked';
  $renewal_readonly = 'readonly';
}

$reg_no = '';
$solid_circulation = '';
$efiling = 'none';
$reg_no_verified = '';
$solid_circulation_verified = '';
$turnover_verified = '';
$date_verified = '';
$rni_regist_no = 'none';
$abc_cert = 'none';
$abc_reg_no_verified = '';

if((@$np_rate_renewal->{'CIR Base'} == 0 || @$vendor_datas->{'CIR Base'} == 0 ) || (@$np_rate_renewal->{'RNI Circulation'} == 1 && @$np_rate_renewal !='')){
$reg_no = @$np_rate_renewal->{'RNI Registration No_'} ?? $vendor_datas->{'RNI Registration No_'} ?? '';
$solid_circulation = $np_rate_renewal->{'circulation'} ?? $vendor_datas->{'Claimed Circulation'} ?? '';
$efiling = 'none';
$rni_regist_no = 'block';
$abc_cert = 'none';
$udin_number = 'none';

$reg_no_verified = @$np_rate_renewal->{'RNI Registration Validation'} ?? $vendor_datas->{'RNI Registration Validation'} ?? '';
$solid_circulation_verified = @$np_rate_renewal->{'RNI Circulation Validation'} ?? $vendor_datas->{'RNI Circulation Validation'} ?? '';
$turnover_verified = @$np_rate_renewal->{'RNI Annual Validation'} ?? $vendor_datas->{'RNI Annual Validation'} ?? '';

$date_verified = $np_rate_renewal->{'RNI Validation Date'} ?? $vendor_datas->{'RNI Validation Date'} ?? '';
}

if((@$np_rate_renewal->{'CIR Base'} == 3 || @$vendor_datas->{'CIR Base'} == 3) || (@$np_rate_renewal->{'ABC Circulation'} == 1 && @$np_rate_renewal !='')){
$solid_circulation = $np_rate_renewal->{'circulation'} ?? $vendor_datas->{'ABC Circulation Number'} ?? '';
$efiling = 'none';
$rni_regist_no = 'none';
$abc_cert = 'block';
$udin_number = 'none';

$abc_reg_no_verified = $np_rate_renewal->{'ABC Registration Validation'} ?? $vendor_datas->{'ABC Registration Validation'} ?? '';
$solid_circulation_verified = $np_rate_renewal->{'ABC Circulation Validation'} ?? $vendor_datas->{'ABC Circulation Validation'} ?? '';

$date_verified = $np_rate_renewal->{'ABC Validation Date'} ?? $vendor_datas->{'ABC Validation Date'} ?? '';
}
if((@$np_rate_renewal->{'CIR Base'} == 1 || @$vendor_datas->{'CIR Base'} == 1) || (@$np_rate_renewal->{'CA Circulation Number'} == 1 && @$np_rate_renewal !='')){
$udin_number = 'block';
$solid_circulation_verified =  @$np_rate_renewal->{'CA Circulation Number'} ?? $vendor_datas->{'CA Circulation Number'} ?? '';
}
//dd($np_rate_renewal);
@endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Application Form for Print Renewal</h6>
      <p>
        @if(@$read != '')
        <a href="{{ url('print-renewal-pdf/'.@$np_rate_renewal->{'NP Code'}) }}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Print Renewal Receipt</a>
        @endif
      </p>
    </div>
    <!-- Card Body -->
    <div class="card-body">
         
      <div style="display: none;" align="center" class="alert alert-success ">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p id="success"></p>
    </div>
      <div style="display: none;" align="center" class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p id="danger"></p>
    </div>

      <form method="POST" enctype="multipart/form-data" autocomplete="off" id="print_fress_emp_renewal">
        {{ csrf_field() }}

        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" id="#tab1">Basic Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab2">Print Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab3">Account Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="#tab4">Upload Document</a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            @include('admin.pages.vendor-print.common-print-renewal.basic-information')
          </div>
          <div id="tab2" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab2-trigger">
            @include('admin.pages.vendor-print.common-print-renewal.print-information')
          </div>
          <div id="tab3" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab3-trigger">
            @include('admin.pages.vendor-print.common-print-renewal.account-information')
          </div>
          <div id="tab4" class="content pt-3 tab-pane" role="tabpanel" aria-labelledby="tab4-trigger">
            @include('admin.pages.vendor-print.common-print-renewal.upload-document')
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.card-body -->
</div>

<!-- /.card -->
@endsection

@section('custom_js')
<script src="{{ url('/js/vendorPrintJs') }}/fresh-em-validation_renewal.js"></script>
<script>
  $(document).ready(function() {
    $("#printing_colour").change(function() {
      if ($(this).val() == 0 && $(this).val() != '') {
        $("#colour_page").show();
      } else {
        $("#colour_pages").val('');
        $("#colour_page").hide();
      }
    });
  });
  $(document).ready(function() {
    $(window).keydown(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
  // start update empanelment form
  function renewalSaveData(id) {
    if ($("#modified").val() == '') {
      if ($("#" + id).val() == 0) {
        $("#" + id).val(1);
      }
      var formData = new FormData($('#print_fress_emp_renewal')[0]);
      $.ajax({
        type: "post",
        url: "{{Route('print-renewal-save')}}",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(data) {
          console.log(data);
          if (data.success == true) {
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);
              $('.alert-success').show();
              $('#success').fadeIn().html(data.message);
              // setTimeout(function() {
              //   $('.alert-success').fadeOut("slow");
              //   window.location.reload();
              // }, 7000);
            }
          }
          if (data.success == false) {
            if (id == 'submit_btn') {
              $("html, body").animate({
                scrollTop: 0
              }, 1000);
              $('.alert-danger').show();
              $('#danger').fadeIn().html(data.message);
              // setTimeout(function() {
              //   $('.alert-danger').fadeOut("slow");
              // }, 7000);
            }
          }
        },
      });
    } else {
      console.log("modified");
    }
    if ($('.gstvalidationMsg').hasClass('alert-info-msg') || $("#GST_No").val() !='') {
      $("#gst_reg_file").removeClass('hide-msg');
    } else {
      $("#gst_reg_file").addClass('hide-msg');
    }
  }
</script>

@endsection
