@extends('admin.layouts.layout')
@section('content')
<style>
.error{color:red;}

</style>
<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Client Profile</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row" style="height:100%"> 
                <!-- <div class="col-md-4">
                    <div class="d-inline"><img src="https://d1don5jg7yw08.cloudfront.net/200x200/profile-images/0xD9c4216cFE7c70344f80035B0bf5FBE01AA69d37_1619305985184.png" width=200px style="margin:0;"><br><p class="pl-2 mt-2"><a href="#" class="btn" style="color:#8f9096;font-weight:600">Edit Picture</a></p></div>
                </div> -->
                <div class="col-md-12">
                    @if(Session::has('message'))
                    <div class="alert alert-success" id="success-alert" align="center">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <!-- <strong>Success!</strong> -->
                    {{Session::get('message')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger" id="danger-alert" align="center">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                   <!--  <strong>Error!</strong> -->
                    {{Session::get('error')}}
                    </div>
                    @endif
                    <div class="container">
                        <form method="post" name="clientForm" id="clientForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="username" value="{{$clientdata->{'User Name'} ?? ''}}">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for=fullName>Name <font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Name" value="{{$clientdata->{'name'} ?? ''}}" maxlength="50" onkeypress="return onlyAlphabets(event,this)">
                                </div>
                                <div class="text-danger" id="nameErr"></div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for=email>E-Mail ID <font color="red">*</font></label>
                                <input type="email" class="form-control form-control-sm" id="email"  name="email" placeholder="Enter E-Mail ID" value="{{$clientdata->{'email'} ?? ''}}">
                                </div>
                                <div class="text-danger" id="emailErr"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for="mobile">Mobile No. <font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter Mobile No." value="{{$clientdata->{'Mobile No_'} ?? ''}}" onkeypress="return onlyNumberKey(event)" maxlength="10">
                                </div>
                                <div class="text-danger" id="mobileErr"></div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for=pass>Designation <font color="red">*</font></label>
                                <input type="text" class="form-control form-control-sm" id="Designation" name="Designation" placeholder="Enter Designation" value="{{$clientdata->{'Designation'} ?? ''}}" maxlength="30">
                            </div>
                            <div class="text-danger" id="DesignationErr"></div>
                            </div>
                        </div>
                            <div class="form-group ">
                                <label for=birthday>Address <font color="red">*</font></label>
                                <textarea class="form-control form-control-sm" row="4" id="Address" name="Address"  placeholder="Enter Address" maxlength="100">{{$clientdata->{'Address'} ?? ''}}</textarea>
                            </div>
                            <div class="text-danger" id="AddressErr"></div>
                            <div class="row mt-5">
                                <div class="col">
                                    <button type="button"  onclick="SaveData()" class="btn btn-primary btn-block form-control-sm " style="color:black!important">Update Profile</button>
                                </div>
                            
                            </div>

                        </form>
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>



@endsection
@section('custom_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

$(document).ready(function(){
    $("#clientForm").validate({
  rules: {
    name: {
      required: true,
    },     
    email: {
      required: true,
      email:true
    },
    mobile: {
      required: true,
      
    },
    Designation: {
      required: true,
    },
    Address:{
        required: true,
    },
  },
  //For custom messages
  messages: {
    name:{
      required: "Please enter name!",
    },
    email:{
        required: "Please enter email address!",    
    },
    mobile:{
        required: "Please enter mobile no.!",
    },
    Designation:{
        required: "Please enter designation!",
    },
    Address:{
        required: "Please enter address!",
    },

  },
  errorElement : 'div',
  errorPlacement: function(error, element) {
    var placement = $(element).data('error');
    if (placement) {
      $(placement).append(error)
    } else {
      error.insertAfter(element);
    }
  }
});
});



function SaveData() {
    var formData = new FormData($('#clientForm')[0]);
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
      },
      type: "POST",
      url: "client-profile",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function(data) {
        swal("Success","Profile has been updated successfully","success").then(function () {
          window.location.href
        }); 
      },
      error: function(data) {
       swal("Error",'Went something wrong',"error").then(function () {
          //window.location = "{{ Route('client.uploadpendingcreativeform') }}";
          window.location.href
        }); 
      },
    });
  }

</script>
@endsection

