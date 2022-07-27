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
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Daily Compliance Report</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" class="complianceFrm" id="complianceFrm" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div id="logins-part" class="tab-pane active show">
            <div id="logins-part" class="content pt-3" role="tabpanel" aria-labelledby="logins-part-trigger">
              <div class="row">
                <div class="col-md-12" align="center"><span id="compliance" style="color:red"></span></div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">RO Code/आरओ कोड<font color="red">*</font></label>
                    <select id="rocode" name="rocode" class="form-control form-control-sm">
                      <option value="" selected="selected"> Please Select </option>
                      @foreach(@$rocodedata AS $rcode)
                      <option value="{{$rcode->rocode}}"> {{$rcode->rocode}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Newspaper Code/समाचार पत्र संहिता <font color="red">*</font></label>

                   <input type="text" maxlength="20" class="form-control form-control-sm" name="npcode" id="npcode" value="{{session()->get('UserName')}}" readonly >
                    <span id="first_owner_name" style="color:red;display:none;"></span>
                  </div>
                </div>
                <div class="col-md-4" id="npnamediv">
                  <div class="form-group">
                    <label class="form-control-label">Newspaper/समाचार पत्र</label>
                    <input type="text" maxlength="20" class="form-control form-control-sm" name="npname" id="npname" readonly>

                  </div>
                </div>
                <div class="col-md-4" id="languagediv">
                  <div class="form-group">
                    <label class="form-control-label">Language/भाषा</label>
                    <input type="text" class="form-control form-control-sm" id="language" name="language" readonly>

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4" id="periodicitydiv">
                  <div class="form-group">
                    <label class="form-control-label">Periodicity/आवधिकता</label>
                    <input type="text" name="periodicity" id="periodicity" class="form-control form-control-sm" readonly>

                  </div>
                </div>
                <div class="col-md-4" id="publication_placediv">
                  <div class="form-group">
                    <label class="form-control-label">Publication Place/प्रकाशन स्थान </label>
                    <input type="text" name="publication_place" id="publication_place" class="form-control form-control-sm" readonly>
                  </div>
                </div>
                <div class="col-md-4" id="statediv">
                  <div class="form-group">
                    <label class="form-control-label">State/राज्य</label>
                    <input type="text" class="form-control form-control-sm" maxlength="40" name="state" id="state" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                
                <div class="col-md-4" id="published_datediv">
                  <div class="form-group">
                    <label class="form-control-label">Published on/पर प्रकाशित<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="published_date" id="published_date" placeholder="DD/MM/YYYY" autocomplete="off" onkeydown="return false" >
                    <span id="date_error" style="color:red;display: none;"></span>
                    <input type="hidden" id="publishing_from_date" name="publishing_from_date">
                    <input type="hidden" id="publishing_to_date" name="publishing_to_date">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label"> Published on Page No./पेज नंबर पर प्रकाशित<font color="red">*</font></label>
                    <input type="text" class="form-control form-control-sm" name="published_pageno"  placeholder="Enter Published on Page No."  id="published_pageno" onkeypress="return onlyDotNumberKey(event)" maxlength="5">
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
                <div class="col-md-4" id="upload_creative12">
                  <div class="form-group">
                    <label class="form-control-label">Upload File/दस्तावेज अपलोड करें<font color="red">*</font></label>
                    <div class="input-group" style="width: 130%;">
                      <div class="custom-file">
                        <input type="file" accept="application/pdf" class="custom-file-doc form-control form-control-sm" name="print_upload_creative_fileName" id="upload_doc_0" data="0" onchange="return uploadFile(0,this)">
                        <label class="custom-file-label" for="upload_doc_0" id="choose_file0">Choose file</label>
                        <input type="hidden" name="print_upload_creative_fileName_img" id="print_upload_creative_fileName_img" >
                        <span class="set-img"></span>
                      </div>

                      <div class="input-group-append">
                        <span class="input-group-text" id="upload_file0">Upload</span>
                      </div>

                      <span id="upload_doc_error0" class="error invalid-feedback"></span>
                    </div>
                  </div>
                </div>
                <!--end div upload file end-->
             @include('admin.pages.pdf-canvas')
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
              <a class="btn btn-primary submit-button btn-sm m-0 " id="submit_btn"><i class="fa fa-save"></i> Submit </a>
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
<script src="{{ url('/js/dailycompliance') }}/dailycompliance.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  $('#npnamediv').hide();
  $('#languagediv').hide();
  $('#periodicitydiv').hide();
  $('#publication_placediv').hide();
  $('#statediv').hide();
  $('#published_datediv').hide();
  
  $('#rocode').change(function() {
    var npcode = $('#rocode').val();
    if (rocode == "" || rocode == null) {
      $('#npnamediv').hide();
      $('#languagediv').hide();
      $('#periodicitydiv').hide();
      $('#publication_placediv').hide();
      $('#statediv').hide();
      $('#published_datediv').hide();
    } else {
      $('#npnamediv').show();
      $('#languagediv').show();
      $('#periodicitydiv').show();
      $('#publication_placediv').show();
      $('#statediv').show();
      $('#published_datediv').show();
    }


  });

  function titleCase(string) {
    return string[0].toUpperCase() + string.slice(1).toLowerCase();
  }
  //  next and previous function for save

  $('.alert-success').hide();
  $('.alert-danger').hide();

  function SaveData() {

    var formData = new FormData($('#complianceFrm')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('dailycompliance.store')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        swal("Success","Data Save Successfully","success").then(function () {
          window.location.reload();
        }); 
      },
      error: function(data) {
       swal("Error",'Server Issue',"error").then(function () {
          //window.location = "{{ Route('client.uploadpendingcreativeform') }}";
          window.location.href
        }); 
      },
    });


  }
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
</script>
<script type="text/javascript">
  // get district based on state by ajax call
  $(document).ready(function() {
    $("#rocode").change(function() {
      $( "#published_date" ).datepicker( "option", $.datepicker.regional[ 'fr' ] );
      if ($(this).val() != '') {
        var code1 = $(this).val();
        var code=code1.split("/");
        var selectlabel = 'Select';
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'nplist' + '/' + code,

          success: function(response='') {
            $('#npname').val(response.npname);
            $('#language').val(response.Language);
            $('#periodicity').val(response.periodicityname);
            $('#publication_place').val(response.publication_place);
            $('#state').val(response.statename);
            $('#published_date').val('');
            var totalDCount1=0;
            var pubdate=formatDate(response.compliacePublishedDate)
            var currentDate=formatDate(new Date());
            var cdatecount= new Date().getDate();
            var pdatecount= new Date(response.compliacePublishedDate).getDate();
            totalDCount1=Math.abs((cdatecount-pdatecount));
            console.log('cdatecount',cdatecount);
            
            console.log('pdatecount',pdatecount);
            var dt='';
            if(pubdate!='01/01/1753'){
              var dt=pubdate;  
              var totalDCount=totalDCount1;
              console.log('totalDCount',totalDCount);
            }else{
              dt=currentDate;
              var totalDCount=1;
              console.log('totalDCount',totalDCount);
            }
            $( "#published_date" ).datepicker( "option", $.datepicker.regional[ 'fr' ] );
            var CURL = {!!json_encode(url('/')) !!};
            $("#published_date").datepicker("destroy");
            var dateFormat = "dd/mm/yy",
            from = $("#published_date")
            .datepicker({
              //defaultDate: "+1w",
              changeMonth: true,
              changeYear: true,
              numberOfMonths: 1,
              showOn: "button",
              buttonImage: CURL + "/img/calendar.gif",
              buttonImageOnly: true,
              buttonText: "Select date",
              dateFormat: 'dd/mm/yy',
              minDate:0,
              maxDate: '+'+totalDCount+'D',
            });
            $( "#published_date" ).datepicker("refresh");
            $('#published_date').click(function() {
              $('#published_date').datepicker("show");
            });
            $('#published_date').val(dt);
          },
        });
      }
    });
  });
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [day, month,year].join('/');
  }
