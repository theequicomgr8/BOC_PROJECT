$(document).ready(function () {
  $("#company_detail").click(function () {
    var form = $("#company_detail_form");
    form.validate({
      rules: {
        owner_name: {
          required: true,
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
          number: true
        },
        address: {
          required: true,
        },
        state: {
          required: true,
        },
        city: {
          required: true,
        },
        district: {
          required: true,
        },
        phone: {
          required: true,
          minlength: 14,
          maxlength: 14,
          number: true
        },
        GST_No: {
          testgst: true,
        },
        PM_Agency_Name: {
          required: true,
        },
        HO_Address: {
          required: true
        },
        HO_Landline_No: {
          maxlength: 15,
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
        "BO_state[]": {
          mytst1: true,
        },
        "BO_Address[]": {
          mytst1: true,
        },

        "BO_Email[]": {
          mytst1: true,
          emailExt: true
        },
        "BO_Mobile[]": {
          mytst1: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        "Authorized_Rep_Name[]": {
          mytst1: true,
        },
        "AR_Address[]": {
          mytst1: true,
        },
        "AR_Email[]": {
          mytst1: true,
          emailExt: true,
        },
        "AR_Mobile_No[]": {
          mytst1: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        Legal_Doc_File_Name: {
          required: true,
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: true,
        },
        GST_File_Name: {
          required: true,
        },
      },
      messages: {
        owner_name: {
          required: "Please fill required field!",
          maxlength: "User can enter only integer 40 alphabets!"
        },
        owner_email: {
          required: "Please fill required field!"
        },
        owner_mobile: {
          required: "Please fill required field!",
          maxlength: "Mobile length should be 10 digit!",
          number: "User can enter only integer numbers!"
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
        phone: {
          required: "Please fill required phone number!",
          minlength: "Phone number should be 14 digit!",
          number: "User can enter only integer numbers!"
        },
        GST_No: {
          required: "Please fill required field!",
        },
        PM_Agency_Name: {
          required: "Please fill required field!"
        },
        HO_Address: {
          required: "Please fill required field!"
        },
        HO_Landline_No: {
          maxlength: "Landline number should be 15 digit!",
          number: "User can enter only integer numbers!"
        },
        HO_Email: {
          required: "Please fill required field!"
        },
        HO_Mobile_No: {
          required: "Please fill required field!",
          minlength: "Mobile length should be 10 digit!",
          number: "User can enter only integer numbers!"
        },
        "BO_state[]": {
          required: "Please Fill required Field!",
        },
        "BO_Address[]": {
          rrequired: "Please Fill required Field!",
        },
        "BO_Email[]": {
          required: "Please Fill required Field!",
          email: "Please enter a valid email address!",
        },
        "BO_Mobile[]": {
          required: "Please Fill required Field!",
          minlength: "Mobile length should be 10 digit!",
          number: "User can enter only integer numbers!"
        },
        "Authorized_Rep_Name[]": {
          required: "Please Fill required Field!",
        },
        "AR_Address[]": {
          required: "Please Fill required Field!",
        },
        "AR_Email[]": {
          required: "Please Fill required Field!",
          email: "Please enter a valid email address!",
        },
        "AR_Mobile_No[]": {
          required: "Please Fill required Field!",
          minlength: "Mobile length should be 10 digit!",
          number: "User can enter only integer numbers!"
        },
        Legal_Doc_File_Name: {
          required: "Please fill required field!",
        },
        Attach_Copy_Of_Pan_Number_File_Name: {
          required: "Please fill required field!",
        },
        GST_File_Name: {
          required: "Please fill required field!",
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
    if (form.valid() === false) {
      return false;
    }
    // if (form.valid() === true) {
    //   alert("success")
    //   // formSubmit();
    // }
  });
  // validation multiple fields
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
  // check email formate
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
  }, 'Please enter a valid email address');

  //check GST formate 
  jQuery.validator.addMethod('testgst', function (value) {
    $(".gstvalidationMsg").hide();
    var reggst = (/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
    if (value.match(reggst)) {
      $(".gstvalidationMsg").show();
      $(".gstvalidationMsg").text('Valid GST No.').css({
        "color": "green",
        "font-weight": "100",
        "font-size": "11px"
      });
      return value.match(reggst);
    } else if (value != '') {
      $(".gstvalidationMsg").show();
      $(".gstvalidationMsg").text('Invalid GST No.!').css({
        "color": "red",
        "font-weight": "100",
        "font-size": "11px"
      });
      return false;
    } else {
      $(".gstvalidationMsg").show();
      $(".gstvalidationMsg").text('Please fill required field!').css({
        "color": "red",
        "font-weight": "100",
        "font-size": "11px"
      });
      return false;
    }
  }, '');
});
$(document).ready(function () {
  if($("#PM_Agency_Name").val() != ''){
    $("#PM_Agency_Name").val($("#PM_Agency_Name").val()).attr('readonly',true);
  }else{
  $("#PM_Agency_Name").val('Please Wait').attr('readonly',false);
  
  var GSTNumber = $("#GST_No").val();
  if (GSTNumber != '') {
    $.ajax({
      url: '/checkgstsole',
      type: 'GET',
      data: { gstNumber: GSTNumber },
      success: function (data) {
        $("#PM_Agency_Name").val(data.legalName);
        /*// $("#PM_Agency_Name").val('');
        if(data.legalName != ''){
          // $("#PM_Agency_Name").val(data.legalName).attr('readonly',true);
          $("#PM_Agency_Name").val(data.legalName);
          $("#PM_Agency_Name").attr('readonly',true);        
        }else{
          $("#PM_Agency_Name").val('');
          $("#PM_Agency_Name").attr('readonly',false);
        }*/

      }
    });
  }
  }
});
function checkUniqueVendor(id, val) {
  if (val != '') {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/solerightcheckuniquevendor',
      data: {
        data: val
      },
      success: function (response) {
        if (response.status == 0) {
          $("#v_alert_" + id).html(titleCase(id) + ' ' + response.message);
          $("#v_alert_" + id).show();
        } else {
          $("#v_alert_" + id).hide();
        }
      }
    });
  }
}

// start for auth section
$(document).ready(function () {
  $("#add_Auth").click(function () {
    var i = $("#countID").val();
    i++;
    var append = '<hr id="hrline_authorized_' + i + '"><div class="row" id="row' + i + '"><div class="col-md-4"><div class="form-group"><label for="AR_Email' + i + '">E-mail ID / ई-मेल आईडी <font color="red">*</font></label><p><input type="text" name="AR_Email[]" placeholder="Enter E-mail ID" class="form-control form-control-sm" id="AR_Email' + i + '" maxlength="30"></p></div></div><div class="col-md-4"><div class="form-group"><label for="AR_Mobile_No' + i + '">Mobile No. / मोबाइल नंबर <font color="red">*</font></label><p><input type="text" name="AR_Mobile_No[]" placeholder="Enter Mobile No." class="form-control form-control-sm" id="AR_Mobile_No' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></p></div></div><div class="col-md-4"><div class="form-group"><label for="Authorized_Rep_Name' + i + '">Contact Person / संपर्क व्यक्ति <font color="red">*</font></label><p><input type="text" name="Authorized_Rep_Name[]" placeholder="Enter Contact Person" id="Authorized_Rep_Name' + i + '" class="form-control form-control-sm" maxlength="40" onkeypress="return onlyAlphabets(event)"></p></div></div><div class="col-md-4"><div class="form-group"><label for="AR_Address' + i + '">Address / पता <font color="red">*</font></label><p><textarea type="text" name="AR_Address[]" id="AR_Address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm" ></textarea></p></div></div><div class="col-md-4"><div class="form-group"><label for="AR_Landline_No' + i + '">Landline No. / लैंडलाइन नंबर <font color="red"></font></label><p><input type="text" name="AR_Landline_No[]" placeholder="Enter Landline No." class="form-control form-control-sm" id="AR_Landline_No' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="14"></p></div></div><div class="col-md-4"><div class="form-group"><label for="altername_mobile' + i + '">Alternate Mobile No. / वैकल्पिक मोबाइल नंबर <font color="red"></font></label><p><input type="text" name="altername_mobile[]" placeholder="Enter Alternate Mobile No." class="form-control form-control-sm" id="altername_mobile' + i + '" onkeypress="return onlyNumberKey(event)" maxlength="10"></p></div></div> <div class="col-md-10"></div><div class="col-md-2" style="padding: 0% 0 0 7%;"><button class="btn btn-danger btn-sm m-0 remove_row" id="' + i + '" style="font-size: 13px;"><i class="fa fa-minus"></i> Remove</button></div></div>';
    $("#radioar").append(append);
    $("#countID").val(i);
  });
  $(document).on('click', '.remove_row', function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var line_no = $("#auth_line_no_" + id).val();
    var odmedia_id = $("#auth_odmedia_id_" + id).val();
    if (line_no != '' && odmedia_id != '') {
      if (confirm("Are you sure you want to delete this?")) {

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'post',
          url: '/remove-authorized-data',
          data: {
            line_no: line_no,
            od_media_id: odmedia_id
          },
          success: function (response) {
            console.log(response);
            $("#row" + id).remove(); //for hide after delete
          }
        });
      } else {
        return false;
      }
    }
    $(this).parent().parent().remove();
    $("#hrline_authorized_" + id).remove();
    var add_count = $("#countID").val();
    $("#countID").val(add_count - 1);
  });
});
// end for auth section

//start get owner data
function checkUniqueOwnerSoleRight(thisd, val, i) {
  if (val != '') {
    var user_id = $('input[name="user_id"]').val();
    var user_email = $('input[name="user_email"]').val();

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: 'POST',
      url: '/checkpsolerightuniqueowner',
      data: {
        data: val,
        id: user_id,
        email: user_email
      },
      success: function (response) {
        //console.log(response);
        if (response.status == 1 && thisd.id == 'owner_email') {
          $("#owner_name").prop("readonly", false);
          $("#owner_mobile").prop("readonly", false);
          $("#owner_address").prop("readonly", false);
          $("#owner_state").prop("disabled", false);
          $("#owner_district").prop("disabled", false);
          $("#owner_city").prop("readonly", false);
          $("#owner_phone").prop("readonly", false);
          $("#owner_fax").prop("readonly", false);
          // owner not exit clean data
          if ($("#owner_input_clean").val() == 0) {
            $("#owner_state").val('');
            $("#owner_district").val('');
            $("#owner_name").val('');
            $("#owner_mobile").val('');
            $("#owner_address").val('');
            $("#owner_city").val('');
            $("#owner_phone").val('');
            $("#owner_fax").val('');
            $("#ownerid").val('');
            $("#mobilecheck").val('');
          }
          var names = $("#emailarr").val();
          var numbersArray = names.split(',');
          if (numbersArray.includes(val) == false) {
            $("#emailarr").val('');
            $('input[name^="owner_email"]').each(function () {
              $("#emailarr").val(function () {
                return $("#emailarr").val() + ',' + $(this).val();
              });
            });
          }
          // });
        }
        if (response.status == 0 && thisd.id == 'owner_email') {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'POST',
            url: '/fetchsolerightownerrecord',
            data: {
              data: val
            },
            success: function (response) {
              console.log(response);
              if (response.status == 1) {
                $("#owner_state").empty();
                $("#owner_district").empty();
                $("#owner_city").empty();
                $("#owner_name").val(response.message['Owner Name']);
                $("#owner_mobile").val(response.message['Mobile No_']);
                $("#owner_address").val(response.message['Address 1']);
                $("#owner_state").html(response.state);
                $("#owner_district").html(response.districts);
                $("#owner_city").html(response.cities);
                $("#owner_city").val(response.message['City']);
                $("#owner_phone").val(response.message['Phone No_']);
                $("#owner_fax").val(response.message['Fax No_']);
                $("#ownerid").val(response.message['Owner ID']);
                $("#mobilecheck").val(response.message['Mobile No_']);
                if ($("#emailarr").val() == '') {
                  $("#emailarr").val(val);
                } else {
                  var names = $("#emailarr").val();
                  var numbersArray = names.split(',');
                  if (numbersArray.includes(val) == false) {
                    $("#emailarr").val('');
                    $('input[name^="owner_email"]').each(function () {
                      $("#emailarr").val(function () {
                        return $("#emailarr").val() +
                          ',' + $(this).val();
                      });
                    });

                  } else {
                  }
                }
                if ($("#ownerid").val() == '') {
                  $("#ownerid").val(response.message['Owner ID']);
                } else {
                  var ownerids = $("#ownerid").val();
                  var ownerArray = ownerids.split(',');
                  if (isInArray(response.message['Owner ID'], ownerArray) ==
                    false) {
                    $("#ownerid").val(function () {
                      return $("#ownerid").val() + ',' + response
                        .message['Owner ID'];
                    });
                    var ownerids = $("#ownerid").val();
                    var ownerArray = ownerids.split(',');
                    $("#ownerid").val(ownerArray);
                  }
                }
              }

              if (response.Status > 0) {
                $("#owner_name").prop("readonly", true);
                $("#owner_mobile").prop("readonly", true);
                $("#owner_address").prop("readonly", true);
                $("#owner_state").prop("disabled", true);
                $("#owner_district").prop("disabled", true);
                $("#owner_city").prop("readonly", true);
                $("#owner_phone").prop("readonly", true);
                $("#owner_fax").prop("readonly", true);
              }
              $("#owner_input_clean").val(0);
            }
          });

        } else if (response.status == 0 && thisd.id == 'owner_mobile' && val != $(
          "#mobilecheck").val()) {
          $("#" + thisd.id).val('');
          $("#alert_" + thisd.id).html('Mobile No. ' + response.message);
          $("#alert_" + thisd.id).show();
        } else {
          $("#alert_" + thisd.id).hide();
        }
        if (thisd.id == 'owner_mobile') {
          $("#owner_input_clean").val(1);
        }
      }
    });
  }
}

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

