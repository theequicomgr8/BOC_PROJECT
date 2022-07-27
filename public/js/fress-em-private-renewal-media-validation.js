$(document).ready(function(){

  
});


$(document).ready(function () {
  $(".pm-next-button").click(function () {

    //ajax part for data insert and update start by suman 11-Jan
    function owner_insert()
    {
        var data = new FormData($("#private_media")[0]);
        $.ajax({
          url : '/privateownerRenewal',
          type:'POST',
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data)
          {
            console.log(data);
          }
        });
    }



  function private_renewal()
  {
    var data = new FormData($("#private_media")[0]);
		$.ajax({
			url : '/privateRenewall',
			type:'POST',
			data:data,
			cache: false,
			contentType: false,
			processData: false,
			success:function(data)
			{
				$("#getID").attr('value',1);
        console.log(data);
			}
		});
  }
    //ajax part for data insert and update End by suman 11-Jan



    var form = $("#private_media");
    form.validate({
      rules: {
        "owner_name[]": {
          mytst1: true,
          minlength: 5,
          maxlength: 100
        },
        "email_owner[]": {
          mytst1: true,
          emailExt: true
        },
        "mobile_owner[]": {
          mytst1: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "address_owner[]": {
          mytst1: true,
        },
        "state_owner[]": {
          mytst1: true
        },
        "city[]": {
          mytst1: true
        },
        "district_owner[]": {
          mytst1: true
        },
        "phone[]": {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        "fax_no[]": {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        HO_Address: {
          required: true
        },
        HO_Landline_No: {
          required: true,
          minlength: 10,
          maxlength: 14,
          number: true,
        },
        HO_Fax_No: {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        HO_Email: {
          required: true,
          emailExt: true
        },
        HO_Mobile_No: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        Authorized_Rep_Name: {
          required: true
        },
        AR_Address: {
          required: true
        },
        AR_Landline_No: {
          required: true,
          minlength: 10,
          maxlength: 14,
          number: true
        },
        AR_FAX_No: {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        AR_Email: {
          required: true,
          emailExt: true
        },
        AR_Mobile_No: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        Legal_Status_of_Company: {
          required: true
        },
        "ODMFO_Year[]": {
          mytst1: true,
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          mytst1: true,
        },
        "ODMFO_Billing_Amount[]": {
          mytst1: true,
          range: [1000, 10000]
        },

        PM_Agency_Name: {
          required: true
        },
        PAN: {
          Panvalid: true
        },
        Bank_Name: {
          required: true
        },
        Bank_Branch: {
          required: true
        },
        IFSC_Code: {
          IFSCvalid: true
        },
        Account_No: {
          required: true
        },
        "MA_District[]": {
          mytst1: true
        },
        "MA_State[]": {
          mytst1: true
        },
        "MA_City[]": {
          mytst1: true
        },
        "MA_Property_Landmark[]": {
          mytst1: true
        },
        Upload_Document_Of_Legal_Status_File_Name: {
          required: true
        },
        Legal_Doc_File_Name: {
          required: true
        },
        Notarized_Copy_File_Name: {
          required: true
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: true
        },
        Photo_File_Name: {
          required: true
        },
        GST_File_Name: {
          required: true
        },
        BO_Landline_No: {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        BO_Fax_No: {
          minlength: 10,
          maxlength: 14,
          number: true
        },
        BO_Mobile: {
          minlength: 10,
          maxlength: 10
        },
        Affidavit_File_Name: {
          required: true
        },
        self_declaration: {
          required: true
        },
        Authority_Which_granted_Media: {
          required: true
        },
        Contract_No: {
          required: true
        },
        Quantity_Of_Display: {
          required: true
        },
        License_From: {
          required: true
        },
        License_To: {
          required: true
        },
        // payment_type: {
        //   required: true
        // },
        GST_No:{
          testgst:true
        },
        

      },

      messages: {

        "owner_name[]": {
          required: "Please fill required field!",
          minlength: "Owner name must be at least 5 alphabets!",
          maxlength: "Users can type only max 100 alphabets!",
        },
        "email_owner[]": {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },

        "mobile_owner[]": {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        "address_owner[]": {
          required: "Please fill required field!"
        },
        "state_owner[]": {
          required: "Please select an state!"
        },
        "city[]": {
          required: "Please fill required field!"
        },
        "district_owner[]": {
          required: "Please fill required field!"
        },
        "phone[]": {
          minlength: "Phone length should be min 10 digit!",
          maxlength: "Phone length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        "fax_no[]": {
          minlength: "Fax length should be min 10 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        HO_Address: {
          required: "Please fill required field!",
        },
        HO_Landline_No: {
          required: "Please fill required field!",
          minlength: "Landline length should be min 10 digit!",
          maxlength: "Landline length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        HO_Fax_No: {
          minlength: "Fax length should be min 10 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        HO_Email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        HO_Mobile_No: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        Authorized_Rep_Name: {
          required: "Please fill required field!"
        },
        AR_Address: {
          required: "Please fill required field!"
        },
        AR_Landline_No: {
          required: "Please fill required field!",
          minlength: "Landline length should be min  10 digit!",
          maxlength: "Landline length should be max  14 digit!",
          number: "Users can enter only integer numbers!"
        },
        AR_FAX_No: {
          minlength: "Fax length should be min  10 digit!",
          maxlength: "Fax length should be max  14 digit!",
          number: "Users can enter only integer numbers!"
        },
        AR_Email: {
          required: "Please fill required field!",
          email: "Please enter a vaild email address!"
        },
        AR_Mobile_No: {
          required: "Please fill required field!",
          minlength: "Mobile length should be min and max 10 digit!",
          number: "Users can enter only integer numbers!"
        },
        Legal_Status_of_Company: {
          required: "Please fill required field!"
        },
        "ODMFO_Year[]": {
          required: "Please fill required field!"
        },
        "ODMFO_Quantity_Of_Display_Or_Duration[]": {
          required: "Please fill required field!"
        },
        "ODMFO_Billing_Amount[]": {
          required: "Please fill required field!",
          range: "Range should be 1000,10000"
        },
     
        PM_Agency_Name: {
          required: "Please fill required field"
        },
        PAN: {
          required: "Please fill required field"
        },
        Bank_Name: {
          required: "Please fill required field"
        },
        Bank_Branch: {
          required: "Please fill required field"
        },
        IFSC_Code: {
          required: "Please fill required field"
        },
        Account_No: {
          required: "Please fill required field"
        },

        "MA_State[]": {
          required: "Please fill required field!"
        },
        "MA_District[]": {
          required: "Please fill required field!"
        },
        "MA_City[]": {
          required: "Please fill required field!"
        },
      
        "MA_Property_Landmark[]": {
          required: "Please fill required field!"
        },
        Upload_Document_Of_Legal_Status_File_Name: {
          required: "Please fill required field!",
        },
        Legal_Doc_File_Name: {
          required: "Please fill required field!",
        },
        Notarized_Copy_File_Name: {
          required: "Please fill required field!",
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: "Please fill required field!",
        },
        Photo_File_Name: {
          required: "Please fill required field!",
        },
        GST_File_Name: {
          required: "Please fill required field!",
        },
        BO_Landline_No: {
          minlength: "Landline length should be min 10 digit!",
          maxlength: "Landline length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        BO_Fax_No: {
          minlength: "Fax length should be min 10 digit!",
          maxlength: "Fax length should be max 14 digit!",
          number: "Users can enter only integer numbers!"
        },
        BO_Mobile: {
          minlength: "Mobile length should be min and max 10 digit!",
        },

        Affidavit_File_Name: {
          required: "Please fill required field!"
        },
        self_declaration: {
          required: "Please fill required field!"
        },
        Authority_Which_granted_Media: {
          required: "Please fill required field!"
        },
        Contract_No: {
          required: "Please fill required field!"
        },
        Quantity_Of_Display: {
          required: "Please fill required field!"
        },
        License_From: {
          required: "Please fill required field!"
        },
        License_To: {
          required: "Please fill required field!"
        },
        // payment_type: {
        //   required: "Please fill required field!"
        // },
        //terms: "Please accept our terms"
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
//console.log(form.valid());
    if (form.valid() === true) {
      if ($('#tab1').is(":visible")) {
        current_fs = $('#tab1');
        owner_insert();//for tab first data insert and update 11-Jan sk
        next_fs = $('#tab2');
        $("a[id='#tab1']").removeClass("active");
        $("a[id='#tab2']").addClass("active");
        nextSaveData('next_tab_1');
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        private_renewal();//for tab 2 data insert and update 11-jan sk
        next_fs = $('#tab3');
        $("a[id='#tab2']").removeClass("active");
        $("a[id='#tab3']").addClass("active");
        nextSaveData('next_tab_2');
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        private_renewal();//for tab 2 data insert and update 11-jan sk
        next_fs = $('#tab4');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");
        nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");
      } else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab4');
        private_renewal();//for tab 2 data insert and update 11-jan sk
        next_fs = $('#tab5');
        $("a[id='#tab3']").removeClass("active");
        $("a[id='#tab4']").addClass("active");

        nextSaveData('submit_btn');
        $("#submit_btn").val("0");
      }
      else if ($('#tab5').is(":visible")) {
        current_fs = $('#tab5');
        next_fs = $('#tab5');
       

        $("a[id='#tab4']").removeClass("active");
        $("a[id='#tab5']").addClass("active");

        //nextSaveData('submit_btn');
        $("#submit_btn").val("0");
      }
     
      // else if ($('#tab5').is(":visible")) {
      //   current_fs = $('#tab5');
      //   next_fs = $('#tab5');
      //   $("a[id='#tab4']").removeClass("active");
      //   $("a[id='#tab5']").addClass("active");
       
      //   // nextSaveData('submit_btn');
      //   // $("#submit_btn").val("0");
      // }
     

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

    else if ($('#tab5').is(":visible")) {
      current_fs = $('#tab5');
      next_fs = $('#tab4');
      $("a[id='#tab5']").removeClass("active");
      $("a[id='#tab4']").addClass("active");
    }

    next_fs.show();
    current_fs.hide();
  });


  //email validation formate
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a vaild email address');

  //gstvaldation
    jQuery.validator.addMethod('testgst', function(value) {
        $("#gstvalidationMsg").hide();
        var reggst = (/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
        if (value.match(reggst)) {
            $("#gstvalidationMsg").show();
            $("#gstvalidationMsg").text('Valid GST No.').css({
                "color": "green",
                "font-weight": "100",
                "font-size": "11px"
            });
            return value.match(reggst);
        } else if (value != '') {
            $("#gstvalidationMsg").show();
            $("#gstvalidationMsg").text('Invalid GST No.!').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        } else {
            $("#gstvalidationMsg").show();
            $("#gstvalidationMsg").text('Please fill required field!').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        }
    }, '');

});
//IFSC Code
jQuery.validator.addMethod('IFSCvalid', function(value) {
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
$.validator.addMethod('Panvalid', function(value) {
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

//End IFSC code validation
$(document).ready(function () {

  $.validator.addMethod("mytst1", function (value, element) {
    var flag = true;
    //console.log(flag + 'ram')
    var name = element.name;
    var id = element.id;
    var rename = name.substring(0, name.length - 2);
    var reid = id.substring(0, id.length - 1);

    $("[name^=" + rename + "]").each(function (i, j) {
      $(this).parent('p').find('span.error').remove();
      $(this).parent('p').find('span.error').remove();
      $("#" + reid + i).removeClass('is-invalid');
      // console.log(rename + 'ram');
      // console.log(reid + 'ram');
      if ($.trim($(this).val()) == '') {
        flag = false;
        $("#" + reid + i).addClass('is-invalid');
        $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error">Please fill required field!</span>');
      }
      $("#" + reid + i + "-error").hide();
    });

    //console.log(flag)
    return flag;
  }, "");
})

/*file upload validation*/
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
});
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}
function uploadFile(i, thiss) {

  var file = thiss.files[0].name;
  var totalBytes = thiss.files[0].size;
  var sizeKb = Math.floor(totalBytes / 1000);
  var ext = file.split('.').pop();
  if (file != '' && sizeKb < 512 && ext == "pdf") {
    $("#choose_file" + i).empty();
    $("#choose_file" + i).text(file);
    $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
    $("#upload_doc_error" + i).hide();
  } else {
    //console.log("hello");
    $("#upload_doc" + i).val('');
    $("#choose_file" + i).text("Choose file");
    $("#upload_doc_error" + i).text('File size should be less than 512kb and file should be pdf!');
    $("#upload_doc_error" + i).show();
    $("#upload_file" + i).html("Upload").addClass("input-group-text");
    $("#upload_doc" + i + "-error").addClass("hide-msg");
  }
}


$(document).ready(function () {
  $("#endDate").focus(function () {
    var from = $("#startDate").val();
    $("#endDate").attr('min', from);
  });

});


/*file Upload*/

/*End File Upload*/

$(document).ready(function () {
  $("input[name='boradio']").click(function () {
    var radioValue = $("input[name='boradio']:checked").val();
    if (radioValue == '1') {
      $("#boradio").show();
    } else {
      $("#boradio").hide();
      // $("#BO_Address").val('');
      // $("#BO_Landline_No").val('');
      // $("#BO_Fax_No").val('');
      // $("#BO_Email").val('');
      // $("#BO_Mobile").val('');
    }
  });
});
