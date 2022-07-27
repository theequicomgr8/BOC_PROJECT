// Alphabetic validation
function alphaOnly(event) {
  var inputValue = event.charCode;
      if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
          event.preventDefault();
    }
}

	function onlyAlphabets(e, t) {
			try {
				if (window.event) {
					var charCode = window.event.keyCode;
				}
				else if (e) {
					var charCode = e.which;
				}
				else { return true; }
				if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32) || (charCode == 45))
					return true;
				else
					return false;
			}
			catch (err) {
				alert(err.Description);
			}
		}

    function onlyNumberKey(evt) {
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
      return false;
      return true;
    }


$(document).ready(function(){
  $(".media-producers-next-button").click(function(){

    function firstTab()
    {
        if($('#modify').val() == 1){
            console.log('modify');
            return false;
        }
      var data =new FormData($("#av_media_producers")[0]);
        $.ajax({
            url :'/first_insert',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            },
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data)
            {
                console.log(data);
            }
        });
    }

function tab_2_3()
{
    if($('#modify').val() == 1){
        console.log('modify');
        return false;
    }
  $("#tab-one").attr('value',0);
  var data =new FormData($("#av_media_producers")[0]);
    $.ajax({
        url :'/first_insert',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        data: data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data)
        {
            console.log(data);
        }
    });
}


function final_submit()
{
    if($('#modify').val() == 1){
        console.log('modify');
        return false;
    }
    var data =new FormData($("#av_media_producers")[0]);
    $.ajax({
        url :'/first_insert',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        data: data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data)
        {

        }
    });
}




