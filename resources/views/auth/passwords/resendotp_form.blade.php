@extends('layouts.layout')
@section('content')
<div class="form-validation mt-20">
    @if(session()->has('error_msg'))
    <div class="text-danger text-center">
        {{ session()->get('error_msg') }}
    </div>
    @endif
    <h4>Resend OTP</h4>
    <form method="post" action="{{ route('resendotp_post') }}">
        @csrf
        <div id="resetform01" class="show">
            <div id="crederror"></div>
            {{-- <input type="hidden" id="csrf" value="{{Session::token()}}"> --}}
            <div class="form-group">
                <div class="form-group"><i class="fa fa-user"></i>
                    <input name="email" type="text" id="email" tabindex="0" class="form-control underline-input" placeholder="Enter Email">
                    <span id="emailerror"></span>
                </div>
                <div class="form-group"><i class="fa fa-unlock-alt"></i>
                    <input type="text" name="mobile" id="mobile" maxlength="10" class="form-control underline-input" placeholder="Enter Your Number" onkeypress="return checkNumberOnly(event)">
                    <span id="moberror"></span>
                </div>
                <div class="form-group dp_ful captcha">
                </div>
                <div class="form-group text-left">
                    <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3">
                </div>
            </div>
        </div>
    </form>
    <!-- <a href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a> &nbsp;&nbsp; -->
</div>
@endsection
@section('custom_js')
<script>
    function checkNumberOnly(event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    }
</script>
@endsection