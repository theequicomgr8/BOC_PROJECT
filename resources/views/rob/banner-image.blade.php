@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }

    /*add css for popu*/
    /* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
<div class="content-wrapper">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Banner </h6> 
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

        @if(Session::has('update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success</strong> {{Session::get('update')}}.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif


    <!-- Small boxes (Stat box) -->
      <form method="post" action="{{Route('bannersave')}}" enctype="multipart/form-data">
        @csrf
          <table id="muform">
            <tr>
                <td>Banner Image : <br><input type="file" name="banner_name[]" id="banner_name" class="form-control" accept="image/x-png,image/jpeg" required></td>
                <td><br><button class="btn btn-info" id="add">Add More</button></td>
            </tr>
        </table>
        <input type="submit" value="Save" class="btn btn-primary btn-sm float-right"> 
      </form> 
              
    </div>
    <br><br><br>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $list)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img class="myImg" src='{{ asset("rob/$list->banner_name") }}' alt="Snow" style="width: 80px; cursor: pointer;" ></td>
                    <td>
                    <a href="/banneredit/{{$list->id}}" style="color: black;"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a  data-id="{{$list->id}}" class="delete" style="color: red;cursor: pointer;"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Trigger the Modal -->
    

    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- The Close Button -->
      <span class="close">&times;</span>

      <!-- Modal Content (The Image) -->
      <img class="modal-content" id="img01">

      <!-- Modal Caption (Image Text) -->
      <div id="caption"></div>
    </div>

</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('/js') }}/validator.js"></script>
<script>
    $(document).ready(function(){
        var i=1;
        $("#add").click(function(e){
            e.preventDefault();
            i++;
            $("#muform").append('<tr id="row'+i+'"><td>Banner Image : <input type="file" name="banner_name[]" id="banner_name" class="form-control" accept="image/x-png,image/jpeg" required></td><td><br><button class="btn btn-danger remove" id="'+i+'">Remove</button></td></tr>');
        });
        $(document).on("click",'.remove',function(e){
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();
        });



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
                    url : '/bannerdelete',
                    type: 'GET',
                    data: {id:id},
                    success:function(data)
                    {
                        window.location.href = "/rob-banner";
                    }
                });
              } else {
                swal("Your  file is safe!");
              }
            });
            
        });

       
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            // img.click = function(){
            //   // modal.style.display = "block";
            //   // modalImg.src = this.src;
            //   // captionText.innerHTML = this.alt;
              
            // }

                

                $(document).on("click",".myImg",function(){
                    modal.style.display = "block";
                      modalImg.src = this.src;
                      captionText.innerHTML = this.alt;
                });



            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }
       
        
    });


</script>





