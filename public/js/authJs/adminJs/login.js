$(document).ready(function () {
    // remove js validation 
    $(".wing_type").change(function () {
        $(".invalid-feedback").hide();
    });
    //end
    $(".login-form").click(function () {
        $("#email-error").text('').removeClass("invalid-feedback");
        var form = $("#login-form");
        form.validate({
            rules: {
                wing: {
                    required: true,
                },
                outdoor: {
                    required: true,
                },
                av: {
                    required: true,
                },
                media: {
                    required: true,
                },
                login_type: {
                    required: true,
                },
                email: {
                    required: true,
                    gstExt: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                wing: {
                    required: "Please fill required field!",
                },
                outdoor: {
                    required: "Please fill required field!",
                },
                av: {
                    required: "Please fill required field!",
                },
                media: {
                    required: "Please fill required field!",
                },
                login_type: {
                    required: "Please fill required field!",
                },
                email: {
                    required: "Please fill required field!"
                },
                password: {
                    required: "Please fill required field!",
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
    });
    //gst validation formate
    var msg = '';
    jQuery.validator.addMethod("gstExt", function (value) {
        var textval = $("#login_type").find("option:selected").text();
        msg = '';
        if (textval == 'GST' && value != '') {
            if (value.match(/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/) == false) {
                $(".invalid-feedback").show();
                msg = 'Please enter a vaild GST no.';
                $("#email-error").text(msg).addClass("invalid-feedback");
                return false;
            } else {
                $("#email-error").text(msg).removeClass("invalid-feedback");
                return true;
            }
        } else {
            $("#email-error").text(msg).removeClass("invalid-feedback");
            return true;
        }
    }, '');

    $("#email").on("keyup", function () {
        var textval = $("#login_type").find("option:selected").text();
        if (textval == 'GST' && $("#email").val() == '') {
            $("#email-error").text('').removeClass("invalid-feedback");
        }
    });
});

function alphadash(event) {
    var inputValue = event.charCode;
    if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue != 45)) {
        event.preventDefault();
    }
}
$(document).ready(function () {
    $('.alert-success').fadeIn();
    setTimeout(function () {
        $('.alert-success').fadeOut("slow");
    }, 5000);
});

$(document).ready(function () {
    $('#login_type').change(function () {
        var textval = $(this).find("option:selected").text();
        $('.vendorlogintypeplace').attr("placeholder", 'Enter ' + textval);
    });
})

$(document).ready(function () {
    $('.wing').change(function () {
        var wing_typeVal = $(this).find("option:selected").val();
        if (wing_typeVal == 3) {
            $('#wing_type').val(3);
        } else if (wing_typeVal == 2) {
            var wing = $('.av').find("option:selected").val();
            $('#wing_type').val(wing);
            $('.av').change(function () {
                var wing = $('.av').find("option:selected").val();
                $('#wing_type').val(wing);
            })
        } else if (wing_typeVal == 1) {
            var wing = $('.outdoor').find("option:selected").val();
            $('#wing_type').val(wing);
            $('.outdoor').change(function () {
                var wing = $('.outdoor').find("option:selected").val();
                $('#wing_type').val(wing);
            })
        } else if (wing_typeVal == 4) {
            var wing = $('.newMedia').find("option:selected").val();
            $('#wing_type').val(wing);
            $('.newMedia').change(function () {
                var wing = $('.newMedia').find("option:selected").val();
                $('#wing_type').val(wing);
            })

        } else if (wing_typeVal == 11) {
            $('#wing_type').val(11);
        } else {
            $('#wing_type').val(wing_typeVal);
        }

        if (wing_typeVal == 0 || wing_typeVal == 1 || wing_typeVal == 2) {
            $("#login_type").children("option[value^=" + 2 + "]").show()
        } else {
            $("#login_type").children("option[value^=" + 2 + "]").hide()
        }
    });

})

$(".wing").change(function () {
    if ($(this).val() == 2) {
        $(".av").show();
    } else {
        $(".av").hide();
    }
    if ($(this).val() == 1) {
        $(".outdoor").show();
    } else {
        $(".outdoor").hide();
    }
    if ($(this).val() == 4) {
        $(".newMedia").show();
    } else {
        $(".newMedia").hide();
    }
});

$(".wing").change(function () {
    if ($(this).val() == 2) {
        $("#wing_type_av").show();
    } else {
        $("#wing_type_av").hide();
    }
    if ($(this).val() == 1) {
        $("#wing_type_outdoor").show();
    } else {
        $("#wing_type_outdoor").hide();
    }
    if ($(this).val() == 4) {
        $("#wing_type_media").show();
    } else {
        $("#wing_type_media").hide();
    }
});

$(".wing_type").change(function () {
    var wingVal = $('.wing').find("option:selected").val();
    var wing_typeval = $(this).find("option:selected").val();

    if (wing_typeval == 0 && wingVal == 1) {
        $("#login_type").children("option[value^=" + 3 + "]").hide();
    } else {
        $("#login_type").children("option[value^=" + 3 + "]").show();
    }
});