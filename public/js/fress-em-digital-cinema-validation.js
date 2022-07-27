// Alphabetic validation
function alphaOnly(event) {
  var inputValue = event.charCode;
  if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
    event.preventDefault();
  }
}
//Ajax function
function AddDigitaldata() {
  var data = new FormData($("#digita_cinema")[0]);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    url: '/DGCOwner',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      console.log(data);
      $("#ownerid").val(data.data);
    }
  });
}
//NO. of seats data
function Addseatsdata() {
  var data = new FormData($("#digita_cinema")[0]);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    url: '/DigitalSeats',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      console.log(data);
      $("#ownerid").val(data.data);
    }
  });
}
//Save Account Details
function AddaccountDetails() {
  var data = new FormData($("#digita_cinema")[0]);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    url: '/AccountDetails',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      console.log(data);
      $("#ownerid").val(data.data);
    }
  });
}

//Save DOC Details
$("#Final_submi").hide();
function AddDOCDetails() {
  var data = new FormData($("#digita_cinema")[0]);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    url: '/SaveDocFile',
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      console.log(data);
      $("#Final_submi").show();
      $("#Final_submi").text(data.message);
      setTimeout(function () {
        window.location.href = 'digital-cinema';
      }, 5000);
    }
  });
}

$(document).ready(function () {
  $(".fm-digital-cinema").click(function () {
    var form = $("#digita_cinema");
    form.validate({
      rules: {
        Owner_Name: {
          required: true,
          minlength: 5,
          maxlength: 100
        },
        digital_email: {
          required: true,
          emailExt: true
        },
        digital_mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        digital_address: {
          required: true
        },
        digital_city: {
          required: true
        },
        digital_state: {
          required: true
        },
        digital_district: {
          required: true
        },
        Authorized_Rep_Name: {
          required: true,
        },
        AR_Address: {
          required: true,
        },
        // AR_Landline_No: {
        //   required: true,
        // },
        AR_Email: {
          required: true,
        },
        AR_Mobile_No: {
          required: true,
        },
        Head_name: {
          required: true
        },
        Head_state: {
          required: true,
        },
        Head_district: {
          required: true,
        },
        Head_city: {
          required: true,
        },
        Head_address: {
          required: true,
        },
        Head_Designation: {
          required: true,
        },
        // Head_Landline_No: {
        //   required: true,
        // },
        Head_Mobile_No: {
          required: true,
        },
        Head_Email: {
          required: true,
        },
        Location_Contact_name: {
          required: true,
        },
        Location_state: {
          required: true,
        },
        Location_district: {
          required: true,
        },
        Location_city: {
          required: true,
        },
        Location_address: {
          required: true,
        },
        Location_Designation: {
          required: true,
        },
        // Location_Landline_No: {
        //   required: true,
        // },
        Location_Mobile_No: {
          required: true,
        },
        Location_Email: {
          required: true,
        },
        /*Tab Second validation start*/

        "company_name[]": {
          required: true
          //required: true
        },
        "exc_agency_name[]": {
          required: true
          //required: true
        },
        "teatre_name[]": {
          required: true,
        },
        "excel_state[]": {
          required: true,
        },
        "excel_district[]": {
          required: true,
        },
        "excel_city[]": {
          required: true,
        },
        "excel_address[]": {
          required: true,
        },
        "excel_pin_code[]": {
          required: true,
        },
        "excel_Seating_Capacity[]": {
          required: true,
        },
        "excel_Screen_type[]": {
          required: true,
        },
        "excel_Web_code[]": {
          required: true,
        },

        /*Tab Second validation End*/

        /*Tab Third validation Start*/
        bank_account_no: {
          required: true,
        },
        account_holder_name: {
          required: true,
        },

        bank_name: {
          required: true,
        },
        IFSC_Code: {
          IFSCvalid: true,
        },
        branch: {
          required: true,
        },
        address_account: {
          required: true,
        },
        PAN: {
          Panvalid: true,
        },
        GST_No: {
          testva: true,
        },
        esi_account_no: {
          required: true,
        },
        esi_no_employees_covered: {
          required: true,
        },
        epf_account_no: {
          required: true,
        },
        epf_no_employees_covered: {
          required: true,
        },
        /*Tab Third validation End*/

        /* tab 4 validation start */
        agreement_parties: {
          required: true,
        },
        Balance_sheet: {
          required: true,
        },
        Certificate_Incorporation: {
          required: true,
        },
        Self_declaration: {
          required: true
        },
        file: {
          required: true
        },
        /* tab 4 validation start */

      },
      messages: {
        Owner_Name: {
          required: "Please fill required field!",
          minlength: "Agency name must be at least 5 alphabets!",
          maxlength: "Users can type only max 100 alphabets!"
        },
        email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        digital_mobile: {
          required: "Please fill required field!",
          maxlength: "Mobile length should be max and min 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        digital_address: {
          required: "Please fill required field!"
        },
        digital_city: {
          required: "Please fill required field!"
        },
        digital_state: {
          required: "Please fill required field!"
        },
        digital_district: {
          required: "Please fill required field!"
        },
        /*Tab second validation start*/
        agency_contract_details: {
          required: "Please fill required field!"
        },
        Authorized_Rep_Name: {
          required: "Please fill required field!",
        },
        AR_Address: {
          required: "Please fill required field!",
        },
        // AR_Landline_No: {
        //   required: "Please fill required field!",
        // },
        AR_Email: {
          required: "Please fill required field!",
        },
        AR_Mobile_No: {
          required: "Please fill required field!",
        },
        Head_name: {
          required: "Please fill required field!",
        },
        Head_state: {
          required: "Please fill required field!",
        },
        Head_district: {
          required: "Please fill required field!",
        },
        Head_city: {
          required: "Please fill required field!",
        },
        Head_address: {
          required: "Please fill required field!",
        },
        Head_Designation: {
          required: "Please fill required field!",
        },
        // Head_Landline_No: {
        //   required: "Please fill required field!",
        // },
        Head_Mobile_No: {
          required: "Please fill required field!",
        },
        Head_Email: {
          required: "Please fill required field!",
        },
        Location_Contact_name: {
          required: "Please fill required field!",
        },
        Location_state: {
          required: "Please fill required field!",
        },
        Location_district: {
          required: "Please fill required field!",
        },
        Location_city: {
          required: "Please fill required field!",
        },
        Location_address: {
          required: "Please fill required field!",
        },
        Location_Designation: {
          required: "Please fill required field!",
        },
        // Location_Landline_No: {
        //   required: "Please fill required field!",
        // },
        Location_Mobile_No: {
          required: "Please fill required field!",
        },
        Location_Email: {
          required: "Please fill required field!"
        },
        screen_unique_code: {
          required: "Please fill required field!"
        },
        number_screens: {
          required: "Please fill required field!"
        },

        /* tab third validation start */
        bank_account_no: {
          required: "Please fill required field!"
        },
        account_holder_name: {
          required: "Please fill required field!"
        },

        bank_name: {
          required: "Please fill required field!"
        },

        IFSC_Code: {
          required: "Please fill required field!"
        },
        branch: {
          required: "Please fill required field!"
        },
        address_account: {
          required: "Please fill required field!"
        },

        PAN: {
          required: "Please fill required field!"
        },
        esi_account_no: {
          required: "Please fill required field!"
        },

        esi_no_employees_covered: {
          required: "Please fill required field!"
        },
        epf_account_no: {
          required: "Please fill required field!"
        },
        epf_no_employees_covered: {
          required: "Please fill required field!"
        },
        /* tab third validation End  */
        /* tab 4 validation start */
        agreement_parties: {
          required: "Please fill required field!"
        },
        Balance_sheet: {
          required: "Please fill required field!"
        },
        Certificate_Incorporation: {
          required: "Please fill required field!"
        },
        Self_declaration: {
          required: "Please select the declaration!"
        },
        file: {
          required: "Please upload excel file!"
        },
        /* tab 4 validation end */
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
        //Store Owner Details
        AddDigitaldata();
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");
        //nextSaveData('next_tab_1');
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        Addseatsdata();
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
        //nextSaveData('next_tab_2');
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        AddaccountDetails();
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
        //nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");

      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        AddDOCDetails();
        next_fs = $('#tab4');
        $("a[id='#tab4']").addClass("active");
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
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a valid email address');

  jQuery.validator.addMethod("pannumber", function (value, element, param) {
    return value.match(/^[A-z]{5}\d{4}[A-Z]{1}$/);
  }, 'Please enter a valid PAN Number');

  jQuery.validator.addMethod("ifsccode", function (value, element, param) {
    return value.match(/^[A-Z]{4}0[0-9]{6}$/);
  }, 'Please enter a valid IFSC Code');
});
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
/*===============End IFCS Code Validation===================*/


function onlyAlphabets(e, t) {
  try {
    if (window.event) {
      var charCode = window.event.keyCode;
    }
    else if (e) {
      var charCode = e.which;
    }
    else { return true; }
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
      return true;
    else
      return false;
  }
  catch (err) {
    alert(err.Description);
  }

}

///alpha numeric
function isAlphaNumeric(e) { // Alphanumeric only
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || k == 0);
}

function onlyNumberKey(evt) {

  // Only ASCII character in that range allowed
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}

// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {

  var charCode = (evt.which) ? evt.which : event.keyCode

  if (
    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
    (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
    (charCode < 48 || charCode > 57))
    return false;

  return true;
}
//float validation



//check fax length
function IsAlphaNumeric(e) {
  // alert(e.keyCode);
  var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
  var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <=

    122) || (keyCode == 32));
  document.getElementById("error").style.display = ret ? "none" : "inline";
  return ret;
}

// alphanumeric

function Validate(e) {
  var keyCode = e.keyCode || e.which;
  var errorMsg = document.getElementById("lblErrorMsg");
  //errorMsg.innerHTML = "";

  //Regex to allow only Alphabets Numbers Dash Underscore and Space
  var pattern = /^[a-z\d\-_\s]+$/i;

  //Validating the textBox value against our regex pattern.
  var isValid = pattern.test(String.fromCharCode(keyCode));
  if (!isValid) {
    errorMsg.innerHTML = "Invalid Attempt, only alphanumeric, dash , underscore and space are allowed.";
  }

  return isValid;
}
////////////// file upload size  512kb ////////////////
$(document).ready(function () {
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  $(".custom-input").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);

    var ext = file.split('.').pop();
    var nolimit = '';
    if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
      nolimit = id;
    }
    if (file != '' && (sizemb <= 20 || nolimit != '') && ext == "pdf") {
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
      $("#" + id + 1).text('File size should be 20MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
      $("#" + id + 4).hide();
      $('#greater_then20mb').show();
      $('#agreement_parties').hide();
      $('#agreement_parties2').hide();
      $('#agreement_parties3').hide();
    }
  });
});