function titleCase(string) {
  return string[0].toUpperCase() + string.slice(1).toLowerCase();
}
$(document).on('change', '.owner_name', function () {
  $("#owner_input_clean").val(1);
});
//end get owner data

$('.alert-danger').hide()
//start Branch Office show hide form js
$(document).ready(function () {
  $("input[name='boradio']").click(function () {
    var radioValue = $("input[name='boradio']:checked").val();
    console.log(radioValue);
    if (radioValue == '1') {
      $("#radio").show();
      $("#addid").show();
      $("#add_branch").show();
    } else {
      $("#radio").hide();
      $("#addid").hide();
    }
  });
});

$(document).ready(function() {
  if ($('.alert-success').text() != '') {
      $('.alert-success').fadeIn();
      setTimeout(function() {
          $('.alert-success').fadeOut("slow");
          if($("#IFSCCODE").val() == ''){
          location.href = "account-details";
          }
      }, 7000);
  }
  if ($('.alert-danger').text() != '') {
      $('.alert-danger').fadeIn();
      setTimeout(function() {
          $('.alert-danger').fadeOut("slow");
      }, 7000);
  }
});

function ownerDetail(val){
if(val == 1){
$("#HO_Email").val($("#owner_email").val());
$("#HO_Mobile_No").val($("#owner_mobile").val());
}else{
  $("#HO_Email").val('');
  $("#HO_Mobile_No").val('');
}
}
//end Branch Office show hide form js
