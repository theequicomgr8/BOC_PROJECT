@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
<div class="content-wrapper">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Contact Us  </h6> 
    </div>
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"></h1>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>
@php
$rob_name=Session::get('UserName');
$name=substr($rob_name,4,20);
$usertype=Session::get('UserType'); 
$url=url()->current();
$today = date('Y-m-d');
@endphp
@php

@endphp
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        
            <form method="post" action="{{Route('contactupdate')}}"  id="rob_contactus" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="getid" value="{{@$data->id}}">
                <div class="row">
                    <div class="col-md-6" style="font-size: 20px;">
                        <div class="form-group">
                            <label style="font-size: 20px;">Region : </label>
                            <input type="radio" name="usertype" class="usertype" disabled value="2" {{@$data->user_type==2 ? 'checked' : ''}} > ROB
                            <input type="radio" name="usertype" class="usertype" disabled value="3" {{@$data->user_type==3 ? 'checked' : ''}}> FOB
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Name : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="fullname" value="{{ @$data->fullname ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Designation : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="designation" value="{{ @$data->designation ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Headquarters : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="Headquarters" value="{{ @$data->Headquarters ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6" style="display: none;" id="fob_name">
                        <div class="form-group">
                            <label>FOB Name</label>
                            <select name="owner_name" class="form-control form-control-sm fob_name">
                                <option value="">Select FOB</option>
                                @foreach($fobs as $fob)
                                <option value='{{"FOB-".$fob->rob_fo}}'>{{$fob->rob_fo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Contact No. : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="contact_no" maxlength="10" value="{{ @$data->contact_no ?? '' }}" onkeypress="return onlyNumberKey(event)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">E-mail. : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="email" value="{{ @$data->email ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">State : <font color="red"></font></label>
                          <!-- <input type="text" class="form-control form-control-sm" name="state_name"> -->
                          <select name="state_name" class="form-control form-control-sm">
                              <option value="">Select State</option>
                              @foreach($states as $key => $state)
                                <option {{@$data->state_name == $state->Description ? 'selected' : '' }}>{{$state->Description}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    @if($usertype==3)
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label">ROB Name : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="rob_name">
                        </div>
                    </div> -->
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Address : <font color="red"></font></label>
                          <textarea name="rob_fob_address" class="form-control form-control-sm">{{@$data->rob_fob_address ?? ''}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Save" id="submit" class="btn btn-primary float-right">
                    </div>
                </div>

            </form>    
        </div>
    <!-- </div> -->

</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('/js') }}/validator.js"></script>
<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            jQuery.validator.addMethod("lettersonly", function(value, element) {
              return this.optional(element) || /^[a-z,' ']+$/i.test(value);
            }, "Letters only please");

            jQuery.validator.addMethod("numbersonly", function(value, element) {
              return this.optional(element) || /^[0-9]+$/i.test(value);
            }, "Numbers only please");

            var form=$("#rob_contactus");
            form.validate({
                rules: {
                    fullname : {
                        required   : true,
                        lettersonly: true,
                    },
                    Headquarters : {
                        required   : true,
                        lettersonly: true,
                    },
                    designation : {
                        required : true,
                    },
                    contact_no : {
                        required    : true,
                        numbersonly : true,
                    },
                    email : {
                        required : true,
                    },
                    state_name : {
                        required : true,
                    },
                    rob_fob_address : {
                        required : true,
                    },
                    owner_name : {
                        required : true,
                    },
                },
                messages: {
                    fullname : {
                        required : "This field is required",
                    },
                    Headquarters : {
                        required : "This field is required",
                    },
                    designation : {
                        required : "This field is required",
                    },
                    contact_no : {
                        required : "This field is required",
                    },
                    email : {
                        required : "This field is required",
                    },
                    state_name : {
                        required : "This field is required",
                    },
                    rob_fob_address : {
                        required : "This field is required",
                    },
                    owner_name : {
                        required : "This field is required",
                    },
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
                },


                submitHandler: function(form) {
                  formsave();
                }

            });
        });


        //fubmit sunction
        function formsave()
        {
            var data =new FormData($("#rob_contactus")[0]);
            $.ajax({
                url: "/contactedit",
                type:'POST',
                data: data,
                contentType:false,
                cache:false,
                processData:false,
                success: function(data) {
                    swal("Success","Data have been saved successfully","success").then(function () {
                          window.location = '/contact-us';
                    });
                }
            });
        }

        $(".usertype").click(function () 
        {
            if ($(this).is(":checked")) 
            {
                var type=$(this).val();
                if(type==2)
                {
                    $("#fob_name").hide();
                    $(".fob_name").attr('disabled',true);
                }
                else
                {
                    $("#fob_name").show();
                    $(".fob_name").attr('disabled',false);
                }
            }
        });


       function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
          return true;
          }

          
          function onlyAlphabets(e, t) {
          try {
            if (window.event) {
              var charCode = window.event.keyCode;
            }
            else if (e) {
              var charCode = e.which;
            }
            else { return true; }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 32))
              return true;
            else
              return false;
          }
          catch (err) {
            alert(err.Description);
          }
        
        } 


    });
</script>





