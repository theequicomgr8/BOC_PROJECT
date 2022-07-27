@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }

</style>
@section('content')
@php $results=isset($response)? $response:'';  @endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary"><i class="fa fa-edit"></i> Plan Estimate</h6> 
    </div>
    <!-- Card Body -->
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover order-list" id="myTable">    
          <thead>
            <tr>
              <th >S.No.</th>
              <th >MP No.</th>
              <th >Client Request Code</th>
              <!-- <th >OD Media Type</th> -->
              <th >Target Area</th>
              <th >Remark</th>
              <th >Status</th>
              <th >Action</th> 
            </tr>
          </thead>
          <tbody>
            @forelse($results as $key=>$result)
            <tr>
              <td>{{ $results->firstItem() + $key }}</td>
              <td>{{ $result->{'MP No_'} }} </td>
              <td>{{ $result->{'Client Request Code'}  }} </td>
                
              <!--Target Area -->  
              @if($result->{'Target Area'} ==0)      
              <td>{{ 'Pan India' }} </td>
              @elseif($result->{'Target Area'} ==1)
              <td> {{ 'Individual State' }} </td>
              @elseif($result->{'Target Area'} ==2)
              <td> {{ 'Group of States' }} </td>
              @elseif($result->{'Target Area'} ==3) 
              <td> {{ 'Cities' }} </td>
              @endif
              <td>{{ 'NA'}}</td>
              <!--Status -->
              @if($result->Status =="0")
              <td> {{ 'Open' }} </td>
              @elseif($result->Status =="1")
              <td> {{ 'Under Approval' }}  </td>
              @elseif($result->Status =="2")
              <td> {{ 'Approved' }} </td>
              @elseif($result->Status =="3")
              <td> {{ 'Rejected' }} </td>
              @elseif($result->Status =="4")
              <td> {{ 'Farworded' }} </td>
              @elseif($result->Status =="5")
              <td> {{ 'Finally Approved' }} </td>
              @elseif($result->Status =="6")
              <td> {{ 'Finally Reject' }} </td>
              @endif

              <td><a class="m-0 font-weight-normal text-primary" href="{{route('tvMediaPlan.show', $result->{'MP No_'} )}}"  style="font-size:15px;"   class="editMember" >View</a> </td>



            </tr>
            @empty
            <tr style="text-align: center; color: red;"><td colspan="8" >No Data</td></tr>
            @endforelse
          </tbody>
        </table>

      </div>
      <div class="d-block" style="width:100%; float: left;">
        <span class="float-right"> 
          {{$results->links('pagination::bootstrap-4')}}
        </span> 
      </div>
    </div>
  </div>

</div>

@endsection
