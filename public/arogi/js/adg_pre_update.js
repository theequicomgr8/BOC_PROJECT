
$(document).ready(function(){
    $(".client-next-button").click(function(){
      jQuery.validator.addMethod("chk", function(value, element) {
        // return this.optional(element) || /^[a-z]+$/i.test(value);
        var demography=$("#ddl_area_nature").val();
        console.log(demography);
        if(demography.length==0)
        {
          $("#ddl_area_nature_err_").show();
          $("#ddl_area_nature_err_").html('Error');
          return false;
        }
      }, "Letters only please");

      $("#ddl_area_nature"). attr("required", "true");
      var form = $("#rob_request");        
      form.validate({
        rules: {   
          programme_activity: {
            required:true,
          },
          sop_theme:{
            required:true,
          },
          email:{
            required:true,
            emailExt: true
          },
          coverage:{
            required:true,
          },
          village_name:{
            required:true,
          },
          office_type:{
            required:true,
          },
          region_id:{
            required:true,
          },
          demography:{
            required :true,
          },
          activity_area:{
            required:true,
          },
          duration_activity_from_date:{
            required:true,
          },
          duration_activity_to_date:{
            required:true,
          },
          approx_size_of_audience:{
            required:true,
          },
          allocated_funds:{
            required:true,
          },
          officer_name:{
            required:true,
          },
          officer_designation:{
            required:true,
          },
          office_location:{
            required:true,
          },
          advance_account:{
            required:true,
          },
          sattlement_account_advance:{
            required:true,
          },
          direct_settlement_bill_pao:{
            required:true,
          },
          'activity_checkbox1[]':{
            required:true
          },
          block:{
            required:true,
          },
          district:{
            required:true,
          },
          distance_covered:{
            required:true,
          },
          'demography[]':{
            required:true,
            chk : true,
          },
          'activity_area[]':{
            required:true
          },
      },
      messages: {      
        programme_activity: {
          required:"Please fill required field!"
        },
        sop_theme: {
          required:"Please fill required field!"
        },
        email: {
          required:"Please fill required field!",
          email: "Please enter a valid email address!"
        },
        coverage: {
          required:"Please fill required field!"
        },
        village_name: {
          required:"Please fill required field!"
        },
        office_type: {
          required:"Please fill required field!"
        },
        region_id: {
          required:"Please fill required field!"
        },
        demography: {
          required:"Please fill required field!"
        },
        activity_area: {
          required:"Please fill required field!"
        },
        duration_activity_from_date:{
          required:"Please fill required field!"
        },
        duration_activity_to_date:{
          required:"Please fill required field!"
        },
        approx_size_of_audience:{
          required:"Please fill required field!"
        },
        allocated_funds:{
          required:"Please fill required field!"
        },
        officer_name:{
          required:"Please fill required field!"
        },
        officer_designation:{
          required:"Please fill required field!"
        },
        office_location:{
          required:"Please fill required field!"
        },
        advance_account:{
          required:"Please fill required field!"
        },
        sattlement_account_advance:{
          required:"Please fill required field!"
        },
        direct_settlement_bill_pao:{
          required:"Please fill required field!"
        },
        'activity_checkbox1[]':{
          required:'Please select atleast one Activity'
        },
        block:{
          required:"Please fill required field!",
        },
        district:{
          required:"Please fill required field!",
        },
        distance_covered:{
          required:"Please fill required field!",
        },
        'demography[]':{
          required:'Please select atleast one Activity',
        },
        'activity_area[]':{
          required:'Please select atleast one Activity',
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

      // function tab123()
      // {
      //       var data =new FormData($("#rob_request")[0]);
      //       $.ajax({
      //           url : "/rob_insert",
      //           type: 'POST',
      //            // headers: {
      //           //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      //           // },
      //            data : data,
      //            contentType: false,
      //            cache : false,
      //            processData:false,
      //           success:function(data)
      //           {
      //               console.log(data);
      //           }
      //       });
      // }

      function pre_submit()
      {
        var data =new FormData($("#rob_request")[0]);
        $.ajax({
            url : "/rob-fob-pre-update",
            type: 'POST',
                // headers: {
            //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
            // },
                data : data,
                contentType: false,
                cache : false,
                processData:false,
            success:function(data)
            {
                console.log('Data Saved');
                // setTimeout(function(){ 
                //     window.location.href='/pre-active-form';
                // }, 5000);
                swal("Success","Data has been update successfully","success").then(function () {
                    window.location.href = '/rob-adg-list';
                    });
            }
        });
      }

  if (form.valid() === true){
  
    if ($('#logins-part').is(":visible"))
    {
      current_fs = $('#logins-part');
      pre_submit();
      next_fs = $('#logins-part');
  
      // $("li[data-target='#logins-part']").removeClass("active show");
      // $("a[id='logins-part-trigger']").attr('aria-selected', false);
      // $("a[id='logins-part-trigger']").attr('disabled', true);
      // $("a[id='logins-part1-trigger']").attr('disabled', false);
      // $("a[id='logins-part1-trigger']").attr('aria-selected', true);
      // $("li[data-target='#logins-part1']").addClass("active show");
      //nextSaveData('next_tab_1');
    }
    

    
    // else if($('#logins-part3').is(":visible"))
    // {
    //   current_fs = $('#logins-part3');
    //   next_fs = $('#logins-part3');
  
    //   $("a[id='logins-part3-trigger']").attr('disabled', false);
    //   $("a[id='logins-part3-trigger']").attr('aria-selected', true);
    //   $("li[data-target='#logins-part3']").addClass("active show");
    //       nextSaveData('submit_btn');
    // }

        
        
        // console.log(current_fs);
        next_fs.show(); 
        current_fs.show();
      }
    });
  $('.reg-previous-button').click(function(){
    if ($('#logins-part1').is(":visible")){
      current_fs = $('#logins-part1');
      next_fs = $('#logins-part');
  
      $("li[data-target='#logins-part1']").removeClass("active show");
      $("a[id='logins-part1-trigger']").attr('aria-selected', false);
      $("a[id='logins-part1-trigger']").attr('disabled', true);
      $("a[id='logins-part-trigger']").attr('disabled', false);
      $("a[id='logins-part-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part']").addClass("active show");
    }else if($('#logins-part2').is(":visible")){
      current_fs = $('#logins-part2');
      next_fs = $('#logins-part1');
  
      $("li[data-target='#logins-part2']").removeClass("active show");
      $("a[id='logins-part2-trigger']").attr('aria-selected', false);
      $("a[id='logins-part2-trigger']").attr('disabled', true);
      $("a[id='logins-part1-trigger']").attr('disabled', false);
      $("a[id='logins-part1-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part1']").addClass("active show");
    }
    else if($('#logins-part3').is(":visible")){
      current_fs = $('#logins-part3');
      next_fs = $('#logins-part2');
  
      $("li[data-target='#logins-part3']").removeClass("active show");
      $("a[id='logins-part3-trigger']").attr('aria-selected', false);
      $("a[id='logins-part3-trigger']").attr('disabled', true);
      $("a[id='logins-part2-trigger']").attr('disabled', false);
      $("a[id='logins-part2-trigger']").attr('aria-selected', true);
      $("li[data-target='#logins-part2']").addClass("active show");
    }
    // else if($('#information-part').is(":visible")){
    //   current_fs = $('#information-part');
    //   next_fs = $('#logins-part2');
  
    //   $("li[data-target='#information-part']").removeClass("active show");        
    //   $("a[id='information-part-trigger']").attr('aria-selected', false);
    //   $("a[id='information-part-trigger']").attr('disabled', true);
    //   $("a[id='logins-part2-trigger']").attr('disabled', false);
    //   $("a[id='logins-part2-trigger']").attr('aria-selected', true);
    //   $("li[data-target='#logins-part2']").addClass("active show");
    // }
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
  
  /*Only Numeric*/
  function alphaOnly(event) {
    var inputValue = event.charCode;
    if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
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
  function isNumberKey(evt)
  {
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
  
  $(document).ready(function(){
    $("#tab_33").click(function(){
      // $("#logins-part2").hide();
      var form2 = $("#rob_request");
      if (form2.valid() == false)
      {
        if($('#logins-part2').is(":visible"))
        {
          current_fs = $('#logins-part2');
          next_fs = $('#logins-part3');
          $("li[data-target='#logins-part2']").removeClass("active show");
          $("a[id='logins-part2-trigger']").attr('disabled', false);
          $("a[id='logins-part2-trigger']").attr('aria-selected', true);
          $("li[data-target='#logins-part3']").addClass("active show");
              //nextSaveData('next_tab_3');
        }
        next_fs.show(); 
        current_fs.hide();
      }
    });
  });
 