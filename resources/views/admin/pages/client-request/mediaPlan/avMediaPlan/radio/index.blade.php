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
      <div class="card-body p-2">
        <form name ="odmsearch" id="odmsearch" method="GET" enctype="multipart/form-data" action="{{Route('radioMediaPlan.index')}}" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label">Radio Type</label>
                <select name="radioType" id="radioType" class="form-control form-control-sm">
                <option value="">Select Radio Type</option>
                <option value="0" {{ $radioType == "0" ? "selected" :""}}>CRS</option>
                <option value="1" {{ $radioType == "1" ? "selected" :""}}>PVT FM</option>
              </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label">&nbsp;</label>
                <input type="submit" class="btn btn-block btn-primary btn-sm" >
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover order-list" id="myTable">    
          <thead>
            <tr>
              <th >S.No.</th>
              <th >MP No.</th>
              <th >Client Request Code</th>
              <th >Radio Type</th> 
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
               @if($result->RadioType ==0)      
              <td>{{ 'CRS' }} </td>
              @elseif($result->RadioType ==1)
              <td> {{ 'PVT FM' }} </td>
              @endif
              <!--Target Area -->  
              @if($result->TargetArea ==0)      
              <td>{{ 'Pan India' }} </td>
              @elseif($result->TargetArea ==1)
              <td> {{ 'Specific Regional' }} </td>
              @elseif($result->{'Target Area'} ==2)
              <td> {{ 'Group Regional' }} </td>
              @endif
               <td>{{ $result->ClientRemarks}}</td>
              <!--Status -->
             <td>{{ $result->PlanStatus}}</td>

              <td><a class="m-0 font-weight-normal text-primary" href="{{route('radioMediaPlan.show', str_replace("FM/","FM",$result->{'MP No_'}) )}}"  style="font-size:15px;"   class="editMember" >View</a> </td>



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
