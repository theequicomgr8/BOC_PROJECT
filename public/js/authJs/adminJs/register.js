$(document).ready(function () {
	// remove js validation 
    $(".wing_type").change(function () {
       $(".invalid-feedback").hide();      
    });
	//end
    $(".signup-form").click(function () {
        var form = $("#signup-form");
        form.validate({
            rules: {
                email: {
                    required: true,
                    emailExt: true
                },
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
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                gst: {
                    required: true,
                    gstExt: true
                }
            },
            messages: {
                email: {
                    required: "Please fill required field!"
                },
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
                mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be 10 digit!",
                    number: "Users can enter only integer numbers!"
                },
                gst: {
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
    });

    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value) {
		 $(".invalid-feedback").show();
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');

    //gst validation formate
    jQuery.validator.addMethod("gstExt", function (value) {
		 $(".invalid-feedback").show();
        return value.match(/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
    }, 'Please enter a vaild GST no.');
});

$(document).ready(function () {
    $(".wing").change(function () {
        var wing = $(".wing").val();
        if (wing == 1 || wing == 2) {
            $("#gst_section").show();
        } else {
            $("#gst_section").hide();
        }
    });

});

function checkNumberOnly(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

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
            $("#login_type").children("option[value^=" + 2 + "]").show();
        } else {
            $("#login_type").children("option[value^=" + 2 + "]").hide();
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