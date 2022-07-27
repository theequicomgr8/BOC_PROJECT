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
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        
            <form method="post"  id="rob_contactus" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6" style="font-size: 20px;">
                        <div class="form-group">
                            <label style="font-size: 20px;">User Type : </label>
                            <input type="radio" name="usertype" class="usertype" value="2" checked> RO
                            <input type="radio" name="usertype" class="usertype" value="3"> FO
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Name : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="fullname">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Designation : <font color="red"></font></label>
                          <!-- <input type="text" class="form-control form-control-sm" name="designation"> -->
                          <select name="designation" class="form-control form-control-sm">
                              <option>-----Select Designation-----</option>
                              <option value="1">Director</option>
                              <option value="2">Assistant Director</option>
                              <option value="3">FPO/FEO</option>
                              <option value="4">Sr. Accounts Officer</option>
                              <option value="5">Accountant</option>
                              <option value="6">Exhibition Assistant</option>
                              <option value="7">TA/FPA</option>
                              <option value="8">Producer</option>
                              <option value="9">Instructor</option>
                              <option value="10">Performer</option>
                              <option value="11">Training Assistant</option>
                              <option value="12">Projectionist</option>
                              <option value="13">UDC</option>
                              <option value="14">LDC</option>
                              <option value="15">MCC</option>
                              <option value="16">Driver</option>
                              <option value="17">MTS</option>
                          </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Headquarters : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="Headquarters">
                        </div>
                    </div> -->
                    <div class="col-md-6" style="display: none;" id="fob_name">
                        <div class="form-group">
                            <label>FO Name</label>
                            <select name="owner_name" class="form-control form-control-sm fob_name">
                                <option value="">Select FO</option>
                                @foreach($fobs as $fob)
                                <option value='{{"FOB-".$fob->rob_fo}}'>{{$fob->rob_fo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Contact No. : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="contact_no" maxlength="10" onkeypress="return onlyNumberKey(event)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">Email ID : <font color="red"></font></label>
                          <input type="text" class="form-control form-control-sm" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label">State : <font color="red"></font></label>
                          <!-- <input type="text" class="form-control form-control-sm" name="state_name"> -->
                          <select name="state_name" class="form-control form-control-sm">
                              <option value="">Select State</option>
                              @foreach($states as $key => $state)
                              <!-- @$data->state_name == $state->Description ? 'selected' : '' -->
                                <option >{{$state->Description}}</option>
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
                          <textarea name="rob_fob_address" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Save" id="submit" class="btn btn-primary btn-sm float-right">
                    </div>
                </div>

            </form>    
        </div>
    <!-- </div> -->
    <div class="container-fluid">
        <table class="table table-striped text-center " id="example">
            <thead class="custom-shorting-header">
                <tr>
                    <th>Sr.No.</th>
                    <th>RO/FO Name</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <!-- <th>Headquarters</th> -->
                    <th>Contact No. </th>
                    <th>E-mail ID</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $key => $list)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <!-- $list->owner_name -->
                        @php 
                        $value=substr($list->owner_name,0,3);
                        $value2=substr($list->owner_name,3,50);
                        if($value=='ROB')
                        {
                            $name="RO".$value2;
                        }
                        elseif($value=='FOB')
                        {
                            $name="FO".$value2;
                        }
                        @endphp
                        {{$name}}
                    </td>
                    <td>{{$list->fullname}}</td>
                    <td>
                        @if($list->designation=='1')
                            Director
                        @elseif($list->designation=='2')
                            Assistant Director
                        @elseif($list->designation=='3')
                            FPO/FEO
                        @elseif($list->designation=='4')
                            Sr. Accounts Officer
                        @elseif($list->designation=='5')
                            Accountant
                        @elseif($list->designation=='6')
                            Exhibition Assistant
                        @elseif($list->designation=='7')
                            TA/FPA
                        @elseif($list->designation=='8')
                            Producer
                        @elseif($list->designation=='9')
                            Instructor
                        @elseif($list->designation=='10')
                            Performer
                        @elseif($list->designation=='11')
                            Training Assistant
                        @elseif($list->designation=='12')
                            Projectionist
                        @elseif($list->designation=='13')
                            UDC
                        @elseif($list->designation=='14')
                            LDC
                        @elseif($list->designation=='15')
                            MCC
                        @elseif($list->designation=='16')
                            Driver
                        @elseif($list->designation=='17')
                            MTS
                        @else
                        NA
                        @endif

                    </td>
                    <!-- <td>{{$list->Headquarters}}</td> -->
                    <td>{{$list->contact_no}}</td>
                    <td>{{$list->email}}</td>
                    <td>{{$list->state_name}}</td>
                    <td>
                        <a href="/contactedit/{{$list->id}}" style="color: black;"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a  data-id="{{$list->id}}" class="delete" style="color: red;cursor: pointer;"><i class="fa fa-trash-o"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
                        // lettersonly : true,
                    },
                    contact_no : {
                        required    : true,
                        numbersonly : true,
                    },
                    email : {
                        required : true,
                        email    : true,
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
                        email    : "Valid email",
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
                url: "/contactsave",
                type:'POST',
                data: data,
                contentType:false,
                cache:false,
                processData:false,
                success: function(data) {
                    swal("Success","Data have been saved successfully","success").then(function () {
                          window.location = '{{ $url }}';
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


        //for data delete

        $(document).on("click",".delete",function(){
            swal({
              title: "Are you sure you want to delete the data ?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                // delete_data()
                var id=$(this).attr('data-id');
                $.ajax({
                    url : '/contactdelete',
                    type: 'GET',
                    data: {id:id},
                    success:function(data)
                    {
                        window.location.href = "/contact-us";
                    }
                });
              } else {
                swal("Your imaginary file is safe!");
              }
            });
            
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