$(document).ready(function () {
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  $(".custom-upload").change(function () {
    var id = $(this).attr("id");
    var file = this.files[0].name;
    var file1 = $('#' + id + 2).text();

    var totalBytes = this.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);

    var ext = file.split('.').pop();
    var nolimit = '';
    if (id == 'specimen_copy_file_name' || id == 'rni_reg_file_name' || id == 'annual_return_file_name') {
      nolimit = id;
    }
    if (file != '' && (sizemb <= 2 || nolimit != '') && ext == "pdf") {
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
});



/*End File Upload*/

//Get District

$(document).on('change', '.Digital_state', function () {
  var id = $(this).attr("digital-dist");
  var State_code = $(this).val();
  $("#" + id).empty();
  $.ajax({
    url: '/DigitalgetDistricts',
    type: 'get',
    data: { State_code: State_code },
    success: function (data) {

      $("#" + id).html(data);
    }
  })
})

$(document).on('change', '.Digital_state', function () {
  var id = $(this).attr("digital-city");
  var State_code = $(this).val();
  $("#" + id).empty();
  $.ajax({
    url: '/get-digital-city',
    type: 'get',
    data: { State_code: State_code },
    success: function (data) {
      $("#" + id).html(data);
    }
  })
})


/*===================Existing IFSC Code =====================*/
// $(document).ready(function () {
//   $("#IFSC_Code").on('keyup', function () {
//     var IFSC = $(this).val();
//     console.log(IFSC);
//     if (IFSC != '') {
//       $.ajax({
//         url: "https://ifsc.razorpay.com/" + IFSC,
//         type: 'get',
//         success: function (data) {
//           console.log(data);
//           if (data.UPI == true && IFSC != '') {
//             $("#bank_name").val(data.BANK);
//             $("#branch_name").val(data.BRANCH);
//             $("#address_of_account").val(data.ADDRESS);
//           }
//           else {
//             $("#bank_name").val('');
//             $("#branch_name").val('');
//             $("#address_of_account").val('');
//           }
//         },
//         error: function (error) {
//           console.log("Not Found !");
//           $("#bank_name").val('');
//           $("#branch_name").val('');
//           $("#address_of_account").val('');
//         }

//       })
//     }

//   })
// })

$("#IFSC_Code").on('keyup', function () {
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

$(document).ready(function () {

  $("#loc_Same_Address_as_HQ").on('change', function () {
    if ($(this).prop('checked') === true) {
      var loc_Same_Address_as_HQ = $("input[loc_Same_Address_as_HQ]").val();
      var Head_name = $("input[name=Head_name]").val();
      var Head_address = $("#Head_address").val();
      var Head_Designation = $("input[name=Head_Designation]").val();
      var Head_Landline_No = $("input[name=Head_Landline_No]").val();
      var Head_Mobile_No = $("input[name=Head_Mobile_No]").val();
      var Head_Email = $("input[name=Head_Email]").val();
      var Head_state = $("#Head_state option:selected").val();
      var Head_district = $("#Head_district option:selected").val();
      var Head_city = $("#Head_city option:selected").val();
      $("input[name=Location_Contact_name]").val(Head_name);
      $("#Location_address").val(Head_address);
      $("input[name=Location_Designation]").val(Head_Designation);
      $("input[name=Location_Landline_No]").val(Head_Landline_No);
      $("input[name=Location_Mobile_No]").val(Head_Mobile_No);
      $("input[name=Location_Email]").val(Head_Email);
      $("#Location_state").val(Head_state);
      $("#Location_district").html("<option value='" + Head_district + "'>" + Head_district + "</option>");
      $("#Location_city").html("<option value='" + Head_city + "'>" + Head_city + "</option>");
      //Error hide 
      if ($("#Location_Contact_name").val() != '') {
        $("#Location_Contact_name").css("border-color", "#ced4da");
        $('#Location_Contact_name-error').hide();
      }
      if ($("#Location_address").val() != '') {
        $("#Location_address").css("border-color", "#ced4da");
        $('#Location_address-error').hide();
      }
      if ($("#Location_Designation").val() != '') {
        $("#Location_Designation").css("border-color", "#ced4da");
        $('#Location_Designation-error').hide();
      }
      if ($("#Location_state").val() != '') {
        $("#Location_state").css("border-color", "#ced4da");
        $('#Location_state-error').hide();
      }
      if ($("#Location_district").val() != '') {
        $("#Location_district").css("border-color", "#ced4da");
        $('#Location_district-error').hide();
      }
      if ($("#Location_city").val() != '') {
        $("#Location_city").css("border-color", "#ced4da");
        $('#Location_city-error').hide();
      }
      // if ($("#Location_state").val() != '') {
      //   $("#Location_Landline_No").css("border-color", "#ced4da");
      //   $('#Location_Landline_No-error').hide();
      // }
      if ($("#Location_Mobile_No").val() != '') {
        $("#Location_Mobile_No").css("border-color", "#ced4da");
        $('#Location_Mobile_No-error').hide();
      }
      if ($("#Location_Email").val() != '') {
        $("#Location_Email").css("border-color", "#ced4da");
        $('#Location_Email-error').hide();
      }
    } else {
      $("input[name=Location_Contact_name]").val('');
      $("#Location_address").val('');
      $("input[name=Location_Designation]").val('');
      $("input[name=Location_Landline_No]").val('');
      $("input[name=Location_Mobile_No]").val('');
      $("input[name=Location_Email]").val('');
      $("#Location_state").val('');
      $("#Location_district").html('<option value="">Select District</option>');
      $("#Location_city").html('<option value="">Select City</option>');
      if ($("#Location_Contact_name").val() == '') {
        $("#Location_Contact_name").css("border-color", "#dc3545");
        $('#Location_Contact_name-error').show();
        $('#Location_Contact_name-error').text('Please fill required field!').css("border-color", "#dc3545");
      }
      if ($("#Location_address").val() == '') {
        $("#Location_address").css("border-color", "#dc3545");
        $('#Location_address-error').show();
      }
      if ($("#Location_Designation").val() == '') {
        $("#Location_Designation").css("border-color", "#dc3545");
        $('#Location_Designation-error').show();
      }
      if ($("#Location_state").val() == '') {
        $("#Location_state").css("border-color", "#dc3545");
        $('#Location_state-error').show();
      }
      if ($("#Location_district").val() == '') {
        $("#Location_district").css("border-color", "#dc3545");
        $('#Location_district-error').show();
      }
      if ($("#Location_city").val() == '') {
        $("#Location_city").css("border-color", "#dc3545");
        $('#Location_city-error').show();
      }
      // if ($("#Location_Landline_No").val() == '') {
      //     $("#Location_Landline_No").css("border-color", "#dc3545");
      //     $('#Location_Landline_No-error').show();
      // }
      if ($("#Location_Mobile_No").val() == '') {
        $("#Location_Mobile_No").css("border-color", "#dc3545");
        $('#Location_Mobile_No-error').show();
      }
      if ($("#Location_Email").val() == '') {
        $("#Location_Email").css("border-color", "#dc3545");
        $('#Location_Email-error').show();
      }
    }

  });
});

/*===================Existing IFSC Code =====================*/