function status_change()
{
  $("#tab-one").attr('value',0);
    var data =new FormData($("#av_media_producers")[0]);
    $.ajax({
        url: '/final_submit',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
        },
        data: data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data)
        {
            console.log(data);
          $("#Final_submi").show();
            $("#Final_submi").text(data.msg);

            setTimeout(function(){
              window.location.href ='audio';
             },10000);
        }
    });
}


    var form = $("#av_media_producers");
    form.validate({
      rules: {
              category:
              {
                required: true
              },

              name_executive_producers : {
              required: true,
              minlength: 5,
              maxlength: 100,
            },

            other_category:
            {
              // required: true,
              number: true,
              // maxlength: 1,
            },
            office_address:
            {
              required: true,
              maxlength:250,
            },
            residential_address:
            {
              required: true,
              maxlength:250,
            },
            office_telephone_no:
            {
              // required: true,
              number:true,
            },
            resident_telephone_no:
            {
              // required: true,
              maxlength:15,
              number:true,
            },
            mobile: {
              required: true,
              minlength: 10,
              maxlength: 10,
              number:true
            },
            email: {
              required: true,
              email: true,
              emailExt: true,
            },
            have_office:
            {
              // required: true,
              maxlength:150,
            },
            contact_person:
            {
              // required: true,
              maxlength:50
             },
            phone: {
              number:true
            },
            Contact_Person_Fax:
            {
              // required:true,
              number: true,
              maxlength:15
            },
           org_type:
            {
              required:true,
            },
            partners_address:{
              required: true,
            },
            net_worth:
            {
              required:true,
              number:8
            },
            number_of_audio:
            {
              required:true,
              number: true
            },
            details_programme:
            {
              required:true,
              maxlength:100
            },
            Channel:
            {
              required: true,
              maxlength:50,
            },
            telecast_date:
            {
              required:true,
            },
            TRP:
            {
              required:true,
              number:true,
              maxlength:5
            },
            address_studio:
            {
              required:true,
            },
            landline_no:
            {
              required:true,
            },
            payee_name:
            {
              required: true,
            },
            pan_number:
            {
              required: true,
            },
            dd_no:
            {
              required: true,
            },
            drawn_on_bank:
            {
              required:true,
            },
            registration_certificate:
            {
              required: true,
            },
            income_tax_return:
            {
              required:true,
            },
            cancelled_cheque:
            {
              required:true,
            },
            bio_data:
            {
              required: true,
            },
            government_departments:
            {
              number: true
            },
            institution_name:
            {
              required: true
            },
            degree_year:
            {
              required: true
            },
            degree_area:
            {
              required: true
            },
            list_of_award:
            {
              maxlength: 200,
            },
            list_of_programme:
            {
              required: true,
            },
            // social_sector:
            // {
            //   required: true,
            // },
            other_relevant_information:
            {
              maxlength: 200
            },
            partnership_firm_state:
            {
              required: true
            },
            net_worth:
            {
              required: true
            },

             Bank_account_number: {
                required: true,
                number: true
            },
            A_C_Holder_name: {
                required: true,
            },
            IFSC_code: {
                required: true,
            },
            Branch_name: {
                required: true
            },
            Bank_name: {
                required: true,
            },
            Bank_account_address: {
                required: true
            },
            PAN_No: {
                Panvalid: true,
            },
            GST_No: {
                testva: true,
            },
            Acceptance:{
                required: true,
            },
            organization_name:{
                required:true,
            },
            org_legal_status:{
                required:true,
            },
        },
        messages: {
          category: {
            required: "Please select category!",
          },
          name_executive_producers: {
            required: "Please Fill Required Field",
            minlength: "Name length should be min 5 Character!",
            maxlength: "Name length should be max 100 Character!"
          },

          office_address:
          {
            required: "Please Fill Required Field",
          },
          other_category:
          {
            number: "Please fill only number!",
          },
          residential_address:
          {
            required: "Please Fill Required Field",
          },
          office_telephone_no:
          {
            maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          resident_telephone_no:
          {
            maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          fax_noo:
          {
            maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          mobile: {
            required: 'Please Fill Required Field',
            maxlength: "Mobile length should be max and min 10 digit!",
            number: "Users can enter only integer numbers!"
          },
          email: {
            required: 'Please Fill Required Field',
            email: "Please enter a vaild email address!"
          },
          have_office:
          {
            maxlength: "User can should max 150 character!",
          },
          contact_person:
          {
            maxlength: "User can should max 150 character!",
          },

          phone: {
            number: "Users can enter only integer numbers!"
          },

           Contact_Person_Fax:
          {
             maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          org_type:
          {
            required: "Please Fill Required Field"
          },
          partners_address:
          {
            required: "Please Fill Required Field",
          },
          net_worth:
          {
            number: "Users can enter only integer numbers!",
          },
          number_of_audio:
          {
            number: "Users can enter only integer numbers!",
          },
          details_programme:
          {
            required: "Please Fill Required Field",
            maxlength: "user can enter maxlength 100!",
          },
          Channel:
          {
            required: "Please Fill Required Field",
          },
          telecast_date:
          {
            required: "Please Fill Required Field",
          },
          TRP:
          {
            required: "Please Fill Required Field",
            maxlength: "TRP length should be max and min 5 digit!",
          },
          address_studio:
          {
            required: "Please Fill Required Field",
          },
          landline_no: {
            required: "Please Fill Required Field",
            maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          fax_no:
          {
            maxlength: "Fax length should be max and min 15 digit!",
            number: "Users can enter only integer numbers!"
          },
          payee_name:
          {
            required: "Please Fill Required Field",
          },
          pan_number:
          {
            required:"Please Fill Required Field"
          },
          dd_no:
          {
            required:"Please Fill Required Field"
          },
          drawn_on_bank:
          {
             required:"Please Fill Required Field"
           },
          registration_certificate:
          {
            required:"Please Fill Required Field"
          },
          income_tax_return:
          {
            required:"Please Fill Required Field"
          },
          cancelled_cheque:
          {
            required:"Please Fill Required Field"
          },
          bio_data:
          {
            required:"Please Fill Required Field"
          },
          government_departments:
          {
            number: "Users can enter only integer numbers!"
          },
          institution_name:
          {
            required:"Please Fill Required Field"
          },
          degree_year:
          {
            required: "Please Fill Required Field"
          },
          degree_area:
          {
             required: "Please Fill Required Field"
          },
          list_of_award:
          {
            maxlength: "User can enter maxlength 200 characters"
          },
          list_of_programme:
          {
            required: "Please Fill Required Field"
          },
          // social_sector:
          // {
          //   required: "Please select required!"
          // },
          other_relevant_information:
          {
            maxlength: "User can enter maxlength 200 characters!"
          },
          partnership_firm_state:
          {
            required: "Please Fill Required Field"
          },
          net_worth:
          {
            required: "Please Fill Required Field"
          },

           Bank_account_number: {
                   required: "Please Fill Required Field",
                    number: "Users can enter only integer numbers!"
                },
                A_C_Holder_name: {
                    required: "Please Fill Required Field"
                },
                 IFSC_code: {
                    required: "Please Fill Required Field"
                  },
                Branch_name: {
                   required: "Please Fill Required Field"
                },
                Bank_name: {
                   required: "Please Fill Required Field"
                },
                Bank_account_address: {
                    required: "Please Fill Required Field"
                },
                Acceptance:{
                    required: "Please Fill Required Field"
                },
                organization_name:{
                    required:"Please Fill Required Field"
                },
                org_legal_status:{
                    required:"Please Fill Required Field"
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
        firstTab();
        next_fs = $('#tab2');
        $("a[href='#tab1']").removeClass("active");
        $("a[href='#tab2']").addClass("active");
        $("#next_tab_1").val("0");

      } else if ($('#tab2').is(":visible")) {
        current_fs = $('#tab2');
        tab_2_3();
        next_fs = $('#tab3');
        $("a[href='#tab2']").removeClass("active");
        $("a[href='#tab3']").addClass("active");
        $("#next_tab_2").val("0");

      } else if ($('#tab3').is(":visible")) {
        current_fs = $('#tab3');
        tab_2_3();
        next_fs = $('#tab4');
        $("a[href='#tab3']").removeClass("active");
        $("a[href='#tab4']").addClass("active");
        // nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");
      }
       else if ($('#tab4').is(":visible")) {
        current_fs = $('#tab3');
        final_submit();
        status_change();
        next_fs = $('#tab4');
        $("a[href='#tab3']").removeClass("active");
        $("a[href='#tab4']").addClass("active");
        // nextSaveData('next_tab_3');
        $("#next_tab_3").val("0");
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
// function IsAlphaNumeric(e) {
//             // alert(e.keyCode);
//              var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
//              var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <=122) || (keyCode == 32));
//              document.getElementById("error").style.display = ret ? "none" : "inline";
//              return ret;
//          }

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

// $('#section_a').hide();
// $('#section_b').hide();
// $('#section_c').hide();
$('#category').change(function(){
  var category =$('#category option:selected').val();
  if(category == "0"){
    $('#section_a').show();
    // $("#net_worth_b").attr('disabled');
    // $("#details_programme_b").attr('disabled');
    // $("#Channel_b").attr('disabled');
    // $("#datepicker1_b").attr('disabled');
    // $("#TRP_b").attr('disabled');
  }else{
    $('#section_a').hide();
  }
   if(category == "1"){
    $('#section_b').show();
    // $("#net_worth_a").attr('disabled');
    // $("#details_programme_a").attr('disabled');
    // $("#Channel_a").attr('disabled');
    // $("#datepicker1_a").attr('disabled');
    // $("#TRP_a").attr('disabled');
  }else{
    $('#section_b').hide();
  }
    if(category == "2"){
    $('#section_c').show();
  }else{
    $('#section_c').hide();
  }


});


$("#category").change(function(){
  var category=$("#category").val();
  if(category=='0')
  {
    $("#net_worth_a").removeAttr('disabled');
    $("#details_programme_a").removeAttr('disabled');
    $("#Channel_a").removeAttr('disabled');
    $("#datepicker1_a").removeAttr('disabled');
    $("#TRP_a").removeAttr('disabled');
    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');
  }
  if(category=='1')
  {
    $("#net_worth_b").removeAttr('disabled');
    $("#details_programme_b").removeAttr('disabled');
    $("#Channel_b").removeAttr('disabled');
    $("#datepicker1_b").removeAttr('disabled');
    $("#TRP_b").removeAttr('disabled');
    $("#address_studio_b").removeAttr('disabled');
    $("#landline_no_b").removeAttr('disabled');
    $("#fax_no_b").removeAttr('disabled');
    $("#net_worth_b").removeAttr('disabled');
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');

  }
  if(category=='2')
  {
    $("#net_worth_c").removeAttr('disabled');
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');

    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_b").attr('disabled','disabled');
  }


  if(category=='3')
  {
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');

    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_b").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');
  }



});

var category=$("#category").val();
  if(category=='0')
  {
    $("#net_worth_a").removeAttr('disabled');
    $("#details_programme_a").removeAttr('disabled');
    $("#Channel_a").removeAttr('disabled');
    $("#datepicker1_a").removeAttr('disabled');
    $("#TRP_a").removeAttr('disabled');
    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');
  }
  if(category=='1')
  {
    $("#net_worth_b").removeAttr('disabled');
    $("#details_programme_b").removeAttr('disabled');
    $("#Channel_b").removeAttr('disabled');
    $("#datepicker1_b").removeAttr('disabled');
    $("#TRP_b").removeAttr('disabled');
    $("#address_studio_b").removeAttr('disabled');
    $("#landline_no_b").removeAttr('disabled');
    $("#fax_no_b").removeAttr('disabled');
    $("#net_worth_b").removeAttr('disabled');
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');

  }
  if(category=='2')
  {
    $("#net_worth_c").removeAttr('disabled');
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');

    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_b").attr('disabled','disabled');
  }


  if(category=='3')
  {
    $("#net_worth_a").attr('disabled','disabled');
    $("#details_programme_a").attr('disabled','disabled');
    $("#Channel_a").attr('disabled','disabled');
    $("#datepicker1_a").attr('disabled','disabled');
    $("#TRP_a").attr('disabled','disabled');

    $("#net_worth_b").attr('disabled','disabled');
    $("#details_programme_b").attr('disabled','disabled');
    $("#Channel_b").attr('disabled','disabled');
    $("#datepicker1_b").attr('disabled','disabled');
    $("#TRP_b").attr('disabled','disabled');
    $("#address_studio_b").attr('disabled','disabled');
    $("#landline_no_b").attr('disabled','disabled');
    $("#fax_no_b").attr('disabled','disabled');
    $("#net_worth_b").attr('disabled','disabled');
    $("#net_worth_c").attr('disabled','disabled');
  }



$(document).ready(function(){

      /*===============IFCS Code Validation===================*/
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
            $("#IFSC_code_Error").text('Please Fill Required Field').css({
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
            $("#PAN_No_Error").text('Please Fill Required Field').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        }

    }, '');
    //GST validation
    jQuery.validator.addMethod('testva', function(value) {
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
            $("#GST_No_Error").text('Please Fill Required Field').css({
                "color": "red",
                "font-weight": "100",
                "font-size": "11px"
            });
            return false;
        }
    }, '');


    /*===============End IFCS Code Validation===================*/
});
//PRIYANSHI SINGH CODE
function ifscCodeFunction(IFSC){
    $("#IFSC_code").css('pointer-event','visible');
    $.ajax({
        url:'https://ifsc.razorpay.com/'+IFSC,
        type:'get',
        success:function(data){
          if(data.UPI ==true && IFSC !=''){
             console.log(data);
          $("#Bank_name").val(data.BANK);
          $("#Branch_name").val(data.BRANCH);
        }else{
          $("#Bank_name").val('');
          $("#Branch_name").val('');
        }
        },
         error: function (error) {
            console.log(error);
            $("#Bank_name").val('');
            $("#Branch_name").val('');
        }
      })
}

/* All Form disabled */
$(document).ready(function () {
    if($('#modify').val()==1){
        $('form *').prop('disabled',true);
    }
    else{
        $('form *').prop('disabled',false);
    }
});
