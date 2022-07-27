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
</style>
<?php 
//dd($_GET['CreativeFileName']);
    $CreativeFileName=isset($_GET['CreativeFileName']) ? $_GET['CreativeFileName'] : '';
     $ROCode=isset($_GET['ROCode']) ? $_GET['ROCode'] : '';
     $NPCode=isset($_GET['NPCode']) ? $_GET['NPCode'] : '';
?>
@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i>Bill Submission </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" class="ODMediaBillingFrm" id="ODMediaBillingFrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row">

                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Bill No./बिल संख्या<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="billno" id="billno" value="<?php echo sprintf("%s%02s", 'B',rand(100,100000).session('UserName'));?>">

                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Date/बिल दिनांक<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" name="bill_date" id="bill_date"  placeholder="DD-MM-YYYY" value="<?php echo date('d-m-Y', strtotime(now())) ;?>">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Publication Date/प्रकाशन दिनांक<font color="red">*</font></label>

                    <input  type="text" class="form-control form-control-sm" name="publication_date" id="publication_date"  placeholder="DD-MM-YYYY" autocomplete="off">
                    <span id="date_error" style="color:red;display: none;"></span>
                    <span class="diffdatemsgLabel"></span>
                    
                  </div>
                </div>
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">GST No./जीएसटी संख्या<font color="red">*</font></label>
                    <input type="text" maxlength="15" class="form-control form-control-sm" name="gstno" id="gstno" return onchange="checksum(this.value);">
                    <span class="gstvalidationMsg"></span>
                    <span class="validcheck"></span>

                  </div>
                </div>
               <!--  <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Published In <font color="red">*</font></label>
                    <select  id="bublishedIn" name="bublishedIn" class="form-control form-control-sm">
                      <option value=""> Select </option>
                      <option value="Color" >Color</option>
                      <option value="Black & White" >Black & White</option>
                      
                    </select>
                    <span id="first_owner_name" style="color:red;display:none;"></span>

                  </div>
                </div> -->
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Page No. on which Ad. Published<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="published_pageno" id="published_pageno" onkeypress="return isNumber(event)" maxlength="5" >
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div> -->

              </div>
              <div class="row">
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Advertisement Length(in CMS)/विज्ञापन की लंबाई<font color="red">*</font></label>
                    <input type="text"  name="advtLen" id="advtLen"  class="form-control form-control-sm" onkeypress="return isNumber(event)" >
                    
                  </div>
                </div>
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Width(In CMS)/चौड़ाई<font color="red">*</font> </label>
                    <input type="text"  name="advtWidth" id="advtWidth"  class="form-control form-control-sm" onkeypress="return isNumber(event)">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Difference in Sq. CMS/वर्ग में अंतर<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="diff" id="diff" onkeypress="return isNumber(event)" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Claimed Amount/दावा की गई राशि<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="claimedAmount" id="claimedAmount" onkeypress="return isNumber(event)">
                    <input  type="hidden" class="form-control form-control-sm" maxlength="40" name="ap_amount" value="{{$_GET['givenAmount']}}">
                    <input type="hidden" name="totaladvtSize" value="{{$_GET['totaladvtSize']}}" id="totaladvtSize">
                  </div>
                </div>
                

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Name/बिल अधिकारी का नाम<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerName" id="billOfficerName" onkeypress="return onlyAlphabets(event,this)">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Bill Officer Designation/बिल अधिकारी पदनाम<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="billOfficerDesign" id="billOfficerDesign" onkeypress="return onlyAlphabets(event,this)">
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">E-mail ID/ईमेल आईडी<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="email" id="email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Auth. Signatory Name/प्रामाणिक। हस्ताक्षरकर्ता का नाम<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="SignatoryName" id="SignatoryName" onkeypress="return onlyAlphabets(event,this)">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Auth. Signatory Designation/प्रामाणिक। हस्ताक्षरी पदनाम<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="SignatoryDesign" id="SignatoryDesign" onkeypress="return onlyAlphabets(event,this)">
                  </div>
                </div>
              </div> 
              <input type="hidden" name="img1" value="{{ @asset('uploads/client-request/'.$CreativeFileName) }}" id="img1">
              <input type="hidden" name="img1_name" value="{{ @$CreativeFileName }}" id="img1_name">
              <input type="hidden" name="agencycode" value="{{@$NPCode }}" id="agencycode">  
              <input type="hidden" name="rocode" value="{{@$ROCode }}" id="rocode">
              <div class="row">
                <!-- start np image upload file-->
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Upload Newspaper<br> Image/समाचार पत्र छवि अपलोड करें<font color="red">*</font></label>
                    <input  accept="image/png, image/jpeg, image/jpg" type="file" class="custom-file-doc form-control form-control-sm" name="agencyImage" id="agencyImage">


                  </div>
                </div><!--end np img div upload file end-->
                <!-- start upload file of adverttisement -->
                <div class="col-md-4" >
                  <div class="form-group">
                    <label class="form-control-label">Upload Advertisement Image/विज्ञापन छवि अपलोड करें<font color="red">*</font></label>
                    <input accept="image/png, image/jpeg, image/jpg"  type="file" class="form-control form-control-sm" name="advtImage" id="advtImage" onchange="encodeImageFileAsURL(this)" >
                    <span id="alert_img_msg" style="display:none; color: red;">0% Match, Creative Image is not available.</span>


                  </div>
                </div><!--end div advt image upload file end-->

                <div class="col-md-4" id="diff-results" style="display:none;" >
                  <div class="form-group">
                    <label class="form-control-label"> Match Image Difference(in %)/मिलान छवि अंतर<font color="red">*</font></label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="ImageMatchPercentage" id="ImageMatchPercentage" value="" readonly>

                  </div>
                  <span id="alert_img_compare" class="" style="display:none;"></span>

                </div>
                

              </div>

              <div class="col-sm-6">
                <div class="form-group clearfix">
                  <label for="owner_newspaper"></label><br>
                  <div class="icheck-primary d-inline">

                  </div>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12 text-right">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-right">
              <a class="btn btn-primary submit-button btn-sm m-0 " ><i class="fa fa-save"></i> Submit </a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
