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
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Banner Update  </h6> 
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
      <form method="post" action="{{Route('banneredit')}}" enctype="multipart/form-data">
        @csrf
          <table id="muform">
            <tr>
                <input type="hidden" name="getid" value="{{Request::segment(2) }}">
                <td>Banner Image : <input type="file" name="banner_name" id="banner_name" class="form-control" required accept="image/x-png,image/jpeg"></td>
            </tr>
            <tr>
                <td><img src='{{asset("rob/$data->banner_name")}}' style="width: 150px;"></td>
            </tr>
        </table>
        <input type="submit" value="save" class="btn btn-primary btn-sm float-right"> 
      </form> 
              
    </div>
    <br><br><br>
    

</section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ url('/js') }}/validator.js"></script>






