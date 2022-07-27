<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Client Request Application Receipt</title>
    <style>
      body{
        
    color: #6c757d !important;
  }
  tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
.text-size{
  text-size:10px;
}
table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}
    </style>
</head>
@php 
$results=isset($response)? $response:'';
//dd($to_date);
@endphp
<body>
    <div class="card-body">
     <div class="table-responsive">
     <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
     <thead>
      <tr>
            <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        CENTRAL BUREAU OF  COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase V, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        
    </thead>
    </table>
      <table class="table table-striped table-bordered table-hover order-list" id="myTable">   
        <thead>
          <tr>
            <th>S.No</th>
            <th>Media Request</th>
             <th>Media Category</th>
            <th>Request Date</th>
            <th>From Date</th>
            <th>To Date</th>
            <!-- <th scope="col">Email</th> -->
            <th>Status</th>

              <th>Display Key</th>
              <th>MP Status</th> 
          </tr>
        </thead>
        <tbody>
        @forelse($results as $key=>$result) 
          <tr>
            <td>{{$key+1}}</td>
            <td>{{ $result->ClientRequestNo }}</td>
            @if($wingType_text )
            <td>{{$wingType_text}}</td>
            @else
            <td>{{ 'NA' }}  </td>
            @endif
            <td>{{ date('Y-m-d', strtotime($result->RequestDate)) }} </td>
            <td>{{ date('Y-m-d', strtotime($result->FromDate))  }} </td>
            <td>{{ date('Y-m-d', strtotime($result->ToDate)) }} </td>
            @if($result->Status =="0")
            <td> {{ 'Open' }} </td>
            @elseif($result->Status =="1" || $result->Status=="2")
            <td> {{ 'Under Process' }} </td>
            @elseif($result->Status =="3")
            <td>{{ 'Plan Created' }}  </td>
            
            @else
            <td>{{ 'NA' }}  </td>
            @endif
            @if(@isset($result->MPNO))
             <td>{{@$result->MPNO}}  </td>
             @else
             <td>NA</td>
             @endif
             @if($result->MPStatus =="0")
                <td> {{ 'Open' }} </td>
              @elseif($result->MPStatus =="1")
                <td> {{ 'Under Approval' }}  </td>
              @elseif($result->MPStatus =="2")
                <td> {{ 'Approved' }} </td>
              @elseif($result->MPStatus =="3")
                <td> {{ 'Rejected' }} </td>
              @elseif($result->MPStatus =="4")
                <td> {{ 'Farworded' }} </td>
              @elseif($result->MPStatus =="5")
                <td> {{ 'Approved' }} </td>
              @elseif($result->MPStatus =="6")
                <td> {{ 'Rejected' }} </td>
              @else
              <td>{{ 'NA' }}  </td>
              @endif
         </tr>
         @empty
            <tr style="text-align: center; color: red;"><td colspan="15" >No Data</td></tr>
            @endforelse
          </tbody>
        </table>
    
      </div>
    
    </div>
  

</body>

</html>