@endsection
@section('custom_js')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="https://rsmbl.github.io/Resemble.js/resemble.js"></script>
<script src="{{ url('/js/billing') }}/ODMediaBilling.js"></script>
<script type="text/javascript">

  function convertImgToBase64(url, callback, outputFormat) {
    var canvas = document.createElement('CANVAS'),
    ctx = canvas.getContext('2d'),
    img = new Image;
    img.crossOrigin = 'Anonymous';
    img.onload = function() {
      var dataURL;
      canvas.height = img.height;
      canvas.width = img.width;
      ctx.drawImage(img, 0, 0);
      dataURL = canvas.toDataURL(outputFormat);
      callback.call(this, dataURL);
      canvas = null;
    };
    img.src = url;
  }

  function encodeImageFileAsURL(element) {
    $('#alert_img_msg').hide();
    function onComplete(data) {
      var time = Date.now();
      var diffImage = new Image();
      diffImage.src = data.getImageDataUrl();

      $("#image-diff").html(diffImage);

      $(diffImage).click(function() {
        var w = window.open("about:blank", "_blank");
        var html = w.document.documentElement;
        var body = w.document.body;

        html.style.margin = 0;
        html.style.padding = 0;
        body.style.margin = 0;
        body.style.padding = 0;

        var img = w.document.createElement("img");
        img.src = diffImage.src;
        img.alt = "image diff";
        img.style.maxWidth = "100%";
        img.addEventListener("click", function() {
          this.style.maxWidth =
          this.style.maxWidth === "100%" ? "" : "100%";
        });
        body.appendChild(img);
      });

      console.log(data.misMatchPercentage);
      if (data.misMatchPercentage == 0) {
                //$("#thesame").show();
                $('#ImageMatchPercentage').val("100");
                $('#alert_img_compare').show();
                $('#alert_img_compare').removeClass('alert-danger');                
                $('#alert_img_compare').addClass('alert-success');                
                $('#alert_img_compare').text("Both image are same");

                $("#diff-results").show();
              } else {
               $('#ImageMatchPercentage').val(data.misMatchPercentage);
               $('#alert_img_compare').show();
               $('#alert_img_compare').addClass('alert-danger');                
               $('#alert_img_compare').removeClass('alert-success');   
               $('#alert_img_compare').text("The second image is "+data.misMatchPercentage+"% different compared to the first.");
               $("#mismatch").text(data.misMatchPercentage);
               if (!data.isSameDimensions) {
                $("#differentdimensions").show();
              } else {
                $("#differentdimensions").hide();
              }
              $("#diff-results").show();

            }
          }


          var file = element.files[0];
          var filePath1 = $("#img1").val();
          var filePath1_name = $("#img1_name").val();
          if(filePath1_name == "")
          {
            $('#alert_img_msg').show();
          }
          else
          {
            $('#alert_img_msg').hide();
            var filePath2 = URL.createObjectURL(file);
            console.log(filePath1);
            console.log(filePath2);
            var img1 = filePath1,
            img2 = filePath2;
            convertImgToBase64(img1, function(base64Img1) {
              convertImgToBase64(img2, function(base64Img2) {
                if (base64Img1 == base64Img2) {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("same");
                } else {
                  if (base64Img2) {
                    resembleControl = resemble(img1)
                    .compareTo(base64Img2)
                    .onComplete(onComplete);
                  }
                  console.log("diff");
                }

              });
            });
          }

        }
      </script>
      <script>


  //  next and previous function for save 

  $('.alert-success').hide();
  $('.alert-danger').hide();

  function SaveData() {

    var formData = new FormData($('#ODMediaBillingFrm')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('ODMediaBilling.store')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.success == true) {
          $('.alert-success').fadeIn().html(data.message);
          setTimeout(function() {
            $('.alert-success').fadeOut("slow");
            window.location.reload();
          }, 5000);

        }
        if (data.success == false) {
          $('.alert-danger').fadeIn().html(data.message);
          setTimeout(function() {
            $('.alert-danger').fadeOut("slow");
          }, 5000);
        }
      },
      error: function(error) {

        console.log('error');
        //window.location.reload();
      }
    });


  }

