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
@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Add Daily Compliance</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" class="outdoorCompliancefrm" id="outdoorCompliancefrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Agency Code/एजेंसी कोड <font color="red">*</font></label>

                    <select  id="agencyCode" name="agencyCode" class="form-control form-control-sm">
                      <option value=""> Select </option>
                      <option>{{session('AgencyCode')}}</option>
                    </select>
                    <span id="first_owner_name" style="color:red;display:none;"></span>

                  </div>
                </div>
                <div class="col-md-4" id="agencyNameDiv">
                  <div class="form-group">
                    <label class="form-control-label">Agency Name/एजेंसी का नाम</label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="agencyname" id="agencyname"  readonly>

                  </div>
                </div>
                <div class="col-md-4" id="languagediv">
                  <div class="form-group">
                    <label class="form-control-label">Language/भाषा</label>
                    <input  type="text" class="form-control form-control-sm" id="language" name="language" readonly>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4" id="publication_placediv">
                  <div class="form-group">
                    <label class="form-control-label">Publication Place/प्रकाशन स्थान </label>
                    <input type="text"  name="publication_place" id="publication_place"  class="form-control form-control-sm" readonly>
                  </div>
                </div>
                <div class="col-md-4" id="statediv">
                  <div class="form-group">
                    <label class="form-control-label">State/राज्य</label>
                    <input  type="text" class="form-control form-control-sm" maxlength="40" name="state" id="state" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">RO Code/आरओ कोड<font color="red">*</font></label>
                    <select  id="rocode" name="rocode" class="form-control form-control-sm">
                      <option value="" selected="selected"> Select </option>
                      @foreach($rocodedata AS $rcode)
                      <option value="{{$rcode->rocode}}" > {{$rcode->rocode}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Published On/पर प्रकाशित<font color="red">*</font></label>
                    <input  type="text" class="form-control form-control-sm" name="startpublished_date" id="startpublished_date"  placeholder="DD-MM-YYYY" autocomplete="off">
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label"> Remark/टिप्पणी </label>
                    <textarea name="remark" id="remark" placeholder=" Enter Remark" rows="2" cols="50" maxlength="120" class="form-control form-control-sm"></textarea>
                    <span id="date_error" style="color:red;display: none;"></span>
                  </div>
                </div>
                <!-- start upload file-->
                <div class="col-md-4" id="upload_creative">
                  <div class="form-group">
                    <label class="form-control-label">Upload File/दस्तावेज अपलोड करें<font color="red">*</font></label>
                    <div class="input-group" style="width: 179%;">
                      <div class="custom-file">
                        <input  type="file" accept="image/png, image/jpeg, image/jpg" class="custom-file-doc form-control form-control-sm" name="print_upload_creative_fileName" id="upload_doc_0"  data="0" onchange="return uploadFile(0,this)">
                        <label class="custom-file-label" for="upload_doc_0" id="choose_file0">Choose file</label>
                      </div>
                      
                      <div class="input-group-append">
                        <span class="input-group-text" id="upload_file0">Upload/अपलोड</span>
                      </div>

                      <span id="upload_doc_error0" class="error invalid-feedback"></span>
                    </div>
                  </div>
                </div><!--end div upload file end-->
                
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
<script src="{{ url('/js/dailycompliance') }}/ODdailycompliance.js"></script>


<script>

  $('#agencyNameDiv').hide(); 
  $('#languagediv').hide();
  $('#publication_placediv').hide();
  $('#statediv').hide();
  $('#agencyCode').change(function(){
    var agencyCode = $('#agencyCode').val();
    if(agencyCode=="" || agencyCode==null){
      $('#agencyNameDiv').hide(); 
      $('#languagediv').hide();
      $('#publication_placediv').hide();
      $('#statediv').hide();
    }else{
      $('#upload_creative').hide();
      if ($(this).val() != '') {
        var code = $(this).val();
        var selectlabel='Select';
        var url ="{{Route('ODMediaCompliance.getSelectedAgencyDetail', ':code')}}";
        url = url.replace(':code', code);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url:url, 
          success: function(response) {
            $('#agencyname').val(response.agencyname);
            $('#language').val(response.Language);
            $('#publication_place').val(response.publication_place);
            $('#state').val(response.statename);

            /*$('#rocode').html('')
            $('#rocode').append('<option value="" selected>' + selectlabel + ' </option>');
            $('#rocode').append('<option value="' + response.rocode + '">' + response.rocode + ' </option>');*/
            
          },
        });
      }


      $('#agencyNameDiv').show(); 
      $('#languagediv').show();
      $('#periodicitydiv').show();
      $('#publication_placediv').show();
      $('#statediv').show();
    }
    

  });
  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  //  next and previous function for save 

  $('.alert-success').hide();
  $('.alert-danger').hide();

  function SaveData() {

    var formData = new FormData($('#outdoorCompliancefrm')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('ODMediaCompliance.store')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.success == true) {
          $("#app").scrollTop(0);
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  $( function() {
    var CURL = {!! json_encode(url('/')) !!};
    from = $( "#startpublished_date" )
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

    $('#startpublished_date').click(function() {
      $('#startpublished_date').datepicker("show");
    });

  } );
</script>
<script type="text/javascript">
  $('#upload_creative').hide();
  // get district based on state by ajax call 
  $(document).ready(function() {
    $("#rocode").change(function() {
      if ($(this).val() != '') {
        var rocode1 = $(this).val();

        var rocode = rocode1.split("/");
        ///alert(array[0]);

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'rolist'+ '/' + rocode ,

          success: function(response) {
            if(response.advtype==0){
              $('#upload_creative').hide();
            }else{
             $('#upload_creative').show();
           } 
         },
       });
      }
    });
  });

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
      var sizeKb = Math.floor(totalBytes / 1000);
      var ext = file.split('.').pop();
      if (file != '' ) {
        $("#" + id + 2).empty();
        $("#" + id + 2).text(file);
        $("#" + id + 3).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");

        $("#" + id + 1).hide();

      } else {
        $("#" + id).val('');
        $("#" + id + 2).text("Choose file");
        $("#" + id + 1).text('File size should be less than 512kb and file should be pdf!');
        $("#" + id + 1).show();
        $("#" + id + 3).html("Upload").addClass("input-group-text");
        $("#" + id + "-error").addClass("hide-msg");
      }
    });

});

 $("#previous_btn").click(function() {
  $.ajax({
    type: "GET",
    url: "{{Route('previousLogs')}}",
    dataType: "json",
    processData: false,
    contentType: false,
    success: function(data) {

    },
    error: function(error) {

      console.log('error');
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
</script>

<style type="text/css">
  .multiselect-container {
    overflow-x: scroll;
    height: 400px;
  }

  .multiselect-container>li>a>label {
    height: auto;
  }
</style>
@endsection