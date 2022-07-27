$(document).ready(function () {
  $("#submit_form").click(function () {
    var form = $("#outdoor_media_form");
    form.validate({
      rules: {
        "MA_State[]": {
          mytst1: true
        },
        "MA_District[]": {
          mytst1: true
        },
        "MA_City[]": {
          mytst1: true
        },
        "Applying_For_OD_Media_Type[]": {
          mytst1: true
        },
        "od_media_type[]": {
          mytst1: true
        },
        "quantity[]": {
          mytst1: true
        },
        MAState: {
          required: true,
        },
        mediacategory: {
          required: true,
        },
        mediasubcategory: {
          required: true,
        },
        media_import: {
          required: true,
        },
        Authority_Which_granted_Media: {
          required: true,
        },
        Contract_No: {
          required: true,
        },
        License_Fee: {
          required: true,
        },
        License_From: {
          required: true,
        },
        License_To: {
          required: true,
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          mytst1: true
        },
        "ODMFO_Billing_Amount[]": {
          mytst1: true
        },
        "from_date[]": {
          mytst1: true,
        },
        "to_date[]": {
          mytst1: true,
        },
        media_import2: {
          required: true,
        },
        Affidavit_File_Name: {
          required: true,
        },
        Legal_Doc_File_Name: {
          required: true,
        },
        Last_License_Fee_Paid: {
          required: true,
        },
        Rate_Offered_to_BOC: {
          required: true,
        },
        Categorization_of_Media: {
          required: true,
        },
        Notarized_Copy_File_Name: {
          required: true,
        },
        Certified_Media_List_File_Name: {
          required: true,
        }
      },
      messages: {

        "MA_State[]": {
          required: "Please fill required field!"
        },
        "MA_District[]": {
          required: "Please fill required field!"
        },
        "MA_City[]": {
          required: "Please fill required field!"
        },
        "Applying_For_OD_Media_Type[]": {
          required: "Please fill required field!",
        },
        "od_media_type[]": {
          required: "Please fill required field!",
        },
        "quantity[]": {
          required: "Please fill required field!"
        },
        MAState: {
          required: "Please fill required field!"
        },
        mediacategory: {
          required: "Please fill required field!"
        },
        mediasubcategory: {
          required: "Please fill required field!"
        },
        media_import: {
          required: "Please fill required field!"
        },
        Authority_Which_granted_Media: {
          required: "Please fill required field!",
        },
        Contract_No: {
          required: "Please fill required field!",
        },
        License_Fee: {
          required: "Please fill required field!",
        },
        License_From: {
          required: "Please fill required field!",
        },
        License_To: {
          required: "Please fill required field!",
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          required: "Please fill required field!",
        },
        "ODMFO_Billing_Amount[]": {
          required: "Please fill required field!",
        },
        "from_date[]": {
          required: "Please fill required field!",
        },
        "to_date[]": {
          required: "Please fill required field!",
        },
        media_import2: {
          required: "Please fill required field!",
        },
        Affidavit_File_Name: {
          required: "Please fill required field!",
        },
        Legal_Doc_File_Name: {
          required: "Please fill required field!",
        },
        Last_License_Fee_Paid: {
          required: "Please fill required field!",
        },
        Rate_Offered_to_BOC: {
          required: "Please fill required field!",
        },
        Categorization_of_Media: {
          required: "Please fill required field!",
        },
        Notarized_Copy_File_Name: {
          required: "Please fill required field!",
        },
        Certified_Media_List_File_Name: {
          required: "Please fill required field!",
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
    if (form.valid() === true) {
      formSubmit();
    }
  //   if (form.valid() === false) {
  //     return false;
  // }
  });

  $.validator.addMethod("mytst1", function (value, element) {
    var flag = true;
    var name = element.name;
    var id = element.id;
    var rename = name.substring(0, name.length - 2);
    var reid = id.substring(0, id.length - 1);
    $("[name^=" + rename + "]").each(function (i, j) {
      $(this).parent('p').find('span.error').remove();
      $(this).parent('p').find('span.error').remove();
      $("#" + reid + i).removeClass('is-invalid');
      if ($.trim($(this).val()) == '') {
        flag = false;
        $("#" + reid + i).addClass('is-invalid');
        $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error invalid-feedback">Please fill required field!</span>');
      }
      $("#" + reid + i + "-error").hide();
    });

    return flag;
  }, "");
});

$(document).ready(function () {
  if ($("#ODGSTID").val() == '' || $("#IFSCCODE").val() == '') {
    // read only all form true
    $('form *').prop('disabled', true);
    $(".m-0").css("pointer-events", "none");
  } else {
    // read only all form false
    $('form *').prop('disabled', false);
    $(".m-0").css("pointer-events", "visible");
  }
});

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}



