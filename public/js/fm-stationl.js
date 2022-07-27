$(document).ready(function () {
    $(".fm-next-button").click(function () {
        var form = $("#fm_station");
        form.validate({
            rules: {
                owner_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 80
                },
                email: {
                    required: true,
                    emailExt: true
                },
                mobile: {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    number: true
                },
                address: {
                    required: true,
                    maxlength: 120
                },
                state: {
                    required: true
                },
                district: {
                    required: true
                },
                city: {
                    required: true
                },
                phone: {
                    number: true
                },
                fax_no: {
                    number: true
                },
                FM_station_name: {
                    required: true
                },
                Broadcast_City: {
                    required: true
                },
                Media_Group: {
                    required: true
                },
                language: {
                    required: true
                },
                Mon_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Mon_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true,



                },
                Mon_TB2_From: {
                    mon_tb_from: true,
                    required: true,
                    //valid_mon_tb2_from:true, 

                },
                Mon_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true,


                },
                Mon_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Mon_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Tue_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Tue_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Tue_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Tue_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Tue_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Tue_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Wed_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Wed_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Wed_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Wed_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Wed_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Wed_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Thur_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Thur_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Thur_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Thur_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Thur_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Thur_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Fri_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Fri_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Fri_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Fri_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Fri_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Fri_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Sat_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sat_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Sat_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sat_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Sat_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sat_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },
                Sun_TB1_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sun_TB1_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Sun_TB2_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sun_TB2_To: {
                    mon_tb_to: true,
                    TB1_To: true,
                    required: true
                },
                Sun_TB3_From: {
                    mon_tb_from: true,
                    required: true
                },
                Sun_TB3_To: {
                    mon_tb_to: true,
                    required: true
                },

                GOPA_Validity_Date: {
                    required: true
                },
                WOL_Validity_Date: {
                    required: true
                },
                // legal_company:{
                //   required:true
                // },
                Commercial_Launch_Date: {
                    required: true
                },
                DO_Contact_Name: {
                    required: true
                },
                DO_Address: {
                    required: true
                },
                DO_Designation: {
                    required: true
                },
                DO_Landline_No: {
                    maxlength: 15,
                    number: true
                },
                DO_Mobile: {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    number: true
                },
                DO_Email: {
                    required: true,
                    emailExt: true
                },
                // OP_Same_Address_as_DO:{
                //         sameas:true,
                // },

                OP_contact_name: {
                    required: true
                },
                OP_Address: {
                    required: true,
                },
                OP_Designation: {
                    required: true,
                },
                OP_Landline_No: {
                    maxlength: 15,
                    number: true
                },
                OP_Mobile_No: {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    number: true
                },
                OP_Email: {
                    required: true,
                    emailExt: true
                },
                HO_Contact_name: {
                    required: true,
                    maxlength: 40
                },

                HO_address: {
                    required: true
                },
                HO_Designation: {
                    required: true
                },
                HO_Landline_No: {
                    maxlength: 15,
                    number: true
                },
                HO_Mobile_No: {
                    required: true,
                    maxlength: 10,
                    minlength: 10,
                    number: true
                },
                HO_Email: {
                    required: true,
                    emailExt: true
                },
                Publisher_Language: {
                    required: true
                },
                Bank_account_number: {
                    required: true,
                    number: true
                },
                A_C_Holder_name: {
                    required: true
                },
                IFSC_code: {
                    required: true,
                },
                Branch_name: {
                    required: true
                },
                Bank_name: {
                    required: true,
                },
                Bank_account_address: {
                    required: true
                },
                PAN_No: {
                    Panvalid: true,
                },
                GST_No: {
                    testva: true,
                },
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
                WOL_Certificate_file: {
                    required: true
                },
                information_broadcasting: {
                    required: true
                },
                GOPA_Certificate_file: {
                    required: true
                },
                Undertaking_file: {
                    required: true
                },
                Program_Scheduling_Certificate_file: {
                    required: true
                },
                Cancelled_Cheque_file: {
                    required: true
                },
                Auditor_Certificate_file: {
                    required: true
                },

                Broadcasting_Certificate_file: {
                    required: true
                },
                Sr_Management_Attestation_file: {
                    required: true
                },
                signed_List_file: {
                    required: true
                },
                Acceptance: {
                    required: true
                },
                davp_panel1: {
                    required: true
                }
            },


            messages: {
                owner_name: {
                    required: "Please fill required field!",
                    minlength: "Agency name must be at least 3 alphabets!",
                    maxlength: "Users can type only max 80 alphabets!"
                },
                email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                mobile: {
                    required: "Please fill required field!",
                    maxlength: "Mobile length should be max 10 digit",
                    minlength: "Mobile length should be min 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                address: {
                    required: "Please fill required field!",
                    maxlength: "Users can type only max 120 alphabets!",
                },
                state: {
                    required: "Please fill required field!",
                },
                district: {
                    required: "Please fill required field!",
                },
                city: {
                    required: "Please fill required field!",
                },
                phone: {
                    maxlength: "Landline length should be max and min 15 digit!",
                    number: "Users can enter only integer numbers!"
                },
                fax_no: {

                    number: "Users can enter only integer numbers!"
                },
                FM_station_name: {
                    required: "Please fill required field!",
                },
                Broadcast_City: {
                    required: "Please fill required field!",
                },
                Media_Group: {
                    required: "Please fill required field!",
                },
                language: {
                    required: "Please fill required field!",
                },
                Mon_TB1_From: {
                    required: "Please fill required field!"
                },
                Mon_TB1_To: {
                    required: "Please fill required field!"
                },
                Mon_TB2_From: {
                    required: "Please fill required field!"
                },
                Mon_TB2_To: {
                    required: "Please fill required field!"
                },
                Mon_TB3_From: {
                    required: "Please fill required field!"
                },
                Mon_TB3_To: {
                    required: "Please fill required field!"
                },
                Tue_TB1_From: {
                    required: "Please fill required field!"
                },
                Tue_TB1_To: {
                    required: "Please fill required field!"
                },
                Tue_TB2_From: {
                    required: "Please fill required field!"
                },
                Tue_TB2_To: {
                    required: "Please fill required field!"
                },
                Tue_TB3_From: {
                    required: "Please fill required field!"
                },
                Tue_TB3_To: {
                    required: "Please fill required field!"
                },
                Wed_TB1_From: {
                    required: "Please fill required field!"
                },
                Wed_TB1_To: {
                    required: "Please fill required field!"
                },
                Wed_TB2_From: {
                    required: "Please fill required field!"
                },
                Wed_TB2_To: {
                    required: "Please fill required field!"
                },
                Wed_TB3_From: {
                    required: "Please fill required field!"
                },
                Wed_TB3_To: {
                    required: "Please fill required field!"
                },
                Thur_TB1_From: {
                    required: "Please fill required field!"
                },
                Thur_TB1_To: {
                    required: "Please fill required field!"
                },
                Thur_TB2_From: {
                    required: "Please fill required field!"
                },
                Thur_TB2_To: {
                    required: "Please fill required field!"
                },
                Thur_TB3_From: {
                    required: "Please fill required field!"
                },
                Thur_TB3_To: {
                    required: "Please fill required field!"
                },
                Fri_TB1_From: {
                    required: "Please fill required field!"
                },
                Fri_TB1_To: {
                    required: "Please fill required field!"
                },
                Fri_TB2_From: {
                    required: "Please fill required field!"
                },
                Fri_TB2_To: {
                    required: "Please fill required field!"
                },
                Fri_TB3_From: {
                    required: "Please fill required field!"
                },
                Fri_TB3_To: {
                    required: "Please fill required field!"
                },
                Sat_TB1_From: {
                    required: "Please fill required field!"
                },
                Sat_TB1_To: {
                    required: "Please fill required field!"
                },
                Sat_TB2_From: {
                    required: "Please fill required field!"
                },
                Sat_TB2_To: {
                    required: "Please fill required field!"
                },
                Sat_TB3_From: {
                    required: "Please fill required field!"
                },
                Sat_TB3_To: {
                    required: "Please fill required field!"
                },
                Sun_TB1_From: {
                    required: "Please fill required field!"
                },
                Sun_TB1_To: {
                    required: "Please fill required field!"
                },
                Sun_TB2_From: {
                    required: "Please fill required field!"
                },
                Sun_TB2_To: {
                    required: "Please fill required field!"
                },
                Sun_TB3_From: {
                    required: "Please fill required field!"
                },
                Sun_TB3_To: {
                    required: "Please fill required field!"
                },
                GOPA_Validity_Date: {
                    required: "Please fill required field!",
                },
                WOL_Validity_Date: {
                    required: "Please fill required field!",
                },
                // legal_company:{
                //   required:"Please fill required field!",
                // },
                Commercial_Launch_Date: {
                    required: "Please fill required field!",
                },
                DO_FM_contact_name: {
                    required: "Please fill required field!",
                },
                DO_Address: {
                    required: "Please fill required field!",
                },
                DO_Designation: {
                    required: "Please fill required field!",
                },
                DO_Landline_No: {
                    required: "Please fill required field!",
                    maxlength: "Landline length should be max and min 15 digit!",
                    number: "Users can enter only integer numbers!"
                },
                DO_Mobile: {
                    required: "Please fill required field!",
                    maxlength: "Mobile length should be max 10 digit!",
                    minlength: "Mobile length should be min 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                DO_Email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                OP_contact_name: {
                    required: "Please fill required field!",
                },
                OP_Address: {
                    required: "Please fill required field!",
                },
                OP_Designation: {
                    required: "Please fill required field!",
                },
                OP_Landline_No: {
                    required: "Please fill required field!",
                    maxlength: "Landline length should be max and min 15 digit!",
                    number: "Users can enter only integer numbers!"
                },
                OP_Mobile_No: {
                    required: "Please fill required field!",
                    maxlength: "Mobile length should be max 10 digit!",
                    minlength: "Mobile length should be min 10 digit",
                    number: "Users can enter only integer numbers!"
                },

                OP_Email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                HO_Contact_name: {
                    required: "Please fill required field!",
                    maxlength: "Contact Name length should be max and min 40 digit!",
                },
                HO_address: {
                    required: "Please fill required field!",
                },
                HO_Designation: {
                    required: "Please fill required field!",
                },
                HO_Landline_No: {
                    required: "Please fill required field!",
                    maxlength: "Landline length should be max and min 15 digit!",
                    number: "Users can enter only integer numbers!"
                },
                HO_Mobile_No: {
                    required: "Please fill required field!",
                    maxlength: "Mobile length should be max 10 digit!",
                    minlength: "Mobile length should be min 10 digit",
                    number: "Users can enter only integer numbers!"
                },
                HO_Email: {
                    required: "Please fill required field!",
                    email: "Please enter a vaild email address!"
                },
                Publisher_Language: {
                    required: "Please fill required field!",
                },
                Bank_account_number: {
                    required: "Please fill required field!",
                    number: "Users can enter only integer numbers!"
                },
                A_C_Holder_name: {
                    required: "Please fill required field!",
                },
                IFSC_code: {
                    required: "Please fill required field!",
                },
                Branch_name: {
                    required: "Please fill required field!",
                },
                Bank_name: {
                    required: "Please fill required field!",
                },
                Bank_account_address: {
                    required: "Please fill required field!",
                },
                PAN_No: {
                    required: "Please fill required field!",
                },
                ESI_account_no: {
                    maxlength: "Account No. length should be min and max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                ESI_no_employees: {
                    maxlength: "Employees length should be min and max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                EPF_account_no: {
                    maxlength: "Account No. length should be min and max 20 digit!",
                    number: "Users can enter only integer numbers!"
                },
                EPF_no_of_employees: {
                    maxlength: "Employees length should be min and max 6 digit!",
                    number: "Users can enter only integer numbers!"
                },
                WOL_Certificate_file: {
                    required: "Please fill required field!",
                },
                information_broadcasting: {
                    required: "Please fill required field!",
                },
                GOPA_Certificate_file: {
                    required: "Please fill required field!",
                },
                Undertaking_file: {
                    required: "Please fill required field!",
                },
                Program_Scheduling_Certificate_file: {
                    required: "Please fill required field!",
                },
                Cancelled_Cheque_file: {
                    required: "Please fill required field!",
                },
                Auditor_Certificate_file: {
                    required: "Please fill required field!",
                },
                Broadcasting_Certificate_file: {
                    required: "Please fill required field!",
                },
                Sr_Management_Attestation_file: {
                    required: "Please fill required field!",
                },
                signed_List_file: {
                    required: "Please fill required field!",
                },

                Acceptance: {
                    required: "Please select required checkbox!"
                },
                davp_panel1: {
                    required: "Please select required checkbox!"
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
            if ($('#tab1').is(":visible")) {
                current_fs = $('#tab1');
                next_fs = $('#tab2');
                $("a[href='#tab1']").removeClass("active");
                $("a[href='#tab2']").addClass("active");
                nextSaveData('next_tab_1');
                $("#next_tab_1").val("0");

            } else if ($('#tab2').is(":visible")) {
                current_fs = $('#tab2');
                next_fs = $('#tab3');
                $("a[href='#tab2']").removeClass("active");
                $("a[href='#tab3']").addClass("active");
                nextSaveData('next_tab_2');
                $("#next_tab_2").val("0");

            } else if ($('#tab3').is(":visible")) {
                current_fs = $('#tab3');
                next_fs = $('#tab4');
                $("a[href='#tab3']").removeClass("active");
                $("a[href='#tab4']").addClass("active");
                nextSaveData('next_tab_3');
                $("#next_tab_3").val("0");
            } else if ($('#tab4').is(":visible")) {
                current_fs = $('#tab3');
                next_fs = $('#tab4');
                $("a[href='#tab4']").addClass("active");
                nextSaveData('submit_btn');
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

        } else if ($('#tab3').is(":visible")) {
            current_fs = $('#tab3');
            next_fs = $('#tab2');
            $("a[href='#tab3']").removeClass("active");
            $("a[href='#tab2']").addClass("active");

        } else if ($('#tab4').is(":visible")) {
            current_fs = $('#tab4');
            next_fs = $('#tab3');
            $("a[href='#tab4']").removeClass("active");
            $("a[href='#tab3']").addClass("active");
        }

        next_fs.show();
        current_fs.hide();
    });

    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value, element, param) {
        return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');
    //mon time band to one 
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
    jQuery.validator.addMethod('testva', function (value) {
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
        }
        else {
            // $("#GST_No_Error").show();
            // $("#GST_No_Error").text('Please fill required field!').css({
            //     "color": "red",
            //     "font-weight": "100",
            //     "font-size": "11px"
            // });
            return true;
        }
    }, '');
    /*===============End IFCS Code Validation===================*/

    /*==================Start Time Band Validation ==============*/
    $.validator.addMethod("mon_tb_from", function (value, element) {
        var Toatt_id = element.getAttribute('data-val');
        var to_id = '#' + Toatt_id + 'To';
        var end_date = $(to_id).val();
        if (value < end_date && end_date != '') {
            $(to_id).css("border-color", "#ced4da");
            $("#" + Toatt_id + "From-error").hide();
            $("#" + Toatt_id + "To-error").hide();
            return true;
        }
        return value < end_date;
    }, 'Please select vaild time.');

    $.validator.addMethod("mon_tb_to", function (value, element) {
        var fromatt_id = element.getAttribute('data-id');
        var from_id = '#' + fromatt_id + 'From';
        var startdatevalue = $(from_id).val();
        if (value > startdatevalue && startdatevalue != '') {
            $(from_id).css("border-color", "#ced4da");
            $("#" + fromatt_id + "From-error").hide();
            $("#" + fromatt_id + "To-error").hide();
        }
        return value > startdatevalue;
    }, 'Please select vaild time.');

    $.validator.addMethod('TB1_To', function (value, element) {
        var froma_id = element.getAttribute('data-deep');
        var fromatt_id = element.getAttribute('data-id');
        var from_id = '#' + fromatt_id + 'To';
        $("#" + froma_id + "From").attr('min', (value));
        var getval = $("#" + froma_id + "From").val(value);
        var preval = $(from_id).val();
        $("#" + froma_id + "From").attr('select', 'select');
        $(from_id).css("border-color", "#ced4da");
        $("#" + fromatt_id + "From-error").hide();
        $("#" + fromatt_id + "To-error").hide();
        return true;
    }, '');


    /*==================End Time Band Validation ==============*/
});

