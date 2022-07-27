$(document).ready(function () {
  $(".next-button").click(function () {
    var form = $("#print_fress_emp_renewal");
    form.validate({
      rules: {
        owner_name:{
          required: true,
          minlength: 3,
          maxlength: 80
        },
        owner_type:{
          required: true
        },
        email:{
          required: true,
          emailExt: true
        },
        mobile:{
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        address:{
          required: true
        },
        v_email: {
          required: true,
          emailExt: true
        },
        v_mobile:{
          required: true,
          minlength: 10,
          number: true
        },
        v_address: {
          required: true
        },
        editor_mobile:{

          minlength: 10,
          number: true
        },        
        press_mobile:{

          minlength: 10,
          number: true
        },
        v_phone: {
          minlength: 6,
          maxlength: 15,
          number: true
        },
        pin_code:{
          required:true,
          minlength: 6,
          maxlength: 6,
          number: true
        },
        cir_base: {
          required: true
        },
        claimed_circulation: {
          required: true,
          maxlength: 8,
          number: true
        },
        printing_colour: {
          required: true,
        },
        page_length: {
          required: true,
          maxlength: 5,
          number: true
        },
        page_width: {
          required: true,
          maxlength: 5,
          number: true
        },
        colour_pages: {
          maxlength: 8,
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
          required: true
        },
        printer_email: {
          required: true,
          emailExt: true
        },
        
        dm_declaration_date: {
          required: true
        },
        Circulation_File_Name: {
          required: true
        },
        DMD_File_Name: {
          required: true
        },
        advertisement_policy: {
          required: true
        },
        rni_registration_no: {
          required: true
        },
        // GST_No: {
        //   required: true
        // },
        abc_certificate_no: {
          required: true
        },
        no_dues_cert_file_name: {
          required: true
        },
        gst_reg_cert_file_name: {
          required: true
        },
        annexure_file_name:{
          required:true
        },
        annual_return_file_name:{
          required:true
        },
        circulation_cert_file_name:{
          required:true
        },
        no_of_page:{
          required:true,
          number:true
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
          minlength: 6,
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
        ca_mobile:{
          minlength: 10,
          maxlength: 10,
          number: true
        },
        ca_udin_number: {
          required: true
        },
        // profile_picture:{
        //   required:true
        // },
        // vendor_scan_signature:{
        //   required:true
        // }
      },
      messages: {
        owner_name:{
          required: "Please fill required field!",
          minlength: "Owner name must be at least 3 alphabets!",
          maxlength: "Users can type only max 80 alphabets!"
        },
        v_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        v_address: {
          required: "Please fill required field!"
        },
        v_mobile:{
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        editor_mobile:{
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },        
        press_mobile:{
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        v_phone: {
          minlength: "Phone no. length should be min 6 digit!",
          maxlength: "Phone no. length should be max 15 digit!",
          number: "Users can enter only integer numbers!"
        },
        pin_code: {
          required: "Please fill required field!",
          minlength: "Pincode length should be min 6 digit!",
          maxlength: "Pincode length should be max 6 digit!",
          number: "Users can enter only integer numbers!"
        },
        cir_base: {
          required: "Please fill required field!"
        },
        claimed_circulation: {
          required: "Please fill required field!",
          maxlength: "Circulation length should be min and max 8 digit!",
          number: "Users can enter only integer numbers!"
        },
        printing_colour: {
          required: "Please fill required field!"
        },
        page_length: {
          required: "Please fill required field!",
          maxlength: "Page length should be min and max 5 digit!",
          number: "Users can enter only integer numbers!"
        },
        page_width: {
          required: "Please fill required field!",
          maxlength: "Width length should be min and max 5 digit!",
          number: "Users can enter only integer numbers!"
        },
        colour_pages: {
          maxlength: "Color pages length should be min and max 8 digit!",
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
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
       
        printer_name: {
          required: "Please fill required field!"
        },
        printer_email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
       
        dm_declaration_date: {
          required: "Please fill required field!",
        },
        Circulation_File_Name: {
          required: "Please fill required field!",
        },
        DMD_File_Name: {
          required: "Please fill required field!"
        },
        advertisement_policy: {
          required: "Please select the declaration!"
        },
        rni_registration_no: {
          required: "Please fill required field!"
        },
        // GST_No: {
        //   required: "Please fill required field!"
        // },
        abc_certificate_no: {
          required: "Please fill required field!"
        },
        no_dues_cert_file_name: {
          required: "Please fill required field!"
        },
        gst_reg_cert_file_name: {
          required: "Please fill required field!"
        },
        annexure_file_name:{
          required:"Please fill required field!"
        },
        annual_return_file_name:{
          required:"Please fill required field!"
        },
        circulation_cert_file_name:{
          required:"Please fill required field!"
        },
        no_of_page:{
          required:"Please fill required field!",
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
          minlength: "Phone no. length should be min 6 digit!",
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
        ca_mobile:{
          minlength: "Mobile length should be 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        ca_udin_number: {
          required: "Please fill required field!"
        },
        // profile_picture:{
        //   required:"Please fill required field!"
        // },
        // vendor_scan_signature:{
        //   required:"Please fill required field!"
        // }
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
        renewalSaveData('next_tab_1');
        $("#next_tab_1").val("0");
      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
        renewalSaveData('next_tab_2');
        $("#next_tab_2").val("0");
      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[id='#tab4']").addClass("active");
        renewalSaveData('submit_btn');
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
      $("#next_tab_2").val("0");
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

///////////// calculate total print area /////////

$(document).ready(function () {
  $('#page_length').keyup(calculate);
  $('#page_width').keyup(calculate);
  $('#no_of_page').keyup(calculate);
});
function calculate(e) {
  var pages = 1;
  if ($('#no_of_page').val() != 0) {
    pages = $('#no_of_page').val();
  }
  var num = $('#page_length').val() * $('#page_width').val() * pages;
  var areaperpage = $('#page_length').val() * $('#page_width').val();
  $('#print_area').val(areaperpage.toFixed(2));
  $('#total_print_area').val(num.toFixed(2));
}
function changeCompAddr(val) {
  if (val == 1) {
      $("#change_info_doc").removeClass("hide-msg");
  } else {
      $("#change_info_doc").addClass("hide-msg");
  }
}
////////////// file upload size  512kb ////////////////
$(document).ready(function () {
  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb <= 2 && ext == "pdf") {
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
      $("#" + id + 1).text('File size should be 2MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
      $("#" + id + 4).hide();
    }
  });
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
});
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

$("#colour_pages").keyup(function () {
  var pages = $("#no_of_page").val();
  //alert( parseInt(pages));
  if (pages == '' || parseInt($(this).val()) > parseInt(pages)) {
    $("#alert_colour_pages").text('Color pages value should be less than or equal to no. of pages').show();
  } else {
    $("#alert_colour_pages").hide();
  }
});

function removezero(val) {
  if (val == 0) {
    $("#claimed_circulation").val('');
  }
}

function latestDmCertificate(val) {
  if (val == 1) {
    $("#dm_certificate").removeClass("hide-msg");
    $("#GST_No").attr('readonly', false);
    $("#latest_dm_certificate").show();
    //$("#GST_No").val('');    
  } else {
    $("#dm_certificate").addClass("hide-msg");
    $("#GST_No").attr('readonly', true);
    $("#latest_dm_certificate").hide();
    // $("#GST_No").val(' ');
  }
}

// start cir based validation
$(document).ready(function () {
  $("#cir_base").change(function () {
    $("#rni_reg_no_verified").val(0);
    $("#claimed_circulation_verified").val(0);
    $("#rni_annual_valid").val(0);
    $("#abc_reg_no_verified").val(0);
    $("#rni_claimed_cirl").hide();
    $("#rni_efill_no").hide();
    $("#abc_cert_no").hide();
    $("#abc-certificate").hide();
    if ($(this).val() == 0) {
      $("#rni-efilling").show();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_registration_no").prop("readonly", false);
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#rni_cert").show();
      $("#form2_rni_cert").show();
      $("#abc-certificate").hide();
      $("#rni_regist_no").show();
      $("#newspaper_name").prop("readonly", true);
      $("#udin_number").hide();
    } else if ($(this).val() == 3) {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").prop("readonly", true);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#abc-certificate").show();
      $("#rni_regist_no").hide();
      $("#udin_number").hide();
    } else if ($(this).val() == 1) {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#abc-certificate").hide();
      $("#rni_regist_no").hide();
      $("#udin_number").show();
      $("#newspaper_name").prop("readonly", false);
  }  else {
      $("#rni-efilling").hide();
      $("#rni_reg_no").hide();
      $("#rni_registration_no").val('');
      $("#rni_efiling_no").val('');
      $("#claimed_circulation").val('');
      $("#rni_efiling_no").prop("readonly", false);
      $("#claimed_circulation").prop("readonly", false);
      $("#newspaper_name").prop("readonly", false);
      $("#newspaper_name").val('');
      $("#rni_cert").hide();
      $("#form2_rni_cert").hide();
      $("#rni_regist_no").hide();
      $("#udin_number").hide();
    }
  });
});

function checkGstUnique(val) {
  var ownerid = $("#ownerid").val();
  // console.log(ownerid)
  if (val != '') {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url: "check-renewal-gstno",
      data: {
        gst_no: val,
        ownerid: ownerid
      },
      success: function (data) {
        if (data['status'] == true) {
          if ($('.gstvalidationMsg').hasClass('alert-info-msg') == true) {
            $('.gstvalidationMsg').addClass('alert-info-msg2');
            $('.gstvalidationMsg').text(data['message']);
            $('.validcheck').html("");
          }
        }
      },
      error: function (error) {
        console.log('error');
      }
    });
  }
}

// Check Unique email Data vendor
function checkUniqueEmailVendor(id, val) {
  if (val != '') {
    var email = val;
    var np_code = $("#newspaper_code").val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'GET',
      url: 'check-renewal-unique-email-vendor',
      data: { email: email, np_code: np_code },
      success: function (response) {
        if (response.status == 1) {
          console.log(response);
          $("#v_alert_" + id).html(response.message);
          $("#v_alert_" + id).show();
          $("#v_" + id).val('');
        } else {
          $("#v_alert_" + id).hide();
        }
      }
    });
  }
}

function checkRegCIRBase(val) {
  var cir_no = $("#cir_base").val();
  var np_code = $("#newspaper_code").val();
  var periodicity = $('#periodicity').val();
 console.log(val);
  if (val != '' && cir_no != '') {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "get",
      url:'check-regno-cir',
      data: {
        cir_no: cir_no,
        reg_no: val,
        np_code: np_code,
        periodicity:periodicity
      },
      success: function (data) {
        if (data.status == true) {
          console.log(data);
          // if(data.data == ''){
          //   $("#rni_registration_no").val('');
          //   $("#rni_reg_no").text(data.message).show().css("color", "red");
          // }else{
          $("#rni_reg_no").text(data.message).show().css("color", "green");
          $("#abc_cert_no").text(data.message).show().css("color", "green");
          // console.log(data.data);
          if (cir_no == 0) {
            $("#rni_efiling_no").val(data.data['EFILE']);
            $("#rni_efiling_no").prop("readonly", true);
            $("#rni_efill_no").text(data.message).show().css("color", "green");
            // let efiling_no_valid = data['Efiling Number Valid'];
            // let efiling_verified = data['Efiling Veryfied'];
            //  console.log(data.data['Efiling Number Valid']);
            if (($.trim(data.data['Efiling Number Valid']) == 'Yes') && ($.trim(data.data['Efiling veryfied']) == 'Yes')) {
              $("#rni_annual_valid").val(1);
            }
            $("#newspaper_name").val(data.data['T_NAME']);
            $("#newspaper_name").prop("readonly", true);
            $("#rni_reg_no_verified").val(1);
            $("#claimed_circulation").val(data.data['sold_circ']);
            $("#claimed_circulation_hidden").val(data.data['sold_circ']);
            $("#claimed_circulation_verified").val(1);
            let page_length = data.data['PageHeight'];
            let pageLen =   (Math.round(page_length * 100) / 100).toFixed(2);
            let pageWidth = (Math.round(data.data['PageWidth'] *100) /100).toFixed(2);
            $("#page_length").val(pageLen);
            $("#page_width").val(pageWidth);
            var pages = 1;
            if ($('#no_of_page').val() != 0) {
              pages = $('#no_of_page').val();
            }
            var num = $('#page_length').val() * $('#page_width').val() * pages;
            var areaperpage = $('#page_length').val() * $('#page_width').val();
            $('#print_area').val(areaperpage.toFixed(2));
            $('#total_print_area').val(num.toFixed(2));

            if (parseInt(data.data['sold_circ']) > 25000) {
              $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
              $("#no_dues_cert").show();
              $("#abc_rni_cert").show();
  
            } else {
              $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
              $("#no_dues_cert").hide();
              $("#abc_rni_cert").hide();
            }

          } else if (cir_no == 3) {
            $("#abc_reg_no_verified").val(1);
            $("#newspaper_name").val(data.data['Publication Name']);
            $("#newspaper_name").prop("readonly", true);
            $("#claimed_circulation").val(data.data['Sold Circulation']);
            $("#claimed_circulation_hidden").val(data.data['Sold Circulation']);
            $("#claimed_circulation_verified").val(1);

            if (parseInt(data.data['Sold Circulation']) > 25000) {
              $("#rni_claimed_cirl").text('PCI no dues certificate is mandatory at tab 4').show().css("color", "#f8b739");
              $("#no_dues_cert").show();
              $("#abc_rni_cert").show();
  
            } else {
              $("#rni_claimed_cirl").text(data.message).show().css("color", "green");
              $("#no_dues_cert").hide();
              $("#abc_rni_cert").hide();
            }
          }

       
          // }
          console.log("success");
        } else {
          if (data.message == 'Data already exist!' && cir_no == 0) {
            console.log(data);
            $("#rni_registration_no").val('');
            $("#rni_reg_no").text(data.message).show().css("color", "red");
          } else if (data.message == 'Data already exist!' && cir_no == 3) {
            $("#abc_certificate_no").val('');
            $("#abc_cert_no").text(data.message).show().css("color", "red");
          } else {
            $("#rni_reg_no").text(data.message).show().css("color", "#f8b739");
            $("#abc_cert_no").text(data.message).show().css("color", "#f8b739");
            $("#rni_claimed_cirl").hide();
            $("#rni_efill_no").hide();
            if (cir_no == 0) {
              $("#rni_efiling_no").val('');
            }
            $("#claimed_circulation").val('');
            $("#rni_efiling_no").prop("readonly", false);
            $("#rni_reg_no_verified").val(0);
            $("#claimed_circulation_verified").val(0);
            $("#rni_annual_valid").val(0);
            $("#newspaper_name").val('');
          }
        }
      },
      error: function (error) {
        console.log('error');
      }
    });
  }
}

$(document).ready(function () {
  $("#claimed_circulation").on('change', function () {
    var cir_val = $("#claimed_circulation").val();
   // console.log(cir_val);
    if (parseInt(cir_val) > 25000) {
      $("#no_dues_cert").show();
      $('#abc_rni_cert').show();
    } else {
      $("#no_dues_cert").hide();
      $('#abc_rni_cert').hide();
    }
  });
});

function checkCirculation(val) {
  if (val != '') {
    if (parseInt(val) == parseInt($("#claimed_circulation_hidden").val()) && parseInt(val) < 25000) {
      $("#rni_claimed_cirl").text("Verified").show().css("color", "green");
      $("#claimed_circulation_verified").val(1);
    } else {
      var msg = '';
      if ($("#cir_base").val() == 1) {
        msg = '';
      } else {
        msg = 'Not verified';
      }
      $("#rni_claimed_cirl").text(msg).show().css("color", "#f8b739");
      $("#claimed_circulation_verified").val(0);
    }
    if (parseInt(val) > 25000) {
      $("#no_dues_cert").removeClass('hide-msg');
    } else {
      $("#no_dues_cert").addClass('hide-msg');
    }
  }
}

//agencies show hide
$('#agenciesDiv').hide();
var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();

if (news_agencies_subscribed == "8") {
    $('#agenciesDiv').show();
} else {
    $('#agenciesDiv').hide();
}
$('#news_agencies_subscribed').change(function () {
  
    var news_agencies_subscribed = $('#news_agencies_subscribed option:selected').val();
    if (news_agencies_subscribed == "") {
        $('#agenciesDiv').hide();
    } else if (news_agencies_subscribed == "8") {
        $('#agenciesDiv').show();
    } else {
        $('#agenciesDiv').hide();
    }
})