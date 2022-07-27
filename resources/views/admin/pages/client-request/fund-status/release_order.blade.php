@extends('admin.layouts.layout')

@section('content')
<?php $prefix_url = Route::current()->getName();?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container" style="width:90%;margin-top: 70px;">

    @if($prefix_url == 'release-order-details')
        <p class="float-right"><a href="{{url('print-cmt')}}/{{$head_no}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></p>
    @elseif($prefix_url == 'bills-cleared-details')
        <p class="float-right"><a href="{{url('print-expd')}}/{{$head_no}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></p>
    @else
        <p class="float-right"><a href="{{url('print-status')}}/{{$head_no}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></p>
    @endif
    
<div class="row header" style="text-align:center;color:#46b8da;">
<h5>Release Order: {{$ro_code}}</h5>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%;margin-top: 70px;">
        <thead>
            <tr style="background-color: #46b8da;">
                <th>S.No.</th>
                <th>Newspaper Name</th>
                <th>Newspaper Code</th>                
                <th>State</th>
                <th>Publication City</th>
                @if($prefix_url == 'release-order-details')
                    <th>Commitment<br>Amount</th>
                @elseif($prefix_url == 'bills-cleared-details')
                    <th>Expenditure<br>Amount</th>
                @else
                    <th>Pending<br>Amount</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($get_release_order as $key => $value)
            <tr>
                <td align="center">{{$key+1}}</td>                
                <td>{{$value->NEWSPAPER_NAME}}</td>
                <td align="center">{{round($value->NEWSPAPER_CODE)}}</td>
                <td>{{$value->STATE_UT_NAME}}</td>
                <td>{{$value->PUBLICATION_CITY}}</td>
                <td align="right">{{round($value->amount)}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" align='right'><strong>Grand Total</strong></td>
            <td><strong>{{round($get_tl)}}<strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

<script type="text/javascript">
  $(document).ready(function() {
$('#example').DataTable();
} );


</script>

