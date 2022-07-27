
$(document).ready(function(){
  var tvTargetArea =$('#tvTargetArea option:selected').val();
  if(tvTargetArea == ''){
    $('#tvGroupRegionDiv').hide(); 
  }else if(tvTargetArea == "0"){
    $('#tvGroupRegionDiv').hide();
  }else if(tvTargetArea == "1"){
    $('#tvGroupRegionDiv').show();
  }
  $('#tvTargetArea').change(function(){
    var tvTargetArea =$('#tvTargetArea option:selected').val();
    if(tvTargetArea == ''){
      $('#tvGroupRegionDiv').hide(); 
      $("#tvGroupRegion").multiselect("clearSelection");
    }else if(tvTargetArea == "0"){
      $('#tvGroupRegionDiv').hide();
      $("#tvGroupRegion").multiselect("clearSelection");
    }else if(tvTargetArea == "1"){
      $('#tvGroupRegionDiv').show();
    }
  });
  //Start is creative for tv
  var tvCreativeAvail =$('#tvCreativeAvail option:selected').val();
  if(tvCreativeAvail==""){
    $('#tvUploadCreativeDiv').hide();
  }
  else if(tvCreativeAvail == "0"){
    $('#tvUploadCreativeDiv').show();
  }
  else if(tvCreativeAvail == "2"|| tvCreativeAvail == "3" || tvCreativeAvail == "1"){
    $('#tvUploadCreativeDiv').hide();
  }
  $('#tvCreativeAvail').change(function(){
    var tvCreativeAvail =$('#tvCreativeAvail option:selected').val();
    if(tvCreativeAvail==""){
      $('#tvUploadCreativeDiv').hide();
    }
    else if(tvCreativeAvail == "0"){
      $('#tvUploadCreativeDiv').show();
    }
    else if(tvCreativeAvail == "3" || tvCreativeAvail == "1"){
      $('#tvUploadCreativeDiv').hide();
    }
    else if(tvCreativeAvail == "2"){
      $('#tvUploadCreativeDiv').hide();

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
   //Group of region
  $('#tvGroupRegion').multiselect({
    nonSelectedText: 'Select Group Region',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'100%',
    textleft:true,
    includeSelectAllOption:true,
  });

});