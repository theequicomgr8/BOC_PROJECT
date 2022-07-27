@extends('layouts.layout')
@section('content')

<div class="form-validation mt-20">
    <h4>OTP Confirm</h4>
    @if(session()->has('set_password'))
    <div class="alert alert-success">
        {{ session()->get('set_password') }}
    </div>
    @endif
    @if(session()->has('otp_message'))
    <div class="alert alert-success">
        {{ session()->get('otp_message') }}
    </div>
    @endif
    <form method="post" action="{{ route('signupConfirm') }}">
        @csrf
        <div id="resetform01" class="show">
            <div id="crederror"></div>
            {{-- <input type="hidden" id="csrf" value="{{Session::token()}}"> --}}
            <div class="form-group">
                <div class="form-group"><i class="fa fa-user"></i>
                    <input name="email" type="hidden" id="email" tabindex="0" value="{{ Session()->get('email_for_otp') }}" class="form-control underline-input" placeholder="Enter Email">
                    <span id="emailerror"></span>
                </div>
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input name="email_otp" type="text" id="email_otp" class="form-control underline-input" placeholder="Enter Your Email OTP" maxlength="4">
                    <span id="moberror"></span>
                </div>
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input name="mobile_otp" type="text" id="mobile_otp" class="form-control underline-input" placeholder="Enter Your Mobile OTP" maxlength="4" disabled="disabled" style="background: #c3c3c3;">
                    <span id="moberror"></span>
                </div>
                <div class="form-group text-left">
                    <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3">
                    <a href="/resendotp" style="color: blue;"><i class="fa fa-user"></i> Resend OTP</a>
                </div>
            </div>
        </div>
    </form>
    <!-- <a href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a> &nbsp;&nbsp; -->
    
    @endsection