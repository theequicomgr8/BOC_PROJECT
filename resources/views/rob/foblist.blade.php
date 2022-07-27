@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    <!-- <link href="{{asset('arogi/css/home_standard.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{asset('arogi/css/bootstrap.css')}}" rel="stylesheet" /> -->
    <!-- <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" /> -->
    {{-- <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" /> --}}
    <!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script> -->
    <!-- <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> Post Activity List </h6> 
    </div>
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"></h1>
              </div><!-- /.col -->
              <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
              </div> -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>
@php
$rob_name=Session::get('UserName');
$name=substr($rob_name,4,20);
$usertype=Session::get('UserType'); 
@endphp
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="row form-actions float-right">
                    @if($usertype=='3')
                    <h4 style="margin-right: 50px;"><span class="btn btn-success "><a href="/rob-form-one" style="list-style: none; color: white;">Add New</a></span></h4>
                    @endif
                </div>
                    <table class="table table-striped text-center" id="example">
                        <thead class="custom-shorting-header">
                            <tr>
                                <th>Sr.No</th>
                                <th>Name of FOB </th>
                                <th>Type of Program</th>
                                <th>Theme</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;    
                            @endphp
                            @foreach ($data as $item)
                                
                            
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->office}}</td>
                                <td>{{$item->activity_checkbox1}}</td>
                                <td>{{$item->sop_theme}}</td>
                                <td>{{$item->venue_event}}</td>
                                <td>
                                    <!-- <a href="rob-form-one/{{$item->Pk_id}}" class="btn btn-info" id="view">View</a> -->
                                    <a href="rob-form-one/{{$item->Pk_id}}" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:20px;color:blue"></i></a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</section>

<!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> -->



@endsection





