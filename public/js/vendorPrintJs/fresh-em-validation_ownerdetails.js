$(document).ready(function () {
    $("form").on('submit', function () {
        var form = $("#owner_details_form");
        form.validate({
            rules: {
                owner_name: {
                    minlength: 2,
                    maxlength: 80
                },
                owner_type: {
                    required: true,
                },
                email: {
                    required: true,
                    emailExt: true
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                address: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                district: {
                    required: true
                },
                phone: {
                    minlength: 6,
                    maxlength: 15,
                },
                pan_copy_file_name: {
                    required: true
                }
            },
            messages: {
                owner_name: {
                    minlength: "Owner name must be at least 2 alphabets!",
                    maxlength: "Users can type only max 80 alphabets!"
                },
                owner_type: {
                    required: "Please fill required field!",
                },
                email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be 10 digit!",
                    number: "Users can enter only integer numbers!"
                },
                address: {
                    required: "Please fill required field!"
                },
                state: {
                    required: "Please select an state!"
                },
                city: {
                    required: "Please fill required field!"
                },
                district: {
                    required: "Please fill required field!"
                },
                phone: {
                    minlength: "Phone no. length should be min 6 digit!",
                    maxlength: "Phone no. length should be max 15 digit!",
                    number: "Users can enter only integer numbers!"
                },
                pan_copy_file_name: {
                    required: "Please fill required field!"
                }
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
        if (form.valid() === false) {
            return false;
        }
    });
    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');

});

// get district and city based on state 
$(document).ready(function () {
    $(".call_district").change(function () {
        if ($(this).val() != '') {
            var id = $(this).attr("data");
            var cityid = $(this).attr("cityid");
            $("#" + id).empty();
            $("#" + cityid).empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                },
                type: 'get',
                url: 'getdistrictcity',
                data: {
                    state_code: $(this).val()
                },
                success: function (response) {
                    $("#" + id).html(response.districts);
                    $("#" + cityid).html(response.cities);

                }
            });
        }
    });
});

function checkUniqueOwner(id, val) {
    if (val != '') {

        var owner_id = $("#ownerid").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'GET',
            url: 'check-unique-owner-company/',
            data: {data : val, owner_id : owner_id},
            success: function (response) {
                console.log(response);
                if (response.status == 0 && id == 'email') {
                    $("#alert_" + id).html(titleCase(id) + ' ' + response.message);
                    $("#alert_" + id).show();
                    $("#email").val('');
                }else if (response.status == 0 && id == 'mobile') {
                    $("#alert_" + id).html(titleCase(id) + ' ' + response.message);
                    $("#alert_" + id).show();
                    $("#mobile").val('');
                } else {
                    $("#alert_" + id).hide();
                }
            }
        });
    }
}
// use for first letter to upper case
function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
}

////////////// file upload validation ////////////////
$(document).ready(function () {
    $(".custom-file-input").change(function () {
        var id = $(this).attr("id");
        var file = this.files[0].name;

        var totalBytes = this.files[0].size;
        var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
        var ext = file.split('.').pop();
       
        if (file != '' && (sizemb <= 2 || nolimit != '') && ext == "pdf") {
            $("#" + id + 2).empty();
            $("#" + id + 2).text(file);
            $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
            $("#" + id + 4).show();
            $("#" + id + 1).hide();
           
        } else {
            $("#" + id).val('');
            $("#" + id + 2).text("Choose file");
            $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
            $("#" + id + 1).show();
            $("#" + id + 3).html("Upload").addClass("input-group-text");
            $("#" + id + "-error").addClass("hide-msg");
            $("#" + id + 4).hide();
        }
    });
});

$(document).ready(function () {
    if ($('.alert-success').text() != '') {
        $('.alert-success').fadeIn();
        setTimeout(function () {
            $('.alert-success').fadeOut("slow");
            // window.location.reload();
        }, 7000);
    }
    if ($('.alert-danger').text() != '') {
        $('.alert-danger').fadeIn();
        setTimeout(function () {
            $('.alert-danger').fadeOut("slow");
            // window.location.reload();
        }, 7000);
    }
});