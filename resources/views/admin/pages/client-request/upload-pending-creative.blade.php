@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;

    p,
    label {
      font: 1rem 'Fira Sans', sans-serif;
    }

    input {
      margin: .4rem;
    }
  }

  .multiselect-search {
    width: 100% !important;
    margin-right: 10px;
  }

  .dropdown-menu.show {
    display: block;
    width: 100% !important;
  }

  .multiselect-clear-filter {
    display: none !important;
  }

  .hide-msg {
    display: none !important;
  }

  .fa-check {
    color: green;
  }

  a.disabled {
    pointer-events: none;
  }

  .ui-datepicker-trigger {
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .fieldset-border {
    border: solid 1px #ccc;
    padding: 10px;
    margin-bottom: 10px;
  }
  .fieldset-border legend {
    width: auto;
    padding: 0 10px;
    font-size: 16px;
    color: #007bff!important;
  }
  .remove-arrow-select {

    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
  }
  .remove-button {color: #fff !important;}
</style>
@section('content')
@php
$clrno=@$aValues['clrno'];
$curl=url()->current();

@endphp
<div class="content-inside p-3">
  <div class="" id="plzWait"><i class="" id="formloader"></i></div>
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>Upload Pending Creative</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body"> 

      <form method="POST"  class="upload_pending_creative" id="upload_pending_creative" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div class="row">
            <span class="set-img"></span>
            @if($aValues['PrintCreativeAvailable']==1)
            <div class="col-md-4" id="PrintUploadCreativeDiv">
              <div class="form-group">
                <label class="form-control-label">Print Upload Advertisement/विज्ञापन अपलोड करें<span style="color:red">*</span></label>
                <input  type="file" accept="application/pdf" class="form-control form-control-sm" name="printCreativeFileName" id="printCreativeFileName"  >
                <input type="hidden" name="print_upload_creative_fileName_img" id="print_upload_creative_fileName_img" >

              </div>
            </div>@endif
             @if($aValues['ODCreativeAvailable']==1)
             <div class="col-md-4" id="OutdoorUploadCreativeDiv">
              <div class="form-group">
                <label class="form-control-label">Outdoor Upload Advertisement/विज्ञापन अपलोड करें<span style="color:red">*</span></label>
                <input  type="file" accept="application/pdf" class="form-control form-control-sm" name="outdoorCreativeFileName" id="outdoorCreativeFileName" >
                <input type="hidden" name="outdoor_upload_creative_fileName_img" id="outdoor_upload_creative_fileName_img" >

              </div>
            </div>@endif
            @include('admin.pages.pdf-canvas')
              @if($aValues['TVCreativeAvailable']==1)
             <div class="col-md-4" id="AVTVUploadCreativeDiv">
              <div class="form-group">
                <label class="form-control-label">AV-TV Upload Advertisement/विज्ञापन अपलोड करें<span style="color:red">*</span></label>
                <input  type="file" accept="video/*" class="form-control form-control-sm" name="tvCreativeFileName" id="tvCreativeFileName" >
              </div>
            </div>@endif
             @if($aValues['RadioCreativeAvailable']==1)
            <div class="col-md-4" id="AVRadioUploadCreativeDiv">
              <div class="form-group">
                <label class="form-control-label">AV-Radio Upload Advertisement/विज्ञापन अपलोड करें<span style="color:red">*</span></label>
                <input  type="file" accept="video/*" class="form-control form-control-sm" name="radioCreativeFileName" id="radioCreativeFileName" >
              </div>
            </div>@endif
          </div>
          <div class="row">
            <div class="col-sm-12 text-right">
               <a class="btn btn-primary client-next-button btn-sm m-0 "  onclick="nextSaveData();" id="uploadbtntab"> Submit </a>
            </div>
          </div>
        </div>
        <input type="hidden" name="clrno" id='clrno' value="{{$clrno}}">
      </form>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script >


 //  next and previous function for save

  function nextSaveData() {
    var formData = new FormData($('#upload_pending_creative')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('client.updatependingcreative')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {

          swal("Success","File Uploaded Successfully","success").then(function () {
            window.location = "{{ Route('client.clientPendingCreativeList') }}";
          });
         
      },
      error: function(data) {
           swal("Error",'You have not choose any file,please choose file',"error").then(function () {
            //window.location = "{{ Route('client.uploadpendingcreativeform') }}";
            window.location.href
          });
        
         
      },
      
    });
  }

// PDF TO Image
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
// for Upload print
$("#printCreativeFileName").on('change', function() {
// Validate whether PDF
  if(['application/pdf'].indexOf($("#printCreativeFileName").get(0).files[0].type) == -1) {
      alert('Error : Not a PDF');
      return;
  }
// Send the object url of the pdf
  showPDF(URL.createObjectURL($("#printCreativeFileName").get(0).files[0]));
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

// For Upload Outdoor 
$("#outdoorCreativeFileName").on('change', function() {
  // Validate whether PDF
    if(['application/pdf'].indexOf($("#outdoorCreativeFileName").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
    }
  // Send the object url of the pdf
  showPDF_advt(URL.createObjectURL($("#outdoorCreativeFileName").get(0).files[0]));
  });

$('.set-img').on('click',function(){
  $("#print_upload_creative_fileName_img").attr('value', __CANVAS.toDataURL());
  $("#outdoor_upload_creative_fileName_img").attr('value', __CANVAS_2.toDataURL());

});
</script>

@endsection