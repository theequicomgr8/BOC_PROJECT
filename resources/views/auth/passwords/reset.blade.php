@extends('layouts.layout')
<style>
    .hide {
        display: none;
    }
    form i {
        cursor: pointer;
    }
</style>
@section('content')
<div class="form-validation mt-20">
    <!-- <h4>Client/ Partner Login</h4> -->
    <h4 class="text-right">Forgot Password</h4>
    <!-- client / vendor reset form-->

    <div id="resetform01" class="show">
        <form method="post" id="reset-form">
            <div id="crederror"></div>
            <input type="hidden" id="csrf" value="{{Session::token()}}">
            <div class="form-group">
                <div class="form-group"><i class="fa fa-user"></i>
                    <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="Enter Email">
                    <span id="emailerror"></span>
                </div>
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input name="mobile" type="text" id="mobile" class="form-control underline-input" maxlength="10" placeholder="Enter Mobile" onkeypress="return checkNumberOnly(event)">
                    <span id="moberror"></span>
                </div>
                <div class="form-group dp_ful captcha">
                </div>
                <div class="form-group text-left">
                    <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3">
                </div>
            </div>
            <!-- <a style="text-shadow: 0px 1px 5px #fff;" class="new-registration-link" href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Login</a> -->
        </form><!-- end client / vendor  reset form-->
    </div><!-- end client / vendor  reset form-->

    <!-- client / vendor otp form-->
    <div id="otpdiv" class="hide">
        <form method="post" id="otp-form">
            <div id="otperror"></div>
            <div class="alert alert-success" id="credotp"></div>
            <div class="form-group">
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input type="text" name="email_otp" id="email_otp" class="form-control underline-input" placeholder="Enter Email OTP" maxlength="4"><span id="email_otperr"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input type="text" name="mobile_otp" id="mobile_otp" class="form-control underline-input" placeholder="Enter Mobile OTP" maxlength="4" disabled="disabled" style="background: #c3c3c3;"><span id="mobile_otperr"></span>
                </div>
            </div>
            <div class="form-group text-left ">
                <input type="submit" value="Submit" id="otpSubmit" class="btn btn-greensea b-0 br-2 mr-3">
            </div>
        </form><!-- end client / vendor  otp form-->
    </div><!-- end client / vendor  otp form-->
    <!-- client / vendor newpassword form-->
    <div id="newpassdiv" class="hide">
        <form method="post" id="newpassword-form">
            <div class="alert alert-success" id="credpass" style="display: none;"></div>
            <div class="alert alert-danger" id="passnotmatch" style="display: none;color:red"></div>
            <div class="form-group">
                <div class="form-group" id="pwd-container"><i class="fa fa-eye-slash" id="togglePassword"></i>
                    <input type="password" name="npassword" id="npassword" class="form-control underline-input" placeholder="Password" onkeydown="return showProgressbar(this.value)"><span id="passerror"></span>
                    <div class="col-sm-12 mt-1">
                        <div class="pwstrength_viewport_progress"></div>
                    </div>
                </div>
                <div class="row">
                    <div id="messages" class="col-sm-12"></div>
                </div>
                <div class="form-group" id="pwd-container"><i class="fa fa-eye-slash" id="toggleConfiPassword"></i>
                    <input type="password" name="confpassword" id="confpassword" class="form-control underline-input" placeholder="Confirm Password"><span id="confpasserror"></span>
                </div>
                <div class="form-group dp_ful captcha">
                </div>
                <div class="form-group text-left">
                    <input type="submit" value="Submit" id="newpassSubmit" class="btn btn-greensea b-0 br-2 mr-3" disabled>
                </div>
            </div>
        </form><!-- end client / vendor  newpassword form-->
    </div><!-- end client / vendor  newpassword form-->
</div>
@endsection
@section('custom_js')
<script src="{{ url('/js/authJs/adminJs') }}/reset.js"></script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#npassword");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.remove('fa-eye-slash');
    this.classList.toggle("fa-eye");
});
const toggleConfiPassword = document.querySelector("#toggleConfiPassword");
const confpassword = document.querySelector("#confpassword");

toggleConfiPassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = confpassword.getAttribute("type") === "password" ? "text" : "password";
    confpassword.setAttribute("type", type);
    
    // toggle the icon
    this.classList.remove('fa-eye-slash');
    this.classList.toggle("fa-eye");
});
</script>
@endsection