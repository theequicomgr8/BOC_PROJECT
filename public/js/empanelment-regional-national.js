//Store Reginal-national Data
function AddVendorDetail() {
    if ($("#modification_form").val() == 0) {
        var data = new FormData($("#emp_regional_national")[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            url: '/saveregional',
            type: 'POST',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
            }
        });
    } else {
        console.log("modified");
    }
}
//End Reginal-national Data
$(document).ready(function () {
    $(".regional-national").click(function () {
        var form = $("#emp_regional_national");
        form.validate({
            rules: {
                owner_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 100
                },
                email: {
                    required: true,
                    emailExt: true
                },
                mobile: {
                    required: true,
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

                // phone_no: {
                //     maxlength: 15,
                //     number: true
                // },
                // fax: {
                //     maxlength: 15,
                //     number: true
                // },
                company_Group: {
                    required: true
                },
                chanel_name: {
                    required: true
                },
                // Uplinking_valid_upto: {
                //     datavalidup: true,
                //     required: true
                // },
                // Down_linking_valid_upto: {
                //     datavalid: true,
                //     required: true
                // },
                // EMMC_License_No: {
                //     required: true
                // },
                // Date_of_EMMC: {
                //     required: true
                // },
                Regional_Language: {
                    required: true
                },
                Legal_status_of_company: {
                    required: true
                },
                // Head_of_Company: {
                //     required: true
                // },
                Month_launch: {
                    required: true
                },
                Year_launch: {
                    Monthyear: true,
                    required: true
                },
                Genre_of_channel: {
                    required: true
                },
                DO_Address: {
                    required: true
                },
                DO_State: {
                    required: true
                },
                DO_District: {
                    required: true
                },
                DO_City: {
                    required: true
                },
                // DO_Phone: {
                //     number: true,
                //     minlength: 15
                // },
                // DO_Fax: {
                //     number: true,
                //     minlength: 15
                // },
                DO_Mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                DO_Email: {
                    required: true,
                    emailExt: true
                },
                HO_Address: {
                    required: true
                },
                HO_State: {
                    required: true
                },
                HO_District: {
                    required: true
                },
                HO_City: {
                    required: true
                },
                // HO_Phone: {
                //     number: true,
                //     minlength: 15
                // },
                // HO_Fax: {
                //     number: true,
                //     minlength: 15
                // },
                HO_Mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                HO_Email: {
                    required: true,
                    emailExt: true
                },
                ODO_Address: {
                    required: true
                },
                ODO_State: {
                    required: true
                },
                ODO_District: {
                    required: true
                },
                ODO_City: {
                    required: true
                },
                ODO_Phone: {
                    number: true,
                    minlength: 15
                },
                ODO_Fax: {
                    number: true,
                    minlength: 15
                },
                ODO_Mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
                },
                ODO_Email: {
                    required: true,
                    emailExt: true
                },
                OHO_Address: {
                    required: true
                },
                OHO_State: {
                    required: true
                },
                OHO_District: {
                    required: true
                },
                OHO_City: {
                    required: true
                },
                OHO_Phone: {
                    number: true,
                    minlength: 15
                },
                OHO_Fax: {
                    number: true,
                    minlength: 15
                },
                OHO_Mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                },
                OHO_Email: {
                    required: true,
                    emailExt: true
                },
                bank_account_no: {
                    required: true,
                    maxlength: 20,
                    number: true
                },
                account_holder_name: {
                    required: true,
                },
                bank_name: {
                    required: true,
                },
                ifsc_code: {
                    required: true,
                },
                branch_name: {
                    required: true,
                },
                address_of_account: {
                    required: true,
                },
                pan_card: {
                    Panvalid: true,
                },
                // GST_No: {
                //     testgst: true,
                // },
                ESI_account_no: {
                    number: true
                },
                ESI_no_employees: {
                    number: true
                },
                EPF_account_no: {
                    number: true
                },
                EPF_no_of_employees: {
                    number: true
                },
                Uplinking_Down_linking: {
                    required: true
                },
                EMMC_certificate: {
                    required: true
                },
                Fixed_Point_Chart: {
                    required: true
                },
                ancelled_cheque: {
                    required: true
                },
                Teleport_operator_certificate: {
                    required: true
                },
                Last_year_certificate: {
                    required: true
                },
                letter_attested: {
                    required: true
                },
                Government_India: {
                    required: true
                },
                applicant_channel_belongs: {
                    required: true
                },
                affirm: {
                    required: true
                },
                Streaming_Start_Date: {
                    required: true
                },


            },
            messages: {
                owner_name: {
                    required: "Please fill required field!",
                    minlength: "Owner name must be at least 5 alphabets!",
                    maxlength: "Users can type only max 100 alphabets!"
                },
                email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },

                mobile: {
                    required: "Please fill required field!",
                    maxlength: "Mobile length should be max and min 10 digit!",
                    number: "Users can enter only integer numbers!"
                },

                address: {
                    required: "Please fill required field!"
                },

                state: {
                    required: "Please fill required field!"
                },
                city: {
                    required: "Please fill required field!"
                },
                district: {
                    required: "Please fill required field!"
                },
                // phone_no: {
                //     maxlength: "Mobile length should be max and min 15 digit!",
                //     number: "Users can enter only integer numbers!"
                // },
                // fax: {
                //     maxlength: "Fax length should be max and min 15 digit!",
                //     number: "Users can enter only integer numbers!"
                // },
                company_Group: {
                    required: "Please fill required field!"
                },
                chanel_name: {
                    required: "Please fill required field!"
                },
                // Uplinking_valid_upto: {
                //     required: "Please fill required field!"
                // },
                // Down_linking_valid_upto: {
                //     required: "Please fill required field!"
                // },
                // EMMC_License_No: {
                //     required: "Please fill required field!"
                // },
                // Date_of_EMMC: {
                //     required: "Please fill required field!"
                // },
                Regional_Language: {
                    required: "Please fill required field!"
                },
                Legal_status_of_company: {
                    required: "Please fill required field!"
                },
                // Head_of_Company: {
                //     required: "Please fill required field!"
                // },
                Month_launch: {
                    required: "Please fill required field!"
                },
                Year_launch: {
                    required: "Please fill required field!"
                },
                Genre_of_channel: {
                    required: "Please fill required field!"
                },
                DO_Address: {
                    required: "Please fill required field!"
                },
                DO_State: {
                    required: "Please fill required field!"
                },
                DO_District: {
                    required: "Please fill required field!"
                },
                DO_City: {
                    required: "Please fill required field!"
                },
                // DO_Phone: {
                //     number: "Users can enter only integer numbers!",
                //     minlength: "Mobile length should be max and min 15 digit!"
                // },
                // DO_Fax: {
                //     number: "Users can enter only integer numbers!",
                //     minlength: "Mobile length should be max and min 15 digit!"
                // },
                DO_Mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile No. should be min 10 digit",
                    maxlength: "Mobile No. should be max 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                DO_Email: {
                    required: "Please fill required field!",
                },
                HO_Address: {
                    required: "Please fill required field!"
                },
                HO_State: {
                    required: "Please fill required field!"
                },
                HO_District: {
                    required: "Please fill required field!"
                },
                HO_City: {
                    required: "Please fill required field!"
                },
                // HO_Phone: {
                //     number: "Users can enter only integer numbers!",
                //     minlength: "Mobile length should be max and min 15 digit!"
                // },
                // HO_Fax: {
                //     number: "Users can enter only integer numbers!",
                //     minlength: "Mobile length should be max and min 15 digit!"
                // },
                HO_Mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile No. should be min 10 digit",
                    maxlength: "Mobile No. should be max 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                HO_Email: {
                    required: "Please fill required field!",
                },
                ODO_Address: {
                    required: "Please fill required field!"
                },
                ODO_State: {
                    required: "Please fill required field!"
                },
                ODO_District: {
                    required: "Please fill required field!"
                },
                ODO_City: {
                    required: "Please fill required field!"
                },
                ODO_Phone: {
                    number: "Users can enter only integer numbers!",
                    minlength: "Mobile length should be max and min 15 digit!"
                },
                ODO_Fax: {
                    number: "Users can enter only integer numbers!",
                    minlength: "Mobile length should be max and min 15 digit!"
                },
                ODO_Mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile No. should be min 10 digit",
                    maxlength: "Mobile No. should be max 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                ODO_Email: {
                    required: "Please fill required field!",
                },
                OHO_Address: {
                    required: "Please fill required field!"
                },
                OHO_State: {
                    required: "Please fill required field!"
                },
                OHO_District: {
                    required: "Please fill required field!"
                },
                OHO_City: {
                    required: "Please fill required field!"
                },
                OHO_Phone: {
                    number: "Users can enter only integer numbers!",
                    minlength: "Phone length should be max and min 15 digit!"
                },
                OHO_Fax: {
                    number: "Users can enter only integer numbers!",
                    minlength: "Mobile length should be max and min 15 digit!"
                },
                OHO_Mobile: {
                    required: "Please fill required field!",
                    minlength: "Mobile length should be min 10 digit!",
                    maxlength: "Mobile length should be max  10 digit!",
                    number: "Users can enter only integer numbers!"
                },
                OHO_Email: {
                    required: "Please fill required field!",
                },
                bank_account_no: {
                    required: "Please fill required field!",
                    maxlength: "Bank Account length should be min and max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                account_holder_name: {
                    required: "Please fill required field!"
                },
                bank_name: {
                    required: "Please fill required field!"
                },
                ifsc_code: {
                    required: "Please fill required field!"
                },
                branch_name: {
                    required: "Please fill required field!"
                },
                address_of_account: {
                    required: "Please fill required field!"
                },
                pan_card: {
                    required: "Please fill required field!"
                },
                // GST_No: {
                //     required: "Please fill required field!"
                // },
                ESI_account_no: {
                    maxlength: "Account No. length should be min and max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                ESI_no_employees: {
                    maxlength: "Employees length should be max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                EPF_account_no: {
                    maxlength: "Account No. length should be min and max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                EPF_no_of_employees: {
                    maxlength: "Employees length should be max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                Uplinking_Down_linking: {
                    required: "Please fill required field!"
                },
                EMMC_certificate: {
                    required: "Please fill required field!"
                },
                Fixed_Point_Chart: {
                    required: "Please fill required field!"
                },
                ancelled_cheque: {
                    required: "Please fill required field!"
                },
                Teleport_operator_certificate: {
                    required: "Please fill required field!"
                },
                Last_year_certificate: {
                    required: "Please fill required field!"
                },
                letter_attested: {
                    required: "Please fill required field!"
                },
                Government_India: {
                    required: "Please fill required field!"
                },
                applicant_channel_belongs: {
                    required: "Please fill required field!"
                },
                affirm: {
                    required: "Please select the declaration!"
                },
                Streaming_Start_Date: {
                    required: "Please fill required field!"
                },

                //   terms: "Please accept our terms"
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
            if ($('#tab1').is(":visible")) {
                current_fs = $('#tab1');
                //my ajax start
                var data = new FormData($("#emp_regional_national")[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                    },
                    url: '/SaveOwnerData',
                    type: 'POST',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        $("#ownerid").val(data.data);
                    }
                })
                //ajax close
                next_fs = $('#tab2');
                $("a[href='#tab1']").removeClass("active");
                $("a[href='#tab2']").addClass("active");
                //nextSaveData('next_tab_1');
                $("#next_tab_1").val("0");
                $("#submit_doc").val(0);
            } else if ($('#tab2').is(":visible")) {
                current_fs = $('#tab2');
                //start ajax
                AddVendorDetail();
                //end ajax
                next_fs = $('#tab3');
                $("a[href='#tab2']").removeClass("active");
                $("a[href='#tab3']").addClass("active");
                //nextSaveData('next_tab_2');
                $("#next_tab_2").val("0");
                $("#submit_doc").val(0);
            } else if ($('#tab3').is(":visible")) {
                current_fs = $('#tab3');
                //start ajax
                AddVendorDetail();
                //end ajax
                next_fs = $('#tab4');
                $("a[href='#tab3']").removeClass("active");
                $("a[href='#tab4']").addClass("active");
                //nextSaveData('next_tab_3');
                $("#next_tab_3").val("0");
                $("#submit_doc").val(1);
            } else if ($('#tab4').is(":visible")) {

                current_fs = $('#tab3');
                //start ajax
                var data = new FormData($("#emp_regional_national")[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
                    },
                    url: '/saveregional',
                    type: 'POST',
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('#Uplinking_Down_linking').focus();
                        $("#Final_submi").show();
                        $("#Final_submi").text(data.message);
                        setTimeout(function () {
                            window.location.href = '/form-type';
                        }, 5000);
                    }
                });
                //end ajax
                next_fs = $('#tab4');
                $("a[href='#tab4']").addClass("active");
                //nextSaveData('submit_btn');
                $("#submit_btn").val("0");

            }

            next_fs.show();
            current_fs.hide();


        }
    });




    $('.reg-previous-button').click(function () {
        if ($('#tab2').is(":visible")) {
            current_fs = $('#tab2');
            next_fs = $('#tab1');
            $("a[href='#tab2']").removeClass("active");
            $("a[href='#tab1']").addClass("active");
            $("#next_tab_3").val("0");
            $("#submit_doc").val(0);

        } else if ($('#tab3').is(":visible")) {
            current_fs = $('#tab3');
            next_fs = $('#tab2');
            $("a[href='#tab3']").removeClass("active");
            $("a[href='#tab2']").addClass("active");
            $("#submit_doc").val(0);

        } else if ($('#tab4').is(":visible")) {
            current_fs = $('#tab4');
            next_fs = $('#tab3');
            $("a[href='#tab4']").removeClass("active");
            $("a[href='#tab3']").addClass("active");
            $("#submit_doc").val(0);
        }

        next_fs.show();
        current_fs.hide();
    });

    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
    }, 'Please enter a vaild email address');

});


