function checkNumberOnly(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}
// start reset form js 
$(document).ready(function () {
    $("#otpdiv").hide();
    $("#newpassdiv").hide();
    $("#resetform").click(function () {
        var form = $("#reset-form");
        form.validate({
            rules: {
                email: {
                    required: true,
                    emailExt: true
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                }
            },
            messages: {
                email: {
                    required: "Please fill required field!"
                },
                mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be 10 digit!",
                    number: "Users can enter only integer numbers!"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
        if (form.valid() === false) {
            return false;
        }
        if (form.valid() === true) {
            resetForm();
            return false;
        }
    });
    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');
});

function resetForm() {
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var token = $("#csrf").val();
    $.ajax({
        url: 'forgot-password',
        type: 'POST',
        data: {
            _token: token,
            mobile: mobile,
            email: email
        },
        success: function (result) {
            console.log(result);
            var result = JSON.parse(result);
            if (result.statusCode == 200) {
                $("#resetform01").hide();
                $("#otpdiv").show();
                $('#credotp').text(result.msg);
            } else {
                $('#crederror').html('<h7 style="color:red">' + result.msg + '<h7>');
            }
        }
    });
}
// end reset form js 

// start otp form js 
$(document).ready(function () {
    $("#otpSubmit").click(function () {
        var form = $("#otp-form");
        form.validate({
            rules: {
                email_otp: {
                    required: true
                },

                /*mobile_otp: {
                    required: true
                }*/
            },
            messages: {
                email_otp: {
                    required: "Please fill required field!"
                },
                
                /*mobile_otp: {
                    required: "Please fill required field!"
                }*/
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
        if (form.valid() === false) {
            return false;
        }
        if (form.valid() === true) {
            otpForm();
            return false;
        }
    });
});

function otpForm() {
    var email_otp = $("#email_otp").val();
    email_otp = email_otp.trim();
    var mobile_otp = $("#mobile_otp").val();
    mobile_otp = mobile_otp.trim();
    var token = $("#csrf").val();
    $.ajax({
        type: "post",
        url: 'submitotp',
        data: {
            _token: token,
            email_otp: email_otp,
            mobile_otp: mobile_otp
        },
        success: function (otpResult) {
            otpResult = JSON.parse(otpResult);
            if (otpResult.statusCode == 200) {
                $("#resetform01").hide();
                $("#otpdiv").hide();
                $("#newpassdiv").show();
                //location.replace("vendor-login");
            } else {
                $('#otperror').html('<h7 style="color:red"> ' + otpResult.msg + ' <h7>');
            }
        }
    });
}
// end otp form js 

// start confirm password form js 
$(document).ready(function () {
    $("#newpassSubmit").click(function () {
        var form = $("#newpassword-form");
        form.validate({
            rules: {
                npassword: {
                    required: true
                },
                confpassword: {
                    required: true
                }
            },
            messages: {
                npassword: {
                    required: "Please fill required field!"
                },
                confpassword: {
                    required: "Please fill required field!"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
        if (form.valid() === false) {
            return false;
        }
        if (form.valid() === true) {
            confirmPassword();
            return false;
        }
    });
});
function confirmPassword() {
    var npassword = $("#npassword").val();
    var confpassword = $("#confpassword").val();
    npassword = npassword.trim();
    var token = $("#csrf").val();
    if (npassword != confpassword) {
        $('#passnotmatch').html('Password not match.').show();
        return false;
    } else {
        $('#passnotmatch').html('').hide();
    }
    $.ajax({
        type: "post",
        url: 'updatepassword',
        data: {
            _token: token,
            npassword: npassword
        },
        success: function (otpResult) {
            otpResult = JSON.parse(otpResult);
            if (otpResult.statusCode == 200) {
                $('.alert-success').fadeIn().html(otpResult.msg).show();
                setTimeout(function () {
                    $('.alert-success').fadeOut("slow");
                    location.replace("vendor-login");
                }, 3000);

            } else {
                $('#otperror').html('<h7 style="color:red"> ' + result.msg + ' <h7>');
            }
        }
    })
}

jQuery(document).ready(function () {
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
        onLoad: function () {
            $('#npassword').text('');
        }
    };
    $('#npassword:password').pwstrength(options);
});

function showProgressbar(val) {
    $(".pwstrength_viewport_progress").show();
    var passstrenth = $('.password-verdict').text();
    if (val == '' || passstrenth == 'Very Weak' || passstrenth == 'Weak') {
        $('#newpassSubmit').attr('disabled', true);
        $(".password-verdict").css('color', '#000');
    } else {
        $('#newpassSubmit').attr('disabled', false);
    }
}