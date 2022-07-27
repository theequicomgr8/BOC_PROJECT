@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <div class="alert alert-success" style="display: none;" id="mail">
        <h6 id="mail_msg"></h6>
    </div>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> FOB TTP List </h6> 
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

$months=["01"=>"January","02"=> "February","03"=> "March","04"=> "April","05"=> "May","06"=> "June","07"=> "July","08"=> "August","09"=> "September","10"=> "October","11"=> "November","12"=> "December"];
@endphp
<section class="content">

    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- <div class="row form-actions float-right">
                    <h4 style="margin-right: 50px;"><span class="btn btn-success "><a href="/pre-active-form" style="list-style: none; color: white;">Add New</a></span></h4>
                </div> -->
                
                    <span class="btn btn-info btn-sm" id="approve" style="margin-bottom:10px;">Approve</span>
                    <form>
                        @csrf
                    <table class="table table-striped text-center" id="example">
                        <thead class="custom-shorting-header">
                            <tr>
                                <th>Sr.No.</th>
                                <th>Unique Code</th>
                                <th>Date</th>
                                <th>Name of RO/FO </th>

                                <th>Village/<br>Town</th>  
                                <th>Block</th>
                                <th>District</th>
                                <th>Distance Covered<br>(in km)</th>
                                <th>Date of Last Visit</th>
                                <th>Contact Number</th>
                                <th>Program Theme</th>
                                
                                <th>Status</th>
                                <th>Action</th>
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
                                <td>
                                    <input type="checkbox" name="getid[]" class="chk" value="{{$item->Pk_id}}">
                                {{$i}}
                                </td>
                                <td>{{$item->unique_id}}</td>
                                <td>{{date('d-m-Y',strtotime($item->duration_activity_from_date))}}</td>
                                <td>{{$item->office}}</td>
                                <td>
                                    <a href="#" vill-id="{{ $item->Pk_id }}" class="text-info village" id="" data-toggle="modal" data-target="#myModal2">View</a>
                                </td>
                                <td>{{$item->block}}</td>
                                <td>{{$item->district}}</td>
                                <td style="text-align: center;">{{$item->distance_covered}}</td>
                                <td>
                                  @if(@$item->last_visit_date!='')
                                    {{date("d-m-Y", strtotime($item->last_visit_date))}}
                                    @else
                                    {{'First Time'}}
                                  @endif
                                  <!-- $item->last_visit_date -->
                                </td>
                                <td>{{$item->contact_no}}</td>
                                <td>{{$item->sop_theme}}</td>
                                
                                <td>
                                    @if($item->approve == 1)
                                     <span style="color: green;">Approved</span>
                                    @elseif($item->approve == 0)
                                     Pending
                                    @elseif($item->approve == 2)
                                     <span style="color: red;cursor: pointer" class="rejectdata" reject-id="{{ $item->Pk_id }}" data-toggle="modal" data-target="#rejectmodel">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->approve == 1)
                                        <a href="#" data-toggle="modal" data-id="{{$item->Pk_id}}"  id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    @elseif($item->approve == 0)
                                        <a href="{{URL::to('approve-rejected/1/').'/'.$item->Pk_id}}"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>
                                            &nbsp;
                                        <a href="#" data-toggle="modal" data-id="{{$item->Pk_id}}" id="reject" data-target="#reject_modal" title="Reject" style="color:red"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{URL::to('approve-rejected/1/').'/'.$item->Pk_id}}"  title="Approve" style="color:green"><i class="fa fa-check" aria-hidden="true"></i></a>
                                    @endif
                               </td>
                               <td>
                                    <a href="rob-approve-pre-active/{{$item->Pk_id}}" style="text-decoration: none;color: blue;" id="view">View</a>
                                    
                                </td>
                                <td>
                                    @if($item->status==2)
                                    <a href="post-form/{{$item->Pk_id}}" style="text-decoration: none;color: blue;" id="view">View</a>
                                    @else
                                    Not Submit
                                    @endif
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    </form>
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


    </div>
</section>

<!-- // Reject Modal -->
<div class="container ">
     <!-- The Modal -->
  <div class="modal align-center pt-5 mt-5" id="reject_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Reason for Rejection?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <form action="#" id="reject_form" method="post">
            @csrf
        <!-- Modal body -->
        <div class="modal-body">        
            <textarea name="reject_reason" id="reject_reason" class="form-control" cols="3" rows="2"></textarea>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>
        </form>
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

<!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/datafetch.js')}}" type="text/javascript"></script> -->

<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="{{asset('arogi/js/common.js')}}" type="text/javascript"></script>

@endsection

@section('custom_js')

<script>
$(document).on("click", "#reject", function () {
     var id = $(this).data('id');
     var url  = "approve-rejected/2/"+id;
     document.getElementById("reject_form").action = url;
     
});
</script>


<script>
    $(document).ready(function(){
        $(document).on("click",".village",function(){
            var id=$(this).attr('vill-id');
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

        function year()
        {
            var year = document.getElementById("year");
            var currentYear = (new Date()).getFullYear();
            for (var i = currentYear; i >= 1990; i--) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                year.appendChild(option);
            }
        }
        year();
        //for filter
        $("#search").click(function(){
            var year=$("#year").val();
            var month=$("#month").val();
            var fob=$("#fob").val();
            var approve=$("#approve_data").val();
            $("#tbody").html('');
            $("#example_info").hide();
            $.ajax({
                url : '/robFobSearch',
                type: 'GET',
                data: {year:year,month:month,fob:fob,approve:approve},
                success:function(data)
                {
                    console.log(data);
                    $("#tbody").append(data);
                }
            });
        });


        $("#approve").on("click",function(){
            var ary=[];
            $(".chk:checked").each(function(){
                ary.push($(this).val());
            });
            $.ajax({
                url : 'multiApprove',
                type: 'GET',
                data: {id:ary},
                success:function(data)
                {
                    console.log(data);
                    $("#mail").show();
                    $("#mail_msg").html('Selected request(s) have been approved');
                }
            });
        });

        //get year 
        // window.onload = function () {
        //     var year = document.getElementById("year");
        //     var currentYear = (new Date()).getFullYear();
        //     for (var i = currentYear; i >= 1990; i--) {
        //         var option = document.createElement("OPTION");
        //         option.innerHTML = i;
        //         option.value = i;
        //         year.appendChild(option);
        //     }
        // };
    });
</script>
@endsection


