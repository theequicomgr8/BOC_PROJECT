@extends('admin.layouts.layout')

@section('content')

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary">Vendor Rate Offered</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
    @if(session()->has('status_msg') == true)
      <div align="center" class="alert alert-success">
        {{ session()->get('message') }}
      </div>
      @else
      @if(session()->get('message'))
      <div align="center" class="alert alert-danger">
        {{ session()->get('message') }}
      </div>
      @endif
      @endif

      <form method="POST" action="{{Route('vendor-rate-status-update')}}" autocomplete="off" id="rate_form">
        {{ csrf_field() }}
        <div class="tab-content">
          <div class="content pt-3 tab-pane active show" role="tabpanel">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="Newspaper_name">Newspaper Name / समाचार पत्र का नाम<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="Newspaper_name" name="Newspaper_name" placeholder="Newspaper Name" maxlength="40" value="{{ $data['Newspaper Name'] ?? '' }}" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="rate">Current Rate / वर्तमान दर<font color="red">*</font></label>
                  <input type="text" class="form-control form-control-sm" id="rate" name="rate" maxlength="50" placeholder="Current Rate" value="{{@$data != '' ? number_format((float)$data['Rate'], 2, '.', '') : '' }}" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="rate_status">Rate Status / दर स्थिति<font color="red">*</font></label>
                  <select id="rate_status" name="rate_status" class="form-control form-control-sm" {{@$data['Rate Remark'] != '' ? 'readonly':''}}>
                    <option value="">Select Status</option>
                    <option value="1" {{@$data['Rate Status'] == 1  ? 'selected' : ''}}>Agree</option>
                    <option value="0" {{@$data['Rate Status'] == 0 && @$data['Rate Remark'] !='' ? 'selected' : ''}}>Not Agree</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="rate_remark">Rate Remark / दर टिप्पणी<font color="red">*</font></label>
                  <textarea name="rate_remark" id="rate_remark" maxlength="220" placeholder="Enter Rate Remark" rows="2" cols="50" class="form-control  form-control-sm" {{@$data['Rate Remark'] != '' ? 'readonly':''}}>{{ $data['Rate Remark'] ?? '' }}</textarea>
                </div>
              </div>
              <div class="col-md-8"></div>
              <button type="submit" class="btn btn-primary" style="margin-left: 13px;" {{@$data == '' || @$data['Rate Remark'] != '' ? 'disabled':''}}>Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.content-->
@endsection

@section('custom_js')
<script>
$(document).ready(function () {
  $("form").on('submit', function() {
    var form = $("#rate_form");
    form.validate({
      rules: {
        rate_status: {
          required: true
        },
        rate_remark: {
          required: true
        }       
      },
      messages: {
        rate_status: {
          required: "Please fill required field!"
        },
        rate_remark: {
          required: "Please fill required field!"
        }        
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
      }
    });
    if (form.valid() === false) {
      return false;
    }
  });
 

});
</script>
@endsection
