@extends('admin.layouts.layout')

@section('content')
<?php 
$user_id = Session::get('UserID'); 
$today = date('Y-m-d');
// dd($today);
?>

<div class="content-inside p-3">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
                {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Soleright</h1>
                </div> --}}
                <div class="row">
                    <div class="col-xl-12">
                        @if(Session::has('od_message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{Session::get('od_message') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <!--<div class="col-xl-6">
                        <h4>List of empanelment form</h4> 
                    </div> -->
                    <!--  persolan-existing-form -->  <!-- rate-settlement-personal-media -->
                    <div class="col-xl-6">
                        <h5><i class="fa fa-list-ol" aria-hidden="true"></i> Empanelled Media List</h5>
                    </div>
                    
                    @if(@$vendor[0]->Modification==1)
                    <div class="col-xl-6">
                        <a href="/persolan-existing-form" class="btn btn-info" style="float: right;">Add New Empanelment</a>
                    </div>
                    @else
                    <div class="col-xl-6">
                        <a href="/rate-settlement-personal-media" class="btn btn-info" style="float: right;">Add New Empanelment</a>
                    </div>
                    @endif
                    
                    <div class="col-xl-6">
                        @if(Session::has('UserID'))
                        <a href="{{ url('outdoorpersonalmediaPdf') }}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download Reports</a>
                        @endif
                    </div>
                    
                    
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <table class="table table-striped text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Reference</th>
                                    <th>Email</th>
                                    <th>Sub category</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                    <th>Agreement</th>
                                </tr>
                            </thead>
                            @php
                                
                            @endphp
                            <tbody>
                                @foreach ($vendor as $key => $vendors )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            {{ $vendors->media_id }}
                                        </td>
                                        <td>
                                            {{ $vendors->ho_email }}
                                            {{-- @if (@$vendors->category==0)
                                                {{ 'Airport' }}
                                            @elseif(@$vendors->category==1)
                                                {{ 'Railway' }}
                                            @elseif(@$vendors->category==2)
                                                {{ 'Road side' }}
                                            @elseif(@$vendors->category==3)
                                                {{ 'Moving Media' }}
                                            @elseif(@$vendors->category==4)
                                                {{ 'Public utility' }}
                                            @endif --}}
                                            {{-- <a href="#" cat-id="{{ $vendors->media_id }}" class="text-info cat-modal" data-toggle="modal" data-target="#myModal">View</a> --}}
                                        </td>
                                        <td>
                                            {{-- {{ $vendors->sub_category }} --}}
                                            <!-- {{-- {{ $vendors->{'name'} }} --}} -->
                                            <a href="#" sub-cat-id="{{ $vendors->media_id }}" class="text-info sub-modal" id="" data-toggle="modal" data-target="#myModal2">View</a></td> 
                                        <td>
                                            {{ $vendors->mobile }}
                                        </td>
                                        <td>
                                            <a href="rate-settlement-personal-media/{{ $vendors->media_id }}" style="text-decoration: none;color: blue;" id="view"><i class="fa fa-eye" style="font-size:30px;color:blue"></i></a>
                                            
                                        </td>
                                        <!-- <td>
                                             @if($vendors->to_date >=$today)
                                                {{'Active'}}
                                            @else
                                            <a href="personal-renewal/{{ $vendors->media_id }}" style="text-decoration: none;color: blue;">Renewal </a>
                                            @endif
                                        </td> -->

                                        @if(@$vendors->renewal_license_to=='')
                                        <td>
                                            @if($vendors->to_date >=$today)
                                            {{'Active'}}
                                            @else
                                            <a href="personal-renewal/{{ $vendors->vendor_code }}" class="text-info">Renewal </a>
                                            @endif
                                        </td>
                                        @else
                                        <td>
                                            @if(@$vendors->renewal_license_to >=$today)
                                            {{'Active'}}
                                            @else
                                            <a href="personal-renewal/{{ $vendors->vendor_code }}" class="text-info">Renewal </a>
                                            @endif
                                        </td>
                                        @endif

                                        <td>
                                            <a href="personal-fileupload/{{ $vendors->media_id }}" style="text-decoration: none;color: blue;">Agreement</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
</div>

<!-- modal for category -->
<div class="container">
    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Show Category</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" id="model-cat">
                <h3 id="showcat"></h3>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>
</div>

<!-- modal for sub category -->
<div class="container">
    <div class="modal" id="myModal2">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Sub Category</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" id="model-sub">
              <h3 id="showsub"></h3>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>
</div>


<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    $(document).ready(function(){
        $(document).on("click",".sub-modal",function(){
            var cat_id=$(this).attr('sub-cat-id');
            $.ajax({
                url : '/personal-show-subcategory',
                type: 'GET',
                data:{cat_id:cat_id},
                success:function(data)
                {
                    // console.log(data.lenght);
                    // var data_val=$.parseJSON(data);
                    // console.log(data.result.length);
                    // var i;
                    // var html='';
                    // for(i=0;i<data.result.length;i++)
                    // {
                    //     html+="<h3 id='showsub'>"+data.result+"</h3>";
                    // }
                    $("#model-sub").html("<h6 id='showsub'>"+data+"</h6>");
                }
            });
        });
    });



    $(document).ready(function(){
        function in_array(needle, haystack)
        {
            for(var key in haystack)
            {
                if(needle === haystack[key])
                {
                    return true;
                }
            }

            return false;
        }
        $(document).on("click",".cat-modal",function(){
            var cat_id=$(this).attr('cat-id');
            $.ajax({
                url : '/show-category',
                type: 'GET',
                data:{cat_id:cat_id},
                success:function(data)
                {
                    // console.log(data.result.length);
                    console.log(jQuery.type(data.result));
                    var ary=[];
                    ary.push(data.result);
                    console.log(ary);
                    if(in_array('0',ary[0]))
                    {
                        // $("#showcat").append('Airport ');
                        console.log('Airport');
                    }
                    else if(in_array('1',ary[0]))
                    {
                        // $("#showcat").append('Railway Station');
                        console.log('Railway Station');
                    } 
                    else if(in_array('2',ary[0]))
                    {
                        // $("#showcat").append('Railway Station');
                        console.log('Road side');
                    }
                    else if(in_array('3',ary[0]))
                    {
                        // $("#showcat").append('Railway Station');
                        console.log('Moving Media');
                    } 
                    else if(in_array('4',ary[0]))
                    {
                        // $("#showcat").append('Railway Station');
                        console.log('Public utility');
                    }                  

                    $("#model-cat").html("<h6 id='showcat'>"+data.result+"</h6>");
                }
            });
        });
    });
</script>
@endsection
