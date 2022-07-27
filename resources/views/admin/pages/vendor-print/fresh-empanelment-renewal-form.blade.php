@extends('admin.layouts.layout')

@section('content')

@php 
@$read ='';
$current_date = date('Y-m-d');
$vendor_datas_contract_end_date = date('Y-m-d',strtotime(@$vendor_datas->{'Cont_ End Date'}));
if( (@$np_rate_renewal->{'Application Date'} != '') && (@$np_rate_renewal->{'Application Date'} != '1900-01-01 00:00:00.000') ) {
    $application_date = (@$np_rate_renewal->{'Application Date'} <=$vendor_datas_contract_end_date);
}
else{
  $application_date = 'true';
}

if( ($vendor_datas_contract_end_date <= $current_date) && (@$application_date) || (@$np_rate_renewal->{'Modification'} == '0') ){
  $read ='';
}
else{
  $read = 'readonly disabled';
}
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-inside p-3">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Print Renewal</h6>
        <p>
        @if(@$read != '')
        <a href="{{ url('print-renewal-pdf/'.@$np_rate_renewal->{'NP Code'}) }}" class="m-0 font-weight-normal text-primary"><i class="fa fa-download"></i> Print Renewal Receipt</a>
        @endif
      </p>
      </div>
      <!-- /.end card-header -->
      
      @if(@$status)
      <div align="center" style="color:red">
      {{ @$status }}
            </div>
      @endif
      <!-- @if(session()->has('status'))
            <div align="center" style="color:red">
              {{ session()->get('message') }}
            </div>
            @endif -->
      
      <form method="post" action="{{url('print-renewal')}}" autocomplete="off">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="content pt-3 tab-pane active show" role="tabpanel">
            <div class="row" style="margin:0">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                @if(session()->has('status'))
                <div align="center" style="color:red">
                  {{ session()->get('message') }}
                </div>
                @endif
                <div class="form-group">
                  <label for="publication">RNI E-Filing No. / आरएनआई ई-फिलिंग नं<font color="red">*</font></label>
                  <input type="text" name="rni_efiling_no" required maxlength="19" placeholder="Enter RNI E-filing Number" class="form-control  form-control-sm" id="rni_efiling_no" value="">
                  @if ($errors->has('np_code'))
                  <span class="text-danger">{{ $errors->first('np_code') }}</span>
                  @endif
                </div>
                @php
                  $dm_date = '1753-01-01';
                  
                  if(@$np_rate_renewal->{'DM Declaration Date'} != ''){

                  $dm_date = date('Y-m-d', strtotime(@$np_rate_renewal->{'DM Declaration Date'}));

                  }elseif( @$vendor_datas->{'DM Declaration Date'} != ''){

                  $dm_date = date('Y-m-d', strtotime(@$vendor_datas->{'DM Declaration Date'}));

                  }
                  @endphp
                <div class="form-group">
                <label for="dm_declaration_date">DM Declaration Date / डीएम घोषणा तिथि </label>
                <input type="date" name="dm_declaration_date" class="form-control  form-control-sm" id="dm_declaration_date" value="{{$dm_date}}" readonly>
                 
                </div>
                <div class="form-group clearfix">
                    <label for="latest_dm_cert"> Is there any Changes on DM Declaration? / क्या डीएम की घोषणा में कोई बदलाव है? </label>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="latest_dm_cert2" name="latest_dm_cert" value="0"  <?= (@$np_rate_renewal->{'DM Declaration'} == 0  ? "checked" : ""); ?> >
                      <label for="latest_dm_cert2">No / नहीं</label>
                    </div>&nbsp;&nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="latest_dm_cert1" name="latest_dm_cert" value="1"  <?= (@$np_rate_renewal->{'DM Declaration'} == 1  ? "checked" : ""); ?> >
                      <label for="latest_dm_cert1">Yes / हाँ </label>
                    </div>
                  </div>
                  <div class="form-group" style="display:none;" id="latest_dm">
                <label for="latest_dm_declaration_date"> Latest DM Declaration Date / नवीनतम डीएम घोषणा तिथि</label>
                @php  $current_date = date('Y-m-d'); @endphp
                <input type="date"  name="latest_dm_declaration_date"  max="{{$current_date}}" class="form-control  form-control-sm" id="latest_dm_declaration_date" value="" >
                 
                </div>
              </div>

             

              <div class="col-md-4"></div>
              <div class="col-md-12" style="text-align: center;">
              <button type="submit" class="btn btn-primary submit-button btn-sm m-0">Submit</button>
            </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.card-body -->
      </form>

    </div>
    <!-- /.card -->
  </div>
  <!-- /.content-inside -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom_js')
<script>
  $(document).ready(function () {
  $("#latest_dm_cert1").on('click', function () {
    // alert();
    var latest_dm = $("#latest_dm_cert1").val();
  //  console.log(latest_dm);
    if (latest_dm == 1) {
      $("#latest_dm").show();     
      $('#latest_dm_declaration_date').prop('required','true');
    }else{
      $("#latest_dm").hide();
      $('#latest_dm_declaration_date').prop('required','');     
    }
  });
  $("#latest_dm_cert2").on('click', function () {
    // alert();
    var latest_dm = $("#latest_dm_cert2").val();
   console.log(latest_dm);
    if (latest_dm == 0) {
      $("#latest_dm").hide();      
      $('#latest_dm_declaration_date').prop('required','');
    }else  {
      $("#latest_dm").show();
      $('#latest_dm_declaration_date').prop('required','true');     
    }
  });
});
  </script>
@endsection