</script>


<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    //var dateFormat = "mm/dd/yy",
    from = $( "#bill_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    })
    $('#bill_date').click(function() {
      $('#bill_date').datepicker("show");
    });
  } );
</script>
<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#publication_date" )
    .datepicker({
      //defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1,
      showOn: "button",
      buttonImage: CURL+"/img/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      dateFormat: 'dd-mm-yy',
    });
    $('#publication_date').click(function() {
      $('#publication_date').datepicker("show");
    });
  } );
</script>


<script>

 ////////////// file upload size  512kb ////////////////
 $(document).ready(function() {

  $(".custom-file-input").change(function() {
    var id = $(this).attr("id");
    id.slice(1);
      // console.log(id);
      var file = this.files[0].name;
      var totalBytes = this.files[0].size;
      var sizemb = (totalBytes / (1024*1024));
      var ext = file.split('.').pop();
      if ((file!= "" && sizemb <= 2)){
        $("#" + id + 2).empty();
        $("#" + id + 2).text(file);
        $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");

        $("#" + id + 1).hide();

      } else {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 1).text('File size should be 2MB');
        $("#" + id + 1).show();
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + "-error").addClass("hide-msg");
      }
    });

});


 function uploadFile(i, thiss) {
  var file = thiss.files[0].name;
  var totalBytes =  thiss.files[0].size;
  var sizemb = (totalBytes / (1024*1024));
    // console.log('totalBytes',totalBytes);
    console.log('sizemb',sizemb);
     // console.log('file',file);
     var ext = file.split('.').pop();

    // if ((sizemb <= 2) && (ext == "jpeg" || ext == "jpg" || ext == "png")) 
    if ((file!= "" && sizemb <= 2)) 
    {
      console.log("if");
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } 
    else 
    {
      console.log("hello");
      $("#upload_doc" + i).val('');
      $("#choose_file" + i).text(file);
      $("#upload_doc_error" + i).text('File size should be 2MB');
      $("#upload_doc_error" + i).show();
      $("#upload_file" + i).html("Upload").addClass("input-group-text");
      $("#upload_doc" + i + "-error").addClass("hide-msg");
    }
  }

  $('.diffdatemsgLabel').removeClass('alert-info-msg');
  $("#publication_date").change(function () {
    var bpublication_date=$('#publication_date').val();
    var cpublishedDate = "<?php  echo date('d-m-Y', strtotime($_GET["cpublishedDate"])); ?>";
    if(bpublication_date != cpublishedDate){
      var diffdatemsg='Compliance Publish date and Billing Publish date are different.';
      $('.diffdatemsgLabel').addClass('alert-info-msg');
      $('.diffdatemsgLabel').text(diffdatemsg);

    }
    else{
      var diffdatemsg='';
      $('.diffdatemsgLabel').removeClass('alert-info-msg');
      $('.diffdatemsgLabel').text(diffdatemsg);
    }

  });

  $("#advtLen,#advtWidth").keyup(function () {
    var btotal=$('#advtLen').val() * $('#advtWidth').val()
    var creativeTotoal = "<?php  echo $_GET["totaladvtSize"]; ?>";
    $('#diff').val(Math.abs(btotal-creativeTotoal) );

  });

</script>
<script >
  function checksum(g){
  
    let regTest = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/.test(g)

    if(regTest){
      var gstMsg='GST No. is valid format';
       $('.gstvalidationMsg').removeClass('alert-info-msg2');
      $('.gstvalidationMsg').addClass('alert-info-msg');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("<i class='fa fa-check' aria-hidden='true'></i>");
      return true;
     //  let a=65,b=55,c=36;
     //  return Array['from'](g).reduce((i,j,k,g)=>{ 
     //   p=(p=(j.charCodeAt(0)<a?parseInt(j):j.charCodeAt(0)-b)*(k%2+1))>c?1+(p-c):p;
     //   return k<14?i+p:j==((c=(c-(i%c)))<10?c:String.fromCharCode(c+b));
     // },0); 
    }else{
      var gstMsg='Enter Valid format GST No. like(18AABCU9603R1ZM)';
      $('.gstvalidationMsg').removeClass('alert-info-msg');
      $('.gstvalidationMsg').addClass('alert-info-msg2');
      $('.gstvalidationMsg').text(gstMsg);
      $('.validcheck').html("");
      return false;

    }
    
}

</script>

<style type="text/css">
  .multiselect-container {
    overflow-x: scroll;
    height: 400px;
  }

  .multiselect-container>li>a>label {
    height: auto;
  }

  .alert-info-msg2 {
    font-size: 80%;
    color: #ef1721;
}
</style>
@endsection