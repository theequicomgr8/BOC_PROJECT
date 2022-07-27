$(document).ready(function () {
  $(".client-next-button").click(function () {
    var form = $("#client_request");
    form.validate({
      rules: {
        Name_of_Officer: {
          required: true,
          minlength: 3,
          maxlength: 40
        },
        Plan_No: {
          required: true,
          maxlength: 20
        },
        print_media_planType: {
          required: true,

        },
        multi_langauge_select: {
          required: true,
        },
        individuals_s: {
          required: true,
        },
        group_of_city: {
          required: true,
        },
        cityList: {
          required: true,
        },
        pageSize: {
          required: true,
        },

        Designation: {
          required: true,
          minlength: 2,
          maxlength: 40
        },
        email: {
          required: true,
          emailExt: true,
          maxlength: 40
        },
        mobile: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        address: {
          required: true
        },

        from_date: {
          required: true
        },
        to_date: {
          required: true
        },
        tentative_budget: {
          required: true
        },
        owner_newspaper: {
          required: true
        },
        knowncampaign: {
          required: true
        },
        un_advertise_length: {
          required: true
        },
        un_advertise_breadth: {
          required: true
        },
        un_advertise_area: {
          required: true
        },
        print_color: {
          required: true
        },

        print_target_area: {
          required: true
        },

        print_language: {
          required: true
        },
        print_media_plan: {
          required: true
        },
        print_page_length: {
          required: true
        },
        print_advertisement_display_select: {
          required: true
        },
        print_creative: {
          required: true
        },
        outdoor_medium: {
          required: true
        },
        outdoor_target_area: {
          required: true
        },
        outdoor_media_category: {
          required: true
        },
        outdoor_media_sub_category: {
          required: true
        },
        outdoor_duration: {
          required: true
        },
        outdoor_no_of_spots: {
          required: true
        },
        outdoor_creative: {
          required: true
        },
        av_tv_target_area: {
          required: true
        },
        av_tv_regions: {
          required: true
        },
        av_tv_language: {
          required: true
        },
        av_tv_secondage: {
          required: true
        },
        av_tv_creative: {
          required: true
        },
        AV_CRS_target_area: {
          required: true
        },
        AV_CRS_language: {
          required: true
        },
        AV_CRS_secondage: {
          required: true
        },
        AV_SRC_creative: {
          required: true
        },
        internet_media_language: {
          required: true
        },
        internet_advertise_length: {
          required: true
        },
        internet_advertise_breadth: {
          required: true
        },
        internet_is_create_available: {
          required: true
        },
        internet_creative: {
          required: true
        },
        digital_media_duration: {
          required: true
        },
        digital_media_band: {
          required: true
        },
        digital_target_area: {
          required: true
        },
        digital_language: {
          required: true
        },
        digital_secondage: {
          required: true
        },
        digital_is_creative_available: {
          required: true
        },
        digital_creative: {
          required: true
        },
        sms_media_target_area: {
          required: true
        },
        sms_media_language: {
          required: true
        },
        sms_media_content_length_limit: {
          required: true
        },
        sms_media_requirement_content: {
          required: true
        },
        sms_media_remark: {
          required: true
        },
        sms_media_is_creative_avilable: {
          required: true
        },
        sms_media_creative: {
          required: true
        },
        advertisement_sms_medium: {
          required: true
        },
        publicity_target_area: {
          required: true
        },
        publicity_type_material: {
          required: true
        },
        publicity_no_of_copies: {
          required: true
        },
        publicity_content: {
          required: true
        },
        publicity_overall_budget: {
          required: true
        },
        publicity_is_creative_avilable: {
          required: true
        },
        publicity_creative: {
          required: true
        },
        media_name_s: {
          required: true
        },
        submedia_name_s: {
          required: true
        },
        media_name_multi_s: {
          required: true
        },
        print_upload_creative_fileName: {
          required: true
        },
        group_s: {
          required: true
        },
        group_of_city: {
          required: true
        },
        langauge_list: {
          required: true
        },



      },
      messages: {
        Name_of_Officer: {
          required: "Please fill required field!",
          minlength: "Officer name must be at least 3 alphabets!",
          maxlength: "Users can type only max 40 alphabets!"
        },
        langauge_list: {
          required: "Please fill required field!",

        },
        individuals_s: {
          required: "Please fill required field!",

        },
        group_s: {
          required: "Please fill required field!",

        },
        group_of_city: {
          required: "Please fill required field!",

        },


        cityList: {
          required: "Please fill required field!",

        },
        group_of_city: {
          required: "Please fill required field!",

        },
        pageSize: {
          required: "Please fill required field!",

        },
        print_media_planType: {
          required: "Please fill required field!",

        },


        Plan_No: {
          required: "Please fill required field!",

        },

        Designation: {
          required: "Please fill required field!",
          minlength: "Designation must be at least 2 alphabets!",
          maxlength: "Users can type only max 40 alphabets!"
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
        address: {
          required: "Please fill required field!"
        },


        from_date: {
          required: "Please fill required field!"
        },
        to_date: {
          required: "Please fill required field!"
        },
        tentative_budget: {
          required: "Please fill required field!"
        },
        owner_newspaper: {
          required: "Please fill required field!"
        },
        knowncampaign: {
          required: "Please fill required field!"
        },
        un_advertise_length: {
          required: "Please fill required field!"
        },
        un_advertise_breadth: {
          required: "Please fill required field!"
        },
        un_advertise_area: {
          required: "Please fill required field!"
        },
        print_color: {
          required: "Please fill required field!"
        },
        multi_langauge_select: {
          required: "Please fill required field!"
        },

        print_target_area: {
          required: "Please fill required field!"
        },
        print_language: {
          required: "Please fill required field!"
        },
        print_media_plan: {
          required: "Please fill required field!"
        },
        print_page_length: {
          required: "Please fill required field!"
        },
        print_advertisement_display_select: {
          required: "Please fill required field!"
        },
        print_creative: {
          required: "Please fill required field!"
        },
        /*Outdoor Section*/
        outdoor_medium: {
          required: "Please fill required field!"
        },
        outdoor_target_area: {
          required: "Please fill required field!"
        },
        outdoor_media_category: {
          required: "Please fill required field!"
        },
        outdoor_media_sub_category: {
          required: "Please fill required field!"
        },
        outdoor_duration: {
          required: "Please fill required field!"
        },
        outdoor_no_of_spots: {
          required: "Please fill required field!"
        },
        outdoor_creative: {
          required: "Please fill required field!"
        },

        /*AV Media Section*/
        av_tv_target_area: {
          required: "Please fill required field!"
        },
        av_tv_regions: {
          required: "Please fill required field!"
        },
        av_tv_language: {
          required: "Please fill required field!"
        },
        av_tv_secondage: {
          required: "Please fill required field!"
        },
        av_tv_creative: {
          required: "Please fill required field!"
        },
        AV_CRS_target_area: {
          required: "Please fill required field!"
        },
        AV_CRS_language: {
          required: "Please fill required field!"
        },
        AV_CRS_secondage: {
          required: "Please fill required field!"
        },
        AV_SRC_creative: {
          required: "Please fill required field!"
        },
        internet_media_language: {
          required: "Please fill required field!"
        },
        internet_advertise_length: {
          required: "Please fill required field!"
        },
        internet_advertise_breadth: {
          required: "Please fill required field!"
        },
        internet_is_create_available: {
          required: "Please fill required field!"
        },
        internet_creative: {
          required: "Please fill required field!"
        },
        digital_media_duration: {
          required: "Please fill required field!"
        },
        digital_media_band: {
          required: "Please fill required field!"
        },
        digital_target_area: {
          required: "Please fill required field!"
        },
        digital_language: {
          required: "Please fill required field!"
        },
        digital_secondage: {
          required: "Please fill required field!"
        },
        digital_is_creative_available: {
          required: "Please fill required field!"
        },
        digital_creative: {
          required: "Please fill required field!"
        },
        /*sms media*/
        sms_media_target_area: {
          required: "Please fill required field!"
        },
        sms_media_language: {
          required: "Please fill required field!"
        },
        sms_media_content_length_limit: {
          required: "Please fill required field!"
        },
        sms_media_requirement_content: {
          required: "Please fill required field!"
        },
        sms_media_remark: {
          required: "Please fill required field!"
        },
        sms_media_is_creative_avilable: {
          required: "Please fill required field!"
        },
        sms_media_creative: {
          required: "Please fill required field!"
        },
        advertisement_sms_medium: {
          required: "Please fill required field!"
        },
        publicity_target_area: {
          required: "Please fill required field!"
        },
        publicity_type_material: {
          required: "Please fill required field!"
        },
        publicity_no_of_copies: {
          required: "Please fill required field!"
        },
        publicity_content: {
          required: "Please fill required field!"
        },
        publicity_overall_budget: {
          required: "Please fill required field!"
        },
        publicity_is_creative_avilable: {
          required: "Please fill required field!"
        },
        publicity_creative: {
          required: "Please fill required field!"
        },
        media_name_s: {
          required: "Please fill required field!"
        },
        submedia_name_s: {
          required: "Please fill required field!"
        },
        media_name_multi_s: {
          required: "Please fill required field!"
        },
        print_upload_creative_fileName: {
          required: "Please fill required field!"
        },

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

      if ($('#logins-part').is(":visible")) {
        current_fs = $('#logins-part');
        next_fs = $('#logins-part1');

        $("li[data-target='#logins-part']").removeClass("active show");
        $("a[id='logins-part-trigger']").attr('aria-selected', false);
        $("a[id='logins-part-trigger']").attr('disabled', true);
        $("a[id='logins-part1-trigger']").attr('disabled', false);
        $("a[id='logins-part1-trigger']").attr('aria-selected', true);
        $("li[data-target='#logins-part1']").addClass("active show");
        nextSaveData('next_tab_1');
      } else if ($('#logins-part1').is(":visible")) {
        current_fs = $('#logins-part');
        next_fs = $('#logins-part1');

        $("a[id='logins-part1-trigger']").attr('disabled', false);
        $("a[id='logins-part1-trigger']").attr('aria-selected', true);
        $("li[data-target='#logins-part1']").addClass("active show");
        nextSaveData('submit_btn');


      }

      // console.log(current_fs);
      next_fs.show();
      current_fs.hide();
    }
  });
  $('.reg-previous-button').click(function () {
    if ($('#logins-part1').is(":visible")) {
      current_fs = $('#logins-part1');
      next_fs = $('#logins-part');

      $("li[data-target='#logins-part1']").removeClass("active show");
      $("a[id='logins-part1-trigger']").attr('aria-selected', false);
      $("a[id='logins-part1-trigger']").attr('disabled', true);
      $("a[id='logins-part-trigger']").attr('disabled', false);
      $("a[id='logins-part-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part']").addClass("active show");
    } else if ($('#logins-part2').is(":visible")) {
      current_fs = $('#logins-part2');
      next_fs = $('#logins-part1');

      $("li[data-target='#logins-part2']").removeClass("active show");
      $("a[id='logins-part2-trigger']").attr('aria-selected', false);
      $("a[id='logins-part2-trigger']").attr('disabled', true);
      $("a[id='logins-part1-trigger']").attr('disabled', false);
      $("a[id='logins-part1-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part1']").addClass("active show");
    } else if ($('#information-part').is(":visible")) {
      current_fs = $('#information-part');
      next_fs = $('#logins-part2');

      $("li[data-target='#information-part']").removeClass("active show");
      $("a[id='information-part-trigger']").attr('aria-selected', false);
      $("a[id='information-part-trigger']").attr('disabled', true);
      $("a[id='logins-part2-trigger']").attr('disabled', false);
      $("a[id='logins-part2-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part2']").addClass("active show");
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

/*Only Numeric*/
function alphaOnly(event) {
  var inputValue = event.charCode;
  if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
    event.preventDefault();
  }
}
/**/

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
function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31
    && (charCode < 48 || charCode > 57))
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


$(document).ready(function () {
  $('#media_name').multiselect({
    nonSelectedText: 'Select Media Name',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  $('#submedia_name').multiselect({
    nonSelectedText: 'Select Media Name',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });

  $('#randomCityList').multiselect({
    nonSelectedText: 'Select Random City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
    includeSelectAllOption: true,
  });


  //Group of state
  $('#group_s').multiselect({
    nonSelectedText: 'Select Group of State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
    includeSelectAllOption: true,
    //includeSelectAllIfMoreThan: 0,

    /*onDropdownShow: function(event) {
        var positions = jQuery('#group_s').val();
        errorPlacement(jQuery('#group_s'), positions);
    },
    onDropdownHide: function(event) {
        var positions = jQuery('#group_s').val();
        errorPlacement(jQuery('#group_s'), positions);
      }*/
  });



  //End group of state

  //Group of city
  //   $('#group_of_city').multiselect({
  //   nonSelectedText: 'Select Group of city',
  //   enableFiltering: true,
  //   enableCaseInsensitiveFiltering: true,
  //   buttonWidth:'100%',
  //   textleft:true,
  // });
  //End group of city
  //Start multiple langauge
  $('#multi_langauge_select').multiselect({
    nonSelectedText: 'Select Group of language',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
    includeSelectAllOption: true,
  });
  //End multiple langauge
  //Start multiple langauge
  //   $('#langauge_select_hindi_english').multiselect({
  //   nonSelectedText: 'Select  Hindi & English',
  //   enableFiltering: true,
  //   enableCaseInsensitiveFiltering: true,
  //   buttonWidth:'100%',
  //   textleft:true,
  // });
  //End multiple langauge
  //Start multiple plan
  //   $('#multiple_media_plan_select').multiselect({
  //   nonSelectedText: 'Select Multiple plan',
  //   enableFiltering: true,
  //   enableCaseInsensitiveFiltering: true,
  //   buttonWidth:'100%',
  //   textleft:true,
  // });
  //End multiple plans 
  //Start multiple state new media
  $('#new_media_target_state').multiselect({
    nonSelectedText: 'Select Group of State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //End multiple plans
  //Start multiple city new media
  $('#new_media_target_city').multiselect({
    nonSelectedText: 'Select Group of City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //sms media 
  $('#sms_media_target_state').multiselect({
    nonSelectedText: 'Select Group of State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //End multiple plans
  //Start multiple city new media
  $('#sms_media_target_city').multiselect({
    nonSelectedText: 'Select New Media',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });

  //av media
  $('#submedia_av_name').multiselect({
    nonSelectedText: 'Select AV',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //av CRS Group State
  $('#submedia_av_name_CRS').multiselect({
    nonSelectedText: 'Select AV CRS State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //av CRS Group City
  $('#AV_CSR_group_city').multiselect({
    nonSelectedText: 'Select AV CRS City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
  });
  //End multiple 

  $('#show_only_print_details').hide();
  $('#show_only_Outdoor_details').hide();
  $('#show_only_AV_details').hide();
  $('#new_media_digital_cinema').hide();
  $('#print_publicity_details_div').hide();
  $('#sub_new_media').hide();
  $('#single_sub_new_media').hide();
  $('#sms_media_details').hide();
  $('#new_media_digital_cinema').hide();
  $('#sub_av_media').hide();
  $('#single_sub_av_media').hide();
  $('#AV_CRS_and_Radio').hide();
  $('#sub_new_media').hide();
  $('#media_internet_website').hide();
  $('#sms_media_details').hide();
  var media_name_single = $('#media_name_single option:selected').val();


  if (media_name_single == "1") {
    $('#show_only_print_details').show();

  } else {
    $('#show_only_print_details').hide();
  }
  /*  
    $('#media_name_single').change(function(){
  
  var media_name_single =$('#media_name_single option:selected').val();
  
  
      if(media_name_single == "Print"){
        $('#show_only_print_details').show();
      	
      }else{
        $('#show_only_print_details').hide();
      }
      if(media_name_single == "Outdoor"){
        $('#show_only_Outdoor_details').show();
      	
      }else{
        $('#show_only_Outdoor_details').hide();
      }
      if(media_name_single == "Printed Publicity"){
        $('#print_publicity_details_div').show(); 
      	
      }else{
        $('#print_publicity_details_div').hide(); 
      }
  
      if(media_name_single == "AV"){
        $('#sub_av_media').show();
        $('#single_submedia_av_name').change(function(){
          var single_submedia_av_name = $('#single_submedia_av_name').val();
          if(single_submedia_av_name == "AV (TV) Media Plan"){
            $('#show_only_AV_details').show();
          }else{
            $('#show_only_AV_details').hide();
          }
          if(single_submedia_av_name == "AV (CRS and Radio)"){
            $('#AV_CRS_and_Radio').show();
          }else{
            $('#AV_CRS_and_Radio').hide();
          }
        	
        })
  
      }else{
        $('#sub_av_media').hide();
      }
      if(media_name_single == "New Media"){
        $('#single_sub_new_media').show();
        $('#sub_new_media').hide();//Hide multiple sub-media
      	
  
        $('#single_submedia_name').change(function(){
          var single_submedia_name =$('#single_submedia_name').val();
          if(single_submedia_name == "New Media (Digital Cinema)"){
            $('#new_media_digital_cinema').show(); 
  
          }else{
            $('#new_media_digital_cinema').hide(); 
          }
          if(single_submedia_name == "New Media (SMS) Details"){
            $('#sms_media_details').show();
  
          }else{
            $('#sms_media_details').hide();
          }
        if(single_submedia_name == "Internet website"){
            $('#media_internet_website').show();
  
          }else{
            $('#media_internet_website').hide();
          }
        })
      }
      else
      {
        $('#sub_new_media').hide();	//Hide multiple sub-media
        $('#single_sub_new_media').hide();
      }
    })*/

  $('#media_name').change(function () {

    //console.log(media_name);
    var media_name = $('#media_name').val();
    // var media_split = media_name.split(',');

    if (media_name.length > 0) {
      //console.log("Multiple");
      // var find_media = media_name.find(checkMediaName);
      var find_print = media_name.indexOf("Print");
      if (find_print >= 0) {
        //console.log("find");
        $('#show_only_print_details').show();
      }
      else {
        $('#show_only_print_details').hide();
      }

      var find_Outdoor = media_name.indexOf("Outdoor");
      if (find_Outdoor >= 0) {

        $('#show_only_Outdoor_details').show();
      }
      else {
        $('#show_only_Outdoor_details').hide();
      }
      var find_Printed_Publicity = media_name.indexOf("Printed Publicity");
      if (find_Printed_Publicity >= 0) {

        $('#print_publicity_details_div').show();
      }
      else {
        $('#print_publicity_details_div').hide();
      }
      var find_AV = media_name.indexOf("AV");
      if (find_AV >= 0) {
        //alert(2);
        $('#sub_av_media').show();
        $('#submedia_av_name').change(function () {

          var submedia_av_name = $('#submedia_av_name').val();
          //alert(submedia_av_name);
          if (submedia_av_name.length > 0) {
            var find_av_tv = submedia_av_name.indexOf("AV (TV) Media Plan");

            if (find_av_tv >= 0) {
              $('#show_only_AV_details').show();

            } else {
              $('#show_only_AV_details').hide();
            }
            var find_av_CRS = submedia_av_name.indexOf("AV (CRS and Radio)");

            if (find_av_CRS >= 0) {
              $('#AV_CRS_and_Radio').show();

            } else {
              $('#AV_CRS_and_Radio').hide();
            }

          } else {

          }

        })

      }
      else {
        $('#sub_av_media').hide();
      }

      var find_New_Media = media_name.indexOf("New Media");

      if (find_New_Media >= 0) {
        $('#single_sub_new_media').hide(); //Hide single sub media.
        $('#media_name_single').val("")
        $('#single_sub_new_media').val("")

        $('#sub_new_media').show();

        $('#sub_new_media').change(function () {
          var sub_new_media = $('#submedia_name').val();
          //console.log(sub_new_media);
          //alert(sub_new_media);
          if (sub_new_media.length > 0) {

            var find_digital_media = sub_new_media.indexOf("New Media (Digital Cinema)");
            if (find_digital_media >= 0) {
              $('#new_media_digital_cinema').show();
            } else {
              $('#new_media_digital_cinema').hide();
            }
            var find_sms_media = sub_new_media.indexOf("New Media (SMS) Details");
            if (find_sms_media >= 0) {
              $('#sms_media_details').show();
              //$('#new_media_digital_cinema').show();
            } else {
              $('#sms_media_details').hide();
            }
            var find_internet_website_media = sub_new_media.indexOf("Internet website");
            if (find_internet_website_media >= 0) {
              $('#media_internet_website').show();
              //$('#new_media_digital_cinema').show();
            } else {
              $('#media_internet_website').hide();
            }

          } else {

          }
        });
      }
      else {
        //alert("else");
        $('#sub_new_media').hide();
      }


      // If we will select more then one Media name.

    }
    else {
      console.log("Single");
      // If we will select only one Media name.
    }

  })



  //Media select
  $('#media_name_multi').hide();
  $('#media_name_single').hide();
  $("#owner_newspaper1").click(function () {
    var name_multi = $("input[name='owner_newspaper']:checked").val();
    if (name_multi == 'Multiple Media') {
      $('#media_name_single').hide();
      $('#media_name_multi').show();

      $('#media_name_single').val("")
      $('#single_sub_new_media').val("")
      //       	$('#single_sub_new_media').hide(); //Hide single sub media.
      // $('#sub_new_media').show();
    }

  });
  var name_single = $("input[name='Campaign_Type']:checked").val();
  if (name_single == '0') {
    $('#media_name_multi').hide();
    $('#media_name_single').show();

    $('#sub_new_media').val("");
    $('#media_name').val("");

    //     $('#single_sub_new_media').show(); //Hide single sub media.
    // $('#sub_new_media').hide();
  }

  /*$("#owner_newspaper2").click(function(){
          var name_single = $("input[name='owner_newspaper']:checked").val();
          if(name_single == 'Single Media')
          {
            $('#media_name_multi').hide();
            $('#media_name_single').show();
  
            $('#sub_new_media').val("");
            $('#media_name').val("");
  
        //     $('#single_sub_new_media').show(); //Hide single sub media.
          // $('#sub_new_media').hide();
          }
        });*/


  /*Show sub media div according to Media name*/
  /*$("#media_name_single").change(function(){
    var media_name = $('#media_name_single').val();
    alert(media_name);
  
  });
  */

  //end media

  //start known and uknown
  $('#print_details').hide();

  var knowncampaign = $("input[name='knowncampaign']:checked").val();
  if (knowncampaign == '1') {
    $('#print_details').show();
  }



  var knowncampaign = $("input[name='knowncampaign']:checked").val();
  if (knowncampaign == '0') {
    $('#print_details').hide();
  }


  $("#radioKnown1").click(function () {
    var knowncampaign = $("input[name='knowncampaign']:checked").val();
    if (knowncampaign == '1') {
      $('#print_details').show();
    }

  });
  $("#radioKnown2").click(function () {
    var knowncampaign = $("input[name='knowncampaign']:checked").val();
    if (knowncampaign == '0') {
      $('#print_details').hide();
    }

  });

  $('#printLength').hide();
  $('#printBread').hide();
  $('#printArea').hide();
  var pageSize = $('#pageSize option:selected').val();
  if (pageSize == "0") {
    $('#un_advertise_length').val();
    $('#un_advertise_breadth').val();
    $('#un_advertise_area').val();
    $('#un_advertise_length').prop("readonly", false);
    $('#un_advertise_breadth').prop("readonly", false);
    $('#un_advertise_area').prop("readonly", true);
    $("#un_advertise_length,#un_advertise_breadth").keyup(function () {

      $('#un_advertise_area').val($('#un_advertise_length').val() * $('#un_advertise_breadth').val());

    });
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show();
  } else if (pageSize == "1") {  //hph

    $('#un_advertise_length').val("25");
    $('#un_advertise_breadth').val("33");
    $('#un_advertise_area').val(25 * 33);
    $('#un_advertise_length').prop("readonly", true);
    $('#un_advertise_breadth').prop("readonly", true);
    $('#un_advertise_area').prop("readonly", true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show();
  } else if (pageSize == "2") {//fp
    $('#un_advertise_length').val("0");
    $('#un_advertise_breadth').val("0");
    $('#un_advertise_area').val("0");
    $('#un_advertise_length').prop("readonly", true);
    $('#un_advertise_breadth').prop("readonly", true);
    $('#un_advertise_area').prop("readonly", true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show();
  } else if (pageSize == "3") {  //hpv

    $('#un_advertise_length').val("52");
    $('#un_advertise_breadth').val("16");
    $('#un_advertise_area').val(52 * 16);
    $('#un_advertise_length').prop("readonly", true);
    $('#un_advertise_breadth').prop("readonly", true);
    $('#un_advertise_area').prop("readonly", true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show();
  } else if (pageSize == "4") {  //Qp

    $('#un_advertise_length').val("25");
    $('#un_advertise_breadth').val("16");
    $('#un_advertise_area').val(25 * 16);
    $('#un_advertise_length').prop("readonly", true);
    $('#un_advertise_breadth').prop("readonly", true);
    $('#un_advertise_area').prop("readonly", true);
    $('#printLength').show();
    $('#printBread').show();
    $('#printArea').show();
  }

  $('#pageSize').change(function () {
    var pageSize = $('#pageSize option:selected').val();
    if (pageSize == "0") {

      $('#un_advertise_length').val('');
      $('#un_advertise_breadth').val("");
      $('#un_advertise_area').val('');
      $('#un_advertise_length').prop("readonly", false);
      $('#un_advertise_breadth').prop("readonly", false);
      $('#un_advertise_area').prop("readonly", true);
      $("#un_advertise_length,#un_advertise_breadth").keyup(function () {

        $('#un_advertise_area').val($('#un_advertise_length').val() * $('#un_advertise_breadth').val());

      });

      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show();
    } else if (pageSize == "1") {  //hph

      $('#un_advertise_length').val("25");
      $('#un_advertise_breadth').val("33");
      $('#un_advertise_area').val(25 * 33);
      $('#un_advertise_length').prop("readonly", true);
      $('#un_advertise_breadth').prop("readonly", true);
      $('#un_advertise_area').prop("readonly", true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show();
    } else if (pageSize == "2") {//fp
      $('#un_advertise_length').val("0");
      $('#un_advertise_breadth').val("0");
      $('#un_advertise_area').val("0");
      $('#un_advertise_length').prop("readonly", true);
      $('#un_advertise_breadth').prop("readonly", true);
      $('#un_advertise_area').prop("readonly", true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show();
    } else if (pageSize == "3") {  //hpv

      $('#un_advertise_length').val("52");
      $('#un_advertise_breadth').val("16");
      $('#un_advertise_area').val(52 * 16);
      $('#un_advertise_length').prop("readonly", true);
      $('#un_advertise_breadth').prop("readonly", true);
      $('#un_advertise_area').prop("readonly", true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show();
    } else if (pageSize == "4") {  //Qp

      $('#un_advertise_length').val("25");
      $('#un_advertise_breadth').val("16");
      $('#un_advertise_area').val(25 * 16);
      $('#un_advertise_length').prop("readonly", true);
      $('#un_advertise_breadth').prop("readonly", true);
      $('#un_advertise_area').prop("readonly", true);
      $('#printLength').show();
      $('#printBread').show();
      $('#printArea').show();
    } else if (pageSize == "") {
      $('#printLength').hide();
      $('#printBread').hide();
      $('#printArea').hide();
    }

  });

  $('#individuals_state').hide();
  $('#group_state').hide();
  $('#group_city').hide();
  $('#randomCity').hide();

  var target_area = $('#target_area option:selected').val();
  if (target_area == "1") {
    $('#group_state').hide();
    $('#group_city').hide();
    $('#randomCity').hide();
    $('#individuals_state').show();
    $('.city_with_state_div').show();
    $('#getCity').show();
    $('#cityList').val('');

  } else if (target_area == "2") {
    $('#individuals_state').hide();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $('#group_city').hide();
    $('#group_state').show();
    $('#cityList').val('');
    $('#individuals_s').val('')
  } else if (target_area == "3") {
    $('#individuals_state').hide();
    $('#group_state').hide();
    $('#group_city').show();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $('#cityList').val('');
    $('#individuals_s').val('')
  }
  else if (target_area == "0") {
    $('#individuals_state').hide();
    $('#group_state').hide();
    $('#group_city').hide();
    $('.city_with_state_div').hide();
    $('#getCity').hide();
    $('#randomCity').hide();
    $('#cityList').val('');
    $('#individuals_s').val('')
  }
  $('#target_area').change(function () {
    var target_area = $('#target_area option:selected').val();
    if (target_area == "1") {
      $('#individuals_s').val('');
      $('#group_state').hide();
      $('#group_city').hide();
      $('#randomCity').hide();
      $('#individuals_state').show();
      $('#city_with_state').prop("checked", false);
      $('.city_with_state_div').show();
      $('#city_with_state').show();
      $('#cityList').val('');




    } else if (target_area == "2") {
      $("#group_s").multiselect("clearSelection");
      $("#group_s").multiselect('refresh');
      $('#individuals_state').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#group_city').hide();
      $('#group_state').show();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('')

    } else if (target_area == "3") {

      $("#group_of_city").val('');
      $('#individuals_state').hide();
      $('#group_state').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#group_city').show();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('')
    }
    else if (target_area == "0") {
      $('#individuals_state').hide();
      $('#group_state').hide();
      $('#group_city').hide();
      $('.city_with_state_div').hide();
      $('#getCity').hide();
      $('#randomCity').hide();
      $('#cityList').val('');
      $('#individuals_s').val('');
    }

  });

  //select  State with city check box
  $('#city_with_state').hide();
  $('.city_with_state_div').hide();
  $('#getCity').hide();
  $('#cityList').val('');
  $('#city_with_state').change(function () {
    if ($('#city_with_state').is(":checked")) {
      $('#cityList').val('');
      $('#getCity').show();
    }
    else {
      $('#cityList').val('');
      $('#getCity').hide();
    }
  });

  //select  Group city check box

  var group_of_city = $('#group_of_city option:selected').val();

  if ($('#group_of_city').val() == "5") {
    //$('.city_with_state_div').show();
    $('#randomCity').show();
  }
  else {
    $('#randomCity').hide();
  }
  $('#group_of_city').change(function () {
    var group_of_city = $('#group_of_city option:selected').val();

    if ($('#group_of_city').val() == "5") {
      $("#randomCityList").multiselect("clearSelection");
      $("#randomCityList").multiselect('refresh');
      $('#randomCity').show();
    }
    else {
      $('#randomCity').hide();
    }
  });


  //Select Multiple language
  $('#single_langauge_select_div').hide();
  $('#multi_langauge_select_div').hide();
  $('#selecte_hindi_english').hide();

  var language_sm = $('#language_sm option:selected').val();

  if (language_sm == "0") {
    $('#multi_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
    $('#single_langauge_select_div').show();

  }
  else if (language_sm == "1") {
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
    $('#multi_langauge_select_div').show();

  }
  else if (language_sm == "2") {
    $('#multi_langauge_select_div').hide();
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').show();
  }
  else if (language_sm == "3") {
    $('#multi_langauge_select_div').hide();
    $('#single_langauge_select_div').hide();
    $('#selecte_hindi_english').hide();
  }



  $('#language_sm').change(function () {
    var language_sm = $('#language_sm option:selected').val();
    if (language_sm == "") {
      $('#single_langauge_select_div').hide();
      $('#multi_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();

    }

    else if (language_sm == "0") {
      $('#single_langauge_select').val('');

      $('#multi_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
      $('#single_langauge_select_div').show();

    }

    else if (language_sm == "1") {
      $("#multi_langauge_select").multiselect("clearSelection");
      $("#multi_langauge_select").multiselect('refresh');
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
      $('#multi_langauge_select_div').show();

    }


    else if (language_sm == "2") {

      $('#multi_langauge_select_div').hide();
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').show();
    }

    else if (language_sm == "3") {
      $('#multi_langauge_select_div').hide();
      $('#single_langauge_select_div').hide();
      $('#selecte_hindi_english').hide();
    }

  })
  /* writen by priyanshi */
  $('#heighLightDiv').hide();
  var multiple_media_plan_select = $('#multiple_media_plan_select option:selected').val();

  if (multiple_media_plan_select == "0") {
    $('#heighLightDiv').show();
  }
  else if (multiple_media_plan_select == "1" || multiple_media_plan_select == "2") {
    $('#heighLightDiv').hide();
  }
  $('#multiple_media_plan_select').change(function () {
    var multiple_media_plan_select = $('#multiple_media_plan_select option:selected').val();
    if (multiple_media_plan_select == "") {
      $('#heighLightDiv').hide();
    }
    else if (multiple_media_plan_select == "0") {
      $('#heighLightDiv').show();
    }
    else if (multiple_media_plan_select == "1" || multiple_media_plan_select == "2") {
      $('#heighLightDiv').hide();
    }
  })
  /* end priyanshi code */



  //End Multiple language
  //Start media plan
  $('#multiple_media_plan').hide();
  var media_plan = $('#media_plan option:selected').val();
  if (media_plan == "0") {
    $('#multiple_media_plan').hide();
  } else if (media_plan == "1") {
    $('#multiple_media_plan').show();
  }
  $('#media_plan').change(function () {
    var media_plan = $('#media_plan option:selected').val();
    if (media_plan == "") {
      $('#multiple_media_plan').hide();
    }
    else if (media_plan == "0") {
      $('#multiple_media_plan').hide();
    } else if (media_plan == "1") {
      $('#multiple_media_plan').show();
    }
  })
  //end media plan

  //Start is creative  for print
  $('#upload_creative').hide();
  var is_create_available = $('#is_create_available option:selected').val();
  if (is_create_available == "") {
    $('#upload_creative').hide();
  }
  else if (is_create_available == "0") {
    $('#upload_creative').show();
  }

  else if (is_create_available == "2" || is_create_available == "3" || is_create_available == "1") {
    $('#upload_creative').hide();
  }
  $('#is_create_available').change(function () {
    var is_create_available = $('#is_create_available option:selected').val();
    if (is_create_available == "") {
      $('#upload_creative').hide();
    }
    else if (is_create_available == "0") {
      $('#upload_creative').show();
    }
    else if (is_create_available == "3" || is_create_available == "1") {
      $('#upload_creative').hide();
    }
    else if (is_create_available == "2") {
      $('#upload_creative').hide();

    }
  })
  //Start is Creative for Outdoor 
  $('#outdoor_upload_creative').hide();
  $('#outdoor_is_create_available').change(function () {
    var outdoor_is_create_available = $('#outdoor_is_create_available option:selected').val();
    if (outdoor_is_create_available == "Yes") {
      $('#outdoor_upload_creative').show();
    } else if (outdoor_is_create_available == "no") {
      $('#outdoor_upload_creative').hide();
    }
  })

  //Start is Creative for AV
  $('#AV_upload_creative').hide();
  $('#AV_is_create_available').change(function () {

    var AV_is_create_available = $('#AV_is_create_available option:selected').val();
    if (AV_is_create_available == "Yes") {
      $('#AV_upload_creative').show()
    } else if (AV_is_create_available == "no") {
      $('#AV_upload_creative').hide()
    }

  })
  //Start is Creative for AV
  $('#new_media_upload_creative').hide();
  $('#new_media_is_create_available').change(function () {

    var new_media_is_create_available = $('#new_media_is_create_available option:selected').val();
    if (new_media_is_create_available == "Yes") {
      $('#new_media_upload_creative').show()
    } else if (new_media_is_create_available == "no") {
      $('#new_media_upload_creative').hide()
    }

  })
  //Print Publicity 
  $('#print_publicity_details_upload_creative').hide();
  $('#print_publicity_details_is_create_available').change(function () {

    var new_media_is_create_available = $('#print_publicity_details_is_create_available option:selected').val();
    if (new_media_is_create_available == "Yes") {
      $('#print_publicity_details_upload_creative').show()
    } else if (new_media_is_create_available == "no") {
      $('#print_publicity_details_upload_creative').hide()
    }

  })

  $('#sms_media_upload_creative').hide();
  $('#sms_media_is_create_available').change(function () {

    var sms_media_is_create_available = $('#sms_media_is_create_available option:selected').val();
    if (sms_media_is_create_available == "Yes") {
      $('#sms_media_upload_creative').show()
    } else if (sms_media_is_create_available == "no") {
      $('#sms_media_upload_creative').hide()
    }

  })
  //internet webside media
  $('#media_internet_website_upload_creative').hide();
  $('#internet_website_is_create_available').change(function () {

    var internet_website_is_create_available = $('#internet_website_is_create_available option:selected').val();
    if (internet_website_is_create_available == "Yes") {
      $('#media_internet_website_upload_creative').show()
    } else if (internet_website_is_create_available == "no") {
      $('#media_internet_website_upload_creative').hide()
    }

  })
  //AV SRC Radio
  $('#AV_SRC_upload_creative').hide();
  $('#AV_SRC_is_create_available').change(function () {

    var AV_SRC_is_create_available = $('#AV_SRC_is_create_available option:selected').val();
    if (AV_SRC_is_create_available == "Yes") {
      $('#AV_SRC_upload_creative').show()
    } else if (AV_SRC_is_create_available == "no") {
      $('#AV_SRC_upload_creative').hide()
    }

  })
  //end id creative

  //AV Target Area 
  $('#group_av').hide();
  $('#specific_av').hide();
  $('#av_target_area').change(function () {
    var av_target_area = $('#av_target_area option:selected').val();
    if (av_target_area == "Specific Region") {
      $('#group_av').hide();
      $('#specific_av').show();
    }
    else if (av_target_area == "Group of State") {
      $('#specific_av').hide();
      $('#group_av').show();
    }

  })

  //new media digital media
  $('#new_media_specific_state').hide();
  $('#new_media_specific_city').hide();
  $('#new_media_group_state').hide();
  $('#new_media_group_city').hide();
  $('#new_degial_target_area').change(function () {
    var new_degial_target_area = $('#new_degial_target_area option:selected').val();
    if (new_degial_target_area == "Specific State") {
      $('#new_media_specific_city').hide();
      $('#new_media_group_state').hide();
      $('#new_media_group_city').hide();
      $('#new_media_specific_state').show();
    } else if (new_degial_target_area == "Specific City") {

      $('#new_media_group_state').hide();
      $('#new_media_group_city').hide();
      $('#new_media_specific_state').hide();
      $('#new_media_specific_city').show();
    } else if (new_degial_target_area == "Group of State") {
      $('#new_media_group_city').hide();
      $('#new_media_specific_state').hide();
      $('#new_media_specific_city').hide();
      $('#new_media_group_state').show();
    } else if (new_degial_target_area == "Group of City") {
      $('#new_media_specific_state').hide();
      $('#new_media_specific_city').hide();
      $('#new_media_group_state').hide();
      $('#new_media_group_city').show();
    }
  })

  //in new media Sms media 
  $('#sms_specific_state').hide();
  $('#sms_specific_city').hide();
  $('#sms_group_state').hide();
  $('#sms_group_city').hide();
  $('#new_degial_SMS').change(function () {
    var new_degial_SMS = $('#new_degial_SMS option:selected').val();
    if (new_degial_SMS == "Specific State") {
      $('#sms_specific_city').hide();
      $('#sms_group_state').hide();
      $('#sms_group_city').hide();
      $('#sms_specific_state').show();
    } else if (new_degial_SMS == "Specific City") {

      $('#sms_group_state').hide();
      $('#sms_group_city').hide();
      $('#sms_specific_state').hide();
      $('#sms_specific_city').show();
    } else if (new_degial_SMS == "Group of State") {
      $('#sms_group_city').hide();
      $('#sms_specific_state').hide();
      $('#sms_specific_city').hide();
      $('#sms_group_state').show();
    } else if (new_degial_SMS == "Group of City") {
      $('#sms_specific_state').hide();
      $('#sms_specific_city').hide();
      $('#sms_group_state').hide();
      $('#sms_group_city').show();
    }
  })

  //AV CRS Radia
  $('#av_crs_single_state').hide();
  $('#AVCSR_pecific_city').hide();
  $('#av_crs_multiple_state').hide();
  $('#AVCSR_group_city').hide();
  $('#AV_CRS_target_area').change(function () {
    var new_degial_SMS = $('#AV_CRS_target_area option:selected').val();
    if (new_degial_SMS == "Specific State") {
      $('#av_crs_single_state').show();
    } else {
      $('#av_crs_single_state').hide();
    }
    if (new_degial_SMS == "Group of State") {

      $('#av_crs_multiple_state').show();
    } else {
      $('#av_crs_multiple_state').hide();
    }
    if (new_degial_SMS == "Specific City") {
      $('#AVCSR_pecific_city').show();
    } else {
      $('#AVCSR_pecific_city').hide();
    }
    if (new_degial_SMS == "Group of City") {

      $('#AVCSR_group_city').show();
    } else {
      $('#AVCSR_group_city').hide();
    }
  })




});