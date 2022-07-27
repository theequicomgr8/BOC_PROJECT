// Alphabetic validation
function alphaOnly(event) {
  var inputValue = event.charCode;
      if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
          event.preventDefault();
    }
}
$(document).ready(function(){
       $.validator.addMethod('TB1_To',function(value, element){
         var froma_id = element.getAttribute('data-deep');
         var fromatt_id = element.getAttribute('data-id');
        var from_id = '#' + fromatt_id + 'To';
        $("#"+ froma_id +"From").attr('min',(value));
        var getval =$("#"+ froma_id +"From").val(value);
        var preval =$(from_id).val();
        $("#"+ froma_id +"From").attr('select','select');
        $(from_id).css("border-color", "#ced4da");
        $("#" + fromatt_id + "From-error").hide();
        $("#" + fromatt_id + "To-error").hide();
        return true;
    },'');
})
$(document).ready(function(){
  $(".community-next-button").click(function(){
    var form = $("#community_radio_station");
    form.validate({
      rules: {
            owner_name: {
              minlength: 5,
              maxlength: 40,
              required: true,
            },
            email: {
              required: true,
              emailExt: true,
            },

            address1: {
              required: true,
            },
            city: {
              required: true,
            },
            state: {
              required: true,
            },

            district: {
              required: true,
            },
            phone: {
              maxlength: 15,
              number:true,
              // required: true,
            },

            /*-------Start Channel ----------------------------*/
            Name:{
              required: true,
            },
            Agency_Code:
            {
              required: true,
            },
            Frequency:{
             required: true,
             },

            Language: {
              required:true,
            },
            /*-------End Channel ----------------------------*/
            /* Start Vlidation ime Band */
              "TB_From1[]":
              {

              required:true,
              mon_tb_from:true,
              },
              "TB_To1[]":
              {
                required:true,
                TB1_To:true,
                mon_tb_to:true,

              },
              "TB_From2[]":
              {
                 required:true,
                 mon_tb_from:true,
              },
              "TB_To2[]":
              {
                 required:true,
                 TB1_To:true,
                 mon_tb_to:true,
              },
               "TB_From3[]":
              {
                  required:true,
                  mon_tb_from:true,
              },
              "TB_To3[]":
              {

                required:true,
                mon_tb_to:true,
              },

      /*------ End Vlidation ime Band -------*/
           /*-------End Channel ----------------------------*/

      /*------- Start GOPA Details--------- */
            GOPA_Signing_Date:
            {
              required:true,
            },
            GOPA_Valid_upto: {
              required: true,
            },

            Cnannel_Head:
            {
              required:true,
            },
            Channel_Launch_Date:
            {
              required:true,
            },
      /*----End GOPA Details---- */
      /*-----Start Channel Office------*/
            WOL_Number:
            {
              required: true,
            },
            WOL_Signing_Date:
            {
              required:true,
            },

            WOL_Valid_Upto:{
              required:true,
            },

            Company_Legal_Status:
            {
              required:true,
            },

            PIN_Code:{
              required:true,
              number:true,
            },

            Address:
            {
              required:true,
            },

            City:{
               required:true,
            },
            District:{
               required:true,
            },

            State:{
              required: true,
            },
            // std_channel_office:{
            //   required:true,
            //   number:true
            // },
            Phone_No:{
                 // required:true,
                 number:true,
            },

            E_Mail:{
               required: true,
                email:true,
                emailExt: true,
            },
            PIN_Code:{
              required:true,
              number:true,
              maxlength: 6,
              minlength: 6,
            },
  /*-----End Channel Office------*/
  /*-----Start Channel Head Office------*/
            HO_Address:
            {
              required:true,
            },

            HO_City:{
               required:true,
            },

            HO_District:{
               required:true,
            },

            HO_State:{
              required: true,
            },

            HO_Phone_No:{
                 // required:true,
                 number:true,
            },

            HO_E_Mail:{
               required: true,
               emailExt: true,
                email:true,

            },

            HO_PIN_Code:{
              required:true,
              number:true,
              maxlength: 6,
              minlength: 6,
            },
/*--------------End Channel Head Office-------------------*/

/*-------------Start Owner Head Office------------*/
            OHO_Address:{
              required:true,
            },

            OHO_City:{
               required:true,
            },

            OHO_District:{
               required:true,
            },

            OHO_State:{
              required: true,
            },

            OHO_Phone_No:{
                 // required:true,
                 number:true,
            },


            OHO_E_Mail:{
               required: true,
               emailExt: true,
                email:true,

            },

            OHO_PIN_Code:{
              required:true,
              number:true,
              maxlength: 6,
              minlength: 6,
            },

            /*End Owner Head Office */
            Bank_Ac_No:{
              required:true,
              maxlength: 20,
              number:true,
            },

            AC_Holder_Name:{
              required:true,
            },

            PAN:{
              required:true,
             pannumber:true,
            },
            GST_No:{
              required:true,
              gstno:true,
            },

            Bank_Name:{
              required:true,
            },
            Bank_Branch:{
              required:true,

            },

            IFSC_Code:{
              required:true,
            },

            Bank_AC_Address:{
            required:true,
            maxlength:250,
            },

            ESI_AC_No:{
            required:true,
            number: true,
            maxlength:20,
            },

            ESI_No_Of_Employee:{
            required:true,
            number: true,
            maxlength:6,
            },

            EPF_AC_No:{
            required:true,
            number: true,
            maxlength:20,
            },

            EPF_No_Of_Employee:{
            required:true,
            number: true,
            maxlength:6,
            },

/*------------------------ Start Upload---------------------------------------*/
          FPC_File_Name:
           {
           required:true,
          },

          GOPA_File_Name:
           {
            required:true,
          },

          WOL_File_Name:
           {
            required:true,
          },

          GST_Cert_File_Name:
          {
            required:true,
          },

          GST_Cert_File_Name:
          {
            required:true,
          },

          PAN_Card_File_Name:
          {
            required:true,

          },

          Content_TCD_File_Name:
          {
            required:true,
          },

          CRS_Cert_File_Name:
          {
            required:true,
          },

          Rate_UT_File_Name:
          {
            required:true,
          },

          Acceptance:
          {
            required:true,
          },
          /*------------------------End Upload----------------------*/
          },
            messages: {
            owner_name: {
            required:"Please fill required publication name!",
            minlength: "Owner name must be at least 5 alphabets!",
            maxlength: "Users can type only max 100 alphabets!"
          },

          email: {
            required: "Please fill required email!",
            email: "Please enter a vaild email address!"
          },

          address1: {
            required: "Please fill required address!"
          },

          city: {
            required: "Please fill required city!"
          },

          state: {
            required: "Please select an state!"
          },

          district: {
            required: "Please select an district!"
          },
          phone: {
            required: "Please fill required phone!",
            maxlength: "Mobile length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },

          Name:{
            required:"Please fill required field!"
          },

          Agency_Code:
          {
            required:"Please fill required agency code!"
          },

          Frequency:{
            required:"Please fill required field!"

          },

          Language: {
            required:"Please fill required field!",
          },

         /* Start Time Band */
           "TB_From1[]":
           {
             required:"Please fill required field!"
           },
          "TB_to1[]":
           {
             required:"Please fill required field!"
           },
            "TB_From2[]":
           {
             required:"Please fill required field!"
           },
          "TB_to2[]":
           {
             required:"Please fill required field!"
           },
            "TB_From3[]":
           {
             required:"Please fill required field!"
           },
          "TB_to3[]":
           {
             required:"Please fill required field!"
           },
        /* End Time Band */

          /*Start GOPA Details */
          GOPA_Signing_Date:
          {
            required: "Please fill required field!"
          },
           GOPA_Valid_upto: {
            required: "Please fill required field!",
          },
          WOL_Number: {
            required: "Please fill required field!",
           },
            WOL_Signing_Date:
          {
            required: "Please fill required field!"
          },

          WOL_Valid_Upto:{
             required: "Please fill required field!",
          },
          Company_Legal_Status:
          {
              required: "Please fill required field!",
          },
          Cnannel_Head:
          {
            required: "Please fill required field!",
          },
          Channel_Launch_Date:
          {
            required: "Please fill required field!"
          },

          /*----End GOPA Details---- */

          /*----Start Channel Office ----*/
          PIN_Code:{
              required:"Please fill required field!",
              number:"Users can enter only integer numbers!"
            },

          Address:{
            required: "Please fill required field!",
          },

          City:{
                required: "Please fill required field!",
          },

          District:{
                required: "Please fill required field!",
          },

          State:{
           required: "Please fill required field!",
          },

          Phone_No:{
            required:"Please fill required field!",
             number: "Users can enter only integer numbers!"
          },

          E_Mail:{
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          },

          PIN_Code:{
            required:"Please fill required field!",
             number: "Users can enter only integer numbers!"
          },
          /*-,---End Channel Office ----*/

          /*start Channel Head Office*/

          HO_Address:
          {
            required: "Please fill required field!"
          },

          HO_City:{
                required: "Please fill required field!",
          },

          HO_District:{
                required: "Please fill required field!",
          },

          HO_State:{
           required: "Please fill required field!",
          },

          HO_Phone_No:{
            required:"Please fill required field!",
          },

          HO_E_Mail:{
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          },

          HO_PIN_Code:{
            required:"Please fill required field!",
             number: "Users can enter only integer numbers!"
          },
          /*----------End Channel Head Office------------*/

          /*-------Start Owner Head Office---------------*/
          OHO_Address:
          {
            required: "Please fill required field!",
          },

          OHO_City:
          {
            required: "Please fill required field!",
          },

          OHO_District:{
                required: "Please fill required field!",
          },

          OHO_State:{
           required: "Please fill required field!",
          },

          OHO_Phone_No:{
            required:"Please fill required field!",
             number: "Users can enter only integer numbers!"
          },


          OHO_E_Mail:{
            required: "Please fill required field!",
            email: "Please enter a vaild email address!"
          },

          OHO_PIN_Code:{
            required:"Please fill required field!",
            number: "Users can enter only integer numbers!"
          },

          /*------End Owner Head Office----------*/

          Bank_Ac_No:{
            required:"Please fill required field!",
            number: "Users can enter only integer numbers!"
          },

           AC_Holder_Name:{
            required:"Please fill required field!",
          },

          PAN:{
            required:"Please fill required field!",
            },

          GST_No:{
            required:"Please fill required field!"
          },

           Bank_Name:{
            required:"Please fill required field!"
          },
          Bank_Branch:{
            required:"Please fill required field!"
          },

          Bank_AC_Address:{
            required:"Please fill required field!",

          },

          ESI_AC_No:{
            required:"Please fill required field!",
            number:"Users can enter only integer numbers"
          },

          ESI_No_Of_Employee:{
            required:"Please fill required field!",
            number:"Users can enter only integer numbers"
          },

          EPF_AC_No:{
            required:"Please fill required field!",
            number:"Users can enter only integer numbers"
          },

          EPF_No_Of_Employee:{
            required:"Please fill required field!",
            number:"Users can enter only integer numbers"
          },

          IFSC_Code:{
          required:"Please fill required field!",
          },

          FPC_File_Name:
          {
            required:"Please fill required field!"
          },

          GOPA_File_Name:
          {
            required:"Please fill required field!"
          },

          WOL_File_Name:
          {
            required:"Please fill required field!"
          },

          GST_Cert_File_Name:
          {
            required:"Please fill required field!"
          },

          PAN_Card_File_Name:
          {
            required:"Please fill required field!"
          },

          Content_TCD_File_Name:
          {
            required:"Please fill required field!"
          },

          CRS_Cert_File_Name:
          {
            required:"Please fill required field!"
          },

          Rate_UT_File_Name:
          {
            required:"Please fill required field!"
          },

          Acceptance:
          {
            required:"Please check on checkbox!",
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
        next_fs = $('#tab2');
        $("a[href='#tab1']").removeClass("active");
        $("a[href='#tab2']").addClass("active");
         nextSaveData('next_tab_1');
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        next_fs = $('#tab3');
        $("a[href='#tab2']").removeClass("active");
        $("a[href='#tab3']").addClass("active");
         nextSaveData('next_tab_2');
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[href='#tab3']").removeClass("active");
        $("a[href='#tab4']").addClass("active");
        nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");
      }
      else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        next_fs = $('#tab4');
        $("a[href='#tab4']").addClass("active");
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
      $("a[href='#tab2']").removeClass("active");
      $("a[href='#tab1']").addClass("active");
      $("#next_tab_3").val("0");

    } else if ($('#tab3').is(":visible")) {
      current_fs = $('#tab3');
      next_fs = $('#tab2');
      $("a[href='#tab3']").removeClass("active");
      $("a[href='#tab2']").addClass("active");

    } else if ($('#tab4').is(":visible")) {
      current_fs = $('#tab4');
      next_fs = $('#tab3');
      $("a[href='#tab4']").removeClass("active");
      $("a[href='#tab3']").addClass("active");
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
jQuery.validator.addMethod("emailExt", function(value, element, param) {
return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a vaild email address');

jQuery.validator.addMethod("pannumber", function(value, element, param) {
return value.match(/^[A-z]{5}\d{4}[A-Z]{1}$/);
},'Please enter a vaild PAN No.');

jQuery.validator.addMethod("gstno", function(value, element, param) {
  return value.match(/\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/);
  },'Please enter a valid GST Number');

jQuery.validator.addMethod("IFSCCode", function(value, element, param) {
  return value.match(/^[A-Z]{4}0[0-9]{6}$/);
  },'Please enter a valid IFSC Code');


 /*==================Start Time Band Validation ==============*/
    $.validator.addMethod("mon_tb_from", function(value, element) {

        var Toatt_id = element.getAttribute('data-id');
        var to_id = '#' + Toatt_id + 'To';
        var end_date = $(to_id).val();

        if (value < end_date && end_date != '') {
            $(to_id).css("border-color", "#ced4da");
            $("#" + Toatt_id + "From-error").hide();
            $("#" + Toatt_id + "To-error").hide();

        }
        return value < end_date;
    }, 'Please select vaild time.');

    $.validator.addMethod("mon_tb_to", function(value, element) {
        var fromatt_id = element.getAttribute('data-id');
        var from_id = '#' + fromatt_id + 'From';
        var startdatevalue = $(from_id).val();
        if (value > startdatevalue && startdatevalue != '') {
            $(from_id).css("border-color", "#ced4da");
            $("#" + fromatt_id + "From-error").hide();
            $("#" + fromatt_id + "To-error").hide();
        }
        return value > startdatevalue;
    }, 'Please select vaild time.');
    /*==================End Time Band Validation ==============*/


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

//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
    return false;
  return true;
  }

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

$("#HO_Same_Address_DO").click(function(){
  if($(this).is(":checked"))
  {
    let Address= $("#Address").val();
    let PIN_Code = $("#PIN_Code").val();
    let Phone_No = $("#Phone_No").val();
    let Fax = $("#Fax").val();
    let Mobile_No = $("#Mobile_No").val();
    let E_Mail = $("#E_Mail").val();
    let City = $("#City").val();
    let State = $('#state_id1 option:selected').val();
    let District = $('#district_id1 option:selected').val();
    $("#HO_Address").val(Address);
    $("#HO_City").attr('value',City);
    $("#HO_State").val(State);
    $("#HO_District").html('<option>'+ District+'</option');
    $("#HO_Phone_No").attr('value',Phone_No);
    $("#HO_Fax").attr('value',Fax);
    $("#HO_Mobile_No").attr('value',Mobile_No);
    $("#HO_E_Mail").attr('value',E_Mail);
    $("#HO_PIN_Code").attr('value',PIN_Code);

  }
  else
  {
    $("#HO_Address").val(' ');

    $("#HO_City").attr('value','');
    $("#HO_State").val('');
    $("#HO_District").html('<option value="">Select District</option>');
    $("#HO_PIN_Code").attr('value','');
    $("#HO_Phone_No").attr('value','');
    $("#HO_Fax").attr('value','');
    $("#HO_Mobile_No").attr('value','');
    $("#HO_E_Mail").attr('value','');
  }

});
$("#checkbox1").click(function(){
  if($(this).is(":checked"))
  {
    let Address =$("#Address").val();
    let PIN_Code = $("#PIN_Code").val();
    let Phone_No = $("#Phone_No").val();
    let Fax = $("#Fax").val();
    let Mobile_No = $("#Mobile_No").val();
    let E_Mail = $("#E_Mail").val();
    let City = $("#City").val();
    let State = $('#state_id1 option:selected').val();
    let District = $('#district_id1 option:selected').val();
    $("#OHO_Address").val(Address);
    $("#OHO_City").attr('value',City);
    $("#OHO_Phone_No").attr('value',Phone_No);
    $("#OHO_Fax").attr('value',Fax);
    $("#OHO_Mobile_No").attr('value',Mobile_No);
    $("#OHO_E_Mail").attr('value',E_Mail);
    $("#OHO_PIN_Code").attr('value',PIN_Code);
    $("#OHO_State").val(State);
    $("#OHO_District").html('<option>'+ District+'</option');

  }

  else
  {
    $("#OHO_Address").val(' ');
    //$("#city_ho_owner").val(' ');
    $("#OHO_City").attr('value','');
    $("#OHO_District").html('<option value="">Select District</option>');
    $("#OHO_State").val('');
    $("#OHO_PIN_Code").attr('value','');
    $("#OHO_Phone_No").attr('value','');
    $("#OHO_Fax").attr('value','');
    $("#OHO_Mobile_No").attr('value','');
    $("#OHO_E_Mail").attr('value','');
  }

});
//Validation for number and .(Dot)
function onlyDotNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 46 || ASCIICode > 57))
    return false;
  return true;
  }

/*End Float/Decimal Validation*/
$(document).ready(function () {

  $(".custom-file-input").change(function () {
    var id = $(this).attr("id");
    id.slice(1);
   // console.log(id);
    var file = this.files[0].name;
    var totalBytes = this.files[0].size;
    // var sizeKb = Math.floor(totalBytes / 1000);
    // var ext = file.split('.').pop();
     var sizemb = (totalBytes / (1024 * 1024)).toFixed(2);
    var ext = file.split('.').pop();
    if (file != '' && sizemb <= 2 && ext == "pdf") {
      $("#" + id + 2).empty();
      $("#" + id + 2).text(file);
      $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      // if($("#doc_data").val() == ''){
      //   $("#doc_data").val(file);
      // }else{
      // var names = $("#doc_data").val();
      // var numbersArray = names.split(',');
      // if(isInArray(file, numbersArray) == false){
      //   $("#doc_data").val(function() {
      //       return $("#doc_data").val() + ',' + file;
      //   });
      $("#" + id + 1).hide();
      // }else{
      //   $("#"+id).val('');
      //   $("#"+id+2).text("Choose file");
      //   $("#"+id+3).html("Upload").addClass("input-group-text");
      //   $("#"+id+1).text('File already selected!');
      //   $("#"+id+1).show();
      //   $("#"+id+"-error").addClass("hide-msg");
      //   }
      // }
    } else {
      //console.log("hello");
      $("#" + id).val('');
      $("#" + id + 2).text("Choose file");
      $("#" + id + 1).text('File size should be less than 2MB and file should be pdf!');
      $("#" + id + 1).show();
      $("#" + id + 3).html("Upload").addClass("input-group-text");
      $("#" + id + "-error").addClass("hide-msg");
    }
  });
  });
$("#email0").on('keyup',function(){
  var email_cr='';
  email_cr =$(this).val();
  $.ajax({
     headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    },
    type:'post',
    url :'findcr',
    data :{email:email_cr},
    success:function(data)
    {   console.log(data.data1);
      if (data.status == true && email_cr != '') {
            $("#owner_name").val(data.data1.owner_name).prop("readonly", false);
            $("#email").val(data.data1.email).prop("readonly",false);
            $("#mobile0").val(data.data1.mobile0).prop("readonly", false);
            $("#address1").val(data.data1.address1).prop("readonly", false);
            $("#state_id").val(data.data1.state).prop("readonly", false);
            $("#district_id0").html('<option>'+data.data1.ds+'</option>').prop("readonly", false);
            $("#city0").val(data.data1.city0).prop("readonly", false);
            $("#phone").val(data.data1.phone).prop("readonly", false);
            $("#fax0").val(data.data1.fax0).prop("readonly", false);
            //$("#ownerid").val(data.data1.owner_id);
            // owner not exit clean data
            }else{
              //$("#fm_station").trigger('reset').prop("readonly",false);
            //$("#owner_name").val('').prop("readonly", false);
            $("#email").val('').prop("readonly",false)
            $("#mobile0").val('').prop("readonly", false);
            $("#address1").val('').prop("readonly", false);
            $("#state_id").val('').prop("readonly", false);
            $("#district_id0").html('<option>Select option </option>').prop("readonly", false);
            $("#city0").val('').prop("readonly", false);
            $("#phone").val('').prop("readonly", false);
            $("#fax0").val('').prop("readonly", false);
            $("#ownerid").val('');
            }

    }

  })
})


