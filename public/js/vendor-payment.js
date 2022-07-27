$(document).ready(function () {
    $("#submit").click(function () {
        var form = $("#myForm");
        form.validate({
            rules: {
                amount: {
                    required: true,
                    amtExt: true
                },
                ship_fname: {
                    required: true,
                    alphaExt: true
                },
                ship_lname: {
                    required: true,
                    alphaExt: true
                },
                bill_fname: {
                    required: true,
                    alphaExt: true
                },
                bill_lname: {
                    required: true,
                    alphaExt: true
                },
                email: {
                    required: true,
                    emailExt: true
                },
                ship_mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                ship_address: {
                    required: true
                },
                ship_pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    number: true
                },
                ship_state: {
                    required: true
                },
                ship_city: {
                    required: true,
                    alphaExt: true
                },
                ship_country: {
                    required: true
                },
                bill_mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                bill_address: {
                    required: true
                },
                bill_pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                    number: true
                },
                bill_state: {
                    required: true
                },
                bill_city: {
                    required: true,
                    alphaExt: true
                },
                bill_country: {
                    required: true
                }
            },
            messages: {
                amount: {
                    required: "Please fill required field!",
                    amtExt: "Please enter valid amount"
                },
                ship_fname: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
                ship_lname: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
                bill_fname: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
                bill_lname: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
                email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                ship_mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be min and max 10 digit!",
                    number: "Users can enter only integer numbers!"
                },
                ship_address: {
                    required: "Please fill required field!"
                },
                ship_pincode: {
                    required: "Please fill required field!",
                    minlength: "Pincode length should be min and max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                ship_state: {
                    required: "Please select an state!"
                },
                ship_city: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
                ship_country: {
                    required: "Please fill required field!"
                },
                bill_address: {
                    required: "Please fill required field!"
                },
                bill_mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be min and max 10 digit!",
                    number: "Users can enter only integer numbers!"
                },
                bill_pincode: {
                    required: "Please fill required field!",
                    minlength: "Pincode length should be min and max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                bill_state: {
                    required: "Please select an state!"
                },
                bill_city: {
                    required: "Please fill required field!"
                },
                bill_country: {
                    required: "Please fill required field!",
                    alphaExt: "Users can enter only alphabets!"
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
        if (form.valid() === true) {
            //  submitHandler: function(form) {
            form.submit();
            // }
        }
    });
    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');

    //alphabit validation formate
    jQuery.validator.addMethod("alphaExt", function (value, element, param) {
        return value.match(/^[a-zA-Z]+$/);
    }, 'Please enter only alphabets');

    //amount validation formate
    jQuery.validator.addMethod("amtExt", function (value, element, param) {
        return value.match(/^\d{0,9}(\.\d{0,2})?$/);
    }, 'Please enter valid amount');
});

$(document).ready(function () {
    $("#same_as_bill").click(function () {
        if (this.checked == true) {
            $("#ship_fname").val($("#bill_fname").val());
            $("#ship_lname").val($("#bill_lname").val());
            $("#ship_mobile").val($("#bill_mobile").val());
            $("#ship_address").val($("#bill_address").val());
            $("#ship_pincode").val($("#bill_pincode").val());
           // $("#ship_country").val($("#bill_country").val());
            $('#ship_state option').removeAttr('selected').filter('[value=' + $("#bill_state :selected").val() + ']').attr('selected', true);
            $("#ship_city").val($("#bill_city").val());
        } else {
            $("#ship_fname").val('');
            $("#ship_lname").val('');
            $("#ship_mobile").val('');
            $("#ship_address").val('');
            $("#ship_pincode").val('');
           // $("#ship_country").val('');
            $('#ship_state option').attr('selected', false);
            $("#ship_city").val('');
        }
    });
});