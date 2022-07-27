@extends('super-admin.layouts.layout')

@section('content')
<?php $user_id = Session::get('UserID'); ?>
<div class="content-inside p-3">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-download" aria-hidden="true"></i> Generate Report</a> -->
    </div>


    <div class="row">
        <div class="col-md-6">
        <h3>Print Vendor Group Login</h3>
        </div>
    
    </div><!-- end row-->

    @endsection
   @section('custom_js')
   
    @endsection
