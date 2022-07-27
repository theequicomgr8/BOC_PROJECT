@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;
  }
</style>
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Application Fees </h6>
    </div>
    <div class="card-body">
      @if($errors->any())
      <div class="alert alert-danger" align="center">
        {{$errors->first()}}
      </div>
      @endif
      <form id="myForm" action="{{url('vendor-payment-bharatkosh')}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="amount">Amount / राशि <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="amount" id="amount" placeholder="Enter Amount">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email">Email ID / ईमेल आईडी <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="email" id="email" value="{{ $owner_data->{'Email ID'} ?? '' }}" placeholder="Enter Email ID">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_fname">Billing First Name / बिल पहला नाम <font color="red">*</font></label>
              @php
              $name_arr = explode(" ",$owner_data->{'Owner Name'});
              $last_name = $name_arr[count($name_arr) -1];
              $first_name = trim(str_replace ($last_name, '', $owner_data->{'Owner Name'}));
              if($first_name == '' || count($name_arr) == 1){
              $first_name = $name_arr[0];
              }
              @endphp
              <input class="form-control form-control-sm" type="text" name="bill_fname" id="bill_fname" value="{{ @$first_name ?? '' }}" placeholder="Enter First Name">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_lname">Billing Last Name / बिल अंतिम नाम <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="bill_lname" id="bill_lname" value="{{ @$last_name ?? '' }}" placeholder="Enter Last Name">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_mobile">Billing Mobile No. / बिल मोबाइल नंबर <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="bill_mobile" id="bill_mobile" value="{{ $owner_data->{'Mobile No_'} ?? '' }}" maxlength="10" placeholder="Enter Mobile">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_address">Billing Address / बिल भेजने का पता <font color="red">*</font></label>
              <textarea class="form-control form-control-sm" name="bill_address" id="bill_address" placeholder="Enter Address">{{ $owner_data->{'Address 1'} ?? '' }}</textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_pincode">Billing Pin Code / बिलिंग पिन कोड <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="bill_pincode" id="bill_pincode" maxlength="6" placeholder="Enter Pincode">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_country">Billing Country / बिलिंग देश <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="bill_country" id="bill_country" value="INDIA">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_state">Billing State / बिलिंग राज्य <font color="red">*</font></label>
              <select id="bill_state" name="bill_state" class="form-control form-control-sm">
                <option value="">Select State</option>
                @if(count($states) > 0)
                @foreach($states as $statesData)
                <option value="{{ $statesData['Code'] }}" {{ $owner_data->{'State'} == $statesData['Code'] ? 'selected' : ''}}>
                  {{$statesData['Description']}}
                </option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bill_city">Billing City / बिलिंग सिटी <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="bill_city" id="bill_city" value="{{ $owner_data->{'City'} ?? '' }}" placeholder="Enter City">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="icheck-success d-inline">
                <input type="checkbox" class="form-control form-control-sm" name="same_as_bill" id="same_as_bill">
                <label for="same_as_bill"> &nbsp;Same As Billing Address / बिलिंग पते के समान</label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_fname">Shipping First Name / शिपिंग पहला नाम <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_fname" id="ship_fname" placeholder="Enter First Name">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_lname">Shipping Last Name / शिपिंग अंतिम नाम <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_lname" id="ship_lname" placeholder="Enter Last Name">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_mobile">Shipping Mobile No. / शिपिंग मोबाइल नंबर <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_mobile" id="ship_mobile" maxlength="10" placeholder="Enter Mobile">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_address">Shipping Address / शिपिंग पता <font color="red">*</font></label>
              <textarea class="form-control form-control-sm" name="ship_address" id="ship_address" placeholder="Enter Address"></textarea>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_pincode">Shipping Pin Code / शिपिंग पिन कोड <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_pincode" id="ship_pincode" maxlength="6" placeholder="Enter Pincode">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_country">Shipping Country / शिपिंग देश <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_country" id="ship_country" value="INDIA">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_state">Shipping State / शिपिंग राज्य <font color="red">*</font></label>
              <select id="ship_state" name="ship_state" class="form-control form-control-sm">
                <option value="">Select State</option>
                @if(count($states) > 0)
                @foreach($states as $statesData)
                <option value="{{ $statesData['Code'] }}">
                  {{$statesData['Description']}}
                </option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="ship_city">Shipping City / शिपिंग सिटी <font color="red">*</font></label>
              <input class="form-control form-control-sm" type="text" name="ship_city" id="ship_city" placeholder="Enter City">
            </div>
          </div>
        </div>
        <!-- /.row -->
        <input type="submit" class="btn btn-primary" value="Proceed" name="submit" id="submit" style="float: right;">
      </form>
    </div>
    <!-- /.card-body -->
  </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('custom_js')
<script src="{{ url('/js') }}/vendor-payment.js"></script>
@endsection