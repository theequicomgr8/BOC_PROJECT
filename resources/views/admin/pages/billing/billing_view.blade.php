@extends('admin.layouts.layout')
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
  .label-width {
      width: 50%;
  }
</style>
@section('content')
@php
    $results = isset($response) ? $response:'';
    //dd($results);
@endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>Bill Submission : </h6>
      {{-- <a href="{{ url('billingPrintPDF/' . Request::segment(3)) }}" id="download"
      style="background:#006799; color:#fff; text-decoration:none; font-size:11px; border-radius: 15px; font-family: sans-serif; padding:8px 20px; text-transform: uppercase;">Download Report</a> --}}

      <div class="col-xl-6">
        @if(Session::has('UserName'))
        <a href="{{route('billing.billingPDF',['NPCode'=>$results->{'NP Code'},'ROCode'=>$results->{'RO No_'},'BillingStatus' => '1'])}}" class="btn btn-info" style="float: right;font-size: 13px;"><i class="fa fa-download"></i> Download Reports</a>
        @endif
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" class="billingFrm" id="billingFrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row">
                <div class="col-md-6" >
                    <div class="form-group">
                      <label class="form-control-label label-width">Bill No. :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Vendor Bill No_'}?>" readonly>
                      {{-- <label for="">{{ $results->{'Vendor Bill No_'} }}</label> --}}
                    </div>
                  </div>
                    <div class="col-md-6" >
                    <div class="form-group">
                      <label class="form-control-label label-width">Control No. :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Control No_'}?>" readonly>
                      {{-- <label for="">{{ $results->{'Control No_'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Bill Date :</label>
                      <input type="text" name="ds" id="1" value="<?= date('d-m-Y', strtotime($results->{'Vendor Bill Date'})) ?>" readonly>
                      {{-- <label for="">{{ $results->{'Vendor Bill Date'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Publication Date :</label>
                      <input type="text" name="ds" id="1" value="<?= date('d-m-Y', strtotime($results->{'Publishing Date'}))?>" readonly>
                      {{-- <label for="">{{ $results->{'Publishing Date'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label class="form-control-label label-width">GST No. :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Vendor GST No_'} ?>" readonly>
                     {{-- <label for="">{{ $results->{'Vendor GST No_'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Published In :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Billing Advertisement Type'} == 'Color' ? 'Color' : 'Black & white' ?>" readonly>
                      {{-- <label for="">{{ $results->{'Billing Advertisement Type'} == 'Color' ? 'Color' : 'Black & white'}}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Page No. on which Ad. Published :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Page No_'} ?>" readonly>
                      {{-- <label for="">{{ $results->{'Page No_'} }}</label> --}}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label class="form-control-label label-width">Advertisement Length(in CMS) :</label>
                      <input type="text" name="ds" id="1" value="<?= round($results->{'Advertisement Length'}, 2) ?>" readonly>
                      {{-- <label for="">{{ round($results->{'Advertisement Length'}),2 }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Width(In CMS) :</label>
                      <input type="text" name="ds" id="1" value="<?= round($results->{'Advertisement Width'}, 2)  ?>" readonly>
                      {{-- <label for="">{{ round($results->{'Advertisement Width'}),2 }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Difference in Sq. :</label>
                      <input type="text" name="ds" id="1" value="<?= round($results->{'Advertisement Diff_'}, 2) ?>" readonly>
                      {{-- <label for="">{{ round($results->{'Advertisement Diff_'}),2 }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Claimed Amount :</label>
                      <input type="text" name="ds" id="1" value="<?= round($results->{'Bill Claim Amount'}, 2)  ?>" readonly>
                     {{-- <label for="">{{ round($results->{'Bill Claim Amount'}),2 }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Bill Officer Name :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Bill Officer Name'}  ?>" readonly>
                      {{-- <label for="">{{ $results->{'Bill Officer Name'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Bill Officer Designation :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Bill Officer Designation'}  ?>" readonly>
                      {{-- <label for="">{{ $results->{'Bill Officer Designation'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">E-mail ID :</label>
                      <input type="text" name="ds" id="1" value="<?= $results->{'Email Id'}  ?>" readonly>
                      {{-- <label for="">{{ $results->{'Email Id'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Auth. Signatory Name :</label>
                      <input type="text" name="ds" id="1" value="<?=$results->{'Bill Submitted By'}  ?>" readonly>
                      {{-- <label for="">{{ $results->{'Bill Submitted By'} }}</label> --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="form-control-label label-width">Auth. Signatory Designation :</label>
                     <input type="text" name="ds" id="1" value="<?=$results->{'Bill Submitted - Designation'}  ?>" readonly>
                     {{-- <label for="">{{ $results->{'Bill Submitted - Designation'} }}</label> --}}
                   </div>
                   </div>
                  <!-- start np image upload file-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label label-width">Upload Newspaper Image :</label>
                     <label for=""><a href="{{ asset('uploads/billing/'.$results->{'NP Img FileName'}) }}" target="_blank">View Document</a></label>
                    </div>
                  </div><!--end np img div upload file end-->
                  <!-- start upload file of adverttisement -->
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label class="form-control-label label-width">Upload Advertisement Image :</label>
                      <label for=""><a href="{{ asset('uploads/billing/'.$results->{'Advertisement Img FileName'}) }}" target="_blank">View Document</a></label>
                    </div>
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
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endsection
@section('custom_js')
@endsection
