@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }

</style>
@section('content')
@php 
$results=isset($response)? $response:'';
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0">
        <i class="fa fa-user"></i>Bill List 
        <!-- <a style="font-size: 14px;" class="m-0 text-primary float-right" href="{{route('dailycompliance.create')}}"  id="addnew" /> 
        <i class="fa fa-user-plus"></i> Click to Add New Daily Compliance </a> -->
      </h6> 
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="card-body p-2">
         <!--  <form name ="ODBsearch" id="ODBsearch" method="GET" enctype="multipart/form-data" action="{{Route('ODMediaBilling.index')}}" >
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Media Type</label>
                  <select name="odmediaType" id="odmediaType" class="form-control form-control-sm">
                  <option value="">Select Media Type</option>
                  <option value="0" {{ $odmediaType == "0" ? "selected" :""}}>Personal Media(PMC)</option>
                  <option value="1" {{ $odmediaType == "1" ? "selected" :""}}>Private Media</option>
                  <option value="2" {{ $odmediaType == "2" ? "selected" :""}}>Sole Right</option>
                  
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
         </form> -->
     </div>
     <div class="table-responsive">
      <table style="" class="table table-striped table-bordered table-hover order-list" id="myTable">

        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Reference No.</th>
            <th scope="col">RO Code</th>
            <th scope="col">Agency Code</th>
            <th scope="col">OD Media Caegory</th>
            <th scope="col">Agency Name</th>
            <th scope="col">Language</th>
            <th scope="col">State</th>
            <th scope="col">Published On</th>
            <th scope="col">Remarks</th>
            <th scope="col" >Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($results as $key=>$result)
          <tr>
            <td>{{$results->firstItem() + $key}}</td>
            <td>{{$result->ReferenceNo }}</td>
            <td>{{$result->{'RO No_'} }}</td>
            <td>{{$result->{'Agency Code'} }} </td>
            @if($result->ODMediaType ==0)   
             <td> {{ 'Sole Right Media' }} </td> 
            @elseif($result->ODMediaType ==1)
             <td>{{ 'Personal Media' }} </td>
            @elseif($result->ODMediaType ==2)
            <td> {{ 'Private Media' }} </td>
            @endif 
             <td>{{$result->{'Agency Name'} }} </td>
            <td>{{$result->Language}} </td>
            <td>{{$result->{'State Name'} }} </td>
            <td>{{date('Y-m-d', strtotime($result->{'Publishing Start Date'}))}} </td>
            <td>{{$result->{'Remarks'} }} </td>

            @if($result->{'Billing Status'}=="1")
            <td> Bill Submitted </td>
           @else
          
            <td  style="width: 150px"align="center"><a class="m-0 font-weight-normal text-primary" href="{{route('ODMediaBilling.create', ['NPCode'=>@$result->{'Agency Code'},'ROCode'=>@$result->{'RO No_'}, 'CrativeFileName'=>@$result->{'Creative File Name'},'givenAmount'=>@round(@$result->{'Amount'}),'totaladvtSize'=>@round(@$result->{'advtSize'}),'cpublishedDate'=>date('Y-m-d', strtotime(@$result->{'Publishing Start Date'}))] )}}"  class="editMember" >
             <i class="fa fa-user-plus"></i> Submit Bill</a> </td>
              @endif
            
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