$.validator.addMethod("Monthyear", function (value, element, param) {
    var Month_launch = $('#Month_launch').val();
    //alert(Month_launch);
    var Year_launch = $('#yearpicker').val();

    if (Month_launch != '' && Year_launch != '') {
        var yearDay = new Date();
        var currentY = yearDay.getFullYear();
        var currentM = yearDay.getMonth() + 1;
        var userfulldate = Year_launch + "-" + Month_launch;
        var currentfulldate = currentY + "-" + currentM;
        var days = daysdifference(currentfulldate, userfulldate);
        console.log(days);
        if (days == true) {
            return true;
        } else {
            return false;
        }

    }
}, '');
{


}

function daysdifference(firstDate, secondDate) {
    var startDay = new Date(firstDate);
    var endDay = new Date(secondDate);
    var millisBetween = startDay.getTime() - endDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    var daysn = Math.round(Math.abs(days));
    var months = Math.floor(daysn / 30);
    //return months ;
    if (months < 6) {
        $("#yearpicker").css("border-color", "#dc3545");
        $("#Month_launch_Error").show();
        $("#Month_launch_Error").text('You are not  eligible for empanelment!');
        return false;
    } else {
        $("#yearpicker").css("border-color", "#ced4da");
        $("#Month_launch_Error").hide();
        return true;

    }
}
/*===============IFCS Code Validation===================*/
jQuery.validator.addMethod('IFSCvalid', function (value) {
    $("#IFSC_code_Error").hide();
    var reg = /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/;
    if (value.match(reg)) {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Valid IFSC code').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
        });
        return true;
    } else if (value != '' && value.match(reg) != true) {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Invalid IFSC code!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $("#IFSC_code_Error").show();
        $("#IFSC_code_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    }
}, '');
//pan card validation
$.validator.addMethod('Panvalid', function (value) {
    var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;
    $("#PAN_No_Error").hide();
    if (value.match(regExp)) {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Valid Pan card No.').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
        });
        return true;
    } else if (value != '' && value.match(regExp) != true) {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Invalid Pan No.!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $("#PAN_No_Error").show();
        $("#PAN_No_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    }

}, '');
//GST validation
jQuery.validator.addMethod('testgst', function (value) {
    $("#GST_No_Error").hide();
    var reggst = (/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
    if (value.match(reggst)) {
        $("#GST_No_Error").show();
        $("#GST_No_Error").text('Valid GST No.').css({
            "color": "green",
            "font-weight": "100",
            "font-size": "11px"
        });
        return value.match(reggst);
    } else if (value != '') {
        $("#GST_No_Error").show();
        $("#GST_No_Error").text('Invalid GST No.!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $("#GST_No_Error").show();
        $("#GST_No_Error").text('Please fill required field!').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    }
}, '');
/*=================Start and End data validation============*/
$.validator.addMethod("datavalid", function (value, element) {
    var startd = element.getAttribute('data');
    var startDate = $('#' + startd).val();
    var endDate = value;
    //console.log(startDate,endDate);
    $("#Down_linking_Error").hide();
    if (Date.parse(startDate) > Date.parse(endDate) && value != '') {
        $("#Down_linking_Error").show();
        $("#Down_linking_Error").text('Greater Than Uplinking valid upto !').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $(startDate).css("border-color", "#ced4da");
        $("#Down_linking_Error").text('');
        return true;
    }
}, '');


$.validator.addMethod("datavalidup", function (value, element) {
    var startd = element.getAttribute('data');
    var endDate = $('#' + startd).val();
    //console.log(endDate);
    var startDate = value;
    console.log(startDate, endDate);
    $("#Down_linking_Error").hide();
    if (Date.parse(startDate) > Date.parse(endDate) && value != '') {
        $("#Down_linking_Error").show();
        $("#Down_linking_Error").text('Greater Than Uplinking valid upto !').css({
            "color": "red",
            "font-weight": "100",
            "font-size": "11px"
        });
        return false;
    } else {
        $(endDate).css("border-color", "#ced4da");
        $("#Down_linking_Error").text('').css("border-color", "#ced4da");
        return true;
    }
}, '');

/*=================End Start and End data validation============*/

$(document).ready(function () {
    //Same As Delhi Office
    $("#HO_same_as_DO").on('change', function () {
        if ($(this).prop('checked') === true) {
            var Do_contact_name = $("#Do_contact_name").val();
            var DO_Address = $("#DO_Address").val();
            var DO_State = $("#DO_State option:selected").val();
            var DO_District = $("#DO_District option:selected").val();
            var DO_City = $("#DO_City").val();
            var DO_Phone = $("#DO_Phone").val();
            var DO_Fax = $("#DO_Fax").val();
            var DO_Mobile = $("#DO_Mobile").val();
            var DO_Email = $("#DO_Email").val();

            $("#HO_contact_name").val(Do_contact_name);
            $("#HO_Address").val(DO_Address);
            $("#HO_State").val(DO_State);
            $("#HO_District").html('<option value="' + DO_District + '">' + DO_District + '</option>');
            $("#HO_City").html('<option value="' + DO_City + '">' + DO_City + '</option>');
            $("#HO_Phone").val(DO_Phone);
            $("#HO_Fax").val(DO_Fax);
            $("#HO_Mobile").val(DO_Mobile);
            $("#HO_Email").val(DO_Email);
        } else {
            $('#HO_contact_name').val('');
            $("#HO_Address").val('');
            $("#HO_State").val('');
            $("#HO_District").html('<option value="">Select District</option>');
            $("#HO_City").html('<option value="">Select City</option>');
            $("#HO_Phone").val('');
            $("#HO_Fax").val('');
            $("#HO_Mobile").val('');
            $("#HO_Email").val('');
        }
    })
    //Same As Ownerdetails
    $("#ODO_same_as_OWO").on('change', function () {
        if ($(this).prop('checked') === true) {
            var ODO_Address = $("#ODO_Address").val();
            var ODO_State = $("#ODO_State option:selected").val();
            var ODO_District = $("#ODO_District option:selected").val();
            var ODO_City = $("#ODO_City").val();
            var ODO_Phone = $("#ODO_Phone").val();
            var ODO_Fax = $("#ODO_Fax").val();
            var ODO_Mobile = $("#ODO_Mobile").val();
            var ODO_Email = $("#ODO_Email").val();
            $("#OHO_Address").val(ODO_Address);
            $("#OHO_State").val(ODO_State);
            $("#OHO_District").html('<option>' + ODO_District + '</option>');
            $("#OHO_City").val(ODO_City);
            $("#OHO_Phone").val(ODO_Phone);
            $("#OHO_Fax").val(ODO_Fax);
            $("#OHO_Mobile").val(ODO_Mobile);
            $("#OHO_Email").val(ODO_Email);

        } else {
            $("#OHO_Address").val('');
            $("#OHO_State").val('');
            $("#OHO_District").html('<option>select District</option>');
            $("#OHO_City").val('');
            $("#OHO_Phone").val('');
            $("#OHO_Fax").val('');
            $("#OHO_Mobile").val('');
            $("#OHO_Email").val('');
        }
    })
});
//fetch uniqe email ID
/*================Existing Email Id =============*/

$("#email").on('keyup', function () {
    var Email_data = $(this).val();
    $.ajax({
        url: '/FetchRNemail',
        type: 'get',
        data: {
            Email_data: Email_data
        },
        success: function (data) {
            console.log(data);
            if (data.status == true && Email_data != '' && data.owner != '') {
                $("#owner_name").val(data.owner.owner_name);
                $("#email").val(data.owner.email_id);
                $("#mobile").val(data.owner.mobile_no);
                $("#address").val(data.owner.address_a);
                $("#state").val(data.owner.state);
                $("#district").html('<option value="' + data.owner.d + '">' + data.owner.d + '</option>');
                $("#city").html('<option value="' + data.owner.city + '">' + data.owner.city + '</option>')
                $("#phone_no").val(data.owner.phone_no);
                $("#fax").val(data.owner.fax_no);
                $("#ownerid").val(data.owner.owner_id);
            } else {
                $("#email").val('');
                //$("#owner_name").val('');
                $("#mobile").val('');
                $("#address").val('');
                $("#state").val('');
                $("#district").html('<option value="">Select District</option>');
                $("#city").html('<option value="">Select City</option>');
                $("#phone_no").val('');
                $("#fax").val('');
                $("#ownerid").val('');
            }


        },

    })
})



$("#ifsc_code").on('keyup', function () {
    var IFSC = $(this).val();
    $.ajax({
        url: 'https://ifsc.razorpay.com/' + IFSC,
        type: 'get',
        success: function (data) {
            if (data.UPI == true && IFSC != '') {
                console.log(data);
                $("#bank_name").val(data.BANK);
                $("#branch_name").val(data.BRANCH);
                $("#address_of_account").val(data.ADDRESS);
            } else {
                $("#bank_name").val('');
                $("#branch_name").val('');
                $("#address_of_account").val('');
            }
        },
        error: function (error) {
            console.log(error);
            $("#bank_name").val('');
            $("#branch_name").val('');
            $("#address_of_account").val('');
        }

    })
})

//Launch year
$(document).ready(function () {
    var currentYear = (new Date()).getFullYear();
    for (y = currentYear; y > 1980; y--) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        document.getElementById('yearpicker').options.add(optn);
    }
})
