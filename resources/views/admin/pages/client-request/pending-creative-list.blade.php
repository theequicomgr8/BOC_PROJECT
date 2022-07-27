@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }
  .ui-datepicker-trigger{
    width: 25;
    height: 25;
    float: right;
    margin-top: -28px;
    margin-right: 4px;
  }
  .table-bordered td, .table-bordered th {
    font-size: 12px !important;
    padding: 10px 7px !important;
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
        <i class="fa fa-user"></i> Pending Creative List
      </h6> 
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="card-body p-2">
        <form name ="wingsTypesearch" id="wingsTypesearch" method="GET" enctype="multipart/form-data" action="{{url('client-pending-creative-list')}}" >
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label">Media Category</label>
                <select name="wingType" id="wingType" class="form-control form-control-sm">
                  <!-- <option value=""> Select Wing Type</option> -->
                  <option value="1" {{ @$wingType == "1" ? "selected" :""}}>Print</option>
                  <option value="2" {{ @$wingType == "2" ? "selected" :""}}>Outdoor</option>
                  <option value="3" {{ @$wingType == "3" ? "selected" :""}}>AV-TV</option>
                  <option value="4" {{ @$wingType == "4" ? "selected" :""}}>AV-Radio</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="form-control-label">&nbsp;</label>
                <input type="submit" value="Search" class="btn btn-block btn-primary btn-sm" >
              </div>
            </div>
          </div>
        </form>
       <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover order-list" id="myTable">   
          <thead>
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Client Request No.</th>
              <th scope="col">Budget</th>
              <th scope="col">From Date</th>
              <th scope="col">To Date</th>
              <th scope="col">Pending Creative</th>
              
            </tr>
          </thead>
          <tbody>
            @forelse($results as $key=>$result) 
            <tr>
              <td>{{$results->firstItem() + $key}}</td>
               <td><a class="m-0 font-weight-normal text-primary" href="{{url('client-submission-form/'.$result->CRHID)}}"  class="editMember" title="Media Request View" >{{ @$result->CRHID? @$result->CRHID:'NA' }}</a></td>
                <td>{{$result->budgetAmount? number_format($result->budgetAmount) :0}}</td>
                 <td>{{ date('d/m/Y', strtotime($result->FromDate))? date('d/m/Y', strtotime($result->FromDate)):'NA' }} </td>
                <td>{{ date('d/m/Y', strtotime($result->ToDate)) ? date('d/m/Y', strtotime($result->ToDate)):'NA' }} </td>
              <td>
                @php 
                $aValues = array(
                'clrno'=>@$result->CRHID,
                'PrintCreativeAvailable'=>@$result->PrintCreativeAvailable,
                'ODCreativeAvailable'=>@$result->ODCreativeAvailable,
                'TVCreativeAvailable'=>@$result->TVCreativeAvailable,
                'RadioCreativeAvailable'=>@$result->RadioCreativeAvailable,
                'Print'=>@$result->Print,
                'Outdoor'=>@$result->Outdoor,
                'AVTV'=>@$result->AVTV,
                'AVRadio'=>@$result->AVRadio
                );

                @endphp
                <a class="m-0 font-weight-normal text-primary" href="{{route('client.uploadpendingcreativeform', $aValues )}}"  class="uploadcreative" title="Upload Creative">Upload</a>
              </td>
            </tr>
            @empty
            <tr style="text-align: center; color: red;"><td colspan="6" >No Data</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="d-block" style="width:100%; float: left;">
        <span class="float-right"> 
          {{$results->withQueryString()->links('pagination::bootstrap-4')}}
        </span> 
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')


@endsection