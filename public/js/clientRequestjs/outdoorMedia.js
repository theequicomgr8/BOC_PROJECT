var __PDF_DOC,
__CURRENT_PAGE,
__TOTAL_PAGES,
__PAGE_RENDERING_IN_PROGRESS = 0,
__CANVAS = $('#pdf-canvas').get(0),
__CANVAS_CTX = __CANVAS.getContext('2d');

function showPDF(pdf_url) {
$("#pdf-loader").show();

PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
  __PDF_DOC = pdf_doc;
  __TOTAL_PAGES = __PDF_DOC.numPages;
  
  // Hide the pdf loader and show pdf container in HTML
  $("#pdf-loader").hide();
  $("#pdf-contents").show();
  // $("#pdf-total-pages").text(__TOTAL_PAGES);

  // Show the first page
  showPage(1);
}).catch(function(error) {
  // If error re-show the upload button
  $("#pdf-loader").hide();
  // $("#upload-button").show();
  
  alert(error.message);
});
}
function showPage(page_no) {
	__PAGE_RENDERING_IN_PROGRESS = 1;
	__CURRENT_PAGE = page_no;

	// Disable Prev & Next buttons while page is being loaded
	$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

	// While page is being rendered hide the canvas and show a loading message
	$("#pdf-canvas").hide();
	$("#page-loader").show();
	$("#download-image").hide();

	// Update current page in HTML
	$("#pdf-current-page").text(page_no);
	
	// Fetch the page
	__PDF_DOC.getPage(page_no).then(function(page) {
		// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
		var scale_required = __CANVAS.width / page.getViewport(1).width;
		// Get viewport of the page at required scale
		var viewport = page.getViewport(scale_required);
		// Set canvas height
		__CANVAS.height = viewport.height;

		var renderContext = {
			canvasContext: __CANVAS_CTX,
			viewport: viewport
		};
		
		// Render the page contents in the canvas
		page.render(renderContext).then(function() {
			__PAGE_RENDERING_IN_PROGRESS = 0;
			// Re-enable Prev & Next buttons
			$("#pdf-next, #pdf-prev").removeAttr('disabled');
			// Show the canvas and hide the page loader
			$("#pdf-canvas").show();
      $("#download-image").show();
      download.click();
		});
	});
}

// When user chooses a PDF file
$("#outdoorCreativeFileName").on('change', function() {
// Validate whether PDF
  if(['application/pdf'].indexOf($("#outdoorCreativeFileName").get(0).files[0].type) == -1) {
      alert('Error : Not a PDF');
      return;
  }
// Send the object url of the pdf
  showPDF(URL.createObjectURL($("#outdoorCreativeFileName").get(0).files[0]));
  
});
$('.set-img').on('click',function(){
  var outdoorCreativeAvail =$('#outdoorCreativeAvail option:selected').val();
  if(outdoorCreativeAvail==""){
    $("#outdoorCreativeFileName_img").attr('value', '');
  }
  else if(outdoorCreativeAvail == "0"){
     $("#outdoorCreativeFileName_img").attr('value', __CANVAS.toDataURL());
  }
  else if(outdoorCreativeAvail == "2"|| outdoorCreativeAvail == "3" || outdoorCreativeAvail == "1"){
    $("#outdoorCreativeFileName_img").attr('value','');
  }
});

