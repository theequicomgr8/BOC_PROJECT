<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="row header" style="text-align:center;color:#46b8da;">
        <!-- <h3>TV Channel  Wise Agency Code</h3> -->
    </div>
     <h3><a href="vendor-login">Back</a></h3>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr style="background-color: #46b8da;">
                <th>S.No</th>
                <th>Name</th>
                <th>Agency Code</th>
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

<script type="text/javascript">
  $(document).ready(function() {
$('#example').DataTable();
} );
</script>
