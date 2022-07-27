// Alphabetic validation
function alphaOnly(event) {
  var inputValue = event.charCode;
      if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
          event.preventDefault();
    }
}

//Store Reginal-national Data
function AddVendorDetail(){
  var data = new FormData($("#internet_website")[0]);
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          url: '/saveInternetWeb',
          type: 'POST',
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
              console.log(data);
          }
      });
}

function AddVendorDetail4(){
  var data = new FormData($("#internet_website")[0]);
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          url: '/saveInternetWeb',
          type: 'POST',
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
                    $('html, body').animate({
                         scrollTop: $(".content-inside").offset().top
                    }, 1000);
            //$(".content-inside").focus();
            $("#Final_submi").show();
            $("#Final_submi").text(data.message);

            setTimeout(function(){
              window.location.href ='internet-website';
             },5000);
          }
    });
}



$(document).ready(function(){
  $(".internet-next-button").click(function(){
    var form = $("#internet_website");
    form.validate({
      rules: {
            PM_Agency_Name: {
              required:true,
              minlength: 5,
              maxlength: 40
            },
            owner_email: {
              required: true,
              emailExt: true
            },
            owner_mobile: {
              required: true,
              minlength: 10,
              maxlength: 10,
              number:true
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
            phone_no: {
              maxlength: 15,
              number:true
            },

            // tab 1 validation close

             // tab 2 validation start
            group_name:{
              required:true,

            },

            date_of_registration:{
              required:true,

            },
            website_url:{
              required:true,
               url: true
            },
            website_category:{
              required:true,
            },
             bank_account_no: {
              required: true,
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
              required: true,
            },
            GST_No: {
              required: true,
            },
            ESI_account_no: {
              required: true,
            },
            ESI_no_employees: {
              required: true,
            },
            EPF_account_no: {
              required: true,
            },
            EPF_no_of_employees: {
              required: true,
            },
            website_auditor:{
              required:true,
            },
            ooic_file_name:{
              required:true,
            },
            pan_upload_file_name:{
              required:true,
            },
            gst_upload_file_name:{
              required:true,
            },
            pas_certificate_file_name:{
              required:true,
            },
            website_work_owned:{
              required:true,
            },
            auditor_report:{
              required:true,
            },
            annexure_a_file_name:{
              required:true,
            },
            notarized_certificate:{
              required:true,
            },
            fees_payment:{
              required:true,
            },
            internet_website:{
              required:true,
            },

        },
        messages: {
          PM_Agency_Name: {
            required:"Please fill required field!",
            minlength: "Owner name must be at least 5 alphabets!",
            maxlength: "Users can type only max 100 alphabets!"
          },
          owner_email: {
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          },
          email_1: {
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          },
          owner_mobile: {
            required: "Please fill required field!",
            maxlength: "Mobile length should be max and min 10 digit!",
            number: "Users can enter only integer numbers!"
          },
          address: {
            required: "Please fill required field!"
          },
          state: {
            required: "Please select an state!"
          },
          city: {
            required: "Please fill required city!"
          },
          district: {
            required: "Please fill required district!"
          },
          phone_no: {
            maxlength: "Mobile length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },

         group_name:{
              required: "Please fill required field!"

            },

            date_of_registration:{
              required: "Please fill required field!"

            },
             website_url:{
              required: "Please fill required field!",
              url:"Please enter a valid URL!"
            },
            website_category:{
              required: "Please fill required field!"
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
          GST_No: {
            required: "Please fill required field!"
          },
          ESI_account_no: {
            required: "Please fill required field!"
          },
          ESI_no_employees: {
            required: "Please fill required field!"
          },
          EPF_no_of_employees: {
            required: "Please fill required field!"
          },
            website_auditor:{
              required: "Please fill required field!"
            },
            pan_upload_file_name:{
              required: "Please fill required field!"
            },
            gst_upload_file_name:{
              required: "Please fill required field!"
            },
            pas_certificate_file_name:{
              required: "Please fill required field!"
            },
            website_work_owned:{
              required: "Please fill required field!"
            },
            auditor_report:{
              required: "Please fill required field!"
            },
            ooic_file_name:{
              required: "Please fill required field!"
            },
            annexure_a_file_name:{
              required: "Please fill required field!"
            },
            notarized_certificate:{
              required: "Please fill required field!"
            },
            fees_payment:{
             required: "Please fill required field!"
            },
            internet_website:{
              required: "Please fill required field!"
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
          AddVendorDetail();
          next_fs = $('#tab2');
          $("a[id='#tab1']").removeClass("active");
          $("a[id='#tab2']").addClass("active");
          //nextSaveData('next_tab_1');
          $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
          current_fs = $('#tab2');
          AddVendorDetail();
          next_fs = $('#tab3');
          $("a[id='#tab2']").removeClass("active");
          $("a[id='#tab3']").addClass("active");
          //nextSaveData('next_tab_2');
          $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
          current_fs = $('#tab3');
          AddVendorDetail();
          next_fs = $('#tab4');
          $("a[id='#tab3']").removeClass("active");
          $("a[id='#tab4']").addClass("active");
          //nextSaveData('next_tab_3');
          $("#next_tab_3").val("0");
      } else if ($('#tab4').is(":visible")) {
          current_fs = $('#tab3');
          AddVendorDetail4();
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
  jQuery.validator.addMethod("emailExt", function(value, element, param) {
  return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  },'Please enter a vaild email address');

  jQuery.validator.addMethod("panNumber", function(value, element, param) {
    return value.match(/^[A-z]{5}\d{4}[A-Z]{1}$/);
  },'Please enter a vaild PAN Number');

  jQuery.validator.addMethod("gstnumber", function(value, element, param) {
    return value.match(/^[A-z]{5}\d{4}[A-Z]{1}$/);
  },'Please enter a vaild GST Number');


});



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
function isAlphaNumeric(e){ // Alphanumeric only
  var k;
  document.all ? k=e.keycode : k=e.which;
  return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0);
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

////////////// file upload validation ////////////////
$(document).ready(function () {
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
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }



//IFSC API

$("#ifsc_code").on('blur', function() {
    var IFSC = $(this).val();
    $.ajax({
        url: 'https://ifsc.razorpay.com/' + IFSC,
        type: 'get',
        success: function(data) {
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
        error: function(error) {
            console.log(error);
        }

    })
})

//GST

$(document).ready(function(){
  $("#GST_No").on('blur',function(){
    $("#agency_name").val('');
    var gstNumber=$("#GST_No").val();
    // console.log(gstNumber);
    $.ajax({
      url : '/checkgst',
      type:'GET',
      data:{gstNumber:gstNumber},
      success:function(data)
      {
        console.log(data);
        $("#agency_name").val(data.legalName);

      }
    });
  });
});


