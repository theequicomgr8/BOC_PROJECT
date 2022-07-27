// Validation for alphabets only
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

// validation for Alphanumeric only
function isAlphaNumeric(e) {
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || k == 0);
}

// validation for numerickey only
function onlyNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}

// use for amount numeric and dot
function isNumber(evt, element) {

  var charCode = (evt.which) ? evt.which : event.keyCode

  if (
    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
    (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
    (charCode < 48 || charCode > 57))
    return false;

  return true;
}

//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode
  if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
    return false;
  return true;
}


//Pan card validation
function validatePanNumber(pan) {
  let pannumber = $(pan).val().toUpperCase(); 
  if (pannumber.match(/^[A-z]{5}\d{4}[A-Z]{1}$/)) {
    $(pan).val(pannumber);
    $("#alert_" + pan.id).text(" Valid PAN number").show().css("color", "green");
  } else {
    $("#alert_" + pan.id).text(" Invalid PAN number").show().css("color", "red");
    $(pan).val("");
  }
}

//IFSC Code validation
function validateIfscCode(ifsc) {
  let ifscnumber = $(ifsc).val().toUpperCase();
  if (ifscnumber.match(/^[A-Z]{4}0[0-9]{6}$/)) {
    $(ifsc).val(ifscnumber);
    $("#alert_" + ifsc.id).text(" Valid IFSC code").show().css("color", "green");
  } else {
    $("#alert_" + ifsc.id).text(" Invalid IFSC code").show().css("color", "red");
    //  $(ifsc).val("");
  }
}

function checksum(gst_no) {
  let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(gst_no);
  if (regTest) {
    var gstMsg = 'GST No. is valid format';
    $('.gstvalidationMsg').removeClass('alert-info-msg2');
    $('.gstvalidationMsg').addClass('alert-info-msg');
    $('.gstvalidationMsg').text(gstMsg);
    $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
    return true;
  } else {
    var gstMsg = 'Enter Valid format GST No. like(18AABCU9603R1ZM)';
    $('.gstvalidationMsg').removeClass('alert-info-msg');
    $('.gstvalidationMsg').addClass('alert-info-msg2');
    $('.gstvalidationMsg').text(gstMsg);
    $('.validcheck').html("");
    return false;
  }
}

// validation for Alphanumeric with space only
function isAlphaNumericSpace(e) {
  var k;
  document.all ? k = e.keycode : k = e.which;
  return ((k > 47 && k < 58) || (k > 64 && k < 91) || (k > 96 && k < 123) || k == 0 || k == 32);
}


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

$(document).ready(function () {
  $('.inputUC').keyup(function () {
    $(this).val($(this).val().toUpperCase());
  });
});


/* alert(text); */


$(document).ready(function () {
  let str = $("label").val();

})
//alert(convertFirstLetterToUpperCase());