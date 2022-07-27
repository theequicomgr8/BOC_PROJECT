@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> TTP List </h6> 
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
//dd(scandir('arogi/images'));
$rob_name=Session::get('UserName');
$name=substr($rob_name,4,20);
$usertype=Session::get('UserType'); 
if($usertype=='2')
{
    $user='ROB';
}
else
{
    $user='FOB';
}

$months=["01"=>"January","02"=> "February","03"=> "March","04"=> "April","05"=> "May","06"=> "June","07"=> "July","08"=> "August","09"=> "September","10"=> "October","11"=> "November","12"=> "December"];
//dd($data);
@endphp
<section class="content">
    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="row form-actions float-right">
                    <h4 style="margin-right: 50px;">
                    @if(count($data) > 0)
                    <span>
                            <a href="{{ url('preroblistpdf/'.Session::get('UserID')) }}" class="btn btn-info btn-sm" style="float: left;font-size: 13px; margin-right: 22px;margin-top: 6px;" download><i class="fa fa-download"></i> Download Report </a>
                        </span>
                    @endif
                        <span class="btn btn-success btn-sm">
                            <a href="/pre-active-form" style="list-style: none; color: white;">Add New</a>
                        </span>
                        
                    </h4>

                </div>
                

                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Year : </label>
                                    <select id="year" class="form-control form-control-sm" name="year">
                                        <option value="">Select Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label>Month : </label>
                                    <select class="form-control form-control-sm" name="month" id="month">
                                        <option value="">Select Month</option>
                                        @foreach($months as $key => $month)
                                            <option value="{{$key}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            

                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label></label><br>
                                    <!-- <input type="submit" class="btn btn-info" id="search" value="Search"> -->
                                    <span class="btn btn-info btm-sm" id="search" style="cursor: pointer; margin-top:3px; height:33px;padding:5px;">View</span>
                                </div>
                            </div>

                        </div>
                    </form>

                    <table class="table table-striped text-center" id="example">
                        <thead class="custom-shorting-header">
                            <tr>
                                <th>Sr.No.</th>
                                <th style="width: 100px;">Date</th>
                                <!-- <th>Name of {{$user}} </th> -->
                                <th>Village/Town</th>  
                                <th>Block</th>
                                <th>District</th>
                                <th>Distance Covered(in km)</th>
                                <th>Date of Last Visit</th>
                                <th>Contact Number</th>
                                <th>Program Theme</th>
                                <th>Status</th>
                                <th>TTP</th>
                                <th>ATP</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @php
                            $i=1;    
                            @endphp
                            @foreach ($data as $item)
                                
                            
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    @if(@$item->duration_activity_from_date!=null)
                                    {{date("d-m-Y", strtotime($item->duration_activity_from_date))}}
                                    @endif
                                </td>
                                <td>
                                    <a href="#" vill-id="{{ $item->Pk_id }}" class="text-info village" id="" data-toggle="modal" data-target="#myModal2">View</a>
                                </td>
                                <td>{{$item->block}}</td>
                                <td>{{$item->district}}</td>
                                <td>{{$item->distance_covered}}</td>
                                <td>
                                    @if(@$item->last_visit_date!='')
                                    {{date("d-m-Y", strtotime($item->last_visit_date))}}
                                    @else
                                    {{'First Time'}}
                                    @endif
                                </td>
                                <td>{{$item->contact_no}}</td>
                                <td>{{$item->sop_theme}}</td>
                                <td>
                                    @if($item->approve == 1)
                                    <span style="color: green;">Approved</span>
                                    @elseif($item->approve == 0)
                                    {{'Pending'}}
                                    @elseif($item->approve == 2)
                                    <span style="color: red;cursor: pointer" class="rejectdata" reject-id="{{ @$item->Pk_id }}" data-toggle="modal" data-target="#rejectmodel">Rejected</span>
                                    @endif
                                </td>
                                
                                <td>
                                    <!-- <a href="rob-form-one/{{$item->Pk_id}}" class="btn btn-info" id="view">View</a> -->
                                    <a href="pre-active-form/{{$item->Pk_id}}" style="text-decoration: none;color: blue;" id="view">View</a>
                                </td>
                                <td> 
                                    @if($item->duration_activity_to_date < date('Y-m-d') && $item->approve==1)
                                        @if($item->status==1)
                                        <a href="post-form/{{$item->Pk_id}}" style="text-decoration: none;color: blue;" id="view">View</a>
                                        @elseif($item->status==2)
                                        <a href="post-form/{{$item->Pk_id}}" style="text-decoration: none;color: green;" id="view">Submited</a>
                                        @else
                                        {{'NA'}}
                                        @endif
                                    @else 
                                    {{ 'NA' }}
                                    @endif
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

        <div class="container">
            <div class="modal" id="myModal2">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Village</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body" id="model-sub">
                            <h3 id="showvillage"></h3>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="modal" id="rejectmodel">
                <div class="modal-dialog">
                    <div class="modal-content">
        
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Reject Region</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
        
                        <!-- Modal body -->
                        <div class="modal-body" id="model-sub">
                            <h3 id="rejectdata"></h3>
                        </div>
        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> -->
<script src="{{asset('arogi/js/common.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $(document).on("click",".village",function(){
            var id=$(this).attr('vill-id');
            // $("#showvillage").html(id);
            $("#showvillage").html('');
            $.ajax({
                url : '/findvillage',
                type : 'GET',
                data: {id:id},
                success:function(data)
                {
                   $("#showvillage").html(data); 
                }
            });
        });

        //get reject content
        $(document).on("click",".rejectdata",function(){
            var id=$(this).attr('reject-id');
            $.ajax({
                url : '/findRejectRegion',
                type : 'GET',
                data: {id:id},
                success:function(data)
                {
                   $("#rejectdata").html(data); 
                }
            });
        });

        //search filter
        $("#search").click(function(){
            var year=$("#year").val();
            var month=$("#month").val();
            var fob=$("#fob").val();
            $("#tbody").html('');
            $("#example_info").hide();
            $.ajax({
                url : '/robSearch',
                type: 'GET',
                data: {year:year,month:month,fob:fob},
                success:function(data)
                {
                    console.log(data);
                    $("#tbody").append(data);
                }
            });
        });

        //get year 
        window.onload = function () {
            var year = document.getElementById("year");
            var currentYear = (new Date()).getFullYear();
            for (var i = currentYear; i >= 1990; i--) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                year.appendChild(option);
            }
        };


    });
</script>



@endsection





