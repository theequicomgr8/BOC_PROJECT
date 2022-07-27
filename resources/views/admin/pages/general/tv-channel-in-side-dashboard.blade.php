@extends('admin.layouts.layout')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container" style="width:90%;margin-bottom: 10px;">
    <div class="row header" style="text-align:center;color:#46b8da;">
        <h3>TV Channel List</h3>
    </div>
    
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr style="background-color: #46b8da;">
                <th>S.No</th>
                <th>Name</th>
                <th>TC Code</th>
            </tr>
        </thead>
        <tbody>
          @foreach($datadb as $key=>$MinistryData)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$MinistryData->Name}}</td>
                <td>{{$MinistryData->{'Agency Code'} }}</td>
            </tr>
          @endforeach
        </tbody>
      <!--   <tfoot>
            <tr style="background-color: #46b8da;">
                <th>S.No</th>
                <th>Ministry Code</th>
                <th>Ministry Name</th>
                <th>Ministry Head</th>
            </tr>
        </tfoot> -->
    </table>
</div>
@endsection

<script type="text/javascript">
  $(document).ready(function() {
$('#example').DataTable();
} );
</script>

