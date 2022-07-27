$(document).ready(function () {
  $(".next-button").click(function () {
    var form = $("#fress_emp_form");
    form.validate({
      rules: {
        owner_name: {
          minlength: 2,
          maxlength: 80
        },
        is_primary: {
          required: true,
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
          minlength: 10,
          maxlength: 15,
          number: true
        },
        fax_no: {
          maxlength: 15,
          number: true
        },
        exist_owner_id: {
          required: true
        },
        newspaper_name: {
          required: true
        },
        place_of_publication: {
          required: true
        },
        v_email: {
          required: true,
          emailExt: true
        },
        v_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        v_address: {
          required: true
        },
        v_state: {
          required: true
        },
        v_city: {
          required: true
        },
        v_district: {
          required: true
        },
        pin_code: {
          required: true,
          minlength: 6,
          maxlength: 6,
          number: true
        },
        v_phone: {
          minlength: 10,
          maxlength: 15,
          number: true
        },
        v_fax_no: {
          maxlength: 15,
          number: true
        },
        language: {
          required: true,
        },
        periodicity: {
          required: true,
        },
        cir_base: {
          required: true,
        },
        claimed_circulation: {
          required: true,
          maxlength: 8,
          number: true
        },
        quality_paper_used: {
          required: true,
        },
        printing_colour: {
          required: true,
        },
        news_agencies_subscribed: {
          required: true,
        },
        agencies: {
          required: true,
        },
        print_area: {
          number: true
        },
        page_length: {
          required: true,
          maxlength: 4,
          number: true
        },
        page_width: {
          required: true,
          maxlength: 4,
          number: true
        },
        no_of_page: {
          required: true,
          maxlength: 7,
          number: true
        },
        total_print_area: {
          // required: true,
          maxlength: 20,
          number: true
        },
        black_white: {
          maxlength: 15,
          number: true
        },
        colour: {
          maxlength: 15,
          number: true
        },
        total_annual_turn_over: {
          maxlength: 10,
          number: true
        },
        colour_pages: {
          maxlength: 8,
          number: true
        },
        price_newspaper: {
          required: true,
          maxlength: 15,
          number: true,
        },
        distance_office_to_press: {
          maxlength: 15,
          number: true
        },
        cin_no: {
          maxlength: 15,
          number: true
        },
        publisher_name: {
          required: true,
        },
        publisher_email: {
          required: true,
          emailExt: true
        },
        publisher_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        printer_name: {
          required: true,
        },
        printer_email: {
          required: true,
          emailExt: true
        },
        printer_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        press_owned_by_owner: {
          required: true,
        },
        name_of_press: {
          required: true,
        },
        press_email: {
          required: true,
          emailExt: true
        },
        press_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        press_phone: {
          required: true,
          minlength: 10,
          maxlength: 15,
          number: true
        },
        name_of_editor: {
          required: true,
        },
        editor_email: {
          required: true,
          emailExt: true
        },
        editor_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        // ca_email: {
        //  emailExt: true
        // },
        ca_mobile: {
          minlength: 10,
          maxlength: 10,
          number: true
        },
        dm_declaration_date: {
          required: true,
        },
        account_type: {
          required: true,
        },
        bank_account_no: {
          required: true,
          minlength: 9,
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
          IFSCValidation: true
        },
        branch_name: {
          required: true,
        },
        address_of_account: {
          required: true,
        },
        pan_card: {
          required: true,
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
        rni_reg_file_name: {
          required: true,
        },
        annexure_file_name: {
          required: true,
        },
        circulation_cert_file_name: {
          required: true,
        },
        annual_return_file_name: {
          required: true,
        },
        specimen_copy_file_name: {
          required: true,
        },
        commercial_rate_file_name: {
          required: true,
        },
        no_dues_cert_file_name: {
          required: true,
        },
        gst_reg_cert_file_name: {
          required: true,
        },
        declaration_field_file_name: {
          required: true,
        },
        pan_copy_file_name: {
          required: true,
        },
        dm_declaration_file_name: {
          required: true,
        },
        change_in_address_file_name: {
          required: true,
        },
        advertisement_policy: {
          required: true
        },
        rni_registration_no: {
          required: true,
          RNIValidation: true
        },
        abc_certificate_no: {
          required: true
        },
        average_circulation_copies: {
          required: true
        },
        date_of_first_publication: {
          required: true
        },
        ca_udin_number: {
          required: true
        },
        self_declaration: {
          required: true
        }
      },
      messages: {
        owner_name: {
          minlength: "Owner name must be at least 2 alphabets!",
          maxlength: "Users can type only max 80 alphabets!"
        },
        is_primary: {
          required: "Please fill required field!",
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
          minlength: "Phone no. length should be min 10 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        exist_owner_id: {
          required: "Please fill required field!"
        },
        fax_no: {
          maxlength: "Fax length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        newspaper_name: {
          required: "Please fill required field!"
        },
        place_of_publication: {
          required: "Please fill required field!"
        },
        v_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        v_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_address: {
          required: "Please fill required field!"
        },
        v_state: {
          required: "Please fill required field!"
        },
        v_city: {
          required: "Please fill required field!"
        },
        v_district: {
          required: "Please fill required field!"
        },
        pin_code: {
          required: "Please fill required field!",
          minlength: "Pincode length should be 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_phone: {
          required: "Please fill required field!",
          minlength: "Phone no. length should be min 10 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_fax_no: {
          maxlength: "Fax length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        language: {
          required: "Please fill required field!"
        },
        periodicity: {
          required: "Please fill required field!"
        },
        cir_base: {
          required: "Please fill required field!"
        },
        claimed_circulation: {
          required: "Please fill required field!",
          maxlength: "Circulation length should be 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        quality_paper_used: {
          required: "Please fill required field!"
        },
        printing_colour: {
          required: "Please fill required field!"
        },
        news_agencies_subscribed: {
          required: "Please fill required field!"
        },
        agencies: {
          required: "Please fill required field!"
        },
        print_area: {
          number: "Users can enter only integer numbers!"
        },
        page_length: {
          required: "Please fill required field!",
          maxlength: "Page length should be 4 digit!",
          number: "Users can enter only integer numbers!"
        },
        page_width: {
          required: "Please fill required field!",
          maxlength: "Width length should be 4 digit!",
          number: "Users can enter only integer numbers!"
        },
        no_of_page: {
          required: "Please fill required field!",
          maxlength: "page length should be 7 digit!",
          number: "Users can enter only integer numbers!"
        },
        total_print_area: {
          // required: "Please fill required field!",
          maxlength: "Print Area length should be 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        black_white: {
          maxlength: "Black White length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        colour: {
          maxlength: "Color length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        total_annual_turn_over: {
          maxlength: "Annual Turn Over length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        colour_pages: {
          maxlength: "Color pages length should be 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        price_newspaper: {
          required: "Please fill required field!",
          maxlength: "Newspaper Price length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        distance_office_to_press: {
          maxlength: "Distance length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        cin_no: {
          maxlength: "CIN No. length should be 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        publisher_name: {
          required: "Please fill required field!"
        },
        publisher_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        publisher_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        printer_name: {
          required: "Please fill required field!"
        },
        printer_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        printer_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        press_owned_by_owner: {
          required: "Please fill required field!"
        },
        name_of_press: {
          required: "Please fill required field!"
        },
        press_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        press_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        press_phone: {
          required: "Please fill required field!",
          minlength: "Phone no. length should be min 10 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        name_of_editor: {
          required: "Please fill required field!"
        },
        editor_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        editor_mobile: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        // ca_email: {
        //   email: "Please enter a vaild email address!"
        // },
        ca_mobile: {
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        dm_declaration_date: {
          required: "Please fill required field!",
        },
        account_type: {
          required: "Please fill required field!",
        },
        bank_account_no: {
          required: "Please fill required field!",
          minlength: "Bank Account length min 9 digit!",
          maxlength: "Bank Account length max 20 digit!",
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
        ESI_account_no: {
          maxlength: "Account No. length should be 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        ESI_no_employees: {
          maxlength: "Employees length should be 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        EPF_account_no: {
          maxlength: "Account No. length should be 20 digit!",
          number: "Users can enter only integer numbers!"
        },
        EPF_no_of_employees: {
          maxlength: "Employees length should be 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        rni_reg_file_name: {
          required: "Please fill required field!",

        },
        annexure_file_name: {
          required: "Please fill required field!",

        },
        circulation_cert_file_name: {
          required: "Please fill required field!",

        },
        annual_return_file_name: {
          required: "Please fill required field!",

        },
        specimen_copy_file_name: {
          required: "Please fill required field!",

        },
        commercial_rate_file_name: {
          required: "Please fill required field!",

        },
        no_dues_cert_file_name: {
          required: "Please fill required field!",

        },
        gst_reg_cert_file_name: {
          required: "Please fill required field!",

        },
        declaration_field_file_name: {
          required: "Please fill required field!",

        },
        pan_copy_file_name: {
          required: "Please fill required field!",

        },
        dm_declaration_file_name: {
          required: "Please fill required field!",

        },
        advertisement_policy: {
          required: "Please fill required field!"
        },
        change_in_address_file_name: {
          required: "Please fill required field!"
        },
        rni_registration_no: {
          required: "Please fill required field!"
        },
        abc_certificate_no: {
          required: "Please fill required field!"
        },
        average_circulation_copies: {
          required: "Please fill required field!"
        },
        date_of_first_publication: {
          required: "Please fill required field!"
        },
        ca_udin_number: {
          required: "Please fill required field!"
        },
        self_declaration: {
          required: "Please select the declaration!"
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
    if (form.valid() == false) {
      $('html, body').animate({
        scrollTop: $('.is-invalid').offset().top
      }, 2000);
    }
    if (form.valid() === true) {
      if ($('#tab1').is(":visible")) {
        current_fs = $('#tab1');
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");
        nextSaveData('next_tab_1');
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
        nextSaveData('next_tab_2');
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
        nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");

      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab4']").addClass("active");
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
      $("a[id='#tab2']").removeClass("active");
      $("a[id='#tab1']").addClass("active");
      $("#next_tab_3").val("0");

    } else if ($('#tab3').is(":visible")) {
      current_fs = $('#tab3');
      next_fs = $('#tab2');
      $("a[id='#tab3']").removeClass("active");
      $("a[id='#tab2']").addClass("active");

    } else if ($('#tab4').is(":visible")) {
      current_fs = $('#tab4');
      next_fs = $('#tab3');
      $("a[id='#tab4']").removeClass("active");
      $("a[id='#tab3']").addClass("active");
    }

    next_fs.show();
    current_fs.hide();
  });
  //email validation formate
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a vaild email address');

});

jQuery.validator.addMethod("RNIValidation", function (value) {

  var claimed_circulation_hidden = $("#claimed_circulation_hidden").val();
  console.log(claimed_circulation_hidden);
  if (checkRegCIRBase(value) == true) {
    if (claimed_circulation_hidden) {
      $("#claimed_circulation").css("border-color", "#ced4da");
      $("#claimed_circulation-error").hide();
    }
    $("#rni_registration_no").css("border-color", "#ced4da");
    $("#rni_registration_no-error").hide();
    return true;
  } else (value == '')
  {
    $("#rni_reg_no").hide();
  }

}, '');

// use for IFSC
jQuery.validator.addMethod("IFSCValidation", function (value) {

  var bank_name = $("#bank_name").val();
  var branch_name = $("#branch_name").val();
  var address_of_account = $("#address_of_account").val(); console.log(bank_name);
  if (bank_name != '' && branch_name != '' && address_of_account != '') {
    $("#bank_name").css("border-color", "#ced4da");
    $("#bank_name-error").hide();
    $("#branch_name").css("border-color", "#ced4da");
    $("#branch_name-error").hide();
    $("#address_of_account").css("border-color", "#ced4da");
    $("#address_of_account-error").hide();
    $("#ifsc_code").css("border-color", "#ced4da");
    return true;
  }
   else (value == '')
  {
    $("#alert_ifsc_code").hide();
  }

}, '');
$(".custom-file-img").change(function () {
  var id = $(this).attr("id");
  var file = this.files[0].name;
  var file1 = $('#' + id + 2).text();

  var totalBytes = this.files[0].size;
  var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
  var ext = file.split('.').pop();
  if (file != '' && sizemb <= 2 && ext == "png" || ext == "jpg" || ext =="jpeg") {
    $("#" + id + 2).empty();
    $("#" + id + 2).text(file);
    $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
    $("#" + id + 4).show();
    $("#" + id + 1).hide();
    if ($("#doc_data").val() == '') {
      $("#doc_data").val(file);
    } else {
      var names = $("#doc_data").val();
      var numbersArray = names.split(',');

      if (isInArray(file, numbersArray) == false) {
        $("#doc_data").val(function () {
          return $("#doc_data").val() + ',' + file;
        });
        var namess = $("#doc_data").val();
        var numbersArray1 = namess.split(',');
        numbersArray1 = $.grep(numbersArray1, function (value) {
          return value != file1;
        });
        $("#doc_data").val(numbersArray1);
        $("#" + id + 1).hide();
      } else {
        var namess = $("#doc_data").val();
        var numbersArray1 = namess.split(',');
        numbersArray1 = $.grep(numbersArray1, function (value) {
          return value != file1;
        });
        $("#doc_data").val(numbersArray1);
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + 1).text('File already selected!');
        $("#" + id + 1).show();
        $("#" + id + "-error").addClass("hide-msg");
      }
    }
  } else {
    $("#" + id).val('');
    $("#" + id + 2).text("Choose file");
    $("#" + id + 1).text('File size should be 2MB and file should be image!');
    $("#" + id + 1).show();
    $("#" + id + 3).html("Upload").addClass("input-group-text");
    $("#" + id + "-error").addClass("hide-msg");
    $("#" + id + 4).hide();
  }
});