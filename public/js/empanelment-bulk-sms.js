// Alphabetic validation
function alphaOnly(event) {
  var inputValue = event.charCode;
  if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
    event.preventDefault();
  }
}


//start ajax code
function nextSaveData() {
  var data = new FormData($("#emp_bulk_sms")[0]);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    }
  });
  // alert("tab3");
  $.ajax({
    type: "post",
    url: "/SaveBulkSms",
    data: data,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data['success'] == true) {
        //  if(id=='next_tab_3'){
        //   $("#Final_submi").show();
        //   $("#Final_submi").text(data.message);
        //   setTimeout(function(){ 
        //     window.location.href ='bulk-sms';
        //    },5000);
        //   console.log(data.message);
        // }
      }
    },
    error: function (error) {
      console.log('error');
    }
  });
}


//final submit
function nextSaveDatafinal() {
  var data = new FormData($("#emp_bulk_sms")[0]);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    }
  });
  // alert("tab3");
  $.ajax({
    type: "post",
    url: "/SaveBulkSms",
    data: data,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data['success'] == true) {
        $('html, body').animate({
          scrollTop: $(".content-inside").offset().top
        }, 1000);
        $("#Final_submi").show();
        $("#Final_submi").text(data.message);
        setTimeout(function () {
          window.location.href = 'bulk-sms';
        }, 5000);
        console.log(data.message);

      }
    },
    error: function (error) {
      console.log('error');
    }
  });
}
//End Ajax Code
$(document).ready(function () {
  $(".bulk-sms").click(function () {
    var form = $("#emp_bulk_sms");
    form.validate({
      rules: {
        agency_name: {
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
        bulk_address: {
          required: true
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
        tel_circle_cat: {
          required: true
        },
        // tel_circle: {
        //   required: true
        // },

        /*Tab Second validation start*/
        bank_account: {
          required: true
        },
        bank_address: {
          required: true
        },
        acc_holder_name: {
          required: true
        },
        bank_name: {
          required: true
        },
        pan_card: {
          Panvalid: true
        },
        ifsc_code: {
          IFSCvalid: true
        },
        branch: {
          required: true
        },
        gst: {
          testgst: true
        },
        Account_ifsc_code: {
          required: true
        },

        esi_acc_number: {
          required: true
        },
        esi_employees_covered: {
          required: true,
        },
        esp_acc_number: {
          required: true,
        },
        esp_employees_covered: {
          required: true,
        },
        /* Third tab validation start */
        TRAI_RC_File_Name: {
          required: true
        },

        JOC_File_Name: {
          required: true
        },

        Throughput_File_Name: {
          required: true
        },
        Bulk_SDP_File_Name: {
          required: true
        },
        OBD_Call_File_Name1: {
          required: true
        },
        OBD_Call_File_Name2: {
          required: true
        },
        Affidavit_For_NS_File_Name: {
          required: true
        },
        Affidavit_For_Dir_File_Name: {
          required: true
        },
        Mobile_number_ODB_File_Name: {
          required: true
        },
        Incorporation_Cert_File_Name: {
          required: true
        },
        PAN_Upload_File_Name: {
          required: true
        },
        GST_Upload_File_Name: {
          required: true
        },

        /* Third tab validation End */
      },
      messages: {
        agency_name: {
          required: "Please fill required field!"
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
        bulk_address: {
          required: "Please fill required field!"
        },
        state: {
          required: "Please fill required field!"
        },
        district: {
          required: "Please fill required field!"
        },
        tel_circle_cat: {
          required: "Please fill required field!"
        },
        // tel_circle: {
        //   required: "Please fill required field!"
        // },


        /*Tab second validation start*/
        bank_account: {
          required: "Please fill required field!"
        },
        bank_address: {
          required: "Please fill required field!"
        },
        acc_holder_name: {
          required: "Please fill required field!"
        },

        bank_name: {
          required: "Please fill required field!"
        },
        ifsc_code: {
          required: "Please fill required field!"
        },
        pan_card:
        {
          required: "Please fill required field!"
        },
        gst:
        {
          required: "Please fill required field!"
        },
        branch: {
          required: "Please fill required field!"
        },
        city: {
          required: "Please fill required field!"
        },

        gst_no: {
          required: "Please fill required field!"
        },
        esi_acc_number: {
          required: "Please fill required field!"
        },
        esi_employees_covered: {
          required: "Please fill required field!",
        },
        esp_acc_number: {
          required: "Please fill required field!"
        },
        esp_employees_covered: {
          required: "Please fill required field!"
        },

        /* Third tab validation start */
        TRAI_RC_File_Name: {
          required: "Please fill required field!"
        },

        JOC_File_Name: {
          required: "Please fill required field!"
        },
        Throughput_File_Name: {
          required: "Please fill required field!"
        },

        Bulk_SDP_File_Name: {
          required: "Please fill required field!"
        },
        OBD_Call_File_Name1: {
          required: "Please fill required field!"
        },
        OBD_Call_File_Name2: {
          required: "Please fill required field!"
        },
        Affidavit_For_NS_File_Name: {
          required: "Please fill required field!"
        },
        Affidavit_For_Dir_File_Name: {
          required: "Please fill required field!"
        },
        Mobile_number_ODB_File_Name: {
          required: "Please fill required field!"
        },
        Incorporation_Cert_File_Name: {
          required: "Please fill required field!"
        },
        PAN_Upload_File_Name: {
          required: "Please fill required field!"
        },
        GST_Upload_File_Name: {
          required: "Please fill required field!"
        },

        /* Third tab validation End */


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
        nextSaveData();
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        nextSaveData();
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
      }
      else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab2');
        nextSaveDatafinal();
        next_fs = $('#tab3');
        $("a[href='#tab3']").addClass("active");

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

    }
    next_fs.show();
    current_fs.hide();
  });
  //jquery required validation on next button
  // $(function () {

  //     $.validator.setDefaults({
  //       submitHandler: function () {
  //         stepper.next()
  //         // alert( "Form successful submitted!" );
  //       }
  //   });
  //email validation formate
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  }, 'Please enter a vaild email address');

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
// end IFSc Validation

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
  $(".custom-file-input").change(function () {
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

//
$("#ifsc_code").on('keyup', function () {
  var IFSC = $(this).val();
  console.log(IFSC);
  // if(IFSC == ''){
  $.ajax({
    url: '/getIFSC',
    type: 'get',
    dataType: "json",
    data: { IFSC: IFSC },
    success: function (data) {
      console.log(data);
      if (data.UPI == true) {

        $("#bank_name").val(data.BANK);
        $("#branch").val(data.BRANCH);
        $("#bank_address").val(data.ADDRESS);
      } else {
        $("#bank_name").val('');
        $("#branch").val('');
        $("#bank_address").val('');
      }
    },
    error: function (error) {
      $("#bank_name").val('');
      $("#branch").val('');
      $("#bank_address").val('');
    }

  })
  // }

})

//GST Api Intrigation
$('#gst_no').on('blur', function () {
  var GST_no = $(this).val();
  console.log(GST_no);
  $.ajax({
    url: '/checkgst',
    type: 'get',
    data: { GST_NO: GST_no },
    success: function (data) {
      console.log(data);
      if (data.legalName != '') {
        $("#agency_name").val(data.legalName);
      } else {
        $("#agency_name").val('');
      }
    }
  })

})

$(document).ready(function () {
  $('.preventLeftClick').on('click', function (e) {
    e.preventDefault();
    return false;
  });
});

