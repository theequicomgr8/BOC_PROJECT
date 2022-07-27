$(document).ready(function () {
    $(".set-pm-next-button").click(function () {
      var form = $("#personal_media");
      form.validate({
        rules: {
          "owner_name[]": {
            minlength: 5,
            mytst1: true,
            maxlength: 40
          },
          "owner_email[]": {
            mytst1: true,
            emailExt: true
          },
          "owner_mobile[]": {
            mytst1: true,
            minlength: 10,
            maxlength: 10,
            number: true
          },
          "address[]": {
            mytst1: true
          },
          "state[]": {
            mytst1: true
          },
          "city[]": {
            mytst1: true
          },
          "district[]": {
            mytst1: true
          },
          "fax_no[]": {
            minlength: 0,
            maxlength: 14,
            number: true
          },
          HO_Address: {
            required: true
          },
          GST_No:{
            testgst:true,
          },
          HO_Landline_No: {
            required: true,
            minlength: 3,
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
          HO_Fax_No: {
            // required: true,
            minlength: 0,
            maxlength: 14,
            number: true
          },
          // BO_Email: {
          //   emailExt: true
          // },
          BO_Mobile: {
            minlength: 10,
            maxlength: 10,
            number: true
          },
          BO_Landline_No: {
            minlength: 3,
            maxlength: 14,
            number: true
          },
          BO_Fax_No: {
            minlength: 0,
            maxlength: 14,
            number: true
          },
          DO_Address: {
            required: true
          },
          DO_Landline_No: {
            required: true,
            minlength: 3,
            maxlength: 14,
            required: true
          },
          DO_Address: {
            required: true
          },
          DO_Fax_No: {
            minlength: 0,
            maxlength: 14,
            number: true
          },
          DO_Email: {
            required: true,
            emailExt: true
          },
          DO_Mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true
          },
          Legal_Status_of_Company: {
            required: true,
          },
          Other_Relevant_Information: {
            required: true,
          },
          Notarized_Copy_File_Name: {
            required: true,
          },
          Attach_Copy_Of_Pan_Number_File_Name: {
            required: true,
          },
          Affidavit_File_Name: {
            required: true,
          },
          Photo_File_Name: {
            required: true,
          },
          Legal_Doc_File_Name: {
            required: true,
          },
          GST_File_Name: {
            required: true,
          },
          year_media: {
            required: true,
          },
          quantity_duration_media: {
            required: true,
          },
          billing_amount_media: {
            required: true,
          },
          DD_No: {
            required: true,
          },
          DD_Date: {
            required: true,
          },
          DD_Bank_Name: {
            required: true,
          },
          DD_Bank_Branch_Name: {
            required: true,
            alphanumeric: true
          },
          PM_Agency_Name: {
            required: true,
          },
          Bank_Name: {
            required: true,
          },
          Application_Amount: {
            required: true,
            number: true,
            range: [1000, 10000],
          },
          DD_Bank_Branch_Name: {
            required: true,
          },
          branch_name_media: {
            required: true,
          },
          Bank_Branch: {
            required: true,
          },
          IFSC_Code: {
            IFSCvalid: true,
          },
          Account_No: {
            required: true,
          },
          "ODMFO_Year[]": {
            mytst1: true,
          },
          "ODMFO_Quantity_Of_Display_Or_Duration[]": {
            mytst1: true,
          },
          "ODMFO_Billing_Amount[]": {
            mytst1: true,
          },
          PAN: {
            Panvalid: true,
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
          Quantity_Of_Display: {
            required: true,
          },
          License_From: {
            required: true,
          },
          License_To: {
            required: true,
          },
          self_declaration: {
            required: true,
          },
        },
        messages: {
          "owner_name[]": {
            required: "Please fill required field!",
            minlength: "Owner name must be at least 5 alphabets!",
            maxlength: "Users can type only max 40 alphabets!"
          },
          "owner_email[]": {
            required: "Please fill required field!",
            email: "Please enter a valid email address!"
          },
          "owner_mobile[]": {
            required: "Please fill required field!",
            minlength: "Mobile length should be min and max 10 digit!",
            number: "Users can enter only integer numbers!"
          },
          "address[]": {
            required: "Please fill required field!"
          },
          "state[]": {
            required: "Please select an state!"
          },
          "city[]": {
            required: "Please fill required city!"
          },
          "district[]": {
            required: "Please fill required district!"
          },
          "fax_no[]": {
            minlength: "Fax length should be min 0 digit!",
            maxlength: "Fax length should be max 14 digit!",
            number: "Users can enter only integer numbers!"
          },
          HO_Address: {
            required: "Please fill required field!"
          },
          HO_Landline_No: {
            required: "Please fill required field!",
            minlength: "Landline length should be min 3 digit!",
            maxlength: "Landline length should be max 14 digit!",
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
          HO_Fax_No: {
            //required: "Please fill required field!",
            minlength: "Fax length should be min 0 digit!",
            maxlength: "Fax length should be max 14 digit!",
            number: "Users can enter only integer numbers!"
          },
          // BO_Email: {
          //   email: "Please enter a vaild email address!"
          // },
          BO_Mobile: {
            minlength: "Mobile length should be min and max 10 digit!",
            number: "Users can enter only integer numbers!"
          },
          BO_Landline_No: {
            minlength: "Landline length should be min 3 digit!",
            maxlength: "Landline length should be max 14 digit!",
            number: "Users can enter only integer numbers!"
          },
          BO_Fax_No: {
            minlength: "Fax length should be min 0 digit!",
            maxlength: "Fax length should be max 14 digit!",
            number: "Users can enter only integer numbers!"
          },
          DO_Address: {
            required: "Please fill required field!"
          },
          DO_Landline_No: {
            required: "Please fill required field!",
            minlength: "Landline length should be min 3 digit!",
            maxlength: "Landline length should be max 14 digit!",
            required: "Please fill required field!"
          },
          DO_Address: {
            required: "Please fill required field!"
          },
          DO_Fax_No: {
            minlength: "Fax length should be min 0 digit!",
            maxlength: "Fax length should be max 14 digit!",
            number: "Users can enter only integer numbers!"
          },
          DO_Email: {
            required: "Please fill required field!",
            email: "Please enter a valid email address!"
          },
          DO_Mobile: {
            required: "Please fill required field!",
            minlength: "Mobile length should be min and max 10 digit!",
            number: "Users can enter only integer numbers!"
          },
          Legal_Status_of_Company: {
            required: "Please fill required field!",
          },
          Other_Relevant_Information: {
            required: "Please fill required field!",
          },
          year_media: {
            required: "Please fill required field!"
          },
          quantity_duration_media: {
            required: "Please fill required field!"
          },
          billing_amount_media: {
            required: "Please fill required field!"
          },
          DD_No: {
            required: "Please fill required field!"
          },
          DD_Date: {
            required: "Please fill required field!"
          },
          DD_Bank_Name: {
            required: "Please fill required field!"
          },
          branch_name_media: {
            required: "Please fill required field!",
          },
  
          PM_Agency_Name: {
            required: "Please fill required field!"
          },
  
          Bank_Name: {
            required: "Please fill required field!"
          },
          Application_Amount: {
            required: "Please fill required field!",
            number: "Users can enter only integer numbers!",
            range: "Range shold be 1000 to 10,000.",
          },
          branch_name_sole: {
            required: "Please fill required field!",
          },
          Bank_Branch: {
            required: "Please fill required field!",
          },
          IFSC_Code: {
            required: "Please fill required field!",
          },
          Account_No_: {
            required: "Please fill required field!",
          },
          "ODMFO_Year[]": {
            required: "Please fill required field!",
          },
          "ODMFO_Quantity_Of_Display_Or_Duration[]": {
            required: "Please fill required field!",
          },
          "ODMFO_Billing_Amount[]": {
            required: "Please fill required field!",
          },
          PAN: {
            required: "Please fill required field!",
            alphanumeric: "Users can enter only  Alphanumeric"
          },
          Notarized_Copy_File_Name: {
            required: "Please fill required field!",
          },
          Attach_Copy_Of_Pan_Number_File_Name: {
            required: "Please fill required field!",
          },
          Affidavit_File_Name: {
            required: "Please fill required field!",
          },
          Photo_File_Name: {
            required: "Please fill required field!",
          },
          Legal_Doc_File_Name: {
            required: "Please fill required field!",
          },
          GST_File_Name: {
            required: "Please fill required field!",
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
          Quantity_Of_Display: {
            required: "Please fill required field!",
          },
          License_From: {
            required: "Please fill required field!",
          },
          License_To: {
            required: "Please fill required field!",
          },
          self_declaration: {
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


        function formSubmit()
        {
            var data = new FormData($("#personal_media")[0]);
            $.ajax({
            url : '/personal-existing-user-data',
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data)
            {
                console.log(data);
                swal("Data saved successfully your code is "+ data.code).then(function(){
                window.location='personal-list';
                });
            }
            });
        }


      if (form.valid() === true) {
        if ($('#tab1').is(":visible")) {
          current_fs = $('#tab1');
          formSubmit();
          next_fs = $('#tab1');
          $("a[id='#tab1']").addClass("active");
        //   $("a[id='#tab2']").addClass("active");
        //   nextSaveData('next_tab_1');
        //   $("#next_tab_1").val("0");
        } 
        // next_fs.show();
        current_fs.show();
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
  
        if ($.trim($(this).val()) == '') {
          flag = false;
          $("#" + reid + i).addClass('is-invalid');
          $(this).parent('p').append('<span  id="' + reid + i + i + '-error" class="error invalid-feedback">Please fill required field!</span>');
        }
        $("#" + reid + i + "-error").hide();
      });
  
      //console.log(flag)
      return flag;
    }, "");
  
  
    //email validation formate
    jQuery.validator.addMethod("emailExt", function (value, element, param) {
      return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/);
    }, 'Please enter a vaild email address');
    ///////////////////////IFSC///////////////
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
  //GST validation 
       
      jQuery.validator.addMethod('testgst', function(value) {
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
    $("#add_row").click(function () {
      var i = $("#increse_i").val();
      i++;
      $("#details_of_owners").append('<div class="row" style="padding: 10px 18px 0 18px;"><div class="col-md-4"><div class="form-group"><label for="owner_name">Publication Name / प्रकाशन का नाम</label><p><input type="text" name="owner_name[]" id="owner_name' + i + '" placeholder="Enter Owner`s Name" maxlength="40" class="form-control form-control-sm form-control form-control-sm-sm owner_name"onkeypress="return onlyAlphabets(event,this);" ></p></div></div><div class="col-md-4"><div class="form-group"><label for="email">Email / ईमेल<font color="red">*</font></label><p><input type="text" name="owner_email[]" id="owner_email' + i + '" placeholder="Enter Email" maxlength="30" onchange="return checkUniqueOwnerpersonalmedia(this, this.value,' + i + ')" class="form-control form-control-sm form-control form-control-sm-sm"><span id="alert_owner_email' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="mobile">Mobile / मोबाइल<font color="red">*</font></label><p><input type="text" name="owner_mobile[]" id="owner_mobile' + i + '" maxlength="10" placeholder="Enter Mobile" onkeypress="return onlyNumberKey(event)" onchange="return checkUniqueOwnerpersonalmedia(this, this.value,' + i + ',0)" class="form-control form-control-sm form-control form-control-sm-sm"><span id="alert_owner_mobile' + i + '" style="color:red;display: none;"></span></p></div></div><div class="col-md-4"><div class="form-group"><label for="address">Address / पता<font color="red">*</font></label><p><textarea type="text" name="address[]" id="owner_address' + i + '" maxlength="120" placeholder="Enter Address" rows="1" class="form-control form-control-sm form-control form-control-sm-sm"></textarea></p></div></div><div class="col-md-4"><div class="form-group"> <label for="fax">Fax / फैक्स</label><input type="text" name="fax_no[]" id="owner_fax' + i + '" placeholder="Enter Fax" class="form-control form-control-sm form-control form-control-sm-sm" maxlength="14"></div></div><div class="col-md-10"></div><div class="col-md-2" style="padding-left: 58px;"><button class="btn btn-danger remove_row"><i class="fa fa-minus"></i> Remove</button></div></div>');
      $("#increse_i").val(i);
    });
  
    $("#details_of_owners").on('click', '.remove_row', function () {
      $(this).parent().parent().remove();
    });
  });
  $(document).ready(function () {
    var currentYear = (new Date()).getFullYear();
    for (var i = 1980; i <= currentYear; i++) {
      var option = document.createElement("OPTION");
      option.innerHTML = i;
      option.value = i;
      $(".ddlYears").append(option);
    }
    $("#add_rows_next").click(function () {
      var i = $("#count_i").val();
      i++;
      $("#details_of_work_done").append(
        '<div class="row"><div class="col-md-4"><div class="form-group"><label for="year">Year / वर्ष<font color="red">*</font></label><p><select name="ODMFO_Year[]" id="Years' + i + '" class="form-control form-control-sm form-control form-control-sm-sm ddlYears"><option value="">Select Year</option></select></p></div></div><div class="col-md-4"><div class="form-group"><label for="quantity_duration">Quantity of Display or Duration / प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label><p><input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" maxlength="8" id="quantity_duration' + i + '" onkeypress="return onlyNumberKey(event)" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm form-control form-control-sm-sm"></p></div></div><div class="col-md-4"><div class="form-group"><label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि (रु)<font color="red">*</font></label><p><input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount' + i + '" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm form-control form-control-sm-sm" maxlength="14" onkeypress="return onlyNumberKey(event)"></p></div></div>    <div class="col-md-4"><div class="form-group"><label>From Date / की तिथि से<font color="red">*</font></label><p><input type="date" name="from_date[]" id="from_date'+i+'" class="form-control form-control-sm"></p></div></div> <div class="col-md-4"><div class="form-group"><label>To Date / तारीख तक <font color="red">*</font></label><p><input type="date" name="to_date[]" id="to_date'+i+'" class="form-control form-control-sm"></p></div></div>     </div><div class="col-md-6"></div><div class="col-md-2" style="padding: 2% 0 5 90%"><button class="btn btn-danger remove_row_next" data="' + i + '"><i class="fa fa-minus"></i> Remove</button><input type="hidden" value="" name="line_no" id="line_no_' + i + '"><input type="hidden" value="" name="odmedia_id" id="odmedia_id_' + i + '"></div></div>'
      );
      $("#count_i").val(i);
      for (var i = 1980; i <= currentYear; i++) {
        var option = document.createElement("OPTION");
        option.innerHTML = i;
        option.value = i;
        $(".ddlYears").append(option);
      }
    });
    $("#details_of_work_done").on('click', '.remove_row_next', function () {
      var ind = $(this).attr('data');
       var line_no = $("#line_no_" + ind).val();
      var odmedia_id = $("#odmedia_id_" + ind).val();
      if (line_no != '' && odmedia_id != '') {
        if (confirm("Are you sure you want to delete this?")) {
  
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            type: 'get',
            url: 'remove-workdone-data',
            data: {
              line_no: line_no, od_media_id: odmedia_id
            },
            success: function (response) {
              console.log(response);
            }
          });       
        } else {
          return false;
        }
      }
      $(this).parent().parent().remove();
    });
  
    //Loop and add the Year values to DropDownList.
  
  });
  
  ////////////// file upload validation ////////////////
  $(document).ready(function () {
    $(".custom-file-input").change(function () {
      var id = $(this).attr("id");
      var id1 = $(this).attr("id");
      var laststringunderscop = id1.match(/[^_]*$/)[0];
      //get string before modify
      if(laststringunderscop == 'modify'){
       id1 = id1.slice(0, id1.lastIndexOf('_'));
      }
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
        $("#" + id1 + 1).hide();
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
            $("#" + id1 + 1).hide();
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
            $("#" + id1 + 1).text('File already selected!');
            $("#" + id1 + 1).show();
            $("#" + id + "-error").addClass("hide-msg");
          }
        }
      } else {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id1 + 1).text('File size should be 2MB and file should be pdf!');
        $("#" + id1 + 1).show();
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + "-error").addClass("hide-msg");
        $("#" + id + 4).hide();
      }
    });
  });
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  
  // upload document Quantity yearly
  function uploadFile(i, thiss) {
    var file = thiss.files[0].name;
    var totalBytes = thiss.files[0].size;
    //var sizeKb = Math.floor(totalBytes / 1000);
    var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb < 2 && ext == "pdf") {
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } else {
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text("Choose file");
      $("#upload_doc_error" + i).text('File size should be 2MB and file should be pdf!');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }
  
  
  $(document).ready(function () {
    $("input[name='optradio']").click(function () {
      var radioValue = $("input[name='optradio']:checked").val();
      console.log(radioValue);
      if (radioValue == '1') {
        $("#radio").show();
      } else {
        $("#radio").hide();
        $("#DO_Address").val('');
        $("#DO_Landline_No").val('');
        $("#DO_Fax_No").val('');
        $("#DO_Email").val('');
        $("#DO_Mobile").val('');
        $("#Other_Relevant_Information").val('');
        $("#Legal_Status_of_Company").val('');
      }
    });
  });
  
  $(document).ready(function () {
    $("input[name='boradio']").click(function () {
      var radioValue = $("input[name='boradio']:checked").val();
      console.log(radioValue);
      if (radioValue == '1') {
        $("#boradio").show();
      } else {
        $("#boradio").hide();
        $("#BO_Address").val('');
        $("#BO_Landline_No").val('');
        $("#BO_Fax_No").val('');
        $("#BO_Email").val('');
        $("#BO_Mobile").val('');
      }
    });
  });
  
  //Show and hide div for payment type(DD and NEFT)
  $('#select_payment').change(function () {
    var payment_type = $('#select_payment').val();
    if (payment_type == 0) {
      $('#dd_div').show();
      $('#neft_div').hide();
  
      $("#PM_Agency_Name").val('');
      $("#pan_no").val('');
      $("#bank_name_2").val('');
      $("#branch_2").val('');
      $("#ifsc_code").val('');
      $("#account_no").val('');
    } else {
      $('#dd_div').hide();
      $("#dd_no").val('');
      $("#dd_date").val('');
      $("#bank_name_1").val('');
      $("#DD_Bank_Branch_Name").val('');
      $("#dd_amount").val('');
  
      $('#neft_div').show()
    }
  });
  $(document).ready(function () {
    var payment_type = $('#select_payment').val();
    if (payment_type == 0) {
      $('#dd_div').show();
      $('#neft_div').hide();
    } else {
      $('#dd_div').hide();
      $('#neft_div').show()
    }
  });
  
  $(document).on('change', '.media_sub_category', function () {
    if ($(this).val() != '') {
      // var id = $(this).attr("data");
      // alert($(this).attr("data"));
      $("#sub_category_outdoor").empty();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'get',
        url: 'getMediaSubCategory',
        data: {
          cat_id: $(this).val()
        },
        success: function (response) {
          console.log(response);
          $("#sub_category_outdoor").html(response.message);
        }
      });
    }
  });
  
  //unique Email function start
  function checkUniqueOwnerpersonalmedia(thisd, val, i) {
    if (val != '') {
      var user_id = $('input[name="user_id"]').val();
      //var user_email = $('input[name="user_email"]').val();
  
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'GET',
        url: 'personalcheckuniqueowner',
        data: {
          data: val,
          id: user_id,
          // email: user_email
        },
        success: function (response) {
  
          if (response.status == 0 && thisd.id == 'owner_email' + i) {
            console.log(response);
            $("#owner_name" + i).prop("readonly", false);
            $("#owner_mobile" + i).prop("readonly", false);
            $("#owner_address" + i).prop("readonly", false);
            $("#owner_state" + i).prop("disabled", false);
            $("#owner_district" + i).prop("disabled", false);
            $("#owner_city" + i).prop("readonly", false);
            $("#owner_phone" + i).prop("readonly", false);
            $("#owner_fax" + i).prop("readonly", false);
            // owner not exit clean data 
            if ($("#owner_input_clean").val() == 0) {
              $("#owner_state" + i).val('');
              $("#owner_district" + i).val('');
              $("#owner_name" + i).val('');
              $("#owner_mobile" + i).val('');
              $("#owner_address" + i).val('');
              $("#owner_city" + i).val('');
              $("#owner_phone" + i).val('');
              $("#owner_fax" + i).val('');
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
          }
          if (response.status == 1 && thisd.id == 'owner_email' + i) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'GET',
              url: 'fetchpersonalownerrecord',
              data: {
                data: val
              },
              success: function (response) {
                if (response.status == 1) {
                  $("#owner_state" + i).empty();
                  $("#owner_district" + i).empty();
                  $("#owner_name" + i).val(response.message['Owner Name']);
                  $("#owner_mobile" + i).val(response.message['Mobile No_']);
                  $("#owner_address" + i).val(response.message['Address 1']);
                  $("#owner_state" + i).html(response.state);
                  $("#owner_district" + i).html(response.districts);
                  $("#owner_city" + i).val(response.message['City']);
                  $("#owner_phone" + i).val(response.message['Phone No_']);
                  $("#owner_fax" + i).val(response.message['Fax No_']);
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
                          return $("#emailarr").val() + ',' + $(this).val();
                        });
                      });
  
                    } else {
                      // $("#alert_" + thisd.id).html("Please enter unique Owner ID");
                      // $("#alert_" + thisd.id).show();
                      // $("#owner_state" + i).val('');
                      // $("#owner_district" + i).val('');
                      // $("#owner_name" + i).val('');
                      // $("#owner_mobile" + i).val('');
                      // $("#owner_address" + i).val('');
                      // $("#owner_city" + i).val('');
                      // $("#owner_phone" + i).val('');
                      // $("#owner_fax" + i).val('');
                      // $("#ownerid" + i).val('');
                      // //  $("#exist_owner_id").val('');
                      // $("#mobilecheck").val('');
                    }
                  }
                  // if ($("#ownerid").val() == '') {
                  //   $("#ownerid").val(response.message['Owner ID']);
                  // } else {
                  //   var ownerids = $("#ownerid").val();
                  //   var ownerArray = ownerids.split(',');
                  //   if (isInArray(response.message['Owner ID'], ownerArray) == false) {
                  //     $("#ownerid").val(function () {
                  //       return $("#ownerid").val() + ',' + response.message['Owner ID'];
                  //     });
                  //     var ownerids = $("#ownerid").val();
                  //     var ownerArray = ownerids.split(',');
                  //     $("#ownerid").val(ownerArray);
                  //   }
                  // }
                }
  
                // if (response.ownerID > 0) {
                //   $("#owner_name" + i).prop("readonly", true);
                //   $("#owner_mobile" + i).prop("readonly", true);
                //   $("#owner_address" + i).prop("readonly", true);
                //   $("#owner_state" + i).prop("disabled", true);
                //   $("#owner_district" + i).prop("disabled", true);
                //   $("#owner_city" + i).prop("readonly", true);
                //   $("#owner_phone" + i).prop("readonly", true);
                //   $("#owner_fax" + i).prop("readonly", true);
                // }
                $("#owner_input_clean").val(0);
              }
            });
  
          } else if (response.status == 1 && thisd.id == 'owner_mobile' + i && val != $("#mobilecheck").val()) {
            // console.log(thisd.id);
            $("#alert_" + thisd.id).html(titleCase(thisd.id.replaceAll('_', ' ')).replace(/\d+/g, '') + ' ' + response.message);
            $("#alert_" + thisd.id).show();
          } else {
            // console.log(id.id);
            $("#alert_" + thisd.id).hide();
          }
          if (thisd.id == 'owner_mobile' + i) {
            $("#owner_input_clean").val(1);
          }
        }
      });
    }
  }
  //unique Email function End
  
  // Check Unique Data 
  function checkUniqueVendor(id, val) {
    if (val != '') {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        type: 'GET',
        url: 'personalcheckuniquevendor',
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
  function isInArray(value, array) {
    return array.indexOf(value) > -1;
  }
  
  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  
  $("#ifsc_code").on('blur', function(){
    var IFSC =$(this).val();
    $.ajax({
      url:'https://ifsc.razorpay.com/'+IFSC,
      type:'get',
      success:function(data){
        if(data.UPI ==true && IFSC !=''){
           console.log(data);
        $("#bank_name").val(data.BANK);
        $("#branch_name").val(data.BRANCH);
        //$("#address_of_account").val(data.ADDRESS);
      }else{
        $("#bank_name").val('');
        $("#branch_name").val('');
       // $("#address_of_account").val('');
      }
      },
       error: function (error) {
          console.log(error);
      }
    
    })
  })
  $(document).ready(function () {
    $("#GST_No").on('blur', function () {
      $("#PM_Agency_Name").val('');
      var gstNumber = $("#GST_No").val();
      // console.log(gstNumber);
      $.ajax({
        url: '/get-agencyName-fromgst',
        type: 'GET',
        data: { gstNumber: gstNumber },
        success: function (data) {
          console.log(data);
          $("#PM_Agency_Name").val(data.legalName);
  
        }
      });
    });
  });



  $(document).on("change",".subcategory",function(){
    var getID=$(this).attr('data-eid');
    var sub_category_val=$("#"+getID).val();
    $.ajax({
      url : '/personal-find-sub-category',
      type : 'GET',
      data:{sub_category_val : sub_category_val},
      success:function(data)
      {
        if(data.status=='1')
        {
          swal("Error", "You have allready selected this sub-category!", "error");
          $("#"+getID).val('');
          // sweet alert
        }
        
      }
    });
    
  });