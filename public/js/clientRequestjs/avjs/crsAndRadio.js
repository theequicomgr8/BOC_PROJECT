
$(document).ready(function(){
  var crsRadioTargetArea =$('#crsRadioTargetArea option:selected').val();
  if(crsRadioTargetArea == ''){
   $('#divcrsRadioState').hide();
   $('#divcrsRadioCity').hide(); 
  }else if(crsRadioTargetArea == "0"){
   $('#divcrsRadioState').hide();
   $('#divcrsRadioCity').hide();
  }else if(crsRadioTargetArea == "1"){
    $('#divcrsRadioState').show();
  }else if(crsRadioTargetArea == "2"){
    $('#divcrsRadioCity').show(); 
  }
  else if(crsRadioTargetArea == "3"){
    $('#divcrsRadioState').show();
    $('#divcrsRadioCity').show(); 
  }
  $('#crsRadioTargetArea').change(function(){
    var crsRadioTargetArea =$('#crsRadioTargetArea option:selected').val();
    if(crsRadioTargetArea == ''){
      $('#divcrsRadioState').hide();
      $('#divcrsRadioCity').hide(); 
      $('#crsRadioState').multiselect('clearSelection');
      $("#crsRadioCity").multiselect('clearSelection');
      //$("#crsRadioCity").multiselect('rebuild');
    }else if(crsRadioTargetArea == "0"){
      $('#divcrsRadioState').hide();
      $('#divcrsRadioCity').hide(); 
      $('#crsRadioState').multiselect('clearSelection');
      $("#crsRadioCity").multiselect('clearSelection');
    }else if(crsRadioTargetArea == "1"){
      $('#divcrsRadioState').show();
      $('#divcrsRadioCity').hide(); 
      $('#crsRadioState').multiselect('clearSelection');
      $("#crsRadioCity").multiselect('clearSelection');
    }else if(crsRadioTargetArea == "2"){
      $('#divcrsRadioCity').show(); 
      $('#divcrsRadioState').hide();
      $('#crsRadioState').multiselect('clearSelection');
      $("#crsRadioCity").multiselect('clearSelection');
    }else if(crsRadioTargetArea == "3"){
      $('#divcrsRadioCity').show(); 
      $('#divcrsRadioState').show();
      $('#crsRadioState').multiselect('clearSelection');
      $("#crsRadioCity").multiselect('clearSelection');
    }
  });
  //Start is creative for crsRadio
  var crsRadioCreativeAvail =$('#crsRadioCreativeAvail option:selected').val();
  if(crsRadioCreativeAvail==""){
    $('#crsRadioUploadCreativeDiv').hide();
  }
  else if(crsRadioCreativeAvail == "0"){
    $('#crsRadioUploadCreativeDiv').show();
  }
  else if(crsRadioCreativeAvail == "2"|| crsRadioCreativeAvail == "3" || crsRadioCreativeAvail == "1"){
    $('#crsRadioUploadCreativeDiv').hide();
  }
  $('#crsRadioCreativeAvail').change(function(){
    var crsRadioCreativeAvail =$('#crsRadioCreativeAvail option:selected').val();
    if(crsRadioCreativeAvail==""){
      $('#crsRadioUploadCreativeDiv').hide();
    }
    else if(crsRadioCreativeAvail == "0"){
      $('#crsRadioUploadCreativeDiv').show();
    }
    else if(crsRadioCreativeAvail == "3" || crsRadioCreativeAvail == "1"){
      $('#crsRadioUploadCreativeDiv').hide();
    }
    else if(crsRadioCreativeAvail == "2"){
      $('#crsRadioUploadCreativeDiv').hide();

    }
  });
  $('input[type="file"]').change(function(e){
    var file = e.target.files[0].name;

    var byte = e.target.files[0].size;
    var sizemb = (byte / (1024*1024));
    var ext = file.split('.').pop();
    if ((file!= "" && sizemb <= 2)) 
    {
      $("#choose_file").text(file);
      $("#upload_doc_error").hide();
    }
    else 
    {
      $("#choose_file" ).text(file);
      $("#upload_doc_error").text('File size should be 2MB');
      $("#upload_doc_error").show();

    }
  });
  
  
  $("#crsRadioState").change(function(){
    var curEle = jQuery(this);
    var state_code = curEle.val();
    if (state_code) {
        jQuery.ajax({
            url: 'getFMCityStateBased/'+state_code+'/'+'',
            type: "GET",
            dataType: "json",
            success: function(data) {
               $('#crsRadioCity').html("");
                jQuery.each(data, function(key, value) {
                  console.log(value.CityName);
                    $('#crsRadioCity').append('<option value="' +value.CityName + '">' + value.CityName + '</option>');
                });

                $("#crsRadioCity").multiselect('rebuild');
            }
        });
    }
  });

   //Group of state
  $('#crsRadioState').multiselect({
    nonSelectedText: 'Select State',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });

  //Group of state
  $('#crsRadioCity').multiselect({
    nonSelectedText: 'Select City',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });


});