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
      $(function(){
          $('.set-img').trigger('click');
      });
      		
		});
	});
}

// When user chooses a PDF file
$("#upload_doc_0").on('change', function() {
// Validate whether PDF
  if(['application/pdf'].indexOf($("#upload_doc_0").get(0).files[0].type) == -1) {
      alert('Error : Not a PDF');
      return;
  }
// Send the object url of the pdf
  showPDF(URL.createObjectURL($("#upload_doc_0").get(0).files[0]));
});

$('.set-img').on('click',function(){
  $("#print_upload_creative_fileName_img").attr('value', __CANVAS.toDataURL());
});


$(document).ready(function(){
  $(".submit-button").click(function(){
    var form = $("#complianceFrm");      
    form.validate({
      rules: {   
        npcode: {
          required:true,
        },
        rocode: {
          required:true,
        },
        published_date: {
          required:true,

        },
        published_pageno : {
          required:true,
        }, 
        print_upload_creative_fileName : {
          required:true,
        },
                              
      },
      messages: {      
        npcode: {
          required:"Please fill required field!",

        },
        rocode: {
          required:"Please fill required field!",

        },
        published_date: {
          required:"Please fill required field!",

        },
        published_pageno: {
          required:"Please fill required field!",

        },
        print_upload_creative_fileName: {
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
});