$(document).ready(function(){
  $(document).on('keyup', 'input[name^="outdoorAdvBreadth"]', function(element,b) {
  //$("#outdoorAdvLength,#outdoorAdvBreadth").keyup(function () {
    var curEle = jQuery(this);
    var parentEle = curEle.closest('#inputFormRow');
    var outdoorAdvLength = parentEle.find('input[name^="outdoorAdvLength"]').attr('id');
    var outdoorAdvBreadth = parentEle.find('input[name^="outdoorAdvBreadth"]').attr('id');
    var outdoorAdvArea = parentEle.find('input[name^="outdoorAdvArea"]').attr('id');
    $('#'+outdoorAdvArea).val($('#'+outdoorAdvLength).val() * $('#'+outdoorAdvBreadth).val());
  });


  $(document).on('change', 'select[name^="outdoorGroupCity"]', function(element,b) {
    var curEleo = jQuery(this);
    var outdoorGroupCityvalu = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var outdoorGroupCityID = parentEle.find('select[name^="outdoorGroupCity"]').attr('id');
    var outdoorRandomCityList = parentEle.find('select[name^="outdoorRandomCityList"]').attr('id');
    var outdoorRandomCityDiv = parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
    var optionsValue = $('#'+outdoorGroupCityID+' option:selected').val();

    if (optionsValue=="5"){
      $('#'+outdoorRandomCityList).multiselect({
        nonSelectedText: 'Select Random City',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
      });
      $("#"+outdoorRandomCityList).multiselect("clearSelection");
      $('#'+outdoorRandomCityDiv).show();
    }else{
      $("#"+outdoorRandomCityList).multiselect("clearSelection");
      //$("#"+outdoorRandomCityList).multiselect( 'refresh' );
      $('#'+outdoorRandomCityDiv).hide();
    }
  });
$(document).on('change', 'select[name^="outdoorTArea"]', function(element,b) {
    var curEleo = jQuery(this);
    var outdoorTArea = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var TASelectID = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    
    
      if(outdoorTArea!="3" ){
        var selectedTgroupCitydivid=parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
        var selectedTgroupCityclassname = $('#'+selectedTgroupCitydivid).attr('class').split(' ');
        var splitselectedTgroupCityclassname =  $('.'+selectedTgroupCityclassname[1]);
        splitselectedTgroupCityclassname.hide(); 
      }
    var options = $('#'+TASelectID+' option:selected').text();
    if(outdoorTArea=="4" || outdoorTArea=="5" || outdoorTArea=="6" ){
      if(options=="City/Town"){
        options='CityTown';
      }
      var selectedTDivID='divOutdoor_'+options;
      var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
      var DivGroupclass = $('#'+DivID).attr('class').split(' ');
      var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }else{
        var optionName=options.split(' ');
        var selectedTDivID='divOutdoor_'+optionName[0].concat(optionName[1]);
        var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
        var DivGroupclass = $('#'+DivID).attr('class').split(' ');
        var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }
    selectedTAGroupClass.hide();
    $('#'+DivID).show();
    if(outdoorTArea=="2" ){
      var outdoorGroupState = parentEle.find('select[name^="outdoorGroupState"]').attr('id');
      $('#'+outdoorGroupState).multiselect({
      nonSelectedText: 'Select Group of State',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      textleft:true,
      includeSelectAllOption:true,
      });
    }
  });

  $(document).on('change', 'select[name^="outdoorMediaSubCategory"]', function(element,b) {
    var curEle = jQuery(this);
    var subCatID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var targetEle = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    var outdoorTrainDiv = parentEle.find('div[id^="divOutdoor_train"]').attr('id');
    if (subCatID) {
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD080' || subCatID=='OD084' || subCatID=='OD104' || subCatID=='OD108' ){
        $('#'+targetEle+' option[value="0"]').attr("selected",true) ;
      }else{
        $('#'+targetEle+' option[value="0"]').attr("selected",false) ;
      }
      if(subCatID=='OD029' || subCatID=='OD030' || subCatID=='OD084' || subCatID=='OD108' ){
         $('#'+outdoorTrainDiv).show();
      }else{
         $('#'+outdoorTrainDiv).hide();
      }
    }
  });

  //end
  //for outdoor view
  $('select[name^="outdoorIndividualState"] option:selected').each(function(index,curEle) {
    var curEle = jQuery(this);
    var categorieID = curEle.val();
    var parentEle = curEle.closest('#inputFormRow');
    var outdoorCityWithState = parentEle.find('input[name^="outdoorCityWithState"]').attr('id');
    $('#'+outdoorCityWithState).prop("checked", false);
  });

  $('select[name^="outdoorGroupCity"] option:selected').each(function(element,b) {
    var curEleo = jQuery(this);
    var outdoorGroupCityvalu = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var outdoorGroupCityID = parentEle.find('select[name^="outdoorGroupCity"]').attr('id');
    var outdoorRandomCityList = parentEle.find('select[name^="outdoorRandomCityList"]').attr('id');
    var outdoorRandomCityDiv = parentEle.find('div[id^="divOutdoor_RandomCity"]').attr('id');
    var divOutdoor_GroupCity = parentEle.find('div[id^="divOutdoor_GroupCity"]').attr('id');
    var optionsValue = $('#'+outdoorGroupCityID+' option:selected').val();
    if (optionsValue=="5"){
      $('#'+outdoorRandomCityList).multiselect({
        nonSelectedText: 'Select Random City',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        textleft:true,
        includeSelectAllOption:true,
      });
      $('#'+outdoorRandomCityDiv).show();
    }else{
      //$("#"+outdoorRandomCityList).multiselect("clearSelection");
      //$("#"+outdoorRandomCityList).multiselect( 'refresh' );
      $('#'+outdoorRandomCityDiv).hide();
       //$('#'+divOutdoor_GroupCity).show();

    }

  });


$('select[name^="outdoorTArea"] option:selected').each(function(element,b) {
    var curEleo = jQuery(this);
    var outdoorTArea = curEleo.val();
    var parentEle = curEleo.closest('#inputFormRow');
    var TASelectID = parentEle.find('select[name^="outdoorTArea"]').attr('id');
    var options = $('#'+TASelectID+' option:selected').text();
    if(outdoorTArea=="4" || outdoorTArea=="5" || outdoorTArea=="6" ){
       if(options=="City/Town"){
        options='CityTown';
      }
      var selectedTDivID='divOutdoor_'+options;
      var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
      var DivGroupclass = $('#'+DivID).attr('class').split(' ');
      var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }else{
        var optionName=options.split(' ');
        var selectedTDivID='divOutdoor_'+optionName[0].concat(optionName[1]);
        console.log(selectedTDivID);
        var DivID = parentEle.find('div[id^="'+selectedTDivID+'"]').attr('id');
        var DivGroupclass = $('#'+DivID).attr('class').split(' ');
        var selectedTAGroupClass=$('.'+DivGroupclass[1]);
    }
    selectedTAGroupClass.hide();
    $('#'+DivID).show();
    if(outdoorTArea=="2" ){
      var outdoorGroupState = parentEle.find('select[name^="outdoorGroupState"]').attr('id');
      $('#'+outdoorGroupState).multiselect({
      nonSelectedText: 'Select Group of State',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      textleft:true,
      includeSelectAllOption:true,
      });
    }
  //Group of state  
  });
  
  //End for outdoor view

  //Start is creative for outdoor
  var outdoorCreativeAvail =$('#outdoorCreativeAvail option:selected').val();
  if(outdoorCreativeAvail==""){
    $('#outdoorUploadCreativeDiv').hide();
  }
  else if(outdoorCreativeAvail == "0"){
    $('#outdoorUploadCreativeDiv').show();
  }
  else if(outdoorCreativeAvail == "2"|| outdoorCreativeAvail == "3" || outdoorCreativeAvail == "1"){
    $('#outdoorUploadCreativeDiv').hide();
  }
  $('#outdoorCreativeAvail').change(function(){
    var outdoorCreativeAvail =$('#outdoorCreativeAvail option:selected').val();
    if(outdoorCreativeAvail==""){
      $('#outdoorUploadCreativeDiv').hide();
    }
    else if(outdoorCreativeAvail == "0"){
      $('#outdoorUploadCreativeDiv').show();
    }
    else if(outdoorCreativeAvail == "3" || outdoorCreativeAvail == "1"){
      $('#outdoorUploadCreativeDiv').hide();
    }
    else if(outdoorCreativeAvail == "2"){
      $('#outdoorUploadCreativeDiv').hide();

    }
  });




});