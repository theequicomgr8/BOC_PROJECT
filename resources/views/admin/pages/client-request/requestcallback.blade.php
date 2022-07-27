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
@php

@endphp
<div class="content-inside p-3">
  <div class="" id="plzWait"><i class="" id="formloader"></i></div>
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> {{__('Request a call-back')}}</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div style="display: none;" align="center" class="alert alert-success"></div>
      <div style="display: none;" align="center" class="alert alert-danger"></div>
      <form method="POST" class="client_request_callback" id="client_request_callback" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
          <div class="tab-pane content pt-3 mcontenttab show active" id="BasicInformation-tab" role="tabpanel" aria-labelledby="BasicInformation-tab">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Name<span style="color:red">*</span></label>
                  <input  type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name" onkeypress="return onlyAlphabets(event,this)" maxlength="20"  value="">
                  <span id="first_owner_name" style="color:red;display:none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Email<span style="color:red">*</span></label>
                  <input  type="text"  class="form-control form-control-sm" name="email" id="email" placeholder="Enter Email" value="" >
                  <span id="first_email" style="color:red;display:none;"></span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Mobile No./मोबाइल नंबर<span style="color:red">*</span></label>
                  <input  type="text" class="form-control form-control-sm" name="mobile" placeholder="Enter Mobile No." onkeypress="return onlyNumberKey(event)" maxlength="10" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Issue<span style="color:red">*</span></label>
                  <textarea  name="issue" id="issue" placeholder="Enter Issue" rows="2" cols="50" class="form-control form-control-sm"></textarea>
                  <span id="first_mobile" style="color:red;display:none;"></span>
                </div>
              </div>
            </div>
              <div class="col-sm-6">
                <div class="form-group clearfix"><label for="owner_newspaper"></label><br>
                  <div class="icheck-primary d-inline"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 text-right">
              <a class="btn btn-primary client-next-button btn-sm m-0 loader" id="btntab">Submit</a>
              <input type="hidden" name="submit" value="" id="submit">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('custom_js')

<script>
  
  //  next and previous function for save 
  $('.alert-success').hide();
  $('.alert-danger').hide();

  function sendMailForCallBack(tab = '') {

    var formData = new FormData($('#client_request_callback')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "{{Route('client.MailForCallBack')}}",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        if (data.success == 'true') {
          var $message = tab + 'Mail sent successfully';
          $("#app").scrollTop(0);
          $('#formloader').removeClass('fa fa-refresh fa-spin fa-3x fa-fw');
          $('#plzWait').removeClass('plz-wait');
          $('#btntab').removeClass('fa fa-circle-o-notch fa-spin fa-fw');
            $('.alert-success').fadeIn().html($message);
            setTimeout(function() {
              $('.alert-success').fadeOut("slow");
             
            }, 3000);
            
            
            document.location.href = "{{URL::to('dashboard')}}";            
        } else if (data.success == 'false') {
          var $message = tab + ' Mail not sent, server issue';
          $("#app").scrollTop(0);
          $('#formloader').removeClass('fa fa-refresh fa-spin fa-3x fa-fw');
          $('#plzWait').removeClass('plz-wait');
          $('#btntab').removeClass('fa fa-circle-o-notch fa-spin fa-fw');
          $('.alert-danger').fadeIn().html($message);
          setTimeout(function() {
            $('.alert-danger').fadeOut("slow");
          }, 2000);
        }
      },
      error: function(error) {
        console.log('error');
      }
    });
  }


$(document).ready(function(){
  $(".client-next-button").click(function(){
    var form = $("#client_request_callback");      
    form.validate({
      rules: {   
        name: {required:true},
        mobile: {required:true},
        email: { required: true, emailExt: true, maxlength: 40 },
        issue: {required:true },                          
      },
      messages: {      
        name: { required:"Please fill required field!"},
        mobile: { required:"Please fill required field!"},
        email: { required: "Please fill required field!", email: "Please enter a vaild email address!" },
        issue: {required:"Please fill required field!" }, 
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
     sendMailForCallBack();
    }else{
      
    }

  });  
   jQuery.validator.addMethod("emailExt", function (value, element, param) {
    return value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
  }, 'Please enter a vaild email address');
});

    
  
</script>

@endsection