$(document).ready(function () {
    $('body').on('focus', ".datepicker", function () {
        //$(this).datepicker();

        $(this).click(function () {
            $('.ui-datepicker-calendar').css("display", "none");
        });
        $(this).focusin(function () {
            $('.ui-datepicker-calendar').css("display", "none");
        });
        $(this).datepicker({
            // changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            beforeShow: function (input) {
                $(input).datepicker("widget").addClass('hide-calendar');
            },
            onClose: function (dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                $(this).datepicker('widget').addClass('hide-calendar');
            }
        });
    });

});

$.validator.addMethod('sameas', function (value, element) {
    var id = element.getAttribute('data')
    alert(id);
    return true;
}, '');
/*End File Upload*/
/*==========Strat Same AS ===============*/
$(document).ready(function () {

    $("input[name=OP_Same_Address_as_DO]").on('change', function () {
        if ($("input[name=OP_Same_Address_as_DO]").prop('checked') === true) {
            var OP_Same_Address_as_DO = $("input[name=OP_Same_Address_as_DO]").val();
            var DO_Contact_Name = $("input[name=DO_Contact_Name]").val();
            var DO_Address = $("#DO_Address").val();
            var DO_Designation = $("input[name=DO_Designation]").val();
            var DO_Landline_No = $("input[name=DO_Landline_No]").val();
            var DO_Mobile = $("input[name=DO_Mobile]").val();
            var DO_Email = $("input[name=DO_Email]").val();
            $("input[name=OP_contact_name]").val(DO_Contact_Name).prop('readonly','true');
            $("#OP_Address").val(DO_Address).prop('readonly','true');
            $("input[name=OP_Designation]").val(DO_Designation).prop('readonly','true');
            $("input[name=OP_Landline_No]").val(DO_Landline_No).prop('readonly','true');
            $("input[name=OP_Mobile_No]").val(DO_Mobile).prop('readonly','true');
            $("input[name=OP_Email]").val(DO_Email).prop('readonly','true');
            //Error hide 
            if ($("#OP_contact_name").val() != '') {
                $("#OP_contact_name").css("border-color", "#ced4da");
                $('#OP_contact_name-error').hide();
            }
            if ($("#OP_Address").val() != '') {
                $("#OP_Address").css("border-color", "#ced4da");
                $('#OP_Address-error').hide();
            }
            if ($("#OP_Designation").val() != '') {
                $("#OP_Designation").css("border-color", "#ced4da");
                $('#OP_Designation-error').hide();
            }
            if ($("#OP_Landline_No").val() != '') {
                $("#OP_Landline_No").css("border-color", "#ced4da");
                $('#OP_Landline_No-error').hide();
            }
            if ($("#OP_Mobile_No").val() != '') {
                $("#OP_Mobile_No").css("border-color", "#ced4da");
                $('#OP_Mobile_No-error').hide();
            }
            if ($("#OP_Email").val() != '') {
                $("#OP_Email").css("border-color", "#ced4da");
                $('#OP_Email-error').hide();
            }
        } else {
            $("input[name=OP_contact_name]").val('').prop('readonly','');
            $("#OP_Address").val('').prop('readonly','');
            $("input[name=OP_Designation]").val('').prop('readonly','');
            $("input[name=OP_Landline_No]").val('').prop('readonly','');
            $("input[name=OP_Mobile_No]").val('').prop('readonly','');
            $("input[name=OP_Email]").val('').prop('readonly','');
            if ($("#OP_contact_name").val() == '') {
                $("#OP_contact_name").css("border-color", "#dc3545");
                $('#OP_contact_name-error').show();
            }
            if ($("#OP_Address").val() == '') {
                $("#OP_Address").css("border-color", "#dc3545");
                $('#OP_Address-error').show();
            }
            if ($("#OP_Designation").val() == '') {
                $("#OP_Designation").css("border-color", "#dc3545");
                $('#OP_Designation-error').show();
            }
            // if ($("#OP_Landline_No").val() == '') {
            //     $("#OP_Landline_No").css("border-color", "#dc3545");
            //     $('#OP_Landline_No-error').show();
            // }
            if ($("#OP_Mobile_No").val() == '') {
                $("#OP_Mobile_No").css("border-color", "#dc3545");
                $('#OP_Mobile_No-error').show();
            }
            if ($("#OP_Email").val() == '') {
                $("#OP_Email").css("border-color", "#dc3545");
                $('#OP_Email-error').show();
            }
        }

    });

    $("input[name=Ho_same_as_op]").on('change', function () {

        var OP_Same_Address_as_HO = $("input[name=OP_Same_Address_as_HO]").val();
        if ($(this).prop('checked') === true) {
            var OP_contact_name = $("input[name=OP_contact_name]").val();
            var OP_Address = $("#OP_Address").val();
            var OP_Designation = $("input[name=OP_Designation]").val();
            var OP_Landline_No = $("input[name=OP_Landline_No]").val();
            var OP_Mobile_No = $("input[name=OP_Mobile_No]").val();
            var OP_Email = $("input[name=OP_Email]").val();
            $("input[name=HO_Contact_name]").val(OP_contact_name).prop('readonly','true');
            $("#HO_address").val(OP_Address).prop('readonly','true');
            $("input[name=HO_Designation]").val(OP_Designation).prop('readonly','true');
            $("input[name=HO_Landline_No]").val(OP_Landline_No).prop('readonly','true');
            $("input[name=HO_Mobile_No]").val(OP_Mobile_No).prop('readonly','true');
            $("input[name=HO_Email]").val(OP_Email).prop('readonly','true');
            if ($("#HO_Contact_name").val() != '') {
                $("#HO_Contact_name").css("border-color", "#ced4da");
                $("#HO_Contact_name-error").hide();
            }
            if ($("#HO_address").val() != '') {
                $("#HO_address").css("border-color", "#ced4da");
                $("#HO_address-error").hide();
            }
            if ($("#HO_address").val() != '') {
                $("#HO_address").css("border-color", "#ced4da");
                $("#HO_address-error").hide();
            }
            if ($("#HO_Designation").val() != '') {
                $("#HO_Designation").css("border-color", "#ced4da");
                $("#HO_Designation-error").hide();
            }
            // if ($("#HO_Landline_No").val() != '') {
            //     $("#HO_Landline_No").css("border-color", "#ced4da");
            //     $("#HO_Landline_No-error").hide();
            // }
            if ($("#HO_Mobile").val() != '') {
                $("#HO_Mobile").css("border-color", "#ced4da");
                $("#HO_Mobile-error").hide();
            }
            if ($("#HO_Email").val() != '') {
                $("#HO_Email").css("border-color", "#ced4da");
                $("#HO_Email-error").hide();
            }

        } else {
            $("input[name=HO_Contact_name]").val('').prop('readonly','');
            $("#HO_address").val('').prop('readonly','');
            $("input[name=HO_Designation]").val('').prop('readonly','');
            $("input[name=HO_Landline_No]").val('').prop('readonly','');
            $("input[name=HO_Mobile_No]").val('').prop('readonly','');
            $("input[name=HO_Email]").val('').prop('readonly','');
            if ($("#HO_Contact_name").val() == '') {
                $("#HO_Contact_name").css("border-color", "#dc3545");
                $("#HO_Contact_name-error").show();
                // $("#HO_Contact_name-error").text('Please fill required field!');

            }
            if ($("#HO_address").val() == '') {
                $("#HO_address").css("border-color", "#dc3545");
                $("#HO_address-error").show();
            }
            if ($("#HO_address").val() == '') {
                $("#HO_address").css("border-color", "#dc3545");
                $("#HO_address-error").show();
            }
            if ($("#HO_Designation").val() == '') {
                $("#HO_Designation").css("border-color", "#dc3545");
                $("#HO_Designation-error").show();
            }
            // if ($("#HO_Landline_No").val() == '') {
            //     $("#HO_Landline_No").css("border-color", "#dc3545");
            //     $("#HO_Landline_No-error").show();
            // }
            if ($("#HO_Mobile").val() == '') {
                $("#HO_Mobile").css("border-color", "#dc3545");
                $("#HO_Mobile-error").show();
            }
            if ($("#HO_Email").val() == '') {
                $("#HO_Email").css("border-color", "#dc3545");
                $("#HO_Email-error").show();
            }
        }

    })
    /*============End Same as Option ==============*/
    /*================Existing Email Id =============*/

    $("#email_owner").on('keyup', function () {
        var Email_data = $(this).val();
        $.ajax({
            url: 'findfm',
            type: 'get',
            data: {
                Email_data: Email_data
            },
            success: function (data) {
                if (data.status == true && Email_data != '' && data.owner != '') {
                    $("#owner_name").val(data.owner.owner_name);
                    $("#email_name").val(data.owner.email_id);
                    $("#mobile").val(data.owner.mobile_no);
                    $("#address").val(data.owner.address_a);
                    $("#state_id").val(data.owner.state);
                    $("#district_id").html('<option value="' + data.owner.d + '">' + data.owner.d + '</option>');
                    $("#city").val(data.owner.city);
                    $("#phone").val(data.owner.phone_no);
                    $("#fax_no").val(data.owner.fax_no);
                    $("#ownerid").val(data.owner.owner_id);
                } else {
                    $("#email_owner").val('');
                    //$("#owner_name").val('');
                    $("#mobile").val('');
                    $("#address").val('');
                    $("#state_id").val('');
                    $("#district_id").html('<option value="">Select District</option>');
                    $("#city").val('');
                    $("#phone").val('');
                    $("#fax_no").val('');
                    $("#ownerid").val('');
                }


            },
            error: function (error) {
                console.log(error);
            }
        })
    })


    /*======================Existing Email Id===============*/
});

/*===================Existing IFSC Code =====================*/
$("#IFSC_code").on('keyup', function () {
    var IFSC = $(this).val();
    console.log(IFSC);
    $.ajax({
        url: '/getIFSC',
        type: 'get',
        dataType: "json",
        data: { IFSC: IFSC },
        success: function (data) {
            console.log(data);
            if (data.UPI == true && IFSC != '' && data != 'Not Found') {
                console.log(data);
                $("#bank_name").val(data.BANK);
                $("#Branch_name").val(data.BRANCH);
                $("#Bank_account_address").val(data.ADDRESS);
            } else {
                $("#bank_name").val('');
                $("#Branch_name").val('');
                $("#Bank_account_address").val('');
            }
        },
        error: function (error) {
            console.log(error);
            $("#bank_name").val('');
            $("#Branch_name").val('');
            $("#Bank_account_address").val('');
        }

    })
})

/*===================Existing IFSC Code =====================*/
$(document).ready(function () {
    $("#lo").on("click", function (e) {
        e.preventDefault();
        return false;
    });


});