@extends('layouts.layout')
@section('content')
<div class="form-validation mt-20">
    <h4>Set Password</h4>
    @if(!empty($set_password) && $status == 1)
    <div class="alert alert-success">
        {{ $set_password }}
    </div>
    @endif
    @if(!empty($set_password2) && $status == 1)
    <div class="alert alert-danger">
        {{ $set_password2 }}
    </div>
    @endif
    <!-- client / vendor reset form-->
    <form method="post" action="{{ route('setpassword') }}">
        @csrf
        <div id="resetform01" class="show">
            <div id="crederror"></div>
            {{-- <input type="hidden" id="csrf" value="{{Session::token()}}"> --}}
            <!-- <div class="form-group"> -->
            <div class="form-group" id="pwd-container"><i class="fa fa-user"></i>
                <input name="password" type="password" id="password" tabindex="0" class="form-control underline-input" placeholder="Enter Password" onkeydown="return showProgressbar(this.value)">
                <span id="emailerror"></span>
                <div class="col-sm-12 mt-1">
                    <div class="pwstrength_viewport_progress"></div>
                </div>
            </div>
            <div class="row">
                <div id="messages" class="col-sm-12"></div>
            </div> 
            <div class="form-group"><i class="fa fa-unlock-alt"></i>
                <input name="cnf_password" type="password" id="cnf_password" class="form-control underline-input" placeholder="Confirm Password">
                <span id="moberror"></span>
            </div>
            <div class="form-group dp_ful captcha">
            </div>
            <div class="form-group text-left ">
                <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3" disabled>
            </div>
            <!-- </div> -->
        </div>
    </form>
    <!-- <a href="{{URL::to('vendor-login')}}"><i class="fa fa-user"></i> Already Registered</a> &nbsp;&nbsp;
    <a href="/resendotp" style="color: blue;"><i class="fa fa-user"></i> Resend OTP</a> -->
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function() {
        $('.alert-success').fadeIn();
        setTimeout(function() {
            $('.alert-success').fadeOut("slow");
        }, 5000);
        $('.alert-danger').fadeIn();
        setTimeout(function() {
            $('.alert-danger').fadeOut("slow");
        }, 5000);
    });
</script>
<script>
    jQuery(document).ready(function() {
        $(".pwstrength_viewport_progress").hide();
        "use strict";
        var options = {};
        options.ui = {
            bootstrap4: true,
            container: "#pwd-container",
            viewports: {
                progress: ".pwstrength_viewport_progress"
            },
            showVerdictsInsideProgressBar: true
        };
        options.common = {
            debug: true,
            onLoad: function() {
                $('#messages').text('');
            }
        };
        $('#password:password').pwstrength(options);
    });

    function showProgressbar(val) {
        $(".pwstrength_viewport_progress").show();
        var passstrenth = $('.password-verdict').text();
        if (val == '' || passstrenth == 'Very Weak' || passstrenth == 'Weak') {
            $('#resetform').attr('disabled', true);
            $(".password-verdict").css('color','#000');
        } else {
            $('#resetform').attr('disabled', false);
        }
    }
</script>
@endsection