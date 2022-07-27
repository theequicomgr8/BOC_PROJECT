@extends('layouts.layout')
@section('content')
<?php
$current_url = last(request()->segments());
?>
<style>
  .av {
    display: none;
  }

  .outdoor {
    display: none;
  }

  .newMedia {
    display: none; 
  }
</style>
<div class="form-validation mt-20">
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="text-danger text-center">{{$error}}</div>
  @endforeach
  @endif
  <h4 class="text-right">
    {{'Sign up'}}
  </h4>
  <form method="POST" id="signup-form" action="{{URL::to($current_url)}}">
    @csrf
    <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
    <div class="form-group">

      <select name="wing" class="form-control wing underline-input wing_type">
        <option value="">Select Vendor/Partner Category</option>
        <option value="3">Print</option>
        <option value="2">AV</option>
        <option value="1">Outdoor Media</option>
        <option value="4">New Media</option>
        <option value="11">Printed Publicity</option>
      </select>
    </div>
    <div class="form-group" id="wing_type_av">
      <select name="av" class="form-control av underline-input wing_type">
        <option value="">Select Wings Type</option>
        <option value="4">TV</option>
        <option value="5">Private FM</option>
        <option value="7">AV-Producer</option>
      </select>
    </div>
    <div class="form-group" id="wing_type_outdoor">
      <select name="outdoor" class="form-control  outdoor underline-input wing_type">
        <option value="">Select Wings Type</option>
        <option value="0">Outdoor</option>
        <option value="1">Personal</option>
      </select>
    </div>
    <div class="form-group" id="wing_type_media">
      <select name="media" class="form-control newMedia underline-input wing_type">
        <option value="">Select Wings Type</option>
        <option value="8">Digital Cinema</option>
        <option value="9">Internet Website</option>
        <option value="10">Bulk SMS</option>
      </select>
    </div>
    <input type="hidden" name="wing_type" id="wing_type" class="select1">

    <div class="form-group"><i class="fa fa-envelope" aria-hidden="true"></i>
      <input type="text" name="email" id="email" value="{{old('email')}}" tabindex="0" class="form-control underline-input" placeholder="Enter Email">
    </div>
    <div class="form-group" id="mobile_section"><i class="fa fa-mobile" aria-hidden="true" style="font-size: 23px;top: 10px !important;"></i>
      <input type="text" name="mobile" id="mobile" value="{{old('mobile')}}" maxlength="10" tabindex="0" class="form-control underline-input" placeholder="Enter Mobile Number" onkeypress="return checkNumberOnly(event)" maxlength="10">
    </div>
    <div class="form-group" id="gst_section" style="display: none;"><i class="fa fa-user"></i>
      <input name="gst" type="text" id="gst" tabindex="0" class="form-control underline-input" placeholder="Enter GST Number">
      <span id="GST_No_Error"></span>
    </div>
    <div class="form-group mb-0">
      <div class="row">
        <div class="col-md-12">
          <button type="submit" id="signup" class="btn btn-greensea b-0 br-2 pull-right mr-0 signup-form">Sign up</button>
        </div>
        <div class="col-md-6">
        </div>
      </div>
    </div>
    <hr style="display: inline-block; width: 100%; margin: 0 0 2px 0 " />
  </form>
  <a class="new-registration-link" href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a>
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js/authJs/adminJs') }}/register.js"></script>
@endsection