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
    form i{
        cursor: pointer;
    }
</style>
<div class="form-validation mt-20">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="text-danger text-center">{{$error}}</div>
    @endforeach
    @endif
    @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{ session()->get('success_message') }}
    </div>
    @endif
    @if(session()->has('otp_success'))
    <div class="alert alert-success">
        {{ session()->get('otp_success') }}
    </div>
    @endif
    <!-- <h4>Client/ Partner Login</h4> -->
    <h4 class="text-right">
        @if(last(request()->segments())=='rob-login')
        {{'ROB-LOGIN'}}
        @else
        {{'Sign in'}}
        @endif
    </h4>
    @if(last(request()->segments())=='rob-login')
    <form method="POST" action="{{URL::to($current_url)}}" id="login-form">
        @csrf
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" onkeypress="return alphadash(event,this);" class="form-control underline-input" placeholder="User Name">

        </div>

        <div class="form-group"><i class="fa fa-eye-slash" id="togglePassword"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Password">
        </div>

        <div class="form-group text-left">
            <button type="submit" class="btn btn-greensea b-0 br-2 pull-right mr-0 login-form">Login</button>
        </div>
    </form>
    @elseif(last(request()->segments())=='vendor-login')
    <!-- client / vendor login-->
    <form method="POST" action="{{URL::to($current_url)}}" id="login-form">
        @csrf
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
        <div class="form-group">
            <select name="login_type" id="login_type" class="form-control underline-input select1">
                <option value="">Select Login Type</option>
                <option value="2">GST</option>
                <option value="3">User ID</option>
                <option value="4">Agency Code</option>
            </select>
        </div>
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">

        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input vendorlogintypeplace" placeholder="Select login type">
            <span id="email-error"></span>
        </div>

        <div class="form-group"><i class="fa fa-eye-slash" id="togglePassword"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Enter Password">
        </div>

        <div class="form-group text-left">
            <input type="submit" value="Login" class="btn btn-greensea b-0 br-2 pull-right mr-0 login-form">
            <a href="{{url('reset-password')}}" class="frgt">Forgot password?</a>
        </div>

    </form><!-- end client / vendor login-->
    <hr style="display: inline-block; width: 100%; margin-bottom: 2px;" />
    <a class="new-registration-link" href="{{URL::to('vendor-signup')}}"><i class="fa fa-user"></i> New Vendor Registration</a><br>
    @if(session()->has('email_verified') && session('email_verified') == 0)
    <a href="{{url('signup_confirm')}}"> <i class="fa fa-user"></i> Email Verification</a>
    @endif
    @else
    <!-- client / vendor login-->
    <form method="POST" action="{{URL::to($current_url)}}" id="login-form">
        @csrf
        <input id="userTypeHidden" type="hidden" name="userTypeHidden" value="{{request()->user_type}}">
        <div class="form-group"><i class="fa fa-user"></i>
            <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="Enter User ID">
            @error('email')
            {{'Only Alpha Character'}}
            @enderror
        </div>
        <div class="form-group"><i class="fa fa-eye-slash" id="togglePassword"></i>
            <input name="password" type="password" id="password" class="form-control underline-input" placeholder="Enter Password">
        </div>
        <div class="form-group text-left ">
            <input type="submit" value="Login" class="btn btn-greensea b-0 br-2 pull-right mr-0 login-form">
            @if(last(request()->segments())=='vendor-login')
            <a href="{{url('reset-password')}}" class="frgt">Forgot password?</a>
            @endif
        </div>
    </form><!-- end client / vendor login-->
    @endif
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js/authJs/adminJs') }}/login.js"></script>
<script>
    
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.remove('fa-eye-slash');
    this.classList.toggle("fa-eye");
});

</script>

@endsection