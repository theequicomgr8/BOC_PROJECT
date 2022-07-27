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

  .table thead th {
    font-size: 13px;
    color: #444 !important; 
  }

  .table td,
  .table th {
    padding: 0.45rem !important;
    font-size: 14px;
  }

  .fieldset-border {
    margin: 0 10px 15px 0px !important;
  }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit" aria-hidden="true"></i> Outdoor Media Empanelment Form</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <input type="hidden" name="ODGSTID" id="ODGSTID" value="{{ Session('ODGSTID') }}">
      <input type="hidden" name="IFSCCODE" id="IFSCCODE" value="{{ Session::get('IFSCCODE') }}">
      @if(!Session('ODGSTID'))
      <div class="alert alert-warning">
        Please Complete Your Company Details !! Click Here to Fill Company Details <a href="/company-details" style="color: red;">Click</a>
      </div>
      @endif
      @if(!Session('IFSCCODE'))
      <div class="alert alert-warning">
        Please Complete Your Account Details !! Click Here to Fill Account Details <a href="/account-details" style="color: red;">Click</a>
      </div>
      @endif
      <div class="alert alert-success" id="show_msg" style="display: none;">
        <div align="center" class="alert alert-success text-primary" id="show_msg2"></div>
      </div>
      <div align="center" class="alert alert-danger" style="display: none;"></div>
      <!--  here form-->
      <form enctype="multipart/form-data" id="outdoor_media_form" autocomplete="off">
        @csrf
        <div class="tab-content">
          <div id="tab1" class="content pt-3 tab-pane active show" role="tabpanel" aria-labelledby="tab1-trigger">
            <!-- your steps content here -->
            <div id="details_of_owner">
              @include('admin.pages.outdoor-media.common.media-address')
              @include('admin.pages.outdoor-media.common.authority-details')
              @include('admin.pages.outdoor-media.common.work-done')
              <fieldset class="fieldset-border">
                <legend> Upload Document / दस्तावेज़ अपलोड करें</legend>
                <strong><font color="red">All documents should be in PDF format and should not exceed with 2MB size.</font></strong>
                <div class="row">
                @include('admin.pages.outdoor-media.common.upload-doc')
                </div>
              </fieldset>
              <!--  file upload end  -->
              <!--  App section start  -->
              <fieldset class="fieldset-border">
                <legend> Submit Location Data</legend>
                <div class="text-center">
                  <h6>Please submit location data through App</h6>
                  <div>
                    <a href="#"><img src="{{url('img/android.png')}}" style="height: 50px;"></a>
                    <!-- <a href="#"><img src="{{url('img/ios.png')}}" style="height: 65px;"></a> -->
                  </div>
                </div>
              </fieldset>
              <!-- App section end -->
            </div>
          </div>
          <input type="hidden" name="doc[]" id="doc_data">
          <input type="hidden" value="{{ @$vendor_data[0]['OD Media ID'] }}" name="EMP_OD_Media_ID" id="EMP_OD_Media_ID">
          <a class="btn btn-primary btn-sm m-0" id="submit_form" style="float: right;"><i class="fa fa-save"></i> Submit </a>
        </div>
      </form>
    </div>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection

@section('custom_js')
<script src="{{ url('/js/outdoorMediaJs') }}/outdoor-media-validation.js"></script>
<script src="{{ url('/js/outdoorMediaJs') }}/sole-right-comman.js"></script>
<script src="{{ url('/js/outdoorMediaJs') }}/location-validation.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function formSubmit() {
    var data = new FormData($("#outdoor_media_form")[0]);
    $.ajax({
      type: 'POST',
      url: 'outdoor-media-empanelment-save',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        swal(" ", "Reference No. " + data.media_id + "\n Your data has been saved successfully. Please upload image through app", "info").then(function() {
          window.location = 'outdoor-media-list';
        });
      }
    });
  }
</script>
@endsection