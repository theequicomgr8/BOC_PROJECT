
$(document).ready(function () {
  $(".client-next-button").click(function () {
    var form = $("#client_request");
    var validator = form.validate({
      rules: {
        /*  Basicinfo tab validation Rules*/
        //Name_of_Officer: { required: true, minlength: 3, maxlength: 40 },
        //Designation: { required: true, minlength: 2, maxlength: 40 },
        //email: { required: true, emailExt: true, maxlength: 40 },
        //mobile: { required: true, minlength: 10, maxlength: 10, number: true },
        //address: { required: true },
        from_date: { required: true },
        to_date: { required: true },
        tentative_budget: { required: true },
        'media_name_s[]': { required: true },
        Campaign_Type: { required: true },
        /*  Print media tab validation Rules*/
        //knowncampaign:{required:true},
        newspaper_type: { required: true },
        Plan_No: { required: true, maxlength: 20 },
        print_media_planType: { required: true },
        multi_langauge_select: { required: true },
        individuals_s: { required: true },
        group_of_city: { required: true },
        cityList: { required: true },
        pageSize: { required: true },
        un_advertise_length: { required: true },
        un_advertise_breadth: { required: true },
        un_advertise_area: { required: true },
        print_color: { required: true },
        print_target_area: { required: true },
        print_language: { required: true },
        print_media_plan: { required: true },
        print_advertisement_display_select: { required: true },
        print_creative: { required: true },
        print_upload_creative_fileName: { required: true },
        group_s: { required: true },
        group_of_city: { required: true },
        langauge_list: { required: true },
        /*Outdoor media tab validation Rules*/
        OutdoorMedium: { required: true },
        outdoorLanguage: { required: true },
        "outdoorTArea[]": { required: true },
        "outdoorAdvLength[]": { required: true },
        "outdoorAdvBreadth[]": { required: true },
        "outdoorAdvArea[]": { required: true },
        "outdoorIndividualState[]": { required: true },
        //outdoorCityWithState :{ required:true },
        "outdoorCityList[]": { required: true },
        "outdoorTown[]": { required: true },
        "outdoorZone[]": { required: true },
        "outdoorPostalCode[]": { required: true },
        "outdoorDistrict[]": { required: true },
        "outdoorGroupState[]": { required: true },
        "outdoorGroupCity[]": { required: true },
        "outdoorRandomCityList[]": { required: true },
        "outdoorMediaCategory[]": { required: true },
        //"outdoorMediaSubCategory[]": { required: true },
        outdoortentative_budget: { required: true },
        "outdoorSpotsno[]": { required: true },
        outdoorCreativeAvail: { required: true },
        outdoorCreativeFileName: { required: true },
        outdoorfrom_date: { required: true },
        outdoorto_date: { required: true },
        
        /*  TV validation start*/
        tvTargetArea: { required: true },
        tvRegion: { required: true },
        tvSpotsNo: { required: true },
        tvDuration: { required: true },
        tvCreativeAvail: { required: true },
        tvCreativeFileName: { required: true },
        tvfrom_date: { required: true },
        tvto_date: { required: true },
        tvTentative_budget: { required: true },
        tvGener: { required: true },
        
        /* End tv Validation*/
        /*  crs Radio validation start*/
        crsRadioMedium: { required: true },
        crsRadioTargetArea: { required: true },
        crsRadioRegion: { required: true },
        crsRadioSpotsNo: { required: true },
        crsRadioDuration: { required: true },
        crsRadioCreativeAvail: { required: true },
        crsRadioCreativeFileName: { required: true },
        crsRadiofrom_date: { required: true},
        crsRadioto_date: { required: true },
        crsTentative_budget: { required: true },
        

        /* End crs Radio Validation*/

      },
      messages: {
        /*  Basicinfo tab validation Mesage*/
        //Name_of_Officer: { required: "Please fill required field!", minlength: "Officer name must be at least 3 alphabets!", maxlength: "Users can type only max 40 alphabets!" },
        //Designation: { required: "Please fill required field!", minlength: "Designation must be at least 2 alphabets!", maxlength: "Users can type only max 40 alphabets!" },
        //email: { required: "Please fill required field!", email: "Please enter a vaild email address!" },
        //mobile: { required: "Please fill required field!", maxlength: "Mobile length should be max and min 10 digit!", number: "Users can enter only integer numbers!" },
        //address: { required: "Please fill required field!" },
        from_date: { required: "Please fill required field!" },
        to_date: { required: "Please fill required field!" },
        tentative_budget: { required: "Please fill required field!" },
        'media_name_s[]': { required: "Please fill required field!" },
        Campaign_Type: { required: "Please fill required field!" },
        newspaper_type: { required: "Please fill required field!" },
        /*Print media tab validation Message*/
        langauge_list: { required: "Please fill required field!", },
        individuals_s: { required: "Please fill required field!", },
        group_s: { required: "Please fill required field!" },
        group_of_city: { required: "Please fill required field!", },
        cityList: { required: "Please fill required field!", },
        group_of_city: { required: "Please fill required field!", },
        pageSize: { required: "Please fill required field!", },
        print_media_planType: { required: "Please fill required field!", },
        Plan_No: { required: "Please fill required field!", },
        un_advertise_length: { required: "Please fill required field!" },
        un_advertise_breadth: { required: "Please fill required field!" },
        un_advertise_area: { required: "Please fill required field!" },
        print_color: { required: "Please fill required field!" },
        multi_langauge_select: { required: "Please fill required field!" },
        print_target_area: { required: "Please fill required field!" },
        print_language: { required: "Please fill required field!" },
        print_media_plan: { required: "Please fill required field!" },
        print_advertisement_display_select: { required: "Please fill required field!" },
        print_creative: { required: "Please fill required field!" },
        print_upload_creative_fileName: { required: "Please fill required field!" },
        /*Outdoor media tab validation message*/
        OutdoorMedium: { required: "Please fill required field!" },
        outdoorLanguage: { required: "Please fill required field!" },
        outdoortentative_budget: { required: "Please fill required field!" },

        'outdoorTArea[]': { required: "Please fill required field!" },
        'outdoorAdvLength[]': { required: "Please fill required field!" },
        'outdoorAdvBreadth[]': { required: "Please fill required field!" },
        'outdoorAdvArea[]': { required: "Please fill required field!" },
        'outdoorIndividualState[]': { required: "Please fill required field!" },
        'outdoorCityWithState[]': { required: "Please fill required field!" },
        'outdoorCityList[]': { required: "Please fill required field!" },
        'outdoorTown[]': { required: "Please fill required field!" },
        'outdoorZone[]': { required: "Please fill required field!" },
        'outdoorPostalCode[]': { required: "Please fill required field!" },
        'outdoorDistrict[]': { required: "Please fill required field!" },
        'outdoorGroupState[]': { required: "Please fill required field!" },
        'outdoorGroupCity[]': { required: "Please fill required field!" },
        'outdoorRandomCityList[]': { required: "Please fill required field!" },
        'outdoorMediaCategory[]': { required: "Please fill required field!" },
        //'outdoorMediaSubCategory[]': { required: "Please fill required field!" },
        //'outdoorDuration :{ required:"Please fill required field!" }, 
        'outdoorSpotsno[]': { required: "Please fill required field!" },
        outdoorCreativeAvail: { required: "Please fill required field!" },
        outdoorCreativeFileName: { required: "Please fill required field!" },
        outdoorfrom_date: { required: 'Please fill required field!'},
        outdoorto_date: { required: "Please fill required field!" },
        /*  TV validation start*/
        tvTargetArea: { required: "Please fill required field!" },
        tvRegion: { required: "Please fill required field!" },
        tvSpotsNo: { required: "Please fill required field!" },
        tvDuration: { required: "Please fill required field!" },
        tvCreativeAvail: { required: "Please fill required field!" },
        tvCreativeFileName: { required: "Please fill required field!" },
        tvfrom_date: { required: 'Please fill required field!'},
        tvto_date: { required: "Please fill required field!" },
        tvTentative_budget: { required: "Please fill required field!" },
        tvGener: { required: "Please fill required field!" },
        
        
        /* End tv Validation*/
        /*  crs Radio validation start*/
        crsRadioMedium: { required: "Please fill required field!" },
        crsRadioTargetArea: { required: "Please fill required field!" },
        crsRadioRegion: { required: "Please fill required field!" },
        crsRadioSpotsNo: { required: "Please fill required field!" },
        crsRadioDuration: { required: "Please fill required field!" },
        crsRadioCreativeAvail: { required: "Please fill required field!" },
        crsRadioCreativeFileName: { required: "Please fill required field!" },
        crsRadiofrom_date: { required: 'Please fill required field!'},
        crsRadioto_date: { required: "Please fill required field!" },
        crsTentative_budget: { required: "Please fill required field!" },
        
        

        /* End crs Radio Validation*/

      },
      //debug: true,
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
      },
      //ignore:[] 
    });
    if (form.valid() === true) {
      let getAllRemoveMe = $('.tab-nav-item');
      if (getAllRemoveMe.length > 0) {
        for (let i = 0; i < getAllRemoveMe.length; i++) {
          if (i > 0) {
            getAllRemoveMe[i].remove();
          }
        }
      }

      $('select[name="media_name_s[]"] option:selected').each(function (index, element) {
        if (element.value != '') {
          var ind = index + 1;
          var getTabName = '<li class="tab-nav-item"  id ="' + element.text + '"><a class="nav-link mediatab" id="#' + element.text + '-tab" data-toggle="tab"  role="tab" aria-controls="' + element.text + '" aria-selected="false">' + element.text + '</a></li>';
          $('#myTab').append(getTabName);
        }

      });
      // next tab
      var i, items = $('.nav-link.mediatab'), pane = $('mcontenttab');

      for (i = 0; i < items.length; i++) {
        if ($(items[i]).hasClass('active') == true) {
          break;
        }
      }

      if (i + 1 == items.length - 1) {
        $('#previous_btn').show();
      } else {
        $('#previous_btn').show();
      }

      var text = '';
      for (j = 0; j < items.length; j++) {

        if ($(items[j].id).is(":visible")) {
          var ind = j;
          var ind1 = j + 1;
          if ($("#btnloader").text() == 'Submit' && j != 0) {
            ind = j - 1;
            ind1 = j;
            $("#submit").val('submit');
          }
          if (j + 1 == items.length - 1) {
            $('.btntab1').addClass('finalSubmit');
            $('.btntab1').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-caret-right"></i>');
            //$("#submit").val('submit');
          }
          current_fs = $(items[ind].id);
          next_fs = $(items[ind1].id);
          $('a[id="' + items[ind].id + '"]').removeClass("active");
          $('a[id="' + items[ind1].id + '"]').addClass("active");
          text = items[j].text;
        }
      }

      next_fs.show();
      current_fs.hide();

      nextSaveData(text);
      // end next tab
    }
  });
  $('.reg-previous-button').click(function () {

    // next tab
    // pane1 = $('.dynamic_tab');
    //     alert('pane'+pane1.length);

    //         for (let i =0; i<pane1.length; i++) {
    //             console.log(pane1[i]);
    //             pane1[i].remove()

    //         }

    var i, items = $('.nav-link.mediatab'), pane = $('.mcontenttab');
    for (i = 0; i < items.length; i++) {
      if ($(items[i]).hasClass('active') == true) {
        break;
      }
    }
    if (i != 1) {
      $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
      $('#previous_btn').show();
    } else {
      $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
      $('#previous_btn').hide();
    }
    // if (i != 0) {
    //   // for tab
    //   $(items[i]).removeClass('active');
    //   $(items[i - 1]).addClass('active');
    //   // for pane
    //   // $(pane[i]).removeClass('show active');
    //   // $(pane[i - 1]).addClass('show active');

    //   var str1 = items[i].id;
    //   var tabId1 = str1.replace('-tab', '');
    //   var str2 = items[i - 1].id;
    //   var tabId2 = str2.replace('-tab', '');
    //   $("div#" + tabId1).removeClass('show active');
    //   $("div#" + tabId2).addClass('show active');
    // }
    for (j = items.length - 1; j >= 0; j--) {

      if ($(items[j].id).is(":visible")) {
        current_fs = $(items[j].id);
        next_fs = $(items[j - 1].id);
        $('a[id="' + items[j].id + '"]').removeClass("active");
        $('a[id="' + items[j - 1].id + '"]').addClass("active");
        // nextSaveData('next_tab_1');
        // $("#next_tab_1").val("0");
        $("#submit").val('');
      }
    }
    next_fs.show();
    current_fs.hide();
    // end next tab
  });
  //$('#btntab').addClass('basictab');
  $('#btntab').addClass('btntab1');
  $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
  $('#previous_btn').hide();

  //aaaa
  //Campaign type select
  var CampaignType = $("#Campaign_Type").val();
  if (CampaignType == "0") {
    $('#mediaNameDiv').hide();
    $('#singlemediaNameDiv').show();
    $("#mediaName").attr("name", "multipleMediaName");
    $("#singlemediaName").attr("name", "media_name_s[]");
  } else if (CampaignType == "1") {
    $('#singlemediaNameDiv').hide();
    $('#mediaNameDiv').show();
    $("#mediaName").attr("name", "media_name_s[]");
    $("#singlemediaName").attr("name", "singlemediaName");

  }
  $('#Campaign_Type').change(function () {
    var CampaignType = $("#Campaign_Type").val();
    if (CampaignType == "0") {
      $('#mediaNameDiv').hide();
      $('#singlemediaNameDiv').show();
      $("#mediaName").attr("name", "multipleMediaName");
      $("#singlemediaName").attr("name", "media_name_s[]");
    } else if (CampaignType == "1") {
      $('#singlemediaNameDiv').hide();
      $('#mediaNameDiv').show();
      $("#mediaName").attr("name", "media_name_s[]");
      $("#singlemediaName").attr("name", "singlemediaName");

    }

  });
  $('#mediaName').multiselect({
    nonSelectedText: 'Select Media Name',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth: '100%',
    textleft: true,
    includeSelectAllOption: true,
  });
  function getMediaNameLength() {
    var val = [];
    $('select[name="media_name_s[]"] option:selected').each(function () {
      var mNameval1 = $(this).val();
      val.push(mNameval1);
    });
    return val.length;

  }

  //
  //Campaign type select
  /*var CampaignType = $("#Campaign_Type").val();
    if(CampaignType=="0"){ 
        $('#mediaNameDiv').hide();
        $('#singlemediaNameDiv').show();
        $("#mediaName").attr("name", "multipleMediaName");
        $("#singlemediaName").attr("name", "media_name_s[]");
    }else if(CampaignType == "1")
    {
      $('#singlemediaNameDiv').hide();
      $('#mediaNameDiv').show(); 
      $("#mediaName").attr("name", "media_name_s[]");
      $("#singlemediaName").attr("name", "singlemediaName");

    }
  $('#Campaign_Type').change(function(){
    var CampaignType = $("#Campaign_Type").val();
    if(CampaignType=="0"){ 
      $('#mediaNameDiv').hide();
      $('#singlemediaNameDiv').show();
      $("#mediaName").attr("name", "multipleMediaName");
      $("#singlemediaName").attr("name", "media_name_s[]");
    }else if(CampaignType == "1")
    {
      $('#singlemediaNameDiv').hide();
      $('#mediaNameDiv').show(); 
      $("#mediaName").attr("name", "media_name_s[]");
      $("#singlemediaName").attr("name", "singlemediaName");

    }

  });
  $('#mediaName').multiselect({
        nonSelectedText: 'Select Media Name',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
    });
  function getMediaNameLength() {
    var val=[]; 
    $('select[name="media_name_s[]"] option:selected').each(function() {
      var mNameval1=$(this).val();
      val.push(mNameval1);
    });
    return val.length;
    
  }*/
  //end Campaign type
  //mange tab
  //showTabs();
  //manageTab();
  /*function showTabs(){
 
     $('select[name="media_name_s[]"] option:selected').each(function(index,element) {
 
       if(element.value!=''){
         console.log(element.text);
         var getTabName='<li class="tab-nav-item"  id ="'+element.text+'"><a class="nav-link mediatab" id="'+element.text+'-tab" data-toggle="tab"  role="tab" aria-controls="'+element.text+'" aria-selected="false">'+element.text+'</a></li>'
         $('.nav.nav-tabs').append(getTabName);
       }
     }); 
    
   }*/


  /*function manageTab(){
  var i, items = $('.nav-link.mediatab'), pane = $('.mcontenttab');
        for(i = 0; i < items.length; i++){

          if($(items[i]).hasClass('active') == true ){
              break;
          }
        }

        if(i+1 == items.length-1){
          $('.btntab1').html('<i class="" id="btnloader">Submit</i> <i class="fa fa-caret-right"></i>');
          $('#previous_btn').show();
        }else{
          $('#previous_btn').show();
        }
        if(i < items.length - 1){
          // for tab
          console.log($(items[i]));
          $(items[i]).removeClass('active');
          $(items[i+1]).addClass('active');
          // for pane
          $(pane[i]).removeClass('show active');
          $(pane[i+1]).addClass('show active');
        }
        //privius
         if(i != 1){
        $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
        $('#previous_btn').show();
      }else{
        $('.btntab1').html('<i class="" id="btnloader">Next</i> <i class="fa fa-caret-right"></i>');
        $('#previous_btn').hide();
      }
      if(i != 0){
        // for tab
        $(items[i]).removeClass('active');
        $(items[i-1]).addClass('active');
        // for pane
        $(pane[i]).removeClass('show active');
        $(pane[i-1]).addClass('show active');
      }  
}*/

  function in_array(needle, haystack) {
    for (var key in haystack) {
      if (needle === haystack[key]) {
        return true;
      }
    }

    return false;
  }

  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  }, 'Please enter a vaild email address');


});