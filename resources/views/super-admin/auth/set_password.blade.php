@extends('layouts.layout')
@section('content')
<div class="form-validation mt-20">
    <h4>Set Admin Password</h4>
    @if(!empty($set_password) && $status == 1)
    <div class="alert alert-success">
        {{ $set_password }}
    </div>
    @endif
    @if(!empty($set_password2) && $status == 1)
    <div class="alert alert-danger" id="error-msg">
        {{ $set_password2 }}
    </div>
    @endif
    <div class="alert alert-danger" style="display:none">Password Not Match! </div>
    <!-- client / vendor reset form-->
    <form method="post" action="{{ route('reset-password') }}">
        @csrf
        <div id="resetform01" class="show">
            <div id="crederror"></div>
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
                <input name="cnf_password" type="password" id="cnf_password" class="form-control underline-input" placeholder="Enter Confirm Password">
                <span id="moberror"></span>
            </div>
            <div class="form-group text-left ">
                <input type="submit" value="Submit" id="resetform" class="btn btn-greensea b-0 br-2 mr-3" disabled>
            </div>
            <!-- </div> -->
        </div>
    </form>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function() {
        $('.alert-success').fadeIn();
        setTimeout(function() {
            $('.alert-success').fadeOut("slow");
        }, 5000);

        if ($("#error-msg").text() != '') {
            $('.alert-danger').fadeIn();
            setTimeout(function() {
                $('.alert-danger').fadeOut("slow");
            }, 5000);
        }
        $("#resetform").click(function() {
            if ($("#password").val() != $("#cnf_password").val()) {
                $("#cnf_password").val('');
                $('.alert-danger').fadeIn().show();
                setTimeout(function() {
                    $('.alert-danger').fadeOut("slow");
                }, 5000);
                return false;
            }
        });
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
            $(".password-verdict").css('color', '#000');
        } else {
            $('#resetform').attr('disabled', false);
        }
    }
</script>
@endsection