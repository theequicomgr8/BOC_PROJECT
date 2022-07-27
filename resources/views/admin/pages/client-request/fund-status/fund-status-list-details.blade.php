@extends('admin.layouts.layout')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container" style="width:90%;margin-top: 70px;">

        <p class="float-right"><a href="{{url('fundstatus')}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></p>
<div class="row header" style="text-align:center;color:#46b8da;">
<h5>{{$Listname}}</h5>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%;margin-top: 70px;">
        <thead>
            <tr style="background-color: #46b8da;">
                <th>S.No.</th>
                <th>Release Order No.</th>
                <th>RO Subject</th>
                <!-- <th>Client Reference</th>
                <th>Client Date</th> -->
                <th>RO Date</th>
                <th>No. of Bills</th>
                <th>Amount (Rs.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($get_mt as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                
                <?php  $ro_code  = str_replace("/","_",$value['ROCODE']); ?>
                @if($tb_name == 'print_cmt')
                    <td><a href="{{URL::to('release-order-details')}}/{{$ro_code}}">{{$value['ROCODE']}}</a></td>
                @elseif($tb_name == 'print_expd')
                    <td><a href="{{URL::to('bills-cleared-details')}}/{{$ro_code}}">{{$value['ROCODE']}}</a></td>
                @else
                    <td><a href="{{URL::to('bills-pending-details')}}/{{$ro_code}}">{{$value['ROCODE']}}</a></td>
                @endif    
                <td>{{$value['SUBJECT']}}</td>
                <td>{{date("d/m/y",strtotime($value['RO_RELEASED_DT']))}}</td>
                <td>{{round($value['NO_OF_ROS'])}}</td>
                <td>{{round($value['amount'])}}</td>
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

