var __PDF_DOC,
__CURRENT_PAGE,
__TOTAL_PAGES,
__PAGE_RENDERING_IN_PROGRESS = 0,
__CANVAS = $('#pdf-canvas').get(0),
__CANVAS_CTX = __CANVAS.getContext('2d');
__CANVAS_2 = $('#pdf-canvas-1').get(0),
__CANVAS_2_CTX = __CANVAS_2.getContext('2d');

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
      $(function(){
          $('.set-img').trigger('click');
      });
      		
		});
	});
}

// When user chooses a PDF file
// for Upload Newspaper
$("#npImage").on('change', function() {
// Validate whether PDF
  if(['application/pdf'].indexOf($("#npImage").get(0).files[0].type) == -1) {
      alert('Error : Not a PDF');
      return;
  }
// Send the object url of the pdf
  showPDF(URL.createObjectURL($("#npImage").get(0).files[0]));
});

// For Upload Advertisment

function showPDF_advt(pdf_url) {
  $("#pdf-loader-1").show();
  
  PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
    __PDF_DOC = pdf_doc;
    __TOTAL_PAGES = __PDF_DOC.numPages;
    
    // Hide the pdf loader and show pdf container in HTML
    $("#pdf-loader-1").hide();
    $("#pdf-contents-1").show();
    // $("#pdf-total-pages").text(__TOTAL_PAGES);
  
    // Show the first page
    showPage_advt(1);
  }).catch(function(error) {
    // If error re-show the upload button
    $("#pdf-loader-1").hide();
    // $("#upload-button").show();
    
    alert(error.message);
  });
  }

function showPage_advt(page_no) {
  __PAGE_RENDERING_IN_PROGRESS = 1;
  __CURRENT_PAGE = page_no;

  // Disable Prev & Next buttons while page is being loaded
  $("#pdf-next-1, #pdf-prev-1").attr('disabled', 'disabled');

  // While page is being rendered hide the canvas and show a loading message
  $("#pdf-canvas-1").hide();
  $("#page-loader-1").show();
  // $("#download-image").hide();

  // Update current page in HTML
  $("#pdf-current-page-1").text(page_no);
  
  // Fetch the page
  __PDF_DOC.getPage(page_no).then(function(page) {
    // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
    var scale_required = __CANVAS_2.width / page.getViewport(1).width;

    // Get viewport of the page at required scale
    var viewport = page.getViewport(scale_required);

    // Set canvas height
    __CANVAS_2.height = viewport.height;

    var renderContext = {
      canvasContext: __CANVAS_2_CTX,
      viewport: viewport
    };
    
    // Render the page contents in the canvas
    page.render(renderContext).then(function() {
      __PAGE_RENDERING_IN_PROGRESS = 0;

      // Re-enable Prev & Next buttons
      $("#pdf-next-1, #pdf-prev-1").removeAttr('disabled');

      // Show the canvas and hide the page loader
      $("#pdf-canvas-1").show();
      $(function(){
          $('.set-img').trigger('click');
      });
          
    });
  });
}

// For Upload Advertisement Image
$("#advtImage").on('change', function() {
  // Validate whether PDF
    if(['application/pdf'].indexOf($("#advtImage").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }
  // Send the object url of the pdf
  showPDF_advt(URL.createObjectURL($("#advtImage").get(0).files[0]));
  });

$('.set-img').on('click',function(){
  $("#npImage_fileName").attr('value', __CANVAS.toDataURL());
  $("#img1").attr('value', __CANVAS.toDataURL());
  $("#advtImage_fileName").attr('value', __CANVAS_2.toDataURL());
  $("#ImageMatchPercentage").trigger('click');

});

$(document).ready(function(){
  $(".submit-button").click(function(){
    var form = $("#billingFrm");      
    form.validate({
      rules: {   
        billno: {
          required:true,
        },
        bill_date: {
          required:true,
        },
        publication_date: {
          required:true,

        },
        // gstno : {
        //   required:true,
        // }, 
        bublishedIn : {
          required:true,
        },
        published_pageno : {
          required:true,
        },
        advtLen : {
          required:true,
        },
        advtWidth : {
          required:true,
        },
        diff : {
          required:true,
        },
        claimedAmount : {
          required:true,
        },
        billOfficerName : {
          required:true,
        },
        billOfficerDesign : {
          required:true,
        },
        email: { required: true, emailExt: true, maxlength: 40 },
        SignatoryName : {
          required:true,
        },
        SignatoryDesign : {
          required:true,
        },
        advtImage : {
          required:true,
        },
        npImage : {
          required:true
        },
        token_bill_date : {
          required:true
        },    
                              
      },
      messages: {      
        billno: {
          required:"Please fill required field!",
        },
        bill_date: {
          required:"Please fill required field!",
        },
        publication_date: {
          required:"Please fill required field!",

        },
        // gstno : {
        //   required:"Please fill required field!",
        // }, 
        bublishedIn : {
          required:"Please fill required field!",
        },
        published_pageno : {
          required:"Please fill required field!",
        },
        advtLen : {
          required:"Please fill required field!",
        },
        advtWidth : {
          required:"Please fill required field!",
        },
        diff : {
          required:"Please fill required field!",
        },
        claimedAmount : {
          required:"Please fill required field!",
        },
        billOfficerName : {
          required:"Please fill required field!",
        },
        billOfficerDesign : {
          required:"Please fill required field!",
        },
        email: { required: "Please fill required field!", email: "Please enter a vaild email address!" },
        SignatoryName : {
          required:"Please fill required field!",
        },
        SignatoryDesign : {
          required:"Please fill required field!",
        },
        advtImage : {
          required:"Please fill required field!",
        },
        npImage : {
          required:"Please fill required field!",
        },
        token_bill_date: {
          required:"Please fill required field!",
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
    if (form.valid() === true){
     SaveData();
    }else{
      
    }

  });  
  jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  }, 'Please enter a vaild email address');
});

    