</script>


<script type="text/javascript">
  $('#upload_creative').hide();
  // get district based on state by ajax call
  $(document).ready(function() {
    $("#rocode").change(function() {
      if ($(this).val() != '') {
        var np_code = $('#npcode').find(":selected").val();
        var ro_code = $('#rocode').find(":selected").val();

        var rocode1 = $(this).val();
        var rocode = rocode1.split("/");

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
          },
          type: 'GET',
          url: 'rolist' + '/' + rocode,
          success: function(response) {
            if (response.advtype == 0) {
              $('#upload_creative').hide();
            } else {
              $('#upload_creative').show();
            }

            // get rodata
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
              },
              type: 'GET',
              url: 'getrodata',
              data: {
                rocode: ro_code,
                npcode: np_code
              },
              success: function(response) {
                $("#publishing_from_date").val(response.publication_from_date);
                $("#publishing_to_date").val(response.publication_to_date);
                $("#published_pageno").val(response.page_no !=0 ? response.page_no :'');
                $("#remark").val(response.Remarks);
              }
            });
          },
        });
      }
    });
  });

  function checkPublishedDate(published_on) {

    var publishingFromDate = moment($("#publishing_from_date").val()).format('MM-DD-YYYY');
    var publishingToDate = moment($("#publishing_to_date").val()).format('MM-DD-YYYY');

    // use for published on date
    published_on = moment(published_on, "DD-MM-YYYY").format("MM-DD-YYYY");

    //use for today date
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    var Submit_date = mm + '-' + dd + '-' + yyyy;

    // use for tomorrow date
    var today1 = new Date();
    var dd1 = String(today1.getDate() + 1).padStart(2, '0');
    var mm1 = String(today1.getMonth() + 1).padStart(2, '0');
    var yyyy1 = today1.getFullYear();

    var Submit_next_day_date = mm1 + '-' + dd1 + '-' + yyyy1;
    var todayhr = today1.getHours() + ":" + today1.getMinutes();

    // check condition according of published_date
    if ((published_on >= publishingFromDate && published_on <= publishingToDate) && (Submit_date <= publishingToDate || Submit_next_day_date <= publishingToDate)) {
      $("#submit_btn").css('pointer-events', 'visible');
      $("#compliance").text('');
      if (publishingToDate == Submit_next_day_date && todayhr >= '16:00') {
        $("#compliance").text('Compliance report should be uploaded within 24 hours only till 4 PM.');
        $("#submit_btn").css('pointer-events', 'none');
      }
    } else {
      $("#compliance").text('Compliance report should be uploaded within 24 hours only till 4 PM.');
      $("#submit_btn").css('pointer-events', 'none');
    }
  }
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
      if (file != '') {
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
    var totalBytes = thiss.files[0].size;
    var sizemb = (totalBytes / (1024 * 1024));
    // console.log('totalBytes',totalBytes);
    console.log('sizemb', sizemb);
    // console.log('file',file);
    var ext = file.split('.').pop();

    // if ((sizemb <= 2) && (ext == "jpeg" || ext == "jpg" || ext == "png"))
    if ((file != "" && sizemb <= 2)) {
      console.log("if");
      $("#choose_file" + i).empty();
      $("#choose_file" + i).text(file);
      $("#upload_file" + i).html("<i class='fa fa-check' aria-hidden='true'></i>").addClass("input-group-text");
      $("#upload_doc_error" + i).hide();
    } else {
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
