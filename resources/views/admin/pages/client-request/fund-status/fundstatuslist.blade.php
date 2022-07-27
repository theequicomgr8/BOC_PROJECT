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
     
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="card-body p-2">

     <div class="table-responsive">
      <div>
        <label>Media Type</label>
        <select class="form-group">
          <option>Select any media Type</option>
          <option selected="selected">Print</option>
        </select>
      </div>
      <table class="table table-striped table-bordered table-hover order-list" id="myTable">   
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Description</th>
            <th scope="col">Advertising</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>LOA amount recieved since 01/04/2022</td>
             <td>0.00</td>
          </tr>
          <tr>
            <td>2</td>
            <td>LOA amount available as on <?php echo date('d/m/Y') ?></td>
             <td id=loa_amount>0.00</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Cheque amount received since 01/04/2022</td>
            <td>0.00</td>
          </tr>
          <tr>
            <td>4</td>
            <td>Cheque amount available as on <?php echo date('d/m/Y') ?></td>
             <td id="cheque_amount">{{round($closing_amount)}}</td>
          </tr>
          <tr>
            <td>5</td>
            <td>Release orders/Commitment since 01/04/2022</td>
            <td>@if(@$gemcmt->{'HEAD_NO'})<strong><a style="color:#3158c9;" href="{{url('print-cmt/'.round(@$gemcmt->{'HEAD_NO'}))}}">{{round($get_camt)}}</a></strong> @else 
            00.0
            @endif</td>
          </tr>
           <tr>
            <td>6</td>
            <td>Bill passed for payment as on <?php echo date('d/m/Y') ?></td>
            <td>@if(@$get_mhexpd->HEAD_NO)<strong><a style="color:#3158c9;" href="{{url('print-expd/'.round($get_mhexpd->HEAD_NO))}}">{{round($get_expd)}}</a></strong>@else 00.0 @endif</td>
          </tr>
          
          <tr>
            <td>7</td>
            <td>Bills pending as on <?php echo date('d/m/Y') ?></td>
            <td>@if(@$get_mhcode->HEAD_NO)<strong><a style="color:#3158c9;" href="{{url('print-status/'.round($get_mhcode->HEAD_NO))}}">{{round($get_atotal)}}</a></strong>@else 00.0 @endif</td>
          </tr>
          <tr>
            <td>8</td>
            <td>Bills expected as on <?php echo date('d/m/Y') ?></td>
            <td>0.00</td>
          </tr>
          <tr>
            <td>9</td> 
            <td>E-Bill recieved physical bill not recieved</td>
            <td>0.00</td>
          </tr>
           <!--  <tr style="text-align: center; color: red;"><td colspan="15" >No Data</td></tr> -->
          </tbody>
        </table>
        <p class="pull-right" style="margin-right: 15%;"><strong>Total Outstanding [(LOA Amount+Cheque Amount)-Bill Pending]: Rs. {{round($closing_amount - $get_atotal)}}</strong></p>
      </div>
      <div class="d-block" style="width:100%; float: left;">
        <span class="float-right"> 
        </span> 
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
@endsection