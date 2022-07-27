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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <div class="content-header">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 text-primary"><i class="fa fa-edit"></i> All RO List </h6> 
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


@endphp
<section class="content">

    <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- <div class="row form-actions float-right">
                    <h4 style="margin-right: 50px;"><span class="btn btn-success "><a href="/pre-active-form" style="list-style: none; color: white;">Add New</a></span></h4>
                </div> -->
                
                    
                    <table class="table table-striped text-center" id="example">
                        <thead class="custom-shorting-header">
                            <tr>
                                <th>Sr.No.</th>
                                <th>RO Name</th>
                                <th>View FO's List</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php 

                            ?>
                            @foreach($data as $key => $list)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="/all-ro-record/{{$list->RobName}}" style="color: blue;">{{substr($list->RobName,4,60)}}</a></td>
                                <th><a href="/all-fo-list/{{$list->RobId}}" style="color: blue;">View</a></th>
                            </tr>
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
            // $("#showvillage").html(id);
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


        //for filter
        $("#search").click(function(){
            var year=$("#year").val();
            var month=$("#month").val();
            var fob=$("#fob").val();
            $("#tbody").html('');
            $("#example_info").hide();
            $.ajax({
                url : '/robFobSearchApprove',
                type: 'GET',
                data: {year:year,month:month,fob:fob},
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

        
    });
</script>
@endsection


