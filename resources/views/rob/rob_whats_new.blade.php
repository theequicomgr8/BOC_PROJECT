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
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> What's New  </h6> 
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
      <form method="post" id="whats_new" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Description : </label>
                <textarea name="description" class="form-control form-control-sm"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date : </label>
                <input type="date" name="post_date" class="form-control form-control-sm">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Person : </label>
                <input type="text" name="conatct_person" class="form-control form-control-sm" onkeypress="return onlyAlphabets(event)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact Number : </label>
                <input type="text" name="conatct_number" class="form-control form-control-sm" maxlength="10" onkeypress="return onlyNumberKey(event)">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Document Type : </label>
                <select class="form-control form-control-sm" name="document_type">
                  <option value="">Select Document Type</option>
                  <option>Tenders</option>
                  <option>Notices</option>
                  <option>Orders</option>
                  <option>Announcements</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Attachment : </label>
                <input type="file" name="filename" class="form-control form-control-sm">
              </div>
            </div>
            <div class="col-md-12">
              <input type="submit" id="submit" value="Post" class="btn btn-primary btn-sm float-right">
            </div>
          </div>
      </form> 
              
    </div>
    <br><br><br>


    <div class="container-fluid">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th style="width: 370px;">Description</th>
                    <th>Date</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Attachment</th>
                    <th>Document Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $list)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$list->description}}</td>
                    <td>{{date("d-m-Y", strtotime($list->post_date))}}</td>  
                    <td>{{$list->conatct_person}}</td>
                    <td>{{$list->conatct_number}}</td>
                    <td>
                      @if(@$list->filename !='')
                      <a href='{{asset("rob/$list->filename") }}' target="_blank">View</a>
                      @endif
                    </td>
                    <td>{{$list->document_type}}</td>
                    <td>
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

            var form=$("#whats_new");
            form.validate({
                rules: {
                    description : {
                        required   : true,
                    },
                    post_date : {
                        required : true,
                    },
                    contact_number : {
                        // required    : true,
                        numbersonly : true,
                    },
                    contact_person : {
                        // required   : true,
                        lettersonly: true,
                    },
                    document_type : {
                        required   : true,
                    },
                },
                messages: {
                    description : {
                        required : "This field is required",
                    },
                    post_date : {
                        required : "This field is required",
                    },
                    contact_number : {
                        // required : "This field is required",
                    },
                    contact_person : {
                        // required : "This field is required",
                    },
                    document_type : {
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
            var data =new FormData($("#whats_new")[0]);
            $.ajax({
                url: "/whats-new",
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



        //for data delete

        $(document).on("click",".delete",function(){
            swal({
              title: "Are you sure you want to delete image ?",
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
                    url : '/whats_new_delete',
                    type: 'GET',
                    data: {id:id},
                    success:function(data)
                    {
                        window.location.href = "/whats-new";
                    }
                });
              } else {
                swal("Your data is safe!");
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





