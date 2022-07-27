@extends('admin.layouts.layout')
<style>
    body {
        color: #6c757d !important;
    }

    .hide-msg {
        display: none !important;
    }

    .fa-check {
        color: green;
    }

    .input-group-text {
        height: 32px !important;
    }

    .custom-file-label {
        height: 32px !important;
        overflow: hidden;
    }

    .custom-file-label::after {
        height: 30px !important;
    }

    .input-group-text {
        font-size: 0.8rem !important;
    }

    /* .input-group {
width: 80% !important;
float: right !important;
} */

    .flexview {
        display: inline-flex;
    }

    .eyecolor {
        color: #007bff !important;
    }

    .iframemargin {
        margin-bottom: -50px;
    }

    .fieldset-border {
        width: 100%;
        border: solid 1px #ccc;
        border-radius: 5px;
        margin: 0 10px 15px 10px;
        padding: 0 15px;
    }

    .fieldset-border legend {
        width: auto;
        background: #fff;
        padding: 0 10px;
        font-size: 14px;
        font-weight: 600;
        color: #3d63d2;
    }

    .subheading {
        font-size: 16px;
        font-weight: 500;
        color: #4066d4;
        border-bottom: solid 1px #4066d4;
        margin-bottom: 15px;
    }

    .divmargin {
        margin-top: 19px;
    }

    .centertext {
        text-align: center;
    }
    form i {
        margin-right: 7px;
        cursor: pointer;
        float: right;
        margin-top: -25px;
    }

</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success centertext">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-danger centertext">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if (session()->has('status_old_pass'))
                    <div class="alert alert-danger centertext">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-9 offset-3">
                <h5>Change password</h5>
                <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}" id="myForm">
                    @csrf
                    <label for="current_password" class="col-md-4 control-label">Current Password <font color="red">*
                        </font></label>
                    <div class="col-md-6">
                        <input id="current_password" type="password" class="form-control" name="current_password"
                            maxlength="20" required><i class="fa fa-eye-slash" id="togglePass"></i>
                        <span id="current_pass"></span>
                    </div>

                    <label for="new_password" class="col-md-4 control-label">New Password <font color="red">*</font>
                    </label>
                    <div class="col-md-6">
                        <input id="new_password" type="password" class="form-control" name="new_password" maxlength="20"
                            required><i class="fa fa-eye-slash" id="togglePassword"></i>
                        <span id="new_pass"></span>
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirm" class="col-md-4 control-label">Confirm Password <font color="red">
                                *</font></label>
                        <div class="col-md-6">
                            <input id="new_password_confirm" type="password" class="form-control"
                                name="new_password_confirm" maxlength="20" required><i class="fa fa-eye-slash" id="toggleConfiPassword"></i>
                            <span id="new_confirm_pass"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <input type="submit" value="Submit" id="chngepass" class="btn btn-greensea b-0 br-2 mr-3">
                                                </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // alert('hii');
            $(document).on('keyup', '#password', function() {
                var val = $(this).val()
                if (isNaN(parseInt(val))) {
                    alert("password is valid");
                } else {
                    alert("Password should not start with number");
                }
            });
        });

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

        $(document).ready(function() {
            $("#chngepass").click(function() {
                var current_password = $("#current_password").val();
                var new_password = $("#new_password").val();
                var new_password_confirm = $("#new_password_confirm").val();
                if (current_password == '') {
                    $('#current_pass').html('<h7 style="color:red">Enter Current Password!<h7>');
                    return false;
                } else {
                    $('#current_pass').html('');
                                   }
                if (new_password == '') {
                    $('#new_pass').html('<h7 style="color:red">Enter New Password!<h7>');
                    return false;
                } else {
                    if (isNaN(parseInt(new_password))) {
                        $('#new_pass').html('');
                    } else {
                        $('#new_pass').html(
                            '<h7 style="color:red">Password Should be Start With Number!</h7>');
                        return false;
                    }
                }
                if (new_password_confirm == '') {
                    $('#new_confirm_pass').html('<h7 style="color:red">Enter Confirm Password!<h7>');
                    return false;
                } else {
                    if (isNaN(parseInt(new_password_confirm))) {
                        if (new_password != new_password_confirm) {
                            $('#new_confirm_pass').html(
                                '<h7 style="color:red">New Password and Confirm Password Should be Same!</h7>'
                            );
                            $("#new_password_confirm").val('');
                            return false;
                        } else {
                            $('#new_confirm_pass').html('<h7 style="color:green">Password is Matched</h7>');
                        }
                    } else {
                        $('#new_confirm_pass').html(
                            '<h7 style="color:red">Password Should be Start With Number!</h7>');
                        return false;
                    }
                }
            });
        });

        $(document).ready(function() {
            const togglePass = document.querySelector('#togglePass');
            const pass = document.querySelector("#current_password");
            if(togglePass){
                togglePass.addEventListener("click", function () {
                    // toggle the type attribute
                    const type = pass.getAttribute("type") === "password" ? "text" : "password";
                    pass.setAttribute("type", type);
                    
                    // toggle the icon
                    this.classList.remove('fa-eye-slash');

                    this.classList.toggle("fa-eye");
                });
            }

            const togglePassword = document.querySelector("#togglePassword");
                const password = document.querySelector("#new_password");
                if(togglePassword){
                togglePassword.addEventListener("click", function () {
                    // toggle the type attribute
                    const type = password.getAttribute("type") === "password" ? "text" : "password";
                    password.setAttribute("type", type);
                    
                    // toggle the icon
                    this.classList.remove('fa-eye-slash');
                    
                    this.classList.toggle("fa-eye");

                });
            }

            const toggleConfirmPassword = document.querySelector("#toggleConfiPassword");
            const Confirmpassword = document.querySelector("#new_password_confirm");
                if(toggleConfirmPassword){
                    toggleConfirmPassword.addEventListener("click", function () {
                        // toggle the type attribute
                        const type = Confirmpassword.getAttribute("type") === "password" ? "text" : "password";
                        Confirmpassword.setAttribute("type", type);
                        
                        // toggle the icon
                        this.classList.remove('fa-eye-slash');

                        this.classList.toggle("fa-eye");
                    });
                }
        });
    </script>
