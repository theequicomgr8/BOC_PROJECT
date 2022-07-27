@extends('admin.layouts.layout')
<style>
  body {
    color: #6c757d !important;
  }
</style>
@section('content')
@php //dd($bills);  @endphp

<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <!-- <div class="card shadow mb-4"> -->
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <div class="row">
        <div class="col-xl-6">
          <h5><i class="fa fa-user" aria-hidden="true"></i> {{$heading}} Reports</h5>
        </div>
        <div class="col-xl-6">
         @if(Session::has('UserName') && session('UserName') !='')
          <a href="{{url('dailyCompliancePrintPDF/'.session('UserName'))}}" class="btn btn-info" style="float: right;font-size: 13px;" download><i class="fa fa-download"></i> Download Reports</a>
          @endif
        </div>
      </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped text-center" id="myTable" style="font-size: 13px;border: 1px solid #cacdd3;">
          <thead>
            <tr>
              <th scope="col">S.No.</th>
             <!--  <th scope="col">Control No.</th> -->
              <th scope="col">RO Code</th>
              <th scope="col">NP Code</th>
              <th scope="col">Amount</th>
              <th scope="col">Published In</th>
              @if(@$status!=0)
              <th scope="col">Token ID</th>
              <th scope="col">Token Date</th>
              <th scope="col">Vendor Bill No.</th>
              <th scope="col">Vendor Bill Date</th>
              @endif
             <!--  <th scope="col">State</th>  -->
              <th scope="col">Published On</th>
              <th scope="col">Remarks</th>
              <!-- <th scope="col">Status</th> -->
               @if(@$status==0)
              <th scope="col">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse($bills as $key=>$result)
            <tr>
              <td>{{$key + 1}}</td>
             <!--  <td>{{$result->ReferenceNo !='' ? $result->ReferenceNo : 'NA'}}</td> -->
              <td>{{$result->{'RO No_'} }}</td>
              <td>{{$result->{'NP Code'} }}</td>
              <td>{{moneyFormatIndiainnumber($result->{'Amount'}) }} </td>
              <td>{{$result->{'bublished_in'} }}</td>
              @if(@$status!=0)
              <td>{{$result->{'Token ID'} }}</td>
               <td>{{ date('d/m/Y', strtotime($result->{'Token Date'})) }}</td>
               <td>{{ $result->{'VendorBillNo_'} }}</td>
               <td>{{ date('d/m/Y', strtotime($result->{'VendorBillDate'})) }}</td>
               
              @endif
             <!--  <td>{{$result->Language}} </td>
              <td>{{$result->{'State Name'} }} </td> -->
              <td>{{date('d/m/Y', strtotime($result->{'Publishing Date'}))}} </td>
              <td>{{$result->{'Remarks'} }} </td>
             <!--  <td>{{$result->{'StatusLable'} }} </td> -->
             @if(@$status==0)
              @if($result->{'Compliance Status'}=="1" && $result->{'Billing Status'}=="1")
              <td> Bill Submitted </td>
              @else
              <td style="width: 150px" align="center"><a class="m-0 font-weight-normal text-info" href="{{route('billing.create', ['NPCode'=>$result->{'NP Code'},'ROCode'=>$result->{'RO No_'}, 'CrativeFileName'=>@$result->{'Crative File Name'},'givenAmount'=>round($result->{'Amount'}),'totaladvtSize'=>round($result->{'advtSize'}),'cpublishedDate'=>date('d-m-Y', strtotime($result->{'TentativePublishingDate'}))] )}}" class="editMember">
                  <i class="fa fa-user-plus"></i> Submit Bill</a>
              </td>
              @endif
              @endif
            </tr>
            @empty
            <tr style="text-align: center; color: red;">
              <td colspan="12">No Data</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>
@endsection
